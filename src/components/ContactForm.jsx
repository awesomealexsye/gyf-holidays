import { useState } from 'react'
import { motion } from 'framer-motion'
import { FaUser, FaEnvelope, FaPhone, FaBuilding, FaBriefcase, FaUsers, FaCalendar, FaMapMarkerAlt, FaComment, FaWhatsapp } from 'react-icons/fa'
import config from '../config'

const ContactForm = ({ title = "Send Us an Inquiry", compact = false }) => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    businessName: '',
    companyType: '',
    numberOfTravelers: '',
    travelDate: '',
    destination: '',
    message: '',
  })

  const [isSubmitting, setIsSubmitting] = useState(false)
  const [showSuccess, setShowSuccess] = useState(false)

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    })
  }

  const handleSubmit = (e) => {
    e.preventDefault()
    setIsSubmitting(true)

    // Simulate form submission (since no backend)
    console.log('Form Data Submitted:', formData)

    setTimeout(() => {
      setIsSubmitting(false)
      setShowSuccess(true)
      setFormData({
        name: '',
        email: '',
        phone: '',
        businessName: '',
        companyType: '',
        numberOfTravelers: '',
        travelDate: '',
        destination: '',
        message: '',
      })

      setTimeout(() => {
        setShowSuccess(false)
      }, 5000)
    }, 1500)
  }

  const handleWhatsAppSubmit = () => {
    const message = `Hello! I'm interested in your travel packages.

Name: ${formData.name}
Email: ${formData.email}
Phone: ${formData.phone}
Business: ${formData.businessName}
Company Type: ${formData.companyType}
Travelers: ${formData.numberOfTravelers}
Travel Date: ${formData.travelDate}
Destination: ${formData.destination}
Message: ${formData.message}`

    const whatsappUrl = `https://wa.me/${config.contact.whatsapp}?text=${encodeURIComponent(message)}`
    window.open(whatsappUrl, '_blank')
  }

  const companyTypes = [
    'Travel Agency',
    'Corporate',
    'Event Management',
    'Tour Operator',
    'Other',
  ]

  return (
    <div className={`bg-white rounded-xl shadow-xl p-6 ${compact ? 'md:p-6' : 'md:p-8'}`}>
      <h3 className="text-2xl md:text-3xl font-bold text-gray-900 mb-6">{title}</h3>

      {showSuccess && (
        <motion.div
          initial={{ opacity: 0, y: -10 }}
          animate={{ opacity: 1, y: 0 }}
          className="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800"
        >
          Thank you for your inquiry! We'll get back to you within 24 hours.
        </motion.div>
      )}

      <form onSubmit={handleSubmit} className="space-y-4">
        <div className={`grid ${compact ? 'grid-cols-1' : 'grid-cols-1 md:grid-cols-2'} gap-4`}>
          {/* Name */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Full Name *
            </label>
            <div className="relative">
              <FaUser className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="text"
                name="name"
                value={formData.name}
                onChange={handleChange}
                required
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                placeholder="John Doe"
              />
            </div>
          </div>

          {/* Email */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Email Address *
            </label>
            <div className="relative">
              <FaEnvelope className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                required
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                placeholder="john@example.com"
              />
            </div>
          </div>

          {/* Phone */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Phone Number *
            </label>
            <div className="relative">
              <FaPhone className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="tel"
                name="phone"
                value={formData.phone}
                onChange={handleChange}
                required
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                placeholder="+91 98765 43210"
              />
            </div>
          </div>

          {/* Business Name */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Business Name *
            </label>
            <div className="relative">
              <FaBuilding className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="text"
                name="businessName"
                value={formData.businessName}
                onChange={handleChange}
                required
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                placeholder="Your Company Name"
              />
            </div>
          </div>

          {/* Company Type */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Company Type *
            </label>
            <div className="relative">
              <FaBriefcase className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10" />
              <select
                name="companyType"
                value={formData.companyType}
                onChange={handleChange}
                required
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent appearance-none bg-white"
              >
                <option value="">Select Type</option>
                {companyTypes.map((type) => (
                  <option key={type} value={type}>
                    {type}
                  </option>
                ))}
              </select>
            </div>
          </div>

          {/* Number of Travelers */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Number of Travelers
            </label>
            <div className="relative">
              <FaUsers className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="number"
                name="numberOfTravelers"
                value={formData.numberOfTravelers}
                onChange={handleChange}
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                placeholder="10"
                min="1"
              />
            </div>
          </div>

          {/* Travel Date */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Preferred Travel Date
            </label>
            <div className="relative">
              <FaCalendar className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="date"
                name="travelDate"
                value={formData.travelDate}
                onChange={handleChange}
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
              />
            </div>
          </div>

          {/* Destination Interest */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Destination of Interest
            </label>
            <div className="relative">
              <FaMapMarkerAlt className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="text"
                name="destination"
                value={formData.destination}
                onChange={handleChange}
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                placeholder="e.g., Bali, Dubai, Europe"
              />
            </div>
          </div>
        </div>

        {/* Message */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Message / Special Requirements
          </label>
          <div className="relative">
            <FaComment className="absolute left-3 top-4 text-gray-400" />
            <textarea
              name="message"
              value={formData.message}
              onChange={handleChange}
              rows="4"
              className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
              placeholder="Tell us more about your requirements..."
            ></textarea>
          </div>
        </div>

        {/* Submit Buttons */}
        <div className="grid grid-cols-1 sm:grid-cols-1 gap-1">
          <button
            type="button"
            onClick={handleWhatsAppSubmit}
            className="flex items-center justify-center space-x-2 py-4 px-6 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition-all hover:shadow-lg transform hover:-translate-y-0.5"
          >
            <FaWhatsapp className="text-xl" />
            <span className="hidden sm:inline">Send on WhatsApp</span>
            <span className="sm:hidden">WhatsApp</span>
          </button>
        </div>
      </form>
    </div>
  )
}

export default ContactForm

