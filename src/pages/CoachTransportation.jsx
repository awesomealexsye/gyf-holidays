import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import {
  FaBus,
  FaCheckCircle,
  FaArrowRight,
  FaMapMarkerAlt,
  FaShieldAlt,
  FaClock,
  FaUserTie,
  FaGlobeEurope,
  FaStar
} from 'react-icons/fa'
import Hero from '../components/Hero'

const CoachTransportation = () => {
  const fleetOptions = [
    {
      title: 'Luxury Coaches',
      capacity: '20 – 48 Seater',
      description: 'Ideal for group tours, student groups, leisure series & MICE movements.',
      image: '/pictures/coach-transportation/1.jpeg',
      icon: FaBus
    },
    {
      title: 'Executive Minibus',
      capacity: 'Up to 15 Seater',
      description: 'Perfect for small groups, FIT movements & corporate travel.',
      image: '/pictures/coach-transportation/5.jpeg',
      icon: FaBus
    },
    {
      title: 'Premium Vans',
      capacity: 'Mercedes Sprinter / Premium Vans',
      description: 'Luxury family travel, VIP movements & executive transfers.',
      image: '/pictures/coach-transportation/3.jpeg',
      icon: FaBus
    }
  ]

  const services = [
    'MICE Movements',
    'FIT Transfers',
    'Group Series',
    'Chauffeur Services',
    'Private Van Tours',
    'Corporate Events',
    'Exhibition Transfers'
  ]

  const features = [
    {
      title: 'Contracted B2B Rates',
      desc: 'Competitive and transparent pricing with no hidden costs.',
      icon: FaStar
    },
    {
      title: 'Reliable Pan-Europe Network',
      desc: 'Strong network of certified transport partners across Europe.',
      icon: FaGlobeEurope
    },
    {
      title: '24/7 Ground Support',
      desc: 'Round-the-clock assistance and local coordination.',
      icon: FaClock
    },
    {
      title: 'Experienced Drivers',
      desc: 'Professional, licensed chauffeurs with local expertise.',
      icon: FaUserTie
    }
  ]

  return (
    <div className="bg-[#fdffff] overflow-x-hidden">
      {/* Hero Section */}
      <Hero
        title="Coach & Transfer Services"
        subtitle="Global standards in luxury standalone coach services across the UK & Europe"
        backgroundImage="/pictures/coach-transportation/5.jpeg"
        showCTA={false}
        height="h-[600px]"
      />

      {/* Intro Section */}
      <section className="relative pt-20 pb-24 px-4 overflow-visible">
        <div className="container mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="max-w-4xl mx-auto text-center mb-20"
          >
            <div className="inline-flex items-center space-x-2 bg-primary-100/50 text-primary-600 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider mb-6 border border-primary-200/50">
              <span className="relative flex h-2 w-2">
                <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                <span className="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
              </span>
              <span>B2B Transport Excellence</span>
            </div>
            <h2 className="text-4xl md:text-6xl font-black text-gray-900 mb-8 leading-tight tracking-tight">
              UK & Europe <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-600">Standalone</span> Coach Services
            </h2>
            <p className="text-xl text-gray-600 leading-relaxed font-medium max-w-3xl mx-auto">
              At GYF Holidays, we specialize in providing reliable and luxury standalone coach services across the UK & Europe for travel agents, tour operators, and corporate planners.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {features.map((feature, idx) => (
              <motion.div
                key={idx}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: idx * 0.1 }}
                className="bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/50 hover:shadow-2xl transition-all group"
              >
                <div className="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <feature.icon className="text-primary-600 text-2xl" />
                </div>
                <h4 className="text-xl font-bold text-gray-900 mb-2">{feature.title}</h4>
                <p className="text-gray-600 leading-relaxed text-sm font-medium">{feature.desc}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Coverage Section */}
      <section className="py-24 bg-[#0a0a0a] text-white relative overflow-hidden">
        <div className="absolute top-0 right-0 w-[600px] h-[600px] bg-primary-600/10 blur-[120px] rounded-full animate-pulse"></div>
        <div className="absolute -bottom-48 -left-48 w-[600px] h-[600px] bg-indigo-600/10 blur-[120px] rounded-full animate-pulse" style={{ animationDelay: '2s' }}></div>
        
        <div className="container mx-auto px-4 relative z-10">
          <div className="flex flex-col lg:flex-row items-center gap-16">
            <div className="w-full lg:w-1/2">
              <div className="inline-block bg-primary-500/10 text-primary-400 px-4 py-1.5 rounded-xl text-sm font-black mb-6 border border-primary-500/20 uppercase tracking-tighter">
                Pan-Europe Network
              </div>
              <h2 className="text-4xl md:text-6xl font-black mb-8 leading-tight tracking-tighter">
                Our <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-indigo-400">Coverage</span>
              </h2>
              <p className="text-gray-400 text-lg mb-10 leading-relaxed font-medium italic">
                We operate through a strong network of certified transport partners ensuring seamless ground handling across Europe.
              </p>
              <div className="grid grid-cols-2 md:grid-cols-3 gap-6">
                {[
                  'United Kingdom', 'France', 'Germany', 'Italy',
                  'Switzerland', 'Netherlands', 'Belgium', 'Austria',
                  'Spain', 'Scandinavia'
                ].map((country, idx) => (
                  <motion.div 
                    key={idx} 
                    whileHover={{ x: 5 }}
                    className="flex items-center space-x-3 text-gray-300 group"
                  >
                    <div className="w-2 h-2 rounded-full bg-primary-500 group-hover:scale-150 transition-transform"></div>
                    <span className="font-bold tracking-tight">{country}</span>
                  </motion.div>
                ))}
                <div className="flex items-center space-x-3 text-primary-400">
                   <div className="w-2 h-2 rounded-full bg-primary-400"></div>
                  <span className="font-black italic tracking-tight">& more</span>
                </div>
              </div>
            </div>
            <div className="w-full lg:w-1/2">
              <motion.div 
                initial={{ opacity: 0, scale: 0.9 }}
                whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }}
                className="relative"
              >
                <div className="absolute -inset-4 bg-gradient-to-tr from-primary-500/20 to-indigo-500/20 blur-2xl rounded-[3rem]"></div>
                <div className="overflow-hidden rounded-[3rem] shadow-2xl relative aspect-[4/3] group border border-white/10">
                  <img
                    src="/pictures/coach-transportation/4.jpeg"
                    alt="Europe Coverage"
                    className="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
              </motion.div>
            </div>
          </div>
        </div>
      </section>

      {/* Fleet Options */}
      <section className="py-32 relative">
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary-50/50 rounded-full blur-3xl -z-10"></div>
        <div className="container mx-auto px-4">
          <div className="text-center mb-20">
            <div className="inline-block bg-primary-50 text-primary-700 px-6 py-2 rounded-2xl text-xs font-black uppercase tracking-[0.2em] mb-6">
              Vehicle Categories
            </div>
            <h2 className="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tighter">Our Fleet Options</h2>
            <p className="text-xl text-gray-500 max-w-2xl mx-auto font-medium leading-relaxed">
              We offer a wide range of modern, well-maintained vehicles operated by professional, licensed chauffeurs.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-10">
            {fleetOptions.map((fleet, idx) => (
              <motion.div
                key={idx}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: idx * 0.1 }}
                className="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl hover:shadow-3xl transition-all border border-gray-100 group flex flex-col h-full"
              >
                <div className="h-72 overflow-hidden relative">
                  <img
                    src={fleet.image}
                    alt={fleet.title}
                    className="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                  <div className="absolute top-6 right-6 bg-white/95 backdrop-blur px-5 py-2 rounded-2xl text-xs font-black text-primary-600 shadow-xl border border-primary-50">
                    {fleet.capacity}
                  </div>
                </div>
                <div className="p-10 flex-grow flex flex-col">
                  <h3 className="text-2xl font-black text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">{fleet.title}</h3>
                  <p className="text-gray-600 mb-8 text-sm leading-relaxed font-medium">{fleet.description}</p>
                  <div className="mt-auto flex items-center p-4 bg-primary-50 rounded-2xl border border-primary-100 group-hover:bg-primary-600 transition-colors">
                    <FaShieldAlt className="text-primary-600 text-lg mr-3 group-hover:text-white transition-colors" />
                    <span className="font-black text-primary-900 text-sm group-hover:text-white transition-colors">Professional Chauffeurs</span>
                  </div>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section className="py-24 relative overflow-visible">
        <div className="absolute inset-0 bg-gray-50 skew-y-3 origin-right -z-10 shadow-inner"></div>
        <div className="container mx-auto px-4">
          <div className="flex flex-col lg:flex-row gap-16 items-center">
            <div className="w-full lg:w-1/2">
              <motion.div 
                initial={{ opacity: 0, x: -30 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
                className="bg-white p-12 md:p-16 rounded-[4rem] shadow-3xl border border-gray-100 relative"
              >
                <div className="absolute -top-8 -left-8 w-20 h-20 bg-primary-600 rounded-3xl shadow-xl flex items-center justify-center rotate-3 group">
                   <FaBus className="text-white text-3xl" />
                </div>
                <h3 className="text-3xl font-black text-gray-900 mb-12 tracking-tight">Services We Cater To</h3>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-8">
                  {services.map((service, idx) => (
                    <motion.div 
                      key={idx} 
                      whileHover={{ scale: 1.05 }}
                      className="flex items-center space-x-4 group"
                    >
                      <div className="w-10 h-10 rounded-2xl bg-green-50 flex items-center justify-center flex-shrink-0 group-hover:bg-green-500 transition-colors shadow-sm">
                        <FaCheckCircle className="text-green-500 text-sm group-hover:text-white transition-colors" />
                      </div>
                      <span className="font-black text-gray-800 tracking-tight group-hover:text-primary-600 transition-colors">{service}</span>
                    </motion.div>
                  ))}
                </div>
              </motion.div>
            </div>
            <div className="w-full lg:w-1/2">
              <motion.div
                initial={{ opacity: 0, x: 30 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
              >
                <div className="inline-block bg-white text-gray-400 px-6 py-2 rounded-2xl shadow-sm text-xs font-black uppercase tracking-[0.2em] mb-8 border border-gray-100">
                  Strategic Partnership
                </div>
                <h2 className="text-4xl md:text-6xl font-black text-gray-900 mb-10 leading-[1.1] tracking-tighter">
                  Why Partner <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-600">With Us?</span>
                </h2>
                <div className="space-y-6">
                  {[
                    'Contracted & Competitive B2B Rates',
                    'Reliable Pan-Europe Network',
                    '24/7 Ground Support',
                    'Experienced Drivers',
                    'Transparent Pricing – No Hidden Costs',
                    'Customized Routing & Itinerary Support'
                  ].map((item, idx) => (
                    <div key={idx} className="flex items-start space-x-5 group">
                      <div className="mt-1.5 w-3 h-3 rounded-full bg-primary-500 flex-shrink-0 shadow-[0_0_15px_rgba(239,68,68,0.4)] group-hover:scale-125 transition-transform"></div>
                      <p className="font-black text-gray-700 leading-tight text-lg tracking-tight">{item}</p>
                    </div>
                  ))}
                </div>
                <div className="mt-12 p-8 bg-gray-900 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                   <div className="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 blur-3xl"></div>
                   <p className="text-white/80 text-lg font-medium leading-relaxed italic relative z-10">
                    "We understand the needs of travel professionals and ensure timely operations, comfort, and safety for your clients."
                  </p>
                </div>
              </motion.div>
            </div>
          </div>
        </div>
      </section>

      {/* Modern CTA */}
      <section className="py-24 px-4 overflow-visible">
        <div className="container mx-auto max-w-6xl">
          <motion.div
            initial={{ opacity: 0, scale: 0.95 }}
            whileInView={{ opacity: 1, scale: 1 }}
            viewport={{ once: true }}
            className="relative bg-[#0a0a0a] rounded-[3.5rem] p-12 md:p-24 overflow-hidden border border-white/5 group shadow-3xl"
          >
            <div className="absolute -top-24 -right-24 w-[500px] h-[500px] bg-primary-600/20 blur-[100px] animate-pulse"></div>
            <div className="absolute -bottom-24 -left-24 w-[400px] h-[400px] bg-indigo-600/20 blur-[100px] animate-pulse" style={{ animationDelay: '2s' }}></div>

            <div className="relative z-10 text-center flex flex-col items-center">
              <div className="w-16 h-16 bg-white/5 backdrop-blur-3xl rounded-3xl flex items-center justify-center mb-10 border border-white/10 ring-1 ring-white/5">
                <FaBus className="text-white text-2xl" />
              </div>
              <h2 className="text-4xl md:text-7xl font-black text-white mb-10 tracking-tighter leading-none">
                Contact Us for Special <span className="text-primary-500">B2B Rates</span>
              </h2>
              <div className="text-white/80 text-lg mb-14 max-w-2xl font-medium leading-loose">
                <p>📧 sales@gyfholidays.com</p>
                <p>📞 +91 88823 82864</p>
              </div>

              <div className="flex flex-col sm:flex-row gap-8 w-full max-w-md">
                <Link
                  to="/contact"
                  className="flex-1 px-10 py-6 bg-white text-gray-950 rounded-2xl font-black text-lg hover:bg-white/90 transform active:scale-95 transition-all shadow-2xl flex items-center justify-center group"
                >
                  Get a Quote
                  <FaArrowRight className="ml-3 group-hover:translate-x-1 transition-transform" />
                </Link>
                <a
                  href="https://wa.me/918882382864"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex-1 px-10 py-6 bg-primary-600 text-white rounded-2xl font-black text-lg hover:bg-primary-700 transform active:scale-95 transition-all shadow-2xl flex items-center justify-center group"
                >
                  WhatsApp
                  <FaArrowRight className="ml-3 group-hover:translate-x-1 transition-transform" />
                </a>
              </div>
            </div>
          </motion.div>
        </div>
      </section>
    </div>
  )
}

export default CoachTransportation
