const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            indigo: colors.indigo,
            violet: colors.violet,
            white: {
                DEFAULT: '#fff',
                20: 'rgba(255,255,255,.2)',
                40: 'rgba(255,255,255,.4)',
                60: 'rgba(255,255,255,.6)',
                80: 'rgba(255,255,255,.8)'
            },
            gray: {
                100: '#f7fafc',
                200: '#edf2f7',
                300: '#e2e8f0',
                400: '#cbd5e0',
                500: '#a0aec0',
                600: '#718096',
                700: '#4a5568',
                800: '#2d3748',
                900: '#1a202c'
              },
              blue: {
                100: '#ebf8ff',
                200: '#bee3f8',
                300: '#90cdf4',
                400: '#63b3ed',
                500: '#4299e1',
                600: '#3182ce',
                700: '#2b6cb0',
                800: '#2c5282',
                900: '#2a4365',
                accent: '#aff2ff'
              },
              yellow: {
                100: '#fffff0',
                200: '#fefcbf',
                300: '#faf089',
                400: '#f6e05e',
                500: '#ecc94b',
                600: '#d69e2e',
                700: '#b7791f',
                800: '#975a16',
                900: '#744210'
              },
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
        backgroundColor: ['responsive', 'hover', 'focus'],
        outline: ['responsive', 'focus'],
    },

    plugins: [require('@tailwindcss/forms')],
};
