-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-02-2023 a las 04:12:53
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_d_usuario_01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_d_usuario_01` (IN `xusu_id` INT)   BEGIN
	UPDATE usuarios 
	SET 
		est='0',
		fech_elim = now() 
	where usu_id=xusu_id;
END$$

DROP PROCEDURE IF EXISTS `sp_i_ticketdetalle_01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_i_ticketdetalle_01` (IN `xtick_id` INT, IN `xusu_id` INT)   BEGIN
	INSERT INTO td_ticketdetalle 
    (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) 
    VALUES 
    (NULL,xtick_id,xusu_id,'Ticket Cerrado...',now(),'1');
END$$

DROP PROCEDURE IF EXISTS `sp_l_usuario_01`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_l_usuario_01` ()   BEGIN
	SELECT * FROM usuarios where est='1';
END$$

DROP PROCEDURE IF EXISTS `sp_l_usuario_02`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_l_usuario_02` (IN `xusu_id` INT)   BEGIN
	SELECT * FROM usuarios where usu_id=xusu_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_pagos`
--

DROP TABLE IF EXISTS `categoria_pagos`;
CREATE TABLE IF NOT EXISTS `categoria_pagos` (
  `cat_pag` int NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`cat_pag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_pagos`
--

INSERT INTO `categoria_pagos` (`cat_pag`, `cat_nom`, `est`) VALUES
(1, 'Transferencia bancaria', 1),
(2, 'Efectivo', 1),
(3, 'Divisas', 1),
(4, 'Punto de venta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_ticket`
--

DROP TABLE IF EXISTS `categoria_ticket`;
CREATE TABLE IF NOT EXISTS `categoria_ticket` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_tick` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_ticket`
--

INSERT INTO `categoria_ticket` (`cat_id`, `cat_tick`, `est`) VALUES
(1, 'Hardware', 1),
(2, 'Software', 1),
(3, 'Incidencia', 1),
(4, 'Peticion de servicio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `usu_id` int DEFAULT NULL,
  `nom_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doc_nac` int NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tip_per` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `client_est` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`client_id`, `usu_id`, `nom_emp`, `doc_nac`, `direccion`, `tip_per`, `client_est`, `est`) VALUES
(1, 2, 'Miguel', 789456, 'Milagro', 'Particular', 'Activo', 1),
(2, NULL, 'Marli', 456789, 'Bella Vista', 'Particular', 'Activo', 1),
(3, 3, 'Pepito', 789456, '5 de julio', 'Particular', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

DROP TABLE IF EXISTS `contratos`;
CREATE TABLE IF NOT EXISTS `contratos` (
  `contrat_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `contrato_plan` int NOT NULL DEFAULT '3',
  `contrat_est` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fech_contrat` datetime DEFAULT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`contrat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`contrat_id`, `client_id`, `contrato_plan`, `contrat_est`, `fech_contrat`, `est`) VALUES
(1, 1, 1, 'Asociado', '2023-02-06 03:23:26', 1),
(2, 2, 4, 'Asociado', '2023-02-06 03:49:13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_plan`
--

DROP TABLE IF EXISTS `contrato_plan`;
CREATE TABLE IF NOT EXISTS `contrato_plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `horario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato_plan`
--

INSERT INTO `contrato_plan` (`id`, `tipo`, `horario`) VALUES
(1, 'Hierro', 'Remoto en horario semanal'),
(2, 'Bronce', 'Horario semanal 8 AM a 5 PM'),
(3, 'Plata', 'Horario de lunes a sabado hasta las 10 PM'),
(4, 'Oro', 'Todos los dias hasta las 10 PM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_servicio`
--

DROP TABLE IF EXISTS `contrato_servicio`;
CREATE TABLE IF NOT EXISTS `contrato_servicio` (
  `contrat_id` int NOT NULL,
  `num_serv` int NOT NULL,
  PRIMARY KEY (`contrat_id`,`num_serv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato_servicio`
--

INSERT INTO `contrato_servicio` (`contrat_id`, `num_serv`) VALUES
(1, 7),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `pag_id` int NOT NULL AUTO_INCREMENT,
  `contrat_id` int NOT NULL,
  `cat_pag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fech_pag` datetime NOT NULL,
  `pag_est` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`pag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`pag_id`, `contrat_id`, `cat_pag`, `fech_pag`, `pag_est`, `est`) VALUES
(1, 1, '1', '2023-02-06 03:24:14', 'Cancelado', 1),
(2, 2, '4', '2023-02-06 03:50:51', 'Cancelado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_contrato`
--

DROP TABLE IF EXISTS `pago_contrato`;
CREATE TABLE IF NOT EXISTS `pago_contrato` (
  `pag_id` int NOT NULL AUTO_INCREMENT,
  `contrat_id` int NOT NULL,
  PRIMARY KEY (`pag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago_contrato`
--

INSERT INTO `pago_contrato` (`pag_id`, `contrat_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

DROP TABLE IF EXISTS `reportes`;
CREATE TABLE IF NOT EXISTS `reportes` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `usu_id` int NOT NULL,
  `numero_referencia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tip_pag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `origen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comprobante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `monto` float NOT NULL DEFAULT '0',
  `fech_trans` date NOT NULL,
  `report_est` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`report_id`, `usu_id`, `numero_referencia`, `tip_pag`, `origen`, `telefono`, `comprobante`, `monto`, `fech_trans`, `report_est`, `est`) VALUES
(1, 2, '102030456', 'Transferencia', '12345678998745612301', NULL, '../public/document/2-102030456-2023-02-06/logoempresa.png', 120, '2023-02-06', 'Esperando', 1),
(2, 3, '123456', 'Pago Movil', 'Banco de Venezuela', '123456', '../public/document/3-123456-2023-02-06/WhatsApp Image 2023-02-04 at 2.19.03 PM.jpeg', 123, '2023-02-06', 'Esperando', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `num_serv` int NOT NULL AUTO_INCREMENT,
  `tip_serv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_serv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_cat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost_serv` int NOT NULL,
  `serv_est` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`num_serv`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`num_serv`, `tip_serv`, `cat_serv`, `sub_cat`, `cost_serv`, `serv_est`, `est`) VALUES
(1, 'Asesoria y Desarrollo', 'Tecnologia de la Informacion', 'Infraestructura Fisica', 1000, 'Disponible', 1),
(2, 'Racks y Cableado Estructurado', 'Tecnologia de la Informacion', 'Infraestructura Fisica', 1100, 'Disponible', 1),
(3, 'Routing, Switching y Firewall', 'Tecnologia de la Informacion', 'Outsourcing IT', 1200, 'Disponible', 1),
(4, 'Telefonia IP', 'Tecnologia de la Informacion', 'Outsourcing IT', 1300, 'Disponible', 1),
(5, 'Reingenieria de redes', 'Tecnologia de la Informacion', 'Outsourcing IT', 1400, 'Disponible', 1),
(6, 'Administracion e Interconexion', 'Redes', 'Redes de datos', 1500, 'Disponible', 1),
(7, 'Redes WIFI', 'Redes', 'Redes de datos', 1600, 'Disponible', 1),
(8, 'Seguridad de redes', 'Redes', 'Redes de datos', 1700, 'Disponible', 1),
(9, 'Puntos de acceso', 'Redes', 'Redes de datos', 1800, 'Disponible', 1),
(10, 'Punto a punto', 'Redes', 'Redes de datos', 1900, 'Disponible', 1),
(11, 'Punto multipunto', 'Redes', 'Redes de datos', 2000, 'Disponible', 1),
(12, 'Sistemas WIFI Empresariales', 'Redes', 'Redes de datos', 2100, 'Disponible', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_documento`
--

DROP TABLE IF EXISTS `td_documento`;
CREATE TABLE IF NOT EXISTS `td_documento` (
  `doc_id` int NOT NULL AUTO_INCREMENT,
  `tick_id` int NOT NULL,
  `doc_nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `td_documento`
--

INSERT INTO `td_documento` (`doc_id`, `tick_id`, `doc_nom`, `fech_crea`, `est`) VALUES
(1, 1, 'logoempresa.png', '2023-02-06 03:33:05', 1),
(2, 2, 'WhatsApp Image 2023-02-04 at 2.19.03 PM.jpeg', '2023-02-06 22:56:19', 1),
(3, 1, 'WhatsApp Image 2023-02-04 at 2.19.03 PM.jpeg', '2023-02-06 22:59:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_ticketdetalle`
--

DROP TABLE IF EXISTS `td_ticketdetalle`;
CREATE TABLE IF NOT EXISTS `td_ticketdetalle` (
  `tickd_id` int NOT NULL AUTO_INCREMENT,
  `tick_id` int NOT NULL,
  `usu_id` int NOT NULL,
  `tickd_descrip` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`tickd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_ticket`
--

DROP TABLE IF EXISTS `tm_ticket`;
CREATE TABLE IF NOT EXISTS `tm_ticket` (
  `tick_id` int NOT NULL AUTO_INCREMENT,
  `usu_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `tick_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tick_descrip` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tick_estado` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `usu_asig` int DEFAULT NULL,
  `fech_asig` datetime DEFAULT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`tick_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tm_ticket`
--

INSERT INTO `tm_ticket` (`tick_id`, `usu_id`, `cat_id`, `tick_titulo`, `tick_descrip`, `tick_estado`, `fech_crea`, `usu_asig`, `fech_asig`, `est`) VALUES
(1, 3, 1, 'test', '<p>test</p>', 'Abierto', '2023-02-06 22:59:31', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_id` int NOT NULL AUTO_INCREMENT,
  `usu_nom` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `usu_ape` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `usu_correo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_pass` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `rol_id` int DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci COMMENT='Tabla Mantenedor de Usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nom`, `usu_ape`, `usu_correo`, `usu_pass`, `rol_id`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
(1, 'Diego', 'Bravo', 'diegobravo2030@gmail.com', '123456', 2, NULL, NULL, NULL, 1),
(2, 'Miguel', 'Fernandez', 'miguel@gmail.com', '123456', 1, '2023-02-06 03:09:37', NULL, NULL, 1),
(3, 'Pepito', 'Diaz', 'pepito@gmail.com', '123456', 1, '2023-02-06 22:36:20', NULL, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
