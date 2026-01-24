import { useParams, Link } from 'react-router-dom'
import { motion } from 'framer-motion'
import { FaMapMarkerAlt, FaClock, FaCheckCircle, FaChevronLeft, FaWhatsapp } from 'react-icons/fa'
import Hero from '../components/Hero'
import packages from '../data/packages.json'
import config from '../config'

const PackageDetails = () => {
    const { packageId } = useParams()
    const pkg = packages.find(p => p.id === packageId)

    if (!pkg) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="text-center">
                    <h2 className="text-2xl font-bold text-gray-900 mb-4">Package Not Found</h2>
                    <Link to="/" className="text-primary-600 font-semibold">Return Home</Link>
                </div>
            </div>
        )
    }

    const handleWhatsAppInquiry = () => {
        const message = `Hi GYF Holidays, I'm interested in the ${pkg.name} (${pkg.duration}). Please provide more details.`
        const whatsappUrl = `https://wa.me/${config.contact.whatsapp.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`
        window.open(whatsappUrl, '_blank')
    }

    return (
        <div className="bg-white">
            <Hero
                title={pkg.name}
                subtitle={pkg.destination}
                backgroundImage={pkg.image}
                showCTA={false}
                height="h-[450px]"
            />

            <div className="container mx-auto px-4 py-12">
                <div className="flex flex-wrap -mx-4">
                    {/* Main Content */}
                    <div className="w-full lg:w-2/3 px-4">
                        <motion.div
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            className="mb-12"
                        >
                            <div className="flex items-center space-x-6 mb-8 p-4 bg-gray-50 rounded-xl">
                                <div className="flex items-center">
                                    <FaClock className="text-primary-600 mr-2" />
                                    <span className="font-semibold">{pkg.duration}</span>
                                </div>
                                <div className="flex items-center">
                                    <FaMapMarkerAlt className="text-primary-600 mr-2" />
                                    <span className="font-semibold">{pkg.destination}</span>
                                </div>
                            </div>

                            <h2 className="text-3xl font-bold text-gray-900 mb-6">Tour Highlights</h2>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
                                {pkg.highlights.map((highlight, index) => (
                                    <div key={index} className="flex items-start space-x-3">
                                        <FaCheckCircle className="text-green-500 mt-1 flex-shrink-0" />
                                        <span className="text-gray-700">{highlight}</span>
                                    </div>
                                ))}
                            </div>

                            <h2 className="text-3xl font-bold text-gray-900 mb-8">Detailed Itinerary</h2>
                            <div className="space-y-8">
                                {pkg.itinerary.map((item, index) => (
                                    <div key={index} className="relative pl-12 pb-8 border-l-2 border-primary-200 last:border-0 last:pb-0">
                                        <div className="absolute left-[-13px] top-0 w-6 h-6 rounded-full bg-primary-600 flex items-center justify-center text-white text-xs font-bold ring-4 ring-white">
                                            {index + 1}
                                        </div>
                                        <div className="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
                                            <h4 className="text-sm font-bold text-primary-600 uppercase tracking-wider mb-1">
                                                {item.day}
                                            </h4>
                                            <h3 className="text-xl font-bold text-gray-900 mb-3">{item.title}</h3>
                                            <p className="text-gray-600 leading-relaxed">{item.description}</p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </motion.div>
                    </div>

                    {/* Sidebar */}
                    <div className="w-full lg:w-1/3 px-4">
                        <div className="sticky top-32">
                            {/* Inquiry Card */}
                            <div className="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-8">
                                <h3 className="text-2xl font-bold text-gray-900 mb-6">Interested in this trip?</h3>
                                <div className="space-y-4">
                                    <button
                                        onClick={handleWhatsAppInquiry}
                                        className="w-full py-4 bg-green-500 text-white rounded-xl font-bold flex items-center justify-center space-x-2 hover:bg-green-600 transition-colors shadow-lg"
                                    >
                                        <FaWhatsapp className="text-xl" />
                                        <span>Inquiry on WhatsApp</span>
                                    </button>
                                    <Link
                                        to="/contact"
                                        className="w-full py-4 bg-primary-600 text-white rounded-xl font-bold flex items-center justify-center space-x-2 hover:bg-primary-700 transition-colors shadow-lg"
                                    >
                                        <span>Contact For Booking</span>
                                    </Link>
                                </div>
                                <p className="text-center text-gray-500 text-sm mt-6">
                                    24/7 Support | Best B2B Rates | Expert Planning
                                </p>
                            </div>

                            {/* Photo Gallery */}
                            {pkg.gallery && pkg.gallery.length > 0 && (
                                <div className="bg-gray-50 rounded-2xl p-6 shadow-inner">
                                    <h3 className="text-xl font-bold text-gray-900 mb-4">Tour Gallery</h3>
                                    <div className="grid grid-cols-2 gap-3">
                                        {pkg.gallery.map((img, idx) => (
                                            <div key={idx} className="h-24 rounded-lg overflow-hidden ring-2 ring-white shadow-sm">
                                                <img src={img} alt={`Gallery ${idx}`} className="w-full h-full object-cover" />
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            )}

                            <Link
                                to="/"
                                className="mt-8 flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors"
                            >
                                <FaChevronLeft className="mr-2 text-xs" /> Back to All Packages
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default PackageDetails
