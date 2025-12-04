/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      /*colors: {
          primary: "var(--primary-color)",
          accent: "var(--accent-color)",
          secondary: "var(--secondary-color)",
          bg: "var(--bg-color)",
          grayCustom: "var(--gray-color)",
      }*/
    },
  },
  variants: {
    extend: {
      backgroundColor: ['hover'],
      boxShadow: ['hover'],
      scale: ['hover'],
    },
  },
  plugins: [
      // require('flowbite/plugin')
  ],
}

