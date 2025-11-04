import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  // Ensure public directory (including .htaccess) is copied to dist
  publicDir: 'public',
  build: {
    // Ensure .htaccess and other dotfiles are copied
    copyPublicDir: true,
  },
})
