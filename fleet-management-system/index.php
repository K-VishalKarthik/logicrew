<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet Management | Home</title>

    <!-- Google Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Global Styles */
        /* Hero Section */
/* Box Styling for 10,000+ Vehicles Managed */
.vehicles-managed-box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Added transition for hover effect */
    margin: 20px;
}

/* Hover Effect for 10,000+ Vehicles Managed Box */
.vehicles-managed-box:hover {
    transform: scale(1.05); /* Slightly enlarge the box on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* More prominent shadow when hovered */
}

/* Example for styling the content inside the box */
.vehicles-managed-box h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
}

.vehicles-managed-box p {
    font-size: 1rem;
    color: #555;
}
 
.hero {
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(to right, #1abc9c, #16a085);
    color: white;
    animation: fadeIn 1s ease-in-out;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Added transition for hover effect */
    border-radius: 10px; /* Optional, for rounding the corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Optional, for shadow effect */
}

.hero:hover {
    transform: scale(1.05); /* Enlarge the box on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* More prominent shadow when hovered */
}

.hero h1 {
    font-size: 3rem;
    font-weight: 600;
}

.hero p {
    font-size: 1.2rem;
    margin-top: 10px;
}
 

        .hero {
    padding: 100px 20px;
    background: rgba(255, 255, 255, 0.1); /* Transparent White */
    backdrop-filter: blur(10px); /* Blurred Glass Effect */
    border-radius: 10px;
    margin: 80px auto 20px;
    width: 80%;
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
}
body, h1, h2, h3, p, a, .btn, nav ul li a {
    font-family: "Cursive";
}


.feature-box {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    padding: 20px;
    margin: 15px;
    width: 250px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(255, 255, 255, 0.15);
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: cursive;
            scroll-behavior: smooth;
        }

        body {
            background-color: #f3f3f3;
            color: #333;
        }
        .nav-buttons button:hover {
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}
@media (max-width: 700px) {
    .navbar {
        flex-direction: column;
        align-items: center;
        padding: 5px;
    }

    .nav-links {
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }

    .nav-buttons {
        flex-direction: column;
        gap: 5px;
    }
}

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 40px;
            background: #2c3e50;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease-in-out;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s;
            font-weight: 500;
        }

        .nav-links a:hover {
            background-color: #34465e;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .nav-buttons button {
            padding: 8px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login { background: #3498db; color: purple; }
        .btn-register { background: #2ecc71; color: white; }
        .btn-support { background: #e74c3c; color: white; }

        .nav-buttons button:hover {
            transform: scale(1.05);
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(to right, #1abc9c, #16a085);
            color: white;
            animation: fadeIn 1s ease-in-out;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 600;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        /* Sections */
        .section {
            padding: 60px 50px;
            text-align: center;
            background: white;
            margin: 30px auto;
            width: 85%;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(50px);
             transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
.section:hover {
  transform: scale(1.1); /* Enlarge the section */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* More prominent shadow */
}
  .section h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .section p, .section ul {
            font-size: 1.1rem;
            color: #555;
        }

        .section ul {
            list-style: none;
            padding: 0;
        }

        .section ul li {
            margin: 8px 0;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            font-size: 1rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Reveal Sections on Scroll */
        .section.visible {
            opacity: 1;
            transform: translateY(0);
        }

/* Styling for the paragraph */
p {
  font-size: 16px;
  line-height: 1.6;
  color: #333;
  font-family: cursive;
}

/* Styling for all span tags inside the paragraph */
p span {
  position: relative;
  display: inline-block;
  transition: transform 0.3s ease, color 0.3s ease;
}

/* Hover Effect for all spans inside the paragraph */
p span:hover {
  transform: scale(1.1); /* Enlarge the text */
  color: #e74c3c; /* Default color change on hover */
}

/* Optional shadow effect when hovering over the span */
p span:hover::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.1);
  z-index: -1;
  border-radius: 3px;
}

/* You can also define custom hover colors for specific spans if needed */
p span:nth-child(1):hover {
  color: #f39c12; /* Vehicle performance */
}

p span:nth-child(2):hover {
  color: #27ae60; /* Driver behavior */
}

p span:nth-child(3):hover {
  color: #c0392b; /* Fuel consumption */
}

p span:nth-child(4):hover {
  color: #8e44ad; /* Route optimization */
}
.nav-links {
    display;flex;
    gap:5px;
}
.nav-links a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-weight: bold;
    position: relative;
    gap:
    transition: color 0.3s ease-in-out, transform 0.2s ease-in-out;
}

.nav-links a:hover {
    color: #f4a261; /* Highlight color on hover */
    transform: translateY(-3px); /* Moves the link slightly up */
}

.nav-links a::after {
    content: "";
    display: block;
    height: 2px;
    width: 0%;
    background: #f4a261;
    transition: width 0.3s ease-in-out;
    position: absolute;
    bottom: -5px;
    left: 0;
}

.nav-links a:hover::after {
    width: 100%; /* Underline expands on hover */
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: white;
    transition: color 0.3s ease-in-out;
}

.logo:hover {
    color: #f4a261; /* Change to any color you prefer */
}
.hero {
            text-align: center;
            padding: 50px;
            background-color: #f0f0f0;
        }

        .quest {
            display: inline-block;
            animation: slideIn 1s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        
        .section {
            padding: 40px;
            background-color: #ecf0f1;
        }

        h2, h3 {
            text-align: center;
            color: #2c3e50;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        h2:hover,h3:hover {
            color: #1abc9c; /* Change color on hover */
            transform: scale(1.05); /* Slightly increase size */
        }

        p {
            line-height: 1.6;
        }

        ul {
            list-style: none;
            padding: 0;
            font-size: 1.1rem;
        }
        img{
            width:100px;
            height:auto;

        }


    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <img src="logo.jpg">
        <div class="logo">FLEET QUEST</div>
        <nav class="nav-links">
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#applications">Applications</a>
            <a href="#achievements">Achievements</a>
            <a href="#contactus">ContactUs</a>


        </nav>
       <div class="nav-buttons">
    <button class="btn-login" onclick="window.location.href='user/login.php'">Login</button>
    <button class="btn-register" onclick="window.location.href='user/register.php'">Register</button>
    <button class="btn-support" onclick="window.location.href='support-us.html'">Support Us</button>
</div>


    </header>

    <section class="hero">
    <h1>
        Welcome to Our Company 
        <span style="color:black;">FLEET</span>
        <span id="dynamicQuest" class="quest" style="color:#f39c12;">QUEST</span>
    </h1>
    <p>Optimizing fleet operations with cutting-edge technology.</p>
</section>>

    <!-- About Us Section -->
    <section class="section" id="about">
    <h2><span>ABOUT US </span></h2>
    <p>
        <strong>Welcome to <span style="color:#1abc9c;">FLEETQUEST</span>,</strong> a leader in
        <span style="color:#3498db;">innovative fleet management solutions</span>. We specialize in
        optimizing vehicle operations, reducing costs, and enhancing efficiency with the latest
        <strong>AI-powered analytics</strong> and <strong>real-time tracking systems</strong>.
    </p>

    <p>
        Our technology enables businesses to monitor <span style="color:#e67e22;">vehicle performance</span>,
        <span style="color:#2ecc71;">driver behavior</span>, <span style="color:#e74c3c;">fuel consumption</span>,
        and <span style="color:#9b59b6;">route optimization</span>. Whether you are a logistics provider,
        a delivery service, or a corporate fleet owner, we ensure <strong>maximum productivity and compliance</strong>
        with industry standards.
    </p>

    <h3 style="margin-top: 20px; color:#2c3e50;">Why Choose Us?</h3>
    <ul>
        <li><strong>Real-time GPS Tracking</strong> for instant fleet monitoring.</li>
        <li><strong>Fuel & Maintenance Optimization</strong> to cut operational costs.</li>
        <li><strong>Driver Safety & Performance Monitoring</strong> for improved accountability.</li>
        <li><strong>AI-powered Predictive Analytics</strong> for smart decision-making.</li>
        <li><strong>Seamless Integration</strong> with existing enterprise systems.</li>
    </ul>

    <p style="margin-top: 20px; text-align: center;">
        Join <strong><span style="color:#1abc9c;">FLEETQUEST</span></strong> and experience
        the future of <strong>smart, efficient, and cost-effective fleet management</strong>.
        <span style="color:#f39c12;">Let's drive your business forward!</span>
    </p>
</section>



    <!-- Services Section -->
    <section class="section" id="services">
    <h2> <span>OUR SERVICES</span></h2>

    <p>
        At <strong><span style="color:#1abc9c;">FLEETQUEST</span></strong>, we offer cutting-edge fleet management services
        that streamline operations, enhance efficiency, and reduce costs. Our smart solutions help businesses take full control
        of their fleet with real-time insights, automation, and AI-powered analytics.
    </p>

    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; margin-top: 20px;">

        <div style="background: #3498db; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3> GPS Fleet Tracking</h3>
            <p>Monitor your fleet in real-time with accurate GPS tracking & route history.</p>
        </div>

        <div style="background: #2ecc71; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3> Fuel Management</h3>
            <p>Reduce fuel consumption and prevent wastage with AI-driven fuel tracking.</p>
        </div>

        <div style="background: #e74c3c; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3>Predictive Maintenance</h3>
            <p>Prevent breakdowns with AI-powered predictive maintenance alerts.</p>
        </div>

        <div style="background: #f39c12; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3> Data Analytics & Reporting</h3>
            <p>Get detailed performance reports & insights to optimize fleet operations.</p>
        </div>

        <div style="background: #9b59b6; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 15px;" class="vehicles-managed-box">
            <h3> Driver Safety & Compliance</h3>
            <p>Ensure driver safety with behavior monitoring, speed alerts, and compliance tracking.</p>
        </div>

        <div style="background: #1abc9c; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 15px;" class="vehicles-managed-box">
            <h3> Logistics & Dispatch</h3>
            <p>Automate dispatching and optimize routes for fast and cost-effective deliveries.</p>
        </div>

    </div>

    <p style="margin-top: 20px;">
        Our advanced fleet management services are designed to increase efficiency, reduce operational costs, and boost productivity.
        <strong>Partner with <span style="color:#1abc9c;">FLEETQUEST</span></strong> today and experience the future of fleet management!
    </p>
</section>


    <!-- Applications Section -->
    <section class="section" id="applications">
    <h2><span>OUR APPLICATIONS<span></h2>

    <p>
        <strong><span style="color:#1abc9c;">FLEETQUEST</span></strong> provides
        next-generation fleet management applications tailored for businesses across industries.
        Our smart solutions enhance efficiency, reduce costs, and improve safety, ensuring your
        fleet operates at peak performance.
    </p>

    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; margin-top: 20px;">

        <div style="background: #3498db; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3>GPS Tracking & Telematics</h3>
            <p>Monitor real-time location, route history, and driver behavior with advanced GPS tracking.</p>
        </div>

        <div style="background: #2ecc71; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3>Fuel & Cost Optimization</h3>
            <p>Reduce fuel wastage and operational expenses with AI-powered analytics.</p>
        </div>

        <div style="background: #e74c3c; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3>Logistics & Delivery Tracking</h3>
            <p>Enhance efficiency with automated dispatching, route optimization, and real-time ETA updates.</p>
        </div>

        <div style="background: #f39c12; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); " class="vehicles-managed-box">
            <h3> Driver Safety & Compliance</h3>
            <p>Ensure safety with automated alerts, speed tracking, and compliance monitoring.</p>
        </div>

        <div style="background: #9b59b6; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 15px;" class="vehicles-managed-box">
            <h3>AI-Powered Predictive Maintenance</h3>
            <p>Reduce downtime with proactive maintenance alerts based on vehicle diagnostics.</p>
        </div>

    </div>

    <p style="margin-top: 20px;">
        Our solutions empower businesses with real-time insights, automated operations, and cost-saving technologies.
        <strong>Partner with <span style="color:#1abc9c;">FLEETQUEST</span></strong> and take your fleet management to the next level!
    </p>
</section>

    <!-- Achievements Section -->
    <section class="section" id="achievements">
    <h2> <span>OUR ACHIEVEMENTS</h2>

    <p>
        At <strong><span style="color:#1abc9c;">FLEETQUEST</span></strong>, we take pride in our
        <span style="color:#e67e22; font-weight: bold;">outstanding contributions</span> to the fleet management industry.
        Our dedication to innovation, efficiency, and customer satisfaction has made us a trusted partner
        for businesses worldwide.
    </p>

    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; margin-top: 20px;">

        <div style="background: #3498db; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box" class="vehicles-managed-box" >
            <h3>10,000+ Vehicles Managed</h3>
            <p>We have successfully optimized operations for <strong>thousands of fleets</strong> globally.</p>
        </div>

        <div style="background: #2ecc71; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3>Best Fleet Management Award 2023</h3>
            <p>Recognized as the #1 Fleet Management Solution for our cutting-edge technology.</p>
        </div>

        <div style="background: #e74c3c; color: white; padding: 20px; border-radius: 10px; width: 250px;
        text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);" class="vehicles-managed-box">
            <h3>99% Customer Satisfaction</h3>
            <p>Our clients trust us for reliable, cost-effective, and AI-driven fleet solutions.</p>
        </div>

    </div>

    <p style="margin-top: 20px;">
        We continue to push boundaries, embrace innovation, and deliver excellence to businesses across the world.
        Join us and experience the <span style="color:#f39c12; font-weight: bold;">future of fleet management</span>!
    </p>
</section>
<section class="section" id="contactus">
<h2><span>CONTACT US</span></h2>
<p>Have any questions or need assistance? Our team at <strong><span style="color:#1abc9c;">FLEETQUEST</span></strong> is here to help!</p>
    
    <!-- Contact Options -->
    <div class="max-w-6xl mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Live Chat & Help Center -->
        <div class="bg-white-700 p-4 rounded-lg shadow-lg text-center hover:scale-105 hover:bg-gray-700 transform transition duration-300">
            <div class="text-3xl text-blue-500 mb-4">❓</div>
            <h2 class="text-xl font-bold">Live Chat & Help Center</h2>
            <p class="text-gray-400 mt-2">Want a quick answer? Chat with us or browse FAQs.</p>
            <p class="text-gray-500 mt-2">
                <span class="block">Live Chat Hours:</span>
                <span>Mon–Fri: 6:00 am–4:00 pm</span><br>
                <span>Sat & Sun: 6:00 am–4:00 pm</span>
            </p>
            <a href="javascript:void(0)" class="text-blue-500 hover:text-blue-300 mt-2 inline-block" onclick="toggleHelpCenter()">Visit Help Center →</a>
        </div>

        <!-- Call Us -->
        <div class="bg-white-700 p-4 rounded-lg shadow-lg text-center hover:scale-105 hover:bg-gray-700 transform transition duration-300">
            <div class="text-3xl text-blue-500 mb-4">📞</div>
            <h2 class="text-xl font-bold">Call Us</h2>
            <p class="text-gray-400 mt-2">Need assistance? Call us directly.</p>
            <p class="text-gray-500 mt-2">
                <span class="block font-bold text-white">+91 7036671402<br>(vishal)</span>
                <span class="block mt-2">Phone Hours:</span>
                <span>Mon–Fri: 6:00 am–4:00 pm</span><br>
                <span>Sat & Sun: Closed</span>
            </p>
        </div>

        <!-- Email Us -->
        <div class="bg-white-700 p-4 rounded-lg shadow-lg text-center hover:scale-105 hover:bg-gray-700 transform transition duration-300">
            <div class="text-3xl text-blue-500 mb-4">✉️</div>
            <h2 class="text-xl font-bold">Email Us</h2>
            <p class="text-gray-400 mt-2">Submit an email, and we'll get back to you soon.</p>
            <p class="text-gray-500 mt-2">
                <span class="block">Email Hours:</span>
                <span>Mon–Fri: 6:00 am–4:00 pm</span><br>
                <span>Sat & Sun: 6:00 am–4:00 pm</span>
            </p>
            <a href="mailto:n210714@rguktn.ac.in" class="text-blue-500 hover:text-blue-300 mt-2 inline-block">Send an Email →</a>
        </div>

    </div>

    <!-- Help Center Section (Initially Hidden) -->
    <div id="helpCenter" class="hidden max-w-6xl mx-auto px-4 md:px-8 mt-4 text-center">
        <div class="bg-white-800 p-4 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold">Help Center</h2>
            <p class="text-gray-400 mt-2">Here you can find FAQs, contact support, and more.</p>

            <!-- FAQs Section -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold">FAQs</h3>
                <div class="mt-2">
                    <button class="w-full text-left text-blue-500" onclick="toggleFAQ('faq1')">
                        How do I add a new vehicle to my fleet?                    </button>
                    <div id="faq1" class="hidden pl-4">
                        <p class="text-gray-400 text-sm">To add a vehicle, you typically need to log in to the fleet management portal and input vehicle details such as  Vehicle ID, model,, license plate number, and other relevant data.</p>
                    </div>
                </div>
                <div class="mt-2">
                    <button class="w-full text-left text-blue-500" onclick="toggleFAQ('faq2')">
                        Can I access fleet data on my phone?                    </button>
                    <div id="faq2" class="hidden pl-4">
                        <p class="text-gray-400 text-sm">You can access through your login id and  password.</p>
                    </div>
                    <div class="mt-2">
                        <button class="w-full text-left text-blue-500" onclick="toggleFAQ('faq3')">
                            Is the data secure?</button>                   
                            <div id="faq3" class="hidden pl-4">
                            <p class="text-gray-400 text-sm">It uses advanced data encryption your data is more secured.</p>
                        </div>
                </div>
            </div>

            <!-- Contact Support Form -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold">Still Need Help?<font color="#e67e22"><a href="mailto:n210714@rguktn.ac.in">@MAIL HERE</a></font></h3>
                
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        // Function to toggle Help Center visibility
        function toggleHelpCenter() {
            const helpCenter = document.getElementById('helpCenter');
            helpCenter.classList.toggle('hidden');
        }

        // Function to toggle FAQ visibility
        function toggleFAQ(faqId) {
            const faq = document.getElementById(faqId);
            faq.classList.toggle('hidden');
        }
    </script>
</section>


    <!-- Footer -->
    <footer class="footer">
        <p><font color="white">© 2025 FLEET<font color="yellow">QUEST</font>. All rights reserved</font>.</p>
    </footer>

    <script>
        // Smooth Scrolling for Navbar Links
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                document.getElementById(this.getAttribute('href').substring(1)).scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Scroll Animations
        const sections = document.querySelectorAll(".section");
        window.addEventListener("scroll", () => {
            sections.forEach(section => {
                if (section.getBoundingClientRect().top < window.innerHeight * 0.75) {
                    section.classList.add("visible");
                }
            });
        });
        // Replace "QUEST" with "QUEST" each time the page is refreshed
    const fleetName = "QUEST"; // Replace this with the desired fleet name
    document.getElementById("dynamicQuest").textContent = fleetName;

    // Optional: Add a slight delay before showing the animation
    window.onload = () => {
        const questElement = document.getElementById("dynamicQuest");
        questElement.classList.remove('quest');
        void questElement.offsetWidth; // Trigger reflow
        questElement.classList.add('quest');
    };
    </script>

</body>
</html>
