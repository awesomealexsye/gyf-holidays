<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $destinationGuides = BlogCategory::updateOrCreate(
            ['slug' => 'destination-guides'],
            [
                'name' => 'Destination Guides',
                'description' => 'In-depth travel guides covering top destinations across Europe, Scandinavia, and the UK for B2B travel agents.',
                'meta_title' => 'Destination Guides for Travel Agents - GYF Holidays Blog',
                'meta_description' => 'Expert destination guides for travel agents. Explore Europe, Scandinavia, and UK travel tips, itineraries, and insider knowledge from GYF Holidays.',
            ]
        );

        $travelTips = BlogCategory::updateOrCreate(
            ['slug' => 'travel-tips'],
            [
                'name' => 'Travel Tips',
                'description' => 'Practical travel tips and industry insights for B2B travel agents and tour operators.',
                'meta_title' => 'B2B Travel Tips & Industry Insights - GYF Holidays Blog',
                'meta_description' => 'Practical travel tips and B2B industry insights for travel agents. Boost your business with expert advice from GYF Holidays.',
            ]
        );

        // Create Tags
        $tags = [];
        $tagData = [
            'europe-tours' => 'Europe Tours',
            'scandinavia' => 'Scandinavia',
            'b2b-travel' => 'B2B Travel',
            'group-tours' => 'Group Tours',
            'travel-planning' => 'Travel Planning',
            'northern-lights' => 'Northern Lights',
            'budget-travel' => 'Budget Travel',
            'visa-tips' => 'Visa Tips',
        ];

        foreach ($tagData as $slug => $name) {
            $tags[$slug] = BlogTag::updateOrCreate(['slug' => $slug], ['name' => $name]);
        }

        // Blog Post 1: Europe Travel Guide
        $blog1 = Blog::updateOrCreate(
            ['slug' => 'ultimate-europe-tour-packages-guide-for-indian-travel-agents-2026'],
            [
                'title' => 'Ultimate Europe Tour Packages Guide for Indian Travel Agents in 2026',
                'excerpt' => 'A comprehensive guide for Indian travel agents on selling Europe tour packages in 2026. Covers top destinations, pricing strategies, visa updates, and how to partner with a reliable B2B DMC for maximum margins.',
                'content' => $this->getBlog1Content(),
                'featured_image' => 'blogs/featured/europe-travel-guide-2026.jpg',
                'blog_category_id' => $destinationGuides->id,
                'author_name' => 'GYF Holidays',
                'meta_title' => 'Europe Tour Packages Guide for Indian Travel Agents 2026 | GYF Holidays',
                'meta_description' => 'Complete guide for Indian travel agents selling Europe tour packages in 2026. Top destinations, B2B DMC pricing, Schengen visa tips, and itinerary ideas from GYF Holidays.',
                'meta_keywords' => 'Europe tour packages India, B2B DMC Europe, Europe travel agent guide, Schengen visa 2026, Europe group tours from India, GYF Holidays Europe',
                'faqs' => [
                    [
                        'question' => 'What are the most popular Europe tour packages from India in 2026?',
                        'answer' => 'The most popular packages include the 10-day Western Europe circuit (Paris, Switzerland, Amsterdam), 7-day Italy special (Rome, Florence, Venice), and the 12-day comprehensive Europe tour covering 6 countries. Scandinavia and UK packages are also gaining traction among Indian travellers.',
                    ],
                    [
                        'question' => 'How can Indian travel agents get the best B2B rates for Europe tours?',
                        'answer' => 'Partner with an established B2B DMC like GYF Holidays that offers wholesale rates on hotels, transfers, and sightseeing. Volume commitments, early booking advantages, and seasonal promotions can further reduce your costs and improve margins.',
                    ],
                    [
                        'question' => 'What is the Schengen visa process for Indian tourists visiting Europe in 2026?',
                        'answer' => 'Indian tourists need a Schengen visa to visit 27 European countries. The process includes submitting an application at the VFS centre, providing travel insurance, confirmed hotel bookings, flight itinerary, bank statements for 3 months, and a cover letter. Processing typically takes 15-20 working days.',
                    ],
                    [
                        'question' => 'What is the best time to sell Europe tour packages from India?',
                        'answer' => 'The peak booking season for Europe tours from India is January to April for summer travel (May–September). Winter packages for Christmas markets (November–December) should be promoted from July onwards. Shoulder seasons (April–May, September–October) offer better rates for budget-conscious clients.',
                    ],
                    [
                        'question' => 'Does GYF Holidays provide marketing support to travel agent partners?',
                        'answer' => 'Yes, GYF Holidays provides comprehensive marketing support including co-branded brochures, social media content, product training webinars, and destination familiarization trips for agent partners across India.',
                    ],
                ],
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'is_active' => true,
            ]
        );

        $blog1->tags()->sync([
            $tags['europe-tours']->id,
            $tags['b2b-travel']->id,
            $tags['group-tours']->id,
            $tags['visa-tips']->id,
            $tags['travel-planning']->id,
        ]);

        // Blog Post 2: Scandinavia Northern Lights
        $blog2 = Blog::updateOrCreate(
            ['slug' => 'scandinavia-northern-lights-tour-packages-b2b-guide-for-travel-agents'],
            [
                'title' => 'Scandinavia Northern Lights Tour Packages: A B2B Guide for Travel Agents',
                'excerpt' => 'Everything Indian travel agents need to know about selling Scandinavia Northern Lights packages. Covers Norway, Sweden, Finland, and Iceland itineraries, best seasons, pricing, and how to differentiate your offerings in a growing market.',
                'content' => $this->getBlog2Content(),
                'featured_image' => 'blogs/featured/scandinavia-northern-lights-tours.jpg',
                'blog_category_id' => $destinationGuides->id,
                'author_name' => 'GYF Holidays',
                'meta_title' => 'Scandinavia Northern Lights Tour Packages for Travel Agents | B2B Guide 2026',
                'meta_description' => 'B2B guide for travel agents selling Scandinavia Northern Lights tours. Norway, Sweden, Finland itineraries, best season, pricing strategies, and DMC partnerships from GYF Holidays.',
                'meta_keywords' => 'Scandinavia tour packages, Northern Lights tours India, B2B Scandinavia DMC, Norway tours for Indian travellers, Finland Northern Lights, GYF Holidays Scandinavia',
                'faqs' => [
                    [
                        'question' => 'When is the best time to see the Northern Lights in Scandinavia?',
                        'answer' => 'The best time to see the Northern Lights is from September to March, with peak visibility between November and February. The aurora is visible in northern Norway (Tromsø), Swedish Lapland (Abisko), Finnish Lapland (Rovaniemi), and Iceland. Clear, dark skies away from city lights offer the best viewing conditions.',
                    ],
                    [
                        'question' => 'What should a Scandinavia Northern Lights package include?',
                        'answer' => 'A complete Northern Lights package should include aurora hunting excursions with expert guides, warm clothing rental, husky or reindeer sledding, ice hotel visits, Finnish sauna experience, and comfortable accommodation in glass igloos or wilderness lodges. Transfers and domestic flights between cities are essential.',
                    ],
                    [
                        'question' => 'How much does a Scandinavia Northern Lights tour cost for Indian travellers?',
                        'answer' => 'A 7-night Scandinavia Northern Lights package typically ranges from INR 1,50,000 to INR 3,50,000 per person depending on accommodation category, activities included, and countries covered. B2B agents partnering with GYF Holidays get wholesale rates with 15-25% margins.',
                    ],
                    [
                        'question' => 'Do Indian tourists need a separate visa for each Scandinavian country?',
                        'answer' => 'No. Norway, Sweden, Finland, and Denmark are all Schengen zone countries, so a single Schengen visa covers all four. Iceland is also part of the Schengen area. Apply for the visa at the consulate of the country where you spend the most nights.',
                    ],
                    [
                        'question' => 'Why is Scandinavia becoming popular among Indian travellers?',
                        'answer' => 'Scandinavia is trending due to Northern Lights bucket-list appeal, unique experiences like ice hotels and midnight sun, Bollywood filming locations in Switzerland alternatives, safe travel environment, and increasing direct/connecting flight options from India. Social media has also driven massive awareness among younger Indian travellers.',
                    ],
                ],
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'is_active' => true,
            ]
        );

        $blog2->tags()->sync([
            $tags['scandinavia']->id,
            $tags['northern-lights']->id,
            $tags['b2b-travel']->id,
            $tags['group-tours']->id,
            $tags['travel-planning']->id,
        ]);
    }

    private function getBlog1Content(): string
    {
        return <<<'HTML'
<h2>Why Europe Remains the #1 Destination for Indian Outbound Travellers</h2>
<p>Europe continues to dominate the outbound travel market from India, with over 2.5 million Indian tourists visiting European countries annually. For travel agents, Europe tour packages represent the highest-margin product category in the B2B travel space. The combination of iconic landmarks, diverse cultures, world-class cuisine, and shopping destinations makes Europe an evergreen seller.</p>
<p>As a B2B travel agent in India, understanding the latest trends, popular routes, and pricing strategies for 2026 can significantly boost your revenue. This guide covers everything you need to know — from the most in-demand itineraries to how partnering with a reliable DMC like GYF Holidays can transform your Europe business.</p>

<h2>Top Europe Tour Itineraries That Sell in 2026</h2>
<h3>1. The Classic Western Europe Circuit (10 Days)</h3>
<p>This remains the bestselling Europe package from India. The itinerary typically covers Paris (2 nights), Swiss Alps — Interlaken/Lucerne (2 nights), Amsterdam (1 night), Brussels (1 night), and a Rhine Valley cruise. Indian families and honeymooners consistently choose this route for its iconic photo spots — the Eiffel Tower, Jungfraujoch, and Keukenhof Gardens.</p>
<p><strong>B2B pricing tip:</strong> Source hotels in zones 2-3 of Paris and use Swiss rail passes for internal transfers to keep costs down while maintaining quality. GYF Holidays offers pre-negotiated rates at 200+ European hotels with guaranteed allotments during peak season.</p>

<h3>2. Italy Explorer (7 Days)</h3>
<p>Italy packages are growing at 30% year-on-year from the Indian market. A typical itinerary covers Rome (2 nights), Florence (1 night), Venice (1 night), and Milan (1 night). Vegetarian food availability and Bollywood connections (DDLJ Switzerland-Italy nostalgia) drive Indian demand.</p>
<p><strong>Pro tip for agents:</strong> Add a Tuscany wine country day trip and a Murano island visit in Venice for premium upsell. These additions cost minimal per person but allow you to charge INR 15,000-20,000 more per traveller.</p>

<h3>3. UK + Scotland Highlights (8 Days)</h3>
<p>Post-Brexit visa changes have made UK a separate destination requiring its own visa, but demand remains strong. London (3 nights), Edinburgh (2 nights), and the Scottish Highlands (1 night) form the core itinerary. Harry Potter studio tours and Premier League match packages are hot add-ons for the Indian market.</p>

<h2>Schengen Visa Updates for Indian Travellers in 2026</h2>
<p>The Schengen visa landscape has evolved significantly. Here are the key updates that every Indian travel agent should communicate to clients:</p>
<ul>
<li><strong>Digital visa applications:</strong> Several consulates now accept online applications, reducing VFS centre wait times</li>
<li><strong>Processing times:</strong> Standard processing is 15-20 working days. Advise clients to apply at least 6-8 weeks before travel</li>
<li><strong>Multi-entry visas:</strong> Frequent travellers with clean visa history are increasingly receiving 2-3 year multi-entry Schengen visas</li>
<li><strong>Travel insurance requirement:</strong> Minimum EUR 30,000 coverage with COVID provisions is mandatory</li>
<li><strong>Financial proof:</strong> Bank statements showing minimum INR 5,00,000 balance for the past 3 months are recommended</li>
</ul>

<h2>B2B Pricing Strategy: How to Maximize Your Margins</h2>
<p>The key to profitable Europe tour packages lies in your sourcing strategy. Here's how top-performing Indian travel agents are structuring their B2B relationships:</p>
<h3>Direct DMC Partnership vs OTA Aggregators</h3>
<p>Working directly with a B2B DMC like GYF Holidays offers 20-35% better rates compared to booking through OTA platforms. Direct partnerships provide flexibility in customization, dedicated support, and volume-based discounts that are impossible to get through aggregators.</p>
<p>With GYF Holidays, travel agents across Delhi, Mumbai, Bangalore, Chennai, Kolkata, and Hyderabad get access to wholesale rates on 150+ European destinations, dedicated account managers, and 24/7 on-ground support across Europe.</p>

<h3>Seasonal Pricing Calendar</h3>
<p>Understanding Europe's pricing seasons is critical for margin optimization:</p>
<ul>
<li><strong>Peak (June–August):</strong> Highest hotel rates, 40-60% markup over base rates. Book 4-6 months in advance</li>
<li><strong>Shoulder (April–May, September–October):</strong> Best value. Rates are 20-30% lower than peak with excellent weather</li>
<li><strong>Winter (November–March):</strong> Lowest rates except during Christmas markets (December) and New Year</li>
</ul>

<h2>What Indian Travellers Want in a Europe Package in 2026</h2>
<p>Understanding your end customer's expectations helps you design packages that sell faster:</p>
<ul>
<li><strong>Vegetarian and Jain food options:</strong> Always include Indian restaurants or vegetarian meal plans. This is the #1 concern for Indian families</li>
<li><strong>Shopping time:</strong> Dedicated shopping hours at outlet malls (La Vallée Village Paris, Foxtown Switzerland) are essential</li>
<li><strong>Photo opportunities:</strong> Itineraries should include Instagram-worthy spots — lavender fields, Swiss meadows, Amsterdam canals</li>
<li><strong>Comfortable coaches:</strong> 35-50 seater luxury coaches with AC and WiFi for group movements. GYF Holidays maintains its own fleet across Europe</li>
<li><strong>Hindi/English-speaking guides:</strong> Increasingly requested by families. GYF Holidays can arrange multilingual guides in all major cities</li>
</ul>

<h2>How GYF Holidays Helps Travel Agents Sell More Europe Packages</h2>
<p>As one of India's leading B2B DMCs for Europe, GYF Holidays offers a complete ecosystem for travel agents:</p>
<ul>
<li><strong>Competitive wholesale rates</strong> with guaranteed hotel allotments during peak season</li>
<li><strong>Customizable itineraries</strong> — modify any package to match your client's budget and preferences</li>
<li><strong>24/7 on-ground support</strong> across all European destinations with emergency assistance</li>
<li><strong>Marketing support</strong> including co-branded brochures and social media content</li>
<li><strong>Training and familiarization trips</strong> for agent partners</li>
<li><strong>Flexible payment terms</strong> and dedicated account managers for each city</li>
</ul>
<p>Whether you're a travel agent in Delhi, Mumbai, Chennai, Bangalore, Kolkata, or any other Indian city, GYF Holidays provides the infrastructure and rates you need to grow your Europe tour business profitably.</p>
HTML;
    }

    private function getBlog2Content(): string
    {
        return <<<'HTML'
<h2>Why Scandinavia is the Hottest New Destination for Indian Travellers</h2>
<p>Scandinavia has emerged as one of the fastest-growing outbound destinations from India, with a 45% increase in Indian arrivals over the past two years. The Northern Lights phenomenon — one of nature's most spectacular displays — is the primary driver, but the region offers far more: midnight sun experiences, ice hotels, Viking heritage, pristine fjords, and some of the world's most unique wildlife encounters.</p>
<p>For B2B travel agents in India, Scandinavia represents a premium, high-margin product. Average per-person spend on Scandinavia packages is 40-60% higher than standard Europe circuits, making it one of the most profitable destination categories you can sell. This guide gives you everything you need to build a successful Scandinavia portfolio.</p>

<h2>Understanding the Scandinavia Market: Countries and Highlights</h2>
<h3>Norway — The Fjord Capital</h3>
<p>Norway is the crown jewel of Scandinavian tourism. Key attractions include the Northern Lights in Tromsø, the dramatic fjords of Bergen and Geiranger, the Arctic Cathedral, and the charming Lofoten Islands. The Norway in a Nutshell scenic train journey is a must-include in every itinerary. Oslo's Viking Ship Museum and the brand-new Munch Museum add cultural depth.</p>
<p><strong>Agent tip:</strong> The Tromsø-based Northern Lights chase excursion has a 90% success rate between November and February. Guarantee this activity in your packages — it's the single biggest selling point.</p>

<h3>Finland — Land of Santa and Saunas</h3>
<p>Finland appeals strongly to Indian families, thanks to the Santa Claus Village in Rovaniemi — one of the most Instagrammed locations by Indian travellers in Scandinavia. Beyond Santa, Finnish Lapland offers glass igloo accommodations where guests can watch the Northern Lights from bed, husky and reindeer safaris, ice fishing, and the authentic Finnish sauna experience.</p>
<p><strong>Package design tip:</strong> A 3-night Rovaniemi add-on to a standard Europe package works brilliantly. Glass igloo stays (Arctic SnowHotel, Kakslauttanen) command premium pricing — up to EUR 500 per night — but clients are willing to pay for this bucket-list experience.</p>

<h3>Sweden — Design, Nature, and the Ice Hotel</h3>
<p>Sweden offers a unique blend of cosmopolitan Stockholm, the original ICEHOTEL in Jukkasjärvi (rebuilt every winter from ice blocks of the Torne River), and the Northern Lights viewing hub of Abisko. The Swedish Lapland region is considered one of the world's most reliable Northern Lights viewing locations due to the unique microclimate around Lake Torneträsk.</p>

<h3>Iceland — Fire and Ice</h3>
<p>Though technically not part of Scandinavia, Iceland is increasingly bundled with Scandinavian packages. The Blue Lagoon, Golden Circle, glacier walks, and whale watching create an unforgettable combination. Reykjavik also serves as a convenient stopover on routes between India and North America.</p>

<h2>Best Scandinavia Northern Lights Itineraries for Indian Clients</h2>
<h3>7-Night Classic Northern Lights (Norway + Finland)</h3>
<p>This is the bestselling Scandinavia itinerary from India:</p>
<ul>
<li><strong>Day 1-2:</strong> Oslo — city tour, Viking Ship Museum, Holmenkollen Ski Jump, Karl Johans Gate</li>
<li><strong>Day 3-4:</strong> Tromsø — Northern Lights chase, Arctic Cathedral, cable car ride, Polaria aquarium</li>
<li><strong>Day 5-6:</strong> Rovaniemi — Santa Claus Village, glass igloo stay, husky safari, reindeer sleigh ride</li>
<li><strong>Day 7:</strong> Helsinki — Senate Square, Suomenlinna fortress, Finnish sauna, departure</li>
</ul>
<p><strong>B2B pricing:</strong> This package ranges from INR 1,80,000 to INR 2,80,000 per person (twin sharing) depending on hotel category and season. GYF Holidays offers this complete ground package including all transfers, activities, and 4-star accommodation.</p>

<h3>10-Night Premium Scandinavia Experience (Norway + Sweden + Finland)</h3>
<p>For premium clients, this extended itinerary adds the ICEHOTEL experience and the scenic Abisko region of Sweden. This commands INR 3,00,000 to INR 4,50,000 per person and delivers exceptional margins for agents.</p>

<h2>Seasonal Guide: When to Sell Scandinavia Packages</h2>
<p>Timing is everything in the Scandinavia business. Here's your annual planning calendar:</p>
<ul>
<li><strong>September–March (Northern Lights season):</strong> Primary selling season. Start promoting in June-July for winter travel. The Northern Lights are visible across all Scandinavian countries above the Arctic Circle</li>
<li><strong>June–August (Midnight Sun season):</strong> A growing market. The midnight sun — where the sun never sets — is a unique experience that appeals to adventure travellers. Fjord cruises, hiking, and wildlife tours peak during these months</li>
<li><strong>December (Christmas special):</strong> Santa Claus Village in Rovaniemi sees huge Indian family demand. Book 6+ months in advance as glass igloos sell out quickly</li>
<li><strong>Shoulder months (April, October):</strong> Lower rates with chances of seeing Northern Lights in October. April brings spring colours and fewer tourists</li>
</ul>

<h2>Practical Tips for Selling Scandinavia to Indian Clients</h2>
<h3>Food and Dietary Requirements</h3>
<p>Unlike Western Europe, Indian restaurants are less common in Scandinavia. However, Scandinavian cuisine is naturally rich in vegetarian options — potatoes, bread, dairy, berries, and salads. Most hotels offer buffet breakfasts with vegetarian choices. For lunch and dinner, advise clients to try local vegetarian options and pack some ready-to-eat Indian meals as backup.</p>

<h3>Weather and Clothing</h3>
<p>Winter temperatures in Northern Scandinavia drop to -20°C to -30°C. Recommend clients invest in proper thermal layers, insulated waterproof jackets, snow boots, and hand warmers. Most Northern Lights tour operators provide thermal suits, but personal base layers are essential.</p>

<h3>Currency and Costs</h3>
<p>Norway, Sweden, and Iceland use their own currencies (NOK, SEK, ISK), while Finland uses the Euro. Scandinavia is expensive — daily budgets should account for INR 8,000-15,000 per person for meals and incidentals. Card payments are accepted almost everywhere, reducing the need for cash.</p>

<h2>Why Partner with GYF Holidays for Scandinavia Packages</h2>
<p>GYF Holidays is one of the few Indian B2B DMCs with dedicated Scandinavia expertise and on-ground partnerships across Norway, Sweden, Finland, and Iceland. Here's what we offer travel agents:</p>
<ul>
<li><strong>Pre-negotiated rates</strong> at premium properties including glass igloos, ice hotels, and Arctic lodges</li>
<li><strong>Guaranteed Northern Lights excursions</strong> with backup dates in case of poor weather</li>
<li><strong>Complete ground handling</strong> — airport transfers, inter-city trains/flights, activity bookings, and English-speaking guides</li>
<li><strong>Flexible packaging</strong> — combine Scandinavia with Western Europe or UK for extended itineraries</li>
<li><strong>Competitive B2B margins</strong> of 15-25% on all Scandinavia packages</li>
<li><strong>24/7 emergency support</strong> across all Scandinavian destinations</li>
</ul>
<p>Whether your clients are honeymooners chasing the Northern Lights, families visiting Santa Claus, or luxury travellers seeking the ICEHOTEL experience, GYF Holidays provides the complete B2B infrastructure to make Scandinavia your most profitable destination category.</p>
<p>Contact our Scandinavia specialists today to get customized itineraries and B2B rates for your next client inquiry.</p>
HTML;
    }
}
