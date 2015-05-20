/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.6.17 : Database - cecintranet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cecintranet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cecintranet`;

/*Table structure for table `alumno_curso` */

DROP TABLE IF EXISTS `alumno_curso`;

CREATE TABLE `alumno_curso` (
  `id_alumno_curso` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso_ofertar` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  `pagado` float NOT NULL DEFAULT '0',
  `referencia` varchar(10) DEFAULT NULL,
  `id_status` int(11) NOT NULL DEFAULT '1',
  `id_user` int(11) NOT NULL,
  `requiere_factura` int(1) DEFAULT NULL,
  `contacto_factura` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_alumno_curso`),
  KEY `fk_alumno_curso_curso_ofertar1_idx` (`id_curso_ofertar`),
  KEY `fk_alumno_curso_personas1_idx` (`id_persona`),
  CONSTRAINT `fk_alumno_curso_curso_ofertar1` FOREIGN KEY (`id_curso_ofertar`) REFERENCES `curso_ofertar` (`id_curso_ofertar`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_curso_personas1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3297 DEFAULT CHARSET=latin1;

/*Table structure for table `api_keys` */

DROP TABLE IF EXISTS `api_keys`;

CREATE TABLE `api_keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `level` smallint(6) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_keys_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `api_logs` */

DROP TABLE IF EXISTS `api_logs`;

CREATE TABLE `api_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `api_key_id` int(10) unsigned NOT NULL,
  `route` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `api_logs_route_index` (`route`),
  KEY `api_logs_method_index` (`method`),
  KEY `api_logs_api_key_id_foreign` (`api_key_id`),
  CONSTRAINT `api_logs_api_key_id_foreign` FOREIGN KEY (`api_key_id`) REFERENCES `api_keys` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `api_users` */

DROP TABLE IF EXISTS `api_users`;

CREATE TABLE `api_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `aplicaciones` */

DROP TABLE IF EXISTS `aplicaciones`;

