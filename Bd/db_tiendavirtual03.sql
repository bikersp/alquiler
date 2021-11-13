-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2021 at 11:03 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(1, 'Chaquetas', 'Lo mejor en moda', 'img_1706b9300f46dc7a373cdc6ae8928895.jpg', '2020-10-23 03:14:08', 'chaquetas', 1),
(2, 'Blusas', 'Las chicas perfectas', 'img_4e01ad64d99f3fba516bc77d198ce17f.jpg', '2020-10-23 03:17:26', 'blusas', 1),
(3, 'Jeans', 'Lo mejor en Jeans', 'img_6cfc2c38c15593e36a5e41795ea1de32.jpg', '2020-10-23 03:17:42', 'jeans', 1),
(4, 'Caballero', 'Productos para caballeros', 'img_a939c8d8ca5784159a43d0d82b80582d.jpg', '2020-10-28 03:45:12', 'caballero', 1),
(5, 'Damas', 'Productos para damas', 'img_5dafcd6ec18901c147c7cfde850a1ab1.jpg', '2020-10-30 03:05:09', 'damas', 1),
(6, 'Accesorios', 'Accesorios varios', 'img_84f83e4988f31e6fd25e9d2df04d3f7f.jpg', '2020-11-14 00:21:15', 'accesorios', 1),
(7, 'Categoria ejemplo', 'Descripción categoría ejemplo', 'portada_categoria.png', '2020-12-05 22:38:27', 'categoria-ejemplo', 0),
(8, 'Caterogía 20', 'Descripción', 'portada_categoria.png', '2020-12-05 23:00:16', 'caterogia-20', 0),
(12, 'nueva ruta x', 'sp', 'portada.png', '2021-01-07 21:37:00', 'nueva-ruta-x', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacto`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `contacto`
--

INSERT INTO `contacto` (`idcontacto`, `nombre`, `email`, `mensaje`, `ip`, `dispositivo`, `useragent`, `date`) VALUES
(1, 'Jean', 'jean@asda.com', 'sapeee', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:23:27'),
(2, 'Sape', 'sape@asda.com', 'sape', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:28:37'),
(3, 'Test', 'test@sasas.com', 'test', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:29:47'),
(4, 'Jeango', 'jeango@gmail.com', 'jeango sape', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '2021-07-13 19:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_pedido`
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
-- Dumping data for table `detalle_pedido`
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
-- Table structure for table `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
CREATE TABLE IF NOT EXISTS `detalle_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `personaid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `transaccionid` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`),
  KEY `personaid` (`personaid`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `detalle_temp`
--

INSERT INTO `detalle_temp` (`id`, `personaid`, `productoid`, `precio`, `cantidad`, `transaccionid`) VALUES
(20, 1, 11, '100.00', 1, 'ot86fuikjrgtj4td0rfpuolt1m'),
(21, 26, 11, '100.00', 1, 'suee83cac98eh8remmm3tu25ov'),
(22, 27, 11, '100.00', 1, '1mg7a68ishk6hvrormlm8131h6'),
(23, 1, 11, '100.00', 1, 'r6paecd7eb32v4d9lu83mftpjo'),
(34, 1, 11, '100.00', 1, '0ek32qn2c62aem0tevh95eiqj1');

-- --------------------------------------------------------

--
-- Table structure for table `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`) VALUES
(3, 3, 'pro_e702903506bd14ecc0e5645cc8a308d2.jpg'),
(4, 3, 'pro_c3abd10d62fa7b01e8dfd61e18118913.jpg'),
(5, 4, 'pro_3e64800e9336055a0a58b69fdad32048.jpg'),
(6, 5, 'pro_bd7592482a91f4531d8a10ab3d815945.jpg'),
(7, 5, 'pro_d8444581afca144189dcfa8303dd58ee.jpg'),
(8, 7, 'pro_1abf3c3c00b89188b25e324dc39d6f62.jpg'),
(10, 8, 'pro_e0c8f0211ec0cf449278010dcbd64da6.jpg'),
(11, 8, 'pro_b4c0c0e77f29cbc207bd1f8bbeb30e02.jpg'),
(12, 7, 'pro_50458020b4d9ac78098be1649bcad5a8.jpg'),
(13, 9, 'pro_14b6a7a08d0aa5a2b779db08bc35c439.jpg'),
(19, 2, 'pro_25bff00db4ed6a2e028cb28195cfa649.jpg'),
(20, 2, 'pro_75f4d282b2735d59287c551e6c2a094e.jpg'),
(21, 6, 'pro_bba122841772a79d9089efe260b0d585.jpg'),
(22, 6, 'pro_bf14fed939b2da088255727ede14a1f8.jpg'),
(23, 1, 'pro_cb6569dd7907b0eebf83b356fb5b8c9f.jpg'),
(24, 10, 'pro_6c0537968a89765773d91230daef622a.jpg'),
(25, 10, 'pro_e3345c10650826ea67447733e65e63a8.jpg'),
(27, 11, 'pro_2742b9f94da4267903f22e05a1ed08d4.jpg'),
(28, 11, 'pro_b9b6a5888dd066a017b0e20ca68eee5d.jpg'),
(29, 11, 'pro_ecad1c55690162bc9e1ed58c767f3987.jpg'),
(30, 12, 'pro_d1d4ad5e1603d3c15a440e5dd4c5cb0c.jpg'),
(31, 12, 'pro_c6f6b5eea4c76ed9bc3a58472c6468b7.jpg'),
(32, 12, 'pro_c5b9a923e22639730766f5b9a88773fd.jpg'),
(33, 12, 'pro_616b30feafb00faca08cb1019150610f.jpg'),
(35, 17, 'pro_714bfc726b24190f7baa8907e330b931.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `descripcion` text COLLATE utf8mb4_bin NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmodulo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del Sistema', 1),
(3, 'Clientes', 'Clientes de Tienda', 1),
(4, 'Productos', 'Todos los Productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Categorias', 'Categorias PRoductos', 1),
(7, 'Suscriptores', 'Suscriptores de sitio Web', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
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
  `direccion_envio` text COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `tipopagoid` (`tipopagoid`),
  KEY `pesonaid` (`personaid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pedido`
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
-- Table structure for table `permisos`
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
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(318, 2, 1, 1, 0, 0, 0),
(319, 2, 2, 1, 0, 0, 0),
(320, 2, 3, 0, 0, 0, 0),
(321, 2, 4, 0, 0, 0, 0),
(322, 2, 5, 0, 0, 0, 0),
(323, 2, 6, 0, 0, 0, 0),
(324, 7, 1, 1, 0, 0, 0),
(325, 7, 2, 0, 0, 0, 0),
(326, 7, 3, 0, 0, 0, 0),
(327, 7, 4, 0, 0, 0, 0),
(328, 7, 5, 1, 0, 0, 0),
(329, 7, 6, 0, 0, 0, 0),
(330, 1, 1, 1, 1, 1, 1),
(331, 1, 2, 1, 1, 1, 1),
(332, 1, 3, 1, 1, 1, 1),
(333, 1, 4, 1, 1, 1, 1),
(334, 1, 5, 1, 1, 1, 1),
(335, 1, 6, 1, 1, 1, 1),
(336, 1, 7, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `idpersona` bigint(20) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(30) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '72816072', 'Jean', 'Cuadros', 940130484, 'bikersprop@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, 'eb4758bcd5e87f375ddb-fcb20952597ee7d11483-08497b6e611d187cea8c-eb73c43181f8d17a5d3c', 1, '2021-01-01 21:26:05', 1),
(2, '111', 'Ragnarsape', 'Lotrocksape', 444444, 'ragnar@gmail.com', '61bffc1741e91c220d77a22064d8d9ae8d5510a5c228e44797bdaf215c72b269', '123125', 'Nombre Fiscal', 'Dirección Fisca', NULL, 1, '2021-01-02 00:55:48', 1),
(8, '123', 'Wes', 'Qwe', 123, 'qwe', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 1, '2021-01-01 21:28:12', 0),
(10, '234', 'Sadf', 'Asdf', 324, 'sdf', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 1, '2021-01-02 00:58:00', 0),
(11, '1234', '123', '123', 123, '1234', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 1, '2021-01-02 00:59:49', 0),
(12, '12345', '123', '123', 123, '12345', '1aa9e2005240e026cc44250623ecb6b52485c70f97fee8e3f8aa9a9eaf0ae089', NULL, NULL, NULL, NULL, 1, '2021-01-02 02:52:32', 0),
(13, '728160721', 'Jeango', 'Sape', 940130484, 'sape@gmail.comm', '54642a52e7a7e93125dd241229061a16b7320c7f5be6af9d3784a2e35ee79631', NULL, NULL, NULL, NULL, 2, '2021-01-02 02:53:30', 1),
(14, '1243432', 'Viork', 'Ragnarson', 9563456454, 'viork@gmail.sp', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 3, '2021-01-02 16:35:17', 1),
(15, '1111111111', 'Aaaaaaaa', 'Aaaaaaaa', 11111111111, 'aaaaaaaa@sad.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa', NULL, 7, '2021-01-03 22:57:41', 0),
(16, '356456', 'Sdf', 'Dasf', 34234234, 'asdf@df.com', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', '234', 'sdfsadf', 'dsafsad', NULL, 7, '2021-01-03 23:10:16', 1),
(17, '1313131313', 'Aaaaaaaa', 'Aaaaaaaa', 13131313, 'aaaaaaaa', '1be50992b1a00d9ea17acaafcf11615e4f37cbc50160e70be4992854b57264e8', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa', NULL, 7, '2021-01-03 23:13:55', 1),
(18, '12312312', 'Jean', 'Cuadrosw', 435345, 'bikersprop@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '34234', 'asdasdasd', 'ssafsdafsadfsdf', NULL, 7, '2021-01-04 00:10:03', 1),
(19, 'sdaf', 'Jeango', 'Sape', 234234, 'asdfasdf@asd.com', 'abb70ed16674dc5810880a62be09900986ab1f0ce8a93e493ca521c76cd1d518', '2342', 'sfdasdf', 'sadfsadf', NULL, 7, '2021-01-04 00:11:24', 1),
(20, 'sadf', 'Dsaf', 'Sdaf', 234, 'dfgs@dsfs.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'adsf', 'asdf', 'asf', NULL, 7, '2021-01-04 00:13:17', 1),
(21, 'asdf', 'Sape', 'Asdf', 24234, 'sadf@asdas.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 2, '2021-01-04 19:32:09', 0),
(22, NULL, 'Jaengo', 'Sape', 546464645, 'asdas@dasd.com', 'c14e976dc90ed2ca5c00a57329b700d2a21f374204434f3d14e27655d21c1cdb', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:48:19', 1),
(23, NULL, 'Jaengo', 'Sape', 546464645, 'assdas@dasd.com', 'dd2842d0715ea85a446d6fe2c5219fb52fb4850c91bdc1a58739c7585d970223', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:50:37', 1),
(24, NULL, 'Sdafsd', 'Sadfsad', 323423, 'dghfg@asc.com', '01c0d023aafe7bc3352aea93fca52b5f0e515d5c096805f4d2e317c05616f419', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:52:01', 1),
(25, NULL, 'Sdfsdf', 'Adgadg', 23423, 'asdfsd@dsds.com', '77a803e8bda342455b0966ad261f79b69fadbc0f9da2b6298ca7999d7c2f4989', NULL, NULL, NULL, NULL, 7, '2021-01-08 14:54:08', 1),
(26, NULL, 'Seledonio', 'Nupanupa', 12312312312, 'seledonio@gmail.com', '65e6ae86ae974d3d464ddbb11094f532d7baab260e6bbcd56ed54010bca22d09', NULL, NULL, NULL, NULL, 7, '2021-01-08 16:59:13', 1),
(27, NULL, 'Asd', 'Asd', 13112312, 'sdasd@asdasas.com', 'bed10a853c6a4d5620fe1b701747c6f0ea5fec9a9a7acf3eab14619bf0a5d487', NULL, NULL, NULL, NULL, 7, '2021-01-08 17:07:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoriaid` bigint(20) NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`),
  KEY `categoriaid` (`categoriaid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idproducto`, `categoriaid`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `datecreated`, `ruta`, `status`) VALUES
(1, 4, '45684545', 'Producto 1', '<p>Descripci&oacute;n producto 1</p>', '200.00', 10, '', '2020-11-15 00:57:57', '', 1),
(2, 3, '465456465', 'Producto 1', '<p>Descripci&oacute;n producto</p> <ul> <li>Uno</li> <li>Dos</li> </ul>', '110.00', 10, '', '2020-11-15 03:13:35', '', 1),
(3, 1, '4654654', 'Producto Uno', '<p>Descripci&oacute;n producto uno</p> <table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"> <tbody> <tr> <td style=\"width: 48.0244%;\">N&uacute;mero</td> <td style=\"width: 48.022%;\">Descripc&iacute;&oacute;n</td> </tr> <tr> <td style=\"width: 48.0244%;\">Uno</td> <td style=\"width: 48.022%;\">Peque&ntilde;o</td> </tr> <tr> <td style=\"width: 48.0244%;\">Dos</td> <td style=\"width: 48.022%;\">Mediano</td> </tr> <tr> <td style=\"width: 48.0244%;\">Tres</td> <td style=\"width: 48.022%;\">Grande</td> </tr> </tbody> </table>', '200.00', 50, '', '2020-11-15 03:19:15', '', 1),
(4, 2, '45654654', 'Producto 4', '<p>Descripci&oacute; producto</p>', '50.00', 0, '', '2020-11-23 02:59:44', '', 1),
(5, 5, '6546546545', 'Producto 5', '<p>Aqu&iacute; va la descripci&oacute;n del producto</p> <ul> <li>Grande</li> <li>Peque&ntilde;o</li> <li>Mediano</li> </ul>', '1000.00', 10, '', '2020-11-23 03:22:35', '', 1),
(6, 4, '646546547877', 'Producto 6', '<p>Descripci&oacute;n producto seis</p> <ul> <li>Uno</li> <li>Dos</li> <li>Tres</li> </ul> <p>&nbsp;</p>', '50.00', 10, '', '2020-11-23 03:38:55', '', 1),
(7, 5, '65465454', 'Producto 7', '<p>Datos del producto</p>', '100.00', 10, '', '2020-11-23 03:39:59', '', 1),
(8, 5, '6546545', 'Producto 8', '<p>Descripc&iacute;on</p>', '50.00', 10, '', '2020-11-23 03:43:29', '', 1),
(9, 2, '546455456', 'Producto 9', '<p>Datos del producto</p>', '120.00', 50, '', '2020-12-01 12:52:33', 'producto-9', 1),
(10, 1, '654546544', 'Producto 10', '<p>Descripc&oacute;n</p>', '100.00', 0, '', '2020-12-02 03:52:09', 'producto-10', 1),
(11, 1, '4657897897', 'Producto Prueba', '<p>Descripcipci&oacute;n producto prueba</p> <ul> <li>Uno</li> <li>Dos</li> <li>Tres</li> </ul> <p>&nbsp;</p>', '100.00', 50, '', '2020-12-06 02:30:02', 'producto-prueba', 1),
(12, 1, '4894647878', 'Producto Ejemplo', '<p>Descripci&oacute;n producto ejemplo</p> <ul> <li>Uno</li> <li>Dos</li> <li>Tres</li> </ul>', '110.00', 10, '', '2020-12-11 02:23:22', 'producto-ejemplo', 1),
(17, 4, '234234', 'producto nuevo Ruta x', '<p><strong>asdasdasdasd</strong></p> <ul> <li style=\"text-align: justify;\">saasd</li> <li style=\"text-align: justify;\">as</li> <li style=\"text-align: justify;\">asd</li> </ul>', '123.50', 234234, NULL, '2021-01-07 21:29:02', 'producto-nuevo-ruta-x', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reembolso`
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
-- Dumping data for table `reembolso`
--

INSERT INTO `reembolso` (`id`, `pedidoid`, `idtransaccion`, `datosreembolso`, `observacion`, `status`) VALUES
(1, 8, '44J28098BT0272706', '{\"id\":\"44J28098BT0272706\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/44J28098BT0272706\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/6TG2331984878750D\",\"rel\":\"up\",\"method\":\"GET\"}]}', 'misio', 'COMPLETED');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
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
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(36, 'asdfasdf', 'asdf', 0),
(3, 'Vendedores', 'sp', 1),
(33, 'sdaf', 'asdf', 0),
(34, 'sadfsss', 'asdf', 0),
(35, 'qwerwqer', 'qwer', 0),
(2, 'Supervisores', 'sapee', 1),
(1, 'Administrador', 'Controla todo', 1),
(40, 'fda', 'af', 0),
(39, 'asdas', 'asd', 0),
(7, 'Cliente', 'Compras', 1),
(37, '123', 'asdf', 0),
(32, 'sp', 'sape', 0),
(4, 'Servicio al Cliente', 'spp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suscripciones`
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
-- Dumping data for table `suscripciones`
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
-- Table structure for table `tipopago`
--

DROP TABLE IF EXISTS `tipopago`;
CREATE TABLE IF NOT EXISTS `tipopago` (
  `idtipopago` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipopago` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tipopago`
--

INSERT INTO `tipopago` (`idtipopago`, `tipopago`, `status`) VALUES
(1, 'PayPal', 1),
(2, 'Efectivo', 1),
(3, 'Tarjeta', 1),
(4, 'Cheque', 1),
(5, 'Despósito Bancario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `edad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `edad`) VALUES
(1, 'Robert', 20),
(3, 'Alex', 19);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reembolso`
--
ALTER TABLE `reembolso`
  ADD CONSTRAINT `reembolso_pedido_fkey` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
