import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import { FaPlane, FaUsers, FaGlobe, FaHandshake, FaAward, FaClock, FaStar, FaQuoteLeft } from 'react-icons/fa'
import Hero from '../components/Hero'
import ContactForm from '../components/ContactForm'
import config from '../config'
import categories from '../data/categories.json'
import Process from '../components/Process'
import JourneyStepper from '../components/JourneyStepper'

const Home = () => {
  const services = [
    {
      icon: FaPlane,
      title: 'Corporate Travel',
      description: 'Comprehensive corporate travel solutions tailored to your business needs.',
      color: 'bg-blue-500',
    },
    {
      icon: FaUsers,
      title: 'Group Bookings',
      description: 'Specialized group travel packages with exclusive rates and benefits.',
      color: 'bg-purple-500',
    },
    {
      icon: FaGlobe,
      title: 'Customized Packages',
      description: 'Personalized travel experiences designed around your preferences.',
      color: 'bg-green-500',
    },
    {
      icon: FaHandshake,
      title: 'B2B Solutions',
      description: 'Complete B2B travel services with dedicated account management.',
      color: 'bg-orange-500',
    },
  ]

  const featuredCategories = categories

  const testimonials = [
    {
      name: 'Rajesh Kumar',
      company: 'Tech Solutions Pvt. Ltd.',
      text: 'GYF Holidays made our corporate retreat absolutely seamless. Their attention to detail and professionalism is unmatched.',
      rating: 5,
    },
    {
      name: 'Priya Sharma',
      company: 'Global Travel Agency',
      text: 'As a B2B partner, GYF has consistently delivered exceptional service. Their packages are competitive and quality is outstanding.',
      rating: 5,
    },
    {
      name: 'Amit Patel',
      company: 'Event Masters India',
      text: 'We have been working with GYF for 3 years. They understand our needs and always go the extra mile.',
      rating: 5,
    },
  ]

  const whyChooseUs = [
    {
      icon: FaAward,
      title: 'Best Prices',
      description: 'Competitive B2B rates with maximum value',
    },
    {
      icon: FaClock,
      title: '24/7 Support',
      description: 'Round-the-clock assistance for all your needs',
    },
    {
      icon: FaHandshake,
      title: 'Trusted Partner',
      description: '10+ years of excellence in travel industry',
    },
    {
      icon: FaStar,
      title: 'Quality Service',
      description: 'Premium experiences with every booking',
    },
  ]

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="Your Trusted B2B Travel Partner"
        subtitle="Discover exceptional corporate travel solutions, customized packages, and unforgettable experiences for your business clients."
      />

      {/* Stats Section */}
      <section className="py-16 gradient-hero">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
            {[
              { number: config.stats.destinations, label: 'Destinations', suffix: '+' },
              { number: config.stats.happyClients, label: 'Happy Clients', suffix: '+' },
              { number: config.stats.yearsExperience, label: 'Years Experience', suffix: '+' },
              { number: config.stats.teamMembers, label: 'Team Members', suffix: '+' },
            ].map((stat, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, scale: 0.5 }}
                whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="text-center text-white"
              >
                <div className="text-4xl md:text-5xl font-bold mb-2">
                  {stat.number}{stat.suffix}
                </div>
                <div className="text-lg opacity-90">{stat.label}</div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Our Services
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Comprehensive B2B travel solutions designed to meet your business needs
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {services.map((service, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-shadow group"
              >
                <div className={`${service.color} w-16 h-16 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform`}>
                  <service.icon className="text-white text-2xl" />
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-3">{service.title}</h3>
                <p className="text-gray-600">{service.description}</p>
              </motion.div>
            ))}
          </div>

          <div className="text-center mt-12">
            <Link
              to="/services"
              className="inline-block px-8 py-4 gradient-primary text-white rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-1 transition-all"
            >
              View All Services
            </Link>
          </div>
        </div>
      </section>

      {/* Featured Destinations */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Tour Packages
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Choose from our most popular tour categories and discover amazing travel experiences
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {featuredCategories.map((category, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500"
              >
                <Link to={`/packages/${category.id}`} className="flex flex-col h-full">
                  <div className="relative aspect-[4/3] overflow-hidden">
                    <img
                      src={category.image}
                      alt={category.name}
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div className="absolute inset-0 bg-black/5 group-hover:bg-black/0 transition-colors duration-500"></div>
                  </div>
                  <div className="p-8 flex-grow flex flex-col items-center text-center">
                    <h3 className="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">
                      {category.name}
                    </h3>
                    <p className="text-gray-600 mb-6 line-clamp-2">
                      {category.description}
                    </p>
                    <div className="mt-auto inline-flex items-center text-primary-600 font-bold group-hover:translate-x-2 transition-transform duration-300">
                      View Packages <FaGlobe className="ml-2 text-sm" />
                    </div>
                  </div>
                </Link>
              </motion.div>
            ))}
          </div>

          <div className="text-center mt-12">
            <Link
              to="/destinations"
              className="inline-block px-8 py-4 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transform hover:-translate-y-1 transition-all shadow-lg"
            >
              Explore All Regions
            </Link>
          </div>
        </div>
      </section>

      {/* Why Choose Us */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Why Choose GYF Holidays
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Your success is our priority. Here's why businesses trust us
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {whyChooseUs.map((item, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="text-center"
              >
                <div className="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <item.icon className="text-primary-600 text-3xl" />
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-2">{item.title}</h3>
                <p className="text-gray-600">{item.description}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              What Our Clients Say
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Don't just take our word for it - hear from our satisfied B2B partners
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {testimonials.map((testimonial, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-8 shadow-lg"
              >
                <FaQuoteLeft className="text-primary-200 text-4xl mb-4" />
                <div className="flex mb-4">
                  {[...Array(testimonial.rating)].map((_, i) => (
                    <FaStar key={i} className="text-yellow-400" />
                  ))}
                </div>
                <p className="text-gray-600 mb-6 italic">{testimonial.text}</p>
                <div>
                  <h4 className="font-bold text-gray-900">{testimonial.name}</h4>
                  <p className="text-sm text-gray-500">{testimonial.company}</p>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>



      {/* Process Section */}
      <Process />

      {/* Journey Stepper Section */}
      <JourneyStepper />

      {/* Contact Form Section */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Ready to Start Your Journey?
              </h2>
              <p className="text-gray-600 text-lg mb-6">
                Get in touch with us today and let's create unforgettable travel experiences for your business clients.
              </p>
              <div className="space-y-4">
                <div className="flex items-center space-x-4">
                  <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <FaPlane className="text-primary-600 text-xl" />
                  </div>
                  <div>
                    <h4 className="font-semibold text-gray-900">Customized Solutions</h4>
                    <p className="text-gray-600">Tailored to your business needs</p>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <FaAward className="text-primary-600 text-xl" />
                  </div>
                  <div>
                    <h4 className="font-semibold text-gray-900">Best Rates</h4>
                    <p className="text-gray-600">Competitive B2B pricing</p>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <FaClock className="text-primary-600 text-xl" />
                  </div>
                  <div>
                    <h4 className="font-semibold text-gray-900">24/7 Support</h4>
                    <p className="text-gray-600">Always here when you need us</p>
                  </div>
                </div>
              </div>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, x: 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
            >
              <ContactForm title="Get a Quick Quote" compact={true} />
            </motion.div>
          </div>
        </div>
      </section>
    </div>
  )
}

export default Home

