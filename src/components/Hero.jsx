import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'

const Hero = ({ 
  title, 
  subtitle, 
  backgroundImage = "https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1920&auto=format&fit=crop&q=80",
  showCTA = true,
  height = "h-[600px]"
}) => {
  return (
    <div className={`relative ${height} flex items-center justify-center overflow-hidden`}>
      {/* Background Image with Overlay */}
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{ backgroundImage: `url(${backgroundImage})` }}
      >
        <div className="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-secondary-900/80"></div>
      </div>

      {/* Content */}
      <div className="relative z-10 container mx-auto px-4 text-center">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
        >
          <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
            {title}
          </h1>
          {subtitle && (
            <p className="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
              {subtitle}
            </p>
          )}
          {showCTA && (
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                to="/contact"
                className="px-8 py-4 bg-secondary-500 text-white rounded-lg font-semibold hover:bg-secondary-600 transform hover:-translate-y-1 transition-all shadow-lg"
              >
                Get Started
              </Link>
              <Link
                to="/destinations"
                className="px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-lg font-semibold hover:bg-white/20 border-2 border-white transition-all"
              >
                Explore Destinations
              </Link>
            </div>
          )}
        </motion.div>
      </div>

      {/* Decorative Elements */}
      <div className="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
            fill="white"
          />
        </svg>
      </div>
    </div>
  )
}

export default Hero

