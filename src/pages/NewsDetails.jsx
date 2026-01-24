import { useParams, Link } from 'react-router-dom'
import { motion } from 'framer-motion'
import { FaCalendar, FaTag, FaChevronLeft, FaShareAlt } from 'react-icons/fa'
import Hero from '../components/Hero'
import newsData from '../data/news.json'

const NewsDetails = () => {
    const { newsId } = useParams()
    const article = newsData.find(a => a.id === parseInt(newsId))

    if (!article) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="text-center">
                    <h2 className="text-2xl font-bold text-gray-900 mb-4">Article Not Found</h2>
                    <Link to="/news" className="text-primary-600 font-semibold">Return to News</Link>
                </div>
            </div>
        )
    }

    return (
        <div className="bg-white">
            <Hero
                title={article.title}
                subtitle={article.category}
                backgroundImage={article.image}
                showCTA={false}
                height="h-[400px]"
            />

            <div className="container mx-auto px-4 py-12">
                <div className="max-w-4xl mx-auto">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        className="mb-12"
                    >
                        <div className="flex flex-wrap items-center justify-between gap-4 mb-8 pb-8 border-b border-gray-100">
                            <div className="flex items-center space-x-6">
                                <div className="flex items-center text-gray-500">
                                    <FaCalendar className="mr-2 text-primary-600" />
                                    <span>{new Date(article.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                                </div>
                                <div className="flex items-center text-gray-500">
                                    <FaTag className="mr-2 text-primary-600" />
                                    <span>{article.category}</span>
                                </div>
                            </div>
                            <button className="flex items-center text-gray-400 hover:text-primary-600 transition-colors">
                                <FaShareAlt className="mr-2" />
                                <span>Share</span>
                            </button>
                        </div>

                        <div className="prose prose-lg max-w-none text-gray-600 leading-relaxed space-y-6">
                            <p className="text-xl font-medium text-gray-900 border-l-4 border-primary-600 pl-6 italic">
                                {article.excerpt}
                            </p>

                            <div className="whitespace-pre-line">
                                {article.content}
                            </div>
                        </div>

                        <div className="mt-16 pt-8 border-t border-gray-100">
                            <Link
                                to="/news"
                                className="inline-flex items-center text-primary-600 font-bold hover:text-primary-700 transition-colors"
                            >
                                <FaChevronLeft className="mr-2 text-xs" /> Back to All News
                            </Link>
                        </div>
                    </motion.div>
                </div>
            </div>
        </div>
    )
}

export default NewsDetails
