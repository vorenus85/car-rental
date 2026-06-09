import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/admin/css/app.css',
                'resources/admin/js/app.js',
                'resources/storefront/css/app.css',
                'resources/storefront/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
        tailwindcss(),
    ],
    test: {
        environment: 'jsdom',
        coverage: {
            provider: 'v8',
            reporter: ['text', 'html'],
            include: [
                'resources/admin/js/composables/**',
                'resources/admin/js/services/**',
                'resources/admin/js/stores/**',
                'resources/admin/js/validators/**',

                'resources/storefront/js/composables/**',
                'resources/storefront/js/services/**',
                'resources/storefront/js/stores/**',
                'resources/storefront/js/validators/**',
            ],
            thresholds: {
                lines: 70,
                functions: 70,
                branches: 60,
                statements: 70,
            },
        },
    },
    resolve: {
        alias: {
            '@admin': path.resolve(__dirname, 'resources/admin/js'),
            '@storefront': path.resolve(__dirname, 'resources/storefront/js'),
        },
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
        proxy: {
            '/sanctum': 'http://localhost:8080',
            '/api': 'http://localhost:8080',
            '/login': 'http://localhost:8080',
        },
        host: true,
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    },
})
