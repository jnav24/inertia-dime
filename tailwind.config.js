import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            borderWidth: {
                6: '6px',
            },
            colors: {
                danger: '#C62828',
                'dm-danger': '#4B0F0F',
                'dm-primary': '#264653',
                'dm-secondary': '#A88D3E',
                primary: '#389894',
                secondary: '#EFC958',
                success: '#198754',
                'dm-main': '#0E1013',
                'lm-primary': '#61EAE4FF',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            minHeight: {
                64: '16rem',
                256: '64rem',
            },
            maxHeight: {
                48: '12rem',
            },
            maxWidth: {
                32: '8rem',
                160: '40rem',
            },
            minWidth: {
                6: '1.5rem',
            },
            opacity: {
                85: '0.85',
                95: '0.95',
            },
            translate: {
                '6/7': '85.7142857%',
                '7/8': '87.5%',
                '9/10': '90%',
            },
            width: {
                100: '25rem',
                150: '38rem',
                200: '50rem',
                250: '63rem',
                300: '75rem',
            },
            zIndex: {
                100: 100,
            },
        },
    },

    plugins: [forms],
};
