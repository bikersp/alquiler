-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-08-2021 a las 23:42:56
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alquiler`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `precio`, `descripcion`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(1, 'Cuarto 1', '300.00', 'Piso 2', 'img_1706b9300f46dc7a373cdc6ae8928895.jpg', '2020-10-23 03:14:08', 'cuarto-1', 1),
(2, 'Cuarto 2', '150.00', 'Piso 2', 'img_4e01ad64d99f3fba516bc77d198ce17f.jpg', '2020-10-23 03:17:26', 'cuarto-2', 1),
(3, 'Cuarto 3', '500.00', 'Piso 2', 'img_6cfc2c38c15593e36a5e41795ea1de32.jpg', '2020-10-23 03:17:42', 'cuarto-3', 1),
(4, 'Cuarto 4', '100.00', 'Piso 2', 'img_a939c8d8ca5784159a43d0d82b80582d.jpg', '2020-10-28 03:45:12', 'cuarto-4', 1),
(5, 'Cuarto 5', '300.00', 'Piso 2', 'img_5dafcd6ec18901c147c7cfde850a1ab1.jpg', '2020-10-30 03:05:09', 'cuarto-5', 1),
(6, 'Cuarto 6', '400.00', 'Piso 3', 'img_84f83e4988f31e6fd25e9d2df04d3f7f.jpg', '2020-11-14 00:21:15', 'cuarto-6', 1),
(7, 'Cuarto 7', '400.00', 'Piso 3', 'portada.png', '2021-07-26 19:03:05', 'cuarto-7', 1),
(8, 'Cuarto 8', '350.00', 'Piso 3', 'portada.png', '2021-07-26 19:04:00', 'cuarto-8', 1),
(9, 'Cuarto 9', '400.00', 'Piso 3', 'portada.png', '2021-07-29 19:25:41', 'cuarto-9', 1),
(10, 'Cuarto 10', '400.00', 'Piso 3', 'portada.png', '2021-07-31 21:00:18', 'cuarto-10', 1),
(11, 'Cuarto 11', '300.00', 'Piso 3', 'portada.png', '2021-08-06 17:54:48', 'cuarto-11', 1),
(12, 'Cuarto 12', '350.00', 'Piso 4', 'portada.png', '2021-08-08 19:33:00', 'cuarto-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `idcontacto` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `mensaje` text COLLATE utf8mb4_bin NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `dispositivo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `useragent` text COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcontacto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idcontacto`, `nombre`, `email`, `mensaje`, `ip`, `dispositivo`, `useragent`, `date`) VALUES
(1, 'Jean', 'jean@asda.com', 'sapeee', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:23:27'),
(2, 'Sape', 'sape@asda.com', 'sape', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:28:37'),
(3, 'Test', 'test@sasas.com', 'test', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:29:47'),
(4, 'Jeango', 'jeango@gmail.com', 'jeango sape', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:39:33'),
(5, 'Inqui 2 No', 'jean', 'inquilino 2 no pago', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', '2021-07-31 14:35:47'),
(6, 'El Cuarto No Pago', 'jean', 'gfdg', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', '2021-08-06 17:58:55'),
(7, 'La Sra Leya Pagara Mañana', 'roxana', 'Comfitmo pagar', '192.168.0.148', 'Movil', 'Mozilla/5.0 (iPad; CPU OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/92.0.4515.90 Mobile/15E148 Safari/604.1', '2021-08-09 18:34:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pedidoid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidoid` (`pedidoid`),
  KEY `productoid` (`productoid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `pedidoid`, `productoid`, `precio`, `cantidad`) VALUES
(1, 1, 11, '100.00', 1),
(2, 1, 9, '120.00', 1),
(3, 2, 11, '100.00', 1),
(4, 3, 11, '100.00', 1),
(5, 4, 11, '100.00', 1),
(6, 5, 11, '100.00', 1),
(7, 6, 11, '100.00', 1),
(8, 7, 10, '100.00', 1),
(9, 7, 11, '100.00', 1),
(10, 8, 11, '100.00', 1),
(11, 9, 11, '100.00', 1),
(12, 10, 12, '110.00', 1),
(13, 11, 11, '100.00', 1),
(14, 12, 17, '123.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE IF NOT EXISTS `gastos` (
  `idgasto` bigint(20) NOT NULL AUTO_INCREMENT,
  `servicioid` bigint(20) NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_bin,
  `fecharegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechapago` date DEFAULT NULL,
  `monto` decimal(11,2) NOT NULL,
  PRIMARY KEY (`idgasto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idgasto`, `servicioid`, `nombre`, `descripcion`, `fecharegistro`, `fechapago`, `monto`) VALUES
(2, 1, '', '', '2021-08-06 00:40:18', '2021-08-01', '155.50'),
(3, 2, '', '', '2021-08-06 00:42:13', '2021-08-01', '100.50'),
(4, 4, '', '', '2021-08-06 00:43:43', '2021-08-01', '40.50'),
(6, 3, '', '', '2021-08-06 02:00:05', '2021-08-01', '250.00'),
(8, 1, NULL, 'Luz 100 Mantenimiento 200', '2021-08-09 18:52:44', '2021-09-01', '300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`) VALUES
(6, 5, 'pro_bd7592482a91f4531d8a10ab3d815945.jpg'),
(7, 5, 'pro_d8444581afca144189dcfa8303dd58ee.jpg'),
(8, 7, 'pro_1abf3c3c00b89188b25e324dc39d6f62.jpg'),
(12, 7, 'pro_50458020b4d9ac78098be1649bcad5a8.jpg'),
(19, 2, 'pro_25bff00db4ed6a2e028cb28195cfa649.jpg'),
(20, 2, 'pro_75f4d282b2735d59287c551e6c2a094e.jpg'),
(21, 6, 'pro_bba122841772a79d9089efe260b0d585.jpg'),
(22, 6, 'pro_bf14fed939b2da088255727ede14a1f8.jpg'),
(24, 10, 'pro_6c0537968a89765773d91230daef622a.jpg'),
(25, 10, 'pro_e3345c10650826ea67447733e65e63a8.jpg'),
(27, 11, 'pro_2742b9f94da4267903f22e05a1ed08d4.jpg'),
(28, 11, 'pro_b9b6a5888dd066a017b0e20ca68eee5d.jpg'),
(29, 11, 'pro_ecad1c55690162bc9e1ed58c767f3987.jpg'),
(30, 12, 'pro_d1d4ad5e1603d3c15a440e5dd4c5cb0c.jpg'),
(31, 12, 'pro_c6f6b5eea4c76ed9bc3a58472c6468b7.jpg'),
(32, 12, 'pro_c5b9a923e22639730766f5b9a88773fd.jpg'),
(33, 12, 'pro_616b30feafb00faca08cb1019150610f.jpg'),
(36, 5, 'producto_28a7a62a5fade3dfbe9de3c425a029e2.png'),
(37, 20, 'producto_3b9821c0aedf93b0fc8cd72c7880ffc8.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `descripcion` text COLLATE utf8mb4_bin NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmodulo`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del Sistema', 1),
(3, 'Clientes', 'Clientes de Tienda', 1),
(4, 'Productos', 'Todos los Productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Categorias', 'Categorias PRoductos', 1),
(7, 'Suscriptores', 'Suscriptores de sitio Web', 1),
(8, 'Contactos', 'Mensaje del formulario contacto', 1),
(9, 'Gastos', 'Gastos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `idpago` bigint(20) NOT NULL AUTO_INCREMENT,
  `personaid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `tipopagoid` bigint(20) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechapago` date DEFAULT NULL,
  `monto` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`idpago`),
  KEY `personaid` (`personaid`),
  KEY `productoid` (`productoid`),
  KEY `tipopagoid` (`tipopagoid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idpago`, `personaid`, `productoid`, `tipopagoid`, `fecharegistro`, `fechapago`, `monto`) VALUES
