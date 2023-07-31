import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/style.scss',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/js/jquery-3.6.4.min.js',
                'resources/js/bootstrap.min.js',
                'resources/js/popper.min.js',
                'resources/fonts/icomoon/style.css',
                // 'resources/css/owl.carousel.min.css',
                // 'resources/css/style.css',
            ],
            refresh: true,
        }),
    ],
});
