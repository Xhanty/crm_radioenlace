-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2023 a las 23:17:23
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `radio_enlace`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`id`, `nombre`, `observaciones`, `created_by`, `fecha`, `status`, `parent_id`) VALUES
(280, 'Almacen 1', NULL, 1, '2023-01-26', 1, NULL),
(281, 'Almacen 2', NULL, 1, '2023-01-26', 1, NULL),
(282, 'Estantería 1', NULL, 1, '2023-01-26', 1, 280),
(283, 'Estantería 1', NULL, 1, '2023-01-26', 1, 281),
(284, 'Nivel 1', NULL, 1, '2023-01-26', 1, 282),
(285, 'Caja 1', NULL, 1, '2023-01-26', 1, 284),
(286, 'Nivel 111', NULL, 1, '2023-01-26', 1, 285);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

CREATE TABLE `anexos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `carpeta` int(11) NOT NULL,
  `id_carpeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_asignaciones`
--

CREATE TABLE `anexos_asignaciones` (
  `id` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `archivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_clientes`
--

CREATE TABLE `anexos_clientes` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_proveedores`
--

CREATE TABLE `anexos_proveedores` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_tasks_projects`
--

CREATE TABLE `anexos_tasks_projects` (
  `id` int(11) NOT NULL,
  `task` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_viaticos`
--

