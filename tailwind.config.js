/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        "primary": "#00B0FF",
        "grey": "#F4F9FF",
        "dark": "#333333",
        "dark-secunder": "#757575",
        "error": "#FF0000",
        "success": "#11AF22",
        "light": "#FFF",
        "yellow": "#FFF200",
      },
      fontFamily: {
        "plusJakartaSans": ['Plus Jakarta Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