(6, 1, 5, 2, '2021-08-05 22:15:24', '2021-08-01', '300.00'),
(7, 1, 18, 2, '2021-08-05 22:15:41', '2021-08-01', '300.00'),
(8, 1, 20, 2, '2021-08-06 18:02:57', '2021-08-01', '300.00'),
(9, 1, 6, 5, '2021-08-06 18:15:55', '2021-08-01', '400.00'),
(10, 1, 10, 2, '2021-08-08 01:35:05', '2021-08-01', '400.00'),
(11, 1, 11, 2, '2021-08-08 01:38:25', '2021-08-01', '400.00'),
(12, 1, 10, 2, '2021-08-08 01:39:48', '2021-07-01', '400.00'),
(13, 1, 7, 2, '2021-08-08 02:09:21', '2021-07-01', '350.00'),
(14, 1, 2, 2, '2021-08-08 16:55:48', '2021-08-01', '350.00'),
(18, 1, 2, 2, '2021-08-08 18:42:13', '2021-07-01', '350.00'),
(22, 1, 12, 2, '2021-08-08 19:54:57', '2021-08-01', '350.00'),
(23, 1, 19, 2, '2021-08-08 19:56:32', '2021-08-01', '300.00'),
(24, 1, 6, 2, '2021-08-08 19:57:01', '2021-07-01', '400.00'),
(25, 1, 5, 2, '2021-08-08 20:09:10', '2021-07-01', '300.00'),
(26, 13, 21, 2, '2021-08-09 18:37:05', '2021-08-01', '350.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` bigint(20) NOT NULL AUTO_INCREMENT,
  `referenciacobro` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `idtransaccionpaypal` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `datospaypal` text COLLATE utf8mb4_bin,
  `personaid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `costo_envio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `monto` decimal(10,2) NOT NULL,
  `tipopagoid` bigint(20) NOT NULL,
  `direccion_envio` text COLLATE utf8mb4_bin,
  `status` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `tipopagoid` (`tipopagoid`),
  KEY `pesonaid` (`personaid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `referenciacobro`, `idtransaccionpaypal`, `datospaypal`, `personaid`, `fecha`, `costo_envio`, `monto`, `tipopagoid`, `direccion_envio`, `status`) VALUES
(1, NULL, NULL, NULL, 1, '2021-01-20 18:21:11', '0.00', '270.00', 2, ', ', 'Pendiente'),
(2, NULL, NULL, NULL, 1, '2021-01-20 18:24:42', '0.00', '150.00', 2, ', ', 'Pendiente'),
(3, NULL, NULL, NULL, 1, '2021-01-20 18:27:07', '0.00', '150.00', 2, '1, 2', 'Pendiente'),
(4, NULL, '86L108645R287541J', '{\"create_time\":\"2021-01-20T23:34:31Z\",\"update_time\":\"2021-01-20T23:35:11Z\",\"id\":\"7B829197F2894234P\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-u5zvy3826444@personal.example.com\",\"payer_id\":\"8K7PPKMEMDER6\",\"address\":{\"country_code\":\"PE\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por $150\",\"reference_id\":\"default\",\"amount\":{\"value\":\"150.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-8fm4733736816@personal.example.com\",\"merchant_id\":\"NJD7Z4NXA9Z9Q\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Lima\",\"admin_area_1\":\"Lima\",\"postal_code\":\"07001\",\"country_code\":\"PE\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"86L108645R287541J\",\"final_capture\":true,\"create_time\":\"2021-01-20T23:35:11Z\",\"update_time\":\"2021-01-20T23:35:11Z\",\"amount\":{\"value\":\"150.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/86L108645R287541J\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/86L108645R287541J/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7B829197F2894234P\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7B829197F2894234P\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', 1, '2021-01-20 18:35:13', '0.00', '150.00', 1, 'surco, Lima', 'Completo'),
(5, NULL, NULL, NULL, 1, '2021-01-20 18:40:55', '0.00', '150.00', 3, '1, 2', 'Pendiente'),
(6, NULL, NULL, NULL, 1, '2021-01-26 19:27:44', '50.00', '150.00', 3, 'asd, asdas', 'Pendiente'),
(7, '879879879798', NULL, NULL, 1, '2021-01-26 19:59:00', '50.00', '250.00', 3, 'proceres, surco', 'Aprobado'),
(8, NULL, '6TG2331984878750D', '{\"create_time\":\"2021-02-17T03:54:28Z\",\"update_time\":\"2021-02-17T03:54:53Z\",\"id\":\"24183970X1067144U\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-u5zvy3826444@personal.example.com\",\"payer_id\":\"8K7PPKMEMDER6\",\"address\":{\"country_code\":\"PE\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por $150\",\"reference_id\":\"default\",\"amount\":{\"value\":\"150.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-8fm4733736816@personal.example.com\",\"merchant_id\":\"NJD7Z4NXA9Z9Q\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Lima\",\"admin_area_1\":\"Lima\",\"postal_code\":\"07001\",\"country_code\":\"PE\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"6TG2331984878750D\",\"final_capture\":true,\"create_time\":\"2021-02-17T03:54:53Z\",\"update_time\":\"2021-02-17T03:54:53Z\",\"amount\":{\"value\":\"150.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/6TG2331984878750D\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/6TG2331984878750D/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/24183970X1067144U\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/24183970X1067144U\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', 1, '2021-02-16 22:54:56', '50.00', '150.00', 1, 'adfg, dfgdfg', 'Reembolsado'),
(9, NULL, '0N040768DY898573V', '{\"create_time\":\"2021-02-18T22:24:11Z\",\"update_time\":\"2021-02-18T22:24:37Z\",\"id\":\"7J0437431P5137230\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-u5zvy3826444@personal.example.com\",\"payer_id\":\"8K7PPKMEMDER6\",\"address\":{\"country_code\":\"PE\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por $150\",\"reference_id\":\"default\",\"amount\":{\"value\":\"150.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-8fm4733736816@personal.example.com\",\"merchant_id\":\"NJD7Z4NXA9Z9Q\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Lima\",\"admin_area_1\":\"Lima\",\"postal_code\":\"07001\",\"country_code\":\"PE\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"0N040768DY898573V\",\"final_capture\":true,\"create_time\":\"2021-02-18T22:24:37Z\",\"update_time\":\"2021-02-18T22:24:37Z\",\"amount\":{\"value\":\"150.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/0N040768DY898573V\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/0N040768DY898573V/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7J0437431P5137230\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7J0437431P5137230\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', 1, '2021-02-18 17:24:37', '50.00', '150.00', 1, '123, 123', 'Completo'),
(10, '23434', NULL, NULL, 18, '2021-04-27 16:51:33', '50.00', '160.00', 4, 'Av. Aviación, Lima', 'Completo'),
(11, '3423423123', NULL, NULL, 1, '2021-04-27 16:55:20', '50.00', '150.00', 2, 'asd, sadas', 'Completo'),
(12, NULL, NULL, NULL, 1, '2021-07-03 23:37:39', '50.00', '173.00', 3, 'asd, asd', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT '0',
  `w` int(11) NOT NULL DEFAULT '0',
  `u` int(11) NOT NULL DEFAULT '0',
  `d` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpermiso`),
  KEY `rolid` (`rolid`),
  KEY `moduloid` (`moduloid`)
) ENGINE=InnoDB AUTO_INCREMENT=399 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(324, 7, 1, 1, 0, 0, 0),
(325, 7, 2, 0, 0, 0, 0),
(326, 7, 3, 0, 0, 0, 0),
(327, 7, 4, 0, 0, 0, 0),
(328, 7, 5, 1, 0, 0, 0),
(329, 7, 6, 0, 0, 0, 0),
(345, 1, 1, 1, 1, 1, 1),
(346, 1, 2, 1, 1, 1, 1),
(347, 1, 3, 1, 1, 1, 1),
(348, 1, 4, 1, 1, 1, 1),
(349, 1, 5, 1, 1, 1, 1),
(350, 1, 6, 1, 1, 1, 1),
(351, 1, 7, 1, 1, 1, 1),
(352, 1, 8, 1, 1, 1, 1),
(353, 1, 9, 1, 1, 1, 1),
(372, 2, 1, 1, 0, 0, 0),
(373, 2, 2, 1, 0, 0, 0),
(374, 2, 3, 0, 0, 0, 0),
(375, 2, 4, 1, 1, 1, 1),
(376, 2, 5, 1, 1, 1, 1),
(377, 2, 6, 1, 0, 1, 0),
(378, 2, 7, 0, 0, 0, 0),
(379, 2, 8, 1, 1, 1, 1),
(380, 2, 9, 1, 1, 1, 1),
(390, 3, 1, 1, 0, 0, 0),
(391, 3, 2, 1, 0, 0, 0),
(392, 3, 3, 0, 0, 0, 0),
(393, 3, 4, 1, 0, 0, 0),
(394, 3, 5, 1, 0, 0, 0),
(395, 3, 6, 1, 0, 0, 0),
(396, 3, 7, 0, 0, 0, 0),
(397, 3, 8, 1, 1, 0, 0),
(398, 3, 9, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `idpersona` bigint(20) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(30) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `cuentas` varchar(250) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `password` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nit` varchar(20) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombrefiscal` varchar(80) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `direccionfiscal` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpersona`),
  KEY `rolid` (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `cuentas`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '32423423', 'Jean', 'Cuadros', 'BCP(123123-123123-423423),\r\nINTERBANK(234234-234234,23423),\r\nBVA(234234-23423-234234)', 933185204, 'bikersprop@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'f', 'J', 'J', 'eb4758bcd5e87f375ddb-fcb20952597ee7d11483-08497b6e611d187cea8c-eb73c43181f8d17a5d3c', 1, '2021-01-01 21:26:05', 1),
(2, '435234', 'Fredy', 'Cuadros', 'BCP(123123-123123-423423),\r\nINTERBANK(234234-234234,23423),\r\nBVA(234234-23423-234234)', 965778657, 'fredy@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '123125', 'Nombre Fiscal', 'Dirección Fisca', NULL, 2, '2021-01-02 00:55:48', 1),
(8, '123', 'Wes', 'Qwe', NULL, 123, 'qwe', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 1, '2021-01-01 21:28:12', 0),
(10, '234', 'Sadf', 'Asdf', NULL, 324, 'sdf', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 1, '2021-01-02 00:58:00', 0),
(11, '1234', '123', '123', NULL, 123, '1234', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 1, '2021-01-02 00:59:49', 0),
(12, '12345', '123', '123', NULL, 123, '12345', '1aa9e2005240e026cc44250623ecb6b52485c70f97fee8e3f8aa9a9eaf0ae089', NULL, NULL, NULL, NULL, 1, '2021-01-02 02:52:32', 0),
(13, '07479982', 'Roxana', 'Vasquez', 'BCP(123123-123123-423423),\r\nINTERBANK(234234-234234-23423),\r\nBVA(234234-23423-234234)', 981585621, 'rox@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 2, '2021-01-02 02:53:30', 1),
(14, '1243432', 'Katy', 'Cuadros', 'BCP(123123-123123-423423),\r\nINTERBANK(234234-234234,23423),\r\nBVA(234234-23423-234234)', 9563456454, 'katy@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 2, '2021-01-02 16:35:17', 1),
(15, '1111111111', 'Aaaaaaaa', 'Aaaaaaaa', NULL, 11111111111, 'aaaaaaaa@sad.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa', NULL, 7, '2021-01-03 22:57:41', 0),
(16, '356456', 'Sdf', 'Dasf', NULL, 34234234, 'asdf@df.com', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', '234', 'sdfsadf', 'dsafsad', NULL, 7, '2021-01-03 23:10:16', 0),
(17, '1313131313', 'Aaaaaaaa', 'Aaaaaaaa', NULL, 13131313, 'aaaaaaaa', '1be50992b1a00d9ea17acaafcf11615e4f37cbc50160e70be4992854b57264e8', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa', NULL, 7, '2021-01-03 23:13:55', 0),
(18, '12312312', 'Jean', 'Cuadrosw', NULL, 435345, 'bikersprop@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '34234', 'asdasdasd', 'ssafsdafsadfsdf', NULL, 7, '2021-01-04 00:10:03', 0),
(19, 'sdaf', 'Jeango', 'Sape', NULL, 234234, 'asdfasdf@asd.com', 'abb70ed16674dc5810880a62be09900986ab1f0ce8a93e493ca521c76cd1d518', '2342', 'sfdasdf', 'sadfsadf', NULL, 7, '2021-01-04 00:11:24', 0),
(20, 'sadf', 'Dsaf', 'Sdaf', NULL, 234, 'dfgs@dsfs.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'adsf', 'asdf', 'asf', NULL, 7, '2021-01-04 00:13:17', 0),
(21, 'asdf', 'Sape', 'Asdf', NULL, 24234, 'sadf@asdas.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 2, '2021-01-04 19:32:09', 0),
(22, '234234', 'Jaengo', 'Sape', NULL, 546464645, 'asdas@dasd.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:48:19', 0),
(23, NULL, 'Jaengo', 'Sape', NULL, 546464645, 'assdas@dasd.com', 'dd2842d0715ea85a446d6fe2c5219fb52fb4850c91bdc1a58739c7585d970223', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:50:37', 0),
(24, NULL, 'Sdafsd', 'Sadfsad', NULL, 323423, 'dghfg@asc.com', '01c0d023aafe7bc3352aea93fca52b5f0e515d5c096805f4d2e317c05616f419', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:52:01', 0),
(25, NULL, 'Sdfsdf', 'Adgadg', NULL, 23423, 'asdfsd@dsds.com', '77a803e8bda342455b0966ad261f79b69fadbc0f9da2b6298ca7999d7c2f4989', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:54:08', 0),
(26, NULL, 'Seledonio', 'Nupanupa', NULL, 12312312312, 'seledonio@gmail.com', '65e6ae86ae974d3d464ddbb11094f532d7baab260e6bbcd56ed54010bca22d09', NULL, NULL, NULL, NULL, 7, '2021-01-08 16:59:13', 0),
(27, NULL, 'Asd', 'Asd', NULL, 13112312, 'sdasd@asdasas.com', 'bed10a853c6a4d5620fe1b701747c6f0ea5fec9a9a7acf3eab14619bf0a5d487', NULL, NULL, NULL, NULL, 7, '2021-01-08 17:07:54', 0),
(28, '4353453442655', 'Violeta', 'Castañeda', 'BCP(123123-123123-423423),\r\nINTERBANK(234234-234234,23423),\r\nBVA(234234-23423-234234)', 923423323, 'vileta@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 3, '2021-08-05 19:47:53', 1),
(29, '7456456', 'Wendy', 'Cuadro', 'BCP(123123-123123-423423),\r\nINTERBANK(234234-234234,23423),\r\nBVA(234234-23423-234234)', 45423542345, 'wendy@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 3, '2021-08-05 19:51:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoriaid` bigint(20) NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci,
  `telefono` bigint(20) DEFAULT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechainicio` varchar(20) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `fechafin` varchar(20) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`),
  KEY `categoriaid` (`categoriaid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `categoriaid`, `codigo`, `nombre`, `descripcion`, `telefono`, `precio`, `stock`, `imagen`, `datecreated`, `fechainicio`, `fechafin`, `ruta`, `status`) VALUES
(2, 6, '465456465', 'Sanedra', '<p>Descripci&oacute;n producto</p> <ul> <li>Uno</li> <li>Dos</li> </ul>', NULL, '350.00', 2, '', '2020-11-15 03:13:35', '02/06/2021', '02/08/2021', 'sanedra', 1),
(5, 1, '6546546545', 'Mariana', '<p>Aqu&iacute; va la descripci&oacute;n del producto</p> <ul> <li>Grande</li> <li>Peque&ntilde;o</li> <li>Mediano</li> </ul>', NULL, '300.00', 3, '', '2020-11-23 03:22:35', '06/07/2021', '06/09/2021', 'mariana', 1),
(6, 8, '42354534', 'Eugenia dervez', '<p>Descripci&oacute;n producto seis</p> <ul> <li>Uno</li> <li>Dos</li> <li>Tres</li> </ul> <p>&nbsp;</p>', NULL, '400.00', 3, '', '2020-11-23 03:38:55', '04/08/2021', '04/11/2021', 'eugenia-dervez', 1),
(7, 7, '65465454', 'Marlene', '<p>Datos del producto</p>', NULL, '350.00', 2, '', '2020-11-23 03:39:59', '30/07/2021', '30/09/2021', 'marlene', 1),
(10, 4, '654546544', 'Giselle', '<p>Descripc&oacute;n</p>', NULL, '400.00', 2, '', '2020-12-02 03:52:09', '01/08/2021', '01/10/2021', 'giselle', 1),
(11, 3, '4657897897', 'Marcela', '<p>Descripcipci&oacute;n producto prueba</p> <ul> <li>Uno</li> <li>Dos</li> <li>Tres</li> </ul> <p>&nbsp;</p>', NULL, '400.00', 3, '', '2020-12-06 02:30:02', '12/07/2021', '12/11/2021', 'marcela', 1),
(12, 2, '4894647878', 'Pepito', '<p>Descripci&oacute;n producto ejemplo</p> <ul> <li>Uno</li> <li>Dos</li> <li>Tres</li> </ul>', NULL, '350.00', 2, '', '2020-12-11 02:23:22', '13/07/2021', '13/11/2021', 'pepito', 1),
(18, 9, '12312334345', 'Mendelosa', '<p>sdf</p>', NULL, '300.00', 1, NULL, '2021-07-31 19:24:02', '16/05/2021', '16/07/2021', 'mendelosa', 1),
(19, 10, '23424234', 'Maria', '<p>test</p>', NULL, '300.00', 2, NULL, '2021-07-31 21:02:08', '28/07/2021', '28/10/2021', 'test-2', 1),
(20, 11, '56456456456', 'monchita', '<p>tiene un michilin</p>', NULL, '300.00', 2, NULL, '2021-08-06 17:55:36', '06/08/2021', '06/12/2021', 'monchita', 1),
(21, 5, '9876543', 'Leya', '<p>&nbsp;Es una oscuri</p>', 123, '350.00', 1, NULL, '2021-08-09 18:32:16', '09/08/2021', '26/02/2022', 'leya', 1),
(23, 1, '2342348', 'sdf', '<p>sdfsdf</p>', NULL, '233.00', 2, NULL, '2021-08-09 22:25:00', '09/08/2021', '13/09/2021', 'sdf', 0),
(24, 1, '436456345', 'saca', '<p>dfgdsfgd</p>', NULL, '123.00', 2, NULL, '2021-08-09 22:41:45', '09/08/2021', '13/09/2021', '1', 0),
(25, 1, '4364543534', 'asa', '<p>fsdfsdaf</p>', NULL, '123.00', 2, NULL, '2021-08-09 22:55:10', '09/08/2021', '13/09/2021', 'asa', 0),
(26, 1, '12423443', 'werwqer', '<p>23423423</p>', NULL, '1234.00', 3, NULL, '2021-08-09 23:00:30', '09/08/2021', '09/08/2021', 'werwqer', 0),
(27, 1, '3542354', 'met', '<p>adsfasdf</p>', NULL, '123.00', 2, NULL, '2021-08-09 23:20:18', '09/08/2021', '13/09/2021', 'met', 0),
(28, 1, '4325423453245', 'sasa', '<p>dsafasdf</p>', 123456, '350.00', 3, NULL, '2021-08-10 00:55:15', '10/08/2021', '14/09/2021', 'sasa', 0),
(29, 1, '34234234', 'gege', '<p>SDASD</p>', 1231231, '123.00', 2, NULL, '2021-08-10 01:05:17', '10/08/2021', '14/09/2021', 'gege', 0),
(30, 1, '3423423', 'SDFDSF', '<p>SDFSADF</p>', 1212, '213.00', 123, NULL, '2021-08-10 01:08:44', '10/08/2021', '10/08/2021', 'sdfdsf', 0),
(31, 1, '34534343', 'sadf', '<p>34</p>', 3245324, '2345.00', 324, NULL, '2021-08-10 01:20:33', '10/08/2021', '14/09/2021', 'sadf', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reembolso`
--

DROP TABLE IF EXISTS `reembolso`;
CREATE TABLE IF NOT EXISTS `reembolso` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `pedidoid` bigint(11) NOT NULL,
  `idtransaccion` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `datosreembolso` text COLLATE utf8mb4_bin NOT NULL,
  `observacion` text COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidoid` (`pedidoid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `reembolso`
--

INSERT INTO `reembolso` (`id`, `pedidoid`, `idtransaccion`, `datosreembolso`, `observacion`, `status`) VALUES
(1, 8, '44J28098BT0272706', '{\"id\":\"44J28098BT0272706\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/44J28098BT0272706\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/6TG2331984878750D\",\"rel\":\"up\",\"method\":\"GET\"}]}', 'misio', 'COMPLETED');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `descripcion` text COLLATE utf8mb4_bin NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idrol`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(3, 'Observador', 'Observar movimientos', 1),
(2, 'Supervisor', 'Supervisar alquiler', 1),
(1, 'Administrador', 'Administrar', 1),
(7, 'Cliente', '', 1),
(4, 'Servicio al Cliente', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `idservicio` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nombre`) VALUES
(1, 'Luz'),
(2, 'Agua'),
(3, 'Caja'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

DROP TABLE IF EXISTS `suscripciones`;
CREATE TABLE IF NOT EXISTS `suscripciones` (
  `idsuscripcion` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idsuscripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `suscripciones`
--

INSERT INTO `suscripciones` (`idsuscripcion`, `nombre`, `email`, `datecreated`, `status`) VALUES
(7, 'Jean', 'sape@dasda.com', '2021-06-24 22:36:55', 0),
(8, '2', '2@sada.com', '2021-06-24 22:38:47', 0),
(9, '3', '3@s3.com', '2021-06-24 22:39:23', 1),
(10, 'Asd', 'asd@sad.com', '2021-06-24 22:41:48', 1),
(11, 'Sapee', 'sape@sad.com', '2021-06-24 22:44:25', 1),
(12, 'Jeansp', 'jeango@asd.com', '2021-06-24 22:47:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

DROP TABLE IF EXISTS `tipopago`;
CREATE TABLE IF NOT EXISTS `tipopago` (
  `idtipopago` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipopago` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`idtipopago`, `tipopago`, `status`) VALUES
(2, 'Efectivo', 1),
(5, 'Despósito Bancario', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_3` FOREIGN KEY (`tipopagoid`) REFERENCES `tipopago` (`idtipopago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reembolso`
--
ALTER TABLE `reembolso`
  ADD CONSTRAINT `reembolso_pedido_fkey` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
