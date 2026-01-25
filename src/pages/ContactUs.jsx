import { motion } from 'framer-motion'
import { FaPhone, FaEnvelope, FaMapMarkerAlt, FaClock, FaFacebookF, FaInstagram, FaYoutube } from 'react-icons/fa'
import Hero from '../components/Hero'
import ContactForm from '../components/ContactForm'
import config from '../config'

const ContactUs = () => {
  const contactCards = [
    {
      icon: FaPhone,
      title: 'Phone',
      details: [config.contact.phone, config.contact.alternatePhone],
      color: 'bg-blue-500',
    },
    {
      icon: FaEnvelope,
      title: 'Email',
      details: [config.contact.email, config.contact.salesEmail, config.contact.supportEmail],
      color: 'bg-green-500',
    },
    {
      icon: FaMapMarkerAlt,
      title: 'Address',
      details: [
        `${config.contact.address.street}`,
        `${config.contact.address.city}, ${config.contact.address.state} ${config.contact.address.zip}`,
      ],
      color: 'bg-purple-500',
    },
    {
      icon: FaClock,
      title: 'Business Hours',
      details: [config.businessHours.weekdays, config.businessHours.sunday],
      color: 'bg-orange-500',
    },
  ]

  const offices = [
    {
      city: 'New Delhi (Head Office)',
      address: 'Unit No 590, 5th Floor, Vegas Commercial Building, Plot No 6, Block - B, Sector 14, Dwarka',
      phone: '+91 97113 33620',
      emails: ['info@gyfholidays.com', 'sales@gyfholidays.com', 'support@gyfholidays.com'],
    },
    {
      city: 'London - Mayfair',
      address: 'Albemarle Street, Mayfair, London, W1S',
      emails: ['info@gyfholidays.com', 'sales@gyfholidays.com', 'support@gyfholidays.com'],
    },
  ]

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="Get In Touch"
        subtitle="GYF PLANNERS PVT LTD - We're here to help you create unforgettable travel experiences"
        backgroundImage="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1920&auto=format&fit=crop&q=80"
        showCTA={false}
        height="h-[400px]"
      />

      {/* Contact Cards */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 -mt-32 relative z-20">
            {contactCards.map((card, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-6 shadow-xl text-center hover:shadow-2xl transition-shadow"
              >
                <div className={`${card.color} w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4`}>
                  <card.icon className="text-white text-2xl" />
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-3">{card.title}</h3>
                {card.details.map((detail, idx) => (
                  <p key={idx} className="text-gray-600 text-sm mb-1">
                    {detail}
                  </p>
                ))}
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Contact Form and Map */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {/* Contact Form */}
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
            >
              <ContactForm />
            </motion.div>

            {/* Map and Info */}
            <motion.div
              initial={{ opacity: 0, x: 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
              className="space-y-6"
            >
              {/* Google Map */}
              <div className="bg-white rounded-xl shadow-xl overflow-hidden h-96">
                <iframe
                  src={config.mapEmbedUrl}
                  width="100%"
                  height="100%"
                  style={{ border: 0 }}
                  allowFullScreen=""
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                  title="Office Location"
                ></iframe>
              </div>

              {/* Additional Info */}
              <div className="bg-white rounded-xl shadow-xl p-6">
                <h3 className="text-2xl font-bold text-gray-900 mb-4">Why Choose Us?</h3>
                <ul className="space-y-3">
                  <li className="flex items-start space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full mt-2"></div>
                    <span className="text-gray-600">24/7 customer support for all your travel needs</span>
                  </li>
                  <li className="flex items-start space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full mt-2"></div>
                    <span className="text-gray-600">Competitive B2B pricing with transparent quotes</span>
                  </li>
                  <li className="flex items-start space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full mt-2"></div>
                    <span className="text-gray-600">Dedicated account managers for personalized service</span>
                  </li>
                  <li className="flex items-start space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full mt-2"></div>
                    <span className="text-gray-600">Quick response time - we reply within 2 hours</span>
                  </li>
                  <li className="flex items-start space-x-3">
                    <div className="w-2 h-2 bg-primary-600 rounded-full mt-2"></div>
                    <span className="text-gray-600">Flexible payment options and credit facilities</span>
                  </li>
                </ul>

                <div className="mt-6 pt-6 border-t border-gray-200">
                  <h4 className="text-lg font-semibold text-gray-900 mb-3">Follow Us</h4>
                  <div className="flex space-x-3">
                    <a
                      href={config.social.facebook}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary-600 hover:text-white transition"
                    >
                      <FaFacebookF />
                    </a>
                    <a
                      href={config.social.instagram}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary-600 hover:text-white transition"
                    >
                      <FaInstagram />
                    </a>
                    <a
                      href={config.social.youtube}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary-600 hover:text-white transition"
                    >
                      <FaYoutube />
                    </a>
                  </div>
                </div>
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Office Locations */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Our Office Locations
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Visit us at any of our offices across the globe
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {offices.map((office, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-8 shadow-lg hover:shadow-2xl transition-shadow"
              >
                <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                  <FaMapMarkerAlt className="text-primary-600 text-xl" />
                </div>
                <h3 className="text-2xl font-bold text-gray-900 mb-4">{office.city}</h3>
                <div className="space-y-3 text-gray-600">
                  <p className="flex items-start space-x-2">
                    <FaMapMarkerAlt className="mt-1 flex-shrink-0 text-gray-400" />
                    <span>{office.address}</span>
                  </p>
                  {office.phone && (
                    <p className="flex items-center space-x-2">
                      <FaPhone className="flex-shrink-0 text-gray-400" />
                      <a href={`tel:${office.phone}`} className="hover:text-primary-600 transition">
                        {office.phone}
                      </a>
                    </p>
                  )}
                  <div className="space-y-1">
                    {office.emails.map((email, emailIndex) => (
                      <p key={emailIndex} className="flex items-center space-x-2">
                        <FaEnvelope className="flex-shrink-0 text-gray-400" />
                        <a href={`mailto:${email}`} className="hover:text-primary-600 transition">
                          {email}
                        </a>
                      </p>
                    ))}
                  </div>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* FAQ Section */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Frequently Asked Questions
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              Quick answers to common questions
            </p>
          </motion.div>

          <div className="max-w-3xl mx-auto space-y-4">
            {[
              {
                question: 'What is your response time for inquiries?',
                answer: 'We typically respond to all inquiries within 2 hours during business hours and within 24 hours outside business hours.',
              },
              {
                question: 'Do you offer credit facilities for B2B partners?',
                answer: 'Yes, we offer flexible credit terms for verified business partners. Please contact our sales team for more details.',
              },
              {
                question: 'What destinations do you cover?',
                answer: 'We cover 150+ destinations worldwide, including popular domestic and international locations. If you need a specific destination, just ask!',
              },
              {
                question: 'Can you customize packages according to our requirements?',
                answer: 'Absolutely! All our packages are fully customizable to match your specific needs, budget, and preferences.',
              },
              {
                question: 'Do you provide 24/7 support during trips?',
                answer: 'Yes, we provide round-the-clock support throughout your journey to ensure a seamless travel experience.',
              },
            ].map((faq, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-6 shadow-lg"
              >
                <h3 className="text-lg font-bold text-gray-900 mb-2">{faq.question}</h3>
                <p className="text-gray-600">{faq.answer}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>
    </div>
  )
}

export default ContactUs

