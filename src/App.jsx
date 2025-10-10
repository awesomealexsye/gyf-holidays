import { Routes, Route } from 'react-router-dom'
import Navbar from './components/Navbar'
import Footer from './components/Footer'
import ScrollToTop from './components/ScrollToTop'
import WhatsAppButton from './components/WhatsAppButton'
import Home from './pages/Home'
import AboutUs from './pages/AboutUs'
import Services from './pages/Services'
import Destination from './pages/Destination'
import ContactUs from './pages/ContactUs'
import News from './pages/News'

function App() {
  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      <main className="flex-grow">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/about" element={<AboutUs />} />
          <Route path="/services" element={<Services />} />
          <Route path="/destinations" element={<Destination />} />
          <Route path="/contact" element={<ContactUs />} />
          <Route path="/news" element={<News />} />
        </Routes>
      </main>
      <Footer />
      <WhatsAppButton />
      <ScrollToTop />
    </div>
  )
}

export default App
