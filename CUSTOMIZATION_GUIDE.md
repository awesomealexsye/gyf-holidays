# GYF Holidays - Customization Guide

Complete guide to customize every aspect of your website.

---

## 🎨 Branding Customization

### 1. Update Company Name & Logo

#### Change Company Name
Edit `src/config.js`:
```javascript
company: {
  name: "Your Company Name",
  tagline: "Your Tagline Here",
  fullName: "Your Company Full Legal Name Pvt. Ltd.",
}
```

Also update in:
- `src/components/Navbar.jsx` - Logo text
- `src/components/Footer.jsx` - Footer branding
- `index.html` - Page title

#### Add Your Logo
1. Add logo image to `public/logo.png`
2. Update `src/components/Navbar.jsx`:
```jsx
<Link to="/" className="flex items-center space-x-2">
  <img src="/logo.png" alt="Logo" className="h-12" />
  <div className="text-3xl font-bold">
    <span className="gradient-primary bg-clip-text text-transparent">GYF</span>
    <span className="text-secondary-600"> Holidays</span>
  </div>
</Link>
```

---

## 📞 Contact Information

### Update All Contact Details
Edit `src/config.js`:

```javascript
contact: {
  phone: "+1 234 567 8900",           // Main phone
  alternatePhone: "+1 234 567 8901",  // Secondary phone
  email: "info@yourcompany.com",      // Main email
  salesEmail: "sales@yourcompany.com", // Sales email
  supportEmail: "support@yourcompany.com", // Support email
  whatsapp: "+12345678900",           // WhatsApp (no spaces or +)
  address: {
    street: "Your Street Address",
    city: "Your City",
    state: "Your State",
    zip: "12345",
    country: "Your Country",
  },
}
```

### Update Business Hours
```javascript
businessHours: {
  weekdays: "Monday - Friday: 9:00 AM - 6:00 PM",
  saturday: "Saturday: 10:00 AM - 4:00 PM",
  sunday: "Sunday: Closed",
}
```

