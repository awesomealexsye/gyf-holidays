import { useState } from 'react'
import { motion, AnimatePresence } from 'framer-motion'
import { FaCalendar, FaTag, FaTimes } from 'react-icons/fa'
import Hero from '../components/Hero'
import NewsCard from '../components/NewsCard'
import newsData from '../data/news.json'

const News = () => {
  const [selectedCategory, setSelectedCategory] = useState('all')
  const [selectedArticle, setSelectedArticle] = useState(null)

  // Get unique categories
  const categories = ['all', ...new Set(newsData.map((article) => article.category))]

  // Filter articles by category
  const filteredArticles = selectedCategory === 'all'
    ? newsData
    : newsData.filter((article) => article.category === selectedCategory)

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="News & Insights"
        subtitle="Stay updated with the latest travel trends, tips, and industry news"
        backgroundImage="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1920&auto=format&fit=crop&q=80"
        showCTA={false}
        height="h-[400px]"
      />

      {/* Category Filter */}
      <section className="py-8 bg-white sticky top-20 z-30 shadow-sm">
        <div className="container mx-auto px-4">
          <div className="flex flex-wrap justify-center gap-4">
            {categories.map((category) => (
              <button
                key={category}
                onClick={() => setSelectedCategory(category)}
                className={`px-6 py-3 rounded-lg font-semibold transition-all capitalize ${
                  selectedCategory === category
                    ? 'gradient-primary text-white shadow-lg'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                }`}
              >
                {category}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Articles Grid */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              {selectedCategory === 'all' ? 'All Articles' : selectedCategory}
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              {filteredArticles.length} article{filteredArticles.length !== 1 ? 's' : ''} found
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {filteredArticles.map((article, index) => (
              <div key={article.id} onClick={() => setSelectedArticle(article)} className="cursor-pointer">
                <NewsCard article={article} index={index} />
              </div>
            ))}
          </div>

          {filteredArticles.length === 0 && (
            <div className="text-center py-12">
              <p className="text-gray-500 text-lg">No articles found in this category.</p>
            </div>
          )}
        </div>
      </section>

      {/* Article Modal */}
      <AnimatePresence>
        {selectedArticle && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            onClick={() => setSelectedArticle(null)}
          >
            <motion.div
              initial={{ scale: 0.9, opacity: 0 }}
              animate={{ scale: 1, opacity: 1 }}
              exit={{ scale: 0.9, opacity: 0 }}
              className="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
              onClick={(e) => e.stopPropagation()}
            >
              {/* Modal Header Image */}
              <div className="relative h-80">
                <img
                  src={selectedArticle.image}
                  alt={selectedArticle.title}
                  className="w-full h-full object-cover"
                />
                <button
                  onClick={() => setSelectedArticle(null)}
                  className="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition"
                >
                  <FaTimes className="text-gray-700" />
                </button>
                <div className="absolute bottom-4 left-4 bg-secondary-500 text-white px-4 py-2 rounded-full font-semibold flex items-center space-x-2">
                  <FaTag />
                  <span>{selectedArticle.category}</span>
                </div>
              </div>

              {/* Modal Content */}
              <div className="p-8 md:p-12">
                <div className="flex items-center text-gray-500 text-sm mb-4">
                  <FaCalendar className="mr-2" />
                  <span>
                    {new Date(selectedArticle.date).toLocaleDateString('en-US', {
                      year: 'numeric',
                      month: 'long',
                      day: 'numeric',
                    })}
                  </span>
                </div>

                <h1 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                  {selectedArticle.title}
                </h1>

                <p className="text-lg text-gray-700 leading-relaxed mb-6">
                  {selectedArticle.content}
                </p>

                <div className="pt-6 border-t border-gray-200">
                  <button
                    onClick={() => setSelectedArticle(null)}
                    className="px-6 py-3 gradient-primary text-white rounded-lg font-semibold hover:shadow-lg transition-all"
                  >
                    Close
                  </button>
                </div>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>

      {/* Newsletter Section */}
      <section className="py-20 gradient-hero">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center max-w-2xl mx-auto"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
              Subscribe to Our Newsletter
            </h2>
            <p className="text-white/90 mb-8">
              Get the latest travel news, tips, and exclusive B2B offers delivered to your inbox
            </p>
            <form className="flex flex-col sm:flex-row gap-4" onSubmit={(e) => {
              e.preventDefault()
              alert('Thank you for subscribing! (This is a demo - no actual subscription)')
            }}>
              <input
                type="email"
                placeholder="Enter your email"
                required
                className="flex-1 px-6 py-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-white"
              />
              <button
                type="submit"
                className="px-8 py-4 bg-white text-primary-600 rounded-lg font-semibold hover:bg-gray-100 transition-all"
              >
                Subscribe
              </button>
            </form>
          </motion.div>
        </div>
      </section>
    </div>
  )
}

export default News

