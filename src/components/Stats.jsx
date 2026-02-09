import { motion } from 'framer-motion'

const Stats = () => {
  const stats = [
    { value: '150+', label: 'DESTINATIONS' },
    { value: '5000+', label: 'HAPPY CLIENTS' },
    { value: '200+', label: 'B2B PARTNERS' },
    { value: '50+', label: 'EXPERTS' },
  ]

  return (
    <div className="container mx-auto px-4 relative z-10 -mt-10">
      <motion.div 
        initial={{ opacity: 0, y: 20 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true }}
        className="bg-white rounded-3xl shadow-xl py-8 px-4 grid grid-cols-2 md:grid-cols-4 gap-8"
      >
        {stats.map((stat, index) => (
          <div key={index} className={`text-center ${index !== stats.length - 1 ? 'md:border-r md:border-gray-100' : ''}`}>
            <h3 className="text-3xl md:text-4xl font-black text-gray-900 mb-2 font-poppins">{stat.value}</h3>
            <p className="text-xs md:text-sm font-bold text-gray-400 tracking-widest uppercase">{stat.label}</p>
          </div>
        ))}
      </motion.div>
    </div>
  )
}

export default Stats
