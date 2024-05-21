import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import path from 'path';

export default defineConfig({
	plugins: [
		laravel({
			input: 'resources/js/app.tsx',
			refresh: true,
		}),
		react(),
	],
	resolve: {
		alias: {
			'@': path.resolve(__dirname, 'resources/js'),
			'assets': path.resolve(__dirname, 'resources/assets'),
		},
		extensions: ['.js', '.jsx', '.ts', '.tsx'], // Add .ts and .tsx here
	},
});
