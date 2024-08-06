-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 09:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars_webpage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `user_password`) VALUES
(1, 'aryan', '$2y$10$PnILdoR7miQasW7kbKz1YeUQ2DT4TgkKux5hyrHLtU2QaB1.me1ee');

-- --------------------------------------------------------

--
-- Table structure for table `buying`
--

CREATE TABLE `buying` (
  `id` int(11) NOT NULL,
  `car_name` text NOT NULL,
  `og_price` int(11) NOT NULL,
  `new_price` int(11) NOT NULL,
  `car_image` text NOT NULL,
  `status` text NOT NULL DEFAULT 'unblock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buying`
--

INSERT INTO `buying` (`id`, `car_name`, `og_price`, `new_price`, `car_image`, `status`) VALUES
(1, 'Acura ZDX', 25000, 24000, '1722078016Acura-ZDX-P.jpg', 'unblock'),
(2, 'Acura TLX', 37000, 34500, '1722078400Acura-TLX.jpeg', 'unblock'),
(3, 'Acura MDX', 39000, 37000, '1722319687Acura-MDX.jpeg', 'unblock'),
(4, 'Acura ILX', 42000, 41000, '1722319740Acura-ILX.jpeg', 'unblock'),
(5, 'Acura NSX', 52000, 50000, '1722319792Acura-NSX.jpeg', 'unblock'),
(6, 'Acura RL', 36000, 34500, '1722319842Acura-RL.jpeg', 'unblock'),
(7, 'Acura INTEGRA', 45000, 44500, '1722319875Acura-INTEGRA.jpeg', 'unblock'),
(9, 'Acura CL', 34000, 33500, '1722319967Acura-CL.jpeg', 'unblock'),
(10, 'Acura SLX', 38000, 37200, '1722320034Acura-SLX.jpeg', 'unblock'),
(11, 'Acura RLX', 47000, 46500, '1722320083Acura-RLX.png', 'unblock'),
(13, 'Acura RSX', 55000, 54500, '1722320150Acura-RSX.jpeg', 'unblock'),
(14, 'Acura Vigor', 58000, 57000, '1722320321Acura-Vigor.jpeg', 'unblock'),
(15, 'Acura TSX', 40000, 39500, '1722320395Acura-TSX.jpeg', 'unblock');

-- --------------------------------------------------------

--
-- Table structure for table `car_maintenance`
--

CREATE TABLE `car_maintenance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `make` text NOT NULL,
  `model` text NOT NULL,
  `year` year(4) NOT NULL,
  `vin` text NOT NULL,
  `license` text NOT NULL,
  `lastServiceDate` date NOT NULL,
  `previousRecords` text NOT NULL,
  `lastMileage` text NOT NULL,
  `currentMileage` text NOT NULL,
  `knownIssues` text NOT NULL,
  `serviceType` varchar(255) NOT NULL,
  `serviceDate` date NOT NULL,
  `serviceTime` time NOT NULL,
  `serviceLocation` text NOT NULL,
  `specificRequests` text NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `billingAddress` text DEFAULT NULL,
  `insuranceInfo` text DEFAULT NULL,
  `warrantyInfo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_maintenance`
--

INSERT INTO `car_maintenance` (`id`, `name`, `phone`, `email`, `address`, `make`, `model`, `year`, `vin`, `license`, `lastServiceDate`, `previousRecords`, `lastMileage`, `currentMileage`, `knownIssues`, `serviceType`, `serviceDate`, `serviceTime`, `serviceLocation`, `specificRequests`, `paymentMethod`, `billingAddress`, `insuranceInfo`, `warrantyInfo`) VALUES
(1, 'demo', 786451, 'demo@gmail.com', 'demo', 'demo', 'demo', '2005', '78965413207896541', '0', '2024-04-13', 'demo', '14', '10', 'demo', 'fullInspection', '2024-07-31', '12:00:00', 'home', 'demo', 'creditCard', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `car_image` text NOT NULL,
  `car_name` text NOT NULL,
  `car_description` text NOT NULL,
  `car_category` varchar(255) NOT NULL,
  `car_brand` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'unblock',
  `car_detail_img` text NOT NULL,
  `car_make` text NOT NULL,
  `model` text NOT NULL,
  `year` year(4) NOT NULL,
  `trim_lvl` text NOT NULL,
  `Engine` text NOT NULL,
  `hp` text NOT NULL,
  `transmission` text NOT NULL,
  `drivetrain` text NOT NULL,
  `fuel` text NOT NULL,
  `dimensions` text NOT NULL,
  `curb_weight` text NOT NULL,
  `cargo_capacity` text NOT NULL,
  `speed` text NOT NULL,
  `top_speed` text NOT NULL,
  `breaking_d` text NOT NULL,
  `fuel_eff` text NOT NULL,
  `interior` text NOT NULL,
  `Infotainment` text NOT NULL,
  `Safety` text NOT NULL,
  `Exterior` text NOT NULL,
  `base_price` text NOT NULL,
  `diff_price` text NOT NULL,
  `exp_rev` text NOT NULL,
  `cust_rev` text NOT NULL,
  `rating` text NOT NULL,
  `warranty` text NOT NULL,
  `main_sch` text NOT NULL,
  `additional_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `car_image`, `car_name`, `car_description`, `car_category`, `car_brand`, `status`, `car_detail_img`, `car_make`, `model`, `year`, `trim_lvl`, `Engine`, `hp`, `transmission`, `drivetrain`, `fuel`, `dimensions`, `curb_weight`, `cargo_capacity`, `speed`, `top_speed`, `breaking_d`, `fuel_eff`, `interior`, `Infotainment`, `Safety`, `Exterior`, `base_price`, `diff_price`, `exp_rev`, `cust_rev`, `rating`, `warranty`, `main_sch`, `additional_info`) VALUES
