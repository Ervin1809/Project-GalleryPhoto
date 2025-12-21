import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Custom Photography Portfolio Palette
                'warm': {
                    50: '#fdf8f4',
                    100: '#faf0e6',
                    200: '#f5e1cd',
                    300: '#E8B38C', // Primary warm peach
                    400: '#d9a070',
                    500: '#BB8644', // Rich amber/caramel
                    600: '#9a6e38',
                    700: '#75654C', // Deep earthy brown
                    800: '#5c4f3d',
                    900: '#433a2e',
                },
                'sage': {
                    50: '#f4f6f4',
                    100: '#e8ece8',
                    200: '#d1d9d1',
                    300: '#b3c2b3',
                    400: '#909E84', // Muted sage green
                    500: '#788a6e',
                    600: '#607058',
                    700: '#4d5946',
                    800: '#3d4739',
                    900: '#2d332a',
                },
                'gold': {
                    50: '#fcfbf0',
                    100: '#f9f7e1',
                    200: '#f1efc3',
                    300: '#E3D477', // Soft gold/chartreuse
                    400: '#d4c35a',
                    500: '#c4b040',
                    600: '#9d8d33',
                    700: '#766a26',
                    800: '#50481a',
                    900: '#29240d',
                },
            },
        },
    },

    plugins: [forms],
};
