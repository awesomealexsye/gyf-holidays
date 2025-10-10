import { useState } from 'react'
import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { FaMapMarkerAlt, FaStar } from 'react-icons/fa'
import Hero from '../components/Hero'

const Destination = () => {
  const [activeCategory, setActiveCategory] = useState('all')

  const categories = [
    { id: 'all', label: 'All Destinations' },
    { id: 'international', label: 'International' },
    { id: 'domestic', label: 'Domestic' },
    { id: 'popular', label: 'Most Popular' },
  ]

  const destinations = [
    {
      id: 1,
      name: 'Bali, Indonesia',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&auto=format&fit=crop&q=80',
      tours: '25+',
      rating: 4.9,
      description: 'Tropical paradise with stunning beaches, temples, and vibrant culture',
      highlights: ['Beach Resorts', 'Cultural Tours', 'Adventure Activities'],
    },
    {
      id: 2,
      name: 'Dubai, UAE',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&auto=format&fit=crop&q=80',
      tours: '30+',
      rating: 4.8,
      description: 'Modern luxury destination with world-class attractions and shopping',
      highlights: ['Luxury Shopping', 'Desert Safari', 'Skyscrapers'],
    },
    {
      id: 3,
      name: 'Paris, France',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800&auto=format&fit=crop&q=80',
      tours: '20+',
      rating: 4.9,
      description: 'City of lights, romance, and world-renowned art and architecture',
      highlights: ['Eiffel Tower', 'Art Museums', 'French Cuisine'],
    },
    {
      id: 4,
      name: 'Maldives',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=800&auto=format&fit=crop&q=80',
      tours: '15+',
      rating: 5.0,
      description: 'Ultimate luxury island escape with crystal-clear waters and overwater villas',
      highlights: ['Water Villas', 'Diving', 'Spa Resorts'],
    },
    {
      id: 5,
      name: 'Switzerland',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?w=800&auto=format&fit=crop&q=80',
      tours: '18+',
      rating: 4.8,
      description: 'Alpine wonderland with breathtaking mountains and pristine lakes',
      highlights: ['Alps', 'Skiing', 'Scenic Railways'],
    },
    {
      id: 6,
      name: 'Thailand',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800&auto=format&fit=crop&q=80',
      tours: '35+',
      rating: 4.7,
      description: 'Exotic blend of beaches, temples, and vibrant street life',
      highlights: ['Bangkok', 'Phuket', 'Thai Cuisine'],
    },
    {
      id: 7,
      name: 'Singapore',
      category: 'international',
      popular: true,
      image: 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?w=800&auto=format&fit=crop&q=80',
      tours: '22+',
      rating: 4.8,
      description: 'Modern city-state with stunning architecture and diverse culture',
      highlights: ['Marina Bay', 'Gardens', 'Universal Studios'],
    },
    {
      id: 8,
      name: 'London, UK',
      category: 'international',
      popular: false,
      image: 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=800&auto=format&fit=crop&q=80',
      tours: '28+',
      rating: 4.7,
      description: 'Historic capital with royal heritage and modern attractions',
      highlights: ['Big Ben', 'Museums', 'Royal Palaces'],
    },
    {
      id: 9,
      name: 'Goa, India',
      category: 'domestic',
      popular: true,
      image: 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=800&auto=format&fit=crop&q=80',
      tours: '40+',
      rating: 4.6,
      description: 'Beach paradise with Portuguese heritage and vibrant nightlife',
      highlights: ['Beaches', 'Water Sports', 'Nightlife'],
    },
    {
      id: 10,
      name: 'Kerala, India',
      category: 'domestic',
      popular: true,
      image: 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?w=800&auto=format&fit=crop&q=80',
      tours: '32+',
      rating: 4.8,
      description: 'God\'s own country with serene backwaters and lush landscapes',
      highlights: ['Houseboats', 'Tea Plantations', 'Ayurveda'],
    },
    {
      id: 11,
      name: 'Rajasthan, India',
      category: 'domestic',
      popular: true,
      image: 'https://images.unsplash.com/photo-1477587458883-47145ed94245?w=800&auto=format&fit=crop&q=80',
      tours: '38+',
      rating: 4.7,
      description: 'Land of royals with magnificent forts and desert adventures',
      highlights: ['Palaces', 'Desert Safari', 'Culture'],
    },
    {
      id: 12,
      name: 'Himachal Pradesh, India',
      category: 'domestic',
      popular: true,
      image: 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=800&auto=format&fit=crop&q=80',
      tours: '35+',
      rating: 4.9,
      description: 'Mountain retreat with snow-capped peaks and adventure activities',
      highlights: ['Shimla', 'Manali', 'Trekking'],
    },
    {
      id: 13,
      name: 'Uttarakhand, India',
      category: 'domestic',
      popular: false,
      image: 'https://images.unsplash.com/photo-1562979314-bee7453e911c?w=800&auto=format&fit=crop&q=80',
      tours: '30+',
      rating: 4.7,
      description: 'Spiritual destination with Himalayan beauty and yoga retreats',
      highlights: ['Rishikesh', 'Haridwar', 'Yoga'],
    },
    {
      id: 14,
      name: 'Andaman Islands, India',
      category: 'domestic',
      popular: false,
      image: 'https://images.unsplash.com/photo-1589197331516-7e2be2019d82?w=800&auto=format&fit=crop&q=80',
      tours: '20+',
      rating: 4.8,
      description: 'Tropical islands with pristine beaches and marine life',
      highlights: ['Scuba Diving', 'Beaches', 'Island Hopping'],
    },
    {
      id: 15,
      name: 'New York, USA',
      category: 'international',
      popular: false,
      image: 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=800&auto=format&fit=crop&q=80',
      tours: '25+',
      rating: 4.7,
      description: 'The city that never sleeps with iconic landmarks and culture',
      highlights: ['Statue of Liberty', 'Times Square', 'Broadway'],
    },
  ]

  const filteredDestinations = destinations.filter((dest) => {
    if (activeCategory === 'all') return true
    if (activeCategory === 'popular') return dest.popular
    return dest.category === activeCategory
  })

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="Explore Destinations"
        subtitle="Discover amazing places around the world for your next corporate trip or group booking"
        backgroundImage="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1920&auto=format&fit=crop&q=80"
        showCTA={false}
        height="h-[400px]"
      />

      {/* Category Filter */}
      <section className="py-8 bg-white sticky top-20 z-30 shadow-sm">
        <div className="container mx-auto px-4">
          <div className="flex flex-wrap justify-center gap-4">
            {categories.map((category) => (
              <button
                key={category.id}
                onClick={() => setActiveCategory(category.id)}
                className={`px-6 py-3 rounded-lg font-semibold transition-all ${
                  activeCategory === category.id
                    ? 'gradient-primary text-white shadow-lg'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                }`}
              >
                {category.label}
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
              {categories.find((c) => c.id === activeCategory)?.label}
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Carefully curated destinations perfect for B2B travel and group bookings
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {filteredDestinations.map((destination, index) => (
              <motion.div
                key={destination.id}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: index * 0.05 }}
                className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow group"
              >
                <div className="relative h-64 overflow-hidden">
                  <img
                    src={destination.image}
                    alt={destination.name}
                    className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                  />
                  {destination.popular && (
                    <div className="absolute top-4 right-4 bg-secondary-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                      Popular
                    </div>
                  )}
                  <div className="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold text-gray-900 flex items-center space-x-1">
                    <FaStar className="text-yellow-400" />
                    <span>{destination.rating}</span>
                  </div>
                </div>

                <div className="p-6">
                  <div className="flex items-center justify-between mb-3">
                    <h3 className="text-xl font-bold text-gray-900 flex items-center space-x-2">
                      <FaMapMarkerAlt className="text-primary-600" />
                      <span>{destination.name}</span>
                    </h3>
                  </div>

                  <p className="text-gray-600 mb-4">{destination.description}</p>

                  <div className="flex flex-wrap gap-2 mb-4">
                    {destination.highlights.map((highlight, idx) => (
                      <span
                        key={idx}
                        className="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-sm"
                      >
                        {highlight}
                      </span>
                    ))}
                  </div>

                  <div className="flex items-center justify-between pt-4 border-t border-gray-200">
                    <span className="text-gray-500 text-sm">{destination.tours} Tour Packages</span>
                    <Link
                      to="/contact"
                      className="text-primary-600 font-semibold hover:text-primary-700 transition-colors"
                    >
                      View Packages →
                    </Link>
                  </div>
                </div>
              </motion.div>
            ))}
          </div>

          {filteredDestinations.length === 0 && (
            <div className="text-center py-12">
              <p className="text-gray-500 text-lg">No destinations found in this category.</p>
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

