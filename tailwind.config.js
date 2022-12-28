module.exports = {
    purge: ["./resources/views/**/*.blade.php", "./resources/css/**/*.css"],
    theme: {
        extend: {
            spacing: {
                128: "42rem",
            }
        },
    },
    variants: {},
    plugins: [require("@tailwindcss/custom-forms")],
};
