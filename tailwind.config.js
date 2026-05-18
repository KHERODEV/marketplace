/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./pages/**/*.php",
    "./includes/**/*.php",
    "./admin/**/*.php",
    "./vendor/**/*.php",
    "./assets/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#f97316',
        secondary: '#1f2937',
      }
    },
  },
  plugins: [],
}
