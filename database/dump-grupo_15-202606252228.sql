/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: grupo_15
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorias_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES
(1,'Aumento de masa muscular','2026-06-10 04:20:49','2026-06-10 04:20:49'),
(2,'Definición / Quemar grasa','2026-06-10 04:20:49','2026-06-10 04:20:49'),
(3,'Salud y vitalidad','2026-06-10 04:20:49','2026-06-10 04:20:49'),
(4,'Accesorios','2026-06-10 04:20:49','2026-06-10 04:20:49');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES
(1,'macarena benitez','bmacarenasolange@gmail.com','compra','hola, me gustaria realizar una compra','vista','2026-06-04 05:16:33','2026-06-05 02:34:21'),
(2,'Ramon Gomez','ramon@gmail.com','reclamo','buenas tardes, me gustaria hacer un reclamo de un producto que me llego en mal estado.','pendiente','2026-06-05 21:25:21','2026-06-25 22:47:16');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_05_15_192458_create_roles_table',1),
(5,'2026_05_15_192559_create_usuarios_table',1),
(6,'2026_06_03_180000_create_categorias_table',1),
(7,'2026_06_03_184640_create_productos_table',1),
(8,'2026_06_04_010453_create_consultas_table',2),
(9,'2026_06_05_143044_create_ventas_cabecera_table',3),
(10,'2026_06_05_143118_create_ventas_detalle_table',3),
(11,'2026_06_25_163804_add_deleted_at_to_productos_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `url_imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
(1,'Whey Protein 2lb Star Nutrion Blend','Whey Protein 2LB Nutrition Blend es un suplemento proteico de alta calidad formulado con una mezcla de proteínas de suero de leche. Aporta aminoácidos esenciales para favorecer la recuperación muscular y el crecimiento de masa magra. Ideal para consumir post-entrenamiento o como complemento proteico diario.',70095.00,3,'productos/YRQrgL7XzCizf2wmkr9p6V3gGcaXBOtsDA4CXvKb.png',1,1,'2026-06-10 05:08:41','2026-06-25 23:07:32',NULL),
(5,'CREATINA 300GR DOYPACK - STAR NUTRITION',NULL,28000.00,7,'productos/acr7b6T4OA7VlKSXjxlzJzEAbwCk8eQY7fX482tX.jpg',1,1,'2026-06-10 21:41:49','2026-06-25 22:43:41','2026-06-25 22:43:41'),
(6,'Gold Standard 100% Whey','Proteína de suero de alta calidad con 24g de proteína por porción y 5.5g de BCAAs. Ideal para la recuperación y el crecimiento muscular. Sabor Extreme Milk Chocolate. 28 porciones por envase.',95000.00,5,'productos/SAJnYWU8UkMPqIvIAWQgpGEHxFPE1YnJP2EusjcX.jpg',1,1,'2026-06-25 23:31:18','2026-06-26 04:20:18',NULL),
(7,'Platinum Nitro Whey - Star Nutrition','Proteína de suero ultra concentrada, aislada e hidrolizada con 25g de proteína por porción. Potenciada con creatina monohidrato y creatina nitrato. Libre de gluten. Sabor Chocolate Suizo. 30 porciones por envase.',58000.00,2,'productos/gJDhG5WopcsyqbBxlbVcSqWFgbuTvNJUDLEnNiJl.webp',1,1,'2026-06-25 23:33:36','2026-06-26 04:19:39',NULL),
(8,'Vegetal Protein Isolate - Gold Nutrition','Proteína 100% vegetal aislada a base de arveja, lupino y arroz. Aporta 30g de proteína natural por porción. Fortificada con Vitamina B12, endulzada con stevia, sin azúcar, sin soja y sin TACC. Apta para veganos. Sabor Neutro. 2lb / 907g.',41000.00,0,'productos/tnHFUfUP3LNzCwLVsJd9ClxnskrXrfz7rbZOI5vi.webp',1,1,'2026-06-25 23:35:35','2026-06-26 04:20:42',NULL),
(9,'Banda de Asistencia Heavy - Proyec','Banda de asistencia para dominadas y ejercicios de fuerza. Intensidad Heavy (17kg - 42.5kg). Tecnología multicapa, 100% látex premium, bicolor amarillo y negro. Ideal para dominadas asistidas, elongación, crossfit y trabajos de fuerza de piernas y brazos.',68800.00,10,'productos/UDOjyfkq8LqRmCOReJmchrkdvtewhTW8hZYNVA4d.webp',1,4,'2026-06-25 23:37:35','2026-06-26 04:20:58',NULL),
(10,'Cinturón de Fuerza Nylon - Balboafit','Cinturón de fuerza de nylon de alta resistencia con hebilla metálica de bloqueo automático. Brinda soporte firme en abdomen y zona lumbar para entrenamientos intensos y levantamiento de pesas. Color negro. Disponible en talles XS, S, M, L, XL.',55000.00,2,'productos/jtxPDMXYvC0SlqahCRS8BbAcwRqmkeoQ7O9jAFyB.webp',1,4,'2026-06-25 23:39:37','2026-06-26 04:21:20',NULL),
(11,'Shaker Gold Nutrition 600cc','Shaker deportivo Gold Nutrition de 600cc. Material resistente y fácil de limpiar, tapa con cierre seguro dorado. Ideal para preparar proteínas, pre-entrenos y suplementos. Diseño transparente con logo dorado.',8000.00,15,'productos/t9ref4uYlAbT7I6V8DrKT5xE3Tqxa22v5KY5fs4b.webp',1,4,'2026-06-25 23:42:47','2026-06-26 04:21:32',NULL),
(12,'Straps de Agarre para Barra - SVG Sport','Cintas de agarre profesionales para levantamiento de pesas, par por unidad. Fabricadas en algodón de alta resistencia con almohadilla de protección para muñeca. 56cm de largo x 4cm de ancho, costuras reforzadas. Ideales para peso muerto, dominadas y remos. Color negro.',8890.00,5,'productos/0RiX1WMWvrJYx1puuXztW0z8ADWXwnJrOzOqbMg7.jpg',1,4,'2026-06-25 23:44:38','2026-06-26 04:21:45',NULL),
(13,'Tobillera con Peso Neoprene 1kg - Proyec','Tobilleras lastradas de neoprene, par por unidad (1kg c/u). Sujeción con velcro ajustable, rellenas con granalla y arena. Ideales para ejercicios de piernas, glúteos y cardio. Color rosa y negro.',24900.00,15,'productos/hPTK89Vthu4axkp2uYgqeArEH8v6SWb6qHESenPy.webp',1,4,'2026-06-25 23:47:33','2026-06-26 04:21:59',NULL),
(14,'L-Carnitina 2000 Tartrato - Body Advance','Suplemento dietario a base de Carnitina Tartrato 2000mg. Colabora en la resistencia durante actividades prolongadas, incrementa el uso de grasas como combustible y acompaña el descenso de peso. Sin TACC, sin lactosa, apto vegano. 180 comprimidos, 30 servicios.',14500.00,9,'productos/NWscBYHbPbtH191vgLnCYNGApZUbnkPsW9CGG0ew.webp',1,2,'2026-06-25 23:49:08','2026-06-26 04:22:13',NULL),
(15,'Carnitine 1000 - Nutrex Research','L-Carnitina pura 1000mg por dosis. Metabolizador lipídico que transporta ácidos grasos a las células para ser utilizados como energía. Sin estimulantes. 60 cápsulas, 30 servicios. Ideal para quemar grasa y mejorar el rendimiento aeróbico.',29700.00,11,'productos/Qz2qHB2ik7FjXNO8mFqrtkCGx7Z7bLNGkXHM2kMD.webp',1,2,'2026-06-25 23:50:33','2026-06-26 04:22:28',NULL),
(16,'Lipo 6 Black Ultra Concentrate - Nutrex Research','Termogénico ultra concentrado en cápsulas líquidas de rápida absorción. Elimina grasa corporal, suprime el apetito y aumenta la energía y el estado de alerta. 250mg de cafeína por servicio. Solo 1 cápsula por dosis. 60 cápsulas, 30 servicios. No apto para menores de 18 años, embarazadas ni lactantes.',65000.00,2,'productos/Y7JWAwTePrssar4ajJaC8RPo1LvlXtWhMZAOKrud.webp',1,2,'2026-06-25 23:51:55','2026-06-26 04:22:41',NULL),
(17,'Colágeno Hidrolizado 300g - Body Advance','Suplemento dietario a base de Colágeno Hidrolizado con L-Metionina, Zinc y Vitaminas. Aporta elasticidad, regeneración de articulaciones, piel, uñas y cabello. Fortalece huesos y tendones. 300g en polvo, 21 servicios. Sabor Frutilla. Industria Argentina.',22000.00,8,'productos/V7OrupqVKjf7p0K4kMn9L4uJCXZCh5SDyz81DFZT.webp',1,3,'2026-06-25 23:53:39','2026-06-26 04:22:53',NULL),
(18,'Omega 3 800EPA/400DHA - InnovaNaturals','Aceite de pescado ultrarefinado de alta concentración con 800mg EPA y 400mg DHA por dosis. Único Omega 3 en Argentina con certificaciones internacionales IFOS y GOED 5 estrellas. Libre de mercurio, metales pesados y contaminantes. Sin TACC, libre de gluten. 60 cápsulas blandas, 30 servicios.',82000.00,4,'productos/OEJU4S9RqFtO0wYwpmdqT7oFIWRsTUwBjSPI1HjO.jpg',1,3,'2026-06-25 23:55:30','2026-06-26 04:23:04',NULL),
(19,'Omelettes Proteicos Jamón y Queso - Granger Foods','Omelettes proteicos hechos con clara de huevo. 25g de proteína por porción, sin azúcar añadida. Rinde 10 omelettes. Contenido neto 350g. Sabor Jamón y Queso.',16000.00,6,'productos/S4VGf7JeS5XWHlIlkWSpXqoOWT0P4Wf9jbDMyVhi.webp',1,3,'2026-06-26 00:23:25','2026-06-26 00:23:25',NULL);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'admin','Administrador','2026-06-05 01:09:28','2026-06-05 01:09:28',NULL),
(2,'cliente','Cliente','2026-06-05 01:09:28','2026-06-05 01:09:28',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_apellido` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` bigint(20) unsigned NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  KEY `usuarios_rol_id_foreign` (`rol_id`),
  CONSTRAINT `usuarios_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(4,'macarena','bmacarenasolange@gmail.com','379455886','$2y$12$sLtnCZ5PJxOzxOedH8R7d.kh5.iKzwZ77w3kd87U06BUU84uHlITC',2,NULL,'2026-06-05 01:11:48','2026-06-05 01:11:48',NULL),
(5,'solangeBeni','beniwen0@gmail.com','37945586','$2y$12$ygSu6OXbHgzgb5LkUI5cveYo55859k1234yqy2pxUVjLXOt9Mlxhe',1,NULL,'2026-06-05 01:37:00','2026-06-05 01:37:00',NULL),
(6,'Ramon Gomez','ramon@gmail.com','3795896321','$2y$12$s186CWyX8G9Eic7EGSgKrOMbkZkICGBb2jel8tmWDF9owi1bFc53.',2,NULL,'2026-06-05 21:10:40','2026-06-05 21:10:40',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_cabecera`
--

DROP TABLE IF EXISTS `ventas_cabecera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas_cabecera` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_venta` timestamp NULL DEFAULT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'carrito',
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_cabecera_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `ventas_cabecera_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_cabecera`
--

LOCK TABLES `ventas_cabecera` WRITE;
/*!40000 ALTER TABLE `ventas_cabecera` DISABLE KEYS */;
INSERT INTO `ventas_cabecera` VALUES
(1,'2026-06-25 23:01:45',4,'confirmado',210285.00,'2026-06-05 22:52:28','2026-06-25 23:01:45'),
(2,NULL,5,'carrito',0.00,'2026-06-10 05:32:19','2026-06-10 05:32:19'),
(3,'2026-06-25 23:07:32',4,'confirmado',70095.00,'2026-06-25 23:07:05','2026-06-25 23:07:32'),
(4,'2026-06-26 03:32:14',4,'confirmado',41.00,'2026-06-25 23:07:52','2026-06-26 03:32:14');
/*!40000 ALTER TABLE `ventas_cabecera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_detalle`
--

DROP TABLE IF EXISTS `ventas_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas_detalle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_detalle_venta_id_foreign` (`venta_id`),
  KEY `ventas_detalle_producto_id_foreign` (`producto_id`),
  CONSTRAINT `ventas_detalle_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `ventas_detalle_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_detalle`
--

LOCK TABLES `ventas_detalle` WRITE;
/*!40000 ALTER TABLE `ventas_detalle` DISABLE KEYS */;
INSERT INTO `ventas_detalle` VALUES
(1,1,1,3,70095.00,210285.00,'2026-06-25 22:53:58','2026-06-25 22:54:06'),
(2,3,1,1,70095.00,70095.00,'2026-06-25 23:07:15','2026-06-25 23:07:15'),
(3,4,8,1,41.00,41.00,'2026-06-26 03:32:00','2026-06-26 03:32:00');
/*!40000 ALTER TABLE `ventas_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'grupo_15'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-06-25 22:28:58
