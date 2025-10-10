# GYF Holidays - B2B Travel Solutions Website

A beautiful, professional, and responsive B2B travel and tours website built with React, Vite, and Tailwind CSS.

## 🌟 Features

- **Beautiful Modern UI**: Stunning gradient backgrounds, smooth animations, and professional design
- **Fully Responsive**: Optimized for mobile, tablet, and desktop devices
- **6 Main Pages**: Home, About Us, Services, Destinations, News, Contact Us
- **B2B Focused**: Designed specifically for business-to-business travel solutions
- **Contact Forms**: Comprehensive inquiry forms with validation
- **News Management**: JSON-based news articles system for easy updates
- **Smooth Animations**: Framer Motion powered transitions and effects
- **Configuration File**: Centralized config.js for easy information updates
- **Interactive Elements**: 
  - Floating WhatsApp button
  - Scroll-to-top button
  - Responsive navigation
  - Category filters
  - Modal popups

## 🚀 Tech Stack

- **React 18** - Modern UI library
- **Vite** - Lightning-fast build tool
- **Tailwind CSS** - Utility-first CSS framework
- **React Router DOM** - Client-side routing
- **Framer Motion** - Animation library
- **React Icons** - Icon library

## 📦 Installation

1. Install dependencies:
```bash
npm install
```

2. Start development server:
```bash
npm run dev
```

3. Build for production:
```bash
npm run build
```

4. Preview production build:
```bash
npm run preview
```

## 📁 Project Structure

```
gyfholidays/
├── src/
│   ├── components/          # Reusable components
│   │   ├── Navbar.jsx
│   │   ├── Footer.jsx
│   │   ├── Hero.jsx
│   │   ├── ContactForm.jsx
│   │   ├── NewsCard.jsx
│   │   ├── WhatsAppButton.jsx
│   │   └── ScrollToTop.jsx
│   ├── pages/              # Page components
│   │   ├── Home.jsx
│   │   ├── AboutUs.jsx
│   │   ├── Services.jsx
│   │   ├── Destination.jsx
│   │   ├── ContactUs.jsx
│   │   └── News.jsx
│   ├── data/
│   │   └── news.json       # News articles data
│   ├── config.js           # Site configuration
│   ├── App.jsx
│   ├── main.jsx
│   └── index.css
├── public/
├── index.html
├── package.json
├── vite.config.js
├── tailwind.config.js
└── postcss.config.js
```

## ⚙️ Configuration

Update company information in `src/config.js`:

- Company name and tagline
- Contact details (phone, email, address)
- Social media links
- Business hours
- WhatsApp number
- Statistics (destinations, clients, etc.)

## 📰 Managing News Articles

Add or edit news articles in `src/data/news.json`:

```json
{
  "id": 1,
  "title": "Article Title",
  "excerpt": "Brief description",
  "content": "Full article content",
  "image": "image-url",
  "date": "2025-10-10",
  "category": "Travel Tips"
}
```

## 🎨 Customization

### Colors
Customize theme colors in `tailwind.config.js`:
- Primary colors (blue shades)
- Secondary colors (orange shades)

### Images
Replace placeholder images with your own:
- Update image URLs in component files
- Use high-quality images (1920px width for hero sections)

### Content
- Update page content directly in component files
- Modify services, destinations, and testimonials
- Adjust contact form fields as needed

## 🚢 Deployment

After building with `npm run build`, deploy the `dist/` folder to:
- Netlify
- Vercel
- GitHub Pages
- Any static hosting service

### Build Output
The build command creates optimized static files in the `dist/` directory:
```bash
npm run build
```

## 📱 Features Breakdown

### Home Page
- Hero section with CTA
- Statistics counter
- Services overview
- Featured destinations
- Why choose us section
- Client testimonials
- Latest news preview
- Quick inquiry form

### About Us Page
- Company story
- Mission and vision
- Core values
- Timeline/milestones
- Team members
- B2B partnership benefits

### Services Page
- Detailed service descriptions
- Core services with features
- Additional services
- Process workflow
- CTA sections

### Destinations Page
- Category filters (All, International, Domestic, Popular)
- Beautiful destination cards
- Ratings and highlights
- Tour package counts
- Interactive hover effects

### Contact Us Page
- Comprehensive contact form
- Contact information cards
- Google Maps integration
- Office locations
- FAQ section
- Social media links

### News Page
- Category filtering
- Article grid layout
- Modal article reader
- Newsletter subscription
- Date and category display

## 🔧 Support

For support, email info@gyfholidays.com or contact us through the website.

## 📄 License

Copyright © 2025 GYF Holidays Pvt. Ltd. All rights reserved.

---

**Built with ❤️ for B2B Travel Excellence**
