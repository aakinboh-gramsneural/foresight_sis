import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                navy: {
                    50: '#e6e9ef',
                    100: '#c0c8d8',
                    200: '#96a4be',
                    300: '#6c80a4',
                    400: '#4d6591',
                    500: '#2d4a7e',
                    600: '#264376',
                    700: '#1d3a6b',
                    800: '#153261',
                    900: '#0a1628',
                    950: '#060e1a',
                },
                gold: {
                    50: '#fdf8ed',
                    100: '#f9edd0',
                    200: '#f3daa1',
                    300: '#ecc572',
                    400: '#e5b04d',
                    500: '#c8a960',
                    600: '#b8923a',
                    700: '#997332',
                    800: '#7d5c2e',
                    900: '#674c29',
                },
            },
            fontFamily: {
                heading: ['Inter', ...defaultTheme.fontFamily.sans],
                body: ['DM Sans', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'fade-in': 'fadeIn 0.6s ease-out forwards',
                'slide-up': 'slideUp 0.6s ease-out forwards',
                'slide-down': 'slideDown 0.3s ease-out forwards',
                'marquee': 'marquee 30s linear infinite',
                'marquee-reverse': 'marquee-reverse 30s linear infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideDown: {
                    '0%': { opacity: '0', transform: 'translateY(-10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                marquee: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                'marquee-reverse': {
                    '0%': { transform: 'translateX(-50%)' },
                    '100%': { transform: 'translateX(0)' },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
