import { motion } from "framer-motion";
import {
  FaEye,
  FaBullseye,
  FaHeart,
  FaUsers,
  FaGlobe,
  FaAward,
  FaHandshake,
  FaShieldAlt,
} from "react-icons/fa";
import Hero from "../components/Hero";
import config from "../config";

const AboutUs = () => {
  const values = [
    {
      icon: FaHeart,
      title: "Customer First",
      description:
        "Your satisfaction is our top priority. We go above and beyond to exceed expectations.",
    },
    {
      icon: FaShieldAlt,
      title: "Trust & Reliability",
      description:
        "Building lasting relationships through honest, transparent, and dependable service.",
    },
    {
      icon: FaAward,
      title: "Excellence",
      description:
        "Commitment to delivering the highest quality in every aspect of our service.",
    },
    {
      icon: FaGlobe,
      title: "Innovation",
      description:
        "Continuously evolving to bring you the best travel solutions and experiences.",
    },
  ];

  const milestones = [
    {
      year: "2015",
      title: "Founded",
      description:
        "GYF Holidays established with a vision to revolutionize B2B travel",
    },
    {
      year: "2017",
      title: "Expansion",
      description: "Expanded to 50+ destinations across Asia and Europe",
    },
    {
      year: "2019",
      title: "Recognition",
      description:
        'Awarded "Best B2B Travel Partner" by Travel Industry Council',
    },
    {
      year: "2021",
      title: "Digital Transformation",
      description:
        "Launched advanced booking platform for seamless experiences",
    },
    {
      year: "2025",
      title: "Global Leader",
      description:
        "Serving 5000+ businesses across 150+ destinations worldwide",
    },
  ];

  const team = [
    {
      name: "Sunil Kapoor",
      position: "Founder & CEO",
      image:
        "https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&auto=format&fit=crop&q=80",
    },
    {
      name: "Priya Mehta",
      position: "Head of Operations",
      image:
        "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80",
    },
    {
      name: "Rahul Singh",
      position: "Business Development",
      image:
        "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&auto=format&fit=crop&q=80",
    },
    {
      name: "Anita Sharma",
      position: "Client Relations",
      image:
        "https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&auto=format&fit=crop&q=80",
    },
  ];

  const benefits = [
    {
      icon: FaHandshake,
      title: "Dedicated Account Manager",
      description:
        "Personalized support from a dedicated professional who understands your business needs.",
    },
    {
      icon: FaAward,
      title: "Competitive Pricing",
      description:
        "Exclusive B2B rates and volume discounts that maximize your profit margins.",
    },
    {
      icon: FaUsers,
      title: "Priority Service",
      description:
        "Fast-track processing and priority assistance for all your bookings and queries.",
    },
    {
      icon: FaGlobe,
      title: "Global Network",
      description:
        "Access to our worldwide network of hotels, airlines, and local partners.",
    },
  ];

  return (
    <div>
      {/* Hero Section */}
      <Hero
        title="About GYF Holidays"
        subtitle="GYF PLANNERS PVT LTD - Your Trusted Partner in Creating Unforgettable Travel Experiences"
        backgroundImage="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&auto=format&fit=crop&q=80"
        showCTA={false}
        height="h-[400px]"
      />

      {/* Company Story */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Our Story
              </h2>
              <p className="text-gray-600 mb-4">
                Every great journey begins with a vision. At GYF Holidays, our
                journey began with a simple idea — to create a reliable and
                professional destination management partner that travel
                businesses can truly depend on.
              </p>
              <p className="text-gray-600 mb-4">
                What started as a small team with deep knowledge of European
                destinations has grown into a trusted B2B travel solutions
                provider, supporting travel agencies, tour operators, and
                corporate clients with seamless ground services and customized
                travel experiences.
              </p>
              <p className="text-gray-600 mb-4">
                Over the years, we have developed strong partnerships with
                hotels, local service providers, and on-ground experts across
                Europe, the UK, and Scandinavia. These relationships allow us to
                deliver consistent quality, competitive pricing, and smooth
                operations for FIT, group, and corporate travel.
              </p>
              <p className="text-gray-600 mb-4">
                We believe that successful travel experiences are built on
                precision, transparency, and local expertise. That's why every
                itinerary we design is carefully curated, every service is
                thoughtfully selected, and every partner relationship is built
                on trust.
              </p>
              <p className="text-gray-600">
                Today, GYF Holidays stands as a growing destination management
                company, empowering travel businesses with dependable solutions,
                personalized support, and memorable travel experiences across
                multiple international destinations. Our story continues with
                every partner we serve and every journey we help create.
              </p>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, x: 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
              className="relative"
            >
              <img
                src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=800&auto=format&fit=crop&q=80"
                alt="Our Story"
                className="rounded-2xl shadow-2xl"
              />
            </motion.div>
          </div>
        </div>
      </section>

      {/* Mission & Vision */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              className="bg-white rounded-2xl p-8 shadow-lg"
            >
              <div className="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
                <FaBullseye className="text-primary-600 text-3xl" />
              </div>
              <h3 className="text-2xl font-bold text-gray-900 mb-4">
                Our Mission
              </h3>
              <p className="text-gray-600">
                To empower businesses with exceptional travel solutions that
                combine quality, value, and personalized service. We strive to
                make every journey seamless, memorable, and perfectly aligned
                with our partners' business objectives.
              </p>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: 0.2 }}
              className="bg-white rounded-2xl p-8 shadow-lg"
            >
              <div className="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mb-6">
                <FaEye className="text-secondary-600 text-3xl" />
              </div>
              <h3 className="text-2xl font-bold text-gray-900 mb-4">
                Our Vision
              </h3>
              <p className="text-gray-600">
                To be the most trusted and innovative B2B travel partner
                globally, recognized for creating extraordinary experiences,
                fostering lasting relationships, and contributing to the success
                of businesses worldwide.
              </p>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Our Values */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Our Core Values
            </h2>
            <p className="text-gray-600 max-w-2xl mx-auto">
              The principles that guide everything we do
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {values.map((value, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="bg-white rounded-xl p-6 shadow-lg text-center hover:shadow-2xl transition-shadow"
              >
                <div className="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <value.icon className="text-primary-600 text-2xl" />
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-3">
                  {value.title}
                </h3>
                <p className="text-gray-600">{value.description}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* B2B Benefits */}
      <section className="py-20 gradient-hero">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
              Partner Benefits
            </h2>
            <p className="text-white/90 max-w-2xl mx-auto">
              Why businesses choose to partner with GYF Holidays
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {benefits.map((benefit, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                className="glass rounded-xl p-6 text-center text-white"
              >
                <div className="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                  <benefit.icon className="text-3xl" />
                </div>
                <h3 className="text-xl font-bold mb-3">{benefit.title}</h3>
                <p className="text-white/80">{benefit.description}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
};

export default AboutUs;
