import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/currency_rates.css',
                'resources/js/app.js',
                'resources/js/currency_converter.js',
            ],
            refresh: true,
        }),
    ],
});
