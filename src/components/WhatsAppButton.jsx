import { motion } from 'framer-motion'
import { FaWhatsapp } from 'react-icons/fa'
import config from '../config'

const WhatsAppButton = () => {
  const whatsappUrl = `https://wa.me/${config.contact.whatsapp}?text=Hello! I'm interested in your travel packages.`

  return (
    <motion.a
      href={whatsappUrl}
      target="_blank"
      rel="noopener noreferrer"
      className="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-40 w-12 h-12 sm:w-14 sm:h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-colors group"
      whileHover={{ scale: 1.1 }}
      whileTap={{ scale: 0.9 }}
      initial={{ opacity: 0, scale: 0 }}
      animate={{ opacity: 1, scale: 1 }}
      transition={{ delay: 1 }}
      aria-label="Contact us on WhatsApp"
    >
      <FaWhatsapp className="text-white text-2xl sm:text-3xl" />
      <span className="absolute right-full mr-2 sm:mr-3 bg-gray-900 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg text-xs sm:text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity hidden sm:block">
        Chat with us!
      </span>
      <span className="absolute right-full mr-2 bg-gray-900 text-white px-2 py-1 rounded-lg text-xs whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity sm:hidden">
        WhatsApp
      </span>
    </motion.a>
  )
}

export default WhatsAppButton

