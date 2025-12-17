/** @type {import('tailwindcss').Config} */
const path = require('path');

module.exports = {
  content: [
    path.join(__dirname, 'templates/components/**/*.php'),
    path.join(__dirname, 'template-components.php'),
  ],
  theme: {
    extend: {
      colors: {
        // Add custom colors if needed based on theme
        brand: {
          DEFAULT: '#541388', // Purple
          light: '#AF1E63',
          dark: '#120E25',
        },
        accent: {
          DEFAULT: '#D01524', // Red
        },
      },
      borderRadius: {
        '10': '10px',
        '20': '20px',
      },
      boxShadow: {
        'custom': '0px 5px 8px 4px rgba(0, 0, 0, 0.1)',
      },
    },
  },
  plugins: [],
}

