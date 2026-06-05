-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: nota_benz
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Journal','journal','active',1,'2026-05-11 19:58:41','2026-05-11 19:58:41'),(2,'Travel','travel','active',2,'2026-05-11 19:58:41','2026-05-11 19:58:41'),(3,'Yada Yada Yada','yada-yada-yada','active',3,'2026-05-11 19:58:41','2026-05-11 19:58:41'),(4,'Letters','letters','active',4,'2026-05-11 19:58:42','2026-05-11 19:58:42'),(5,'Manifestos','manifestos','active',5,'2026-05-11 19:58:42','2026-05-11 19:58:42');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`),
  KEY `blogs_blog_category_id_foreign` (`blog_category_id`),
  KEY `blogs_created_by_foreign` (`created_by`),
  KEY `blogs_updated_by_foreign` (`updated_by`),
  CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `blogs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `blogs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,5,'Don\'t let the Bastards Grind You Down','dont-let-the-bastards-grind-you-down','<p><span style=\"background-color: initial;\">Nuestra Señora de las Mercedes</span></p><p><strong style=\"background-color: initial;\">Patroness of Prisoners and Captives.</strong></p><p><span style=\"background-color: initial;\">Our Lady of Mercy or Our Lady of Ransom</span></p><p><img src=\"/storage/blog-editor/MG3Xog4IIdSPCd92f63Xqgrk10ebLaQuCbzkQiQs.avif\" width=\"308\"></p><p><strong style=\"background-color: initial;\"><em>Invoked for the protection of those captives by ICE and for the \"ransom\" of souls from the bondage of sin.</em></strong></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">The Order of the Blessed Virgin Mary of Mercy – </span><strong style=\"background-color: initial;\"><em>Mercedarians</em></strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;- was </span><strong style=\"background-color: initial;\">established to ransom</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;Christians held captive during the Crusades and the Moorish occupation of Spain.</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">Los Mercedarios – The Mercedarians were founded in 1218 in Barcelona, Spain, after a vision of the Virgin Mary shared by St. Peter Nolasco, St. Raymond of Penyafort, and King James I of Aragon. Inspired by this vision, Members of the order </span><strong style=\"background-color: initial;\">pledged a Fourth Vow to act as hostages</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;and even </span><strong style=\"background-color: initial;\">exchange their own lives</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;for prisoners\' freedom.</span></p><p><strong style=\"background-color: initial;\">Still Today, </strong><span style=\"background-color: rgba(0, 0, 0, 0);\">as Our Mother of Freedom and Liberation she is </span><strong style=\"background-color: initial;\">the official patroness of prisons and inmates in several countries</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">, including Spain, Venezuela, and the Dominican Republic. In many regions, Her feast day is marked by </span><strong style=\"background-color: initial;\">visits to prisons</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">, where religious services are held and, in some historical traditions</span><span style=\"background-color: initial;\">, groups of prisoners were </span><a href=\"https://casadecampoliving.com/dominican-republic-celebrates-the-dia-de-la-virgen-de-las-mercedes/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: initial; color: rgb(0, 6, 36);\"><strong><u>granted pardon</u></strong></a><strong style=\"background-color: initial; color: rgb(0, 6, 36);\"><u> </u></strong><strong style=\"background-color: initial;\">in her </strong><a href=\"http://honor.do/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: initial; color: rgb(0, 6, 36);\"><strong><u>honor</u></strong><u>.</u></a><strong style=\"background-color: initial; color: rgb(0, 6, 36);\"><u> </u></strong></p><p><img src=\"/storage/blog-editor/ahybcyZI7blrvmPHMGXvsGF073sZ7jwuxAHlQ5sI.avif\"></p><p>By Luis Jose Rueda Aparicio - Archbishop of Bogota, Colombia- September 2025</p><p><span style=\"background-color: rgba(0, 0, 0, 0);\"> Our Lady of Mercedes is often shown in the Mercedarians\' </span><strong style=\"background-color: initial;\">White</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;</span><strong style=\"background-color: initial;\">Habit</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;– Symbolizing Purity. </span><strong style=\"background-color: initial;\">Holding Broken Chains or Shackles</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">, symbolizing the breaking of spiritual and physical bonds. </span><strong style=\"background-color: initial;\">Mercedarian Shield:</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">&nbsp;An emblem of protection and faith worn on her breast or depicted nearby. </span><strong style=\"background-color: initial;\">Bags of Coins</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">: Sometimes shown carrying money, representing funds raised for ransoming captives. Also often depicted in the Madonna della Misericordia - Virgin of Mercy- pose, sometimes sheltering captives under her cloak.</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">Besides prisoners, She is also the patron saint of the </span><strong style=\"background-color: initial;\">Dominican Republic, Barcelona</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">, and various towns in Spain and Latin America.&nbsp;</span><strong style=\"background-color: initial;\"><em>Dia De Las Mercedes</em>&nbsp;</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">or</span><strong style=\"background-color: initial;\">&nbsp;</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">the Feast of Our Lady of Mercy is observed annually on</span><strong style=\"background-color: initial;\">&nbsp;September 24 as an Official Holyday </strong><span style=\"background-color: rgba(0, 0, 0, 0);\">in Barcelona and Dominican Republic.</span><strong style=\"background-color: initial;\">&nbsp;</strong><span style=\"background-color: rgba(0, 0, 0, 0);\">The feast day is a time to thank Her Grace for the Mercy shown, particularly in rescuing those in dire circumstances.</span></p><p><strong style=\"background-color: rgba(0, 0, 0, 0); color: rgb(0, 0, 0);\">Novena<em> Prayer to Our Lady of Mercedes</em></strong></p><p><img src=\"/storage/blog-editor/lo1oqF1ZqtceKlkNOzx1v8oe4BomyfWvvhe1mLRF.avif\"></p><p><span style=\"background-color: initial;\">NUESTRA SENORA DE LAS MERCEDES DEL SANTO CERRO, REPUBLICA DOMINICANA</span></p><p><span style=\"background-color: initial;\">O Virgin of Mercedes, </span><span style=\"background-color: rgba(0, 0, 0, 0);\"> </span><em style=\"background-color: initial; color: rgb(10, 10, 10);\">source of all goodness, </em></p><p><em style=\"color: rgb(10, 10, 10); background-color: initial;\"> glory of the helpless, messenger of freedom and mercy, refuge of those suffering aid of the captive, shelter of the oppressed, </em></p><p><em style=\"color: rgb(10, 10, 10); background-color: initial;\">redeemer of injustice intercede for us all.</em><span style=\"color: rgb(10, 10, 10); background-color: initial;\">&nbsp;</span><em style=\"color: rgb(10, 10, 10); background-color: initial;\">Oh Mary, mother of mercy, do not leave us handed over to our weak forces intercede for us.</em></p><p><em style=\"color: rgb(10, 10, 10); background-color: initial;\">Redemptive Mother allows forgiveness to be the way to live in peace. Virgin of Mercedes, pray for us.</em></p><p><em style=\"color: rgb(10, 10, 10); background-color: initial;\">Mother of kindness, accompany the imprisoned and those who carry invisible prisons in their souls</em></p>','blogs/lRxN5lOaKb0JLJBEbPKb1aZr3WKYw1gJ41LMXGIv.png',1,'2026-05-12 18:18:00',1,1,'2026-05-12 18:18:59','2026-05-13 23:27:02'),(2,3,'THE FIRST MERCEDES WAS NOT A BENZ','the-first-mercedes-was-not-a-benz','<p><span style=\"background-color: rgba(0, 0, 0, 0);\">That’s my name, Mercedes. If you are not Latinx you probably say - \"Like the car\". Then, to keep the conversation going, maybe I would respond- \"The car was named after a woman\".&nbsp;- \"A beautiful woman”, you might go on. Of course, if you find the Benz beautiful, what else could the real Mercedes Jellinek have been? I learned to kind-of-like this back and forth.&nbsp;-What? You did not know she was the daughter of one of the builders? It was Jellinek and Benz. Wikipedia has pictures of her. I’m glad that she seemed to be beautiful. - Jellinek-Benz as a car brand was not going to cut it. When I am in an educational mood, I could go on and tell you that there is a highly revered Madonna, Nuestra Señora de Las Mercedes - Our Lady of Mercy. And, if I feel like getting personal, I could say that I was born on Her day, a big celebration in the Dominican Republic, also in Spain, and many Latinx countries.&nbsp;If I feel intimate, I could venture to tell you that as a child, seeing The Car cruising thru my raggedy neighborhood made mothers hush their children to hide indoors. Boys and girls, especially the pubescents ones.</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">If I\'m wearing my jester hat, you might hear me say - \"Yes, but I\'m a Limited Edition. Custom Made, All Original Parts\"- Or - “Vintage, Mint Condition\".&nbsp;Heck, after I must spell it over the phone, to make sure they got it right, I would say -\"Mercedes, like the car\", assuming we all know how to spell the Benz name.</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">Growing up I didn’t like to be called Mercedes. It sounded too serious, too grown up. I liked my middle name better, so everybody called me Amarilis/Amarillys. I erased Mercedes from my life, even from official papers. Well, not from all of them. Until I got my first official job at a USA official office.&nbsp;I had to use my first name like it was on the very official papers. And there it was Mercedes quietly waiting for her moment, because the payroll secretary was insistent on making everything consistent. Plus, at the parties, and everywhere, people asked me if they could call me Maria, because they couldn’t make it beyond three syllables to say “Amarilis”. So, Mercedes sprang to action and came to the rescue. After all, it is my name. But at first it felt strange, as if I was talking about somebody else. Many people change their name when they join certain communities -nuns, monks, artists- because they wanted a new image, starting a new life. It was like wearing a beautiful old pair of shoes for the first time in a long time. I admit now that I resented having to switch names. So many new things to learn, to adopt and adapt. Even the name. Asking me if I was named after a car was not a conversation starter. At least, not a congenial one. Now, after all these years, all that is meaningless. It’s just stories to tell or to forget. Or to remember in gratitude to all the Mercedes NotaBenz that have made my name famous.</span></p>','blogs/wAGJYBoQ4mc1QURZ7NXrmeFJoEslGnDeZOBO2pBR.png',1,'2026-05-12 19:51:00',1,1,'2026-05-12 19:51:13','2026-05-12 19:52:27'),(3,2,'Walking Without a Map','walking-without-a-map','<p><span style=\"background-color: rgba(0, 0, 0, 0);\">Travel, for me, is not about destinations — it’s about listening.Listening to unfamiliar streets, languages I don’t fully understand, and the quiet lessons that only movement can teach.</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">Every journey leaves a mark, even the ones that don’t make it to photographs. This space holds stories from roads taken slowly and intentionally.</span></p>','blogs/XWD86pZqUQpsNjND8p4qUvUMvNubjhaIONpHNTW3.png',1,'2026-05-12 19:56:35',1,NULL,'2026-05-12 19:56:35','2026-05-12 19:56:35'),(4,1,'Morning Pages & Quiet Truths','morning-pages-quiet-truths','<p><span style=\"background-color: rgba(0, 0, 0, 0);\">Some mornings begin before the world wakes up.I sit with my coffee, my thoughts half-formed, and let the words arrive without judgment. These pages are not meant to impress or explain — they exist to untangle the noise inside my head.</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">This journal is a place for raw moments, unfinished ideas, and the gentle discipline of showing up to myself every day.</span></p>','blogs/RHf9eWStAPsVP31UCZc5ksNOp0iMJBpPXhwFwJWE.png',1,'2026-05-12 19:59:45',1,NULL,'2026-05-12 19:59:45','2026-05-12 19:59:45'),(5,2,'Havana Ooh Na-Na','havana-ooh-na-na','<p><span style=\"background-color: rgba(0, 0, 0, 0);\">Bar Hopping and Santeria. If you are in Havana -Habana- that’s</span></p><p><span style=\"background-color: rgba(0, 0, 0, 0);\">what you do. And bar hopping means El Floridita and La Bodeguita del Medio, Ernest Hemingway watering holes.</span></p>','blogs/VST7gfGwT2QZQFmVXzMfIBBwIuguokDx8pG2rRDU.gif',1,'2026-05-12 20:10:33',1,NULL,'2026-05-12 20:10:33','2026-05-12 20:10:33'),(6,5,'MORNING PAGES AND KEYWORDS','morning-pages-and-keywords','<p><span style=\"background-color: rgba(0, 0, 0, 0);\">Morning pages are supposed to be private. I have to explain what’s morning pages if this is going to be the blog the first blog the one that hooks the reader and have the algorithm busy I got to get the keywords that sells. I here circling around the issue of jumping into the mush pit like if there is someone reading, like if I couldn’t see that the space is empty. Empty space. I’m jumping into emptiness. I’m forcing myself to mix the stream of consciousness morning pages. Ok keyword, the artist way-Julia Cameron. You just write like if no one is reading, not even you. But that’s not gonna happen because at some point I have to read it at least to see how horrible it is or not so horrible, Not AI. But it is not easy to stand as if naked, think nobody is watching, not knowing that in effect somebody is watching. Well, that’s why I’m trying, I wish I could give something wholesome, genuine, full of blemishes and even tripe, but truly mine. Toward the crowd. Into the crowd. Viaje Hacia La Muchedumbre. Pedro Mir lips and mine on a New City Poet’s Open Mic night. Those are good keywords, don’t you think? I see myself as in a Matrix movie, walking into the multitude, merging, disappearing into everybody, unrecognized by myself, anonymous. This thing of getting onto the internet, blogging, having a website. Needing a website. Wanting a website. Is the Order of Things, El Orden del Discurso, all over again, and I can see why Foucault – I shouldn’t use French names, what if I alienate some of my audience? Well don’t mind me, forget the French, his name was Michel. That’s easier, and I like his writing, that’s why he comes to mind now because I’m wishing at this moment I didn’t have to jump, I wish I didn’t have to start, to begin. I wish I was already in the middle of my own speech, and somebody was reading me now just because it was reading me yesterday or last month. Years going around this idea, trying to get out of the shell for so long. Years of thinking about how to do it. I got used to it. I took care of that image like a precious Barby doll, kept in the original box, and now it’s like somebody else is coming out. I’m looking at the doll in the box as if it were not me, and yet, it was I. And it will not be anymore. I’m driving AI crazy with this grammatical jambalaya, broken English gumbo. That’s why it’s called Stream of Consciousness. J. Cameron says to write the morning pages like that. First thing in the morning. These days everything is so polished. Yes, I’m gonna correct the spelling and some punctuation for any gracious reader that happened to catch me on the Mush Pit. Going down, diving into the Crowd. But AI is not happy with my prose, and I like that. Let’s break the ice just like that. Ok. This is my first blog. If you are here now. And I will be part of your journey. You already are part of mine.</span></p>','blogs/0Hm34qGWIF4eHKPWJWTG53wFlogtKNXapE13sO3T.png',1,'2026-05-12 20:15:25',1,1,'2026-05-12 20:14:56','2026-05-12 20:15:25');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('nota-benz-cache-illuminate:queue:restart','i:1778716283;',2094076283);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (4,2,23,2,16.50,'2026-05-12 22:21:55','2026-05-12 22:22:02');
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,NULL,'JQo68sQFCTySoEYGzt93YECCjpHR8vLgV05LZSla','2026-05-05 22:37:30','2026-05-05 22:37:30'),(2,1,NULL,'2026-05-12 20:31:33','2026-05-12 20:31:33'),(3,NULL,'2mRsDgGffYYdCOWUvtwCL1B5liuWaoC1imKfhU7r','2026-05-13 19:25:50','2026-05-13 19:25:50');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_module_permissions`
--

DROP TABLE IF EXISTS `cms_module_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_module_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` int NOT NULL,
  `is_add` tinyint(1) NOT NULL DEFAULT '1',
  `is_view` tinyint(1) NOT NULL DEFAULT '1',
  `is_update` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_module_permissions`
--

