/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `eventos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `eventos`;

CREATE TABLE IF NOT EXISTS `actos` (
  `Id_acto` int NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Descripcion_corta` varchar(2000) NOT NULL,
  `Descripcion_larga` varchar(2500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `Num_asistentes` int NOT NULL,
  `id_tipo_acto` int DEFAULT NULL,
  `id_ponente` int NOT NULL,
  PRIMARY KEY (`Id_acto`),
  KEY `FK_Actos_Id_Tipo_Acto` (`id_tipo_acto`),
  KEY `FK_Actos_id_ponente` (`id_ponente`) USING BTREE,
  CONSTRAINT `FK_Actos_id_ponente` FOREIGN KEY (`id_ponente`) REFERENCES `lista_ponentes` (`id_ponente`),
  CONSTRAINT `FK_Actos_Id_Tipo_Acto` FOREIGN KEY (`id_tipo_acto`) REFERENCES `tipo_acto` (`Id_tipo_acto`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

INSERT INTO `actos` (`Id_acto`, `Fecha`, `Hora`, `Titulo`, `Descripcion_corta`, `Descripcion_larga`, `Num_asistentes`, `id_tipo_acto`, `id_ponente`) VALUES
	(6, '2023-06-07', '15:00:00', 'Festival de Música', 'Festival con bandas locales', 'Disfruta de la mejor música en vivo de bandas locales.', 200, 1, 1),
	(9, '2023-09-12', '17:00:00', 'Expo Tecnológica', 'Exhibición de tecnología emergente', 'Las últimas innovaciones en tecnología y electrónica.', 90, 4, 1),
	(10, '2023-10-26', '12:00:00', 'Evento de Networking', 'Encuentro de profesionales', 'Una gran oportunidad para hacer networking con profesionales de distintos sectores.', 110, 5, 1),
	(11, '2023-11-05', '09:30:00', 'Carrera Benéfica', 'Evento deportivo por una causa', 'Participa en una carrera para recaudar fondos para una causa benéfica.', 160, 1, 1),
	(14, '2023-02-09', '16:30:00', 'Simposio de Ciencia', 'Encuentro científico', 'Discusiones y presentaciones sobre los últimos avances en diversas áreas de la ciencia.', 95, 4, 1),
	(15, '2023-03-15', '08:00:00', 'Desayuno Empresarial', 'Networking y charlas de negocios', 'Un evento matutino para empresarios y emprendedores.', 130, 5, 1),
	(16, '2023-04-05', '18:00:00', 'Noche de Cine', 'Proyección de películas independientes', 'Disfruta de una selección de películas independientes.', 65, 1, 1),
	(17, '2023-05-23', '13:00:00', 'Charla sobre Sostenibilidad', 'Sostenibilidad y medio ambiente', 'Discusión sobre prácticas sostenibles y su impacto en el medio ambiente.', 75, 2, 1),
	(18, '2023-06-16', '17:15:00', 'Fiesta de Verano', 'Celebración al aire libre', 'Celebra el inicio del verano con música, comida y diversión.', 190, 3, 1),
	(28, '2024-02-22', '14:00:00', 'Título prueba 0', 'Descripción Corta 0', 'Descripción Larga 0', 1, 1, 6),
	(30, '2023-12-19', '14:00:00', 'Título prueba 22', 'Descripción Corta 2', 'Descripción Larga 2', 17, 1, 6),
	(31, '2023-12-01', '12:00:00', 'Título prueba 3', 'Descripción Corta 3', 'Descripción Larga 3', 9, 2, 6),
	(32, '2023-12-03', '12:00:00', 'Título prueba 4', 'Descripción Corta 4', 'Descripción Larga 4', 3, 2, 6),
	(33, '2023-12-02', '10:00:00', 'Título prueba 5', 'Descripción Corta 5', 'Descripción Larga 5', 28, 1, 6),
	(34, '2023-12-04', '12:00:00', 'Título prueba', 'Descripción Corta 6', 'Descripción Larga 6', 15, 1, 6),
	(35, '2023-12-19', '16:00:00', 'Título prueba 7', 'Descripción Corta 7', 'Descripción Larga 7', 12, 1, 6),
	(36, '2023-12-20', '10:00:00', 'Título prueba 8', 'Descripción Corta 8', 'Descripción Larga 8', 9, 1, 6),
	(37, '2023-12-21', '12:00:00', 'Título', 'Descripción Corta prueba fecha', 'Descripción Larga prueba fecha', 11, 1, 6),
	(38, '2023-12-27', '14:00:00', 'Titulo de prueba de guardado', 'Descripción corta de prueba de guardado en base de datos', 'Descripción corta de prueba de guardado en base de datos', 5, 1, 6),
	(40, '2023-12-27', '12:00:00', 'Titulo de prueba de Ponente 3', 'Descripción corta de prueba de guardado en base de datos', 'Descripción corta de prueba de guardado en base de datos', 5, 2, 4),
	(41, '2023-12-28', '10:00:00', 'Titulo de prueba de Ponente', 'Descripción Larga Titulo de prueba de Ponentes', 'Descripción Larga Titulo de prueba de Ponentes', 3, 2, 4),
	(42, '2023-12-28', '15:00:00', 'Prueba Plazas', 'Descripción Corta Prueba Plazas', 'Descripción Larga Prueba Plazas', 1, 1, 5),
	(43, '2023-12-29', '12:00:00', 'Prueba Plazas 1', 'Descripción Corta Prueba Plazas 1', 'Descripción Larga Prueba Plazas 1', 1, 1, 4),
	(44, '2023-12-28', '11:00:00', 'Prueba Def', 'Descripción Corta Prueba Def', 'Descripción Larga Prueba Def', 2, NULL, 5),
	(45, '2023-12-20', '10:00:00', 'Prueba def 1', 'Descripción Corta Prueba def 1', 'Descripción Larga Prueba def 1', 2, NULL, 4);

CREATE TABLE IF NOT EXISTS `documentacion` (
  `Id_presentacion` int NOT NULL AUTO_INCREMENT,
  `Id_acto` int NOT NULL,
  `Localizacion_documentacion` varchar(100) NOT NULL,
  `Orden` int NOT NULL,
  `Id_persona` int NOT NULL,
  `Titulo_documento` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_presentacion`),
  KEY `FK_Documentacion_Id_Acto` (`Id_acto`),
  KEY `FK_Documentacion_Id_Persona` (`Id_persona`),
  CONSTRAINT `FK_Documentacion_Id_Acto` FOREIGN KEY (`Id_acto`) REFERENCES `actos` (`Id_acto`),
  CONSTRAINT `FK_Documentacion_Id_Persona` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

INSERT INTO `documentacion` (`Id_presentacion`, `Id_acto`, `Localizacion_documentacion`, `Orden`, `Id_persona`, `Titulo_documento`) VALUES
	(1, 36, 'Sala A', 1, 1, 'Presentación Tecnología'),
	(2, 15, 'Sala A', 2, 2, 'Información Adicional'),
	(3, 37, 'Sala B', 1, 3, 'Material del Taller'),
	(4, 6, 'Sala C', 1, 1, 'Presentación de Marketing'),
	(5, 9, 'documentos/pU06GQzm1uU6FwogvZdpRaDYYTdRLEYv8ysQKWzU.pdf', 5, 4, 'ExpoTec.pdf'),
	(6, 10, 'Sala B', 3, 4, 'Prueba1.pdf'),
	(7, 6, 'Sala A', 2, 4, 'Prueba1.pdf'),
	(8, 6, 'Sala A', 5, 4, 'Documetno 1505.pdf'),
	(9, 37, 'Sala A', 2, 4, 'Documento 15-05 M.pdf');

CREATE TABLE IF NOT EXISTS `failed_jobs` (
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


CREATE TABLE IF NOT EXISTS `inscritos` (
  `Id_inscripcion` int NOT NULL AUTO_INCREMENT,
  `Id_persona` int NOT NULL,
  `id_acto` int NOT NULL,
  `Fecha_inscripcion` datetime NOT NULL,
  PRIMARY KEY (`Id_inscripcion`),
  KEY `FK_Inscritos_Id_Persona` (`Id_persona`),
  KEY `FK_Inscritos_Id_Acto` (`id_acto`),
  CONSTRAINT `FK_Inscritos_Id_Acto` FOREIGN KEY (`id_acto`) REFERENCES `actos` (`Id_acto`),
  CONSTRAINT `FK_Inscritos_Id_Persona` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb3;

INSERT INTO `inscritos` (`Id_inscripcion`, `Id_persona`, `id_acto`, `Fecha_inscripcion`) VALUES
	(25, 1, 6, '2023-12-21 19:57:32'),
	(26, 2, 9, '2023-12-21 19:58:21'),
	(28, 3, 18, '2023-12-21 20:08:26'),
	(30, 4, 6, '2023-12-26 13:02:17'),
	(31, 3, 6, '2023-12-26 13:04:24'),
	(32, 5, 31, '2023-12-26 13:05:14'),
	(34, 1, 6, '2023-12-26 13:07:10'),
	(35, 5, 6, '2023-12-26 13:07:10'),
	(36, 2, 11, '2023-12-26 13:08:23'),
	(38, 1, 30, '2023-12-26 13:38:25'),
	(39, 1, 30, '2023-12-26 13:44:09'),
	(40, 4, 11, '2023-12-26 13:48:55'),
	(41, 4, 11, '2023-12-26 13:48:55'),
	(42, 3, 6, '2023-12-26 13:49:43'),
	(43, 1, 30, '2023-12-26 13:52:40'),
	(44, 1, 30, '2023-12-26 13:53:14'),
	(45, 4, 35, '2023-12-26 14:36:11'),
	(46, 1, 37, '2023-12-26 14:36:58'),
	(47, 1, 36, '2023-12-26 14:38:07'),
	(48, 1, 28, '2023-12-26 17:54:23'),
	(49, 4, 37, '2023-12-26 17:54:55'),
	(50, 4, 31, '2023-12-26 17:59:39'),
	(51, 4, 33, '2023-12-26 19:10:56'),
	(52, 1, 33, '2023-12-26 19:17:06'),
	(53, 2, 28, '2023-12-26 20:20:29'),
	(54, 4, 38, '2023-12-27 02:47:47'),
	(55, 4, 9, '2023-12-27 13:14:55'),
	(56, 1, 40, '2023-12-27 17:16:24'),
	(57, 4, 32, '2023-12-27 17:23:59'),
	(63, 3, 33, '2023-12-27 17:38:55'),
	(64, 1, 41, '2023-12-27 17:44:44'),
	(66, 2, 41, '2023-12-27 17:46:21'),
	(67, 5, 41, '2023-12-27 17:46:43'),
	(69, 1, 42, '2023-12-27 17:51:43'),
	(71, 9, 33, '2023-12-27 18:07:05'),
	(73, 10, 33, '2023-12-27 18:28:39'),
	(74, 11, 6, '2023-12-27 18:29:33'),
	(75, 12, 33, '2023-12-27 19:05:14'),
	(76, 1, 44, '2023-12-27 19:07:55'),
	(77, 11, 44, '2023-12-27 19:08:16');

CREATE TABLE IF NOT EXISTS `lista_ponentes` (
  `id_ponente` int NOT NULL AUTO_INCREMENT,
  `Id_persona` int NOT NULL,
  `Id_acto` int NOT NULL,
  `Orden` int NOT NULL,
  PRIMARY KEY (`id_ponente`),
  KEY `FK_Lista_Ponentes_Id_Persona` (`Id_persona`),
  KEY `FK_Lista_Ponentes_Id_Acto` (`Id_acto`),
  CONSTRAINT `FK_Lista_Ponentes_Id_Acto` FOREIGN KEY (`Id_acto`) REFERENCES `actos` (`Id_acto`),
  CONSTRAINT `FK_Lista_Ponentes_Id_Persona` FOREIGN KEY (`Id_persona`) REFERENCES `personas` (`Id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

INSERT INTO `lista_ponentes` (`id_ponente`, `Id_persona`, `Id_acto`, `Orden`) VALUES
	(1, 1, 37, 1),
	(2, 2, 38, 2),
	(3, 3, 36, 1),
	(4, 9, 14, 4),
	(5, 9, 10, 3),
	(6, 9, 15, 2),
	(8, 9, 16, 3);

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_12_20_222133_create_permission_tables', 2);

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5),
	(3, 'App\\Models\\User', 5),
	(1, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(2, 'App\\Models\\User', 8),
	(2, 'App\\Models\\User', 9),
	(2, 'App\\Models\\User', 10),
	(2, 'App\\Models\\User', 11),
	(2, 'App\\Models\\User', 12);

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('prueba0@mail.com', '$2y$10$Jk78Q.h4w7r5fzgeUTQkv.1ubFEVwzQFBu5.ISsIQs.VRDvu1nxMq', '2023-12-21 19:23:02');

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'manage users', 'web', '2023-12-20 21:27:10', '2023-12-20 21:27:10'),
	(2, 'manage posts', 'web', '2023-12-20 21:27:10', '2023-12-20 21:27:10');

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `personas` (
  `Id_persona` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

INSERT INTO `personas` (`Id_persona`, `Nombre`, `Apellido1`, `Apellido2`) VALUES
	(1, 'Prueba0', 'Prueba0', 'Prueba0'),
	(2, 'Prueba1', 'Prueba1', 'Prueba1'),
	(3, 'Maria', 'Lopez', 'Rodriguez'),
	(4, 'Pedro', 'Gonzalez', 'Sanchez'),
	(5, 'Angel', 'Castro', 'Merino'),
	(6, 'Prueba16', 'App16', 'App16'),
	(7, 'Prueba17', 'Prueba7', 'Prueba7'),
	(8, 'Prueba18', 'Prueba18', 'Prueba18'),
	(9, 'Prueba12', 'App12', 'App12'),
	(10, 'prueba13', 'app13', 'app13'),
	(11, 'Pablo', 'Carrasco', 'Ibarburu'),
	(12, 'Lucia', 'Hidalgo', 'Hidalgo');

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2023-12-20 21:27:10', '2023-12-20 21:27:10'),
	(2, 'user', 'web', '2023-12-20 21:27:10', '2023-12-20 21:27:10'),
	(3, 'ponente', 'web', '2023-12-27 00:40:28', '2023-12-27 00:40:28');

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(2, 2);

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `Id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO `tipos_usuarios` (`Id_tipo_usuario`, `Descripcion`) VALUES
	(1, 'Ponentes'),
	(2, 'Administrador'),
	(3, 'Usuario normal');

CREATE TABLE IF NOT EXISTS `tipo_acto` (
  `Id_tipo_acto` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_tipo_acto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

INSERT INTO `tipo_acto` (`Id_tipo_acto`, `Descripcion`) VALUES
	(1, 'Musical'),
	(2, 'Gastronómico'),
	(3, 'Cine'),
	(4, 'Teatro'),
	(5, 'Moda');

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'prueba0', 'prueba0@mail.com', NULL, '$2y$10$3BAryMKzxqGQENOLJQMx1.FYPDZojCRF6ElM8GJNjEenWFOO53D06', NULL, '2023-12-07 12:50:07', '2023-12-20 21:16:15'),
	(2, 'prueba1', 'prueba1@mail.com', NULL, '$2y$10$HtC.iA7VWkBIRDXEq4UJ0.SZo929r26N1ZE0sRDTvy7eG59mAqMjK', NULL, '2023-12-20 21:38:49', '2023-12-20 21:38:49'),
	(3, 'prueba2', 'prueba2@mail.com', NULL, '$2y$10$hg9ix/QnV8Q1l29QpeoUruYvqa/GVCK3nHwySgzroTKMEqvVuULZa', NULL, '2023-12-20 21:45:07', '2023-12-20 21:45:07'),
	(4, 'prueba3', 'prueba3@mail.com', NULL, '$2y$10$EevwpaWvPDuHd6MC6pGRwuYm0RFKmsKr5lrqBU2XKGVKXa/E2vZNe', NULL, '2023-12-20 21:49:44', '2023-12-20 22:00:16'),
	(5, 'prueba4', 'prueba4@mail.com', NULL, '$2y$10$.tOzWDsN.TNQCCkFfupPduff5ckAFqAlWUnRiktJz6tIm4ZdSejVy', NULL, '2023-12-20 21:52:04', '2023-12-20 21:52:04'),
	(6, 'prueba10', 'prueba10@mail.com', NULL, '$2y$10$h7/zkGml0FpYXkhBaAvxXOlrDsd5SOgyFb8WvwCbkz6gopDPIFcsK', NULL, '2023-12-21 19:19:03', '2023-12-21 19:19:03'),
	(7, 'Usauario Nuevo 5', 'prueba5@mail.com', NULL, '$2y$10$PoO7GVyaF1Dh2VqQQsPyZeeAuQ25WahiHoZOqm0p2K2.24RZ5RxF6', NULL, '2023-12-27 01:04:41', '2023-12-27 01:04:41'),
	(8, 'Prueba11', 'prueba11@mail.com', NULL, '$2y$10$kFALEnxm/t.XDbK/J4owNuTdSXVP3npaTkMbOBT75tDvlKaybY7DS', NULL, '2023-12-27 16:37:18', '2023-12-27 16:37:18'),
	(9, 'Prueba12 App12 App12', 'prueba12@mail.com', NULL, '$2y$10$guEf0V.mqF/QQt.h2aUqWu7tb49tThSWVzyzLN39/4wVO4uY5DaEG', NULL, '2023-12-27 17:05:16', '2023-12-27 17:05:16'),
	(10, 'prueba13 app13 app13', 'prueba13@mail.com', NULL, '$2y$10$8tNqrq43/MaYxD9vyXtyR.b2cPzfgt.WWbJHI.FVKKFTLAGRNS2V.', NULL, '2023-12-27 17:22:57', '2023-12-27 17:22:57'),
	(11, 'Pablo Carrasco Ibarburu', 'pablete@mail.com', NULL, '$2y$10$H3Xq1VKuM9pSYElPdiJr5ePdyYG4JEoJUBZAClSKRNZr2EEO.bLim', NULL, '2023-12-27 17:29:27', '2023-12-27 17:29:27'),
	(12, 'Lucia Hidalgo Hidalgo', 'luciahi@mail.com', NULL, '$2y$10$9oN8YPOIXNqre4x93KKNH.vvl/tEONeRRls6Pr/3yAbtNzdpkBelW', NULL, '2023-12-27 18:05:07', '2023-12-27 18:05:07');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_usuario` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Id_Persona` int NOT NULL,
  `Id_tipo_usuario` int NOT NULL,
  PRIMARY KEY (`Id_usuario`),
  KEY `FK_Usuarios_Id_Persona` (`Id_Persona`),
  KEY `FK_Usuarios_Id_Tipo_Usuarios` (`Id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;

INSERT INTO `usuarios` (`Id_usuario`, `Username`, `Password`, `Id_Persona`, `Id_tipo_usuario`) VALUES
	(1, 'test@test.es', '', 1, 1),
	(2, 'usuario1', 'clave123', 2, 2),
	(3, 'usuario2', 'secreto', 3, 2),
	(13, 'castro', '$2y$10$/IXSP7an2UMWea7Xsd4REekT2uc1Ch8QBCWoT4dyyF2uFT9m59jTy', 21, 1),
	(14, 'castro', '$2y$10$omajsq17zeZHg10l.NVExua0n..7VGYPIXCUvjVfTYKBSiQKKid5e', 22, 1),
	(15, 'castro', '$2y$10$IhoFwWyMLAbOJqzn5nqyIulBLuI5v4l.61pHI/QBPrf/70Hv.mqRO', 23, 1),
	(16, 'PepElDelPalots', '$2y$10$GgchzvOaS2QEvTRv0CuLuuMy/.c9pTvoYvtV2rHEyXrfNT/MuziBG', 24, 1),
	(20, 'Usuario1@mail.com', 'pass123', 24, 1),
	(21, 'paco@mail.com', '$2y$10$/662U3UfYKlhA/oEHEc/1Oop1dRGiRNV1QtxBfgiJeaaqPtNF55um', 26, 1),
	(22, 'pepe@mail.com', '$2y$10$/ohOdiQsYRmYnJM6NlduH.8K6nxF9fI45pl8PIEkDwcN.3G8oL9AK', 24, 1),
	(23, 'prueba1@mail.com', '$2y$10$o3IMo6sjbOSXPCg1FxvTPe7mvMf84oybC24.I5YfqSXia8I/SCIoq', 29, 1),
	(24, 'prueba2@mail.com', '$2y$10$hCFC7nZW0VDbu.SkYLIC5uun.K7pdcbzGo8XufZxGCOa1RUBQulMC', 30, 1),
	(25, 'Prueba3@mail.com', '$2y$10$cxntd47FVGZCnC5QuQbMPOfHeEedjs0h6aRdAgWY1l4MaXc9tVu9i', 31, 3),
	(26, 'prueba4@mail.com', '$2y$10$TmNzoP3MLRLcFMGjswUENeLWXzk/Uz1DY8tTgb5K3BvkUPRifpE1O', 32, 3),
	(27, 'prueba5@mail.com', '$2y$10$B721ZshKqNQmlha52t07s.JjQO0sqDQ9LLSbkpA1uzg2Gx5uIpp36', 34, 3),
	(28, 'prueba6@mail.com', '$2y$10$XovPcx7CJWfeusDsVhjwie/mZS7BFzat/2nhbsmiRVihJfrkUD8Em', 36, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
