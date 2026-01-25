import { Link } from 'react-router-dom'
import { FaFacebookF, FaInstagram, FaYoutube, FaPhone, FaEnvelope, FaMapMarkerAlt } from 'react-icons/fa'
import config from '../config'

const Footer = () => {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="bg-gray-900 text-gray-300">
      {/* Main Footer */}
      <div className="container mx-auto px-4 py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div>
            <div className="mb-4">
              <h3 className="text-2xl font-bold">
                <span className="text-primary-400">GYF</span>
                <span className="text-secondary-400"> Holidays</span>
              </h3>
            </div>
            <p className="text-gray-400 mb-4">
              {config.company.description}
            </p>
            <div className="flex space-x-3">
              <a
                href={config.social.facebook}
                target="_blank"
                rel="noopener noreferrer"
                className="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary-600 transition"
                aria-label="Facebook"
              >
                <FaFacebookF />
              </a>
              <a
                href={config.social.instagram}
                target="_blank"
                rel="noopener noreferrer"
                className="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary-600 transition"
                aria-label="Instagram"
              >
                <FaInstagram />
              </a>
              <a
                href={config.social.youtube}
                target="_blank"
                rel="noopener noreferrer"
                className="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary-600 transition"
                aria-label="YouTube"
              >
                <FaYoutube />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-white font-semibold text-lg mb-4">Quick Links</h4>
            <ul className="space-y-2">
              <li>
                <Link to="/" className="hover:text-primary-400 transition">Home</Link>
              </li>
              <li>
                <Link to="/about" className="hover:text-primary-400 transition">About Us</Link>
              </li>
              <li>
                <Link to="/services" className="hover:text-primary-400 transition">Services</Link>
              </li>
              <li>
                <Link to="/destinations" className="hover:text-primary-400 transition">Destinations</Link>
              </li>

              <li>
                <Link to="/contact" className="hover:text-primary-400 transition">Contact Us</Link>
              </li>
            </ul>
          </div>

          {/* Services */}
          <div>
            <h4 className="text-white font-semibold text-lg mb-4">Our Services</h4>
            <ul className="space-y-2">
              <li className="hover:text-primary-400 transition">Corporate Travel</li>
              <li className="hover:text-primary-400 transition">Group Bookings</li>
              <li className="hover:text-primary-400 transition">Customized Packages</li>
              <li className="hover:text-primary-400 transition">Event Management</li>
              <li className="hover:text-primary-400 transition">Travel Consultation</li>
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h4 className="text-white font-semibold text-lg mb-4">Contact Us</h4>
            <ul className="space-y-3">
              <li className="flex items-start space-x-3">
                <FaMapMarkerAlt className="text-primary-400 mt-1 flex-shrink-0" />
                <span>
                  {config.contact.address.street}, {config.contact.address.city}, {config.contact.address.state} {config.contact.address.zip}
                </span>
              </li>
              <li className="flex items-center space-x-3">
                <FaPhone className="text-primary-400 flex-shrink-0" />
                <a href={`tel:${config.contact.phone}`} className="hover:text-primary-400 transition">
                  {config.contact.phone}
                </a>
              </li>
              <li className="flex items-center space-x-3">
                <FaEnvelope className="text-primary-400 flex-shrink-0" />
                <a href={`mailto:${config.contact.email}`} className="hover:text-primary-400 transition">
                  {config.contact.email}
                </a>
              </li>
            </ul>
            <div className="mt-4">
              <h5 className="text-white font-semibold mb-2">Business Hours</h5>
              <p className="text-sm text-gray-400">{config.businessHours.weekdays}</p>
              <p className="text-sm text-gray-400">{config.businessHours.sunday}</p>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Footer */}
      <div className="border-t border-gray-800">
        <div className="container mx-auto px-4 py-6">
          <div className="flex flex-col md:flex-row justify-between items-center">
            <p className="text-gray-400 text-sm">
              &copy; 2025 GYF PLANNERS PVT LTD. All rights reserved.
            </p>
            <div className="flex space-x-6 mt-4 md:mt-0">
              <Link to="/privacy" className="text-gray-400 hover:text-primary-400 text-sm transition">
                Privacy Policy
              </Link>
              <Link to="/terms" className="text-gray-400 hover:text-primary-400 text-sm transition">
                Terms & Conditions
              </Link>
            </div>
          </div>
        </div>
      </div>
    </footer>
  )
}

export default Footer

