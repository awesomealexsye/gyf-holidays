import { motion } from 'framer-motion'
import { FaCalendar, FaTag } from 'react-icons/fa'
import { Link } from 'react-router-dom'

const NewsCard = ({ article, index = 0 }) => {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.5, delay: index * 0.1 }}
      className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 group"
    >
      {/* Image */}
      <div className="relative h-56 overflow-hidden">
        <img
          src={article.image}
          alt={article.title}
          className="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
        />
        <div className="absolute top-4 right-4 bg-secondary-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center space-x-1">
          <FaTag className="text-xs" />
          <span>{article.category}</span>
        </div>
      </div>

      {/* Content */}
      <div className="p-6">
        <div className="flex items-center text-gray-500 text-sm mb-3">
          <FaCalendar className="mr-2" />
          <span>{new Date(article.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
        </div>

        <h3 className="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2">
          {article.title}
        </h3>

        <p className="text-gray-600 mb-4 line-clamp-3">
          {article.excerpt}
        </p>

        <Link
          to={`/news/${article.id}`}
          className="text-primary-600 font-semibold hover:text-primary-700 flex items-center transition-colors"
        >
          Read More
          <svg
            className="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
          </svg>
        </Link>
      </div>
    </motion.div>
  )
}

export default NewsCard

