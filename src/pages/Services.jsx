import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import {
  FaPlane,
  FaUsers,
  FaCog,
  FaCalendarAlt,
  FaHeadset,
  FaHotel,
  FaBus,
  FaUmbrellaBeach,
  FaGlobe,
  FaHandshake,
  FaCheckCircle
} from 'react-icons/fa'
import Hero from '../components/Hero'
import Process from '../components/Process'

const Services = () => {
  const mainServices = [
    {
      icon: FaPlane,
      title: 'Corporate Travel Management',
      description: 'Comprehensive end-to-end corporate travel solutions including flight bookings, hotel accommodations, ground transportation, and expense management. We help businesses streamline their travel processes while reducing costs.',
      features: [
        'Flight and hotel booking',
        'Travel policy compliance',
        'Expense tracking and reporting',
        'Duty of care services',
        'Travel risk management',
      ],
      color: 'bg-blue-500',
    },
    {
      icon: FaUsers,
      title: 'Group Tours & Bookings',
      description: 'Specialized in organizing seamless group travel experiences for corporate teams, incentive trips, and large groups. We handle all logistics from start to finish, ensuring a smooth and memorable journey for all participants.',
      features: [
        'Customized itineraries',
        'Bulk booking discounts',
        'Dedicated tour managers',
        'Group coordination',
        'Special meal arrangements',
      ],
      color: 'bg-purple-500',
    },
    {
      icon: FaCog,
      title: 'Customized Travel Packages',
      description: 'Tailor-made travel packages designed specifically for your business needs. Whether it\'s a team-building retreat, client entertainment, or a special celebration, we create unique experiences that align with your objectives.',
      features: [
        'Personalized itineraries',
        'Flexible scheduling',
        'Budget optimization',
        'Theme-based packages',
        'Activity coordination',
      ],
      color: 'bg-green-500',
    },
    {
      icon: FaCalendarAlt,
      title: 'Event Management',
      description: 'Professional event planning and management services for conferences, seminars, corporate retreats, and special occasions. We take care of every detail so you can focus on your event\'s success.',
      features: [
        'Venue selection',
        'Logistics management',
        'Accommodation arrangements',
        'Audio-visual setup',
        'On-site coordination',
      ],
      color: 'bg-orange-500',
    },
    {
      icon: FaHeadset,
      title: 'Travel Consultation',
      description: 'Expert travel advice and consultation services to help you make informed decisions. Our experienced consultants provide insights on destinations, timing, budgets, and best practices for business travel.',
      features: [
        'Destination recommendations',
        'Budget planning',
        'Travel season advice',
        'Cultural insights',
        'Risk assessment',
      ],
      color: 'bg-indigo-500',
    },
  ]

  const additionalServices = [
    { icon: FaHotel, title: 'Hotel Bookings', description: 'Premium hotel reservations worldwide' },
    { icon: FaBus, title: 'Ground Transportation', description: 'Reliable transport arrangements' },
    { icon: FaUmbrellaBeach, title: 'Leisure Packages', description: 'Vacation and holiday packages' },
    { icon: FaGlobe, title: 'International Tours', description: 'Global destination expertise' },
    { icon: FaHandshake, title: 'Travel Insurance', description: 'Comprehensive coverage options' },
  ]

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="Our Services"
        subtitle="Comprehensive B2B travel solutions tailored to your business needs"
        backgroundImage="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&auto=format&fit=crop&q=80"
        showCTA={false}
        height="h-[400px]"
      />

      {/* Main Services */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Our Core Services
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Complete travel solutions designed for B2B excellence
            </p>
          </motion.div>

          <div className="space-y-12">
            {mainServices.map((service, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className={`bg-white rounded-2xl shadow-xl overflow-hidden ${index % 2 === 0 ? '' : ''
                  }`}
              >
                <div className={`grid grid-cols-1 ${index % 2 === 0 ? 'lg:grid-cols-2' : 'lg:grid-cols-2'} gap-0`}>
                  <div className={`p-8 md:p-12 ${index % 2 === 0 ? '' : 'lg:order-2'}`}>
                    <div className={`${service.color} w-16 h-16 rounded-xl flex items-center justify-center mb-6`}>
                      <service.icon className="text-white text-3xl" />
                    </div>
                    <h3 className="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                      {service.title}
                    </h3>
                    <p className="text-gray-600 mb-6">
                      {service.description}
                    </p>
                    <ul className="space-y-3">
                      {service.features.map((feature, idx) => (
                        <li key={idx} className="flex items-start space-x-3">
                          <FaCheckCircle className="text-green-500 mt-1 flex-shrink-0" />
                          <span className="text-gray-700">{feature}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                  <div className={`bg-gradient-to-br from-gray-100 to-gray-200 p-8 md:p-12 flex items-center justify-center ${index % 2 === 0 ? '' : 'lg:order-1'}`}>
                    <service.icon className={`text-gray-300 opacity-20`} style={{ fontSize: '15rem' }} />
                  </div>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Additional Services */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Additional Services
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              More ways we can support your travel needs
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {additionalServices.map((service, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, scale: 0.9 }}
                whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-shadow text-center"
              >
                <div className="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <service.icon className="text-primary-600 text-2xl" />
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-2">{service.title}</h3>
                <p className="text-gray-600">{service.description}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Process Section */}
      <Process />

      {/* CTA Section */}
      <section className="py-20 gradient-hero">
        <div className="container mx-auto px-4 text-center">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
              Ready to Get Started?
            </h2>
            <p className="text-white/90 text-lg mb-8 max-w-2xl mx-auto">
              Let's discuss how we can create the perfect travel solution for your business
            </p>
            <Link
              to="/contact"
              className="inline-block px-8 py-4 bg-white text-primary-600 rounded-lg font-semibold hover:bg-gray-100 transform hover:-translate-y-1 transition-all shadow-lg"
            >
              Contact Us Today
            </Link>
          </motion.div>
        </div>
      </section>
    </div>
  )
}

export default Services

