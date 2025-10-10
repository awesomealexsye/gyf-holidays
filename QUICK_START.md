# GYF Holidays - Quick Start Guide

## 🚀 Getting Started in 3 Steps

### Step 1: Install Dependencies
```bash
npm install
```

### Step 2: Start Development Server
```bash
npm run dev
```
Your website will be available at `http://localhost:5173`

### Step 3: Build for Production
```bash
npm run build
```
Production-ready files will be in the `dist/` folder.

---

## 📝 Customization Guide

### Update Company Information

Edit `src/config.js` to update:

```javascript
// Company details
company: {
  name: "GYF Holidays",
  tagline: "Your Trusted B2B Travel Partner",
  // ... update as needed
}

// Contact information
contact: {
  phone: "+91 98765 43210",      // Update your phone
  email: "info@gyfholidays.com", // Update your email
  whatsapp: "+919876543210",     // Update WhatsApp number
  address: {
    street: "123 Business Park...",
    city: "Mumbai",
    // ... update your address
  }
}

// Social media links
social: {
  facebook: "https://facebook.com/yourpage",
  instagram: "https://instagram.com/yourpage",
  // ... update your social links
}
```

### Add News Articles

Edit `src/data/news.json`:

```json
[
  {
    "id": 1,
    "title": "Your Article Title",
    "excerpt": "Brief description",
    "content": "Full article content here...",
    "image": "https://your-image-url.com/image.jpg",
    "date": "2025-10-10",
    "category": "Travel Tips"
  }
]
```

### Change Colors

Edit `tailwind.config.js`:

```javascript
colors: {
  primary: {
    500: '#3b82f6',  // Main blue color
    600: '#2563eb',
    // ... adjust as needed
  },
  secondary: {
    500: '#f97316',  // Main orange color
    600: '#ea580c',
    // ... adjust as needed
  }
}
```

### Update Images

Replace image URLs throughout the components:
- Look for `https://images.unsplash.com/...` 
- Replace with your own image URLs
- Recommended: Use a CDN or image hosting service

---

## 🎯 Key Files to Customize

| File | Purpose |
|------|---------|
| `src/config.js` | Company info, contact details, social links |
| `src/data/news.json` | News articles and blog posts |
| `src/pages/Home.jsx` | Homepage content and sections |
| `src/pages/AboutUs.jsx` | About page content and team |
| `src/pages/Services.jsx` | Services descriptions |
| `src/pages/Destination.jsx` | Destinations and tours |
| `tailwind.config.js` | Theme colors and styling |

---

## 🌐 Deployment Options

### Option 1: Netlify
1. Build: `npm run build`
2. Drag `dist/` folder to [Netlify Drop](https://app.netlify.com/drop)
3. Done! Your site is live.

### Option 2: Vercel
1. Install Vercel CLI: `npm i -g vercel`
2. Run: `vercel`
3. Follow prompts
4. Done!

### Option 3: Traditional Hosting
1. Build: `npm run build`
2. Upload all files from `dist/` folder to your web server
3. Point your domain to the hosting directory
4. Done!

---

## 📱 Testing Responsiveness

Test your website on different screen sizes:
- Mobile: 375px - 767px
- Tablet: 768px - 1023px
- Desktop: 1024px+

Open browser dev tools (F12) and use device toolbar to test.

---

## 💡 Tips

1. **Images**: Use high-quality images (min 1920px width for hero sections)
2. **Performance**: Compress images before using them
3. **SEO**: Update `index.html` title and meta description
4. **Forms**: Currently logs to console - integrate with your backend/email service
5. **Google Maps**: Update the map embed URL in `config.js`

---

## 🆘 Troubleshooting

### Dependencies Installation Issues
```bash
# Clear cache and reinstall
rm -rf node_modules package-lock.json
npm install
```

### Build Errors
```bash
# Check for syntax errors
npm run build
```

### Port Already in Use
```bash
# Use different port
npm run dev -- --port 3000
```

---

## 📞 Need Help?

Contact us at info@gyfholidays.com for support.

---

**Happy Building! 🎉**

