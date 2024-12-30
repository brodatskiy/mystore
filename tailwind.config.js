/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "selector",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.{vue,js,ts,jsx,tsx}",
    ],

    theme: {
        extend: {
            colors: {
            },
        },
    },

    plugins: [require('tailwindcss-primeui')],
};
