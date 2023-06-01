import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/dashboard.js',
                'resources/css/bootstrap.rtl.min.css',
                'resources/css/dashboard.css',
                'resources/css/dashboard.rtl.css',
            ],
            refresh: true,
        }),
    ],
});
