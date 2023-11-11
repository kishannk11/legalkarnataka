-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2023 at 11:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `legalkarnataka`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `action`, `email`, `orderid`) VALUES
(20, 'accept', 'ranjithchandran220@gmail.com', 155210),
(21, 'callback', 'ranjithchandran220@gmail.com', 382530),
(22, 'callback', 'ranjithchandran220@gmail.com', 382530);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `email`, `username`, `password`, `role`, `image`) VALUES
(1, 'LegalKarnatakaUpdate2', 'legalupdate2@legalkarnataka.com', 'admin', '$2a$12$AuJo7tOUIalkjs05OVnj1uR6QY7vxYe7HuBcjlcNiygKLcisuUfT.', 'admin', 'upload/2033222631advocates-photo(1).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `stamp_price` int(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `prod_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `email`, `order_id`, `file_name`, `prod_id`) VALUES
(17, 'ranjithchandran220update@gmail.com', '382530', 'advocates-photo(1).pdf', 42),
(18, 'legalupdate2@legalkarnataka.com', '895454', 'advocates-photo.jpeg', 42),
(19, 'legalupdate2@legalkarnataka.com', '895454', 'advocates-photo(1).pdf', 42),
(20, 'ranjithchandran220@gmail.com', '258841', 'image.jpg', 42),
(21, 'ranjithchandran220@gmail.com', '258841', 'preview_image(14).png', 42),
(22, 'ranjithchandran220@gmail.com', '258841', 'preview_image(6).png', 43),
(23, 'ranjithchandran220@gmail.com', '258841', 'preview_image(8).png', 43),
(24, 'ranjithchandran220@gmail.com', '258841', 'preview_image(10).png', 43),
(25, 'ranjithchandran220@gmail.com', '326971', 'advocates-photo(1).jpeg', 43),
(26, 'ranjithchandran220@gmail.com', '326971', 'advocates-photo(1).pdf', 43),
(27, 'ranjithchandran220@gmail.com', '326971', 'advocates-photo.jpeg', 43),
(28, 'ranjithchandran220@gmail.com', '326971', 'advocates-photo(1).jpeg', 43),
(29, 'ranjithchandran220@gmail.com', '326971', 'advocates-photo.jpeg', 43),
(30, 'ranjithchandran220@gmail.com', '326971', 'advocates-photo(2).jpeg', 43),
(31, 'ranjithchandran220@gmail.com', '197318', '64d0bde6d9df8.jpeg', 43);

-- --------------------------------------------------------

--
-- Table structure for table `form_templates`
--

CREATE TABLE `form_templates` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `template_fields` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_templates`
--

INSERT INTO `form_templates` (`id`, `template_name`, `template_fields`) VALUES
(6, 'Name', '<div class=\"mb-3\">\r\n    <label class=\"form-label\" style=\"color: #000000;\"><b>Name</b></label>\r\n    <input type=\"text\" class=\"form-control\" name=\"name\" required>\r\n</div>'),
(7, 'Price', '<div class=\"mb-3\">\r\n <label class=\"form-label\">Stamp Paper Price</label>\r\n <input type=\"text\" class=\"form-control\" name=\"price\" id=\"stampPrice\">\r\n </div>'),
(8, 'Phone', '<div class=\"mb-3\">\r\n                                            <label class=\"form-label\">Change Name</label>\r\n                                            <input type=\"text\" class=\"form-control\" name=\"phone\">\r\n                                        </div>');

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`id`, `name`) VALUES
(6, 'Affidevit update'),
(7, 'Marriage Document'),
(8, 'Divorce');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postalcode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `prod_id` text NOT NULL,
  `price` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_charge` varchar(30) NOT NULL,
  `gst_amount` varchar(30) NOT NULL,
  `stamp_price` varchar(30) NOT NULL,
  `commission` varchar(30) NOT NULL,
  `shipment_id` varchar(50) NOT NULL,
  `shipment_order_id` varchar(50) NOT NULL,
  `delivery_type` varchar(40) NOT NULL,
  `order_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `firstname`, `lastname`, `address`, `city`, `postalcode`, `state`, `order_id`, `email`, `prod_id`, `price`, `created_at`, `delivery_charge`, `gst_amount`, `stamp_price`, `commission`, `shipment_id`, `shipment_order_id`, `delivery_type`, `order_status`) VALUES
(263, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '574880', 'ranjithchandran220@gmail.com', '43', '2368.32', '2023-10-11 06:26:44', '40.32', '72', '500', '30', '417674781', '419497604', 'Shiprocket', 'New'),
(264, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '574880', 'ranjithchandran220@gmail.com', '44', '2368.32', '2023-10-11 06:26:44', '40.32', '72', '800', '50', '417674781', '419497604', 'Shiprocket', 'New'),
(265, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '415846', 'ranjithchandran220@gmail.com', '43', '1192.5', '2023-10-11 06:41:10', '40.32', '72', '500', '30', '417684315', '419507138', 'Shiprocket', 'New'),
(266, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '415846', 'ranjithchandran220@gmail.com', '49', '1192.5', '2023-10-11 06:41:10', '40.32', '23', '0', '0', '417684315', '419507138', 'Shiprocket', 'New'),
(267, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '775015', 'ranjithchandran220@gmail.com', '43', '2317', '2023-10-11 06:48:35', '40.32', '72', '600', '50', '417689142', '419511966', 'Shiprocket', 'Shipped'),
(268, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '775015', 'ranjithchandran220@gmail.com', '44', '2317', '2023-10-11 06:48:35', '40.32', '72', '500', '30', '417689142', '419511966', 'Shiprocket', 'Shipped'),
(269, 'Ranjith', 'Chandran', 'Banglore', 'Banglore', '560068', 'Karnataka', '775015', 'ranjithchandran220@gmail.com', '49', '2317', '2023-10-11 06:48:35', '40.32', '22.68', '0', '0', '417689142', '419511966', 'Shiprocket', 'Shipped'),
(270, 'Ranjith', 'Chandran', 'banglore', 'banglore', '574229', 'Karnataka', '684846', 'ranjithchandran220@gmail.com', '49', '209.17', '2023-10-11 06:56:05', '60.49', '22.68', '0', '0', '417695122', '419517945', 'Shiprocket', 'New'),
(271, 'Ranjith', 'Chandran', 'ban', 'ban', '560068', 'Karnataka', '317040', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 06:59:28', '40.32', '22.68', '0', '0', '417698545', '419521369', 'Shiprocket', 'New'),
(272, 'Ranjith', 'Chandran', 'banglore', 'bamglore', '560068', 'Karnataka', '315897', 'ranjithchandran220@gmail.com', '49', '148.68', '2023-10-11 07:02:33', '0', '22.68', '0', '0', '417702919', '419525743', 'Instant Delivery', 'New'),
(273, 'Ranjith', 'Chandran', 'bab', 'bab', '560068', 'Karnataka', '201004', 'ranjithchandran220@gmail.com', '49', '198.68', '2023-10-11 07:19:01', '50', '22.68', '0', '0', '417716392', '419539216', 'Indian Post', 'New'),
(274, 'Ranjith', 'Chandran', 'tet', 'tet', '560068', 'Karnataka', '152525', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:24:33', '40.32', '22.68', '0', '0', '417719931', '419542755', 'Shiprocket', 'New'),
(275, 'Ranjith', 'Chandran', 'bab', 'bba', '560068', 'Karnataka', '543820', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:26:41', '40.32', '22.68', '0', '0', '417721350', '419544174', 'Shiprocket', 'New'),
(276, 'Ranjith', 'Chandran', 'ban', 'nna', '560068', 'Karnataka', '152530', 'ranjithchandran220@gmail.com', '49', '198.68', '2023-10-11 07:28:27', '50', '22.68', '0', '0', '417722382', '419545206', 'Indian Post', 'New'),
(277, 'Ranjith', 'Chandran', 'bab', 'nan', '560068', 'Karnataka', '518717', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:29:37', '40.32', '22.68', '0', '0', '417722930', '419545754', 'Shiprocket', 'New'),
(278, 'Ranjith', 'Chandran', 'banglore', 'banglore', '560068', 'Karnataka', '387183', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:31:46', '40.32', '22.68', '0', '0', '417724085', '419546909', 'Shiprocket', 'New'),
(279, 'Ranjith', 'Chandran', 'babba', 'bbbab', '560068', 'Karnataka', '897774', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:34:50', '40.32', '22.68', '0', '0', '417725668', '419548492', 'Shiprocket', 'New'),
(280, 'Ranjith', 'Chandran', 'ban', 'bab', '560068', 'Karnataka', '539596', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:42:34', '40.32', '22.68', '0', '0', '417729476', '419552300', 'Shiprocket', 'New'),
(281, 'Ranjith', 'Chandran', 'banglore', 'Banglore', '560068', 'Karnataka', '491482', 'ranjithchandran220@gmail.com', '49', '189', '2023-10-11 07:45:07', '40.32', '22.68', '0', '0', '417730614', '419553438', 'Shiprocket', 'New'),
(282, 'Ranjith', 'Chandran', 'Banglore', 'banglore', '560068', 'Karnataka', '493135', 'ranjithchandran220@gmail.com', '49', '202.91', '2023-11-02 08:13:59', '54.23', '22.68', '0', '0', '428541777', '430365947', 'Shiprocket', 'New'),
(283, 'Ranjith', 'Chandran', 'bann', 'bann', '560068', 'Karnataka', '984259', 'ranjithchandran220@gmail.com', '43', '957.73', '2023-11-02 08:16:08', '54.23', '72', '400', '30', '428542761', '430366931', 'Shiprocket', 'New'),
(284, 'Ranjith', 'Chandran', 'bab', 'bab', '560068', 'Karnataka', '314376', 'ranjithchandran220@gmail.com', '47', '81.37', '2023-11-02 12:22:26', '54.23', '4.14', '0', '0', '428689981', '430514237', 'Shiprocket', 'New'),
(285, 'Ranjith', 'Chandran', 'teseTTE', 'test', '560068', 'Karnataka', '651293', 'ranjithchandran220@gmail.com', '47', '81.37', '2023-11-02 12:25:17', '54.23', '4.14', '0', '0', '428691640', '430515895', 'Shiprocket', 'New'),
(286, 'Ranjith', 'Chandran', 'adress', 'add', '574229', 'Karnataka', '629832', 'ranjithchandran220@gmail.com', '43', '753.49', '2023-11-10 07:15:03', '60.49', '72', '200', '20', '432862532', '434687396', 'Shiprocket', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `password_token`
--

CREATE TABLE `password_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_token`
--

INSERT INTO `password_token` (`id`, `email`, `token`, `created_at`) VALUES
(12, 'ranjithchandran220@gmail.com', '02be343fe26bbb9b2658b0872e5f4b1ed843fac1b5e645cde9b84c9d7ba15f8e01a71d2a40872a6a911a4342c3e7daab9e7c', '2023-10-26 09:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_details`
--

CREATE TABLE `pdf_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pdf_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preview_data`
--

CREATE TABLE `preview_data` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `product_id` int(10) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preview_data`
--

INSERT INTO `preview_data` (`id`, `label`, `value`, `email`, `product_id`, `order_id`, `created_at`) VALUES
(179, 'Stamp Paper Price', '200', 'ranjithchandran220update@gmail.com', 42, '382530', '2023-09-28 10:55:30'),
(180, 'Name', 'Ranjith', 'ranjithchandran220update@gmail.com', 42, '382530', '2023-09-28 10:55:30'),
(181, 'Stamp Paper Price', '500', 'ranjithchandran220update@gmail.com', 42, '143379', '2023-09-28 13:45:00'),
(182, 'Name', 'Ranjith', 'ranjithchandran220update@gmail.com', 42, '143379', '2023-09-28 13:45:00'),
(183, 'Stamp Paper Price', '300', 'ranjithchandran220@gmail.com', 42, '704802', '2023-09-29 09:22:18'),
(184, 'Name', 'Ranjith', 'ranjithchandran220@gmail.com', 42, '704802', '2023-09-29 09:22:18'),
(185, 'Stamp Paper Price', '500', 'legalupdate2@legalkarnataka.com', 42, '895454', '2023-10-03 07:19:13'),
(186, 'Name', 'Chandan', 'legalupdate2@legalkarnataka.com', 42, '895454', '2023-10-03 07:19:13'),
(187, 'Stamp Paper Price', '300', 'ranjithchandran220@gmail.com', 42, '258841', '2023-10-03 07:22:38'),
(188, 'Name', 'Ranjith', 'ranjithchandran220@gmail.com', 42, '258841', '2023-10-03 07:22:38'),
(189, 'Stamp Paper Price', '400', 'ranjithchandran220@gmail.com', 43, '258841', '2023-10-03 07:23:58'),
(190, 'Name', 'Kishan', 'ranjithchandran220@gmail.com', 43, '258841', '2023-10-03 07:23:58'),
(191, 'Stamp Paper Price', '3', 'ranjithchandran220@gmail.com', 43, '258841', '2023-10-03 07:23:58'),
(192, 'Stamp Paper Price', '3000', 'ranjithchandran220@gmail.com', 43, '219758', '2023-10-04 08:19:16'),
(193, 'Name', 'rad', 'ranjithchandran220@gmail.com', 43, '219758', '2023-10-04 08:19:16'),
(194, 'Stamp Paper Price', '200', 'ranjithchandran220@gmail.com', 43, '219758', '2023-10-04 08:19:16'),
(195, 'Name', 'Ranjith', 'ranjithchandran220@gmail.com', 43, '476115', '2023-10-09 12:00:15'),
(196, 'Stamp Paper Price', '2000', 'ranjithchandran220@gmail.com', 43, '476115', '2023-10-09 12:00:15'),
(197, 'Name', 'Ranjith', 'ranjithchandran220@gmail.com', 43, '476115', '2023-10-09 12:01:48'),
(198, 'Stamp Paper Price', '200', 'ranjithchandran220@gmail.com', 43, '476115', '2023-10-09 12:01:48'),
(199, 'Name', 'Ranjith', 'ranjithchandran220@gmail.com', 44, '326971', '2023-10-10 10:07:00'),
(200, 'Stamp Paper Price', '800', 'ranjithchandran220@gmail.com', 44, '326971', '2023-10-10 10:07:00'),
(201, 'Change Name', 'Thee', 'ranjithchandran220@gmail.com', 44, '326971', '2023-10-10 10:07:00'),
(202, 'Name', 'ranjith', 'ranjithchandran220@gmail.com', 44, '775015', '2023-10-11 06:47:33'),
(203, 'Stamp Paper Price', '500', 'ranjithchandran220@gmail.com', 44, '775015', '2023-10-11 06:47:33'),
(204, 'Change Name', 'rohah', 'ranjithchandran220@gmail.com', 44, '775015', '2023-10-11 06:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `main_category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text DEFAULT NULL,
  `additionalfiles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `category`, `main_category`, `price`, `details`, `additionalfiles`) VALUES
(43, 'Test update ', '2', '7', 400.00, 'sadfdsfdsafdsafdsfs', 'Test\r\ntest1\r\ntest2\r\ntest4'),
(44, 'E Stamp', '6', '6', 400.00, 'sample details are being added', 'Aadhar\r\nPAN'),
(47, 'test', '6', '6', 23.00, 'sa', 'asas'),
(48, 'tets', '4', '6', 12.00, 'asas', 'asas'),
(49, 'AFFIDAVIT FOR CHANGE OF NAME IN BIRTH CERTIFICATE  (MINOR CHILD)', '2', '7', 126.00, 'The reasons for the name change are varied. The causes could be astrology, numerology, the minor&amp;amp;#039;s interests, inclusion or rejection of surname or change of the last name due to divorce or remarriage of parents. Hence, an affidavit is required when the minor&amp;amp;#039;s name is to be changed or corrected.', 'Adar\r\nfile\r\nfile');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`) VALUES
(22, 43, 'preview_image(11).png'),
(23, 43, 'preview_image(11).png'),
(30, 44, '651c5a1280a9e.jpeg'),
(31, 44, '651c5a1280c06.jpeg'),
(32, 44, '651c5a1280d70.jpeg'),
(35, 47, '651e4024d159a.jpeg'),
(36, 48, '651e41593c2b5.jpeg'),
(37, 49, '6524eb70a4b81.jpeg'),
(38, 49, '6524eb70a5360.jpeg'),
(39, 49, '6524eb70a53d7.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_templates`
--

CREATE TABLE `product_templates` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `template_id` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_templates`
--

INSERT INTO `product_templates` (`id`, `prod_name`, `template_id`) VALUES
(65, '43', '7'),
(66, '44', '6'),
(67, '44', '7'),
(68, '44', '8');

-- --------------------------------------------------------

--
-- Table structure for table `softcopy`
--

CREATE TABLE `softcopy` (
  `id` int(11) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `softcopy`
--

INSERT INTO `softcopy` (`id`, `orderid`, `email`, `filename`) VALUES
(5, '875799', 'ranjithchandran220@gmail.com', '1612940472571.jpeg'),
(19, '875799', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(20, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(21, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(22, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).jpeg'),
(23, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).jpeg'),
(24, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(25, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(26, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(27, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(28, '155210', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(29, '382530', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(30, '382530', 'ranjithchandran220@gmail.com', 'advocates-photo(1).pdf'),
(31, '574880', 'ranjithchandran220@gmail.com', '574880_37.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `parent_category`) VALUES
(2, 'Small stamp Update', '7'),
(4, 'Small Stamp', '6'),
(5, 'Mariage Certificate', '8'),
(6, 'Divorce Certificate', '8'),
(7, 'Test affidevite', '6');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `prod_id` varchar(20) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `txnid`, `amount`, `status`, `prod_id`, `order_id`, `timestamp`) VALUES
(74, '65084551d110a', 1265.27, 'success', '42', '875814', '2023-09-18 12:44:06'),
(75, '65084551d110a', 1265.27, 'success', '43', '875814', '2023-09-18 12:44:06'),
(76, '65093fa9cb817', 1205.00, 'success', '42', '140634', '2023-09-19 06:29:53'),
(77, '65093fa9cb817', 1205.00, 'success', '43', '140634', '2023-09-19 06:29:53'),
(78, '6509509ce6ba2', 1105.00, 'success', '42', '155210', '2023-09-19 07:42:03'),
(79, '6509509ce6ba2', 1105.00, 'success', '43', '155210', '2023-09-19 07:42:03'),
(80, '651568e890cf5', 635.49, 'success', '42', '382530', '2023-09-28 11:53:05'),
(81, '651579969dfae', 530.00, 'success', '43', '459986', '2023-09-28 13:04:04'),
(82, '651583872e03d', 943.50, 'success', '42', '143379', '2023-09-28 13:46:29'),
(83, '651568e890cf5', 635.49, 'success', '42', '382531', '2023-09-28 11:53:05'),
(84, '651bc28753a65', 1618.82, '', '42', '258841', '2023-10-03 07:29:11'),
(85, '651bc28753a65', 1618.82, '', '43', '258841', '2023-10-03 07:29:11'),
(86, '651cf9abf0500', 532.49, 'success', '43', '936457', '2023-10-04 05:36:22'),
(87, '651d0c7bbc6b5', 472.00, 'success', '43', '639778', '2023-10-04 06:56:35'),
(88, '651d1b2d3b8e2', 472.00, 'success', '44', '195415', '2023-10-04 07:59:18'),
(89, '651d1b2d3b8e2', 472.00, 'success', '44', '195415', '2023-10-04 08:03:00'),
(90, '651d1c818540c', 522.00, 'success', '44', '629089', '2023-10-04 08:05:05'),
(91, '651d1c818540c', 522.00, 'success', '44', '629089', '2023-10-04 08:06:40'),
(92, '651d1d715701f', 472.00, 'success', '44', '338363', '2023-10-04 08:08:56'),
(93, '651d3a0564423', 522.00, 'success', '43', '213307', '2023-10-04 10:10:51'),
(94, '651d3ca11d316', 512.32, 'success', '43', '749224', '2023-10-04 10:21:58'),
(95, '651db4a2d771c', 512.32, 'success', '44', '533941', '2023-10-04 18:54:03'),
(96, '651db52aebe19', 512.32, 'failure', '43', '815140', '2023-10-04 18:55:40'),
(97, '651db613a75f2', 532.49, 'failure', '44', '589410', '2023-10-04 18:59:32'),
(98, '651e779480a54', 512.32, 'failure', '44', '275263', '2023-10-05 08:45:10'),
(99, '651e782ab32ed', 512.32, 'failure', '44', '583798', '2023-10-05 08:47:40'),
(100, '6523b8657da9e', 472.00, 'failure', '44', '972968', '2023-10-09 08:23:03'),
(101, '6523b8d0a7a47', 472.00, 'failure', '44', '844468', '2023-10-09 08:24:50'),
(102, '65264023e4254', 2368.32, 'failure', '43', '574880', '2023-10-11 06:26:45'),
(103, '65264023e4254', 2368.32, 'failure', '44', '574880', '2023-10-11 06:26:45'),
(104, '6526438616fd7', 1192.50, 'failure', '43', '415846', '2023-10-11 06:41:11'),
(105, '6526438616fd7', 1192.50, 'failure', '49', '415846', '2023-10-11 06:41:11'),
(106, '652645426d532', 2317.00, 'failure', '43', '775015', '2023-10-11 06:48:35'),
(107, '652645426d532', 2317.00, 'failure', '44', '775015', '2023-10-11 06:48:35'),
(108, '652645426d532', 2317.00, 'failure', '49', '775015', '2023-10-11 06:48:35'),
(109, '6526470514116', 209.17, 'failure', '49', '684846', '2023-10-11 06:56:06'),
(110, '652647d04e880', 189.00, 'success', '49', '317040', '2023-10-11 07:00:14'),
(111, '65264888e3cb5', 148.68, 'failure', '49', '315897', '2023-10-11 07:02:33'),
(112, '65264c654dfd8', 198.68, 'failure', '49', '201004', '2023-10-11 07:19:05'),
(113, '65264db119ad9', 189.00, 'failure', '49', '152525', '2023-10-11 07:24:34'),
(114, '65264e31570cd', 189.00, 'failure', '49', '543820', '2023-10-11 07:26:42'),
(115, '65264e9b25af9', 198.68, 'failure', '49', '152530', '2023-10-11 07:28:28'),
(116, '65264ee0de98a', 189.00, 'failure', '49', '518717', '2023-10-11 07:29:38'),
(117, '65264f620e458', 189.00, 'failure', '49', '387183', '2023-10-11 07:31:47'),
(118, '65265019d9fc2', 189.00, 'failure', '49', '897774', '2023-10-11 07:34:51'),
(119, '652651e9d0507', 189.00, 'failure', '49', '539596', '2023-10-11 07:42:35'),
(120, '6526528302a71', 189.00, 'failure', '49', '491482', '2023-10-11 07:45:08'),
(121, '65435a4687889', 202.91, 'failure', '49', '493135', '2023-11-02 08:14:10'),
(122, '65435ac7d5559', 957.73, 'failure', '43', '984259', '2023-11-02 08:16:10'),
(123, '6543948136c72', 81.37, 'failure', '47', '314376', '2023-11-02 12:22:28'),
(124, '6543952c7ddbb', 81.37, 'failure', '47', '651293', '2023-11-02 12:25:19'),
(125, '654dd87752dbb', 753.49, 'failure', '43', '629832', '2023-11-10 07:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phonenumber`, `password`, `role`, `image`) VALUES
(9, 'Ranjith', 'Chandran', 'ranjithchandran220@gmail.com', '8105897579', '$2a$12$qdYElPjp2Sl8xr.PtCbk5uKduEYdkoxBW0sHM4tTUJn24ue.UXeMq', 'client', '../admin/upload/528656835advocates-photo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `email`, `password`, `createdAt`, `updatedAt`) VALUES
(1, 'example@example.com', 'password123', '2023-08-30 11:28:34', '2023-08-30 11:28:34'),
(3, 'example1@example.com', 'password123', '2023-08-30 11:34:31', '2023-08-30 11:34:31'),
(4, 'example3@example.com', 'password123', '2023-08-30 17:38:53', '2023-08-30 17:38:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_templates`
--
ALTER TABLE `form_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_details`
--
ALTER TABLE `pdf_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preview_data`
--
ALTER TABLE `preview_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_templates`
--
ALTER TABLE `product_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `softcopy`
--
ALTER TABLE `softcopy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `form_templates`
--
ALTER TABLE `form_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `main_category`
--
ALTER TABLE `main_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pdf_details`
--
ALTER TABLE `pdf_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `preview_data`
--
ALTER TABLE `preview_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_templates`
--
ALTER TABLE `product_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `softcopy`
--
ALTER TABLE `softcopy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