### Update Google Maps
Get your Google Maps embed URL:
1. Go to [Google Maps](https://maps.google.com)
2. Search for your location
3. Click "Share" → "Embed a map"
4. Copy the iframe URL
5. Update in `config.js`:
```javascript
mapEmbedUrl: "YOUR_GOOGLE_MAPS_EMBED_URL"
```

---

## 🌐 Social Media Links

Edit `src/config.js`:
```javascript
social: {
  facebook: "https://facebook.com/yourpage",
  instagram: "https://instagram.com/yourpage",
  twitter: "https://twitter.com/yourpage",
  linkedin: "https://linkedin.com/company/yourpage",
  youtube: "https://youtube.com/@yourpage",
}
```

---

## 📊 Statistics & Numbers

Update your business statistics in `src/config.js`:
```javascript
stats: {
  destinations: 200,      // Number of destinations
  happyClients: 10000,    // Number of clients
  yearsExperience: 15,    // Years in business
  teamMembers: 100,       // Team size
}
```

These appear on the homepage stats section.

---

## 🖼️ Images & Photos

### Hero Images
Update background images in each page:

**Home Page** (`src/pages/Home.jsx`):
```jsx
<Hero
  backgroundImage="https://your-image-url.com/hero.jpg"
/>
```

**About Page** (`src/pages/AboutUs.jsx`):
```jsx
<Hero
  backgroundImage="https://your-image-url.com/about.jpg"
/>
```

### Destination Images
Edit `src/pages/Destination.jsx`:
```javascript
const destinations = [
  {
    name: 'Your Destination',
    image: 'https://your-image-url.com/destination.jpg',
    // ... other properties
  }
]
```

### Team Member Photos
Edit `src/pages/AboutUs.jsx`:
```javascript
const team = [
  {
    name: 'Team Member Name',
    position: 'Position',
    image: 'https://your-image-url.com/team-member.jpg',
  }
]
```

### Image Recommendations
- **Hero Images**: 1920x800px minimum
- **Destination Cards**: 800x600px
- **Team Photos**: 400x400px (square)
- **News Images**: 800x600px
- Format: JPG or WebP (compressed)
- Use image optimization tools before uploading

---

## 🎨 Colors & Theme

### Change Primary Color (Blue)
Edit `tailwind.config.js`:
```javascript
primary: {
  50: '#eff6ff',
  100: '#dbeafe',
  200: '#bfdbfe',
  300: '#93c5fd',
  400: '#60a5fa',
  500: '#3b82f6',  // Main color
  600: '#2563eb',  // Darker shade
  700: '#1d4ed8',
  800: '#1e40af',
  900: '#1e3a8a',
}
```

### Change Secondary Color (Orange)
```javascript
secondary: {
  50: '#fff7ed',
  100: '#ffedd5',
  200: '#fed7aa',
  300: '#fdba74',
  400: '#fb923c',
  500: '#f97316',  // Main color
  600: '#ea580c',  // Darker shade
  700: '#c2410c',
  800: '#9a3412',
  900: '#7c2d12',
}
```

### Change Font
Edit `tailwind.config.js`:
```javascript
fontFamily: {
  sans: ['Your Font', 'sans-serif'],
}
```

Add font link to `index.html`:
```html
<link href="https://fonts.googleapis.com/css2?family=Your+Font:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

---

## 📰 News Articles

### Add New Article
Edit `src/data/news.json`:
```json
{
  "id": 7,
  "title": "Your Article Title",
  "excerpt": "Brief description of your article (150-200 characters)",
  "content": "Full article content goes here. This can be multiple paragraphs. Write as much as you need to fully explain your topic.",
  "image": "https://your-image-url.com/article.jpg",
  "date": "2025-10-15",
  "category": "Your Category"
}
```

### Available Categories
- Travel Tips
- Business Travel
- Destinations
- Travel Planning
- Sustainability
- Travel Safety
- (or create your own)

### Image Sources
- [Unsplash](https://unsplash.com) - Free high-quality images
- [Pexels](https://pexels.com) - Free stock photos
- Your own professional photography

---

## 🏢 Services Customization

### Update Services
Edit `src/pages/Services.jsx`:

```javascript
const mainServices = [
  {
    icon: FaYourIcon,  // Import from react-icons
    title: 'Your Service Name',
    description: 'Detailed description of your service...',
    features: [
      'Feature 1',
      'Feature 2',
      'Feature 3',
    ],
    color: 'bg-blue-500',  // Choose color
  }
]
```

### Available Icon Options
Import from `react-icons/fa`:
- `FaPlane` - Flights
- `FaHotel` - Hotels
- `FaBus` - Transport
- `FaUsers` - Groups
- `FaGlobe` - Global
- `FaPassport` - Visa
- ... and 1000+ more icons

---

## 🌍 Destinations

### Add New Destination
Edit `src/pages/Destination.jsx`:
```javascript
{
  id: 16,
  name: 'Destination Name, Country',
  category: 'international', // or 'domestic'
  popular: true,  // or false
  image: 'https://your-image-url.com/destination.jpg',
  tours: '20+',
  rating: 4.8,
  description: 'Brief description of the destination',
  highlights: ['Highlight 1', 'Highlight 2', 'Highlight 3'],
}
```

### Categories
- `international` - International destinations
- `domestic` - Domestic destinations
- Set `popular: true` to show in Popular filter

---

## 📝 Page Content

### Home Page Content
Edit `src/pages/Home.jsx`:

**Hero Section**:
```jsx
<Hero
  title="Your Main Headline"
  subtitle="Your supporting text goes here"
/>
```

**Services**: Update the `services` array
**Testimonials**: Update the `testimonials` array
**Why Choose Us**: Update the `whyChooseUs` array

### About Page Content
Edit `src/pages/AboutUs.jsx`:

**Mission & Vision**: Update text in the cards
**Values**: Update the `values` array
**Timeline**: Update the `milestones` array
**Team**: Update the `team` array

### Contact Page Content
Edit `src/pages/ContactUs.jsx`:

**Office Locations**: Update the `offices` array
**FAQ**: Update the FAQ array

---

## 📋 Contact Form Fields

### Customize Form Fields
Edit `src/components/ContactForm.jsx`:

Add new field:
```jsx
<div>
  <label className="block text-sm font-medium text-gray-700 mb-2">
    Your Field Label *
  </label>
  <input
    type="text"
    name="yourField"
    value={formData.yourField}
    onChange={handleChange}
    required
    className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
    placeholder="Placeholder text"
  />
</div>
```

Don't forget to add to initial state:
```javascript
const [formData, setFormData] = useState({
  // ... existing fields
  yourField: '',
})
```

### Connect Form to Backend
Replace the console.log in `handleSubmit`:

```javascript
const handleSubmit = async (e) => {
  e.preventDefault()
  setIsSubmitting(true)

  try {
    const response = await fetch('YOUR_API_ENDPOINT', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    })
    
    if (response.ok) {
      setShowSuccess(true)
      // Reset form
    }
  } catch (error) {
    console.error('Error:', error)
  }
  
  setIsSubmitting(false)
}
```

---

## 🎯 SEO Customization

### Update Page Title & Meta
Edit `index.html`:
```html
<title>Your Company - Your Tagline</title>
<meta name="description" content="Your company description for search engines" />
```

### Add More Meta Tags
```html
<meta property="og:title" content="Your Company Name" />
<meta property="og:description" content="Your description" />
<meta property="og:image" content="https://your-site.com/og-image.jpg" />
<meta property="og:url" content="https://your-site.com" />
<meta name="twitter:card" content="summary_large_image" />
```

---

## 🔧 Advanced Customizations

### Add New Page
1. Create `src/pages/YourPage.jsx`
2. Add route in `src/App.jsx`:
```jsx
<Route path="/your-page" element={<YourPage />} />
```
3. Add link in `src/components/Navbar.jsx`

### Change Animation Speed
Edit animation settings in any component:
```jsx
<motion.div
  initial={{ opacity: 0 }}
  animate={{ opacity: 1 }}
  transition={{ duration: 0.5 }} // Adjust speed here
