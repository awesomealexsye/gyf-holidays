# GYF Holidays - Deployment Guide

## 📦 Production Build

Before deploying, create a production build:

```bash
npm run build
```

This will create a `dist/` folder with optimized static files ready for deployment.

---

## 🌐 Deployment Options

### 1. Netlify (Recommended - Easiest)

#### Method A: Drag & Drop
1. Build your project: `npm run build`
2. Go to [Netlify Drop](https://app.netlify.com/drop)
3. Drag the `dist/` folder onto the page
4. Done! You'll get a live URL instantly

#### Method B: Git Integration
1. Push your code to GitHub
2. Go to [Netlify](https://app.netlify.com)
3. Click "New site from Git"
4. Connect your repository
5. Build settings:
   - **Build command**: `npm run build`
   - **Publish directory**: `dist`
6. Click "Deploy site"

**Custom Domain**: 
- Go to Site settings → Domain management
- Add your custom domain
- Update DNS records as instructed

---

### 2. Vercel (Great for React Apps)

#### CLI Deployment
```bash
# Install Vercel CLI
npm i -g vercel

# Deploy
vercel

# Production deployment
vercel --prod
```

#### Git Integration
1. Go to [Vercel](https://vercel.com)
2. Import your Git repository
3. Vercel auto-detects Vite configuration
4. Click "Deploy"

**Custom Domain**:
- Go to Project Settings → Domains
- Add your custom domain
- Update DNS as instructed

---

### 3. GitHub Pages

1. Install gh-pages:
```bash
npm install --save-dev gh-pages
```

2. Add to `package.json`:
```json
{
  "homepage": "https://yourusername.github.io/gyfholidays",
  "scripts": {
    "predeploy": "npm run build",
    "deploy": "gh-pages -d dist"
  }
}
```

3. Update `vite.config.js`:
```javascript
export default defineConfig({
  plugins: [react()],
  base: '/gyfholidays/', // Your repo name
})
```

4. Deploy:
```bash
npm run deploy
```

5. Enable GitHub Pages:
   - Go to repo Settings → Pages
   - Source: gh-pages branch
   - Save

---

### 4. Traditional Hosting (cPanel/FTP)

1. Build the project:
```bash
npm run build
```

2. Upload files:
   - Connect via FTP/cPanel File Manager
   - Upload all files from `dist/` folder to your `public_html` or `www` directory
   - Make sure `index.html` is in the root

3. Configure:
   - If using subdirectory, update `vite.config.js` base path
   - Ensure server supports SPA routing (add `.htaccess` for Apache)

#### Apache .htaccess (for SPA routing)
Create `.htaccess` in the root:
```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /
  RewriteRule ^index\.html$ - [L]
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . /index.html [L]
</IfModule>
```

---

### 5. AWS S3 + CloudFront

1. Build the project:
```bash
npm run build
```

2. Create S3 bucket:
   - Enable static website hosting
   - Upload `dist/` contents
   - Set bucket policy for public access

3. Create CloudFront distribution:
   - Origin: Your S3 bucket
   - Default root object: `index.html`
   - Error pages: 404 → /index.html (for SPA routing)

4. Update DNS to point to CloudFront URL

---

### 6. Firebase Hosting

1. Install Firebase CLI:
```bash
npm install -g firebase-tools
```

2. Login and initialize:
```bash
firebase login
firebase init hosting
```

3. Configuration:
   - Public directory: `dist`
   - Single-page app: Yes
   - GitHub auto-deploy: Optional

4. Deploy:
```bash
npm run build
firebase deploy
```

---

## 🔧 Pre-Deployment Checklist

- [ ] Update `src/config.js` with production values
- [ ] Test all pages and forms
- [ ] Replace placeholder images with real ones
- [ ] Update meta tags in `index.html`
- [ ] Test on mobile devices
- [ ] Check console for errors
- [ ] Optimize images (compress)
- [ ] Update Google Maps API key if needed
- [ ] Test contact form submission
- [ ] Verify all links work
- [ ] Check browser compatibility

---

## 🎯 Performance Optimization

### Image Optimization
- Use WebP format for better compression
- Compress images before upload
- Use CDN for image hosting
- Lazy load images

### Build Optimization
Already configured in Vite:
- Code splitting ✅
- Minification ✅
- Tree shaking ✅
- CSS optimization ✅

### Additional Tips
- Enable gzip/brotli compression on server
- Use CDN for static assets
- Enable browser caching
- Monitor with Google Lighthouse

---

## 🔐 Security Best Practices

1. **Environment Variables**:
   - Never commit API keys
   - Use `.env` files for sensitive data
   - Add `.env` to `.gitignore`

2. **HTTPS**:
   - Always use HTTPS in production
   - Most platforms provide free SSL (Let's Encrypt)

3. **CORS**:
   - Configure properly if integrating with backend API

---

## 📊 Post-Deployment

### Analytics
Add Google Analytics to `index.html`:
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

### SEO
- Submit sitemap to Google Search Console
- Add structured data markup
- Optimize meta descriptions
- Add robots.txt

### Monitoring
- Set up uptime monitoring
- Configure error tracking (Sentry)
- Monitor performance (Google PageSpeed)

---

## 🆘 Troubleshooting

### Blank Page After Deployment
- Check browser console for errors
- Verify base path in `vite.config.js`
- Ensure all files uploaded correctly
- Check server configuration for SPA routing

### 404 on Page Refresh
- Configure server for SPA routing
- Add `.htaccess` for Apache
- Set error pages correctly in hosting platform

### Images Not Loading
- Check image URLs are absolute
- Verify CORS settings
- Use CDN or relative paths
- Check image file names and case sensitivity

---

## 📞 Support

For deployment assistance, contact your hosting provider or reach out to us at info@gyfholidays.com

---

**Happy Deploying! 🚀**

