import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import {
  FaPlane,
  FaUsers,
  FaCog,
  FaCalendarAlt,
  FaHeadset,
  FaCheckCircle,
  FaMapMarkedAlt,
  FaArrowRight,
  FaGlobe
} from 'react-icons/fa'
import Hero from '../components/Hero'
import Process from '../components/Process'

const Services = () => {
  const mainServices = [
    {
      title: 'Corporate Land Travel Management',
      icon: FaPlane,
      description: 'GYF Holidays delivers professional corporate land travel solutions across Europe, the UK, and key international destinations. We specialize in seamless ground arrangements for business travelers, corporate groups, and MICE movements, ensuring efficiency, reliability, and exceptional service standards.',
      details: 'Our corporate travel solutions are designed to simplify complex logistics, optimize costs, and provide a smooth travel experience for organizations and their employees.',
      features: [
        {
          title: 'Hotel Accommodation Management',
          desc: 'Carefully selected corporate hotels, serviced apartments, and long-stay options with negotiated rates, ensuring comfort, convenience, and value for business travelers.'
        },
        {
          title: 'Ground Transportation & Mobility Solutions',
          desc: 'End-to-end ground logistics including airport transfers, chauffeur-driven vehicles, intercity travel, luxury coaches, and group transportation across multiple destinations.'
        },
        {
          title: 'Corporate Travel Policy Alignment',
          desc: 'All arrangements are managed in accordance with your company’s travel policies, ensuring transparency, cost control, and standardized processes.'
        },
        {
          title: '24/7 Operational & On-Ground Support',
          desc: 'Round-the-clock assistance and local coordination to ensure smooth execution of corporate travel plans and immediate support when required.'
        },
        {
          title: 'MICE & Business Travel Solutions',
          desc: 'Comprehensive land arrangements for meetings, incentives, conferences, exhibitions, corporate events, business delegations, and international corporate tours.'
        },
        {
          title: 'Dedicated Corporate Account Management',
          desc: 'A single point of contact to manage corporate requirements, negotiate supplier contracts, and deliver customized solutions tailored to your organization.'
        }
      ],
      color: 'bg-blue-600',
      image: '/pictures/our-services/img1.jpg',
      footer: 'With strong local partnerships and on-ground expertise, GYF Holidays ensures seamless corporate land travel solutions that meet global standards of quality, efficiency, and reliability.'
    },
    {
      title: 'Group Tours & Bookings',
      icon: FaUsers,
      description: 'GYF Holidays specializes in planning and managing seamless group travel solutions across Europe, the UK, and international destinations. We design and execute well-coordinated group tours for corporate teams, incentive programs, business delegations, and large leisure groups, ensuring smooth operations and exceptional travel experiences.',
      details: 'From planning to execution, our expert team manages every detail with precision, making group travel efficient, organized, and memorable.',
      features: [
        {
          title: 'Customized Group Itineraries',
          desc: 'Tailor-made travel programs designed according to group size, interests, budget, and travel objectives.'
        },
        {
          title: 'Special Group Rates & Bulk Benefits',
          desc: 'Negotiated group rates for hotels, transportation, sightseeing, and services, ensuring cost efficiency and maximum value.'
        },
        {
          title: 'Dedicated Tour & Operations Management',
          desc: 'Professional tour managers and operational support to oversee group movements and ensure flawless execution throughout the journey.'
        },
        {
          title: 'End-to-End Group Coordination',
          desc: 'Comprehensive coordination of logistics including hotels, transfers, sightseeing, guides, and schedules for smooth group movements.'
        },
        {
          title: 'Special Meal & Dietary Arrangements',
          desc: 'Arranged group meals including Indian, vegetarian, halal, Jain, and customized dietary requirements based on group preferences.'
        }
      ],
      color: 'bg-indigo-600',
      image: '/pictures/our-services/img2.jpg',
      footer: 'With strong supplier partnerships and on-ground expertise, we ensure every group tour is delivered with efficiency, comfort, and the highest service standards.'
    },
    {
      title: 'Customized Travel Packages',
      icon: FaCog,
      description: 'GYF Holidays designs tailor-made travel packages for corporate clients, groups, and FIT travelers, crafted to meet diverse travel needs and preferences. Whether it’s a corporate retreat, incentive travel, client engagement program, special celebration, or a personalized leisure trip, we create unique travel experiences aligned with your objectives, interests, and budget.',
      details: 'With deep destination expertise and strong local partnerships, we deliver seamless, flexible, and high-quality travel solutions for both business and individual travelers.',
      features: [
        {
          title: 'Personalized Itineraries',
          desc: 'Bespoke travel programs designed for corporate groups and FIT travelers, based on travel goals, preferences, and destination choices.'
        },
        {
          title: 'Flexible Scheduling & Planning',
          desc: 'Adaptable travel plans tailored to corporate agendas as well as individual travel styles and timelines.'
        },
        {
          title: 'Cost & Budget Optimization',
          desc: 'Strategic planning and supplier negotiations to deliver the best value while maintaining premium service standards.'
        },
        {
          title: 'Theme-Based Travel Experiences',
          desc: 'Creative theme-driven packages including luxury holidays, cultural tours, adventure trips, wellness retreats, romantic getaways, and incentive travel programs.'
        },
        {
          title: 'Activity & Experience Coordination',
          desc: 'Curated experiences, excursions, and exclusive activities for corporate groups and FIT travelers to enhance engagement and overall travel experience.'
        }
      ],
      color: 'bg-emerald-600',
      image: '/pictures/our-services/img3.jpg',
      footer: 'Whether for business or leisure, GYF Holidays delivers customized travel experiences with precision, creativity, and exceptional service standards.'
    },
    {
      title: 'Small Group & Family Private Van Tours',
      icon: FaMapMarkedAlt,
      description: 'GYF Holidays specializes in designing exclusive small group and family private tours with personalized itineraries and premium ground services. Ideal for families, friends, and small private groups, our tours offer comfort, flexibility, and a more intimate travel experience across Europe, the UK, and international destinations.',
      details: 'With private vehicles and customized planning, we ensure seamless travel, personalized experiences, and memorable journeys tailored to individual preferences.',
      features: [
        {
          title: 'Customized Private Itineraries',
          desc: 'Tailor-made travel programs designed according to group size, interests, pace, and destination preferences.'
        },
        {
          title: 'Private Van & Chauffeur Services',
          desc: 'Comfortable private vans with professional drivers for airport transfers, intercity travel, sightseeing, and day tours.'
        },
        {
          title: 'Flexible Travel Planning',
          desc: 'Itineraries designed with flexibility to accommodate family needs, leisure time, and personalized schedules.'
        },
        {
          title: 'Handpicked Accommodation Options',
          desc: 'Carefully selected hotels, apartments, and family-friendly properties suited to small groups and private travelers.'
        },
        {
          title: 'Curated Experiences & Activities',
          desc: 'Exclusive experiences, guided tours, cultural activities, and family-friendly attractions tailored to your interests.'
        },
        {
          title: 'Dedicated On-Ground Support',
          desc: '24/7 local assistance and operational support to ensure a smooth and hassle-free travel experience.'
        }
      ],
      color: 'bg-violet-600',
      image: '/pictures/our-services/img-van.jpg',
      footer: 'Our small group and family private tours combine personalized planning, comfort, and local expertise to deliver truly unique and unforgettable travel experiences.'
    },
    {
      title: 'Event Management & MICE Solutions',
      icon: FaCalendarAlt,
      description: 'GYF Holidays provides professional event planning and management services for conferences, seminars, corporate retreats, incentive programs, and special occasions across Europe, the UK, and international destinations. We manage every aspect of event planning and execution, allowing you to focus on your objectives while we deliver flawless experiences.',
      details: 'With strong destination expertise and reliable local partners, we ensure seamless coordination, high-quality execution, and memorable event experiences.',
      features: [
        {
          title: 'Venue Selection & Contracting',
          desc: 'Identification and booking of suitable venues including hotels, conference centers, and unique event spaces based on your event requirements and budget.'
        },
        {
          title: 'End-to-End Logistics Management',
          desc: 'Comprehensive management of event logistics including transportation, scheduling, supplier coordination, and operational planning.'
        },
        {
          title: 'Accommodation Arrangements',
          desc: 'Hotel bookings and room allocations for delegates, speakers, and VIP guests with negotiated group rates.'
        },
        {
          title: 'Audio-Visual & Technical Setup',
          desc: 'Arrangement of professional audio-visual equipment, staging, lighting, and technical support for smooth event execution.'
        },
        {
          title: 'On-Site Event Coordination',
          desc: 'Dedicated on-ground team and event managers to supervise operations, manage vendors, and ensure seamless execution throughout the event.'
        },
        {
          title: 'Customized Event Concepts & Experiences',
          desc: 'Creative themes, branding elements, gala dinners, and unique experiences tailored to your event objectives.'
        }
      ],
      color: 'bg-amber-600',
      image: '/pictures/our-services/img4.jpg',
      footer: 'Our event management solutions combine strategic planning, operational excellence, and local expertise to deliver impactful and memorable corporate events.'
    },
    {
      title: 'Travel Consultation & Advisory Services',
      icon: FaHeadset,
      description: 'GYF Holidays offers professional travel consultation and advisory services to help corporate clients, groups, and FIT travelers make informed and confident travel decisions. Our experienced consultants provide strategic insights on destinations, planning, budgets, and travel experiences to ensure every journey is well-planned, efficient, and rewarding.',
      details: 'With in-depth destination knowledge and industry expertise, we guide you through every stage of travel planning with clarity and precision.',
      features: [
        {
          title: 'Destination Recommendations',
          desc: 'Expert guidance on the most suitable destinations based on travel objectives, preferences, and budget.'
        },
        {
          title: 'Budget Planning & Cost Optimization',
          desc: 'Strategic budget planning to balance quality and cost, ensuring maximum value for your travel investment.'
        },
        {
          title: 'Best Time & Travel Season Advice',
          desc: 'Insights on ideal travel periods, weather conditions, peak seasons, and off-season advantages.'
        },
        {
          title: 'Cultural & Local Insights',
          desc: 'Practical knowledge of local culture, etiquette, experiences, and hidden gems to enrich your travel experience.'
        },
        {
          title: 'Travel Feasibility & Risk Awareness',
          desc: 'Assessment of travel practicality, logistical considerations, and potential challenges to ensure smooth planning.'
        }
      ],
      color: 'bg-rose-600',
      image: '/pictures/our-services/img5.jpg',
      footer: 'Our travel consultation services empower clients with expert knowledge and tailored guidance, ensuring smarter planning and exceptional travel experiences.'
    }
  ]

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: {
        staggerChildren: 0.2
      }
    }
  }

  const itemVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: {
      opacity: 1,
      y: 0,
      transition: {
        duration: 0.8,
        ease: "easeOut"
      }
    }
  }

  return (
    <div className="bg-[#fdffff] overflow-x-hidden">
      {/* Hero Section */}
      <Hero
        title="Our Services"
        subtitle="Global standards of quality, efficiency, and reliability in travel management"
        backgroundImage="/pictures/our-services/img-all.jpg"
        showCTA={false}
        height="h-[550px]"
      />

      {/* Intro Section with floating cards */}
      <section className="relative pt-12 pb-24 px-4 overflow-visible">
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
              <span>B2B Travel Excellence</span>
            </div>
            <h2 className="text-4xl md:text-6xl font-black text-gray-900 mb-8 leading-tight tracking-tight">
              Crafting <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-600">Legendary</span> Experiences
            </h2>
            <p className="text-xl text-gray-600 leading-relaxed font-medium max-w-3xl mx-auto">
              We provide high-precision land arrangement services tailored for B2B partners and corporations who demand nothing but the absolute best.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {[
              { title: 'Global Standards', desc: 'Efficiency and reliability at every touchpoint.', icon: FaGlobe },
              { title: 'Local Expertise', desc: 'Strong partnerships ensuring seamless execution.', icon: FaMapMarkedAlt },
              { title: '24/7 Support', desc: 'Round-the-clock assistance whenever you need it.', icon: FaHeadset }
            ].map((stat, idx) => (
              <motion.div
                key={idx}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: idx * 0.1 }}
                className="bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/50 hover:shadow-2xl transition-all group"
              >
                <div className="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <stat.icon className="text-primary-600 text-2xl" />
                </div>
                <h4 className="text-xl font-bold text-gray-900 mb-2">{stat.title}</h4>
                <p className="text-gray-600 leading-relaxed">{stat.desc}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Advanced Service Sections */}
      <section className="py-24 space-y-32">
        {mainServices.map((service, index) => (
          <div key={index} className="relative">
            {/* Background Accent */}
            <div className={`absolute top-1/2 -translate-y-1/2 ${index % 2 === 0 ? '-left-64' : '-right-64'} w-[800px] h-[800px] bg-gradient-to-br from-primary-50 to-indigo-50/20 rounded-full blur-3xl opacity-40 -z-10`}></div>

            <div className="container mx-auto px-4">
              <div className={`flex flex-col lg:flex-row gap-16 items-center ${index % 2 === 0 ? '' : 'lg:flex-row-reverse'}`}>
                {/* Visual Side */}
                <motion.div
                  initial={{ opacity: 0, x: index % 2 === 0 ? -50 : 50 }}
                  whileInView={{ opacity: 1, x: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.8 }}
                  className="w-full lg:w-1/2 relative"
                >
                  <div className="relative z-10">
                    <div className="absolute -inset-4 bg-gradient-to-tr from-primary-200/20 to-transparent blur-2xl -z-10 rounded-full"></div>
                    <div className="overflow-hidden rounded-[2.5rem] shadow-2xl relative aspect-[4/3] group">
                      <img
                        src={service.image}
                        alt={service.title}
                        className="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                      />
                      <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>

                      {/* Floating Glass Label */}
                      <div className="absolute top-8 left-8">
                        <div className="bg-white/10 backdrop-blur-xl border border-white/20 p-4 rounded-3xl shadow-2xl flex items-center space-x-4">
                          <div className={`${service.color} w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg ring-4 ring-white/10`}>
                            <service.icon className="text-xl" />
                          </div>
                          <div>
                            <p className="text-white/60 text-xs font-bold uppercase tracking-widest leading-none mb-1">Service Tier</p>
                            <p className="text-white font-bold leading-none">Premium Business</p>
                          </div>
                        </div>
                      </div>

                      <div className="absolute bottom-10 left-10">
                        <h3 className="text-white text-3xl font-black md:text-4xl drop-shadow-2xl leading-tight">
                          {service.title.split(' & ').map((part, i, arr) => (
                            <span key={i} className="block">
                              {part}{i < arr.length - 1 ? ' &' : ''}
                            </span>
                          ))}
                        </h3>
                      </div>
                    </div>
                  </div>

                  {/* Decorative Elements */}
                  <div className={`absolute -bottom-10 ${index % 2 === 0 ? '-right-10' : '-left-10'} w-40 h-40 bg-white shadow-2xl rounded-3xl p-6 hidden md:flex flex-col justify-end ring-1 ring-gray-100 z-20`}>
                    <p className="text-3xl font-black text-primary-600 mb-1 leading-none">0{index + 1}</p>
                    <p className="text-gray-400 font-bold uppercase text-[10px] tracking-widest leading-none">Step Forward</p>
                  </div>
                </motion.div>

                {/* Content Side */}
                <motion.div
                  initial={{ opacity: 0, x: index % 2 === 0 ? 50 : -50 }}
                  whileInView={{ opacity: 1, x: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.8 }}
                  className="w-full lg:w-1/2"
                >
                  <div className="inline-block bg-primary-50 text-primary-700 px-4 py-1.5 rounded-xl text-sm font-black mb-6 border border-primary-100/50 uppercase tracking-tighter">
                    Managed Excellence
                  </div>
                  <h3 className="text-4xl md:text-5xl font-black text-gray-900 mb-8 leading-[1.15] tracking-tight">
                    {service.title}
                  </h3>
                  <div className="relative pl-8 mb-10 border-l-4 border-primary-200">
                    <p className="text-lg text-gray-700 font-bold mb-4 leading-relaxed">
                      {service.description}
                    </p>
                    <p className="text-gray-500 italic text-sm leading-loose">
                      {service.details}
                    </p>
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                    {service.features.map((feature, idx) => (
                      <motion.div
                        key={idx}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all group"
                      >
                        <div className="flex items-center space-x-3 mb-3">
                          <div className="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0 group-hover:bg-green-500 transition-colors">
                            <FaCheckCircle className="text-green-500 text-sm group-hover:text-white transition-colors" />
                          </div>
                          <h4 className="font-black text-gray-900 leading-tight group-hover:text-primary-600 transition-colors">{feature.title}</h4>
                        </div>
                        <p className="text-xs text-gray-500 leading-relaxed font-medium">
                          {feature.desc}
                        </p>
                      </motion.div>
                    ))}
                  </div>

                  <div className="group relative bg-[#121212] p-8 rounded-[2rem] shadow-2xl overflow-hidden hover:scale-[1.02] transition-transform duration-500">
                    <div className="relative z-10 flex items-start space-x-6">
                      <div className="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center flex-shrink-0">
                        <FaMapMarkedAlt className="text-white text-xl" />
                      </div>
                      <p className="text-white/80 text-sm font-medium leading-relaxed italic">
                        {service.footer}
                      </p>
                    </div>
                    <div className="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 blur-3xl -z-0"></div>
                  </div>
                </motion.div>
              </div>
            </div>
          </div>
        ))}
      </section>

      {/* Stepper Section (Our Process) with stylized container */}
      <section className="py-32 relative">
        <div className="absolute inset-0 bg-gray-50 skew-y-3 origin-right -z-10 shadow-inner"></div>
        <div className="container mx-auto px-4">
          <div className="text-center mb-24">
            <div className="inline-block bg-white text-gray-400 px-6 py-2 rounded-2xl shadow-sm text-xs font-black uppercase tracking-[0.2em] mb-8 border border-gray-100">
              Operational Workflow
            </div>
            <h2 className="text-4xl md:text-7xl font-black text-gray-900 mb-8 tracking-tighter leading-none">
              How We Create <span className="text-primary-600">Impact</span>
            </h2>
            <p className="text-xl text-gray-500 max-w-2xl mx-auto font-medium leading-relaxed italic">
              Our systematic B2B approach ensures every journey is executed with mathematical precision and artistic care.
            </p>
          </div>
          <div className="bg-white p-12 md:p-20 rounded-[4rem] shadow-3xl border border-gray-100 relative">
            <div className="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-primary-600 rounded-[2rem] shadow-xl flex items-center justify-center ring-[12px] ring-gray-50">
              <FaArrowRight className="text-white text-2xl -rotate-90 md:rotate-0" />
            </div>
            <Process />
          </div>
        </div>
      </section>

      {/* Modern CTA with overlapping design */}
      <section className="py-24 px-4 overflow-visible">
        <div className="container mx-auto max-w-6xl">
          <motion.div
            initial={{ opacity: 0, scale: 0.95 }}
            whileInView={{ opacity: 1, scale: 1 }}
            viewport={{ once: true }}
            className="relative bg-[#0a0a0a] rounded-[3.5rem] p-12 md:p-24 overflow-hidden border border-white/5 group shadow-3xl"
          >
            {/* Animated Background Gradients */}
            <div className="absolute -top-24 -right-24 w-[500px] h-[500px] bg-primary-600/20 blur-[100px] animate-pulse"></div>
            <div className="absolute -bottom-24 -left-24 w-[400px] h-[400px] bg-indigo-600/20 blur-[100px] animate-pulse" style={{ animationDelay: '2s' }}></div>

            <div className="relative z-10 text-center flex flex-col items-center">
              <div className="w-16 h-16 bg-white/5 backdrop-blur-3xl rounded-3xl flex items-center justify-center mb-10 border border-white/10 ring-1 ring-white/5">
                <FaPlane className="text-white text-2xl" />
              </div>
              <h2 className="text-4xl md:text-7xl font-black text-white mb-10 tracking-tighter leading-none">
                Elevate Your <span className="underline decoration-primary-500 decoration-8 underline-offset-8">Standard</span>
              </h2>
              <p className="text-white/60 text-xl mb-14 max-w-2xl font-medium leading-relaxed italic">
                Ready to redefine travel excellence? Let's engineer the perfect partnership for your organization.
              </p>

              <div className="flex flex-col sm:flex-row gap-8 w-full max-w-md">
                <Link
                  to="/contact"
                  className="flex-1 px-10 py-6 bg-white text-gray-950 rounded-2xl font-black text-lg hover:bg-white/90 transform active:scale-95 transition-all shadow-2xl flex items-center justify-center group"
                >
                  Start Inquiry
                  <FaArrowRight className="ml-3 group-hover:translate-x-1 transition-transform" />
                </Link>
                <a
                  href="https://wa.me/91XXXXXXXXXX"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex-1 px-10 py-6 bg-primary-600 text-white rounded-2xl font-black text-lg hover:bg-primary-700 transform active:scale-95 transition-all shadow-2xl flex items-center justify-center group"
                >
                  WhatsApp
                  <FaArrowRight className="ml-3 group-hover:translate-x-1 transition-transform" />
                </a>
              </div>
            </div>

            {/* Minimal Background Pattern */}
            <div className="absolute inset-0 opacity-[0.03] pointer-events-none" style={{ backgroundImage: 'radial-gradient(circle, #fff 1px, transparent 1px)', backgroundSize: '40px 40px' }}></div>
          </motion.div>
        </div>
      </section>
    </div>
  )
}

export default Services
