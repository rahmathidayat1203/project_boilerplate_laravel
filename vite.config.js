import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/adminlte.css', 'resources/js/adminlte.js', 'resources/css/datatables.css', 'resources/js/datatables.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
