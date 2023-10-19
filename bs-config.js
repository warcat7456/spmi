module.exports = {
    files: [
        'resources/views/**/*.blade.php',
    ],
    proxy: 'localhost:8000',
    port: 3000, // Browsersync port (you can change this to another port if needed)
};
