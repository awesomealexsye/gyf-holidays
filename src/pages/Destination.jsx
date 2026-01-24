import { useState } from 'react'
import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { FaMapMarkerAlt, FaStar, FaChevronRight } from 'react-icons/fa'
import Hero from '../components/Hero'
import packages from '../data/packages.json'
import categories from '../data/categories.json'

const Destination = () => {
  const [activeCategory, setActiveCategory] = useState('all')

  const filterButtons = [
    { id: 'all', label: 'All Destinations' },
    ...categories.map(cat => ({ id: cat.id, label: cat.name }))
  ]

  const filteredPackages = packages.filter((pkg) => {
    if (activeCategory === 'all') return true
    return pkg.categoryId === activeCategory
  })

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="Explore Destinations"
        subtitle="Discover amazing places around the world for your next corporate trip or group booking"
        backgroundImage="/pictures/swiss-package/swiss-package-1.jpeg"
        showCTA={false}
        height="h-[400px]"
      />

      {/* Category Filter */}
      <section className="py-8 bg-white sticky top-20 z-30 shadow-sm">
        <div className="container mx-auto px-4">
          <div className="flex flex-wrap justify-center gap-4">
            {filterButtons.map((btn) => (
              <button
                key={btn.id}
                onClick={() => setActiveCategory(btn.id)}
                className={`px-6 py-3 rounded-lg font-semibold transition-all ${activeCategory === btn.id
                    ? 'gradient-primary text-white shadow-lg'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                  }`}
              >
                {btn.label}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Destinations Grid */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              {filterButtons.find((b) => b.id === activeCategory)?.label}
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Carefully curated destinations perfect for B2B travel and group bookings
            </p>
          </motion.div>

          {filteredPackages.length > 0 ? (
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {filteredPackages.map((pkg, index) => (
                <motion.div
                  key={pkg.id}
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: index * 0.05 }}
                  className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow group"
                >
                  <div className="relative h-64 overflow-hidden">
                    <img
                      src={pkg.image}
                      alt={pkg.name}
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    />
                    <div className="absolute top-4 right-4 bg-primary-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                      {pkg.duration}
                    </div>
                    <div className="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold text-gray-900 flex items-center space-x-1">
                      <FaStar className="text-yellow-400" />
                      <span>4.9</span>
                    </div>
                  </div>

                  <div className="p-6">
                    <div className="flex items-center justify-between mb-3">
                      <h3 className="text-xl font-bold text-gray-900 flex items-center space-x-2 truncate">
                        <FaMapMarkerAlt className="text-primary-600" />
                        <span>{pkg.name}</span>
                      </h3>
                    </div>

                    <p className="text-gray-600 mb-4 line-clamp-2">{pkg.description}</p>

                    <div className="flex flex-wrap gap-2 mb-4">
                      {pkg.highlights.slice(0, 3).map((highlight, idx) => (
                        <span
                          key={idx}
                          className="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-sm"
                        >
                          {highlight}
                        </span>
                      ))}
                    </div>

                    <div className="flex items-center justify-between pt-4 border-t border-gray-200">
                      <span className="text-gray-500 text-sm">{pkg.destination}</span>
                      <Link
                        to={`/package/${pkg.id}`}
                        className="text-primary-600 font-semibold hover:text-primary-700 transition-colors flex items-center"
                      >
                        View Details <FaChevronRight className="ml-1 text-xs" />
                      </Link>
                    </div>
                  </div>
                </motion.div>
              ))}
            </div>
          ) : (
            <div className="text-center py-20 bg-white rounded-2xl shadow-inner border-2 border-dashed border-gray-200">
              <h3 className="text-2xl font-bold text-gray-900 mb-4">Tour Packages Arriving Soon!</h3>
              <p className="text-gray-600 max-w-md mx-auto">
                We are currently curating the best experiences for this category. Please wait till then, we will add amazing tour and trip packages here soon.
              </p>
            </div>
          )}
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 gradient-hero">
        <div className="container mx-auto px-4 text-center">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
              Can't Find Your Dream Destination?
            </h2>
            <p className="text-white/90 text-lg mb-8 max-w-2xl mx-auto">
              We can create custom packages for any destination worldwide. Tell us where you want to go!
            </p>
            <Link
              to="/contact"
              className="inline-block px-8 py-4 bg-white text-primary-600 rounded-lg font-semibold hover:bg-gray-100 transform hover:-translate-y-1 transition-all shadow-lg"
            >
              Request Custom Package
            </Link>
          </motion.div>
        </div>
      </section>
    </div>
  )
}

export default Destination
