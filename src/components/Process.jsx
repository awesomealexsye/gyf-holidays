import { motion } from 'framer-motion'

const Process = () => {
    const processSteps = [
        {
            number: '01',
            title: 'Inquiry',
            description: 'Share your travel requirements with us',
        },
        {
            number: '02',
            title: 'Consultation',
            description: 'Our experts discuss options and customize solutions',
        },
        {
            number: '03',
            title: 'Proposal',
            description: 'Receive detailed itinerary and pricing',
        },
        {
            number: '04',
            title: 'Booking',
            description: 'Confirm and finalize your travel arrangements',
        },
        {
            number: '05',
            title: 'Support',
            description: 'Enjoy 24/7 assistance throughout your journey',
        },
    ]

    return (
        <section className="py-20 bg-white">
            <div className="container mx-auto px-4">
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    className="text-center mb-16"
                >
                    <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Our Process
                    </h2>
                    <p className="text-gray-600 max-w-2xl mx-auto">
                        Simple, transparent, and efficient - here's how we work
                    </p>
                </motion.div>

                <div className="grid grid-cols-1 md:grid-cols-5 gap-8">
                    {processSteps.map((step, index) => (
                        <motion.div
                            key={index}
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: index * 0.1 }}
                            className="relative text-center"
                        >
                            <div className="mb-6 relative">
                                <div className="w-20 h-20 bg-primary-600 rounded-full flex items-center justify-center mx-auto text-white text-2xl font-bold relative z-10 shadow-lg">
                                    {step.number}
                                </div>
                                {index < processSteps.length - 1 && (
                                    <div className="hidden md:block absolute top-10 left-[60%] w-[80%] h-0.5 bg-primary-200 z-0"></div>
                                )}
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-2">{step.title}</h3>
                            <p className="text-gray-600">{step.description}</p>
                        </motion.div>
                    ))}
                </div>
            </div>
        </section>
    )
}

export default Process
