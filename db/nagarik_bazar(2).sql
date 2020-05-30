-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2020 at 11:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nagarik_bazar`
--

-- --------------------------------------------------------

--
-- Table structure for table `creditsales`
--

CREATE TABLE `creditsales` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `paidamount` double NOT NULL,
  `dueamount` double NOT NULL,
  `saller_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_status` tinyint(1) NOT NULL DEFAULT 1,
  `sales_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `creditsales`
--

INSERT INTO `creditsales` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `paidamount`, `dueamount`, `saller_name`, `comp`, `sales_status`, `sales_date`, `created_at`, `updated_at`) VALUES
(7, 3, 3, 4, 2400, 2300, 100, 'admin', '', 1, '2020-02-24', '2020-02-24 09:20:30', '2020-03-05 07:46:08'),
(8, 3, 3, 3, 1800, 1500, 300, 'admin', '', 1, '2020-02-24', '2020-02-24 10:13:32', '2020-03-05 07:50:13'),
(12, 3, 4, 3, 900, 300, 600, 'admin', '', 1, '2020-03-05', '2020-03-05 06:48:06', '2020-03-05 07:36:33'),
(14, 7, 2, 3, 1053, 199, 854, 'admin', 'al_safa', 1, '2020-03-07', '2020-03-07 09:42:16', '2020-03-07 09:42:16'),
(15, 7, 16, 3, 131, 500, -369, 'admin', 'al_safa', 1, '2020-03-07', '2020-03-07 09:54:01', '2020-03-07 09:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` double NOT NULL,
  `code_number` double NOT NULL,
  `due_amount` double NOT NULL DEFAULT 0,
  `customer_type` tinyint(1) NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `district`, `phone_number`, `code_number`, `due_amount`, `customer_type`, `comp`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 'Ajad', 'Habiganj', 1234567895, 5555, 5000, 1, 'aladin', 'admin', NULL, '2020-02-20 11:25:57', '2020-03-05 07:50:13'),
(4, 'Ajim', 'Noakhali', 134568793, 3333, 0, 0, 'aladin', 'admin', NULL, '2020-02-24 10:57:35', '2020-03-07 06:30:01'),
(5, 'Karim', 'dhaka', 2554555435, 4444, 0, 1, 'aladin', 'admin', NULL, '2020-02-24 10:58:12', '2020-02-25 04:58:08'),
(6, 'Abdullah', 'Bhola', 12344545, 6666, 0, 0, 'aladin', 'admin', NULL, '2020-02-25 09:01:43', '2020-02-25 09:01:43'),
(7, 'Robin', 'Dhaka', 12344545, 4545, 485, 1, 'al_safa', 'admin', NULL, '2020-03-07 07:43:45', '2020-03-07 09:54:01'),
(8, 'Abdul', 'dhaka', 12344545, 7777, 0, 0, 'safa', 'admin', NULL, '2020-03-07 10:27:50', '2020-03-07 10:27:50'),
(9, 'Jasim', 'Dhaka', 1458789434, 3333, 0, 0, 'pioneer', 'sazzad19', NULL, '2020-03-07 12:28:26', '2020-03-07 12:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `aria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selltarget` double NOT NULL,
  `bonus_amount` double NOT NULL DEFAULT 0,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `customer_id`, `aria`, `selltarget`, `bonus_amount`, `comp`, `created_at`, `updated_at`) VALUES
(6, 5, 'sylhet', 50000, 750, 'aladin', '2020-02-25 04:58:08', '2020-02-25 06:57:40'),
(7, 3, 'Faridpur', 4000, 2675, 'aladin', '2020-02-25 05:55:06', '2020-02-25 05:55:40'),
(8, 7, 'sylhet', 20000, 0, 'al_safa', '2020-03-07 08:42:15', '2020-03-07 08:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` double NOT NULL,
  `salary` double NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `phone_number`, `salary`, `comp`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 'Shakil', 'Sylhet', 1789456789, 30000, 'aladin', 'admin', NULL, '2020-03-03 07:48:15', '2020-03-03 07:48:15'),
