# 🚀 Getting Started with GYF Holidays Website

Welcome! Your professional B2B travel website is ready. Follow these simple steps to get started.

---

## ⚡ Quick Start (3 Minutes)

### Step 1: Install Dependencies (1 min)
Open terminal in the project folder and run:
```bash
npm install
```

### Step 2: Start Development Server (30 sec)
```bash
npm run dev
```

Your website will open at: **http://localhost:5173**

### Step 3: View Your Website! ✨
Open your browser and explore all 6 pages:
- Home
- About Us
- Services
- Destinations
- News
- Contact Us

---

## 🎯 What You Need to Do Next

### Priority 1: Update Contact Information (5 minutes)
1. Open `src/config.js`
2. Update:
   - Phone numbers
   - Email addresses
   - WhatsApp number
   - Office address
   - Social media links

### Priority 2: Replace Images (10 minutes)
Replace placeholder images with your own:
- Hero backgrounds (1920x800px)
- Destination photos (800x600px)
- Team member photos (400x400px)
- News article images (800x600px)

**Where to find free images:**
- [Unsplash](https://unsplash.com)
- [Pexels](https://pexels.com)

### Priority 3: Update Content (15 minutes)
Review and customize:
- Company story in About Us page
- Service descriptions
- Testimonials
- News articles in `src/data/news.json`

---

## 📁 Important Files to Know

| File | What It Does | When to Edit |
|------|--------------|--------------|
| `src/config.js` | All contact info & settings | **First thing!** |
| `src/data/news.json` | News articles | To add/edit articles |
| `src/pages/Home.jsx` | Homepage content | To change homepage |
| `src/pages/AboutUs.jsx` | About page | To update company info |
| `tailwind.config.js` | Colors & styling | To change colors |

---

## 🎨 Quick Customizations

### Change Colors
Edit `tailwind.config.js`:
```javascript
primary: {
  500: '#3b82f6',  // Change this blue
  600: '#2563eb',
}
secondary: {
  500: '#f97316',  // Change this orange
  600: '#ea580c',
}
```

### Add Your Logo
1. Add logo to `public/` folder
2. Edit `src/components/Navbar.jsx`
3. Replace text logo with image

### Update Company Name
Find and replace "GYF Holidays" with your name in:
- `src/config.js`
- `src/components/Navbar.jsx`
- `src/components/Footer.jsx`
- `index.html` (page title)

---

## 🏗️ Building for Production

When you're ready to launch:

### Step 1: Build
```bash
npm run build
```

This creates a `dist/` folder with optimized files.

### Step 2: Deploy
Upload the `dist/` folder to your hosting:
- **Netlify**: Drag & drop the `dist/` folder
- **Vercel**: Run `vercel` command
- **Traditional Hosting**: FTP upload to `public_html`

Detailed deployment guide: See `DEPLOYMENT.md`

---

## 📚 Documentation Files

Your project includes comprehensive guides:

| Document | What's Inside |
|----------|---------------|
| `README.md` | Complete project documentation |
| `QUICK_START.md` | Fast start guide with commands |
| `DEPLOYMENT.md` | Detailed deployment instructions |
| `CUSTOMIZATION_GUIDE.md` | How to customize everything |
| `PROJECT_SUMMARY.md` | What has been built |
| `GETTING_STARTED.md` | This file - beginner guide |

---

## ✅ Pre-Launch Checklist

Before you deploy, make sure you:

- [ ] Updated contact info in `config.js`
- [ ] Replaced all placeholder images
- [ ] Updated company name everywhere
- [ ] Customized About Us page
- [ ] Added your own news articles
- [ ] Tested contact form
- [ ] Tested on mobile device
- [ ] Checked all links work
- [ ] Updated social media links
- [ ] Added your logo
- [ ] Updated page title in `index.html`
- [ ] Tested the build (`npm run build`)

---

## 🔧 Common Commands

```bash
# Start development server
npm run dev

# Build for production
npm run build

# Preview production build locally
npm run preview

# Install dependencies
npm install

# Update dependencies
npm update
```

---

## 📱 Test on Different Devices

### Desktop Testing
1. Open http://localhost:5173 in browser
2. Test all pages and forms
3. Click all buttons and links

### Mobile Testing
1. Open browser dev tools (F12)
2. Click device toolbar icon
3. Select different devices
4. Test navigation and forms

### Or test on real devices:
1. Find your computer's IP address
2. On mobile, visit: http://YOUR_IP:5173
3. Test everything on real device

---

## 💡 Tips for Success

1. **Start Small**: Update config first, then move to content
2. **Test Often**: Check changes as you make them
3. **Keep Backups**: Save copies of original files
4. **Use Git**: Commit changes regularly
5. **Ask for Help**: Check documentation files

---

## 🎓 Learning Resources

If you want to customize further:

- **React**: [react.dev](https://react.dev)
- **Tailwind CSS**: [tailwindcss.com](https://tailwindcss.com)
- **Vite**: [vitejs.dev](https://vitejs.dev)
- **React Icons**: [react-icons.github.io](https://react-icons.github.io)

---

## 🆘 Troubleshooting

### Can't install dependencies?
```bash
# Clear cache and try again
rm -rf node_modules package-lock.json
npm install
```

### Port 5173 already in use?
```bash
# Use different port
npm run dev -- --port 3000
```

### Build errors?
- Check for syntax errors in files
- Make sure all brackets match
- Verify imports are correct

### Form not working?
- Check browser console for errors
- Forms currently log to console (no backend)
- See `CUSTOMIZATION_GUIDE.md` to connect to backend

---

## 🎉 You're Ready!

Everything is set up and working. Now it's time to:

1. **Customize** - Make it yours
2. **Test** - Verify everything works
3. **Deploy** - Launch to the world
4. **Celebrate** - You have a professional website! 🎊

---

## 📞 Need More Help?

Check these files in order:
1. This file - Basic setup
2. `QUICK_START.md` - Commands and quick tips
3. `CUSTOMIZATION_GUIDE.md` - Detailed customization
4. `DEPLOYMENT.md` - How to deploy
5. `README.md` - Complete documentation

---

**Welcome to GYF Holidays Website! Let's make it yours! 🚀**

*Built with React + Vite + Tailwind CSS*

