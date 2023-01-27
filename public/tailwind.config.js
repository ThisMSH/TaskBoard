/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin');
module.exports = {
  content: [
    "./**/*.js",
    "../app/views/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
      textShadow: {
        'h1': '0 0 6px #0F172A'
      },
      minWidth: {
        '140': '140px'
      },
      textStroke: {
        '1': '1px rgb(241 245 249)',
        '2': '1px rgb(96 165 250)'
      },
      maxHeight: {
        'vh-50': '50vh'
      },
      colors: {
        'red-0': 'rgb(255 0 0)'
      }
    },
  },
  plugins: [
    plugin(function ({matchUtilities, theme}) {
      matchUtilities(
        {
          'text-shadow': (value) => ({
            textShadow: value,
          })
        },
        { values:
          theme('textShadow')
        }
      )
    }),
    plugin(function ({matchUtilities, theme}) {
      matchUtilities(
        {
          'text-stroke': (value) => ({
            '-webkit-text-stroke': value,
          })
        },
        { values:
          theme('textStroke')
        }
      )
    }),
  ],
}
