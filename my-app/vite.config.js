import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'

// https://vitejs.dev/config/
export default defineConfig({
  base: '/wp-content/plugins/svelteboilerplate/my-app/dist/',
  plugins: [svelte()]
})