(1, '1721982757Acura-ZDX.jpeg', 'Acura ZDX', '<p>The Acura ZDX is a mid-size luxury electric SUV, marking Acura&#39;s first foray into electric vehicles. Launched in 2024, it features a sleek design, advanced technology, and impressive performance options.</p>\r\n', 'Crossover', 'Acura', 'unblock', '1721982757Acura-ZDX-carousel.jpeg,1721982757Acura-ZDX-carousel1.jpeg,1721982757Acura-ZDX-carousel2.jpeg,1721982757Acura-ZDX-P.jpg', '<p>Acura</p>\r\n', '<p>ZDX</p>\r\n', '0000', '<p>Base, Technology Package, Advance Package</p>\r\n', '<p>3.7L V6</p>\r\n', '<p>300 hp @ 6,300 rpm, 270 lb-ft @ 4,500 rpm</p>\r\n', '<p>&nbsp;6-speed automatic with manual shift control</p>\r\n', '<p>&nbsp;AWD (All-Wheel Drive)</p>\r\n', '<p>Gasoline, 16 mpg city / 23 mpg highway / 19 mpg combined</p>\r\n', '<p>Length: 173.6 inches</p>\r\n\r\n<p>Width: 78.5 inches</p>\r\n\r\n<p>Height: 62.8 inches</p>\r\n\r\n<p>Wheelbase: 108.3 inches</p>\r\n', '<p>4,431 lbs</p>\r\n', '<p>26.3 cubic feet (rear seats up), 55.8 cubic feet (rear seats down)</p>\r\n', '<p>Approximately 6.5 seconds</p>\r\n', '<p>130 mph (electronically limited)</p>\r\n', '<p>Approximately 123 feet from 60 mph</p>\r\n', '<p>16 mpg city / 23 mpg highway / 19 mpg combined</p>\r\n', '<p>&nbsp;- Seating Capacity: 5</p>\r\n\r\n<p>&nbsp; - Materials: Leather upholstery, heated and ventilated front seats</p>\r\n\r\n<p>&nbsp; - Comfort Features: Dual-zone automatic climate control, power-adjustable front seats</p>\r\n', '<p>&nbsp;- Screen Size: 8-inch display</p>\r\n\r\n<p>&nbsp; - Connectivity: Bluetooth, USB port, auxiliary input</p>\r\n\r\n<p>&nbsp; - Audio System: Acura/ELS surround sound system with 10 speakers</p>\r\n', '<p>&nbsp;- Airbags: Front, side, curtain</p>\r\n\r\n<p>&nbsp; - ABS, stability control, traction control</p>\r\n\r\n<p>&nbsp; - Advanced Driver-Assistance Systems: Adaptive cruise control, blind-spot monitoring, collision mitigation braking</p>\r\n', '<p>&nbsp; - Lighting: Xenon HID headlights, LED taillights</p>\r\n\r\n<p>&nbsp; - Wheels: 19-inch alloy wheels</p>\r\n\r\n<p>&nbsp; - Sunroof: Panoramic glass roof</p>\r\n', '<p>Approximately $50,920 (2013 model)</p>', '<p>&nbsp; - Technology Package: +$4,500</p>\r\n\r\n<p>&nbsp; - Advance Package: +$8,600</p>\r\n', '<p>&nbsp;Generally praised for its style, luxury, and unique design, though criticized for limited rear visibility and cargo space.</p>\r\n', '<p>Mixed reviews with appreciation for luxury and design but some concerns about practicality and price.</p>\r\n', '<p>Average rating of 7/10</p>\r\n', '<p>&nbsp;4-year/50,000-mile limited warranty, 6-year/70,000-mile powertrain warranty</p>\r\n', '<p>Regular oil changes every 7,500 miles, tire rotations, brake inspections, and other routine maintenance as per the owner&#39;s manual</p>\r\n', '<p>- History of the Model:** The Acura ZDX was produced from 2010 to 2013, designed as a luxury crossover SUV with coupe-like styling.</p>\r\n\r\n<p>- Awards and Accolades:** Noted for its unique design and luxury features, though it did not win major automotive awards.</p>\r\n\r\n<p>- Recall Information:** Check for any recall notices specific to the 2013 Acura ZDX on the NHTSA website.</p>\r\n'),
(2, '1722075594Acura-TLX.jpeg', 'Acura TLX', '<p>The Acura TLX is a luxury sedan introduced in 2014, serving as a successor to the TL and TSX models. Known for its performance and innovative features, it embodies Acura&#39;s commitment to precision craftsmanship.</p>\r\n', 'Sedan', 'Acura', 'unblock', '', '<p>Acura</p>\r\n', '<p>TLX</p>\r\n', '0000', '<p>Base, Technology, A-Spec, Advance, Type S</p>\r\n', '<p>&nbsp;- 2.0L turbocharged inline-4 (Base, Technology, A-Spec, Advance)</p>\r\n\r\n<p>&nbsp; - 3.0L turbocharged V6 (Type S)</p>\r\n', '<p>-Horsepower</p>\r\n\r\n<p>- 272 hp (2.0L)</p>\r\n\r\n<p>- 355 hp (3.0L)</p>\r\n\r\n<p>- Torque</p>\r\n\r\n<p>- 280 lb-ft (2.0L)</p>\r\n\r\n<p>- 354 lb-ft (3.0L)</p>\r\n', '<p>10-speed automatic</p>\r\n', '<p>Front-wheel drive (Base, Technology, A-Spec, Advance), All-wheel drive (Type S)</p>\r\n', '<p>&nbsp;Premium unleaded</p>\r\n', '<p>- Length: 194.6 inches</p>\r\n\r\n<p>&nbsp; - Width: 75.2 inches</p>\r\n\r\n<p>&nbsp; - Height: 56.4 inches</p>\r\n\r\n<p>&nbsp; - Wheelbase: 113.0 inches</p>\r\n', '<p>&nbsp; - 3,755 lbs (2.0L)</p>\r\n\r\n<p>&nbsp; - 4,200 lbs (3.0L)</p>\r\n', '<p>13.5 cubic feet</p>\r\n', '<p>&nbsp; - Approximately 5.9 seconds (2.0L)</p>\r\n\r\n<p>&nbsp; - Approximately 4.7 seconds (3.0L)</p>\r\n', '<p>155 mph (electronically limited)</p>\r\n', '<p>120 feet from 60 mph</p>\r\n', '<p>&nbsp; - City: 22 mpg (2.0L) / 19 mpg (3.0L)</p>\r\n\r\n<p>&nbsp; - Highway: 31 mpg (2.0L) / 25 mpg (3.0L)</p>\r\n\r\n<p>&nbsp; - Combined: 25 mpg (2.0L) / 21 mpg (3.0L)</p>\r\n', '<p>&nbsp; - Seating capacity: 5</p>\r\n\r\n<p>&nbsp; - Materials: Leather upholstery, optional Milano leather</p>\r\n\r\n<p>&nbsp; - Comfort: Heated and ventilated seats, power-adjustable front seats, dual-zone automatic climate control</p>\r\n', '<p>&nbsp; - Screen size: 10.2-inch display</p>\r\n\r\n<p>&nbsp; - Connectivity: Apple CarPlay, Android Auto, Bluetooth, USB ports</p>\r\n\r\n<p>&nbsp; - Audio system: ELS Studio 3D Premium Audio System (17 speakers)</p>\r\n', '<p>&nbsp; - Airbags: Front, side, and curtain airbags</p>\r\n\r\n<p>&nbsp; - ABS and stability control</p>\r\n\r\n<p>&nbsp; - Advanced driver-assistance systems: Adaptive cruise control, lane-keeping assist, blind-spot monitoring, rear cross-traffic alert</p>\r\n', '<p>&nbsp; - Lighting: LED headlights, daytime running lights, LED taillights</p>\r\n\r\n<p>&nbsp; - Wheels: 18-inch alloy wheels (Base), 19-inch alloy wheels (A-Spec, Type S)</p>\r\n\r\n<p>&nbsp; - Sunroof: Standard power moonroof</p>\r\n', 'TLX Base: Starting at $39,000', '<p>&nbsp; - TLX Technology: Starting at $42,000</p>\r\n\r\n<p>&nbsp; - TLX A-Spec: Starting at $45,000</p>\r\n\r\n<p>&nbsp; - TLX Advance: Starting at $48,000</p>\r\n\r\n<p>&nbsp; - TLX Type S: Starting at $55,000</p>\r\n', '<p>Positive reviews highlighting performance, technology, and luxury features.</p>\r\n', '<p>&nbsp;User ratings and feedback on comfort, reliability, and overall satisfaction.</p>\r\n', '<p>8/10</p>\r\n', '<p>&nbsp; - Basic: 4 years/50,000 miles</p>\r\n\r\n<p>&nbsp; - Powertrain: 6 years/70,000 miles</p>\r\n\r\n<p>&nbsp; - Corrosion: 5 years/unlimited miles</p>\r\n\r\n<p>&nbsp; - Roadside Assistance: 4 years/50,000 miles</p>\r\n', '<p>Regular maintenance intervals (oil changes, tire rotations, brake inspections)</p>\r\n', '<p><strong>Model History</strong>:<br />\r\nThe Acura TLX was introduced in 2014 as a successor to the Acura TL and TSX models. It debuted at the New York International Auto Show and began production in July 2014. The first generation ran from 2015 to 2020, followed by a second generation launched in 2021, featuring significant design and performance upgrades, including new engine options and an innovative infotainment system.</p>\r\n\r\n<p><strong>Awards and Accolades</strong>:<br />\r\nThe Acura TLX has received numerous awards, including high safety ratings from the IIHS and NHTSA. It has been recognized for its value and performance in various automotive publications, contributing to its reputation as a competitive luxury sedan in its class.</p>\r\n\r\n<p><strong>Recall Information</strong>:<br />\r\nThe Acura TLX has had recalls over the years, primarily related to safety and performance issues. For instance, recalls have addressed problems with the rearview camera and potential fuel leaks. Acura has actively communicated with owners regarding these recalls and provided necessary repairs through authorized dealerships to ensure vehicle safety and compliance.</p>\r\n\r\n<p>&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_date` date NOT NULL DEFAULT current_timestamp(),
  `image` text NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'unblock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_date`, `image`, `title`, `sub_title`, `description`, `status`) VALUES
(2, '2024-07-05', '1722071117Bajaj-Freedom-CNG-Bike-image.jpg', 'Bajaj Freedom CNG Bike Launched Today!', 'The world&rsquo;s first CNG-powered motorcycle.', 'The Bajaj Freedom 125 is the world&#39;s first production motorcycle with a dual-fuel CNG and petrol powertrain. Featuring a sloper engine design and an integrated CNG tank, the Freedom 125 offers an extended range. Bajaj plans to launch both urban and rugged variants, priced competitively between ₹90,000 to ₹95,000, to bring an eco-friendly and affordable commuting solution to the entry-level motorcycle segment.', 'unblock'),
(3, '2024-07-04', '17220730542nd-news.jpg', 'Electric car, SUV sales drop 20 percent in June 2024', 'Electric passenger vehicle sales in Jan-Jun 2024.', 'Electric passenger vehicle sales in India declined 20% YoY to 12,000 units in June 2024, while electric two- and three-wheeler sales grew 10% to 120,000 units. For Jan-Jun 2024, electric car and SUV sales totaled 80,000 units, down 15% YoY, while two- and three-wheeler EV sales increased 18% to 650,000 units, attributed to supply chain issues, high costs, and lack of charging infrastructure for passenger EVs versus affordability and incentives driving two- and three-wheeler growth.', 'unblock'),
(4, '2024-07-04', '1722073160news6.jpeg', 'Maruti Suzuki Jimny Discounts Reach ₹2.85 Lakh in July 2024', 'Attractive Offers on the Compact SUV.', 'Maruti Suzuki is offering discounts of up to ₹2.85 lakh on the Jimny compact SUV in July 2024. The Jimny is priced between ₹12.74 lakh and ₹14.79 lakh (ex-showroom, Delhi), and buyers can avail cash benefits of up to ₹1 lakh, along with additional finance-related discounts of up to ₹1.50 lakh. The Jimny is available in two four-wheel-drive variants, with a 1.5-litre petrol engine and the choice of manual or automatic transmissions.', 'unblock'),
(5, '2024-07-04', '1722073219news7.jpeg', 'Tata Altroz Racer: Pros and Cons', 'Evaluating the Performance-Focused Hatchback.', 'The Tata Altroz Racer offers a more powerful and dynamic driving experience, with a sporty design, 1.2-litre turbo-petrol engine, and improved handling. However, its premium pricing, reduced practicality, and niche appeal may be drawbacks for some buyers. The article examines the key reasons to consider or avoid the Altroz Racer variant.', 'unblock'),
(6, '2024-07-04', '1722073267news8.jpeg', 'Aston Martin DBX707 AMR24: Exclusive F1-Inspired SUV', 'Celebrating the AMR24 Formula 1 Car.', 'Aston Martin has unveiled the DBX707 AMR24, a limited-edition luxury SUV based on the standard DBX707. The new model features a distinctive AMR24-inspired exterior with carbon fiber accents and exclusive interior touches, including AMR24 branding. Only 24 units will be produced worldwide, making it a highly exclusive offering.', 'unblock'),
(7, '2024-07-03', '1722073313new3.jpg', 'Audi India Q2 2024 Sales Down 6% Year-on-Year', 'Audi India Q2 2024: Supply Issues Hamper Sales, Pre-Owned Biz Grows.', 'Audi India retailed 1,431 vehicles in Q2 2024, a 37% increase over Q1 but a 6% decline from Q2 2023, due to supply chain issues. While Audi&#39;s pre-owned car business grew 33% year-on-year, the company lags behind rivals like BMW, which sold 7,089 units in H1 2024. However, Audi remains confident that supplies will normalize in H2 2024, allowing it to better meet customer demand.', 'unblock'),
(8, '2024-07-03', '1722073355news4.jpg', 'Electric Two-Wheeler Sales in India: June 2024 Highlights', 'Electric Scooter and Motorcycle Sales Trends.', 'TVS iQube sales grew 20% month-over-month, while Ather 450X and 450 Plus saw a 10% increase to 3,851 units. Ola S1 and S1 Pro sales rose 5% to 3,421 units. However, Bajaj Chetak and Husqvarna Vektorr sales remained flat. Revolt RV400 electric motorcycle sales increased 20% to 1,200 units.', 'unblock'),
(9, '2024-06-26', '1722073417news5.jpg', 'Bugatti and Jacob &amp; Co. Collaborate on Tourbillon Watch', 'Exclusive Timepiece Inspired by V16 Hypercar.', 'Bugatti and Jacob &amp; Co. have unveiled a new Tourbillon watch inspired by the Tourbillon V16 hybrid hypercar. The 52mm x 44mm black-PVD titanium case watch features a 30-second flying Tourbillon, miniature V16 engine animation, and will be limited to 250 units. Prices start at $340,000 (around ₹2.84 crore), with the first 150 in black DLC titanium and customization options for the remaining models.', 'unblock');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `phone_no` int(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`id`, `name`, `email`, `subject`, `phone_no`, `message`) VALUES
(1, 'demo', 'demo@gmail.com', 'demo', 786451, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `selling`
--

CREATE TABLE `selling` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `car_brand` text NOT NULL,
  `car_name` text NOT NULL,
  `car_mod_no` text NOT NULL,
  `car_no` text NOT NULL,
  `km_driven` int(11) NOT NULL,
  `dents` int(11) NOT NULL,
  `min_sale_price` int(11) NOT NULL,
  `max_sale_price` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selling`
--

INSERT INTO `selling` (`id`, `name`, `phone_no`, `country`, `state`, `city`, `address`, `car_brand`, `car_name`, `car_mod_no`, `car_no`, `km_driven`, `dents`, `min_sale_price`, `max_sale_price`, `image`) VALUES
(1, 'demo', 978645132, 'demo', 'demo', 'demo', 'demo', 'acura', 'Acura Vigor', 'demo', 'demo', 45000, 3, 3670, 1800, '1721981460_2nd-news.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `ip_address` varchar(454) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buying`
--
ALTER TABLE `buying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_maintenance`
--
ALTER TABLE `car_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buying`
--
ALTER TABLE `buying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_maintenance`
--
ALTER TABLE `car_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `selling`
--
ALTER TABLE `selling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