CREATE TABLE `anexos_viaticos` (
  `id` int(11) NOT NULL,
  `id_viatico` int(11) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendamientos`
--

CREATE TABLE `arrendamientos` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `anexo_factura` varchar(100) NOT NULL,
  `numero_factura_recibida` varchar(50) NOT NULL,
  `subtotal` float NOT NULL,
  `iva` float NOT NULL,
  `retencion` float NOT NULL,
  `total` float NOT NULL,
  `descuento` float NOT NULL,
  `visto_bueno` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `tiene_retencion` int(11) NOT NULL,
  `visto_bueno2` int(11) DEFAULT NULL,
  `visto_bueno3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `asignacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_culminacion` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `fecha_completada` datetime DEFAULT NULL,
  `visto_bueno` int(11) NOT NULL,
  `devuelta` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `revision` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances_asignaciones`
--

CREATE TABLE `avances_asignaciones` (
  `id` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` text NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances_tasks_projects`
--

CREATE TABLE `avances_tasks_projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` int(11) NOT NULL,
  `avance` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `name_file` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_eventos`
--

CREATE TABLE `calendario_eventos` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `empleado` int(11) NOT NULL,
  `calendarId` int(1) NOT NULL,
  `isAllDay` int(1) NOT NULL,
  `isPrivate` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `state` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `useCreationPopup` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calendario_eventos`
--

INSERT INTO `calendario_eventos` (`id`, `code`, `empleado`, `calendarId`, `isAllDay`, `isPrivate`, `name`, `description`, `state`, `start`, `end`, `useCreationPopup`, `created_at`) VALUES
(22, 'CL-IPIHGH4OIVCDRFSTTB7F', 1, 1, 1, 0, 'Casaaa', '', 'Empresa', '2023-01-10 00:00:00', '2023-01-10 23:59:00', 1, '2023-01-16 16:38:37'),
(23, 'CL-SH6KBNIJ2ZSBNOSOKZQP', 1, 1, 1, 0, 'pppppp', '', 'Empresa', '2023-01-11 00:00:00', '2023-01-11 23:59:00', 1, '2023-01-16 16:39:19'),
(24, 'CL-AWEXWFWOBIHU7KR5RSBE', 1, 1, 0, 0, 'asdccasd', '', 'Empresa', '2023-01-17 10:29:00', '2023-01-18 17:30:00', 1, '2023-01-16 16:39:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_archivos`
--

CREATE TABLE `categorias_archivos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias_archivos`
--

INSERT INTO `categorias_archivos` (`id`, `nombre`, `fecha`, `created_by`) VALUES
(2, 'Programacion', '2022-03-03 17:13:00', 1),
(3, 'Imagenes', '2022-03-03 17:13:07', 1),
(4, 'Fotos', '2022-03-03 17:13:12', 1),
(5, 'Videos', '2022-03-03 17:13:16', 1),
(6, 'Archivo', '2022-03-09 12:34:02', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_calendario`
--

CREATE TABLE `categorias_calendario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `bgColor` varchar(255) NOT NULL,
  `dragBgColor` varchar(255) NOT NULL,
  `borderColor` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_calendario`
--

INSERT INTO `categorias_calendario` (`id`, `nombre`, `color`, `bgColor`, `dragBgColor`, `borderColor`, `created_by`, `created_at`) VALUES
(1, 'Tareas', '#ffffff', '#ff5583', '#ff5583', '#ff5583', 1, '2023-01-16 18:47:05'),
(2, 'Eventos', '#ffffff', '#03bd9e', '#03bd9e', '#03bd9e', 1, '2023-01-16 18:47:05'),
(3, 'Notas', '#ffffff', '#9e5fff', '#9e5fff', '#9e5fff', 1, '2023-01-16 18:47:05'),
(4, 'Recordatorios', '#ffffff', '#00a9ff', '#00a9ff', '#00a9ff', 1, '2023-01-16 18:47:05'),
(5, 'Casa', '#ffffff', '#e0e04a', '#e0e04a', '#e0e04a', 1, '2023-01-16 18:47:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE `categorias_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_productos`
--

INSERT INTO `categorias_productos` (`id`, `nombre`, `created_by`, `fecha`) VALUES
(87, 'RADIOS', 1, '2023-01-12'),
(88, 'REPETIDORAS', 1, '2023-01-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_proyectos`
--

CREATE TABLE `categorias_proyectos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_proyectos`
--

INSERT INTO `categorias_proyectos` (`id`, `nombre`, `created_by`) VALUES
(43, 'SERVICIO AL CLIENTE', 39),
(44, 'FACTURACION', 39),
(45, 'SEGUIMIENTO ', 39),
(47, 'LABORATORIO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_seguimiento_clientes`
--

CREATE TABLE `categorias_seguimiento_clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_seguimiento_clientes`
--

INSERT INTO `categorias_seguimiento_clientes` (`id`, `nombre`, `created_by`) VALUES
(1, 'SERVICIO AL CLIENTE', 39),
(2, 'LABORATORIO', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nit` varchar(50) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `telefono_fijo` varchar(100) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `observaciones` text NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `tipo_regimen` varchar(50) NOT NULL,
  `estado` int(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `codigo_verificacion` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `tipo_identificacion` int(11) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `codigo_sucursal` varchar(50) NOT NULL,
  `indicativo_telefono` varchar(40) NOT NULL,
  `extencion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nit`, `razon_social`, `direccion`, `telefono_fijo`, `celular`, `contacto`, `email`, `observaciones`, `avatar`, `tipo_regimen`, `estado`, `ciudad`, `codigo_verificacion`, `tipo`, `tipo_identificacion`, `documento`, `codigo_sucursal`, `indicativo_telefono`, `extencion`) VALUES
(9, '890917141', 'Seguridad Atempi de Colombia Limitada', 'Cl 16 B Sur Cra 42 - 97', '4486110', '3148288903', 'Andres', 'Almacen@atempi.co', '', 'a6d06a8d45fe0e84c035eb060197a4ba.png', 'Jurídico', 1, 'Medellín ', 6, 0, 0, '', '', '604', '0'),
(11, '890922447', 'Construcciones el Condor S.A', 'Cr 25 No. 3 - 45 piso 3', '4480029', '3206754334', 'Maria Isabel Castaño', 'notificaciones.judiciales@elcondor.com', '', '3327c921fe873e6aa11fb6944fda8752.png', 'Jurídico', 1, 'Medellín', 4, 0, 0, '', '057', '604', '0'),
(13, '900888228', 'Minerales Camino Real S.A.S', 'Cl 113 No. 7-21 To A P 11 Of 1101', '6585893', '3153052609', 'Luis Puerto', 'lpuerto@mineralescaminoreal.com', '', 'f6152d1798adb99f5f5cd2c4dc8a9770.png', 'Jurídico', 1, 'Bogotá ', 8, 0, 0, '', '0', '001', '0'),
(14, '900768355', 'Inversiones Entre Rios S.A.S', 'Cl 48 No. 19- 100 Ca 13 A La Castellana', '3137295328', '3165399135', 'Juan Casas', 'gerencia@inversionesentrerios.com', '', '7034cb162ecf72dff4ad832aa2598164.png', 'Jurídico', 1, 'Pereira Risaralda', 0, 0, 0, '', '0', '606', '0'),
(15, '900551266', 'Consorcio CCC Ituango', 'Cra 43 A 6 Sur 15 Of 253', '2667935', '3113303096', 'Jose Gabriel Hernandez', 'jose.hernandez@cccituango.com', '', 'eb014f8013ad078be05caebae132fd47.png', 'Jurídico', 1, 'Medellín', 0, 0, 0, '', '001', '604', '0'),
(16, '901401130', 'Consorcio Isla 2020 Puerto Berrio', 'Cra 7 C No. 125-08', '4926970', '3218120347', 'Breiner', 'gestiondocumental@consorcioisla.com', '', 'cb05a6a00b65d54736a7199c2babb6ae.png', 'Jurídico', 1, 'Bogotá ', 9, 0, 0, '', '001', '601', '0'),
(17, '811007280', 'Seracis LTDA', 'Cl 47 D No. 79-33', '4484518', '3116444816', 'Alejandro  Acosta', 'a.acosta@radioenlacesas.com', '', '49b7d968f83100901198b05c8e8ffb33.png', 'Jurídico', 1, 'Medellín ', 1, 0, 0, '', '001', '604', '0'),
(18, '830504313', 'Radio Enlace S.A.S', 'CL 27 No 81-70', '4448280', '3116307079', 'Oscar Sanchez', 'gcomercial@radioenlacesas.com', '', '53e5282ff2ae259536efa798d273f4b7.png', 'Jurídico', 1, 'Medellín', 5, 0, 0, '', '001', '604', '0'),
(19, '901440255', 'Consorcio Isla Caribe', 'Cra 7 C No. 125-08', '4926970', '3176799450', 'Liliana  Montoya', 'liliana.montoya@conislacaribe.com', '', '9510b64de8bf5353ff1c6a1fdd67d4ba.png', 'Jurídico', 1, 'Bogotá ', 7, 0, 0, '', '001', '601', '0'),
(20, '900102268', 'Ingeniería, Transporte y Maquinaria S.A.S Intramaq', 'Cra 48 No. 48 Sur 75BG 161', '4483012', '3116167644', 'Claudia', 'direccionadministrativa@intramaq.co', '', 'c9bdb1e33b3e94c303812536b1b069b4.png', 'Jurídico', 1, 'Medellin', 1, 0, 0, '', '01', '', '0'),
(21, '890911846', 'Seguridad de Colombia Antioquia Limitada', 'Cr 43D No. 8 -06', '2684800', '3136593577', 'Jairo Vasquez ', 'Almacen@sedecol.com', '', '0f8d16c4633b62306362348dfd4e6889.png', 'Jurídico', 1, 'Medellín ', 2, 0, 0, '', '01', '604', '3'),
(22, '900356646', 'Ortiz Construcciones y Proyectos S.A Sucursal Colombia', 'Cl 113 No. 7-21 Of 1213 Ed. Teleport Torre A', '9156596', '3208302963', 'Nestor Barajas', 'nestor.barajas@grupoortiz.com', '', '083d30b297eb493274e3e36d7a999c0f.png', 'Jurídico', 1, 'Bogotá ', 7, 0, 0, '', '001', '601', '0'),
(23, '901019138', 'Consorcio Ruta 40', 'Cl 99 No. 14 -49 P 3 ZN C', '6202166', '3213707349', 'Marcela Ortiz', 'mortiz@via40express.com', '', 'c8f09108311e17955ec8014967d6ac95.png', 'Jurídico', 1, 'Bogotá ', 1, 0, 0, '', '001', '601', '0'),
(24, '890923681', 'Cimbrados S.A', 'Cr 44 No 46 Sur 50', '3313233', '3045531872', 'Arley Cortez', 'almacen@cimbrados.com', '', '4d7de703235dd5f34cfc0ea752b91d90.png', 'Jurídico', 1, 'Medellín', 6, 0, 0, '', '0', '604', '109'),
(25, '900432686', 'Arce Geofísicos Sucursal de Colombia', 'CL 12 No. 30 - 356', '4482950', '3104705895', 'Juliana Romero', 'julianaromero@geofisicos.com', '', '9d23ca0dc31142b609ee852b57b7fe66.png', 'Jurídico', 1, 'Medellín', 0, 0, 0, '', '01', '604', '0'),
(26, '900166687', 'Continental Gold', 'Cl 7 No. 39 -215', '3121026', '3235726744', 'Daniel Verbel', 'daniel.verbel@continentalgold.com', '', '4fe6a89f59ecf3c317df832191431667.png', 'Jurídico', 1, 'Medellín', 7, 0, 0, '', '', '', ''),
(27, '800010866', 'Expertos Seguridad LTDA', 'CIR 4  No. 69  - 18', '4301000', '2604477', 'Oscar Diaz', 'comprasylogistica@expertoseguridad.com.co', '', '0620bf91ed82cb6b316ee9824de53741.png', 'Jurídico', 1, 'Medellín ', 6, 0, 0, '', '', '', ''),
(28, '890333105', 'Andina Seguridad del Valle', 'CL 47 Norte 4B N. 85 Barrio La Flora', '6047050', '3217997792', 'Yimmy Montenegro', 'dmedellin@andinaseguridad.com.co', 'Gerente', '2353cc6bad039b3264b6cd57e2641811.png', 'Jurídico', 1, 'Medellín ', 3, 0, 0, '', '0', '604', '123'),
(29, '901000005', 'Soliciones Integrales de Seguridada &amp; Vigilancia Pivada Limitada', 'Cra 83 A 33 B 05', '3223492', '3146382295', 'Mavis Pumarejo', 'administrativa@integralseguridad.co', '', 'de94df122c93219677998861b1c9eece.png', 'Jurídico', 1, 'Medellin', 5, 0, 0, '', '01', '604', '0'),
(30, '901009478', 'Via 40Express S.A.S', 'Cl 99 No. 14- 49 OF 302 ED EAR', '3257300', '3217407858', 'Hernan Alarcon', 'halarcon@via40express.com', '', 'dd1e982a5fbfc1dc376660b44d5b7189.png', 'Jurídico', 1, 'Bogotá ', 6, 0, 0, '', '', '', ''),
(31, '890932424', 'Sp Ingenieros S.A.S', 'Cra 74 No. 28-29', '3417600', '3417445', 'Maria Munera', 'admon.mar2@sp.com.co', '', '64f7a04489effd51617cfc09b31b1701.png', 'Jurídico', 1, 'Medellín', 8, 0, 0, '', '0', '0', '604'),
(32, '800241602', 'Fundación Colombiana de Cancerología Clínica Vida', 'Cl 7 39 - 197 INT 302', '4480016', '3164297230', 'Daniel Alberto', 'coordinacion.infraestructura@clinicavida.com', '', '00bd2e2e3d3e14ef03932d8162c6f623.png', 'Jurídico', 1, 'Medellín ', 1, 0, 0, '', '0', '604', '0'),
(33, '900464667', 'Zima Seguridad LTDA', 'Cr 21A No. 29 A 56', '6431311', '3507104616', 'Jorge Vasquez', 'superv.rmagdalena@zimaseguridad.com.co', '', '0a7a8981105f015faeaa4877c3f63486.png', 'Jurídico', 1, 'Cartagena', 8, 0, 0, '', '', '', ''),
(34, '890312749', 'Seguridad Atlas LTDA', 'CL 14 No. 52 - 51', '3788660', '3216489229', 'Diego Tamayo', 'datamayo@atlas.com.co', '', 'c102e83e630408753c2a8f554c4c1134.png', 'Jurídico', 1, 'Medellín ', 6, 0, 0, '', '0', '604', '4063'),
(35, '811001008', 'Televigia Limitada', 'Cra 43 D D No.  8-12', '2668181', '', 'Edwin  Sampedro ', 'supervisormonitoreo@televigia.com', '', 'd02e3fe932f6d425fdd84d52eb4d53bc.png', 'Jurídico', 1, 'Medellín', 5, 0, 0, '', '0', '604', '0'),
(36, '', 'West Army  Security Limitada', 'Cl 52 A No. 73 - 90', '4047080', '3203743203', 'Alexander', 'operacionesmedellin@was.com.co', '', '1cc2111a5aad56ee033f1415bd41e505.png', 'Jurídico', 1, 'Bogotá ', 0, 0, 0, '', '51', '601', '0'),
(37, '', 'Concesionaria Vial del Pacifico S.A.S', '', '6049300', '3113919797', 'Linea de Atención ', '', '', '3ea653cc6bf2fd80419aa6ab0c679bbe.png', 'Jurídico', 1, '', 0, 0, 0, '', '', '', ''),
(38, '900899437', 'Consorcio  Antioquia al Mar ', 'CL 18 Cra 35-69 Of 306', '3126355280', '3126355280', 'Alba Marina Sanchez', 'direccion.compras@tuneldeltoyo.com', '', '67d6f97498346e1b930331f4f43e8ba9.png', 'Jurídico', 1, 'Giraldo - Antioquia', 8, 0, 0, '', '0', '604', '0'),
(39, '900937826', 'Consorcio Constructor Conexión Norte', 'Cl 11 No. 27-16 Barrio el triangulo ', '3102111514', '323 582 04 25', 'Yennifer Lopez', 'y_lopez@constructorconexionnorte.com.co', '', '6d7b8dd0fb43f5e54209924d5d1805ba.png', 'Jurídico', 1, 'Caucasia', 3, 0, 0, '', '0', '604', '0'),
(40, '900548173', 'Masivo de Occidente S.A.S', 'Cra 67 No. 8 b 94', '4487655', '3114910647', 'Luz Jiménez ', 'luz.jimenez@mdosas.com', '', '02f95aa9987e77110862e846f1270c77.png', 'Jurídico', 1, 'Medellín', 3, 0, 0, '', '', '', ''),
(41, '900448692', 'Fidelity Security  Company LTDA', 'Cl 105 No. 46-57', '8052614', '3204489680', 'Karol Millan', 'dadministrativo@fidelitysecurityltda.com', '', 'e7b3bd79a0bb086a914fc8ed6cd7ebe3.png', 'Jurídico', 1, 'Bogotá ', 5, 0, 0, '', '0', '601', '122'),
(42, '901466546', 'En Colombia Tecnología y Comunicaciones S.A.S / Encoltec', 'Cl 50 No. 71- 80 Ap 817 To A ED. el Caribe', '3166403933', '3147463284', 'Jaime Ospina', 'encoltec@gmail.com', '', '37af911e556718e3a5b818af780a2171.png', 'Jurídico', 1, 'Medellín', 8, 0, 0, '', '0', '604', '0'),
(43, '860037914', 'Coscuez S.A', 'Oficina Principal Otache', '3203916133', '3203916133', 'Jeferson', 'kiran.s@furagems.com', '', 'e6c725044bce8cabe02e0c77f8297169.png', 'Jurídico', 1, 'Medellín ', 7, 0, 0, '', '057', '0', '0'),
(44, '901380838', 'Consorcio R&amp;S', 'AV CR 20 85 A 21', '4321757', '', 'Juan ', '', '', '', '', 1, '', 2, 0, 0, '', '', '', ''),
(45, '901172312', 'FreshColombia  International S.A.S', 'Zona Franca Rionegro Bodega 244/245/246', '3228051', '3222089711', 'Jose Patiño', 'jose.patino@freshcolombia.co', '', '71c2dc59f52c0e5ee91cfb087b336317.png', '', 1, 'Rionegro', 0, 0, 0, '', '', '604', '1'),
(46, '830139512', 'Compañia de Vigilancia los Libertadores LTDA', 'CR 14  A No. 82 63 OF 301', '8053335', '3102271328', 'Brayan ', 'gerenciabogotacvl@gmail.com', '', '1979872dbe826583384d3bdbf3948932.png', 'Juridico', 1, 'Bogota', 9, 0, 0, '', '', '601', '0'),
(47, '900387546', 'PORTAL RAIZ S.A.S', 'CL 29 41 105 ED SOHO', '(604) 2625832', '', 'Michael Gómez', 'portalraiz18@gmail.com', '', '', 'Común', 1, 'Medellín', 5, 0, 0, '', '0', '(604)', ' '),
(48, '800029899', 'Ingeniería y Vías S.A.S  / Ingevias', 'Cl 6 Sur 38-15', '4485587', '3002674582', 'Luisa Vasquez Franco', 'luisa.vasquez@ingevias.com', '', '3fd668025d4111d717882047b802c696.png', 'Juridico', 1, 'Medellin', 2, 0, 0, '', '604', '4', '0'),
(49, '830095304', 'CRC Comunicaciones S.A.S', 'Cra 28 No. 71-95', '2258650', '3108175023', 'Aurora', 'factura@crccomunicaciones.com', '', 'd7625d75ebeed9297871fbc250532361.png', 'Juridico', 1, 'Bogota', 2, 0, 0, '', '601', '601', '0'),
(50, '860023264', 'Securitas de Colombia S.A.', 'AC 26 92 32 Conecta Edificio Gold 12', '', '', '', '', '', '', 'Común', 1, 'Bogotá DC ', 7, 0, 0, '', '', '', ''),
(51, '900411781', 'Fajas MYD PosquirurgIcas S.A.S', 'Cra 50C  No. 10 Sur 120 BG 122', '4443174', '3184459473', 'Anderson Aguilar', 'contador@fajasmyd.com.co', '', '309ee5764a392832a2037a7cdba24017.png', 'Juridico', 1, 'Medellín ', 2, 0, 0, '', '0', '604', '0'),
(52, '901068528', 'Concretos y Equipos  C&amp;E S.A.S', 'Cl 60 No. 144-360 Vda la Palma san Cristóbal ', '4730861', '3114100864', 'x', 'compras@concretosyequipos.com.co', '', 'f5e39fc07c3902b5dbf8bac8254bc26f.png', 'Juridico', 1, 'Medellin', 8, 0, 0, '', '', '604', '0'),
(53, '812000120', 'Obras Arquitectos Constructores S.A.S', 'KM 3 CR 33 Via  a cerromatoso', '7627910', '', '', 'gerencia@obrass.com.co', '', '75e8507da0b9194a709a2f0794cf879f.png', 'Juridico', 1, 'Medellín ', 1, 0, 0, '', '0', '60', '0'),
(54, '890903436', 'MCM Company S.A.S ', 'Cl 19 A No. 43B 41', '2619100', '30005919154', 'Adrián Guzmán ', '', '', '0a58630922a7c91debbb1ead5d4584fc.png', '', 1, 'Medellín ', 2, 0, 0, '', '', '604', '0'),
(55, '890981863', 'Corporacion de Fomento Asistencial del Hospital Universitario San Vicente de Paul', 'CR 52 A No. 39 80', '054 4480550', '3205874140', 'Jerónimo  Montoya', 'jmontoya@corpaul.com', '', 'c2f43e017b4637fb68625719ba77f420.png', 'Juridico', 1, 'Medellín ', 0, 0, 0, '', '0', '604', '0'),
(56, '900807426', 'Civiltech Ingeniería y Construcción S.A.S', 'Cra 52 A # 123-50 Barrio Batan ', '6364194', '3155660777', 'Nataly Hernandez', 'nhernandez@civiltechic.com', '', '7a3f5bbe6b139d37fb86daad1222ecf0.png', 'Juridico', 1, 'Bogota', 3, 0, 0, '', '0', '601', '0'),
(57, '900983468', 'Hidroenergia de la Montaña S.A.S E.S.P', 'Cl 3 Sur  No. 43  A 52 Of 1801', '3123618', '3138687387', 'Carlos Torres', 'carlostorres@hidroenergiadelamontana.com', '', '8628fbde375e9744b7ff1997eca7cd9b.png', 'Juridico', 1, 'Medellín ', 5, 0, 0, '', '0', '601', '0'),
(58, '890917295', 'Colorquimica S.A.S', 'Cl 77 Sur No 53-51 ', '3021717', '', 'Daniel Muñoz', 'amunos@clq.com.co', '', 'b9cc4d47d0d644521006326aa0bded85.png', '', 1, 'Medellín ', 1, 0, 0, '', '', '604', ''),
(59, '830055897', 'Patrimonio Autonomo Fiduciaria Bogota S.A - Vinus', 'CL 67 No. 7 -37 Piso 3', '2585858', '', 'Yuli Uribe', 'yuribe@tuneloriente.com', '', '072db3ffec76857dfb6c018c39ac7f0a.png', 'Juridico', 1, 'Bogota', 7, 0, 0, '', '', '601', '0'),
(60, '811012172', 'Concesion Tunel Aburra Oriente', 'Cra 35 A 15B 35 OF 508 ed. prisma', '4446178', '3165211013', 'Ingeniero Gabriel', 'anyellif@tuneloriente.com', '', '92eea9dbe8457cff00ef8e1ddf0bf8d0.png', 'Juridico', 1, 'Medellín ', 2, 0, 0, '', '0', '604', '0'),
(61, '900677711', 'Grúas Vanegas Rojas S.A.S', 'Cl 82 Cr 51 B 22 INT 201', '5162865', '3113154417', 'Pedro Nel Vanegas Rojas ', 'gruasvanegasmedellin@hotmail.com', '', '4e29f9e615e31bfa9ae8ab1a7495f880.png', 'Juridico', 1, 'Medellín ', 9, 0, 0, '', '', '', ''),
(62, '811000761', 'Minera el Roble ', 'CRA 43A No. 1 A SUR 69 OF 701', '5405330', '3207648126', 'Sebastian Rendon ', 'srendon@miner.com.co', '', 'f6eab358602f4a6ab415bbe678331ee9.png', '', 1, 'Medellín ', 9, 0, 0, '', '0', '604', '0'),
(63, '9000840799', 'IP Integrales S.A.S', 'Cl 45 G No. 77 AA 16BRR Velodromo', '5575724', '3136589351', 'Jhon Jairo ', 'asistente@ipintegrales.com.co', '', '55886f421579a38f05276241b06d17f8.png', 'Juridico', 1, 'Medellín ', 4, 0, 0, '', '0', '604', '0'),
(64, '81600141', 'Ingeniería de Sistemas Telemáticos S.A  / Insitel', 'Cl 144 No. 21 - 44 ', '6200177', '6200277', '', 'info@insitel.com', '', '87b0a4243cdda1a4cdb849c294e6375b.png', 'Juridico', 1, 'Bogotá', 6, 0, 0, '', '0', '601', '0'),
(65, '901608054', 'Unión Temporal CPC 2022', 'CRA 38 # 38 Sur 29 Barrio mesa', '4441327', '3105037474', 'Juan Fernando Garcia', 'compras@csyr.com.co', '', '', 'Juridico', 1, 'Medellín ', 7, 0, 0, '', '', '604', ''),
(66, '890930811', 'EDIFICIO NOVA TEMPO ', 'CRA 43a No. 14 - 109 OF 801', '2666608', '3008317259', 'SANDRA LONDOÑO', 'asistentenovatempo@gmail.com', '', 'b4d7baf4b6b8464b4d2a5b35c51a4c75.png', '', 1, 'Medellín ', 0, 0, 0, '', '', '604', '0'),
(67, '901157412', 'Alquiler, Equipo y Construcciones  S.A.S', 'Cra 51 B 4 Sur 14', '3585686', '3104398330', 'Luisa', 'contabilidad@alkiconayc.com', '', '', 'Juridico', 1, 'Medellín ', 4, 0, 0, '', '', '604', ''),
(68, '901574121', 'Consorcio Mega construcciones Occidente ', 'CR 35 A 15 B 35 ED PRISMA OF 817', '3116628', '3157098005', 'Carlos', 'socialviacaicedo@consorciomeca.com', '', '41dc58d2633a306d0f34a5d8e8763037.png', '', 1, 'Medellín ', 4, 0, 0, '', '', '604', ''),
(69, '900284917', 'Constructora Sumas y Restas S.A.S', 'CRA 38 No. 38sur 29', '4441327', '3105047474', 'Juan Fernando ', 'compras@csyr.com.co', '', '96c9711391617c3f9b49f075f3901cde.png', '', 1, '', 1, 0, 0, '', '', '604', ''),
(70, '900680466', 'Corporación Cuenca  Verde ', 'CR 43 A 1 A SUR 29 OF 811 ED COLMENA', '2 6 8 1 4 0 2', '3226190952', 'Sebastián Román ', 'auxiliar.campo2@cuencaverde.org', '', 'ab00b210e419641d9cd7afb4e93afab6.png', 'Juridico', 1, 'Medellín ', 1, 0, 0, '', '', '604', ''),
(71, '811016337', 'Instituto de Deporte Recreación  y  Aprovechamiento del Tiempo Libre Inder Envigado', 'CRA 48 # 46 - 150', '604 4482098', '3136139051', 'Carlos', 'dfernandez@inderenvigado.gov.co', '', '', 'Juridico', 1, 'Envigado', 9, 0, 0, '', '', '604', ''),
(72, '890114642', 'Caldas Gold Marmato S.A.S', 'Cra. 24 # 62 - 53 Ed. Pranha Urbano Of 201', '8819662', '3108343838', 'Marcos Malagon ', 'notificaciones@caldasgold.com.co', '', '222195e8263323a10cbef89dd0f7fa35.png', 'Juridico', 1, 'Manizales ', 8, 0, 0, '', '', '606', ''),
(73, '900318997', 'Agregados de la Sierra S.A', 'CL 18 35 69 OF 424', '6040111', '3115830609', '', 'notificacionesjudiciales@agregadosdelasierra.com', '', 'c97ddf8892997da33a0ec984ca792ec8.png', 'Juridico', 1, 'Medellín ', 9, 0, 0, '', '', '601', ''),
(74, '9 0 1 5 8 1 6 9 9', 'Consorcio  I.E.J.F.K 2022', 'CR 38 38 SUR 29', '', '3127792748', 'Juan Fernando García', 'facturacion@csyr.com.co', '', 'b913eba33c1792533cc2101445bf3a7f.png', 'Juridico', 1, 'Medellín ', 8, 0, 0, '', '', '604', ''),
(76, '830027231', 'Rocsa Colombia S.A   /  Improquim', 'Par IND LOGIKA II AUT Medellín Costado Sur KM 5 7 BG 1', '4325136', '3202789768', 'Jorge Improquim', '', '', '0c1dfe0bb3f735190f1248de7cbff79f.png', 'Juridico', 1, 'Medellín ', 3, 0, 0, '', '', '604', ''),
(77, '901252983', 'Edificio Castropol Plaza  - Propiedad Horizontal Portal Raiz', 'CR 42 14 11 Y CL 14 42 24', '4797964', '3117771851', 'Michael   de portal raiz', 'portalraiz18@gmail.com', '', 'ac0d995bf51944cfcc733edc6075e59f.png', '', 1, 'Medellín ', 4, 0, 0, '', '', '604', ''),
(78, '890901110', 'Constructora Conconcreto S.A', 'CRA 43A 18 SUR 135 PISO 4', '4025700', '323 3620141', 'Carlos ', 'conconcretofe@conconcreto.com', '', '2f2a93c29b232967a86022a69658f960.png', '', 1, 'Medellín ', 8, 0, 0, '', '', '', ''),
(79, '860019021', 'Asociación  para la Enseñanza Aspaen ', 'CL 69 7 A 50', '2177590', '3164280956', 'Sandra Riaza', 'sandra.raiza@aspaen.edu.co', '', '2aa41f0c68829843e5c942fd390db76f.png', '', 1, '', 9, 0, 0, '', '', '601', ''),
(80, '900958259', 'Ingealquipos S.A.S', 'CRA 38 # 38 SUR 29', '4441327', '', '', 'facturacion@ingealquipos.com.co', '', 'f4500b2e792d98ac5b50c268e26af067.png', 'Juridico', 1, 'Medellín ', 7, 0, 0, '', '', '604', ''),
(81, '800256769', 'Patrimonio Autónomo Fiduciaria Corficolombiana S.A / Covipacifico ', 'Calle 10 4 - 47 p 20', '6013538795', '3157855728', 'Margarita', 'margarita.vasco@covipacifico.co', '', '', '', 1, 'Bogotá', 6, 0, 0, '', '', '', ''),
(82, '860066946', 'Seguridad Superior Ltda', 'CRA 50 No. 96 - 09', '230581', '3142130700', 'Jhon', '', '', '00348d3a9618c6af49d63115a94f50cd.png', '', 1, '', 0, 0, 0, '', '', '', ''),
(83, '901348351', 'Profesionales en Seguridad Industrial de Colombia SAS', 'TV 68 H 38B 14 SUR', '', '3223481576', 'Manuel Duarte', 'jmanuelduarte764@gmail.com', '', '66abad39caf4afed6bf9667e495ea41d.png', 'Juridico', 1, 'Bogotá', 3, 0, 0, '', '', '', ''),
(84, '', 'Jairo de Jesus Guerra Velez', 'CALLE 37 Nº 76-30', '3003676652', '3003676652', 'Jairo Guerra', 'Jairo.guerra@hotmail.com', '', '', 'Juridico', 1, 'Medellín ', 0, 1, 0, '', '', '', ''),
(85, '900193076', 'Kluane de Colombia S.A.S', 'KM 7 Aut Bogota- Medellín Par Industrial celta trade Park de Funza Dpto de Cundinamarca ', '8966775', '3203418967 - 3503913964', 'Karen Vanegas ', 'karen.vanegas@kluanecolombia.com', '', '1c1bb1c9e54c79e6e48f29b4c1fb8ad8.png', '', 1, 'Cundinamarca', 1, 0, 0, '', '', '', ''),
(86, '890304099', 'Hoteles Estelar S.A', 'AV Colombia 2 72', '8920470', '3153640762', 'Diana Patricia Cifuentes', 'jhon.marin@hotelesestelar.com', '', '', '', 1, 'cali', 3, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_nomina`
--

CREATE TABLE `configuracion_nomina` (
  `id` int(11) NOT NULL,
  `porcentaje_salud` float NOT NULL,
  `porcentaje_pension` float NOT NULL,
  `monto_base_fte` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion_nomina`
--

INSERT INTO `configuracion_nomina` (`id`, `porcentaje_salud`, `porcentaje_pension`, `monto_base_fte`) VALUES
(1, 4, 4, 4000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `consideraciones` text NOT NULL,
  `incluye` text NOT NULL,
  `validez` varchar(255) NOT NULL,
  `forma_pago` varchar(255) NOT NULL,
  `tiempo_entrega` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_facturacion`
--

CREATE TABLE `datos_facturacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo_regimen` varchar(100) NOT NULL,
  `indicativo_telefono` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `responsabilidad_fiscal` varchar(50) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_facturacion`
--

INSERT INTO `datos_facturacion` (`id`, `nombre`, `apellido`, `email`, `tipo_regimen`, `indicativo_telefono`, `telefono`, `extension`, `codigo_postal`, `responsabilidad_fiscal`, `id_cliente`) VALUES
(122, 'rrr', '', '', '', '', '', '', '', '', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_tecnico`
--

CREATE TABLE `datos_tecnico` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `indicativo_telefono` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `extension` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_tecnico`
--

INSERT INTO `datos_tecnico` (`id`, `id_cliente`, `nombre`, `apellido`, `email`, `indicativo_telefono`, `telefono`, `extension`) VALUES
(4, 9, 'Henry', 'Arango', 'coor_logistico@atempi.co', '', '3014231617', ''),
(5, 10, 'Andres', 'Velez', 'andres.velez@elcondor.com', '', '3167186560', '0'),
(6, 11, 'Andres', 'Vélez  ', 'andres.velez@elcondor.com', '57', '3167186560', '0'),
(13, 13, 'Anastasio ', 'Chaustre', 'achaustre@mineralescaminoreal.com', '57', '317 8871163', '0'),
(14, 14, 'Yair ', 'Restrepo', 'yair.restrepo@inversionesentrerios.com', '57', '3214677862', '0'),
(19, 16, 'Breither ', 'Pulgarin', 'breitner.pulgarin@latincosa.com', '', '3218120347', '0'),
(20, 15, 'Andres', 'Macana', 'cctv@cccituango.co', '57', '3506194325', '0'),
(22, 17, 'Alejadro ', 'Acosta', 'a.acosta@seracis.com', '0', '3216444816', '0'),
(24, 18, 'Miguel ', 'Castellano', 'labtec1@radioenlacesas.com', '', '3103018000', '0'),
(26, 19, 'Liliana ', 'Montoya', 'liliana.montoya@conislacaribe.com', '57', '3176799450', '0'),
(29, 20, 'Alejandro ', 'Velez', 'coordinadortecnico4@intramaq.co', '607', '4483012', '0'),
(30, 21, 'Jairo ', 'Vasquez', 'Almacen@sedecol.com', '604', '2684800', '3'),
(33, 22, 'Javier ', 'Espinoza', 'consultorseguridad.baq@gmail.com', '57', '3208302963', '0'),
(34, 23, 'Hernan', 'Alarcon', 'halarcon@via40express.com', '57', '3145846847', '0'),
(39, 26, 'Daniel ', 'Verbel', 'daniel.verbel@continentalgold.com', '57', '3235726744', '0'),
(41, 27, 'Oscar', 'Diaz', 'comprasylogistica@expertoseguridad.com.co', '57', '3128179921', '149'),
(43, 28, 'Yimmy ', 'Montenegro', 'dmedellin@andinaseguridad.com.co', '57', '3217997792', '0'),
(45, 29, 'Jhonatan', 'Restrepo', 'Gerencia@integralseguridad.co', '', '3145969083', ''),
(48, 31, 'Sergio ', 'Correa', 'auxcompras2@sp.com.co', '57', '3014866377', '0'),
(53, 33, 'Jesus ', 'Vecino', 'superv.rmagdalena@zimaseguridad.com.co', '57', '3162865051', '0'),
(55, 34, 'David ', 'Tamayo', 'datamayo@atlas.com.co', '', '321 648 92 29', '0'),
(56, 35, 'Edwin', 'Sampedro', 'supervisormonitoreo@televigia.com', '604', '2668181', '0'),
(58, 36, 'Ariel ', 'Barbosa', 'coordinadorpuertoberrio@gmail.com', '', '3103000065', '0'),
(59, 30, 'Hernan', 'Alarcon', 'halarcon@via40express.com', '57', '3145846847', '0'),
(62, 38, 'Andres ', 'Tovar', 'andres.tovar@tuneldeltoyo.com', '', '3103699662', '0'),
(65, 40, 'Alexis', 'Loaiza', '110-111', '604', '4487655', '0'),
(74, 41, 'Sandra ', 'Rey', 'logistica@fidelitysecurityltda.com', '57', '', ''),
(76, 3, 'testasd2', 'testasd2', 'test2@test.testasd2', '1351351358', '13513513582', '99'),
(77, 44, '', '', '', '', '', ''),
(78, 45, '', '', '', '', '', ''),
(79, 46, 'Braya', 'Coordinador Operativo', '', '0', '3102271328', ''),
(80, 47, '', '', '', '', '', ''),
(81, 48, '', '', '', '', '', ''),
(82, 49, '', '', '', '', '', ''),
(83, 50, '', '', '', '', '', ''),
(84, 51, '', '', '', '', '', ''),
(85, 52, '', '', '', '', '', ''),
(86, 53, '', '', '', '', '', ''),
(87, 54, '', '', '', '', '', ''),
(88, 55, '', '', '', '', '', ''),
(89, 56, '', '', '', '', '', ''),
(90, 57, 'Carlos ', 'Torres', 'carlostorres@hidroenergiadelamontana.com', '57', '3138687387', '0'),
(91, 58, '', '', '', '', '', ''),
(92, 59, '', '', '', '', '', ''),
(93, 60, '', '', '', '', '', ''),
(94, 61, '', '', '', '', '', ''),
(95, 62, '', '', '', '', '', ''),
(96, 63, '', '', '', '', '', ''),
(97, 64, '', '', '', '', '', ''),
(98, 65, '', '', '', '', '', ''),
(99, 66, '', '', '', '', '', ''),
(100, 67, '', '', '', '', '', ''),
(101, 68, '', '', '', '', '', ''),
(102, 69, '', '', '', '', '', ''),
(103, 70, '', '', '', '', '', ''),
(104, 71, '', '', '', '', '', ''),
(105, 72, '', '', '', '', '', ''),
(106, 73, '', '', '', '', '', ''),
(107, 74, '', '', '', '', '', ''),
(108, 75, '', '', '', '', '', ''),
(109, 76, '', '', '', '', '', ''),
(110, 77, '', '', '', '', '', ''),
(111, 78, '', '', '', '', '', ''),
(112, 79, '', '', '', '', '', ''),
(113, 80, '', '', '', '', '', ''),
(114, 81, '', '', '', '', '', ''),
(115, 82, '', '', '', '', '', ''),
(116, 83, '', '', '', '', '', ''),
(117, 84, '', '', '', '', '', ''),
(118, 85, '', '', '', '', '', ''),
(119, 86, '', '', '', '', '', ''),
(120, 87, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `codigo_empleado` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono_fijo` varchar(20) NOT NULL,
  `telefono_celular` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_retiro` date NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `eps` varchar(50) NOT NULL,
  `caja_compensacion` varchar(50) NOT NULL,
  `arl` varchar(50) NOT NULL,
  `fondo_pension` varchar(50) NOT NULL,
  `periodo_vacaciones` text NOT NULL,
  `observaciones` text NOT NULL,
  `prestamo` int(11) NOT NULL,
  `periodo_dotacion` text NOT NULL,
  `numero_licencia_conduccion` varchar(50) NOT NULL,
  `vencimiento_licencia_conduccion` date NOT NULL,
  `multas_transito_pendiente` int(11) NOT NULL,
  `implementos_seguridad` text NOT NULL,
  `riesgos_profesionales` int(11) NOT NULL,
  `culminacion_contrato` date NOT NULL,
  `status` int(11) NOT NULL,
  `licencia_conduccion_moto` varchar(100) NOT NULL,
  `vencimiento_licencia_moto` varchar(100) NOT NULL,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `codigo_empleado`, `nombre`, `cargo`, `password`, `rol`, `email`, `telefono_fijo`, `telefono_celular`, `direccion`, `fecha_ingreso`, `fecha_retiro`, `avatar`, `fecha_nacimiento`, `eps`, `caja_compensacion`, `arl`, `fondo_pension`, `periodo_vacaciones`, `observaciones`, `prestamo`, `periodo_dotacion`, `numero_licencia_conduccion`, `vencimiento_licencia_conduccion`, `multas_transito_pendiente`, `implementos_seguridad`, `riesgos_profesionales`, `culminacion_contrato`, `status`, `licencia_conduccion_moto`, `vencimiento_licencia_moto`, `puntos`) VALUES
(1, '1001437547', 'Santiago Smith', 'Desarrollador', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 7, 'smith@gmail.com', '6164046', '3164693321', '', '2022-02-08', '0000-00-00', '61c999645d93b18961967f7329a66a1f.png', '2022-02-02', 'Sura', 'Sura', 'Sura', 'Sura', '01/2019 a 04/2019', 'sin observaciones', 0, '01/2019 a 05/2019', '16136136136', '0000-00-00', 0, '20834302', 5, '0000-00-00', 1, '', '', 0),
(6, '98518213', 'Oscar Sanchez', 'Tecnico', '$2y$10$ijBbJ/Yq8gC.fOtVHUTkhOzZDgB4hrtXyfgioElUgMLv8VDefN17O', 9, 'gcomercial@radioenlacesas.com', '1654654', '3116307079', 'Calle 47 # 34 - 52 Interior 202\r\nBarrio Buenos Aires', '2022-02-02', '0000-00-00', '90aa9b94eb827928359be427685ed8a7.png', '1966-09-07', 'Sura', 'Comfama', 'Sura', 'Protección', '135135', '135135', 0, '01/2019 a 05/2019', '16136136136', '2022-02-08', 0, '135135', 3, '0000-00-00', 1, '', '', 0),
(8, '43552929', 'Mónica Patricia Sánchez Durán', 'Directora Administrativa', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'direcciong@radioenlacesas.com', '4448280', '3113112209', '', '2004-09-24', '0000-00-00', '46a75035b7febeb615e0f07cde62db8c.png', '1970-05-02', 'Sura', 'Comfama', 'Sura', 'Colpensiones', '12/03/2010 al 22/03/2010\r\n03/05/2011 al 23/05/2011\r\n04/02/2012 al 20/02/2012', 'Cuida a Gaby', 1, '12/03/2010 al 22/03/2010 03/05/2011 al 23/05/2011 04/02/2012 al 20/02/2012', '43552929', '2022-02-25', 1, '12/03/2010 al 22/03/2010 03/05/2011 al 23/05/2011 04/02/2012 al 20/02/2012', 3, '0000-00-00', 1, '', '', 0),
(9, '1036610363', 'Sirley Tatiana Murillo Gómez', 'Coordinadora Gestión Humana', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'recursoshumanos@radioenlacesas.com', '3884353', '3148783053', 'Carrera 69 calle 38 b sur 104 villa maría torre 5 apt 419 ', '2020-10-07', '0000-00-00', '359ee9e30ef2fa0cb98f46dc0e2b9b03.png', '1987-09-24', 'Salud Total', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 7-10-2020 al  6-10-2021\r\nSegundo periodo: 7-10-2021 al 6-10-2022\r\n\r\n', '', 0, ' 11-03-2021 ', '', '0000-00-00', 0, '2-06-2021 / 16-07-2021 ', 3, '0000-00-00', 1, '', '', 0),
(10, '1020450624', 'Deisy Johana  Villada Vélez ', 'Asistente de Gerencia', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'asistente_direccion@radioenlacesas.com', '3053259400', '3137742487', 'Carrera 44 # 26 71', '2016-01-05', '2022-05-04', '503cffcd735b1b4f5ba672355ef185bc.png', '1992-08-29', 'Nueva EPS', 'Comfama', 'Sura', 'Porvenir', 'Primer periodo: 05/01/2016 - 04/01/2017 / Segundo periodo: 05/01/2017 - 04/01/2018 \r\nTercer periodo: 05/01/2018 - 04/01/2019  /  Cuarto periodo: 05/01/2019 - 04/01/2020 \r\nQuinto periodo: 05/01/2020 - 04/01/2021  /  Sexto periodo: 05/01/2021 - 04/01/2022\r\n', '', 1, '11-03-2021', 'LC02004704423', '2031-04-07', 0, '22-06-2021', 5, '0000-00-00', 1, '', '', 0),
(11, '1082104571', 'Wilmar Hernán Tupaz Meneses ', 'Ingeniero Electronico ', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'wilmar.tupaz@radioenlacesas.com', '3152611966', '3133056726', 'Calle 12 sur # 54 34', '2021-06-20', '2022-06-20', 'ce7c475b7d581bd5149a1f352908eda1.png', '1989-12-11', 'Sura', 'Comfama', 'Sura', 'Colpensiones', '21-06-2021 al 20-06-2022', '', 0, '25-08-2021 ', '', '0000-00-00', 0, '22-10-2021', 3, '0000-00-00', 0, 'LC02004913978', '2031-10-08', 0),
(12, 'CE 1006858', 'Jesús David Vasquez Barrios', 'Técnico - Auxiliar de laboratorio', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'ingeniero_proyectos@radioenlacesas.com', '', '3103010830', 'Carrera 35 # 41 a 18', '2021-12-01', '2022-05-31', '6caff3a471d6dd6cc403d1dc6f892dc1.png', '1988-01-16', 'Sura', 'Comfama', 'Sura', 'Protección', '01-12-2022 al 15-12-2022 \r\n', '', 1, 'MARZO 2022', 'LC02004431914', '2030-09-29', 0, '2-12-2021', 5, '0000-00-00', 1, '', '', 0),
(14, 'CE 1131673', 'Carmen Jesús Quijada González', 'Asistente administrativa', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'facturacionelectronica@radioenlacesas.com', '', '3218930123', 'Carrera 79 a calle 24 # 46', '2020-04-27', '0000-00-00', '4e4111f86005c1b656cc9132d7c62da3.png', '1983-11-30', 'Sura', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 27/04/2020 - 26/04/2021\r\nSegundo periodo: 27/04/2021 - 26/04/2022\r\n', '', 1, '11-03-2021', '', '0000-00-00', 0, '02-06-2021', 3, '0000-00-00', 0, '', '', 0),
(15, '15347940', 'José Alexis  Fernández  Piedrahita', 'Ingeniero electrónico', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'ingeniero_soporte1@radioenlacesas.com', '', '3137737361', 'Carrera 99 C # 48 B  40 bloque 8 apto 501', '2020-05-29', '0000-00-00', '03cdc203edb8275560138e4cfc8bf623.png', '1966-01-05', 'Sura', 'Comfama', 'Sura', 'Porvenir', 'Primer periodo: 29/05/2020 - 28/05/2021 \r\nSegundo periodo: 29/05/2021 - 28/05/2022 ', '', 0, '11-03-2021 ', 'LC03002681350', '2027-04-07', 0, '13-04-2021 / 17-06-2021', 5, '0000-00-00', 1, 'LC03002681350', '2022-01-10', 0),
(16, '1037652621', 'David Trujillo Lopera', 'Auxiliar de ingeniería', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'david.trujillo@radioenlacesas.com', '2761596', '3138396470', 'Calle 46 B sur # 37 04 Trianon, Envigado', '2021-06-18', '0000-00-00', '3c856dcc811ea1661a20ea9b3e987499.png', '1996-10-27', 'Sura', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 18/06/2021 - 17/06/2022', '', 0, '25-08-2021 / 22-02-2022', '', '0000-00-00', 0, '22-10-2021 / 1-10-2021 / 26-01-2022', 5, '0000-00-00', 1, '', '', 0),
(17, '1152194618', 'Kevin Vélez Sánchez', 'Técnico en radiocomunicaciones', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'kevin.velez@radioenlacesas.com', '', '3218958707', 'Diagonal 75 b # 01-289 calamari 1 casa 217', '2020-06-01', '0000-00-00', '55fc4b80803fbd4c6ab24f345908c996.png', '1991-12-09', 'Sura', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 01/06/2020 - 30/05/2021 \r\nSegundo periodo: 01/06/2021 - 30/05/2022 ', '', 1, '11-03-2021', 'LC01006662941', '2025-07-07', 0, '11-03-2021 / 11-05-2021 / 30-06-2021 / 22-06-2021 / 22-10-2021', 5, '0000-00-00', 1, '', '', 0),
(18, '1214748376', 'Gerardo Andrés Palomino Guarín', 'Auxiliar de laboratorio', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'andres.palomino@radioenlacesas.com', '', '3148395860', 'Carrera 51 # 95 30', '2020-12-04', '0000-00-00', '5d5c590ad68a6e2f2a07d43eb15503ed.png', '1999-12-03', 'Sura', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 04/12/2020 - 03/12/2021. Segundo periodo: 04/12/2022 -03/12/2023', '', 0, '03-12-2020 / 11-03-2021 / 14-04-2021 / 11-05-2021', '', '0000-00-00', 0, '03-12-2020 ', 3, '0000-00-00', 0, '', '', 0),
(19, 'CE 997140', 'Miguel Eduardo Castellanos Toro', 'Técnico en radiocomunicaciones', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'labtec1@radioenlacesas.com', '3125585732', '3103018000', 'Calle 43 # 90A -40 apto 404', '2019-06-15', '0000-00-00', 'd9c3f743ec85863b0187461c03730fcf.png', '1995-12-05', 'Sura', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 15/06/2019- 14/06/2020\r\nSegundo periodo: 15/06/2020 - 14/06/2021\r\nTercer periodo: 15/06/2021- 14/06/2022&quot;', '', 1, '15-07-2020 / 06-10-2020 / 11-03-2021', 'LC03003798550', '2029-11-05', 0, '20-08-2019 / 30-05-2019 / 20-09-2019 / 09-10-2019 / 06-10-2020 / 09-10-2020 / 15-04-2021 / 30-06-2021 / 22-06-2021', 5, '0000-00-00', 1, '', '', 0),
(21, '8310356', 'Hugo de Jesús Sánchez Patiño', 'Conductor', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'viticor968@hotmail.com', '5090353', '3137472746', 'Diagonal 75 b # 01-289 calamari 1 casa 217', '2010-01-01', '0000-00-00', '0e0288ba6622cd3c8aa9b8af21c4d8d3.png', '1944-08-04', 'Sura', 'Comfama', 'Sura', '', 'Primer periodo: 01/01/2010 - 31/12/2010 Segundo periodo:  01/01/2011 - 31/12/2011 Tercer periodo:  01/01/2012 - 31/12/2012 Cuarto periodo:  01/01/2013 - 31/12/2013 Quinto periodo:  01/01/2014 - 31/12/2014 Sexto periodo:  01/01/2015 - 31/12/2015 Séptimo  periodo: 01/01/2016 - 31/12/2016 Octavo periodo:  01/01/2017 - 31/12/2017 Noveno periodo:  01/01/2018 - 31/12/2018 Decimo periodo  01/01/2019 - 31/12/2019  Periodo once: 01/01/2020 - 31/12/2020 Periodo doce: 01/01/2021 - 31/12/2021 Periodo trece 01/01/2021 - 31/12/2022', '', 0, '09-10-2010 / 11-03-2021 / ', 'LC03003378397', '2023-10-30', 0, '20-01-2020 / 09-10-2020 /  14-03-2021 / 22-06-2021', 5, '0000-00-00', 1, '', '', 0),
(22, '71695030', 'Víctor Hugo Sánchez Duran', 'Conductor ', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'viticor968@hotmail.com', '5090353', '3137828690', 'Carrera 86 # 45 AA 55 barrio  floresta', '2008-08-19', '0000-00-00', '58999bbcc1c70ba582163e093f11863b.png', '1968-01-27', 'Sura', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 19/08/2008 - 18/08/2009 Segundo periodo: 19/08/2009 - 18/08/2010 Tercer periodo: 19/08/2010 - 18/08/2011 Cuarto periodo: 19/08/2011 - 18/08/2012 Quinto periodo: 19/08/2012 - 18/08/2013 Sexto periodo: 19/08/2013 - 18/08/2014 Séptimo periodo: 19/08/2014 - 18/08/2015 Octavo periodo: 19/08/2015 - 18/08/2016 Noveno periodo: 19/08/2016 - 18/08/2017 Decimo periodo: 19/08/2017 - 18/08/2018 Periodo once: 19/08/2018 - 18/08/2019 Periodo doce: 19/08/2019 - 18/08/2020 Periodo trece: 19/08/2020 - 18/08/2021 Periodo catorce: 19/08/2021 - 18/08/2022', '', 0, '15-09-2020 / 11-03-2021', 'LC2004304411', '2023-01-24', 0, '20-01-2021 / 19-04-2021', 4, '0000-00-00', 1, 'LC2004304411', '2028-10-29', 0),
(23, '1036608983', 'Pablo Andrés Suarez Valencia', 'Documentador y dibujante', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'soporte.doc@setronics.net', '3739518', '3226844346', 'Calle 40 # 51-56 Itagüí San Isidro', '2021-05-06', '0000-00-00', '06361b625c396a3c1157cfe2c23d1fed.png', '1987-07-23', 'Sura', 'Comfama', 'Sura', '', 'Primer periodo 06-05-2021 al 05-05-2022', '', 0, '07-02-2022', '', '0000-00-00', 0, '17-06-2021', 3, '0000-00-00', 1, '', '', 0),
(24, '98661287', 'Mario León Gómez Medina ', 'Auxiliar operativo', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'marioleongomezmedina87@gmail.com', '3113871163', '3003796483', 'Calle 72 # 27 AA 187', '2022-02-25', '0000-00-00', '3849f7b0ce0fd870543628142766b595.png', '1976-01-16', 'Nueva EPS', 'Comfama', 'Sura', 'Porvenir', '', '', 0, '', '', '0000-00-00', 0, '', 5, '0000-00-00', 1, '', '', 0),
(25, '3481253', 'Carlos Mario Martínez Marín', 'Conductor de grua', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'chente1955@hotmail.com', '', '3117389912', 'San Félix ', '2010-12-03', '0000-00-00', 'ecf05364fafba030bd825f73ba0d0876.png', '1955-04-14', 'Nueva EPS', 'Comfama', 'Sura', 'Protección', '', '', 0, '', '', '0000-00-00', 0, '', 4, '0000-00-00', 1, '', '', 0),
(26, '15400381', 'Manuel Guillermo Valenzuela Vargas', 'Conductor de grua', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'maguiva155@hotmail.com', '5803639', '3122979905', 'Carrera 65 # 42-67 Apt 302 ', '2013-07-11', '0000-00-00', '5c4696d52a711d2ba4b315b8d4d74c63.png', '1954-11-26', 'Sura', 'Comfama', 'Sura', 'Ninguno ', 'Primer periodo: 11/07/2013 - 10/07/2014 Segundo periodo: 11/07/2014 - 10/07/2015 Tercer periodo: 11/07/2015 - 10/07/2016 Cuarto periodo: 11/07/2016 - 10/07/2017 Quinto periodo: 11/07/2017 - 10/07/2018 Sexto periodo: 11/07/2018 - 10/07/2019 Séptimo periodo: 11/07/2019 - 10/07/2020 Octavo periodo: 11/07/2020 - 10/07/2021 Noveno periodo: 11/07/2021 - 10/07/2022', 'El trabajador ya se encuentra pensionado', 0, '02-12-2020 / 18-12-2020 / 02-08-2021 / 29-11-2021', 'LC02004929911', '2022-08-30', 0, '18-03-2020 / 04-11-2020 / 2-12-2020 / 02-08-2021 / 29-11-2021 ', 4, '2022-09-05', 1, 'LC02004929911', '2026-08-30', 0),
(27, '8407078', 'Oscar Darío Mejía Piedrahita', 'Conductor de grúa', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'oscar.dario22@hotmail.com', '3117639093', '3128405942', 'Calle 58 # 62-22', '2019-12-17', '0000-00-00', 'f722ab4882ed1dda9dd669c8bb48cdfe.png', '1962-06-22', 'Nueva EPS', 'Comfama', 'Sura', 'Protección', 'Primer periodo: 17/12/2019 - 16/12/2020 Segundo periodo: 17/12/2020 - 16/12/2021 ', '', 0, '16-12-2019 / 02-12-2020 / 07-04-2021 / 02-08-2021', '', '0000-00-00', 0, '16-12-2019 / 18-03-2020 / 01-10-2020/ 04-11-2020 / 02-12-2020 / ', 4, '2022-12-16', 1, '', '', 0),
(28, '3434464', 'Hugo de Jesús Correa Abello', 'Conductor de grua', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'hugoaries1953@gmail.com', '4967180', '3113329147', 'Calle 38 # 94-14 Santa Mónica', '2012-08-21', '0000-00-00', '1d4ce8c2d546eff0a7d745e860e1f53a.png', '1953-04-08', 'Sura', 'Comfama', 'Sura', 'Ninguna', 'Primer periodo: 21/08/2012 - 20/08/2013 Segundo periodo: 21/08/2013 - 20/08/2014 Tercer periodo: 21/08/2014 - 20/08/2015 Cuarto  periodo: 21/08/2015 - 20/08/2016 Quinto periodo: 21/08/2016 - 20/08/2017 Sexto periodo: 21/08/2017 - 20/08/2018 Séptimo periodo: 21/08/2018 - 20/08/2019 Octavo periodo: 21/08/2019 - 20/08/2020 Noveno periodo: 21/08/2020 - 20/08/2021', 'El trabajador ya esta pensionado', 0, '26-06-2020 / 02-12-2020 / 18-12-2020 / 07-04-2021 / 02-08-2021 / ', 'LC02004929927', '2022-08-30', 0, '01-10-2020 / 04-11-2020 / 18-03-2020 / 02-12-2020 / 16-06-2021 / 02-08-2021 / 29-11-2021 ', 4, '0000-00-00', 1, 'LC02004929927', '2022-01-10', 0),
(29, '1035861880', 'Cristian Camilo Gallego Zuleta', 'Conductor de grúa', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'zuletagallego15@hotmail.com', '3193577282', '3193577282', 'Calle 109 # 75-42  Florencia', '2019-09-19', '2022-05-25', '900496489636dc6c9220778e42065e06.png', '1992-09-11', 'Sura', 'Comfama', 'Sura', 'Colpensiones', 'Primer periodo: 19/09/2019 - 18/09/2020 Segundo periodo: 19/09/2020 - 18/09/2021', 'Renuncia el 25-05-2022', 0, '18-12-2020 / 02-12-2020 / 14-12-2020 / 07-04-2021 / 29-11-2021', 'LC07000520404', '2024-09-13', 0, '18-09-2019 / 18-06-2020 / 01-10-2020 / 04-11-2020/ 02-12-2020 / 02-08-2021 / 29-11-2021 ', 4, '2022-05-25', 0, 'LC07000520404', '2031-09-13', 0),
(30, '71668320', 'Luis Fernando Hernández Cano ', 'Conductor de grúa', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'fernando1965@hotmail.com', '3225963636', '3216717123', 'Carrera 101 # 100 A 12 Belén las Violetas', '2018-01-03', '0000-00-00', '2926efbc617c22dc4b65e5913187ae97.png', '1965-08-29', 'Sura', 'Comfama', 'Sura', 'Protección', '&quot;Primer periodo: 3/01/2018 - 2/01/2019\r\nSegundo periodo: 3/01/2019- 2/01/2020\r\nTercer periodo: 3/01/2020 - 02/01/2021\r\nCuarto periodo: 03/01/2021- 02/01/2022 Quinto periodo: 03/01/2022-02/01/2023&quot;', '', 0, '06-02-2019 / 31-05-2019 / 04-10-2019 / 16-09-2020 / 02-12-2020 / 18-12-2020 / 07-04-2021 / 02-09-2021 / 29-11-2021 / 24-01-2022', 'LC07000113537', '2023-06-24', 0, '06-02-2019 / 04-10-2019 / 16- 04-2020 / 16-06-2020 / 01-10-2020 / 04-11-2020 / 02-12-2020 / ', 4, '0000-00-00', 1, 'LC07000113537', '2028-07-27', 0),
(31, '12982962', 'Carlos Alfredo Pulzara Pachajoa', 'Conductor de grúa', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'carlosapulzarap07@gmail.com', '2898046', '3205969754', 'Km 21 autopista Norte, Girardota', '2020-02-04', '0000-00-00', '1d371625d9f529f885d74f063f535c54.png', '1964-08-09', 'Nueva EPS', 'Comfama', 'Sura', 'Colpensiones', 'Primer periodo: 04/02/2020 - 03/02/2021 Segundo periodo: 04/02/2021 - 03/02/2022', '', 0, '03-02-2020 / 02-12-2020 / 18-12-2020 / 07-04-2021 / 02-08-2021', 'LC06002547798', '2025-01-25', 0, '18-06-2020 / 01-10-2020 / 04-11-2020 /  02-12-2020 / 02-08-2021 / ', 4, '2022-09-24', 1, 'LC06002547798', '2024-01-10', 0),
(32, '1017223792', 'Melissa Velez Sánchez', 'Odontologa General', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 0, 'melissavelez@mecdental.co', '', '3043854240', 'Diagonal 75 B numero 1-289 casa 217 Urbanizacion Kalamari  1 etapa 1 ', '0000-00-00', '0000-00-00', '98e2cd212382773faef45593a70fbe9d.png', '1994-09-28', '', '', '', '', '', '', 0, '', '', '0000-00-00', 0, '', 5, '0000-00-00', 1, '', '', 0),
(33, '1036339627', 'Laura Stefania Álvarez Murcia ', 'Auxiliar MEC Dental ', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 0, 'recepcion@mecdental.co', '', '3103859571', '', '2021-09-25', '0000-00-00', '4e748fa0a17a2bc2c550eaf4e601f2c6.png', '0000-00-00', '', '', '', '', '', '', 0, '', '', '0000-00-00', 0, '', 1, '0000-00-00', 1, '', '', 0),
(34, '43272444', 'Janeth Catalina Romero Lozano', 'Contadora', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 3, 'contabilidad@radioenlacesas.com', '3147399290', '3103908693', 'Calle 55 Sur # 60 22 ', '2022-08-01', '0000-00-00', '08e2f8743f4aa7be015a352d862127ee.png', '1981-09-22', 'Sura', 'Comfama', 'Sura', 'Porvenir', '', 'Prestadora de servicios', 0, '', '', '0000-00-00', 0, '', 1, '0000-00-00', 1, '', '', 0),
(35, '1000884094', 'Brian Ospina Montoya', 'Conductor de grúa ', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'brian723ospina@gmail.com', '4716108', '3113122686', 'Calle 98 A # 65 95', '2022-06-01', '0000-00-00', 'f9598c794fefb21fd7ca053b73813c62.png', '1998-01-27', 'Sura', 'Comfama', 'Sura', 'Porvenir', 'Primer periodo: 01/06/2022 - 31/05/2023', '', 0, '02/06/2022', 'LCO6001678080', '2023-06-17', 0, '02/06/2022', 4, '0000-00-00', 1, '', '', 0),
(36, '1034988081', 'Alejandra Colorado Sanchez', '', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'alejacolorado@gmail.com', '', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', 0, '', '', '0000-00-00', 0, '', 3, '0000-00-00', 1, '', '', 0),
(37, '43655530', 'Olga Lucia Valencia Lopez', 'Servicios generales', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, '', '4444280', '', 'Carrera 27# 37 b sur 21', '2022-06-01', '0000-00-00', '', '1981-09-09', 'Nueva EPS', 'Comfama', 'Sura', 'Porvenir', '', '', 0, '', '', '0000-00-00', 0, '', 3, '0000-00-00', 1, '', '', 0),
(38, '1128404557', 'Juan Pablo Cadavid Muñoz', 'Asesor', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'asesorprofsst.cadavid@gmail.com', '', '3015353766', 'Calle 65 AA # 43 24 Apt 202', '2021-01-12', '0000-00-00', 'b1b7c3ccdc1a73663370b7a5f055c88e.png', '1986-08-02', 'Sura', 'Comfama', 'Sura', 'Protección', '', '', 0, '', '', '0000-00-00', 0, '', 5, '0000-00-00', 1, '', '', 0),
(39, '52959060', 'Andrea Bolivar Suarez', 'Auxiliar contable', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'andreabolivar2507@gmail.com', '3156487594', '3214966549', 'Calle 54 # 86 A 60', '2022-06-23', '0000-00-00', '0e127ea5d07b263ef1d6d2248e960a30.png', '1983-07-25', 'Sura', 'Comfama', 'Sura', 'Porvenir', '', '', 0, '', '', '0000-00-00', 0, '', 3, '0000-00-00', 1, '', '', 0),
(40, '1035391890', 'Juan David Sossa Tamayo', 'Conductor de grúa ', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'juan-st97@hotmail.com', '8631828', '3137350494', 'Cisneros', '2022-07-27', '0000-00-00', '36fb3c6480fe30f160224214b9d8e77b.png', '1997-05-09', 'Nueva EPS', 'Comfama', 'Sura', 'Porvenir', '', '', 0, '', 'LCO7000173026', '2023-09-23', 1, '', 5, '0000-00-00', 1, '', '', 0),
(41, '1020466435', 'Daniel Esteban Alzate Zapata', 'Conductor de grúa ', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'leinad9903@gmail.com', '3207539313', '3112590677', 'Cisneros', '2022-09-19', '0000-00-00', '05bc50a59944bfb855270fe2993d139a.png', '1995-03-01', 'Savia salud', 'Comfama', 'Sura', 'Protección', '', '', 0, '', 'LCO6001816536', '2024-10-09', 0, '', 5, '0000-00-00', 1, '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_viatico`
--

CREATE TABLE `empleados_viatico` (
  `id` int(11) NOT NULL,
  `id_viatico` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_equivalentes`
--

CREATE TABLE `gastos_equivalentes` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `anexo_factura` varchar(100) NOT NULL,
  `numero_factura_recibida` varchar(50) NOT NULL,
  `subtotal` float NOT NULL,
  `iva` float NOT NULL,
  `retencion` float NOT NULL,
  `total` float NOT NULL,
  `descuento` float NOT NULL,
  `visto_bueno` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `tiene_retencion` int(11) NOT NULL,
  `visto_bueno2` int(11) DEFAULT NULL,
  `visto_bueno3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_fijos`
--

CREATE TABLE `gastos_fijos` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `anexo_factura` varchar(100) NOT NULL,
  `numero_factura_recibida` varchar(50) NOT NULL,
  `subtotal` float NOT NULL,
  `iva` float NOT NULL,
  `retencion` float NOT NULL,
  `total` float NOT NULL,
  `descuento` float NOT NULL,
  `visto_bueno` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `tiene_retencion` int(11) NOT NULL,
  `visto_bueno2` int(11) DEFAULT NULL,
  `visto_bueno3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_varios`
--

CREATE TABLE `gastos_varios` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `anexo_factura` varchar(100) NOT NULL,
  `numero_factura_recibida` varchar(50) NOT NULL,
  `subtotal` float NOT NULL,
  `iva` float NOT NULL,
  `retencion` float NOT NULL,
  `total` float NOT NULL,
  `descuento` float NOT NULL,
  `visto_bueno` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `tiene_retencion` int(11) NOT NULL,
  `visto_bueno2` int(11) DEFAULT NULL,
  `visto_bueno3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto_id`, `serial`, `cantidad`, `status`, `created_by`, `created_at`) VALUES
(9, 1, '655656', 1, 0, 1, '2023-01-26 09:00:33'),
(10, 1, '4444', 1, 1, 1, '2023-01-27 07:47:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2022_12_26_111942_create_task_projects_table', 1),
(6, '2022_12_26_112123_create_statuses_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE `movimientos_inventario` (
  `id` int(11) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '0=Compra\r\n1=ReIngreso\r\n2=Alquiler\r\n3=Asignado\r\n4=Prestado\r\n5=Instalado\r\n6=Vendido\r\n7=Dado de baja',
  `inventario_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `precio_venta` varchar(255) DEFAULT NULL,
  `precio_compra` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`id`, `tipo`, `inventario_id`, `almacen_id`, `cantidad`, `empleado_id`, `cliente_id`, `proveedor_id`, `precio_venta`, `precio_compra`, `observaciones`, `created_by`, `created_at`) VALUES
(8, 0, 9, 257, 1, NULL, NULL, 4, '3333', '66353535', NULL, 1, '2023-01-26 09:00:33'),
(9, 4, 9, 16, 1, NULL, 25, NULL, NULL, NULL, NULL, 1, '2023-01-26 09:00:52'),
(10, 0, 9, 258, 1, NULL, NULL, 7, NULL, NULL, NULL, 1, '2023-01-26 09:44:30'),
(11, 0, 10, 284, 1, NULL, NULL, 20, '3333', NULL, NULL, 1, '2023-01-27 07:47:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id` int(11) NOT NULL,
  `id_trabajador` int(11) DEFAULT NULL,
  `sueldo` float DEFAULT 0,
  `dia_trabajo` float DEFAULT 0,
  `dias_laborados` int(11) DEFAULT 0,
  `quincena` float DEFAULT 0,
  `extras` float DEFAULT 0,
  `subsidio_transporte` float DEFAULT 0,
  `transporte_adicional` float DEFAULT 0,
  `incapacidad_retroactivo` float DEFAULT 0,
  `total_devengado` float DEFAULT 0,
  `salud` float DEFAULT 0,
  `pension` float DEFAULT 0,
  `fsp` float DEFAULT 0,
  `seg_vida` float DEFAULT 0,
  `credito_comfa` float DEFAULT 0,
  `retencion_fte` float DEFAULT 0,
  `total_global` float DEFAULT 0,
  `porcentaje_fte` float DEFAULT 0,
  `porcentaje_fsp` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_nomina`
--

CREATE TABLE `novedades_nomina` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `desde` datetime DEFAULT NULL,
  `hasta` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `dias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_new`
--

CREATE TABLE `permisos_new` (
  `id` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  `modulo` varchar(255) NOT NULL,
  `administrador` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos_new`
--

INSERT INTO `permisos_new` (`id`, `empleado`, `modulo`, `administrador`, `fecha`) VALUES
(955, 6, 'ver_asignaciones', 1, '2023-01-10 10:58:26'),
(956, 6, 'ver_asignaciones_proyectos', 1, '2023-01-10 10:58:26'),
(957, 6, 'ver_actividades', 1, '2023-01-10 10:58:26'),
(958, 6, 'ver_puntos', 1, '2023-01-10 10:58:26'),
(7057, 1, 'ver_asignaciones', 1, '2023-01-27 11:59:05'),
(7058, 1, 'gestion_asignacion', 1, '2023-01-27 11:59:05'),
(7059, 1, 'gestion_puntos', 1, '2023-01-27 11:59:05'),
(7060, 1, 'ver_asignaciones_proyectos', 1, '2023-01-27 11:59:05'),
(7061, 1, 'gestion_asignaciones_proyectos', 1, '2023-01-27 11:59:05'),
(7062, 1, 'gestion_puntos_proyectos', 1, '2023-01-27 11:59:05'),
(7063, 1, 'ver_actividades', 1, '2023-01-27 11:59:05'),
(7064, 1, 'gestionar_actividades', 1, '2023-01-27 11:59:05'),
(7065, 1, 'ver_puntos', 1, '2023-01-27 11:59:05'),
(7066, 1, 'gestionar_puntos', 1, '2023-01-27 11:59:05'),
(7067, 1, 'ver_vehiculos', 1, '2023-01-27 11:59:05'),
(7068, 1, 'gestion_vehiculos', 1, '2023-01-27 11:59:05'),
(7069, 1, 'enviar_checklist_vehiculos', 1, '2023-01-27 11:59:05'),
(7070, 1, 'gestion_checklist_vehiculos', 1, '2023-01-27 11:59:05'),
(7071, 1, 'gestion_salud_vehiculos', 1, '2023-01-27 11:59:05'),
(7072, 1, 'ver_clientes', 1, '2023-01-27 11:59:05'),
(7073, 1, 'add_clientes', 1, '2023-01-27 11:59:05'),
(7074, 1, 'edit_clientes', 1, '2023-01-27 11:59:05'),
(7075, 1, 'anexos_clientes', 1, '2023-01-27 11:59:05'),
(7076, 1, 'eliminar_clientes', 1, '2023-01-27 11:59:05'),
(7077, 1, 'ver_empleados', 1, '2023-01-27 11:59:05'),
(7078, 1, 'add_empleados', 1, '2023-01-27 11:59:05'),
(7079, 1, 'edit_empleados', 1, '2023-01-27 11:59:05'),
(7080, 1, 'anexos_empleados', 1, '2023-01-27 11:59:05'),
(7081, 1, 'clave_empleados', 1, '2023-01-27 11:59:05'),
(7082, 1, 'novedades_empleados', 1, '2023-01-27 11:59:05'),
(7083, 1, 'nomina_empleados', 1, '2023-01-27 11:59:05'),
(7084, 1, 'ver_proveedores', 1, '2023-01-27 11:59:05'),
(7085, 1, 'add_proveedores', 1, '2023-01-27 11:59:05'),
(7086, 1, 'edit_proveedores', 1, '2023-01-27 11:59:05'),
(7087, 1, 'anexos_proveedores', 1, '2023-01-27 11:59:05'),
(7088, 1, 'gestion_categorias_inventario', 1, '2023-01-27 11:59:05'),
(7089, 1, 'gestion_almacenes_inventario', 1, '2023-01-27 11:59:05'),
(7090, 1, 'gestion_productos_inventario', 1, '2023-01-27 11:59:05'),
(7091, 1, 'gestion_inventario', 1, '2023-01-27 11:59:05'),
(7092, 1, 'gestion_actividades_inventario', 1, '2023-01-27 11:59:05'),
(7093, 1, 'delete_existencias_inventario', 1, '2023-01-27 11:59:05'),
(7094, 1, 'gestion_productos_baja', 1, '2023-01-27 11:59:05'),
(7095, 1, 'gestion_repuestos_reparacion', 1, '2023-01-27 11:59:05'),
(7096, 1, 'gestion_ventas', 1, '2023-01-27 11:59:05'),
(7097, 1, 'gestion_prestamos', 1, '2023-01-27 11:59:05'),
(7098, 1, 'gestion_alquileres', 1, '2023-01-27 11:59:05'),
(7099, 1, 'gestion_productos_asignados', 1, '2023-01-27 11:59:05'),
(7100, 1, 'solicitud_elementos', 1, '2023-01-27 11:59:05'),
(7101, 1, 'gestion_solicitudes', 1, '2023-01-27 11:59:05'),
(7102, 1, 'devolver_elementos', 1, '2023-01-27 11:59:05'),
(7103, 1, 'gesion_categorias_proyectos', 1, '2023-01-27 11:59:05'),
(7104, 1, 'gestion_proyectos', 1, '2023-01-27 11:59:05'),
(7105, 1, 'gestion_actas_proyectos', 1, '2023-01-27 11:59:05'),
(7106, 1, 'firma_cliente_proyectos', 1, '2023-01-27 11:59:05'),
(7107, 1, 'visto_bueno_proyectos', 1, '2023-01-27 11:59:05'),
(7108, 1, 'gestion_categorias_seguimientos', 1, '2023-01-27 11:59:05'),
(7109, 1, 'gestion_seguimientos', 1, '2023-01-27 11:59:05'),
(7110, 1, 'gestion_actas_seguimientos', 1, '2023-01-27 11:59:05'),
(7111, 1, 'visto_bueno_seguimientos', 1, '2023-01-27 11:59:05'),
(7112, 1, 'gestion_reparaciones', 1, '2023-01-27 11:59:05'),
(7113, 1, 'ver_reparaciones_asignadas', 1, '2023-01-27 11:59:05'),
(7114, 1, 'generar_informes_reparaciones', 1, '2023-01-27 11:59:05'),
(7115, 1, 'devolver_repuesto_reparacion', 1, '2023-01-27 11:59:05'),
(7116, 1, 'categorias_archivos', 1, '2023-01-27 11:59:05'),
(7117, 1, 'gestion_archivos', 1, '2023-01-27 11:59:05'),
(7118, 1, 'gestion_documentos', 1, '2023-01-27 11:59:05'),
(7119, 1, 'gestion_orden_compra', 1, '2023-01-27 11:59:05'),
(7120, 1, 'completar_orden_compra', 1, '2023-01-27 11:59:05'),
(7121, 1, 'enviar_orden_compra', 1, '2023-01-27 11:59:05'),
(7122, 1, 'eliminar_orden_compra', 1, '2023-01-27 11:59:05'),
(7123, 1, 'gestionar_cotizaciones', 1, '2023-01-27 11:59:05'),
(7124, 1, 'completar_cotizaciones', 1, '2023-01-27 11:59:05'),
(7125, 1, 'enviar_cotizaciones', 1, '2023-01-27 11:59:05'),
(7126, 1, 'eliminar_cotizaciones', 1, '2023-01-27 11:59:05'),
(7127, 1, 'gestionar_remisiones', 1, '2023-01-27 11:59:05'),
(7128, 1, 'completar_remisiones', 1, '2023-01-27 11:59:05'),
(7129, 1, 'enviar_remisiones', 1, '2023-01-27 11:59:05'),
(7130, 1, 'eliminar_remisiones', 1, '2023-01-27 11:59:05'),
(7131, 1, 'gestion_facturacion', 1, '2023-01-27 11:59:05'),
(7132, 1, 'completar_facturas', 1, '2023-01-27 11:59:05'),
(7133, 1, 're_abrir_facturas', 1, '2023-01-27 11:59:05'),
(7134, 1, 'anular_facturas', 1, '2023-01-27 11:59:05'),
(7135, 1, 'gestion_causaciones', 1, '2023-01-27 11:59:05'),
(7136, 1, 'enviar_facturas', 1, '2023-01-27 11:59:05'),
(7137, 1, 'detalles_facturas', 1, '2023-01-27 11:59:05'),
(7138, 1, 'eliminar_facturas', 1, '2023-01-27 11:59:05'),
(7139, 1, 'estadistica_proveedores', 1, '2023-01-27 11:59:05'),
(7140, 1, 'estadisticas_ventas', 1, '2023-01-27 11:59:05'),
(7141, 1, 'estadisticas_orden_compra', 1, '2023-01-27 11:59:05'),
(7142, 1, 'informes_contables', 1, '2023-01-27 11:59:05'),
(7143, 1, 'gestion_viaticos', 1, '2023-01-27 11:59:05'),
(7144, 1, 'gestion_nomina_general', 1, '2023-01-27 11:59:05'),
(7145, 1, 'gestion_config_nomina_general', 1, '2023-01-27 11:59:05'),
(7146, 1, 'gestion_arrendamientos', 1, '2023-01-27 11:59:05'),
(7147, 1, 'gestion_gastos_varios', 1, '2023-01-27 11:59:05'),
(7148, 1, 'gestion_gastos_fijos', 1, '2023-01-27 11:59:05'),
(7149, 1, 'gestion_gastos_equivalentes', 1, '2023-01-27 11:59:05'),
(7150, 1, 'configuracion_sistema', 1, '2023-01-27 11:59:05'),
(7151, 1, 'permisos_usuarios', 1, '2023-01-27 11:59:05'),
(7152, 1, 'categorias_calendario', 1, '2023-01-27 11:59:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `cod_producto` varchar(255) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `sub_categoria` int(11) DEFAULT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `observaciones` text NOT NULL,
  `created_at` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `cod_producto`, `id_creador`, `categoria`, `sub_categoria`, `marca`, `modelo`, `nombre`, `imagen`, `observaciones`, `created_at`, `status`) VALUES
(1, 'PR-A6A417AP	', 1, 87, 9, 'MOTOROLA', '15455', 'PRO', 'noimagen.png', 'Excelente', '2023-01-13', 1),
(2, 'PR-J6A417MP', 1, 87, 14, 'MOTOROLA', 'POCK', 'PLUS', '2109897227804105317.jpg', 'Muy buenoo', '2023-01-13', 1),
(3, 'PR-SV5XWPL3', 1, 88, 13, 'MOTOROLA', '545154', 'PLUS PRO', '2036538564753935264.png', '', '2023-01-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nit` varchar(50) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `telefono_fijo` varchar(100) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `observaciones` text NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `codigo_verificacion` int(11) NOT NULL,
  `tipo_regimen` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `email_comercial` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nit`, `razon_social`, `direccion`, `telefono_fijo`, `celular`, `contacto`, `email`, `observaciones`, `avatar`, `codigo_verificacion`, `tipo_regimen`, `estado`, `ciudad`, `email_comercial`) VALUES
(4, '900382335', 'Radiotrans Colombia S.A.S', 'Carrera 71 Circular 1 - 42', '(604) 4481991', '3137487534', 'Martha Liliana Leon', 'mleon@radiotrans.com', '', 'bfbcb18259412a2d6ec5884d55437a6c.png', 5, '', 1, 'Medellín', ''),
(5, '800162165', 'Sistemas Electrónicos y Telecomunicaciones S.A.S', 'Carrera 33 No. 62 - 34', '(601) 6433825', '3114772496', 'David Roldan', 'david.roldan@sistelec.com.co', '', '08b883f641ae8473d574cdbec7221fe8.png', 3, '', 1, '', ''),
(6, '901192317', 'Syscom Colombia S.A.S', 'Cra. 90A No. 64C 38 Álamos Norte', '(601) 7443650', '3147209764', 'William Cárdenas', 'luis@syscomcolombia.com', '', '8d07ce149e754e0c0d7c96075b8db3e2.png', 0, '', 1, '', ''),
(7, '890941103', 'Equielect S.A.S', 'Carrera 72 No. 30-53', '(604) 4443133', '', '', 'equielect@equielect.com.co', '', '7c101e2faed734ec911ce2ffe4290d22.png', 7, '', 1, '', ''),
(8, '830079015', 'Meltec Comunicaciones S.A', 'CL 130A # 58A 29', '(601) 4111899 ', '3143956689', 'Alejandro Arango', 'cartera@meltec.com.co', '', 'e817c1d6da72e09bdb041b3379421e39.png', 1, '', 1, '', ''),
(9, '800170775', 'Transmicosta S.A.S', 'CL 75 58 48', '(605) 3689050', '3157187962', 'Cecilia Danies', 'gerencia@transmicosta.com', '', '138ea9cb785d4a19b9e5d64eaffaf185.png', 1, '', 1, '', ''),
(11, '900245554', 'Amarillo LTDA', 'Calle 8C N° 87B - 40 oficina 223', '(601)7460018 EXT 03', '(601) 7460018', 'Gloria Díaz', ' admon.amarilloltda@gmail.com', '', '9ad2a29267149e68f27582cefb4c0172.png', 5, '', 1, '', ''),
(12, '890913902', 'Antioqueña de Automotores y Repuestos S.A.S  ANDAR', 'CARRERA 77 N° 28 - 13 BELEN', '(604) 4440800', '3213139234', 'Leonardo Vásquez', 'leonardo.velasquez@andar.com.co', '', '0638eaa95b618e76d814eac90f0974f6.png', 6, '', 1, '', ''),
(13, '98490197', 'Baterías JV', 'Diagonal 44 31 41', '', '3155182035', 'Marcela', 'ventasbateriasjv@gmail.com', '', '7b552d80ddb53403e0536b78794e6915.png', 1, '', 1, '', ''),
(14, '900413864', 'Calza Soluciones ', 'Carrera 67 A N°51-79', '(604) 4488584', '3175163310', 'Melissa', 'comercial@radioenlacesas.com', '', '829763b900cba9a5063863f49f896808.png', 4, '', 1, '', ''),
(15, '900722974', 'Copimarks S.A.S', 'Carrera 78 45 E 61', '(604) 4482874', '3105025201 / 3134909757', 'Jorge Sánchez', 'copimarks@gmail.com', '', '33aa09f76666e6e2e51e96ba775416b7.png', 1, '', 1, '', ''),
(16, '811015782', 'Elian Comunicaciones y Montajes S.A.S', 'Calle 36 SA Sur N° 46 A 81 Of. 237', '(604) 3317287', '31038372530', 'Cesar Hoyos', 'eliancomunicaciones@hotmail.com', '', '0ac198f3fd1f3db014321505bab757a7.png', 9, '', 1, '', ''),
(18, '10883737', 'Juan Eduardo Alvarado Solorzano', 'Carrera 52, Calle 82 -24 Medellín', '(604) 2131785', '', 'Juan Alvarado', 'metrofuego@une.net.co', '', 'c19fa572fa0ad7d5081b9841c8234a36.png', 4, '', 1, '', ''),
(19, '900323290', 'Estación de Servicio Estrella del Norte S.A.S', 'Aut. Norte KM 16 Vda. Zarzal', '(604) 4480313 / 4015252', '', 'Sebastián Vélez', 'edsestrelladelnorte@une.net,co', '', '42e2a66f84519c31f1904a26fd7a43e3.png', 0, '', 1, '', ''),
(20, '860500630', 'Isec', 'Carrera 43A # 14 -27 Oficina 202', '(604) 2666434', '3153838392', 'Luz Stella Vásquez ', 'stella.vasquez@isec.com.co', '', '87a7a92578531a3c8ba5778a1a6f927f.png', 6, '', 1, '', ''),
(21, '900225832', 'Luchos Lujomania LTDA', 'Carrera 64 N° 42B - 31', '(604) 4082320 / 4087942', '', 'Alexandra Restrepo', 'contacto@luchoslujomania.com', '', '98c016f888a2f9257dc9d9ae9143093a.png', 2, '', 1, '', ''),
(22, '811000995', 'Mas Frenos S.A.S', 'Calle 30 A 65 B 66', '(604) 4798744 / 4798461', '', 'German Hernández', 'masfrenos@gmail.com', '', '551c5c6b0068c144a559fe35e3467522.png', 0, '', 1, '', ''),
(23, '901436594', 'Inversiones Mas Repuestos S.A.S', 'Carera 61 N°45 - 08', '', '3003641449 / 3007631988', 'Karen', 'masrepuestos@gmail.com', '', '6beb3c5bb911d29e684faf35564e7d06.png', 3, '', 1, '', ''),
(24, '901446306', 'Grupo Empresarial ADSL S.A.S', 'Calle 48 # 10-45 CC Monterrey Loc. 315-316', '(604) 6090123', '3122510095', 'Mauricio Franco', 'm.franco@grupoadsl.com', '', '', 1, '', 1, '', ''),
(25, '900585869', 'Mega Storage Colombia S.A.S', 'Calle 8 B N° 65 251', '(604) 6051525', '3216390098', 'Yurani Mendez', 'contabilidad@megastorage.com.co', '', 'a261bf5349156150b4d68835d461b52e.png', 8, '', 1, '', ''),
(26, '900744916', 'Mundirepuestos  del Norte S.A.S', 'Diagonal 52 N° 15 A 351 - Interior 5 Centro Logístico del Norte - Bello', '(604) 3666709', '3113555851', 'Carolina Castro', 'administracion@mundirepuestosdelnorte.com.co', '', 'a04872500ff3a5c3469bc04ff4f7f871.png', 9, '', 1, '', ''),
(27, '900986403', 'Radiofrecuencia e Ingeniería en Comunicaciones S.A.S', 'Carrera 37 B N° 1 G  - 20', '(601) 3843687', '3102256990', 'William Marín', 'williammartincom@gmail.com', '', '5e4adc3438c110f95dc526885b0bad77.png', 0, '', 1, '', ''),
(28, '900906969', 'Soluciones en Seguridad y Salud en el Trabajo S3 S.A.S', 'Carera 53 N°  36 - 35', '(604) 4796057', '3044783532', 'Laura', 'cartera3soluciones@gmail.com', '', 'a6fcc619567ef2feef6e591d852dd027.png', 5, 'Común', 1, 'Medellín', 'foracionalturas@s3soluciones.com.co'),
(29, '900265297', 'Sociedad de Seguridad Electrónica y Telecomunicaciones S.A.S', 'Av. Carera 20 N° 85 A - 21', '(601) 4321757', '3125085416 / 3115446076', 'Lucia González / Diany Delgado', 'contabilidad@setronics.net', '', 'fa966e69754c8fb7701fc5d3714641ea.png', 2, 'Común', 1, 'Bogotá', 'consultor.diany@setronics.net'),
(30, '890942699', 'Almacén Sus Llantas S.A.S', 'Carrera 59 N° 48 - 20 Barrio Triste', '(604) 5112424', '3215112424', 'Ana Gil', 'conta.susllantas@une.net.co', '', 'b339711c7a2df622bf33b12b4dc66d07.png', 9, 'Común', 1, 'Medellín', 'facturacionsusllantas@gmail.com'),
(31, '900034424', 'Electrónica  I+D S.A.S ', 'Calle 48 D N° 65 A - 35', '(604) 6073333', '3159282544', '', 'administrtivo@didacticaselectronicas.com', '', 'd7797cb044065303b7982449bf23457e.png', 0, '', 1, '', ''),
(32, '900597685', 'Sustento Jurídico ', 'Calle 8 B N° 65 167', '(604) 4199704', '3104415759', 'Edison Garcia', 'edisongarcia@sustentojuridico.com', '', '9ef3a8963714462abc64b441a3ae6a40.png', 1, '', 1, '', ''),
(33, '900037505', 'Felda S.A', 'Calle 30 A N° 69 C - 11', '(604) 2350517', '3117229415', 'Francia Zapata', 'primaxbelenauxiliar@gmail.com', '', '', 2, 'Común', 1, 'Medellín', ''),
(34, '800224025', 'Tablecol S.A.S', 'Carrera 56 N° 29-72 ', '(604) 44083129', '3104525720 / 3122581879', 'Margoth Rincon', 'cartera@tablecol.com.co', '', 'e0ad738367faee457a6d7eb79e105e62.png', 8, 'Común', 1, 'Medellín', ''),
(35, '900529671', 'Ferretería Servillaves la 30 S.A.S', 'Calle 30 N° 75-04', '(604) 4449471', '3148851469', '', 'servillavesla30@une.net.co', '', 'd7beaa386ac040062c8aef0bc3664b78.png', 9, 'Común', 1, 'Medellín ', ''),
(36, '900653389', 'Grupo Empresarial Camaleón S.A.S', 'Calle 30 N° 74-77', '(604) 5821080', '3041733035', '', 'pinturaselcamaleondela30@gmail.com', '', '88aa84cb01113f26141423fe28a2c96c.png', 6, 'Común', 1, 'Medellín', ''),
(37, '830504313', 'Radio Enlace S.A.S', 'Calle 27 N°81 - 70 Belén la Palma', '(604) 4448280', '3116307079', 'Oscar Sánchez ', 'facturacionelectronica@radioenlacesas.com', '', 'e5f8af09c439c8602ceab505144e8879.png', 5, 'Común', 1, 'Medellín', 'gcomercial@radioenlacesas.com'),
(38, '901248086', 'Uno A Tecnología S.A.S', 'Calle 14 # 48-33 CC. Monterrey Local 380A ', '(604) 4441818', '', '', 'www.unoacomputadores.com', '', '76726cc66c2b4bbe4efe00f0df965afe.png', 7, 'Común', 1, 'Medellín', ''),
(39, '800242106', 'Sodimac Colombia S.A.', 'Calle 30 A N° 82 A - 26', '', '3208899933', '', 'servicioalcliente@corp.homecenter.cpm.co', '', '61689d16f9f015cf10096e217d9143be.png', 2, 'Común', 1, 'Medellín', ''),
(40, '900525717', 'Almacén LCC S.A.S', 'Cra. 65 No. 8 B 91 LC174', '3611263', '', '', 'contabilidad.lcc@dotakondor.com', '', '18a4b3c5eef3d3e8a22a795637fc7c72.png', 0, 'Juridico', 1, 'Medellín ', ''),
(41, '900933129', 'Meca S.A.S', 'Cra. 54 No. 29c120 loc 101', '5017013', '3117655802', '', 'meca701@hotmail.com', '', '7e93e958bf92c10b91b7378cf01eec5e.png', 1, 'Juridico', 1, 'Medellín ', ''),
(42, '43094755', 'Moto Veloz', 'Cl 38 No. 51-32', '2328265', '', '', '', '', 'cbbc9342f18b9ba5c51dab8873e3de5f.png', 1, 'Juridico', 1, 'Medellín ', ''),
(43, '900702001', 'Fénix Producciones S.A.S', 'Cl 49 No. 67 A 32', '4482246', '2304408', '', 'info♠fenixcomercial.com.co', '', '13ed291c09189f15fc05994b080c20f7.png', 5, 'Juridico', 1, 'Medellín ', ''),
(44, '800227071', 'Tornifer S.A.S', 'Cl 30 No. 54-11', '3228015', '3137466', '', '', '', 'b7b02797d0b7410fe16c7b9685be934f.png', 0, '', 1, 'Medellín ', ''),
(45, '890943055', 'Suconel Suministros y Controles Electronicos', 'Cra 53 No. 50 - 51 Of 506', '4487830', '3012578952', 'Suconel', 'suconel@suconel.com', '', 'df0a29132fca02bc7fa1c2971e4fbf42.png', 0, 'Juridico', 1, 'Medellín ', ''),
(46, '800147520', 'Compel  S.A Tecnología &amp; Vigilancia ', 'Cra 70 No. 32b -147', '3512492', '3006351247', 'Compel', 'Compel@compel.com.co', '', '5347b32148d744287cb069a0984a799f.png', 2, 'Juridico', 1, 'Medellín ', ''),
(47, '890922294', 'Protokimica S.A.S', 'Cra 56b No. 49-58', '4448787', '3117192216', 'Efren Villalba ', 'protokimica@une.net.co', '', '0d38a412b45f03cd3d5eddfeadb4d242.png', 4, 'Juridico', 1, 'Medellín ', ''),
(48, '900529671', 'Ferretería Serví Llaves la 30', 'Cl 30 # 75-04', '4449471', '3148851469', 'Jairo León Álvarez ', 'servillavezla30@une.net.co', '', '455aa1c12281e108f6f3df4456755fe1.png', 9, 'Juridico', 1, 'Medellín ', ''),
(49, '900434009', 'Macrotics S.A.S', 'Carrera 50 C 10 sur 35 BRR la Aguacatala', '6048418828', '3330333228', 'Jaime García', 'ventas@macrotics.com', '', '1962dbc1e33a9ee7d07aeded0e9e32e1.png', 3, 'Común', 1, 'Medellín', ''),
(50, '900164446', 'Grupo Empresarial de Radiocomunicaciones E.U.', 'Calle 79B N 69 R-28', '6012516969', '3124347142', 'Jaime Hernández', 'radiotelefonos@hotmail.com', '', '66541273565ad7d34453f484ae6225a0.png', 1, 'Común', 1, 'Bogotá', ''),
(51, '811039882', 'Comercializadora Jagir S.A.S', 'Cra  52 #38-58', '', '3157804512', '', '', '', 'ea54ab55a65a9519a3a97cad065e8213.png', 0, '', 1, 'Medellín ', ''),
(52, '900458715', 'Uricamperos &amp; Diesel  S.A.S', 'Cra 51 No 39-21', '3229673', '3122574274', '', 'ventas@uricamperos.com', '', 'e38fe9b8f6f32d71ed86968ba9bb323a.png', 9, '', 1, '', ''),
(53, '2684800', 'Jairo Vásquez', 'Medellín', '2684800', '', 'Jairo Vásquez', '', 'Cta. Ahorros Bancolombia 10349100332  //  \r\nCliente Seguridad de Colombia  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Medellín', ''),
(54, '15381163', 'Luis Antonio Giraldo Rincón', 'CALLE 27 81 70', '3054551899', '3006659005', 'Luis Antonio Giraldo', 'comercial@radioenlacesas.com', 'Cta. Ahorros Bancolombia 10309362858  / /  \r\nCliente Masivos de Occidente  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 57, 'Simplificado', 1, 'Medellín', ''),
(55, '70257077', 'Edwar Ernesto Gallego', 'Cerro el Rubí - Yolombo', '', '3504869245', 'Edwar Ernesto Gallego', '', 'Cta. Ahorros Bancolombia 0-7299667612 //  \r\nCliente Vinus  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Yolombo', ''),
(56, '3401378', 'Miguel Vahos', 'Cerro Horizonte', '', '3103790947', 'Miguel Vahos', '', 'Cta. Ahorros Bancolombia 41867033597  / /  \r\nCliente Continental Gold  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Horizonte', ''),
(57, '3669716', 'Alfonso Tapias Machado', 'Finca el Mico, Remedios.', '', '3137968328', 'Alfonso Tapias Machado', '', 'Cta. Ahorros Bancolombia62527282204  //  \r\nCliente Conexión Norte, Grupo Ortiz, Intramaq y Atempi  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Remedios', ''),
(58, '15421478', 'Luis Alberto Pérez Arboleda', 'Finca Boquerón', '', '', 'Luis Alberto Pérez Arboleda', '', 'Cta. Ahorros Banco Bogotá  //  \r\nCliente Seracis  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Bogotá', ''),
(59, '21580004', 'Belarmina Durango', 'Cerro Cativo', '', '3217582751', 'Belarmina Durango', '', 'Cta. Ahorros CFC 0-1201053377  //  \r\nCliente Continental Gold y Atempi  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Cativo', ''),
(60, '43905052', 'Beatriz Correa', 'Cerro Toto ', '', '3127238853', 'Beatriz Correa', '', 'Cta. Ahorro a la Mano 13127238853  //  \r\nCliente Seracis  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Mutata', ''),
(61, '1128452089', 'Esneider Espinosa ', 'Cerro la Meseta', '', '3007729918', 'Esneider Espinosa', '', 'Cta. Ahorros Bancolombia 1560885543  / /  \r\nCliente Consorcio R&amp;S  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Titiribí', ''),
(62, '8415976', 'José Ignacio Higuita Vásquez', 'Cerro Dabeiba', '', '3108440238', 'Luis Ignacio Higuita Vásquez', '', 'Cta. Ahorros Bancolombia  //  \r\nCliente Sp. Ingenieros Mar II  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Dabeiba', ''),
(63, '43363356', 'Gloria Ruiz', 'Cerro Bello San Félix', '', '3205417102', 'Gloria Ruiz', '', 'Cta. Ahorros Bancolombia 54100033634  //  \r\nCliente Seguridad de Colombia  //  \r\nSe debe incrementar en Octubre de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'San Félix ', ''),
(64, '32210151', 'María Hilda Quintero Zabala', 'Cerro Otú, Vereda la Brava', '', '3122415933', 'María Hilda Quintero Zabala', '', 'Cta. Ahorros Bancolombia 52700015548  //  \r\nCliente Seracis  //  \r\nSe debe incrementar en Marzo de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Remedios', ''),
(65, '71578126', 'Gabriel Jaime Ochoa Peláez', 'Cerro Sevilla', '', '3233001425', 'Gabriel Jaime Ochoa Peláez', '', 'Cta. Ahorros Bancolombia 2167007751  //  \r\nCliente Minerales Camino Real  //  \r\n Se debe incrementar en Junio de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Sevilla', ''),
(66, '1026159146', 'Yeison David Henao Atehortúa', 'Cerro el Colombianito', '', '3194508493', 'Yeison David Henao Atehortúa ', '', 'Cta. Ahorros Bancolombia 27900001266  //  \r\nCliente Consorcio R&amp;S  //  \r\nSe debe incrementar en Agosto de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Caldas', ''),
(67, '16075309', 'Camilo Andres Lopera', 'Cerro San José de la Montaña', '', '3206322680', 'Camilo Andres Lopera', '', 'Cta. Corriente Bancolombia 7014384380  //                                                                                                                                          Cliente Hdroituango y Conconcreto  //                                                                                                                                             \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, '', 1, 'San José ', ''),
(68, '7530716', 'Guillermo Adolfo Atehortúa Agudelo ', 'Cerro el Cedro, Amaga', '', '3223093528', 'Guillermo Adolfo Atehortúa Agudelo ', '', 'Cta. Ahorros Bancolombia 52001440071  //  \r\nCliente Consorcio R&amp;S  //  \r\nSe debe incrementar en Septiembre de cada año según el porcentaje del IPC.\r\n', '', 0, '', 1, 'Amaga', ''),
(69, '1037368146', 'Eliana María Suarez', 'Cerro Maceo', '', '3108255728', 'Eliana María Suarez', '', 'Cta. Ahorros Bancolombia 16390361991  //  \r\nCliente Intramaq  //  \r\nSe debe incrementar en Abril de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Maceo', ''),
(70, '8075270', 'Oscar Darío Giraldo Ramírez', 'Dabeiba - Chinos', '', '3218735537', 'Oscar Darío Giraldo / Flor', '', 'Cta. Ahorro a la Mano 03126059317 / /\r\nSolo se cancelan los servicios una vez que ellos envían la factura, del recibo se debe restar (140.000 pesos) que es lo que normalmente ellos pagaban de luz y se le debe pagar el diferencial.', '', 0, 'Simplificado', 1, 'Dabeiba', ''),
(71, '43424223', 'Omaira del Socorro escobar Sánchez ', 'Cerro Pantanillo', '', '3113136979', 'Omaira del Socorro Escobar Sánchez', '', 'Gana BArbosa  //  \r\nCliente Hatovial  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Barbosa', ''),
(72, '1039284416', 'Robinson Flores Vargas', 'Dabeiba', '', '31732002976', 'Robinson Flores Vargas', '', 'Gana Dabeiba  //  \r\nCliente Seracis Chinos  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n\r\n\r\n', '', 0, 'Simplificado', 1, 'Dabeiba', ''),
(73, '8333249', 'José Joaquín León Gases ', 'Mutata', '', '3218903562', 'José Joaquim León Gases', '', 'Gana Mutata  //  \r\nCliente Seracis Chinos  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Mutata', ''),
(74, '8417622', 'Rubiel  Benítez ', 'Dabeiba', '', '3183757447', 'Rubiel Benítez', '', 'Gana Dabeiba  //  \r\nCliente Seracis Chinos  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Dabeiba', ''),
(75, '21818287', 'María Nidia Macías Flores ', 'Vegachí', '', '3165676391', 'María Nidia Flores', '', 'Gana Vegachí  //  \r\nCliente  //  \r\nSe debe incrementar en Febrero de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Vegachí', ''),
(76, '6271627', 'Eduardo Calderón', 'Santa Fe ', '', '3148895933', 'Eduardo Calderón ', '', 'Gana Santa Fe  //  \r\nCliente El Cóndor  //  \r\nSe debe incrementar en Febrero de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Santa Fe', ''),
(77, '30760476', 'Rocío Beltrán Castro', 'Codazzi el Cesar', '', '3144245571', 'Rocío Beltrán Castro', '', 'Cta Ahorro a la Mano Bancolombia 52491370742  // \r\nCliente Isla Caribe  //  \r\nSe debe incrementar en Agosto de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'El Cesar', ''),
(78, '71023107', 'Jorge Humberto Lopera Durando', 'Frontino', '', '3122814104', 'Jorge Humberto Lopera Durando ', '', 'Cta. Ahorro a la Mano Bancolombia 03122814104  //  \r\nCliente Sp. Ingenieros Mar II  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Frontino', ''),
(79, '900802615', 'Solarplus Energy S.A.S', 'Calle 65 Calle 8 B 91 IN 372', '6044483363', '3137330883', 'Juan Bernal ', 'tradecontabilidad@gmail.com', '', '40d568165a13576e7db2432794952b8e.png', 6, 'Común', 1, 'Medellín', ''),
(80, '900986403', 'RFI Comunicaciones S.A.S', 'Cra 37 B No. 1 g - 20', '3843687', '3102256990', 'William Martin Vargas ', '', '', '1855330a09a42d68e131fc6b676eca82.png', 0, 'Juridico', 1, 'Bogotá', ''),
(81, '890980958', 'MUNICIPIO DE MACEO', 'Carrera 30 #30-32', '8640209', '8640209', '', 'alcaldia@maceo-antioquia.gov.co', '', '', 3, '', 1, 'MACEO', ''),
(82, '19708332', 'ROBERTO CARLOS 	LEIVA PEREZ', 'VEREDA 4 VIENTOS', '', '3002349561', 'ROBERTO CARLOS 	LEIVA PEREZ', '', '', '', 1, 'SIMPLE', 1, '', ''),
(83, '830114921', 'COLOMBIA MOVIL S A E S P', 'CR 65 30A 58', '', '018003000000', 'TIGO BUSINES', 'atencionprimercontacto@mail.tigo.com.co', '', 'c8fb2c2ab13b2cbb0a75db1749c2f859.png', 1, 'GRANDES CONTRIBUYENTES', 1, 'MEDELLIN', ''),
(84, '800153993', 'COMUNICACION CELULAR S A COMCEL S A', 'Cl 30 A 82 a-26 C.C Los Molinos L 3031 ', '01-800-0341818', '01-800-0341818', 'CLARO', 'solucionesclaro@claro.com.co', '', 'b5f2dc14220cc7faec83e84120c5e7a8.png', 7, 'GRANDES CONTRIBUYENTES', 1, 'MEDELLIN', ''),
(85, '890904996', 'EMPRESAS PUBLICAS DE MEDELLIN E.S.P.', 'CRA 58  42 125', '3808080', '', 'EPM', 'notificacionesjudicialesepm@epm.com.co', '', '3486570319715963e6ec1f22ee3dd5bb.png', 1, 'GRANDES CONTRIBUYENTES', 1, 'MEDELLIN', 'notificacionesjudicialesepm@epm.com.co'),
(86, '1128404557', 'JUAN PABLO CADAVID MUÑOS', '', '', '3015353766', 'JUAN PABLO CADAVID MUÑOS', '', '', '', 0, 'SIMPLE', 1, 'MEDELLIN', ''),
(87, '1036610363', 'SIRLEY TATIANA MURILLO GOMEZ', 'Carre 69 calle 34 b sur 102', '', '3148783053', 'SIRLEY TATIANA MURILLO GOMEZ', 'coordinadora.sst@radioenlacesas.com', '', '', 0, 'SIMPLE', 1, 'MEDELLIN', ''),
(88, '41948443', 'ANGELA MARIAPEREZ ARANGO', 'CL 39 SUR 25C 89 APTO 428', '', '3122476898', 'ANGELA MARIAPEREZ ARANGO', 'angelaperez1980@hotmail.com', '', '', 0, 'SIMPLE', 1, '', ''),
(89, '71687072', 'JEFERSON ARANGO RESTREPO', 'Cra 98#22h 57', '311 6396382', '311 6396382', 'JEFERSON ARANGO RESTREPO', 'jefersonarango@gmail.com', '', '', 0, 'SIMPLE', 1, 'MEDELLIN', ''),
(90, '901296977', 'PUNTA DEL PARQUE - PROPIEDAD HORIZONTAL', 'CL 37B SUR 27 30', '', '3501546', 'PUNTA DEL PARQUE - PROPIEDAD HORIZONTAL', 'puntadelparqueph@gmail.com', '', '', 9, 'REGIMEN COMUN', 1, 'MEDELLIN', ''),
(91, '3518230', 'Electrónicas ADM ', 'Cra 53 No.  51-51 Local 311 CC La Cascada', '4807950', '', '', '', '', '', 3, '', 1, 'Medellín ', ''),
(92, '901291245', 'ICANN GROUP S.A.S', 'cl 33 74e 84', '2503941', '313 7366882', 'Alejandro Torres', 'orestrepo@hotmail.com', '', 'ccc209e3e7abc29adcfd6edd4ee8fcdc.png', 3, 'REGIMEN COMUN', 1, 'MEDELLIN', ''),
(93, '800060880', 'Ferragro S.A.S', 'Cra. 42 # 51 - 34', '4483797', '3117207435', '', 'jjrestrepo@ferragro.com', '', 'c4f0d1c3ac3ef4e1880f6338c4bd6e3a.png', 3, '', 1, 'Medellín ', ''),
(94, '43620699', 'Marcela Ríos Urrea / Enactivo Consulting', 'CR 35 65 SUR 135 AP 1505', '', '3187170367', '', 'marcelariosurrea@gmail.com', '', 'e6724d6b019cd529315f3818a51c4924.png', 4, '', 1, 'Medellín ', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` date DEFAULT NULL,
  `descripcion` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `porcentaje_tecnico` int(11) NOT NULL,
  `porcentaje_participante` int(11) NOT NULL,
  `puntos_mensual` int(11) NOT NULL,
  `visto_bueno` int(11) NOT NULL,
  `firma` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `id_categoria`, `nombre`, `id_cliente`, `puntos`, `factura`, `fecha`, `fecha_inicio`, `fecha_culminacion`, `descripcion`, `created_by`, `status`, `porcentaje_tecnico`, `porcentaje_participante`, `puntos_mensual`, `visto_bueno`, `firma`) VALUES
(66, 45, 'Prueba', 11, 0, 1, '2023-01-10', '2023-01-04', '2023-01-12', 'Sin descripcion', 1, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '0 => fijos, 1 => ocacionales, 2 => negativos',
  `status` int(11) NOT NULL COMMENT '0 => no pagado, 1=> pagado',
  `created_by` int(11) NOT NULL,
  `corte_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id`, `id_empleado`, `descripcion`, `cantidad`, `fecha`, `tipo`, `status`, `created_by`, `corte_by`) VALUES
(395, 8, '', 4, '2023-01-05 11:34:00', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_inventario`
--

CREATE TABLE `salida_inventario` (
  `id` int(11) NOT NULL,
  `tipo` int(1) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salida_inventario`
--

INSERT INTO `salida_inventario` (`id`, `tipo`, `producto_id`, `inventario_id`, `cantidad`, `user_id`, `cliente_id`, `observaciones`, `status`, `created_by`, `created_at`) VALUES
(16, 3, 1, 9, 1, NULL, 25, NULL, 0, 1, '2023-01-26 09:00:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud`
--

CREATE TABLE `salud` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL,
  `dolor_garganta` varchar(100) DEFAULT NULL,
  `malestar_general` varchar(100) DEFAULT NULL,
  `fiebre` varchar(100) DEFAULT NULL,
  `tos_seca` varchar(100) DEFAULT NULL,
  `perdida_olfato` varchar(100) DEFAULT NULL,
  `res_diagnostico_covid19` varchar(100) DEFAULT NULL,
  `contacto_covid19` varchar(100) DEFAULT NULL,
  `res_servicio_salud` varchar(100) DEFAULT NULL,
  `res_65years` varchar(100) DEFAULT NULL,
  `res_enfermedades_cronicas` varchar(100) DEFAULT NULL,
  `declaracion` varchar(100) DEFAULT NULL,
  `botas` varchar(100) DEFAULT NULL,
  `uniforme` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_clientes`
--

CREATE TABLE `seguimiento_clientes` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` date NOT NULL,
  `descripcion` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `porcentaje_tecnico` int(11) NOT NULL,
  `porcentaje_participante` int(11) NOT NULL,
  `puntos_mensual` int(11) NOT NULL,
  `visto_bueno` int(11) NOT NULL,
  `firma` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `statuses`
--

INSERT INTO `statuses` (`id`, `title`, `color`, `slug`, `order`) VALUES
(1, 'Asignado', 'text-red-500', 'assigned', 1),
(2, 'En Proceso', 'text-yellow-500', 'in-progress', 2),
(3, 'En Revisión', 'text-blue-500', 'in-review', 3),
(4, 'Culminado', 'text-green-500', 'completed', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_proyecto`
--

CREATE TABLE `status_proyecto` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `status_proyecto`
--

INSERT INTO `status_proyecto` (`id`, `id_proyecto`, `nombre`, `created_by`) VALUES
(4, 1, 'Preparacion', 1),
(6, 1, 'En Progreso', 1),
(7, 1, 'Completado', 1),
(8, 9, 'Asignado', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias_productos`
--

CREATE TABLE `subcategorias_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias_productos`
--

INSERT INTO `subcategorias_productos` (`id`, `nombre`, `categoria`, `created_by`, `fecha`) VALUES
(9, 'PORTATILES', 87, 1, '2023-01-12'),
(10, 'BASES', 87, 1, '2023-01-12'),
(13, 'REPETIDORAS', 88, 1, '2023-01-12'),
(14, 'OTROS', 87, 1, '2023-01-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task_projects`
--

CREATE TABLE `task_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` smallint(6) NOT NULL DEFAULT 0,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `puntos` int(11) DEFAULT 0,
  `init_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `placa` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `tipo_combustible` varchar(100) DEFAULT NULL,
  `soat` varchar(100) DEFAULT NULL,
  `seguro_obligatorio` varchar(100) DEFAULT NULL,
  `seguro_riesgos` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `year`, `placa`, `color`, `tipo`, `foto`, `observaciones`, `tipo_combustible`, `soat`, `seguro_obligatorio`, `seguro_riesgos`, `created_by`, `estado`) VALUES
(4, 'Suzuki', '2016', '2015', 'ISV080', 'Gris oscuro', 'Campero', 'ed6adb3ce52d975fea06fc6b6660c419.png', '', 'Gasolina', '06-05-2023', '06-05-2023', '04-06-2023', 9, 1),
(5, 'Suzuki', '2017', '2016', 'IUW925', 'Gris Metálico', 'Campero', '87773f58ee2b3e95c372c899351e2eda.png', '', 'Gasolina', '15-02-2023', '16-06-2023', '10-02-2023', 9, 1),
(6, 'Chevrolet', '2019', '2018', 'EQT839', 'Blanco Galaxia', 'Sedan', 'b78ce83af867928864efa17762b773ce.png', '', 'ACPM', '14-08-2022', '08-09-2022', '26-06-2022', 9, 1),
(7, 'International', '2014', '2013', 'WCO240', 'Blanco', 'Grua Planchón', 'cc868891ca3a5ea1a177c40f24cd3b3c.png', '', 'ACPM', '08-10-2023', '25-11-2022', '13-12-2022', 9, 1),
(8, 'Chevrolet', '2007', '2008', 'TMY386', 'Amarillo Eléctrico', 'Grua Pluma', '2a4d8dbe0ec495152d6a4b6ff12021ee.png', '', 'ACPM', '21-01-2023', '21-07-2023', '14-08-2023', 9, 1),
(9, 'International', '2013', '2012', 'TEK045', 'Blanco', 'Tractocamión', 'cfb874d23e0c86d7b36eb9a3449f843a.png', '', 'ACPM', '20-06-2023', '01-09-2023', '27-11-2022', 9, 1),
(10, 'Ram', '20212', '2021', 'JYU143', 'Gris Granito', 'Camioneta', '18419423311912114557.jpg', 'El seguro de riesgo lo tiene Bancolombia', 'Gasolina', '17-06-2022', NULL, NULL, 9, 1),
(11, 'Chevrolet', '2019', '2018', 'EQT839', 'Blanco Galaxia', 'Grua Planchón', '2ef1384793ba160c3cf0bee9fe5f3a0f.png', '', 'ACPM', '14-08-2023', '08-09-2023', '26-06-2023', 9, 1),
(12, 'Suzuki', '2023', '2022', 'LGN109', 'Gris Metálico', 'Campero', '46395f09886f81a2d558577c001c2d1c.png', '', 'Gasolina', '23-09-2023', '28-09-2028', '', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaticos`
--

CREATE TABLE `viaticos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `motivo` text NOT NULL,
  `salida` datetime NOT NULL,
  `llegada` datetime NOT NULL,
  `destino` varchar(255) NOT NULL,
  `transporte_descripcion` text NOT NULL,
  `transporte_precio` float NOT NULL DEFAULT 0,
  `observaciones` text NOT NULL,
  `km_recorridos` varchar(100) NOT NULL,
  `galones_consumidos` varchar(100) NOT NULL DEFAULT '0',
  `valor_galones` float NOT NULL,
  `ticket` varchar(50) NOT NULL,
  `tipo_gasolina` varchar(50) NOT NULL,
  `observaciones_gasolina` text NOT NULL,
  `valor_desayuno` float NOT NULL,
  `valor_almuerzo` float NOT NULL,
  `valor_comida` float NOT NULL,
  `valor_devolucion` float NOT NULL,
  `valor_diferencia` float NOT NULL,
  `observaciones_comida` text NOT NULL,
  `valor_peaje` float NOT NULL,
  `valor_alojamiento` float NOT NULL,
  `valor_taxi` float NOT NULL,
  `valor_bus` float NOT NULL,
  `valor_bestia` float NOT NULL,
  `observaciones_movilidad` text NOT NULL,
  `valor_adicionales` float NOT NULL,
  `observaciones_adicionales` text NOT NULL,
  `valor_otros` float NOT NULL,
  `observaciones_otros` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexos_asignaciones`
--
ALTER TABLE `anexos_asignaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexos_clientes`
--
ALTER TABLE `anexos_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexos_proveedores`
--
ALTER TABLE `anexos_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexos_tasks_projects`
--
ALTER TABLE `anexos_tasks_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexos_viaticos`
--
ALTER TABLE `anexos_viaticos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `arrendamientos`
--
ALTER TABLE `arrendamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `avances_asignaciones`
--
ALTER TABLE `avances_asignaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `avances_tasks_projects`
--
ALTER TABLE `avances_tasks_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calendario_eventos`
--
ALTER TABLE `calendario_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_archivos`
--
ALTER TABLE `categorias_archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_calendario`
--
ALTER TABLE `categorias_calendario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_proyectos`
--
ALTER TABLE `categorias_proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_seguimiento_clientes`
--
ALTER TABLE `categorias_seguimiento_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_facturacion`
--
ALTER TABLE `datos_facturacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_tecnico`
--
ALTER TABLE `datos_tecnico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados_viatico`
--
ALTER TABLE `empleados_viatico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_equivalentes`
--
ALTER TABLE `gastos_equivalentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_fijos`
--
ALTER TABLE `gastos_fijos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_varios`
--
ALTER TABLE `gastos_varios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventario_id` (`inventario_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `novedades_nomina`
--
ALTER TABLE `novedades_nomina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos_new`
--
ALTER TABLE `permisos_new`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `inventario_id` (`inventario_id`);

--
-- Indices de la tabla `salud`
--
ALTER TABLE `salud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguimiento_clientes`
--
ALTER TABLE `seguimiento_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status_proyecto`
--
ALTER TABLE `status_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategorias_productos`
--
ALTER TABLE `subcategorias_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task_projects`
--
ALTER TABLE `task_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculos_id_IDX` (`id`) USING BTREE;

--
-- Indices de la tabla `viaticos`
--
ALTER TABLE `viaticos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de la tabla `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `anexos_asignaciones`
--
ALTER TABLE `anexos_asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `anexos_clientes`
--
ALTER TABLE `anexos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `anexos_proveedores`
--
ALTER TABLE `anexos_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `anexos_tasks_projects`
--
ALTER TABLE `anexos_tasks_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `anexos_viaticos`
--
ALTER TABLE `anexos_viaticos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `arrendamientos`
--
ALTER TABLE `arrendamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=886;

--
-- AUTO_INCREMENT de la tabla `avances_asignaciones`
--
ALTER TABLE `avances_asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1708;

--
-- AUTO_INCREMENT de la tabla `avances_tasks_projects`
--
ALTER TABLE `avances_tasks_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `calendario_eventos`
--
ALTER TABLE `calendario_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `categorias_archivos`
--
ALTER TABLE `categorias_archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categorias_calendario`
--
ALTER TABLE `categorias_calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `categorias_proyectos`
--
ALTER TABLE `categorias_proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `categorias_seguimiento_clientes`
--
ALTER TABLE `categorias_seguimiento_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_facturacion`
--
ALTER TABLE `datos_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `datos_tecnico`
--
ALTER TABLE `datos_tecnico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `empleados_viatico`
--
ALTER TABLE `empleados_viatico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `gastos_equivalentes`
--
ALTER TABLE `gastos_equivalentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos_fijos`
--
ALTER TABLE `gastos_fijos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `gastos_varios`
--
ALTER TABLE `gastos_varios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `novedades_nomina`
--
ALTER TABLE `novedades_nomina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos_new`
--
ALTER TABLE `permisos_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7153;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT de la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de la tabla `seguimiento_clientes`
--
ALTER TABLE `seguimiento_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `status_proyecto`
--
ALTER TABLE `status_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `subcategorias_productos`
--
ALTER TABLE `subcategorias_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `task_projects`
--
ALTER TABLE `task_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `viaticos`
--
ALTER TABLE `viaticos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD CONSTRAINT `movimientos_inventario_ibfk_1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  ADD CONSTRAINT `salida_inventario_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `salida_inventario_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `salida_inventario_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `salida_inventario_ibfk_5` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `salida_inventario_ibfk_6` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
