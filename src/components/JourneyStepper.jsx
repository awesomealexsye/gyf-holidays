import { motion } from 'framer-motion'
import { FaSuitcase, FaMapMarkedAlt, FaHome } from 'react-icons/fa'

const JourneyStepper = () => {
    const steps = [
        {
            icon: FaSuitcase,
            title: 'Preparation',
            description: 'Receive your personalized itinerary, travel documents, and expert tips for a smooth departure.',
            details: ['Itinerary Finalization', 'Visa Assistance', 'Packing Guide']
        },
        {
            icon: FaMapMarkedAlt,
            title: 'The Experience',
            description: 'Immerse yourself in carefully curated tours with 24/7 on-ground support and seamless logistics.',
            details: ['Private Transfers', 'Guided Tours', '24/7 Support']
        },
        {
            icon: FaHome,
            title: 'Homecoming',
            description: 'Return with unforgettable memories and shared stories from your bespoke travel experience.',
            details: ['Feedback Session', 'Photo Sharing', 'Future Planning']
        }
    ]

    return (
        <section className="py-24 bg-gray-50 overflow-hidden">
            <div className="container mx-auto px-4">
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    className="text-center mb-20"
                >
                    <h2 className="text-3xl md:text-5xl font-bold text-gray-900 mb-6 font-primary">
                        Your Journey with GYF Holidays
                    </h2>
                    <p className="text-gray-600 max-w-2xl mx-auto text-lg">
                        From the first consultation to your safe return, we ensure every moment is perfectly orchestrated.
                    </p>
                </motion.div>

                <div className="relative max-w-5xl mx-auto">
                    {/* Connection Line */}
                    <div className="hidden md:block absolute top-[60px] left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-primary-200 via-primary-500 to-primary-200 z-0"></div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                        {steps.map((step, index) => (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, y: 30 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true }}
                                transition={{ delay: index * 0.2 }}
                                className="group"
                            >
                                <div className="flex flex-col items-center">
                                    <div className="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-8 shadow-xl border-4 border-gray-100 group-hover:border-primary-500 transition-all duration-500 transform group-hover:scale-110 relative">
                                        <step.icon className="text-4xl text-primary-600 transition-colors duration-500" />
                                        <div className="absolute -top-2 -right-2 w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            {index + 1}
                                        </div>
                                    </div>

                                    <h3 className="text-2xl font-bold text-gray-900 mb-4 text-center">
                                        {step.title}
                                    </h3>
                                    <p className="text-gray-600 text-center mb-8 px-4 leading-relaxed italic">
                                        {step.description}
                                    </p>

                                    <div className="w-full space-y-3">
                                        {step.details.map((detail, idx) => (
                                            <div key={idx} className="flex items-center space-x-3 bg-white p-3 rounded-xl shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow">
                                                <div className="w-2 h-2 rounded-full bg-primary-500"></div>
                                                <span className="text-sm font-semibold text-gray-700">{detail}</span>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            </motion.div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    )
}

export default JourneyStepper
