-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2022 a las 00:25:55
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--
CREATE DATABASE IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `propietario_id`, `config_id`, `nombre`, `telefono`, `direccion`, `ruc`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, 1, 1, 'La unica', '963124785', 'calle Girón unión 215', '17563245128', '2022-02-04 18:08:22', '2022-02-04 18:11:54', 1, 0x05f3f70ae1a04c738a88d01bff018c72);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `propietario_id`, `config_id`, `nombre`, `detalle`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, 1, 1, 'Condiments', NULL, '2022-02-04 03:27:46', '2022-02-04 03:27:46', 1, 0x79c403e49c7f4883bedc1ddfca7c990b),
(2, 1, 1, 'lapteos', NULL, '2022-02-04 03:33:29', '2022-02-04 03:33:29', 1, 0x9d584675ba5341dea1a8d499ee88c2ce);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `alias` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_corto` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `propietario_id`, `config_id`, `alias`, `nombre`, `nombre_corto`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, NULL, NULL, 'Pidia', 'Pidia', 'Pidia', '2022-02-03 20:52:04', '2022-02-04 18:00:40', 1, 0x04b072271e834ffd9f6d804da9b9b8f0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_config_menu_menus`
--

CREATE TABLE `config_config_menu_menus` (
  `config_id` int(11) NOT NULL,
  `config_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `config_config_menu_menus`
--

INSERT INTO `config_config_menu_menus` (`config_id`, `config_menu_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_menu`
--

CREATE TABLE `config_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `config_menu`
--

INSERT INTO `config_menu` (`id`, `name`, `route`, `activo`) VALUES
(1, 'Listado Menu', 'menu_index', 1),
(2, 'Listado Productos', 'producto_index', 1),
(3, 'Listado Categoria', 'categoria_index', 1),
(4, 'Listado Proveedores', 'proveedor_index', 1),
(6, 'Listar Orden Compra', 'ordenCompra_index', 1),
(7, 'Listado Trabajadores', 'trabajador_index', 1),
(8, 'Listado almacen', 'almacen_index', 1),
(9, 'Listado Orden Pedido', 'ordenPedido_index', 1),
(10, 'Listado CLientes', 'cliente_index', 1),
(11, 'Listado Despachos', 'despacho_index', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

CREATE TABLE `despacho` (
  `id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `fecha_salida` datetime NOT NULL,
  `items_desapachados` decimal(10,2) DEFAULT NULL,
  `cantidad_despacho` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `despacho`
--

INSERT INTO `despacho` (`id`, `almacen_id`, `trabajador_id`, `propietario_id`, `config_id`, `fecha_salida`, `items_desapachados`, `cantidad_despacho`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, 1, 1, 1, 1, '2022-02-02 14:11:00', NULL, '4.00', '2022-02-04 17:11:43', '2022-02-04 18:13:42', 1, 0x60d5edad3668401fb59c40751c026a38),
(2, NULL, 1, 1, 1, '2022-02-22 14:32:00', '12.00', '3.00', '2022-02-04 17:32:30', '2022-02-04 17:32:30', 1, 0xc631d46db6d146049baadca7e04577a9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_producto`
--

CREATE TABLE `despacho_producto` (
  `despacho_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `despacho_producto`
--

INSERT INTO `despacho_producto` (`despacho_id`, `producto_id`) VALUES
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_compra`
--

CREATE TABLE `detalle_orden_compra` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `orden_compra_id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `precio_proveedor` decimal(10,2) DEFAULT NULL,
  `cant_recibida` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_orden_compra`
--

INSERT INTO `detalle_orden_compra` (`id`, `producto_id`, `orden_compra_id`, `propietario_id`, `config_id`, `precio_proveedor`, `cant_recibida`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, 3, 1, NULL, NULL, '14.00', '2.00', '2022-02-04 04:11:33', '2022-02-04 23:11:35', 1, 0x4d4373ff0f39452aa3b2dc434d1e3a23),
(2, 3, 2, NULL, NULL, '32.00', '54.00', '2022-02-04 23:30:34', '2022-02-05 00:07:18', 1, 0xa0a70d8fe7664841a433f2b661541e6a),
(3, 3, 2, NULL, NULL, '12.00', '65.00', '2022-02-04 23:39:29', '2022-02-05 00:07:18', 1, 0xadf9ead1ae5a4714986cd22ce437baf9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220203194453', '2022-02-03 20:45:05', 850),
('DoctrineMigrations\\Version20220203195856', '2022-02-03 20:59:05', 196),
('DoctrineMigrations\\Version20220203203119', '2022-02-03 21:31:25', 114),
('DoctrineMigrations\\Version20220203205712', '2022-02-03 21:57:24', 114),
('DoctrineMigrations\\Version20220203222548', '2022-02-03 23:25:53', 153),
('DoctrineMigrations\\Version20220204012228', '2022-02-04 02:22:37', 501),
('DoctrineMigrations\\Version20220204030520', '2022-02-04 04:05:26', 33),
('DoctrineMigrations\\Version20220204032622', '2022-02-04 04:26:27', 60),
('DoctrineMigrations\\Version20220204044852', '2022-02-04 05:49:09', 359),
('DoctrineMigrations\\Version20220204051443', '2022-02-04 06:14:53', 63),
('DoctrineMigrations\\Version20220204053059', '2022-02-04 06:31:06', 106),
('DoctrineMigrations\\Version20220204054106', '2022-02-04 06:41:16', 184),
('DoctrineMigrations\\Version20220204054722', '2022-02-04 06:47:44', 436),
('DoctrineMigrations\\Version20220204160731', '2022-02-04 17:07:50', 757),
('DoctrineMigrations\\Version20220204162623', '2022-02-04 17:26:32', 168),
('DoctrineMigrations\\Version20220204163744', '2022-02-04 17:37:54', 135),
('DoctrineMigrations\\Version20220204172542', '2022-02-04 18:25:52', 107);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orden` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `padre_id`, `propietario_id`, `config_id`, `nombre`, `ruta`, `icono`, `orden`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, NULL, 1, 1, 'Seguridad', NULL, 'fas fa-user-secret', 6, '2022-02-03 20:53:47', '2022-02-04 18:06:44', 1, 0x85b419360cb8492fa468b4400c036bd1),
(2, 1, 1, 1, 'Menu', 'menu_index', NULL, 0, '2022-02-03 20:54:23', '2022-02-03 20:54:23', 1, 0x725681c6c5de49389d953b533effea40),
(3, NULL, 1, 1, 'Producto', NULL, 'fas fa-shopping-basket', 0, '2022-02-03 23:36:23', '2022-02-04 03:51:05', 1, 0xa04a5f029b7f46e8ad6198ec6a33b812),
(4, 3, 1, 1, 'Productos', 'producto_index', NULL, 0, '2022-02-03 23:40:33', '2022-02-03 23:40:33', 1, 0x1c88ae4c991345578032655ffb9d2fc3),
(5, 3, 1, 1, 'Categorias', 'categoria_index', NULL, 0, '2022-02-03 23:41:03', '2022-02-03 23:41:59', 1, 0xa8fd2a14a70b44499f8426bd9d32dc69),
(6, NULL, 1, 1, 'Ordenes', NULL, 'fas fa-shopping-cart', 0, '2022-02-04 03:46:28', '2022-02-04 15:28:35', 1, 0x19ad6e0d5b3248a6b2c59302c95ad03f),
(7, 6, 1, 1, 'Orden Compras', 'ordenCompra_index', NULL, 0, '2022-02-04 03:57:00', '2022-02-04 15:29:06', 1, 0xc13c342739144ee0afcdac6fc3b5d476),
(8, NULL, 1, 1, 'Aportadores', NULL, 'fas fa-users', 0, '2022-02-04 04:33:43', '2022-02-04 04:33:43', 1, 0x6f549dc5b6a249b6b7e8316ebbfac0eb),
(9, 8, 1, 1, 'Trabajadores', 'trabajador_index', NULL, 0, '2022-02-04 04:34:09', '2022-02-04 04:34:09', 1, 0xa4ea3c89d7c04444acfbbceec7f28136),
(10, 8, 1, 1, 'Proveedores', 'proveedor_index', NULL, 0, '2022-02-04 04:34:35', '2022-02-04 04:34:35', 1, 0x593c53657de34d8fbc1188cb17ccd116),
(11, NULL, 1, 1, 'Mas', NULL, 'fas fa-ellipsis-v', 5, '2022-02-04 04:38:15', '2022-02-04 04:42:08', 1, 0x9308a3f98add40f9ad3b40378f95bfdb),
(12, 11, 1, 1, 'Almacen', 'almacen_index', NULL, 0, '2022-02-04 04:42:32', '2022-02-04 04:42:32', 1, 0x33061868845946b4a78b8d4de6d37dea),
(13, 6, 1, 1, 'Orden Pedidos', 'ordenPedido_index', NULL, 0, '2022-02-04 15:31:06', '2022-02-04 15:31:06', 1, 0xf8980d13c71a49c789043744253d89d6),
(14, 8, 1, 1, 'Clientes', 'cliente_index', NULL, 0, '2022-02-04 18:01:09', '2022-02-04 18:01:09', 1, 0xec1a333f4d3b4831b732fc0e83f4e5b1),
(15, NULL, 1, 1, 'Despachos', NULL, 'fas fa-sign-out-alt', 3, '2022-02-04 18:03:46', '2022-02-04 18:05:22', 1, 0x19e0ec92dfb840a7b3c8576ab377a7b3),
(16, 15, 1, 1, 'Destribucion', 'despacho_index', NULL, 0, '2022-02-04 18:06:14', '2022-02-04 18:06:14', 1, 0xc889d1c1dfba43fca4e219d13c953954);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id` int(11) NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `precio_orden` decimal(10,2) DEFAULT NULL,
  `cantidad_orden` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `num_factura` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id`, `trabajador_id`, `proveedor_id`, `propietario_id`, `config_id`, `fecha`, `precio_orden`, `cantidad_orden`, `created_at`, `updated_at`, `activo`, `uuid`, `num_factura`) VALUES
(1, 1, 1, 1, 1, '2022-02-17 00:00:00', NULL, '0.00', '2022-02-04 04:11:33', '2022-02-04 23:11:35', 1, 0x2d4dd6ce651a42efae4accd35c7155d5, '46562'),
(2, 1, 1, 1, 1, '2022-02-24 02:31:40', '13.00', '15.00', '2022-02-04 23:29:57', '2022-02-05 00:07:18', 1, 0x81773b4d096c4df38f2efba6afcfbd8b, '84132174');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido`
--

CREATE TABLE `orden_pedido` (
  `id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `fecha_pedido` datetime NOT NULL,
  `cantidad_pedido` decimal(10,2) DEFAULT NULL,
  `cantidad_items` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden_pedido`
--

INSERT INTO `orden_pedido` (`id`, `almacen_id`, `trabajador_id`, `propietario_id`, `config_id`, `fecha_pedido`, `cantidad_pedido`, `cantidad_items`, `created_at`, `updated_at`, `activo`, `uuid`, `cliente_id`) VALUES
(2, 1, 1, 1, 1, '2022-02-18 11:47:00', '15.00', '3.00', '2022-02-04 17:47:46', '2022-02-04 17:47:46', 1, 0x3ed1d85614134b4eb2459a8ca573f9ed, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido_producto`
--

CREATE TABLE `orden_pedido_producto` (
  `orden_pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden_pedido_producto`
--

INSERT INTO `orden_pedido_producto` (`orden_pedido_id`, `producto_id`) VALUES
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

CREATE TABLE `parametro` (
  `id` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria_id`, `propietario_id`, `config_id`, `precio_unitario`, `descripcion`, `precio_venta`, `created_at`, `updated_at`, `activo`, `uuid`, `nombre`) VALUES
(3, 2, 1, 1, '12.00', '---', '20.00', '2022-02-04 04:09:20', '2022-02-04 04:09:20', 1, 0x34becc8da68946529aaa476a40bd8ea6, 'Tarros de Leche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `propietario_id`, `config_id`, `nombre`, `apellidos`, `telefono`, `direccion`, `dni`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, 1, 1, 'Andres', 'Marinces Torrez', '963214578', 'nose', '75412638', '2022-02-04 04:06:28', '2022-02-04 04:06:28', 1, 0xdf787c9b6c544798a828839bc244889e);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id`, `propietario_id`, `config_id`, `nombre`, `apellidos`, `telefono`, `direccion`, `dni`, `cargo`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, 1, 1, 'Huber', 'Estrada Menlendrez', '963258147', 'calle san ramon 364', '78546321', 'supervisor', '2022-02-03 21:36:40', '2022-02-03 21:36:40', 1, 0x25f54e9be43a4b19a55a2b6a57606534);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `propietario_id`, `config_id`, `username`, `email`, `password`, `full_name`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, NULL, 1, 'admin', 'walmerhen@gmail.com', '$2y$13$R9b7qvbqBIX8eho75UEFMuRk/krv2zXJihNCspwEPmVr0RGebvd1y', 'Walmer Herrera', '2022-02-03 20:45:35', '2022-02-03 20:52:52', 1, 0x71c1177580df463c81774e18cc9a35f2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `listar` tinyint(1) DEFAULT NULL,
  `mostrar` tinyint(1) DEFAULT NULL,
  `crear` tinyint(1) DEFAULT NULL,
  `editar` tinyint(1) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `imprimir` tinyint(1) DEFAULT NULL,
  `exportar` tinyint(1) DEFAULT NULL,
  `importar` tinyint(1) DEFAULT NULL,
  `maestro` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso_usuario_rol`
--

CREATE TABLE `usuario_permiso_usuario_rol` (
  `usuario_permiso_id` int(11) NOT NULL,
  `usuario_rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `config_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id`, `propietario_id`, `config_id`, `nombre`, `rol`, `created_at`, `updated_at`, `activo`, `uuid`) VALUES
(1, NULL, NULL, 'Super Administrador', 'ROLE_SUPER_ADMIN', '2022-02-03 20:45:35', '2022-02-03 20:45:35', 1, 0x8a7f212c7cd044c7a5ea0a7f8f05d684);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_usuario_rol`
--

CREATE TABLE `usuario_usuario_rol` (
  `usuario_id` int(11) NOT NULL,
  `usuario_rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_usuario_rol`
--

INSERT INTO `usuario_usuario_rol` (`usuario_id`, `usuario_rol_id`) VALUES
(1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D5B2D250D17F50A6` (`uuid`),
  ADD KEY `IDX_D5B2D25053C8D32C` (`propietario_id`),
  ADD KEY `IDX_D5B2D25024DB0683` (`config_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4E10122DD17F50A6` (`uuid`),
  ADD KEY `IDX_4E10122D53C8D32C` (`propietario_id`),
  ADD KEY `IDX_4E10122D24DB0683` (`config_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F41C9B25D17F50A6` (`uuid`),
  ADD KEY `IDX_F41C9B2553C8D32C` (`propietario_id`),
  ADD KEY `IDX_F41C9B2524DB0683` (`config_id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D48A2F7CD17F50A6` (`uuid`),
  ADD KEY `IDX_D48A2F7C53C8D32C` (`propietario_id`),
  ADD KEY `IDX_D48A2F7C24DB0683` (`config_id`);

--
-- Indices de la tabla `config_config_menu_menus`
--
ALTER TABLE `config_config_menu_menus`
  ADD PRIMARY KEY (`config_id`,`config_menu_id`),
  ADD KEY `IDX_A8E9CD3124DB0683` (`config_id`),
  ADD KEY `IDX_A8E9CD31B9CB2BE2` (`config_menu_id`);

--
-- Indices de la tabla `config_menu`
--
ALTER TABLE `config_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_254BF5B3D17F50A6` (`uuid`),
  ADD KEY `IDX_254BF5B39C9C9E68` (`almacen_id`),
  ADD KEY `IDX_254BF5B3EC3656E` (`trabajador_id`),
  ADD KEY `IDX_254BF5B353C8D32C` (`propietario_id`),
  ADD KEY `IDX_254BF5B324DB0683` (`config_id`);

--
-- Indices de la tabla `despacho_producto`
--
ALTER TABLE `despacho_producto`
  ADD PRIMARY KEY (`despacho_id`,`producto_id`),
  ADD KEY `IDX_5E741005299C08BC` (`despacho_id`),
  ADD KEY `IDX_5E7410057645698E` (`producto_id`);

--
-- Indices de la tabla `detalle_orden_compra`
--
ALTER TABLE `detalle_orden_compra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BF1A3A25D17F50A6` (`uuid`),
  ADD KEY `IDX_BF1A3A257645698E` (`producto_id`),
  ADD KEY `IDX_BF1A3A25EA8C2923` (`orden_compra_id`),
  ADD KEY `IDX_BF1A3A2553C8D32C` (`propietario_id`),
  ADD KEY `IDX_BF1A3A2524DB0683` (`config_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7D053A93D17F50A6` (`uuid`),
  ADD KEY `IDX_7D053A93613CEC58` (`padre_id`),
  ADD KEY `IDX_7D053A9353C8D32C` (`propietario_id`),
  ADD KEY `IDX_7D053A9324DB0683` (`config_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_765A054ED17F50A6` (`uuid`),
  ADD KEY `IDX_765A054EEC3656E` (`trabajador_id`),
  ADD KEY `IDX_765A054ECB305D73` (`proveedor_id`),
  ADD KEY `IDX_765A054E53C8D32C` (`propietario_id`),
  ADD KEY `IDX_765A054E24DB0683` (`config_id`);

--
-- Indices de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2C77227FD17F50A6` (`uuid`),
  ADD KEY `IDX_2C77227F9C9C9E68` (`almacen_id`),
  ADD KEY `IDX_2C77227FEC3656E` (`trabajador_id`),
  ADD KEY `IDX_2C77227F53C8D32C` (`propietario_id`),
  ADD KEY `IDX_2C77227F24DB0683` (`config_id`),
  ADD KEY `IDX_2C77227FDE734E51` (`cliente_id`);

--
-- Indices de la tabla `orden_pedido_producto`
--
ALTER TABLE `orden_pedido_producto`
  ADD PRIMARY KEY (`orden_pedido_id`,`producto_id`),
  ADD KEY `IDX_449301B2503F48CE` (`orden_pedido_id`),
  ADD KEY `IDX_449301B27645698E` (`producto_id`);

--
-- Indices de la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4C12795FD17F50A6` (`uuid`),
  ADD KEY `IDX_4C12795F613CEC58` (`padre_id`),
  ADD KEY `IDX_4C12795F53C8D32C` (`propietario_id`),
  ADD KEY `IDX_4C12795F24DB0683` (`config_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A7BB0615D17F50A6` (`uuid`),
  ADD KEY `IDX_A7BB06153397707A` (`categoria_id`),
  ADD KEY `IDX_A7BB061553C8D32C` (`propietario_id`),
  ADD KEY `IDX_A7BB061524DB0683` (`config_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_16C068CED17F50A6` (`uuid`),
  ADD KEY `IDX_16C068CE53C8D32C` (`propietario_id`),
  ADD KEY `IDX_16C068CE24DB0683` (`config_id`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_42157CDFD17F50A6` (`uuid`),
  ADD KEY `IDX_42157CDF53C8D32C` (`propietario_id`),
  ADD KEY `IDX_42157CDF24DB0683` (`config_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_2265B05DD17F50A6` (`uuid`),
  ADD KEY `IDX_2265B05D53C8D32C` (`propietario_id`),
  ADD KEY `IDX_2265B05D24DB0683` (`config_id`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_845C01D9CCD7E912` (`menu_id`);

--
-- Indices de la tabla `usuario_permiso_usuario_rol`
--
ALTER TABLE `usuario_permiso_usuario_rol`
  ADD PRIMARY KEY (`usuario_permiso_id`,`usuario_rol_id`),
  ADD KEY `IDX_B45A84629FDFE795` (`usuario_permiso_id`),
  ADD KEY `IDX_B45A8462FEA85A65` (`usuario_rol_id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_72EDD1A4D17F50A6` (`uuid`),
  ADD KEY `IDX_72EDD1A453C8D32C` (`propietario_id`),
  ADD KEY `IDX_72EDD1A424DB0683` (`config_id`);

--
-- Indices de la tabla `usuario_usuario_rol`
--
ALTER TABLE `usuario_usuario_rol`
  ADD PRIMARY KEY (`usuario_id`,`usuario_rol_id`),
  ADD KEY `IDX_4AC6232ADB38439E` (`usuario_id`),
  ADD KEY `IDX_4AC6232AFEA85A65` (`usuario_rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `config_menu`
--
ALTER TABLE `config_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `despacho`
--
ALTER TABLE `despacho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_orden_compra`
--
ALTER TABLE `detalle_orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parametro`
--
ALTER TABLE `parametro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `FK_D5B2D25024DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_D5B2D25053C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `FK_4E10122D24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_4E10122D53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_F41C9B2524DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_F41C9B2553C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `FK_D48A2F7C24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_D48A2F7C53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `config_config_menu_menus`
--
ALTER TABLE `config_config_menu_menus`
  ADD CONSTRAINT `FK_A8E9CD3124DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A8E9CD31B9CB2BE2` FOREIGN KEY (`config_menu_id`) REFERENCES `config_menu` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `FK_254BF5B324DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_254BF5B353C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_254BF5B39C9C9E68` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`),
  ADD CONSTRAINT `FK_254BF5B3EC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`);

--
-- Filtros para la tabla `despacho_producto`
--
ALTER TABLE `despacho_producto`
  ADD CONSTRAINT `FK_5E741005299C08BC` FOREIGN KEY (`despacho_id`) REFERENCES `despacho` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5E7410057645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_orden_compra`
--
ALTER TABLE `detalle_orden_compra`
  ADD CONSTRAINT `FK_BF1A3A2524DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_BF1A3A2553C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_BF1A3A257645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `FK_BF1A3A25EA8C2923` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`id`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_7D053A9324DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_7D053A9353C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_7D053A93613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `menu` (`id`);

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `FK_765A054E24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_765A054E53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_765A054ECB305D73` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `FK_765A054EEC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`);

--
-- Filtros para la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD CONSTRAINT `FK_2C77227F24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_2C77227F53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_2C77227F9C9C9E68` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`),
  ADD CONSTRAINT `FK_2C77227FDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `FK_2C77227FEC3656E` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`);

--
-- Filtros para la tabla `orden_pedido_producto`
--
ALTER TABLE `orden_pedido_producto`
  ADD CONSTRAINT `FK_449301B2503F48CE` FOREIGN KEY (`orden_pedido_id`) REFERENCES `orden_pedido` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_449301B27645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD CONSTRAINT `FK_4C12795F24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_4C12795F53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_4C12795F613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `parametro` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB061524DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_A7BB06153397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_A7BB061553C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `FK_16C068CE24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_16C068CE53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `FK_42157CDF24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_42157CDF53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D24DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_2265B05D53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `FK_845C01D9CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Filtros para la tabla `usuario_permiso_usuario_rol`
--
ALTER TABLE `usuario_permiso_usuario_rol`
  ADD CONSTRAINT `FK_B45A84629FDFE795` FOREIGN KEY (`usuario_permiso_id`) REFERENCES `usuario_permiso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B45A8462FEA85A65` FOREIGN KEY (`usuario_rol_id`) REFERENCES `usuario_rol` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `FK_72EDD1A424DB0683` FOREIGN KEY (`config_id`) REFERENCES `config` (`id`),
  ADD CONSTRAINT `FK_72EDD1A453C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario_usuario_rol`
--
ALTER TABLE `usuario_usuario_rol`
  ADD CONSTRAINT `FK_4AC6232ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4AC6232AFEA85A65` FOREIGN KEY (`usuario_rol_id`) REFERENCES `usuario_rol` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
