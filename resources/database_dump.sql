-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table home24.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table home24.categories: ~10 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Necessitatibus qui quod omnis.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(2, 'Est sed voluptas est cum voluptatem.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(3, 'Voluptatem sit error minima soluta repudiandae.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(4, 'Provident facilis impedit deserunt.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(5, 'Facere unde id occaecati ipsum aut atque labore.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(6, 'Aut dolor velit suscipit velit ad nulla.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(7, 'Earum facilis exercitationem quam inventore odit.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(8, 'Quae magnam doloremque molestias consequatur ea laborum veritatis explicabo.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(9, 'Ut est rerum aut earum.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL),
	(10, 'Sed dolores fuga autem atque minima.', '2018-11-21 07:08:56', '2018-11-21 07:08:56', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table home24.category_product
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_category` (`product_id`,`category_id`),
  KEY `category_product_category_id_foreign` (`category_id`),
  CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table home24.category_product: ~125 rows (approximately)
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 3, '2018-11-21 10:08:56', NULL, NULL),
	(2, 1, 7, '2018-11-21 10:08:56', NULL, NULL),
	(3, 2, 9, '2018-11-21 10:08:56', NULL, NULL),
	(4, 2, 10, '2018-11-21 10:08:56', NULL, NULL),
	(5, 3, 7, '2018-11-21 10:08:56', NULL, NULL),
	(6, 3, 2, '2018-11-21 10:08:56', NULL, NULL),
	(7, 4, 1, '2018-11-21 10:08:56', NULL, NULL),
	(8, 4, 9, '2018-11-21 10:08:56', NULL, NULL),
	(9, 5, 10, '2018-11-21 10:08:56', NULL, NULL),
	(10, 5, 9, '2018-11-21 10:08:56', NULL, NULL),
	(11, 6, 5, '2018-11-21 10:08:56', NULL, NULL),
	(12, 7, 2, '2018-11-21 10:08:56', NULL, NULL),
	(13, 8, 7, '2018-11-21 10:08:56', NULL, NULL),
	(14, 8, 3, '2018-11-21 10:08:56', NULL, NULL),
	(15, 9, 9, '2018-11-21 10:08:56', NULL, NULL),
	(16, 10, 4, '2018-11-21 10:08:56', NULL, NULL),
	(17, 10, 5, '2018-11-21 10:08:56', NULL, NULL),
	(18, 10, 10, '2018-11-21 10:08:56', NULL, NULL),
	(19, 11, 1, '2018-11-21 10:08:56', NULL, NULL),
	(20, 12, 3, '2018-11-21 10:08:56', NULL, NULL),
	(21, 12, 10, '2018-11-21 10:08:56', NULL, NULL),
	(22, 13, 7, '2018-11-21 10:08:56', NULL, NULL),
	(23, 13, 2, '2018-11-21 10:08:56', NULL, NULL),
	(24, 14, 2, '2018-11-21 10:08:56', NULL, NULL),
	(25, 14, 8, '2018-11-21 10:08:56', NULL, NULL),
	(26, 14, 10, '2018-11-21 10:08:56', NULL, NULL),
	(27, 15, 7, '2018-11-21 10:08:56', NULL, NULL),
	(28, 15, 10, '2018-11-21 10:08:56', NULL, NULL),
	(29, 16, 1, '2018-11-21 10:08:56', NULL, NULL),
	(30, 16, 3, '2018-11-21 10:08:56', NULL, NULL),
	(31, 17, 5, '2018-11-21 10:08:56', NULL, NULL),
	(32, 17, 3, '2018-11-21 10:08:56', NULL, NULL),
	(33, 17, 2, '2018-11-21 10:08:56', NULL, NULL),
	(34, 18, 4, '2018-11-21 10:08:56', NULL, NULL),
	(35, 18, 5, '2018-11-21 10:08:56', NULL, NULL),
	(36, 18, 1, '2018-11-21 10:08:56', NULL, NULL),
	(37, 19, 6, '2018-11-21 10:08:56', NULL, NULL),
	(38, 20, 9, '2018-11-21 10:08:56', NULL, NULL),
	(39, 21, 7, '2018-11-21 10:08:56', NULL, NULL),
	(40, 21, 4, '2018-11-21 10:08:56', NULL, NULL),
	(41, 21, 6, '2018-11-21 10:08:56', NULL, NULL),
	(42, 22, 7, '2018-11-21 10:08:56', NULL, NULL),
	(43, 23, 8, '2018-11-21 10:08:56', NULL, NULL),
	(44, 23, 10, '2018-11-21 10:08:56', NULL, NULL),
	(45, 23, 6, '2018-11-21 10:08:56', NULL, NULL),
	(46, 24, 8, '2018-11-21 10:08:56', NULL, NULL),
	(47, 24, 4, '2018-11-21 10:08:56', NULL, NULL),
	(48, 24, 9, '2018-11-21 10:08:56', NULL, NULL),
	(49, 25, 2, '2018-11-21 10:08:56', NULL, NULL),
	(50, 25, 1, '2018-11-21 10:08:56', NULL, NULL),
	(51, 26, 1, '2018-11-21 10:08:56', NULL, NULL),
	(52, 26, 9, '2018-11-21 10:08:56', NULL, NULL),
	(53, 27, 6, '2018-11-21 10:08:56', NULL, NULL),
	(54, 28, 2, '2018-11-21 10:08:56', NULL, NULL),
	(55, 29, 1, '2018-11-21 10:08:56', NULL, NULL),
	(56, 30, 8, '2018-11-21 10:08:56', NULL, NULL),
	(57, 30, 2, '2018-11-21 10:08:56', NULL, NULL),
	(58, 30, 7, '2018-11-21 10:08:56', NULL, NULL),
	(59, 31, 4, '2018-11-21 10:08:57', NULL, NULL),
	(60, 31, 9, '2018-11-21 10:08:57', NULL, NULL),
	(61, 32, 5, '2018-11-21 10:08:57', NULL, NULL),
	(62, 32, 9, '2018-11-21 10:08:57', NULL, NULL),
	(63, 33, 3, '2018-11-21 10:08:57', NULL, NULL),
	(64, 33, 5, '2018-11-21 10:08:57', NULL, NULL),
	(65, 34, 5, '2018-11-21 10:08:57', NULL, NULL),
	(66, 34, 9, '2018-11-21 10:08:57', NULL, NULL),
	(67, 34, 3, '2018-11-21 10:08:57', NULL, NULL),
	(68, 35, 5, '2018-11-21 10:08:57', NULL, NULL),
	(69, 36, 7, '2018-11-21 10:08:57', NULL, NULL),
	(70, 36, 1, '2018-11-21 10:08:57', NULL, NULL),
	(71, 37, 9, '2018-11-21 10:08:57', NULL, NULL),
	(72, 37, 10, '2018-11-21 10:08:57', NULL, NULL),
	(73, 37, 7, '2018-11-21 10:08:57', NULL, NULL),
	(74, 38, 8, '2018-11-21 10:08:57', NULL, NULL),
	(75, 38, 9, '2018-11-21 10:08:57', NULL, NULL),
	(76, 39, 1, '2018-11-21 10:08:57', NULL, NULL),
	(77, 39, 4, '2018-11-21 10:08:57', NULL, NULL),
	(78, 40, 4, '2018-11-21 10:08:57', NULL, NULL),
	(79, 40, 1, '2018-11-21 10:08:57', NULL, NULL),
	(80, 41, 5, '2018-11-21 10:08:57', NULL, NULL),
	(81, 42, 3, '2018-11-21 10:08:57', NULL, NULL),
	(82, 43, 3, '2018-11-21 10:08:57', NULL, NULL),
	(83, 43, 1, '2018-11-21 10:08:57', NULL, NULL),
	(84, 44, 6, '2018-11-21 10:08:57', NULL, NULL),
	(85, 45, 2, '2018-11-21 10:08:57', NULL, NULL),
	(86, 45, 5, '2018-11-21 10:08:57', NULL, NULL),
	(87, 46, 8, '2018-11-21 10:08:57', NULL, NULL),
	(88, 46, 1, '2018-11-21 10:08:57', NULL, NULL),
	(89, 47, 6, '2018-11-21 10:08:57', NULL, NULL),
	(90, 47, 1, '2018-11-21 10:08:57', NULL, NULL),
	(91, 48, 4, '2018-11-21 10:08:57', NULL, NULL),
	(92, 49, 1, '2018-11-21 10:08:57', NULL, NULL),
	(93, 49, 3, '2018-11-21 10:08:57', NULL, NULL),
	(94, 50, 5, '2018-11-21 10:08:57', NULL, NULL),
	(95, 50, 3, '2018-11-21 10:08:57', NULL, NULL),
	(96, 50, 10, '2018-11-21 10:08:57', NULL, NULL);
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;

-- Dumping structure for table home24.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table home24.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(6, '2014_10_12_000000_create_users_table', 1),
	(7, '2014_10_12_100000_create_password_resets_table', 1),
	(8, '2018_11_10_235131_create_products_table', 1),
	(9, '2018_11_12_115021_create_categories_table', 1),
	(10, '2018_11_12_115100_create_category_product_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table home24.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table home24.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table home24.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table home24.products: ~69 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `title`, `description`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Quia tempore exercitationem et alias pariatur repudiandae.', 'Distinctio ut et commodi. Asperiores veniam eius et doloremque. Iusto aliquam voluptas qui delectus.', 4, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(2, 'Sit ut reiciendis voluptatibus aspernatur assumenda dolorum.', 'Aut enim dolor voluptate officia consequatur eum non. Expedita nam amet sapiente quod et nihil. Autem illum dolores voluptatem officia debitis perspiciatis.', 10, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(3, 'Doloribus nemo non saepe enim mollitia magni amet.', 'Repellendus iste quasi officiis et. Quis officia eum saepe est. Temporibus tenetur debitis officiis nam ipsam porro eius.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(4, 'Eos inventore autem aperiam necessitatibus debitis minima saepe.', 'Rerum nisi et possimus. Facilis placeat quam aut ipsa magni. Dignissimos eos provident similique libero eos ipsam dignissimos suscipit. Occaecati nulla voluptas delectus dolores eum quia ex officia. Vitae vel molestiae saepe.', 3, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(5, 'Dolores officiis qui natus.', 'Sunt eveniet enim voluptas illo. Tempora libero fugiat possimus et id delectus. Ut omnis laborum qui. Temporibus deleniti similique omnis a maiores.', 7, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(6, 'Aut iusto tenetur optio quia voluptas necessitatibus dolor.', 'Laborum et nostrum velit quia. Libero magni itaque voluptas necessitatibus ut reiciendis.', 4, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(7, 'Impedit quos animi est.', 'Quos ducimus nihil facere ducimus quis id minus. Deserunt eaque sint qui aut adipisci non. Laborum accusamus ipsum corporis cupiditate officia.', 7, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(8, 'Dolorem eaque nihil ut culpa pariatur magnam.', 'Blanditiis ipsa iste doloremque possimus non itaque unde. A ea tenetur provident qui. Doloribus eos ipsum corporis quibusdam sed commodi. Perspiciatis vero necessitatibus hic reprehenderit aliquid.', 10, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(9, 'At dignissimos omnis necessitatibus eius ducimus.', 'Sunt quis voluptatem modi cumque reiciendis non. Vel praesentium quam voluptates porro voluptas. Alias et repellendus voluptates nihil similique eius nam. Voluptas placeat doloribus eos omnis.', 2, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(10, 'In molestiae eos molestias.', 'Nesciunt necessitatibus qui consequatur. Molestiae esse assumenda ut. Quas sit tempora id omnis. Voluptatem rerum cumque vel.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(11, 'Voluptatem sed qui sint eveniet nulla officia repellat.', 'Eos aut voluptatum perspiciatis dignissimos aliquam eligendi vero quae. Aperiam voluptate qui dignissimos. Qui dolore labore incidunt sequi nesciunt. Mollitia dolores et explicabo aperiam.', 3, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(12, 'Omnis voluptas deserunt earum qui.', 'Aut molestiae illo aperiam error tempore nihil. Officiis fuga quia ut itaque eum atque est. Labore molestias sapiente sunt animi adipisci.', 1, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(13, 'Harum consequatur explicabo ut fugiat aliquid totam.', 'Quos unde ut velit soluta qui. Non omnis perferendis distinctio dolorem quam ut. Porro quod nesciunt et ut est laborum. Aut repellendus quia omnis debitis sed.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(14, 'Illo officia voluptatem consequatur et esse temporibus optio exercitationem.', 'Molestiae dolor quibusdam aliquid corrupti amet. Repellat aperiam aut quo excepturi sunt praesentium commodi id. Perferendis ex commodi iste dolor.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(15, 'Possimus possimus cupiditate aut incidunt veritatis reiciendis.', 'Vel qui commodi occaecati illo exercitationem. Maxime ut nam dolor aut atque magni qui. Impedit laboriosam sit quia ut.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(16, 'Quas officiis porro velit possimus eos mollitia totam.', 'Placeat a dolore libero quos. Reprehenderit porro est corrupti incidunt qui labore. Nihil adipisci voluptas et et ut iure. Distinctio excepturi expedita quia at aliquam optio.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(17, 'Quia ratione nisi ut.', 'Consequatur ut amet sed qui rerum voluptatem et eos. Aspernatur quo dolor consequatur hic eos dolorem quis. Aliquid molestiae velit voluptas harum et similique architecto enim. Ducimus ut ipsam facilis architecto voluptatem.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(18, 'Eaque fuga sunt tempora voluptates.', 'Ipsum voluptas molestiae illo cupiditate. Sint fugit velit cupiditate distinctio et. Ut consequuntur minus recusandae maiores et eligendi et.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(19, 'Quod minima eaque et ea.', 'Commodi pariatur asperiores cupiditate temporibus in. Quae aut eveniet vel quos eos ipsa. In enim rerum impedit repellendus temporibus quos. Et velit dicta voluptatum non doloribus esse est.', 1, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(20, 'Aliquam eligendi nostrum repellendus corrupti perspiciatis soluta perspiciatis.', 'Consectetur consequuntur quam sunt dolorem. Velit distinctio et quasi molestiae at dolores quia.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(21, 'Dolorem dicta amet totam eos.', 'Facere voluptas perferendis dolorum vel. Assumenda nihil ipsam repudiandae itaque aut odit sit. Nemo voluptas ipsa repudiandae saepe aspernatur explicabo. Eum neque sit nobis vel vel ea.', 2, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(22, 'Deleniti quia voluptatum quis quo qui et laudantium.', 'Molestias eligendi enim soluta ipsa aut voluptas. Numquam quae laborum quam explicabo dicta eos laborum est. Eius et voluptas tempora consequatur.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(23, 'A maiores tempora qui nam provident.', 'Qui dolor voluptas a consequuntur ut dolor. Mollitia doloribus et saepe sit eaque. Id laudantium blanditiis quae consequatur dolor sunt.', 10, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(24, 'Natus quo tenetur blanditiis dolores sapiente.', 'Ad repellendus consequatur et quo. Et est alias qui nam delectus ut facere. Officia hic totam et quia provident autem.', 3, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(25, 'Et voluptas in adipisci repellendus et maiores deserunt.', 'Rerum in eos vitae magnam. Omnis eaque omnis corrupti quae. Ut commodi vel praesentium assumenda.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(26, 'Harum non dolor ex dolorem.', 'Temporibus voluptas est omnis vel praesentium tempora officiis. Corporis omnis neque harum inventore.', 7, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(27, 'Explicabo nesciunt qui quas ipsam voluptatum sunt est.', 'Non et animi non debitis. Earum non qui recusandae nobis esse fuga in nobis. Eveniet quibusdam quia eius nihil cum ab velit. Deserunt suscipit nisi ipsam dignissimos molestiae.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(28, 'Dolor ipsum quis consequuntur aut cumque nisi.', 'Cum et molestiae impedit consectetur. Quas et omnis debitis architecto consequatur adipisci omnis.', 10, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(29, 'Ipsam laudantium autem unde ad magnam nisi.', 'Reiciendis quo nulla maxime mollitia architecto doloremque sit. Dolorem accusantium quo iure distinctio. Voluptatibus incidunt ad velit eos est temporibus.', 2, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(30, 'Consequatur accusamus voluptatibus voluptate quasi minima praesentium.', 'Eos saepe tempore quia nobis vel veritatis nemo. Odit voluptas non qui molestiae ea. Quam repellat tempore voluptatibus dolorem. Totam incidunt sunt facere non veritatis.', 8, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(31, 'Voluptates labore debitis voluptatem quia.', 'Quaerat neque facere nostrum hic ullam deserunt. Dolor nobis voluptas ut ullam quidem qui sunt et. Quis aut commodi et corporis et odit. Cumque numquam maxime iure consequatur dolor et.', 8, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(32, 'Error minus unde aut dolorem consequatur.', 'Quia vero rerum temporibus aut perferendis. Voluptatem nostrum a perspiciatis ullam fugiat voluptatem. A aliquid quia nesciunt est eos. Eos et culpa temporibus corrupti.', 7, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(33, 'Vel qui nulla consequuntur ipsam maiores dolores.', 'Est assumenda magni ut. Nostrum quia sed eligendi reprehenderit. Molestiae dolores veniam sit ut neque modi ut et. Quia nesciunt qui consequatur voluptas est dignissimos.', 8, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(34, 'Omnis sed autem qui temporibus culpa quia.', 'Voluptates ab quia non et non id. Commodi sit soluta ut inventore. Quod sit dolores praesentium facilis libero saepe culpa. Suscipit ea consectetur qui molestiae cum consequatur aut.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(35, 'Accusamus rerum praesentium et illo.', 'Quisquam voluptatem adipisci a qui ex. Aut porro libero cum non repudiandae. Deserunt pariatur ipsum ex delectus consequatur cupiditate. Quisquam asperiores omnis natus expedita.', 5, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(36, 'Non in sint ducimus dolorem perspiciatis quia.', 'Deleniti voluptatum autem quod soluta necessitatibus. Nostrum est reiciendis ea voluptatem et explicabo cumque consectetur. Nihil sit ab asperiores beatae optio qui quis eos. Odit ratione tempore earum hic blanditiis sed.', 7, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(37, 'Soluta et occaecati hic soluta quasi sunt qui.', 'Necessitatibus debitis quia atque dolor asperiores. Culpa fugit eum sit odio nulla dolor non. Autem reprehenderit deserunt error minus hic maiores. Adipisci quos velit ipsa veritatis et qui quo.', 6, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(38, 'Aliquid molestiae saepe modi accusamus.', 'Vero rem tenetur perspiciatis sint voluptates. Sequi hic aut ipsam sit iusto non et delectus. Numquam recusandae quidem ab ducimus. Voluptas tempore et sunt laudantium.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(39, 'Qui sit assumenda ut.', 'Porro laborum inventore incidunt aut sit ut tenetur. Et quasi fugit adipisci aut illo ab. Est corrupti explicabo odit ab et accusamus. Iusto autem occaecati modi qui illo. A similique consequatur provident qui et sed.', 1, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(40, 'Vel aut possimus cupiditate eaque maxime sit temporibus.', 'Quasi optio sit quidem error exercitationem. Perspiciatis consequatur laudantium voluptatem et tenetur. Natus molestias iste vitae et possimus suscipit. Ut culpa porro tenetur ullam exercitationem.', 7, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(41, 'Sint eum aut repellat quibusdam non.', 'Similique aut eveniet voluptates a delectus. Velit similique repellat est earum qui non. Et aut ut sit dolorem corporis. Rem quas reiciendis soluta inventore ducimus non.', 9, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(42, 'Ut dolores sed quos itaque hic quisquam.', 'Expedita harum est assumenda perferendis ratione voluptates. In in at dolorem exercitationem esse. Rerum repudiandae neque quo vel nesciunt magnam modi.', 6, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(43, 'Qui at sit exercitationem quo laborum minima.', 'Voluptatum necessitatibus et eum dolorum. Fugit numquam exercitationem vero deserunt. Rerum expedita ipsum quaerat quo totam odit. Exercitationem vel repellat quia ratione.', 1, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(44, 'Possimus sunt sit molestiae vel autem commodi et.', 'Velit sit omnis facere eligendi alias repellendus nulla eligendi. Soluta rerum excepturi nostrum eum quo voluptates qui. Tempore magnam temporibus laborum ut. Molestiae tenetur minus dolorem.', 8, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(45, 'Aperiam quia omnis sunt id libero ut voluptas.', 'Qui fugit iure asperiores aut id et ducimus. Error ut voluptas et deserunt harum. Velit nihil labore voluptatem nobis. Magni natus eum nam.', 1, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(46, 'Consequatur reiciendis eligendi ea quos ea dolorum.', 'Sed cumque facere ea vel. Accusamus fugit similique distinctio. Quas ratione aut dolorum necessitatibus nam.', 3, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(47, 'Fuga quis vel mollitia at quia ab.', 'Et qui officia est reprehenderit expedita sed. Est sequi voluptate deserunt quae. Molestiae esse quis voluptas architecto qui recusandae.', 4, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(48, 'Totam nam ut aut odit eligendi eaque sequi.', 'Tempora et temporibus voluptate earum atque est facere. Odio at impedit aut rerum dolore voluptatem perspiciatis. Officia sit aut vel qui suscipit saepe. Quia ducimus sit et asperiores a omnis.', 4, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(49, 'Omnis assumenda labore iste exercitationem accusamus exercitationem quo.', 'Rerum qui fugiat rerum quo totam aut. Impedit qui sed sit temporibus ea. Sapiente qui non dolores velit harum doloremque possimus ut.', 1, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL),
	(50, 'Eum neque omnis quos.', 'Deserunt blanditiis laboriosam vel temporibus necessitatibus ipsum et et. Voluptatibus ducimus enim sequi ipsam similique suscipit non. Dolore et placeat rerum et. Dolor consequatur id ea omnis sunt corrupti aliquam.', 4, '2018-11-21 07:08:55', '2018-11-21 07:08:55', NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table home24.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_limit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table home24.users: ~12 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rate_limit`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@test.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:54', '2018-11-21 07:08:54'),
	(2, 'Willa Bailey', 'wanda.haley@langosh.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:54', '2018-11-21 07:08:54'),
	(3, 'Cyril Kunde', 'maeve23@yahoo.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:54', '2018-11-21 07:08:54'),
	(4, 'Cruz King', 'hoppe.okey@hotmail.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55'),
	(5, 'Jacques Mueller', 'gennaro.kassulke@adams.biz', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55'),
	(6, 'Miss Madaline Dickens', 'kole14@grimes.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55'),
	(7, 'Lew Donnelly', 'bschmeler@hotmail.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55'),
	(8, 'Davion Haley III', 'rohan.pete@heaney.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55'),
	(9, 'Aniyah Morar', 'macie.emard@yahoo.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55'),
	(10, 'Madeline Hoppe Sr.', 'ebert.benjamin@gmail.com', NULL, '$2y$10$1XLnZ1Md7MkPJpU.pEQ.aexTc5kcsCguTY4VVNR855W.ErYhwiL02', NULL, '2018-11-21 07:08:55', '2018-11-21 07:08:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
