/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './app/Livewire/**/*.php',
    './app/Http/Livewire/**/*.php',
    './vendor/livewire/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}