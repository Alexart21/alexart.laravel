import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/bootstrap.min.css',
                'resources/css/animate.min.css',
                'resources/css/fontawesome/css/all.min.css',

                'resources/js/app.js',
                'resources/js/velocity.min.js',
                'resources/js/velocity.ui.min.js',
                'resources/js/wow.min.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
