-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `bwastore-laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bwastore-laravel`;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `photo`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Meet Room',	'assets/category/iAXuaY3I6dJK8IvbHBcF1qSsUXCtIYski0TzwDL0.svg',	'meet-room',	NULL,	'2022-07-11 06:49:10',	'2022-07-28 00:26:49'),
(2,	'Beach',	'assets/category/gwr0cM8C1eYuod92nl1qW6wNU6FtnV1orjAhdr6j.svg',	'beach',	NULL,	'2022-07-28 00:26:33',	'2022-07-28 00:26:33'),
(3,	'Garden',	'assets/category/SYtWDkvlNuFfo4Zf6yyAk4RCBwdJRWAhqCcztcxQ.svg',	'garden',	NULL,	'2022-07-28 00:31:20',	'2022-07-28 00:31:20'),
(4,	'Golf',	'assets/category/Hqb4IzNSAfPP6tzzfcHPW8eXQlPXaKXnWCLLIQYj.svg',	'golf',	NULL,	'2022-07-28 00:31:46',	'2022-07-28 00:31:46'),
(5,	'Private',	'assets/category/fotNko7erbNvqyVjeOpfUIsWjztRtwFgvWE9YCvy.svg',	'private',	NULL,	'2022-07-28 00:32:36',	'2022-07-28 00:32:36'),
(6,	'Pollside',	'assets/category/upNmEK08OiCj1DeR9kegDQSJsRr7Iti8v4Z7qP86.svg',	'pollside',	NULL,	'2022-07-28 00:33:16',	'2022-07-28 00:33:16');

DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency_id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `districts_regency_id_foreign` (`regency_id`),
  KEY `districts_id_index` (`id`),
  CONSTRAINT `districts_regency_id_foreign` FOREIGN KEY (`regency_id`) REFERENCES `regencies` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2017_05_02_140432_create_provinces_tables',	1),
