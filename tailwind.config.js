module.exports = {
  content: [
      "./resources/views/register/registerUser.blade.php",
      "./resources/views/layout.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/aspect-ratio'),
  ],
}
