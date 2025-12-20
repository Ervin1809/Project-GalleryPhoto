<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Auth:: user()->role !== 'admin') {
    //             abort(403, 'Unauthorized.  Admin access only.');
    //         }
    //         return $next($request);
    //     });
    // }

    public function index()
    {
        $images = Image::with('reviews')->latest()->paginate(10);
        return view('admin.images.index', compact('images'));
    }

    public function create()
    {
        return view('admin.images.create');
    }

    public function store(Request $request)
    {
        try {
            // Validasi dengan pesan error custom
            $validated = $request->validate([
                'title' => 'required|string|max: 255',
                'file_low_res' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'file_high_res' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
                'description' => 'required|string',
            ], [
                // Custom error messages
                'title.required' => 'Title is required.',
                'title.max' => 'Title cannot exceed 255 characters.',

                'file_low_res. required' => 'Low resolution image is required.',
                'file_low_res.image' => 'Low resolution file must be an image.',
                'file_low_res.mimes' => 'Low resolution image must be:  JPEG, PNG, JPG, WebP, or GIF.',
                'file_low_res.max' => 'Low resolution image size cannot exceed 5MB.',

                'file_high_res.required' => 'High resolution image is required.',
                'file_high_res.image' => 'High resolution file must be an image.',
                'file_high_res.mimes' => 'High resolution image must be: JPEG, PNG, JPG, WebP, or GIF.',
                'file_high_res.max' => 'High resolution image size cannot exceed 10MB.',
            ]);

            // Cek apakah file uploaded
            if (!$request->hasFile('file_low_res')) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Low resolution file not uploaded.  Please try again.');
            }

            if (!$request->hasFile('file_high_res')) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'High resolution file not uploaded.  Please try again.');
            }

            // Cek apakah file valid
            if (! $request->file('file_low_res')->isValid()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Low resolution file is corrupted or invalid. Please upload a different file.');
            }

            if (!$request->file('file_high_res')->isValid()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'High resolution file is corrupted or invalid. Please upload a different file.');
            }

            // Upload low res
            $lowResFile = $request->file('file_low_res');
            $lowResPath = $lowResFile->store('images/low_res', 'public');

            if (!$lowResPath) {
                throw new \Exception('Failed to save low resolution image to storage.  Check storage permissions.');
            }

            // Upload high res
            $highResFile = $request->file('file_high_res');
            $highResPath = $highResFile->store('images/high_res', 'public');

            if (!$highResPath) {
                // Rollback:  hapus low res yang sudah diupload
                Storage::disk('public')->delete($lowResPath);
                throw new \Exception('Failed to save high resolution image to storage. Check storage permissions.');
            }

            // Verify files exist
            if (!Storage::disk('public')->exists($lowResPath)) {
                throw new \Exception('Low resolution image uploaded but not found in storage.');
            }

            if (!Storage::disk('public')->exists($highResPath)) {
                Storage::disk('public')->delete($lowResPath);
                throw new \Exception('High resolution image uploaded but not found in storage.');
            }

            // Create image record
            $image = Image::create([
                'title' => $validated['title'],
                'file_low_res' => $lowResPath,
                'file_high_res' => $highResPath,
                'uploaded_by' => Auth::id(),
                'description' => $validated['description'],
            ]);

            // Log success
            Log::info('Image uploaded successfully', [
                'image_id' => $image->id,
                'title' => $image->title,
                'admin_id' => Auth::id(),
            ]);

            return redirect()
                ->route('admin.images.index')
                ->with('success', '✅ Image uploaded successfully! Low res:  ' . $lowResFile->getClientOriginalName() . ', High res: ' . $highResFile->getClientOriginalName());

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors (otomatis di-handle Laravel)
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->validator);

        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Image upload failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'admin_id' => Auth::id(),
            ]);

            // Cleanup:  hapus file jika ada yang terupload
            if (isset($lowResPath)) {
                Storage::disk('public')->delete($lowResPath);
            }
            if (isset($highResPath)) {
                Storage::disk('public')->delete($highResPath);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Upload failed: ' .  $e->getMessage() . ' Please check file format and size, or contact support.');
        }
    }

    public function destroy(Image $image)
    {
        try {
            // Verify image exists
            if (!$image) {
                return redirect()
                    ->route('admin.images.index')
                    ->with('error', 'Image not found.');
            }

            // Store image info for log
            $imageTitle = $image->title;
            $imageId = $image->id;

            // Delete files from storage
            $lowResDeleted = Storage::disk('public')->delete($image->file_low_res);
            $highResDeleted = Storage::disk('public')->delete($image->file_high_res);

            // Warning jika file tidak terhapus (tapi lanjut hapus record)
            $deletionWarning = '';
            if (!$lowResDeleted) {
                $deletionWarning .= ' Low resolution file not found in storage.';
            }
            if (!$highResDeleted) {
                $deletionWarning .= ' High resolution file not found in storage.';
            }

            // Delete database record
            $image->delete();

            // Log success
            Log::info('Image deleted', [
                'image_id' => $imageId,
                'title' => $imageTitle,
                'admin_id' => Auth::id(),
            ]);

            $message = '✅ Image deleted successfully!';
            if ($deletionWarning) {
                $message .= ' Note: ' . $deletionWarning;
            }

            return redirect()
                ->route('admin.images.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            // Log error
            Log::error('Image deletion failed', [
                'error' => $e->getMessage(),
                'image_id' => $image->id ??  'unknown',
                'admin_id' => Auth::id(),
            ]);

            return redirect()
                ->back()
                ->with('error', '❌ Delete failed: ' . $e->getMessage());
        }
    }
}
