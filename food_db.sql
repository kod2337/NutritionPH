-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 03:30 PM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules`
--

CREATE TABLE `admin_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `name`, `address`, `amount`, `donated_at`) VALUES
(11, 'Akissa Rimando', '12 Justina ', 600.00, '2025-03-20 08:05:40'),
(12, 'Gab Fortuna', '24 Vitalez', 1000.00, '2025-03-20 08:16:38'),
(13, 'Gab Fortuna', '24 Vitalez', 1000.00, '2025-03-20 08:17:23'),
(14, 'Anonymous', 'N/A', 2.00, '2025-03-20 08:22:50'),
(15, 'Anonymous', 'N/A', 2.00, '2025-03-20 08:23:04'),
(16, 'Anonymous', 'N/A', 3.00, '2025-03-20 08:23:44'),
(17, 'Anonymous', 'N/A', 3.00, '2025-03-20 08:24:25'),
(18, 'Anonymous', 'N/A', 3.00, '2025-03-20 08:25:31'),
(19, 'Anonymous', 'N/A', 3.00, '2025-03-20 08:26:10'),
(20, 'Anonymous', 'N/A', 2.00, '2025-03-20 08:26:45'),
(21, 'Anonymous', 'N/A', 2.00, '2025-03-20 08:27:18'),
(22, 'Adnan Fortuna', '5 Justina Village, Sucat, Paranaque', 1200.00, '2025-03-20 08:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `image`, `comment`, `rating`) VALUES
(4, 'Harold Forones', 'user-icon.png', 'NourishedPH has completely changed the way I eat! Their meal plans are not only nutritious but also incredibly delicious. I love how they use fresh, locally sourced ingredients to create meals that make healthy eating so easy and enjoyable. Plus, their delivery service is always on time! Highly recommend to anyone looking for a sustainable and tasty way to stay healthy!', 4),
(8, 'Miguel Santos', 'user-icon.png', 'Tried many healthy meal delivery services, but NourishedPH stands out! The meals are flavorful, portions are just right, and I feel so much more energized throughout the day. The variety keeps me excited for each meal. Definitely my go-to for nutritious and convenient food!', 5),
(10, 'Reymond Palmos', 'user-icon.png', 'Absolutely love the meals! Healthy, delicious, and affordable. NourishedPH makes eating clean so easy. Highly recommend!', 5);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 2, 'Maxene Mateo', 'maxenemateo@gmail.com', '9123123123', 'Hi!');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `reference` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `description`, `reference`, `image`) VALUES
(1, 'Understanding Basic Nutrition', 'This module covers essential nutrients, their functions, and how to maintain a balanced diet for optimal health. Topics include macronutrients (carbohydrates, proteins, fats) and micronutrients (vitamins and minerals).', 'https://www.who.int/health-topics/nutrition', 'mod1.webp'),
(2, 'The Impact of Food Waste on the Environment', 'Learn about the environmental consequences of food waste, including carbon footprint, water waste, and land usage. The module also explores sustainable practices to reduce food waste.', 'https://www.fao.org/platform-food-loss-waste/en/', 'mod2.jpg'),
(3, ' Smart Shopping and Meal Planning', 'This module provides practical tips on how to buy only what you need, store food properly, and plan meals efficiently to minimize waste.', 'https://www.epa.gov/recycle/reducing-wasted-food-home', 'mod3.jpg'),
(4, 'The Importance of a Balanced Diet', 'This module explains the significance of a well-balanced diet, dietary guidelines, and how different food groups contribute to overall health and well-being.', 'https://www.hsph.harvard.edu/nutritionsource/healthy-eating-plate/', 'mod4.png'),
(5, 'The Global Food Waste Crisis', 'This module discusses the scale of global food waste, its economic and social impacts, and initiatives being taken worldwide to address the issue.', 'https://www.un.org/en/observances/end-food-waste-day', 'mod5.jpg'),
(6, 'Malnutrition in the Philippines: Causes and Solutions', 'This module explores the causes of malnutrition in the Philippines, including poverty, food insecurity, and unhealthy diets. It also discusses government programs like the National Nutrition Council (NNC) and initiatives like Feeding Programs for Children.', 'https://www.nnc.gov.ph/', 'mod6.jpg'),
(7, 'Food Waste in the Philippines: How Big is the Problem?', 'An overview of food waste in the Philippines, highlighting issues in markets, restaurants, and households. This module also presents local solutions, such as food rescue programs and composting initiatives.', 'https://www.unep.org/', 'mod7.png'),
(8, 'Urban Gardening and Food Security in the Philippines', 'This module teaches Filipino households how to grow their own food through urban gardening, hydroponics, and organic farming, promoting sustainable food production and waste reduction.', 'https://www.da.gov.ph/', 'mod8.jpg'),
(9, 'Feeding Programs and Nutrition Assistance in the Philippines', 'An overview of school-based and community feeding programs like DepEd’s School-Based Feeding Program (SBFP), which helps combat child malnutrition.', 'https://www.deped.gov.ph/', 'mod9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, 1, 'Gab Fortuna', '9152886906', 'gab12fortuna@gmail.com', 'Gcash', 'Blk 2, Lot 5, Justina Village, Brgy. San Isidro, Paranaque City, NCR, Philippines - 1700', 'Stir-fried Kangkong (80 x 1) - ', 80, '2025-03-20', 'pending'),
(3, 1, 'Gab Fortuna', '9152886906', 'gab12fortuna@gmail.com', 'Gcash', 'Blk 2, Lot 5, Justina Village, Brgy. San Isidro, Paranaque City, NCR, Philippines - 1700', 'Stir-fried Kangkong (80 x 1) - ', 80, '2025-03-20', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Stir-fried Kangkong', 'main dish', 80, 'stirfriedkangkong.jpg'),
(2, 'Chicken Teriyaki', 'main dish', 120, 'chickenteriyaki.jpg'),
(3, 'Pepino Salad', 'main dish', 75, 'pepino.jpg'),
(4, 'Apple Juice', 'drinks', 50, 'applejuice.jpg'),
(5, 'Orange Juice', 'drinks', 50, 'orangejuice.jpg'),
(6, 'Calamansi Juice', 'drinks', 50, 'calamansijuice.jpg'),
(7, 'Bottled Water', 'drinks', 25, 'bottledwater.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'Gab Fortuna', 'gab12fortuna@gmail.com', '9152886906', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Blk 2, Lot 5, Justina Village, Brgy. San Isidro, Paranaque City, NCR, Philippines - 1700'),
(2, 'Maxene Mateo', 'maxenemateo@gmail.com', '9231231231', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(3, 'Harold Forones', 'haroldforones@gmail.com', '9123123123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '5, 123, asdasd, asdas, Las Pinas City, NCR, Philippines - 1740'),
(4, 'Ericson Ofracio', 'ericsonofracio@gmail.com', '9123131232', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(5, 'Akissa Rimando', 'akissarimando@gmail.com', '9123123131', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(6, 'Daniel Jose', 'danieljose@gmail.com', '9194353453', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(7, 'Ian Shun', 'ianshun@gmail.com', '9123123132', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_modules`
--
ALTER TABLE `admin_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_modules`
--
ALTER TABLE `admin_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