CREATE TABLE `aplicaciones` (
  `id_aplicacion` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripción` text NOT NULL,
  `controlador` varchar(100) NOT NULL,
  `metodo` varchar(100) NOT NULL,
  `lectura` int(1) NOT NULL DEFAULT '1' COMMENT '0 para publico, 1 para usuarios, 2 para buscar en tabla privilegios aplicaciones',
  `escritura` int(1) NOT NULL DEFAULT '2' COMMENT '0 para publico, 1 para usuarios, 2 para buscar en tabla privilegios aplicaciones',
  `modificacion` int(1) NOT NULL DEFAULT '2' COMMENT '0 para publico, 1 para usuarios, 2 para buscar en tabla privilegios aplicaciones',
  `eliminar` int(1) NOT NULL DEFAULT '2' COMMENT '0 para publico, 1 para usuarios, 2 para buscar en tabla privilegios aplicaciones',
  `icono` varchar(255) DEFAULT 'fa-folder',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_aplicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Aquí se capturaran las aplicaciones que existen';

/*Table structure for table `archivos_instructores` */

DROP TABLE IF EXISTS `archivos_instructores`;

CREATE TABLE `archivos_instructores` (
  `id_archivo_instructor` int(11) NOT NULL AUTO_INCREMENT,
  `id_instructor` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL COMMENT 'Aquí se indicará que tipo de archivo se sube',
  `url` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_archivo_instructor`),
  KEY `fk_archivos_instructores_instructores1` (`id_instructor`),
  CONSTRAINT `fk_archivos_instructores_instructores1` FOREIGN KEY (`id_instructor`) REFERENCES `instructores` (`id_instructor`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=668 DEFAULT CHARSET=latin1;

/*Table structure for table `aulas` */

DROP TABLE IF EXISTS `aulas`;

CREATE TABLE `aulas` (
  `id_aula` int(11) NOT NULL AUTO_INCREMENT,
  `aula` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `cedes` */

DROP TABLE IF EXISTS `cedes`;

CREATE TABLE `cedes` (
  `id_cede` int(11) NOT NULL AUTO_INCREMENT,
  `cede` char(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cede`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `curso_ofertar` */

DROP TABLE IF EXISTS `curso_ofertar`;

CREATE TABLE `curso_ofertar` (
  `id_curso_ofertar` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL,
  `instructores_id_instructor` int(11) NOT NULL,
  `capacidad_alumnos` int(11) DEFAULT NULL,
  `fechainicial` varchar(10) DEFAULT NULL,
  `fechafinal` varchar(10) DEFAULT NULL,
  `id_aula` int(11) NOT NULL,
  `id_status_cursos` int(11) NOT NULL,
  `id_sabatino_normal` int(11) NOT NULL DEFAULT '1',
  `costo_general` float DEFAULT NULL,
  `costo_empleado` float DEFAULT NULL,
  `costo_politecnico` float DEFAULT NULL,
  `costo_becado` float DEFAULT NULL,
  `referencias_dadas` int(3) NOT NULL DEFAULT '0',
  `referencias_pagadas` int(3) NOT NULL DEFAULT '0',
  `no_ano` int(1) DEFAULT '1' COMMENT 'Aqui se pondra cuantas veces se ha dado en el ano',
  `id_user` int(11) NOT NULL,
  `dias_clase` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_curso_ofertar`),
  KEY `fk_curso_ofertar_cursos1_idx` (`id_curso`),
  KEY `fk_curso_ofertar_instructores1_idx` (`instructores_id_instructor`),
  KEY `fk_curso_ofertar_aulas1_idx` (`id_aula`),
  KEY `fk_curso_ofertar_status_cursos1_idx` (`id_status_cursos`),
  KEY `fk_curso_ofertar_sabatino_normal1_idx` (`id_sabatino_normal`),
  CONSTRAINT `curso_ofertar_ibfk_5` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `curso_ofertar_ibfk_6` FOREIGN KEY (`id_status_cursos`) REFERENCES `status_cursos` (`id_status_cursos`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `curso_ofertar_ibfk_7` FOREIGN KEY (`id_sabatino_normal`) REFERENCES `sabatino_normal` (`id_sabatino_normal`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_ofertar_cursos1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_ofertar_instructores1` FOREIGN KEY (`instructores_id_instructor`) REFERENCES `instructores` (`id_instructor`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=latin1;

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_curso` varchar(255) DEFAULT NULL,
  `id_web` int(11) DEFAULT NULL,
  `letra_referencia` varchar(2) DEFAULT NULL,
  `id_tipos_cursos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `fk_cursos_tipos_cursos1_idx` (`id_tipos_cursos`),
  CONSTRAINT `fk_cursos_tipos_cursos1` FOREIGN KEY (`id_tipos_cursos`) REFERENCES `tipos_cursos` (`id_tipos_cursos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Table structure for table `discapacidades` */

DROP TABLE IF EXISTS `discapacidades`;

CREATE TABLE `discapacidades` (
  `id_discapacidad` int(11) NOT NULL AUTO_INCREMENT,
  `discapacidad` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_discapacidad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `equivalencia_referencias` */

DROP TABLE IF EXISTS `equivalencia_referencias`;

CREATE TABLE `equivalencia_referencias` (
  `id_equivalencia_referencia` int(11) NOT NULL AUTO_INCREMENT,
  `movimientos_id_movimiento` int(11) NOT NULL,
  `alumno_curso_id_alumno_curso` int(11) NOT NULL,
  `status_movimientos_id_status_movimiento` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_equivalencia_referencia`),
  KEY `fk_equivalencia_referencias_movimientos1_idx` (`movimientos_id_movimiento`),
  KEY `fk_equivalencia_referencias_alumno_curso1_idx` (`alumno_curso_id_alumno_curso`),
  CONSTRAINT `fk_equivalencia_referencias_alumno_curso1` FOREIGN KEY (`alumno_curso_id_alumno_curso`) REFERENCES `alumno_curso` (`id_alumno_curso`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_equivalencia_referencias_movimientos1` FOREIGN KEY (`movimientos_id_movimiento`) REFERENCES `movimientos` (`id_movimiento`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2478 DEFAULT CHARSET=latin1;

/*Table structure for table `folios_ipn` */

DROP TABLE IF EXISTS `folios_ipn`;

CREATE TABLE `folios_ipn` (
  `id_folio_ipn` int(11) NOT NULL AUTO_INCREMENT,
  `folio_ipn` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_folio_ipn` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_equivalencia_referencia` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_folio_ipn`)
) ENGINE=InnoDB AUTO_INCREMENT=1785 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Table structure for table `grados_estudio` */

DROP TABLE IF EXISTS `grados_estudio`;

CREATE TABLE `grados_estudio` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `instructor_prefesion_academica` */

DROP TABLE IF EXISTS `instructor_prefesion_academica`;

CREATE TABLE `instructor_prefesion_academica` (
  `id_instructor_prefesion_academica` int(11) NOT NULL AUTO_INCREMENT,
  `id_instructor` int(11) NOT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `fecha_inicio` varchar(10) DEFAULT NULL,
  `fecha_fin` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_instructor_prefesion_academica`),
  KEY `fk_instructor_prefesion_academica_instructores1_idx` (`id_instructor`),
  CONSTRAINT `fk_instructor_prefesion_academica_instructores1` FOREIGN KEY (`id_instructor`) REFERENCES `instructores` (`id_instructor`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=622 DEFAULT CHARSET=latin1;

/*Table structure for table `instructor_profesional` */

DROP TABLE IF EXISTS `instructor_profesional`;

CREATE TABLE `instructor_profesional` (
  `id_instructor_profesional` int(11) NOT NULL AUTO_INCREMENT,
  `id_instructor` int(11) NOT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `fecha_inicio` varchar(20) DEFAULT NULL,
  `fecha_fin` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_instructor_profesional`),
  KEY `fk_instructor_profesional_instructores1_idx` (`id_instructor`),
  CONSTRAINT `fk_instructor_profesional_instructores1` FOREIGN KEY (`id_instructor`) REFERENCES `instructores` (`id_instructor`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=852 DEFAULT CHARSET=latin1;

/*Table structure for table `instructores` */

DROP TABLE IF EXISTS `instructores`;

CREATE TABLE `instructores` (
  `id_instructor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email2` varchar(50) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `RFC` varchar(16) DEFAULT NULL,
  `CURP` varchar(45) DEFAULT NULL,
  `cursos` text NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1' COMMENT 'campo para saber si el instructor esta disponible',
  `id_cede` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_instructor`),
  KEY `fk_instructor_cede1` (`id_cede`),
  CONSTRAINT `fk_instructor_cede1` FOREIGN KEY (`id_cede`) REFERENCES `cedes` (`id_cede`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=633 DEFAULT CHARSET=latin1;

/*Table structure for table `instructores_academicos` */

DROP TABLE IF EXISTS `instructores_academicos`;

CREATE TABLE `instructores_academicos` (
  `id_instructores_academicos` int(11) NOT NULL AUTO_INCREMENT,
  `id_instructor` int(11) NOT NULL,
  `id_tipo_estudio` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `lugar` char(100) DEFAULT NULL,
  `fecha` char(15) DEFAULT NULL,
  `cedula` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_instructores_academicos`),
  KEY `fk_instructores_academicos_instructores1_idx` (`id_instructor`),
  KEY `fk_instructores_academicos_tipos_estudios1_idx` (`id_tipo_estudio`),
  CONSTRAINT `fk_instructores_academicos_instructores1` FOREIGN KEY (`id_instructor`) REFERENCES `instructores` (`id_instructor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_instructores_academicos_instructores2` FOREIGN KEY (`id_instructor`) REFERENCES `instructores` (`id_instructor`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_instructores_academicos_tipos_estudios1` FOREIGN KEY (`id_tipo_estudio`) REFERENCES `tipos_estudios` (`id_tipo_estudio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=850 DEFAULT CHARSET=latin1;

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `mensajes_chat` */

DROP TABLE IF EXISTS `mensajes_chat`;

CREATE TABLE `mensajes_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `hora` tinytext,
  `mensaje` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mensajes_usuarios` (`users_id`),
  CONSTRAINT `mensajes_usuarios` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Table structure for table `meses` */

DROP TABLE IF EXISTS `meses`;

CREATE TABLE `meses` (
  `number` varchar(2) DEFAULT NULL,
  `mes` varchar(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tipos_movimientos_id_tipo_movimiento` int(11) NOT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `num_movimiento` varchar(10) NOT NULL,
  `referencia` text,
  `abono` float DEFAULT NULL,
  `cuenta` varchar(15) NOT NULL COMMENT 'Para pagos de cuenta de tercero',
  `status_movimiento` int(11) NOT NULL DEFAULT '1' COMMENT '1: no enlazado 2:enlazado 3:problema 4:sobrante',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_movimiento`),
  UNIQUE KEY `num_movimiento` (`num_movimiento`),
  KEY `fk_movimientos_tipos_movimientos1_idx` (`tipos_movimientos_id_tipo_movimiento`),
  CONSTRAINT `fk_movimientos_tipos_movimientos1` FOREIGN KEY (`tipos_movimientos_id_tipo_movimiento`) REFERENCES `tipos_movimientos` (`id_tipo_movimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2186 DEFAULT CHARSET=latin1;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `personal` */

DROP TABLE IF EXISTS `personal`;

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_p` varchar(50) DEFAULT NULL,
  `apellido_m` varchar(50) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `extension` int(5) DEFAULT NULL,
  `id_departamento` int(11) NOT NULL,
  `espersona` int(1) DEFAULT '1' COMMENT '1 para personas 0 para servidores',
  `ip` varchar(15) DEFAULT NULL,
  `tags` varchar(100) NOT NULL COMMENT 'para busquedas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_personal`),
  KEY `fk_personal_departamentos_idx` (`id_departamento`),
  CONSTRAINT `fk_personal_departamentos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `id_sexo` int(11) NOT NULL,
  `fecha_nacimiento` varchar(10) DEFAULT NULL,
  `RFC` varchar(13) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `escuela_procedencia` varchar(100) DEFAULT NULL,
  `ano_egreso` int(4) DEFAULT NULL,
  `grados_estudio_id_grado` int(11) NOT NULL,
  `discapacidades_id_discapacidad` int(11) NOT NULL,
  `id_tipo_alumno` int(11) NOT NULL DEFAULT '1',
  `file_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `fk_personas_sexos1_idx` (`id_sexo`),
  KEY `fk_personas_grados_estudio1_idx` (`grados_estudio_id_grado`),
  KEY `fk_personas_discapacidades1_idx` (`discapacidades_id_discapacidad`),
  CONSTRAINT `fk_personas_discapacidades1` FOREIGN KEY (`discapacidades_id_discapacidad`) REFERENCES `discapacidades` (`id_discapacidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personas_grados_estudio1` FOREIGN KEY (`grados_estudio_id_grado`) REFERENCES `grados_estudio` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personas_sexos1` FOREIGN KEY (`id_sexo`) REFERENCES `sexos` (`id_sexo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1510 DEFAULT CHARSET=latin1;

/*Table structure for table `precios_cursos` */

DROP TABLE IF EXISTS `precios_cursos`;

CREATE TABLE `precios_cursos` (
  `clave` int(5) NOT NULL,
  `id_tipo_curso` int(11) NOT NULL,
  `descripcion` text,
  `precio` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`clave`),
  KEY `id_tipo_curso` (`id_tipo_curso`),
  CONSTRAINT `precios_cursos_ibfk_1` FOREIGN KEY (`id_tipo_curso`) REFERENCES `tipos_cursos` (`id_tipos_cursos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `privilegio_aplicaciones` */

DROP TABLE IF EXISTS `privilegio_aplicaciones`;

CREATE TABLE `privilegio_aplicaciones` (
  `id_privilegio_aplicaciones` int(11) NOT NULL AUTO_INCREMENT,
  `aplicaciones_id_aplicacion` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `tipo_privilegios_id_tipo_privilegio` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_privilegio_aplicaciones`),
  KEY `fk_privilegio_aplicaciones_aplicaciones1_idx` (`aplicaciones_id_aplicacion`),
  KEY `fk_privilegio_aplicaciones_users1_idx` (`users_id`),
  KEY `fk_privilegio_aplicaciones_tipo_privilegios1_idx` (`tipo_privilegios_id_tipo_privilegio`),
  CONSTRAINT `fk_privilegio_aplicaciones_aplicaciones1` FOREIGN KEY (`aplicaciones_id_aplicacion`) REFERENCES `aplicaciones` (`id_aplicacion`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_privilegio_aplicaciones_tipo_privilegios1` FOREIGN KEY (`tipo_privilegios_id_tipo_privilegio`) REFERENCES `tipo_privilegios` (`id_tipo_privilegio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_privilegio_aplicaciones_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=latin1;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `default` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `sabatino_normal` */

DROP TABLE IF EXISTS `sabatino_normal`;

CREATE TABLE `sabatino_normal` (
  `id_sabatino_normal` int(11) NOT NULL AUTO_INCREMENT,
  `sabatino_normal` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_sabatino_normal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `servicios_categorias` */

DROP TABLE IF EXISTS `servicios_categorias`;

CREATE TABLE `servicios_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `servicios_disponibles` */

DROP TABLE IF EXISTS `servicios_disponibles`;

CREATE TABLE `servicios_disponibles` (
  `servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_categoria` int(11) DEFAULT NULL,
  `servicio` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`servicio_id`),
  KEY `sub_categoria` (`sub_categoria`),
  CONSTRAINT `servicios_disponibles_ibfk_1` FOREIGN KEY (`sub_categoria`) REFERENCES `servicios_sub_categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `servicios_sub_categorias` */

DROP TABLE IF EXISTS `servicios_sub_categorias`;

CREATE TABLE `servicios_sub_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `sub_categoria` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `servicios_sub_categorias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `servicios_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `sexos` */

DROP TABLE IF EXISTS `sexos`;

CREATE TABLE `sexos` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `sexo` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `solicitud_servicio` */

DROP TABLE IF EXISTS `solicitud_servicio`;

CREATE TABLE `solicitud_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `descripcion` text,
  `id_user_assigned` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1:pendiente,2:asignado,3:atendiendo,4:atendido,6:cancelado',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `servicios_disponible_id` int(11) DEFAULT NULL,
  `observaciones` text,
  `comentarios` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_user_assigned` (`id_user_assigned`),
  KEY `servicios_disponible_id` (`servicios_disponible_id`),
  CONSTRAINT `solicitud_servicio_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitud_servicio_ibfk_2` FOREIGN KEY (`id_user_assigned`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitud_servicio_ibfk_3` FOREIGN KEY (`servicios_disponible_id`) REFERENCES `servicios_disponibles` (`servicio_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `status_cursos` */

DROP TABLE IF EXISTS `status_cursos`;

CREATE TABLE `status_cursos` (
  `id_status_cursos` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status_cursos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `status_movimientos` */

DROP TABLE IF EXISTS `status_movimientos`;

CREATE TABLE `status_movimientos` (
  `id_status_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `status_movimiento` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_status` */

DROP TABLE IF EXISTS `tbl_status`;

CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` char(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `tipo_privilegios` */

DROP TABLE IF EXISTS `tipo_privilegios`;

CREATE TABLE `tipo_privilegios` (
  `id_tipo_privilegio` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_privilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `tipos_alumnos` */

DROP TABLE IF EXISTS `tipos_alumnos`;

CREATE TABLE `tipos_alumnos` (
  `id_tipo_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_alumno` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `tipos_cursos` */

DROP TABLE IF EXISTS `tipos_cursos`;

CREATE TABLE `tipos_cursos` (
  `id_tipos_cursos` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_curso` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipos_cursos`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `tipos_estudios` */

DROP TABLE IF EXISTS `tipos_estudios`;

CREATE TABLE `tipos_estudios` (
  `id_tipo_estudio` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_estudio` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_estudio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `tipos_movimientos` */

DROP TABLE IF EXISTS `tipos_movimientos`;

CREATE TABLE `tipos_movimientos` (
  `id_tipo_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_movimiento` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `user_autologin` */

DROP TABLE IF EXISTS `user_autologin`;

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `user_profiles` */

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `role_id` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_cede` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cede_usuer1` (`id_cede`),
  CONSTRAINT `fk_cede_usuer1` FOREIGN KEY (`id_cede`) REFERENCES `cedes` (`id_cede`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
