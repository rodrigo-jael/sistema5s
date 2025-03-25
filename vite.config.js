import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Permite conexiones externas
        port: 5173, // Asegúrate de usar este puerto en el teléfono
        strictPort: true,
        hmr: {
            host: '192.168.100.42', // Poner la IP de tu laptop
        },
    }
});
