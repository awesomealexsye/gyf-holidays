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
      className="fixed bottom-6 right-6 z-40 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-colors group"
      whileHover={{ scale: 1.1 }}
      whileTap={{ scale: 0.9 }}
      initial={{ opacity: 0, scale: 0 }}
      animate={{ opacity: 1, scale: 1 }}
      transition={{ delay: 1 }}
      aria-label="Contact us on WhatsApp"
    >
      <FaWhatsapp className="text-white text-3xl" />
      <span className="absolute right-full mr-3 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">
        Chat with us!
      </span>
    </motion.a>
  )
}

export default WhatsAppButton

