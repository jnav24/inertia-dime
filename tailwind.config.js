import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

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
            blur: {
                xs: '2px',
            },
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

                // 'dm-primary': '#0E1013',
                // 'dm-secondary': '#17181B',
                'dm-stroke': '#25272b',
                'dm-text': '#41444c',
                'dm-text-hover': '#575b66',
                'dm-disabled': '#3C3C3C',
                'dm-text-disabled': '#777777',
                // 'lm-primary': colors.gray['50'],
                'lm-secondary': colors.white,
                'lm-stroke': colors.gray['200'],
                'lm-text': colors.gray['300'],
                'lm-text-hover': colors.gray['500'],
                'lm-disabled': '#E5E5E5',
                'lm-text-disabled': '#ABABAB',
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
                125: '31.25rem',
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
