/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                "semi-transparent": "rgba(0, 0, 0, 0.22)",
            },
        },
    },
    plugins: [],
};