LOCK TABLES `cms_module_permissions` WRITE;
/*!40000 ALTER TABLE `cms_module_permissions` DISABLE KEYS */;
INSERT INTO `cms_module_permissions` VALUES (1,'admin',1,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(2,'admin',2,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(3,'admin',3,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(4,'admin',5,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(5,'admin',6,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(6,'admin',4,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(7,'admin',7,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(8,'admin',8,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(9,'admin',9,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(10,'user',1,0,1,0,0,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(11,'user',4,1,1,1,1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40');
/*!40000 ALTER TABLE `cms_module_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_modules`
--

DROP TABLE IF EXISTS `cms_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_modules`
--

LOCK TABLES `cms_modules` WRITE;
/*!40000 ALTER TABLE `cms_modules` DISABLE KEYS */;
INSERT INTO `cms_modules` VALUES (1,0,'Dashboard','admin.dashboard','fa-regular fa-house',1,'active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(2,0,'Users','users.index','fa-solid fa-users',2,'active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(3,0,'Products','products-module','fa-solid fa-box-open',3,'active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(4,0,'Orders','orders.index','fa-solid fa-list-ul',4,'active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(5,3,'All Categories','product-categories.index','fa-solid fa-tags',1,'active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(6,3,'All Products','products.index','fa-solid fa-list-ul',2,'active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(7,0,'Blogs','blogs-module','fa-solid fa-book-open',5,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(8,7,'Blog categories','blog-categories.index','fa-solid fa-tags',1,'active','2026-05-11 19:58:40','2026-05-11 19:58:40'),(9,7,'All posts','blogs.index','fa-solid fa-list-ul',2,'active','2026-05-11 19:58:40','2026-05-11 19:58:40');
/*!40000 ALTER TABLE `cms_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_28_230800_create_cms_modules_table',1),(5,'2026_04_28_230924_create_cms_module_permissions_table',1),(6,'2026_04_29_191307_create_product_categories_table',1),(7,'2026_04_29_191308_create_product_types_table',1),(8,'2026_04_29_191309_create_products_table',1),(9,'2026_04_29_194427_create_attributes_table',1),(10,'2026_04_29_203416_create_product_images_table',1),(11,'2026_04_30_191153_create_product_attribute_items_table',1),(12,'2026_05_02_120000_add_product_attribute_item_id_to_product_images_table',1),(13,'2026_05_04_120000_create_product_variations_table',1),(14,'2026_05_04_120001_create_product_variation_values_table',1),(15,'2026_05_04_120002_add_product_variation_id_to_product_images_table',1),(16,'2026_05_04_205159_create_carts_table',1),(17,'2026_05_04_205348_create_cart_items_table',1),(18,'2026_05_04_224934_create_orders_table',1),(19,'2026_05_04_225037_create_order_items_table',1),(20,'2026_05_04_225234_create_order_addresses_table',1),(21,'2026_05_08_221709_create_blogs_table',2),(22,'2026_05_11_120000_create_blog_categories_table',3),(23,'2026_05_11_120001_add_columns_to_blogs_table',3),(24,'2026_05_12_000000_drop_excerpt_from_blogs_table',3),(25,'2026_05_12_000001_remove_dummy_all_products_product_category',4),(26,'2026_05_12_120000_add_color_key_to_product_images_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_addresses`
--

DROP TABLE IF EXISTS `order_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_addresses_order_id_foreign` (`order_id`),
  CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_addresses`
--

LOCK TABLES `order_addresses` WRITE;
/*!40000 ALTER TABLE `order_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_qty` int NOT NULL DEFAULT '0',
  `total` decimal(10,2) NOT NULL,
  `order_status` enum('pending','processing','shipped','delivered','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_intent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attribute_items`
--

DROP TABLE IF EXISTS `product_attribute_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_attribute_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_attribute_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_items_product_attribute_id_foreign` (`product_attribute_id`),
  KEY `product_attribute_items_product_id_foreign` (`product_id`),
  KEY `product_attribute_items_created_by_foreign` (`created_by`),
  KEY `product_attribute_items_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_attribute_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `product_attribute_items_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attribute_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attribute_items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attribute_items`
--

LOCK TABLES `product_attribute_items` WRITE;
/*!40000 ALTER TABLE `product_attribute_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_attribute_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_created_by_foreign` (`created_by`),
  KEY `product_attributes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_attributes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `product_attributes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attributes`
--

LOCK TABLES `product_attributes` WRITE;
/*!40000 ALTER TABLE `product_attributes` DISABLE KEYS */;
INSERT INTO `product_attributes` VALUES (1,'Short-Sleeve T-Shirt',1,NULL,'2026-05-11 23:10:13','2026-05-11 23:10:13'),(2,'Color',1,NULL,'2026-05-11 23:42:18','2026-05-11 23:42:18'),(3,'Size',1,NULL,'2026-05-11 23:42:18','2026-05-11 23:42:18');
/*!40000 ALTER TABLE `product_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (2,'NOTaBENZ','notabenz','active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(3,'POLKA DOTS COLLECTION','polka-dots','active','2026-05-05 22:37:02','2026-05-05 22:37:02'),(4,'TAINO COLLECTION','taino-collection','active','2026-05-11 19:58:40','2026-05-11 19:58:40');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `product_attribute_item_id` bigint unsigned DEFAULT NULL,
  `product_variation_id` bigint unsigned DEFAULT NULL,
  `color_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_created_by_foreign` (`created_by`),
  KEY `product_images_updated_by_foreign` (`updated_by`),
  KEY `product_images_product_attribute_item_id_foreign` (`product_attribute_item_id`),
  KEY `product_images_product_variation_id_foreign` (`product_variation_id`),
  KEY `product_images_product_id_color_key_index` (`product_id`,`color_key`),
  CONSTRAINT `product_images_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `product_images_product_attribute_item_id_foreign` FOREIGN KEY (`product_attribute_item_id`) REFERENCES `product_attribute_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_images_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_images_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=479 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (42,1,NULL,NULL,NULL,'uploads/products/magsafe/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:40','2026-05-13 17:42:54'),(43,1,NULL,NULL,NULL,'uploads/products/magsafe/02.avif',0,1,NULL,NULL,'2026-05-11 19:58:40','2026-05-13 17:42:54'),(44,1,NULL,NULL,NULL,'uploads/products/magsafe/03.avif',0,2,NULL,NULL,'2026-05-11 19:58:40','2026-05-13 17:42:54'),(45,1,NULL,NULL,NULL,'uploads/products/magsafe/04.avif',0,3,NULL,NULL,'2026-05-11 19:58:40','2026-05-13 17:42:54'),(46,1,NULL,NULL,NULL,'uploads/products/magsafe/05.avif',0,4,NULL,NULL,'2026-05-11 19:58:40','2026-05-13 17:42:54'),(56,4,NULL,NULL,NULL,'uploads/products/tumbler/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:52:48'),(57,4,NULL,NULL,NULL,'uploads/products/tumbler/02.avif',0,1,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:52:48'),(58,4,NULL,NULL,NULL,'uploads/products/tumbler/03.avif',0,2,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:52:48'),(59,4,NULL,NULL,NULL,'uploads/products/tumbler/04.avif',0,3,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:52:48'),(60,5,NULL,NULL,NULL,'uploads/products/water-bottle/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:56:31'),(61,5,NULL,NULL,NULL,'uploads/products/water-bottle/02.avif',0,1,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:56:31'),(62,5,NULL,NULL,NULL,'uploads/products/water-bottle/03.avif',0,2,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:56:31'),(63,5,NULL,NULL,NULL,'uploads/products/water-bottle/04.avif',0,3,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:56:31'),(64,6,NULL,NULL,NULL,'uploads/products/heavy-shirt/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:55:48'),(65,6,NULL,NULL,NULL,'uploads/products/heavy-shirt/02.jpg',0,1,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:55:48'),(66,6,NULL,NULL,NULL,'uploads/products/heavy-shirt/03.jpg',0,2,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:55:48'),(67,6,NULL,NULL,NULL,'uploads/products/heavy-shirt/04.jpg',0,3,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:55:48'),(68,7,NULL,NULL,NULL,'uploads/products/canvas-shoes/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:43:32'),(69,7,NULL,NULL,NULL,'uploads/products/canvas-shoes/02.avif',0,1,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:43:32'),(70,7,NULL,NULL,NULL,'uploads/products/canvas-shoes/03.avif',0,2,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:43:32'),(71,7,NULL,NULL,NULL,'uploads/products/canvas-shoes/04.avif',0,3,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:43:32'),(72,7,NULL,NULL,NULL,'uploads/products/canvas-shoes/05.avif',0,4,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:43:32'),(73,8,NULL,NULL,NULL,'uploads/products/pajama-top/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:44:02'),(74,8,NULL,NULL,NULL,'uploads/products/pajama-top/02.avif',0,1,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:44:02'),(75,8,NULL,NULL,NULL,'uploads/products/pajama-top/03.avif',0,2,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:44:02'),(76,8,NULL,NULL,NULL,'uploads/products/pajama-top/04.avif',0,3,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:44:02'),(77,8,NULL,NULL,NULL,'uploads/products/pajama-top/05.avif',0,4,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:44:02'),(78,9,NULL,NULL,NULL,'uploads/products/athletic-shoes/01.avif',1,0,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:50:30'),(79,9,NULL,NULL,NULL,'uploads/products/athletic-shoes/02.avif',0,1,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:50:30'),(80,9,NULL,NULL,NULL,'uploads/products/athletic-shoes/03.avif',0,2,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:50:30'),(81,9,NULL,NULL,NULL,'uploads/products/athletic-shoes/04.avif',0,3,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:50:30'),(82,9,NULL,NULL,NULL,'uploads/products/athletic-shoes/05.avif',0,4,NULL,NULL,'2026-05-11 19:58:41','2026-05-13 17:50:30'),(84,2,NULL,NULL,NULL,'products/6a025afe1df874.27409753_01.avif',1,0,1,NULL,'2026-05-11 22:41:02','2026-05-13 17:57:35'),(85,2,NULL,NULL,NULL,'products/6a025afe348776.91395995_02.avif',0,1,1,NULL,'2026-05-11 22:41:02','2026-05-13 17:57:35'),(86,2,NULL,NULL,NULL,'products/6a025afe34daa7.54007109_03.avif',0,2,1,NULL,'2026-05-11 22:41:02','2026-05-13 17:57:35'),(87,2,NULL,NULL,NULL,'products/6a025afe3513f9.68827753_04.avif',0,3,1,NULL,'2026-05-11 22:41:02','2026-05-13 17:57:35'),(88,2,NULL,NULL,NULL,'products/6a025afe354809.52260649_05.avif',0,4,1,NULL,'2026-05-11 22:41:02','2026-05-13 17:57:35'),(93,14,NULL,NULL,NULL,'products/6a025ea9c75133.26306784_utility-01.avif',1,0,1,NULL,'2026-05-11 22:56:41','2026-05-11 22:56:41'),(94,14,NULL,NULL,NULL,'products/6a025ea9c80dd1.18013478_utility-03.avif',0,1,1,NULL,'2026-05-11 22:56:41','2026-05-11 22:56:41'),(95,14,NULL,NULL,NULL,'products/6a025ea9c845c5.61179280_utility-02.avif',0,2,1,NULL,'2026-05-11 22:56:41','2026-05-11 22:56:41'),(96,14,NULL,NULL,NULL,'products/6a025ea9df4158.45063110_utility-04.avif',0,3,1,NULL,'2026-05-11 22:56:41','2026-05-11 22:56:41'),(97,15,NULL,NULL,NULL,'products/6a02606f799347.82101511_glass-jar.avif',1,0,1,NULL,'2026-05-11 23:04:15','2026-05-12 16:32:46'),(169,19,NULL,NULL,NULL,'products/6a035f550e8190.97698603_01.avif',1,0,1,NULL,'2026-05-12 17:11:49','2026-05-12 17:24:07'),(170,19,NULL,NULL,NULL,'products/6a035f550f3080.87983656_02.avif',0,1,1,NULL,'2026-05-12 17:11:49','2026-05-12 17:24:07'),(171,19,NULL,NULL,NULL,'products/6a035f550f5e69.32761704_03.avif',0,2,1,NULL,'2026-05-12 17:11:49','2026-05-12 17:24:07'),(172,19,NULL,NULL,NULL,'products/6a035f550f8584.24565149_04.avif',0,3,1,NULL,'2026-05-12 17:11:49','2026-05-12 17:24:07'),(173,19,NULL,NULL,NULL,'products/6a035f551c1046.80105423_05.avif',0,4,1,NULL,'2026-05-12 17:11:49','2026-05-12 17:24:07'),(210,22,NULL,NULL,NULL,'products/6a038df23549a1.77964822_short-sleeve-01.avif',1,0,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(211,22,NULL,NULL,NULL,'products/6a038df2362974.93062453_short-sleeve-02.avif',0,1,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(212,22,NULL,NULL,NULL,'products/6a038df2366c31.66777027_short-sleeve-18.avif',0,2,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(213,22,NULL,NULL,NULL,'products/6a038df236a994.70344902_short-sleeve-17.avif',0,3,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(214,22,NULL,NULL,NULL,'products/6a038df236de96.39775015_short-sleeve-16.avif',0,4,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(215,22,NULL,NULL,NULL,'products/6a038df23712b9.93390198_short-sleeve-15.avif',0,5,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(216,22,NULL,NULL,NULL,'products/6a038df2374468.41000630_short-sleeve-14.avif',0,6,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(217,22,NULL,NULL,NULL,'products/6a038df24cd854.70318103_short-sleeve-13.avif',0,7,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(218,22,NULL,NULL,NULL,'products/6a038df24d4782.49897153_short-sleeve-12.avif',0,8,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(219,22,NULL,NULL,NULL,'products/6a038df24dada0.07805629_short-sleeve-11.avif',0,9,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(220,22,NULL,NULL,NULL,'products/6a038df24debd9.65205175_short-sleeve-10.avif',0,10,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(221,22,NULL,NULL,NULL,'products/6a038df24e1c78.93054886_short-sleeve-09.avif',0,11,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(222,22,NULL,NULL,NULL,'products/6a038df24e5674.02196545_short-sleeve-08.avif',0,12,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(223,22,NULL,NULL,NULL,'products/6a038df24e8905.59663258_short-sleeve-07.avif',0,13,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(224,22,NULL,NULL,NULL,'products/6a038df24ec4a8.62680310_short-sleeve-06.avif',0,14,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(225,22,NULL,NULL,NULL,'products/6a038df24f0a85.14061950_short-sleeve-05.avif',0,15,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(226,22,NULL,NULL,NULL,'products/6a038df26519c8.66513545_short-sleeve-04.avif',0,16,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(227,22,NULL,NULL,NULL,'products/6a038df2657c25.31338697_short-sleeve-03.avif',0,17,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(228,22,NULL,NULL,'Black','products/6a038df27f3407.14029236_01.avif',0,18,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(229,22,NULL,NULL,'Black','products/6a038df27f8f82.79729483_02.avif',0,19,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(230,22,NULL,NULL,'Black','products/6a038df27fc6f4.09648484_03.avif',0,20,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(231,22,NULL,NULL,'Black','products/6a038df2800123.23394083_04.avif',0,21,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(232,22,NULL,NULL,'Black','products/6a038df2961ee4.57555098_05.avif',0,22,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(233,22,NULL,NULL,'Black','products/6a038df2969279.05946307_06.avif',0,23,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(234,23,NULL,NULL,NULL,'products/6a03a4ac06ea00.95481623_01.avif',1,0,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(235,23,NULL,NULL,NULL,'products/6a03a4ac07a759.00854696_02.avif',0,1,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(236,23,NULL,NULL,NULL,'products/6a03a4ac07de64.49184185_03.avif',0,2,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(237,23,NULL,NULL,NULL,'products/6a03a4ac080953.49903628_04.avif',0,3,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(238,23,NULL,NULL,NULL,'products/6a03a4ac084441.73728268_05.avif',0,4,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(239,23,NULL,NULL,NULL,'products/6a03a4ac087279.26767342_06.avif',0,5,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(240,23,NULL,NULL,NULL,'products/6a03a4ac08a620.45232969_07.avif',0,6,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(241,23,NULL,NULL,NULL,'products/6a03a4ac08d421.38195981_08.avif',0,7,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(242,23,NULL,NULL,NULL,'products/6a03a4ac0903a7.25126417_09.avif',0,8,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(243,23,NULL,NULL,NULL,'products/6a03a4ac0932b4.06582142_10.avif',0,9,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(244,23,NULL,NULL,NULL,'products/6a03a4ac1c13f6.85693667_11.avif',0,10,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(245,23,NULL,NULL,NULL,'products/6a03a4ac1c6e18.08747289_12.avif',0,11,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(246,23,NULL,NULL,NULL,'products/6a03a4ac1ca996.99873719_13.avif',0,12,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(247,23,NULL,NULL,NULL,'products/6a03a4ac1da133.03095980_14.avif',0,13,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(248,23,NULL,NULL,NULL,'products/6a03a4ac1de140.95755049_15.avif',0,14,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(249,23,NULL,NULL,'Black Heather','products/6a03a4ac654fd2.49272553_01.avif',0,39,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(250,23,NULL,NULL,'Black Heather','products/6a03a4ac65add8.64805247_02.avif',0,40,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(251,23,NULL,NULL,'Black Heather','products/6a03a4ac65e538.00089600_03.avif',0,41,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(252,23,NULL,NULL,'Black Heather','products/6a03a4ac6618f7.42589429_04.avif',0,42,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(253,23,NULL,NULL,'Black Heather','products/6a03a4ac666091.56658059_05.avif',0,43,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(254,23,NULL,NULL,'Black Heather','products/6a03a4ac66a435.50217564_06.avif',0,44,1,NULL,'2026-05-12 22:07:40','2026-05-12 22:26:22'),(255,23,NULL,NULL,'Black','products/6a03a5d73488a1.86680301_01.avif',0,33,1,NULL,'2026-05-12 22:12:39','2026-05-12 22:26:22'),(256,23,NULL,NULL,'Black','products/6a03a5d7351265.32247593_02.avif',0,34,1,NULL,'2026-05-12 22:12:39','2026-05-12 22:26:22'),(257,23,NULL,NULL,'Black','products/6a03a5d7354f09.55868980_03.avif',0,35,1,NULL,'2026-05-12 22:12:39','2026-05-12 22:26:22'),(258,23,NULL,NULL,'Black','products/6a03a5d7359fa9.94709952_04.avif',0,36,1,NULL,'2026-05-12 22:12:39','2026-05-12 22:26:22'),(259,23,NULL,NULL,'Black','products/6a03a5d735f226.23649075_05.avif',0,37,1,NULL,'2026-05-12 22:12:39','2026-05-12 22:26:22'),(260,23,NULL,NULL,'Black','products/6a03a5d7362315.57464481_06.avif',0,38,1,NULL,'2026-05-12 22:12:39','2026-05-12 22:26:22'),(261,23,NULL,NULL,'Vintage Black','products/6a03a7f4b10892.29591872_01.avif',0,22,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(262,23,NULL,NULL,'Vintage Black','products/6a03a7f4b16653.21638458_02.avif',0,24,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(263,23,NULL,NULL,'Vintage Black','products/6a03a7f4c6b735.34757123_03.avif',0,25,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(264,23,NULL,NULL,'Vintage Black','products/6a03a7f4c79371.45483972_04.avif',0,27,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(265,23,NULL,NULL,'Vintage Black','products/6a03a7f4c7d912.32360930_05.avif',0,29,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(266,23,NULL,NULL,'Vintage Black','products/6a03a7f4c80bb7.54898085_06.avif',0,32,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(267,23,NULL,NULL,'Oxblood Black','products/6a03a7f4c873e0.38845394_01.avif',0,21,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(268,23,NULL,NULL,'Oxblood Black','products/6a03a7f4c89e70.13702460_02.avif',0,23,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(269,23,NULL,NULL,'Oxblood Black','products/6a03a7f4c8ce35.36118421_03.avif',0,26,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(270,23,NULL,NULL,'Oxblood Black','products/6a03a7f4c900e8.73296198_04.avif',0,28,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(271,23,NULL,NULL,'Oxblood Black','products/6a03a7f4df2416.98694559_05.avif',0,30,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(272,23,NULL,NULL,'Oxblood Black','products/6a03a7f4df8a38.65668425_06.avif',0,31,1,NULL,'2026-05-12 22:21:40','2026-05-12 22:26:22'),(273,23,NULL,NULL,'Nevy','products/6a03a8c436f157.00372157_01.avif',0,15,1,NULL,'2026-05-12 22:25:08','2026-05-12 22:26:22'),(274,23,NULL,NULL,'Nevy','products/6a03a8c4375833.05547581_02.avif',0,16,1,NULL,'2026-05-12 22:25:08','2026-05-12 22:26:22'),(275,23,NULL,NULL,'Nevy','products/6a03a8c4378840.26218915_03.avif',0,17,1,NULL,'2026-05-12 22:25:08','2026-05-12 22:26:22'),(276,23,NULL,NULL,'Nevy','products/6a03a8c44ccb86.27342399_04.avif',0,18,1,NULL,'2026-05-12 22:25:08','2026-05-12 22:26:22'),(277,23,NULL,NULL,'Nevy','products/6a03a8c44d29f9.37010388_05.avif',0,19,1,NULL,'2026-05-12 22:25:08','2026-05-12 22:26:22'),(278,23,NULL,NULL,'Nevy','products/6a03a8c44d6e81.53242343_06.avif',0,20,1,NULL,'2026-05-12 22:25:08','2026-05-12 22:26:22'),(279,24,NULL,NULL,NULL,'products/6a03ab3b2c6ef3.87517597_01.avif',1,0,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(280,24,NULL,NULL,NULL,'products/6a03ab3b34b8a5.16716147_02.avif',0,1,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(281,24,NULL,NULL,NULL,'products/6a03ab3b350072.26119058_03.avif',0,2,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(282,24,NULL,NULL,NULL,'products/6a03ab3b3534b7.94497738_04.avif',0,3,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(283,24,NULL,NULL,NULL,'products/6a03ab3b357070.30578768_05.avif',0,4,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(284,24,NULL,NULL,NULL,'products/6a03ab3b35b931.23267184_06.avif',0,5,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(285,24,NULL,NULL,NULL,'products/6a03ab3b35ef15.80277468_07.avif',0,6,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(286,24,NULL,NULL,NULL,'products/6a03ab3b363d33.17067001_08.avif',0,7,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(287,24,NULL,NULL,NULL,'products/6a03ab3b4ca0a1.28558749_09.avif',0,8,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(288,24,NULL,NULL,'Navy','products/6a03ab3b7fffc4.84809335_NEVY.avif',0,11,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(289,24,NULL,NULL,'Black','products/6a03ab3b9682d3.21819749_BLACK.avif',0,9,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(290,24,NULL,NULL,'Dark Grey Heather','products/6a03ab3b973655.84486592_GREY.avif',0,10,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(291,25,NULL,NULL,NULL,'products/6a03aca5496c73.74192005_01.avif',1,0,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(292,25,NULL,NULL,NULL,'products/6a03aca54cba76.95423532_02.avif',0,1,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(293,25,NULL,NULL,NULL,'products/6a03aca54d1991.11309832_03.avif',0,2,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(294,25,NULL,NULL,NULL,'products/6a03aca54d5295.78552501_04.avif',0,3,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(295,25,NULL,NULL,NULL,'products/6a03aca54d8512.12220516_05.avif',0,4,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(296,25,NULL,NULL,NULL,'products/6a03aca54db413.17600572_06.avif',0,5,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(297,25,NULL,NULL,NULL,'products/6a03aca54de4c6.78301468_07.avif',0,6,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(298,25,NULL,NULL,NULL,'products/6a03aca54e16f9.36737257_08.avif',0,7,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(299,25,NULL,NULL,NULL,'products/6a03aca54e4389.67925767_09.avif',0,8,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(300,25,NULL,NULL,NULL,'products/6a03aca54e7439.89445024_10.avif',0,9,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(301,25,NULL,NULL,NULL,'products/6a03aca54ea433.91947407_11.avif',0,10,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(302,25,NULL,NULL,NULL,'products/6a03aca54ed130.60190924_12.avif',0,11,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(303,25,NULL,NULL,NULL,'products/6a03aca54efed6.05153539_13.avif',0,12,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(304,25,NULL,NULL,NULL,'products/6a03aca54f3171.22345484_14.avif',0,13,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(305,25,NULL,NULL,NULL,'products/6a03aca54f61b9.40487773_15.avif',0,14,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(306,25,NULL,NULL,NULL,'products/6a03aca54fbb01.34680386_16.avif',0,15,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(307,25,NULL,NULL,NULL,'products/6a03aca5652d77.90229678_17.avif',0,16,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(308,25,NULL,NULL,NULL,'products/6a03aca5658dd9.58306510_18.avif',0,17,1,NULL,'2026-05-12 22:41:41','2026-05-12 22:44:38'),(309,26,NULL,NULL,NULL,'products/6a03b9670cced5.70138751_01.avif',1,0,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(310,26,NULL,NULL,NULL,'products/6a03b9671be322.32291625_02.avif',0,1,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(311,26,NULL,NULL,NULL,'products/6a03b9671c36b6.91804364_03.avif',0,2,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(312,26,NULL,NULL,NULL,'products/6a03b9671c6e11.20517571_04.avif',0,3,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(313,26,NULL,NULL,NULL,'products/6a03b9671ca3f2.83676718_05.avif',0,4,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(314,26,NULL,NULL,NULL,'products/6a03b9671cd237.32935657_06.avif',0,5,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(315,26,NULL,NULL,NULL,'products/6a03b9671cff42.07519132_07.avif',0,6,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(316,27,NULL,NULL,NULL,'products/6a03bad03a7d76.00187666_01.avif',1,0,1,NULL,'2026-05-12 23:42:08','2026-05-13 17:54:08'),(317,27,NULL,NULL,NULL,'products/6a03bad04cdab7.23197230_02.avif',0,1,1,NULL,'2026-05-12 23:42:08','2026-05-13 17:54:08'),(318,27,NULL,NULL,NULL,'products/6a03bad04d43d2.48783340_03.avif',0,2,1,NULL,'2026-05-12 23:42:08','2026-05-13 17:54:08'),(319,27,NULL,NULL,NULL,'products/6a03bad04d91d1.58139378_04.avif',0,3,1,NULL,'2026-05-12 23:42:08','2026-05-13 17:54:08'),(320,28,NULL,NULL,NULL,'products/6a03bbeb58e5d3.36405339_01.avif',1,0,1,NULL,'2026-05-12 23:46:51','2026-05-12 23:46:51'),(321,28,NULL,NULL,NULL,'products/6a03bbeb598b12.32376356_02.avif',0,1,1,NULL,'2026-05-12 23:46:51','2026-05-12 23:46:51'),(322,28,NULL,NULL,NULL,'products/6a03bbeb59c460.23308931_03.avif',0,2,1,NULL,'2026-05-12 23:46:51','2026-05-12 23:46:51'),(323,28,NULL,NULL,NULL,'products/6a03bbeb59f881.26363899_04.avif',0,3,1,NULL,'2026-05-12 23:46:51','2026-05-12 23:46:51'),(324,29,NULL,NULL,NULL,'products/6a03bf4eae5929.70465267_01.avif',1,0,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(325,29,NULL,NULL,NULL,'products/6a03bf4eaf6a69.00298218_02.avif',0,1,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(326,29,NULL,NULL,NULL,'products/6a03bf4eafbb14.82494643_03.avif',0,2,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(327,29,NULL,NULL,NULL,'products/6a03bf4eb011c3.52175224_04.avif',0,3,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(328,29,NULL,NULL,NULL,'products/6a03bf4eb04e18.50087982_05.avif',0,4,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(329,29,NULL,NULL,NULL,'products/6a03bf4eb08f27.27510733_06.avif',0,5,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(330,29,NULL,NULL,NULL,'products/6a03bf4eb0c3c4.87699712_07.avif',0,6,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(331,29,NULL,NULL,NULL,'products/6a03bf4eb0faf4.07445485_08.avif',0,7,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(332,29,NULL,NULL,NULL,'products/6a03bf4ec6e2a3.15867598_09.avif',0,8,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(333,29,NULL,NULL,NULL,'products/6a03bf4ec76402.22336219_10.avif',0,9,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(334,29,NULL,NULL,NULL,'products/6a03bf4ec7a831.28432038_11.avif',0,10,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(335,29,NULL,NULL,NULL,'products/6a03bf4ec804c6.71739884_12.avif',0,11,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(336,29,NULL,NULL,NULL,'products/6a03bf4ec84808.26871906_13.avif',0,12,1,NULL,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(337,30,NULL,NULL,NULL,'products/6a03c14a95ff79.99032230_01.avif',1,0,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(338,30,NULL,NULL,NULL,'products/6a03c14a971146.68545991_02.avif',0,1,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(339,30,NULL,NULL,NULL,'products/6a03c14a974836.24350220_03.avif',0,2,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(340,30,NULL,NULL,NULL,'products/6a03c14a9791e0.59556682_04.avif',0,3,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(341,30,NULL,NULL,NULL,'products/6a03c14a97e357.94906242_05.avif',0,4,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(342,30,NULL,NULL,NULL,'products/6a03c14a9846a3.34870325_06.avif',0,5,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:47'),(343,30,NULL,NULL,NULL,'products/6a03c14a988d57.99453892_07.avif',0,6,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:47'),(344,30,NULL,NULL,NULL,'products/6a03c14aae7418.28177876_08.avif',0,7,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:47'),(345,30,NULL,NULL,NULL,'products/6a03c14aaec354.88768315_09.avif',0,8,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:47'),(346,30,NULL,NULL,NULL,'products/6a03c14aaf0cc3.12675698_10.avif',0,9,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:47'),(347,30,NULL,NULL,NULL,'products/6a03c14aaf4ec1.41370970_11.avif',0,10,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:47'),(348,31,NULL,NULL,NULL,'products/6a03c28095ee09.35577397_01.avif',1,0,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(349,31,NULL,NULL,NULL,'products/6a03c28096d4c5.24433632_02.avif',0,1,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(350,31,NULL,NULL,NULL,'products/6a03c280971ca2.65607536_03.avif',0,2,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(351,31,NULL,NULL,NULL,'products/6a03c2809769d4.48839825_04.avif',0,3,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(352,31,NULL,NULL,NULL,'products/6a03c28097a621.05195379_05.avif',0,4,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(353,31,NULL,NULL,NULL,'products/6a03c28097d8f2.63142491_06.avif',0,5,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(354,31,NULL,NULL,NULL,'products/6a03c2809805e0.81803691_07.avif',0,6,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(355,31,NULL,NULL,NULL,'products/6a03c280983347.44065456_08.avif',0,7,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(356,32,NULL,NULL,NULL,'products/6a03c3b21de455.33028611_01.avif',1,0,1,NULL,'2026-05-13 00:20:02','2026-05-13 00:20:02'),(357,32,NULL,NULL,NULL,'products/6a03c3b234e615.05200175_02.avif',0,1,1,NULL,'2026-05-13 00:20:02','2026-05-13 00:20:02'),(358,32,NULL,NULL,NULL,'products/6a03c3b2356bb1.22081643_03.avif',0,2,1,NULL,'2026-05-13 00:20:02','2026-05-13 00:20:02'),(359,32,NULL,NULL,NULL,'products/6a03c3b2360a68.04925049_04.avif',0,3,1,NULL,'2026-05-13 00:20:02','2026-05-13 00:20:02'),(360,33,NULL,NULL,NULL,'products/6a049c19653415.72733058_01.avif',1,0,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(361,33,NULL,NULL,NULL,'products/6a049c19697793.45037237_02.avif',0,1,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(362,33,NULL,NULL,NULL,'products/6a049c1969c4f0.35517640_03.avif',0,2,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(363,33,NULL,NULL,NULL,'products/6a049c196a14a9.02559967_04.avif',0,3,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(364,33,NULL,NULL,NULL,'products/6a049c196a6720.53517425_05.avif',0,4,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(365,33,NULL,NULL,NULL,'products/6a049c197db514.86725312_06.avif',0,5,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(366,33,NULL,NULL,NULL,'products/6a049c197e1ce2.77112726_07.avif',0,6,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(367,33,NULL,NULL,NULL,'products/6a049c197e8217.97443436_08.avif',0,7,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(368,33,NULL,NULL,NULL,'products/6a049c197ede94.94846501_09.avif',0,8,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(369,33,NULL,NULL,NULL,'products/6a049c197f2ee2.99107413_10.avif',0,9,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(370,34,NULL,NULL,NULL,'products/6a049e29ae6851.49851997_01.avif',1,0,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(371,34,NULL,NULL,NULL,'products/6a049e29af86b7.74338629_02.avif',0,1,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(372,34,NULL,NULL,NULL,'products/6a049e29afb9e6.11375265_03.avif',0,2,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(373,34,NULL,NULL,NULL,'products/6a049e29afecc1.22346140_04.avif',0,3,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(374,34,NULL,NULL,NULL,'products/6a049e29b019c0.69384252_05.avif',0,4,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(375,34,NULL,NULL,NULL,'products/6a049e29b04635.21992823_06.avif',0,5,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(376,34,NULL,NULL,NULL,'products/6a049e29b077e5.02059418_07.avif',0,6,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(377,34,NULL,NULL,NULL,'products/6a049e29b0a5b2.22359496_08.avif',0,7,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(378,34,NULL,NULL,NULL,'products/6a049e29b0d880.94476627_09.avif',0,8,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:10'),(379,35,NULL,NULL,NULL,'products/6a049f64053d86.36118726_01.avif',1,0,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(380,35,NULL,NULL,NULL,'products/6a049f6405fa50.48928197_02.avif',0,1,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(381,35,NULL,NULL,NULL,'products/6a049f640668c2.79538861_03.avif',0,2,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(382,35,NULL,NULL,NULL,'products/6a049f6406c290.35647348_04.avif',0,3,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(383,35,NULL,NULL,NULL,'products/6a049f64070472.26802535_05.avif',0,4,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(384,35,NULL,NULL,NULL,'products/6a049f64073b13.62386493_06.avif',0,5,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(385,35,NULL,NULL,NULL,'products/6a049f64078101.80066591_07.avif',0,6,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(386,36,NULL,NULL,NULL,'products/6a04a060e07329.44432010_01.avif',1,0,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(387,36,NULL,NULL,NULL,'products/6a04a060e17821.41469816_02.avif',0,1,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(388,36,NULL,NULL,NULL,'products/6a04a060e1bf79.46243780_03.avif',0,2,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(389,36,NULL,NULL,NULL,'products/6a04a060e1f576.40347062_04.avif',0,3,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(390,36,NULL,NULL,NULL,'products/6a04a060e23065.60493625_05.avif',0,4,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(391,36,NULL,NULL,NULL,'products/6a04a060e2eb60.94293129_06.avif',0,5,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(392,36,NULL,NULL,NULL,'products/6a04a060e33957.25188623_07.avif',0,6,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(393,36,NULL,NULL,NULL,'products/6a04a060e38287.55541810_08.avif',0,7,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(394,36,NULL,NULL,NULL,'products/6a04a060e3ca90.00535434_09.avif',0,8,1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:37'),(395,36,NULL,NULL,NULL,'products/6a04a061038205.08143623_10.avif',0,9,1,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(396,36,NULL,NULL,NULL,'products/6a04a06103ed41.04807958_11.avif',0,10,1,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(397,37,NULL,NULL,NULL,'products/6a04a2dc6b7a97.00576933_01.avif',1,0,1,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(398,37,NULL,NULL,NULL,'products/6a04a2dc7e0c59.18171699_02.avif',0,1,1,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(399,37,NULL,NULL,NULL,'products/6a04a2dc7e6913.30092856_03.avif',0,2,1,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(400,37,NULL,NULL,NULL,'products/6a04a2dc7e9d63.25447685_04.avif',0,3,1,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(401,38,NULL,NULL,NULL,'products/6a04a7120a0ff6.67926688_glass-jar.avif',1,0,1,NULL,'2026-05-13 16:30:10','2026-05-13 16:30:10'),(402,39,NULL,NULL,NULL,'products/6a04a9841d44b1.71292134_01.avif',1,0,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(403,39,NULL,NULL,NULL,'products/6a04a9841e1e87.99059153_02.avif',0,1,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(404,39,NULL,NULL,NULL,'products/6a04a9841e5317.72563752_03.avif',0,2,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(405,39,NULL,NULL,NULL,'products/6a04a9841e84a4.94285035_04.avif',0,3,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(406,39,NULL,NULL,NULL,'products/6a04a9841eb611.48167895_05.avif',0,4,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(407,39,NULL,NULL,NULL,'products/6a04a9841ee5e3.66901133_06.avif',0,5,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(408,39,NULL,NULL,NULL,'products/6a04a9841f23d6.15662988_07.avif',0,6,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(409,39,NULL,NULL,NULL,'products/6a04a9841f5126.01153572_08.avif',0,7,1,NULL,'2026-05-13 16:40:36','2026-05-13 17:22:41'),(410,40,NULL,NULL,NULL,'products/6a04a9ec6938e5.61722730_01.avif',1,0,1,NULL,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(411,40,NULL,NULL,NULL,'products/6a04a9ec6ac456.87365223_02.avif',0,1,1,NULL,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(412,40,NULL,NULL,NULL,'products/6a04a9ec6b1953.37638651_03.avif',0,2,1,NULL,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(413,40,NULL,NULL,NULL,'products/6a04a9ec7dd8b6.49406587_04.avif',0,3,1,NULL,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(414,40,NULL,NULL,NULL,'products/6a04a9ec7e4b32.81924952_05.avif',0,4,1,NULL,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(415,40,NULL,NULL,NULL,'products/6a04a9ec7ea0a1.99805333_06.avif',0,5,1,NULL,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(416,41,NULL,NULL,NULL,'products/6a04b0fb174e32.39802008_01.avif',1,0,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(417,41,NULL,NULL,NULL,'products/6a04b0fb1c7e58.82913526_02.avif',0,1,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(418,41,NULL,NULL,NULL,'products/6a04b0fb1ccdf6.41823678_03.avif',0,2,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(419,41,NULL,NULL,NULL,'products/6a04b0fb1d1105.68582560_01.avif',0,3,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(420,41,NULL,NULL,NULL,'products/6a04b0fb1d4ba7.01615731_02.avif',0,4,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(421,41,NULL,NULL,NULL,'products/6a04b0fb1d8707.58185174_03.avif',0,5,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(422,42,NULL,NULL,NULL,'products/6a04b2de351010.56812184_01.avif',1,0,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(423,42,NULL,NULL,NULL,'products/6a04b2de35b549.15977080_02.avif',0,1,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(424,42,NULL,NULL,NULL,'products/6a04b2de35e9a8.44660732_03.avif',0,2,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(425,42,NULL,NULL,NULL,'products/6a04b2de3615e7.60813283_04.avif',0,3,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(426,42,NULL,NULL,NULL,'products/6a04b2de364207.70598196_05.avif',0,4,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(427,42,NULL,NULL,NULL,'products/6a04b2de366d89.65857557_06.avif',0,5,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(428,42,NULL,NULL,NULL,'products/6a04b2de369f93.25997693_07.avif',0,6,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(429,42,NULL,NULL,NULL,'products/6a04b2de36d0f0.78833297_08.avif',0,7,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(430,42,NULL,NULL,NULL,'products/6a04b2de36f916.73322300_09.avif',0,8,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(431,42,NULL,NULL,NULL,'products/6a04b2de372549.58820228_10.avif',0,9,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(432,42,NULL,NULL,NULL,'products/6a04b2de3752c7.57898891_11.avif',0,10,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(433,42,NULL,NULL,NULL,'products/6a04b2de377f83.98465721_12.avif',0,11,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(434,42,NULL,NULL,NULL,'products/6a04b2de37cd29.18340400_13.avif',0,12,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(435,43,NULL,NULL,NULL,'products/6a04c1218da792.38954145_01.avif',1,0,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(436,43,NULL,NULL,NULL,'products/6a04c1218e4929.50499658_02.avif',0,1,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(437,43,NULL,NULL,NULL,'products/6a04c121966316.31227775_03.avif',0,2,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(438,43,NULL,NULL,NULL,'products/6a04c12196b366.47760298_04.avif',0,3,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(439,43,NULL,NULL,NULL,'products/6a04c121974ea5.26011128_05.avif',0,4,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(440,43,NULL,NULL,NULL,'products/6a04c121aeb724.80711671_06.avif',0,5,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(441,43,NULL,NULL,NULL,'products/6a04c121af1851.18574334_07.avif',0,6,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(442,44,NULL,NULL,NULL,'products/6a04c48bc5b105.38476015_01.avif',1,0,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(443,44,NULL,NULL,NULL,'products/6a04c48bc773c4.47359655_02.avif',0,1,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(444,44,NULL,NULL,NULL,'products/6a04c48bc7a699.77572139_03.avif',0,2,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(445,44,NULL,NULL,NULL,'products/6a04c48bc7d9d5.12815755_04.avif',0,3,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(446,44,NULL,NULL,NULL,'products/6a04c48bc80697.69530408_05.avif',0,4,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(447,44,NULL,NULL,NULL,'products/6a04c48bc830e9.45677108_06.avif',0,5,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(448,44,NULL,NULL,NULL,'products/6a04c48bc86285.37776585_07.avif',0,6,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(449,44,NULL,NULL,NULL,'products/6a04c48bc89261.41531182_08.avif',0,7,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(450,44,NULL,NULL,NULL,'products/6a04c48bc8c048.42520190_09.avif',0,8,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(451,44,NULL,NULL,NULL,'products/6a04c48bc8e826.37730936_10.avif',0,9,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(452,44,NULL,NULL,NULL,'products/6a04c48bc91297.73408733_11.avif',0,10,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(453,44,NULL,NULL,NULL,'products/6a04c48bc93ac2.51574113_12.avif',0,11,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(454,44,NULL,NULL,NULL,'products/6a04c48bc96600.69824893_13.avif',0,12,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(455,44,NULL,NULL,NULL,'products/6a04c48bc99021.95427539_14.avif',0,13,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(456,44,NULL,NULL,NULL,'products/6a04c48bdf60d1.52843388_15.avif',0,14,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(457,44,NULL,NULL,NULL,'products/6a04c48be02869.76860036_16.avif',0,15,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(458,44,NULL,NULL,NULL,'products/6a04c48be0e9d0.06834119_17.avif',0,16,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(459,44,NULL,NULL,NULL,'products/6a04c48be128e9.16987317_18.avif',0,17,1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:56'),(460,44,NULL,NULL,NULL,'products/6a04c48be15b76.40353225_19.avif',0,18,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(461,44,NULL,NULL,NULL,'products/6a04c48c03c668.69885534_20.avif',0,19,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(462,44,NULL,NULL,NULL,'products/6a04c48c042259.64678013_21.avif',0,20,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(463,44,NULL,NULL,NULL,'products/6a04c48c046b66.08038595_22.avif',0,21,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(464,44,NULL,NULL,NULL,'products/6a04c48c04a746.08165168_23.avif',0,22,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(465,44,NULL,NULL,NULL,'products/6a04c48c04e1e2.00440278_24.avif',0,23,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(466,44,NULL,NULL,NULL,'products/6a04c48c051e37.42859282_25.avif',0,24,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(467,44,NULL,NULL,'Black','products/6a04c48c4d8be0.83208207_01.avif',0,25,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(468,44,NULL,NULL,'Black','products/6a04c48c4dcbe6.16195807_02.avif',0,27,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(469,44,NULL,NULL,'Black','products/6a04c48c4dfa33.58661370_03.avif',0,30,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(470,44,NULL,NULL,'Black','products/6a04c48c4e2d78.50841864_04.avif',0,32,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(471,44,NULL,NULL,'Black','products/6a04c48c4e5c57.07914845_05.avif',0,34,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(472,44,NULL,NULL,'Black','products/6a04c48c4e8d08.64411787_06.avif',0,35,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(473,44,NULL,NULL,'Heather Dark Black','products/6a04c48c4f03b1.63422784_01.avif',0,26,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(474,44,NULL,NULL,'Heather Dark Black','products/6a04c48c4f38e0.42659213_02.avif',0,28,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(475,44,NULL,NULL,'Heather Dark Black','products/6a04c48c4f6b87.59922188_03.avif',0,29,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(476,44,NULL,NULL,'Heather Dark Black','products/6a04c48c658ef1.70079349_04.avif',0,31,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(477,44,NULL,NULL,'Heather Dark Black','products/6a04c48c65c2d9.05701515_05.avif',0,33,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(478,44,NULL,NULL,'Heather Dark Black','products/6a04c48c65f2e3.82661478_06.avif',0,36,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_types`
--

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;
INSERT INTO `product_types` VALUES (1,'Simple Product','simple','2026-05-05 22:37:02','2026-05-05 22:37:02'),(2,'Variable Product','variable','2026-05-05 22:37:02','2026-05-05 22:37:02');
/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variation_values`
--

DROP TABLE IF EXISTS `product_variation_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variation_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_variation_id` bigint unsigned NOT NULL,
  `product_attribute_id` bigint unsigned NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `variation_attribute_unique` (`product_variation_id`,`product_attribute_id`),
  KEY `product_variation_values_product_attribute_id_foreign` (`product_attribute_id`),
  CONSTRAINT `product_variation_values_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_variation_values_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=885 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variation_values`
--

LOCK TABLES `product_variation_values` WRITE;
/*!40000 ALTER TABLE `product_variation_values` DISABLE KEYS */;
INSERT INTO `product_variation_values` VALUES (91,46,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(92,46,3,'S','2026-05-12 17:24:07','2026-05-12 17:24:07'),(93,47,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(94,47,3,'M','2026-05-12 17:24:07','2026-05-12 17:24:07'),(95,48,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(96,48,3,'L','2026-05-12 17:24:07','2026-05-12 17:24:07'),(97,49,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(98,49,3,'XL','2026-05-12 17:24:07','2026-05-12 17:24:07'),(99,50,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(100,50,3,'2XL','2026-05-12 17:24:07','2026-05-12 17:24:07'),(101,51,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(102,51,3,'3XL','2026-05-12 17:24:07','2026-05-12 17:24:07'),(103,52,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(104,52,3,'4XL','2026-05-12 17:24:07','2026-05-12 17:24:07'),(105,53,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(106,53,3,'5XL','2026-05-12 17:24:07','2026-05-12 17:24:07'),(107,54,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(108,54,3,'6XL','2026-05-12 17:24:07','2026-05-12 17:24:07'),(109,55,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(110,55,3,'XS','2026-05-12 17:24:07','2026-05-12 17:24:07'),(111,56,2,'Uncategorized','2026-05-12 17:24:07','2026-05-12 17:24:07'),(112,56,3,'2XS','2026-05-12 17:24:07','2026-05-12 17:24:07'),(163,82,2,'Black','2026-05-12 20:30:42','2026-05-12 20:30:42'),(164,82,3,'S','2026-05-12 20:30:42','2026-05-12 20:30:42'),(165,83,2,'Black','2026-05-12 20:30:42','2026-05-12 20:30:42'),(166,83,3,'M','2026-05-12 20:30:42','2026-05-12 20:30:42'),(167,84,2,'Black','2026-05-12 20:30:42','2026-05-12 20:30:42'),(168,84,3,'L','2026-05-12 20:30:42','2026-05-12 20:30:42'),(169,85,2,'Black','2026-05-12 20:30:42','2026-05-12 20:30:42'),(170,85,3,'XL','2026-05-12 20:30:42','2026-05-12 20:30:42'),(171,86,2,'Black','2026-05-12 20:30:42','2026-05-12 20:30:42'),(172,86,3,'2XL','2026-05-12 20:30:42','2026-05-12 20:30:42'),(173,87,2,'Black','2026-05-12 20:30:42','2026-05-12 20:30:42'),(174,87,3,'3XL','2026-05-12 20:30:42','2026-05-12 20:30:42'),(419,210,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(420,210,3,'XS','2026-05-12 22:26:21','2026-05-12 22:26:21'),(421,211,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(422,211,3,'S','2026-05-12 22:26:21','2026-05-12 22:26:21'),(423,212,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(424,212,3,'M','2026-05-12 22:26:21','2026-05-12 22:26:21'),(425,213,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(426,213,3,'L','2026-05-12 22:26:21','2026-05-12 22:26:21'),(427,214,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(428,214,3,'XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(429,215,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(430,215,3,'2XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(431,216,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(432,216,3,'3XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(433,217,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(434,217,3,'4XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(435,218,2,'Black Heather','2026-05-12 22:26:21','2026-05-12 22:26:21'),(436,218,3,'5XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(437,219,2,'Black','2026-05-12 22:26:21','2026-05-12 22:26:21'),(438,219,3,'XS','2026-05-12 22:26:21','2026-05-12 22:26:21'),(439,220,2,'Black','2026-05-12 22:26:21','2026-05-12 22:26:21'),(440,220,3,'S','2026-05-12 22:26:21','2026-05-12 22:26:21'),(441,221,2,'Black','2026-05-12 22:26:21','2026-05-12 22:26:21'),(442,221,3,'M','2026-05-12 22:26:21','2026-05-12 22:26:21'),(443,222,2,'Black','2026-05-12 22:26:21','2026-05-12 22:26:21'),(444,222,3,'L','2026-05-12 22:26:21','2026-05-12 22:26:21'),(445,223,2,'Black','2026-05-12 22:26:21','2026-05-12 22:26:21'),(446,223,3,'XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(447,224,2,'Black','2026-05-12 22:26:21','2026-05-12 22:26:21'),(448,224,3,'2XL','2026-05-12 22:26:21','2026-05-12 22:26:21'),(449,225,2,'Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(450,225,3,'3XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(451,226,2,'Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(452,226,3,'4XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(453,227,2,'Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(454,227,3,'5XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(455,228,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(456,228,3,'XS','2026-05-12 22:26:22','2026-05-12 22:26:22'),(457,229,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(458,229,3,'S','2026-05-12 22:26:22','2026-05-12 22:26:22'),(459,230,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(460,230,3,'M','2026-05-12 22:26:22','2026-05-12 22:26:22'),(461,231,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(462,231,3,'L','2026-05-12 22:26:22','2026-05-12 22:26:22'),(463,232,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(464,232,3,'XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(465,233,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(466,233,3,'2XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(467,234,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(468,234,3,'3XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(469,235,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(470,235,3,'4XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(471,236,2,'Vintage Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(472,236,3,'5XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(473,237,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(474,237,3,'S','2026-05-12 22:26:22','2026-05-12 22:26:22'),(475,238,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(476,238,3,'M','2026-05-12 22:26:22','2026-05-12 22:26:22'),(477,239,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(478,239,3,'L','2026-05-12 22:26:22','2026-05-12 22:26:22'),(479,240,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(480,240,3,'XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(481,241,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(482,241,3,'2XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(483,242,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(484,242,3,'3XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(485,243,2,'Oxblood Black','2026-05-12 22:26:22','2026-05-12 22:26:22'),(486,243,3,'4XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(487,244,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(488,244,3,'XS','2026-05-12 22:26:22','2026-05-12 22:26:22'),(489,245,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(490,245,3,'S','2026-05-12 22:26:22','2026-05-12 22:26:22'),(491,246,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(492,246,3,'M','2026-05-12 22:26:22','2026-05-12 22:26:22'),(493,247,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(494,247,3,'L','2026-05-12 22:26:22','2026-05-12 22:26:22'),(495,248,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(496,248,3,'XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(497,249,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(498,249,3,'2XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(499,250,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(500,250,3,'3XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(501,251,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(502,251,3,'4XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(503,252,2,'Nevy','2026-05-12 22:26:22','2026-05-12 22:26:22'),(504,252,3,'5XL','2026-05-12 22:26:22','2026-05-12 22:26:22'),(505,253,2,'Navy','2026-05-12 22:35:39','2026-05-12 22:35:39'),(506,253,3,'S','2026-05-12 22:35:39','2026-05-12 22:35:39'),(507,254,2,'Navy','2026-05-12 22:35:39','2026-05-12 22:35:39'),(508,254,3,'M','2026-05-12 22:35:39','2026-05-12 22:35:39'),(509,255,2,'Navy','2026-05-12 22:35:39','2026-05-12 22:35:39'),(510,255,3,'L','2026-05-12 22:35:39','2026-05-12 22:35:39'),(511,256,2,'Navy','2026-05-12 22:35:39','2026-05-12 22:35:39'),(512,256,3,'XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(513,257,2,'Navy','2026-05-12 22:35:39','2026-05-12 22:35:39'),(514,257,3,'2XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(515,258,2,'Navy','2026-05-12 22:35:39','2026-05-12 22:35:39'),(516,258,3,'3XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(517,259,2,'Black','2026-05-12 22:35:39','2026-05-12 22:35:39'),(518,259,3,'S','2026-05-12 22:35:39','2026-05-12 22:35:39'),(519,260,2,'Black','2026-05-12 22:35:39','2026-05-12 22:35:39'),(520,260,3,'M','2026-05-12 22:35:39','2026-05-12 22:35:39'),(521,261,2,'Black','2026-05-12 22:35:39','2026-05-12 22:35:39'),(522,261,3,'L','2026-05-12 22:35:39','2026-05-12 22:35:39'),(523,262,2,'Black','2026-05-12 22:35:39','2026-05-12 22:35:39'),(524,262,3,'XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(525,263,2,'Black','2026-05-12 22:35:39','2026-05-12 22:35:39'),(526,263,3,'2XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(527,264,2,'Black','2026-05-12 22:35:39','2026-05-12 22:35:39'),(528,264,3,'3XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(529,265,2,'Dark Grey Heather','2026-05-12 22:35:39','2026-05-12 22:35:39'),(530,265,3,'S','2026-05-12 22:35:39','2026-05-12 22:35:39'),(531,266,2,'Dark Grey Heather','2026-05-12 22:35:39','2026-05-12 22:35:39'),(532,266,3,'M','2026-05-12 22:35:39','2026-05-12 22:35:39'),(533,267,2,'Dark Grey Heather','2026-05-12 22:35:39','2026-05-12 22:35:39'),(534,267,3,'L','2026-05-12 22:35:39','2026-05-12 22:35:39'),(535,268,2,'Dark Grey Heather','2026-05-12 22:35:39','2026-05-12 22:35:39'),(536,268,3,'XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(537,269,2,'Dark Grey Heather','2026-05-12 22:35:39','2026-05-12 22:35:39'),(538,269,3,'2XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(539,270,2,'Dark Grey Heather','2026-05-12 22:35:39','2026-05-12 22:35:39'),(540,270,3,'3XL','2026-05-12 22:35:39','2026-05-12 22:35:39'),(585,293,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(586,293,3,'2XS','2026-05-12 22:44:38','2026-05-12 22:44:38'),(587,294,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(588,294,3,'XS','2026-05-12 22:44:38','2026-05-12 22:44:38'),(589,295,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(590,295,3,'S','2026-05-12 22:44:38','2026-05-12 22:44:38'),(591,296,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(592,296,3,'M','2026-05-12 22:44:38','2026-05-12 22:44:38'),(593,297,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(594,297,3,'L','2026-05-12 22:44:38','2026-05-12 22:44:38'),(595,298,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(596,298,3,'XL','2026-05-12 22:44:38','2026-05-12 22:44:38'),(597,299,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(598,299,3,'2XL','2026-05-12 22:44:38','2026-05-12 22:44:38'),(599,300,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(600,300,3,'3XL','2026-05-12 22:44:38','2026-05-12 22:44:38'),(601,301,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(602,301,3,'4XL','2026-05-12 22:44:38','2026-05-12 22:44:38'),(603,302,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(604,302,3,'5XL','2026-05-12 22:44:38','2026-05-12 22:44:38'),(605,303,2,'','2026-05-12 22:44:38','2026-05-12 22:44:38'),(606,303,3,'6XL','2026-05-12 22:44:38','2026-05-12 22:44:38'),(621,311,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(622,311,3,'XS','2026-05-12 23:36:07','2026-05-12 23:36:07'),(623,312,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(624,312,3,'S','2026-05-12 23:36:07','2026-05-12 23:36:07'),(625,313,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(626,313,3,'M','2026-05-12 23:36:07','2026-05-12 23:36:07'),(627,314,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(628,314,3,'L','2026-05-12 23:36:07','2026-05-12 23:36:07'),(629,315,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(630,315,3,'XL','2026-05-12 23:36:07','2026-05-12 23:36:07'),(631,316,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(632,316,3,'2XL','2026-05-12 23:36:07','2026-05-12 23:36:07'),(633,317,2,'','2026-05-12 23:36:07','2026-05-12 23:36:07'),(634,317,3,'3XL','2026-05-12 23:36:07','2026-05-12 23:36:07'),(659,330,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(660,330,3,'2XS','2026-05-13 00:09:46','2026-05-13 00:09:46'),(661,331,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(662,331,3,'XS','2026-05-13 00:09:46','2026-05-13 00:09:46'),(663,332,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(664,332,3,'S','2026-05-13 00:09:46','2026-05-13 00:09:46'),(665,333,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(666,333,3,'M','2026-05-13 00:09:46','2026-05-13 00:09:46'),(667,334,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(668,334,3,'L','2026-05-13 00:09:46','2026-05-13 00:09:46'),(669,335,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(670,335,3,'XL','2026-05-13 00:09:46','2026-05-13 00:09:46'),(671,336,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(672,336,3,'2XL','2026-05-13 00:09:46','2026-05-13 00:09:46'),(673,337,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(674,337,3,'3XL','2026-05-13 00:09:46','2026-05-13 00:09:46'),(675,338,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(676,338,3,'4XL','2026-05-13 00:09:46','2026-05-13 00:09:46'),(677,339,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(678,339,3,'5XL','2026-05-13 00:09:46','2026-05-13 00:09:46'),(679,340,2,'','2026-05-13 00:09:46','2026-05-13 00:09:46'),(680,340,3,'6XL','2026-05-13 00:09:46','2026-05-13 00:09:46'),(681,341,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(682,341,3,'XS','2026-05-13 00:14:56','2026-05-13 00:14:56'),(683,342,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(684,342,3,'S','2026-05-13 00:14:56','2026-05-13 00:14:56'),(685,343,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(686,343,3,'M','2026-05-13 00:14:56','2026-05-13 00:14:56'),(687,344,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(688,344,3,'L','2026-05-13 00:14:56','2026-05-13 00:14:56'),(689,345,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(690,345,3,'XL','2026-05-13 00:14:56','2026-05-13 00:14:56'),(691,346,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(692,346,3,'2XL','2026-05-13 00:14:56','2026-05-13 00:14:56'),(693,347,2,'','2026-05-13 00:14:56','2026-05-13 00:14:56'),(694,347,3,'3XL','2026-05-13 00:14:56','2026-05-13 00:14:56'),(695,348,2,'','2026-05-13 15:43:21','2026-05-13 15:43:21'),(696,348,3,'XS','2026-05-13 15:43:21','2026-05-13 15:43:21'),(697,349,2,'','2026-05-13 15:43:21','2026-05-13 15:43:21'),(698,349,3,'S','2026-05-13 15:43:21','2026-05-13 15:43:21'),(699,350,2,'','2026-05-13 15:43:21','2026-05-13 15:43:21'),(700,350,3,'M','2026-05-13 15:43:21','2026-05-13 15:43:21'),(701,351,2,'','2026-05-13 15:43:21','2026-05-13 15:43:21'),(702,351,3,'L','2026-05-13 15:43:21','2026-05-13 15:43:21'),(703,352,2,'','2026-05-13 15:43:21','2026-05-13 15:43:21'),(704,352,3,'XL','2026-05-13 15:43:21','2026-05-13 15:43:21'),(705,353,2,'','2026-05-13 15:43:21','2026-05-13 15:43:21'),(706,353,3,'2XL','2026-05-13 15:43:21','2026-05-13 15:43:21'),(707,354,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(708,354,3,'2XS','2026-05-13 15:52:09','2026-05-13 15:52:09'),(709,355,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(710,355,3,'XS','2026-05-13 15:52:09','2026-05-13 15:52:09'),(711,356,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(712,356,3,'S','2026-05-13 15:52:09','2026-05-13 15:52:09'),(713,357,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(714,357,3,'M','2026-05-13 15:52:09','2026-05-13 15:52:09'),(715,358,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(716,358,3,'L','2026-05-13 15:52:09','2026-05-13 15:52:09'),(717,359,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(718,359,3,'XL','2026-05-13 15:52:09','2026-05-13 15:52:09'),(719,360,2,'','2026-05-13 15:52:09','2026-05-13 15:52:09'),(720,360,3,'2XL','2026-05-13 15:52:09','2026-05-13 15:52:09'),(721,361,2,'','2026-05-13 15:52:10','2026-05-13 15:52:10'),(722,361,3,'3XL','2026-05-13 15:52:10','2026-05-13 15:52:10'),(723,362,2,'','2026-05-13 15:52:10','2026-05-13 15:52:10'),(724,362,3,'4XL','2026-05-13 15:52:10','2026-05-13 15:52:10'),(725,363,2,'','2026-05-13 15:52:10','2026-05-13 15:52:10'),(726,363,3,'5XL','2026-05-13 15:52:10','2026-05-13 15:52:10'),(727,364,2,'','2026-05-13 15:52:10','2026-05-13 15:52:10'),(728,364,3,'6XL','2026-05-13 15:52:10','2026-05-13 15:52:10'),(729,365,2,'','2026-05-13 15:57:24','2026-05-13 15:57:24'),(730,365,3,'XS','2026-05-13 15:57:24','2026-05-13 15:57:24'),(731,366,2,'','2026-05-13 15:57:24','2026-05-13 15:57:24'),(732,366,3,'S','2026-05-13 15:57:24','2026-05-13 15:57:24'),(733,367,2,'','2026-05-13 15:57:24','2026-05-13 15:57:24'),(734,367,3,'M','2026-05-13 15:57:24','2026-05-13 15:57:24'),(735,368,2,'','2026-05-13 15:57:24','2026-05-13 15:57:24'),(736,368,3,'L','2026-05-13 15:57:24','2026-05-13 15:57:24'),(737,369,2,'','2026-05-13 15:57:24','2026-05-13 15:57:24'),(738,369,3,'XL','2026-05-13 15:57:24','2026-05-13 15:57:24'),(739,370,2,'','2026-05-13 16:01:37','2026-05-13 16:01:37'),(740,370,3,'XS','2026-05-13 16:01:37','2026-05-13 16:01:37'),(741,371,2,'','2026-05-13 16:01:37','2026-05-13 16:01:37'),(742,371,3,'S','2026-05-13 16:01:37','2026-05-13 16:01:37'),(743,372,2,'','2026-05-13 16:01:37','2026-05-13 16:01:37'),(744,372,3,'M','2026-05-13 16:01:37','2026-05-13 16:01:37'),(745,373,2,'','2026-05-13 16:01:37','2026-05-13 16:01:37'),(746,373,3,'L','2026-05-13 16:01:37','2026-05-13 16:01:37'),(747,374,2,'','2026-05-13 16:01:37','2026-05-13 16:01:37'),(748,374,3,'XL','2026-05-13 16:01:37','2026-05-13 16:01:37'),(749,375,2,'','2026-05-13 16:12:12','2026-05-13 16:12:12'),(750,375,3,'XS','2026-05-13 16:12:12','2026-05-13 16:12:12'),(751,376,2,'','2026-05-13 16:12:12','2026-05-13 16:12:12'),(752,376,3,'S','2026-05-13 16:12:12','2026-05-13 16:12:12'),(753,377,2,'','2026-05-13 16:12:12','2026-05-13 16:12:12'),(754,377,3,'M','2026-05-13 16:12:12','2026-05-13 16:12:12'),(755,378,2,'','2026-05-13 16:12:12','2026-05-13 16:12:12'),(756,378,3,'L','2026-05-13 16:12:12','2026-05-13 16:12:12'),(757,379,2,'','2026-05-13 16:12:12','2026-05-13 16:12:12'),(758,379,3,'XL','2026-05-13 16:12:12','2026-05-13 16:12:12'),(759,380,2,'','2026-05-13 16:12:12','2026-05-13 16:12:12'),(760,380,3,'2XL','2026-05-13 16:12:12','2026-05-13 16:12:12'),(797,399,2,'','2026-05-13 17:12:27','2026-05-13 17:12:27'),(798,399,3,'S','2026-05-13 17:12:27','2026-05-13 17:12:27'),(799,400,2,'','2026-05-13 17:12:27','2026-05-13 17:12:27'),(800,400,3,'M','2026-05-13 17:12:27','2026-05-13 17:12:27'),(801,401,2,'','2026-05-13 17:12:27','2026-05-13 17:12:27'),(802,401,3,'L','2026-05-13 17:12:27','2026-05-13 17:12:27'),(803,402,2,'','2026-05-13 17:12:27','2026-05-13 17:12:27'),(804,402,3,'XL','2026-05-13 17:12:27','2026-05-13 17:12:27'),(805,403,2,'','2026-05-13 17:12:27','2026-05-13 17:12:27'),(806,403,3,'2XL','2026-05-13 17:12:27','2026-05-13 17:12:27'),(807,404,2,'','2026-05-13 17:12:27','2026-05-13 17:12:27'),(808,404,3,'3XL','2026-05-13 17:12:27','2026-05-13 17:12:27'),(809,405,2,'','2026-05-13 17:20:30','2026-05-13 17:20:30'),(810,405,3,'xs','2026-05-13 17:20:30','2026-05-13 17:20:30'),(811,406,2,'','2026-05-13 17:20:30','2026-05-13 17:20:30'),(812,406,3,'S','2026-05-13 17:20:30','2026-05-13 17:20:30'),(813,407,2,'','2026-05-13 17:20:30','2026-05-13 17:20:30'),(814,407,3,'M','2026-05-13 17:20:30','2026-05-13 17:20:30'),(815,408,2,'','2026-05-13 17:20:30','2026-05-13 17:20:30'),(816,408,3,'L','2026-05-13 17:20:30','2026-05-13 17:20:30'),(817,409,2,'','2026-05-13 17:20:30','2026-05-13 17:20:30'),(818,409,3,'XL','2026-05-13 17:20:30','2026-05-13 17:20:30'),(819,410,2,'','2026-05-13 17:20:30','2026-05-13 17:20:30'),(820,410,3,'2XL','2026-05-13 17:20:30','2026-05-13 17:20:30'),(821,411,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(822,411,3,'XS','2026-05-13 17:22:41','2026-05-13 17:22:41'),(823,412,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(824,412,3,'S','2026-05-13 17:22:41','2026-05-13 17:22:41'),(825,413,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(826,413,3,'M','2026-05-13 17:22:41','2026-05-13 17:22:41'),(827,414,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(828,414,3,'L','2026-05-13 17:22:41','2026-05-13 17:22:41'),(829,415,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(830,415,3,'XL','2026-05-13 17:22:41','2026-05-13 17:22:41'),(831,416,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(832,416,3,'2XL','2026-05-13 17:22:41','2026-05-13 17:22:41'),(833,417,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(834,417,3,'3XL','2026-05-13 17:22:41','2026-05-13 17:22:41'),(835,418,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(836,418,3,'4XL','2026-05-13 17:22:41','2026-05-13 17:22:41'),(837,419,2,'','2026-05-13 17:22:41','2026-05-13 17:22:41'),(838,419,3,'5XL','2026-05-13 17:22:41','2026-05-13 17:22:41'),(839,420,2,'','2026-05-13 17:54:08','2026-05-13 17:54:08'),(840,420,3,'XS','2026-05-13 17:54:08','2026-05-13 17:54:08'),(841,421,2,'','2026-05-13 17:54:08','2026-05-13 17:54:08'),(842,421,3,'S','2026-05-13 17:54:08','2026-05-13 17:54:08'),(843,422,2,'','2026-05-13 17:54:08','2026-05-13 17:54:08'),(844,422,3,'M','2026-05-13 17:54:08','2026-05-13 17:54:08'),(845,423,2,'','2026-05-13 17:54:08','2026-05-13 17:54:08'),(846,423,3,'L','2026-05-13 17:54:08','2026-05-13 17:54:08'),(847,424,2,'','2026-05-13 17:54:08','2026-05-13 17:54:08'),(848,424,3,'XL','2026-05-13 17:54:08','2026-05-13 17:54:08'),(849,425,2,'','2026-05-13 17:54:08','2026-05-13 17:54:08'),(850,425,3,'2XL','2026-05-13 17:54:08','2026-05-13 17:54:08'),(851,426,2,'','2026-05-13 18:21:21','2026-05-13 18:21:21'),(852,426,3,'S','2026-05-13 18:21:21','2026-05-13 18:21:21'),(853,427,2,'','2026-05-13 18:21:21','2026-05-13 18:21:21'),(854,427,3,'M','2026-05-13 18:21:21','2026-05-13 18:21:21'),(855,428,2,'','2026-05-13 18:21:21','2026-05-13 18:21:21'),(856,428,3,'L','2026-05-13 18:21:21','2026-05-13 18:21:21'),(857,429,2,'','2026-05-13 18:21:21','2026-05-13 18:21:21'),(858,429,3,'XL','2026-05-13 18:21:21','2026-05-13 18:21:21'),(859,430,2,'','2026-05-13 18:21:21','2026-05-13 18:21:21'),(860,430,3,'2XL','2026-05-13 18:21:21','2026-05-13 18:21:21'),(861,431,2,'Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(862,431,3,'S','2026-05-13 18:35:56','2026-05-13 18:35:56'),(863,432,2,'Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(864,432,3,'M','2026-05-13 18:35:56','2026-05-13 18:35:56'),(865,433,2,'Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(866,433,3,'L','2026-05-13 18:35:56','2026-05-13 18:35:56'),(867,434,2,'Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(868,434,3,'XL','2026-05-13 18:35:56','2026-05-13 18:35:56'),(869,435,2,'Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(870,435,3,'2XL','2026-05-13 18:35:56','2026-05-13 18:35:56'),(871,436,2,'Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(872,436,3,'3XL','2026-05-13 18:35:56','2026-05-13 18:35:56'),(873,437,2,'Heather Dark Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(874,437,3,'S','2026-05-13 18:35:56','2026-05-13 18:35:56'),(875,438,2,'Heather Dark Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(876,438,3,'M','2026-05-13 18:35:56','2026-05-13 18:35:56'),(877,439,2,'Heather Dark Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(878,439,3,'L','2026-05-13 18:35:56','2026-05-13 18:35:56'),(879,440,2,'Heather Dark Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(880,440,3,'XL','2026-05-13 18:35:56','2026-05-13 18:35:56'),(881,441,2,'Heather Dark Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(882,441,3,'2XL','2026-05-13 18:35:56','2026-05-13 18:35:56'),(883,442,2,'Heather Dark Black','2026-05-13 18:35:56','2026-05-13 18:35:56'),(884,442,3,'3XL','2026-05-13 18:35:56','2026-05-13 18:35:56');
/*!40000 ALTER TABLE `product_variation_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variations`
--

DROP TABLE IF EXISTS `product_variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variations_product_id_foreign` (`product_id`),
  CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=443 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variations`
--

LOCK TABLES `product_variations` WRITE;
/*!40000 ALTER TABLE `product_variations` DISABLE KEYS */;
INSERT INTO `product_variations` VALUES (46,19,36.50,0,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(47,19,36.50,1,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(48,19,36.50,2,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(49,19,36.50,3,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(50,19,38.50,4,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(51,19,40.50,5,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(52,19,42.00,6,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(53,19,44.00,7,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(54,19,46.00,8,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(55,19,36.50,9,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(56,19,36.50,10,NULL,'2026-05-12 17:24:07','2026-05-12 17:24:07'),(82,22,14.50,0,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(83,22,14.50,1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(84,22,14.50,2,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(85,22,14.50,3,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(86,22,14.50,4,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(87,22,14.50,5,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(210,23,12.50,0,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(211,23,12.50,1,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(212,23,12.50,2,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(213,23,12.50,3,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(214,23,12.50,4,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(215,23,13.50,5,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(216,23,15.00,6,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(217,23,16.50,7,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(218,23,18.00,8,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(219,23,12.50,9,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(220,23,12.50,10,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(221,23,12.50,11,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(222,23,12.50,12,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(223,23,12.50,13,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(224,23,13.50,14,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(225,23,15.00,15,NULL,'2026-05-12 22:26:21','2026-05-12 22:26:21'),(226,23,16.50,16,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(227,23,18.00,17,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(228,23,12.50,18,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(229,23,12.50,19,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(230,23,12.50,20,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(231,23,12.48,21,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(232,23,12.50,22,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(233,23,13.50,23,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(234,23,15.00,24,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(235,23,16.50,25,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(236,23,18.00,26,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(237,23,12.50,27,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(238,23,12.50,28,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(239,23,12.50,29,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(240,23,12.50,30,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(241,23,13.50,31,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(242,23,15.00,32,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(243,23,16.50,33,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(244,23,12.50,34,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(245,23,12.50,35,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(246,23,12.50,36,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(247,23,12.50,37,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(248,23,12.50,38,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(249,23,13.50,39,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(250,23,15.00,40,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(251,23,16.50,41,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(252,23,18.00,42,NULL,'2026-05-12 22:26:22','2026-05-12 22:26:22'),(253,24,16.00,0,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(254,24,16.00,1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(255,24,16.00,2,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(256,24,16.00,3,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(257,24,16.00,4,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(258,24,16.00,5,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(259,24,16.00,6,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(260,24,16.00,7,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(261,24,16.00,8,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(262,24,16.00,9,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(263,24,16.00,10,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(264,24,16.00,11,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(265,24,16.00,12,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(266,24,16.00,13,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(267,24,16.00,14,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(268,24,16.00,15,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(269,24,16.00,16,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(270,24,16.00,17,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(293,25,32.50,0,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(294,25,32.50,1,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(295,25,32.50,2,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(296,25,32.50,3,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(297,25,32.50,4,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(298,25,32.50,5,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(299,25,34.50,6,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(300,25,35.50,7,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(301,25,37.00,8,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(302,25,38.50,9,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(303,25,40.00,10,NULL,'2026-05-12 22:44:38','2026-05-12 22:44:38'),(311,26,49.50,0,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(312,26,49.50,1,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(313,26,49.50,2,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(314,26,49.50,3,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(315,26,49.50,4,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(316,26,51.50,5,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(317,26,53.00,6,NULL,'2026-05-12 23:36:07','2026-05-12 23:36:07'),(330,30,32.00,0,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(331,30,32.00,1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(332,30,32.00,2,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(333,30,32.00,3,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(334,30,32.00,4,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(335,30,32.00,5,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(336,30,33.50,6,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(337,30,35.00,7,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(338,30,36.50,8,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(339,30,37.50,9,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(340,30,39.00,10,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(341,31,54.50,0,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(342,31,54.50,1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(343,31,54.50,2,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(344,31,54.50,3,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(345,31,54.50,4,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(346,31,56.00,5,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(347,31,57.00,6,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(348,33,51.00,0,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(349,33,51.00,1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(350,33,51.00,2,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(351,33,51.00,3,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(352,33,51.00,4,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(353,33,52.50,5,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(354,34,32.00,0,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(355,34,32.00,1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(356,34,32.00,2,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(357,34,32.00,3,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(358,34,31.99,4,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(359,34,32.00,5,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(360,34,33.50,6,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(361,34,35.00,7,NULL,'2026-05-13 15:52:10','2026-05-13 15:52:10'),(362,34,36.50,8,NULL,'2026-05-13 15:52:10','2026-05-13 15:52:10'),(363,34,38.00,9,NULL,'2026-05-13 15:52:10','2026-05-13 15:52:10'),(364,34,39.50,10,NULL,'2026-05-13 15:52:10','2026-05-13 15:52:10'),(365,35,24.50,0,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(366,35,24.50,1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(367,35,24.50,2,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(368,35,24.50,3,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(369,35,24.50,4,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(370,36,18.00,0,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(371,36,18.00,1,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(372,36,18.00,2,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(373,36,18.00,3,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(374,36,18.00,4,NULL,'2026-05-13 16:01:37','2026-05-13 16:01:37'),(375,37,34.00,0,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(376,37,34.00,1,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(377,37,34.00,2,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(378,37,34.00,3,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(379,37,34.00,4,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(380,37,36.50,5,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(399,41,30.50,0,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(400,41,30.50,1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(401,41,30.50,2,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(402,41,30.50,3,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(403,41,32.50,4,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(404,41,34.50,5,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(405,42,40.00,0,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(406,42,40.00,1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(407,42,40.00,2,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(408,42,40.00,3,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(409,42,40.00,4,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(410,42,42.50,5,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(411,39,16.50,0,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(412,39,16.50,1,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(413,39,16.50,2,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(414,39,16.50,3,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(415,39,16.50,4,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(416,39,18.50,5,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(417,39,20.50,6,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(418,39,22.00,7,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(419,39,24.50,8,NULL,'2026-05-13 17:22:41','2026-05-13 17:22:41'),(420,27,27.00,0,NULL,'2026-05-13 17:54:08','2026-05-13 17:54:08'),(421,27,27.00,1,NULL,'2026-05-13 17:54:08','2026-05-13 17:54:08'),(422,27,27.00,2,NULL,'2026-05-13 17:54:08','2026-05-13 17:54:08'),(423,27,27.00,3,NULL,'2026-05-13 17:54:08','2026-05-13 17:54:08'),(424,27,27.00,4,NULL,'2026-05-13 17:54:08','2026-05-13 17:54:08'),(425,27,29.00,5,NULL,'2026-05-13 17:54:08','2026-05-13 17:54:08'),(426,43,53.50,0,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(427,43,53.50,1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(428,43,53.50,2,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(429,43,53.50,3,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(430,43,56.00,4,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(431,44,16.00,0,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(432,44,16.00,1,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(433,44,16.00,2,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(434,44,16.00,3,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(435,44,17.50,4,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(436,44,18.50,5,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(437,44,16.00,6,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(438,44,16.00,7,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(439,44,16.00,8,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(440,44,16.00,9,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(441,44,17.50,10,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56'),(442,44,18.50,11,NULL,'2026-05-13 18:35:56','2026-05-13 18:35:56');
/*!40000 ALTER TABLE `product_variations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_type_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `from_price` decimal(10,2) DEFAULT NULL,
  `to_price` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_product_type_id_foreign` (`product_type_id`),
  KEY `products_created_by_foreign` (`created_by`),
  KEY `products_updated_by_foreign` (`updated_by`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,3,'MagSafe® tough case for iPhone®','magsafe-case',1,20.50,NULL,NULL,'Protect your phone with this tough, dual-layer case. Its impact-resistant shell and shock-absorbing liner keep your device safe, while built-in MagSafe® magnets ensure secure attachment and faster wireless charging.\r\n\r\n• Polycarbonate outer shell\r\n• Thermoplastic Polyurethane inner liner\r\n• Dual-layer protection\r\n• Precisely aligned port openings\r\n• MagSafe® compatible\r\n• Induction charging-compatible\r\n• Matte or gloss finish\r\n• Blank product sourced from Korea\r\n\r\nDisclaimer: Keep away from liquids containing high alcohol levels, as designs on the phone case may rub off. Keep away from direct sunlight to prevent yellowing. \r\n\r\nImportant: This product can’t be shipped to South Korea, Hong Kong, Taiwan, Japan, or Singapore. If your shipping address is in these regions, please choose a different product.','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:42:54'),(2,2,'White glossy mug','white-mug',1,7.00,NULL,NULL,'Whether you\'re drinking your morning coffee, evening tea, or something in between—this mug\'s for you! It\'s sturdy and glossy with a vivid print that\'ll withstand the microwave and dishwasher.\r\n\r\n• Ceramic\r\n• 11 oz mug dimensions: 3.8″ (9.6 cm) in height, 3.2″ (8.2 cm) in diameter\r\n• 15 oz mug dimensions: 4.7″ (11.9 cm) in height, 3.3″ (8.5 cm) in diameter\r\n• 20 oz mug dimensions: 4.3″ (10.9 cm) in height, 3.7″ (9.3 cm) in diameter\r\n• Lead and BPA-free material\r\n• Dishwasher and microwave safe\r\n• Blank product sourced from China\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:57:35'),(4,2,'Insulated tumbler with a straw','tumbler',1,22.50,NULL,NULL,'Upgrade your drinkware game and add a splash of color to your day with this insulated tumbler. Cheers to style and functionality in every sip!\r\n\r\n• High-grade stainless steel tumbler\r\n• 20 oz. (600 ml)\r\n• Tumbler size: 4″ × 7.2″ (10.1 cm × 18.2 cm)\r\n• Includes straw and lid\r\n• Blank product sourced from China and printed in the US\r\n\r\nDisclaimer: \r\n• Not dishwasher or microwave safe. Hand-wash only.\r\n• Not leak-proof. To prevent potential leaks, we recommend keeping the tumbler upright at all times.','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:52:48'),(5,2,'Stainless steel water bottle with a straw lid','water-bottle',1,24.50,NULL,NULL,'Stay hydrated all day with this 32 oz (950 ml) water bottle. It’s ideal for workouts or busy days, with a wide-mouth foldable straw for spill-free sipping and a rotating handle for easy carrying.\r\n\r\n• Double-walled stainless steel with vacuum insulation\r\n• Plastic lid and wide-mouth foldable straw\r\n• 32 oz. (950 ml)\r\n• Height: 9.92″ (25.2 cm)\r\n• Diameter: 3.54″ (9 cm)\r\n• Glossy finish\r\n• Rotating handle\r\n• Comes with an anti-slip patch\r\n• Blank product sourced from China\r\n\r\nDisclaimer: Not dishwasher or microwave safe. Hand-wash only.','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:56:31'),(6,2,'Garment-dyed heavyweight shirt','heavy-shirt',1,18.50,NULL,NULL,'Enjoy ultimate comfort with this unisex garment-dyed shirt, crafted from durable heavyweight fabric and dyed for a lived-in look. The dyeing technique ensures the shirt is pre-shrunk to maintain its shape no matter how many times you wash it.\r\n\r\n• 100% soft ring-spun cotton\r\n• Fabric weight: 6.1 oz./yd.² (206.8 g/m²)\r\n• Relaxed fit\r\n• Garment-dyed, pre-shrunk fabric\r\n• Topstitched, classic width collar\r\n• Twill-taped neck and shoulders for comfort and durability\r\n• Rib cuffs\r\n• Shoulder-to-shoulder twill tape\r\n• Signature twill label\r\n• Blank product sourced from Honduras\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:55:48'),(7,3,'Men’s slip-on canvas shoes','canvas-shoes',1,49.00,NULL,NULL,'Made for comfort and ease, these Men’s Slip-On Canvas Shoes are stylish and the ideal piece for completing an outfit. Equipped with removable soft insoles and rubber outsoles, it’s also easy to adjust them for a better fit.\r\n\r\n•  100% polyester canvas upper side\r\n•  Ethylene-vinyl acetate (EVA) rubber outsole\r\n•  Your brand on the box, insole, and tongue of the shoe \r\n•  Breathable lining, soft insole\r\n•  Elastic side accents\r\n•  Padded collar and tongue\r\n•  Printed, cut, and handmade\r\n•  Blank product sourced from China\r\n\r\nImportant: This product is available in the following countries: United States, Canada, Australia, United Kingdom, New Zealand, Japan, Austria, Andorra, Belgium, Bulgaria, Croatia, Czech Republic, Denmark, Estonia, Finland, France, Germany, Greece, Holy See (Vatican city), Hungary, Iceland, Ireland, Italy, Latvia, Lithuania, Liechtenstein, Luxemburg, Malta, Monaco, Netherlands, Norway, Poland, Portugal, San Marino, Slovakia, Slovenia, Switzerland, Spain, Sweden, and Turkey. If your shipping address is outside these countries, please choose a different product.','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:43:32'),(8,3,'Women’s pajama top','pajama-top',1,25.50,NULL,NULL,'This silky-feel pajama top is wonderful as part of nightwear and doubles as stylish loungewear. The high-quality satin material will make you feel comfy, beautiful, and pampered.\r\n\r\n• 100% Polyester\r\n• Luxurious, silky-feel fabric\r\n• Fabric weight: 2.65 oz./yd.² (90 g/m²)\r\n• Relaxed fit\r\n• Blank product sourced from China\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:44:02'),(9,3,'Women’s athletic shoes','athletic-shoes',1,50.00,NULL,NULL,'Boost your mood throughout your busy day with comfy and lightweight athletic shoes. Equipped with breathable lining, a padded collar, and rubber outsole—they’ll easily become your go-to footwear.\r\n\r\n• 100% polyester ultralight flyknit\r\n• Ethylene-vinyl acetate (EVA) rubber outsole\r\n• Breathable lining\r\n• Soft insole and a padded collar\r\n• Lace-up front\r\n• Soles and laces in matching colors\r\n• Blank product sourced from China\r\n\r\nDisclaimers: \r\n• The outsole design varies by size. Sizes 37.5 to 40 have a point-like pattern, while sizes 40.5 to 47.5 feature stripes.\r\n• A strong glue smell is expected upon the product’s arrival. Allow the shoes to air out for a couple of days and the smell will disappear.','active',NULL,1,'2026-05-05 22:37:02','2026-05-13 17:50:30'),(14,2,'Utility crossbody bag','utility-crossbody-bag',1,27.00,NULL,NULL,'This bag is sturdy, stylish, and ready to go wherever you do. With adjustable straps and two spacious pockets, it’s the ultimate accessory for hiking, festivals, and everyday use.\r\n\r\n• 100% polyester\r\n• Fabric weight: 9 oz./yd.² (305 g/m²)\r\n• Bag size: 5.7″ × 7.7″ × 2″ (14.5 cm × 19.5 cm × 5 cm)\r\n• Capacity: 0.37 gallons (1.4 l)\r\n• Water-resistant and durable\r\n• Sturdy fabric with fusible backing to add firmness\r\n• Inside and outside pockets\r\n• Adjustable strap\r\n• Two-way zipper\r\n• Blank product components sourced from China','active',1,1,'2026-05-11 22:46:30','2026-05-11 22:56:41'),(15,4,'Glass jar soy wax candle','glass-jar-soy-wax-candle',1,14.50,NULL,NULL,'With its sleek glass jar, this candle functions as stylish home decor. Light it up and watch how its soft glow brings the room to life!\r\n\r\n• Soy wax\r\n• Cotton wick\r\n• 3.76″ × 3.13″  (95 × 79 mm) glass vessel\r\n• Product weight: 1.2 lbs (570 g)\r\n• Unscented, has a pleasant natural aroma\r\n• Blank product sourced from Latvia','active',1,1,'2026-05-11 23:04:15','2026-05-12 16:32:46'),(19,3,'Unisex cotton sweatshirt','unisex-cotton-sweatshirt',2,0.00,36.50,46.00,'Soft, stretchy, and made to last – this cotton sweatshirt blends comfort and quality for effortless everyday style for all body types. Its clean shape and breathable fabric make it a go-to piece for casual outfits or standout streetwear designs.\r\n\r\n• 95% cotton, 5% elastane\r\n• Fabric weight: 7.8 oz./yd.² (265 g/m²)\r\n• Relaxed fit with drop shoulder\r\n• Slight stretch for comfort and shape retention\r\n• Pilling-resistant and durable after multiple washes\r\n• Blank product sourced from Mexico\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,1,'2026-05-12 17:11:49','2026-05-12 17:17:59'),(22,2,'Short-Sleeve T-Shirt','short-sleeve-t-shirt',2,0.00,14.50,14.50,'This thick cotton t-shirt makes for a go-to wardrobe staple! It\'s comfortable, soft, and its tubular construction means it\'s less fitted. \r\n\r\n• 100% ring-spun cotton\r\n• Heather Grey is 90% cotton and 10% polyester (all other heather colors are 35% cotton and 65% polyester)\r\n• Fabric weight: 4.3 oz/yd² (145.79 g/m²)\r\n• Pre-shrunk\r\n• Shoulder-to-shoulder taping\r\n• Double-stitched sleeves and bottom hem\r\n• Blank product sourced from Haiti, Honduras, Mexico, or Bangladesh\r\n\r\nDisclaimer: Due to the fabric properties, the White color variant may appear off-white rather than bright white.\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-12 20:30:42','2026-05-12 20:30:42'),(23,2,'Unisex t-shirt','unisex-t-shirt',2,0.00,12.50,18.00,'This t-shirt is everything you\'ve dreamed of and more. It feels soft and lightweight, with the right amount of stretch. It\'s comfortable and flattering for all.\r\n\r\n• 100% combed and ring-spun cotton (Heather colors contain polyester)\r\n• Fabric weight: 4.2 oz./yd.² (142 g/m²)\r\n• Pre-shrunk fabric\r\n• Side-seamed construction\r\n• Shoulder-to-shoulder taping\r\n• Blank product sourced from Nicaragua, Mexico, Honduras, or the US\r\n\r\nDisclaimer: The fabric is slightly sheer and may appear see-through, especially in lighter colors or under certain lighting conditions.\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,1,'2026-05-12 22:07:40','2026-05-12 22:12:38'),(24,2,'Women\'s Relaxed T-Shirt','womens-relaxed-t-shirt',2,0.00,16.00,16.00,'This just might be the softest and most comfortable women\'s t-shirt you\'ll ever own. Combine the relaxed fit and smooth fabric of this tee with jeans to create an effortless every-day outfit, or dress it up with a jacket and dress pants for a business casual look.\r\n\r\n• 100% combed and ring-spun cotton\r\n• Heather Prism Lilac & Heather Prism Natural are 99% combed and ring-spun cotton, 1% polyester\r\n• Athletic Heather is 90% combed and ring-spun cotton, 10% polyester\r\n• Other Heather colors are 52% combed and ring-spun cotton, 48% polyester\r\n• Fabric weight: 4.2 oz/y² (142 g/m²)\r\n• Relaxed fit\r\n• Pre-shrunk fabric\r\n• Side-seamed construction\r\n• Crew neck\r\n• Blank product sourced from Nicaragua, Honduras, or the US\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-12 22:35:39','2026-05-12 22:35:39'),(25,3,'Flare leggings','flare-leggings',2,0.00,32.50,40.00,'Designed to enhance your figure, these trendy leggings feature a high waist and a butt-lifting cut. The flared leg bottoms add a touch of style and make the leggings comfortable. Wear them on a walk, to the gym, or style them up with a bomber jacket or hoodie.\r\n\r\n• 75% recycled polyester, 25% elastane for production in the US/Mexico\r\n• 74% recycled polyester, 26% elastane for production in Latvia\r\n• Fabric weight: 6.64 oz./yd.² (225 g/m²) in the US/Mexico\r\n• Fabric weight: 7.37 oz./yd.² (250 g/m²) in Latvia\r\n• Soft and stretchy premium quality fabric with a mild compression feel\r\n• Moisture-wicking fabric\r\n• UPF 50+ protection\r\n• High-waisted with a butt-lifting cut\r\n• Flared design from the knee down\r\n• Double-layered waistband with a pocket on the inside\r\n• The fabric is OEKO-TEX 100 standard certified\r\n• Blank product components sourced from Mexico and China\r\n\r\nDisclaimers: \r\n• If body measurements fall between sizes, size up for a comfortable fit and size down for a snug fit.\r\n• In areas where the fabric is double-layered (like pockets), details from the inner fabric layer may subtly show through, especially with lighter designs.\r\n• Please note that contact with rough surfaces should be avoided since they can pull out the white fibers in the fabric, damaging the leggings.\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,1,'2026-05-12 22:41:41','2026-05-12 22:43:44'),(26,3,'Men\'s Joggers','mens-joggers',2,0.00,49.50,53.00,'Make your workouts more comfortable with these cotton-feel joggers. They\'re soft on the outside, and even softer on the inside, so use them for a jog, or simply for lounging on the couch to binge your favorite show.\r\n\r\n• 96% recycled polyester, 4% elastane for manufacturing in the US/Mexico\r\n• 95% recycled polyester, 5% spandex for manufacturing in Latvia\r\n• Fabric weight (may vary by 5%): 9.08 oz./yd.² (308 g/m²)\r\n• Slim fit\r\n• Soft cotton-feel fabric face\r\n• Brushed fleece fabric inside\r\n• Cuffed legs\r\n• Practical pockets\r\n• Elastic waistband with a white drawstring\r\n• Blank components sourced from China\r\n\r\nDisclaimer: In areas where the fabric is double-layered (like pockets), details from the inner fabric layer may subtly show through, especially with lighter designs.','active',1,1,'2026-05-12 23:35:13','2026-05-12 23:36:07'),(27,3,'Women’s pajama shorts','womens-pajama-shorts',2,0.00,27.00,29.00,'Lounge in luxury with these silky-soft pajama shorts, perfect for lazy mornings or chilled-out evenings. Crafted for women who love comfort and style, these shorts double as chic loungewear with sleek piping details that give them that extra touch of class. Whether you’re Netflixing all day or winding down, these shorts are a must!\r\n• 100% Polyester\r\n• Premium quality\r\n• Silky-smooth fabric for all-day comfort\r\n• Relaxed fit with adjustable drawstrings\r\n• Chic piping detail along the side seams\r\n• Blank product sourced from China','active',1,1,'2026-05-12 23:42:08','2026-05-12 23:42:37'),(28,3,'Glass jar soy wax candle','glass-jar-soy-wax-candle-2',1,14.50,NULL,NULL,'With its sleek glass jar, this candle functions as stylish home decor. Light it up and watch how its soft glow brings the room to life!\r\n\r\n• Soy wax\r\n• Cotton wick\r\n• 3.76″ × 3.13″  (95 × 79 mm) glass vessel\r\n• Product weight: 1.2 lbs (570 g)\r\n• Unscented, has a pleasant natural aroma\r\n• Blank product sourced from Latvia','active',1,NULL,'2026-05-12 23:46:51','2026-05-12 23:46:51'),(29,3,'Backpack','backpack',1,59.50,NULL,NULL,'This medium size backpack is just what you need for daily use or sports activities! The pockets (including one for your laptop) give plenty of room for all your necessities, while the water-resistant material will protect them from the weather. \r\n\r\n• Made from 100% polyester\r\n• Dimensions: H 16⅛\" (41cm), W 12¼\" (31cm), D 3⅞\" (10cm)\r\n• Fabric weight: 9 oz./yd.² (305 g/m²)\r\n• Maximum weight limit: 44lbs (20kg)\r\n• Water-resistant material\r\n• Large inside pocket with a separate compartment for a 15” laptop, front pocket with a zipper, and a hidden pocket with zipper on the back of the bag\r\n• Top zipper has 2 sliders with zipper pullers\r\n• Silky lining, piped inside hems, and a soft mesh back\r\n• Padded ergonomic bag straps from polyester with plastic strap regulators\r\n• Blank product components sourced from China','active',1,1,'2026-05-13 00:01:18','2026-05-13 17:31:22'),(30,3,'Recycled long-sleeve crop top','recycled-long-sleeve-crop-top',2,0.00,32.00,39.00,'This long-sleeve crop top is made of recycled polyester and elastane, making it an eco-friendly choice for swimming, sports, or athleisure outfits.  The crop top has a tear-away care label and a wide, double-layered waistline band for a comfortable fit. \r\n\r\n• 75% recycled polyester, 25% elastane for production in the US/Mexico\r\n• 88% recycled polyester, 12% elastane for production in Latvia\r\n• Fabric weight: 6.64 oz./yd.² (225 g/m²) in the US/Mexico\r\n• Fabric weight: 6.78 oz./yd.² (230 g/m²) in Latvia\r\n• UPF 50+\r\n• Trendy, cropped fit\r\n• Wide, double-layered waistline band\r\n• Raglan sleeves\r\n• Tear-away care label\r\n• Size up if you’re between sizes as this fabric can be tight on the body\r\n• Blank product components sourced from Mexico and Spain\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 00:09:46','2026-05-13 00:09:46'),(31,3,'Unisex Bomber Jacket','unisex-bomber-jacket',2,0.00,54.50,57.00,'Add a little zing to your wardrobe with this vibrant All-Over Print Bomber Jacket. Wear it on a basic t-shirt, or layer it on top of a warm hoodie—it’ll look great either way. With a brushed fleece inside, and a relaxed unisex fit, this Bomber Jacket is just the stuff of the dreams, so be quick to grab yourself one!\r\n\r\n• 100% polyester\r\n• Fabric weight: 6.49 oz/yd² (220 g/m²), weight may vary by 5%\r\n• Brushed fleece fabric inside\r\n• Unisex fit\r\n• Overlock seams\r\n• Sturdy neck tape\r\n• Silver YKK zipper\r\n• 2 self-fabric pockets\r\n• Blank product components sourced from the US and China\r\n\r\nDisclaimer: In areas where the fabric is double-layered (like pockets), details from the inner fabric layer may subtly show through, especially with lighter designs.\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 00:14:56','2026-05-13 00:14:56'),(32,3,'POLKA DOTS Tapered stainless steel tumbler','polka-dots-tapered-stainless-steel-tumbler',1,38.50,NULL,NULL,'Designed to blend style and practicality, the POLKA DOTS Tapered Stainless Steel Tumbler is an everyday essential with personality. Crafted from durable stainless steel, it helps maintain your beverage’s temperature while offering a comfortable grip and a cup-holder-friendly shape. The tapered design makes it easy to carry, whether you’re commuting, working, or relaxing. Finished with a bold polka dot pattern, this tumbler adds a playful yet refined touch to your daily routine. Reusable and long-lasting, it’s a smart, stylish alternative to disposable drinkware for life on the go.','active',1,NULL,'2026-05-13 00:20:02','2026-05-13 00:20:02'),(33,3,'Women’s cropped windbreaker','womens-cropped-windbreaker',2,0.00,51.00,52.50,'Hike in style without the rain getting in the way—this cropped windbreaker is lightweight, waterproof, and suitable for every kind of adventure. Features include side-slit pockets, breathable mesh lining, and adjustable drawcords on the hood and waist to support all your stylish outdoor looks.\r\n\r\n• 100% polyester\r\n• Breathable mesh lining, reduces static\r\n• Water-resistant\r\n• Elastic cuffs\r\n• Adjustable drawcords on the hood and waist\r\n• Half-zippable front\r\n• Side-slit pockets\r\n• Blank product sourced from China\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 15:43:21','2026-05-13 15:43:21'),(34,4,'Recycled unisex sports jersey','recycled-unisex-sports-jersey',2,0.00,32.00,39.00,'Looking for the perfect sports jersey? We have you covered—made of 100% recycled polyester fabric, this shirt is breathable, moisture-wicking, and has a double-layered v-neck collar that creates a premium look.\r\n\r\n• 100% recycled polyester fabric\r\n• Fabric weight in the EU (may vary by 5%): 5.61 oz./yd.² (190 g/m²)\r\n• Fabric weight in the US (may vary by 5%): 4.42 oz./yd.² (150 g/m²)• Two-way stretch fabric\r\n• Moisture-wicking material\r\n• Regular fit\r\n• UPF50+ protection\r\n• Double-layered v-neck collar\r\n• Blank product sourced from China\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 15:52:09','2026-05-13 15:52:09'),(35,4,'Sublimation Cut & Sew Tank Top','sublimation-cut-sew-tank-top',2,0.00,24.50,24.50,'This body-hugging tank top is a must-have!   \r\n\r\n• 75% recycled polyester, 25% elastane for production in the US/Mexico\r\n• 82% polyester, 18% elastane for production in Latvia\r\n• Fabric weight: 6.64 oz./yd.² (225 g/m²) in the US/Mexico\r\n• Fabric weight: 6.78 oz./yd.² (230 g/m²) in Latvia\r\n• Four-way stretch, which means fabric stretches and recovers on the cross and lengthwise grains \r\n• Made with a smooth, comfortable microfiber yarn\r\n• Precision-cut and hand-sewn after printing\r\n• Blank product components sourced from Mexico and China\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 15:57:24','2026-05-13 15:57:24'),(36,4,'Crop Top','crop-top',2,0.00,18.00,18.00,'Look fabulous in an all-over printed, body-hugging crop top.   \r\n\r\n• 75% recycled polyester, 25% elastane for production in the US/Mexico\r\n• 82% polyester, 18% elastane for production in Latvia\r\n• Fabric weight: 6.64 oz./yd.² (225 g/m²) in the US/Mexico\r\n• Fabric weight: 6.78 oz./yd.² (230 g/m²) in Latvia\r\n• Material has a four-way stretch, which means fabric stretches and recovers on the cross and lengthwise grains.\r\n• Made with a smooth, comfortable microfiber yarn\r\n• Body-hugging fit\r\n• Precision-cut and hand-sewn after printing\r\n• Blank product components sourced from Mexico and China\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 16:01:36','2026-05-13 16:01:36'),(37,4,'Women’s cotton crew neck t-shirt','womens-cotton-crew-neck-t-shirt',2,0.00,34.00,36.50,'This cotton tee is designed to feel like your favorite from day one. Made from soft cotton with just enough stretch, it moves with the body, retains its shape, and looks great wash after wash.\r\n\r\n• 96% cotton, 4% elastane\r\n• Fabric weight: 5.6 oz./yd.² (189 g/m²)\r\n• Regular fit\r\n• Slight stretch for ease and fit retention\r\n• Pilling-resistant and built to last\r\n• Blank product sourced from Mexico\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 16:12:12','2026-05-13 16:12:12'),(38,4,'Glass jar soy wax candle','glass-jar-soy-wax-candle-3',1,14.50,NULL,NULL,'With its sleek glass jar, this candle functions as stylish home decor. Light it up and watch how its soft glow brings the room to life!\r\n\r\n• Soy wax\r\n• Cotton wick\r\n• 3.76″ × 3.13″  (95 × 79 mm) glass vessel\r\n• Product weight: 1.2 lbs (570 g)\r\n• Unscented, has a pleasant natural aroma\r\n• Blank product sourced from Latvia','active',1,NULL,'2026-05-13 16:30:10','2026-05-13 16:30:10'),(39,4,'Unisex t-shirt','unisex-t-shirt-2',2,0.00,16.50,24.50,'This t-shirt is everything you\'ve dreamed of and more. It feels soft and lightweight, with the right amount of stretch. It\'s comfortable and flattering for all. \r\n\r\n• 100% combed and ring-spun cotton (Heather colors contain polyester)\r\n• Fabric weight: 4.2 oz./yd.² (142 g/m²)\r\n• Pre-shrunk fabric\r\n• Side-seamed construction\r\n• Shoulder-to-shoulder taping\r\n• Blank product sourced from Nicaragua, Mexico, Honduras, or the US\r\n\r\nDisclaimer: The fabric is slightly sheer and may appear see-through, especially in lighter colors or under certain lighting conditions.\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,1,'2026-05-13 16:34:24','2026-05-13 17:22:41'),(40,4,'Vintage corduroy cap','vintage-corduroy-cap',1,22.00,NULL,NULL,'Step up your style with an embroidered old-school cap. It’s crafted from 100% cotton corduroy that’s soft to the touch and comfy to wear. It features an adjustable strap with a gold-colored buckle for a great fit and a visor to protect you from the sun and wind. Complete your look with this embroidered corduroy cap and rock a cool vibe all day long.\r\n\r\n• 100% cotton corduroy\r\n• Unstructured, 6-panel, low-profile\r\n• Cotton twill sweatband and taping\r\n• 6 embroidered eyelets\r\n• Adjustable strap with a gold-colored metal buckle\r\n• Head circumference: 20″–22″ (50.8 cm–56 cm)\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,1,'2026-05-13 16:42:20','2026-05-13 17:30:07'),(41,4,'Unisex relax crew neck sweatshirt','unisex-relax-crew-neck-sweatshirt',2,0.00,30.50,34.50,'A sweatshirt that balances comfort and style with ease. Made from a soft cotton blend, it features a relaxed fit and drop shoulders that make it perfect for casual days, lounging, or layering up when it’s cooler outside.\r\n\r\n• 80% cotton, 20% recycled polyester\r\n• Mid-weight fabric for year-round wear\r\n• Relaxed fit \r\n• Drop shoulders, ribbed crew neck, and sleeve cuffs\r\n• Pre-shrunk to help maintain fit\r\n• Blank product sourced from Vietnam\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 17:12:27','2026-05-13 17:12:27'),(42,4,'Unisex fleece sweatpants','unisex-fleece-sweatpants',2,0.00,40.00,42.50,'Well-made and lined with fleece, these comfortable Unisex Fleece Sweatpants will be your first choice for a casual everyday outfit—all you need to add is a graphic tee and sneakers to finish off the look.\r\n\r\n\r\n\r\n• 100% cotton face\r\n\r\n• 65% cotton, 35% polyester\r\n\r\n• Charcoal Heather is 55% cotton, 45% polyester\r\n\r\n• Tightly knit 3-end fleece\r\n\r\n• 5-thread stitching\r\n\r\n• Cuffed and side-seamed legs\r\n\r\n• Elastic inside the waistband\r\n\r\n• Flat drawstrings in a matching color\r\n\r\n• 2 cross pockets in front\r\n\r\n• 1 top-stitched patch pocket on the back of the right leg\r\n\r\n• Ribbed waist, cuffs, and gusset at crotch\r\n\r\n• Blank product sourced from Pakistan','active',1,NULL,'2026-05-13 17:20:30','2026-05-13 17:20:30'),(43,2,'Crop Hoodie','crop-hoodie',2,0.00,53.50,56.00,'Let fashion take over your wardrobe with this great statement piece. The trendy raw hem and matching drawstrings means that this hoodie is bound to become a true favorite.\r\n\r\n• 52% airlume combed and ring-spun cotton, 48% poly fleece\r\n• Fabric weight: 6.5 oz/yd² (220.39 g/m²)\r\n• Dyed-to-match drawstrings\r\n• Dropped shoulder cut\r\n• Cropped body with a raw hem\r\n• Blank product sourced from Mexico, Nicaragua or the United States\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 18:21:21','2026-05-13 18:21:21'),(44,2,'Short-Sleeve T-Shirt','short-sleeve-t-shirt-2',2,0.00,16.00,18.50,'This thick cotton t-shirt makes for a go-to wardrobe staple! It\'s comfortable, soft, and its tubular construction means it\'s less fitted. \r\n\r\n• 100% ring-spun cotton\r\n• Heather Grey is 90% cotton and 10% polyester (all other heather colors are 35% cotton and 65% polyester)\r\n• Fabric weight: 4.3 oz/yd² (145.79 g/m²)\r\n• Pre-shrunk\r\n• Shoulder-to-shoulder taping\r\n• Double-stitched sleeves and bottom hem\r\n• Blank product sourced from Haiti, Honduras, Mexico, or Bangladesh\r\n\r\nDisclaimer: Due to the fabric properties, the White color variant may appear off-white rather than bright white.\r\n\r\nThis product is made especially for you as soon as you place an order, which is why it takes us a bit longer to deliver it to you. Making products on demand instead of in bulk helps reduce overproduction, so thank you for making thoughtful purchasing decisions!','active',1,NULL,'2026-05-13 18:35:55','2026-05-13 18:35:55');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('71WRkC0FZhz65911iFoQXN082ZInDCCkaMTBFTj3',NULL,'152.166.128.23','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidDNPajh0MjZ2UGtYMnlWdmd6NHhYcHlCMGVJck9CdGF2QzNaYVpQYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODk6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbS9hcnRpZmFjdHMvcG9sa2EtZG90cy10YXBlcmVkLXN0YWlubGVzcy1zdGVlbC10dW1ibGVyIjtzOjU6InJvdXRlIjtzOjE0OiJhcnRpZmFjdHMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779027772),('8kxysDai57bgb1tsATki0bCkCgf7S9eMsHxungCx',NULL,'172.70.240.157','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZklYRTV5d3pScFhSSjBWeERPY20wdVFVZmk0d3VSWW03TVJSV2JlMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778996318),('f6lvXjrGdQuNqR86DW9H3lCzoV8RRm26qezAOr5S',NULL,'172.71.148.90','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDFJaEpVcUlBd0psaXBPTFY2dExTdjlpVUtQbnQ2M09oSzVlQUhHcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778991418),('Gya73OIMUWkvOuML0k4MKQlgAXWwyqHrjmApdCIX',NULL,'205.169.39.173','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2daTG0xZkxYN1RFalFubjRmOTBtTG9NcXVYZmxESmN2WUV3YUxTRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778984338),('HQNDd1AWIrUf7c2aGzXXt5a7ExikIQEiMR9waPYX',NULL,'173.194.92.208','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzdHNXdBMDNEVnBKbjZrb0pEWERSTkoweUJ0a2dOZ0tvYllOdkRvbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779027151),('hxLLQ0G87SqBVv67kmG9E6aDgstZ5bv6GMAPlAV5',NULL,'104.22.66.9','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoicHVsekI0STU1c2s1UVdwaDVRS3VqZTFSTldvWjdybFdtaXgwMHdQbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778991422),('lhzmUi6YBomdjOcK3O5pFZh9KmYE1CRuSdWgX8C7',NULL,'172.68.164.152','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDNNbk1VbU1XazNqaUR4VWNCektwVTJzRFE4UWhnRjJPTmlheU1yTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778986802),('n4Q65vsG2ew3mfl93LuQFhDfH8a3qYDdzKWR0ddu',NULL,'172.71.144.88','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2N6M2lQZkN5cFQ4TzVHNzVtRHp6M0UyWHRjQjd5eDFlWkJlWkNkOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778996315),('NVdAa0SSij0dzirpETshp2FPb41zCGidlIzdsl0E',NULL,'119.73.97.172','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoic0Y5ck52YmpzTUFYNjhNOXpoNTZlazlKREdEV3pWYjY0SW05V1BVMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1779294131),('oF759H9YHJ5p2dhf9iClM6fuT59ZE9TP7RTuAGED',NULL,'172.70.247.136','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXFnMVNOZTE3WWNJZXRKVm43TFNqWjMwV1p0RGJ3MktBOTlYaTIwVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778996322),('oVRvfovPOreNm8HoJN23BysOOgPP8kYfzAThb03n',NULL,'13.219.73.223','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/138.0.7204.23 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlBoUDhIeFh5NzBLWFZsNU4xY2VMalpKTWtkZ3RwYzBxQUhzc3ZoMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1779211705),('owT8t5Pw0Om5Vqi12VBlLKypUjzD6Erzk1Fdui3H',NULL,'162.158.111.224','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUU5jUGNrRVZZOVJWODZwb3luSHJ1eXl1TW9SeFlVbnc4QVJZeHY1UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778986806),('tzCPociyKNwFARHlruUtYgPaNM8KoMqO90AthqNf',NULL,'13.219.73.223','okhttp/5.3.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0lZb3FLc3pwa1h5dkdPQ1QxNG05YVVMUWgzb3NNblpNaEl2VmU2aiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1779211657),('WxmzGmtugLbemzCnQlzMTPNyytWcRyhcVqhkZKlo',NULL,'104.22.66.8','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjR6eThlWE44RVBRVzh5d2VZNmpJMUtzblJ2TnJnMENicE5VRWRJRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778991427),('ZkRfqpFanswo0RmN6ggSLAgjW9XM69RhdyRDwCpZ',NULL,'162.158.95.208','Go-http-client/1.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlZBR1FyREpmMnUzRjljbzNva2tYSEwwVEFncVBCdEs2NmdGNDA3QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778986810),('ZwLIM5Ph9rp9hIIH8sWX3RdexXsU6wBRcSi8sM3z',NULL,'205.169.39.173','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTJFRWlUSmgxQXlDZHRHNndRcHA4NEtpZU1jaUp6bnA3R0VSeFBiUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbm90YWJlbnouc2l0ZXN0YWdpbmdsaW5rLmNvbSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1778984334);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Admin','admin@notabenz.com',NULL,'$2y$12$uCpB3jVQS81azYj8fX9Jcu99IZb7/QEgt/ZKva9XTStDey.87/tjK',NULL,'2026-05-05 22:37:02','2026-05-05 22:37:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-20 23:20:20