>
```

### Remove Sections
Simply comment out or delete the `<section>` in the respective page file.

---

## 🧪 Testing Your Changes

1. **Start Dev Server**:
```bash
npm run dev
```

2. **Test on Different Devices**:
- Open browser dev tools (F12)
- Toggle device toolbar
- Test mobile, tablet, desktop views

3. **Check Console**:
- Look for any errors
- Verify form submissions

4. **Build Test**:
```bash
npm run build
npm run preview
```

---

## 📦 Before Going Live

- [ ] Update all company information
- [ ] Replace all placeholder images
- [ ] Test all links
- [ ] Test contact form
- [ ] Test on mobile devices
- [ ] Check for console errors
- [ ] Verify Google Maps works
- [ ] Test WhatsApp button
- [ ] Spell check all content
- [ ] Update meta tags for SEO
- [ ] Add Google Analytics (optional)
- [ ] Add favicon

---

## 💡 Pro Tips

1. **Use a CDN for Images**: Upload images to Cloudinary or Imgix
2. **Compress Images**: Use TinyPNG before uploading
3. **Test Performance**: Use Google Lighthouse
4. **Keep it Updated**: Regular content updates improve SEO
5. **Backup**: Keep a copy of `config.js` and `news.json`

---

## 🆘 Need Help?

If you get stuck:
1. Check the browser console for errors
2. Refer to component comments in code
3. Review React documentation
4. Check Tailwind CSS documentation

---

**Happy Customizing! 🎨**