(4,	'2017_05_02_140444_create_regencies_tables',	1),
(5,	'2017_05_02_142019_create_districts_tables',	1),
(6,	'2017_05_02_143454_create_villages_tables',	1),
(7,	'2019_08_19_000000_create_failed_jobs_table',	1),
(8,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(9,	'2022_04_21_063653_create_categories_table',	1),
(10,	'2022_04_21_064421_create_products_table',	1),
(11,	'2022_04_21_064917_create_product_galleries_table',	1),
(12,	'2022_04_21_065411_create_carts_table',	1),
(13,	'2022_04_24_063208_create_transactions_table',	1),
(14,	'2022_04_24_063239_create_transaction_details_table',	1),
(15,	'2022_04_24_073239_delete_resi_field_at_transactions_table',	1),
(16,	'2022_04_25_071235_add_resi_and_shipping_status_to_transaction_details_tables',	1),
(17,	'2022_04_25_071819_add_code_to_transactions_tables',	1),
(18,	'2022_04_25_073427_add_code_to_transaction_details_tables',	1),
(19,	'2022_04_25_074128_add_slug_to_products_table',	1),
(20,	'2022_04_25_074732_add_roles_field_to_users_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `users_id`, `categories_id`, `price`, `description`, `deleted_at`, `created_at`, `updated_at`, `slug`) VALUES
(1,	'Pool View Wedding',	1,	6,	2150,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:39:07',	'2022-07-28 00:39:07',	'pool-view-wedding'),
(2,	'Papel La Casa',	1,	3,	200,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:40:21',	'2022-07-28 00:43:43',	'papel-la-casa'),
(3,	'Taman Tiara Regency',	1,	3,	1350,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:42:18',	'2022-07-28 00:42:18',	'taman-tiara-regency'),
(4,	'Citra Harmoni Garden',	11,	3,	1485,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:46:24',	'2022-07-28 00:46:24',	'citra-harmoni-garden'),
(5,	'Classic Aisle Wedding',	13,	1,	1200,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:47:46',	'2022-07-28 00:47:46',	'classic-aisle-wedding'),
(6,	'Kuta Beach Wedding',	1,	2,	2350,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:48:23',	'2022-07-28 00:48:23',	'kuta-beach-wedding'),
(7,	'Private Wedding Room',	13,	5,	1500,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:50:47',	'2022-07-28 00:50:47',	'private-wedding-room'),
(8,	'Golf Court Wedding',	1,	4,	2100,	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	NULL,	'2022-07-28 00:52:09',	'2022-07-28 00:52:09',	'golf-court-wedding');

DROP TABLE IF EXISTS `product_galleries`;
CREATE TABLE `product_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_galleries` (`id`, `photos`, `products_id`, `created_at`, `updated_at`) VALUES
(1,	'assets/product/iIBEKrN0RALWGYr1ba5LS7XRKs9tAlfqNSz8HT2a.png',	'1',	'2022-07-28 00:39:07',	'2022-07-28 00:39:07'),
(2,	'assets/product/P4H5EDILwne9akjR2qNLuJTUU9mZZ2CCRdBLHu9h.png',	'2',	'2022-07-28 00:40:21',	'2022-07-28 00:40:21'),
(3,	'assets/product/DDPEB5TMRDQvQtGOqIrQ33ef5ocSDZkjFkbRsLTp.png',	'3',	'2022-07-28 00:42:18',	'2022-07-28 00:42:18'),
(4,	'assets/product/tHCUnJSGY5tcnjAMMYn9RJJyHswreAU8HKtF3ltE.png',	'1',	'2022-07-28 00:42:45',	'2022-07-28 00:42:45'),
(5,	'assets/product/rvTY5zQ6aOCEG9AZpBMv4IqwImwWcw5ci9hXFjFu.png',	'1',	'2022-07-28 00:42:50',	'2022-07-28 00:42:50'),
(6,	'assets/product/LmsVSaz3pdB8kCwbPo3a944AdrvdW2ADPOj6n2ui.png',	'1',	'2022-07-28 00:42:55',	'2022-07-28 00:42:55'),
(7,	'assets/product/bN2fY6QF8ctNKJxkg1T10POHKniU1zWl0lNTiYrL.png',	'2',	'2022-07-28 00:43:21',	'2022-07-28 00:43:21'),
(8,	'assets/product/BOIkUGvDVxh7OPSqKvS59zX80Xa9AUvkBivJmZMO.png',	'2',	'2022-07-28 00:43:29',	'2022-07-28 00:43:29'),
(9,	'assets/product/Ynr60mHRPyOs3JFyjKXbyXqrfWgXbpddZHYP4ihT.png',	'2',	'2022-07-28 00:43:36',	'2022-07-28 00:43:36'),
(10,	'assets/product/Y0VccAHxt7IRkCLPSUnZrn34qQjRtzt5izdANp5r.png',	'3',	'2022-07-28 00:44:04',	'2022-07-28 00:44:04'),
(11,	'assets/product/mgqJEG1gPxg0qgO3a7YF7sEe4sqZxcRHppXs5DsM.png',	'3',	'2022-07-28 00:44:09',	'2022-07-28 00:44:09'),
(12,	'assets/product/6ZcxMD9GqAmfVBQTZGK17fxuesJUxw56ULftn4Qs.png',	'3',	'2022-07-28 00:44:15',	'2022-07-28 00:44:15'),
(13,	'assets/product/NWRCb0cN5OQcR1IsnJzjWqGxgGkQ8rvknGQe30ZI.png',	'4',	'2022-07-28 00:46:58',	'2022-07-28 00:46:58'),
(14,	'assets/product/eAAcrlzOx6IZrKaiICinbaqxCgG6TKb3p8EpbHxf.png',	'4',	'2022-07-28 00:46:58',	'2022-07-28 00:46:58'),
(15,	'assets/product/qpJ4DEqf6JGYoz3HyjMhT0ka62am2UAmyPcTi7K2.png',	'6',	'2022-07-28 00:49:16',	'2022-07-28 00:49:16'),
(16,	'assets/product/hWsblDMVshme1NWJ6F0B9jmOdNbkb5oaS7zj5HD9.png',	'5',	'2022-07-28 00:49:31',	'2022-07-28 00:49:31'),
(17,	'assets/product/ep6MT7uoJEIZXZ70CUS6fLH8pxU7tdZaW7QMsINk.png',	'7',	'2022-07-28 00:51:08',	'2022-07-28 00:51:08'),
(18,	'assets/product/cIauVbVr52fQcETtAdJWDObz3avL05Da8YVv0VAT.png',	'8',	'2022-07-28 00:52:34',	'2022-07-28 00:52:34');

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `provinces_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `regencies`;
CREATE TABLE `regencies` (
  `id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `regencies_province_id_foreign` (`province_id`),
  KEY `regencies_id_index` (`id`),
  CONSTRAINT `regencies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `inscurance_price` int(11) NOT NULL,
  `shipping_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `transaction_details`;
CREATE TABLE `transaction_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transactions_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `rental_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_one` longtext COLLATE utf8mb4_unicode_ci,
  `address_two` longtext COLLATE utf8mb4_unicode_ci,
  `provinces_id` int(11) DEFAULT NULL,
  `regencies_id` int(11) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_status` int(11) DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_izin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `address_one`, `address_two`, `provinces_id`, `regencies_id`, `zip_code`, `country`, `phone_number`, `store_name`, `store_status`, `categories_id`, `nik`, `pas_foto`, `ktp`, `surat_izin`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `roles`) VALUES
(1,	'Puspita Kharisma',	'kharis@gmail.com',	NULL,	'$2y$10$BB.fQaqW2lQzpOWJrks.6.0I5RljvKeCfAurWL74ciiXgdXalxShu',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-11 06:43:06',	'2022-07-11 06:43:06',	'ADMIN'),
(5,	'tes',	'tes@gmail.com',	NULL,	'$2y$10$8N08gPsgux8DJNcu39SnlOkHFhJV5Sb0FKJIq9jx8H4q1CzYVjWTK',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'relasidatabaseTA.drawio.png',	0,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-11 07:45:31',	'2022-07-11 07:45:31',	'USER'),
(9,	'aaa',	'aa@gmail.com',	NULL,	'$2y$10$ftRDexSEaFpDx9dS5PeNZugUHGPyLgijnujNjpaL7aVAkbpyWZJPS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'11111111',	'11111111',	0,	1,	'11111111',	NULL,	'Hefa-Store (1).png',	NULL,	NULL,	NULL,	'2022-07-11 17:36:24',	'2022-07-11 17:36:24',	'USER'),
(11,	'Agus Salim',	'agus@gmail.com',	NULL,	'$2y$10$PWMYGDHKU7tcKcL64xCFX..snHPfyP7NqVuUTSq.sdmqAPgpec85e',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'11111111',	'11111111',	0,	1,	'11111111',	'Hefa-Store (1).png',	'Hefa-Store (1).png',	'Hefa-Store (1).png',	NULL,	NULL,	'2022-07-11 18:12:34',	'2022-07-11 18:12:34',	'USER'),
(12,	'blabla',	'iuj@gmail.com',	NULL,	'$2y$10$QbD9gUmZjDdOCJoTV2Y/QOkWH3nxlGI3Ey7CnxsEltPIRFP3gqGlW',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'11111111',	'11111111',	0,	1,	'11111111',	'Hefa-Store (1).png',	'Hefa-Store (1).png',	'Hefa-Store (1).png',	NULL,	NULL,	'2022-07-11 18:18:38',	'2022-07-11 18:18:38',	'USER'),
(13,	'Fajar',	'fajar@mail.com',	NULL,	'$2y$10$O0wG8bSvdo6udvd4V4W.5eM1Xapu/Em3VPv0tAPXEOlQOayBPqUT2',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'091234567890',	'FajarShop',	0,	1,	'3518111122223333',	'WhatsApp Image 2022-07-11 at 19.35.39.jpeg',	'WhatsApp Image 2022-07-11 at 19.35.40 (1).jpeg',	'WhatsApp Image 2022-07-11 at 19.35.40.jpeg',	NULL,	NULL,	'2022-07-12 06:28:50',	'2022-07-12 06:28:50',	'USER');

DROP TABLE IF EXISTS `villages`;
CREATE TABLE `villages` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `villages_district_id_foreign` (`district_id`),
  KEY `villages_id_index` (`id`),
  CONSTRAINT `villages_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-07-29 09:50:51