(4, 'Rafi', 'Sylhet', 1458789434, 30000, 'al_safa', 'admin', NULL, '2020-03-07 08:31:28', '2020-03-07 08:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `expenses_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `party_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalamount` double NOT NULL,
  `paidamount` double NOT NULL DEFAULT 0,
  `dueamount` double NOT NULL DEFAULT 0,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expenses_name`, `party_name`, `totalamount`, `paidamount`, `dueamount`, `product_name`, `comp`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Rent Expenses', 'House Owner', 50000, 45000, 5000, 'home', '', 'admin', 'admin', '2017-07-20 09:01:44', '2020-02-20 11:58:35'),
(2, 'Bill payment', 'Subusu', 4000, 4000, 0, 'Internet', '', 'admin', 'admin', '2017-10-28 14:52:48', '2017-10-28 15:43:32'),
(3, 'Dealer Bonus', 'Dealers', 2675, 2675, 0, 'Bonus', '', 'admin', NULL, '2020-02-25 06:54:16', '2020-02-25 08:07:17'),
(4, 'salary', 'montu', 12000, 10000, 2000, 'pen', '', 'admin', NULL, '2020-03-03 08:18:28', '2020-03-03 08:18:28'),
(5, 'salary', 'montu', 12000, 14000, -2000, 'expence', '', 'admin', NULL, '2020-03-03 08:19:46', '2020-03-03 08:19:46'),
(6, 'Rent Expenses', 'home', 10000, 7000, 3000, 'home rent', 'al_safa', 'admin', NULL, '2020-03-07 07:05:02', '2020-03-07 07:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `expensestitles`
--

CREATE TABLE `expensestitles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensestitles`
--

INSERT INTO `expensestitles` (`id`, `name`, `comp`, `created_at`, `updated_at`) VALUES
(1, 'Consumable Expenses', '', '2017-07-20 09:00:46', '2017-07-20 09:00:46'),
(2, 'Rent Expenses', '', '2017-07-20 09:00:58', '2017-07-20 09:00:58'),
(3, 'Bill payment', '', '2017-10-28 14:52:16', '2017-10-28 14:52:16'),
(4, 'Dealer Bonus', '', NULL, NULL),
(5, 'salary', '', '2020-03-03 08:17:21', '2020-03-03 08:17:21'),
(6, 'Hardware', '', '2020-03-07 07:11:29', '2020-03-07 07:11:29'),
(7, 'Software', 'al_safa', '2020-03-07 07:14:55', '2020-03-07 07:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2017_05_28_124228_create_roles_table', 3),
(4, '2017_05_28_124417_create_user_roles_table', 4),
(5, '2017_05_28_124654_create_permissions_table', 5),
(6, '2017_05_28_124806_create_role_permissions_table', 6),
(7, '2017_05_28_125406_create_modules_table', 7),
(8, '2017_05_28_125428_create_role_modules_table', 8),
(9, '2017_06_07_103849_create_productcategories_table', 9),
(10, '2017_06_07_103917_create_products_table', 10),
(11, '2017_06_09_071114_create_sales_table', 11),
(12, '2017_06_26_093722_create_expenses_table', 12),
(13, '2017_07_06_132245_create_salescarts_table', 13),
(14, '2017_07_06_141913_create_expensestitles_table', 14),
(15, '2017_07_07_125933_create_purchases_table', 15),
(17, '2017_07_17_084213_create_transactions_table', 16),
(18, '2019_08_19_000000_create_failed_jobs_table', 17),
(20, '2020_02_20_115033_create_creditsales_table', 18),
(21, '2020_02_19_144703_create_customers_table', 19),
(23, '2020_02_23_160007_create_employees_table', 20),
(24, '2020_02_24_173539_create_dealers_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_url` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_rank` int(11) NOT NULL,
  `view_sidebar` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `module_key`, `module_url`, `module_icon`, `module_rank`, `view_sidebar`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', 'dashboard-panel', 'fa fa-home', 1, 1, '2017-06-21 12:30:00', NULL),
(2, 'User Management', 'user_management', 'user-register', 'fa fa-user', 2, 1, '2017-06-05 22:44:05', '2020-03-02 09:47:36'),
(3, 'Module Management', 'module_management', 'module-list', 'fa fa-signal', 3, 1, '2017-06-06 19:38:48', '2017-06-06 19:38:48'),
(4, 'Role Management', 'role_management', 'role-list', 'fa fa-eye', 5, 1, '2017-06-06 19:55:09', '2017-06-06 19:55:09'),
(5, 'Permission Management', 'permission_management', 'permission-list', 'fa fa-refresh', 4, 1, '2017-06-06 22:27:01', '2017-06-06 22:27:01'),
(6, 'Productcategory MGMT', 'productcategory_mgmt', 'productcategory-list', 'fa fa-flag', 6, 1, '2017-06-07 18:09:49', '2017-06-07 18:09:49'),
(7, 'Product Management', 'product_management', 'product-list', 'fa fa-product-hunt', 7, 1, '2017-06-07 18:11:25', '2017-06-07 18:11:25'),
(8, 'Sales Management', 'sales_management', 'sales', 'fa fa-shopping-cart', 8, 1, '2017-06-08 19:37:53', '2017-06-08 19:37:53'),
(10, 'Expenses Management', 'expenses_management', 'expenses-list', 'fa fa-usd', 10, 1, '2017-06-22 18:52:09', '2017-06-22 18:52:09'),
(14, 'Purchase Management', 'purchase_management', 'purchase-list', 'fa fa-list', 15, 1, '2017-07-07 01:23:47', '2017-07-07 01:23:47'),
(15, 'Bank Transaction', 'bank_transaction', 'transaction-list', 'fa fa-list', 17, 0, '2017-07-15 23:41:04', '2017-07-15 23:41:04'),
(16, 'Expiry Dates', 'expiry-dates', 'expiry-dates', 'fa fa-list', 18, 1, NULL, NULL),
(17, 'Customers Management', 'customers_key', 'customers-list', 'fa fa-list', 19, 1, '2020-02-19 09:44:11', '2020-02-19 09:44:11'),
(18, 'Sales Return', 'sales_return', 'sales_return', 'fa fa-list', 20, 1, '2020-02-22 06:36:53', '2020-02-22 06:36:53'),
(19, 'Employee Management', 'employee_management', 'employee-list', 'fa fa-list', 21, 1, '2020-02-23 09:35:04', '2020-02-23 09:35:04'),
(20, 'Dealer Management', 'dealer_management', 'dealer-list', 'fa fa-list', 22, 1, '2020-02-24 11:21:39', '2020-02-24 11:21:39'),
(21, 'Database Backup', 'database-backup', 'database-backup', 'fa fa-refresh', 23, 1, '2020-03-05 05:18:54', '2020-03-05 05:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `permission_key`, `created_at`, `updated_at`) VALUES
(1, 'Create New User', 'user-register', '2017-06-06 21:12:20', '2017-06-06 21:12:20'),
(2, 'Module Create', 'module-create', '2017-06-07 23:18:50', '2017-06-07 23:18:50'),
(3, 'Module View', 'module-list', '2017-06-07 23:19:11', '2017-06-07 23:19:11'),
(4, 'Module Delete', 'module-delete', '2017-06-07 23:19:26', '2017-06-07 23:19:26'),
(5, 'Module Edit', 'module-edit', '2017-06-07 23:19:43', '2017-06-07 23:19:43'),
(6, 'Role View', 'role-list', '2017-06-07 23:20:39', '2017-06-07 23:20:39'),
(7, 'Role Create', 'role-create', '2017-06-07 23:20:52', '2017-06-07 23:20:52'),
(8, 'Permission Asign', 'permission-asign', '2017-06-07 23:21:16', '2017-06-07 23:32:14'),
(9, 'Permission Create', 'permission-create', '2017-06-07 23:21:48', '2017-06-07 23:21:48'),
(10, 'Permission Views', 'permission-list', '2017-06-07 23:22:07', '2017-06-07 23:22:07'),
(11, 'Permission Edit', 'permission-edit', '2017-06-07 23:22:46', '2017-06-07 23:22:46'),
(12, 'Permission Delete', 'permission-delete', '2017-06-07 23:23:18', '2017-06-07 23:23:18'),
(13, 'Productcategory View', 'productcategory-list', '2017-06-07 23:33:40', '2017-06-07 23:33:40'),
(14, 'Product Category Create', 'productcategory-create', '2017-06-07 23:34:38', '2017-06-07 23:34:38'),
(15, 'Product Category Edit', 'productcategory-edit', '2017-06-07 23:35:00', '2017-06-07 23:35:00'),
(16, 'Product Category Delete', 'productcategory-delete', '2017-06-07 23:35:21', '2017-06-07 23:35:21'),
(17, 'Product View', 'product-list', '2017-06-07 23:39:33', '2017-06-07 23:39:33'),
(18, 'Product Create', 'product-create', '2017-06-07 23:39:50', '2017-06-07 23:39:50'),
(19, 'Product Edit', 'product-edit', '2017-06-07 23:40:06', '2017-06-07 23:40:06'),
(20, 'Product Delete', 'product-delete', '2017-06-07 23:40:45', '2017-06-07 23:40:45'),
(25, 'Sales view', 'sales-list', '2017-07-16 23:57:39', '2017-07-16 23:57:39'),
(26, 'Make/Create Sales', 'sales-create', '2017-07-16 23:59:43', '2017-07-16 23:59:43'),
(30, 'Purchase view', 'purchase-list', '2017-07-17 00:24:38', '2017-07-17 00:24:38'),
(31, 'Make new Purchase', 'purchase-create', '2017-07-17 00:25:03', '2017-07-17 00:25:03'),
(32, 'purchase Update/Confirm Dueamount', 'purchase-update', '2017-07-17 00:25:41', '2017-07-17 00:25:41'),
(33, 'Expenses View', 'expenses-list', '2017-07-17 00:30:32', '2017-07-17 00:30:32'),
(34, 'Expenses Create', 'expenses-create', '2017-07-17 00:31:24', '2017-07-17 00:31:24'),
(35, 'Expenses Edit', 'expenses-edit', '2017-07-17 00:31:43', '2017-07-17 00:31:43'),
(36, 'Expenses Delete', 'expenses-delete', '2017-07-17 00:32:04', '2017-07-17 00:32:04'),
(37, 'Expenses Heading Create', 'expenses-heading', '2017-07-17 00:33:34', '2017-07-17 00:33:34'),
(45, 'User Password Change', 'password-change', '2017-07-17 00:54:08', '2017-07-17 00:54:08'),
(46, 'Transcation/Bank view', 'transaction-list', '2017-07-17 22:30:39', '2017-07-17 22:30:39'),
(47, 'Transaction remaining Deposite update', 'transaction-update', '2017-07-17 22:31:56', '2017-07-17 22:31:56'),
(48, 'Transaction Entry', 'transaction-create', '2017-07-17 22:32:23', '2017-07-17 22:32:23'),
(49, 'Customer View', 'customers-list', '2020-02-19 10:31:41', '2020-02-19 10:31:41'),
(50, 'Customer Edit', 'customer-edit', '2020-02-20 09:18:21', '2020-02-20 09:18:21'),
(51, 'Customer Delete', 'customer-delete', '2020-02-20 10:14:14', '2020-02-20 10:14:14'),
(52, 'Sales Return', 'sales_return', '2020-02-22 06:39:36', '2020-02-22 06:39:36'),
(53, 'Employee Management', 'employee_management', '2020-02-23 10:14:01', '2020-02-23 10:14:01'),
(54, 'Employee Delete', 'employee-delete', '2020-02-24 08:32:17', '2020-02-24 08:32:17'),
(55, 'Dealer View', 'dealer-list', '2020-02-24 11:25:31', '2020-02-24 11:25:31'),
(56, 'Dealer Create', 'dealer-create', '2020-02-24 11:27:24', '2020-02-24 11:27:24'),
(57, 'Dealer Edit', 'dealer-edit', '2020-02-24 11:27:49', '2020-02-24 11:27:49'),
(58, 'Dealer Delete', 'dealer-delete', '2020-02-24 11:28:46', '2020-02-24 11:28:46'),
(59, 'Sale Delete', 'sale-delete', '2020-03-03 07:40:28', '2020-03-03 07:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE `productcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`id`, `name`, `slug`, `comp`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 'Food Items', 'food-items', '', 1, 'admin', NULL, '2017-10-28 12:15:46', '2017-10-28 12:15:46'),
(4, 'Beverag', 'beverag', 'al_safa', 1, 'user', 'admin', '2017-10-28 15:06:02', '2020-03-07 05:24:51'),
(5, 'Personal Care', 'personal-care', '', 1, 'admin', 'admin', '2017-10-28 15:25:40', '2017-10-28 15:32:48'),
(6, 'Bread and Bakery', 'bread-and-bakery', '', 1, 'admin', NULL, '2017-10-28 15:25:54', '2017-10-28 15:25:54'),
(7, 'Baby Product', 'baby-product', '', 1, 'admin', NULL, '2017-10-28 15:26:52', '2017-10-28 15:26:52'),
(8, 'cvsdfsdf', 'cvsdfsdf', '', 1, 'admin', NULL, '2017-12-21 15:38:54', '2017-12-21 15:38:54'),
(9, 'pen', 'pen-.5', '', 1, 'admin', NULL, '2020-03-03 08:14:07', '2020-03-03 08:14:07'),
(10, 'Shampo', 'shampo', 'pioneer', 1, 'admin', NULL, '2020-03-07 05:21:31', '2020-03-07 05:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `productcategory_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `expiry_date` date NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productcategory_id`, `name`, `code`, `quantity`, `stock`, `price`, `expiry_date`, `comp`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 3, 'Rice 10 kg', 'R10', 50, 27, 400, '2020-06-14', 'al_safa', 1, 'admin', 'admin', '2017-10-28 15:28:24', '2020-03-07 09:42:16'),
(3, 4, 'Apple Juce 1 Litter', 'AJ', 50, 36, 600, '2020-02-17', 'pioneer', 1, 'admin', NULL, '2017-10-28 15:29:32', '2020-03-08 11:28:13'),
(4, 4, 'Hard Soda 1 Litter', 'HS1', 70, 46, 300, '2020-08-12', '', 1, 'admin', NULL, '2017-10-28 15:31:10', '2020-03-07 06:24:55'),
(5, 5, 'Gillette Razor Blade', 'GRB', 50, 29, 300, '2020-06-13', '', 1, 'admin', NULL, '2017-10-28 15:34:01', '2020-03-07 05:57:51'),
(6, 5, 'Toothpaste', 'TP', 70, 67, 50, '2021-03-03', '', 1, 'admin', NULL, '2017-10-28 15:34:41', '2020-03-07 05:52:55'),
(7, 5, 'Coconut Oil', 'CO', 70, 70, 100, '2019-12-18', '', 1, 'admin', NULL, '2017-10-28 15:36:13', '2017-10-28 15:36:13'),
(8, 6, 'Black Forest Full', 'BFF', 50, 50, 50, '2020-02-17', '', 1, 'admin', NULL, '2017-10-28 15:36:46', '2017-10-28 15:36:46'),
(10, 6, 'French Bread', 'FB', 60, 60, 60, '2020-04-09', '', 1, 'admin', NULL, '2017-10-28 15:37:54', '2017-10-28 15:37:54'),
(11, 7, 'Johndon Powder', 'JP', 100, 100, 600, '2020-05-14', '', 1, 'admin', NULL, '2017-10-28 15:39:19', '2017-10-28 15:39:19'),
(12, 5, 'Pampers', 'PMRS', 35, 35, 500, '2020-08-12', '', 1, 'admin', NULL, '2017-10-28 15:40:13', '2017-10-28 15:40:13'),
(13, 4, 'Ice-Cream', '2222', 2, 3, 234, '2020-10-01', '', 1, 'admin', NULL, '2020-02-20 04:24:14', '2020-03-03 06:57:53'),
(14, 7, 'Milk', '333', 200, 200, 60, '2020-08-05', '', 1, 'admin', NULL, '2020-02-22 05:23:58', '2020-02-22 05:23:58'),
(15, 9, 'pen ball point', '1252', 100, 99, 10, '2020-03-03', '', 1, 'admin', NULL, '2020-03-03 08:15:50', '2020-03-03 08:18:56'),
(16, 4, 'Ice Cream', 'ice-222', 30, 10, 47, '2020-03-19', 'al_safa', 1, 'admin', NULL, '2020-03-07 05:39:08', '2020-03-08 11:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `goods_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `party_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalamount` double NOT NULL,
  `paidamount` double NOT NULL,
  `dueamount` double NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('vat','pan','normal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `goods_name`, `party_name`, `totalamount`, `paidamount`, `dueamount`, `comp`, `status`, `purchase_date`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Software', 'Cheetahwebtech', 500000, 500000, 0, '', 'vat', '2017-07-20', 'admin', NULL, '2017-07-20 09:03:02', '2017-07-20 09:03:02'),
(2, 'Other Purchase', 'Some Other', 50000, 50000, 0, '', 'pan', '2017-07-20', 'admin', NULL, '2017-07-20 09:03:41', '2017-10-28 14:46:18'),
(3, 'Furniture', 'Thapa furniture', 4000, 30000, 400, '', 'pan', '2017-10-28', 'admin', NULL, '2017-10-28 14:50:57', '2017-10-28 14:50:57'),
(4, 'Baby Product 1 Bundel', 'Gupta wholeSell', 5000, 5000, 0, '', 'pan', '2017-10-28', 'admin', NULL, '2017-10-28 15:46:07', '2017-10-28 15:46:07'),
(5, 'Chairs', 'RFL', 5000, 5000, 0, '', 'normal', '2020-02-20', 'admin', NULL, '2020-02-20 11:32:21', '2020-02-20 11:39:16'),
(6, 'TABLE', 'RFL', 3000, 2950, 50, '', 'pan', '2020-02-20', 'admin', NULL, '2020-02-20 11:38:55', '2020-03-03 09:01:40'),
(7, 'Chairs', 'RFL', 2000, 2000, 0, '', 'pan', '2020-02-20', 'admin', NULL, '2020-02-20 11:42:38', '2020-03-03 09:03:03'),
(8, 'Shirts', 'RFL', 5000, 5000, 0, '', 'normal', '2020-02-20', 'admin', NULL, '2020-02-20 11:43:40', '2020-03-03 08:20:12'),
(9, 'TABLE', 'TTTT', 4000, 4000, 0, '', 'pan', '2020-02-20', 'admin', NULL, '2020-02-20 11:44:25', '2020-02-20 11:44:42'),
(10, 'Chairs', 'RFL', 10000, 10000, 0, '', 'normal', '2020-03-03', 'admin', NULL, '2020-03-03 07:43:27', '2020-03-03 07:43:27'),
(11, 'Table', 'RFL', 3000, 7000, -4000, '', 'normal', '2020-03-03', 'admin', NULL, '2020-03-03 09:59:53', '2020-03-03 09:59:53'),
(12, 'Computers', 'Hp', 100000, 100000, 0, 'al_safa', 'normal', '2020-03-07', 'admin', NULL, '2020-03-07 07:21:24', '2020-03-07 10:01:09'),
(13, 'Laptops', 'DELL', 100000, 100000, 0, 'al_safa', 'normal', '2020-03-07', 'admin', NULL, '2020-03-07 10:04:55', '2020-03-07 10:05:43'),
(14, 'Tablets', 'Square', 3000, 2000, 1000, 'pioneer', 'normal', '2020-03-08', 'admin', NULL, '2020-03-08 06:01:24', '2020-03-08 06:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2017-07-19 18:15:00', '2017-07-20 18:15:00'),
(3, 'User', '2020-03-03 08:06:18', '2020-03-03 08:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_modules`
--

CREATE TABLE `role_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_modules`
--

INSERT INTO `role_modules` (`id`, `role_id`, `module_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, '2017-06-05 22:44:05', '2017-06-05 22:44:05'),
(4, 1, 3, '2017-06-06 19:38:48', '2017-06-06 19:38:48'),
(5, 1, 4, '2017-06-06 19:55:09', '2017-06-06 19:55:09'),
(6, 1, 5, '2017-06-06 22:27:01', '2017-06-06 22:27:01'),
(7, 1, 6, '2017-06-07 18:09:49', '2017-06-07 18:09:49'),
(9, 1, 7, '2017-06-07 18:11:25', '2017-06-07 18:11:25'),
(15, 1, 10, '2017-06-22 18:52:09', '2017-06-22 18:52:09'),
(21, 1, 14, '2017-07-07 01:23:47', '2017-07-07 01:23:47'),
(23, 1, 15, '2017-07-15 23:41:04', '2017-07-15 23:41:04'),
(28, 1, 19, '2020-02-23 09:35:04', '2020-02-23 09:35:04'),
(30, 1, 20, '2020-02-24 11:21:39', '2020-02-24 11:21:39'),
(36, 1, 17, '2020-03-07 11:50:23', '2020-03-07 11:50:23'),
(37, 3, 17, '2020-03-07 11:50:23', '2020-03-07 11:50:23'),
(38, 1, 1, '2020-03-07 11:50:56', '2020-03-07 11:50:56'),
(40, 3, 1, '2020-03-07 11:50:56', '2020-03-07 11:50:56'),
(41, 1, 21, '2020-03-07 11:51:09', '2020-03-07 11:51:09'),
(43, 3, 21, '2020-03-07 11:51:09', '2020-03-07 11:51:09'),
(44, 1, 16, '2020-03-07 11:52:27', '2020-03-07 11:52:27'),
(45, 3, 16, '2020-03-07 11:52:27', '2020-03-07 11:52:27'),
(46, 1, 8, '2020-03-07 11:53:23', '2020-03-07 11:53:23'),
(48, 3, 8, '2020-03-07 11:53:23', '2020-03-07 11:53:23'),
(49, 1, 18, '2020-03-07 11:53:34', '2020-03-07 11:53:34'),
(51, 3, 18, '2020-03-07 11:53:35', '2020-03-07 11:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1170, 1, 1, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1171, 1, 2, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1172, 1, 3, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1173, 1, 4, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1174, 1, 5, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1175, 1, 6, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1176, 1, 7, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1177, 1, 8, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1178, 1, 9, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1179, 1, 10, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1180, 1, 11, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1181, 1, 12, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1182, 1, 13, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1183, 1, 14, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1184, 1, 15, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1185, 1, 16, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1186, 1, 17, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1187, 1, 18, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1188, 1, 19, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1189, 1, 20, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1190, 1, 25, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1191, 1, 26, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1192, 1, 30, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1193, 1, 31, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1194, 1, 32, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1195, 1, 33, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1196, 1, 34, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1197, 1, 35, '2020-03-03 07:40:42', '2020-03-03 07:40:42'),
(1198, 1, 36, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1199, 1, 37, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1200, 1, 45, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1201, 1, 46, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1202, 1, 47, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1203, 1, 48, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1204, 1, 49, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1205, 1, 50, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1206, 1, 51, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1207, 1, 52, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1208, 1, 53, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1209, 1, 54, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1210, 1, 55, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1211, 1, 56, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1212, 1, 57, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1213, 1, 58, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1214, 1, 59, '2020-03-03 07:40:43', '2020-03-03 07:40:43'),
(1245, 3, 17, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1246, 3, 25, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1247, 3, 26, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1248, 3, 32, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1249, 3, 49, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1250, 3, 50, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1251, 3, 51, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1252, 3, 52, '2020-03-07 12:38:09', '2020-03-07 12:38:09'),
(1253, 3, 59, '2020-03-07 12:38:09', '2020-03-07 12:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `saller_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_status` tinyint(1) NOT NULL DEFAULT 1,
  `sales_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `saller_name`, `comp`, `sales_status`, `sales_date`, `created_at`, `updated_at`) VALUES
(12, 3, 2, 3, 1500, 'admin', '', 1, '2020-02-24', '2020-02-24 09:03:34', '2020-02-24 09:03:34'),
(13, 3, 5, 3, 900, 'admin', '', 1, '2020-02-24', '2020-02-24 09:03:34', '2020-03-03 08:23:55'),
(14, 3, 3, 2, 1200, 'admin', '', 1, '2020-02-24', '2020-02-24 09:26:19', '2020-02-24 09:26:19'),
(15, 3, 3, 5, 3000, 'admin', '', 1, '2020-02-25', '2020-02-25 08:50:58', '2020-03-03 07:47:07'),
(16, 3, 3, 4, 2400, 'admin', '', 1, '2020-02-25', '2020-02-25 08:50:58', '2020-02-25 08:50:58'),
(17, 2, 2, 5, 1710, 'admin', '', 1, '2020-02-20', '2020-02-25 10:13:29', '2020-03-03 07:34:54'),
(18, 2, 2, 4, 2000, 'admin', '', 1, '2020-02-20', '2020-02-25 10:13:47', '2020-02-25 10:13:47'),
(19, 2, 4, 3, 900, 'admin', '', 1, '2020-02-20', '2020-02-25 10:15:42', '2020-02-25 10:15:42'),
(20, 3, 5, 5, 1500, 'admin', '', 1, '2020-02-25', '2020-02-25 10:27:11', '2020-02-25 10:27:11'),
(21, 3, 3, 4, 2400, 'admin', '', 1, '2020-02-25', '2020-02-25 10:32:42', '2020-02-25 10:32:42'),
(22, 3, 3, 3, 1800, 'admin', '', 1, '2020-02-25', '2020-02-25 10:33:46', '2020-02-25 10:33:46'),
(23, 4, 4, 3, 765, 'admin', '', 1, '2020-03-03', '2020-03-03 08:19:01', '2020-03-03 08:19:01'),
(24, 5, 3, 3, 1593, 'admin', '', 1, '2020-03-03', '2020-03-03 08:19:01', '2020-03-03 08:19:01'),
(25, 3, 2, 3, 1500, 'admin', '', 1, '2020-02-24', '2020-03-03 09:40:19', '2020-03-03 09:40:19'),
(26, 3, 3, 3, 1700, 'admin', '', 1, '2020-02-24', '2020-03-05 07:45:41', '2020-03-05 07:45:41'),
(27, 4, 6, 1, 50, 'admin', 'al_safa', 1, '2020-03-07', '2020-03-07 05:53:08', '2020-03-07 05:53:08'),
(28, 4, 4, 3, 774, 'admin', 'pioneer', 1, '2020-03-07', '2020-03-07 06:30:01', '2020-03-07 06:30:01'),
(29, 7, 16, 5, 235, 'admin', 'al_safa', 1, '2020-03-07', '2020-03-07 10:52:58', '2020-03-07 10:52:58'),
(30, 9, 3, 4, 2400, 'admin', 'pioneer', 1, '2020-03-08', '2020-03-08 11:24:36', '2020-03-08 11:24:36'),
(31, 7, 16, 3, 137, 'admin', 'al_safa', 1, '2020-03-08', '2020-03-08 11:28:55', '2020-03-08 11:28:55'),
(32, 7, 16, 3, 137, 'admin', 'al_safa', 1, '2020-03-08', '2020-03-08 11:30:42', '2020-03-08 11:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `salescarts`
--

CREATE TABLE `salescarts` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `saller_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_status` tinyint(1) NOT NULL DEFAULT 1,
  `sales_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salescarts`
--

INSERT INTO `salescarts` (`id`, `customer_id`, `product_id`, `quantity`, `price`, `saller_name`, `comp`, `sales_status`, `sales_date`, `created_at`, `updated_at`) VALUES
(51, 9, 3, 3, 1780, 'admin', 'pioneer', 1, '2020-03-08 00:00:00', '2020-03-08 11:28:13', '2020-03-08 11:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `totalamount` double NOT NULL,
  `depositeamount` double NOT NULL,
  `remainingamount` double NOT NULL,
  `deposite_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposite_date` date NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `comp`, `password`, `last_login`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Grocery System', 'admin', 'nagarikbazar@gmail.com', '', '$2y$10$lIKCIfwU/4/PMkUDOQYXdOv5TNZBfFGl5XnD/N.PIOF8Tu/ChAAc2', '2020-03-09 16:35:05', 1, 'O56TikPwyrHwgwY5sMtCWn1xnFqFtY0BG9eGPLhYCBTsvmXsBbT0INV0WTM2', '2017-06-05 21:35:29', '2020-03-09 10:35:05'),
(2, 'User Admin', 'user', 'nagarikbazar1@testtest.com', '', '$2y$10$RJobR0XNPlyFr0XL5ENkg./R.lw2yRmxQoU6EW9nntGASaZ89xzQe', '2017-10-29 09:27:32', 1, 't4d8hhkDCOcbq3ASUlkwEHtPb69jZoq16Kl53SpfR9CkHxQd8HW8NwcyghQu', '2017-06-06 19:47:19', '2017-10-29 03:42:32'),
(4, 'New User', 'newuser', 'nagarik@gmail.com', '', '$2y$10$Kf4TSIjuoMPqbAD8yzxQROMv48vAkhK3k5k394Xf9nGWVYFNJ8mrC', NULL, 1, NULL, '2020-02-19 08:39:43', '2020-02-19 08:39:43'),
(5, 'Sazzad', 'sazzad19', 'sazzad@gmail.com', 'pioneer', '$2y$10$gL0UinLelaC9VOvHtCGKUOBkIMh30sdKS5ksTmgELdIZ0QHqutsIK', '2020-03-08 17:31:38', 1, 'AyyHsjBAre2yeR1XdRGk1tgvHxFyWTYJxXkxU2ssK0gUgeSMc541GJ6gijYu', '2020-03-07 05:07:34', '2020-03-08 11:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-06-05 21:35:29', '2017-06-05 21:35:29'),
(4, 3, 5, '2020-03-07 05:07:34', '2020-03-07 05:07:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creditsales`
--
ALTER TABLE `creditsales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creditsales_customer_id_foreign` (`customer_id`),
  ADD KEY `creditsales_product_id_foreign` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_created_by_foreign` (`created_by`),
  ADD KEY `customers_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_created_by_foreign` (`created_by`),
  ADD KEY `employees_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_created_by_foreign` (`created_by`),
  ADD KEY `expenses_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `expensestitles`
--
ALTER TABLE `expensestitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_name_unique` (`name`),
  ADD UNIQUE KEY `modules_module_key_unique` (`module_key`),
  ADD UNIQUE KEY `modules_module_url_unique` (`module_url`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD UNIQUE KEY `permissions_permission_key_unique` (`permission_key`);

--
-- Indexes for table `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productcategories_slug_unique` (`slug`),
  ADD KEY `productcategories_created_by_foreign` (`created_by`),
  ADD KEY `productcategories_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_productcategory_id_foreign` (`productcategory_id`),
  ADD KEY `products_created_by_foreign` (`created_by`),
  ADD KEY `products_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_created_by_foreign` (`created_by`),
  ADD KEY `purchases_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_modules`
--
ALTER TABLE `role_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_modules_role_id_foreign` (`role_id`),
  ADD KEY `role_modules_module_id_foreign` (`module_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_product_id_foreign` (`product_id`);

--
-- Indexes for table `salescarts`
--
ALTER TABLE `salescarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salescarts_product_id_foreign` (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_created_by_foreign` (`created_by`),
  ADD KEY `transactions_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditsales`
--
ALTER TABLE `creditsales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expensestitles`
--
ALTER TABLE `expensestitles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_modules`
--
ALTER TABLE `role_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1254;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `salescarts`
--
ALTER TABLE `salescarts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditsales`
--
ALTER TABLE `creditsales`
  ADD CONSTRAINT `creditsales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creditsales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `productcategories`
--
ALTER TABLE `productcategories`
  ADD CONSTRAINT `productcategories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productcategories_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_productcategory_id_foreign` FOREIGN KEY (`productcategory_id`) REFERENCES `productcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `role_modules`
--
ALTER TABLE `role_modules`
  ADD CONSTRAINT `role_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_modules_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salescarts`
--
ALTER TABLE `salescarts`
  ADD CONSTRAINT `salescarts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
