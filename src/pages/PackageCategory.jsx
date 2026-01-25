import { useParams, Link } from 'react-router-dom'
import { motion } from 'framer-motion'
import { FaMapMarkerAlt, FaClock, FaStar, FaChevronRight } from 'react-icons/fa'
import Hero from '../components/Hero'
import packages from '../data/packages.json'
import categories from '../data/categories.json'

const PackageCategory = () => {
    const { categoryId } = useParams()

    const category = categories.find(c => c.id === categoryId)
    const filteredPackages = packages.filter(p => p.categoryId === categoryId)

    if (!category) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="text-center">
                    <h2 className="text-2xl font-bold text-gray-900 mb-4">Category Not Found</h2>
                    <Link to="/" className="text-primary-600 font-semibold">Return Home</Link>
                </div>
            </div>
        )
    }

    return (
        <div>
            <Hero
                title={category.name}
                subtitle={category.description}
                backgroundImage={category.image}
                showCTA={false}
                height="h-[400px]"
            />

            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    {filteredPackages.length > 0 ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            {filteredPackages.map((pkg, index) => (
                                <motion.div
                                    key={pkg.id}
                                    initial={{ opacity: 0, y: 20 }}
                                    animate={{ opacity: 1, y: 0 }}
                                    transition={{ delay: index * 0.1 }}
                                    className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow group"
                                >
                                    <div className="relative aspect-video overflow-hidden">
                                        <img
                                            src={pkg.image}
                                            alt={pkg.name}
                                            className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        />
                                        <div className="absolute top-4 right-4 bg-primary-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                            {pkg.duration}
                                        </div>
                                    </div>

                                    <div className="p-6">
                                        <h3 className="text-xl font-bold text-gray-900 mb-2 truncate">
                                            {pkg.name}
                                        </h3>
                                        <div className="flex items-center text-gray-500 text-sm mb-4">
                                            <FaMapMarkerAlt className="mr-2 text-primary-500" />
                                            <span className="truncate">{pkg.destination}</span>
                                        </div>
                                        <p className="text-gray-600 mb-6 line-clamp-2">
                                            {pkg.description}
                                        </p>
                                        <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div className="flex items-center text-yellow-500">
                                                <FaStar className="mr-1" />
                                                <span className="font-semibold text-gray-900">4.9</span>
                                            </div>
                                            <Link
                                                to={`/package/${pkg.id}`}
                                                className="flex items-center text-primary-600 font-bold hover:text-primary-700 transition-colors"
                                            >
                                                View Details <FaChevronRight className="ml-1 text-xs" />
                                            </Link>
                                        </div>
                                    </div>
                                </motion.div>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-20 bg-white rounded-2xl shadow-inner border-2 border-dashed border-gray-200">
                            <div className="mb-6">
                                <FaClock className="text-gray-300 text-6xl mx-auto" />
                            </div>
                            <h3 className="text-2xl font-bold text-gray-900 mb-4">Tour Packages Arriving Soon!</h3>
                            <p className="text-gray-600 max-w-md mx-auto">
                                We are currently curating the best experiences for this region. Please wait till then, we will add amazing tour and trip packages here soon.
                            </p>
                            <Link
                                to="/destinations"
                                className="inline-block mt-8 px-8 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-colors"
                            >
                                Explore Other Destinations
                            </Link>
                        </div>
                    )}
                </div>
            </section>
        </div>
    )
}

export default PackageCategory
