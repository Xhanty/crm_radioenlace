-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2023 a las 00:14:23
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios_reparaciones`
--

CREATE TABLE `accesorios_reparaciones` (
  `id` int(11) NOT NULL,
  `accesorio` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesorios_reparaciones`
--

INSERT INTO `accesorios_reparaciones` (`id`, `accesorio`, `status`, `created_by`, `created_at`) VALUES
(3, 'Perilla', 1, 1, '2023-05-11 14:53:08'),
(4, 'Carcasa', 1, 1, '2023-05-11 14:53:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_economicas`
--

CREATE TABLE `actividades_economicas` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades_economicas`
--

INSERT INTO `actividades_economicas` (`id`, `code`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(1, '011', 'Cultivos agrícolas transitorios', 1, 1, '2023-02-22 13:12:45'),
(2, '0111', 'Cultivo de cereales (excepto arroz), legumbres y semillas oleaginosas', 1, 1, '2023-02-22 13:12:45'),
(3, '0112', 'Cultivo de arroz', 1, 1, '2023-02-22 13:12:45'),
(4, '0113', 'Cultivo de hortalizas, raíces y tubérculos', 1, 1, '2023-02-22 13:12:45'),
(5, '0114', 'Cultivo de tabaco', 1, 1, '2023-02-22 13:12:45'),
(6, '0115', 'Cultivo de plantas textiles', 1, 1, '2023-02-22 13:12:45'),
(7, '0119', 'Otros cultivos transitorios n.c.p', 1, 1, '2023-02-22 13:12:45'),
(8, '012', 'Cultivos agrícolas permanentes', 1, 1, '2023-02-22 13:12:45'),
(9, '0121', 'Cultivo de frutas tropicales y subtropicales', 1, 1, '2023-02-22 13:12:45'),
(10, '0122', 'Cultivo de plátano y banano', 1, 1, '2023-02-22 13:12:45'),
(11, '0123', 'Cultivo de café', 1, 1, '2023-02-22 13:12:45'),
(12, '0124', 'Cultivo de caña de azúcar', 1, 1, '2023-02-22 13:12:45'),
(13, '0125', 'Cultivo de flor de corte', 1, 1, '2023-02-22 13:12:45'),
(14, '0126', 'Cultivo de palma para aceite (palma africana) y otros frutos oleaginosos', 1, 1, '2023-02-22 13:12:45'),
(15, '0127', 'Cultivo de plantas con las que se preparan bebidas', 1, 1, '2023-02-22 13:12:45'),
(16, '0128', 'Cultivo de especias y de plantas aromáticas y medicinales', 1, 1, '2023-02-22 13:12:45'),
(17, '0129', 'Otros cultivos permanentes n.c.p', 1, 1, '2023-02-22 13:12:45'),
(18, '013', 'Propagación de plantas (actividades de los viveros, excepto viveros forestales)', 1, 1, '2023-02-22 13:12:45'),
(19, '0130', 'Propagación de plantas (actividades de los viveros, excepto viveros forestales)', 1, 1, '2023-02-22 13:12:45'),
(20, '014', 'Ganadería', 1, 1, '2023-02-22 13:12:45'),
(21, '0141', 'Cría de ganado bovino y bufalino', 1, 1, '2023-02-22 13:12:45'),
(22, '0142', 'Cría de caballos y otros equinos', 1, 1, '2023-02-22 13:12:45'),
(23, '0143', 'Cría de ovejas y cabras', 1, 1, '2023-02-22 13:12:45'),
(24, '0144', 'Cría de ganado porcino', 1, 1, '2023-02-22 13:12:45'),
(25, '0145', 'Cría de aves de corral', 1, 1, '2023-02-22 13:12:45'),
(26, '0149', 'Cría de otros animales n.c.p', 1, 1, '2023-02-22 13:12:45'),
(27, '015', 'Explotación mixta (agrícola y pecuaria)', 1, 1, '2023-02-22 13:12:45'),
(28, '0150', 'Explotación mixta (agrícola y pecuaria)', 1, 1, '2023-02-22 13:12:45'),
(29, '016', 'Actividades de apoyo a la agricultura y la ganadería, y actividades posteriores a la cosecha', 1, 1, '2023-02-22 13:12:45'),
(30, '0161', 'Actividades de apoyo a la agricultura', 1, 1, '2023-02-22 13:12:45'),
(31, '0162', 'Actividades de apoyo a la ganadería', 1, 1, '2023-02-22 13:12:45'),
(32, '0163', 'Actividades posteriores a la cosecha', 1, 1, '2023-02-22 13:12:45'),
(33, '0164', 'Tratamiento de semillas para propagación', 1, 1, '2023-02-22 13:12:45'),
(34, '017', 'Caza ordinaria y mediante trampas y actividades de servicios conexas', 1, 1, '2023-02-22 13:12:45'),
(35, '01710', 'Caza ordinaria y mediante trampas y actividades de servicios conexas', 1, 1, '2023-02-22 13:12:45'),
(36, '021', 'Silvicultura y otras actividades forestales', 1, 1, '2023-02-22 13:12:45'),
(37, '0210', 'Silvicultura y otras actividades forestales', 1, 1, '2023-02-22 13:12:45'),
(38, '022', 'Extracción de madera', 1, 1, '2023-02-22 13:12:45'),
(39, '0220', 'Extracción de madera', 1, 1, '2023-02-22 13:12:45'),
(40, '023', 'Recolección de productos forestales diferentes a la madera', 1, 1, '2023-02-22 13:12:45'),
(41, '0230', 'Recolección de productos forestales diferentes a la madera', 1, 1, '2023-02-22 13:12:45'),
(42, '024', 'Servicios de apoyo a la silvicultura', 1, 1, '2023-02-22 13:12:45'),
(43, '0240', 'Servicios de apoyo a la silvicultura', 1, 1, '2023-02-22 13:12:45'),
(44, '031', 'Pesca', 1, 1, '2023-02-22 13:12:45'),
(45, '0311', 'Pesca marítima', 1, 1, '2023-02-22 13:12:45'),
(46, '0312', 'Pesca de agua dulce', 1, 1, '2023-02-22 13:12:45'),
(47, '032', 'Acuicultura', 1, 1, '2023-02-22 13:12:45'),
(48, '0321', 'Acuicultura marítima', 1, 1, '2023-02-22 13:12:45'),
(49, '0322', 'Acuicultura de agua dulce', 1, 1, '2023-02-22 13:12:45'),
(50, '051', 'Extracción de hulla (carbón de piedra)', 1, 1, '2023-02-22 13:12:45'),
(51, '0510', 'Extracción de hulla (carbón de piedra)', 1, 1, '2023-02-22 13:12:45'),
(52, '052', 'Extracción de carbón lignito', 1, 1, '2023-02-22 13:12:45'),
(53, '0520', 'Extracción de carbón lignito', 1, 1, '2023-02-22 13:12:45'),
(54, '061', 'Extracción de petróleo crudo', 1, 1, '2023-02-22 13:12:45'),
(55, '0610', 'Extracción de petróleo crudo', 1, 1, '2023-02-22 13:12:45'),
(56, '062', 'Extracción de gas natural', 1, 1, '2023-02-22 13:12:45'),
(57, '0620', 'Extracción de gas natural', 1, 1, '2023-02-22 13:12:45'),
(58, '071', 'Extracción de minerales de hierro', 1, 1, '2023-02-22 13:12:45'),
(59, '0710', 'Extracción de minerales de hierro', 1, 1, '2023-02-22 13:12:45'),
(60, '072', 'Extracción de minerales metalíferos no ferrosos', 1, 1, '2023-02-22 13:12:45'),
(61, '0721', 'Extracción de minerales de uranio y de torio', 1, 1, '2023-02-22 13:12:45'),
(62, '0722', 'Extracción de oro y otros metales preciosos', 1, 1, '2023-02-22 13:12:45'),
(63, '0723', 'Extracción de minerales de níquel', 1, 1, '2023-02-22 13:12:45'),
(64, '0729', 'Extracción de otros minerales metalíferos no ferrosos n.c.p', 1, 1, '2023-02-22 13:12:45'),
(65, '081', 'Extracción de piedra, arena, arcillas, cal, yeso, caolín, bentonitas y similares', 1, 1, '2023-02-22 13:12:45'),
(66, '0811', 'Extracción de piedra, arena, arcillas comunes, yeso y anhidrita', 1, 1, '2023-02-22 13:12:45'),
(67, '0812', 'Extracción de arcillas de uso industrial, caliza, caolín y bentonitas', 1, 1, '2023-02-22 13:12:45'),
(68, '082', 'Extracción de esmeraldas, piedras preciosas y semipreciosas', 1, 1, '2023-02-22 13:12:45'),
(69, '0820', 'Extracción de esmeraldas, piedras preciosas y semipreciosas', 1, 1, '2023-02-22 13:12:45'),
(70, '089', 'Extracción de otros minerales no metálicos n.c.p', 1, 1, '2023-02-22 13:12:45'),
(71, '0891', 'Extracción de minerales para la fabricación de abonos y productos químicos', 1, 1, '2023-02-22 13:12:45'),
(72, '0892', 'Extracción de halita (sal)', 1, 1, '2023-02-22 13:12:45'),
(73, '0899', 'Extracción de otros minerales no metálicos n.c.p', 1, 1, '2023-02-22 13:12:45'),
(74, '091', 'Actividades de apoyo para la extracción de petróleo y de gas natural', 1, 1, '2023-02-22 13:12:45'),
(75, '0910', 'Actividades de apoyo para la extracción de petróleo y de gas natural', 1, 1, '2023-02-22 13:12:45'),
(76, '099', 'Actividades de apoyo para otras actividades de explotación de minas y canteras', 1, 1, '2023-02-22 13:12:45'),
(77, '0990', 'Actividades de apoyo para otras actividades de explotación de minas y canteras', 1, 1, '2023-02-22 13:12:45'),
(78, '101', 'Procesamiento y conservación de carne, pescado, crustáceos y moluscos', 1, 1, '2023-02-22 13:12:45'),
(79, '1011', 'Procesamiento y conservación de carne y productos cárnicos', 1, 1, '2023-02-22 13:12:45'),
(80, '1012', 'Procesamiento y conservación de pescados, crustáceos y moluscos', 1, 1, '2023-02-22 13:12:45'),
(81, '102', 'Procesamiento y conservación de frutas, legumbres, hortalizas y turbérculo', 1, 1, '2023-02-22 13:12:45'),
(82, '1020', 'Procesamiento y conservación de frutas, legumbres, hortalizas y tubérculos', 1, 1, '2023-02-22 13:12:45'),
(83, '103', 'Elaboración de aceites y grasas de origen vegetal y animal', 1, 1, '2023-02-22 13:12:45'),
(84, '1030', 'Elaboración de aceites y grasas de origen vegetal y animal', 1, 1, '2023-02-22 13:12:45'),
(85, '104', 'Elaboración de productos lácteos', 1, 1, '2023-02-22 13:12:45'),
(86, '1040', 'Elaboración de productos lácteos', 1, 1, '2023-02-22 13:12:45'),
(87, '105', 'Elaboración de productos de molinería, almidones y productos derivados del almidón', 1, 1, '2023-02-22 13:12:45'),
(88, '1051', 'Elaboración de productos de molinería', 1, 1, '2023-02-22 13:12:45'),
(89, '1052', 'Elaboración de almidones y productos derivados del almidón', 1, 1, '2023-02-22 13:12:45'),
(90, '106', 'Elaboración de productos de café', 1, 1, '2023-02-22 13:12:45'),
(91, '1061', 'Trilla de café', 1, 1, '2023-02-22 13:12:45'),
(92, '1062', 'Descafeinado, tostión y molienda del café', 1, 1, '2023-02-22 13:12:45'),
(93, '1063', 'Otros derivados del café', 1, 1, '2023-02-22 13:12:45'),
(94, '107', 'Elaboración de azúcar y panela', 1, 1, '2023-02-22 13:12:45'),
(95, '1071', 'Elaboración y refinación de azúcar', 1, 1, '2023-02-22 13:12:45'),
(96, '1072', 'Elaboración de panela', 1, 1, '2023-02-22 13:12:45'),
(97, '108', 'Elaboración de otros productos alimenticios', 1, 1, '2023-02-22 13:12:45'),
(98, '1081', 'Elaboración de productos de panadería', 1, 1, '2023-02-22 13:12:45'),
(99, '1082', 'Elaboración de cacao, chocolate y productos de confitería', 1, 1, '2023-02-22 13:12:45'),
(100, '1083', 'Elaboración de macarrones, fideos, alcuzcuz y productos farináceos similares', 1, 1, '2023-02-22 13:12:45'),
(101, '1084', 'Elaboración de comidas y platos preparados', 1, 1, '2023-02-22 13:12:45'),
(102, '1089', 'Elaboración de otros productos alimenticios n.c.p', 1, 1, '2023-02-22 13:12:45'),
(103, '109', 'Elaboración de alimentos preparados para animales', 1, 1, '2023-02-22 13:12:45'),
(104, '1090', 'Elaboración de alimentos preparados para animales', 1, 1, '2023-02-22 13:12:45'),
(105, '110', 'Elaboración de bebidas', 1, 1, '2023-02-22 13:12:45'),
(106, '1101', 'Destilación, rectificación y mezcla de bebidas alcohólicas', 1, 1, '2023-02-22 13:12:45'),
(107, '1102', 'Elaboración de bebidas fermentadas no destiladas', 1, 1, '2023-02-22 13:12:45'),
(108, '1103', 'Producción de malta, elaboración de cervezas y otras bebidas malteadas', 1, 1, '2023-02-22 13:12:45'),
(109, '1104', 'Elaboración de bebidas no alcohólicas, producción de aguas minerales y de otras aguas embotelladas', 1, 1, '2023-02-22 13:12:45'),
(110, '120', 'Elaboración de productos de tabaco', 1, 1, '2023-02-22 13:12:45'),
(111, '1200', 'Elaboración de productos de tabaco', 1, 1, '2023-02-22 13:12:45'),
(112, '131', 'Preparación, hilatura, tejeduría y acabado de productos textiles', 1, 1, '2023-02-22 13:12:45'),
(113, '1311', 'Preparación e hilatura de fibras textiles', 1, 1, '2023-02-22 13:12:45'),
(114, '1312', 'Tejeduría de productos textiles', 1, 1, '2023-02-22 13:12:45'),
(115, '1313', 'Acabado de productos textiles', 1, 1, '2023-02-22 13:12:45'),
(116, '139', 'Fabricación de otros productos textiles', 1, 1, '2023-02-22 13:12:45'),
(117, '1391', 'Fabricación de tejidos de punto y ganchillo', 1, 1, '2023-02-22 13:12:45'),
(118, '1392', 'Confección de artículos con materiales textiles, excepto prendas de vestir', 1, 1, '2023-02-22 13:12:45'),
(119, '1393', 'Fabricación de tapetes y alfombras para pisos', 1, 1, '2023-02-22 13:12:45'),
(120, '1394', 'Fabricación de cuerdas, cordeles, cables, bramantes y redes', 1, 1, '2023-02-22 13:12:45'),
(121, '1399', 'Fabricación de otros artículos textiles n.c.p', 1, 1, '2023-02-22 13:12:45'),
(122, '141', 'Confección de prendas de vestir, excepto prendas de piel', 1, 1, '2023-02-22 13:12:45'),
(123, '1410', 'Confección de prendas de vestir, excepto prendas de piel', 1, 1, '2023-02-22 13:12:45'),
(124, '142', 'Fabricación de artículos de piel', 1, 1, '2023-02-22 13:12:45'),
(125, '1420', 'Fabricación de artículos de piel', 1, 1, '2023-02-22 13:12:45'),
(126, '143', 'Fabricación de artículos de punto y ganchillo', 1, 1, '2023-02-22 13:12:45'),
(127, '1430', 'Fabricación de artículos de punto y ganchillo', 1, 1, '2023-02-22 13:12:45'),
(128, '151', 'Curtido y recurtido de cueros; fabricación de artículos de viaje, bolsos de mano y artículos similares,\r\n                y fabricación de artículos de talabartería y guarnicionería, adobo y teñido de pieles', 1, 1, '2023-02-22 13:12:45'),
(129, '1511', 'Curtido y recurtido de cueros; recurtido y teñido de pieles', 1, 1, '2023-02-22 13:12:45'),
(130, '1512', 'Fabricación de artículos de viaje, bolsos de mano y artículos similares elaborados en cuero, y\r\n                fabricación de artículos de talabartería y guarnicionería', 1, 1, '2023-02-22 13:12:45'),
(131, '1513', 'Fabricación de artículos de viaje, bolsos de mano y artículos similares elaborados en cuero, y\r\n                fabricación de artículos de talabartería y guarnicionería', 1, 1, '2023-02-22 13:12:45'),
(132, '152', 'Fabricación de calzado', 1, 1, '2023-02-22 13:12:45'),
(133, '1521', 'Fabricación de calzado de cuero y piel, con cualquier tipo de suela', 1, 1, '2023-02-22 13:12:45'),
(134, '1522', 'Fabricación de otros tipos de calzado, excepto calzado de cuero y piel', 1, 1, '2023-02-22 13:12:45'),
(135, '1523', 'Fabricación de partes del calzado', 1, 1, '2023-02-22 13:12:45'),
(136, '161', 'Aserrado, acepillado e impregnación de la madera', 1, 1, '2023-02-22 13:12:45'),
(137, '1610', 'Aserrado, acepillado e impregnación de la madera', 1, 1, '2023-02-22 13:12:45'),
(138, '162', 'Fabricación de hojas de madera para enchapado; fabricación de tableros contrachapados, tableros\r\n                laminados, tableros de partículas y otros tableros y paneles', 1, 1, '2023-02-22 13:12:45'),
(139, '1620', 'Fabricación de hojas de madera para enchapado; fabricación de tableros contrachapados, tableros\r\n                laminados, tableros de partículas y otros tableros y paneles', 1, 1, '2023-02-22 13:12:45'),
(140, '163', 'Fabricación de partes y piezas de madera, de carpintería y ebanistería para la construcción', 1, 1, '2023-02-22 13:12:45'),
(141, '1630', 'Fabricación de partes y piezas de madera, de carpintería y ebanistería para la construcción', 1, 1, '2023-02-22 13:12:45'),
(142, '164', 'Fabricación de recipientes de madera', 1, 1, '2023-02-22 13:12:45'),
(143, '1640', 'Fabricación de recipientes de madera', 1, 1, '2023-02-22 13:12:45'),
(144, '169', 'Fabricación de otros productos de madera; fabricación de artículos de cestería y espartería', 1, 1, '2023-02-22 13:12:45'),
(145, '1690', 'Fabricación de otros productos de madera; fabricación de artículos de cestería y espartería', 1, 1, '2023-02-22 13:12:45'),
(146, '170', 'Fabricación de papel, cartón y productos de papel y cartón', 1, 1, '2023-02-22 13:12:45'),
(147, '1701', 'Fabricación de pulpas (pastas) celulósicas; papel y cartón', 1, 1, '2023-02-22 13:12:45'),
(148, '1702', 'Fabricación de papel y cartón ondulado (corrugado); fabricación de envases, empaques y de embalajes de\r\n                papel y cartón', 1, 1, '2023-02-22 13:12:45'),
(149, '1709', 'Fabricación de otros artículos de papel y cartón', 1, 1, '2023-02-22 13:12:45'),
(150, '181', 'Actividades de impresión y actividades de servicios relacionados con la impresión', 1, 1, '2023-02-22 13:12:45'),
(151, '1811', 'Actividades de impresión', 1, 1, '2023-02-22 13:12:45'),
(152, '1812', 'Actividades de servicios relacionados con la impresión', 1, 1, '2023-02-22 13:12:45'),
(153, '182', 'Producción de copias a partir de grabaciones originales', 1, 1, '2023-02-22 13:12:45'),
(154, '1820', 'Producción de copias a partir de grabaciones originales', 1, 1, '2023-02-22 13:12:45'),
(155, '191', 'Fabricación de productos de hornos de coque', 1, 1, '2023-02-22 13:12:45'),
(156, '1910', 'Fabricación de productos de hornos de coque', 1, 1, '2023-02-22 13:12:45'),
(157, '192', 'Fabricación de productos de la refinación del petróleo', 1, 1, '2023-02-22 13:12:45'),
(158, '1921', 'Fabricación de productos de la refinación del petróleo', 1, 1, '2023-02-22 13:12:45'),
(159, '1922', 'Actividad de mezcla de combustibles', 1, 1, '2023-02-22 13:12:45'),
(160, '201', 'Fabricación de sustancias químicas básicas, abonos y compuestos inorgánicos nitrogenados, plásticos y\r\n                caucho sintético en formas primarias', 1, 1, '2023-02-22 13:12:45'),
(161, '2011', 'Fabricación de sustancias y productos químicos básicos', 1, 1, '2023-02-22 13:12:45'),
(162, '2012', 'Fabricación de abonos y compuestos inorgánicos nitrogenados', 1, 1, '2023-02-22 13:12:45'),
(163, '2013', 'Fabricación de plásticos en formas primarias', 1, 1, '2023-02-22 13:12:45'),
(164, '2014', 'Fabricación de caucho sintético en formas primarias', 1, 1, '2023-02-22 13:12:45'),
(165, '202', 'Fabricación de otros productos químicos', 1, 1, '2023-02-22 13:12:45'),
(166, '2021', 'Fabricación de plaguicidas y otros productos químicos de uso agropecuario', 1, 1, '2023-02-22 13:12:45'),
(167, '2022', 'Fabricación de pinturas, barnices y revestimientos similares, tintas para impresión y masillas', 1, 1, '2023-02-22 13:12:45'),
(168, '2023', 'Fabricación de jabones y detergentes, preparados para limpiar y pulir; perfumes y preparados de tocador', 1, 1, '2023-02-22 13:12:45'),
(169, '2029', 'perfumes y preparados de tocador. Fabricación de otros productos químicos n.c.p', 1, 1, '2023-02-22 13:12:45'),
(170, '203', 'Fabricación de fibras sintéticas y artificiales', 1, 1, '2023-02-22 13:12:45'),
(171, '2030', 'Fabricación de fibras sintéticas y artificiales', 1, 1, '2023-02-22 13:12:45'),
(172, '210', 'Fabricación de productos farmacéuticos, sustancias químicas medicinales y productos botánicos de uso\r\n                farmacéutico', 1, 1, '2023-02-22 13:12:45'),
(173, '2100', 'Fabricación de productos farmacéuticos, sustancias químicas medicinales y productos botánicos de\r\n                uso farmacéutico', 1, 1, '2023-02-22 13:12:45'),
(174, '221', 'Fabricación de productos de caucho', 1, 1, '2023-02-22 13:12:45'),
(175, '2211', 'Fabricación de llantas y neumáticos de caucho', 1, 1, '2023-02-22 13:12:45'),
(176, '2212', 'Reencauche de llantas usadas', 1, 1, '2023-02-22 13:12:45'),
(177, '2219', 'Fabricación de formas básicas de caucho y otros productos de caucho n.c.p', 1, 1, '2023-02-22 13:12:45'),
(178, '222', 'Fabricación de productos de plástico', 1, 1, '2023-02-22 13:12:45'),
(179, '2221', 'Fabricación de formas básicas de plástico', 1, 1, '2023-02-22 13:12:45'),
(180, '2229', 'Fabricación de artículos de plástico n.c.p', 1, 1, '2023-02-22 13:12:45'),
(181, '231', 'Fabricación de vidrio y productos de vidrio', 1, 1, '2023-02-22 13:12:45'),
(182, '2310', 'Fabricación de vidrio y productos de vidrio', 1, 1, '2023-02-22 13:12:45'),
(183, '239', 'Fabricación de productos minerales no metálicos n.c.p', 1, 1, '2023-02-22 13:12:45'),
(184, '2391', 'Fabricación de productos refractarios', 1, 1, '2023-02-22 13:12:45'),
(185, '2392', 'Fabricación de materiales de arcilla para la construcción', 1, 1, '2023-02-22 13:12:45'),
(186, '2393', 'Fabricación de otros productos de cerámica y porcelana', 1, 1, '2023-02-22 13:12:45'),
(187, '2394', 'Fabricación de cemento, cal y yeso', 1, 1, '2023-02-22 13:12:45'),
(188, '2395', 'Fabricación de artículos de hormigón, cemento y yeso', 1, 1, '2023-02-22 13:12:45'),
(189, '2396', 'Corte, tallado y acabado de la piedra', 1, 1, '2023-02-22 13:12:45'),
(190, '2399', 'Fabricación de otros productos minerales no metálicos n.c.p', 1, 1, '2023-02-22 13:12:45'),
(191, '241', 'Industrias básicas de hierro y de acero', 1, 1, '2023-02-22 13:12:45'),
(192, '2410', 'Industrias básicas de hierro y de acero', 1, 1, '2023-02-22 13:12:45'),
(193, '242', 'Industrias básicas de metales preciosos y de metales no ferrosos', 1, 1, '2023-02-22 13:12:45'),
(194, '2421', 'Industrias básicas de metales preciosos', 1, 1, '2023-02-22 13:12:45'),
(195, '2429', 'Industrias básicas de otros metales no ferrosos', 1, 1, '2023-02-22 13:12:45'),
(196, '243', 'Fundición de metales', 1, 1, '2023-02-22 13:12:45'),
(197, '2431', 'Fundición de hierro y de acero', 1, 1, '2023-02-22 13:12:45'),
(198, '2432', 'Fundición de metales no ferrosos', 1, 1, '2023-02-22 13:12:45'),
(199, '251', 'Fabricación de productos metálicos para uso estructural, tanques, depósitos y generadores de vapor', 1, 1, '2023-02-22 13:12:45'),
(200, '2511', 'Fabricación de productos metálicos para uso estructural', 1, 1, '2023-02-22 13:12:45'),
(201, '2512', 'Fabricación de tanques, depósitos y recipientes de metal, excepto los utilizados para el envase o\r\n                transporte de mercancías', 1, 1, '2023-02-22 13:12:45'),
(202, '2513', 'Fabricación de generadores de vapor, excepto calderas de agua caliente para calefacción central,', 1, 1, '2023-02-22 13:12:45'),
(203, '252', 'Fabricación de armas y municiones', 1, 1, '2023-02-22 13:12:45'),
(204, '2520', 'Fabricación de armas y municiones', 1, 1, '2023-02-22 13:12:45'),
(205, '259', 'Fabricación de otros productos elaborados de metal y actividades de servicios relacionadas con el\r\n                trabajo de metales', 1, 1, '2023-02-22 13:12:45'),
(206, '2591', 'Forja, prensado, estampado y laminado de metal; pulvimetalurgia', 1, 1, '2023-02-22 13:12:45'),
(207, '2592', 'Tratamiento y revestimiento de metales; mecanizado', 1, 1, '2023-02-22 13:12:45'),
(208, '2593', 'Fabricación de artículos de cuchillería, herramientas de mano y artículos de ferretería', 1, 1, '2023-02-22 13:12:45'),
(209, '2599', 'Fabricación de otros productos laborados de metal n.c.p', 1, 1, '2023-02-22 13:12:45'),
(210, '261', 'Fabricación de componentes y tableros electrónicos', 1, 1, '2023-02-22 13:12:45'),
(211, '2610', 'Fabricación de componentes y tableros electrónicos', 1, 1, '2023-02-22 13:12:45'),
(212, '262', 'Fabricación de computadoras y de equipo periférico', 1, 1, '2023-02-22 13:12:45'),
(213, '2620', 'Fabricación de computadoras y de equipo periférico', 1, 1, '2023-02-22 13:12:45'),
(214, '263', 'Fabricación de equipos de comunicación', 1, 1, '2023-02-22 13:12:45'),
(215, '2630', 'Fabricación de equipos de comunicación', 1, 1, '2023-02-22 13:12:45'),
(216, '264', 'Fabricación de aparatos electrónicos de consumo', 1, 1, '2023-02-22 13:12:45'),
(217, '2640', 'Fabricación de aparatos electrónicos de consumo', 1, 1, '2023-02-22 13:12:45'),
(218, '265', 'Fabricación de equipo de medición, prueba, navegación y control; fabricación de relojes', 1, 1, '2023-02-22 13:12:45'),
(219, '2651', 'abricación de equipo de medición, prueba, navegación y control', 1, 1, '2023-02-22 13:12:45'),
(220, '2652', 'Fabricación de relojes', 1, 1, '2023-02-22 13:12:45'),
(221, '266', 'Fabricación de equipo de irradiación y equipo electrónico de uso médico y terapéutico', 1, 1, '2023-02-22 13:12:45'),
(222, '2660', 'Fabricación de equipo de irradiación y equipo electrónico de uso médico y terapéutico', 1, 1, '2023-02-22 13:12:45'),
(223, '267', 'Fabricación de instrumentos ópticos y equipo fotográfico', 1, 1, '2023-02-22 13:12:45'),
(224, '2670', 'Fabricación de instrumentos ópticos y equipo fotográfico', 1, 1, '2023-02-22 13:12:45'),
(225, '268', 'Fabricación de medios magnéticos y ópticos para almacenamiento de datos', 1, 1, '2023-02-22 13:12:45'),
(226, '2680', 'Fabricación de medios magnéticos y ópticos para almacenamiento de datos', 1, 1, '2023-02-22 13:12:45'),
(227, '271', 'Fabricación de motores, generadores y transformadores eléctricos y de aparatos de distribución y control\r\n                de la energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(228, '2711', 'Fabricación de motores, generadores y transformadores eléctricos', 1, 1, '2023-02-22 13:12:45'),
(229, '2712', 'Fabricación de aparatos de distribución y control de la energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(230, '272', 'Fabricación de pilas, baterías y acumuladores eléctricos', 1, 1, '2023-02-22 13:12:45'),
(231, '2720', 'Fabricación de pilas, baterías y acumuladores eléctricos', 1, 1, '2023-02-22 13:12:45'),
(232, '273', 'Fabricación de hilos y cables aislados y sus dispositivos', 1, 1, '2023-02-22 13:12:45'),
(233, '2731', 'Fabricación de hilos y cables eléctricos y de fibra óptica', 1, 1, '2023-02-22 13:12:45'),
(234, '2732', 'Fabricación de dispositivos de cableado', 1, 1, '2023-02-22 13:12:45'),
(235, '274', 'Fabricación de equipos eléctricos de iluminación', 1, 1, '2023-02-22 13:12:45'),
(236, '2740', 'Fabricación de equipos eléctricos de iluminación', 1, 1, '2023-02-22 13:12:45'),
(237, '275', 'Fabricación de aparatos de uso doméstico', 1, 1, '2023-02-22 13:12:45'),
(238, '2750', 'Fabricación de aparatos de uso doméstico', 1, 1, '2023-02-22 13:12:45'),
(239, '279', 'Fabricación de otros tipos de equipo eléctrico n.c.p', 1, 1, '2023-02-22 13:12:45'),
(240, '2790', 'Fabricación de otros tipos de equipo eléctrico n.c.p', 1, 1, '2023-02-22 13:12:45'),
(241, '281', 'Fabricación de maquinaria y equipo de uso general', 1, 1, '2023-02-22 13:12:45'),
(242, '2811', 'Fabricación de motores, turbinas, y partes para motores de combustión interna', 1, 1, '2023-02-22 13:12:45'),
(243, '2812', 'Fabricación de equipos de potencia hidráulica y neumática', 1, 1, '2023-02-22 13:12:45'),
(244, '2813', 'Fabricación de otras bombas, compresores, grifos y válvulas', 1, 1, '2023-02-22 13:12:45'),
(245, '2814', 'Fabricación de cojinetes, engranajes, trenes de engranajes y piezas de transmisión', 1, 1, '2023-02-22 13:12:45'),
(246, '2815', 'Fabricación de hornos, hogares y quemadores industriales', 1, 1, '2023-02-22 13:12:45'),
(247, '2816', 'Fabricación de equipo de elevación y manipulación', 1, 1, '2023-02-22 13:12:45'),
(248, '2817', 'Fabricación de maquinaria y equipo de oficina (excepto computadoras y equipo periférico)', 1, 1, '2023-02-22 13:12:45'),
(249, '2818', 'Fabricación de herramientas manuales con motor', 1, 1, '2023-02-22 13:12:45'),
(250, '2819', 'Fabricación de otros tipos de maquinaria y equipo de uso general n.c.p', 1, 1, '2023-02-22 13:12:45'),
(251, '282', 'Fabricación de maquinaria y equipo de uso especial', 1, 1, '2023-02-22 13:12:45'),
(252, '2821', 'Fabricación de maquinaria agropecuaria y forestal', 1, 1, '2023-02-22 13:12:45'),
(253, '2822', 'Fabricación de máquinas formadoras de metal y de máquinas herramienta', 1, 1, '2023-02-22 13:12:45'),
(254, '2823', 'Fabricación de maquinaria para la metalurgia', 1, 1, '2023-02-22 13:12:45'),
(255, '2824', 'Fabricación de maquinaria para explotación de minas y canteras y para obras de construcción', 1, 1, '2023-02-22 13:12:45'),
(256, '2825', 'Fabricación de maquinaria para la elaboración de alimentos, bebidas y tabaco', 1, 1, '2023-02-22 13:12:45'),
(257, '2826', 'Fabricación de maquinaria para la elaboración de productos textiles, prendas de vestir y cueros', 1, 1, '2023-02-22 13:12:45'),
(258, '2829', 'Fabricación de otros tipos de maquinaria y equipo de uso especial n.c.p', 1, 1, '2023-02-22 13:12:45'),
(259, '291', 'Fabricación de vehículos automotores y sus motores', 1, 1, '2023-02-22 13:12:45'),
(260, '2910', 'Fabricación de vehículos automotores y sus motores', 1, 1, '2023-02-22 13:12:45'),
(261, '292', 'Fabricación de carrocerías para vehículos automotores; fabricación de remolques y semirremolques', 1, 1, '2023-02-22 13:12:45'),
(262, '2920', 'Fabricación de carrocerías para vehículos automotores; fabricación de remolques y semirremolques', 1, 1, '2023-02-22 13:12:45'),
(263, '293', 'Fabricación de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores', 1, 1, '2023-02-22 13:12:45'),
(264, '2930', 'Fabricación de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores', 1, 1, '2023-02-22 13:12:45'),
(265, '301', 'Construcción de barcos y otras embarcaciones', 1, 1, '2023-02-22 13:12:45'),
(266, '3011', 'Construcción de barcos y de estructuras flotantes', 1, 1, '2023-02-22 13:12:45'),
(267, '3012', 'Construcción de embarcaciones de recreo y deporte', 1, 1, '2023-02-22 13:12:45'),
(268, '302', 'Fabricación de locomotoras y de material rodante para ferrocarriles', 1, 1, '2023-02-22 13:12:45'),
(269, '3020', 'Fabricación de locomotoras y de material rodante para ferrocarriles', 1, 1, '2023-02-22 13:12:45'),
(270, '303', 'Fabricación de aeronaves, naves espaciales y de maquinaria conexa', 1, 1, '2023-02-22 13:12:45'),
(271, '3030', 'Fabricación de aeronaves, naves espaciales y de maquinaria conexa', 1, 1, '2023-02-22 13:12:45'),
(272, '304', 'Fabricación de vehículos militares de combate', 1, 1, '2023-02-22 13:12:45'),
(273, '3040', 'Fabricación de vehículos militares de combate', 1, 1, '2023-02-22 13:12:45'),
(274, '309', 'Fabricación de otros tipos de equipo de transporte n.c.p', 1, 1, '2023-02-22 13:12:45'),
(275, '3091', 'Fabricación de motocicletas', 1, 1, '2023-02-22 13:12:45'),
(276, '3092', 'Fabricación de bicicletas y de sillas de ruedas para personas con discapacidad', 1, 1, '2023-02-22 13:12:45'),
(277, '3099', 'Fabricación de otros tipos de equipo de transporte n.c.p', 1, 1, '2023-02-22 13:12:45'),
(278, '311', 'Fabricación de muebles', 1, 1, '2023-02-22 13:12:45'),
(279, '3110', 'Fabricación de muebles', 1, 1, '2023-02-22 13:12:45'),
(280, '312', 'Fabricación de colchones y somieres', 1, 1, '2023-02-22 13:12:45'),
(281, '3120', 'Fabricación de colchones y somieres', 1, 1, '2023-02-22 13:12:45'),
(282, '321', 'Fabricación de joyas, bisutería y artículos conexos', 1, 1, '2023-02-22 13:12:45'),
(283, '3210', 'Fabricación de joyas, bisutería y artículos conexos', 1, 1, '2023-02-22 13:12:45'),
(284, '322', 'Fabricación de instrumentos musicales', 1, 1, '2023-02-22 13:12:45'),
(285, '3220', 'Fabricación de instrumentos musicales', 1, 1, '2023-02-22 13:12:45'),
(286, '323', 'Fabricación de artículos y equipo para la práctica del deporte', 1, 1, '2023-02-22 13:12:45'),
(287, '3230', 'Fabricación de artículos y equipo para la práctica del deporte', 1, 1, '2023-02-22 13:12:45'),
(288, '324', 'Fabricación de juegos, juguetes y rompecabezas', 1, 1, '2023-02-22 13:12:45'),
(289, '3240', 'Fabricación de juegos, juguetes y rompecabezas', 1, 1, '2023-02-22 13:12:45'),
(290, '325', 'Fabricación de instrumentos, aparatos y materiales médicos y odontológicos (incluido mobiliario)', 1, 1, '2023-02-22 13:12:45'),
(291, '3250', 'Fabricación de instrumentos, aparatos y materiales médicos y odontológicos (incluido mobiliario)', 1, 1, '2023-02-22 13:12:45'),
(292, '329', 'Otras industrias manufactureras n.c.p', 1, 1, '2023-02-22 13:12:45'),
(293, '3290', 'Otras industrias manufactureras n.c.p', 1, 1, '2023-02-22 13:12:45'),
(294, '331', 'Mantenimiento y reparación especializado de productos elaborados en metal y de maquinaria y equipo', 1, 1, '2023-02-22 13:12:45'),
(295, '3311', 'Mantenimiento y reparación especializado de productos elaborados en metal', 1, 1, '2023-02-22 13:12:45'),
(296, '3312', 'Mantenimiento y reparación especializado de maquinaria y equipo', 1, 1, '2023-02-22 13:12:45'),
(297, '3313', 'Mantenimiento y reparación especializado de equipo electrónico y óptico', 1, 1, '2023-02-22 13:12:45'),
(298, '3314', 'Mantenimiento y reparación especializado de equipo eléctrico', 1, 1, '2023-02-22 13:12:45'),
(299, '3315', 'Mantenimiento y reparación especializado de equipo de transporte, excepto los vehículos automotores,\r\n                motocicletas y bicicletas', 1, 1, '2023-02-22 13:12:45'),
(300, '3319', 'Mantenimiento y reparación de otros tipos de equipos y sus componentes n.c.p', 1, 1, '2023-02-22 13:12:45'),
(301, '332', 'Instalación especializada de maquinaria y equipo industrial', 1, 1, '2023-02-22 13:12:45'),
(302, '3320', 'Instalación especializada de maquinaria y equipo industrial', 1, 1, '2023-02-22 13:12:45'),
(303, '351', 'Generación, transmisión, distribución y comercialización de energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(304, '3511', 'Generación de energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(305, '3512', 'Transmisión de energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(306, '3513', 'Distribución de energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(307, '3514', 'Comercialización de energía eléctrica', 1, 1, '2023-02-22 13:12:45'),
(308, '352', 'Producción de gas; distribución de combustibles gaseosos por tuberías', 1, 1, '2023-02-22 13:12:45'),
(309, '3520', 'Producción de gas; distribución de combustibles gaseosos por tuberías', 1, 1, '2023-02-22 13:12:46'),
(310, '353', 'Suministro de vapor y aire acondicionado', 1, 1, '2023-02-22 13:12:46'),
(311, '3530', 'Suministro de vapor y aire acondicionado', 1, 1, '2023-02-22 13:12:46'),
(312, '360', 'Captación, tratamiento y distribución de agua', 1, 1, '2023-02-22 13:12:46'),
(313, '3600', 'Captación, tratamiento y distribución de agua', 1, 1, '2023-02-22 13:12:46'),
(314, '381', 'Recolección de desechos', 1, 1, '2023-02-22 13:12:46'),
(315, '3811', 'Recolección de desechos no peligrosos', 1, 1, '2023-02-22 13:12:46'),
(316, '3812', 'Recolección de desechos peligrosos', 1, 1, '2023-02-22 13:12:46'),
(317, '382', 'Tratamiento y disposición de desechos', 1, 1, '2023-02-22 13:12:46'),
(318, '3821', 'Tratamiento y disposición de desechos no peligrosos', 1, 1, '2023-02-22 13:12:46'),
(319, '3822', 'Tratamiento y disposición de desechos peligrosos', 1, 1, '2023-02-22 13:12:46'),
(320, '383', 'Recuperación de materiales', 1, 1, '2023-02-22 13:12:46'),
(321, '3830', 'Recuperación de materiales', 1, 1, '2023-02-22 13:12:46'),
(322, '16,25', 'Actividades de saneamiento ambiental y otros servicios de gestión de desechos', 1, 1, '2023-02-22 13:12:46'),
(323, '3900', 'Actividades de saneamiento ambiental y otros servicios de gestión de desechos', 1, 1, '2023-02-22 13:12:46'),
(324, '411', 'Construcción de edificios', 1, 1, '2023-02-22 13:12:46'),
(325, '4111', 'Construcción de edificios residenciales', 1, 1, '2023-02-22 13:12:46'),
(326, '4112', 'Construcción de edificios no residenciales', 1, 1, '2023-02-22 13:12:46'),
(327, '421', 'Construcción de carreteras y vías de ferrocarril', 1, 1, '2023-02-22 13:12:46'),
(328, '4210', 'Construcción de carreteras y vías de ferrocarril', 1, 1, '2023-02-22 13:12:46'),
(329, '422', 'Construcción de proyectos de servicio público', 1, 1, '2023-02-22 13:12:46'),
(330, '4220', 'Construcción de proyectos de servicio público', 1, 1, '2023-02-22 13:12:46'),
(331, '429', 'Construcción de otras obras de ingeniería civil', 1, 1, '2023-02-22 13:12:46'),
(332, '4290', 'Construcción de otras obras de ingeniería civil', 1, 1, '2023-02-22 13:12:46'),
(333, '431', 'Demolición y preparación del terreno', 1, 1, '2023-02-22 13:12:46'),
(334, '4311', 'Demolición', 1, 1, '2023-02-22 13:12:46'),
(335, '4312', 'Preparación del terreno', 1, 1, '2023-02-22 13:12:46'),
(336, '432', 'Instalaciones eléctricas, de fontanería y otras instalaciones especializadas', 1, 1, '2023-02-22 13:12:46'),
(337, '4321', 'Instalaciones eléctricas', 1, 1, '2023-02-22 13:12:46'),
(338, '4322', 'Instalaciones de fontanería, calefacción y aire acondicionado', 1, 1, '2023-02-22 13:12:46'),
(339, '4329', 'Otras instalaciones especializadas', 1, 1, '2023-02-22 13:12:46'),
(340, '433', 'Terminación y acabado de edificios y obras de ingeniería civil', 1, 1, '2023-02-22 13:12:46'),
(341, '4330', 'Terminación y acabado de edificios y obras de ingeniería civil', 1, 1, '2023-02-22 13:12:46'),
(342, '439', 'Otras actividades especializadas para la construcción de edificios y obras de ingeniería civil', 1, 1, '2023-02-22 13:12:46'),
(343, '4390', 'Otras actividades especializadas para la construcción de edificios y obras de ingeniería civil', 1, 1, '2023-02-22 13:12:46'),
(344, '451', 'Comercio de vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(345, '4511', 'Comercio de vehículos automotores nuevos', 1, 1, '2023-02-22 13:12:46'),
(346, '4512', 'Comercio de vehículos automotores usados', 1, 1, '2023-02-22 13:12:46'),
(347, '452', 'Mantenimiento y reparación de vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(348, '4520', 'Mantenimiento y reparación de vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(349, '453', 'Comercio de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(350, '4530', 'Comercio de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(351, '454', 'Comercio, mantenimiento y reparación de motocicletas y de sus partes, piezas y accesorios', 1, 1, '2023-02-22 13:12:46'),
(352, '4541', 'Comercio de motocicletas y de sus partes, piezas y accesorios', 1, 1, '2023-02-22 13:12:46'),
(353, '4542', 'Mantenimiento y reparación de motocicletas y de sus partes y piezas', 1, 1, '2023-02-22 13:12:46'),
(354, '46', 'Comercio al por mayor y en comisión o por contrata, excepto el comercio de vehículos automotores y\r\n                motocicletas', 1, 1, '2023-02-22 13:12:46'),
(355, '461', 'Comercio al por mayor a cambio de una retribución o por contrata', 1, 1, '2023-02-22 13:12:46'),
(356, '4610', 'Comercio al por mayor a cambio de una retribución o por contrata', 1, 1, '2023-02-22 13:12:46'),
(357, '462', 'Comercio al por mayor de materias primas agropecuarias; animales vivos', 1, 1, '2023-02-22 13:12:46'),
(358, '4620', 'Comercio al por mayor de materias primas agropecuarias; animales vivos', 1, 1, '2023-02-22 13:12:46'),
(359, '463', 'Comercio al por mayor de alimentos, bebidas y tabaco', 1, 1, '2023-02-22 13:12:46'),
(360, '4631', 'Comercio al por mayor de productos alimenticios', 1, 1, '2023-02-22 13:12:46'),
(361, '4632', 'Comercio al por mayor de bebidas y tabaco', 1, 1, '2023-02-22 13:12:46'),
(362, '464', 'Comercio al por mayor de artículos y enseres domésticos (incluidas prendas de vestir)', 1, 1, '2023-02-22 13:12:46'),
(363, '4641', 'Comercio al por mayor de productos textiles, productos confeccionados para uso doméstico', 1, 1, '2023-02-22 13:12:46'),
(364, '4642', 'Comercio al por mayor de prendas de vestir', 1, 1, '2023-02-22 13:12:46'),
(365, '4643', 'Comercio al por mayor de calzado', 1, 1, '2023-02-22 13:12:46'),
(366, '4644', 'Comercio al por mayor de aparatos y equipo de uso doméstico', 1, 1, '2023-02-22 13:12:46'),
(367, '4645', 'Comercio al por mayor de productos farmacéuticos, medicinales, cosméticos y de tocador', 1, 1, '2023-02-22 13:12:46'),
(368, '4649', 'Comercio al por mayor de otros utensilios domésticos n.c.p', 1, 1, '2023-02-22 13:12:46'),
(369, '465', 'Comercio al por mayor de maquinaria y equipo', 1, 1, '2023-02-22 13:12:46'),
(370, '4651', 'Comercio al por mayor de computadores, equipo periférico y programas de informática', 1, 1, '2023-02-22 13:12:46'),
(371, '4652', 'Comercio al por mayor de equipo, partes y piezas electrónicos y de telecomunicaciones', 1, 1, '2023-02-22 13:12:46'),
(372, '4653', 'Comercio al por mayor de maquinaria y equipo agropecuarios', 1, 1, '2023-02-22 13:12:46'),
(373, '4659', 'Comercio al por mayor de otros tipos de maquinaria y equipo n.c.p', 1, 1, '2023-02-22 13:12:46'),
(374, '466', 'Comercio al por mayor especializado de otros productos', 1, 1, '2023-02-22 13:12:46'),
(375, '4661', 'Comercio al por mayor de combustibles sólidos, líquidos, gaseosos y productos conexos', 1, 1, '2023-02-22 13:12:46'),
(376, '4662', 'Comercio al por mayor de metales y productos metalíferos', 1, 1, '2023-02-22 13:12:46'),
(377, '4663', 'Comercio al por mayor de materiales de construcción, artículos de ferretería, pinturas, productos de\r\n                vidrio, equipo y materiales de fontanería y calefacción', 1, 1, '2023-02-22 13:12:46'),
(378, '4664', 'Comercio al por mayor de productos químicos básicos, cauchos y plásticos en formas primarias y productos\r\n                químicos de uso agropecuario', 1, 1, '2023-02-22 13:12:46'),
(379, '4665', 'Comercio al por mayor de desperdicios, desechos y chatarra', 1, 1, '2023-02-22 13:12:46'),
(380, '4669', 'Comercio al por mayor de otros productos n.c.p', 1, 1, '2023-02-22 13:12:46'),
(381, '469', 'Comercio al por mayor no especializado', 1, 1, '2023-02-22 13:12:46'),
(382, '4690', 'Comercio al por mayor no especializado', 1, 1, '2023-02-22 13:12:46'),
(383, '471', 'Comercio al por menor en establecimientos no especializados', 1, 1, '2023-02-22 13:12:46'),
(384, '4711', 'Comercio al por menor en establecimientos no especializados con surtido compuesto principalmente por\r\n                alimentos, bebidas o tabaco', 1, 1, '2023-02-22 13:12:46'),
(385, '4719', 'Comercio al por menor en establecimientos no especializados, con surtido compuesto principalmente por\r\n                productos diferentes de alimentos (víveres en general), bebidas y tabaco', 1, 1, '2023-02-22 13:12:46'),
(386, '472', 'Comercio al por menor de alimentos (víveres en general), bebidas y tabaco, en establecimientos\r\n                especializados', 1, 1, '2023-02-22 13:12:46'),
(387, '4721', 'abaco, en establecimientos especializados. 4721 Comercio al por menor de productos agrícolas para el\r\n                consumo en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(388, '4722', 'Comercio al por menor de leche, productos lácteos y huevos, en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(389, '4723', 'Comercio al por menor de carnes (incluye aves de corral), productos cárnicos, pescados y productos de\r\n                mar, en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(390, '4724', 'Comercio al por menor de bebidas y productos del tabaco, en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(391, '4729', 'Comercio al por menor de otros productos alimenticios n.c.p., en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(392, '473', 'Comercio al por menor de combustible, lubricantes, aditivos y productos de limpieza para\r\n                automotores, en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(393, '4731', 'Comercio al por menor de combustible para automotores', 1, 1, '2023-02-22 13:12:46'),
(394, '4732', 'Comercio al por menor de lubricantes (aceites, grasas), aditivos y productos de limpieza para\r\n                vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(395, '474', 'Comercio al por menor de equipos de informática y de comunicaciones, en establecimientos\r\n                especializados', 1, 1, '2023-02-22 13:12:46'),
(396, '4741', 'Comercio al por menor de computadores, equipos periféricos, programas de informática y equipos de\r\n                telecomunicaciones en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(397, '4742', 'Comercio al por menor de equipos y aparatos de sonido y de video, en establecimientos\r\n                especializados', 1, 1, '2023-02-22 13:12:46'),
(398, '475', 'Comercio al por menor de otros enseres domésticos en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(399, '4751', 'Comercio al por menor de productos textiles en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(400, '4752', 'Comercio al por menor de artículos de ferretería, pinturas y productos de vidrio en\r\n                establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(401, '4753', 'Comercio al por menor de tapices, alfombras y cubrimientos para paredes y pisos en\r\n                establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(402, '4754', 'Comercio al por menor de electrodomésticos y gasodomésticos de uso doméstico, muebles y equipos de\r\n                iluminación', 1, 1, '2023-02-22 13:12:46'),
(403, '4755', 'Comercio al por menor de artículos y utensilios de uso doméstico', 1, 1, '2023-02-22 13:12:46'),
(404, '4759', 'Comercio al por menor de otros artículos domésticos en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(405, '476', 'Comercio al por menor de artículos culturales y de entretenimiento, en establecimientos\r\n                especializados', 1, 1, '2023-02-22 13:12:46'),
(406, '4761', 'Comercio al por menor de libros, periódicos, materiales y artículos de papelería y escritorio, en\r\n                establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(407, '4762', 'Comercio al por menor de artículos deportivos, en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(408, '4769', 'Comercio al por menor de otros artículos culturales y de entretenimiento n.c.p. en\r\n                establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(409, '477', 'Comercio al por menor de otros productos en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(410, '4771', 'Comercio al por menor de prendas de vestir y sus accesorios (incluye artículos de piel) en\r\n                establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(411, '4772', 'Comercio al por menor de todo tipo de calzado y artículos de cuero y sucedáneos del cuero en\r\n                establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(412, '4773', 'Comercio al por menor de productos farmacéuticos y medicinales, cosméticos y artículos de tocador\r\n                en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(413, '4774', 'Comercio al por menor de otros productos nuevos en establecimientos especializados', 1, 1, '2023-02-22 13:12:46'),
(414, '4775', 'Comercio al por menor de artículos de segunda mano', 1, 1, '2023-02-22 13:12:46'),
(415, '478', 'Comercio al por menor en puestos de venta móviles', 1, 1, '2023-02-22 13:12:46'),
(416, '4781', 'Comercio al por menor de alimentos, bebidas y tabaco, en puestos de venta móviles', 1, 1, '2023-02-22 13:12:46'),
(417, '4789', 'Comercio al por menor de otros productos en puestos de venta móviles', 1, 1, '2023-02-22 13:12:46'),
(418, '479', 'Comercio al por menor no realizado en establecimientos, puestos de venta o mercados', 1, 1, '2023-02-22 13:12:46'),
(419, '4791', 'Comercio al por menor realizado a través de internet', 1, 1, '2023-02-22 13:12:46'),
(420, '4792', 'Comercio al por menor realizado a través de casas de venta o por correo', 1, 1, '2023-02-22 13:12:46'),
(421, '4799', 'Otros tipos de comercio al por menor no realizado en establecimientos, puestos de venta o\r\n                mercados', 1, 1, '2023-02-22 13:12:46'),
(422, '491', 'Transporte férreo', 1, 1, '2023-02-22 13:12:46'),
(423, '4911', 'Transporte férreo de pasajeros', 1, 1, '2023-02-22 13:12:46'),
(424, '4912', 'Transporte férreo de carga', 1, 1, '2023-02-22 13:12:46'),
(425, '492', 'Transporte terrestre público automotor', 1, 1, '2023-02-22 13:12:46'),
(426, '4921', 'Transporte de pasajeros', 1, 1, '2023-02-22 13:12:46'),
(427, '4922', 'Transporte mixto', 1, 1, '2023-02-22 13:12:46'),
(428, '4923', 'Transporte de carga por carretera', 1, 1, '2023-02-22 13:12:46'),
(429, '493', 'Transporte por tuberías', 1, 1, '2023-02-22 13:12:46'),
(430, '4930', 'Transporte por tuberías', 1, 1, '2023-02-22 13:12:46'),
(431, '501', 'Transporte marítimo y de cabotaje', 1, 1, '2023-02-22 13:12:46'),
(432, '5011', 'Transporte de pasajeros marítimo y de cabotaje', 1, 1, '2023-02-22 13:12:46'),
(433, '5012', 'Transporte de carga marítimo y de cabotaje', 1, 1, '2023-02-22 13:12:46'),
(434, '502', 'Transporte fluvial', 1, 1, '2023-02-22 13:12:46'),
(435, '5021', 'Transporte fluvial de pasajeros', 1, 1, '2023-02-22 13:12:46'),
(436, '5022', 'Transporte fluvial de carga', 1, 1, '2023-02-22 13:12:46'),
(437, '511', 'Transporte aéreo de pasajeros', 1, 1, '2023-02-22 13:12:46'),
(438, '5111', 'Transporte aéreo nacional de pasajeros', 1, 1, '2023-02-22 13:12:46'),
(439, '5112', 'Transporte aéreo internacional de pasajeros', 1, 1, '2023-02-22 13:12:46'),
(440, '512', 'Transporte aéreo de carga', 1, 1, '2023-02-22 13:12:46'),
(441, '5121', 'Transporte aéreo nacional de carga', 1, 1, '2023-02-22 13:12:46'),
(442, '5122', 'Transporte aéreo internacional de carga', 1, 1, '2023-02-22 13:12:46'),
(443, '521', 'Almacenamiento y depósito', 1, 1, '2023-02-22 13:12:46'),
(444, '5210', 'Almacenamiento y depósito', 1, 1, '2023-02-22 13:12:46'),
(445, '522', 'Actividades de las estaciones, vías y servicios complementarios para el transporte', 1, 1, '2023-02-22 13:12:46'),
(446, '5221', 'Actividades de estaciones, vías y servicios complementarios para el transporte terrestre', 1, 1, '2023-02-22 13:12:46'),
(447, '5222', 'Actividades de puertos y servicios complementarios para el transporte acuático', 1, 1, '2023-02-22 13:12:46'),
(448, '5223', 'Actividades de aeropuertos, servicios de navegación aérea y demás actividades conexas al\r\n                transporte aéreo', 1, 1, '2023-02-22 13:12:46'),
(449, '5224', 'Manipulación de carga', 1, 1, '2023-02-22 13:12:46'),
(450, '5229', 'Otras actividades complementarias al transporte', 1, 1, '2023-02-22 13:12:46'),
(451, '531', 'Actividades postales nacionales', 1, 1, '2023-02-22 13:12:46'),
(452, '5310', 'Actividades postales nacionales', 1, 1, '2023-02-22 13:12:46'),
(453, '532', 'Actividades de mensajería', 1, 1, '2023-02-22 13:12:46'),
(454, '5320', 'Actividades de mensajería', 1, 1, '2023-02-22 13:12:46'),
(455, '551', 'Actividades de alojamiento de estancias cortas', 1, 1, '2023-02-22 13:12:46'),
(456, '5511', 'Alojamiento en hoteles', 1, 1, '2023-02-22 13:12:46'),
(457, '5512', 'Alojamiento en apartahoteles', 1, 1, '2023-02-22 13:12:46'),
(458, '5513', 'Alojamiento en centros vacacionales', 1, 1, '2023-02-22 13:12:46'),
(459, '5514', 'Alojamiento rural', 1, 1, '2023-02-22 13:12:46'),
(460, '5519', 'Otros tipos de alojamientos para visitantes', 1, 1, '2023-02-22 13:12:46'),
(461, '5520', 'Actividades de zonas de camping y parques para vehículos recreacionales', 1, 1, '2023-02-22 13:12:46'),
(462, '553', 'Servicio por horas', 1, 1, '2023-02-22 13:12:46'),
(463, '5530', 'Servicio por horas', 1, 1, '2023-02-22 13:12:46'),
(464, '559', 'Otros tipos de alojamiento n.c.p', 1, 1, '2023-02-22 13:12:46'),
(465, '5590', 'Otros tipos de alojamiento n.c.p', 1, 1, '2023-02-22 13:12:46'),
(466, '561', 'Actividades de restaurantes, cafeterías y servicio móvil de comidas', 1, 1, '2023-02-22 13:12:46'),
(467, '5611', 'Expendio a la mesa de comidas preparadas', 1, 1, '2023-02-22 13:12:46'),
(468, '5612', 'Expendio por autoservicio de comidas preparadas', 1, 1, '2023-02-22 13:12:46'),
(469, '5613', 'Expendio de comidas preparadas en cafeterías', 1, 1, '2023-02-22 13:12:46'),
(470, '5619', 'Otros tipos de expendio de comidas preparadas n.c.p', 1, 1, '2023-02-22 13:12:46'),
(471, '562', 'Actividades de catering para eventos y otros servicios de comidas', 1, 1, '2023-02-22 13:12:46'),
(472, '5621', 'Catering para eventos', 1, 1, '2023-02-22 13:12:46'),
(473, '5629', 'Actividades de otros servicios de comidas', 1, 1, '2023-02-22 13:12:46'),
(474, '563', 'Expendio de bebidas alcohólicas para el consumo dentro del establecimiento', 1, 1, '2023-02-22 13:12:46'),
(475, '5630', 'Expendio de bebidas alcohólicas para el consumo dentro del establecimiento', 1, 1, '2023-02-22 13:12:46'),
(476, '581', 'Edición de libros, publicaciones periódicas y otras actividades de edición', 1, 1, '2023-02-22 13:12:46'),
(477, '5811', 'Edición de libros', 1, 1, '2023-02-22 13:12:46'),
(478, '5812', 'Edición de directorios y listas de correo', 1, 1, '2023-02-22 13:12:46'),
(479, '5813', 'Edición de periódicos, revistas y otras publicaciones periódicas', 1, 1, '2023-02-22 13:12:46'),
(480, '5819', 'Otros trabajos de edición', 1, 1, '2023-02-22 13:12:46'),
(481, '582', 'Edición de programas de informática (software)', 1, 1, '2023-02-22 13:12:46'),
(482, '5820', 'Edición de programas de informática (software)', 1, 1, '2023-02-22 13:12:46');
INSERT INTO `actividades_economicas` (`id`, `code`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(483, '591', 'Actividades de producción de películas cinematográficas, video y producción de programas, anuncios y\r\n                comerciales de televisión', 1, 1, '2023-02-22 13:12:46'),
(484, '5911', 'Actividades de producción de películas cinematográficas, videos, programas, anuncios y comerciales de\r\n                televisión', 1, 1, '2023-02-22 13:12:46'),
(485, '5912', 'Actividades de posproducción de películas cinematográficas, videos, programas, anuncios y comerciales de\r\n                televisión', 1, 1, '2023-02-22 13:12:46'),
(486, '5913', 'Actividades de distribución de películas cinematográficas, videos, programas, anuncios y comerciales de\r\n                televisión', 1, 1, '2023-02-22 13:12:46'),
(487, '5914', 'ctividades de exhibición de películas cinematográficas y videos', 1, 1, '2023-02-22 13:12:46'),
(488, '592', 'Actividades de grabación de sonido y edición de música', 1, 1, '2023-02-22 13:12:46'),
(489, '5920', 'Actividades de grabación de sonido y edición de música', 1, 1, '2023-02-22 13:12:46'),
(490, '601', 'Actividades de programación y transmisión en el servicio de radiodifusión sonora', 1, 1, '2023-02-22 13:12:46'),
(491, '6010', 'Actividades de programación y transmisión en el servicio de radiodifusión sonora', 1, 1, '2023-02-22 13:12:46'),
(492, '602', 'Actividades de programación y transmisión de televisión', 1, 1, '2023-02-22 13:12:46'),
(493, '6020', 'Actividades de programación y transmisión de televisión', 1, 1, '2023-02-22 13:12:46'),
(494, '611', 'Actividades de telecomunicaciones alámbricas', 1, 1, '2023-02-22 13:12:46'),
(495, '6110', 'Actividades de telecomunicaciones alámbricas', 1, 1, '2023-02-22 13:12:46'),
(496, '612', 'Actividades de telecomunicaciones inalámbricas', 1, 1, '2023-02-22 13:12:46'),
(497, '6120', 'Actividades de telecomunicaciones inalámbricas', 1, 1, '2023-02-22 13:12:46'),
(498, '613', 'Actividades de telecomunicación satelital', 1, 1, '2023-02-22 13:12:46'),
(499, '6130', 'Actividades de telecomunicación satelital', 1, 1, '2023-02-22 13:12:46'),
(500, '619', 'Otras actividades de telecomunicaciones', 1, 1, '2023-02-22 13:12:46'),
(501, '6190', 'Otras actividades de telecomunicaciones', 1, 1, '2023-02-22 13:12:46'),
(502, '620', 'Desarrollo de sistemas informáticos (planificación, análisis, diseño, programación, pruebas),\r\n                consultoría informática y actividades relacionadas', 1, 1, '2023-02-22 13:12:46'),
(503, '6201', 'Actividades de desarrollo de sistemas informáticos (planificación, análisis, diseño, programación,\r\n                pruebas)', 1, 1, '2023-02-22 13:12:46'),
(504, '6202', 'Actividades de consultoría informática y actividades de administración de instalaciones\r\n                informáticas', 1, 1, '2023-02-22 13:12:46'),
(505, '6209', 'Otras actividades de tecnologías de información y actividades de servicios informáticos', 1, 1, '2023-02-22 13:12:46'),
(506, '6311', 'Procesamiento de datos, alojamiento (hosting) y actividades relacionadas; portales web', 1, 1, '2023-02-22 13:12:46'),
(507, '6312', 'Portales web', 1, 1, '2023-02-22 13:12:46'),
(508, '639', 'Otras actividades de servicio de información', 1, 1, '2023-02-22 13:12:46'),
(509, '6391', 'Actividades de agencias de noticias', 1, 1, '2023-02-22 13:12:46'),
(510, '6399', 'Otras actividades de servicio de información n.c.p', 1, 1, '2023-02-22 13:12:46'),
(511, '641', 'Intermediación monetaria', 1, 1, '2023-02-22 13:12:46'),
(512, '6411', 'Banco Central', 1, 1, '2023-02-22 13:12:46'),
(513, '6412', 'Bancos comerciales', 1, 1, '2023-02-22 13:12:46'),
(514, '642', 'Otros tipos de intermediación monetaria', 1, 1, '2023-02-22 13:12:46'),
(515, '6421', 'Actividades de las corporaciones financieras', 1, 1, '2023-02-22 13:12:46'),
(516, '6422', 'Actividades de las compañías de financiamiento', 1, 1, '2023-02-22 13:12:46'),
(517, '6423', 'Banca de segundo piso', 1, 1, '2023-02-22 13:12:46'),
(518, '6424', 'Actividades de las cooperativas financieras', 1, 1, '2023-02-22 13:12:46'),
(519, '643', 'Fideicomisos, fondos (incluye fondos de cesantías) y entidades financieras similares', 1, 1, '2023-02-22 13:12:46'),
(520, '6431', 'Fideicomisos, fondos y entidades financieras similares', 1, 1, '2023-02-22 13:12:46'),
(521, '6432', 'Fondos de cesantías', 1, 1, '2023-02-22 13:12:46'),
(522, '649', 'Otras actividades de servicio financiero, excepto las de seguros y pensiones', 1, 1, '2023-02-22 13:12:46'),
(523, '6491', 'Leasing financiero (arrendamiento financiero)', 1, 1, '2023-02-22 13:12:46'),
(524, '6492', 'Actividades financieras de fondos de empleados y otras formas asociativas del sector solidario', 1, 1, '2023-02-22 13:12:46'),
(525, '6493', 'Actividades de compra de cartera o factoring', 1, 1, '2023-02-22 13:12:46'),
(526, '6494', 'Otras actividades de distribución de fondos', 1, 1, '2023-02-22 13:12:46'),
(527, '6495', 'Instituciones especiales oficiales', 1, 1, '2023-02-22 13:12:46'),
(528, '6499', 'Otras actividades de servicio financiero, excepto las de seguros y pensiones n.c.p', 1, 1, '2023-02-22 13:12:46'),
(529, '651', 'Seguros y capitalización', 1, 1, '2023-02-22 13:12:46'),
(530, '6511', 'Seguros generales', 1, 1, '2023-02-22 13:12:46'),
(531, '6512', 'Seguros de vida', 1, 1, '2023-02-22 13:12:46'),
(532, '6513', 'Reaseguros', 1, 1, '2023-02-22 13:12:46'),
(533, '6514', 'Capitalización', 1, 1, '2023-02-22 13:12:46'),
(534, '652', 'Servicios de seguros sociales de salud y riesgos profesionales', 1, 1, '2023-02-22 13:12:46'),
(535, '6521', 'Servicios de seguros sociales de salud', 1, 1, '2023-02-22 13:12:46'),
(536, '6522', 'Servicios de seguros sociales de riesgos profesionales', 1, 1, '2023-02-22 13:12:46'),
(537, '653', 'Servicios de seguros sociales de pensiones', 1, 1, '2023-02-22 13:12:46'),
(538, '6531', 'Régimen de prima media con prestación definida (RPM)', 1, 1, '2023-02-22 13:12:46'),
(539, '6532', 'Régimen de ahorro individual (RAI)', 1, 1, '2023-02-22 13:12:46'),
(540, '661', 'Actividades auxiliares de las actividades de servicios financieros, excepto las de seguros y pensiones', 1, 1, '2023-02-22 13:12:46'),
(541, '6611', 'Administración de mercados financieros', 1, 1, '2023-02-22 13:12:46'),
(542, '6612', 'Corretaje de valores y de contratos de productos básicos', 1, 1, '2023-02-22 13:12:46'),
(543, '6613', 'Otras actividades relacionadas con el mercado de valores', 1, 1, '2023-02-22 13:12:46'),
(544, '6614', 'Actividades de las casas de cambio', 1, 1, '2023-02-22 13:12:46'),
(545, '6615', 'Actividades de los profesionales de compra y venta de divisas', 1, 1, '2023-02-22 13:12:46'),
(546, '6619', 'Otras actividades auxiliares de las actividades de servicios financieros n.c.p', 1, 1, '2023-02-22 13:12:46'),
(547, '662', 'Actividades de servicios auxiliares de los servicios de seguros y pensiones', 1, 1, '2023-02-22 13:12:46'),
(548, '6621', 'Actividades de agentes y corredores de seguros', 1, 1, '2023-02-22 13:12:46'),
(549, '6629', 'Evaluación de riesgos y daños, y otras actividades de servicios auxiliares', 1, 1, '2023-02-22 13:12:46'),
(550, '663', 'Actividades de administración de fondos', 1, 1, '2023-02-22 13:12:46'),
(551, '6630', 'Actividades de administración de fondos', 1, 1, '2023-02-22 13:12:46'),
(552, '681', 'Actividades inmobiliarias realizadas con bienes propios o arrendados', 1, 1, '2023-02-22 13:12:46'),
(553, '6810', 'Actividades inmobiliarias realizadas con bienes propios o arrendados', 1, 1, '2023-02-22 13:12:46'),
(554, '682', 'Actividades inmobiliarias realizadas a cambio de una retribución o por contrata', 1, 1, '2023-02-22 13:12:46'),
(555, '6820', 'Actividades inmobiliarias realizadas a cambio de una retribución o por contrata', 1, 1, '2023-02-22 13:12:46'),
(556, '691', 'Actividades jurídicas', 1, 1, '2023-02-22 13:12:46'),
(557, '6910', 'Actividades jurídicas', 1, 1, '2023-02-22 13:12:46'),
(558, '692', 'Actividades de contabilidad, teneduría de libros, auditoría financiera y asesoría tributaria', 1, 1, '2023-02-22 13:12:46'),
(559, '6920', 'Actividades de contabilidad, teneduría de libros, auditoría financiera y asesoría tributaria', 1, 1, '2023-02-22 13:12:46'),
(560, '711', 'Actividades de arquitectura e ingeniería y otras actividades conexas de consultoría técnica', 1, 1, '2023-02-22 13:12:46'),
(561, '7110', 'Actividades de arquitectura e ingeniería y otras actividades conexas de consultoría técnica', 1, 1, '2023-02-22 13:12:46'),
(562, '712', 'Ensayos y análisis técnicos', 1, 1, '2023-02-22 13:12:46'),
(563, '7120', 'Ensayos y análisis técnicos', 1, 1, '2023-02-22 13:12:46'),
(564, '721', 'Investigaciones y desarrollo experimental en el campo de las ciencias naturales y la ingeniería', 1, 1, '2023-02-22 13:12:46'),
(565, '7210', 'Investigaciones y desarrollo experimental en el campo de las ciencias naturales y la ingeniería', 1, 1, '2023-02-22 13:12:46'),
(566, '722', 'Investigaciones y desarrollo experimental en el campo de las ciencias sociales y las humanidades', 1, 1, '2023-02-22 13:12:46'),
(567, '7220', 'Investigaciones y desarrollo experimental en el campo de las ciencias sociales y las\r\n                humanidades', 1, 1, '2023-02-22 13:12:46'),
(568, '731', 'Publicidad', 1, 1, '2023-02-22 13:12:46'),
(569, '7310', 'Publicidad', 1, 1, '2023-02-22 13:12:46'),
(570, '732', 'Estudios de mercado y realización de encuestas de opinión pública', 1, 1, '2023-02-22 13:12:46'),
(571, '7320', 'Estudios de mercado y realización de encuestas de opinión pública', 1, 1, '2023-02-22 13:12:46'),
(572, '741', 'Actividades especializadas de diseño', 1, 1, '2023-02-22 13:12:46'),
(573, '7410', 'Actividades especializadas de diseño', 1, 1, '2023-02-22 13:12:46'),
(574, '742', 'Actividades de fotografía', 1, 1, '2023-02-22 13:12:46'),
(575, '7420', 'Actividades de fotografía', 1, 1, '2023-02-22 13:12:46'),
(576, '749', 'Otras actividades profesionales, científicas y técnicas n.c.p', 1, 1, '2023-02-22 13:12:46'),
(577, '7490', 'Otras actividades profesionales, científicas y técnicas n.c.p', 1, 1, '2023-02-22 13:12:46'),
(578, '750', 'Actividades veterinarias', 1, 1, '2023-02-22 13:12:46'),
(579, '7500', 'Actividades veterinarias', 1, 1, '2023-02-22 13:12:46'),
(580, '771', 'Alquiler y arrendamiento de vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(581, '7710', 'Alquiler y arrendamiento de vehículos automotores', 1, 1, '2023-02-22 13:12:46'),
(582, '772', 'Alquiler y arrendamiento de efectos personales y enseres domésticos', 1, 1, '2023-02-22 13:12:46'),
(583, '7721', 'Alquiler y arrendamiento de equipo recreativo y deportivo', 1, 1, '2023-02-22 13:12:46'),
(584, '7722', 'Alquiler de videos y discos', 1, 1, '2023-02-22 13:12:46'),
(585, '7729', 'Alquiler y arrendamiento de otros efectos personales y enseres domésticos n.c.p', 1, 1, '2023-02-22 13:12:46'),
(586, '773', 'Alquiler y arrendamiento de otros tipos de maquinaria, equipo y bienes tangibles n.c.p', 1, 1, '2023-02-22 13:12:46'),
(587, '7730', 'Alquiler y arrendamiento de otros tipos de maquinaria, equipo y bienes tangibles n.c.p', 1, 1, '2023-02-22 13:12:46'),
(588, '774', 'Arrendamiento de propiedad intelectual y productos similares, excepto obras protegidas por derechos de\r\n                autor', 1, 1, '2023-02-22 13:12:46'),
(589, '7740', 'Arrendamiento de propiedad intelectual y productos similares, excepto obras protegidas por\r\n                derechos de autor', 1, 1, '2023-02-22 13:12:46'),
(590, '781', 'Actividades de agencias de empleo', 1, 1, '2023-02-22 13:12:46'),
(591, '7810', 'Actividades de agencias de empleo', 1, 1, '2023-02-22 13:12:46'),
(592, '782', 'Actividades de agencias de empleo temporal', 1, 1, '2023-02-22 13:12:46'),
(593, '7820', 'Actividades de agencias de empleo temporal', 1, 1, '2023-02-22 13:12:46'),
(594, '783', 'Otras actividades de suministro de recurso humano', 1, 1, '2023-02-22 13:12:46'),
(595, '7830', 'Otras actividades de suministro de recurso humano', 1, 1, '2023-02-22 13:12:46'),
(596, '791', 'Actividades de las agencias de viajes y operadores turísticos', 1, 1, '2023-02-22 13:12:46'),
(597, '7911', 'Actividades de las agencias de viaje', 1, 1, '2023-02-22 13:12:46'),
(598, '7912', 'Actividades de operadores turísticos', 1, 1, '2023-02-22 13:12:46'),
(599, '799', 'Otros servicios de reserva y actividades relacionadas', 1, 1, '2023-02-22 13:12:46'),
(600, '7990', 'Otros servicios de reserva y actividades relacionadas', 1, 1, '2023-02-22 13:12:46'),
(601, '801', 'Actividades de seguridad privada', 1, 1, '2023-02-22 13:12:46'),
(602, '8010', 'Actividades de seguridad privada', 1, 1, '2023-02-22 13:12:46'),
(603, '802', 'Actividades de servicios de sistemas de seguridad', 1, 1, '2023-02-22 13:12:46'),
(604, '8020', 'Actividades de servicios de sistemas de seguridad', 1, 1, '2023-02-22 13:12:46'),
(605, '803', 'Actividades de detectives e investigadores privados', 1, 1, '2023-02-22 13:12:46'),
(606, '8030', 'Actividades de detectives e investigadores privados', 1, 1, '2023-02-22 13:12:46'),
(607, '811', 'Actividades combinadas de apoyo a instalaciones', 1, 1, '2023-02-22 13:12:46'),
(608, '8110', 'Actividades combinadas de apoyo a instalaciones', 1, 1, '2023-02-22 13:12:46'),
(609, '812', 'Actividades de limpieza', 1, 1, '2023-02-22 13:12:46'),
(610, '8121', 'Limpieza general interior de edificios', 1, 1, '2023-02-22 13:12:46'),
(611, '8129', 'Otras actividades de limpieza de edificios e instalaciones industriales', 1, 1, '2023-02-22 13:12:46'),
(612, '813', 'Actividades de paisajismo y servicios de mantenimiento conexos', 1, 1, '2023-02-22 13:12:46'),
(613, '8130', 'Actividades de paisajismo y servicios de mantenimiento conexos', 1, 1, '2023-02-22 13:12:46'),
(614, '821', 'Actividades administrativas y de apoyo de oficina', 1, 1, '2023-02-22 13:12:46'),
(615, '8211', 'Actividades combinadas de servicios administrativos de oficina', 1, 1, '2023-02-22 13:12:46'),
(616, '8219', 'Fotocopiado, preparación de documentos y otras actividades especializadas de apoyo a oficina', 1, 1, '2023-02-22 13:12:46'),
(617, '822', 'Actividades de centros de llamadas (Call center)', 1, 1, '2023-02-22 13:12:46'),
(618, '8220', 'Actividades de centros de llamadas (Call center)', 1, 1, '2023-02-22 13:12:46'),
(619, '823', 'Organización de convenciones y eventos comerciales', 1, 1, '2023-02-22 13:12:46'),
(620, '8230', 'Organización de convenciones y eventos comerciales', 1, 1, '2023-02-22 13:12:46'),
(621, '829', 'Actividades de servicios de apoyo a las empresas n.c.p', 1, 1, '2023-02-22 13:12:46'),
(622, '8291', 'Actividades de agencias de cobranza y oficinas de calificación crediticia', 1, 1, '2023-02-22 13:12:46'),
(623, '8292', 'Actividades de envase y empaque', 1, 1, '2023-02-22 13:12:46'),
(624, '8299', 'Otras actividades de servicio de apoyo a las empresas n.c.p', 1, 1, '2023-02-22 13:12:46'),
(625, '841', 'Administración del Estado y aplicación de la política económica y social de la comunidad', 1, 1, '2023-02-22 13:12:46'),
(626, '8411', 'Actividades legislativas de la administración pública', 1, 1, '2023-02-22 13:12:46'),
(627, '8412', 'Actividades ejecutivas de la administración pública', 1, 1, '2023-02-22 13:12:46'),
(628, '8413', 'Regulación de las actividades de organismos que prestan servicios de salud, educativos, culturales.y\r\n                otros servicios sociales, excepto servicios de seguridad social', 1, 1, '2023-02-22 13:12:46'),
(629, '8414', 'Actividades reguladoras y facilitadoras de la actividad económica', 1, 1, '2023-02-22 13:12:46'),
(630, '8415', 'Actividades de los otros órganos de control', 1, 1, '2023-02-22 13:12:46'),
(631, '842', 'Prestación de servicios a la comunidad en general', 1, 1, '2023-02-22 13:12:46'),
(632, '8421', 'Relaciones exteriores', 1, 1, '2023-02-22 13:12:46'),
(633, '8422', 'Actividades de defensa', 1, 1, '2023-02-22 13:12:46'),
(634, '8423', 'Orden público y actividades de seguridad', 1, 1, '2023-02-22 13:12:46'),
(635, '8424', 'Administración de justicia', 1, 1, '2023-02-22 13:12:46'),
(636, '843', 'Actividades de planes de seguridad social de afiliación obligatoria', 1, 1, '2023-02-22 13:12:46'),
(637, '8430', 'Actividades de planes de seguridad social de afiliación obligatoria', 1, 1, '2023-02-22 13:12:46'),
(638, '851', 'Educación de la primera infancia, preescolar y básica primaria', 1, 1, '2023-02-22 13:12:46'),
(639, '8511', 'Educación de la primera infancia', 1, 1, '2023-02-22 13:12:46'),
(640, '8512', 'Educación preescolar', 1, 1, '2023-02-22 13:12:46'),
(641, '8513', 'Educación básica primaria', 1, 1, '2023-02-22 13:12:46'),
(642, '852', 'Educación secundaria y de formación laboral', 1, 1, '2023-02-22 13:12:46'),
(643, '8521', 'Educación básica secundaria', 1, 1, '2023-02-22 13:12:46'),
(644, '8522', 'Educación media académica', 1, 1, '2023-02-22 13:12:46'),
(645, '8523', 'Educación media técnica y de formación laboral', 1, 1, '2023-02-22 13:12:46'),
(646, '853', 'Establecimientos que combinan diferentes niveles de educación', 1, 1, '2023-02-22 13:12:46'),
(647, '8530', 'Establecimientos que combinan diferentes niveles de educación', 1, 1, '2023-02-22 13:12:46'),
(648, '854', 'Educación superior', 1, 1, '2023-02-22 13:12:46'),
(649, '8541', 'Educación técnica profesional', 1, 1, '2023-02-22 13:12:46'),
(650, '8542', 'Educación tecnológica', 1, 1, '2023-02-22 13:12:46'),
(651, '8543', 'Educación de instituciones universitarias o de escuelas tecnológicas', 1, 1, '2023-02-22 13:12:46'),
(652, '8544', 'Educación de universidades', 1, 1, '2023-02-22 13:12:46'),
(653, '855', 'Otros tipos de educación', 1, 1, '2023-02-22 13:12:46'),
(654, '8551', 'Formación académica no formal', 1, 1, '2023-02-22 13:12:46'),
(655, '8552', 'Enseñanza deportiva y recreativa', 1, 1, '2023-02-22 13:12:46'),
(656, '8553', 'Enseñanza cultural', 1, 1, '2023-02-22 13:12:46'),
(657, '8559', 'Otros tipos de educación n.c.p', 1, 1, '2023-02-22 13:12:46'),
(658, '856', 'Actividades de apoyo a la educación', 1, 1, '2023-02-22 13:12:46'),
(659, '8560', 'Actividades de apoyo a la educación', 1, 1, '2023-02-22 13:12:46'),
(660, '861', 'Actividades de hospitales y clínicas, con internación', 1, 1, '2023-02-22 13:12:46'),
(661, '8610', 'Actividades de hospitales y clínicas, con internación', 1, 1, '2023-02-22 13:12:46'),
(662, '862', 'Actividades de práctica médica y odontológica, sin internación', 1, 1, '2023-02-22 13:12:46'),
(663, '8621', 'Actividades de la práctica médica, sin internación', 1, 1, '2023-02-22 13:12:46'),
(664, '8622', 'Actividades de la práctica odontológica', 1, 1, '2023-02-22 13:12:46'),
(665, '869', 'Otras actividades de atención relacionadas con la salud humana', 1, 1, '2023-02-22 13:12:46'),
(666, '8691', 'Actividades de apoyo diagnóstico', 1, 1, '2023-02-22 13:12:46'),
(667, '8692', 'Actividades de apoyo terapéutico', 1, 1, '2023-02-22 13:12:46'),
(668, '8699', 'Otras actividades de atención de la salud humana', 1, 1, '2023-02-22 13:12:46'),
(669, '871', 'Actividades de atención residencial medicalizada de tipo general', 1, 1, '2023-02-22 13:12:46'),
(670, '8710', 'Actividades de atención residencial medicalizada de tipo general', 1, 1, '2023-02-22 13:12:46'),
(671, '872', 'Actividades de atención residencial, para el cuidado de pacientes con retardo mental, enfermedad mental\r\n                y consumo de sustancias psicoactivas', 1, 1, '2023-02-22 13:12:46'),
(672, '8720', 'Actividades de atención residencial, para el cuidado de pacientes con retardo mental, enfermedad mental\r\n                y consumo de sustancias psicoactivas', 1, 1, '2023-02-22 13:12:46'),
(673, '873', 'Actividades de atención en instituciones para el cuidado de personas mayores y/o discapacitadas', 1, 1, '2023-02-22 13:12:46'),
(674, '8730', 'Actividades de atención en instituciones para el cuidado de personas mayores y/o discapacitadas', 1, 1, '2023-02-22 13:12:46'),
(675, '879', 'Otras actividades de atención en instituciones con alojamiento', 1, 1, '2023-02-22 13:12:46'),
(676, '8790', 'Otras actividades de atención en instituciones con alojamiento', 1, 1, '2023-02-22 13:12:46'),
(677, '881', 'Actividades de asistencia social sin alojamiento para personas mayores y discapacitadas', 1, 1, '2023-02-22 13:12:46'),
(678, '8810', 'Actividades de asistencia social sin alojamiento para personas mayores y discapacitadas', 1, 1, '2023-02-22 13:12:46'),
(679, '889', 'Otras actividades de asistencia social sin alojamiento', 1, 1, '2023-02-22 13:12:46'),
(680, '8890', 'Otras actividades de asistencia social sin alojamiento', 1, 1, '2023-02-22 13:12:46'),
(681, '900', 'Actividades creativas, artísticas y de entretenimiento', 1, 1, '2023-02-22 13:12:46'),
(682, '9001', 'Creación literaria', 1, 1, '2023-02-22 13:12:46'),
(683, '9002', 'Creación musical', 1, 1, '2023-02-22 13:12:46'),
(684, '9003', 'Creación teatral', 1, 1, '2023-02-22 13:12:46'),
(685, '9004', 'Creación audiovisual', 1, 1, '2023-02-22 13:12:46'),
(686, '9005', 'Artes plásticas y visuales', 1, 1, '2023-02-22 13:12:46'),
(687, '9006', 'Actividades teatrales', 1, 1, '2023-02-22 13:12:46'),
(688, '9007', 'Actividades de espectáculos musicales en vivo', 1, 1, '2023-02-22 13:12:46'),
(689, '9008', 'Otras actividades de espectáculos en vivo', 1, 1, '2023-02-22 13:12:46'),
(690, '910', 'Actividades de bibliotecas, archivos, museos y otras actividades culturales', 1, 1, '2023-02-22 13:12:46'),
(691, '9101', 'Actividades de bibliotecas y archivos', 1, 1, '2023-02-22 13:12:46'),
(692, '9102', 'Actividades y funcionamiento de museos, conservación de edificios y sitios históricos', 1, 1, '2023-02-22 13:12:46'),
(693, '9103', 'Actividades de jardines botánicos, zoológicos y reservas naturales', 1, 1, '2023-02-22 13:12:46'),
(694, '920', 'Actividades de juegos de azar y apuestas', 1, 1, '2023-02-22 13:12:46'),
(695, '9200', 'Actividades de juegos de azar y apuestas', 1, 1, '2023-02-22 13:12:46'),
(696, '931', 'Actividades deportivas', 1, 1, '2023-02-22 13:12:46'),
(697, '9311', 'Gestión de instalaciones deportivas', 1, 1, '2023-02-22 13:12:46'),
(698, '9312', 'Actividades de clubes deportivos', 1, 1, '2023-02-22 13:12:46'),
(699, '9319', 'Otras actividades deportivas', 1, 1, '2023-02-22 13:12:46'),
(700, '932', 'Otras actividades recreativas y de esparcimiento', 1, 1, '2023-02-22 13:12:46'),
(701, '9321', 'Actividades de parques de atracciones y parques temáticos', 1, 1, '2023-02-22 13:12:46'),
(702, '9329', 'Otras actividades recreativas y de esparcimiento n.c.p', 1, 1, '2023-02-22 13:12:46'),
(703, '941', 'Actividades de asociaciones empresariales y de empleadores, y asociaciones profesionales', 1, 1, '2023-02-22 13:12:46'),
(704, '9411', 'Actividades de asociaciones empresariales y de empleadores', 1, 1, '2023-02-22 13:12:46'),
(705, '9412', 'Actividades de asociaciones profesionales', 1, 1, '2023-02-22 13:12:46'),
(706, '942', 'Actividades de sindicatos de empleados', 1, 1, '2023-02-22 13:12:46'),
(707, '9420', 'Actividades de sindicatos de empleados', 1, 1, '2023-02-22 13:12:46'),
(708, '949', 'Actividades de otras asociaciones', 1, 1, '2023-02-22 13:12:46'),
(709, '9491', 'Actividades de asociaciones religiosas', 1, 1, '2023-02-22 13:12:46'),
(710, '9492', 'Actividades de asociaciones políticas', 1, 1, '2023-02-22 13:12:46'),
(711, '9499', 'Actividades de otras asociaciones n.c.p', 1, 1, '2023-02-22 13:12:46'),
(712, '951', 'Mantenimiento y reparación de computadores y equipo de comunicaciones', 1, 1, '2023-02-22 13:12:46'),
(713, '9511', 'Mantenimiento y reparación de computadores y de equipo periférico', 1, 1, '2023-02-22 13:12:46'),
(714, '9512', 'Mantenimiento y reparación de equipos de comunicación', 1, 1, '2023-02-22 13:12:46'),
(715, '9521', 'Mantenimiento y reparación de aparatos electrónicos de consumo', 1, 1, '2023-02-22 13:12:46'),
(716, '9522', 'Mantenimiento y reparación de aparatos y equipos domésticos y de jardinería', 1, 1, '2023-02-22 13:12:46'),
(717, '9523', 'Reparación de calzado y artículos de cuero', 1, 1, '2023-02-22 13:12:46'),
(718, '9524', 'Reparación de muebles y accesorios para el hogar', 1, 1, '2023-02-22 13:12:46'),
(719, '9529', 'Mantenimiento y reparación de otros efectos personales y enseres domésticos', 1, 1, '2023-02-22 13:12:46'),
(720, '960', 'Otras actividades de servicios personales', 1, 1, '2023-02-22 13:12:46'),
(721, '9601', 'Lavado y limpieza, incluso la limpieza en seco, de productos textiles y de piel', 1, 1, '2023-02-22 13:12:46'),
(722, '9602', 'Peluquería y otros tratamientos de belleza', 1, 1, '2023-02-22 13:12:46'),
(723, '9603', 'Pompas fúnebres y actividades relacionadas', 1, 1, '2023-02-22 13:12:46'),
(724, '9609', 'Otras actividades de servicios personales n.c.p', 1, 1, '2023-02-22 13:12:46'),
(725, '970', 'Actividades de los hogares individuales como empleadores de personal doméstico', 1, 1, '2023-02-22 13:12:46'),
(726, '9700', 'Actividades de los hogares individuales como empleadores de personal doméstico', 1, 1, '2023-02-22 13:12:46'),
(727, '981', 'Actividades no diferenciadas de los hogares individuales como productores de bienes para uso propio', 1, 1, '2023-02-22 13:12:46'),
(728, '9810', 'Actividades no diferenciadas de los hogares individuales como productores de bienes para uso propio', 1, 1, '2023-02-22 13:12:46'),
(729, '982', 'Actividades no diferenciadas de los hogares individuales como productores de servicios para uso propio', 1, 1, '2023-02-22 13:12:46'),
(730, '9820', 'Actividades no diferenciadas de los hogares individuales como productores de servicios para uso propio', 1, 1, '2023-02-22 13:12:46'),
(731, '0010', 'Asalariados', 1, 1, '2023-02-22 13:12:46'),
(732, '0020', 'Pensionados', 1, 1, '2023-02-22 13:12:46'),
(733, '0081', 'Personas Naturales sin Actividad Económica', 1, 1, '2023-02-22 13:12:46'),
(734, '0082', 'Personas Naturales Subsidiadas por Terceros', 1, 1, '2023-02-22 13:12:46'),
(735, '0090', 'Rentistas de Capital, solo para personas naturales', 1, 1, '2023-02-22 13:12:46'),
(736, '1', '1', 0, 1, '2023-02-22 22:10:29'),
(737, 'RRRR', 'RRRR', 0, 1, '2023-02-23 11:40:21');

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

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `id_empleado`, `id_cliente`, `descripcion`, `asignacion`, `fecha`, `fecha_culminacion`, `status`, `created_by`, `fecha_completada`, `visto_bueno`, `devuelta`, `codigo`, `revision`) VALUES
(887, 1, 11, 'Ver la asdjaskdjnf', 'Revisar la casa', '2023-03-22 10:41:00', '2023-03-23 10:42:00', 0, 1, NULL, 0, 0, 'RE1663935591', 0);

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
-- Estructura de tabla para la tabla `avances_reparaciones`
--

CREATE TABLE `avances_reparaciones` (
  `id` int(11) NOT NULL,
  `detalle_id` int(11) NOT NULL,
  `observacion` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(87, 'RADIOS CASA', 1, '2023-01-12'),
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
-- Estructura de tabla para la tabla `categorias_reparaciones`
--

CREATE TABLE `categorias_reparaciones` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_reparaciones`
--

INSERT INTO `categorias_reparaciones` (`id`, `categoria`, `status`, `created_by`, `created_at`) VALUES
(1, 'Radios', 1, 1, '2023-05-11 15:05:38'),
(2, 'Antenas', 1, 1, '2023-05-11 15:06:29');

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
-- Estructura de tabla para la tabla `centros_costo`
--

CREATE TABLE `centros_costo` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centros_costo`
--

INSERT INTO `centros_costo` (`id`, `code`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(2, '02', 'GASTOS ADMNISTARIVOS Y FINANCIEROS', 1, 1, '2023-02-23 09:57:55'),
(3, '02', 'Nomina Administrativa', 1, 1, '2023-02-23 09:57:55'),
(4, '02', 'Área administrativa y contable', 1, 1, '2023-02-23 09:57:55'),
(5, '02', 'Gastos Oficina', 1, 1, '2023-02-23 09:57:55'),
(6, '02', 'Gastos personales', 1, 1, '2023-02-23 09:57:55'),
(7, '02', 'ÁREA COMERCIAL', 1, 1, '2023-02-23 09:57:55'),
(8, '02', 'Repuestos y accesorios', 1, 1, '2023-02-23 09:57:55'),
(9, '02', 'Servicio de  Alquiler de radios', 1, 1, '2023-02-23 09:57:55'),
(10, '02', 'Comercialización de radios', 1, 1, '2023-02-23 09:57:55'),
(11, '02', 'Servicio Alquiler de frecuencias', 1, 1, '2023-02-23 09:57:55'),
(12, '02', 'Servicio de Reparacion de Radios', 1, 1, '2023-02-23 09:57:55'),
(13, '02', 'ÁREA OPERACIONES', 1, 1, '2023-02-23 09:57:55'),
(14, '02', 'Nomina operacional', 1, 1, '2023-02-23 09:57:55'),
(15, '02', 'Vehiculos', 1, 1, '2023-02-23 09:57:55'),
(16, '02', 'Cerros', 1, 1, '2023-02-23 09:57:55'),
(17, '02', 'Grúas', 1, 1, '2023-02-23 09:57:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `departamento_id`, `nombre`, `codigo_postal`, `status`, `created_by`, `created_at`) VALUES
(1, 5, 'Abriaquí', NULL, 1, 1, '2023-02-22 12:50:49'),
(2, 50, 'Acacías', NULL, 1, 1, '2023-02-22 12:50:49'),
(3, 27, 'Acandí', NULL, 1, 1, '2023-02-22 12:50:49'),
(4, 41, 'Acevedo', NULL, 1, 1, '2023-02-22 12:50:49'),
(5, 13, 'Achí', NULL, 1, 1, '2023-02-22 12:50:49'),
(6, 41, 'Agrado', NULL, 1, 1, '2023-02-22 12:50:49'),
(7, 25, 'Agua de Dios', NULL, 1, 1, '2023-02-22 12:50:49'),
(8, 20, 'Aguachica', NULL, 1, 1, '2023-02-22 12:50:49'),
(9, 68, 'Aguada', NULL, 1, 1, '2023-02-22 12:50:49'),
(10, 17, 'Aguadas', NULL, 1, 1, '2023-02-22 12:50:49'),
(11, 85, 'Aguazul', NULL, 1, 1, '2023-02-22 12:50:49'),
(12, 20, 'Agustín Codazzi', NULL, 1, 1, '2023-02-22 12:50:49'),
(13, 41, 'Aipe', NULL, 1, 1, '2023-02-22 12:50:49'),
(14, 18, 'Albania', NULL, 1, 1, '2023-02-22 12:50:49'),
(15, 44, 'Albania', NULL, 1, 1, '2023-02-22 12:50:49'),
(16, 68, 'Albania', NULL, 1, 1, '2023-02-22 12:50:49'),
(17, 25, 'Albán', NULL, 1, 1, '2023-02-22 12:50:49'),
(18, 52, 'Albán (San José)', NULL, 1, 1, '2023-02-22 12:50:49'),
(19, 76, 'Alcalá', NULL, 1, 1, '2023-02-22 12:50:49'),
(20, 5, 'Alejandria', NULL, 1, 1, '2023-02-22 12:50:49'),
(21, 47, 'Algarrobo', NULL, 1, 1, '2023-02-22 12:50:49'),
(22, 41, 'Algeciras', NULL, 1, 1, '2023-02-22 12:50:49'),
(23, 19, 'Almaguer', NULL, 1, 1, '2023-02-22 12:50:49'),
(24, 15, 'Almeida', NULL, 1, 1, '2023-02-22 12:50:49'),
(25, 73, 'Alpujarra', NULL, 1, 1, '2023-02-22 12:50:49'),
(26, 41, 'Altamira', NULL, 1, 1, '2023-02-22 12:50:49'),
(27, 27, 'Alto Baudó (Pie de Pato)', NULL, 1, 1, '2023-02-22 12:50:49'),
(28, 13, 'Altos del Rosario', NULL, 1, 1, '2023-02-22 12:50:49'),
(29, 73, 'Alvarado', NULL, 1, 1, '2023-02-22 12:50:49'),
(30, 5, 'Amagá', NULL, 1, 1, '2023-02-22 12:50:49'),
(31, 5, 'Amalfi', NULL, 1, 1, '2023-02-22 12:50:49'),
(32, 73, 'Ambalema', NULL, 1, 1, '2023-02-22 12:50:49'),
(33, 25, 'Anapoima', NULL, 1, 1, '2023-02-22 12:50:49'),
(34, 52, 'Ancuya', NULL, 1, 1, '2023-02-22 12:50:49'),
(35, 76, 'Andalucía', NULL, 1, 1, '2023-02-22 12:50:49'),
(36, 5, 'Andes', NULL, 1, 1, '2023-02-22 12:50:49'),
(37, 5, 'Angelópolis', NULL, 1, 1, '2023-02-22 12:50:49'),
(38, 5, 'Angostura', NULL, 1, 1, '2023-02-22 12:50:49'),
(39, 25, 'Anolaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(40, 5, 'Anorí', NULL, 1, 1, '2023-02-22 12:50:49'),
(41, 17, 'Anserma', NULL, 1, 1, '2023-02-22 12:50:49'),
(42, 76, 'Ansermanuevo', NULL, 1, 1, '2023-02-22 12:50:49'),
(43, 73, 'Anzoátegui', NULL, 1, 1, '2023-02-22 12:50:49'),
(44, 5, 'Anzá', NULL, 1, 1, '2023-02-22 12:50:49'),
(45, 5, 'Apartadó', NULL, 1, 1, '2023-02-22 12:50:49'),
(46, 25, 'Apulo', NULL, 1, 1, '2023-02-22 12:50:49'),
(47, 66, 'Apía', NULL, 1, 1, '2023-02-22 12:50:49'),
(48, 15, 'Aquitania', NULL, 1, 1, '2023-02-22 12:50:49'),
(49, 47, 'Aracataca', NULL, 1, 1, '2023-02-22 12:50:49'),
(50, 17, 'Aranzazu', NULL, 1, 1, '2023-02-22 12:50:49'),
(51, 68, 'Aratoca', NULL, 1, 1, '2023-02-22 12:50:49'),
(52, 81, 'Arauca', NULL, 1, 1, '2023-02-22 12:50:49'),
(53, 81, 'Arauquita', NULL, 1, 1, '2023-02-22 12:50:49'),
(54, 25, 'Arbeláez', NULL, 1, 1, '2023-02-22 12:50:49'),
(55, 52, 'Arboleda (Berruecos)', NULL, 1, 1, '2023-02-22 12:50:49'),
(56, 54, 'Arboledas', NULL, 1, 1, '2023-02-22 12:50:49'),
(57, 5, 'Arboletes', NULL, 1, 1, '2023-02-22 12:50:49'),
(58, 15, 'Arcabuco', NULL, 1, 1, '2023-02-22 12:50:49'),
(59, 13, 'Arenal', NULL, 1, 1, '2023-02-22 12:50:49'),
(60, 5, 'Argelia', NULL, 1, 1, '2023-02-22 12:50:49'),
(61, 19, 'Argelia', NULL, 1, 1, '2023-02-22 12:50:49'),
(62, 76, 'Argelia', NULL, 1, 1, '2023-02-22 12:50:49'),
(63, 47, 'Ariguaní (El Difícil)', NULL, 1, 1, '2023-02-22 12:50:49'),
(64, 13, 'Arjona', NULL, 1, 1, '2023-02-22 12:50:49'),
(65, 5, 'Armenia', NULL, 1, 1, '2023-02-22 12:50:49'),
(66, 63, 'Armenia', NULL, 1, 1, '2023-02-22 12:50:49'),
(67, 73, 'Armero (Guayabal)', NULL, 1, 1, '2023-02-22 12:50:49'),
(68, 13, 'Arroyohondo', NULL, 1, 1, '2023-02-22 12:50:49'),
(69, 20, 'Astrea', NULL, 1, 1, '2023-02-22 12:50:49'),
(70, 73, 'Ataco', NULL, 1, 1, '2023-02-22 12:50:49'),
(71, 27, 'Atrato (Yuto)', NULL, 1, 1, '2023-02-22 12:50:49'),
(72, 23, 'Ayapel', NULL, 1, 1, '2023-02-22 12:50:49'),
(73, 27, 'Bagadó', NULL, 1, 1, '2023-02-22 12:50:49'),
(74, 27, 'Bahía Solano (Mútis)', NULL, 1, 1, '2023-02-22 12:50:49'),
(75, 27, 'Bajo Baudó (Pizarro)', NULL, 1, 1, '2023-02-22 12:50:49'),
(76, 19, 'Balboa', NULL, 1, 1, '2023-02-22 12:50:49'),
(77, 66, 'Balboa', NULL, 1, 1, '2023-02-22 12:50:49'),
(78, 8, 'Baranoa', NULL, 1, 1, '2023-02-22 12:50:49'),
(79, 41, 'Baraya', NULL, 1, 1, '2023-02-22 12:50:49'),
(80, 52, 'Barbacoas', NULL, 1, 1, '2023-02-22 12:50:49'),
(81, 5, 'Barbosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(82, 68, 'Barbosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(83, 68, 'Barichara', NULL, 1, 1, '2023-02-22 12:50:49'),
(84, 50, 'Barranca de Upía', NULL, 1, 1, '2023-02-22 12:50:49'),
(85, 68, 'Barrancabermeja', NULL, 1, 1, '2023-02-22 12:50:49'),
(86, 44, 'Barrancas', NULL, 1, 1, '2023-02-22 12:50:49'),
(87, 13, 'Barranco de Loba', NULL, 1, 1, '2023-02-22 12:50:49'),
(88, 8, 'Barranquilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(89, 20, 'Becerríl', NULL, 1, 1, '2023-02-22 12:50:49'),
(90, 17, 'Belalcázar', NULL, 1, 1, '2023-02-22 12:50:49'),
(91, 5, 'Bello', NULL, 1, 1, '2023-02-22 12:50:49'),
(92, 5, 'Belmira', NULL, 1, 1, '2023-02-22 12:50:49'),
(93, 25, 'Beltrán', NULL, 1, 1, '2023-02-22 12:50:49'),
(94, 15, 'Belén', NULL, 1, 1, '2023-02-22 12:50:49'),
(95, 52, 'Belén', NULL, 1, 1, '2023-02-22 12:50:49'),
(96, 27, 'Belén de Bajirá', NULL, 1, 1, '2023-02-22 12:50:49'),
(97, 66, 'Belén de Umbría', NULL, 1, 1, '2023-02-22 12:50:49'),
(98, 18, 'Belén de los Andaquíes', NULL, 1, 1, '2023-02-22 12:50:49'),
(99, 15, 'Berbeo', NULL, 1, 1, '2023-02-22 12:50:49'),
(100, 5, 'Betania', NULL, 1, 1, '2023-02-22 12:50:49'),
(101, 15, 'Beteitiva', NULL, 1, 1, '2023-02-22 12:50:49'),
(102, 5, 'Betulia', NULL, 1, 1, '2023-02-22 12:50:49'),
(103, 68, 'Betulia', NULL, 1, 1, '2023-02-22 12:50:49'),
(104, 25, 'Bituima', NULL, 1, 1, '2023-02-22 12:50:49'),
(105, 15, 'Boavita', NULL, 1, 1, '2023-02-22 12:50:49'),
(106, 54, 'Bochalema', NULL, 1, 1, '2023-02-22 12:50:49'),
(107, 11, 'Bogotá D.C.', NULL, 1, 1, '2023-02-22 12:50:49'),
(108, 25, 'Bojacá', NULL, 1, 1, '2023-02-22 12:50:49'),
(109, 27, 'Bojayá (Bellavista)', NULL, 1, 1, '2023-02-22 12:50:49'),
(110, 5, 'Bolívar', NULL, 1, 1, '2023-02-22 12:50:49'),
(111, 19, 'Bolívar', NULL, 1, 1, '2023-02-22 12:50:49'),
(112, 68, 'Bolívar', NULL, 1, 1, '2023-02-22 12:50:49'),
(113, 76, 'Bolívar', NULL, 1, 1, '2023-02-22 12:50:49'),
(114, 20, 'Bosconia', NULL, 1, 1, '2023-02-22 12:50:49'),
(115, 15, 'Boyacá', NULL, 1, 1, '2023-02-22 12:50:49'),
(116, 5, 'Briceño', NULL, 1, 1, '2023-02-22 12:50:49'),
(117, 15, 'Briceño', NULL, 1, 1, '2023-02-22 12:50:49'),
(118, 68, 'Bucaramanga', NULL, 1, 1, '2023-02-22 12:50:49'),
(119, 54, 'Bucarasica', NULL, 1, 1, '2023-02-22 12:50:49'),
(120, 76, 'Buenaventura', NULL, 1, 1, '2023-02-22 12:50:49'),
(121, 15, 'Buenavista', NULL, 1, 1, '2023-02-22 12:50:49'),
(122, 23, 'Buenavista', NULL, 1, 1, '2023-02-22 12:50:49'),
(123, 63, 'Buenavista', NULL, 1, 1, '2023-02-22 12:50:49'),
(124, 70, 'Buenavista', NULL, 1, 1, '2023-02-22 12:50:49'),
(125, 19, 'Buenos Aires', NULL, 1, 1, '2023-02-22 12:50:49'),
(126, 52, 'Buesaco', NULL, 1, 1, '2023-02-22 12:50:49'),
(127, 76, 'Buga', NULL, 1, 1, '2023-02-22 12:50:49'),
(128, 76, 'Bugalagrande', NULL, 1, 1, '2023-02-22 12:50:49'),
(129, 5, 'Burítica', NULL, 1, 1, '2023-02-22 12:50:49'),
(130, 15, 'Busbanza', NULL, 1, 1, '2023-02-22 12:50:49'),
(131, 25, 'Cabrera', NULL, 1, 1, '2023-02-22 12:50:49'),
(132, 68, 'Cabrera', NULL, 1, 1, '2023-02-22 12:50:49'),
(133, 50, 'Cabuyaro', NULL, 1, 1, '2023-02-22 12:50:49'),
(134, 25, 'Cachipay', NULL, 1, 1, '2023-02-22 12:50:49'),
(135, 5, 'Caicedo', NULL, 1, 1, '2023-02-22 12:50:49'),
(136, 76, 'Caicedonia', NULL, 1, 1, '2023-02-22 12:50:49'),
(137, 70, 'Caimito', NULL, 1, 1, '2023-02-22 12:50:49'),
(138, 73, 'Cajamarca', NULL, 1, 1, '2023-02-22 12:50:49'),
(139, 19, 'Cajibío', NULL, 1, 1, '2023-02-22 12:50:49'),
(140, 25, 'Cajicá', NULL, 1, 1, '2023-02-22 12:50:49'),
(141, 13, 'Calamar', NULL, 1, 1, '2023-02-22 12:50:49'),
(142, 95, 'Calamar', NULL, 1, 1, '2023-02-22 12:50:49'),
(143, 63, 'Calarcá', NULL, 1, 1, '2023-02-22 12:50:49'),
(144, 5, 'Caldas', NULL, 1, 1, '2023-02-22 12:50:49'),
(145, 15, 'Caldas', NULL, 1, 1, '2023-02-22 12:50:49'),
(146, 19, 'Caldono', NULL, 1, 1, '2023-02-22 12:50:49'),
(147, 68, 'California', NULL, 1, 1, '2023-02-22 12:50:49'),
(148, 76, 'Calima (Darién)', NULL, 1, 1, '2023-02-22 12:50:49'),
(149, 19, 'Caloto', NULL, 1, 1, '2023-02-22 12:50:49'),
(150, 76, 'Calí', NULL, 1, 1, '2023-02-22 12:50:49'),
(151, 5, 'Campamento', NULL, 1, 1, '2023-02-22 12:50:49'),
(152, 8, 'Campo de la Cruz', NULL, 1, 1, '2023-02-22 12:50:49'),
(153, 41, 'Campoalegre', NULL, 1, 1, '2023-02-22 12:50:49'),
(154, 15, 'Campohermoso', NULL, 1, 1, '2023-02-22 12:50:49'),
(155, 23, 'Canalete', NULL, 1, 1, '2023-02-22 12:50:49'),
(156, 8, 'Candelaria', NULL, 1, 1, '2023-02-22 12:50:49'),
(157, 76, 'Candelaria', NULL, 1, 1, '2023-02-22 12:50:49'),
(158, 13, 'Cantagallo', NULL, 1, 1, '2023-02-22 12:50:49'),
(159, 27, 'Cantón de San Pablo', NULL, 1, 1, '2023-02-22 12:50:49'),
(160, 25, 'Caparrapí', NULL, 1, 1, '2023-02-22 12:50:49'),
(161, 68, 'Capitanejo', NULL, 1, 1, '2023-02-22 12:50:49'),
(162, 5, 'Caracolí', NULL, 1, 1, '2023-02-22 12:50:49'),
(163, 5, 'Caramanta', NULL, 1, 1, '2023-02-22 12:50:49'),
(164, 68, 'Carcasí', NULL, 1, 1, '2023-02-22 12:50:49'),
(165, 5, 'Carepa', NULL, 1, 1, '2023-02-22 12:50:49'),
(166, 73, 'Carmen de Apicalá', NULL, 1, 1, '2023-02-22 12:50:49'),
(167, 25, 'Carmen de Carupa', NULL, 1, 1, '2023-02-22 12:50:49'),
(168, 5, 'Carmen de Viboral', NULL, 1, 1, '2023-02-22 12:50:49'),
(169, 27, 'Carmen del Darién (CURBARADÓ)', NULL, 1, 1, '2023-02-22 12:50:49'),
(170, 5, 'Carolina', NULL, 1, 1, '2023-02-22 12:50:49'),
(171, 13, 'Cartagena', NULL, 1, 1, '2023-02-22 12:50:49'),
(172, 18, 'Cartagena del Chairá', NULL, 1, 1, '2023-02-22 12:50:49'),
(173, 76, 'Cartago', NULL, 1, 1, '2023-02-22 12:50:49'),
(174, 97, 'Carurú', NULL, 1, 1, '2023-02-22 12:50:49'),
(175, 73, 'Casabianca', NULL, 1, 1, '2023-02-22 12:50:49'),
(176, 50, 'Castilla la Nueva', NULL, 1, 1, '2023-02-22 12:50:49'),
(177, 5, 'Caucasia', NULL, 1, 1, '2023-02-22 12:50:49'),
(178, 5, 'Cañasgordas', NULL, 1, 1, '2023-02-22 12:50:49'),
(179, 68, 'Cepita', NULL, 1, 1, '2023-02-22 12:50:49'),
(180, 23, 'Cereté', NULL, 1, 1, '2023-02-22 12:50:49'),
(181, 15, 'Cerinza', NULL, 1, 1, '2023-02-22 12:50:49'),
(182, 68, 'Cerrito', NULL, 1, 1, '2023-02-22 12:50:49'),
(183, 47, 'Cerro San Antonio', NULL, 1, 1, '2023-02-22 12:50:49'),
(184, 52, 'Chachaguí', NULL, 1, 1, '2023-02-22 12:50:49'),
(185, 25, 'Chaguaní', NULL, 1, 1, '2023-02-22 12:50:49'),
(186, 70, 'Chalán', NULL, 1, 1, '2023-02-22 12:50:49'),
(187, 73, 'Chaparral', NULL, 1, 1, '2023-02-22 12:50:49'),
(188, 68, 'Charalá', NULL, 1, 1, '2023-02-22 12:50:49'),
(189, 68, 'Charta', NULL, 1, 1, '2023-02-22 12:50:49'),
(190, 5, 'Chigorodó', NULL, 1, 1, '2023-02-22 12:50:49'),
(191, 68, 'Chima', NULL, 1, 1, '2023-02-22 12:50:49'),
(192, 20, 'Chimichagua', NULL, 1, 1, '2023-02-22 12:50:49'),
(193, 23, 'Chimá', NULL, 1, 1, '2023-02-22 12:50:49'),
(194, 15, 'Chinavita', NULL, 1, 1, '2023-02-22 12:50:49'),
(195, 17, 'Chinchiná', NULL, 1, 1, '2023-02-22 12:50:49'),
(196, 54, 'Chinácota', NULL, 1, 1, '2023-02-22 12:50:49'),
(197, 23, 'Chinú', NULL, 1, 1, '2023-02-22 12:50:49'),
(198, 25, 'Chipaque', NULL, 1, 1, '2023-02-22 12:50:49'),
(199, 68, 'Chipatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(200, 15, 'Chiquinquirá', NULL, 1, 1, '2023-02-22 12:50:49'),
(201, 20, 'Chiriguaná', NULL, 1, 1, '2023-02-22 12:50:49'),
(202, 15, 'Chiscas', NULL, 1, 1, '2023-02-22 12:50:49'),
(203, 15, 'Chita', NULL, 1, 1, '2023-02-22 12:50:49'),
(204, 54, 'Chitagá', NULL, 1, 1, '2023-02-22 12:50:49'),
(205, 15, 'Chitaraque', NULL, 1, 1, '2023-02-22 12:50:49'),
(206, 15, 'Chivatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(207, 47, 'Chivolo', NULL, 1, 1, '2023-02-22 12:50:49'),
(208, 25, 'Choachí', NULL, 1, 1, '2023-02-22 12:50:49'),
(209, 25, 'Chocontá', NULL, 1, 1, '2023-02-22 12:50:49'),
(210, 85, 'Chámeza', NULL, 1, 1, '2023-02-22 12:50:49'),
(211, 25, 'Chía', NULL, 1, 1, '2023-02-22 12:50:49'),
(212, 15, 'Chíquiza', NULL, 1, 1, '2023-02-22 12:50:49'),
(213, 15, 'Chívor', NULL, 1, 1, '2023-02-22 12:50:49'),
(214, 13, 'Cicuco', NULL, 1, 1, '2023-02-22 12:50:49'),
(215, 68, 'Cimitarra', NULL, 1, 1, '2023-02-22 12:50:49'),
(216, 63, 'Circasia', NULL, 1, 1, '2023-02-22 12:50:49'),
(217, 5, 'Cisneros', NULL, 1, 1, '2023-02-22 12:50:49'),
(218, 15, 'Ciénaga', NULL, 1, 1, '2023-02-22 12:50:49'),
(219, 47, 'Ciénaga', NULL, 1, 1, '2023-02-22 12:50:49'),
(220, 23, 'Ciénaga de Oro', NULL, 1, 1, '2023-02-22 12:50:49'),
(221, 13, 'Clemencia', NULL, 1, 1, '2023-02-22 12:50:49'),
(222, 5, 'Cocorná', NULL, 1, 1, '2023-02-22 12:50:49'),
(223, 73, 'Coello', NULL, 1, 1, '2023-02-22 12:50:49'),
(224, 25, 'Cogua', NULL, 1, 1, '2023-02-22 12:50:49'),
(225, 41, 'Colombia', NULL, 1, 1, '2023-02-22 12:50:49'),
(226, 70, 'Colosó (Ricaurte)', NULL, 1, 1, '2023-02-22 12:50:49'),
(227, 86, 'Colón', NULL, 1, 1, '2023-02-22 12:50:49'),
(228, 52, 'Colón (Génova)', NULL, 1, 1, '2023-02-22 12:50:49'),
(229, 5, 'Concepción', NULL, 1, 1, '2023-02-22 12:50:49'),
(230, 68, 'Concepción', NULL, 1, 1, '2023-02-22 12:50:49'),
(231, 5, 'Concordia', NULL, 1, 1, '2023-02-22 12:50:49'),
(232, 47, 'Concordia', NULL, 1, 1, '2023-02-22 12:50:49'),
(233, 27, 'Condoto', NULL, 1, 1, '2023-02-22 12:50:49'),
(234, 68, 'Confines', NULL, 1, 1, '2023-02-22 12:50:49'),
(235, 52, 'Consaca', NULL, 1, 1, '2023-02-22 12:50:49'),
(236, 52, 'Contadero', NULL, 1, 1, '2023-02-22 12:50:49'),
(237, 68, 'Contratación', NULL, 1, 1, '2023-02-22 12:50:49'),
(238, 54, 'Convención', NULL, 1, 1, '2023-02-22 12:50:49'),
(239, 5, 'Copacabana', NULL, 1, 1, '2023-02-22 12:50:49'),
(240, 15, 'Coper', NULL, 1, 1, '2023-02-22 12:50:49'),
(241, 63, 'Cordobá', NULL, 1, 1, '2023-02-22 12:50:49'),
(242, 19, 'Corinto', NULL, 1, 1, '2023-02-22 12:50:49'),
(243, 68, 'Coromoro', NULL, 1, 1, '2023-02-22 12:50:49'),
(244, 70, 'Corozal', NULL, 1, 1, '2023-02-22 12:50:49'),
(245, 15, 'Corrales', NULL, 1, 1, '2023-02-22 12:50:49'),
(246, 25, 'Cota', NULL, 1, 1, '2023-02-22 12:50:49'),
(247, 23, 'Cotorra', NULL, 1, 1, '2023-02-22 12:50:49'),
(248, 15, 'Covarachía', NULL, 1, 1, '2023-02-22 12:50:49'),
(249, 70, 'Coveñas', NULL, 1, 1, '2023-02-22 12:50:49'),
(250, 73, 'Coyaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(251, 81, 'Cravo Norte', NULL, 1, 1, '2023-02-22 12:50:49'),
(252, 52, 'Cuaspud (Carlosama)', NULL, 1, 1, '2023-02-22 12:50:49'),
(253, 50, 'Cubarral', NULL, 1, 1, '2023-02-22 12:50:49'),
(254, 15, 'Cubará', NULL, 1, 1, '2023-02-22 12:50:49'),
(255, 15, 'Cucaita', NULL, 1, 1, '2023-02-22 12:50:49'),
(256, 25, 'Cucunubá', NULL, 1, 1, '2023-02-22 12:50:49'),
(257, 54, 'Cucutilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(258, 15, 'Cuitiva', NULL, 1, 1, '2023-02-22 12:50:49'),
(259, 50, 'Cumaral', NULL, 1, 1, '2023-02-22 12:50:49'),
(260, 99, 'Cumaribo', NULL, 1, 1, '2023-02-22 12:50:49'),
(261, 52, 'Cumbal', NULL, 1, 1, '2023-02-22 12:50:49'),
(262, 52, 'Cumbitara', NULL, 1, 1, '2023-02-22 12:50:49'),
(263, 73, 'Cunday', NULL, 1, 1, '2023-02-22 12:50:49'),
(264, 18, 'Curillo', NULL, 1, 1, '2023-02-22 12:50:49'),
(265, 68, 'Curití', NULL, 1, 1, '2023-02-22 12:50:49'),
(266, 20, 'Curumaní', NULL, 1, 1, '2023-02-22 12:50:49'),
(267, 5, 'Cáceres', NULL, 1, 1, '2023-02-22 12:50:49'),
(268, 54, 'Cáchira', NULL, 1, 1, '2023-02-22 12:50:49'),
(269, 54, 'Cácota', NULL, 1, 1, '2023-02-22 12:50:49'),
(270, 25, 'Cáqueza', NULL, 1, 1, '2023-02-22 12:50:49'),
(271, 27, 'Cértegui', NULL, 1, 1, '2023-02-22 12:50:49'),
(272, 15, 'Cómbita', NULL, 1, 1, '2023-02-22 12:50:49'),
(273, 13, 'Córdoba', NULL, 1, 1, '2023-02-22 12:50:49'),
(274, 52, 'Córdoba', NULL, 1, 1, '2023-02-22 12:50:49'),
(275, 54, 'Cúcuta', NULL, 1, 1, '2023-02-22 12:50:49'),
(276, 5, 'Dabeiba', NULL, 1, 1, '2023-02-22 12:50:49'),
(277, 76, 'Dagua', NULL, 1, 1, '2023-02-22 12:50:49'),
(278, 44, 'Dibulla', NULL, 1, 1, '2023-02-22 12:50:49'),
(279, 44, 'Distracción', NULL, 1, 1, '2023-02-22 12:50:49'),
(280, 73, 'Dolores', NULL, 1, 1, '2023-02-22 12:50:49'),
(281, 5, 'Don Matías', NULL, 1, 1, '2023-02-22 12:50:49'),
(282, 66, 'Dos Quebradas', NULL, 1, 1, '2023-02-22 12:50:49'),
(283, 15, 'Duitama', NULL, 1, 1, '2023-02-22 12:50:49'),
(284, 54, 'Durania', NULL, 1, 1, '2023-02-22 12:50:49'),
(285, 5, 'Ebéjico', NULL, 1, 1, '2023-02-22 12:50:49'),
(286, 5, 'El Bagre', NULL, 1, 1, '2023-02-22 12:50:49'),
(287, 47, 'El Banco', NULL, 1, 1, '2023-02-22 12:50:49'),
(288, 76, 'El Cairo', NULL, 1, 1, '2023-02-22 12:50:49'),
(289, 50, 'El Calvario', NULL, 1, 1, '2023-02-22 12:50:49'),
(290, 54, 'El Carmen', NULL, 1, 1, '2023-02-22 12:50:49'),
(291, 68, 'El Carmen', NULL, 1, 1, '2023-02-22 12:50:49'),
(292, 27, 'El Carmen de Atrato', NULL, 1, 1, '2023-02-22 12:50:49'),
(293, 13, 'El Carmen de Bolívar', NULL, 1, 1, '2023-02-22 12:50:49'),
(294, 50, 'El Castillo', NULL, 1, 1, '2023-02-22 12:50:49'),
(295, 76, 'El Cerrito', NULL, 1, 1, '2023-02-22 12:50:49'),
(296, 52, 'El Charco', NULL, 1, 1, '2023-02-22 12:50:49'),
(297, 15, 'El Cocuy', NULL, 1, 1, '2023-02-22 12:50:49'),
(298, 25, 'El Colegio', NULL, 1, 1, '2023-02-22 12:50:49'),
(299, 20, 'El Copey', NULL, 1, 1, '2023-02-22 12:50:49'),
(300, 18, 'El Doncello', NULL, 1, 1, '2023-02-22 12:50:49'),
(301, 50, 'El Dorado', NULL, 1, 1, '2023-02-22 12:50:49'),
(302, 76, 'El Dovio', NULL, 1, 1, '2023-02-22 12:50:49'),
(303, 15, 'El Espino', NULL, 1, 1, '2023-02-22 12:50:49'),
(304, 68, 'El Guacamayo', NULL, 1, 1, '2023-02-22 12:50:49'),
(305, 13, 'El Guamo', NULL, 1, 1, '2023-02-22 12:50:49'),
(306, 44, 'El Molino', NULL, 1, 1, '2023-02-22 12:50:49'),
(307, 20, 'El Paso', NULL, 1, 1, '2023-02-22 12:50:49'),
(308, 18, 'El Paujil', NULL, 1, 1, '2023-02-22 12:50:49'),
(309, 52, 'El Peñol', NULL, 1, 1, '2023-02-22 12:50:49'),
(310, 13, 'El Peñon', NULL, 1, 1, '2023-02-22 12:50:49'),
(311, 68, 'El Peñon', NULL, 1, 1, '2023-02-22 12:50:49'),
(312, 25, 'El Peñón', NULL, 1, 1, '2023-02-22 12:50:49'),
(313, 47, 'El Piñon', NULL, 1, 1, '2023-02-22 12:50:49'),
(314, 68, 'El Playón', NULL, 1, 1, '2023-02-22 12:50:49'),
(315, 95, 'El Retorno', NULL, 1, 1, '2023-02-22 12:50:49'),
(316, 47, 'El Retén', NULL, 1, 1, '2023-02-22 12:50:49'),
(317, 70, 'El Roble', NULL, 1, 1, '2023-02-22 12:50:49'),
(318, 25, 'El Rosal', NULL, 1, 1, '2023-02-22 12:50:49'),
(319, 52, 'El Rosario', NULL, 1, 1, '2023-02-22 12:50:49'),
(320, 52, 'El Tablón de Gómez', NULL, 1, 1, '2023-02-22 12:50:49'),
(321, 19, 'El Tambo', NULL, 1, 1, '2023-02-22 12:50:49'),
(322, 52, 'El Tambo', NULL, 1, 1, '2023-02-22 12:50:49'),
(323, 54, 'El Tarra', NULL, 1, 1, '2023-02-22 12:50:49'),
(324, 54, 'El Zulia', NULL, 1, 1, '2023-02-22 12:50:49'),
(325, 76, 'El Águila', NULL, 1, 1, '2023-02-22 12:50:49'),
(326, 41, 'Elías', NULL, 1, 1, '2023-02-22 12:50:49'),
(327, 68, 'Encino', NULL, 1, 1, '2023-02-22 12:50:49'),
(328, 68, 'Enciso', NULL, 1, 1, '2023-02-22 12:50:49'),
(329, 5, 'Entrerríos', NULL, 1, 1, '2023-02-22 12:50:49'),
(330, 5, 'Envigado', NULL, 1, 1, '2023-02-22 12:50:49'),
(331, 73, 'Espinal', NULL, 1, 1, '2023-02-22 12:50:49'),
(332, 25, 'Facatativá', NULL, 1, 1, '2023-02-22 12:50:49'),
(333, 73, 'Falan', NULL, 1, 1, '2023-02-22 12:50:49'),
(334, 17, 'Filadelfia', NULL, 1, 1, '2023-02-22 12:50:49'),
(335, 63, 'Filandia', NULL, 1, 1, '2023-02-22 12:50:49'),
(336, 15, 'Firavitoba', NULL, 1, 1, '2023-02-22 12:50:49'),
(337, 73, 'Flandes', NULL, 1, 1, '2023-02-22 12:50:49'),
(338, 18, 'Florencia', NULL, 1, 1, '2023-02-22 12:50:49'),
(339, 19, 'Florencia', NULL, 1, 1, '2023-02-22 12:50:49'),
(340, 15, 'Floresta', NULL, 1, 1, '2023-02-22 12:50:49'),
(341, 76, 'Florida', NULL, 1, 1, '2023-02-22 12:50:49'),
(342, 68, 'Floridablanca', NULL, 1, 1, '2023-02-22 12:50:49'),
(343, 68, 'Florián', NULL, 1, 1, '2023-02-22 12:50:49'),
(344, 44, 'Fonseca', NULL, 1, 1, '2023-02-22 12:50:49'),
(345, 81, 'Fortúl', NULL, 1, 1, '2023-02-22 12:50:49'),
(346, 25, 'Fosca', NULL, 1, 1, '2023-02-22 12:50:49'),
(347, 52, 'Francisco Pizarro', NULL, 1, 1, '2023-02-22 12:50:49'),
(348, 5, 'Fredonia', NULL, 1, 1, '2023-02-22 12:50:49'),
(349, 73, 'Fresno', NULL, 1, 1, '2023-02-22 12:50:49'),
(350, 5, 'Frontino', NULL, 1, 1, '2023-02-22 12:50:49'),
(351, 50, 'Fuente de Oro', NULL, 1, 1, '2023-02-22 12:50:49'),
(352, 47, 'Fundación', NULL, 1, 1, '2023-02-22 12:50:49'),
(353, 52, 'Funes', NULL, 1, 1, '2023-02-22 12:50:49'),
(354, 25, 'Funza', NULL, 1, 1, '2023-02-22 12:50:49'),
(355, 25, 'Fusagasugá', NULL, 1, 1, '2023-02-22 12:50:49'),
(356, 25, 'Fómeque', NULL, 1, 1, '2023-02-22 12:50:49'),
(357, 25, 'Fúquene', NULL, 1, 1, '2023-02-22 12:50:49'),
(358, 25, 'Gachalá', NULL, 1, 1, '2023-02-22 12:50:49'),
(359, 25, 'Gachancipá', NULL, 1, 1, '2023-02-22 12:50:49'),
(360, 15, 'Gachantivá', NULL, 1, 1, '2023-02-22 12:50:49'),
(361, 25, 'Gachetá', NULL, 1, 1, '2023-02-22 12:50:49'),
(362, 8, 'Galapa', NULL, 1, 1, '2023-02-22 12:50:49'),
(363, 70, 'Galeras (Nueva Granada)', NULL, 1, 1, '2023-02-22 12:50:49'),
(364, 68, 'Galán', NULL, 1, 1, '2023-02-22 12:50:49'),
(365, 25, 'Gama', NULL, 1, 1, '2023-02-22 12:50:49'),
(366, 20, 'Gamarra', NULL, 1, 1, '2023-02-22 12:50:49'),
(367, 15, 'Garagoa', NULL, 1, 1, '2023-02-22 12:50:49'),
(368, 41, 'Garzón', NULL, 1, 1, '2023-02-22 12:50:49'),
(369, 41, 'Gigante', NULL, 1, 1, '2023-02-22 12:50:49'),
(370, 76, 'Ginebra', NULL, 1, 1, '2023-02-22 12:50:49'),
(371, 5, 'Giraldo', NULL, 1, 1, '2023-02-22 12:50:49'),
(372, 25, 'Girardot', NULL, 1, 1, '2023-02-22 12:50:49'),
(373, 5, 'Girardota', NULL, 1, 1, '2023-02-22 12:50:49'),
(374, 68, 'Girón', NULL, 1, 1, '2023-02-22 12:50:49'),
(375, 20, 'Gonzalez', NULL, 1, 1, '2023-02-22 12:50:49'),
(376, 54, 'Gramalote', NULL, 1, 1, '2023-02-22 12:50:49'),
(377, 5, 'Granada', NULL, 1, 1, '2023-02-22 12:50:49'),
(378, 25, 'Granada', NULL, 1, 1, '2023-02-22 12:50:49'),
(379, 50, 'Granada', NULL, 1, 1, '2023-02-22 12:50:49'),
(380, 68, 'Guaca', NULL, 1, 1, '2023-02-22 12:50:49'),
(381, 15, 'Guacamayas', NULL, 1, 1, '2023-02-22 12:50:49'),
(382, 76, 'Guacarí', NULL, 1, 1, '2023-02-22 12:50:49'),
(383, 52, 'Guachavés', NULL, 1, 1, '2023-02-22 12:50:49'),
(384, 19, 'Guachené', NULL, 1, 1, '2023-02-22 12:50:49'),
(385, 25, 'Guachetá', NULL, 1, 1, '2023-02-22 12:50:49'),
(386, 52, 'Guachucal', NULL, 1, 1, '2023-02-22 12:50:49'),
(387, 5, 'Guadalupe', NULL, 1, 1, '2023-02-22 12:50:49'),
(388, 41, 'Guadalupe', NULL, 1, 1, '2023-02-22 12:50:49'),
(389, 68, 'Guadalupe', NULL, 1, 1, '2023-02-22 12:50:49'),
(390, 25, 'Guaduas', NULL, 1, 1, '2023-02-22 12:50:49'),
(391, 52, 'Guaitarilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(392, 52, 'Gualmatán', NULL, 1, 1, '2023-02-22 12:50:49'),
(393, 47, 'Guamal', NULL, 1, 1, '2023-02-22 12:50:49'),
(394, 50, 'Guamal', NULL, 1, 1, '2023-02-22 12:50:49'),
(395, 73, 'Guamo', NULL, 1, 1, '2023-02-22 12:50:49'),
(396, 68, 'Guapota', NULL, 1, 1, '2023-02-22 12:50:49'),
(397, 19, 'Guapí', NULL, 1, 1, '2023-02-22 12:50:49'),
(398, 70, 'Guaranda', NULL, 1, 1, '2023-02-22 12:50:49'),
(399, 5, 'Guarne', NULL, 1, 1, '2023-02-22 12:50:49'),
(400, 25, 'Guasca', NULL, 1, 1, '2023-02-22 12:50:49'),
(401, 5, 'Guatapé', NULL, 1, 1, '2023-02-22 12:50:49'),
(402, 25, 'Guataquí', NULL, 1, 1, '2023-02-22 12:50:49'),
(403, 25, 'Guatavita', NULL, 1, 1, '2023-02-22 12:50:49'),
(404, 15, 'Guateque', NULL, 1, 1, '2023-02-22 12:50:49'),
(405, 68, 'Guavatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(406, 25, 'Guayabal de Siquima', NULL, 1, 1, '2023-02-22 12:50:49'),
(407, 25, 'Guayabetal', NULL, 1, 1, '2023-02-22 12:50:49'),
(408, 15, 'Guayatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(409, 68, 'Guepsa', NULL, 1, 1, '2023-02-22 12:50:49'),
(410, 15, 'Guicán', NULL, 1, 1, '2023-02-22 12:50:49'),
(411, 25, 'Gutiérrez', NULL, 1, 1, '2023-02-22 12:50:49'),
(412, 66, 'Guática', NULL, 1, 1, '2023-02-22 12:50:49'),
(413, 68, 'Gámbita', NULL, 1, 1, '2023-02-22 12:50:49'),
(414, 15, 'Gámeza', NULL, 1, 1, '2023-02-22 12:50:49'),
(415, 63, 'Génova', NULL, 1, 1, '2023-02-22 12:50:49'),
(416, 5, 'Gómez Plata', NULL, 1, 1, '2023-02-22 12:50:49'),
(417, 54, 'Hacarí', NULL, 1, 1, '2023-02-22 12:50:49'),
(418, 13, 'Hatillo de Loba', NULL, 1, 1, '2023-02-22 12:50:49'),
(419, 68, 'Hato', NULL, 1, 1, '2023-02-22 12:50:49'),
(420, 85, 'Hato Corozal', NULL, 1, 1, '2023-02-22 12:50:49'),
(421, 44, 'Hatonuevo', NULL, 1, 1, '2023-02-22 12:50:49'),
(422, 5, 'Heliconia', NULL, 1, 1, '2023-02-22 12:50:49'),
(423, 54, 'Herrán', NULL, 1, 1, '2023-02-22 12:50:49'),
(424, 73, 'Herveo', NULL, 1, 1, '2023-02-22 12:50:49'),
(425, 5, 'Hispania', NULL, 1, 1, '2023-02-22 12:50:49'),
(426, 41, 'Hobo', NULL, 1, 1, '2023-02-22 12:50:49'),
(427, 73, 'Honda', NULL, 1, 1, '2023-02-22 12:50:49'),
(428, 73, 'Ibagué', NULL, 1, 1, '2023-02-22 12:50:49'),
(429, 73, 'Icononzo', NULL, 1, 1, '2023-02-22 12:50:49'),
(430, 52, 'Iles', NULL, 1, 1, '2023-02-22 12:50:49'),
(431, 52, 'Imúes', NULL, 1, 1, '2023-02-22 12:50:49'),
(432, 19, 'Inzá', NULL, 1, 1, '2023-02-22 12:50:49'),
(433, 94, 'Inírida', NULL, 1, 1, '2023-02-22 12:50:49'),
(434, 52, 'Ipiales', NULL, 1, 1, '2023-02-22 12:50:49'),
(435, 41, 'Isnos', NULL, 1, 1, '2023-02-22 12:50:49'),
(436, 27, 'Istmina', NULL, 1, 1, '2023-02-22 12:50:49'),
(437, 5, 'Itagüí', NULL, 1, 1, '2023-02-22 12:50:49'),
(438, 5, 'Ituango', NULL, 1, 1, '2023-02-22 12:50:49'),
(439, 15, 'Izá', NULL, 1, 1, '2023-02-22 12:50:49'),
(440, 19, 'Jambaló', NULL, 1, 1, '2023-02-22 12:50:49'),
(441, 76, 'Jamundí', NULL, 1, 1, '2023-02-22 12:50:49'),
(442, 5, 'Jardín', NULL, 1, 1, '2023-02-22 12:50:49'),
(443, 15, 'Jenesano', NULL, 1, 1, '2023-02-22 12:50:49'),
(444, 5, 'Jericó', NULL, 1, 1, '2023-02-22 12:50:49'),
(445, 15, 'Jericó', NULL, 1, 1, '2023-02-22 12:50:49'),
(446, 25, 'Jerusalén', NULL, 1, 1, '2023-02-22 12:50:49'),
(447, 68, 'Jesús María', NULL, 1, 1, '2023-02-22 12:50:49'),
(448, 68, 'Jordán', NULL, 1, 1, '2023-02-22 12:50:49'),
(449, 8, 'Juan de Acosta', NULL, 1, 1, '2023-02-22 12:50:49'),
(450, 25, 'Junín', NULL, 1, 1, '2023-02-22 12:50:49'),
(451, 27, 'Juradó', NULL, 1, 1, '2023-02-22 12:50:49'),
(452, 23, 'La Apartada y La Frontera', NULL, 1, 1, '2023-02-22 12:50:49'),
(453, 41, 'La Argentina', NULL, 1, 1, '2023-02-22 12:50:49'),
(454, 68, 'La Belleza', NULL, 1, 1, '2023-02-22 12:50:49'),
(455, 25, 'La Calera', NULL, 1, 1, '2023-02-22 12:50:49'),
(456, 15, 'La Capilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(457, 5, 'La Ceja', NULL, 1, 1, '2023-02-22 12:50:49'),
(458, 66, 'La Celia', NULL, 1, 1, '2023-02-22 12:50:49'),
(459, 52, 'La Cruz', NULL, 1, 1, '2023-02-22 12:50:49'),
(460, 76, 'La Cumbre', NULL, 1, 1, '2023-02-22 12:50:49'),
(461, 17, 'La Dorada', NULL, 1, 1, '2023-02-22 12:50:49'),
(462, 54, 'La Esperanza', NULL, 1, 1, '2023-02-22 12:50:49'),
(463, 5, 'La Estrella', NULL, 1, 1, '2023-02-22 12:50:49'),
(464, 52, 'La Florida', NULL, 1, 1, '2023-02-22 12:50:49'),
(465, 20, 'La Gloria', NULL, 1, 1, '2023-02-22 12:50:49'),
(466, 20, 'La Jagua de Ibirico', NULL, 1, 1, '2023-02-22 12:50:49'),
(467, 44, 'La Jagua del Pilar', NULL, 1, 1, '2023-02-22 12:50:49'),
(468, 52, 'La Llanada', NULL, 1, 1, '2023-02-22 12:50:49'),
(469, 50, 'La Macarena', NULL, 1, 1, '2023-02-22 12:50:49'),
(470, 17, 'La Merced', NULL, 1, 1, '2023-02-22 12:50:49'),
(471, 25, 'La Mesa', NULL, 1, 1, '2023-02-22 12:50:49'),
(472, 18, 'La Montañita', NULL, 1, 1, '2023-02-22 12:50:49'),
(473, 25, 'La Palma', NULL, 1, 1, '2023-02-22 12:50:49'),
(474, 68, 'La Paz', NULL, 1, 1, '2023-02-22 12:50:49'),
(475, 20, 'La Paz (Robles)', NULL, 1, 1, '2023-02-22 12:50:49'),
(476, 25, 'La Peña', NULL, 1, 1, '2023-02-22 12:50:49'),
(477, 5, 'La Pintada', NULL, 1, 1, '2023-02-22 12:50:49'),
(478, 41, 'La Plata', NULL, 1, 1, '2023-02-22 12:50:49'),
(479, 54, 'La Playa', NULL, 1, 1, '2023-02-22 12:50:49'),
(480, 99, 'La Primavera', NULL, 1, 1, '2023-02-22 12:50:49'),
(481, 85, 'La Salina', NULL, 1, 1, '2023-02-22 12:50:49'),
(482, 19, 'La Sierra', NULL, 1, 1, '2023-02-22 12:50:49'),
(483, 63, 'La Tebaida', NULL, 1, 1, '2023-02-22 12:50:49'),
(484, 52, 'La Tola', NULL, 1, 1, '2023-02-22 12:50:49'),
(485, 5, 'La Unión', NULL, 1, 1, '2023-02-22 12:50:49'),
(486, 52, 'La Unión', NULL, 1, 1, '2023-02-22 12:50:49'),
(487, 70, 'La Unión', NULL, 1, 1, '2023-02-22 12:50:49'),
(488, 76, 'La Unión', NULL, 1, 1, '2023-02-22 12:50:49'),
(489, 15, 'La Uvita', NULL, 1, 1, '2023-02-22 12:50:49'),
(490, 19, 'La Vega', NULL, 1, 1, '2023-02-22 12:50:49'),
(491, 25, 'La Vega', NULL, 1, 1, '2023-02-22 12:50:49'),
(492, 15, 'La Victoria', NULL, 1, 1, '2023-02-22 12:50:49'),
(493, 17, 'La Victoria', NULL, 1, 1, '2023-02-22 12:50:49'),
(494, 76, 'La Victoria', NULL, 1, 1, '2023-02-22 12:50:49'),
(495, 66, 'La Virginia', NULL, 1, 1, '2023-02-22 12:50:49'),
(496, 54, 'Labateca', NULL, 1, 1, '2023-02-22 12:50:49'),
(497, 15, 'Labranzagrande', NULL, 1, 1, '2023-02-22 12:50:49'),
(498, 68, 'Landázuri', NULL, 1, 1, '2023-02-22 12:50:49'),
(499, 68, 'Lebrija', NULL, 1, 1, '2023-02-22 12:50:49'),
(500, 52, 'Leiva', NULL, 1, 1, '2023-02-22 12:50:49'),
(501, 50, 'Lejanías', NULL, 1, 1, '2023-02-22 12:50:49'),
(502, 25, 'Lenguazaque', NULL, 1, 1, '2023-02-22 12:50:49'),
(503, 91, 'Leticia', NULL, 1, 1, '2023-02-22 12:50:49'),
(504, 5, 'Liborina', NULL, 1, 1, '2023-02-22 12:50:49'),
(505, 52, 'Linares', NULL, 1, 1, '2023-02-22 12:50:49'),
(506, 27, 'Lloró', NULL, 1, 1, '2023-02-22 12:50:49'),
(507, 23, 'Lorica', NULL, 1, 1, '2023-02-22 12:50:49'),
(508, 23, 'Los Córdobas', NULL, 1, 1, '2023-02-22 12:50:49'),
(509, 70, 'Los Palmitos', NULL, 1, 1, '2023-02-22 12:50:49'),
(510, 54, 'Los Patios', NULL, 1, 1, '2023-02-22 12:50:49'),
(511, 68, 'Los Santos', NULL, 1, 1, '2023-02-22 12:50:49'),
(512, 54, 'Lourdes', NULL, 1, 1, '2023-02-22 12:50:49'),
(513, 8, 'Luruaco', NULL, 1, 1, '2023-02-22 12:50:49'),
(514, 73, 'Lérida', NULL, 1, 1, '2023-02-22 12:50:49'),
(515, 73, 'Líbano', NULL, 1, 1, '2023-02-22 12:50:49'),
(516, 19, 'López (Micay)', NULL, 1, 1, '2023-02-22 12:50:49'),
(517, 15, 'Macanal', NULL, 1, 1, '2023-02-22 12:50:49'),
(518, 68, 'Macaravita', NULL, 1, 1, '2023-02-22 12:50:49'),
(519, 5, 'Maceo', NULL, 1, 1, '2023-02-22 12:50:49'),
(520, 25, 'Machetá', NULL, 1, 1, '2023-02-22 12:50:49'),
(521, 25, 'Madrid', NULL, 1, 1, '2023-02-22 12:50:49'),
(522, 13, 'Magangué', NULL, 1, 1, '2023-02-22 12:50:49'),
(523, 52, 'Magüi (Payán)', NULL, 1, 1, '2023-02-22 12:50:49'),
(524, 13, 'Mahates', NULL, 1, 1, '2023-02-22 12:50:49'),
(525, 44, 'Maicao', NULL, 1, 1, '2023-02-22 12:50:49'),
(526, 70, 'Majagual', NULL, 1, 1, '2023-02-22 12:50:49'),
(527, 8, 'Malambo', NULL, 1, 1, '2023-02-22 12:50:49'),
(528, 52, 'Mallama (Piedrancha)', NULL, 1, 1, '2023-02-22 12:50:49'),
(529, 8, 'Manatí', NULL, 1, 1, '2023-02-22 12:50:49'),
(530, 44, 'Manaure', NULL, 1, 1, '2023-02-22 12:50:49'),
(531, 20, 'Manaure Balcón del Cesar', NULL, 1, 1, '2023-02-22 12:50:49'),
(532, 17, 'Manizales', NULL, 1, 1, '2023-02-22 12:50:49'),
(533, 25, 'Manta', NULL, 1, 1, '2023-02-22 12:50:49'),
(534, 17, 'Manzanares', NULL, 1, 1, '2023-02-22 12:50:49'),
(535, 85, 'Maní', NULL, 1, 1, '2023-02-22 12:50:49'),
(536, 50, 'Mapiripan', NULL, 1, 1, '2023-02-22 12:50:49'),
(537, 13, 'Margarita', NULL, 1, 1, '2023-02-22 12:50:49'),
(538, 5, 'Marinilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(539, 15, 'Maripí', NULL, 1, 1, '2023-02-22 12:50:49'),
(540, 73, 'Mariquita', NULL, 1, 1, '2023-02-22 12:50:49'),
(541, 17, 'Marmato', NULL, 1, 1, '2023-02-22 12:50:49'),
(542, 17, 'Marquetalia', NULL, 1, 1, '2023-02-22 12:50:49'),
(543, 66, 'Marsella', NULL, 1, 1, '2023-02-22 12:50:49'),
(544, 17, 'Marulanda', NULL, 1, 1, '2023-02-22 12:50:49'),
(545, 13, 'María la Baja', NULL, 1, 1, '2023-02-22 12:50:49'),
(546, 68, 'Matanza', NULL, 1, 1, '2023-02-22 12:50:49'),
(547, 5, 'Medellín', NULL, 1, 1, '2023-02-22 12:50:49'),
(548, 25, 'Medina', NULL, 1, 1, '2023-02-22 12:50:49'),
(549, 27, 'Medio Atrato', NULL, 1, 1, '2023-02-22 12:50:49'),
(550, 27, 'Medio Baudó', NULL, 1, 1, '2023-02-22 12:50:49'),
(551, 27, 'Medio San Juan (ANDAGOYA)', NULL, 1, 1, '2023-02-22 12:50:49'),
(552, 73, 'Melgar', NULL, 1, 1, '2023-02-22 12:50:49'),
(553, 19, 'Mercaderes', NULL, 1, 1, '2023-02-22 12:50:49'),
(554, 50, 'Mesetas', NULL, 1, 1, '2023-02-22 12:50:49'),
(555, 18, 'Milán', NULL, 1, 1, '2023-02-22 12:50:49'),
(556, 15, 'Miraflores', NULL, 1, 1, '2023-02-22 12:50:49'),
(557, 95, 'Miraflores', NULL, 1, 1, '2023-02-22 12:50:49'),
(558, 19, 'Miranda', NULL, 1, 1, '2023-02-22 12:50:49'),
(559, 66, 'Mistrató', NULL, 1, 1, '2023-02-22 12:50:49'),
(560, 97, 'Mitú', NULL, 1, 1, '2023-02-22 12:50:49'),
(561, 86, 'Mocoa', NULL, 1, 1, '2023-02-22 12:50:49'),
(562, 68, 'Mogotes', NULL, 1, 1, '2023-02-22 12:50:49'),
(563, 68, 'Molagavita', NULL, 1, 1, '2023-02-22 12:50:49'),
(564, 23, 'Momil', NULL, 1, 1, '2023-02-22 12:50:49'),
(565, 13, 'Mompós', NULL, 1, 1, '2023-02-22 12:50:49'),
(566, 15, 'Mongua', NULL, 1, 1, '2023-02-22 12:50:49'),
(567, 15, 'Monguí', NULL, 1, 1, '2023-02-22 12:50:49'),
(568, 15, 'Moniquirá', NULL, 1, 1, '2023-02-22 12:50:49'),
(569, 5, 'Montebello', NULL, 1, 1, '2023-02-22 12:50:49'),
(570, 13, 'Montecristo', NULL, 1, 1, '2023-02-22 12:50:49'),
(571, 23, 'Montelíbano', NULL, 1, 1, '2023-02-22 12:50:49'),
(572, 63, 'Montenegro', NULL, 1, 1, '2023-02-22 12:50:49'),
(573, 23, 'Monteria', NULL, 1, 1, '2023-02-22 12:50:49'),
(574, 85, 'Monterrey', NULL, 1, 1, '2023-02-22 12:50:49'),
(575, 13, 'Morales', NULL, 1, 1, '2023-02-22 12:50:49'),
(576, 19, 'Morales', NULL, 1, 1, '2023-02-22 12:50:49'),
(577, 18, 'Morelia', NULL, 1, 1, '2023-02-22 12:50:49'),
(578, 70, 'Morroa', NULL, 1, 1, '2023-02-22 12:50:49'),
(579, 25, 'Mosquera', NULL, 1, 1, '2023-02-22 12:50:49'),
(580, 52, 'Mosquera', NULL, 1, 1, '2023-02-22 12:50:49'),
(581, 15, 'Motavita', NULL, 1, 1, '2023-02-22 12:50:49'),
(582, 23, 'Moñitos', NULL, 1, 1, '2023-02-22 12:50:49'),
(583, 73, 'Murillo', NULL, 1, 1, '2023-02-22 12:50:49'),
(584, 5, 'Murindó', NULL, 1, 1, '2023-02-22 12:50:49'),
(585, 5, 'Mutatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(586, 54, 'Mutiscua', NULL, 1, 1, '2023-02-22 12:50:49'),
(587, 15, 'Muzo', NULL, 1, 1, '2023-02-22 12:50:49'),
(588, 68, 'Málaga', NULL, 1, 1, '2023-02-22 12:50:49'),
(589, 5, 'Nariño', NULL, 1, 1, '2023-02-22 12:50:49'),
(590, 25, 'Nariño', NULL, 1, 1, '2023-02-22 12:50:49'),
(591, 52, 'Nariño', NULL, 1, 1, '2023-02-22 12:50:49'),
(592, 73, 'Natagaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(593, 5, 'Nechí', NULL, 1, 1, '2023-02-22 12:50:49'),
(594, 5, 'Necoclí', NULL, 1, 1, '2023-02-22 12:50:49'),
(595, 17, 'Neira', NULL, 1, 1, '2023-02-22 12:50:49'),
(596, 41, 'Neiva', NULL, 1, 1, '2023-02-22 12:50:49'),
(597, 25, 'Nemocón', NULL, 1, 1, '2023-02-22 12:50:49'),
(598, 25, 'Nilo', NULL, 1, 1, '2023-02-22 12:50:49'),
(599, 25, 'Nimaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(600, 15, 'Nobsa', NULL, 1, 1, '2023-02-22 12:50:49'),
(601, 25, 'Nocaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(602, 17, 'Norcasia', NULL, 1, 1, '2023-02-22 12:50:49'),
(603, 13, 'Norosí', NULL, 1, 1, '2023-02-22 12:50:49'),
(604, 27, 'Novita', NULL, 1, 1, '2023-02-22 12:50:49'),
(605, 47, 'Nueva Granada', NULL, 1, 1, '2023-02-22 12:50:49'),
(606, 15, 'Nuevo Colón', NULL, 1, 1, '2023-02-22 12:50:49'),
(607, 85, 'Nunchía', NULL, 1, 1, '2023-02-22 12:50:49'),
(608, 27, 'Nuquí', NULL, 1, 1, '2023-02-22 12:50:49'),
(609, 41, 'Nátaga', NULL, 1, 1, '2023-02-22 12:50:49'),
(610, 76, 'Obando', NULL, 1, 1, '2023-02-22 12:50:49'),
(611, 68, 'Ocamonte', NULL, 1, 1, '2023-02-22 12:50:49'),
(612, 54, 'Ocaña', NULL, 1, 1, '2023-02-22 12:50:49'),
(613, 68, 'Oiba', NULL, 1, 1, '2023-02-22 12:50:49'),
(614, 15, 'Oicatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(615, 5, 'Olaya', NULL, 1, 1, '2023-02-22 12:50:49'),
(616, 52, 'Olaya Herrera', NULL, 1, 1, '2023-02-22 12:50:49'),
(617, 68, 'Onzaga', NULL, 1, 1, '2023-02-22 12:50:49'),
(618, 41, 'Oporapa', NULL, 1, 1, '2023-02-22 12:50:49'),
(619, 86, 'Orito', NULL, 1, 1, '2023-02-22 12:50:49'),
(620, 85, 'Orocué', NULL, 1, 1, '2023-02-22 12:50:49'),
(621, 73, 'Ortega', NULL, 1, 1, '2023-02-22 12:50:49'),
(622, 52, 'Ospina', NULL, 1, 1, '2023-02-22 12:50:49'),
(623, 15, 'Otanche', NULL, 1, 1, '2023-02-22 12:50:49'),
(624, 70, 'Ovejas', NULL, 1, 1, '2023-02-22 12:50:49'),
(625, 15, 'Pachavita', NULL, 1, 1, '2023-02-22 12:50:49'),
(626, 25, 'Pacho', NULL, 1, 1, '2023-02-22 12:50:49'),
(627, 19, 'Padilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(628, 41, 'Paicol', NULL, 1, 1, '2023-02-22 12:50:49'),
(629, 20, 'Pailitas', NULL, 1, 1, '2023-02-22 12:50:49'),
(630, 25, 'Paime', NULL, 1, 1, '2023-02-22 12:50:49'),
(631, 15, 'Paipa', NULL, 1, 1, '2023-02-22 12:50:49'),
(632, 15, 'Pajarito', NULL, 1, 1, '2023-02-22 12:50:49'),
(633, 41, 'Palermo', NULL, 1, 1, '2023-02-22 12:50:49'),
(634, 17, 'Palestina', NULL, 1, 1, '2023-02-22 12:50:49'),
(635, 41, 'Palestina', NULL, 1, 1, '2023-02-22 12:50:49'),
(636, 68, 'Palmar', NULL, 1, 1, '2023-02-22 12:50:49'),
(637, 8, 'Palmar de Varela', NULL, 1, 1, '2023-02-22 12:50:49'),
(638, 68, 'Palmas del Socorro', NULL, 1, 1, '2023-02-22 12:50:49'),
(639, 76, 'Palmira', NULL, 1, 1, '2023-02-22 12:50:49'),
(640, 70, 'Palmito', NULL, 1, 1, '2023-02-22 12:50:49'),
(641, 73, 'Palocabildo', NULL, 1, 1, '2023-02-22 12:50:49'),
(642, 54, 'Pamplona', NULL, 1, 1, '2023-02-22 12:50:49'),
(643, 54, 'Pamplonita', NULL, 1, 1, '2023-02-22 12:50:49'),
(644, 25, 'Pandi', NULL, 1, 1, '2023-02-22 12:50:49'),
(645, 15, 'Panqueba', NULL, 1, 1, '2023-02-22 12:50:49'),
(646, 25, 'Paratebueno', NULL, 1, 1, '2023-02-22 12:50:49'),
(647, 25, 'Pasca', NULL, 1, 1, '2023-02-22 12:50:49'),
(648, 19, 'Patía (El Bordo)', NULL, 1, 1, '2023-02-22 12:50:49'),
(649, 15, 'Pauna', NULL, 1, 1, '2023-02-22 12:50:49'),
(650, 15, 'Paya', NULL, 1, 1, '2023-02-22 12:50:49'),
(651, 85, 'Paz de Ariporo', NULL, 1, 1, '2023-02-22 12:50:49'),
(652, 15, 'Paz de Río', NULL, 1, 1, '2023-02-22 12:50:49'),
(653, 47, 'Pedraza', NULL, 1, 1, '2023-02-22 12:50:49'),
(654, 20, 'Pelaya', NULL, 1, 1, '2023-02-22 12:50:49'),
(655, 17, 'Pensilvania', NULL, 1, 1, '2023-02-22 12:50:49'),
(656, 5, 'Peque', NULL, 1, 1, '2023-02-22 12:50:49'),
(657, 66, 'Pereira', NULL, 1, 1, '2023-02-22 12:50:49'),
(658, 15, 'Pesca', NULL, 1, 1, '2023-02-22 12:50:49'),
(659, 5, 'Peñol', NULL, 1, 1, '2023-02-22 12:50:49'),
(660, 19, 'Piamonte', NULL, 1, 1, '2023-02-22 12:50:49'),
(661, 68, 'Pie de Cuesta', NULL, 1, 1, '2023-02-22 12:50:49'),
(662, 73, 'Piedras', NULL, 1, 1, '2023-02-22 12:50:49'),
(663, 19, 'Piendamó', NULL, 1, 1, '2023-02-22 12:50:49'),
(664, 63, 'Pijao', NULL, 1, 1, '2023-02-22 12:50:49'),
(665, 47, 'Pijiño', NULL, 1, 1, '2023-02-22 12:50:49'),
(666, 68, 'Pinchote', NULL, 1, 1, '2023-02-22 12:50:49'),
(667, 13, 'Pinillos', NULL, 1, 1, '2023-02-22 12:50:49'),
(668, 8, 'Piojo', NULL, 1, 1, '2023-02-22 12:50:49'),
(669, 15, 'Pisva', NULL, 1, 1, '2023-02-22 12:50:49'),
(670, 41, 'Pital', NULL, 1, 1, '2023-02-22 12:50:49'),
(671, 41, 'Pitalito', NULL, 1, 1, '2023-02-22 12:50:49'),
(672, 47, 'Pivijay', NULL, 1, 1, '2023-02-22 12:50:49'),
(673, 73, 'Planadas', NULL, 1, 1, '2023-02-22 12:50:49'),
(674, 23, 'Planeta Rica', NULL, 1, 1, '2023-02-22 12:50:49'),
(675, 47, 'Plato', NULL, 1, 1, '2023-02-22 12:50:49'),
(676, 52, 'Policarpa', NULL, 1, 1, '2023-02-22 12:50:49'),
(677, 8, 'Polonuevo', NULL, 1, 1, '2023-02-22 12:50:49'),
(678, 8, 'Ponedera', NULL, 1, 1, '2023-02-22 12:50:49'),
(679, 19, 'Popayán', NULL, 1, 1, '2023-02-22 12:50:49'),
(680, 85, 'Pore', NULL, 1, 1, '2023-02-22 12:50:49'),
(681, 52, 'Potosí', NULL, 1, 1, '2023-02-22 12:50:49'),
(682, 76, 'Pradera', NULL, 1, 1, '2023-02-22 12:50:49'),
(683, 73, 'Prado', NULL, 1, 1, '2023-02-22 12:50:49'),
(684, 52, 'Providencia', NULL, 1, 1, '2023-02-22 12:50:49'),
(685, 88, 'Providencia', NULL, 1, 1, '2023-02-22 12:50:49'),
(686, 20, 'Pueblo Bello', NULL, 1, 1, '2023-02-22 12:50:49'),
(687, 23, 'Pueblo Nuevo', NULL, 1, 1, '2023-02-22 12:50:49'),
(688, 66, 'Pueblo Rico', NULL, 1, 1, '2023-02-22 12:50:49'),
(689, 5, 'Pueblorrico', NULL, 1, 1, '2023-02-22 12:50:49'),
(690, 47, 'Puebloviejo', NULL, 1, 1, '2023-02-22 12:50:49'),
(691, 68, 'Puente Nacional', NULL, 1, 1, '2023-02-22 12:50:49'),
(692, 52, 'Puerres', NULL, 1, 1, '2023-02-22 12:50:49'),
(693, 86, 'Puerto Asís', NULL, 1, 1, '2023-02-22 12:50:49'),
(694, 5, 'Puerto Berrío', NULL, 1, 1, '2023-02-22 12:50:49'),
(695, 15, 'Puerto Boyacá', NULL, 1, 1, '2023-02-22 12:50:49'),
(696, 86, 'Puerto Caicedo', NULL, 1, 1, '2023-02-22 12:50:49'),
(697, 99, 'Puerto Carreño', NULL, 1, 1, '2023-02-22 12:50:49'),
(698, 8, 'Puerto Colombia', NULL, 1, 1, '2023-02-22 12:50:49'),
(699, 50, 'Puerto Concordia', NULL, 1, 1, '2023-02-22 12:50:49'),
(700, 23, 'Puerto Escondido', NULL, 1, 1, '2023-02-22 12:50:49'),
(701, 50, 'Puerto Gaitán', NULL, 1, 1, '2023-02-22 12:50:49'),
(702, 86, 'Puerto Guzmán', NULL, 1, 1, '2023-02-22 12:50:49'),
(703, 86, 'Puerto Leguízamo', NULL, 1, 1, '2023-02-22 12:50:49'),
(704, 23, 'Puerto Libertador', NULL, 1, 1, '2023-02-22 12:50:49'),
(705, 50, 'Puerto Lleras', NULL, 1, 1, '2023-02-22 12:50:49'),
(706, 50, 'Puerto López', NULL, 1, 1, '2023-02-22 12:50:49'),
(707, 5, 'Puerto Nare', NULL, 1, 1, '2023-02-22 12:50:49'),
(708, 91, 'Puerto Nariño', NULL, 1, 1, '2023-02-22 12:50:49'),
(709, 68, 'Puerto Parra', NULL, 1, 1, '2023-02-22 12:50:49'),
(710, 18, 'Puerto Rico', NULL, 1, 1, '2023-02-22 12:50:49'),
(711, 50, 'Puerto Rico', NULL, 1, 1, '2023-02-22 12:50:49'),
(712, 81, 'Puerto Rondón', NULL, 1, 1, '2023-02-22 12:50:49'),
(713, 25, 'Puerto Salgar', NULL, 1, 1, '2023-02-22 12:50:49'),
(714, 54, 'Puerto Santander', NULL, 1, 1, '2023-02-22 12:50:49'),
(715, 19, 'Puerto Tejada', NULL, 1, 1, '2023-02-22 12:50:49'),
(716, 5, 'Puerto Triunfo', NULL, 1, 1, '2023-02-22 12:50:49'),
(717, 68, 'Puerto Wilches', NULL, 1, 1, '2023-02-22 12:50:49'),
(718, 25, 'Pulí', NULL, 1, 1, '2023-02-22 12:50:49'),
(719, 52, 'Pupiales', NULL, 1, 1, '2023-02-22 12:50:49'),
(720, 19, 'Puracé (Coconuco)', NULL, 1, 1, '2023-02-22 12:50:49'),
(721, 73, 'Purificación', NULL, 1, 1, '2023-02-22 12:50:49'),
(722, 23, 'Purísima', NULL, 1, 1, '2023-02-22 12:50:49'),
(723, 17, 'Pácora', NULL, 1, 1, '2023-02-22 12:50:49'),
(724, 15, 'Páez', NULL, 1, 1, '2023-02-22 12:50:49'),
(725, 19, 'Páez (Belalcazar)', NULL, 1, 1, '2023-02-22 12:50:49'),
(726, 68, 'Páramo', NULL, 1, 1, '2023-02-22 12:50:49'),
(727, 25, 'Quebradanegra', NULL, 1, 1, '2023-02-22 12:50:49'),
(728, 25, 'Quetame', NULL, 1, 1, '2023-02-22 12:50:49'),
(729, 27, 'Quibdó', NULL, 1, 1, '2023-02-22 12:50:49'),
(730, 63, 'Quimbaya', NULL, 1, 1, '2023-02-22 12:50:49'),
(731, 66, 'Quinchía', NULL, 1, 1, '2023-02-22 12:50:49'),
(732, 15, 'Quipama', NULL, 1, 1, '2023-02-22 12:50:49'),
(733, 25, 'Quipile', NULL, 1, 1, '2023-02-22 12:50:49'),
(734, 54, 'Ragonvalia', NULL, 1, 1, '2023-02-22 12:50:49'),
(735, 15, 'Ramiriquí', NULL, 1, 1, '2023-02-22 12:50:49'),
(736, 85, 'Recetor', NULL, 1, 1, '2023-02-22 12:50:49'),
(737, 13, 'Regidor', NULL, 1, 1, '2023-02-22 12:50:49'),
(738, 5, 'Remedios', NULL, 1, 1, '2023-02-22 12:50:49'),
(739, 47, 'Remolino', NULL, 1, 1, '2023-02-22 12:50:49'),
(740, 8, 'Repelón', NULL, 1, 1, '2023-02-22 12:50:49'),
(741, 50, 'Restrepo', NULL, 1, 1, '2023-02-22 12:50:49'),
(742, 76, 'Restrepo', NULL, 1, 1, '2023-02-22 12:50:49'),
(743, 5, 'Retiro', NULL, 1, 1, '2023-02-22 12:50:49'),
(744, 25, 'Ricaurte', NULL, 1, 1, '2023-02-22 12:50:49'),
(745, 52, 'Ricaurte', NULL, 1, 1, '2023-02-22 12:50:49'),
(746, 68, 'Rio Negro', NULL, 1, 1, '2023-02-22 12:50:49'),
(747, 73, 'Rioblanco', NULL, 1, 1, '2023-02-22 12:50:49'),
(748, 76, 'Riofrío', NULL, 1, 1, '2023-02-22 12:50:49'),
(749, 44, 'Riohacha', NULL, 1, 1, '2023-02-22 12:50:49'),
(750, 17, 'Risaralda', NULL, 1, 1, '2023-02-22 12:50:49'),
(751, 41, 'Rivera', NULL, 1, 1, '2023-02-22 12:50:49'),
(752, 52, 'Roberto Payán (San José)', NULL, 1, 1, '2023-02-22 12:50:49'),
(753, 76, 'Roldanillo', NULL, 1, 1, '2023-02-22 12:50:49'),
(754, 73, 'Roncesvalles', NULL, 1, 1, '2023-02-22 12:50:49'),
(755, 15, 'Rondón', NULL, 1, 1, '2023-02-22 12:50:49'),
(756, 19, 'Rosas', NULL, 1, 1, '2023-02-22 12:50:49'),
(757, 73, 'Rovira', NULL, 1, 1, '2023-02-22 12:50:49'),
(758, 15, 'Ráquira', NULL, 1, 1, '2023-02-22 12:50:49'),
(759, 27, 'Río Iró', NULL, 1, 1, '2023-02-22 12:50:49'),
(760, 27, 'Río Quito', NULL, 1, 1, '2023-02-22 12:50:49'),
(761, 17, 'Río Sucio', NULL, 1, 1, '2023-02-22 12:50:49'),
(762, 13, 'Río Viejo', NULL, 1, 1, '2023-02-22 12:50:49'),
(763, 20, 'Río de oro', NULL, 1, 1, '2023-02-22 12:50:49'),
(764, 5, 'Ríonegro', NULL, 1, 1, '2023-02-22 12:50:49'),
(765, 27, 'Ríosucio', NULL, 1, 1, '2023-02-22 12:50:49'),
(766, 68, 'Sabana de Torres', NULL, 1, 1, '2023-02-22 12:50:49'),
(767, 8, 'Sabanagrande', NULL, 1, 1, '2023-02-22 12:50:49'),
(768, 5, 'Sabanalarga', NULL, 1, 1, '2023-02-22 12:50:49'),
(769, 8, 'Sabanalarga', NULL, 1, 1, '2023-02-22 12:50:49'),
(770, 85, 'Sabanalarga', NULL, 1, 1, '2023-02-22 12:50:49'),
(771, 47, 'Sabanas de San Angel (SAN ANGEL)', NULL, 1, 1, '2023-02-22 12:50:49'),
(772, 5, 'Sabaneta', NULL, 1, 1, '2023-02-22 12:50:49'),
(773, 15, 'Saboyá', NULL, 1, 1, '2023-02-22 12:50:49'),
(774, 23, 'Sahagún', NULL, 1, 1, '2023-02-22 12:50:49'),
(775, 41, 'Saladoblanco', NULL, 1, 1, '2023-02-22 12:50:49'),
(776, 17, 'Salamina', NULL, 1, 1, '2023-02-22 12:50:49'),
(777, 47, 'Salamina', NULL, 1, 1, '2023-02-22 12:50:49'),
(778, 54, 'Salazar', NULL, 1, 1, '2023-02-22 12:50:49'),
(779, 73, 'Saldaña', NULL, 1, 1, '2023-02-22 12:50:49'),
(780, 63, 'Salento', NULL, 1, 1, '2023-02-22 12:50:49'),
(781, 5, 'Salgar', NULL, 1, 1, '2023-02-22 12:50:49'),
(782, 15, 'Samacá', NULL, 1, 1, '2023-02-22 12:50:49'),
(783, 52, 'Samaniego', NULL, 1, 1, '2023-02-22 12:50:49'),
(784, 17, 'Samaná', NULL, 1, 1, '2023-02-22 12:50:49'),
(785, 70, 'Sampués', NULL, 1, 1, '2023-02-22 12:50:49'),
(786, 41, 'San Agustín', NULL, 1, 1, '2023-02-22 12:50:49'),
(787, 20, 'San Alberto', NULL, 1, 1, '2023-02-22 12:50:49'),
(788, 68, 'San Andrés', NULL, 1, 1, '2023-02-22 12:50:49'),
(789, 23, 'San Andrés Sotavento', NULL, 1, 1, '2023-02-22 12:50:49'),
(790, 5, 'San Andrés de Cuerquía', NULL, 1, 1, '2023-02-22 12:50:49'),
(791, 23, 'San Antero', NULL, 1, 1, '2023-02-22 12:50:49'),
(792, 73, 'San Antonio', NULL, 1, 1, '2023-02-22 12:50:49'),
(793, 25, 'San Antonio de Tequendama', NULL, 1, 1, '2023-02-22 12:50:49'),
(794, 68, 'San Benito', NULL, 1, 1, '2023-02-22 12:50:49'),
(795, 70, 'San Benito Abad', NULL, 1, 1, '2023-02-22 12:50:49'),
(796, 25, 'San Bernardo', NULL, 1, 1, '2023-02-22 12:50:49'),
(797, 52, 'San Bernardo', NULL, 1, 1, '2023-02-22 12:50:49'),
(798, 23, 'San Bernardo del Viento', NULL, 1, 1, '2023-02-22 12:50:49'),
(799, 54, 'San Calixto', NULL, 1, 1, '2023-02-22 12:50:49'),
(800, 5, 'San Carlos', NULL, 1, 1, '2023-02-22 12:50:49'),
(801, 23, 'San Carlos', NULL, 1, 1, '2023-02-22 12:50:49'),
(802, 50, 'San Carlos de Guaroa', NULL, 1, 1, '2023-02-22 12:50:49'),
(803, 25, 'San Cayetano', NULL, 1, 1, '2023-02-22 12:50:49'),
(804, 54, 'San Cayetano', NULL, 1, 1, '2023-02-22 12:50:49'),
(805, 13, 'San Cristobal', NULL, 1, 1, '2023-02-22 12:50:49'),
(806, 20, 'San Diego', NULL, 1, 1, '2023-02-22 12:50:49'),
(807, 15, 'San Eduardo', NULL, 1, 1, '2023-02-22 12:50:49'),
(808, 13, 'San Estanislao', NULL, 1, 1, '2023-02-22 12:50:49'),
(809, 13, 'San Fernando', NULL, 1, 1, '2023-02-22 12:50:49'),
(810, 5, 'San Francisco', NULL, 1, 1, '2023-02-22 12:50:49'),
(811, 25, 'San Francisco', NULL, 1, 1, '2023-02-22 12:50:49'),
(812, 86, 'San Francisco', NULL, 1, 1, '2023-02-22 12:50:49'),
(813, 68, 'San Gíl', NULL, 1, 1, '2023-02-22 12:50:49'),
(814, 13, 'San Jacinto', NULL, 1, 1, '2023-02-22 12:50:49'),
(815, 13, 'San Jacinto del Cauca', NULL, 1, 1, '2023-02-22 12:50:49'),
(816, 5, 'San Jerónimo', NULL, 1, 1, '2023-02-22 12:50:49'),
(817, 68, 'San Joaquín', NULL, 1, 1, '2023-02-22 12:50:49'),
(818, 17, 'San José', NULL, 1, 1, '2023-02-22 12:50:49'),
(819, 68, 'San José de Miranda', NULL, 1, 1, '2023-02-22 12:50:49'),
(820, 5, 'San José de Montaña', NULL, 1, 1, '2023-02-22 12:50:49'),
(821, 15, 'San José de Pare', NULL, 1, 1, '2023-02-22 12:50:49'),
(822, 23, 'San José de Uré', NULL, 1, 1, '2023-02-22 12:50:49'),
(823, 18, 'San José del Fragua', NULL, 1, 1, '2023-02-22 12:50:49'),
(824, 95, 'San José del Guaviare', NULL, 1, 1, '2023-02-22 12:50:49'),
(825, 27, 'San José del Palmar', NULL, 1, 1, '2023-02-22 12:50:49'),
(826, 50, 'San Juan de Arama', NULL, 1, 1, '2023-02-22 12:50:49'),
(827, 70, 'San Juan de Betulia', NULL, 1, 1, '2023-02-22 12:50:49'),
(828, 13, 'San Juan de Nepomuceno', NULL, 1, 1, '2023-02-22 12:50:49'),
(829, 52, 'San Juan de Pasto', NULL, 1, 1, '2023-02-22 12:50:49'),
(830, 25, 'San Juan de Río Seco', NULL, 1, 1, '2023-02-22 12:50:49'),
(831, 5, 'San Juan de Urabá', NULL, 1, 1, '2023-02-22 12:50:49'),
(832, 44, 'San Juan del Cesar', NULL, 1, 1, '2023-02-22 12:50:49'),
(833, 50, 'San Juanito', NULL, 1, 1, '2023-02-22 12:50:49'),
(834, 52, 'San Lorenzo', NULL, 1, 1, '2023-02-22 12:50:49'),
(835, 73, 'San Luis', NULL, 1, 1, '2023-02-22 12:50:49'),
(836, 5, 'San Luís', NULL, 1, 1, '2023-02-22 12:50:49'),
(837, 15, 'San Luís de Gaceno', NULL, 1, 1, '2023-02-22 12:50:49'),
(838, 85, 'San Luís de Palenque', NULL, 1, 1, '2023-02-22 12:50:49'),
(839, 70, 'San Marcos', NULL, 1, 1, '2023-02-22 12:50:49'),
(840, 20, 'San Martín', NULL, 1, 1, '2023-02-22 12:50:49'),
(841, 50, 'San Martín', NULL, 1, 1, '2023-02-22 12:50:49'),
(842, 13, 'San Martín de Loba', NULL, 1, 1, '2023-02-22 12:50:49'),
(843, 15, 'San Mateo', NULL, 1, 1, '2023-02-22 12:50:49'),
(844, 68, 'San Miguel', NULL, 1, 1, '2023-02-22 12:50:49'),
(845, 86, 'San Miguel', NULL, 1, 1, '2023-02-22 12:50:49'),
(846, 15, 'San Miguel de Sema', NULL, 1, 1, '2023-02-22 12:50:49'),
(847, 70, 'San Onofre', NULL, 1, 1, '2023-02-22 12:50:49'),
(848, 13, 'San Pablo', NULL, 1, 1, '2023-02-22 12:50:49'),
(849, 52, 'San Pablo', NULL, 1, 1, '2023-02-22 12:50:49'),
(850, 15, 'San Pablo de Borbur', NULL, 1, 1, '2023-02-22 12:50:49'),
(851, 5, 'San Pedro', NULL, 1, 1, '2023-02-22 12:50:49'),
(852, 70, 'San Pedro', NULL, 1, 1, '2023-02-22 12:50:49'),
(853, 76, 'San Pedro', NULL, 1, 1, '2023-02-22 12:50:49'),
(854, 52, 'San Pedro de Cartago', NULL, 1, 1, '2023-02-22 12:50:49'),
(855, 5, 'San Pedro de Urabá', NULL, 1, 1, '2023-02-22 12:50:49'),
(856, 23, 'San Pelayo', NULL, 1, 1, '2023-02-22 12:50:49'),
(857, 5, 'San Rafael', NULL, 1, 1, '2023-02-22 12:50:49'),
(858, 5, 'San Roque', NULL, 1, 1, '2023-02-22 12:50:49'),
(859, 19, 'San Sebastián', NULL, 1, 1, '2023-02-22 12:50:49'),
(860, 47, 'San Sebastián de Buenavista', NULL, 1, 1, '2023-02-22 12:50:49'),
(861, 5, 'San Vicente', NULL, 1, 1, '2023-02-22 12:50:49'),
(862, 18, 'San Vicente del Caguán', NULL, 1, 1, '2023-02-22 12:50:49'),
(863, 68, 'San Vicente del Chucurí', NULL, 1, 1, '2023-02-22 12:50:49'),
(864, 47, 'San Zenón', NULL, 1, 1, '2023-02-22 12:50:49'),
(865, 52, 'Sandoná', NULL, 1, 1, '2023-02-22 12:50:49'),
(866, 47, 'Santa Ana', NULL, 1, 1, '2023-02-22 12:50:49'),
(867, 5, 'Santa Bárbara', NULL, 1, 1, '2023-02-22 12:50:49'),
(868, 68, 'Santa Bárbara', NULL, 1, 1, '2023-02-22 12:50:49'),
(869, 52, 'Santa Bárbara (Iscuandé)', NULL, 1, 1, '2023-02-22 12:50:49'),
(870, 47, 'Santa Bárbara de Pinto', NULL, 1, 1, '2023-02-22 12:50:49'),
(871, 13, 'Santa Catalina', NULL, 1, 1, '2023-02-22 12:50:49'),
(872, 5, 'Santa Fé de Antioquia', NULL, 1, 1, '2023-02-22 12:50:49'),
(873, 27, 'Santa Genoveva de Docorodó', NULL, 1, 1, '2023-02-22 12:50:49'),
(874, 68, 'Santa Helena del Opón', NULL, 1, 1, '2023-02-22 12:50:49'),
(875, 73, 'Santa Isabel', NULL, 1, 1, '2023-02-22 12:50:49');
INSERT INTO `ciudades` (`id`, `departamento_id`, `nombre`, `codigo_postal`, `status`, `created_by`, `created_at`) VALUES
(876, 8, 'Santa Lucía', NULL, 1, 1, '2023-02-22 12:50:49'),
(877, 47, 'Santa Marta', NULL, 1, 1, '2023-02-22 12:50:49'),
(878, 15, 'Santa María', NULL, 1, 1, '2023-02-22 12:50:49'),
(879, 41, 'Santa María', NULL, 1, 1, '2023-02-22 12:50:49'),
(880, 13, 'Santa Rosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(881, 19, 'Santa Rosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(882, 66, 'Santa Rosa de Cabal', NULL, 1, 1, '2023-02-22 12:50:49'),
(883, 5, 'Santa Rosa de Osos', NULL, 1, 1, '2023-02-22 12:50:49'),
(884, 15, 'Santa Rosa de Viterbo', NULL, 1, 1, '2023-02-22 12:50:49'),
(885, 13, 'Santa Rosa del Sur', NULL, 1, 1, '2023-02-22 12:50:49'),
(886, 99, 'Santa Rosalía', NULL, 1, 1, '2023-02-22 12:50:49'),
(887, 15, 'Santa Sofía', NULL, 1, 1, '2023-02-22 12:50:49'),
(888, 15, 'Santana', NULL, 1, 1, '2023-02-22 12:50:49'),
(889, 19, 'Santander de Quilichao', NULL, 1, 1, '2023-02-22 12:50:49'),
(890, 54, 'Santiago', NULL, 1, 1, '2023-02-22 12:50:49'),
(891, 86, 'Santiago', NULL, 1, 1, '2023-02-22 12:50:49'),
(892, 5, 'Santo Domingo', NULL, 1, 1, '2023-02-22 12:50:49'),
(893, 8, 'Santo Tomás', NULL, 1, 1, '2023-02-22 12:50:49'),
(894, 5, 'Santuario', NULL, 1, 1, '2023-02-22 12:50:49'),
(895, 66, 'Santuario', NULL, 1, 1, '2023-02-22 12:50:49'),
(896, 52, 'Sapuyes', NULL, 1, 1, '2023-02-22 12:50:49'),
(897, 81, 'Saravena', NULL, 1, 1, '2023-02-22 12:50:49'),
(898, 54, 'Sardinata', NULL, 1, 1, '2023-02-22 12:50:49'),
(899, 25, 'Sasaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(900, 15, 'Sativanorte', NULL, 1, 1, '2023-02-22 12:50:49'),
(901, 15, 'Sativasur', NULL, 1, 1, '2023-02-22 12:50:49'),
(902, 5, 'Segovia', NULL, 1, 1, '2023-02-22 12:50:49'),
(903, 25, 'Sesquilé', NULL, 1, 1, '2023-02-22 12:50:49'),
(904, 76, 'Sevilla', NULL, 1, 1, '2023-02-22 12:50:49'),
(905, 15, 'Siachoque', NULL, 1, 1, '2023-02-22 12:50:49'),
(906, 25, 'Sibaté', NULL, 1, 1, '2023-02-22 12:50:49'),
(907, 86, 'Sibundoy', NULL, 1, 1, '2023-02-22 12:50:49'),
(908, 54, 'Silos', NULL, 1, 1, '2023-02-22 12:50:49'),
(909, 25, 'Silvania', NULL, 1, 1, '2023-02-22 12:50:49'),
(910, 19, 'Silvia', NULL, 1, 1, '2023-02-22 12:50:49'),
(911, 68, 'Simacota', NULL, 1, 1, '2023-02-22 12:50:49'),
(912, 25, 'Simijaca', NULL, 1, 1, '2023-02-22 12:50:49'),
(913, 13, 'Simití', NULL, 1, 1, '2023-02-22 12:50:49'),
(914, 70, 'Sincelejo', NULL, 1, 1, '2023-02-22 12:50:49'),
(915, 70, 'Sincé', NULL, 1, 1, '2023-02-22 12:50:49'),
(916, 27, 'Sipí', NULL, 1, 1, '2023-02-22 12:50:49'),
(917, 47, 'Sitionuevo', NULL, 1, 1, '2023-02-22 12:50:49'),
(918, 25, 'Soacha', NULL, 1, 1, '2023-02-22 12:50:49'),
(919, 15, 'Soatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(920, 15, 'Socha', NULL, 1, 1, '2023-02-22 12:50:49'),
(921, 68, 'Socorro', NULL, 1, 1, '2023-02-22 12:50:49'),
(922, 15, 'Socotá', NULL, 1, 1, '2023-02-22 12:50:49'),
(923, 15, 'Sogamoso', NULL, 1, 1, '2023-02-22 12:50:49'),
(924, 18, 'Solano', NULL, 1, 1, '2023-02-22 12:50:49'),
(925, 8, 'Soledad', NULL, 1, 1, '2023-02-22 12:50:49'),
(926, 18, 'Solita', NULL, 1, 1, '2023-02-22 12:50:49'),
(927, 15, 'Somondoco', NULL, 1, 1, '2023-02-22 12:50:49'),
(928, 5, 'Sonsón', NULL, 1, 1, '2023-02-22 12:50:49'),
(929, 5, 'Sopetrán', NULL, 1, 1, '2023-02-22 12:50:49'),
(930, 13, 'Soplaviento', NULL, 1, 1, '2023-02-22 12:50:49'),
(931, 25, 'Sopó', NULL, 1, 1, '2023-02-22 12:50:49'),
(932, 15, 'Sora', NULL, 1, 1, '2023-02-22 12:50:49'),
(933, 15, 'Soracá', NULL, 1, 1, '2023-02-22 12:50:49'),
(934, 15, 'Sotaquirá', NULL, 1, 1, '2023-02-22 12:50:49'),
(935, 19, 'Sotara (Paispamba)', NULL, 1, 1, '2023-02-22 12:50:49'),
(936, 52, 'Sotomayor (Los Andes)', NULL, 1, 1, '2023-02-22 12:50:49'),
(937, 68, 'Suaita', NULL, 1, 1, '2023-02-22 12:50:49'),
(938, 8, 'Suan', NULL, 1, 1, '2023-02-22 12:50:49'),
(939, 41, 'Suaza', NULL, 1, 1, '2023-02-22 12:50:49'),
(940, 25, 'Subachoque', NULL, 1, 1, '2023-02-22 12:50:49'),
(941, 19, 'Sucre', NULL, 1, 1, '2023-02-22 12:50:49'),
(942, 68, 'Sucre', NULL, 1, 1, '2023-02-22 12:50:49'),
(943, 70, 'Sucre', NULL, 1, 1, '2023-02-22 12:50:49'),
(944, 25, 'Suesca', NULL, 1, 1, '2023-02-22 12:50:49'),
(945, 25, 'Supatá', NULL, 1, 1, '2023-02-22 12:50:49'),
(946, 17, 'Supía', NULL, 1, 1, '2023-02-22 12:50:49'),
(947, 68, 'Suratá', NULL, 1, 1, '2023-02-22 12:50:49'),
(948, 25, 'Susa', NULL, 1, 1, '2023-02-22 12:50:49'),
(949, 15, 'Susacón', NULL, 1, 1, '2023-02-22 12:50:49'),
(950, 15, 'Sutamarchán', NULL, 1, 1, '2023-02-22 12:50:49'),
(951, 25, 'Sutatausa', NULL, 1, 1, '2023-02-22 12:50:49'),
(952, 15, 'Sutatenza', NULL, 1, 1, '2023-02-22 12:50:49'),
(953, 19, 'Suárez', NULL, 1, 1, '2023-02-22 12:50:49'),
(954, 73, 'Suárez', NULL, 1, 1, '2023-02-22 12:50:49'),
(955, 85, 'Sácama', NULL, 1, 1, '2023-02-22 12:50:49'),
(956, 15, 'Sáchica', NULL, 1, 1, '2023-02-22 12:50:49'),
(957, 25, 'Tabio', NULL, 1, 1, '2023-02-22 12:50:49'),
(958, 27, 'Tadó', NULL, 1, 1, '2023-02-22 12:50:49'),
(959, 13, 'Talaigua Nuevo', NULL, 1, 1, '2023-02-22 12:50:49'),
(960, 20, 'Tamalameque', NULL, 1, 1, '2023-02-22 12:50:49'),
(961, 81, 'Tame', NULL, 1, 1, '2023-02-22 12:50:49'),
(962, 52, 'Taminango', NULL, 1, 1, '2023-02-22 12:50:49'),
(963, 52, 'Tangua', NULL, 1, 1, '2023-02-22 12:50:49'),
(964, 97, 'Taraira', NULL, 1, 1, '2023-02-22 12:50:49'),
(965, 5, 'Tarazá', NULL, 1, 1, '2023-02-22 12:50:49'),
(966, 41, 'Tarqui', NULL, 1, 1, '2023-02-22 12:50:49'),
(967, 5, 'Tarso', NULL, 1, 1, '2023-02-22 12:50:49'),
(968, 15, 'Tasco', NULL, 1, 1, '2023-02-22 12:50:49'),
(969, 85, 'Tauramena', NULL, 1, 1, '2023-02-22 12:50:49'),
(970, 25, 'Tausa', NULL, 1, 1, '2023-02-22 12:50:49'),
(971, 41, 'Tello', NULL, 1, 1, '2023-02-22 12:50:49'),
(972, 25, 'Tena', NULL, 1, 1, '2023-02-22 12:50:49'),
(973, 47, 'Tenerife', NULL, 1, 1, '2023-02-22 12:50:49'),
(974, 25, 'Tenjo', NULL, 1, 1, '2023-02-22 12:50:49'),
(975, 15, 'Tenza', NULL, 1, 1, '2023-02-22 12:50:49'),
(976, 54, 'Teorama', NULL, 1, 1, '2023-02-22 12:50:49'),
(977, 41, 'Teruel', NULL, 1, 1, '2023-02-22 12:50:49'),
(978, 41, 'Tesalia', NULL, 1, 1, '2023-02-22 12:50:49'),
(979, 25, 'Tibacuy', NULL, 1, 1, '2023-02-22 12:50:49'),
(980, 15, 'Tibaná', NULL, 1, 1, '2023-02-22 12:50:49'),
(981, 15, 'Tibasosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(982, 25, 'Tibirita', NULL, 1, 1, '2023-02-22 12:50:49'),
(983, 54, 'Tibú', NULL, 1, 1, '2023-02-22 12:50:49'),
(984, 23, 'Tierralta', NULL, 1, 1, '2023-02-22 12:50:49'),
(985, 41, 'Timaná', NULL, 1, 1, '2023-02-22 12:50:49'),
(986, 19, 'Timbiquí', NULL, 1, 1, '2023-02-22 12:50:49'),
(987, 19, 'Timbío', NULL, 1, 1, '2023-02-22 12:50:49'),
(988, 15, 'Tinjacá', NULL, 1, 1, '2023-02-22 12:50:49'),
(989, 15, 'Tipacoque', NULL, 1, 1, '2023-02-22 12:50:49'),
(990, 13, 'Tiquisio (Puerto Rico)', NULL, 1, 1, '2023-02-22 12:50:49'),
(991, 5, 'Titiribí', NULL, 1, 1, '2023-02-22 12:50:49'),
(992, 15, 'Toca', NULL, 1, 1, '2023-02-22 12:50:49'),
(993, 25, 'Tocaima', NULL, 1, 1, '2023-02-22 12:50:49'),
(994, 25, 'Tocancipá', NULL, 1, 1, '2023-02-22 12:50:49'),
(995, 15, 'Toguí', NULL, 1, 1, '2023-02-22 12:50:49'),
(996, 5, 'Toledo', NULL, 1, 1, '2023-02-22 12:50:49'),
(997, 54, 'Toledo', NULL, 1, 1, '2023-02-22 12:50:49'),
(998, 70, 'Tolú', NULL, 1, 1, '2023-02-22 12:50:49'),
(999, 70, 'Tolú Viejo', NULL, 1, 1, '2023-02-22 12:50:49'),
(1000, 68, 'Tona', NULL, 1, 1, '2023-02-22 12:50:49'),
(1001, 15, 'Topagá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1002, 25, 'Topaipí', NULL, 1, 1, '2023-02-22 12:50:49'),
(1003, 19, 'Toribío', NULL, 1, 1, '2023-02-22 12:50:49'),
(1004, 76, 'Toro', NULL, 1, 1, '2023-02-22 12:50:49'),
(1005, 15, 'Tota', NULL, 1, 1, '2023-02-22 12:50:49'),
(1006, 19, 'Totoró', NULL, 1, 1, '2023-02-22 12:50:49'),
(1007, 85, 'Trinidad', NULL, 1, 1, '2023-02-22 12:50:49'),
(1008, 76, 'Trujillo', NULL, 1, 1, '2023-02-22 12:50:49'),
(1009, 8, 'Tubará', NULL, 1, 1, '2023-02-22 12:50:49'),
(1010, 23, 'Tuchín', NULL, 1, 1, '2023-02-22 12:50:49'),
(1011, 76, 'Tulúa', NULL, 1, 1, '2023-02-22 12:50:49'),
(1012, 52, 'Tumaco', NULL, 1, 1, '2023-02-22 12:50:49'),
(1013, 15, 'Tunja', NULL, 1, 1, '2023-02-22 12:50:49'),
(1014, 15, 'Tunungua', NULL, 1, 1, '2023-02-22 12:50:49'),
(1015, 13, 'Turbaco', NULL, 1, 1, '2023-02-22 12:50:49'),
(1016, 13, 'Turbaná', NULL, 1, 1, '2023-02-22 12:50:49'),
(1017, 5, 'Turbo', NULL, 1, 1, '2023-02-22 12:50:49'),
(1018, 15, 'Turmequé', NULL, 1, 1, '2023-02-22 12:50:49'),
(1019, 15, 'Tuta', NULL, 1, 1, '2023-02-22 12:50:49'),
(1020, 15, 'Tutasá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1021, 85, 'Támara', NULL, 1, 1, '2023-02-22 12:50:49'),
(1022, 5, 'Támesis', NULL, 1, 1, '2023-02-22 12:50:49'),
(1023, 52, 'Túquerres', NULL, 1, 1, '2023-02-22 12:50:49'),
(1024, 25, 'Ubalá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1025, 25, 'Ubaque', NULL, 1, 1, '2023-02-22 12:50:49'),
(1026, 25, 'Ubaté', NULL, 1, 1, '2023-02-22 12:50:49'),
(1027, 76, 'Ulloa', NULL, 1, 1, '2023-02-22 12:50:49'),
(1028, 25, 'Une', NULL, 1, 1, '2023-02-22 12:50:49'),
(1029, 27, 'Unguía', NULL, 1, 1, '2023-02-22 12:50:49'),
(1030, 27, 'Unión Panamericana (ÁNIMAS)', NULL, 1, 1, '2023-02-22 12:50:49'),
(1031, 5, 'Uramita', NULL, 1, 1, '2023-02-22 12:50:49'),
(1032, 50, 'Uribe', NULL, 1, 1, '2023-02-22 12:50:49'),
(1033, 44, 'Uribia', NULL, 1, 1, '2023-02-22 12:50:49'),
(1034, 5, 'Urrao', NULL, 1, 1, '2023-02-22 12:50:49'),
(1035, 44, 'Urumita', NULL, 1, 1, '2023-02-22 12:50:49'),
(1036, 8, 'Usiacuri', NULL, 1, 1, '2023-02-22 12:50:49'),
(1037, 5, 'Valdivia', NULL, 1, 1, '2023-02-22 12:50:49'),
(1038, 23, 'Valencia', NULL, 1, 1, '2023-02-22 12:50:49'),
(1039, 68, 'Valle de San José', NULL, 1, 1, '2023-02-22 12:50:49'),
(1040, 73, 'Valle de San Juan', NULL, 1, 1, '2023-02-22 12:50:49'),
(1041, 86, 'Valle del Guamuez', NULL, 1, 1, '2023-02-22 12:50:49'),
(1042, 20, 'Valledupar', NULL, 1, 1, '2023-02-22 12:50:49'),
(1043, 5, 'Valparaiso', NULL, 1, 1, '2023-02-22 12:50:49'),
(1044, 18, 'Valparaiso', NULL, 1, 1, '2023-02-22 12:50:49'),
(1045, 5, 'Vegachí', NULL, 1, 1, '2023-02-22 12:50:49'),
(1046, 73, 'Venadillo', NULL, 1, 1, '2023-02-22 12:50:49'),
(1047, 5, 'Venecia', NULL, 1, 1, '2023-02-22 12:50:49'),
(1048, 25, 'Venecia (Ospina Pérez)', NULL, 1, 1, '2023-02-22 12:50:49'),
(1049, 15, 'Ventaquemada', NULL, 1, 1, '2023-02-22 12:50:49'),
(1050, 25, 'Vergara', NULL, 1, 1, '2023-02-22 12:50:49'),
(1051, 76, 'Versalles', NULL, 1, 1, '2023-02-22 12:50:49'),
(1052, 68, 'Vetas', NULL, 1, 1, '2023-02-22 12:50:49'),
(1053, 25, 'Viani', NULL, 1, 1, '2023-02-22 12:50:49'),
(1054, 5, 'Vigía del Fuerte', NULL, 1, 1, '2023-02-22 12:50:49'),
(1055, 76, 'Vijes', NULL, 1, 1, '2023-02-22 12:50:49'),
(1056, 54, 'Villa Caro', NULL, 1, 1, '2023-02-22 12:50:49'),
(1057, 19, 'Villa Rica', NULL, 1, 1, '2023-02-22 12:50:49'),
(1058, 15, 'Villa de Leiva', NULL, 1, 1, '2023-02-22 12:50:49'),
(1059, 54, 'Villa del Rosario', NULL, 1, 1, '2023-02-22 12:50:49'),
(1060, 86, 'Villagarzón', NULL, 1, 1, '2023-02-22 12:50:49'),
(1061, 25, 'Villagómez', NULL, 1, 1, '2023-02-22 12:50:49'),
(1062, 73, 'Villahermosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(1063, 17, 'Villamaría', NULL, 1, 1, '2023-02-22 12:50:49'),
(1064, 13, 'Villanueva', NULL, 1, 1, '2023-02-22 12:50:49'),
(1065, 44, 'Villanueva', NULL, 1, 1, '2023-02-22 12:50:49'),
(1066, 68, 'Villanueva', NULL, 1, 1, '2023-02-22 12:50:49'),
(1067, 85, 'Villanueva', NULL, 1, 1, '2023-02-22 12:50:49'),
(1068, 25, 'Villapinzón', NULL, 1, 1, '2023-02-22 12:50:49'),
(1069, 73, 'Villarrica', NULL, 1, 1, '2023-02-22 12:50:49'),
(1070, 50, 'Villavicencio', NULL, 1, 1, '2023-02-22 12:50:49'),
(1071, 41, 'Villavieja', NULL, 1, 1, '2023-02-22 12:50:49'),
(1072, 25, 'Villeta', NULL, 1, 1, '2023-02-22 12:50:49'),
(1073, 25, 'Viotá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1074, 15, 'Viracachá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1075, 50, 'Vista Hermosa', NULL, 1, 1, '2023-02-22 12:50:49'),
(1076, 17, 'Viterbo', NULL, 1, 1, '2023-02-22 12:50:49'),
(1077, 68, 'Vélez', NULL, 1, 1, '2023-02-22 12:50:49'),
(1078, 25, 'Yacopí', NULL, 1, 1, '2023-02-22 12:50:49'),
(1079, 52, 'Yacuanquer', NULL, 1, 1, '2023-02-22 12:50:49'),
(1080, 41, 'Yaguará', NULL, 1, 1, '2023-02-22 12:50:49'),
(1081, 5, 'Yalí', NULL, 1, 1, '2023-02-22 12:50:49'),
(1082, 5, 'Yarumal', NULL, 1, 1, '2023-02-22 12:50:49'),
(1083, 5, 'Yolombó', NULL, 1, 1, '2023-02-22 12:50:49'),
(1084, 5, 'Yondó (Casabe)', NULL, 1, 1, '2023-02-22 12:50:49'),
(1085, 85, 'Yopal', NULL, 1, 1, '2023-02-22 12:50:49'),
(1086, 76, 'Yotoco', NULL, 1, 1, '2023-02-22 12:50:49'),
(1087, 76, 'Yumbo', NULL, 1, 1, '2023-02-22 12:50:49'),
(1088, 13, 'Zambrano', NULL, 1, 1, '2023-02-22 12:50:49'),
(1089, 68, 'Zapatoca', NULL, 1, 1, '2023-02-22 12:50:49'),
(1090, 47, 'Zapayán (PUNTA DE PIEDRAS)', NULL, 1, 1, '2023-02-22 12:50:49'),
(1091, 5, 'Zaragoza', NULL, 1, 1, '2023-02-22 12:50:49'),
(1092, 76, 'Zarzal', NULL, 1, 1, '2023-02-22 12:50:49'),
(1093, 15, 'Zetaquirá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1094, 25, 'Zipacón', NULL, 1, 1, '2023-02-22 12:50:49'),
(1095, 25, 'Zipaquirá', NULL, 1, 1, '2023-02-22 12:50:49'),
(1096, 47, 'Zona Bananera (PRADO - SEVILLA)', NULL, 1, 1, '2023-02-22 12:50:49'),
(1097, 54, 'Ábrego', NULL, 1, 1, '2023-02-22 12:50:49'),
(1098, 41, 'Íquira', NULL, 1, 1, '2023-02-22 12:50:49'),
(1099, 15, 'Úmbita', NULL, 1, 1, '2023-02-22 12:50:49'),
(1100, 25, 'Útica', NULL, 1, 1, '2023-02-22 12:50:49');

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
(9, '890917141', 'Seguridad Atempi de Colombia Limitada', 'Cl 16 B Sur Cra 42 - 97', '4486110', '3148288903', 'Andres', 'Almacen@atempi.co', '', 'a6d06a8d45fe0e84c035eb060197a4ba.png', 'Jurídico', 0, 'Medellín ', 6, 0, 0, '', '', '604', '0'),
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
-- Estructura de tabla para la tabla `configuracion_autoretencion`
--

CREATE TABLE `configuracion_autoretencion` (
  `id` int(11) NOT NULL,
  `en_uso` int(1) NOT NULL DEFAULT 1,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_impuesto` int(1) NOT NULL COMMENT '1 = Autoretencion',
  `tarifa` varchar(255) DEFAULT NULL,
  `cuenta_debito` int(11) NOT NULL,
  `cuenta_credito` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion_autoretencion`
--

INSERT INTO `configuracion_autoretencion` (`id`, `en_uso`, `codigo`, `nombre`, `tipo_impuesto`, `tarifa`, `cuenta_debito`, `cuenta_credito`, `created_by`, `created_at`) VALUES
(4, 1, '01', 'ReteFuente 4%', 1, '4', 3240, 3240, 1, '2023-05-02 16:34:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_impuestos`
--

CREATE TABLE `configuracion_impuestos` (
  `id` int(11) NOT NULL,
  `en_uso` int(1) NOT NULL DEFAULT 1,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_impuesto` int(1) NOT NULL COMMENT '1 = Iva\r\n2 = ReteFuente\r\n3 = ReteIva\r\n4 = ReteIca\r\n5 = Impoconsumo',
  `por_valor` int(1) NOT NULL DEFAULT 0,
  `tarifa` varchar(255) DEFAULT NULL,
  `ventas` int(11) NOT NULL,
  `compras` int(11) NOT NULL,
  `devolucion_ventas` int(11) NOT NULL,
  `devolucion_compras` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion_impuestos`
--

INSERT INTO `configuracion_impuestos` (`id`, `en_uso`, `codigo`, `nombre`, `tipo_impuesto`, `por_valor`, `tarifa`, `ventas`, `compras`, `devolucion_ventas`, `devolucion_compras`, `created_by`, `created_at`) VALUES
(2, 1, '1', 'IVA 19%', 1, 0, '19', 396, 401, 413, 402, 45, '2023-05-15 16:44:36'),
(3, 1, '2', 'IVA 5%', 1, 0, '5', 397, 403, 414, 404, 45, '2023-05-15 16:47:39'),
(4, 1, '3', 'RETENCION EN LA FUENTE 11%', 2, 0, '11', 96, 290, 97, 291, 45, '2023-05-15 16:49:47'),
(5, 1, '4', 'RETENCION EN LA FUENTE 10%', 2, 0, '10', 94, 301, 95, 302, 45, '2023-05-15 16:51:02'),
(6, 1, '5', 'RETENCION EN LA FUENTE 6%', 2, 0, '6', 92, 304, 93, 305, 45, '2023-05-15 16:52:33'),
(7, 1, '6', 'RETENCION EN LA FUENTE 2.5%', 2, 0, '2.5', 88, 318, 89, 319, 45, '2023-05-15 16:54:10'),
(8, 1, '7', 'RETENCION EN LA FUENTE 4%', 2, 0, '4', 90, 312, 91, 307, 45, '2023-05-15 16:55:52'),
(10, 1, '8', 'IVA 16%', 1, 0, '16', 396, 401, 413, 402, 45, '2023-05-16 09:24:43'),
(11, 1, '9', 'RTE FTE ARRIENDO 3.5%', 2, 0, '3.5', 100, 311, 101, 307, 45, '2023-05-16 09:42:16'),
(12, 1, '10', 'RETENCION DE IVA', 3, 0, '15', 112, 338, 113, 339, 45, '2023-05-16 09:45:35'),
(13, 1, '11', 'RETE FTE SERVICIOS 3.5%', 2, 0, '3.5', 100, 320, 101, 321, 45, '2023-05-16 09:47:50'),
(14, 1, '12', 'RETENCION EN LA FUENTE 7%', 2, 0, '7', 98, 315, 99, 316, 45, '2023-05-16 09:49:38'),
(15, 1, '13', 'RETENCION EN LA FUENTE 2%', 2, 0, '2', 102, 326, 103, 327, 45, '2023-05-16 09:51:11'),
(16, 1, '14', 'RETENCION EN LA FUENTE 1%', 2, 0, '1', 104, 308, 105, 309, 45, '2023-05-16 09:55:20'),
(17, 1, '15', 'RETENCION EN LA FUENTE 0.1%', 2, 0, '0.1', 106, 322, 89, 319, 45, '2023-05-16 09:57:13'),
(18, 1, '16', 'RETENCION EN LA FUENTE 4%', 2, 0, '4', 90, 306, 91, 307, 45, '2023-05-16 10:05:16'),
(19, 1, '17', 'IMPOCONSUMO 8%', 5, 1, '8', 432, 434, 433, 435, 45, '2023-05-16 10:12:23'),
(20, 1, '18', 'IVA 19% SERV', 1, 0, '19', 398, 408, 415, 409, 45, '2023-05-16 10:22:57');

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
-- Estructura de tabla para la tabla `configuracion_puc`
--

CREATE TABLE `configuracion_puc` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_child` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `acciones` int(1) NOT NULL DEFAULT 0,
  `auxiliar` int(1) NOT NULL DEFAULT 0,
  `forma_pago` int(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion_puc`
--

INSERT INTO `configuracion_puc` (`id`, `code`, `code_child`, `nombre`, `parent_id`, `status`, `acciones`, `auxiliar`, `forma_pago`, `created_by`, `created_at`) VALUES
(1, 1, NULL, 'Activo', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(2, 2, NULL, 'Pasivo', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(3, 3, NULL, 'Patrimonio', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(4, 4, NULL, 'Ingresos', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(5, 5, NULL, 'Gastos', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(6, 6, NULL, 'Costos de venta', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(7, 7, NULL, 'Costos de producción o de operación', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(8, 8, NULL, 'Cuentas de orden deudoras', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(9, 9, NULL, 'Cuentas de orden acreedoras', NULL, 1, 0, 0, 0, 43, '2023-05-08 15:00:10'),
(10, 11, NULL, 'Efectivo y equivalentes de efectivo', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:11'),
(11, 1105, NULL, 'Caja', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:12'),
(12, 110505, NULL, 'Caja general', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:13'),
(13, 11050501, 1, 'Caja general', 1, 1, 0, 1, 1, 43, '2023-05-08 15:00:14'),
(14, 110510, NULL, 'Cajas menores', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:15'),
(15, 11051001, 1, 'Caja Hugo Sanchez', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:16'),
(16, 11051002, 2, 'Caja victor Sanchez', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:17'),
(17, 1110, NULL, 'Bancos', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:18'),
(18, 111005, NULL, 'Moneda nacional', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:19'),
(19, 11100501, 1, 'Moneda nacional Bancolombia', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:20'),
(20, 11100502, 2, 'Pagos en línea', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:21'),
(21, 11100503, 3, 'Bancolombia corriente No.54232313100', 1, 1, 0, 1, 1, 43, '2023-05-08 15:00:22'),
(22, 11100504, 4, 'Pagos en línea Mercado Pago', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:23'),
(23, 111090, NULL, 'Bancos Consorcios y UT', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:24'),
(24, 11109090, 90, 'Bancos Consorcio R&S', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:25'),
(25, 1120, NULL, 'Cuentas de ahorro', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:26'),
(26, 112005, NULL, 'Bancos', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:27'),
(27, 11200501, 1, 'Bancos', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:28'),
(28, 11200502, 2, 'Bancolombia Ahorros No.10825335162', 1, 1, 0, 1, 1, 43, '2023-05-08 15:00:29'),
(29, 1145, NULL, 'Inversiones en efectivo', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:30'),
(30, 114505, NULL, 'Fiducias', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:31'),
(31, 11450501, 1, 'Fiducias', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:32'),
(32, 11450597, 97, 'D. fiscal fiducias', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:33'),
(33, 12, NULL, 'Inversiones en asociadas', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:34'),
(34, 1205, NULL, 'Acciones', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:35'),
(35, 120535, NULL, 'Comercio al por mayor y al por menor', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:36'),
(36, 12053501, 1, 'Comercio al por mayor y al por menor', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:37'),
(37, 12053502, 2, 'Reajuste fiscal', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:38'),
(38, 12053503, 3, 'Método de participación', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:39'),
(39, 1225, NULL, 'Cert. de Deposito Termino', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:40'),
(40, 122595, NULL, 'Otros Certificados ', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:41'),
(41, 12259590, 90, 'Certicados Consorcio R&S', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:42'),
(42, 1245, NULL, 'DERECHOS FIDUCIARIOS', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:43'),
(43, 124505, NULL, 'FIDUCIA BBIA', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:44'),
(44, 1295, NULL, 'Acciones o derechos en clubes deportivos', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:45'),
(45, 129515, NULL, 'Acciones o derechos en clubes deportivos', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:46'),
(46, 12951501, 1, 'Acciones o derechos en clubes deportivos', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:47'),
(47, 129595, NULL, 'Otras inversiones', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:48'),
(48, 12959501, 1, 'Otras inversiones', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:49'),
(49, 13, NULL, 'Deudores comerciales y otras cuentas por cobrar', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:50'),
(50, 1305, NULL, 'Clientes nacionales', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:51'),
(51, 130505, NULL, 'Clientes nacionales', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:52'),
(52, 13050501, 1, 'Clientes nacionales', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:53'),
(53, 130510, NULL, 'Clientes del exterior', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:54'),
(54, 13051001, 1, 'Clientes del exterior', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:55'),
(55, 130590, NULL, 'Clientes Consorcio y UT', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:56'),
(56, 13059001, 1, 'Clientes Nacionales Consorcio R&S', 1, 1, 0, 1, 0, 43, '2023-05-08 15:00:57'),
(57, 1310, NULL, 'Cuentas corrientes comerciales', 1, 1, 0, 0, 0, 43, '2023-05-08 15:00:58'),
(58, 131015, NULL, 'Accionistas o Socios', 1, 1, 1, 0, 0, 43, '2023-05-08 15:00:59'),
(59, 1325, NULL, 'Cuentas por cobrar a socios y accionistas', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(60, 132510, NULL, 'A accionistas', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(61, 13251001, 1, 'Monica Sanchez', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(62, 13251003, 3, 'Gastos Mec', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(63, 13251004, 4, 'Gastos don Oscar', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(64, 13251090, 90, 'Participes del  Consorcio R&S', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(65, 1330, NULL, 'Anticipos y avances', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(66, 133005, NULL, 'A proveedores', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(67, 13300501, 1, 'A proveedores', 1, 1, 0, 1, 1, 43, '0000-00-00 00:00:00'),
(68, 13300597, 97, 'D. fiscal a proveedores', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(69, 133010, NULL, 'A contratistas', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(70, 13301001, 1, 'A contratistas', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(71, 13301097, 97, 'D. fiscal a contratistas', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(72, 133015, NULL, 'A trabajadores', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(73, 13301501, 1, 'Cajas Menores', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(74, 13301502, 2, 'Otros', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(75, 13301503, 3, 'A TRABAJADORES', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(76, 13301597, 97, 'D. fiscal anticipos a trabajadores', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(77, 133090, NULL, 'Anticipos y avances Consorcios y UT', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(78, 13309001, 1, 'Consorcio R&S ', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(79, 133095, NULL, 'Otros', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(80, 13309501, 1, 'Otros', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(81, 1350, NULL, 'Retención sobre contratos', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(82, 135090, NULL, 'Retención sobre contratos consorcios y UT', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(83, 13509090, 90, 'Rentencion sobre Consorcio R&S', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(84, 1355, NULL, 'Anticipo de impuestos y contribuciones o', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(85, 135510, NULL, 'Anticipo de impuestos de industria y com.', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(86, 13551001, 1, 'Anticipo de impuestos de industria y com.', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(87, 135515, NULL, 'Anticipo Retención en la fuente', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(88, 13551501, 1, 'Anticipo Retención en la fuente 2,5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(89, 13551502, 2, 'Devolución Retención en la fuente 2,5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(90, 13551503, 3, 'Anticipo Retención en la fuente 4% Alquiler', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(91, 13551504, 4, 'Devolución Retención en la fuente 4%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(92, 13551505, 5, 'Anticipo Retención en la fuente 6%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(93, 13551506, 6, 'Devolución retención en la fuente 6%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(94, 13551507, 7, 'Anticipo Retención en la fuente 10%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(95, 13551508, 8, 'Devolución Retención en la fuente 10%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(96, 13551509, 9, 'Anticipo Retención en la fuente 11%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(97, 13551510, 10, 'Devolución en ventas Retefuente 11%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(98, 13551511, 11, 'Anticipo Retención en la fuente 7%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(99, 13551512, 12, 'Devolución Retención en la fuente 7%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(100, 13551513, 13, 'Anticipo Retención en la fuente 3,5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(101, 13551514, 14, 'Devolución Retención en la fuente 3,5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(102, 13551515, 15, 'Anticipo Retención en la fuente 2%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(103, 13551516, 16, 'Devolución Retención en la fuente 2%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(104, 13551517, 17, 'Anticipo Retención en la fuente 1%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(105, 13551518, 18, 'Devolución Retención en la fuente 1%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(106, 13551519, 19, 'Anticipo Retencion en la fuente 0.1%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(107, 13551520, 20, 'Otras retenciones ', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(108, 13551521, 21, 'Anticipo Retención Servicios 4%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(109, 13551522, 22, 'Anticipo de Retencion en la fuente del 5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(110, 13551523, 23, 'Devolución Retención en la fuente 5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(111, 135517, NULL, 'Impuesto a las ventas retenido', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(112, 13551701, 1, 'Impuesto a las ventas retenido 15%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(113, 13551702, 2, 'Devolución impuesto a las ventas retenido 15%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(114, 135518, NULL, 'Impuesto de industria y comercio retenido', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(115, 13551801, 1, 'Rete Ica 11,04', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(116, 13551802, 2, 'Devolución Rete Ica 11,04', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(117, 13551803, 3, 'Rete Ica 13,08', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(118, 13551804, 4, 'Devolución Rete Ica 13,08', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(119, 13551805, 5, 'Rete Ica 9,66', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(120, 13551806, 6, 'Devolución Rete Ica 9,66', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(121, 13551807, 7, 'Rete Ica 8', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(122, 13551808, 8, 'Devolución Rete Ica 8', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(123, 13551809, 9, 'Rete Ica 7', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(124, 13551810, 10, 'Devolución Rete Ica 7', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(125, 13551811, 11, 'Rete Ica 6.9', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(126, 13551812, 12, 'Devolución Rete Ica 6.9', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(127, 13551813, 13, 'Rete Ica ', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(128, 13551814, 14, 'Devolución Rete Ica 4', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(129, 13551815, 15, 'Impuesto de industria y comercio retenido', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(130, 13551816, 16, 'Autorretencion impuesto de industria y comercio', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(131, 13551817, 17, 'Autorretencion avisos y tableros', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(132, 13551818, 18, 'Anticipo de impuesto de industria y comercio', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(133, 135519, NULL, 'Autorrenta ', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(134, 13551901, 1, 'Autorrenta .80', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(135, 13551902, 2, 'Autorenta 0.4%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(136, 13551903, 3, 'Devolucion Autorenta 0.4%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(137, 13551905, 5, 'Autorrenta 0,40%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(138, 135520, NULL, 'Sobrantes en liquidación privada de impuestos', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(139, 13552001, 1, 'Saldo a favor Renta', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(140, 135590, NULL, 'Anticipo de impuestos y contribuciones Consorcios ', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(141, 13559001, 1, 'Anticipos de impuestos Consorcio R&S', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(142, 1365, NULL, 'Cuentas por cobrar a trabajadores', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(143, 136515, NULL, 'Educación', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(144, 13651501, 1, 'Educación', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(145, 136525, NULL, 'Calamidad domestica', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(146, 13652501, 1, 'Calamidad domestica', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(147, 136595, NULL, 'otros Prestamos a empleados', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(148, 13659501, 1, 'Prestamo libre inversion', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(149, 1380, NULL, 'Deudores varios', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(150, 138095, NULL, 'Otros', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(151, 13809501, 1, 'Incapacidades', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(152, 13809502, 2, 'Otros deudores', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(153, 13809597, 97, 'D. fiscal otros deudores', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(154, 1399, NULL, 'Provisiones', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(155, 139905, NULL, 'Clientes', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(156, 13990501, 1, 'Clientes', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(157, 13990597, 97, 'D. fiscal clientes', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(158, 14, NULL, 'Inventarios', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(159, 1435, NULL, 'Mercancías no fabricadas por la empresa', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(160, 143501, NULL, 'Mercancías no fabricadas', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(161, 14350101, 1, 'Mercancías no fabricadas', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(162, 1455, NULL, 'Materiales respuestos y accesorios', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(163, 145501, NULL, 'Inventarios ', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(164, 145505, NULL, 'Materiales, repuestos y accesorios', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(165, 14550501, 1, 'Materiales, repuestos y accesorios', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(166, 1498, NULL, 'Otros', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(167, 149801, NULL, 'Otros', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(168, 14980101, 1, 'Otros', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(169, 14980102, 2, 'Otros', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(170, 149802, NULL, 'Ajustes de cartera', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(171, 15, NULL, 'Propiedad planta y equipo', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(172, 1504, NULL, 'Terrenos', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(173, 150405, NULL, 'Urbanos', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(174, 15040505, 5, 'Urbanos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(175, 15040597, 97, 'D. fiscal revaluación urbanos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(176, 1516, NULL, 'Construcciones y edificaciones', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(177, 151605, NULL, 'Edificios', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(178, 15160501, 1, 'Edificios', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(179, 15160597, 97, 'D. fiscal edificios', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(180, 151610, NULL, 'Edificios', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(181, 15161001, 1, 'Oficinas', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(182, 15161097, 97, 'D. fiscal revaluación construcciones', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(183, 1524, NULL, 'Equipo de oficina', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(184, 152405, NULL, 'Muebles y enseres', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(185, 15240501, 1, 'Muebles y enseres', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(186, 15240502, 2, 'Silla Giratoria ', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(187, 15240503, 3, 'Calentadores gas', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(188, 15240597, 97, 'D. fiscal muebles y enseres', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(189, 152410, NULL, 'Equipos', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(190, 15241002, 2, 'Televisor', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(191, 15241003, 3, 'Ponchadora ', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(192, 15241097, 97, 'D. fiscal equipos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(193, 1528, NULL, 'Equipo de computación y comunicación', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(194, 152805, NULL, 'Equipos de procesamiento de datos', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(195, 15280501, 1, 'Equipos de procesamiento de datos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(196, 15280590, 90, 'Eq. de Computo y Comun Consorcio R&S', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(197, 15280597, 97, 'D. fiscal equipos de procesamiento de datos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(198, 152810, NULL, 'Equipos de Telecomunicaciones', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(199, 15281001, 1, 'Telefono Satelital Inmarsat isatphone II', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(200, 152890, NULL, 'Equipo de computacion y comunicacion consorcios y ', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(201, 15289001, 1, 'Consorcio R&S', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(202, 1540, NULL, 'Flota y equipo de transporte', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(203, 154001, NULL, 'Vehículos  ', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(204, 154005, NULL, 'Vehículos en leasing', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(205, 15400501, 1, 'Vehículos en leasing', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(206, 15400597, 97, 'D. fiscal vehículos leasing', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(207, 1592, NULL, 'Depreciación acumulada', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(208, 159205, NULL, 'Construcciones y edificaciones', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(209, 15920501, 1, 'Construcciones y edificaciones', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(210, 15920597, 97, 'D. fiscal valor de salvamento construcciones', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(211, 159215, NULL, 'Equipo de oficina', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(212, 15921501, 1, 'Equipo de oficina', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(213, 15921597, 97, 'D. fiscal equipo de oficina', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(214, 159220, NULL, 'Equipo de computación y comunicación', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(215, 15922001, 1, 'Equipo de computación y comunicación', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(216, 15922097, 97, 'D. fiscal equipo de computación y comunicación', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(217, 159235, NULL, 'Flota y equipo de transporte', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(218, 15923501, 1, 'Flota y equipo de transporte', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(219, 15923597, 97, 'D. fiscal depreciación flota', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(220, 16, NULL, 'Intangibles', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(221, 1625, NULL, 'Derechos', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(222, 162535, NULL, 'En bienes recibidos en arrendamiento financiero ', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(223, 1635, NULL, 'Licencias', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(224, 163501, NULL, 'Derecho de uso', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(225, 16350101, 1, 'Derecho de uso', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(226, 16350190, 90, 'Derecho de Uso Consorcio R&S', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(227, 16350197, 97, 'D. fiscal derecho de uso', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(228, 163515, NULL, 'Marca adquirida', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(229, 16351501, 1, 'Marca adquirida', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(230, 16351597, 97, 'D. fiscal marca adquirida', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(231, 17, NULL, 'Otros activos no financieros', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(232, 1720, NULL, 'Entidades controladas en forma conjunta', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(233, 172020, NULL, 'Negocios conjuntos', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(234, 17202001, 1, 'Negocios conjuntos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(235, 18, NULL, 'Impuesto a las ganancias', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(236, 1805, NULL, 'Impuesto corriente', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(237, 180505, NULL, 'Renta y complementarios', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(238, 18050501, 1, 'Autorretencion servicios', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(239, 18050502, 2, 'Retención en la fuente compras 1.5%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(240, 18050503, 3, 'Tarjetas de crédito', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(241, 18050504, 4, 'Servicios 6%', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(242, 18050505, 5, 'Autorretencion', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(243, 18050506, 6, 'Anticipo sobretasa cree', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(244, 18050507, 7, 'Sobrantes en liquidación privada de impuestos', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(245, 19, NULL, 'Otros activos financieros', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(246, 1945, NULL, 'De inversiones', 1, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(247, 194510, NULL, 'De inversiones', 1, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(248, 19451001, 1, 'De inversiones', 1, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(249, 21, NULL, 'Pasivos financieros', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(250, 2105, NULL, 'Bancos nacionales', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(251, 210510, NULL, 'Pagares', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(252, 21051001, 1, 'Colpatria costo amortizado', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(253, 21051002, 2, 'BBVA diferencia certificado', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(254, 21051003, 3, 'Bancolombia ', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(255, 21051004, 4, 'COOPERATIVA FINANCIERA', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(256, 21051005, 5, 'CONSORCIO RYS', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(257, 210595, NULL, 'TARJETA CREDITO BBIA', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(258, 21059501, 1, 'TC VISA PESOS', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(259, 210596, NULL, 'TC FALABELLA', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(260, 2110, NULL, 'Depósitos recibidos', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(261, 211095, NULL, 'Otros', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(262, 21109501, 1, 'Otros', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(263, 22, NULL, 'Proveedores', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(264, 2205, NULL, 'Proveedores nacionales', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(265, 220505, NULL, 'Proveedores nacionales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(266, 22050501, 1, 'Proveedores nacionales', 2, 1, 0, 1, 1, 43, '0000-00-00 00:00:00'),
(267, 22050590, 90, 'Porveedores Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(268, 2210, NULL, 'Proveedores del exterior', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(269, 221005, NULL, 'Proveedores del exterior', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(270, 22100501, 1, 'Proveedores del exterior', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(271, 23, NULL, 'Acreedores comerciales y otras cuentas por pagar', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(272, 2305, NULL, 'Cuentas corrientes comerciales', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(273, 230505, NULL, 'Cuentas corrientes comerciales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(274, 23050501, 1, 'Cuentas corrientes comerciales', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(275, 2335, NULL, 'Costos y gastos por pagar', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(276, 233525, NULL, 'Honorarios', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(277, 23352501, 1, 'Honorarios', 2, 1, 0, 1, 1, 43, '0000-00-00 00:00:00'),
(278, 233595, NULL, 'Otros', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(279, 23359501, 1, 'Otros', 2, 1, 0, 1, 1, 43, '0000-00-00 00:00:00'),
(280, 23359590, 90, 'Costos y Gastos x Pagar Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(281, 2345, NULL, 'Acreedores oficiales', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(282, 234501, NULL, 'Anticipo Ica BImestral', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(283, 234505, NULL, 'Acuerdos de Pago', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(284, 23450502, 2, 'Iva Acuerdo de Pago', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(285, 2365, NULL, 'Retenciones en la fuente', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(286, 236505, NULL, 'Salarios y pagos laborales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(287, 23650501, 1, 'Salarios y pagos laborales', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(288, 236510, NULL, 'Dividendos y/o participaciones', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(289, 236515, NULL, 'Honorarios', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(290, 23651501, 1, 'Honorarios', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(291, 23651502, 2, 'Devolución Honorarios', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(292, 23651503, 3, 'Retención 7%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(293, 23651504, 4, 'Devolución retención 7%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(294, 23651505, 5, 'Retención 3,5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(295, 23651506, 6, 'Devolución retención 3,5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(296, 23651507, 7, 'Retención 2%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(297, 23651508, 8, 'Devolución retención 2%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(298, 23651509, 9, 'Retención 1%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(299, 23651510, 10, 'Devolución retención 1%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(300, 236520, NULL, 'Honorarios 10%', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(301, 23652001, 1, 'Honorarios Personas Naturales', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(302, 23652002, 2, 'Devolución Comisiones', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(303, 236525, NULL, 'Servicios', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(304, 23652501, 1, 'Servicios 6%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(305, 23652502, 2, 'Devolución Servicios 6%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(306, 23652503, 3, 'Servicios 4%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(307, 23652504, 4, 'Devolución Servicios 4%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(308, 23652505, 5, 'Servicios  1 %', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(309, 23652506, 6, 'Devolución servicios  1 %', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(310, 236530, NULL, 'Arrendamientos', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(311, 23653001, 1, 'Arrendamientos 3.5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(312, 23653002, 2, 'Arrendamientos del 4%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(313, 236535, NULL, 'Rendimientos financieros', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(314, 23653501, 1, 'Rendimientos financieros', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(315, 23653502, 2, 'Rendimientos financieros 7 %', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(316, 23653503, 3, 'Devolución rendimientos financieros 7 %', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(317, 236540, NULL, 'Retención por compras', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(318, 23654001, 1, 'Retención por compras 2,5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(319, 23654002, 2, 'Devolución Retención por compras 2,5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(320, 23654004, 4, 'Retención por compras 3,5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(321, 23654005, 5, 'Devolución Retención por compras 3,5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(322, 23654006, 6, 'Retencion por compras del 0.1%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(323, 236545, NULL, 'Retencion en la fuente 5%', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(324, 23654505, 5, 'Devolución Retención 5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(325, 236570, NULL, 'Otras retenciones', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(326, 23657001, 1, 'Otras retenciones  2 %', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(327, 23657002, 2, 'Devolución otras retenciones  2 %', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(328, 236575, NULL, 'Autorretenciones', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(329, 23657501, 1, 'Autorretenciones', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(330, 23657502, 2, 'Autorenta 0.4%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(331, 23657503, 3, 'Devolucion Autorenta 0.4%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(332, 23657504, 4, 'Autorrenta 0.40%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(333, 236590, NULL, 'Retencion en la Fuente ', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(334, 23659090, 90, 'Retencion en la Fuente Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(335, 236599, NULL, 'PAGO RETEFUENTE', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(336, 2367, NULL, 'Impuesto a las ventas retenido', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(337, 236701, NULL, 'Impuesto a las ventas retenido', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(338, 23670101, 1, 'Impuesto a las ventas retenido 15%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(339, 23670102, 2, 'Devolución Impuesto a las ventas retenido 15%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(340, 236705, NULL, 'Retención de impuesto a las ventas Iva', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(341, 236768, NULL, 'Impuesto a las ventas retenido', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(342, 23676801, 1, 'Impuesto a las ventas retenido', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(343, 2368, NULL, 'Impuesto de industria y comercio retenido', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(344, 236805, NULL, 'Retención industria y comercio Ica', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(345, 23680501, 1, 'Reteica 11,04', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(346, 23680502, 2, 'Devolución Reteica 11,04', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(347, 23680503, 3, 'Reteica 13,8', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(348, 23680504, 4, 'Devolución Reteica 13,8', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(349, 23680505, 5, 'Reteica 9,66', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(350, 23680506, 6, 'Devolución Reteica 9,66', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(351, 23680507, 7, 'Reteica 8', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(352, 23680508, 8, 'Devolución Reteica 8', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(353, 23680509, 9, 'Reteica 7', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(354, 23680510, 10, 'Devolución Reteica 7', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(355, 23680511, 11, 'Reteica 6,9', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(356, 23680512, 12, 'Devolución Reteica 6,9', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(357, 23680513, 13, 'Reteica 4,14', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(358, 23680514, 14, 'Devolución Reteica 4,14', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(359, 23680590, 90, 'Retencion ICA Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(360, 2370, NULL, 'Aportes a empresas promotoras de salud eps', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(361, 237005, NULL, 'Aportes a entidades promotoras de salud eps', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(362, 23700501, 1, 'Aportes a entidades promotoras de salud eps', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(363, 237006, NULL, 'Aporte a administradoras de riesgos profesionales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(364, 23700601, 1, 'Aporte a administradoras de riesgos profesionales, ARL', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(365, 237010, NULL, 'Aportes al icbf Sena y cajas de compensación', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(366, 23701001, 1, 'Aportes al icbf Sena y cajas de compensación', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(367, 23701002, 2, 'Sena', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(368, 23701003, 3, 'Icbf', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(369, 237015, NULL, 'Aportes arl', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(370, 23701501, 1, 'Aportes arl', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(371, 237025, NULL, 'Embargos judiciales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(372, 23702501, 1, 'Embargos judiciales', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(373, 237030, NULL, 'Libranzas', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(374, 23703001, 1, 'Libranzas', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(375, 237045, NULL, 'Fondos', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(376, 23704501, 1, 'Fondos', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(377, 237050, NULL, 'Ahorro afc', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(378, 23705001, 1, 'Ahorro afc', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(379, 237090, NULL, 'Aport y Retenciones Nomina', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(380, 23709090, 90, 'Aport y Rtecione Nomina Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(381, 237095, NULL, 'PAGO SEGURO EMPLEADOS', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(382, 237099, NULL, 'PAGO SEGURIDAD SOCIAL', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(383, 2380, NULL, 'Acreedores varios', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(384, 238030, NULL, 'Fondos de cesantías y/o pensiones', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(385, 23803001, 1, 'Fondos de cesantías y/o pensiones', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(386, 238095, NULL, 'Otros', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(387, 23809501, 1, 'Otros', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(388, 24, NULL, 'Pasivos por impuestos', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(389, 2404, NULL, 'De renta y complementarios corriente', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(390, 240405, NULL, 'Vigencia fiscal corriente', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(391, 24040501, 1, 'Vigencia fiscal corriente', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(392, 2408, NULL, 'Impuesto sobre las ventas por pagar', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(393, 240805, NULL, 'Iva generado en ventas', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(394, 24080501, 1, 'Iva generado en ventas', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(395, 240806, NULL, 'Iva generado', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(396, 24080601, 1, 'Iva generado en ventas 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(397, 24080602, 2, 'Iva generado 5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(398, 24080603, 3, 'Iva Generado Servicios 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(399, 24080604, 4, 'Iva Generado  16%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(400, 240810, NULL, 'Iva descontable por compras', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(401, 24081001, 1, 'Iva descontable por compras 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(402, 24081002, 2, 'Iva Devolución en compras 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(403, 24081003, 3, 'Iva descontable por compras 5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(404, 24081004, 4, 'Iva Devolución en compras 5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(405, 240811, NULL, 'Iva descontable por Servicio', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(406, 24081101, 1, 'Iva Descontable por servicios 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(407, 24081102, 2, 'Iva devolucion en compra 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(408, 24081103, 3, 'Iva descontable en  Servicios.19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(409, 24081130, 30, 'Iva Devolucion Servicios 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(410, 240815, NULL, 'Descontable por servicios', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(411, 24081501, 1, 'Descontable por servicios', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(412, 240820, NULL, 'Descontable por devoluciones', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(413, 24082001, 1, 'Descontable por devoluciones 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(414, 24082002, 2, 'Descontable por devoluciones 5%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(415, 24082003, 3, 'Descontable Dev. Servicio 19%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(416, 24082004, 4, 'Descontable por Dev 16%', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(417, 240830, NULL, 'Descontable régimen simplificado', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(418, 24083001, 1, 'Descontable régimen simplificado', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(419, 240890, NULL, 'Imp Sobre Las Venta x Pagar Consorciales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(420, 24089090, 90, 'Imp a la Venta x Pagar Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(421, 240899, NULL, 'Impuestos por pagar ', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(422, 2412, NULL, 'Industria y Comercio', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(423, 241205, NULL, 'ICA', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(424, 24120590, 90, 'ICA R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(425, 2464, NULL, 'De licores, cervezas y cigarrillos', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(426, 246401, NULL, 'Impuesto por valor en ventas', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(427, 246402, NULL, 'Impuesto por valor en devolucion en ventas', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(428, 246403, NULL, 'Impuesto por valor en compras', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(429, 246404, NULL, 'Impuesto por valor en devolucion en compras', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(430, 2495, NULL, 'Otros', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(431, 249501, NULL, 'Impuesto al consumo nacional', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(432, 24950101, 1, 'Impuesto al consumo en ventas', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(433, 24950102, 2, 'Impuesto al consumo en devolucion en ventas', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(434, 24950103, 3, 'Impuesto al consumo en compras', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(435, 24950104, 4, 'Impuesto al consumo en devolucion en compras', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(436, 25, NULL, 'Beneficios a empleados', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(437, 2505, NULL, 'Salarios por pagar', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(438, 250505, NULL, 'Salarios por pagar', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(439, 25050501, 1, 'Salarios por pagar', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(440, 25050590, 90, 'Salarios Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(441, 2510, NULL, 'Pasivo estimado para obligaciones laborales', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(442, 251010, NULL, 'Pasivo estimado para obligaciones laborales', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(443, 25101001, 1, 'Cesantías', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(444, 25101002, 2, 'Intereses sobre cesantías', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(445, 25101003, 3, 'Vacaciones', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(446, 25101004, 4, 'Prima de servicios', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(447, 251090, NULL, 'Pasivos en beneficios empleados conosrcios', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(448, 25109001, 1, 'Beneficios Empl Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(449, 28, NULL, 'Pasivos no financieros', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(450, 2805, NULL, 'Anticipos y avances recibidos', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(451, 280505, NULL, 'De clientes', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(452, 28050501, 1, 'De clientes', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(453, 28050502, 2, 'Por Legalizar', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(454, 28050590, 90, 'Anticipos y Avances Consorcio R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(455, 2815, NULL, 'Ingresos recibidos para terceros', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(456, 281505, NULL, 'Valores recibidos para terceros', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(457, 28150501, 1, 'Valores recibidos para terceros', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(458, 28150502, 2, 'Seguros de vida empleados', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(459, 28150503, 3, 'Prestamos comfama', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(460, 28150504, 4, 'Ahorros empleados', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(461, 2895, NULL, 'Diversos', 2, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(462, 289595, NULL, 'Recaudos consorcio', 2, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(463, 28959501, 1, 'CONSORCIO R&S', 2, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(464, 31, NULL, 'Capital social', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(465, 3105, NULL, 'Capital suscrito y pagado', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(466, 310505, NULL, 'Capital suscrito y pagado', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(467, 31050501, 1, 'Capital autorizado', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(468, 310510, NULL, 'Capital por suscribir (db)', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(469, 31051001, 1, 'Capital por suscribir (db)', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(470, 32, NULL, 'Superávit de capital', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(471, 3205, NULL, 'Prima en colocación de acciones cuotas o partes d', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(472, 320505, NULL, 'Prima en colocación de acciones', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(473, 32050501, 1, 'Prima en colocación de acciones', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(474, 320520, NULL, 'Superávit por el método de participación', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(475, 32052001, 1, 'Superávit por el método de participación', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(476, 33, NULL, 'Reservas', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(477, 3305, NULL, 'Reservas obligatorias', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(478, 330505, NULL, 'Reservas obligatorias', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(479, 33050501, 1, 'Reserva legal', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(480, 36, NULL, 'Resultado del Ejercicio ', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(481, 3605, NULL, 'Resultado del Ejercicio ', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(482, 360501, NULL, 'Resultado del Ejercicio ', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(483, 360502, NULL, 'Utilidad Fiscal', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(484, 360590, NULL, 'Resultados de Ejercicios Consorcio R&S', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(485, 37, NULL, 'Resultados de ejercicios anteriores', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(486, 3705, NULL, 'Resultados de ejercicios anteriores', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(487, 370505, NULL, 'Resultados de ejercicios anteriores', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(488, 37050501, 1, 'Utilidades o excedentes acumulados', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(489, 3710, NULL, 'Convergencia', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(490, 371005, NULL, 'Convergencia', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(491, 37100501, 1, 'Otros aportes de capital', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(492, 39, NULL, 'Afectaciones fiscales de ingresos y gastos', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(493, 3905, NULL, 'Resultados fiscales de ventas en ganancia ocasional', 3, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(494, 390505, NULL, 'Resultados fiscales de ventas en ganancia ocasional', 3, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(495, 39050501, 1, 'Resultados fiscales de ventas en ganancia ocasional', 3, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(496, 41, NULL, 'Ingresos de actividades ordinarias', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(497, 4120, NULL, 'Alquiler', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(498, 412001, NULL, 'Alquiler de Frecuencias y Repetidoras', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(499, 4135, NULL, 'Comercio al por mayor y al detal', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(500, 413501, NULL, 'Servicios ', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(501, 41350101, 1, 'Comercio al por mayor y al detal', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(502, 41350102, 2, 'Descuentos', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(503, 41350103, 3, 'Servicios', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(504, 41350190, 90, 'Comercio Consorcio R&S', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(505, 41350197, 97, 'D. fiscal Comercio al por mayor y al detal', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(506, 4150, NULL, 'Actividad Financiera', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(507, 415045, NULL, 'Cuotas de administracion - corsorcios', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(508, 4175, NULL, 'Devolución en ventas', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(509, 417505, NULL, 'Devolución', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(510, 41750501, 1, 'Devolución en ventas', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(511, 41750502, 2, 'Devolución en servicios', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(512, 41750503, 3, 'Devolución en descuentos', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(513, 41750504, 4, 'Devolucioin de Alquiler', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(514, 41750590, 90, 'Devolucion en Venta  Consorcio R&S', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(515, 41750597, 97, 'D. fiscal devolución en ventas', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(516, 4180, NULL, 'Servicios', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(517, 418001, NULL, 'Servicios', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(518, 41800101, 1, 'Servicios de radio y repetidoras', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(519, 41800102, 2, 'Descuentos en servicios', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(520, 41800103, 3, 'Servicios de gruas ', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(521, 41800190, 90, 'Servicios Consorcio R&S', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(522, 41800197, 97, 'D. fiscal servicios', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(523, 42, NULL, 'Otros ingresos de actividades ordinarias', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(524, 4210, NULL, 'Financieros', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(525, 421005, NULL, 'Intereses Financieros', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(526, 421020, NULL, 'Diferencia en cambio', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(527, 42102001, 1, 'Diferencia en cambio', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(528, 42102097, 97, 'D. fiscal diferencia en cambio', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(529, 421040, NULL, 'Descuentos comerciales condicionados', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(530, 42104001, 1, 'Descuentos comerciales condicionados', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(531, 42104097, 97, 'D. fiscal descuentos comerciales condicionados', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(532, 421090, NULL, 'Financieros Consorciales', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(533, 42109090, 90, 'Financiero Consorcial R&S', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(534, 4218, NULL, 'Ingresos método de participación', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(535, 421805, NULL, 'De sociedades anónimas y/o asimiladas', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(536, 42180501, 1, 'De sociedades anónimas y/o asimiladas', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(537, 42180597, 97, 'D. fiscal de sociedades anónimas y/o asimiladas', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(538, 4250, NULL, 'Recuperaciones', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(539, 425005, NULL, 'Cuentas Malas', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(540, 4255, NULL, 'Indemnizaciones', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(541, 425540, NULL, 'Por incapacidades', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(542, 42554001, 1, 'Eps', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(543, 42554005, 5, 'EPS', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(544, 4295, NULL, 'Diversos', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(545, 429505, NULL, 'Aprovechamientos', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(546, 42950501, 1, 'Aprovechamientos', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(547, 42950597, 97, 'D. fiscal aprovechamientos', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(548, 429581, NULL, 'Ajuste al peso', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(549, 42958101, 1, 'Ajuste al peso', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(550, 42958190, 90, 'Ajuste al Peso Consorcio R&S', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(551, 42958197, 97, 'D. fiscal ajuste al peso', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(552, 43, NULL, 'Ganancias', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(553, 4305, NULL, 'Propiedad planta y equipo', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(554, 430505, NULL, 'Revaluación', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(555, 43050501, 1, 'Revaluación de terrenos y edificaciones', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(556, 43050597, 97, 'D. fiscal revaluación de terrenos y edificaciones', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(557, 430510, NULL, 'Salvamento', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(558, 43051001, 1, 'Salvamento', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(559, 43051097, 97, 'D. fiscal salvamento', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(560, 44, NULL, 'Ingresos fiscales', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(561, 4405, NULL, 'Ingresos por ganancia ocasional', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(562, 440505, NULL, 'Ingresos por ganancia ocasional', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(563, 44050501, 1, 'Ingresos por ganancia ocasional', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(564, 44050597, 97, 'D. fiscal Ingresos por ganancia ocasional', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(565, 4410, NULL, 'Ingresos renta ordinaria', 4, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(566, 441005, NULL, 'Recuperación de deducciones fiscales', 4, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(567, 44100501, 1, 'Recuperación de depreciación', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(568, 44100597, 97, 'D. fiscal recuperación de depreciación', 4, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(569, 51, NULL, 'Administrativos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(570, 5105, NULL, 'Gastos de personal', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00');
INSERT INTO `configuracion_puc` (`id`, `code`, `code_child`, `nombre`, `parent_id`, `status`, `acciones`, `auxiliar`, `forma_pago`, `created_by`, `created_at`) VALUES
(571, 510503, NULL, 'Salario integral', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(572, 51050301, 1, 'Salario integral', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(573, 51050397, 97, 'D. fiscal salario integral', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(574, 510506, NULL, 'Sueldos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(575, 51050601, 1, 'Sueldos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(576, 51050697, 97, 'D. fiscal sueldos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(577, 510512, NULL, 'Apoyo sostenimiento aprendices', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(578, 51051201, 1, 'Apoyo sostenimiento aprendices', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(579, 51051297, 97, 'D. fiscal apoyo sostenimiento aprendices', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(580, 510515, NULL, 'Horas extras y recargos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(581, 51051501, 1, 'Horas extras y recargos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(582, 51051597, 97, 'D. fiscal horas extras y recargos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(583, 510521, NULL, 'Viaticos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(584, 510524, NULL, 'Incapacidades', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(585, 51052401, 1, 'Incapacidades', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(586, 51052497, 97, 'D. fiscal incapacidades', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(587, 510527, NULL, 'Auxilio de transporte', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(588, 51052701, 1, 'Auxilio de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(589, 51052797, 97, 'D. fiscal auxilio de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(590, 510530, NULL, 'Cesantías', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(591, 51053001, 1, 'Cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(592, 51053097, 97, 'D. fiscal cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(593, 510533, NULL, 'Intereses sobre cesantías', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(594, 51053301, 1, 'Intereses sobre cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(595, 51053397, 97, 'D. fiscal intereses sobre cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(596, 510536, NULL, 'Prima de servicios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(597, 51053601, 1, 'Prima de servicios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(598, 51053697, 97, 'D. fiscal prima de servicios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(599, 510539, NULL, 'Vacaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(600, 51053901, 1, 'Vacaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(601, 51053997, 97, 'D. fiscal vacaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(602, 510545, NULL, 'Auxilios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(603, 51054501, 1, 'Educativo', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(604, 51054502, 2, 'Auxilio transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(605, 51054597, 97, 'D. fiscal auxilio transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(606, 510548, NULL, 'Bonificaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(607, 51054801, 1, 'Bonificaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(608, 51054897, 97, 'D. fiscal bonificaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(609, 510551, NULL, 'Dotación y suministro a trabajadores', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(610, 51055101, 1, 'Dotación y suministro a trabajadores', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(611, 51055197, 97, 'D. fiscal dotación y suministro a trabajadores', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(612, 510560, NULL, 'Indemnizaciones laborales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(613, 51056001, 1, 'Indemnizaciones laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(614, 51056097, 97, 'D. fiscal indemnizaciones laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(615, 510563, NULL, 'Capacitación al personal', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(616, 51056301, 1, 'Capacitación al personal', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(617, 51056397, 97, 'D. fiscal capacitación al personal', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(618, 510566, NULL, 'Gastos deportivos y de recreación', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(619, 51056601, 1, 'Gastos deportivos y de recreación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(620, 51056697, 97, 'D. fiscal gastos deportivos y de recreación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(621, 510568, NULL, 'Aportes a administradora de riesgos laborales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(622, 51056801, 1, 'Aportes a administradora de riesgos laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(623, 51056897, 97, 'D. fiscal aportes a administradora de riesgos laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(624, 510569, NULL, 'Aportes a entidades promotoras de salud eps', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(625, 51056901, 1, 'Aportes a entidades promotoras de salud eps', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(626, 51056997, 97, 'D. fiscal aportes a entidades promotoras de salud eps', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(627, 510570, NULL, 'Aporte a fondos de pensión y/o cesantías', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(628, 51057001, 1, 'Aporte a fondos de pensión y/o cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(629, 51057097, 97, 'D. fiscal aporte a fondos de pensión y/o cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(630, 510572, NULL, 'Aportes cajas de compensación familiar', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(631, 51057201, 1, 'Aportes cajas de compensación familiar', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(632, 51057297, 97, 'D. fiscal aportes cajas de compensación familiar', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(633, 510575, NULL, 'Aportes icbf', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(634, 51057501, 1, 'Aportes icbf', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(635, 51057597, 97, 'D. fiscal aportes icbf', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(636, 510578, NULL, 'Aportes Sena', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(637, 51057801, 1, 'Aportes Sena', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(638, 51057897, 97, 'D. fiscal aportes Sena', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(639, 510584, NULL, 'Gastos médicos y drogas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(640, 51058401, 1, 'Gastos médicos y drogas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(641, 51058402, 2, 'EXAMENES OCUPACIONALES', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(642, 51058497, 97, 'D. fiscal gastos médicos y drogas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(643, 510590, NULL, 'Gastos de Personal Consorcial', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(644, 51059090, 90, 'G. Personal Consocio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(645, 510595, NULL, 'Otros', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(646, 51059501, 1, 'Bienestar y atención a empleados', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(647, 51059597, 97, 'D. fiscal bienestar y atención a empleados', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(648, 5110, NULL, 'Honorarios', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(649, 511010, NULL, 'Revisoría fiscal', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(650, 51101001, 1, 'Honorarios - Revisoría fiscal', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(651, 511015, NULL, 'Auditoria externa', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(652, 511020, NULL, 'Avalúos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(653, 511025, NULL, 'Asesoría jurídica', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(654, 51102501, 1, 'Honorarios - Asesoría jurídica', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(655, 511030, NULL, 'ASESORIA CONTABLE Y F', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(656, 51103001, 1, 'HONORARIOS CONTABLES', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(657, 511035, NULL, 'Asesoría técnica', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(658, 51103501, 1, 'Asesoría técnica', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(659, 511090, NULL, 'Honorarios Consorcial', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(660, 51109090, 90, 'Honorarios Consocio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(661, 5115, NULL, 'Impuestos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(662, 511505, NULL, 'Industria y comercio', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(663, 51150501, 1, 'Industria y comercio', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(664, 511515, NULL, 'A la propiedad raíz', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(665, 51151501, 1, 'A la propiedad raíz', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(666, 511540, NULL, 'De vehículos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(667, 51154001, 1, 'De vehículos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(668, 511570, NULL, 'IVA descontable', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(669, 51157001, 1, 'IVA DESCONTABLE', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(670, 511595, NULL, 'Otros impuestos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(671, 51159501, 1, 'Otros impuestos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(672, 51159502, 2, 'F. U. de Tecnologia de la Inf y las Comunicaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(673, 51159503, 3, 'GMF 4X100', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(674, 51159504, 4, 'Impuesto al consumo ', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(675, 5120, NULL, 'Arrendamientos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(676, 512010, NULL, 'Construcciones y edificaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(677, 51201001, 1, 'Arrendamientos - Construcciones y edificaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(678, 51201002, 2, 'Arrend/espacios/cerros', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(679, 512020, NULL, 'Equipo de oficina', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(680, 51202001, 1, 'Arrendamientos - Equipo de oficina', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(681, 51202002, 2, 'Equipos de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(682, 512025, NULL, 'Equipo de computación', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(683, 51202501, 1, 'Arrendamiento - Equipo de computación y comunicación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(684, 51202502, 2, 'Equipos oficina', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(685, 512095, NULL, 'Bodegaje', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(686, 51209501, 1, 'Arrendamiento uso de software', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(687, 5125, NULL, 'Contribuciones y afiliaciones', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(688, 512505, NULL, 'Contribuciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(689, 51250501, 1, 'Fondo unico de Tecnologias de la Iformacion y las Comunicaciones Tic', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(690, 512510, NULL, 'Afiliaciones y sostenimiento', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(691, 51251001, 1, 'Afiliaciones y sostenimiento', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(692, 5130, NULL, 'Seguros', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(693, 513010, NULL, 'Cumplimiento', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(694, 51301001, 1, 'Cumplimiento', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(695, 513015, NULL, 'Corriente débil', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(696, 513020, NULL, 'Vida colectiva', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(697, 51302001, 1, 'Vida colectiva', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(698, 513030, NULL, 'Terremoto', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(699, 51303001, 1, 'Seguros - Terremoto', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(700, 513035, NULL, 'Sustracción y hurto', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(701, 513040, NULL, 'Flota y equipo de transporte', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(702, 513060, NULL, 'responsabilidad civil Y Extracontractual', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(703, 51306001, 1, 'responsabilidad civil ', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(704, 513070, NULL, 'Rotura de maquinaria', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(705, 513075, NULL, 'Obligatorio accidente de transito', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(706, 51307501, 1, 'Obligatorio accidente de transito', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(707, 5135, NULL, 'Servicios', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(708, 513505, NULL, 'Aseo y vigilancia', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(709, 51350501, 1, 'Servicios - Aseo y vigilancia', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(710, 513506, NULL, 'Curso Coordinador Trabajo', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(711, 51350601, 1, 'Seguro en alturas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(712, 513507, NULL, 'Estudio de Verificacion Hojas de vida', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(713, 51350701, 1, 'Confiabilidad Estudio de Verificacion Hojas de vida', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(714, 513508, NULL, 'Tecnico ANE', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(715, 51350801, 1, 'Informe tecnico ane', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(716, 513509, NULL, 'Curso cultivo y extraccion la quimica de Cannabis', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(717, 513510, NULL, 'Temporales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(718, 51351001, 1, 'Oficios Varios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(719, 513520, NULL, 'Procesamiento electrónico de datos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(720, 51352001, 1, 'Servicios - Procesamiento electrónico de datos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(721, 513525, NULL, 'Acueducto y alcantarillado', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(722, 51352501, 1, 'Servicios públicos - Acueducto y alcantarillado', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(723, 513530, NULL, 'Energía eléctrica', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(724, 51353001, 1, 'Servicios públicos - Energía eléctrica', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(725, 513535, NULL, 'Teléfono', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(726, 51353501, 1, 'Servicios públicos - Teléfono', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(727, 51353502, 2, 'Servicios públicos - Celular', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(728, 513536, NULL, 'Internet', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(729, 51353601, 1, 'UNE TIGO', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(730, 51353602, 2, 'OTROS', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(731, 51353603, 3, 'INTERNET', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(732, 513540, NULL, 'Correo portes y telegramas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(733, 51354001, 1, 'Correo portes y telegramas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(734, 513541, NULL, 'Servicio de Fotocopiadora', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(735, 513550, NULL, 'Transporte fletes y acarreos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(736, 51355001, 1, 'Transporte fletes y acarreos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(737, 513555, NULL, 'Gas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(738, 51355501, 1, 'Servicios públicos - Gas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(739, 513590, NULL, 'Servicios Consorciales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(740, 51359090, 90, 'Servicios Consocio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(741, 513595, NULL, 'Otros', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(742, 51359501, 1, 'Otros', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(743, 5140, NULL, 'Gastos legales', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(744, 514005, NULL, 'Notariales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(745, 51400501, 1, 'Notariales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(746, 514010, NULL, 'Registro mercantil', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(747, 51401001, 1, 'Registro mercantil', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(748, 514015, NULL, 'Tramites y licencias', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(749, 51401501, 1, 'Tramites y licencias', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(750, 514095, NULL, 'Otros', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(751, 51409502, 2, 'SOFTWARE', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(752, 5145, NULL, 'Mantenimiento y reparaciones', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(753, 514510, NULL, 'Construcciones y edificaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(754, 51451001, 1, 'Mantenimientos - Construcciones y edificaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(755, 514520, NULL, 'Equipo de oficina', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(756, 514525, NULL, 'Equipo de computación y comunicación', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(757, 51452501, 1, 'Mantenimiento - Equipo de computación y comunicación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(758, 514540, NULL, 'Flota y equipo de transporte', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(759, 51454001, 1, 'Flota y equipo de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(760, 514590, NULL, 'Manten y Repciones Consorciales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(761, 51459090, 90, 'Mantenimiento y Reparaciones Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(762, 5150, NULL, 'Adecuación e instalación', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(763, 515005, NULL, 'Instalaciones eléctricas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(764, 515010, NULL, 'Arreglos ornamentales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(765, 515015, NULL, 'Reparaciones locativas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(766, 51501501, 1, 'Reparaciones locativas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(767, 515020, NULL, 'Adecuación de puestos de trabajo', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(768, 5155, NULL, 'Gastos de viaje', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(769, 515505, NULL, 'Alojamiento y manutención', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(770, 51550501, 1, 'Alimentacion en Viaticos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(771, 51550502, 2, 'Alojamiento En viaticos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(772, 515515, NULL, 'Pasajes aéreos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(773, 51551501, 1, 'Gastos de viaje - Pasajes aéreos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(774, 515520, NULL, 'Pasajes terrestres', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(775, 51552001, 1, 'Gastos de viaje - Pasajes terrestres', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(776, 515590, NULL, 'G. de Viaje consorciales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(777, 51559090, 90, 'G. de VIaje Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(778, 515595, NULL, 'Otros gastos de viaje', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(779, 5160, NULL, 'Depreciaciones', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(780, 516005, NULL, 'Construcciones y edificaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(781, 516015, NULL, 'Equipo de oficina', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(782, 51601501, 1, 'Equipo de oficina', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(783, 51601597, 97, 'D. fiscal equipo de oficina', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(784, 516020, NULL, 'Equipo de computación y comunicación', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(785, 51602001, 1, 'Equipo de computación y comunicación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(786, 51602097, 97, 'D. fiscal equipo de computación y comunicación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(787, 516035, NULL, 'Flota y equipo de transporte', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(788, 51603501, 1, 'Flota y equipo de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(789, 51603597, 97, 'D. fiscal flota y equipo de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(790, 516090, NULL, 'Depreciaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(791, 51609090, 90, 'Deprecioacion Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(792, 5165, NULL, 'Amortizaciones', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(793, 516510, NULL, 'Intangibles', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(794, 516515, NULL, 'Cargos diferidos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(795, 516590, NULL, 'Amortizacion', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(796, 51659090, 90, 'Amortizacion Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(797, 5195, NULL, 'Diversos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(798, 519510, NULL, 'Libros suscripciones periódicos y revistas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(799, 519520, NULL, 'Gastos de representación y relaciones publicas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(800, 51952001, 1, 'Gastos de representación y relaciones publicas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(801, 519525, NULL, 'Elementos de aseo y cafetería', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(802, 51952501, 1, 'Elementos de aseo y cafetería', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(803, 519530, NULL, 'Útiles papelería y fotocopias', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(804, 51953001, 1, 'Útiles papelería y fotocopias', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(805, 519535, NULL, 'Combustibles y lubricantes', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(806, 51953501, 1, 'Combustibles y lubricantes', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(807, 519545, NULL, 'Taxis y buses', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(808, 51954501, 1, 'Taxis y buses', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(809, 51954502, 2, 'Peajes', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(810, 519560, NULL, 'Casino y restaurante', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(811, 51956001, 1, 'Casino y restaurante', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(812, 519565, NULL, 'Parqueaderos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(813, 51956501, 1, 'Parqueaderos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(814, 519590, NULL, 'Gastos Diversos ', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(815, 51959090, 90, 'Gastos Diversos Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(816, 519595, NULL, 'Otros', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(817, 51959501, 1, 'Otros', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(818, 5199, NULL, 'Otros gastos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(819, 519905, NULL, 'Inversiones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(820, 519999, NULL, 'Otros gastos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(821, 51999999, 99, 'Pregúntale a tu contador', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(822, 52, NULL, 'Ventas', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(823, 5205, NULL, 'Gastos de personal', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(824, 520503, NULL, 'Salario integral', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(825, 52050301, 1, 'Salario integral', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(826, 52050397, 97, 'D. fiscal salario integral', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(827, 520506, NULL, 'Sueldos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(828, 52050601, 1, 'Sueldos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(829, 52050697, 97, 'D. fiscal sueldos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(830, 520512, NULL, 'Apoyo sostenimiento aprendices', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(831, 52051201, 1, 'Apoyo sostenimiento aprendices', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(832, 52051297, 97, 'D. fiscal apoyo sostenimiento aprendices', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(833, 520515, NULL, 'Horas extras y recargos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(834, 52051501, 1, 'Horas extras y recargos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(835, 52051597, 97, 'D. fiscal horas extras y recargos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(836, 520524, NULL, 'Incapacidades', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(837, 52052401, 1, 'Incapacidades', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(838, 52052497, 97, 'D. fiscal incapacidades', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(839, 520527, NULL, 'Auxilio de transporte', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(840, 52052701, 1, 'Auxilio de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(841, 52052797, 97, 'D. fiscal auxilio de transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(842, 520530, NULL, 'Cesantías', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(843, 52053001, 1, 'Cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(844, 52053097, 97, 'D. fiscal cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(845, 520533, NULL, 'Intereses sobre cesantías', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(846, 52053301, 1, 'Intereses sobre cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(847, 52053397, 97, 'D. fiscal intereses sobre cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(848, 520536, NULL, 'Prima de servicios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(849, 52053601, 1, 'Prima de servicios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(850, 52053697, 97, 'D. fiscal prima de servicios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(851, 520539, NULL, 'Vacaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(852, 52053901, 1, 'Vacaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(853, 52053997, 97, 'D. fiscal vacaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(854, 520545, NULL, 'Auxilios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(855, 52054501, 1, 'Educativo', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(856, 52054502, 2, 'Auxilio transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(857, 52054597, 97, 'D. fiscal auxilio transporte', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(858, 520548, NULL, 'Bonificaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(859, 52054801, 1, 'Bonificaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(860, 52054897, 97, 'D. fiscal bonificaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(861, 520551, NULL, 'Dotación y suministro a trabajadores', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(862, 52055101, 1, 'Dotación y suministro a trabajadores', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(863, 52055197, 97, 'D. fiscal dotación y suministro a trabajadores', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(864, 520560, NULL, 'Indemnizaciones laborales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(865, 52056001, 1, 'Indemnizaciones laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(866, 52056097, 97, 'D. fiscal indemnizaciones laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(867, 520563, NULL, 'Capacitación al personal', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(868, 52056301, 1, 'Capacitación al personal', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(869, 52056397, 97, 'D. fiscal capacitación al personal', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(870, 520566, NULL, 'Gastos deportivos y de recreación', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(871, 52056601, 1, 'Gastos deportivos y de recreación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(872, 52056697, 97, 'D. fiscal gastos deportivos y de recreación', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(873, 520568, NULL, 'Aportes a administradora de riesgos laborales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(874, 52056801, 1, 'Aportes a administradora de riesgos laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(875, 52056897, 97, 'D. fiscal aportes a administradora de riesgos laborales', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(876, 520569, NULL, 'Aportes a entidades promotoras de salud eps', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(877, 52056901, 1, 'Aportes a entidades promotoras de salud eps', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(878, 52056997, 97, 'D. fiscal aportes a entidades promotoras de salud eps', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(879, 520570, NULL, 'Aporte a fondos de pensión y/o cesantías', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(880, 52057001, 1, 'Aporte a fondos de pensión y/o cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(881, 52057097, 97, 'D. fiscal aporte a fondos de pensión y/o cesantías', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(882, 520572, NULL, 'Aportes cajas de compensación familiar', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(883, 52057201, 1, 'Aportes cajas de compensación familiar', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(884, 52057297, 97, 'D. fiscal aportes cajas de compensación familiar', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(885, 520575, NULL, 'Aportes icbf', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(886, 52057501, 1, 'Aportes icbf', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(887, 52057597, 97, 'D. fiscal aportes icbf', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(888, 520578, NULL, 'Aportes Sena', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(889, 52057801, 1, 'Aportes Sena', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(890, 52057897, 97, 'D. fiscal aportes Sena', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(891, 520584, NULL, 'Gastos médicos y drogas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(892, 52058401, 1, 'Gastos médicos y drogas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(893, 52058497, 97, 'D. fiscal gastos médicos y drogas', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(894, 520595, NULL, 'Otros', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(895, 52059501, 1, 'Bienestar y atención a empleados', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(896, 52059597, 97, 'D. fiscal bienestar y atención a empleados', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(897, 5220, NULL, 'ARRENDAMIENTOS', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(898, 522005, NULL, 'TERRENOS', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(899, 5235, NULL, 'Servicios', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(900, 523510, NULL, 'Temporales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(901, 523535, NULL, 'Teléfono', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(902, 523540, NULL, 'Correo portes y telegramas', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(903, 523560, NULL, 'Publicidad propaganda y promoción', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(904, 5255, NULL, 'Gastos de viaje', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(905, 525515, NULL, 'Pasajes aéreos comercial', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(906, 5295, NULL, 'Diversos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(907, 529505, NULL, 'Comisiones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(908, 52950501, 1, 'Comisiones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(909, 529545, NULL, 'Taxis y buses', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(910, 529595, NULL, 'Otros diversos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(911, 53, NULL, 'Otros gastos de actividades ordinarias', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(912, 5305, NULL, 'Financieros', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(913, 530505, NULL, 'Gastos bancarios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(914, 53050501, 1, 'Gastos bancarios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(915, 530515, NULL, 'Comisiones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(916, 53051501, 1, 'Comisiones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(917, 530520, NULL, 'Intereses', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(918, 53052002, 2, 'Intereses de mora', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(919, 530525, NULL, 'Diferencia en cambio', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(920, 530535, NULL, 'Descuentos comerciales condicionados', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(921, 53053501, 1, 'Descuentos comerciales condicionados', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(922, 530590, NULL, 'Gastos Financieros Consorciales', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(923, 53059090, 90, 'Financieros Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(924, 5310, NULL, 'Perdida en venta y retiro de bienes', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(925, 531030, NULL, 'Retiro de propiedades planta y equipo', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(926, 5315, NULL, 'Gastos extraordinarios', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(927, 531515, NULL, 'Costos y gastos de ejercicios anteriores', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(928, 53151590, 90, 'Costos y Gastos No deducibles Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(929, 531520, NULL, 'Impuestos asumidos', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(930, 53152001, 1, 'Gravamen al movimiento financiero', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(931, 53152002, 2, 'Otros impuestos asumidos', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(932, 53152003, 3, 'IVA asumido 3% del 16%', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(933, 531525, NULL, 'Costos y gastos no deducibles', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(934, 53152501, 1, 'Costos y gastos no deducibles', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(935, 5395, NULL, 'Gastos diversos', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(936, 539520, NULL, 'Multas sanciones y litigios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(937, 53952001, 1, 'Multas sanciones y litigios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(938, 53952090, 90, 'Gastos Diversos Consorcio R&S', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(939, 539525, NULL, 'Donaciones', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(940, 53952501, 1, 'Donaciones', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(941, 539581, NULL, 'Ajuste al peso', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(942, 53958101, 1, 'Ajuste al peso', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(943, 539595, NULL, 'Otros', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(944, 54, NULL, 'Impuesto de renta y complementarios', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(945, 5405, NULL, 'Impuesto de renta y complementarios', 5, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(946, 540505, NULL, 'Impuesto de renta y complementarios', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(947, 54050501, 1, 'Impuesto de renta y complementarios', 5, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(948, 540510, NULL, 'Cree', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(949, 540515, NULL, 'Impuesto a la riqueza', 5, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(950, 61, NULL, 'Costo de ventas y de prestación de servicios', 6, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(951, 6135, NULL, 'Comercio al por mayor y al por menor', 6, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(952, 613504, NULL, 'Mantenimiento , reparacion y lavada de vehiculo au', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(953, 613505, NULL, 'Comercio al por mayor y al por menor', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(954, 61350501, 1, 'Comercio al por mayor y al por menor', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(955, 61350502, 2, 'Repuestos vehiculos', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(956, 613510, NULL, 'Combustible. solidos, liquidos y gaseosos', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(957, 61351001, 1, 'Combustible liquido', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(958, 61351002, 2, 'Lubricantes y aditivos', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(959, 6145, NULL, 'Transporte, almacenamiento y comunicaciones ', 6, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(960, 614540, NULL, 'Servicios complementarios para transporte ', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(961, 61454001, 1, 'Asistencia preventiva vehicular', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(962, 6155, NULL, 'ACTIVIDADES INMOBILIARIA, EMPRESARIALES Y DE ALQUI', 6, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(963, 615590, NULL, 'MANTENIMIENTO Y REPARACION DE MAQUINARIA Y EQUIPOS', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(964, 61559001, 1, 'MANTENIMIENTO E INSTALACION TORRE AUTOSOPORTADA', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(965, 61559002, 2, 'Mantenimiento Reparacion de Radios', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(966, 6180, NULL, 'Servicios', 6, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(967, 618001, NULL, 'Servicios', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(968, 61800101, 1, 'Servicios', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(969, 61800102, 2, 'COMPRAS MERCANCIAS', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(970, 61800103, 3, 'Servicio transporte grua', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(971, 61800104, 4, 'Alquiler', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(972, 618020, NULL, 'Arrendamiento', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(973, 61802001, 1, 'Arrend/espacios/cerros', 6, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(974, 618025, NULL, 'Acueducto y Alcantarillado', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(975, 618030, NULL, 'Energia Electrica', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(976, 618090, NULL, 'Otros servicios', 6, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(977, 71, NULL, 'Costos de producción o de operación', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(978, 7105, NULL, 'Costos de producción o de operación', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(979, 710505, NULL, 'Costos de producción o de operación', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(980, 71050501, 1, 'Materia prima', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(981, 7135, NULL, 'Costo mercancias al por mayor y detal', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(982, 713595, NULL, 'otros productos', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(983, 71359501, 1, 'Repuestos para mantenimientos de radios', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(984, 72, NULL, 'Mano de obra directa', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(985, 7205, NULL, 'Mano de obra directa', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(986, 720503, NULL, 'Salario integral', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(987, 72050301, 1, 'Salario integral', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(988, 720506, NULL, 'Sueldos', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(989, 72050601, 1, 'Sueldos', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(990, 720512, NULL, 'Apoyo sostenimiento aprendices', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(991, 72051201, 1, 'Apoyo sostenimiento aprendices', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(992, 720515, NULL, 'Horas extras y recargos', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(993, 72051501, 1, 'Horas extras y recargos', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(994, 720524, NULL, 'Incapacidades', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(995, 72052401, 1, 'Incapacidades', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(996, 720527, NULL, 'Auxilio de transporte', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(997, 72052701, 1, 'Auxilio de transporte', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(998, 720530, NULL, 'Cesantías', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(999, 72053001, 1, 'Cesantías', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1000, 720533, NULL, 'Intereses sobre cesantías', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1001, 72053301, 1, 'Intereses sobre cesantías', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1002, 720536, NULL, 'Prima de servicios', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1003, 72053601, 1, 'Prima de servicios', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1004, 720539, NULL, 'Vacaciones', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1005, 72053901, 1, 'Vacaciones', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1006, 720545, NULL, 'Auxilios', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1007, 720548, NULL, 'Bonificaciones', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1008, 72054801, 1, 'Bonificaciones', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1009, 720551, NULL, 'Dotación y suministro a trabajadores', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1010, 720560, NULL, 'Indemnizaciones laborales', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1011, 72056001, 1, 'Indemnizaciones laborales', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1012, 720563, NULL, 'Capacitación al personal', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1013, 720566, NULL, 'Gastos deportivos y de recreación', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1014, 720568, NULL, 'Aportes a administradora de riesgos laborales', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1015, 72056801, 1, 'Aportes a administradora de riesgos laborales', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1016, 720569, NULL, 'Aportes a entidades promotoras de salud eps', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1017, 72056901, 1, 'Aportes a entidades promotoras de salud eps', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1018, 720570, NULL, 'Aporte a fondos de pensión y/o cesantías', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1019, 72057001, 1, 'Aporte a fondos de pensión y/o cesantías', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1020, 720572, NULL, 'Aportes cajas de compensación familiar', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1021, 72057201, 1, 'Aportes cajas de compensación familiar', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1022, 720575, NULL, 'Aportes icbf', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1023, 72057501, 1, 'Aportes icbf', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1024, 720578, NULL, 'Aportes Sena', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1025, 72057801, 1, 'Aportes Sena', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1026, 720584, NULL, 'Gastos médicos y drogas', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1027, 720590, NULL, 'Mano de Obra Consorcia', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1028, 72059090, 90, 'MDO Directa Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1029, 720595, NULL, 'Otros', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1030, 73, NULL, 'Costos indirectos', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1031, 7305, NULL, 'Costos indirectos', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1032, 730505, NULL, 'Costos indirectos', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1033, 73050501, 1, 'Repuestos para Radios y Repetidoras', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1034, 73050502, 2, 'Costos indirectos consorcios ', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1035, 73050590, 90, 'Costos indirectos Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1036, 7310, NULL, 'Honorarios', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1037, 731090, NULL, 'Honoracios consorcial', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1038, 73109090, 90, 'Honorios Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1039, 7320, NULL, 'Arrendamientos', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1040, 732005, NULL, 'Arrendamientos', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1041, 73200590, 90, 'Arrendamiento Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1042, 7330, NULL, 'Seguro', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1043, 733005, NULL, 'Seguros consorciales', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1044, 73300590, 90, 'Seguro Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1045, 7335, NULL, 'Servicios ', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1046, 733505, NULL, 'Servicios de Produccion', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1047, 73350590, 90, 'Servicios de Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1048, 733530, NULL, 'Energia Electrica Cerros ', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1049, 73353001, 1, 'Energia Electrica Cerros', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1050, 733535, NULL, 'Telefonia E Internet Cerros', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1051, 73353501, 1, 'Telefonia Cerros', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1052, 73353502, 2, 'Internet Cerros', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1053, 7345, NULL, 'Mantenimiento y Reparaciones', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1054, 734505, NULL, 'Mant. y Rep. Consorcales', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1055, 73450590, 90, 'Mant y Reparaciones Consorcio R&S', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1056, 734540, NULL, 'Flota y Equipo de Transporte', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1057, 73454001, 1, 'Mantenimiento , reparacion Vehiculos', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1058, 7351, NULL, 'SERVICIOS ', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1059, 735120, NULL, 'ARENDAMIENTOS', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1060, 73512001, 1, 'Arrend/espacios/cerros', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1061, 73512010, 10, 'CONSTRUCIONES Y EDIFICACIONES', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1062, 7395, NULL, 'Costos de produccion Diversos', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1063, 739535, NULL, 'Combustibles y lubricantes', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1064, 73953501, 1, 'Combustibles y lubricantes vehiculos ', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1065, 74, NULL, 'Contratos de servicios', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1066, 7405, NULL, 'Contratos de servicios', 7, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1067, 740505, NULL, 'Contratos de servicios', 7, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1068, 74050501, 1, 'Servicio de suministro e instalacion de acometida aerea', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1069, 74050502, 2, 'Servicio y Mantenimiento preventivo de equipos de ', 7, 1, 0, 1, 0, 43, '0000-00-00 00:00:00'),
(1070, 81, NULL, 'Derechos contingentes', 8, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1071, 99, NULL, 'Cuentas de orden acreedoras', 9, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1072, 9999, NULL, 'Saldos iniciales por conciliar', 9, 1, 0, 0, 0, 43, '0000-00-00 00:00:00'),
(1073, 999999, NULL, 'Saldos iniciales por conciliar', 9, 1, 1, 0, 0, 43, '0000-00-00 00:00:00'),
(1074, 99999999, 99, 'Saldos iniciales por conciliar', 9, 1, 0, 1, 0, 43, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador`
--

CREATE TABLE `contador` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contador`
--

INSERT INTO `contador` (`id`, `nombres`, `apellidos`, `tipo_documento`, `documento`) VALUES
(1, 'Tatiana', 'Nose', 3, '11111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `incluye` text DEFAULT NULL,
  `validez` varchar(255) NOT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `forma_pago` varchar(255) NOT NULL,
  `tiempo_entrega` varchar(255) DEFAULT NULL,
  `descuento` varchar(255) DEFAULT NULL,
  `garantia` text DEFAULT NULL,
  `envio` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `aprobado` int(1) NOT NULL DEFAULT 0,
  `fecha_revision` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `code`, `cliente_id`, `descripcion`, `incluye`, `validez`, `duracion`, `forma_pago`, `tiempo_entrega`, `descuento`, `garantia`, `envio`, `status`, `aprobado`, `fecha_revision`, `created_by`, `created_at`) VALUES
(30, 1, 11, NULL, NULL, '8 días', NULL, 'Crédito', NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2023-03-09 11:53:11'),
(31, 2, 11, NULL, NULL, '8 días', NULL, 'Crédito', NULL, NULL, NULL, NULL, 1, 0, NULL, 1, '2023-03-09 12:15:13'),
(32, 3, 11, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', NULL, NULL, NULL, 0, 0, NULL, 6, '2023-03-27 09:43:33');

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
-- Estructura de tabla para la tabla `datos_tributarios`
--

CREATE TABLE `datos_tributarios` (
  `id` int(11) NOT NULL,
  `actividad_economica` text DEFAULT NULL,
  `ica` int(11) DEFAULT NULL,
  `aiu` int(11) DEFAULT NULL,
  `dos_impuestos` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `valorem` int(11) DEFAULT NULL,
  `responsabilidad_fiscal` int(11) DEFAULT NULL,
  `tributos` int(11) DEFAULT NULL,
  `anexo_dian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_tributarios`
--

INSERT INTO `datos_tributarios` (`id`, `actividad_economica`, `ica`, `aiu`, `dos_impuestos`, `iva`, `valorem`, `responsabilidad_fiscal`, `tributos`, `anexo_dian`) VALUES
(1, '1,2', 1, 2, 2, 1, 1, 1, 1, '1677244591pdf-prueba-1.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `pais_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `pais_id`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(5, 47, 'Antioquia', 1, 1, '2023-02-22 12:47:34'),
(8, 47, 'Atlántico', 1, 1, '2023-02-22 12:47:34'),
(11, 47, 'Bogotá, D.C.', 1, 1, '2023-02-22 12:47:34'),
(13, 47, 'Bolívar', 1, 1, '2023-02-22 12:47:34'),
(15, 47, 'Boyacá', 1, 1, '2023-02-22 12:47:34'),
(17, 47, 'Caldas', 1, 1, '2023-02-22 12:47:34'),
(18, 47, 'Caquetá', 1, 1, '2023-02-22 12:47:34'),
(19, 47, 'Cauca', 1, 1, '2023-02-22 12:47:34'),
(20, 47, 'Cesar', 1, 1, '2023-02-22 12:47:34'),
(23, 47, 'Córdoba', 1, 1, '2023-02-22 12:47:34'),
(25, 47, 'Cundinamarca', 1, 1, '2023-02-22 12:47:34'),
(27, 47, 'Chocó', 1, 1, '2023-02-22 12:47:34'),
(41, 47, 'Huila', 1, 1, '2023-02-22 12:47:34'),
(44, 47, 'La Guajira', 1, 1, '2023-02-22 12:47:34'),
(47, 47, 'Magdalena', 1, 1, '2023-02-22 12:47:34'),
(50, 47, 'Meta', 1, 1, '2023-02-22 12:47:34'),
(52, 47, 'Nariño', 1, 1, '2023-02-22 12:47:34'),
(54, 47, 'Norte de Santander', 1, 1, '2023-02-22 12:47:34'),
(63, 47, 'Quindio', 1, 1, '2023-02-22 12:47:34'),
(66, 47, 'Risaralda', 1, 1, '2023-02-22 12:47:34'),
(68, 47, 'Santander', 1, 1, '2023-02-22 12:47:34'),
(70, 47, 'Sucre', 1, 1, '2023-02-22 12:47:34'),
(73, 47, 'Tolima', 1, 1, '2023-02-22 12:47:34'),
(76, 47, 'Valle del Cauca', 1, 1, '2023-02-22 12:47:34'),
(81, 47, 'Arauca', 1, 1, '2023-02-22 12:47:34'),
(85, 47, 'Casanare', 1, 1, '2023-02-22 12:47:34'),
(86, 47, 'Putumayo', 1, 1, '2023-02-22 12:47:34'),
(88, 47, 'Archipiélago de San Andrés, Providencia y Santa Catalina', 1, 1, '2023-02-22 12:47:34'),
(91, 47, 'Amazonas', 1, 1, '2023-02-22 12:47:34'),
(94, 47, 'Guainía', 1, 1, '2023-02-22 12:47:34'),
(95, 47, 'Guaviare', 1, 1, '2023-02-22 12:47:34'),
(97, 47, 'Vaupés', 1, 1, '2023-02-22 12:47:34'),
(99, 47, 'Vichada', 1, 1, '2023-02-22 12:47:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cotizaciones`
--

CREATE TABLE `detalle_cotizaciones` (
  `id` int(11) NOT NULL,
  `titulo` text DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cotizacion_id` int(11) DEFAULT NULL,
  `tipo_divisa` int(1) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `tipo_transaccion` int(1) DEFAULT NULL,
  `precio` varchar(255) DEFAULT NULL,
  `iva` varchar(255) DEFAULT '0',
  `retencion` varchar(255) DEFAULT '0',
  `tipo_pago` int(1) NOT NULL DEFAULT 0,
  `img_grande` int(1) NOT NULL DEFAULT 0,
  `descripcion` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_cotizaciones`
--

INSERT INTO `detalle_cotizaciones` (`id`, `titulo`, `producto_id`, `cotizacion_id`, `tipo_divisa`, `cantidad`, `tipo_transaccion`, `precio`, `iva`, `retencion`, `tipo_pago`, `img_grande`, `descripcion`, `created_by`, `created_at`) VALUES
(147, NULL, 1, 32, 1, 1, 1, '111', '1', '1', 1, 0, 'asdasd', 6, '2023-03-27 09:43:33'),
(153, NULL, 3, 31, 1, 4, 3, '40000', '19', '0', 1, 0, NULL, 1, '2023-05-15 11:35:27'),
(154, 'Venta', NULL, 30, NULL, NULL, NULL, NULL, '0', '0', 0, 0, NULL, 1, '2023-05-15 11:36:25'),
(155, NULL, 1, 30, 1, 5, 1, '50000', '19', '0', 1, 0, NULL, 1, '2023-05-15 11:36:25'),
(156, 'Alquiler', NULL, 30, NULL, NULL, NULL, NULL, '0', '0', 0, 0, NULL, 1, '2023-05-15 11:36:25'),
(157, NULL, 3, 30, 1, 4, 3, '40000', '19', '0', 0, 0, NULL, 1, '2023-05-15 11:36:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura_compra`
--

CREATE TABLE `detalle_factura_compra` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `producto` int(11) DEFAULT NULL,
  `serial_producto` varchar(255) DEFAULT NULL,
  `cuenta` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bodega` varchar(255) DEFAULT NULL,
  `cantidad` varchar(255) NOT NULL,
  `valor_unitario` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL,
  `impuesto_cargo` varchar(11) DEFAULT NULL,
  `impuesto_retencion` varchar(11) DEFAULT NULL,
  `valor_total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura_compra`
--

INSERT INTO `detalle_factura_compra` (`id`, `factura_id`, `tipo`, `producto`, `serial_producto`, `cuenta`, `description`, `bodega`, `cantidad`, `valor_unitario`, `descuento`, `impuesto_cargo`, `impuesto_retencion`, `valor_total`) VALUES
(1146, 1154, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '777.731,00', '0,00', '0', '0', '777.731,00'),
(1147, 1154, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '112.755,00', '0,00', '2', '0', '134.178,00'),
(1148, 1155, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '129.900,00', '0,00', '0', '0', '129.900,00'),
(1149, 1156, 3, NULL, NULL, 1069, 'Servicio y Mantenimiento preventivo de equipos de', NULL, '1', '433.613,00', '0,00', '2', '0', '515.999,00'),
(1150, 1157, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '124.871,00', '0,00', '0', '0', '133.952,00'),
(1151, 1158, 3, NULL, NULL, 726, 'Servicios públicos - Teléfono', NULL, '1', '83.080,00', '0,00', '0', '0', '83.080,00'),
(1152, 1159, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '83.950,00', '0,00', '2', '0', '99.901,00'),
(1153, 1160, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '209.959,00', '0,00', '0', '0', '209.959,00'),
(1154, 1161, 3, NULL, NULL, 1052, 'INTERNET', NULL, '1', '162.381,00', '0,00', '0', '0', '162.381,00'),
(1155, 1162, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '39.931,00', '0,00', '0', '0', '39.931,00'),
(1156, 1163, 3, NULL, NULL, 724, 'Servicios públicos - Energía eléctrica', NULL, '1', '272.020,00', '0,00', '0', '0', '272.020,00'),
(1157, 1164, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '40.336,00', '0,00', '2', '0', '48.000,00'),
(1158, 1165, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '46.517,00', '0,00', '3', '0', '48.843,00'),
(1159, 1166, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '1.639.643,00', '0,00', '0', '0', '1.638.003,00'),
(1160, 1167, 3, NULL, NULL, 771, 'Alojamiento En viaticos', NULL, '2', '15.740,00', '0,00', '0', '0', '33.998,00'),
(1161, 1168, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '60.037,00', '0,00', '0', '0', '60.037,00'),
(1162, 1169, 3, NULL, NULL, 957, 'Combustible liquido', NULL, '1', '3.844.925,00', '0,00', '0', '0', '3.844.925,00'),
(1163, 1169, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '5210,00', '0,00', '2', '0', '6200,00'),
(1164, 1169, 3, NULL, NULL, 1029, 'Otros', NULL, '2', '11.680,00', '0,00', '2', '0', '27.798,00'),
(1165, 1170, 3, NULL, NULL, 724, 'Servicios públicos - Energía eléctrica', NULL, '1', '0,00', '0,00', '0', '0', '0,00'),
(1166, 1171, 3, NULL, NULL, 766, 'Reparaciones locativas', NULL, '1', '20.000,00', '0,00', '0', '0', '20.000,00'),
(1167, 1172, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '88.341,00', '0,00', '0', '0', '88.341,00'),
(1168, 1173, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '364.990,00', '0,00', '0', '0', '364.990,00'),
(1169, 1174, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '137.602,00', '0,00', '0', '0', '147.609,00'),
(1170, 1175, 3, NULL, NULL, 770, 'Alimentacion en Viaticos', NULL, '1', '11.111,00', '0,00', '0', '0', '12.000,00'),
(1171, 1176, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '49.537,00', '0,00', '0', '0', '53.499,00'),
(1172, 1177, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '21.849,00', '0,00', '2', '0', '26.000,00'),
(1173, 1178, 3, NULL, NULL, 694, 'Cumplimiento', NULL, '1', '694.976,00', '0,00', '2', '0', '827.021,00'),
(1174, 1179, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '26.714,00', '0,00', '3', '0', '28.050,00'),
(1175, 1179, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '9664,00', '0,00', '2', '0', '11.500,00'),
(1176, 1179, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '15.074,00', '0,00', '0', '0', '15.074,00'),
(1177, 1180, 3, NULL, NULL, 961, 'Asistencia preventiva vehicular', NULL, '1', '8.865.546,00', '0,00', '2', '0', '10.195.378,00'),
(1178, 1181, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '777.731,00', '0,00', '0', '0', '777.731,00'),
(1179, 1181, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '112.755,00', '0,00', '2', '0', '134.178,00'),
(1180, 1182, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '156.302,00', '0,00', '2', '0', '185.999,00'),
(1181, 1183, 3, NULL, NULL, 745, 'Notariales', NULL, '1', '7058,00', '0,00', '2', '0', '8399,00'),
(1182, 1183, 3, NULL, NULL, 745, 'Notariales', NULL, '1', '13.200,00', '0,00', '0', '0', '13.200,00'),
(1183, 1184, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '220.000,00', '0,00', '0', '0', '220.000,00'),
(1184, 1185, 3, NULL, NULL, 736, 'Transporte fletes y acarreos', NULL, '1', '13.500,00', '0,00', '0', '0', '13.500,00'),
(1185, 1186, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '13.884.470,00', '0,00', '2', '0', '16.175.407,00'),
(1186, 1186, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '0,00', '0,00', '0', '0', '0,00'),
(1187, 1187, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '676.470,00', '0,00', '2', '0', '804.999,00'),
(1188, 1188, 3, NULL, NULL, 1060, 'Arrend/espacios/cerros', NULL, '1', '920.919,00', '0,00', '2', '0', '1.095.894,00'),
(1189, 1189, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '273.148,00', '0,00', '0', '0', '294.999,00'),
(1190, 1190, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '1', '4800,00', '0,00', '2', '0', '5712,00'),
(1191, 1191, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '14.907,00', '0,00', '2', '0', '17.739,00'),
(1192, 1192, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '75.952,00', '0,00', '0', '0', '75.952,00'),
(1193, 1193, 3, NULL, NULL, 957, 'Combustible liquido', NULL, '1', '3.844.925,00', '0,00', '0', '0', '3.844.925,00'),
(1194, 1193, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '5210,00', '0,00', '2', '0', '6200,00'),
(1195, 1193, 3, NULL, NULL, 1029, 'Otros', NULL, '2', '11.680,00', '0,00', '2', '0', '27.798,00'),
(1196, 1194, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '20.925,00', '0,00', '0', '0', '22.599,00'),
(1197, 1195, 3, NULL, NULL, 1057, 'Mantenimiento , reparacion Vehiculos', NULL, '1', '394.957,00', '0,00', '2', '0', '469.999,00'),
(1198, 1196, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '62.511,00', '0,00', '2', '0', '74.388,00'),
(1199, 1198, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '77.983,00', '0,00', '2', '0', '92.800,00'),
(1200, 1199, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '1', '9000,00', '0,00', '2', '0', '10.710,00'),
(1201, 1200, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '15', '54.773,00', '0,00', '2', '0', '977.698,00'),
(1202, 1202, 3, NULL, NULL, 766, 'Reparaciones locativas', NULL, '1', '25.966,00', '0,00', '2', '0', '30.900,00'),
(1203, 1203, 3, NULL, NULL, 1057, 'Mantenimiento , reparacion Vehiculos', NULL, '1', '201.680,00', '0,00', '2', '0', '239.999,00'),
(1204, 1204, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '120.190,00', '0,00', '0', '0', '120.190,00'),
(1205, 1205, 3, NULL, NULL, 684, 'Equipos oficina', NULL, '1', '3.125.958,00', '0,00', '2', '0', '3.719.890,00'),
(1206, 1206, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '178.599,00', '0,00', '0', '0', '178.599,00'),
(1207, 1207, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '468.823,00', '0,00', '2', '0', '557.899,00'),
(1208, 1208, 3, NULL, NULL, 1052, 'INTERNET', NULL, '1', '27.455,00', '0,00', '0', '0', '27.455,00'),
(1209, 1209, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '93.965,00', '0,00', '0', '0', '93.965,00'),
(1210, 1210, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '11.111,00', '0,00', '19', '0', '12.000,00'),
(1211, 1211, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '13.884.470,00', '0,00', '2', '0', '16.175.407,00'),
(1212, 1211, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '0,00', '0,00', '0', '0', '0,00'),
(1213, 1212, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '14.530,00', '0,00', '0', '0', '14.530,00'),
(1214, 1213, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '239.861,00', '0,00', '0', '0', '239.861,00'),
(1215, 1214, 3, NULL, NULL, 747, 'Registro mercantil', NULL, '1', '7200,00', '0,00', '0', '0', '7200,00'),
(1216, 1215, 3, NULL, NULL, 749, 'Tramites y licencias', NULL, '1', '27.600,00', '0,00', '0', '0', '27.600,00'),
(1217, 1216, 3, NULL, NULL, 771, 'Alojamiento En viaticos', NULL, '1', '403.361,00', '0,00', '0', '0', '479.999,00'),
(1218, 1217, 3, NULL, NULL, 804, 'Útiles papelería y fotocopias', NULL, '1', '40.546,00', '0,00', '2', '0', '48.250,00'),
(1219, 1217, 3, NULL, NULL, 804, 'Útiles papelería y fotocopias', NULL, '1', '21.990,00', '0,00', '0', '0', '21.990,00'),
(1220, 1218, 3, NULL, NULL, 1052, 'INTERNET', NULL, '1', '209.635,00', '0,00', '0', '0', '209.635,00'),
(1221, 1219, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '15', '19.081,00', '0,00', '2', '0', '340.596,00'),
(1222, 1220, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '1', '39.400,00', '0,00', '2', '0', '46.886,00'),
(1223, 1221, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '1', '1.155.665,00', '0,00', '2', '0', '1.346.349,00'),
(1224, 1222, 3, NULL, NULL, 952, 'Mantenimiento , reparacion y lavada de vehiculo au', NULL, '1', '412.776,00', '0,00', '2', '0', '491.203,00'),
(1225, 1223, 3, NULL, NULL, 770, 'Alimentacion en Viaticos', NULL, '1', '11.111,00', '0,00', '0', '0', '12.000,00'),
(1226, 1224, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '85.714,00', '0,00', '2', '0', '102.000,00'),
(1227, 1224, 3, NULL, NULL, 958, 'Lubricantes y aditivos', NULL, '1', '150.000,00', '0,00', '0', '0', '150.000,00'),
(1228, 1225, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '183.300,00', '0,00', '0', '0', '183.300,00'),
(1229, 1226, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '286.797,00', '0,00', '2', '0', '341.288,00'),
(1230, 1227, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '116.723,00', '0,00', '2', '0', '138.900,00'),
(1231, 1228, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '1.042.016,00', '0,00', '2', '0', '1.198.318,00'),
(1232, 1230, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '215.933,00', '0,00', '2', '0', '256.960,00'),
(1233, 1232, 3, NULL, NULL, 726, 'Servicios públicos - Teléfono', NULL, '1', '21.197,00', '0,00', '0', '0', '21.197,00'),
(1234, 1233, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '95.560,00', '0,00', '2', '0', '113.716,00'),
(1235, 1234, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '501.176,00', '0,00', '2', '0', '596.399,00'),
(1236, 1235, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '249.900,00', '0,00', '0', '0', '249.900,00'),
(1237, 1237, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '16.806,00', '0,00', '2', '0', '19.999,00'),
(1238, 1237, 3, NULL, NULL, 958, 'Lubricantes y aditivos', NULL, '1', '117.000,00', '0,00', '0', '0', '117.000,00'),
(1239, 1238, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '98.235,00', '0,00', '2', '0', '116.900,00'),
(1240, 1239, 3, NULL, NULL, 957, 'Combustible liquido', NULL, '1', '102.942,00', '0,00', '0', '0', '102.942,00'),
(1241, 1240, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '97.800,00', '0,00', '0', '0', '97.800,00'),
(1242, 1241, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '249.900,00', '0,00', '0', '0', '249.900,00'),
(1243, 1243, 3, NULL, NULL, 684, 'Equipos oficina', NULL, '1', '37.647,00', '0,00', '2', '0', '44.800,00'),
(1244, 1244, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '235.980,00', '0,00', '0', '0', '235.980,00'),
(1245, 1245, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '192.900,00', '0,00', '0', '0', '192.900,00'),
(1246, 1246, 3, NULL, NULL, 1052, 'INTERNET', NULL, '1', '161.955,00', '0,00', '0', '0', '161.955,00'),
(1247, 1247, 3, NULL, NULL, 766, 'Reparaciones locativas', NULL, '1', '430.000,00', '0,00', '0', '0', '430.000,00'),
(1248, 1248, 3, NULL, NULL, 934, 'Costos y gastos no deducibles', NULL, '1', '25.900,00', '0,00', '0', '0', '25.900,00'),
(1249, 1249, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '638.402,00', '0,00', '2', '0', '759.698,00'),
(1250, 1250, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '42.016,00', '0,00', '2', '0', '49.999,00'),
(1251, 1251, 3, NULL, NULL, 165, 'Materiales, repuestos y accesorios', NULL, '1', '588.235,00', '0,00', '2', '0', '700.000,00'),
(1252, 1252, 3, NULL, NULL, 811, 'Casino y restaurante', NULL, '1', '26.680,00', '0,00', '0', '0', '28.494,00'),
(1253, 1253, 3, NULL, NULL, 1009, 'Dotación y suministro a trabajadores', NULL, '1', '190.588,00', '0,00', '2', '0', '226.800,00'),
(1254, 1254, 3, NULL, NULL, 724, 'Servicios públicos - Energía eléctrica', NULL, '1', '1.207.774,00', '0,00', '0', '0', '1.207.774,00'),
(1255, 1255, 3, NULL, NULL, 957, 'Combustible liquido', NULL, '1', '3.844.925,00', '0,00', '0', '0', '3.844.925,00'),
(1256, 1255, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '5210,00', '0,00', '2', '0', '6200,00'),
(1257, 1255, 3, NULL, NULL, 1029, 'Otros', NULL, '2', '11.680,00', '0,00', '2', '0', '27.798,00'),
(1258, 1256, 3, NULL, NULL, 1029, 'Otros', NULL, '1', '323.529,00', '0,00', '2', '0', '385.000,00'),
(1259, 1257, 3, NULL, NULL, 1064, 'Combustibles y lubricantes', NULL, '1', '50.000,00', '0,00', '0', '0', '50.000,00'),
(1260, 1258, 3, NULL, NULL, 745, 'Notariales', NULL, '1', '7058,00', '0,00', '2', '0', '8399,00'),
(1261, 1258, 3, NULL, NULL, 745, 'Notariales', NULL, '1', '13.200,00', '0,00', '0', '0', '13.200,00'),
(1262, 1259, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '26.714,00', '0,00', '3', '0', '28.050,00'),
(1263, 1259, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '9664,00', '0,00', '2', '0', '11.500,00'),
(1264, 1259, 3, NULL, NULL, 802, 'Elementos de aseo y cafetería', NULL, '1', '15.074,00', '0,00', '0', '0', '15.074,00'),
(1265, 1260, 3, NULL, NULL, 804, 'Útiles papelería y fotocopias', NULL, '1', '40.546,00', '0,00', '2', '0', '48.250,00'),
(1266, 1260, 3, NULL, NULL, 804, 'Útiles papelería y fotocopias', NULL, '1', '21.990,00', '0,00', '0', '0', '21.990,00'),
(1267, 1262, 3, NULL, NULL, 771, 'Alojamiento En viaticos', NULL, '1', '201.680,00', '0,00', '0', '0', '239.999,00'),
(1268, 1264, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '16.806,00', '0,00', '2', '0', '19.999,00'),
(1269, 1264, 3, NULL, NULL, 958, 'Lubricantes y aditivos', NULL, '1', '117.000,00', '0,00', '0', '0', '117.000,00'),
(1270, 1267, 3, NULL, NULL, 955, 'Repuestos vehiculos', NULL, '1', '85.714,00', '0,00', '2', '0', '102.000,00'),
(1271, 1267, 3, NULL, NULL, 958, 'Lubricantes y aditivos', NULL, '1', '150.000,00', '0,00', '0', '0', '150.000,00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura_venta`
--

CREATE TABLE `detalle_factura_venta` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `producto` int(11) DEFAULT NULL,
  `serial_producto` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bodega` varchar(255) DEFAULT NULL,
  `cantidad` varchar(255) NOT NULL,
  `valor_unitario` varchar(255) NOT NULL,
  `descuento` varchar(255) DEFAULT NULL,
  `impuesto_cargo` varchar(255) DEFAULT NULL,
  `impuesto_retencion` varchar(255) DEFAULT NULL,
  `valor_total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura_venta`
--

INSERT INTO `detalle_factura_venta` (`id`, `factura_id`, `producto`, `serial_producto`, `description`, `bodega`, `cantidad`, `valor_unitario`, `descuento`, `impuesto_cargo`, `impuesto_retencion`, `valor_total`) VALUES
(6, 7, 1, NULL, '', NULL, '20', '200.000,00', '0.00', '19', '0', '4.760.000,00'),
(7, 7, 2, NULL, '', NULL, '1', '100.000,00', '0.00', '19', '0', '119.000,00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ordenes`
--

CREATE TABLE `detalle_ordenes` (
  `id` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` varchar(255) DEFAULT NULL,
  `precio` varchar(255) DEFAULT '0',
  `iva` varchar(255) DEFAULT '0',
  `retencion` varchar(255) DEFAULT '0',
  `proveedor` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ordenes`
--

INSERT INTO `detalle_ordenes` (`id`, `orden_id`, `producto_id`, `cantidad`, `precio`, `iva`, `retencion`, `proveedor`, `descripcion`) VALUES
(12, 2, 2, '222', '3333', '19', '2', 7, 'Se debe realizar un cableado tipo c'),
(13, 2, 1, '20', '45000', '19', '0', 4, NULL),
(16, 4, 2, '4', '25000', '19', '0', 15, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_precios`
--

CREATE TABLE `detalle_precios` (
  `id` int(11) NOT NULL,
  `precio_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_requerida` int(11) NOT NULL DEFAULT 0,
  `cantidad_disponible` int(11) NOT NULL DEFAULT 0,
  `precio` varchar(255) DEFAULT '0',
  `descuento` varchar(255) DEFAULT '0',
  `iva` varchar(255) NOT NULL DEFAULT '0',
  `nota` text DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reparaciones`
--

CREATE TABLE `detalle_reparaciones` (
  `id` int(11) NOT NULL,
  `reparacion_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `encargado_id` int(11) NOT NULL,
  `accesorios` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detelle_remisiones`
--

CREATE TABLE `detelle_remisiones` (
  `id` int(11) NOT NULL,
  `remision_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detelle_remisiones`
--

INSERT INTO `detelle_remisiones` (`id`, `remision_id`, `producto_id`, `cantidad`, `descripcion`) VALUES
(9, 3, 2, 2, NULL),
(10, 14, 1, 2, NULL),
(11, 14, 3, 3, NULL),
(12, 16, 1, 1, NULL),
(13, 17, 1, 1, NULL),
(14, 18, 1, 12, NULL),
(15, 19, 1, 1, NULL),
(16, 20, 1, 11, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `codigo_empleado` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono_fijo` varchar(20) DEFAULT NULL,
  `telefono_celular` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `eps` varchar(50) DEFAULT NULL,
  `caja_compensacion` varchar(50) DEFAULT NULL,
  `arl` varchar(50) DEFAULT NULL,
  `fondo_pension` varchar(50) DEFAULT NULL,
  `periodo_vacaciones` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `prestamo` int(11) DEFAULT NULL,
  `periodo_dotacion` text DEFAULT NULL,
  `numero_licencia_conduccion` varchar(50) DEFAULT NULL,
  `vencimiento_licencia_conduccion` date DEFAULT NULL,
  `multas_transito_pendiente` int(11) DEFAULT NULL,
  `implementos_seguridad` text DEFAULT NULL,
  `riesgos_profesionales` int(11) DEFAULT NULL,
  `culminacion_contrato` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `licencia_conduccion_moto` varchar(100) DEFAULT NULL,
  `vencimiento_licencia_moto` varchar(100) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `codigo_empleado`, `nombre`, `cargo`, `password`, `rol`, `email`, `telefono_fijo`, `telefono_celular`, `direccion`, `fecha_ingreso`, `fecha_retiro`, `avatar`, `fecha_nacimiento`, `eps`, `caja_compensacion`, `arl`, `fondo_pension`, `periodo_vacaciones`, `observaciones`, `prestamo`, `periodo_dotacion`, `numero_licencia_conduccion`, `vencimiento_licencia_conduccion`, `multas_transito_pendiente`, `implementos_seguridad`, `riesgos_profesionales`, `culminacion_contrato`, `status`, `licencia_conduccion_moto`, `vencimiento_licencia_moto`, `puntos`) VALUES
(1, '1001437547', 'Santiago Smith', 'Desarrollador', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 7, 'smith@gmail.com', '6164046', '3164693321', '', '2022-02-08', '0000-00-00', '61c999645d93b18961967f7329a66a1f.png', '2022-02-02', 'Sura', 'Sura', 'Sura', 'Sura', '01/2019 a 04/2019', 'sin observaciones', 0, '01/2019 a 05/2019', '16136136136', '0000-00-00', 0, '20834302', 5, '0000-00-00', 1, '', '', 0),
(6, '98518213', 'Oscar Sanchez', 'Tecnico', '$2y$10$oQC8r3bJ5L/dgQLJ1KblBehbGg1Qm/Khh9IB4Lz6HyAISliJ2K0eq', 9, 'gcomercial@radioenlacesas.com', '1654654', '3116307079', 'Calle 47 # 34 - 52 Interior 202\r\nBarrio Buenos Aires', '2022-02-02', '0000-00-00', '90aa9b94eb827928359be427685ed8a7.png', '1966-09-07', 'Sura', 'Comfama', 'Sura', 'Protección', '135135', '135135', 0, '01/2019 a 05/2019', '16136136136', '2022-02-08', 0, '135135', 3, '0000-00-00', 1, '', '', 0),
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
-- Estructura de tabla para la tabla `factura_compra`
--

CREATE TABLE `factura_compra` (
  `id` int(11) NOT NULL,
  `favorito` int(1) NOT NULL DEFAULT 0,
  `token` text DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `centro_costo` int(11) NOT NULL,
  `fecha_elaboracion` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL,
  `factura_proveedor` varchar(255) NOT NULL,
  `num_factura_proveedor` int(11) NOT NULL,
  `total_bruto` varchar(255) DEFAULT NULL,
  `descuentos` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `impuestos_1` text DEFAULT NULL,
  `impuestos_2` text DEFAULT NULL,
  `valor_total` varchar(255) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `adjunto_pdf` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura_compra`
--

INSERT INTO `factura_compra` (`id`, `favorito`, `token`, `numero`, `tipo`, `centro_costo`, `fecha_elaboracion`, `fecha_vencimiento`, `proveedor_id`, `factura_proveedor`, `num_factura_proveedor`, `total_bruto`, `descuentos`, `subtotal`, `impuestos_1`, `impuestos_2`, `valor_total`, `observaciones`, `adjunto_pdf`, `status`, `created_at`, `created_by`) VALUES
(1154, 0, NULL, 1, 1, 17, '2023-04-29', '2023-05-29', 26, 'FE', 13831, '777.731,00', '0,00', '777.731,00', '[[\"IVA 19%\",25493]]', '[]', '777.731,00', 'Combustibles y lubricantes', NULL, 1, '2023-05-16 17:01:14', 1),
(1155, 0, NULL, 2, 1, 6, '2023-04-27', '2023-05-27', 106, 'PARK', 752, '129.900,00', '0,00', '129.900,00', '[]', '[]', '129.900,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:15', 1),
(1156, 0, NULL, 3, 1, 6, '2023-04-25', '2023-05-25', 137, 'FEMF', 16978, '433.613,00', '0,00', '433.613,00', '[[\"IVA 19%\",98039]]', '[]', '515.999,00', 'Servicio y Mantenimiento preventivo de equipos de', NULL, 1, '2023-05-16 17:01:15', 1),
(1157, 0, NULL, 4, 1, 6, '2023-04-18', '2023-05-18', 165, 'FE', 18482, '124.871,00', '0,00', '124.871,00', '[]', '[]', '133.952,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:15', 1),
(1158, 0, NULL, 5, 1, 5, '2023-04-24', '2023-05-24', 176, 'BOPU', 63346970, '83.080,00', '0,00', '83.080,00', '[]', '[]', '83.080,00', 'Servicios públicos - Teléfono', NULL, 1, '2023-05-16 17:01:15', 1),
(1159, 0, NULL, 6, 1, 5, '2023-04-24', '2023-05-24', 118, 'F661', 30305, '83.950,00', '0,00', '83.950,00', '[[\"IVA 19%\",18981]]', '[]', '99.901,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:16', 1),
(1160, 0, NULL, 7, 1, 6, '2023-04-25', '2023-05-25', 134, 'ARK', 6510, '209.959,00', '0,00', '209.959,00', '[]', '[]', '209.959,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:16', 1),
(1161, 0, NULL, 8, 1, 5, '2023-04-27', '2023-05-27', 176, 'BOPU', 63490752, '162.381,00', '0,00', '162.381,00', '[]', '[]', '162.381,00', 'INTERNET', NULL, 1, '2023-05-16 17:01:16', 1),
(1162, 0, NULL, 9, 1, 16, '2023-04-26', '2023-05-26', 110, 'FE', 1065, '39.931,00', '0,00', '39.931,00', '[]', '[]', '39.931,00', 'Combustibles y lubricantes', NULL, 1, '2023-05-16 17:01:16', 1),
(1163, 0, NULL, 10, 1, 16, '2023-04-21', '2023-05-21', 85, '133', 4554935, '272.020,00', '0,00', '272.020,00', '[]', '[]', '272.020,00', 'Servicios públicos - Energía eléctrica', NULL, 1, '2023-05-16 17:01:16', 1),
(1164, 0, NULL, 11, 1, 17, '2023-04-27', '2023-05-27', 172, 'FEPS', 5018, '40.336,00', '0,00', '40.336,00', '[[\"IVA 19%\",9120]]', '[]', '48.000,00', 'Otros', NULL, 1, '2023-05-16 17:01:17', 1),
(1165, 0, NULL, 12, 1, 6, '2023-04-27', '2023-05-27', 167, 'F248', 231, '46.517,00', '0,00', '46.517,00', '[[\"IVA 5%\",2442]]', '[]', '48.843,00', 'Elementos de aseo y cafetería', NULL, 1, '2023-05-16 17:01:17', 1),
(1166, 0, NULL, 13, 1, 15, '2023-04-28', '2023-05-28', 33, 'CBEL', 5274, '1.639.643,00', '0,00', '1.639.643,00', '[]', '[]', '1.638.003,00', 'Combustibles y lubricantes', NULL, 1, '2023-05-16 17:01:17', 1),
(1167, 0, NULL, 14, 1, 16, '2023-04-25', '2023-05-25', 142, 'FEL', 606, '31.480,00', '0,00', '31.480,00', '[]', '[]', '33.998,00', 'Alojamiento En viaticos', NULL, 1, '2023-05-16 17:01:17', 1),
(1168, 0, NULL, 15, 1, 16, '2023-04-25', '2023-05-25', 117, 'PO', 6749, '60.037,00', '0,00', '60.037,00', '[]', '[]', '60.037,00', 'Combustibles y lubricantes', NULL, 1, '2023-05-16 17:01:17', 1),
(1169, 0, NULL, 16, 1, 17, '2023-04-17', '2023-05-17', 19, 'EN', 2035, '3.844.925,00', '0,00', '3.844.925,00', '[[\"IVA 19%\",1178],[\"IVA 19%\",5281]]', '[]', '3.844.925,00', 'Combustible liquido', NULL, 1, '2023-05-16 17:01:18', 1),
(1170, 0, NULL, 17, 1, 16, '2023-04-18', '2023-05-18', 85, '133', 8335, '0,00', '0,00', '0,00', '[]', '[]', '0,00', 'Servicios públicos - Energía eléctrica', NULL, 1, '2023-05-16 17:01:18', 1),
(1171, 0, NULL, 18, 1, 5, '2023-04-25', '2023-05-25', 18, 'MTF1', 1465, '20.000,00', '0,00', '20.000,00', '[]', '[]', '20.000,00', 'Reparaciones locativas', NULL, 1, '2023-05-16 17:01:18', 1),
(1172, 0, NULL, 19, 1, 16, '2023-04-23', '2023-05-23', 117, 'PO', 6590, '88.341,00', '0,00', '88.341,00', '[]', '[]', '88.341,00', 'Combustibles y lubricantes', NULL, 1, '2023-05-16 17:01:18', 1),
(1173, 0, NULL, 20, 1, 6, '2023-04-26', '2023-05-26', 140, 'LB', 13870, '364.990,00', '0,00', '364.990,00', '[]', '[]', '364.990,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:18', 1),
(1174, 0, NULL, 21, 1, 6, '2023-04-27', '2023-05-27', 155, 'EWA', 870, '137.602,00', '0,00', '137.602,00', '[]', '[]', '147.609,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:19', 1),
(1175, 0, NULL, 22, 1, 16, '2023-04-24', '2023-05-24', 116, 'FV', 374, '11.111,00', '0,00', '11.111,00', '[]', '[]', '12.000,00', 'Alimentacion en Viaticos', NULL, 1, '2023-05-16 17:01:19', 1),
(1176, 0, NULL, 23, 1, 6, '2023-04-22', '2023-05-22', 126, 'Q58', 2792, '49.537,00', '0,00', '49.537,00', '[]', '[]', '53.499,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:19', 1),
(1177, 0, NULL, 24, 1, 16, '2023-04-22', '2023-05-22', 136, 'FE', 12192, '21.849,00', '0,00', '21.849,00', '[[\"IVA 19%\",4940]]', '[]', '26.000,00', 'Otros', NULL, 1, '2023-05-16 17:01:19', 1),
(1178, 0, NULL, 25, 1, 5, '2023-04-19', '2023-05-19', 171, '1012', 1282072, '694.976,00', '0,00', '694.976,00', '[[\"IVA 19%\",157133]]', '[]', '827.021,00', 'Cumplimiento', NULL, 1, '2023-05-16 17:01:19', 1),
(1179, 0, NULL, 26, 1, 5, '2023-04-25', '2023-05-25', 120, 'TPVA', 11101, '26.714,00', '0,00', '26.714,00', '[[\"IVA 5%\",1402],[\"IVA 19%\",2185]]', '[]', '28.050,00', 'Elementos de aseo y cafetería', NULL, 1, '2023-05-16 17:01:20', 1),
(1180, 0, NULL, 27, 1, 17, '2023-04-26', '2023-05-26', 135, 'GV', 1541, '8.865.546,00', '0,00', '8.865.546,00', '[[\"IVA 19%\",1937121]]', '[]', '10.195.378,00', 'Asistencia preventiva vehicular', NULL, 1, '2023-05-16 17:01:20', 1),
(1181, 0, NULL, 28, 1, 17, '2023-04-29', '2023-05-29', 26, 'FE', 13831, '112.755,00', '0,00', '112.755,00', '[[\"IVA 19%\",25493]]', '[]', '134.178,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:20', 1),
(1182, 0, NULL, 29, 1, 17, '2023-04-19', '2023-05-19', 23, 'FE', 819, '156.302,00', '0,00', '156.302,00', '[[\"IVA 19%\",35339]]', '[]', '185.999,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:20', 1),
(1183, 0, NULL, 30, 1, 5, '2023-04-17', '2023-05-17', 151, 'KSNR', 6394806, '13.200,00', '0,00', '13.200,00', '[[\"IVA 19%\",1595]]', '[]', '13.200,00', 'Notariales', NULL, 1, '2023-05-16 17:01:20', 1),
(1184, 0, NULL, 31, 1, 6, '2023-04-23', '2023-05-23', 131, 'F', 280633, '220.000,00', '0,00', '220.000,00', '[]', '[]', '220.000,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:21', 1),
(1185, 0, NULL, 32, 1, 5, '2023-04-25', '2023-05-25', 139, 'PJ', 1029693, '13.500,00', '0,00', '13.500,00', '[]', '[]', '13.500,00', 'Transporte fletes y acarreos', NULL, 1, '2023-05-16 17:01:21', 1),
(1186, 0, NULL, 33, 1, 17, '2023-04-18', '2023-05-18', 12, 'FT1E', 110494, '13.884.470,00', '0,00', '13.884.470,00', '[[\"IVA 19%\",3073327]]', '[]', '16.175.407,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:21', 1),
(1187, 0, NULL, 34, 1, 5, '2023-04-26', '2023-05-26', 39, '4307', 10022854, '676.470,00', '0,00', '676.470,00', '[[\"IVA 19%\",152949]]', '[]', '804.999,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:21', 1),
(1188, 0, NULL, 35, 1, 16, '2023-04-20', '2023-05-20', 11, 'AM', 2040, '920.919,00', '0,00', '920.919,00', '[[\"IVA 19%\",208219]]', '[]', '1.095.894,00', 'Arrend/espacios/cerros', NULL, 1, '2023-05-16 17:01:21', 1),
(1189, 0, NULL, 36, 1, 6, '2023-04-20', '2023-05-20', 107, 'FE', 1719, '273.148,00', '0,00', '273.148,00', '[]', '[]', '294.999,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:22', 1),
(1190, 0, NULL, 37, 1, 16, '2023-04-19', '2023-05-19', 44, 'FET', 69945, '4800,00', '0,00', '4800,00', '[[\"IVA 19%\",1085]]', '[]', '5712,00', 'Materiales, repuestos y accesorios', NULL, 1, '2023-05-16 17:01:22', 1),
(1191, 0, NULL, 38, 1, 5, '2023-04-26', '2023-05-26', 150, 'A0C', 1346, '14.907,00', '0,00', '14.907,00', '[[\"IVA 19%\",3370]]', '[]', '17.739,00', 'Elementos de aseo y cafetería', NULL, 1, '2023-05-16 17:01:22', 1),
(1192, 0, NULL, 39, 1, 6, '2023-04-25', '2023-05-25', 125, '36FE', 1358, '75.952,00', '0,00', '75.952,00', '[]', '[]', '75.952,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:22', 1),
(1193, 0, NULL, 40, 1, 17, '2023-04-17', '2023-05-17', 19, 'EN', 2035, '5210,00', '0,00', '5210,00', '[[\"IVA 19%\",1178],[\"IVA 19%\",5281]]', '[]', '6200,00', 'Otros', NULL, 1, '2023-05-16 17:01:22', 1),
(1194, 0, NULL, 41, 1, 6, '2023-04-26', '2023-05-26', 154, 'PM', 9337, '20.925,00', '0,00', '20.925,00', '[]', '[]', '22.599,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:23', 1),
(1195, 0, NULL, 42, 1, 15, '2023-04-26', '2023-05-26', 22, 'E', 1256, '394.957,00', '0,00', '394.957,00', '[[\"IVA 19%\",89299]]', '[]', '469.999,00', 'Mantenimiento , reparacion Vehiculos', NULL, 1, '2023-05-16 17:01:23', 1),
(1196, 0, NULL, 43, 1, 17, '2023-04-29', '2023-05-29', 26, 'FE', 13821, '62.511,00', '0,00', '62.511,00', '[[\"IVA 19%\",14133]]', '[]', '74.388,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:23', 1),
(1198, 0, NULL, 44, 1, 5, '2023-04-25', '2023-05-25', 118, 'FW23', 15800, '77.983,00', '0,00', '77.983,00', '[[\"IVA 19%\",17632]]', '[]', '92.800,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:23', 1),
(1199, 0, NULL, 45, 1, 12, '2023-04-28', '2023-05-28', 44, 'FET', 68935, '9000,00', '0,00', '9000,00', '[[\"IVA 19%\",2034]]', '[]', '10.710,00', 'Materiales, repuestos y accesorios', NULL, 1, '2023-05-16 17:01:23', 1),
(1200, 0, NULL, 46, 1, 10, '2023-04-27', '2023-05-27', 4, 'FE', 9733, '821.595,00', '0,00', '821.595,00', '[[\"IVA 19%\",185762]]', '[]', '977.698,00', 'Materiales, repuestos y accesorios ANTENAS', NULL, 1, '2023-05-16 17:01:24', 1),
(1202, 0, NULL, 47, 1, 5, '2023-04-21', '2023-05-21', 39, '4306', 100214533, '25.966,00', '0,00', '25.966,00', '[[\"IVA 19%\",5871]]', '[]', '30.900,00', 'Reparaciones locativas', NULL, 1, '2023-05-16 17:01:24', 1),
(1203, 0, NULL, 48, 1, 15, '2023-04-24', '2023-05-24', 22, 'E', 1250, '201.680,00', '0,00', '201.680,00', '[[\"IVA 19%\",45599]]', '[]', '239.999,00', 'Mantenimiento , reparacion Vehiculos', NULL, 1, '2023-05-16 17:01:24', 1),
(1204, 0, NULL, 49, 1, 6, '2023-04-27', '2023-05-27', 121, 'GJ0', 970149, '120.190,00', '0,00', '120.190,00', '[]', '[]', '120.190,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:24', 1),
(1205, 0, NULL, 50, 1, 6, '2023-04-24', '2023-05-24', 127, 'AM', 363642, '3.125.958,00', '0,00', '3.125.958,00', '[[\"IVA 19%\",706779]]', '[]', '3.719.890,00', 'Equipos oficina', NULL, 1, '2023-05-16 17:01:25', 1),
(1206, 0, NULL, 51, 1, 6, '2023-04-26', '2023-05-26', 141, 'FC', 116896, '178.599,00', '0,00', '178.599,00', '[]', '[]', '178.599,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:25', 1),
(1207, 0, NULL, 52, 1, 5, '2023-04-26', '2023-05-26', 39, '4307', 100228585, '468.823,00', '0,00', '468.823,00', '[[\"IVA 19%\",106000]]', '[]', '557.899,00', 'Elementos de aseo y cafetería', NULL, 1, '2023-05-16 17:01:25', 1),
(1208, 0, NULL, 53, 1, 5, '2023-04-18', '2023-05-18', 176, 'BOPU', 62324908, '27.455,00', '0,00', '27.455,00', '[]', '[]', '27.455,00', 'INTERNET', NULL, 1, '2023-05-16 17:01:25', 1),
(1209, 0, NULL, 54, 1, 6, '2023-04-27', '2023-05-27', 123, 'E227', 2360, '93.965,00', '0,00', '93.965,00', '[]', '[]', '93.965,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:25', 1),
(1210, 0, NULL, 55, 1, 16, '2023-04-30', '2023-05-30', 116, 'FV', 374, '11.111,00', '0,00', '11.111,00', '[[\"Impoconsumo 8%\",960]]', '[]', '12.000,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:26', 1),
(1211, 0, NULL, 56, 1, 17, '2023-04-18', '2023-05-18', 12, 'FT1E', 110494, '0,00', '0,00', '0,00', '[[\"IVA 19%\",3073327]]', '[]', '0,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:26', 1),
(1212, 0, NULL, 57, 1, 6, '2023-04-27', '2023-05-27', 123, 'E277', 2361, '14.530,00', '0,00', '14.530,00', '[]', '[]', '14.530,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:26', 1),
(1213, 0, NULL, 58, 1, 6, '2023-04-25', '2023-05-25', 156, 'MAPA', 25227, '239.861,00', '0,00', '239.861,00', '[]', '[]', '239.861,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:26', 1),
(1214, 0, NULL, 59, 1, 5, '2023-04-26', '2023-05-26', 112, 'REME', 1976362, '7200,00', '0,00', '7200,00', '[]', '[]', '7200,00', 'Registro mercantil', NULL, 1, '2023-05-16 17:01:26', 1),
(1215, 0, NULL, 60, 1, 5, '2023-04-17', '2023-05-17', 151, 'KSNR', 6394806, '27.600,00', '0,00', '27.600,00', '[]', '[]', '27.600,00', 'Tramites y licencias', NULL, 1, '2023-05-16 17:01:27', 1),
(1216, 0, NULL, 61, 1, 16, '2023-04-21', '2023-05-21', 142, 'FEL', 595, '403.361,00', '0,00', '403.361,00', '[]', '[]', '479.999,00', 'Alojamiento En viaticos', NULL, 1, '2023-05-16 17:01:27', 1),
(1217, 0, NULL, 62, 1, 5, '2023-04-26', '2023-05-26', 109, 'DY', 59583, '40.546,00', '0,00', '40.546,00', '[[\"IVA 19%\",9167]]', '[]', '48.250,00', 'Útiles papelería y fotocopias', NULL, 1, '2023-05-16 17:01:27', 1),
(1218, 0, NULL, 63, 1, 5, '2023-04-24', '2023-05-24', 176, 'BOPU', 63336204, '209.635,00', '0,00', '209.635,00', '[]', '[]', '209.635,00', 'INTERNET', NULL, 1, '2023-05-16 17:01:27', 1),
(1219, 0, NULL, 64, 1, 10, '2023-04-27', '2023-05-27', 4, 'FE', 9738, '286.215,00', '0,00', '286.215,00', '[[\"IVA 19%\",64713]]', '[]', '340.596,00', 'Materiales, repuestos y accesorios', NULL, 1, '2023-05-16 17:01:27', 1),
(1220, 0, NULL, 65, 1, 16, '2023-04-19', '2023-05-19', 7, 'FC', 365329, '39.400,00', '0,00', '39.400,00', '[[\"IVA 19%\",8908]]', '[]', '46.886,00', 'Materiales, repuestos y accesorios', NULL, 1, '2023-05-16 17:01:28', 1),
(1221, 0, NULL, 66, 1, 8, '2023-04-21', '2023-05-21', 4, 'FE', 9662, '1.155.665,00', '0,00', '1.155.665,00', '[[\"IVA 19%\",255806]]', '[]', '1.346.349,00', 'Materiales, repuestos y accesorios', NULL, 1, '2023-05-16 17:01:28', 1),
(1222, 0, NULL, 67, 1, 17, '2023-04-20', '2023-05-20', 26, 'FE', 13711, '412.776,00', '0,00', '412.776,00', '[[\"IVA 19%\",93328]]', '[]', '491.203,00', 'Mantenimiento , reparacion y lavada de vehiculo au', NULL, 1, '2023-05-16 17:01:28', 1),
(1223, 0, NULL, 68, 1, 16, '2023-04-25', '2023-05-25', 116, 'FV', 393, '11.111,00', '0,00', '11.111,00', '[]', '[]', '12.000,00', 'Alimentacion en Viaticos', NULL, 1, '2023-05-16 17:01:28', 1),
(1224, 0, NULL, 69, 1, 15, '2023-04-20', '2023-05-20', 157, 'E', 6723, '85.714,00', '0,00', '85.714,00', '[[\"IVA 19%\",19380]]', '[]', '102.000,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:29', 1),
(1225, 0, NULL, 70, 1, 6, '2023-04-25', '2023-05-25', 152, 'F', 75701, '183.300,00', '0,00', '183.300,00', '[]', '[]', '183.300,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:29', 1),
(1226, 0, NULL, 71, 1, 16, '2023-04-25', '2023-05-25', 133, 'FE', 175, '286.797,00', '0,00', '286.797,00', '[[\"IVA 19%\",64844]]', '[]', '341.288,00', 'COMPRA DE CEMENTO', NULL, 1, '2023-05-16 17:01:29', 1),
(1227, 0, NULL, 72, 1, 5, '2023-04-25', '2023-05-25', 118, 'FW23', 15801, '116.723,00', '0,00', '116.723,00', '[[\"IVA 19%\",26391]]', '[]', '138.900,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:29', 1),
(1228, 0, NULL, 73, 1, 17, '2023-04-17', '2023-05-17', 168, 'RM', 19396, '1.042.016,00', '0,00', '1.042.016,00', '[[\"IVA 19%\",227680]]', '[]', '1.198.318,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:29', 1),
(1230, 0, NULL, 74, 1, 6, '2023-04-25', '2023-05-25', 127, 'AM', 220203, '215.933,00', '0,00', '215.933,00', '[[\"IVA 19%\",48822]]', '[]', '256.960,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:30', 1),
(1232, 0, NULL, 75, 1, 5, '2023-04-19', '2023-05-19', 84, 'E', 978681, '21.197,00', '0,00', '21.197,00', '[]', '[]', '21.197,00', 'Servicios públicos - Teléfono', NULL, 1, '2023-05-16 17:01:30', 1),
(1233, 0, NULL, 76, 1, 16, '2023-04-25', '2023-05-25', 133, 'FE', 176, '95.560,00', '0,00', '95.560,00', '[[\"IVA 19%\",21606]]', '[]', '113.716,00', 'COMPRA DE CEMENTO', NULL, 1, '2023-05-16 17:01:30', 1),
(1234, 0, NULL, 77, 1, 5, '2023-04-24', '2023-05-24', 118, 'FE23', 15778, '501.176,00', '0,00', '501.176,00', '[[\"IVA 19%\",113315]]', '[]', '596.399,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:30', 1),
(1235, 0, NULL, 78, 1, 6, '2023-04-25', '2023-05-25', 159, 'VCFU', 3862, '249.900,00', '0,00', '249.900,00', '[]', '[]', '249.900,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:31', 1),
(1237, 0, NULL, 79, 1, 15, '2023-04-26', '2023-05-26', 157, 'E', 6760, '117.000,00', '0,00', '117.000,00', '[[\"IVA 19%\",3799]]', '[]', '117.000,00', 'Lubricantes y aditivos', NULL, 1, '2023-05-16 17:01:31', 1),
(1238, 0, NULL, 80, 1, 5, '2023-04-24', '2023-05-24', 118, '0W23', 1401, '98.235,00', '0,00', '98.235,00', '[[\"IVA 19%\",22211]]', '[]', '116.900,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:32', 1),
(1239, 0, NULL, 81, 1, 16, '2023-04-26', '2023-05-26', 145, 'EDS', 388, '102.942,00', '0,00', '102.942,00', '[]', '[]', '102.942,00', 'Combustible liquido', NULL, 1, '2023-05-16 17:01:32', 1),
(1240, 0, NULL, 82, 1, 5, '2023-04-27', '2023-05-27', 111, 'MAC', 1497, '97.800,00', '0,00', '97.800,00', '[]', '[]', '97.800,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:32', 1),
(1241, 0, NULL, 83, 1, 6, '2023-04-25', '2023-05-25', 159, 'VCFU', 3862, '249.900,00', '0,00', '249.900,00', '[]', '[]', '249.900,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:32', 1),
(1243, 0, NULL, 84, 1, 5, '2023-04-25', '2023-05-25', 160, 'E', 62, '37.647,00', '0,00', '37.647,00', '[[\"IVA 19%\",8512]]', '[]', '44.800,00', 'Equipos oficina', NULL, 1, '2023-05-16 17:01:33', 1),
(1244, 0, NULL, 85, 1, 6, '2023-04-26', '2023-05-26', 140, 'LB', 13871, '235.980,00', '0,00', '235.980,00', '[]', '[]', '235.980,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:33', 1),
(1245, 0, NULL, 86, 1, 6, '2023-04-27', '2023-05-27', 164, 'TMFF', 3314, '192.900,00', '0,00', '192.900,00', '[]', '[]', '192.900,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:33', 1),
(1246, 0, NULL, 87, 1, 5, '2023-04-24', '2023-05-24', 176, 'BOPU', 63348088, '161.955,00', '0,00', '161.955,00', '[]', '[]', '161.955,00', 'INTERNET', NULL, 1, '2023-05-16 17:01:33', 1),
(1247, 0, NULL, 88, 1, 5, '2023-04-25', '2023-05-25', 18, 'MTF1', 1464, '430.000,00', '0,00', '430.000,00', '[]', '[]', '430.000,00', 'Reparaciones locativas', NULL, 1, '2023-05-16 17:01:33', 1),
(1248, 0, NULL, 89, 1, 6, '2023-04-27', '2023-05-27', 156, 'MAPA', 25250, '25.900,00', '0,00', '25.900,00', '[]', '[]', '25.900,00', 'Costos y gastos no deducibles', NULL, 1, '2023-05-16 17:01:34', 1),
(1249, 0, NULL, 90, 1, 6, '2023-04-27', '2023-05-27', 119, 'FE', 60143185, '638.402,00', '0,00', '638.402,00', '[[\"IVA 19%\",144342]]', '[]', '759.698,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:34', 1),
(1250, 0, NULL, 91, 1, 16, '2023-04-22', '2023-05-22', 129, 'FVE', 1741, '42.016,00', '0,00', '42.016,00', '[[\"IVA 19%\",9499]]', '[]', '49.999,00', 'Otros', NULL, 1, '2023-05-16 17:01:34', 1),
(1251, 0, NULL, 92, 1, 8, '2023-04-19', '2023-05-19', 114, 'BRT', 325, '588.235,00', '0,00', '588.235,00', '[[\"IVA 19%\",133000]]', '[]', '700.000,00', 'Materiales, repuestos y accesorios', NULL, 1, '2023-05-16 17:01:34', 1),
(1252, 0, NULL, 93, 1, 6, '2023-04-17', '2023-05-17', 109, 'FJ', 726, '26.680,00', '0,00', '26.680,00', '[]', '[]', '28.494,00', 'Casino y restaurante', NULL, 1, '2023-05-16 17:01:34', 1),
(1253, 0, NULL, 94, 1, 5, '2023-04-24', '2023-05-24', 118, '0W23', 1400, '190.588,00', '0,00', '190.588,00', '[[\"IVA 19%\",43092]]', '[]', '226.800,00', 'Dotación y suministro a trabajadores', NULL, 1, '2023-05-16 17:01:35', 1),
(1254, 0, NULL, 95, 1, 16, '2023-04-20', '2023-05-20', 85, '133', 4500646, '1.207.774,00', '0,00', '1.207.774,00', '[]', '[]', '1.207.774,00', 'Servicios públicos - Energía eléctrica', NULL, 1, '2023-05-16 17:01:35', 1),
(1255, 0, NULL, 96, 1, 17, '2023-04-17', '2023-05-17', 19, 'EN', 2035, '23.360,00', '0,00', '23.360,00', '[[\"IVA 19%\",1178],[\"IVA 19%\",5281]]', '[]', '27.798,00', 'Otros', NULL, 1, '2023-05-16 17:01:35', 1),
(1256, 0, NULL, 97, 1, 17, '2023-04-27', '2023-05-27', 39, '4303', 100212531, '323.529,00', '0,00', '323.529,00', '[[\"IVA 19%\",73150]]', '[]', '385.000,00', 'Otros', NULL, 1, '2023-05-16 17:01:35', 1),
(1257, 0, NULL, 98, 1, 16, '2023-04-30', '2023-05-30', 173, 'FC', 359575, '50.000,00', '0,00', '50.000,00', '[]', '[]', '50.000,00', 'Combustibles y lubricantes', NULL, 1, '2023-05-16 17:01:36', 1),
(1258, 0, NULL, 99, 1, 5, '2023-04-17', '2023-05-17', 151, 'KSNR', 6394806, '7058,00', '0,00', '7058,00', '[[\"IVA 19%\",1595]]', '[]', '8399,00', 'Notariales', NULL, 1, '2023-05-16 17:01:36', 1),
(1259, 0, NULL, 100, 1, 5, '2023-04-25', '2023-05-25', 120, 'TPVA', 11101, '15.074,00', '0,00', '15.074,00', '[[\"IVA 5%\",1402],[\"IVA 19%\",2185]]', '[]', '15.074,00', 'Elementos de aseo y cafetería', NULL, 1, '2023-05-16 17:01:36', 1),
(1260, 0, NULL, 101, 1, 5, '2023-04-26', '2023-05-26', 109, 'DY', 59583, '21.990,00', '0,00', '21.990,00', '[[\"IVA 19%\",9167]]', '[]', '21.990,00', 'Útiles papelería y fotocopias', NULL, 1, '2023-05-16 17:01:36', 1),
(1262, 0, NULL, 102, 1, 16, '2023-04-25', '2023-05-25', 142, 'FEL', 599, '201.680,00', '0,00', '201.680,00', '[]', '[]', '239.999,00', 'Alojamiento En viaticos', NULL, 1, '2023-05-16 17:01:37', 1),
(1264, 0, NULL, 103, 1, 15, '2023-04-26', '2023-05-26', 157, 'E', 6760, '16.806,00', '0,00', '16.806,00', '[[\"IVA 19%\",3799]]', '[]', '19.999,00', 'Repuestos vehiculos', NULL, 1, '2023-05-16 17:01:37', 1),
(1267, 0, NULL, 104, 1, 15, '2023-04-20', '2023-05-20', 157, 'E', 6723, '150.000,00', '0,00', '150.000,00', '[[\"IVA 19%\",19380]]', '[]', '150.000,00', 'Lubricantes y aditivos', NULL, 1, '2023-05-16 17:01:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_venta`
--

CREATE TABLE `factura_venta` (
  `id` int(11) NOT NULL,
  `favorito` int(1) NOT NULL DEFAULT 0,
  `token` text DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1,
  `fecha_elaboracion` date NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `vendedor_id` int(11) NOT NULL,
  `total_bruto` varchar(255) DEFAULT NULL,
  `descuentos` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `impuestos_1` text DEFAULT NULL,
  `impuestos_2` text DEFAULT NULL,
  `valor_total` varchar(255) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `adjunto_pdf` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura_venta`
--

INSERT INTO `factura_venta` (`id`, `favorito`, `token`, `numero`, `tipo`, `fecha_elaboracion`, `cliente_id`, `vendedor_id`, `total_bruto`, `descuentos`, `subtotal`, `impuestos_1`, `impuestos_2`, `valor_total`, `observaciones`, `adjunto_pdf`, `status`, `created_at`, `created_by`) VALUES
(7, 0, NULL, 1, 1, '2023-05-16', 13, 1, '4.100.000,00', '0,00', '4.100.000,00', '[[\"IVA 19%\",779000]]', '[]', '4.879.000,00', 'gg', NULL, 1, '2023-05-16 11:22:24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pago`
--

CREATE TABLE `formas_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formas_pago`
--

INSERT INTO `formas_pago` (`id`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(1, 'Transferencia', 1, 1, '2023-02-22 18:11:00'),
(2, 'Efectivo', 1, 1, '2023-02-22 18:11:00'),
(3, 'Tarjeta Débito', 1, 1, '2023-02-22 18:11:00'),
(4, 'Tarjeta Crédito', 1, 1, '2023-02-22 18:11:00'),
(5, 'Crédito Proveedores', 1, 1, '2023-02-22 18:11:00'),
(6, 'PSE', 1, 1, '2023-02-22 18:11:00'),
(7, '1111', 0, 1, '2023-02-22 22:11:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_prospectos`
--

CREATE TABLE `historial_prospectos` (
  `id` int(11) NOT NULL,
  `prospecto_id` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_prospectos`
--

INSERT INTO `historial_prospectos` (`id`, `prospecto_id`, `observacion`, `created_by`, `created_at`) VALUES
(2, 5801, 'Casa', 1, '2023-02-27 14:56:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_cotizaciones`
--

CREATE TABLE `history_cotizaciones` (
  `id` int(11) NOT NULL,
  `cotizacion_id` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `history_cotizaciones`
--

INSERT INTO `history_cotizaciones` (`id`, `cotizacion_id`, `observacion`, `created_by`, `created_at`) VALUES
(1, 4, 'Muy biuenoasdasdasdsa Muy biuenoasdasdasdsa Muy biuenoasdasdasdsa Muy biuenoasdasdasdsa Muy biuenoasdasdasdsa', 1, '2023-02-15 22:24:24'),
(3, 4, 'asdasasdasdsadasdasdasd', 1, '2023-02-15 16:59:11'),
(4, 4, 'asdassasad', 1, '2023-02-15 16:59:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `codigo_interno` varchar(255) DEFAULT NULL,
  `serial` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto_id`, `codigo_interno`, `serial`, `cantidad`, `status`, `created_by`, `created_at`) VALUES
(15, 1, '051051', '051051', 0, 0, 1, '2023-04-13 14:30:02'),
(16, 1, '0444444', '05050', 0, 0, 1, '2023-04-13 14:30:32'),
(17, 1, 'asd', 'addddd', 0, 0, 1, '2023-05-05 07:53:13'),
(18, 1, '9999', '99999', 0, 0, 1, '2023-05-05 07:57:31'),
(19, 1, '1111', '111', 1, 1, 1, '2023-05-05 08:06:11'),
(20, 1, '111ee', '111ee', 1, 1, 1, '2023-05-09 15:25:22');

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
(57, 0, 15, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-13 14:30:02'),
(58, 0, 16, 283, 1, NULL, NULL, NULL, '12000', NULL, NULL, 1, '2023-04-13 14:30:32'),
(59, 1, 16, 286, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-13 14:30:53'),
(60, 3, 16, 282, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-13 14:33:11'),
(61, 5, 16, 284, 1, NULL, 67, NULL, NULL, NULL, NULL, 1, '2023-04-13 14:33:38'),
(62, 1, 16, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-13 14:33:58'),
(63, 2, 16, 283, 1, NULL, 16, NULL, NULL, NULL, 'Producto asignado a la solicitud de inventario con código: SOL-YMPKS', 1, '2023-05-05 07:49:26'),
(64, 2, 15, 283, 1, NULL, 16, NULL, NULL, NULL, 'Producto asignado a la solicitud de inventario con código: SOL-YMPKS', 1, '2023-05-05 07:49:26'),
(65, 0, 17, 282, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-05 07:53:13'),
(66, 3, 17, 283, 1, NULL, 13, NULL, NULL, NULL, 'Producto asignado a la solicitud de inventario con código: SOL-ESWOF', 1, '2023-05-05 07:53:42'),
(67, 0, 18, 284, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-05 07:57:31'),
(68, 4, 18, 283, 1, NULL, 13, NULL, NULL, NULL, 'Producto asignado a la solicitud de inventario con código: SOL-Y9NUK', 1, '2023-05-05 07:58:10'),
(69, 0, 19, 286, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-05 08:06:11'),
(70, 3, 19, 283, 1, NULL, 11, NULL, NULL, NULL, 'Producto asignado a la solicitud de inventario con código: SOL-IN4OQ', 1, '2023-05-05 08:06:42'),
(71, 3, 19, 283, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 11:49:55'),
(72, 1, 19, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:08:22'),
(73, 3, 19, 283, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:13:53'),
(74, 1, 19, 286, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:14:08'),
(75, 3, 19, 283, 1, 10, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:16:16'),
(79, 1, 19, 286, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:27:38'),
(80, 3, 19, 283, 1, 26, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:28:32'),
(81, 1, 19, 286, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:28:50'),
(82, 3, 19, 282, 1, NULL, 14, NULL, NULL, NULL, 'Producto asignado a la solicitud de inventario con código: SOL-PV3VY', 1, '2023-05-08 12:29:37'),
(83, 1, 19, 285, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-08 12:33:30'),
(84, 0, 20, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 15:25:22'),
(85, 3, 20, 283, 1, 8, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 15:27:24'),
(86, 1, 20, 283, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 15:27:44'),
(87, 1, 20, 284, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-09 15:28:17');

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
-- Estructura de tabla para la tabla `observaciones_proveedores`
--

CREATE TABLE `observaciones_proveedores` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observaciones_proveedores`
--

INSERT INTO `observaciones_proveedores` (`id`, `proveedor_id`, `observacion`, `created_by`, `created_at`) VALUES
(4, 4, 'Se activa', 1, '2023-03-09 09:04:06'),
(5, 4, 'Se inactiva', 1, '2023-03-09 09:04:17'),
(6, 4, 'Se reactiva', 1, '2023-03-09 09:33:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra`
--

CREATE TABLE `ordenes_compra` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `aprobado` int(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenes_compra`
--

INSERT INTO `ordenes_compra` (`id`, `code`, `cliente_id`, `descripcion`, `status`, `aprobado`, `created_by`, `created_at`) VALUES
(2, 1, 30, 'Antenas para radio DEP45', 1, 0, 1, '2023-02-09 11:10:14'),
(4, 2, 17, NULL, 1, 0, 1, '2023-02-15 12:00:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizacion`
--

CREATE TABLE `organizacion` (
  `id` int(11) NOT NULL,
  `tipo_empresa` int(11) DEFAULT NULL,
  `organizacion` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `digito` varchar(255) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `tipo_regimen` int(11) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `email_contacto` varchar(255) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `organizacion`
--

INSERT INTO `organizacion` (`id`, `tipo_empresa`, `organizacion`, `tipo_documento`, `documento`, `digito`, `ciudad`, `direccion`, `tipo_regimen`, `telefono`, `contacto`, `email_contacto`, `pagina_web`, `avatar`) VALUES
(1, 2, 'ad', 5, '123', '4', 30, 'asd', 2, '123', 'asd', 'asd', 'asd', '1677244602inst4.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_compras`
--

CREATE TABLE `pagos_compras` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT 0,
  `tipo` int(1) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_compras`
--

INSERT INTO `pagos_compras` (`id`, `numero`, `tipo`, `factura_id`, `valor`, `status`, `created_by`, `created_at`) VALUES
(1, 0, 0, 40, '624.750,00', 0, 1, '2023-05-04 14:44:50'),
(5, 1, 1, 40, '24.750,00', 1, 1, '2023-05-04 16:51:58'),
(6, 2, 1, 40, '600.000,00', 1, 1, '2023-05-04 16:52:10'),
(7, 3, 0, 41, '743.750,00', 0, 1, '2023-05-04 17:00:58'),
(8, 3, 1, 41, '100.000,00', 1, 1, '2023-05-04 17:01:51'),
(9, 4, 1, 41, '200.000,00', 1, 1, '2023-05-04 17:02:24'),
(10, 5, 1, 41, '443.750,00', 1, 1, '2023-05-04 17:03:19'),
(11, 6, 0, 91, '74.388,00', 0, 1, '2023-05-16 15:31:04'),
(12, 6, 0, 92, '93.965,00', 0, 1, '2023-05-16 15:31:04'),
(13, 6, 0, 93, '385.000,00', 0, 1, '2023-05-16 15:31:05'),
(14, 6, 0, 94, '147.609,00', 0, 1, '2023-05-16 15:31:05'),
(15, 6, 0, 96, '1.638.003,00', 0, 1, '2023-05-16 15:31:05'),
(16, 6, 0, 97, '10.710,00', 0, 1, '2023-05-16 15:31:05'),
(17, 6, 0, 98, '340.596,00', 0, 1, '2023-05-16 15:31:06'),
(18, 6, 0, 99, '25.900,00', 0, 1, '2023-05-16 15:31:06'),
(19, 6, 0, 100, '759.698,00', 0, 1, '2023-05-16 15:31:06'),
(20, 6, 0, 101, '48.843,00', 0, 1, '2023-05-16 15:31:06'),
(21, 6, 0, 102, '50.000,00', 0, 1, '2023-05-16 15:31:06'),
(22, 6, 0, 103, '74.388,00', 0, 1, '2023-05-16 15:31:07'),
(23, 6, 0, 104, '977.698,00', 0, 1, '2023-05-16 15:31:07'),
(24, 6, 0, 105, '93.965,00', 0, 1, '2023-05-16 15:31:07'),
(25, 6, 0, 106, '1.638.003,00', 0, 1, '2023-05-16 15:31:07'),
(26, 6, 0, 107, '147.609,00', 0, 1, '2023-05-16 15:31:08'),
(27, 6, 0, 108, '10.710,00', 0, 1, '2023-05-16 15:31:08'),
(28, 6, 0, 109, '25.900,00', 0, 1, '2023-05-16 15:31:08'),
(29, 6, 0, 110, '48.843,00', 0, 1, '2023-05-16 15:31:08'),
(30, 6, 0, 111, '50.000,00', 0, 1, '2023-05-16 15:31:08'),
(31, 6, 0, 112, '12.000,00', 0, 1, '2023-05-16 15:31:09'),
(32, 6, 0, 113, '14.530,00', 0, 1, '2023-05-16 15:31:09'),
(33, 6, 0, 114, '134.178,00', 0, 1, '2023-05-16 15:31:09'),
(34, 6, 0, 115, '303.620,00', 0, 1, '2023-05-16 15:31:09'),
(35, 6, 0, 116, '192.900,00', 0, 1, '2023-05-16 15:31:10'),
(36, 6, 0, 117, '162.381,00', 0, 1, '2023-05-16 15:31:10'),
(37, 6, 0, 118, '12.000,00', 0, 1, '2023-05-16 15:31:10'),
(38, 6, 0, 119, '48.000,00', 0, 1, '2023-05-16 15:31:10'),
(39, 6, 0, 120, '97.800,00', 0, 1, '2023-05-16 15:31:10'),
(40, 6, 0, 121, '129.900,00', 0, 1, '2023-05-16 15:31:11'),
(41, 6, 0, 122, '303.620,00', 0, 1, '2023-05-16 15:31:11'),
(42, 6, 0, 123, '120.190,00', 0, 1, '2023-05-16 15:31:11'),
(43, 6, 0, 124, '777.731,00', 0, 1, '2023-05-16 15:31:11'),
(44, 6, 0, 126, '759.698,00', 0, 1, '2023-05-16 15:31:12'),
(45, 6, 0, 127, '340.596,00', 0, 1, '2023-05-16 15:31:12'),
(46, 6, 0, 128, '97.800,00', 0, 1, '2023-05-16 15:31:12'),
(47, 6, 0, 129, '977.698,00', 0, 1, '2023-05-16 15:31:12'),
(48, 6, 0, 130, '129.900,00', 0, 1, '2023-05-16 15:31:12'),
(49, 6, 0, 131, '385.000,00', 0, 1, '2023-05-16 15:31:13'),
(50, 6, 0, 132, '911.909,00', 0, 1, '2023-05-16 15:31:13'),
(51, 6, 0, 134, '14.530,00', 0, 1, '2023-05-16 15:31:13'),
(52, 6, 0, 135, '192.900,00', 0, 1, '2023-05-16 15:31:13'),
(53, 6, 0, 136, '48.000,00', 0, 1, '2023-05-16 15:31:13'),
(54, 6, 0, 137, '120.190,00', 0, 1, '2023-05-16 15:31:14'),
(55, 6, 0, 141, '303.620,00', 0, 1, '2023-05-16 15:38:14'),
(56, 6, 0, 142, '759.698,00', 0, 1, '2023-05-16 15:38:14'),
(57, 6, 0, 143, '192.900,00', 0, 1, '2023-05-16 15:38:14'),
(58, 6, 0, 144, '50.000,00', 0, 1, '2023-05-16 15:38:14'),
(59, 6, 0, 145, '48.000,00', 0, 1, '2023-05-16 15:38:15'),
(60, 6, 0, 146, '97.800,00', 0, 1, '2023-05-16 15:38:15'),
(61, 6, 0, 147, '977.698,00', 0, 1, '2023-05-16 15:38:15'),
(62, 6, 0, 148, '162.381,00', 0, 1, '2023-05-16 15:38:15'),
(63, 6, 0, 149, '759.698,00', 0, 1, '2023-05-16 15:38:15'),
(64, 6, 0, 150, '93.965,00', 0, 1, '2023-05-16 15:38:16'),
(65, 6, 0, 151, '911.909,00', 0, 1, '2023-05-16 15:38:16'),
(66, 6, 0, 152, '10.710,00', 0, 1, '2023-05-16 15:38:16'),
(67, 6, 0, 153, '74.388,00', 0, 1, '2023-05-16 15:38:16'),
(68, 6, 0, 154, '25.900,00', 0, 1, '2023-05-16 15:38:16'),
(69, 6, 0, 155, '12.000,00', 0, 1, '2023-05-16 15:38:17'),
(70, 6, 0, 156, '1.638.003,00', 0, 1, '2023-05-16 15:38:17'),
(71, 6, 0, 157, '50.000,00', 0, 1, '2023-05-16 15:38:17'),
(72, 6, 0, 158, '48.843,00', 0, 1, '2023-05-16 15:38:17'),
(73, 6, 0, 159, '97.800,00', 0, 1, '2023-05-16 15:38:17'),
(74, 6, 0, 160, '977.698,00', 0, 1, '2023-05-16 15:38:18'),
(75, 6, 0, 161, '25.900,00', 0, 1, '2023-05-16 15:38:18'),
(76, 6, 0, 162, '777.731,00', 0, 1, '2023-05-16 15:38:18'),
(77, 6, 0, 163, '48.843,00', 0, 1, '2023-05-16 15:38:18'),
(78, 6, 0, 164, '74.388,00', 0, 1, '2023-05-16 15:38:18'),
(79, 6, 0, 165, '303.620,00', 0, 1, '2023-05-16 15:38:19'),
(80, 6, 0, 166, '385.000,00', 0, 1, '2023-05-16 15:38:19'),
(81, 6, 0, 167, '93.965,00', 0, 1, '2023-05-16 15:38:19'),
(82, 6, 0, 168, '129.900,00', 0, 1, '2023-05-16 15:38:19'),
(83, 6, 0, 170, '147.609,00', 0, 1, '2023-05-16 15:38:20'),
(84, 6, 0, 171, '340.596,00', 0, 1, '2023-05-16 15:38:20'),
(85, 6, 0, 172, '10.710,00', 0, 1, '2023-05-16 15:38:20'),
(86, 6, 0, 173, '120.190,00', 0, 1, '2023-05-16 15:38:20'),
(87, 6, 0, 174, '192.900,00', 0, 1, '2023-05-16 15:38:20'),
(88, 6, 0, 175, '340.596,00', 0, 1, '2023-05-16 15:38:20'),
(89, 6, 0, 176, '12.000,00', 0, 1, '2023-05-16 15:38:21'),
(90, 6, 0, 177, '120.190,00', 0, 1, '2023-05-16 15:38:21'),
(91, 6, 0, 178, '48.000,00', 0, 1, '2023-05-16 15:38:21'),
(92, 6, 0, 179, '14.530,00', 0, 1, '2023-05-16 15:38:21'),
(93, 6, 0, 180, '134.178,00', 0, 1, '2023-05-16 15:38:22'),
(94, 6, 0, 181, '129.900,00', 0, 1, '2023-05-16 15:38:22'),
(95, 6, 0, 182, '147.609,00', 0, 1, '2023-05-16 15:38:22'),
(96, 6, 0, 183, '14.530,00', 0, 1, '2023-05-16 15:38:22'),
(97, 6, 0, 184, '1.638.003,00', 0, 1, '2023-05-16 15:38:22'),
(98, 6, 0, 185, '385.000,00', 0, 1, '2023-05-16 15:38:23'),
(99, 6, 0, 191, '53.499,00', 0, 1, '2023-05-16 15:40:49'),
(100, 6, 0, 192, '12.000,00', 0, 1, '2023-05-16 15:40:50'),
(101, 6, 0, 193, '804.999,00', 0, 1, '2023-05-16 15:40:50'),
(102, 6, 0, 194, '17.739,00', 0, 1, '2023-05-16 15:40:50'),
(103, 6, 0, 196, '192.900,00', 0, 1, '2023-05-16 15:40:50'),
(104, 6, 0, 197, '430.000,00', 0, 1, '2023-05-16 15:40:51'),
(105, 6, 0, 198, '138.900,00', 0, 1, '2023-05-16 15:40:51'),
(106, 6, 0, 199, '294.999,00', 0, 1, '2023-05-16 15:40:51'),
(107, 6, 0, 200, '13.500,00', 0, 1, '2023-05-16 15:40:51'),
(108, 6, 0, 201, '1.095.894,00', 0, 1, '2023-05-16 15:40:51'),
(109, 6, 0, 202, '303.620,00', 0, 1, '2023-05-16 15:40:52'),
(110, 6, 0, 203, '557.899,00', 0, 1, '2023-05-16 15:40:52'),
(111, 6, 0, 204, '759.698,00', 0, 1, '2023-05-16 15:40:52'),
(112, 6, 0, 206, '33.998,00', 0, 1, '2023-05-16 15:40:52'),
(113, 6, 0, 207, '1.638.003,00', 0, 1, '2023-05-16 15:40:53'),
(114, 6, 0, 208, '44.800,00', 0, 1, '2023-05-16 15:40:53'),
(115, 6, 0, 209, '235.980,00', 0, 1, '2023-05-16 15:40:53'),
(116, 6, 0, 210, '136.999,00', 0, 1, '2023-05-16 15:40:53'),
(117, 6, 0, 211, '5712,00', 0, 1, '2023-05-16 15:40:54'),
(118, 6, 0, 212, '777.731,00', 0, 1, '2023-05-16 15:40:54'),
(119, 6, 0, 213, '129.900,00', 0, 1, '2023-05-16 15:40:54'),
(120, 6, 0, 214, '479.999,00', 0, 1, '2023-05-16 15:40:54'),
(121, 6, 0, 215, '1.198.318,00', 0, 1, '2023-05-16 15:40:54'),
(122, 6, 0, 216, '83.080,00', 0, 1, '2023-05-16 15:40:54'),
(123, 6, 0, 217, '20.000,00', 0, 1, '2023-05-16 15:40:55'),
(124, 6, 0, 218, '21.197,00', 0, 1, '2023-05-16 15:40:55'),
(125, 6, 0, 219, '226.800,00', 0, 1, '2023-05-16 15:40:55'),
(126, 6, 0, 221, '97.800,00', 0, 1, '2023-05-16 15:40:56'),
(127, 6, 0, 222, '14.530,00', 0, 1, '2023-05-16 15:40:56'),
(128, 6, 0, 223, '17.739,00', 0, 1, '2023-05-16 15:40:56'),
(129, 6, 0, 224, '138.900,00', 0, 1, '2023-05-16 15:40:56'),
(130, 6, 0, 225, '102.942,00', 0, 1, '2023-05-16 15:40:56'),
(131, 6, 0, 226, '13.500,00', 0, 1, '2023-05-16 15:40:57'),
(132, 6, 0, 227, '134.178,00', 0, 1, '2023-05-16 15:40:57'),
(133, 6, 0, 228, '341.288,00', 0, 1, '2023-05-16 15:40:57'),
(134, 6, 0, 229, '12.000,00', 0, 1, '2023-05-16 15:40:57'),
(135, 6, 0, 230, '28.494,00', 0, 1, '2023-05-16 15:40:58'),
(136, 6, 0, 231, '120.190,00', 0, 1, '2023-05-16 15:40:58'),
(137, 6, 0, 232, '12.000,00', 0, 1, '2023-05-16 15:40:58'),
(138, 6, 0, 233, '88.341,00', 0, 1, '2023-05-16 15:40:58'),
(139, 6, 0, 234, '33.998,00', 0, 1, '2023-05-16 15:40:59'),
(140, 6, 0, 235, '27.798,00', 0, 1, '2023-05-16 15:40:59'),
(141, 6, 0, 236, '239.999,00', 0, 1, '2023-05-16 15:40:59'),
(142, 6, 0, 237, '364.990,00', 0, 1, '2023-05-16 15:40:59'),
(143, 6, 0, 239, '60.037,00', 0, 1, '2023-05-16 15:41:00'),
(144, 6, 0, 240, '1.095.894,00', 0, 1, '2023-05-16 15:41:00'),
(145, 6, 0, 241, '5712,00', 0, 1, '2023-05-16 15:41:00'),
(146, 6, 0, 242, '83.080,00', 0, 1, '2023-05-16 15:41:00'),
(147, 6, 0, 243, '1.638.003,00', 0, 1, '2023-05-16 15:41:00'),
(148, 6, 0, 244, '272.020,00', 0, 1, '2023-05-16 15:41:01'),
(149, 6, 0, 245, '515.999,00', 0, 1, '2023-05-16 15:41:01'),
(150, 6, 0, 246, '21.197,00', 0, 1, '2023-05-16 15:41:01'),
(151, 6, 0, 247, '491.203,00', 0, 1, '2023-05-16 15:41:01'),
(152, 6, 0, 248, '25.900,00', 0, 1, '2023-05-16 15:41:01'),
(153, 6, 0, 249, '48.000,00', 0, 1, '2023-05-16 15:41:02'),
(154, 6, 0, 250, '220.000,00', 0, 1, '2023-05-16 15:41:02'),
(155, 6, 0, 252, '19.999,00', 0, 1, '2023-05-16 15:41:02'),
(156, 6, 0, 253, '3.719.890,00', 0, 1, '2023-05-16 15:41:03'),
(157, 6, 0, 254, '1.198.318,00', 0, 1, '2023-05-16 15:41:03'),
(158, 6, 0, 255, '22.599,00', 0, 1, '2023-05-16 15:41:03'),
(159, 6, 0, 257, '340.596,00', 0, 1, '2023-05-16 15:41:03'),
(160, 6, 0, 258, '303.620,00', 0, 1, '2023-05-16 15:41:04'),
(161, 6, 0, 259, '239.999,00', 0, 1, '2023-05-16 15:41:04'),
(162, 6, 0, 260, '102.942,00', 0, 1, '2023-05-16 15:41:04'),
(163, 6, 0, 261, '341.288,00', 0, 1, '2023-05-16 15:41:04'),
(164, 6, 0, 262, '30.900,00', 0, 1, '2023-05-16 15:41:04'),
(165, 6, 0, 263, '13.200,00', 0, 1, '2023-05-16 15:41:05'),
(166, 6, 0, 264, '3.878.923,00', 0, 1, '2023-05-16 15:41:05'),
(167, 6, 0, 265, '74.388,00', 0, 1, '2023-05-16 15:41:05'),
(168, 6, 0, 266, '50.000,00', 0, 1, '2023-05-16 15:41:05'),
(169, 6, 0, 267, '294.999,00', 0, 1, '2023-05-16 15:41:06'),
(170, 6, 0, 268, '185.999,00', 0, 1, '2023-05-16 15:41:06'),
(171, 6, 0, 269, '12.000,00', 0, 1, '2023-05-16 15:41:06'),
(172, 6, 0, 270, '48.843,00', 0, 1, '2023-05-16 15:41:06'),
(173, 6, 0, 271, '235.980,00', 0, 1, '2023-05-16 15:41:07'),
(174, 6, 0, 272, '557.899,00', 0, 1, '2023-05-16 15:41:07'),
(175, 6, 0, 273, '97.800,00', 0, 1, '2023-05-16 15:41:07'),
(176, 6, 0, 274, '759.698,00', 0, 1, '2023-05-16 15:41:07'),
(177, 6, 0, 275, '364.990,00', 0, 1, '2023-05-16 15:41:07'),
(178, 6, 0, 276, '220.000,00', 0, 1, '2023-05-16 15:41:08'),
(179, 6, 0, 277, '48.000,00', 0, 1, '2023-05-16 15:41:08'),
(180, 6, 0, 278, '117.000,00', 0, 1, '2023-05-16 15:41:08'),
(181, 6, 0, 279, '60.037,00', 0, 1, '2023-05-16 15:41:08'),
(182, 6, 0, 280, '272.020,00', 0, 1, '2023-05-16 15:41:08'),
(183, 6, 0, 281, '147.609,00', 0, 1, '2023-05-16 15:41:09'),
(184, 6, 0, 282, '249.900,00', 0, 1, '2023-05-16 15:41:09'),
(185, 6, 0, 283, '44.800,00', 0, 1, '2023-05-16 15:41:09'),
(186, 6, 0, 284, '20.000,00', 0, 1, '2023-05-16 15:41:09'),
(187, 6, 0, 286, '116.900,00', 0, 1, '2023-05-16 15:41:10'),
(188, 6, 0, 287, '430.000,00', 0, 1, '2023-05-16 15:41:10'),
(189, 6, 0, 288, '183.300,00', 0, 1, '2023-05-16 15:41:10'),
(190, 6, 0, 289, '340.596,00', 0, 1, '2023-05-16 15:41:10'),
(191, 6, 0, 290, '3.844.925,00', 0, 1, '2023-05-16 15:41:11'),
(192, 6, 0, 291, '209.959,00', 0, 1, '2023-05-16 15:41:11'),
(193, 6, 0, 292, '28.494,00', 0, 1, '2023-05-16 15:41:11'),
(194, 6, 0, 293, '48.843,00', 0, 1, '2023-05-16 15:41:11'),
(195, 6, 0, 294, '30.900,00', 0, 1, '2023-05-16 15:41:11'),
(196, 6, 0, 295, '50.000,00', 0, 1, '2023-05-16 15:41:12'),
(197, 6, 0, 296, '249.900,00', 0, 1, '2023-05-16 15:41:12'),
(198, 6, 0, 297, '99.901,00', 0, 1, '2023-05-16 15:41:12'),
(199, 6, 0, 298, '46.886,00', 0, 1, '2023-05-16 15:41:12'),
(200, 6, 0, 300, '161.955,00', 0, 1, '2023-05-16 15:41:13'),
(201, 6, 0, 301, '209.635,00', 0, 1, '2023-05-16 15:41:13'),
(202, 6, 0, 302, '10.710,00', 0, 1, '2023-05-16 15:41:13'),
(203, 6, 0, 303, '49.999,00', 0, 1, '2023-05-16 15:41:13'),
(204, 6, 0, 304, '11.500,00', 0, 1, '2023-05-16 15:41:13'),
(205, 6, 0, 305, '26.000,00', 0, 1, '2023-05-16 15:41:14'),
(206, 6, 0, 306, '93.965,00', 0, 1, '2023-05-16 15:41:14'),
(207, 6, 0, 307, '92.800,00', 0, 1, '2023-05-16 15:41:14'),
(208, 6, 0, 308, '515.999,00', 0, 1, '2023-05-16 15:41:14'),
(209, 6, 0, 309, '12.000,00', 0, 1, '2023-05-16 15:41:14'),
(210, 6, 0, 310, '129.900,00', 0, 1, '2023-05-16 15:41:15'),
(211, 6, 0, 311, '12.000,00', 0, 1, '2023-05-16 15:41:15'),
(212, 6, 0, 312, '977.698,00', 0, 1, '2023-05-16 15:41:15'),
(213, 6, 0, 313, '116.900,00', 0, 1, '2023-05-16 15:41:15'),
(214, 6, 0, 314, '491.203,00', 0, 1, '2023-05-16 15:41:15'),
(215, 6, 0, 315, '385.000,00', 0, 1, '2023-05-16 15:41:16'),
(216, 6, 0, 316, '49.999,00', 0, 1, '2023-05-16 15:41:16'),
(217, 6, 0, 317, '88.341,00', 0, 1, '2023-05-16 15:41:16'),
(218, 6, 0, 318, '120.190,00', 0, 1, '2023-05-16 15:41:16'),
(219, 6, 0, 319, '209.959,00', 0, 1, '2023-05-16 15:41:16'),
(220, 6, 0, 320, '93.965,00', 0, 1, '2023-05-16 15:41:17'),
(221, 6, 0, 321, '239.999,00', 0, 1, '2023-05-16 15:41:17'),
(222, 6, 0, 322, '1.346.349,00', 0, 1, '2023-05-16 15:41:17'),
(223, 6, 0, 323, '249.900,00', 0, 1, '2023-05-16 15:41:17'),
(224, 6, 0, 324, '46.886,00', 0, 1, '2023-05-16 15:41:17'),
(225, 6, 0, 325, '192.900,00', 0, 1, '2023-05-16 15:41:18'),
(226, 6, 0, 326, '161.955,00', 0, 1, '2023-05-16 15:41:18'),
(227, 6, 0, 327, '209.635,00', 0, 1, '2023-05-16 15:41:18'),
(228, 6, 0, 328, '7200,00', 0, 1, '2023-05-16 15:41:18'),
(229, 6, 0, 329, '27.600,00', 0, 1, '2023-05-16 15:41:19'),
(230, 6, 0, 330, '102.000,00', 0, 1, '2023-05-16 15:41:19'),
(231, 6, 0, 331, '977.698,00', 0, 1, '2023-05-16 15:41:19'),
(232, 6, 0, 332, '162.381,00', 0, 1, '2023-05-16 15:41:19'),
(233, 6, 0, 334, '185.999,00', 0, 1, '2023-05-16 15:41:20'),
(234, 6, 0, 335, '8399,00', 0, 1, '2023-05-16 15:41:20'),
(235, 6, 0, 337, '26.000,00', 0, 1, '2023-05-16 15:41:20'),
(236, 6, 0, 338, '700.000,00', 0, 1, '2023-05-16 15:41:21'),
(237, 6, 0, 339, '70.240,00', 0, 1, '2023-05-16 15:41:21'),
(238, 6, 0, 340, '183.300,00', 0, 1, '2023-05-16 15:41:21'),
(239, 6, 0, 341, '10.195.378,00', 0, 1, '2023-05-16 15:41:21'),
(240, 6, 0, 342, '10.710,00', 0, 1, '2023-05-16 15:41:21'),
(241, 6, 0, 343, '252.000,00', 0, 1, '2023-05-16 15:41:22'),
(242, 6, 0, 344, '113.716,00', 0, 1, '2023-05-16 15:41:22'),
(243, 6, 0, 345, '1.346.349,00', 0, 1, '2023-05-16 15:41:22'),
(244, 6, 0, 346, '75.952,00', 0, 1, '2023-05-16 15:41:22'),
(245, 6, 0, 347, '99.901,00', 0, 1, '2023-05-16 15:41:23'),
(246, 6, 0, 348, '249.900,00', 0, 1, '2023-05-16 15:41:23'),
(247, 6, 0, 350, '827.021,00', 0, 1, '2023-05-16 15:41:23'),
(248, 6, 0, 351, '92.800,00', 0, 1, '2023-05-16 15:41:23'),
(249, 6, 0, 353, '21.599,00', 0, 1, '2023-05-16 15:41:24'),
(250, 6, 0, 354, '239.999,00', 0, 1, '2023-05-16 15:41:24'),
(251, 6, 0, 355, '385.000,00', 0, 1, '2023-05-16 15:41:24'),
(252, 6, 0, 356, '147.609,00', 0, 1, '2023-05-16 15:41:24'),
(253, 6, 0, 358, '150.000,00', 0, 1, '2023-05-16 15:41:25'),
(254, 6, 0, 359, '113.716,00', 0, 1, '2023-05-16 15:41:25'),
(255, 6, 0, 360, '162.381,00', 0, 1, '2023-05-16 15:41:25'),
(256, 6, 0, 361, '28.050,00', 0, 1, '2023-05-16 15:41:25'),
(257, 6, 0, 363, '53.499,00', 0, 1, '2023-05-16 15:41:26'),
(258, 6, 0, 364, '700.000,00', 0, 1, '2023-05-16 15:41:26'),
(259, 6, 0, 365, '27.600,00', 0, 1, '2023-05-16 15:41:26'),
(260, 6, 0, 366, '39.931,00', 0, 1, '2023-05-16 15:41:26'),
(261, 6, 0, 368, '10.195.378,00', 0, 1, '2023-05-16 15:41:27'),
(262, 6, 0, 369, '25.900,00', 0, 1, '2023-05-16 15:41:27'),
(263, 6, 0, 371, '75.952,00', 0, 1, '2023-05-16 15:41:28'),
(264, 6, 0, 372, '469.999,00', 0, 1, '2023-05-16 15:41:28'),
(265, 6, 0, 373, '827.021,00', 0, 1, '2023-05-16 15:41:28'),
(266, 6, 0, 374, '133.952,00', 0, 1, '2023-05-16 15:41:28'),
(267, 6, 0, 375, '239.861,00', 0, 1, '2023-05-16 15:41:28'),
(268, 6, 0, 376, '469.999,00', 0, 1, '2023-05-16 15:41:29'),
(269, 6, 0, 377, '133.952,00', 0, 1, '2023-05-16 15:41:29'),
(270, 6, 0, 378, '591.224,00', 0, 1, '2023-05-16 15:41:29'),
(271, 6, 0, 379, '15.074,00', 0, 1, '2023-05-16 15:41:29'),
(272, 6, 0, 380, '7200,00', 0, 1, '2023-05-16 15:41:30'),
(273, 6, 0, 381, '591.224,00', 0, 1, '2023-05-16 15:41:30'),
(274, 6, 0, 382, '39.931,00', 0, 1, '2023-05-16 15:41:30'),
(275, 6, 0, 383, '48.250,00', 0, 1, '2023-05-16 15:41:30'),
(276, 6, 0, 384, '1.207.774,00', 0, 1, '2023-05-16 15:41:31'),
(277, 6, 0, 385, '0,00', 0, 1, '2023-05-16 15:41:31'),
(278, 6, 0, 386, '178.599,00', 0, 1, '2023-05-16 15:41:31'),
(279, 6, 0, 388, '239.861,00', 0, 1, '2023-05-16 15:41:32'),
(280, 6, 0, 389, '21.990,00', 0, 1, '2023-05-16 15:41:32'),
(281, 6, 0, 390, '27.455,00', 0, 1, '2023-05-16 15:41:32'),
(282, 6, 0, 391, '54.624,00', 0, 1, '2023-05-16 15:41:32'),
(283, 6, 0, 392, '1.207.774,00', 0, 1, '2023-05-16 15:41:32'),
(284, 6, 0, 394, '256.960,00', 0, 1, '2023-05-16 15:41:33'),
(285, 6, 0, 395, '0,00', 0, 1, '2023-05-16 15:41:33'),
(286, 6, 0, 396, '596.399,00', 0, 1, '2023-05-16 15:41:33'),
(287, 6, 0, 398, '256.960,00', 0, 1, '2023-05-16 15:41:34'),
(288, 6, 0, 399, '178.599,00', 0, 1, '2023-05-16 15:41:34'),
(289, 6, 0, 400, '596.399,00', 0, 1, '2023-05-16 15:41:34'),
(290, 6, 0, 401, '27.455,00', 0, 1, '2023-05-16 15:41:34'),
(291, 6, 0, 402, '16.175.407,00', 0, 1, '2023-05-16 15:41:35'),
(292, 6, 0, 403, '16.175.407,00', 0, 1, '2023-05-16 15:41:35'),
(293, 6, 0, 407, '14.530,00', 0, 1, '2023-05-16 15:59:27'),
(294, 6, 0, 408, '430.000,00', 0, 1, '2023-05-16 15:59:28'),
(295, 6, 0, 409, '10.195.378,00', 0, 1, '2023-05-16 15:59:28'),
(296, 6, 0, 410, '75.952,00', 0, 1, '2023-05-16 15:59:28'),
(297, 6, 0, 411, '977.698,00', 0, 1, '2023-05-16 15:59:29'),
(298, 6, 0, 412, '479.999,00', 0, 1, '2023-05-16 15:59:29'),
(299, 6, 0, 413, '48.000,00', 0, 1, '2023-05-16 15:59:29'),
(300, 6, 0, 414, '17.739,00', 0, 1, '2023-05-16 15:59:29'),
(301, 6, 0, 415, '138.900,00', 0, 1, '2023-05-16 15:59:29'),
(302, 6, 0, 416, '39.931,00', 0, 1, '2023-05-16 15:59:30'),
(303, 6, 0, 417, '185.999,00', 0, 1, '2023-05-16 15:59:30'),
(304, 6, 0, 418, '92.800,00', 0, 1, '2023-05-16 15:59:30'),
(305, 6, 0, 419, '27.798,00', 0, 1, '2023-05-16 15:59:30'),
(306, 6, 0, 420, '74.388,00', 0, 1, '2023-05-16 15:59:30'),
(307, 6, 0, 421, '272.020,00', 0, 1, '2023-05-16 15:59:31'),
(308, 6, 0, 422, '97.800,00', 0, 1, '2023-05-16 15:59:31'),
(309, 6, 0, 423, '3.844.925,00', 0, 1, '2023-05-16 15:59:31'),
(310, 6, 0, 424, '5712,00', 0, 1, '2023-05-16 15:59:31'),
(311, 6, 0, 425, '161.955,00', 0, 1, '2023-05-16 15:59:31'),
(312, 6, 0, 426, '102.000,00', 0, 1, '2023-05-16 15:59:31'),
(313, 6, 0, 427, '162.381,00', 0, 1, '2023-05-16 15:59:32'),
(314, 6, 0, 428, '10.710,00', 0, 1, '2023-05-16 15:59:32'),
(315, 6, 0, 429, '44.800,00', 0, 1, '2023-05-16 15:59:32'),
(316, 6, 0, 430, '239.999,00', 0, 1, '2023-05-16 15:59:32'),
(317, 6, 0, 431, '192.900,00', 0, 1, '2023-05-16 15:59:32'),
(318, 6, 0, 432, '25.900,00', 0, 1, '2023-05-16 15:59:33'),
(319, 6, 0, 434, '827.021,00', 0, 1, '2023-05-16 15:59:33'),
(320, 6, 0, 435, '20.000,00', 0, 1, '2023-05-16 15:59:33'),
(321, 6, 0, 436, '12.000,00', 0, 1, '2023-05-16 15:59:34'),
(322, 6, 0, 437, '7200,00', 0, 1, '2023-05-16 15:59:34'),
(323, 6, 0, 438, '0,00', 0, 1, '2023-05-16 15:59:34'),
(324, 6, 0, 439, '209.959,00', 0, 1, '2023-05-16 15:59:34'),
(325, 6, 0, 440, '120.190,00', 0, 1, '2023-05-16 15:59:35'),
(326, 6, 0, 441, '777.731,00', 0, 1, '2023-05-16 15:59:35'),
(327, 6, 0, 444, '235.980,00', 0, 1, '2023-05-16 15:59:35'),
(328, 6, 0, 445, '30.900,00', 0, 1, '2023-05-16 15:59:36'),
(329, 6, 0, 446, '19.999,00', 0, 1, '2023-05-16 15:59:36'),
(330, 6, 0, 447, '249.900,00', 0, 1, '2023-05-16 15:59:36'),
(331, 6, 0, 448, '88.341,00', 0, 1, '2023-05-16 15:59:36'),
(332, 6, 0, 449, '12.000,00', 0, 1, '2023-05-16 15:59:36'),
(333, 6, 0, 450, '102.942,00', 0, 1, '2023-05-16 15:59:37'),
(334, 6, 0, 451, '3.719.890,00', 0, 1, '2023-05-16 15:59:37'),
(335, 6, 0, 452, '226.800,00', 0, 1, '2023-05-16 15:59:37'),
(336, 6, 0, 453, '27.600,00', 0, 1, '2023-05-16 15:59:37'),
(337, 6, 0, 454, '13.500,00', 0, 1, '2023-05-16 15:59:37'),
(338, 6, 0, 455, '385.000,00', 0, 1, '2023-05-16 15:59:38'),
(339, 6, 0, 456, '60.037,00', 0, 1, '2023-05-16 15:59:38'),
(340, 6, 0, 457, '1.346.349,00', 0, 1, '2023-05-16 15:59:38'),
(341, 6, 0, 459, '99.901,00', 0, 1, '2023-05-16 15:59:38'),
(342, 6, 0, 460, '596.399,00', 0, 1, '2023-05-16 15:59:39'),
(343, 6, 0, 461, '557.899,00', 0, 1, '2023-05-16 15:59:39'),
(344, 6, 0, 462, '491.203,00', 0, 1, '2023-05-16 15:59:39'),
(345, 6, 0, 463, '256.960,00', 0, 1, '2023-05-16 15:59:39'),
(346, 6, 0, 464, '364.990,00', 0, 1, '2023-05-16 15:59:39'),
(347, 6, 0, 465, '469.999,00', 0, 1, '2023-05-16 15:59:39'),
(348, 6, 0, 466, '209.635,00', 0, 1, '2023-05-16 15:59:40'),
(349, 6, 0, 468, '303.620,00', 0, 1, '2023-05-16 15:59:40'),
(350, 6, 0, 469, '22.599,00', 0, 1, '2023-05-16 15:59:40'),
(351, 6, 0, 470, '48.250,00', 0, 1, '2023-05-16 15:59:41'),
(352, 6, 0, 471, '12.000,00', 0, 1, '2023-05-16 15:59:41'),
(353, 6, 0, 472, '341.288,00', 0, 1, '2023-05-16 15:59:41'),
(354, 6, 0, 473, '294.999,00', 0, 1, '2023-05-16 15:59:41'),
(355, 6, 0, 474, '239.999,00', 0, 1, '2023-05-16 15:59:41'),
(356, 6, 0, 475, '113.716,00', 0, 1, '2023-05-16 15:59:42'),
(357, 6, 0, 476, '178.599,00', 0, 1, '2023-05-16 15:59:42'),
(358, 6, 0, 477, '27.455,00', 0, 1, '2023-05-16 15:59:42'),
(359, 6, 0, 478, '239.861,00', 0, 1, '2023-05-16 15:59:42'),
(360, 6, 0, 479, '117.000,00', 0, 1, '2023-05-16 15:59:42'),
(361, 6, 0, 480, '8399,00', 0, 1, '2023-05-16 15:59:43'),
(362, 6, 0, 481, '515.999,00', 0, 1, '2023-05-16 15:59:43'),
(363, 6, 0, 482, '93.965,00', 0, 1, '2023-05-16 15:59:43'),
(364, 6, 0, 483, '134.178,00', 0, 1, '2023-05-16 15:59:43'),
(365, 6, 0, 484, '0,00', 0, 1, '2023-05-16 15:59:44'),
(366, 6, 0, 485, '759.698,00', 0, 1, '2023-05-16 15:59:44'),
(367, 6, 0, 486, '48.843,00', 0, 1, '2023-05-16 15:59:44'),
(368, 6, 0, 487, '28.494,00', 0, 1, '2023-05-16 15:59:44'),
(369, 6, 0, 488, '46.886,00', 0, 1, '2023-05-16 15:59:44'),
(370, 6, 0, 489, '53.499,00', 0, 1, '2023-05-16 15:59:45'),
(371, 6, 0, 490, '13.200,00', 0, 1, '2023-05-16 15:59:45'),
(372, 6, 0, 491, '340.596,00', 0, 1, '2023-05-16 15:59:45'),
(373, 6, 0, 492, '220.000,00', 0, 1, '2023-05-16 15:59:45'),
(374, 6, 0, 493, '21.990,00', 0, 1, '2023-05-16 15:59:45'),
(375, 6, 0, 494, '26.000,00', 0, 1, '2023-05-16 15:59:46'),
(376, 6, 0, 495, '116.900,00', 0, 1, '2023-05-16 15:59:46'),
(377, 6, 0, 496, '28.050,00', 0, 1, '2023-05-16 15:59:46'),
(378, 6, 0, 497, '150.000,00', 0, 1, '2023-05-16 15:59:46'),
(379, 6, 0, 498, '16.175.407,00', 0, 1, '2023-05-16 15:59:46'),
(380, 6, 0, 500, '249.900,00', 0, 1, '2023-05-16 15:59:47'),
(381, 6, 0, 501, '21.197,00', 0, 1, '2023-05-16 15:59:47'),
(382, 6, 0, 502, '129.900,00', 0, 1, '2023-05-16 15:59:47'),
(383, 6, 0, 504, '1.198.318,00', 0, 1, '2023-05-16 15:59:48'),
(384, 6, 0, 505, '1.638.003,00', 0, 1, '2023-05-16 15:59:48'),
(385, 6, 0, 507, '6200,00', 0, 1, '2023-05-16 15:59:48'),
(386, 6, 0, 508, '1.207.774,00', 0, 1, '2023-05-16 15:59:49'),
(387, 6, 0, 509, '804.999,00', 0, 1, '2023-05-16 15:59:49'),
(388, 6, 0, 510, '15.074,00', 0, 1, '2023-05-16 15:59:49'),
(389, 6, 0, 512, '591.224,00', 0, 1, '2023-05-16 15:59:49'),
(390, 6, 0, 513, '1.095.894,00', 0, 1, '2023-05-16 15:59:50'),
(391, 6, 0, 514, '700.000,00', 0, 1, '2023-05-16 15:59:50'),
(392, 6, 0, 515, '183.300,00', 0, 1, '2023-05-16 15:59:50'),
(393, 6, 0, 516, '147.609,00', 0, 1, '2023-05-16 15:59:50'),
(394, 6, 0, 518, '50.000,00', 0, 1, '2023-05-16 15:59:51'),
(395, 6, 0, 519, '83.080,00', 0, 1, '2023-05-16 15:59:51'),
(396, 6, 0, 520, '49.999,00', 0, 1, '2023-05-16 15:59:51'),
(397, 6, 0, 522, '33.998,00', 0, 1, '2023-05-16 15:59:52'),
(398, 6, 0, 524, '11.500,00', 0, 1, '2023-05-16 15:59:52'),
(399, 6, 0, 532, '341.288,00', 0, 1, '2023-05-16 16:07:37'),
(400, 6, 0, 533, '977.698,00', 0, 1, '2023-05-16 16:07:38'),
(401, 6, 0, 534, '209.959,00', 0, 1, '2023-05-16 16:07:38'),
(402, 6, 0, 535, '185.999,00', 0, 1, '2023-05-16 16:07:38'),
(403, 6, 0, 537, '700.000,00', 0, 1, '2023-05-16 16:07:39'),
(404, 6, 0, 538, '113.716,00', 0, 1, '2023-05-16 16:07:39'),
(405, 6, 0, 540, '1.346.349,00', 0, 1, '2023-05-16 16:07:39'),
(406, 6, 0, 542, '1.638.003,00', 0, 1, '2023-05-16 16:07:40'),
(407, 6, 0, 543, '0,00', 0, 1, '2023-05-16 16:07:40'),
(408, 6, 0, 544, '220.000,00', 0, 1, '2023-05-16 16:07:40'),
(409, 6, 0, 545, '133.952,00', 0, 1, '2023-05-16 16:07:40'),
(410, 6, 0, 546, '117.000,00', 0, 1, '2023-05-16 16:07:41'),
(411, 6, 0, 547, '60.037,00', 0, 1, '2023-05-16 16:07:41'),
(412, 6, 0, 548, '239.999,00', 0, 1, '2023-05-16 16:07:41'),
(413, 6, 0, 549, '102.942,00', 0, 1, '2023-05-16 16:07:41'),
(414, 6, 0, 550, '27.455,00', 0, 1, '2023-05-16 16:07:41'),
(415, 6, 0, 551, '235.980,00', 0, 1, '2023-05-16 16:07:42'),
(416, 6, 0, 552, '30.900,00', 0, 1, '2023-05-16 16:07:42'),
(417, 6, 0, 553, '10.710,00', 0, 1, '2023-05-16 16:07:42'),
(418, 6, 0, 554, '256.960,00', 0, 1, '2023-05-16 16:07:42'),
(419, 6, 0, 557, '14.530,00', 0, 1, '2023-05-16 16:07:43'),
(420, 6, 0, 558, '28.494,00', 0, 1, '2023-05-16 16:07:43'),
(421, 6, 0, 559, '134.178,00', 0, 1, '2023-05-16 16:07:44'),
(422, 6, 0, 560, '74.388,00', 0, 1, '2023-05-16 16:07:44'),
(423, 6, 0, 561, '249.900,00', 0, 1, '2023-05-16 16:07:44'),
(424, 6, 0, 562, '88.341,00', 0, 1, '2023-05-16 16:07:44'),
(425, 6, 0, 563, '20.000,00', 0, 1, '2023-05-16 16:07:44'),
(426, 6, 0, 564, '48.250,00', 0, 1, '2023-05-16 16:07:45'),
(427, 6, 0, 565, '3.844.925,00', 0, 1, '2023-05-16 16:07:45'),
(428, 6, 0, 566, '209.635,00', 0, 1, '2023-05-16 16:07:45'),
(429, 6, 0, 567, '129.900,00', 0, 1, '2023-05-16 16:07:45'),
(430, 6, 0, 568, '5712,00', 0, 1, '2023-05-16 16:07:46'),
(431, 6, 0, 569, '93.965,00', 0, 1, '2023-05-16 16:07:46'),
(432, 6, 0, 570, '46.886,00', 0, 1, '2023-05-16 16:07:46'),
(433, 6, 0, 571, '99.901,00', 0, 1, '2023-05-16 16:07:46'),
(434, 6, 0, 572, '48.843,00', 0, 1, '2023-05-16 16:07:47'),
(435, 6, 0, 573, '469.999,00', 0, 1, '2023-05-16 16:07:47'),
(436, 6, 0, 574, '50.000,00', 0, 1, '2023-05-16 16:07:47'),
(437, 6, 0, 575, '83.080,00', 0, 1, '2023-05-16 16:07:47'),
(438, 6, 0, 576, '120.190,00', 0, 1, '2023-05-16 16:07:48'),
(439, 6, 0, 577, '1.207.774,00', 0, 1, '2023-05-16 16:07:48'),
(440, 6, 0, 578, '92.800,00', 0, 1, '2023-05-16 16:07:48'),
(441, 6, 0, 579, '75.952,00', 0, 1, '2023-05-16 16:07:48'),
(442, 6, 0, 580, '161.955,00', 0, 1, '2023-05-16 16:07:49'),
(443, 6, 0, 581, '33.998,00', 0, 1, '2023-05-16 16:07:49'),
(444, 6, 0, 582, '13.200,00', 0, 1, '2023-05-16 16:07:49'),
(445, 6, 0, 583, '192.900,00', 0, 1, '2023-05-16 16:07:49'),
(446, 6, 0, 584, '48.000,00', 0, 1, '2023-05-16 16:07:49'),
(447, 6, 0, 585, '294.999,00', 0, 1, '2023-05-16 16:07:50'),
(448, 6, 0, 586, '116.900,00', 0, 1, '2023-05-16 16:07:50'),
(449, 6, 0, 587, '804.999,00', 0, 1, '2023-05-16 16:07:50'),
(450, 6, 0, 588, '491.203,00', 0, 1, '2023-05-16 16:07:50'),
(451, 6, 0, 589, '25.900,00', 0, 1, '2023-05-16 16:07:50'),
(452, 6, 0, 590, '19.999,00', 0, 1, '2023-05-16 16:07:51'),
(453, 6, 0, 591, '303.620,00', 0, 1, '2023-05-16 16:07:51'),
(454, 6, 0, 592, '150.000,00', 0, 1, '2023-05-16 16:07:51'),
(455, 6, 0, 594, '27.798,00', 0, 1, '2023-05-16 16:07:51'),
(456, 6, 0, 595, '515.999,00', 0, 1, '2023-05-16 16:07:52'),
(457, 6, 0, 596, '12.000,00', 0, 1, '2023-05-16 16:07:52'),
(458, 6, 0, 597, '21.197,00', 0, 1, '2023-05-16 16:07:52'),
(459, 6, 0, 598, '759.698,00', 0, 1, '2023-05-16 16:07:52'),
(460, 6, 0, 599, '49.999,00', 0, 1, '2023-05-16 16:07:52'),
(461, 6, 0, 600, '827.021,00', 0, 1, '2023-05-16 16:07:53'),
(462, 6, 0, 601, '596.399,00', 0, 1, '2023-05-16 16:07:53'),
(463, 6, 0, 602, '147.609,00', 0, 1, '2023-05-16 16:07:53'),
(464, 6, 0, 603, '385.000,00', 0, 1, '2023-05-16 16:07:53'),
(465, 6, 0, 604, '10.195.378,00', 0, 1, '2023-05-16 16:07:53'),
(466, 6, 0, 605, '0,00', 0, 1, '2023-05-16 16:07:54'),
(467, 6, 0, 606, '7200,00', 0, 1, '2023-05-16 16:07:54'),
(468, 6, 0, 608, '364.990,00', 0, 1, '2023-05-16 16:07:54'),
(469, 6, 0, 609, '777.731,00', 0, 1, '2023-05-16 16:07:55'),
(470, 6, 0, 610, '3.719.890,00', 0, 1, '2023-05-16 16:07:55'),
(471, 6, 0, 611, '6200,00', 0, 1, '2023-05-16 16:07:55'),
(472, 6, 0, 612, '21.990,00', 0, 1, '2023-05-16 16:07:55'),
(473, 6, 0, 613, '53.499,00', 0, 1, '2023-05-16 16:07:55'),
(474, 6, 0, 614, '44.800,00', 0, 1, '2023-05-16 16:07:56'),
(475, 6, 0, 615, '102.000,00', 0, 1, '2023-05-16 16:07:56'),
(476, 6, 0, 616, '17.739,00', 0, 1, '2023-05-16 16:07:56'),
(477, 6, 0, 617, '27.600,00', 0, 1, '2023-05-16 16:07:56'),
(478, 6, 0, 618, '97.800,00', 0, 1, '2023-05-16 16:07:56'),
(479, 6, 0, 619, '1.198.318,00', 0, 1, '2023-05-16 16:07:57'),
(480, 6, 0, 620, '178.599,00', 0, 1, '2023-05-16 16:07:57'),
(481, 6, 0, 621, '479.999,00', 0, 1, '2023-05-16 16:07:57'),
(482, 6, 0, 622, '1.095.894,00', 0, 1, '2023-05-16 16:07:57'),
(483, 6, 0, 623, '12.000,00', 0, 1, '2023-05-16 16:07:57'),
(484, 6, 0, 624, '16.175.407,00', 0, 1, '2023-05-16 16:07:58'),
(485, 6, 0, 625, '183.300,00', 0, 1, '2023-05-16 16:07:58'),
(486, 6, 0, 626, '26.000,00', 0, 1, '2023-05-16 16:07:58'),
(487, 6, 0, 627, '138.900,00', 0, 1, '2023-05-16 16:07:58'),
(488, 6, 0, 628, '39.931,00', 0, 1, '2023-05-16 16:07:59'),
(489, 6, 0, 630, '12.000,00', 0, 1, '2023-05-16 16:07:59'),
(490, 6, 0, 631, '226.800,00', 0, 1, '2023-05-16 16:07:59'),
(491, 6, 0, 632, '557.899,00', 0, 1, '2023-05-16 16:08:00'),
(492, 6, 0, 633, '430.000,00', 0, 1, '2023-05-16 16:08:00'),
(493, 6, 0, 634, '239.861,00', 0, 1, '2023-05-16 16:08:00'),
(494, 6, 0, 636, '15.074,00', 0, 1, '2023-05-16 16:08:01'),
(495, 6, 0, 637, '591.224,00', 0, 1, '2023-05-16 16:08:01'),
(496, 6, 0, 638, '22.599,00', 0, 1, '2023-05-16 16:08:01'),
(497, 6, 0, 639, '13.500,00', 0, 1, '2023-05-16 16:08:01'),
(498, 6, 0, 641, '162.381,00', 0, 1, '2023-05-16 16:08:02'),
(499, 6, 0, 642, '239.999,00', 0, 1, '2023-05-16 16:08:02'),
(500, 6, 0, 645, '11.500,00', 0, 1, '2023-05-16 16:08:02'),
(501, 6, 0, 646, '28.050,00', 0, 1, '2023-05-16 16:08:03'),
(502, 6, 0, 654, '340.596,00', 0, 1, '2023-05-16 16:08:04'),
(503, 6, 0, 655, '249.900,00', 0, 1, '2023-05-16 16:08:05'),
(504, 6, 0, 656, '46.886,00', 0, 1, '2023-05-16 16:12:38'),
(505, 6, 0, 657, '150.000,00', 0, 1, '2023-05-16 16:12:38'),
(506, 6, 0, 658, '178.599,00', 0, 1, '2023-05-16 16:12:38'),
(507, 6, 0, 659, '21.197,00', 0, 1, '2023-05-16 16:12:39'),
(508, 6, 0, 660, '99.901,00', 0, 1, '2023-05-16 16:12:39'),
(509, 6, 0, 661, '977.698,00', 0, 1, '2023-05-16 16:12:39'),
(510, 6, 0, 662, '294.999,00', 0, 1, '2023-05-16 16:12:39'),
(511, 6, 0, 663, '83.080,00', 0, 1, '2023-05-16 16:12:39'),
(512, 6, 0, 664, '777.731,00', 0, 1, '2023-05-16 16:12:40'),
(513, 6, 0, 665, '700.000,00', 0, 1, '2023-05-16 16:12:40'),
(514, 6, 0, 666, '183.300,00', 0, 1, '2023-05-16 16:12:40'),
(515, 6, 0, 667, '30.900,00', 0, 1, '2023-05-16 16:12:40'),
(516, 6, 0, 668, '596.399,00', 0, 1, '2023-05-16 16:12:41'),
(517, 6, 0, 669, '27.600,00', 0, 1, '2023-05-16 16:12:41'),
(518, 6, 0, 670, '8399,00', 0, 1, '2023-05-16 16:12:41'),
(519, 6, 0, 671, '27.455,00', 0, 1, '2023-05-16 16:12:41'),
(520, 6, 0, 672, '5712,00', 0, 1, '2023-05-16 16:12:42'),
(521, 6, 0, 673, '25.900,00', 0, 1, '2023-05-16 16:12:42'),
(522, 6, 0, 674, '74.388,00', 0, 1, '2023-05-16 16:12:42'),
(523, 6, 0, 675, '209.635,00', 0, 1, '2023-05-16 16:12:42'),
(524, 6, 0, 676, '14.530,00', 0, 1, '2023-05-16 16:12:42'),
(525, 6, 0, 677, '249.900,00', 0, 1, '2023-05-16 16:12:43'),
(526, 6, 0, 678, '0,00', 0, 1, '2023-05-16 16:12:43'),
(527, 6, 0, 679, '235.980,00', 0, 1, '2023-05-16 16:12:43'),
(528, 6, 0, 680, '129.900,00', 0, 1, '2023-05-16 16:12:43'),
(529, 6, 0, 681, '39.931,00', 0, 1, '2023-05-16 16:12:43'),
(530, 6, 0, 682, '162.381,00', 0, 1, '2023-05-16 16:12:44'),
(531, 6, 0, 683, '93.965,00', 0, 1, '2023-05-16 16:12:44'),
(532, 6, 0, 684, '48.250,00', 0, 1, '2023-05-16 16:12:44'),
(533, 6, 0, 685, '239.999,00', 0, 1, '2023-05-16 16:12:44'),
(534, 6, 0, 686, '92.800,00', 0, 1, '2023-05-16 16:12:45'),
(535, 6, 0, 687, '88.341,00', 0, 1, '2023-05-16 16:12:45'),
(536, 6, 0, 688, '430.000,00', 0, 1, '2023-05-16 16:12:45'),
(537, 6, 0, 689, '249.900,00', 0, 1, '2023-05-16 16:12:45'),
(538, 6, 0, 690, '239.999,00', 0, 1, '2023-05-16 16:12:45'),
(539, 6, 0, 691, '220.000,00', 0, 1, '2023-05-16 16:12:46'),
(540, 6, 0, 692, '113.716,00', 0, 1, '2023-05-16 16:12:46'),
(541, 6, 0, 693, '21.990,00', 0, 1, '2023-05-16 16:12:46'),
(542, 6, 0, 694, '48.000,00', 0, 1, '2023-05-16 16:12:46'),
(543, 6, 0, 695, '134.178,00', 0, 1, '2023-05-16 16:12:46'),
(544, 6, 0, 696, '60.037,00', 0, 1, '2023-05-16 16:12:47'),
(545, 6, 0, 697, '19.999,00', 0, 1, '2023-05-16 16:12:47'),
(546, 6, 0, 698, '272.020,00', 0, 1, '2023-05-16 16:12:47'),
(547, 6, 0, 699, '479.999,00', 0, 1, '2023-05-16 16:12:47'),
(548, 6, 0, 700, '515.999,00', 0, 1, '2023-05-16 16:12:48'),
(549, 6, 0, 701, '116.900,00', 0, 1, '2023-05-16 16:12:48'),
(550, 6, 0, 702, '16.175.407,00', 0, 1, '2023-05-16 16:12:48'),
(551, 6, 0, 703, '804.999,00', 0, 1, '2023-05-16 16:12:48'),
(552, 6, 0, 704, '303.620,00', 0, 1, '2023-05-16 16:12:48'),
(553, 6, 0, 705, '340.596,00', 0, 1, '2023-05-16 16:12:49'),
(554, 6, 0, 706, '13.200,00', 0, 1, '2023-05-16 16:12:49'),
(555, 6, 0, 707, '759.698,00', 0, 1, '2023-05-16 16:12:49'),
(556, 6, 0, 709, '3.719.890,00', 0, 1, '2023-05-16 16:12:50'),
(557, 6, 0, 710, '13.500,00', 0, 1, '2023-05-16 16:12:50'),
(558, 6, 0, 711, '44.800,00', 0, 1, '2023-05-16 16:12:50'),
(559, 6, 0, 712, '161.955,00', 0, 1, '2023-05-16 16:12:50'),
(560, 6, 0, 713, '11.500,00', 0, 1, '2023-05-16 16:12:50'),
(561, 6, 0, 714, '1.638.003,00', 0, 1, '2023-05-16 16:12:51'),
(562, 6, 0, 715, '53.499,00', 0, 1, '2023-05-16 16:12:51'),
(563, 6, 0, 716, '341.288,00', 0, 1, '2023-05-16 16:12:51'),
(564, 6, 0, 717, '49.999,00', 0, 1, '2023-05-16 16:12:51'),
(565, 6, 0, 718, '26.000,00', 0, 1, '2023-05-16 16:12:52'),
(566, 6, 0, 719, '7200,00', 0, 1, '2023-05-16 16:12:52'),
(567, 6, 0, 720, '75.952,00', 0, 1, '2023-05-16 16:12:52'),
(568, 6, 0, 721, '3.844.925,00', 0, 1, '2023-05-16 16:12:52'),
(569, 6, 0, 722, '147.609,00', 0, 1, '2023-05-16 16:12:52'),
(570, 6, 0, 723, '239.861,00', 0, 1, '2023-05-16 16:12:53'),
(571, 6, 0, 724, '0,00', 0, 1, '2023-05-16 16:12:53'),
(572, 6, 0, 725, '20.000,00', 0, 1, '2023-05-16 16:12:53'),
(573, 6, 0, 726, '22.599,00', 0, 1, '2023-05-16 16:12:53'),
(574, 6, 0, 727, '226.800,00', 0, 1, '2023-05-16 16:12:53'),
(575, 6, 0, 729, '385.000,00', 0, 1, '2023-05-16 16:12:54'),
(576, 6, 0, 730, '48.843,00', 0, 1, '2023-05-16 16:12:54'),
(577, 6, 0, 731, '491.203,00', 0, 1, '2023-05-16 16:12:54'),
(578, 6, 0, 732, '138.900,00', 0, 1, '2023-05-16 16:12:54'),
(579, 6, 0, 734, '1.198.318,00', 0, 1, '2023-05-16 16:12:55'),
(580, 6, 0, 735, '133.952,00', 0, 1, '2023-05-16 16:12:55'),
(581, 6, 0, 736, '1.207.774,00', 0, 1, '2023-05-16 16:12:55'),
(582, 6, 0, 737, '102.000,00', 0, 1, '2023-05-16 16:12:55'),
(583, 6, 0, 738, '209.959,00', 0, 1, '2023-05-16 16:12:56'),
(584, 6, 0, 739, '591.224,00', 0, 1, '2023-05-16 16:12:56'),
(585, 6, 0, 740, '6200,00', 0, 1, '2023-05-16 16:12:56'),
(586, 6, 0, 741, '192.900,00', 0, 1, '2023-05-16 16:12:56'),
(587, 6, 0, 742, '120.190,00', 0, 1, '2023-05-16 16:12:57'),
(588, 6, 0, 743, '117.000,00', 0, 1, '2023-05-16 16:12:57'),
(589, 6, 0, 744, '1.346.349,00', 0, 1, '2023-05-16 16:12:57'),
(590, 6, 0, 745, '256.960,00', 0, 1, '2023-05-16 16:12:57'),
(591, 6, 0, 746, '557.899,00', 0, 1, '2023-05-16 16:12:57'),
(592, 6, 0, 747, '50.000,00', 0, 1, '2023-05-16 16:12:57'),
(593, 6, 0, 748, '33.998,00', 0, 1, '2023-05-16 16:12:58'),
(594, 6, 0, 749, '10.710,00', 0, 1, '2023-05-16 16:12:58'),
(595, 6, 0, 750, '28.494,00', 0, 1, '2023-05-16 16:12:58'),
(596, 6, 0, 752, '102.942,00', 0, 1, '2023-05-16 16:12:59'),
(597, 6, 0, 753, '12.000,00', 0, 1, '2023-05-16 16:12:59'),
(598, 6, 0, 754, '17.739,00', 0, 1, '2023-05-16 16:12:59'),
(599, 6, 0, 756, '469.999,00', 0, 1, '2023-05-16 16:12:59'),
(600, 6, 0, 757, '827.021,00', 0, 1, '2023-05-16 16:13:00'),
(601, 6, 0, 758, '185.999,00', 0, 1, '2023-05-16 16:13:00'),
(602, 6, 0, 759, '10.195.378,00', 0, 1, '2023-05-16 16:13:00'),
(603, 6, 0, 760, '28.050,00', 0, 1, '2023-05-16 16:13:00'),
(604, 6, 0, 761, '1.095.894,00', 0, 1, '2023-05-16 16:13:01'),
(605, 6, 0, 763, '97.800,00', 0, 1, '2023-05-16 16:13:01'),
(606, 6, 0, 764, '364.990,00', 0, 1, '2023-05-16 16:13:01'),
(607, 6, 0, 765, '27.798,00', 0, 1, '2023-05-16 16:13:02'),
(608, 6, 0, 771, '15.074,00', 0, 1, '2023-05-16 16:13:03'),
(609, 6, 0, 780, '162.381,00', 0, 1, '2023-05-16 16:33:27'),
(610, 6, 0, 781, '209.959,00', 0, 1, '2023-05-16 16:33:28'),
(611, 6, 0, 782, '209.635,00', 0, 1, '2023-05-16 16:33:28'),
(612, 6, 0, 784, '17.739,00', 0, 1, '2023-05-16 16:33:28'),
(613, 6, 0, 786, '97.800,00', 0, 1, '2023-05-16 16:33:29'),
(614, 6, 0, 787, '50.000,00', 0, 1, '2023-05-16 16:33:29'),
(615, 6, 0, 788, '239.999,00', 0, 1, '2023-05-16 16:33:29'),
(616, 6, 0, 789, '303.620,00', 0, 1, '2023-05-16 16:33:29'),
(617, 6, 0, 790, '46.886,00', 0, 1, '2023-05-16 16:33:30'),
(618, 6, 0, 791, '22.599,00', 0, 1, '2023-05-16 16:33:30'),
(619, 6, 0, 792, '226.800,00', 0, 1, '2023-05-16 16:33:30'),
(620, 6, 0, 793, '113.716,00', 0, 1, '2023-05-16 16:33:30'),
(621, 6, 0, 794, '804.999,00', 0, 1, '2023-05-16 16:33:31'),
(622, 6, 0, 796, '364.990,00', 0, 1, '2023-05-16 16:33:31'),
(623, 6, 0, 797, '10.710,00', 0, 1, '2023-05-16 16:33:31'),
(624, 6, 0, 798, '16.175.407,00', 0, 1, '2023-05-16 16:33:31'),
(625, 6, 0, 799, '48.000,00', 0, 1, '2023-05-16 16:33:32'),
(626, 6, 0, 800, '27.600,00', 0, 1, '2023-05-16 16:33:32'),
(627, 6, 0, 801, '83.080,00', 0, 1, '2023-05-16 16:33:32'),
(628, 6, 0, 802, '479.999,00', 0, 1, '2023-05-16 16:33:32'),
(629, 6, 0, 803, '20.000,00', 0, 1, '2023-05-16 16:33:32'),
(630, 6, 0, 804, '75.952,00', 0, 1, '2023-05-16 16:33:33'),
(631, 6, 0, 805, '239.999,00', 0, 1, '2023-05-16 16:33:33'),
(632, 6, 0, 806, '1.638.003,00', 0, 1, '2023-05-16 16:33:33'),
(633, 6, 0, 807, '591.224,00', 0, 1, '2023-05-16 16:33:33'),
(634, 6, 0, 808, '8399,00', 0, 1, '2023-05-16 16:33:33'),
(635, 6, 0, 809, '116.900,00', 0, 1, '2023-05-16 16:33:34'),
(636, 6, 0, 810, '700.000,00', 0, 1, '2023-05-16 16:33:34'),
(637, 6, 0, 811, '5712,00', 0, 1, '2023-05-16 16:33:34'),
(638, 6, 0, 812, '178.599,00', 0, 1, '2023-05-16 16:33:34'),
(639, 6, 0, 813, '10.195.378,00', 0, 1, '2023-05-16 16:33:35'),
(640, 6, 0, 814, '102.000,00', 0, 1, '2023-05-16 16:33:35'),
(641, 6, 0, 816, '1.207.774,00', 0, 1, '2023-05-16 16:33:35'),
(642, 6, 0, 817, '99.901,00', 0, 1, '2023-05-16 16:33:35'),
(643, 6, 0, 818, '60.037,00', 0, 1, '2023-05-16 16:33:36'),
(644, 6, 0, 819, '596.399,00', 0, 1, '2023-05-16 16:33:36'),
(645, 6, 0, 820, '28.494,00', 0, 1, '2023-05-16 16:33:36'),
(646, 6, 0, 821, '294.999,00', 0, 1, '2023-05-16 16:33:36'),
(647, 6, 0, 822, '48.843,00', 0, 1, '2023-05-16 16:33:37'),
(648, 6, 0, 823, '161.955,00', 0, 1, '2023-05-16 16:33:37'),
(649, 6, 0, 824, '183.300,00', 0, 1, '2023-05-16 16:33:37'),
(650, 6, 0, 825, '827.021,00', 0, 1, '2023-05-16 16:33:37'),
(651, 6, 0, 826, '3.719.890,00', 0, 1, '2023-05-16 16:33:38'),
(652, 6, 0, 827, '27.798,00', 0, 1, '2023-05-16 16:33:38'),
(653, 6, 0, 828, '12.000,00', 0, 1, '2023-05-16 16:33:38'),
(654, 6, 0, 829, '13.200,00', 0, 1, '2023-05-16 16:33:38'),
(655, 6, 0, 830, '192.900,00', 0, 1, '2023-05-16 16:33:39'),
(656, 6, 0, 832, '21.197,00', 0, 1, '2023-05-16 16:33:39'),
(657, 6, 0, 834, '239.861,00', 0, 1, '2023-05-16 16:33:39'),
(658, 6, 0, 835, '185.999,00', 0, 1, '2023-05-16 16:33:40'),
(659, 6, 0, 836, '129.900,00', 0, 1, '2023-05-16 16:33:40'),
(660, 6, 0, 837, '249.900,00', 0, 1, '2023-05-16 16:33:40'),
(661, 6, 0, 838, '469.999,00', 0, 1, '2023-05-16 16:33:41'),
(662, 6, 0, 840, '12.000,00', 0, 1, '2023-05-16 16:33:41'),
(663, 6, 0, 841, '0,00', 0, 1, '2023-05-16 16:33:41'),
(664, 6, 0, 842, '26.000,00', 0, 1, '2023-05-16 16:33:42'),
(665, 6, 0, 843, '92.800,00', 0, 1, '2023-05-16 16:33:42'),
(666, 6, 0, 844, '557.899,00', 0, 1, '2023-05-16 16:33:42'),
(667, 6, 0, 846, '235.980,00', 0, 1, '2023-05-16 16:33:42'),
(668, 6, 0, 847, '220.000,00', 0, 1, '2023-05-16 16:33:43'),
(669, 6, 0, 848, '117.000,00', 0, 1, '2023-05-16 16:33:43'),
(670, 6, 0, 849, '39.931,00', 0, 1, '2023-05-16 16:33:43'),
(671, 6, 0, 850, '341.288,00', 0, 1, '2023-05-16 16:33:43'),
(672, 6, 0, 851, '33.998,00', 0, 1, '2023-05-16 16:33:43'),
(673, 6, 0, 852, '25.900,00', 0, 1, '2023-05-16 16:33:44'),
(674, 6, 0, 853, '1.198.318,00', 0, 1, '2023-05-16 16:33:44'),
(675, 6, 0, 854, '491.203,00', 0, 1, '2023-05-16 16:33:44'),
(676, 6, 0, 855, '12.000,00', 0, 1, '2023-05-16 16:33:44'),
(677, 6, 0, 856, '120.190,00', 0, 1, '2023-05-16 16:33:44'),
(678, 6, 0, 857, '53.499,00', 0, 1, '2023-05-16 16:33:45'),
(679, 6, 0, 858, '7200,00', 0, 1, '2023-05-16 16:33:45'),
(680, 6, 0, 859, '30.900,00', 0, 1, '2023-05-16 16:33:45'),
(681, 6, 0, 860, '6200,00', 0, 1, '2023-05-16 16:33:45'),
(682, 6, 0, 861, '93.965,00', 0, 1, '2023-05-16 16:33:46'),
(683, 6, 0, 862, '27.455,00', 0, 1, '2023-05-16 16:33:46'),
(684, 6, 0, 863, '1.095.894,00', 0, 1, '2023-05-16 16:33:46'),
(685, 6, 0, 864, '515.999,00', 0, 1, '2023-05-16 16:33:46'),
(686, 6, 0, 866, '133.952,00', 0, 1, '2023-05-16 16:33:47'),
(687, 6, 0, 867, '134.178,00', 0, 1, '2023-05-16 16:33:47'),
(688, 6, 0, 868, '49.999,00', 0, 1, '2023-05-16 16:33:47'),
(689, 6, 0, 869, '21.990,00', 0, 1, '2023-05-16 16:33:47'),
(690, 6, 0, 870, '13.500,00', 0, 1, '2023-05-16 16:33:47'),
(691, 6, 0, 871, '102.942,00', 0, 1, '2023-05-16 16:33:48'),
(692, 6, 0, 872, '977.698,00', 0, 1, '2023-05-16 16:33:48'),
(693, 6, 0, 873, '88.341,00', 0, 1, '2023-05-16 16:33:48'),
(694, 6, 0, 874, '74.388,00', 0, 1, '2023-05-16 16:33:48'),
(695, 6, 0, 875, '147.609,00', 0, 1, '2023-05-16 16:33:49'),
(696, 6, 0, 876, '11.500,00', 0, 1, '2023-05-16 16:33:49'),
(697, 6, 0, 877, '138.900,00', 0, 1, '2023-05-16 16:33:49'),
(698, 6, 0, 879, '14.530,00', 0, 1, '2023-05-16 16:33:50'),
(699, 6, 0, 880, '0,00', 0, 1, '2023-05-16 16:33:50'),
(700, 6, 0, 881, '3.844.925,00', 0, 1, '2023-05-16 16:33:50'),
(701, 6, 0, 883, '430.000,00', 0, 1, '2023-05-16 16:33:50'),
(702, 6, 0, 884, '249.900,00', 0, 1, '2023-05-16 16:33:51'),
(703, 6, 0, 885, '256.960,00', 0, 1, '2023-05-16 16:33:51'),
(704, 6, 0, 886, '272.020,00', 0, 1, '2023-05-16 16:33:51'),
(705, 6, 0, 887, '759.698,00', 0, 1, '2023-05-16 16:33:51'),
(706, 6, 0, 888, '44.800,00', 0, 1, '2023-05-16 16:33:52'),
(707, 6, 0, 889, '48.250,00', 0, 1, '2023-05-16 16:33:52'),
(708, 6, 0, 891, '340.596,00', 0, 1, '2023-05-16 16:33:52'),
(709, 6, 0, 892, '19.999,00', 0, 1, '2023-05-16 16:33:53'),
(710, 6, 0, 893, '777.731,00', 0, 1, '2023-05-16 16:33:53'),
(711, 6, 0, 895, '1.346.349,00', 0, 1, '2023-05-16 16:33:53'),
(712, 6, 0, 896, '28.050,00', 0, 1, '2023-05-16 16:33:53'),
(713, 6, 0, 897, '15.074,00', 0, 1, '2023-05-16 16:33:54'),
(714, 6, 0, 904, '14.530,00', 0, 1, '2023-05-16 16:44:11'),
(715, 6, 0, 905, '303.620,00', 0, 1, '2023-05-16 16:44:11'),
(716, 6, 0, 906, '1.198.318,00', 0, 1, '2023-05-16 16:44:12'),
(717, 6, 0, 907, '50.000,00', 0, 1, '2023-05-16 16:44:12'),
(718, 6, 0, 908, '1.207.774,00', 0, 1, '2023-05-16 16:44:12'),
(719, 6, 0, 909, '0,00', 0, 1, '2023-05-16 16:44:12'),
(720, 6, 0, 910, '515.999,00', 0, 1, '2023-05-16 16:44:12'),
(721, 6, 0, 911, '26.000,00', 0, 1, '2023-05-16 16:44:13'),
(722, 6, 0, 912, '591.224,00', 0, 1, '2023-05-16 16:44:13'),
(723, 6, 0, 913, '491.203,00', 0, 1, '2023-05-16 16:44:13'),
(724, 6, 0, 915, '185.999,00', 0, 1, '2023-05-16 16:44:13'),
(725, 6, 0, 916, '27.798,00', 0, 1, '2023-05-16 16:44:14'),
(726, 6, 0, 917, '479.999,00', 0, 1, '2023-05-16 16:44:14'),
(727, 6, 0, 918, '46.886,00', 0, 1, '2023-05-16 16:44:14'),
(728, 6, 0, 919, '53.499,00', 0, 1, '2023-05-16 16:44:14'),
(729, 6, 0, 920, '272.020,00', 0, 1, '2023-05-16 16:44:15'),
(730, 6, 0, 921, '48.250,00', 0, 1, '2023-05-16 16:44:15'),
(731, 6, 0, 922, '0,00', 0, 1, '2023-05-16 16:44:15'),
(732, 6, 0, 924, '102.000,00', 0, 1, '2023-05-16 16:44:15'),
(733, 6, 0, 925, '364.990,00', 0, 1, '2023-05-16 16:44:16'),
(734, 6, 0, 926, '161.955,00', 0, 1, '2023-05-16 16:44:16'),
(735, 6, 0, 927, '3.844.925,00', 0, 1, '2023-05-16 16:44:16'),
(736, 6, 0, 928, '27.455,00', 0, 1, '2023-05-16 16:44:16'),
(737, 6, 0, 929, '5712,00', 0, 1, '2023-05-16 16:44:16'),
(738, 6, 0, 930, '340.596,00', 0, 1, '2023-05-16 16:44:17'),
(739, 6, 0, 931, '33.998,00', 0, 1, '2023-05-16 16:44:17'),
(740, 6, 0, 932, '92.800,00', 0, 1, '2023-05-16 16:44:17'),
(741, 6, 0, 933, '44.800,00', 0, 1, '2023-05-16 16:44:17'),
(742, 6, 0, 934, '74.388,00', 0, 1, '2023-05-16 16:44:17'),
(743, 6, 0, 935, '120.190,00', 0, 1, '2023-05-16 16:44:18'),
(744, 6, 0, 936, '192.900,00', 0, 1, '2023-05-16 16:44:18'),
(745, 6, 0, 937, '3.719.890,00', 0, 1, '2023-05-16 16:44:18'),
(746, 6, 0, 939, '102.942,00', 0, 1, '2023-05-16 16:44:18'),
(747, 6, 0, 940, '16.175.407,00', 0, 1, '2023-05-16 16:44:19'),
(748, 6, 0, 941, '48.843,00', 0, 1, '2023-05-16 16:44:19'),
(749, 6, 0, 942, '1.346.349,00', 0, 1, '2023-05-16 16:44:19'),
(750, 6, 0, 943, '256.960,00', 0, 1, '2023-05-16 16:44:19'),
(751, 6, 0, 944, '133.952,00', 0, 1, '2023-05-16 16:44:20'),
(752, 6, 0, 945, '138.900,00', 0, 1, '2023-05-16 16:44:20'),
(753, 6, 0, 946, '20.000,00', 0, 1, '2023-05-16 16:44:20'),
(754, 6, 0, 947, '249.900,00', 0, 1, '2023-05-16 16:44:20'),
(755, 6, 0, 948, '21.197,00', 0, 1, '2023-05-16 16:44:20'),
(756, 6, 0, 949, '147.609,00', 0, 1, '2023-05-16 16:44:21'),
(757, 6, 0, 950, '150.000,00', 0, 1, '2023-05-16 16:44:21'),
(758, 6, 0, 951, '21.990,00', 0, 1, '2023-05-16 16:44:21'),
(759, 6, 0, 952, '239.999,00', 0, 1, '2023-05-16 16:44:21'),
(760, 6, 0, 953, '48.000,00', 0, 1, '2023-05-16 16:44:21'),
(761, 6, 0, 954, '469.999,00', 0, 1, '2023-05-16 16:44:21'),
(762, 6, 0, 955, '596.399,00', 0, 1, '2023-05-16 16:44:22'),
(763, 6, 0, 956, '75.952,00', 0, 1, '2023-05-16 16:44:22'),
(764, 6, 0, 957, '6200,00', 0, 1, '2023-05-16 16:44:22'),
(765, 6, 0, 959, '60.037,00', 0, 1, '2023-05-16 16:44:22'),
(766, 6, 0, 960, '700.000,00', 0, 1, '2023-05-16 16:44:23'),
(767, 6, 0, 961, '88.341,00', 0, 1, '2023-05-16 16:44:23'),
(768, 6, 0, 962, '1.095.894,00', 0, 1, '2023-05-16 16:44:23'),
(769, 6, 0, 963, '804.999,00', 0, 1, '2023-05-16 16:44:23'),
(770, 6, 0, 964, '12.000,00', 0, 1, '2023-05-16 16:44:23'),
(771, 6, 0, 965, '827.021,00', 0, 1, '2023-05-16 16:44:24'),
(772, 6, 0, 966, '385.000,00', 0, 1, '2023-05-16 16:44:24'),
(773, 6, 0, 967, '30.900,00', 0, 1, '2023-05-16 16:44:24'),
(774, 6, 0, 968, '183.300,00', 0, 1, '2023-05-16 16:44:24'),
(775, 6, 0, 969, '7200,00', 0, 1, '2023-05-16 16:44:24'),
(776, 6, 0, 970, '430.000,00', 0, 1, '2023-05-16 16:44:25'),
(777, 6, 0, 971, '39.931,00', 0, 1, '2023-05-16 16:44:25'),
(778, 6, 0, 973, '93.965,00', 0, 1, '2023-05-16 16:44:25'),
(779, 6, 0, 974, '249.900,00', 0, 1, '2023-05-16 16:44:26'),
(780, 6, 0, 975, '235.980,00', 0, 1, '2023-05-16 16:44:26'),
(781, 6, 0, 976, '239.861,00', 0, 1, '2023-05-16 16:44:26'),
(782, 6, 0, 977, '10.195.378,00', 0, 1, '2023-05-16 16:44:26'),
(783, 6, 0, 978, '22.599,00', 0, 1, '2023-05-16 16:44:26'),
(784, 6, 0, 979, '13.500,00', 0, 1, '2023-05-16 16:44:26'),
(785, 6, 0, 980, '15.074,00', 0, 1, '2023-05-16 16:44:27'),
(786, 6, 0, 981, '777.731,00', 0, 1, '2023-05-16 16:44:27'),
(787, 6, 0, 982, '341.288,00', 0, 1, '2023-05-16 16:44:27'),
(788, 6, 0, 985, '12.000,00', 0, 1, '2023-05-16 16:44:28'),
(789, 6, 0, 986, '239.999,00', 0, 1, '2023-05-16 16:44:28'),
(790, 6, 0, 987, '49.999,00', 0, 1, '2023-05-16 16:44:28'),
(791, 6, 0, 988, '28.494,00', 0, 1, '2023-05-16 16:44:28'),
(792, 6, 0, 989, '25.900,00', 0, 1, '2023-05-16 16:44:29'),
(793, 6, 0, 990, '162.381,00', 0, 1, '2023-05-16 16:44:29'),
(794, 6, 0, 991, '226.800,00', 0, 1, '2023-05-16 16:44:29'),
(795, 6, 0, 992, '134.178,00', 0, 1, '2023-05-16 16:44:29'),
(796, 6, 0, 993, '557.899,00', 0, 1, '2023-05-16 16:44:29'),
(797, 6, 0, 994, '13.200,00', 0, 1, '2023-05-16 16:44:30'),
(798, 6, 0, 995, '99.901,00', 0, 1, '2023-05-16 16:44:30'),
(799, 6, 0, 997, '116.900,00', 0, 1, '2023-05-16 16:44:30'),
(800, 6, 0, 998, '17.739,00', 0, 1, '2023-05-16 16:44:30'),
(801, 6, 0, 999, '129.900,00', 0, 1, '2023-05-16 16:44:31'),
(802, 6, 0, 1000, '11.500,00', 0, 1, '2023-05-16 16:44:31'),
(803, 6, 0, 1002, '97.800,00', 0, 1, '2023-05-16 16:44:31'),
(804, 6, 0, 1004, '759.698,00', 0, 1, '2023-05-16 16:44:32'),
(805, 6, 0, 1005, '209.959,00', 0, 1, '2023-05-16 16:44:32'),
(806, 6, 0, 1006, '27.600,00', 0, 1, '2023-05-16 16:44:32'),
(807, 6, 0, 1008, '977.698,00', 0, 1, '2023-05-16 16:44:32'),
(808, 6, 0, 1010, '83.080,00', 0, 1, '2023-05-16 16:44:33'),
(809, 6, 0, 1011, '117.000,00', 0, 1, '2023-05-16 16:44:33'),
(810, 6, 0, 1012, '294.999,00', 0, 1, '2023-05-16 16:44:33'),
(811, 6, 0, 1013, '8399,00', 0, 1, '2023-05-16 16:44:33'),
(812, 6, 0, 1014, '28.050,00', 0, 1, '2023-05-16 16:44:34'),
(813, 6, 0, 1016, '10.710,00', 0, 1, '2023-05-16 16:44:34'),
(814, 6, 0, 1017, '220.000,00', 0, 1, '2023-05-16 16:44:34'),
(815, 6, 0, 1018, '113.716,00', 0, 1, '2023-05-16 16:44:35'),
(816, 6, 0, 1021, '19.999,00', 0, 1, '2023-05-16 16:44:35'),
(817, 6, 0, 1022, '12.000,00', 0, 1, '2023-05-16 16:44:35'),
(818, 6, 0, 1023, '209.635,00', 0, 1, '2023-05-16 16:44:36'),
(819, 6, 0, 1025, '178.599,00', 0, 1, '2023-05-16 16:44:36'),
(820, 6, 0, 1028, '1.198.318,00', 0, 1, '2023-05-16 16:53:33'),
(821, 6, 0, 1030, '13.200,00', 0, 1, '2023-05-16 16:53:33'),
(822, 6, 0, 1031, '93.965,00', 0, 1, '2023-05-16 16:53:33'),
(823, 6, 0, 1032, '27.455,00', 0, 1, '2023-05-16 16:53:34'),
(824, 6, 0, 1033, '1.207.774,00', 0, 1, '2023-05-16 16:53:34'),
(825, 6, 0, 1034, '303.620,00', 0, 1, '2023-05-16 16:53:34'),
(826, 6, 0, 1035, '150.000,00', 0, 1, '2023-05-16 16:53:34'),
(827, 6, 0, 1036, '46.886,00', 0, 1, '2023-05-16 16:53:34'),
(828, 6, 0, 1038, '147.609,00', 0, 1, '2023-05-16 16:53:35'),
(829, 6, 0, 1039, '102.942,00', 0, 1, '2023-05-16 16:53:35'),
(830, 6, 0, 1040, '256.960,00', 0, 1, '2023-05-16 16:53:35'),
(831, 6, 0, 1041, '27.600,00', 0, 1, '2023-05-16 16:53:36'),
(832, 6, 0, 1042, '99.901,00', 0, 1, '2023-05-16 16:53:36'),
(833, 6, 0, 1043, '17.739,00', 0, 1, '2023-05-16 16:53:36'),
(834, 6, 0, 1044, '28.050,00', 0, 1, '2023-05-16 16:53:36'),
(835, 6, 0, 1045, '220.000,00', 0, 1, '2023-05-16 16:53:36'),
(836, 6, 0, 1046, '92.800,00', 0, 1, '2023-05-16 16:53:37'),
(837, 6, 0, 1047, '827.021,00', 0, 1, '2023-05-16 16:53:37'),
(838, 6, 0, 1048, '185.999,00', 0, 1, '2023-05-16 16:53:37'),
(839, 6, 0, 1049, '33.998,00', 0, 1, '2023-05-16 16:53:37'),
(840, 6, 0, 1050, '16.175.407,00', 0, 1, '2023-05-16 16:53:37'),
(841, 6, 0, 1051, '209.635,00', 0, 1, '2023-05-16 16:53:38'),
(842, 6, 0, 1052, '7200,00', 0, 1, '2023-05-16 16:53:38'),
(843, 6, 0, 1053, '479.999,00', 0, 1, '2023-05-16 16:53:38'),
(844, 6, 0, 1054, '74.388,00', 0, 1, '2023-05-16 16:53:38'),
(845, 6, 0, 1055, '249.900,00', 0, 1, '2023-05-16 16:53:39'),
(846, 6, 0, 1056, '3.719.890,00', 0, 1, '2023-05-16 16:53:39'),
(847, 6, 0, 1057, '28.494,00', 0, 1, '2023-05-16 16:53:39'),
(848, 6, 0, 1058, '1.638.003,00', 0, 1, '2023-05-16 16:53:39'),
(849, 6, 0, 1061, '102.000,00', 0, 1, '2023-05-16 16:53:40'),
(850, 6, 0, 1062, '120.190,00', 0, 1, '2023-05-16 16:53:40'),
(851, 6, 0, 1064, '0,00', 0, 1, '2023-05-16 16:53:41'),
(852, 6, 0, 1065, '8399,00', 0, 1, '2023-05-16 16:53:41'),
(853, 6, 0, 1066, '25.900,00', 0, 1, '2023-05-16 16:53:41'),
(854, 6, 0, 1067, '113.716,00', 0, 1, '2023-05-16 16:53:41'),
(855, 6, 0, 1068, '364.990,00', 0, 1, '2023-05-16 16:53:41');
INSERT INTO `pagos_compras` (`id`, `numero`, `tipo`, `factura_id`, `valor`, `status`, `created_by`, `created_at`) VALUES
(856, 6, 0, 1069, '430.000,00', 0, 1, '2023-05-16 16:53:42'),
(857, 6, 0, 1070, '209.959,00', 0, 1, '2023-05-16 16:53:42'),
(858, 6, 0, 1071, '700.000,00', 0, 1, '2023-05-16 16:53:42'),
(859, 6, 0, 1072, '97.800,00', 0, 1, '2023-05-16 16:53:42'),
(860, 6, 0, 1073, '161.955,00', 0, 1, '2023-05-16 16:53:42'),
(861, 6, 0, 1074, '1.095.894,00', 0, 1, '2023-05-16 16:53:43'),
(862, 6, 0, 1075, '178.599,00', 0, 1, '2023-05-16 16:53:43'),
(863, 6, 0, 1076, '49.999,00', 0, 1, '2023-05-16 16:53:43'),
(864, 6, 0, 1077, '10.195.378,00', 0, 1, '2023-05-16 16:53:43'),
(865, 6, 0, 1078, '53.499,00', 0, 1, '2023-05-16 16:53:43'),
(866, 6, 0, 1079, '60.037,00', 0, 1, '2023-05-16 16:53:44'),
(867, 6, 0, 1081, '83.080,00', 0, 1, '2023-05-16 16:53:44'),
(868, 6, 0, 1082, '14.530,00', 0, 1, '2023-05-16 16:53:44'),
(869, 6, 0, 1083, '591.224,00', 0, 1, '2023-05-16 16:53:45'),
(870, 6, 0, 1084, '557.899,00', 0, 1, '2023-05-16 16:53:45'),
(871, 6, 0, 1085, '239.999,00', 0, 1, '2023-05-16 16:53:45'),
(872, 6, 0, 1086, '22.599,00', 0, 1, '2023-05-16 16:53:46'),
(873, 6, 0, 1087, '596.399,00', 0, 1, '2023-05-16 16:53:46'),
(874, 6, 0, 1088, '226.800,00', 0, 1, '2023-05-16 16:53:46'),
(875, 6, 0, 1089, '88.341,00', 0, 1, '2023-05-16 16:53:47'),
(876, 6, 0, 1090, '129.900,00', 0, 1, '2023-05-16 16:53:47'),
(877, 6, 0, 1091, '30.900,00', 0, 1, '2023-05-16 16:53:47'),
(878, 6, 0, 1092, '340.596,00', 0, 1, '2023-05-16 16:53:47'),
(879, 6, 0, 1093, '13.500,00', 0, 1, '2023-05-16 16:53:48'),
(880, 6, 0, 1094, '469.999,00', 0, 1, '2023-05-16 16:53:48'),
(881, 6, 0, 1095, '239.999,00', 0, 1, '2023-05-16 16:53:48'),
(882, 6, 0, 1097, '1.346.349,00', 0, 1, '2023-05-16 16:53:49'),
(883, 6, 0, 1098, '15.074,00', 0, 1, '2023-05-16 16:53:49'),
(884, 6, 0, 1099, '341.288,00', 0, 1, '2023-05-16 16:53:49'),
(885, 6, 0, 1100, '48.000,00', 0, 1, '2023-05-16 16:53:49'),
(886, 6, 0, 1101, '12.000,00', 0, 1, '2023-05-16 16:53:49'),
(887, 6, 0, 1102, '235.980,00', 0, 1, '2023-05-16 16:53:50'),
(888, 6, 0, 1103, '6200,00', 0, 1, '2023-05-16 16:53:50'),
(889, 6, 0, 1104, '133.952,00', 0, 1, '2023-05-16 16:53:50'),
(890, 6, 0, 1105, '21.990,00', 0, 1, '2023-05-16 16:53:50'),
(891, 6, 0, 1106, '116.900,00', 0, 1, '2023-05-16 16:53:50'),
(892, 6, 0, 1107, '117.000,00', 0, 1, '2023-05-16 16:53:51'),
(893, 6, 0, 1108, '239.861,00', 0, 1, '2023-05-16 16:53:51'),
(894, 6, 0, 1109, '50.000,00', 0, 1, '2023-05-16 16:53:51'),
(895, 6, 0, 1110, '162.381,00', 0, 1, '2023-05-16 16:53:51'),
(896, 6, 0, 1111, '48.843,00', 0, 1, '2023-05-16 16:53:51'),
(897, 6, 0, 1112, '138.900,00', 0, 1, '2023-05-16 16:53:52'),
(898, 6, 0, 1113, '0,00', 0, 1, '2023-05-16 16:53:52'),
(899, 6, 0, 1114, '26.000,00', 0, 1, '2023-05-16 16:53:52'),
(900, 6, 0, 1115, '20.000,00', 0, 1, '2023-05-16 16:53:53'),
(901, 6, 0, 1116, '294.999,00', 0, 1, '2023-05-16 16:53:53'),
(902, 6, 0, 1118, '977.698,00', 0, 1, '2023-05-16 16:53:53'),
(903, 6, 0, 1119, '12.000,00', 0, 1, '2023-05-16 16:53:53'),
(904, 6, 0, 1121, '3.844.925,00', 0, 1, '2023-05-16 16:53:54'),
(905, 6, 0, 1122, '19.999,00', 0, 1, '2023-05-16 16:53:54'),
(906, 6, 0, 1123, '134.178,00', 0, 1, '2023-05-16 16:53:54'),
(907, 6, 0, 1124, '183.300,00', 0, 1, '2023-05-16 16:53:54'),
(908, 6, 0, 1125, '12.000,00', 0, 1, '2023-05-16 16:53:55'),
(909, 6, 0, 1126, '5712,00', 0, 1, '2023-05-16 16:53:55'),
(910, 6, 0, 1128, '21.197,00', 0, 1, '2023-05-16 16:53:55'),
(911, 6, 0, 1129, '515.999,00', 0, 1, '2023-05-16 16:53:55'),
(912, 6, 0, 1130, '491.203,00', 0, 1, '2023-05-16 16:53:56'),
(913, 6, 0, 1131, '385.000,00', 0, 1, '2023-05-16 16:53:56'),
(914, 6, 0, 1132, '10.710,00', 0, 1, '2023-05-16 16:53:56'),
(915, 6, 0, 1133, '44.800,00', 0, 1, '2023-05-16 16:53:56'),
(916, 6, 0, 1134, '11.500,00', 0, 1, '2023-05-16 16:53:56'),
(917, 6, 0, 1136, '48.250,00', 0, 1, '2023-05-16 16:53:57'),
(918, 6, 0, 1137, '39.931,00', 0, 1, '2023-05-16 16:53:57'),
(919, 6, 0, 1138, '27.798,00', 0, 1, '2023-05-16 16:53:57'),
(920, 6, 0, 1139, '759.698,00', 0, 1, '2023-05-16 16:53:57'),
(921, 6, 0, 1140, '192.900,00', 0, 1, '2023-05-16 16:53:58'),
(922, 6, 0, 1141, '804.999,00', 0, 1, '2023-05-16 16:53:58'),
(923, 6, 0, 1142, '249.900,00', 0, 1, '2023-05-16 16:53:58'),
(924, 6, 0, 1143, '272.020,00', 0, 1, '2023-05-16 16:53:58'),
(925, 6, 0, 1144, '75.952,00', 0, 1, '2023-05-16 16:53:59'),
(926, 6, 0, 1148, '777.731,00', 0, 1, '2023-05-16 16:53:59'),
(927, 6, 0, 1154, '777.731,00', 0, 1, '2023-05-16 17:01:14'),
(928, 6, 0, 1155, '129.900,00', 0, 1, '2023-05-16 17:01:15'),
(929, 6, 0, 1156, '515.999,00', 0, 1, '2023-05-16 17:01:15'),
(930, 6, 0, 1157, '133.952,00', 0, 1, '2023-05-16 17:01:15'),
(931, 6, 0, 1158, '83.080,00', 0, 1, '2023-05-16 17:01:15'),
(932, 6, 0, 1159, '99.901,00', 0, 1, '2023-05-16 17:01:16'),
(933, 6, 0, 1160, '209.959,00', 0, 1, '2023-05-16 17:01:16'),
(934, 6, 0, 1161, '162.381,00', 0, 1, '2023-05-16 17:01:16'),
(935, 6, 0, 1162, '39.931,00', 0, 1, '2023-05-16 17:01:16'),
(936, 6, 0, 1163, '272.020,00', 0, 1, '2023-05-16 17:01:16'),
(937, 6, 0, 1164, '48.000,00', 0, 1, '2023-05-16 17:01:17'),
(938, 6, 0, 1165, '48.843,00', 0, 1, '2023-05-16 17:01:17'),
(939, 6, 0, 1166, '1.638.003,00', 0, 1, '2023-05-16 17:01:17'),
(940, 6, 0, 1167, '33.998,00', 0, 1, '2023-05-16 17:01:17'),
(941, 6, 0, 1168, '60.037,00', 0, 1, '2023-05-16 17:01:17'),
(942, 6, 0, 1169, '3.844.925,00', 0, 1, '2023-05-16 17:01:18'),
(943, 6, 0, 1170, '0,00', 0, 1, '2023-05-16 17:01:18'),
(944, 6, 0, 1171, '20.000,00', 0, 1, '2023-05-16 17:01:18'),
(945, 6, 0, 1172, '88.341,00', 0, 1, '2023-05-16 17:01:18'),
(946, 6, 0, 1173, '364.990,00', 0, 1, '2023-05-16 17:01:18'),
(947, 6, 0, 1174, '147.609,00', 0, 1, '2023-05-16 17:01:19'),
(948, 6, 0, 1175, '12.000,00', 0, 1, '2023-05-16 17:01:19'),
(949, 6, 0, 1176, '53.499,00', 0, 1, '2023-05-16 17:01:19'),
(950, 6, 0, 1177, '26.000,00', 0, 1, '2023-05-16 17:01:19'),
(951, 6, 0, 1178, '827.021,00', 0, 1, '2023-05-16 17:01:19'),
(952, 6, 0, 1179, '28.050,00', 0, 1, '2023-05-16 17:01:20'),
(953, 6, 0, 1180, '10.195.378,00', 0, 1, '2023-05-16 17:01:20'),
(954, 6, 0, 1181, '134.178,00', 0, 1, '2023-05-16 17:01:20'),
(955, 6, 0, 1182, '185.999,00', 0, 1, '2023-05-16 17:01:20'),
(956, 6, 0, 1183, '13.200,00', 0, 1, '2023-05-16 17:01:20'),
(957, 6, 0, 1184, '220.000,00', 0, 1, '2023-05-16 17:01:21'),
(958, 6, 0, 1185, '13.500,00', 0, 1, '2023-05-16 17:01:21'),
(959, 6, 0, 1186, '16.175.407,00', 0, 1, '2023-05-16 17:01:21'),
(960, 6, 0, 1187, '804.999,00', 0, 1, '2023-05-16 17:01:21'),
(961, 6, 0, 1188, '1.095.894,00', 0, 1, '2023-05-16 17:01:21'),
(962, 6, 0, 1189, '294.999,00', 0, 1, '2023-05-16 17:01:22'),
(963, 6, 0, 1190, '5712,00', 0, 1, '2023-05-16 17:01:22'),
(964, 6, 0, 1191, '17.739,00', 0, 1, '2023-05-16 17:01:22'),
(965, 6, 0, 1192, '75.952,00', 0, 1, '2023-05-16 17:01:22'),
(966, 6, 0, 1193, '6200,00', 0, 1, '2023-05-16 17:01:22'),
(967, 6, 0, 1194, '22.599,00', 0, 1, '2023-05-16 17:01:23'),
(968, 6, 0, 1195, '469.999,00', 0, 1, '2023-05-16 17:01:23'),
(969, 6, 0, 1196, '74.388,00', 0, 1, '2023-05-16 17:01:23'),
(970, 6, 0, 1198, '92.800,00', 0, 1, '2023-05-16 17:01:23'),
(971, 6, 0, 1199, '10.710,00', 0, 1, '2023-05-16 17:01:23'),
(972, 6, 0, 1200, '977.698,00', 0, 1, '2023-05-16 17:01:24'),
(973, 6, 0, 1202, '30.900,00', 0, 1, '2023-05-16 17:01:24'),
(974, 6, 0, 1203, '239.999,00', 0, 1, '2023-05-16 17:01:24'),
(975, 6, 0, 1204, '120.190,00', 0, 1, '2023-05-16 17:01:24'),
(976, 6, 0, 1205, '3.719.890,00', 0, 1, '2023-05-16 17:01:25'),
(977, 6, 0, 1206, '178.599,00', 0, 1, '2023-05-16 17:01:25'),
(978, 6, 0, 1207, '557.899,00', 0, 1, '2023-05-16 17:01:25'),
(979, 6, 0, 1208, '27.455,00', 0, 1, '2023-05-16 17:01:25'),
(980, 6, 0, 1209, '93.965,00', 0, 1, '2023-05-16 17:01:25'),
(981, 6, 0, 1210, '12.000,00', 0, 1, '2023-05-16 17:01:26'),
(982, 6, 0, 1211, '0,00', 0, 1, '2023-05-16 17:01:26'),
(983, 6, 0, 1212, '14.530,00', 0, 1, '2023-05-16 17:01:26'),
(984, 6, 0, 1213, '239.861,00', 0, 1, '2023-05-16 17:01:26'),
(985, 6, 0, 1214, '7200,00', 0, 1, '2023-05-16 17:01:26'),
(986, 6, 0, 1215, '27.600,00', 0, 1, '2023-05-16 17:01:27'),
(987, 6, 0, 1216, '479.999,00', 0, 1, '2023-05-16 17:01:27'),
(988, 6, 0, 1217, '48.250,00', 0, 1, '2023-05-16 17:01:27'),
(989, 6, 0, 1218, '209.635,00', 0, 1, '2023-05-16 17:01:27'),
(990, 6, 0, 1219, '340.596,00', 0, 1, '2023-05-16 17:01:27'),
(991, 6, 0, 1220, '46.886,00', 0, 1, '2023-05-16 17:01:28'),
(992, 6, 0, 1221, '1.346.349,00', 0, 1, '2023-05-16 17:01:28'),
(993, 6, 0, 1222, '491.203,00', 0, 1, '2023-05-16 17:01:28'),
(994, 6, 0, 1223, '12.000,00', 0, 1, '2023-05-16 17:01:28'),
(995, 6, 0, 1224, '102.000,00', 0, 1, '2023-05-16 17:01:29'),
(996, 6, 0, 1225, '183.300,00', 0, 1, '2023-05-16 17:01:29'),
(997, 6, 0, 1226, '341.288,00', 0, 1, '2023-05-16 17:01:29'),
(998, 6, 0, 1227, '138.900,00', 0, 1, '2023-05-16 17:01:29'),
(999, 6, 0, 1228, '1.198.318,00', 0, 1, '2023-05-16 17:01:29'),
(1000, 6, 0, 1230, '256.960,00', 0, 1, '2023-05-16 17:01:30'),
(1001, 6, 0, 1232, '21.197,00', 0, 1, '2023-05-16 17:01:30'),
(1002, 6, 0, 1233, '113.716,00', 0, 1, '2023-05-16 17:01:30'),
(1003, 6, 0, 1234, '596.399,00', 0, 1, '2023-05-16 17:01:30'),
(1004, 6, 0, 1235, '249.900,00', 0, 1, '2023-05-16 17:01:31'),
(1005, 6, 0, 1237, '117.000,00', 0, 1, '2023-05-16 17:01:31'),
(1006, 6, 0, 1238, '116.900,00', 0, 1, '2023-05-16 17:01:32'),
(1007, 6, 0, 1239, '102.942,00', 0, 1, '2023-05-16 17:01:32'),
(1008, 6, 0, 1240, '97.800,00', 0, 1, '2023-05-16 17:01:32'),
(1009, 6, 0, 1241, '249.900,00', 0, 1, '2023-05-16 17:01:32'),
(1010, 6, 0, 1243, '44.800,00', 0, 1, '2023-05-16 17:01:33'),
(1011, 6, 0, 1244, '235.980,00', 0, 1, '2023-05-16 17:01:33'),
(1012, 6, 0, 1245, '192.900,00', 0, 1, '2023-05-16 17:01:33'),
(1013, 6, 0, 1246, '161.955,00', 0, 1, '2023-05-16 17:01:33'),
(1014, 6, 0, 1247, '430.000,00', 0, 1, '2023-05-16 17:01:33'),
(1015, 6, 0, 1248, '25.900,00', 0, 1, '2023-05-16 17:01:34'),
(1016, 6, 0, 1249, '759.698,00', 0, 1, '2023-05-16 17:01:34'),
(1017, 6, 0, 1250, '49.999,00', 0, 1, '2023-05-16 17:01:34'),
(1018, 6, 0, 1251, '700.000,00', 0, 1, '2023-05-16 17:01:34'),
(1019, 6, 0, 1252, '28.494,00', 0, 1, '2023-05-16 17:01:34'),
(1020, 6, 0, 1253, '226.800,00', 0, 1, '2023-05-16 17:01:35'),
(1021, 6, 0, 1254, '1.207.774,00', 0, 1, '2023-05-16 17:01:35'),
(1022, 6, 0, 1255, '27.798,00', 0, 1, '2023-05-16 17:01:35'),
(1023, 6, 0, 1256, '385.000,00', 0, 1, '2023-05-16 17:01:35'),
(1024, 6, 0, 1257, '50.000,00', 0, 1, '2023-05-16 17:01:36'),
(1025, 6, 0, 1258, '8399,00', 0, 1, '2023-05-16 17:01:36'),
(1026, 6, 0, 1259, '15.074,00', 0, 1, '2023-05-16 17:01:36'),
(1027, 6, 0, 1260, '21.990,00', 0, 1, '2023-05-16 17:01:36'),
(1028, 6, 0, 1262, '239.999,00', 0, 1, '2023-05-16 17:01:37'),
(1029, 6, 0, 1264, '19.999,00', 0, 1, '2023-05-16 17:01:37'),
(1030, 6, 0, 1267, '150.000,00', 0, 1, '2023-05-16 17:01:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_ventas`
--

CREATE TABLE `pagos_ventas` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 0,
  `tipo` int(1) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_ventas`
--

INSERT INTO `pagos_ventas` (`id`, `numero`, `tipo`, `factura_id`, `valor`, `status`, `created_by`, `created_at`) VALUES
(1, 1, 0, 3, '23.800,00', 0, 1, '2023-05-05 14:46:31'),
(2, 1, 1, 3, '610,00', 1, 1, '2023-05-05 15:15:38'),
(3, 2, 1, 3, '22.000,00', 1, 1, '2023-05-05 15:15:52'),
(4, 3, 0, 4, '5.236.000,00', 1, 1, '2023-05-05 15:24:03'),
(5, 3, 1, 4, '5.890.500,00', 1, 1, '2023-05-05 15:25:07'),
(6, 4, 0, 7, '4.879.000,00', 0, 1, '2023-05-16 11:22:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `code`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Congo', 242),
(50, 'CD', 'Congo The Democratic Republic Of The', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametrizacion_documentos`
--

CREATE TABLE `parametrizacion_documentos` (
  `id` int(11) NOT NULL,
  `documento` int(11) NOT NULL COMMENT '1=Comprobante de egreso;\r\n2=Factura de compra;\r\n3=Factura de venta;\r\n4=Nómina;\r\n5=Recibos de caja;',
  `tipo_parametrizacion` int(11) DEFAULT NULL,
  `tipo_regimen` int(11) NOT NULL,
  `cuenta` int(11) NOT NULL,
  `naturaleza` int(1) NOT NULL COMMENT '1=Débito;\r\n2=Crédito;',
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parametrizacion_documentos`
--

INSERT INTO `parametrizacion_documentos` (`id`, `documento`, `tipo_parametrizacion`, `tipo_regimen`, `cuenta`, `naturaleza`, `status`, `created_by`, `created_at`) VALUES
(1, 3, 1, 1, 3240, 1, 1, 1, '2023-04-04'),
(2, 3, 1, 1, 3240, 2, 1, 1, '2023-04-04'),
(3, 3, 1, 1, 3240, 1, 1, 1, '2023-04-04'),
(4, 3, 2, 1, 3240, 1, 1, 1, '2023-04-04'),
(5, 3, 2, 2, 3240, 1, 1, 1, '2023-04-04'),
(6, 2, 1, 1, 3240, 1, 1, 1, '2023-04-20'),
(7, 2, 1, 1, 3240, 2, 0, 1, '2023-04-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_new`
--

CREATE TABLE `permisos_new` (
  `id` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  `modulo` varchar(255) NOT NULL,
  `administrador` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cotizaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos_new`
--

INSERT INTO `permisos_new` (`id`, `empleado`, `modulo`, `administrador`, `fecha`, `cotizaciones`) VALUES
(8825, 6, 'ver_asignaciones', 1, '2023-03-27 09:42:57', NULL),
(8826, 6, 'ver_asignaciones_proyectos', 1, '2023-03-27 09:42:57', NULL),
(8827, 6, 'ver_puntos', 1, '2023-03-27 09:42:57', NULL),
(8828, 6, 'gestion_orden_compra', 1, '2023-03-27 09:42:57', NULL),
(8829, 6, 'completar_orden_compra', 1, '2023-03-27 09:42:57', NULL),
(8830, 6, 'enviar_orden_compra', 1, '2023-03-27 09:42:57', NULL),
(8831, 6, 'eliminar_orden_compra', 1, '2023-03-27 09:42:57', NULL),
(8832, 6, 'gestionar_cotizaciones', 1, '2023-03-27 09:42:57', NULL),
(8833, 6, 'completar_cotizaciones', 1, '2023-03-27 09:42:57', NULL),
(8834, 6, 'enviar_cotizaciones', 1, '2023-03-27 09:42:57', NULL),
(8835, 6, 'eliminar_cotizaciones', 1, '2023-03-27 09:42:57', NULL),
(8836, 6, 'gestionar_remisiones', 1, '2023-03-27 09:42:57', NULL),
(8837, 6, 'completar_remisiones', 1, '2023-03-27 09:42:57', NULL),
(8838, 6, 'enviar_remisiones', 1, '2023-03-27 09:42:57', NULL),
(8839, 6, 'eliminar_remisiones', 1, '2023-03-27 09:42:57', NULL),
(8840, 6, 'gestionar_precios_proveedores', 1, '2023-03-27 09:42:57', NULL),
(8841, 6, 'completar_precios_proveedores', 1, '2023-03-27 09:42:57', NULL),
(8842, 6, 'enviar_precios_proveedores', 1, '2023-03-27 09:42:57', NULL),
(8843, 6, 'eliminar_precios_proveedores', 1, '2023-03-27 09:42:57', NULL),
(8844, 6, 'ver_prospectos_personas', 1, '2023-03-27 09:42:57', NULL),
(8845, 6, 'gestionar_prospectos_personas', 1, '2023-03-27 09:42:57', NULL),
(8846, 6, 'importar_prospectos_personas', 1, '2023-03-27 09:42:57', NULL),
(8847, 6, 'exportar_prospectos_personas', 1, '2023-03-27 09:42:57', NULL),
(8848, 6, 'ver_prospectos_empresas', 1, '2023-03-27 09:42:57', NULL),
(8849, 6, 'gestionar_prospectos_empresas', 1, '2023-03-27 09:42:57', NULL),
(8850, 6, 'importar_prospectos_empresas', 1, '2023-03-27 09:42:57', NULL),
(8851, 6, 'exportar_prospectos_empresas', 1, '2023-03-27 09:42:57', NULL),
(9454, 1, 'ver_asignaciones', 1, '2023-04-24 14:29:42', NULL),
(9455, 1, 'gestion_asignacion', 1, '2023-04-24 14:29:42', NULL),
(9456, 1, 'gestion_puntos', 1, '2023-04-24 14:29:42', NULL),
(9457, 1, 'ver_asignaciones_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9458, 1, 'gestion_asignaciones_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9459, 1, 'gestion_puntos_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9460, 1, 'ver_clientes', 1, '2023-04-24 14:29:42', NULL),
(9461, 1, 'gestionar_clientes', 1, '2023-04-24 14:29:42', NULL),
(9462, 1, 'inactivar_clientes', 1, '2023-04-24 14:29:42', NULL),
(9463, 1, 'eliminar_clientes', 1, '2023-04-24 14:29:42', NULL),
(9464, 1, 'ver_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9465, 1, 'gestionar_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9466, 1, 'inactivar_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9467, 1, 'eliminar_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9468, 1, 'ver_empleados', 1, '2023-04-24 14:29:42', NULL),
(9469, 1, 'gestionar_empleados', 1, '2023-04-24 14:29:42', NULL),
(9470, 1, 'inactivar_empleados', 1, '2023-04-24 14:29:42', NULL),
(9471, 1, 'eliminar_empleados', 1, '2023-04-24 14:29:42', NULL),
(9472, 1, 'ver_puntos', 1, '2023-04-24 14:29:42', NULL),
(9473, 1, 'gestionar_puntos', 1, '2023-04-24 14:29:42', NULL),
(9474, 1, 'ver_vehiculos', 1, '2023-04-24 14:29:42', NULL),
(9475, 1, 'gestion_vehiculos', 1, '2023-04-24 14:29:42', NULL),
(9476, 1, 'enviar_checklist_vehiculos', 1, '2023-04-24 14:29:42', NULL),
(9477, 1, 'gestion_checklist_vehiculos', 1, '2023-04-24 14:29:42', NULL),
(9478, 1, 'gestion_salud_vehiculos', 1, '2023-04-24 14:29:42', NULL),
(9479, 1, 'gestion_categorias_inventario', 1, '2023-04-24 14:29:42', NULL),
(9480, 1, 'gestion_almacenes_inventario', 1, '2023-04-24 14:29:42', NULL),
(9481, 1, 'gestion_productos_inventario', 1, '2023-04-24 14:29:42', NULL),
(9482, 1, 'gestion_inventario', 1, '2023-04-24 14:29:42', NULL),
(9483, 1, 'ver_movimientos_inventario', 1, '2023-04-24 14:29:42', NULL),
(9484, 1, 'solicitud_elementos', 1, '2023-04-24 14:29:42', NULL),
(9485, 1, 'gestion_solicitudes', 1, '2023-04-24 14:29:42', NULL),
(9486, 1, 'gesion_categorias_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9487, 1, 'gestion_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9488, 1, 'gestion_actas_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9489, 1, 'firma_cliente_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9490, 1, 'visto_bueno_proyectos', 1, '2023-04-24 14:29:42', NULL),
(9491, 1, 'ver_reparaciones_asignadas', 1, '2023-04-24 14:29:42', NULL),
(9492, 1, 'gestion_reparaciones', 1, '2023-04-24 14:29:42', NULL),
(9493, 1, 'generar_informes_reparaciones', 1, '2023-04-24 14:29:42', NULL),
(9494, 1, 'gestion_documentos', 1, '2023-04-24 14:29:42', NULL),
(9495, 1, 'gestion_orden_compra', 1, '2023-04-24 14:29:42', NULL),
(9496, 1, 'completar_orden_compra', 1, '2023-04-24 14:29:42', NULL),
(9497, 1, 'enviar_orden_compra', 1, '2023-04-24 14:29:42', NULL),
(9498, 1, 'eliminar_orden_compra', 1, '2023-04-24 14:29:42', NULL),
(9499, 1, 'gestionar_cotizaciones', 1, '2023-04-24 14:29:42', NULL),
(9500, 1, 'completar_cotizaciones', 1, '2023-04-24 14:29:42', NULL),
(9501, 1, 'enviar_cotizaciones', 1, '2023-04-24 14:29:42', NULL),
(9502, 1, 'eliminar_cotizaciones', 1, '2023-04-24 14:29:42', NULL),
(9503, 1, 'ver_remisiones', 1, '2023-04-24 14:29:42', NULL),
(9504, 1, 'gestionar_remisiones', 1, '2023-04-24 14:29:42', NULL),
(9505, 1, 'enviar_remisiones', 1, '2023-04-24 14:29:42', NULL),
(9506, 1, 'eliminar_remisiones', 1, '2023-04-24 14:29:42', NULL),
(9507, 1, 'gestionar_precios_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9508, 1, 'completar_precios_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9509, 1, 'enviar_precios_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9510, 1, 'eliminar_precios_proveedores', 1, '2023-04-24 14:29:42', NULL),
(9511, 1, 'ver_prospectos_personas', 1, '2023-04-24 14:29:42', NULL),
(9512, 1, 'gestionar_prospectos_personas', 1, '2023-04-24 14:29:42', NULL),
(9513, 1, 'importar_prospectos_personas', 1, '2023-04-24 14:29:42', NULL),
(9514, 1, 'exportar_prospectos_personas', 1, '2023-04-24 14:29:42', NULL),
(9515, 1, 'ver_prospectos_empresas', 1, '2023-04-24 14:29:42', NULL),
(9516, 1, 'gestionar_prospectos_empresas', 1, '2023-04-24 14:29:42', NULL),
(9517, 1, 'importar_prospectos_empresas', 1, '2023-04-24 14:29:42', NULL),
(9518, 1, 'exportar_prospectos_empresas', 1, '2023-04-24 14:29:42', NULL),
(9519, 1, 'contabilidad_config_administrativa', 1, '2023-04-24 14:29:42', NULL),
(9520, 1, 'contabilidad_config_general', 1, '2023-04-24 14:29:42', NULL),
(9521, 1, 'contabilidad_config_catalogos', 1, '2023-04-24 14:29:42', NULL),
(9522, 1, 'contabilidad_config_otros', 1, '2023-04-24 14:29:42', NULL),
(9523, 1, 'contabilidad_factura_compra', 1, '2023-04-24 14:29:42', NULL),
(9524, 1, 'contabilidad_factura_venta', 1, '2023-04-24 14:29:42', NULL),
(9525, 1, 'contabilidad_nota_credito', 1, '2023-04-24 14:29:42', NULL),
(9526, 1, 'contabilidad_nota_debito', 1, '2023-04-24 14:29:42', NULL),
(9527, 1, 'contabilidad_recibo_pago', 1, '2023-04-24 14:29:42', NULL),
(9528, 1, 'permisos_usuarios', 1, '2023-04-24 14:29:42', NULL),
(9529, 1, 'categorias_calendario', 1, '2023-04-24 14:29:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_proveedores`
--

CREATE TABLE `precio_proveedores` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `moneda` varchar(255) DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `fecha_entrega` text DEFAULT NULL,
  `condiciones_entrega` text DEFAULT NULL,
  `condiciones_pago` text DEFAULT NULL,
  `precio_dolar` varchar(255) NOT NULL DEFAULT '0',
  `total` varchar(255) NOT NULL DEFAULT '0',
  `file_cotizacion` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `prospectos`
--

CREATE TABLE `prospectos` (
  `id` int(11) NOT NULL,
  `tipo_cliente` int(1) NOT NULL DEFAULT 0,
  `pais_id` int(11) NOT NULL DEFAULT 0,
  `empresa` text DEFAULT NULL,
  `nombres` text DEFAULT NULL,
  `apellidos` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `cargo` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `tel_fijo` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `whatsapp` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `referido` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 2,
  `fecha_evento` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prospectos`
--

INSERT INTO `prospectos` (`id`, `tipo_cliente`, `pais_id`, `empresa`, `nombres`, `apellidos`, `email`, `cargo`, `celular`, `tel_fijo`, `fecha_nacimiento`, `direccion`, `facebook`, `whatsapp`, `instagram`, `referido`, `logo`, `estado`, `fecha_evento`, `created_by`, `created_at`) VALUES
(5803, 0, 47, 'Radio Enlace', 'Santiago', 'Henao', NULL, NULL, '3164693321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, '2023-03-02 12:17:00'),
(5804, 0, 47, 'Radio Enlace', 'Piedad', 'Henao', NULL, NULL, '3135190880', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, '2023-03-02 12:17:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospectos_empresas`
--

CREATE TABLE `prospectos_empresas` (
  `id` int(11) NOT NULL,
  `tipo_cliente` int(1) NOT NULL DEFAULT 0,
  `pais_id` int(11) NOT NULL DEFAULT 0,
  `empresa` text DEFAULT NULL,
  `nombres` text DEFAULT NULL,
  `apellidos` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `cargo` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `tel_fijo` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `whatsapp` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `referido` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 2,
  `fecha_evento` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prospectos_empresas`
--

INSERT INTO `prospectos_empresas` (`id`, `tipo_cliente`, `pais_id`, `empresa`, `nombres`, `apellidos`, `email`, `cargo`, `celular`, `tel_fijo`, `fecha_nacimiento`, `direccion`, `facebook`, `whatsapp`, `instagram`, `referido`, `logo`, `estado`, `fecha_evento`, `created_by`, `created_at`) VALUES
(6, 1, 5, NULL, 'asdd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-03-01', 1, '2023-02-27 10:05:08'),
(7, 1, 47, '1001437547', 'Santiago Smith', 'Delgado Henao', 'smithhenao2020@gmail.com', NULL, NULL, NULL, NULL, 'Carrera 53 AB # 46-73 Barrio Obrero', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, '2023-02-27 12:35:15');

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
  `email_comercial` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL DEFAULT '123456'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nit`, `razon_social`, `direccion`, `telefono_fijo`, `celular`, `contacto`, `email`, `observaciones`, `avatar`, `codigo_verificacion`, `tipo_regimen`, `estado`, `ciudad`, `email_comercial`, `clave`) VALUES
(4, '900382335', 'Radiotrans Colombia S.A.S', 'Carrera 71 Circular 1 - 42', '(604) 4481991', '3137487534', 'Martha Liliana Leon', 'mleon@radiotrans.com', '', 'bfbcb18259412a2d6ec5884d55437a6c.png', 5, '', 1, 'Medellín', '', '123456'),
(5, '800162165', 'Sistemas Electrónicos y Telecomunicaciones S.A.S', 'Carrera 33 No. 62 - 34', '(601) 6433825', '3114772496', 'David Roldan', 'david.roldan@sistelec.com.co', '', '08b883f641ae8473d574cdbec7221fe8.png', 3, '', 1, '', '', '123456'),
(6, '901192317', 'Syscom Colombia S.A.S', 'Cra. 90A No. 64C 38 Álamos Norte', '(601) 7443650', '3147209764', 'William Cárdenas', 'luis@syscomcolombia.com', '', '8d07ce149e754e0c0d7c96075b8db3e2.png', 0, '', 1, '', '', '123456'),
(7, '890941103', 'Equielect S.A.S', 'Carrera 72 No. 30-53', '(604) 4443133', '', '', 'equielect@equielect.com.co', '', '7c101e2faed734ec911ce2ffe4290d22.png', 7, '', 1, '', '', '123456'),
(8, '830079015', 'Meltec Comunicaciones S.A', 'CL 130A # 58A 29', '(601) 4111899 ', '3143956689', 'Alejandro Arango', 'cartera@meltec.com.co', '', 'e817c1d6da72e09bdb041b3379421e39.png', 1, '', 1, '', '', '123456'),
(9, '800170775', 'Transmicosta S.A.S', 'CL 75 58 48', '(605) 3689050', '3157187962', 'Cecilia Danies', 'gerencia@transmicosta.com', '', '138ea9cb785d4a19b9e5d64eaffaf185.png', 1, '', 1, '', '', '123456'),
(11, '900245554', 'Amarillo LTDA', 'Calle 8C N° 87B - 40 oficina 223', '(601)7460018 EXT 03', '(601) 7460018', 'Gloria Díaz', ' admon.amarilloltda@gmail.com', '', '9ad2a29267149e68f27582cefb4c0172.png', 5, '', 1, '', '', '123456'),
(12, '890913902', 'Antioqueña de Automotores y Repuestos S.A.S  ANDAR', 'CARRERA 77 N° 28 - 13 BELEN', '(604) 4440800', '3213139234', 'Leonardo Vásquez', 'leonardo.velasquez@andar.com.co', '', '0638eaa95b618e76d814eac90f0974f6.png', 6, '', 1, '', '', '123456'),
(13, '98490197', 'Baterías JV', 'Diagonal 44 31 41', '', '3155182035', 'Marcela', 'ventasbateriasjv@gmail.com', '', '7b552d80ddb53403e0536b78794e6915.png', 1, '', 1, '', '', '123456'),
(14, '900413864', 'Calza Soluciones ', 'Carrera 67 A N°51-79', '(604) 4488584', '3175163310', 'Melissa', 'comercial@radioenlacesas.com', '', '829763b900cba9a5063863f49f896808.png', 4, '', 1, '', '', '123456'),
(15, '900722974', 'Copimarks S.A.S', 'Carrera 78 45 E 61', '(604) 4482874', '3105025201 / 3134909757', 'Jorge Sánchez', 'copimarks@gmail.com', '', '33aa09f76666e6e2e51e96ba775416b7.png', 1, '', 1, '', '', '123456'),
(16, '811015782', 'Elian Comunicaciones y Montajes S.A.S', 'Calle 36 SA Sur N° 46 A 81 Of. 237', '(604) 3317287', '31038372530', 'Cesar Hoyos', 'eliancomunicaciones@hotmail.com', '', '0ac198f3fd1f3db014321505bab757a7.png', 9, '', 1, '', '', '123456'),
(18, '10883737', 'Juan Eduardo Alvarado Solorzano', 'Carrera 52, Calle 82 -24 Medellín', '(604) 2131785', '', 'Juan Alvarado', 'metrofuego@une.net.co', '', 'c19fa572fa0ad7d5081b9841c8234a36.png', 4, '', 1, '', '', '123456'),
(19, '900323290', 'Estación de Servicio Estrella del Norte S.A.S', 'Aut. Norte KM 16 Vda. Zarzal', '(604) 4480313 / 4015252', '', 'Sebastián Vélez', 'edsestrelladelnorte@une.net,co', '', '42e2a66f84519c31f1904a26fd7a43e3.png', 0, '', 1, '', '', '123456'),
(20, '860500630', 'Isec', 'Carrera 43A # 14 -27 Oficina 202', '(604) 2666434', '3153838392', 'Luz Stella Vásquez ', 'stella.vasquez@isec.com.co', '', '87a7a92578531a3c8ba5778a1a6f927f.png', 6, '', 1, '', '', '123456'),
(21, '900225832', 'Luchos Lujomania LTDA', 'Carrera 64 N° 42B - 31', '(604) 4082320 / 4087942', '', 'Alexandra Restrepo', 'contacto@luchoslujomania.com', '', '98c016f888a2f9257dc9d9ae9143093a.png', 2, '', 1, '', '', '123456'),
(22, '811000995', 'Mas Frenos S.A.S', 'Calle 30 A 65 B 66', '(604) 4798744 / 4798461', '', 'German Hernández', 'masfrenos@gmail.com', '', '551c5c6b0068c144a559fe35e3467522.png', 0, '', 1, '', '', '123456'),
(23, '901436594', 'Inversiones Mas Repuestos S.A.S', 'Carera 61 N°45 - 08', '', '3003641449 / 3007631988', 'Karen', 'masrepuestos@gmail.com', '', '6beb3c5bb911d29e684faf35564e7d06.png', 3, '', 1, '', '', '123456'),
(24, '901446306', 'Grupo Empresarial ADSL S.A.S', 'Calle 48 # 10-45 CC Monterrey Loc. 315-316', '(604) 6090123', '3122510095', 'Mauricio Franco', 'm.franco@grupoadsl.com', '', '', 1, '', 1, '', '', '123456'),
(25, '900585869', 'Mega Storage Colombia S.A.S', 'Calle 8 B N° 65 251', '(604) 6051525', '3216390098', 'Yurani Mendez', 'contabilidad@megastorage.com.co', '', 'a261bf5349156150b4d68835d461b52e.png', 8, '', 1, '', '', '123456'),
(26, '900744916', 'Mundirepuestos  del Norte S.A.S', 'Diagonal 52 N° 15 A 351 - Interior 5 Centro Logístico del Norte - Bello', '(604) 3666709', '3113555851', 'Carolina Castro', 'administracion@mundirepuestosdelnorte.com.co', '', 'a04872500ff3a5c3469bc04ff4f7f871.png', 9, '', 1, '', '', '123456'),
(27, '900986403', 'Radiofrecuencia e Ingeniería en Comunicaciones S.A.S', 'Carrera 37 B N° 1 G  - 20', '(601) 3843687', '3102256990', 'William Marín', 'williammartincom@gmail.com', '', '5e4adc3438c110f95dc526885b0bad77.png', 0, '', 1, '', '', '123456'),
(28, '900906969', 'Soluciones en Seguridad y Salud en el Trabajo S3 S.A.S', 'Carera 53 N°  36 - 35', '(604) 4796057', '3044783532', 'Laura', 'cartera3soluciones@gmail.com', '', 'a6fcc619567ef2feef6e591d852dd027.png', 5, 'Común', 1, 'Medellín', 'foracionalturas@s3soluciones.com.co', '123456'),
(29, '900265297', 'Sociedad de Seguridad Electrónica y Telecomunicaciones S.A.S', 'Av. Carera 20 N° 85 A - 21', '(601) 4321757', '3125085416 / 3115446076', 'Lucia González / Diany Delgado', 'contabilidad@setronics.net', '', 'fa966e69754c8fb7701fc5d3714641ea.png', 2, 'Común', 1, 'Bogotá', 'consultor.diany@setronics.net', '123456'),
(30, '890942699', 'Almacén Sus Llantas S.A.S', 'Carrera 59 N° 48 - 20 Barrio Triste', '(604) 5112424', '3215112424', 'Ana Gil', 'conta.susllantas@une.net.co', '', 'b339711c7a2df622bf33b12b4dc66d07.png', 9, 'Común', 1, 'Medellín', 'facturacionsusllantas@gmail.com', '123456'),
(31, '900034424', 'Electrónica  I+D S.A.S ', 'Calle 48 D N° 65 A - 35', '(604) 6073333', '3159282544', '', 'administrtivo@didacticaselectronicas.com', '', 'd7797cb044065303b7982449bf23457e.png', 0, '', 1, '', '', '123456'),
(32, '900597685', 'Sustento Jurídico ', 'Calle 8 B N° 65 167', '(604) 4199704', '3104415759', 'Edison Garcia', 'edisongarcia@sustentojuridico.com', '', '9ef3a8963714462abc64b441a3ae6a40.png', 1, '', 1, '', '', '123456'),
(33, '900037505', 'Felda S.A', 'Calle 30 A N° 69 C - 11', '(604) 2350517', '3117229415', 'Francia Zapata', 'primaxbelenauxiliar@gmail.com', '', '', 2, 'Común', 1, 'Medellín', '', '123456'),
(34, '800224025', 'Tablecol S.A.S', 'Carrera 56 N° 29-72 ', '(604) 44083129', '3104525720 / 3122581879', 'Margoth Rincon', 'cartera@tablecol.com.co', '', 'e0ad738367faee457a6d7eb79e105e62.png', 8, 'Común', 1, 'Medellín', '', '123456'),
(35, '900529671', 'Ferretería Servillaves la 30 S.A.S', 'Calle 30 N° 75-04', '(604) 4449471', '3148851469', '', 'servillavesla30@une.net.co', '', 'd7beaa386ac040062c8aef0bc3664b78.png', 9, 'Común', 1, 'Medellín ', '', '123456'),
(36, '900653389', 'Grupo Empresarial Camaleón S.A.S', 'Calle 30 N° 74-77', '(604) 5821080', '3041733035', '', 'pinturaselcamaleondela30@gmail.com', '', '88aa84cb01113f26141423fe28a2c96c.png', 6, 'Común', 1, 'Medellín', '', '123456'),
(37, '830504313', 'Radio Enlace S.A.S', 'Calle 27 N°81 - 70 Belén la Palma', '(604) 4448280', '3116307079', 'Oscar Sánchez ', 'facturacionelectronica@radioenlacesas.com', '', 'e5f8af09c439c8602ceab505144e8879.png', 5, 'Común', 1, 'Medellín', 'gcomercial@radioenlacesas.com', '123456'),
(38, '901248086', 'Uno A Tecnología S.A.S', 'Calle 14 # 48-33 CC. Monterrey Local 380A ', '(604) 4441818', '', '', 'www.unoacomputadores.com', '', '76726cc66c2b4bbe4efe00f0df965afe.png', 7, 'Común', 1, 'Medellín', '', '123456'),
(39, '800242106', 'Sodimac Colombia S.A.', 'Calle 30 A N° 82 A - 26', '', '3208899933', '', 'servicioalcliente@corp.homecenter.cpm.co', '', '61689d16f9f015cf10096e217d9143be.png', 2, 'Común', 1, 'Medellín', '', '123456'),
(40, '900525717', 'Almacén LCC S.A.S', 'Cra. 65 No. 8 B 91 LC174', '3611263', '', '', 'contabilidad.lcc@dotakondor.com', '', '18a4b3c5eef3d3e8a22a795637fc7c72.png', 0, 'Juridico', 1, 'Medellín ', '', '123456'),
(41, '900933129', 'Meca S.A.S', 'Cra. 54 No. 29c120 loc 101', '5017013', '3117655802', '', 'meca701@hotmail.com', '', '7e93e958bf92c10b91b7378cf01eec5e.png', 1, 'Juridico', 1, 'Medellín ', '', '123456'),
(42, '43094755', 'Moto Veloz', 'Cl 38 No. 51-32', '2328265', '', '', '', '', 'cbbc9342f18b9ba5c51dab8873e3de5f.png', 1, 'Juridico', 1, 'Medellín ', '', '123456'),
(43, '900702001', 'Fénix Producciones S.A.S', 'Cl 49 No. 67 A 32', '4482246', '2304408', '', 'info♠fenixcomercial.com.co', '', '13ed291c09189f15fc05994b080c20f7.png', 5, 'Juridico', 1, 'Medellín ', '', '123456'),
(44, '800227071', 'Tornifer S.A.S', 'Cl 30 No. 54-11', '3228015', '3137466', '', '', '', 'b7b02797d0b7410fe16c7b9685be934f.png', 0, '', 1, 'Medellín ', '', '123456'),
(45, '890943055', 'Suconel Suministros y Controles Electronicos', 'Cra 53 No. 50 - 51 Of 506', '4487830', '3012578952', 'Suconel', 'suconel@suconel.com', '', 'df0a29132fca02bc7fa1c2971e4fbf42.png', 0, 'Juridico', 1, 'Medellín ', '', '123456'),
(46, '800147520', 'Compel  S.A Tecnología &amp; Vigilancia ', 'Cra 70 No. 32b -147', '3512492', '3006351247', 'Compel', 'Compel@compel.com.co', '', '5347b32148d744287cb069a0984a799f.png', 2, 'Juridico', 1, 'Medellín ', '', '123456'),
(47, '890922294', 'Protokimica S.A.S', 'Cra 56b No. 49-58', '4448787', '3117192216', 'Efren Villalba ', 'protokimica@une.net.co', '', '0d38a412b45f03cd3d5eddfeadb4d242.png', 4, 'Juridico', 1, 'Medellín ', '', '123456'),
(48, '900529671', 'Ferretería Serví Llaves la 30', 'Cl 30 # 75-04', '4449471', '3148851469', 'Jairo León Álvarez ', 'servillavezla30@une.net.co', '', '455aa1c12281e108f6f3df4456755fe1.png', 9, 'Juridico', 1, 'Medellín ', '', '123456'),
(49, '900434009', 'Macrotics S.A.S', 'Carrera 50 C 10 sur 35 BRR la Aguacatala', '6048418828', '3330333228', 'Jaime García', 'ventas@macrotics.com', '', '1962dbc1e33a9ee7d07aeded0e9e32e1.png', 3, 'Común', 1, 'Medellín', '', '123456'),
(50, '900164446', 'Grupo Empresarial de Radiocomunicaciones E.U.', 'Calle 79B N 69 R-28', '6012516969', '3124347142', 'Jaime Hernández', 'radiotelefonos@hotmail.com', '', '66541273565ad7d34453f484ae6225a0.png', 1, 'Común', 1, 'Bogotá', '', '123456'),
(51, '811039882', 'Comercializadora Jagir S.A.S', 'Cra  52 #38-58', '', '3157804512', '', '', '', 'ea54ab55a65a9519a3a97cad065e8213.png', 0, '', 1, 'Medellín ', '', '123456'),
(52, '900458715', 'Uricamperos &amp; Diesel  S.A.S', 'Cra 51 No 39-21', '3229673', '3122574274', '', 'ventas@uricamperos.com', '', 'e38fe9b8f6f32d71ed86968ba9bb323a.png', 9, '', 1, '', '', '123456'),
(53, '2684800', 'Jairo Vásquez', 'Medellín', '2684800', '', 'Jairo Vásquez', '', 'Cta. Ahorros Bancolombia 10349100332  //  \r\nCliente Seguridad de Colombia  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Medellín', '', '123456'),
(54, '15381163', 'Luis Antonio Giraldo Rincón', 'CALLE 27 81 70', '3054551899', '3006659005', 'Luis Antonio Giraldo', 'comercial@radioenlacesas.com', 'Cta. Ahorros Bancolombia 10309362858  / /  \r\nCliente Masivos de Occidente  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 57, 'Simplificado', 1, 'Medellín', '', '123456'),
(55, '70257077', 'Edwar Ernesto Gallego', 'Cerro el Rubí - Yolombo', '', '3504869245', 'Edwar Ernesto Gallego', '', 'Cta. Ahorros Bancolombia 0-7299667612 //  \r\nCliente Vinus  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Yolombo', '', '123456'),
(56, '3401378', 'Miguel Vahos', 'Cerro Horizonte', '', '3103790947', 'Miguel Vahos', '', 'Cta. Ahorros Bancolombia 41867033597  / /  \r\nCliente Continental Gold  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Horizonte', '', '123456'),
(57, '3669716', 'Alfonso Tapias Machado', 'Finca el Mico, Remedios.', '', '3137968328', 'Alfonso Tapias Machado', '', 'Cta. Ahorros Bancolombia62527282204  //  \r\nCliente Conexión Norte, Grupo Ortiz, Intramaq y Atempi  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Remedios', '', '123456'),
(58, '15421478', 'Luis Alberto Pérez Arboleda', 'Finca Boquerón', '', '', 'Luis Alberto Pérez Arboleda', '', 'Cta. Ahorros Banco Bogotá  //  \r\nCliente Seracis  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Bogotá', '', '123456'),
(59, '21580004', 'Belarmina Durango', 'Cerro Cativo', '', '3217582751', 'Belarmina Durango', '', 'Cta. Ahorros CFC 0-1201053377  //  \r\nCliente Continental Gold y Atempi  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Cativo', '', '123456'),
(60, '43905052', 'Beatriz Correa', 'Cerro Toto ', '', '3127238853', 'Beatriz Correa', '', 'Cta. Ahorro a la Mano 13127238853  //  \r\nCliente Seracis  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Mutata', '', '123456'),
(61, '1128452089', 'Esneider Espinosa', 'Cerro la Meseta', '', '3007729918', 'Esneider Espinosa', '', 'Cta. Ahorros Bancolombia 1560885543  / /  Cliente Consorcio R&amp;S  //  Se debe incrementar en Enero de cada año según el porcentaje del IPC.', '', 0, 'Simplificado', 1, 'Titiribí', '', '123456'),
(62, '8415976', 'José Ignacio Higuita Vásquez', 'Cerro Dabeiba', '', '3108440238', 'Luis Ignacio Higuita Vásquez', '', 'Cta. Ahorros Bancolombia  //  \r\nCliente Sp. Ingenieros Mar II  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Dabeiba', '', '123456'),
(63, '43363356', 'Gloria Ruiz', 'Cerro Bello San Félix', '', '3205417102', 'Gloria Ruiz', '', 'Cta. Ahorros Bancolombia 54100033634  //  \r\nCliente Seguridad de Colombia  //  \r\nSe debe incrementar en Octubre de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'San Félix ', '', '123456'),
(64, '32210151', 'María Hilda Quintero Zabala', 'Cerro Otú, Vereda la Brava', '', '3122415933', 'María Hilda Quintero Zabala', '', 'Cta. Ahorros Bancolombia 52700015548  //  \r\nCliente Seracis  //  \r\nSe debe incrementar en Marzo de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Remedios', '', '123456'),
(65, '71578126', 'Gabriel Jaime Ochoa Peláez', 'Cerro Sevilla', '', '3233001425', 'Gabriel Jaime Ochoa Peláez', '', 'Cta. Ahorros Bancolombia 2167007751  //  \r\nCliente Minerales Camino Real  //  \r\n Se debe incrementar en Junio de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Sevilla', '', '123456'),
(66, '1026159146', 'Yeison David Henao Atehortúa', 'Cerro el Colombianito', '', '3194508493', 'Yeison David Henao Atehortúa ', '', 'Cta. Ahorros Bancolombia 27900001266  //  \r\nCliente Consorcio R&amp;S  //  \r\nSe debe incrementar en Agosto de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Caldas', '', '123456'),
(67, '16075309', 'Camilo Andres Lopera', 'Cerro San José de la Montaña', '', '3206322680', 'Camilo Andres Lopera', '', 'Cta. Corriente Bancolombia 7014384380  //                                                                                                                                          Cliente Hdroituango y Conconcreto  //                                                                                                                                             \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, '', 1, 'San José ', '', '123456'),
(68, '7530716', 'Guillermo Adolfo Atehortúa Agudelo ', 'Cerro el Cedro, Amaga', '', '3223093528', 'Guillermo Adolfo Atehortúa Agudelo ', '', 'Cta. Ahorros Bancolombia 52001440071  //  \r\nCliente Consorcio R&amp;S  //  \r\nSe debe incrementar en Septiembre de cada año según el porcentaje del IPC.\r\n', '', 0, '', 1, 'Amaga', '', '123456'),
(69, '1037368146', 'Eliana María Suarez', 'Cerro Maceo', '', '3108255728', 'Eliana María Suarez', '', 'Cta. Ahorros Bancolombia 16390361991  //  \r\nCliente Intramaq  //  \r\nSe debe incrementar en Abril de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Maceo', '', '123456'),
(70, '8075270', 'Oscar Darío Giraldo Ramírez', 'Dabeiba - Chinos', '', '3218735537', 'Oscar Darío Giraldo / Flor', '', 'Cta. Ahorro a la Mano 03126059317 / /\r\nSolo se cancelan los servicios una vez que ellos envían la factura, del recibo se debe restar (140.000 pesos) que es lo que normalmente ellos pagaban de luz y se le debe pagar el diferencial.', '', 0, 'Simplificado', 1, 'Dabeiba', '', '123456'),
(71, '43424223', 'Omaira del Socorro escobar Sánchez ', 'Cerro Pantanillo', '', '3113136979', 'Omaira del Socorro Escobar Sánchez', '', 'Gana BArbosa  //  \r\nCliente Hatovial  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Barbosa', '', '123456'),
(72, '1039284416', 'Robinson Flores Vargas', 'Dabeiba', '', '31732002976', 'Robinson Flores Vargas', '', 'Gana Dabeiba  //  \r\nCliente Seracis Chinos  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n\r\n\r\n', '', 0, 'Simplificado', 1, 'Dabeiba', '', '123456'),
(73, '8333249', 'José Joaquín León Gases ', 'Mutata', '', '3218903562', 'José Joaquim León Gases', '', 'Gana Mutata  //  \r\nCliente Seracis Chinos  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Mutata', '', '123456'),
(74, '8417622', 'Rubiel  Benítez ', 'Dabeiba', '', '3183757447', 'Rubiel Benítez', '', 'Gana Dabeiba  //  \r\nCliente Seracis Chinos  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Dabeiba', '', '123456'),
(75, '21818287', 'María Nidia Macías Flores ', 'Vegachí', '', '3165676391', 'María Nidia Flores', '', 'Gana Vegachí  //  \r\nCliente  //  \r\nSe debe incrementar en Febrero de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Vegachí', '', '123456'),
(76, '6271627', 'Eduardo Calderón', 'Santa Fe ', '', '3148895933', 'Eduardo Calderón ', '', 'Gana Santa Fe  //  \r\nCliente El Cóndor  //  \r\nSe debe incrementar en Febrero de cada año según el porcentaje del IPC.\r\n\r\n', '', 0, 'Simplificado', 1, 'Santa Fe', '', '123456'),
(77, '30760476', 'Rocío Beltrán Castro', 'Codazzi el Cesar', '', '3144245571', 'Rocío Beltrán Castro', '', 'Cta Ahorro a la Mano Bancolombia 52491370742  // \r\nCliente Isla Caribe  //  \r\nSe debe incrementar en Agosto de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'El Cesar', '', '123456'),
(78, '71023107', 'Jorge Humberto Lopera Durando', 'Frontino', '', '3122814104', 'Jorge Humberto Lopera Durando ', '', 'Cta. Ahorro a la Mano Bancolombia 03122814104  //  \r\nCliente Sp. Ingenieros Mar II  //  \r\nSe debe incrementar en Enero de cada año según el porcentaje del IPC.\r\n', '', 0, 'Simplificado', 1, 'Frontino', '', '123456'),
(79, '900802615', 'Solarplus Energy S.A.S', 'Calle 65 Calle 8 B 91 IN 372', '6044483363', '3137330883', 'Juan Bernal ', 'tradecontabilidad@gmail.com', '', '40d568165a13576e7db2432794952b8e.png', 6, 'Común', 1, 'Medellín', '', '123456'),
(80, '900986403', 'RFI Comunicaciones S.A.S', 'Cra 37 B No. 1 g - 20', '3843687', '3102256990', 'William Martin Vargas ', '', '', '1855330a09a42d68e131fc6b676eca82.png', 0, 'Juridico', 1, 'Bogotá', '', '123456'),
(81, '890980958', 'MUNICIPIO DE MACEO', 'Carrera 30 #30-32', '8640209', '8640209', '', 'alcaldia@maceo-antioquia.gov.co', '', '', 3, '', 1, 'MACEO', '', '123456'),
(82, '19708332', 'ROBERTO CARLOS 	LEIVA PEREZ', 'VEREDA 4 VIENTOS', '', '3002349561', 'ROBERTO CARLOS 	LEIVA PEREZ', '', '', '', 1, 'SIMPLE', 1, '', '', '123456'),
(83, '830114921', 'COLOMBIA MOVIL S A E S P', 'CR 65 30A 58', '', '018003000000', 'TIGO BUSINES', 'atencionprimercontacto@mail.tigo.com.co', '', 'c8fb2c2ab13b2cbb0a75db1749c2f859.png', 1, 'GRANDES CONTRIBUYENTES', 1, 'MEDELLIN', '', '123456'),
(84, '800153993', 'COMUNICACION CELULAR S A COMCEL S A', 'Cl 30 A 82 a-26 C.C Los Molinos L 3031 ', '01-800-0341818', '01-800-0341818', 'CLARO', 'solucionesclaro@claro.com.co', '', 'b5f2dc14220cc7faec83e84120c5e7a8.png', 7, 'GRANDES CONTRIBUYENTES', 1, 'MEDELLIN', '', '123456'),
(85, '890904996', 'EMPRESAS PUBLICAS DE MEDELLIN E.S.P.', 'CRA 58  42 125', '3808080', '', 'EPM', 'notificacionesjudicialesepm@epm.com.co', '', '3486570319715963e6ec1f22ee3dd5bb.png', 1, 'GRANDES CONTRIBUYENTES', 1, 'MEDELLIN', 'notificacionesjudicialesepm@epm.com.co', '123456'),
(86, '1128404557', 'JUAN PABLO CADAVID MUÑOS', '', '', '3015353766', 'JUAN PABLO CADAVID MUÑOS', '', '', '', 0, 'SIMPLE', 1, 'MEDELLIN', '', '123456'),
(87, '1036610363', 'SIRLEY TATIANA MURILLO GOMEZ', 'Carre 69 calle 34 b sur 102', '', '3148783053', 'SIRLEY TATIANA MURILLO GOMEZ', 'coordinadora.sst@radioenlacesas.com', '', '', 0, 'SIMPLE', 1, 'MEDELLIN', '', '123456'),
(88, '41948443', 'ANGELA MARIAPEREZ ARANGO', 'CL 39 SUR 25C 89 APTO 428', '', '3122476898', 'ANGELA MARIAPEREZ ARANGO', 'angelaperez1980@hotmail.com', '', '', 0, 'SIMPLE', 1, '', '', '123456'),
(89, '71687072', 'JEFERSON ARANGO RESTREPO', 'Cra 98#22h 57', '311 6396382', '311 6396382', 'JEFERSON ARANGO RESTREPO', 'jefersonarango@gmail.com', '', '', 0, 'SIMPLE', 1, 'MEDELLIN', '', '123456'),
(90, '901296977', 'PUNTA DEL PARQUE - PROPIEDAD HORIZONTAL', 'CL 37B SUR 27 30', '', '3501546', 'PUNTA DEL PARQUE - PROPIEDAD HORIZONTAL', 'puntadelparqueph@gmail.com', '', '', 9, 'REGIMEN COMUN', 1, 'MEDELLIN', '', '123456'),
(91, '3518230', 'Electrónicas ADM ', 'Cra 53 No.  51-51 Local 311 CC La Cascada', '4807950', '', '', '', '', '', 3, '', 1, 'Medellín ', '', '123456'),
(92, '901291245', 'ICANN GROUP S.A.S', 'cl 33 74e 84', '2503941', '313 7366882', 'Alejandro Torres', 'orestrepo@hotmail.com', '', 'ccc209e3e7abc29adcfd6edd4ee8fcdc.png', 3, 'REGIMEN COMUN', 1, 'MEDELLIN', '', '123456'),
(93, '800060880', 'Ferragro S.A.S', 'Cra. 42 # 51 - 34', '4483797', '3117207435', '', 'jjrestrepo@ferragro.com', '', 'c4f0d1c3ac3ef4e1880f6338c4bd6e3a.png', 3, '', 1, 'Medellín ', '', '123456'),
(94, '43620699', 'Marcela Ríos Urrea / Enactivo Consulting', 'CR 35 65 SUR 135 AP 1505', '', '3187170367', '', 'marcelariosurrea@gmail.com', '', 'e6724d6b019cd529315f3818a51c4924.png', 4, '', 1, 'Medellín ', '', '123456'),
(96, '860516314', 'DAGA S.A. EN REORGANIZACION', 'CR 106 15 25 MZ 10 BG 65', '6016 0 3 1 0 0 0', '', '', 'contabilidad@daga-sa.com', '', '19653033601843855423.png', 3, 'Persona juridica', 1, 'Bogota', 'contabilidad@daga-sa.com', '123456'),
(97, '900427263', 'ELECTRO ANDU S.A.S.', 'CL 52 54 24', '604 4484387', '', '', 'secretariaelectroandu@gmail.com', '', '12200879241133583691.png', 9, 'Persona juridica', 1, 'MEDELLIN', 'secretariaelectroandu@gmail.com', '123456'),
(98, '890913555', 'FERROINDUSTRIAL S.A.', 'CL 39 46 235', '6053702105', '3164229337', 'Daliana', 'contabilidad@ferroindustrial.com.co', '', '42207541934782113.png', 3, 'Persona juridica', 1, 'Barranquilla', '', '123456'),
(99, '900367868', 'Marketing de insumos S.A.S.', 'CR 20 13 58 OF 413 CC PUERTO RICO', '9370257', '3112815885', '', 'gerencia@markyn.com', '', '', 6, '', 1, 'Bogotá D.C', 'gerencia@markyn.com', '123456'),
(100, '43136138', 'Sandra Milena', 'Marulanda Montoya', '', '(617)2818997', 'Sandra Milena Marulanda Montoya', 'Sandraespinosa1@aol.com', '', '', 0, '', 1, 'Titiribi', 'Sandraespinosa1@aol.com', '123456'),
(101, '900985188', 'ELECSU COMUNICACIONES S.A.S', 'CR 12 19 46 P 4 OF 402 elecsu@', '2 8 1 4 5 3 1', '', '', '', '', 'noavatar.png', 7, '', 1, 'Bogota', 'elecsu@gmail.com', '123456'),
(102, '71658966', 'Alberto Federico alvarez Gonsalez', 'CR 59 19 14', '5812448', '3012651922', '', 'mitchell.alvarez.e@gmail.com', '', 'noavatar.png', 2, 'No responsable de IVA', 1, 'Medellin', 'mitchell.alvarez.e@gmail.com', '123456'),
(103, '900986403', 'RADIOFRECUENCIA E INGENIERÍA EN COMUNICACIONES S.A.S', 'CR 37B 1G 20', '3843684', '3102256990', '', '', '', 'noavatar.png', 0, '', 1, '', '', '123456'),
(105, '811001008', ' TELEVIGIA LIMITADA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(106, '900142335', 'ACQUA MARKETING  COLOMBIA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(107, '900667139', 'ALIMENTOS DE LA SIERRA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(108, '3179276', 'ALIRIO AHUMADA RUIZ', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(109, '890900608', 'ALMACENES EXITO S A', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(110, '32390107', 'AMPARO DEL SOCORRO PELAEZ GIRALDO', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(111, '830137461', 'BELLA PIEL SAS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(112, '890905080', 'CAMARA DE COMERCIO DE MEDELLIN', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(113, '1042709801', 'CARLOS ANDRES ATEHORTUA VASCO', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(114, '43644070', 'CARMEN PATRICIA OSSA HOYOS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(115, '890900076', 'CINE COLOMBIA SAS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(116, '900993023', 'COCOROLLO EL ALTICO S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(117, '900133093', 'COMBUSTIBLES DEL CESAR & CIA LTDA CODELCE', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(118, '900342297', 'COMERCIALIZADORA ARTURO CALLE S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(119, '800069933', 'COMODIN S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(120, '890901172', 'COOPERATIVA CONSUMO TOMA POSESION', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(121, '890901672', 'CRYSTAL S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(122, '70785806', 'DIEGO RESTREPO RAMIREZ', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(123, '890941663', 'DISTRIBUIDORA PASTEUR S.A', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(124, '900221395', 'DISTRICOMBUSTIBLES S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(125, '83003584', 'D-PORTES S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(126, '811009359', 'DYVAL S.A', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(127, '900017447', 'FALABELLA DE COLOMBIA S A', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(128, '890901481', 'FEDERACION NACIONAL DE COMERCIANTES FENALCO SECCIONAL ANTIOQUIA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(129, '900410127', 'FERRETERIA Y DEPOSITO ALTO DE LA VIRGEN S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(130, '71080014', 'GERARDO ANTONIO CIERRA CORREA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(131, '900521807', 'GLOBAL OPERADORA HOTELERA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(132, '901405506', 'GOES GRUPO DE OPERACIONES ESTRATEGICAS EN MARKETING SAS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(133, '900759077', 'GROUND LIGHTNING S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(134, '890900307', 'GROUPE SEB ANDEAN S. A.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(135, '900677711', 'GRUAS VANEGAS ROJAS S. A. S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(136, '70326533', 'HECTOR MADRID SALDARRIAGA MADRID', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(137, '900277370', 'I SHOP COLOMBIA SAS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(138, '901555347', 'IMPROTO 3D S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(139, '800251569', 'INTER RAPIDISIMO SA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(140, '811045607', 'INVERSIONES EURO S. A.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(141, '901197499', 'INVERSIONES MARIN VELASQUEZ  S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(142, '901609298', 'INVERSIONES MONANO S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(143, '900670975', 'INVERSIONES TORRE DE LONDRES S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(144, '1006858', 'JESUS DAVID VASQUEZ BARRIOS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(145, '83165404', 'JOSE ARLEX OSORIO NORIEGA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(146, '4350842', 'JOSE JAIRO VASQUEZ QUICENO', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(147, '1028780632', 'JUAN ESTEBAN BOLIVAR SUAREZ', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(148, '1036651968', 'Julian Esteban Sanchez Pabon', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(149, '8351444', 'JULIO CESAR RESTREPO VASQUEZ', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(150, '900276962', 'KOBA COLOMBIA S A S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(151, '901000330', 'KUSHKI COLOMBIA SAS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(152, '900407432', 'L&C S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(153, '890940499', 'LA CASA DEL GRANJERO S.A.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(154, '901140415', 'LA MIGUERIA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(155, '811034562', 'LA RECETA Y CIA S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(156, '890900098', 'LANDERS Y CIA S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(157, '39167260', 'LIA MARGARITA ARBELAEZ DE LOPEZ', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(158, '901106003', 'LM INVESTMENT HOUSE S A S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(159, '900428510', 'MC HOMAS Y ZAPATOS  S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(160, '901137699', 'MINISO COLOMBIA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(161, '98557903', 'NELSON DAVID VELASQUEZ', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(162, '8410602', 'PEDRO NEL RIVERA RIVERA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(163, '16051795', 'PEDRO PEREZ SOTO', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(164, '890912426', 'PEREZ Y CARDONA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(165, '901446111', 'PERU AMSTERDAN S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(166, '811007170', 'PINTURAS EL   AGUILA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(167, '830112317', 'PROCAFECOL S.A', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(168, '890904382', 'REENCAUCHADORA MEJIA S.A.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(169, '71420636', 'REINALDO DE JESUS RODRIGUEZ QUICENO', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(170, '4339285', 'RODRIGO ANDRES MOLINA MOLINA', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(171, '890903790', 'SEGUROS DE VIDA SURAMERICANA S.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(172, '900641439', 'SEINCODE SAS', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(173, '901028482', 'SELOASEGURO S.A.S', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(174, '860512330', 'SERVIENTREGA S.A.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(175, '900817989', 'TECNOLOGIA HELICOIL S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(176, '900092385', 'UNE EPM TELECOMUNICACIONES S.A.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(177, '890908099', 'VIAJES VERACRUZ LALIANXA S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(178, '901575818', 'W GRUAS S.A.S.', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456'),
(179, '15405614', 'YOVANY ALBERTO DURANGO', '', '', '', '', '', '', '', 0, '', 1, '', '', '123456');

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
-- Estructura de tabla para la tabla `pucs`
--

CREATE TABLE `pucs` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pucs`
--

INSERT INTO `pucs` (`id`, `code`, `nombre`, `parent_id`, `status`, `created_by`, `created_at`) VALUES
(1, 1, 'Activo', NULL, 1, 1, '2023-02-21 08:36:26'),
(2, 2, 'Pasivo', NULL, 1, 1, '2023-02-21 08:36:26'),
(3, 3, 'Patrimonio', NULL, 1, 1, '2023-02-21 08:36:26'),
(4, 4, 'Ingresos', NULL, 1, 1, '2023-02-21 08:36:26'),
(5, 5, 'Gastos', NULL, 1, 1, '2023-02-21 08:36:26'),
(6, 6, 'Costos de venta', NULL, 1, 1, '2023-02-21 08:36:26'),
(7, 7, 'Costos de producción o de operación', NULL, 1, 1, '2023-02-21 08:36:26'),
(8, 8, 'Cuentas de orden deudoras', NULL, 1, 1, '2023-02-21 08:36:26'),
(9, 9, 'Cuentas de orden acreedoras', NULL, 1, 1, '2023-02-21 08:36:26'),
(11, 11, 'Disponible', 1, 1, 1, '2023-02-21 09:34:05'),
(12, 1105, 'Caja', 1, 1, 1, '2023-02-21 09:34:05'),
(13, 110505, 'Caja general', 1, 1, 1, '2023-02-21 09:34:05'),
(14, 110510, 'Cajas menores', 1, 1, 1, '2023-02-21 09:34:05'),
(15, 110515, 'Moneda extranjera', 1, 1, 1, '2023-02-21 09:34:05'),
(16, 1110, 'Bancos', 1, 1, 1, '2023-02-21 09:34:05'),
(17, 111005, 'Moneda nacional', 1, 1, 1, '2023-02-21 09:34:05'),
(18, 111010, 'Moneda extranjera', 1, 1, 1, '2023-02-21 09:34:05'),
(19, 1115, 'Remesas en tránsito', 1, 1, 1, '2023-02-21 09:34:05'),
(20, 111505, 'Moneda nacional', 1, 1, 1, '2023-02-21 09:34:05'),
(21, 111510, 'Moneda extranjera', 1, 1, 1, '2023-02-21 09:34:05'),
(22, 1120, 'Cuentas de ahorro', 1, 1, 1, '2023-02-21 09:34:05'),
(23, 112005, 'Bancos', 1, 1, 1, '2023-02-21 09:34:05'),
(24, 112010, 'Corporaciones de ahorro y vivienda', 1, 1, 1, '2023-02-21 09:34:05'),
(25, 112015, 'Organismos cooperativos financieros', 1, 1, 1, '2023-02-21 09:34:05'),
(26, 1125, 'Fondos', 1, 1, 1, '2023-02-21 09:34:05'),
(27, 112505, 'Rotatorios moneda nacional', 1, 1, 1, '2023-02-21 09:34:06'),
(28, 112510, 'Rotatorios moneda extranjera', 1, 1, 1, '2023-02-21 09:34:06'),
(29, 112515, 'Especiales moneda nacional', 1, 1, 1, '2023-02-21 09:34:06'),
(30, 112520, 'Especiales moneda extranjera', 1, 1, 1, '2023-02-21 09:34:06'),
(31, 112525, 'De amortización moneda nacional', 1, 1, 1, '2023-02-21 09:34:06'),
(32, 112530, 'De amortización moneda extranjera', 1, 1, 1, '2023-02-21 09:34:06'),
(33, 12, 'Inversiones', 1, 1, 1, '2023-02-21 09:34:06'),
(34, 1205, 'Acciones', 1, 1, 1, '2023-02-21 09:34:06'),
(35, 120505, 'Agricultura, ganadería, caza y silvicultura', 1, 1, 1, '2023-02-21 09:34:06'),
(36, 120510, 'Pesca', 1, 1, 1, '2023-02-21 09:34:06'),
(37, 120515, 'Explotación de minas y canteras', 1, 1, 1, '2023-02-21 09:34:06'),
(38, 120520, 'Industria manufacturera', 1, 1, 1, '2023-02-21 09:34:06'),
(39, 120525, 'Suministro de electricidad, gas y agua', 1, 1, 1, '2023-02-21 09:34:06'),
(40, 120530, 'Construcción', 1, 1, 1, '2023-02-21 09:34:06'),
(41, 120535, 'Comercio al por mayor y al por menor', 1, 1, 1, '2023-02-21 09:34:06'),
(42, 120540, 'Hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:06'),
(43, 120545, 'Transporte, almacenamiento y comunicaciones', 1, 1, 1, '2023-02-21 09:34:06'),
(44, 120550, 'Actividad financiera', 1, 1, 1, '2023-02-21 09:34:06'),
(45, 120555, 'Actividades inmobiliarias, empresariales y de alquiler', 1, 1, 1, '2023-02-21 09:34:06'),
(46, 120560, 'Enseñanza', 1, 1, 1, '2023-02-21 09:34:06'),
(47, 120565, 'Servicios sociales y de salud', 1, 1, 1, '2023-02-21 09:34:06'),
(48, 120570, 'Otras actividades de servicios comunitarios, sociales y personales', 1, 1, 1, '2023-02-21 09:34:06'),
(49, 120599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:06'),
(50, 1210, 'Cuotas o partes de interés social', 1, 1, 1, '2023-02-21 09:34:06'),
(51, 121005, 'Agricultura, ganadería, caza y silvicultura', 1, 1, 1, '2023-02-21 09:34:06'),
(52, 121010, 'Pesca', 1, 1, 1, '2023-02-21 09:34:06'),
(53, 121015, 'Explotación de minas y canteras', 1, 1, 1, '2023-02-21 09:34:06'),
(54, 121020, 'Industria manufacturera', 1, 1, 1, '2023-02-21 09:34:06'),
(55, 121025, 'Suministro de electricidad, gas y agua', 1, 1, 1, '2023-02-21 09:34:07'),
(56, 121030, 'Construcción', 1, 1, 1, '2023-02-21 09:34:07'),
(57, 121035, 'Comercio al por mayor y al por menor', 1, 1, 1, '2023-02-21 09:34:07'),
(58, 121040, 'Hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:07'),
(59, 121045, 'Transporte, almacenamiento y comunicaciones', 1, 1, 1, '2023-02-21 09:34:07'),
(60, 121050, 'Actividad financiera', 1, 1, 1, '2023-02-21 09:34:07'),
(61, 121055, 'Actividades inmobiliarias, empresariales y de alquiler', 1, 1, 1, '2023-02-21 09:34:07'),
(62, 121060, 'Enseñanza', 1, 1, 1, '2023-02-21 09:34:07'),
(63, 121065, 'Servicios sociales y de salud', 1, 1, 1, '2023-02-21 09:34:07'),
(64, 121070, 'Otras actividades de servicios comunitarios, sociales y personales', 1, 1, 1, '2023-02-21 09:34:07'),
(65, 121099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:07'),
(66, 1215, 'Bonos', 1, 1, 1, '2023-02-21 09:34:07'),
(67, 121505, 'Bonos públicos moneda nacional', 1, 1, 1, '2023-02-21 09:34:07'),
(68, 121510, 'Bonos públicos moneda extranjera', 1, 1, 1, '2023-02-21 09:34:07'),
(69, 121515, 'Bonos ordinarios', 1, 1, 1, '2023-02-21 09:34:07'),
(70, 121520, 'Bonos convertibles en acciones', 1, 1, 1, '2023-02-21 09:34:07'),
(71, 121595, 'Otros', 1, 1, 1, '2023-02-21 09:34:07'),
(72, 1220, 'Cédulas', 1, 1, 1, '2023-02-21 09:34:07'),
(73, 122005, 'Cédulas de capitalización', 1, 1, 1, '2023-02-21 09:34:07'),
(74, 122010, 'Cédulas hipotecarias', 1, 1, 1, '2023-02-21 09:34:07'),
(75, 122015, 'Cédulas de inversión', 1, 1, 1, '2023-02-21 09:34:07'),
(76, 122095, 'Otras', 1, 1, 1, '2023-02-21 09:34:07'),
(77, 1225, 'Certificados', 1, 1, 1, '2023-02-21 09:34:07'),
(78, 122505, 'Certificados de depósito a término (CDT)', 1, 1, 1, '2023-02-21 09:34:07'),
(79, 122510, 'Certificados de depósito de ahorro', 1, 1, 1, '2023-02-21 09:34:08'),
(80, 122515, 'Certificados de ahorro de valor constante (CAVC)', 1, 1, 1, '2023-02-21 09:34:08'),
(81, 122520, 'Certificados de cambio', 1, 1, 1, '2023-02-21 09:34:08'),
(82, 122525, 'Certificados cafeteros valorizables', 1, 1, 1, '2023-02-21 09:34:08'),
(83, 122530, 'Certificados eléctricos valorizables (CEV)', 1, 1, 1, '2023-02-21 09:34:08'),
(84, 122535, 'Certificados de reembolso tributario (CERT)', 1, 1, 1, '2023-02-21 09:34:08'),
(85, 122540, 'Certificados de desarrollo turístico', 1, 1, 1, '2023-02-21 09:34:08'),
(86, 122545, 'Certificados de inversión forestal (CIF)', 1, 1, 1, '2023-02-21 09:34:08'),
(87, 122595, 'Otros', 1, 1, 1, '2023-02-21 09:34:08'),
(88, 1230, 'Papeles comerciales', 1, 1, 1, '2023-02-21 09:34:08'),
(89, 123005, 'Empresas comerciales', 1, 1, 1, '2023-02-21 09:34:08'),
(90, 123010, 'Empresas industriales', 1, 1, 1, '2023-02-21 09:34:08'),
(91, 123015, 'Empresas de servicios', 1, 1, 1, '2023-02-21 09:34:08'),
(92, 1235, 'Títulos', 1, 1, 1, '2023-02-21 09:34:08'),
(93, 123505, 'Títulos de desarrollo agropecuario', 1, 1, 1, '2023-02-21 09:34:08'),
(94, 123510, 'Títulos canjeables por certificados de cambio', 1, 1, 1, '2023-02-21 09:34:08'),
(95, 123515, 'Títulos de tesorería (TES)', 1, 1, 1, '2023-02-21 09:34:08'),
(96, 123520, 'Títulos de participación', 1, 1, 1, '2023-02-21 09:34:08'),
(97, 123525, 'Títulos de crédito de fomento', 1, 1, 1, '2023-02-21 09:34:08'),
(98, 123530, 'Títulos financieros agroindustriales (TFA)', 1, 1, 1, '2023-02-21 09:34:08'),
(99, 123535, 'Títulos de ahorro cafetero (TAC)', 1, 1, 1, '2023-02-21 09:34:08'),
(100, 123540, 'Títulos de ahorro nacional (TAN)', 1, 1, 1, '2023-02-21 09:34:08'),
(101, 123545, 'Títulos energéticos de rentabilidad creciente (TER)', 1, 1, 1, '2023-02-21 09:34:09'),
(102, 123550, 'Títulos de ahorro educativo (TAE)', 1, 1, 1, '2023-02-21 09:34:09'),
(103, 123555, 'Títulos financieros industriales y comerciales', 1, 1, 1, '2023-02-21 09:34:09'),
(104, 123560, 'Tesoros', 1, 1, 1, '2023-02-21 09:34:09'),
(105, 123565, 'Títulos de devolución de impuestos nacionales (TIDIS)', 1, 1, 1, '2023-02-21 09:34:09'),
(106, 123570, 'Títulos inmobiliarios', 1, 1, 1, '2023-02-21 09:34:09'),
(107, 123595, 'Otros', 1, 1, 1, '2023-02-21 09:34:09'),
(108, 1240, 'Aceptaciones bancarias o financieras', 1, 1, 1, '2023-02-21 09:34:09'),
(109, 124005, 'Bancos comerciales', 1, 1, 1, '2023-02-21 09:34:09'),
(110, 124010, 'Compañías de financiamiento comercial', 1, 1, 1, '2023-02-21 09:34:09'),
(111, 124015, 'Corporaciones financieras', 1, 1, 1, '2023-02-21 09:34:09'),
(112, 124095, 'Otras', 1, 1, 1, '2023-02-21 09:34:09'),
(113, 1245, 'Derechos fiduciarios', 1, 1, 1, '2023-02-21 09:34:09'),
(114, 124505, 'Fideicomisos de inversión moneda nacional', 1, 1, 1, '2023-02-21 09:34:09'),
(115, 124510, 'Fideicomisos de inversión moneda extranjera', 1, 1, 1, '2023-02-21 09:34:09'),
(116, 1250, 'Derechos de recompra de inversiones negociadas (repos)', 1, 1, 1, '2023-02-21 09:34:09'),
(117, 125005, 'Acciones', 1, 1, 1, '2023-02-21 09:34:10'),
(118, 125010, 'Cuotas o partes de interés social', 1, 1, 1, '2023-02-21 09:34:10'),
(119, 125015, 'Bonos', 1, 1, 1, '2023-02-21 09:34:10'),
(120, 125020, 'Cédulas', 1, 1, 1, '2023-02-21 09:34:10'),
(121, 125025, 'Certificados', 1, 1, 1, '2023-02-21 09:34:10'),
(122, 125030, 'Papeles comerciales', 1, 1, 1, '2023-02-21 09:34:10'),
(123, 125035, 'Títulos', 1, 1, 1, '2023-02-21 09:34:10'),
(124, 125040, 'Aceptaciones bancarias o financieras', 1, 1, 1, '2023-02-21 09:34:10'),
(125, 125095, 'Otros', 1, 1, 1, '2023-02-21 09:34:10'),
(126, 125099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:10'),
(127, 1255, 'Obligatorias', 1, 1, 1, '2023-02-21 09:34:10'),
(128, 125505, 'Bonos de financiamiento especial', 1, 1, 1, '2023-02-21 09:34:10'),
(129, 125510, 'Bonos de financiamiento presupuestal', 1, 1, 1, '2023-02-21 09:34:10'),
(130, 125515, 'Bonos para desarrollo social y seguridad interna (BDSI)', 1, 1, 1, '2023-02-21 09:34:10'),
(131, 125595, 'Otras', 1, 1, 1, '2023-02-21 09:34:10'),
(132, 1260, 'Cuentas en participación', 1, 1, 1, '2023-02-21 09:34:10'),
(133, 126099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:10'),
(134, 1295, 'Otras inversiones', 1, 1, 1, '2023-02-21 09:34:10'),
(135, 129505, 'Aportes en cooperativas', 1, 1, 1, '2023-02-21 09:34:10'),
(136, 129510, 'Derechos en clubes sociales', 1, 1, 1, '2023-02-21 09:34:10'),
(137, 129515, 'Acciones o derechos en clubes deportivos', 1, 1, 1, '2023-02-21 09:34:10'),
(138, 129520, 'Bonos en colegios', 1, 1, 1, '2023-02-21 09:34:10'),
(139, 129595, 'Diversas', 1, 1, 1, '2023-02-21 09:34:10'),
(140, 129599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:10'),
(141, 1299, 'Provisiones', 1, 1, 1, '2023-02-21 09:34:11'),
(142, 129905, 'Acciones', 1, 1, 1, '2023-02-21 09:34:11'),
(143, 129910, 'Cuotas o partes de interés social', 1, 1, 1, '2023-02-21 09:34:11'),
(144, 129915, 'Bonos', 1, 1, 1, '2023-02-21 09:34:11'),
(145, 129920, 'Cédulas', 1, 1, 1, '2023-02-21 09:34:11'),
(146, 129925, 'Certificados', 1, 1, 1, '2023-02-21 09:34:11'),
(147, 129930, 'Papeles comerciales', 1, 1, 1, '2023-02-21 09:34:11'),
(148, 129935, 'Títulos', 1, 1, 1, '2023-02-21 09:34:11'),
(149, 129940, 'Aceptaciones bancarias o financieras', 1, 1, 1, '2023-02-21 09:34:11'),
(150, 129945, 'Derechos fiduciarios', 1, 1, 1, '2023-02-21 09:34:11'),
(151, 129950, 'Derechos de recompra de inversiones negociadas', 1, 1, 1, '2023-02-21 09:34:11'),
(152, 129955, 'Obligatorias', 1, 1, 1, '2023-02-21 09:34:11'),
(153, 129960, 'Cuentas en participación', 1, 1, 1, '2023-02-21 09:34:11'),
(154, 129995, 'Otras inversiones', 1, 1, 1, '2023-02-21 09:34:11'),
(155, 13, 'Deudores', 1, 1, 1, '2023-02-21 09:34:11'),
(156, 1305, 'Clientes', 1, 1, 1, '2023-02-21 09:34:11'),
(157, 130505, 'Nacionales', 1, 1, 1, '2023-02-21 09:34:11'),
(158, 130510, 'Del exterior', 1, 1, 1, '2023-02-21 09:34:11'),
(159, 130515, 'Deudores del sistema', 1, 1, 1, '2023-02-21 09:34:11'),
(160, 1310, 'Cuentas corrientes comerciales', 1, 1, 1, '2023-02-21 09:34:12'),
(161, 131005, 'Casa matriz', 1, 1, 1, '2023-02-21 09:34:12'),
(162, 131010, 'Compañías vinculadas', 1, 1, 1, '2023-02-21 09:34:12'),
(163, 131015, 'Accionistas o socios', 1, 1, 1, '2023-02-21 09:34:12'),
(164, 131020, 'Particulares', 1, 1, 1, '2023-02-21 09:34:12'),
(165, 131095, 'Otras', 1, 1, 1, '2023-02-21 09:34:12'),
(166, 1315, 'Cuentas por cobrar a casa matriz', 1, 1, 1, '2023-02-21 09:34:12'),
(167, 131505, 'Ventas', 1, 1, 1, '2023-02-21 09:34:12'),
(168, 131510, 'Pagos a nombre de casa matriz', 1, 1, 1, '2023-02-21 09:34:12'),
(169, 131515, 'Valores recibidos por casa matriz', 1, 1, 1, '2023-02-21 09:34:12'),
(170, 131520, 'Préstamos', 1, 1, 1, '2023-02-21 09:34:12'),
(171, 1320, 'Cuentas por cobrar a vinculados económicos', 1, 1, 1, '2023-02-21 09:34:12'),
(172, 132005, 'Filiales', 1, 1, 1, '2023-02-21 09:34:12'),
(173, 132010, 'Subsidiarias', 1, 1, 1, '2023-02-21 09:34:12'),
(174, 132015, 'Sucursales', 1, 1, 1, '2023-02-21 09:34:13'),
(175, 1323, 'Cuentas por cobrar a directores', 1, 1, 1, '2023-02-21 09:34:13'),
(176, 1325, 'Cuentas por cobrar a socios y accionistas', 1, 1, 1, '2023-02-21 09:34:13'),
(177, 132505, 'A socios', 1, 1, 1, '2023-02-21 09:34:13'),
(178, 132510, 'A accionistas', 1, 1, 1, '2023-02-21 09:34:13'),
(179, 1328, 'Aportes por cobrar', 1, 1, 1, '2023-02-21 09:34:13'),
(180, 1330, 'Anticipos y avances', 1, 1, 1, '2023-02-21 09:34:13'),
(181, 133005, 'A proveedores', 1, 1, 1, '2023-02-21 09:34:13'),
(182, 133010, 'A contratistas', 1, 1, 1, '2023-02-21 09:34:13'),
(183, 133015, 'A trabajadores', 1, 1, 1, '2023-02-21 09:34:13'),
(184, 133020, 'A agentes', 1, 1, 1, '2023-02-21 09:34:13'),
(185, 133025, 'A concesionarios', 1, 1, 1, '2023-02-21 09:34:13'),
(186, 133030, 'De adjudicaciones', 1, 1, 1, '2023-02-21 09:34:13'),
(187, 133095, 'Otros', 1, 1, 1, '2023-02-21 09:34:13'),
(188, 133099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:13'),
(189, 1332, 'Cuentas de operación conjunta', 1, 1, 1, '2023-02-21 09:34:13'),
(190, 1335, 'Depósitos', 1, 1, 1, '2023-02-21 09:34:13'),
(191, 133505, 'Para importaciones', 1, 1, 1, '2023-02-21 09:34:13'),
(192, 133510, 'Para servicios', 1, 1, 1, '2023-02-21 09:34:13'),
(193, 133515, 'Para contratos', 1, 1, 1, '2023-02-21 09:34:13'),
(194, 133520, 'Para responsabilidades', 1, 1, 1, '2023-02-21 09:34:13'),
(195, 133525, 'Para juicios ejecutivos', 1, 1, 1, '2023-02-21 09:34:13'),
(196, 133530, 'Para adquisición de acciones, cuotas o derechos sociales', 1, 1, 1, '2023-02-21 09:34:13'),
(197, 133535, 'En garantía', 1, 1, 1, '2023-02-21 09:34:13'),
(198, 133595, 'Otros', 1, 1, 1, '2023-02-21 09:34:13'),
(199, 1340, 'Promesas de compra venta', 1, 1, 1, '2023-02-21 09:34:13'),
(200, 134005, 'De bienes raíces', 1, 1, 1, '2023-02-21 09:34:13'),
(201, 134010, 'De maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:13'),
(202, 134015, 'De flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:13'),
(203, 134020, 'De flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:14'),
(204, 134025, 'De flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:14'),
(205, 134030, 'De flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:14'),
(206, 134035, 'De semovientes', 1, 1, 1, '2023-02-21 09:34:14'),
(207, 134095, 'De otros bienes', 1, 1, 1, '2023-02-21 09:34:14'),
(208, 1345, 'Ingresos por cobrar', 1, 1, 1, '2023-02-21 09:34:14'),
(209, 134505, 'Dividendos y/o participaciones', 1, 1, 1, '2023-02-21 09:34:14'),
(210, 134510, 'Intereses', 1, 1, 1, '2023-02-21 09:34:14'),
(211, 134515, 'Comisiones', 1, 1, 1, '2023-02-21 09:34:14'),
(212, 134520, 'Honorarios', 1, 1, 1, '2023-02-21 09:34:14'),
(213, 134525, 'Servicios', 1, 1, 1, '2023-02-21 09:34:14'),
(214, 134530, 'Arrendamientos', 1, 1, 1, '2023-02-21 09:34:14'),
(215, 134535, 'CERT por cobrar', 1, 1, 1, '2023-02-21 09:34:14'),
(216, 134595, 'Otros', 1, 1, 1, '2023-02-21 09:34:14'),
(217, 1350, 'Retención sobre contratos', 1, 1, 1, '2023-02-21 09:34:14'),
(218, 135005, 'De construcción', 1, 1, 1, '2023-02-21 09:34:14'),
(219, 135010, 'De prestación de servicios', 1, 1, 1, '2023-02-21 09:34:14'),
(220, 135095, 'Otros', 1, 1, 1, '2023-02-21 09:34:14'),
(221, 1355, 'Anticipo de impuestos y contribuciones o saldos a favor', 1, 1, 1, '2023-02-21 09:34:14'),
(222, 135505, 'Anticipo de impuestos de renta y complementarios', 1, 1, 1, '2023-02-21 09:34:14'),
(223, 135510, 'Anticipo de impuestos de industria y comercio', 1, 1, 1, '2023-02-21 09:34:14'),
(224, 135515, 'Retención en la fuente', 1, 1, 1, '2023-02-21 09:34:14'),
(225, 135517, 'Impuesto a las ventas retenido', 1, 1, 1, '2023-02-21 09:34:14'),
(226, 135518, 'Impuesto de industria y comercio retenido', 1, 1, 1, '2023-02-21 09:34:14'),
(227, 135520, 'Sobrantes en liquidación privada de impuestos', 1, 1, 1, '2023-02-21 09:34:14'),
(228, 135525, 'Contribuciones', 1, 1, 1, '2023-02-21 09:34:14'),
(229, 135530, 'Impuestos descontables', 1, 1, 1, '2023-02-21 09:34:14'),
(230, 135595, 'Otros', 1, 1, 1, '2023-02-21 09:34:14'),
(231, 1360, 'Reclamaciones', 1, 1, 1, '2023-02-21 09:34:14'),
(232, 136005, 'A compañías aseguradoras', 1, 1, 1, '2023-02-21 09:34:14'),
(233, 136010, 'A transportadores', 1, 1, 1, '2023-02-21 09:34:15'),
(234, 136015, 'Por tiquetes aéreos', 1, 1, 1, '2023-02-21 09:34:15'),
(235, 136095, 'Otras', 1, 1, 1, '2023-02-21 09:34:15'),
(236, 1365, 'Cuentas por cobrar a trabajadores', 1, 1, 1, '2023-02-21 09:34:15'),
(237, 136505, 'Vivienda', 1, 1, 1, '2023-02-21 09:34:16'),
(238, 136510, 'Vehículos', 1, 1, 1, '2023-02-21 09:34:16'),
(239, 136515, 'Educación', 1, 1, 1, '2023-02-21 09:34:16'),
(240, 136520, 'Médicos, odontológicos y similares', 1, 1, 1, '2023-02-21 09:34:16'),
(241, 136525, 'Calamidad doméstica', 1, 1, 1, '2023-02-21 09:34:16'),
(242, 136530, 'Responsabilidades', 1, 1, 1, '2023-02-21 09:34:16'),
(243, 136595, 'Otros', 1, 1, 1, '2023-02-21 09:34:16'),
(244, 1370, 'Préstamos a particulares', 1, 1, 1, '2023-02-21 09:34:16'),
(245, 137005, 'Con garantía real', 1, 1, 1, '2023-02-21 09:34:16'),
(246, 137010, 'Con garantía personal', 1, 1, 1, '2023-02-21 09:34:16'),
(247, 1380, 'Deudores varios', 1, 1, 1, '2023-02-21 09:34:16'),
(248, 138005, 'Depositarios', 1, 1, 1, '2023-02-21 09:34:16'),
(249, 138010, 'Comisionistas de bolsas', 1, 1, 1, '2023-02-21 09:34:16'),
(250, 138015, 'Fondo de inversión', 1, 1, 1, '2023-02-21 09:34:16'),
(251, 138020, 'Cuentas por cobrar de terceros', 1, 1, 1, '2023-02-21 09:34:16'),
(252, 138025, 'Pagos por cuenta de terceros', 1, 1, 1, '2023-02-21 09:34:16'),
(253, 138030, 'Fondos de inversión social', 1, 1, 1, '2023-02-21 09:34:16'),
(254, 138095, 'Otros', 1, 1, 1, '2023-02-21 09:34:16'),
(255, 1385, 'Derechos de recompra de cartera negociada', 1, 1, 1, '2023-02-21 09:34:17'),
(256, 1390, 'Deudas de difícil cobro', 1, 1, 1, '2023-02-21 09:34:17'),
(257, 1399, 'Provisiones', 1, 1, 1, '2023-02-21 09:34:17'),
(258, 139905, 'Clientes', 1, 1, 1, '2023-02-21 09:34:17'),
(259, 139910, 'Cuentas corrientes comerciales', 1, 1, 1, '2023-02-21 09:34:17'),
(260, 139915, 'Cuentas por cobrar a casa matriz', 1, 1, 1, '2023-02-21 09:34:17'),
(261, 139920, 'Cuentas por cobrar a vinculados económicos', 1, 1, 1, '2023-02-21 09:34:17'),
(262, 139925, 'Cuentas por cobrar a socios y accionistas', 1, 1, 1, '2023-02-21 09:34:17'),
(263, 139930, 'Anticipos y avances', 1, 1, 1, '2023-02-21 09:34:17'),
(264, 139932, 'Cuentas de operación conjunta', 1, 1, 1, '2023-02-21 09:34:17'),
(265, 139935, 'Depósitos', 1, 1, 1, '2023-02-21 09:34:17'),
(266, 139940, 'Promesas de compraventa', 1, 1, 1, '2023-02-21 09:34:17'),
(267, 139945, 'Ingresos por cobrar', 1, 1, 1, '2023-02-21 09:34:17'),
(268, 139950, 'Retención sobre contratos', 1, 1, 1, '2023-02-21 09:34:17'),
(269, 139955, 'Reclamaciones', 1, 1, 1, '2023-02-21 09:34:17'),
(270, 139960, 'Cuentas por cobrar a trabajadores', 1, 1, 1, '2023-02-21 09:34:17'),
(271, 139965, 'Préstamos a particulares', 1, 1, 1, '2023-02-21 09:34:17'),
(272, 139975, 'Deudores varios', 1, 1, 1, '2023-02-21 09:34:17'),
(273, 139980, 'Derechos de recompra de cartera negociada', 1, 1, 1, '2023-02-21 09:34:17'),
(274, 14, 'Inventarios', 1, 1, 1, '2023-02-21 09:34:17'),
(275, 1405, 'Materias primas', 1, 1, 1, '2023-02-21 09:34:17'),
(276, 140599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:17'),
(277, 1410, 'Productos en proceso', 1, 1, 1, '2023-02-21 09:34:17'),
(278, 141099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:17'),
(279, 1415, 'Obras de construcción en curso', 1, 1, 1, '2023-02-21 09:34:17'),
(280, 141599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:17'),
(281, 1417, 'Obras de urbanismo', 1, 1, 1, '2023-02-21 09:34:18'),
(282, 141799, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(283, 1420, 'Contratos en ejecución', 1, 1, 1, '2023-02-21 09:34:18'),
(284, 142099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(285, 1425, 'Cultivos en desarrollo', 1, 1, 1, '2023-02-21 09:34:18'),
(286, 142599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(287, 1428, 'Plantaciones agrícolas', 1, 1, 1, '2023-02-21 09:34:18'),
(288, 142899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(289, 1430, 'Productos terminados', 1, 1, 1, '2023-02-21 09:34:18'),
(290, 143005, 'Productos manufacturados', 1, 1, 1, '2023-02-21 09:34:18'),
(291, 143010, 'Productos extraídos y/o procesados', 1, 1, 1, '2023-02-21 09:34:18'),
(292, 143015, 'Productos agrícolas y forestales', 1, 1, 1, '2023-02-21 09:34:18'),
(293, 143020, 'Subproductos', 1, 1, 1, '2023-02-21 09:34:18'),
(294, 143025, 'Productos de pesca', 1, 1, 1, '2023-02-21 09:34:18'),
(295, 143099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(296, 1435, 'Mercancías no fabricadas por la empresa', 1, 1, 1, '2023-02-21 09:34:18'),
(297, 143599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(298, 1440, 'Bienes raíces para la venta', 1, 1, 1, '2023-02-21 09:34:18'),
(299, 144099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(300, 1445, 'Semovientes', 1, 1, 1, '2023-02-21 09:34:18'),
(301, 144599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(302, 1450, 'Terrenos', 1, 1, 1, '2023-02-21 09:34:18'),
(303, 145005, 'Por urbanizar', 1, 1, 1, '2023-02-21 09:34:18'),
(304, 145010, 'Urbanizados por construir', 1, 1, 1, '2023-02-21 09:34:18'),
(305, 145099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(306, 1455, 'Materiales, repuestos y accesorios', 1, 1, 1, '2023-02-21 09:34:18'),
(307, 145599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(308, 1460, 'Envases y empaques', 1, 1, 1, '2023-02-21 09:34:18'),
(309, 146099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:18'),
(310, 1465, 'Inventarios en tránsito', 1, 1, 1, '2023-02-21 09:34:19'),
(311, 146599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:19'),
(312, 1499, 'Provisiones', 1, 1, 1, '2023-02-21 09:34:19'),
(313, 149905, 'Para obsolescencia', 1, 1, 1, '2023-02-21 09:34:19'),
(314, 149910, 'Para diferencia de inventario físico', 1, 1, 1, '2023-02-21 09:34:19'),
(315, 149915, 'Para pérdidas de inventarios', 1, 1, 1, '2023-02-21 09:34:19'),
(316, 149920, 'Lifo', 1, 1, 1, '2023-02-21 09:34:19'),
(317, 15, 'Propiedades, planta y equipo', 1, 1, 1, '2023-02-21 09:34:19'),
(318, 1504, 'Terrenos', 1, 1, 1, '2023-02-21 09:34:19'),
(319, 150405, 'Urbanos', 1, 1, 1, '2023-02-21 09:34:19'),
(320, 150410, 'Rurales', 1, 1, 1, '2023-02-21 09:34:19'),
(321, 150499, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:19'),
(322, 1506, 'Materiales proyectos petroleros', 1, 1, 1, '2023-02-21 09:34:19'),
(323, 150605, 'Tuberías y equipo', 1, 1, 1, '2023-02-21 09:34:19'),
(324, 150610, 'Costos de importación materiales', 1, 1, 1, '2023-02-21 09:34:19'),
(325, 150615, 'Proyectos de construcción', 1, 1, 1, '2023-02-21 09:34:19'),
(326, 150699, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:20'),
(327, 1508, 'Construcciones en curso', 1, 1, 1, '2023-02-21 09:34:20'),
(328, 150805, 'Construcciones y edificaciones', 1, 1, 1, '2023-02-21 09:34:20'),
(329, 150810, 'Acueductos, plantas y redes', 1, 1, 1, '2023-02-21 09:34:20'),
(330, 150815, 'Vías de comunicación', 1, 1, 1, '2023-02-21 09:34:20'),
(331, 150820, 'Pozos artesianos', 1, 1, 1, '2023-02-21 09:34:20'),
(332, 150825, 'Proyectos de exploración', 1, 1, 1, '2023-02-21 09:34:20'),
(333, 150830, 'Proyectos de desarrollo', 1, 1, 1, '2023-02-21 09:34:20'),
(334, 150899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:20'),
(335, 1512, 'Maquinaria y equipos en montaje', 1, 1, 1, '2023-02-21 09:34:20'),
(336, 151205, 'Maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:20'),
(337, 151210, 'Equipo de oficina', 1, 1, 1, '2023-02-21 09:34:20'),
(338, 151215, 'Equipo de computación y comunicación', 1, 1, 1, '2023-02-21 09:34:20'),
(339, 151220, 'Equipo médico-científico', 1, 1, 1, '2023-02-21 09:34:20'),
(340, 151225, 'Equipo de hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:20'),
(341, 151230, 'Flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:20'),
(342, 151235, 'Flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:20'),
(343, 151240, 'Flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:20'),
(344, 151245, 'Flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:20'),
(345, 151250, 'Plantas y redes', 1, 1, 1, '2023-02-21 09:34:20'),
(346, 151299, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:20'),
(347, 1516, 'Construcciones y edificaciones', 1, 1, 1, '2023-02-21 09:34:20'),
(348, 151605, 'Edificios', 1, 1, 1, '2023-02-21 09:34:20'),
(349, 151610, 'Oficinas', 1, 1, 1, '2023-02-21 09:34:20'),
(350, 151615, 'Almacenes', 1, 1, 1, '2023-02-21 09:34:20'),
(351, 151620, 'Fábricas y plantas industriales', 1, 1, 1, '2023-02-21 09:34:20'),
(352, 151625, 'Salas de exhibición y ventas', 1, 1, 1, '2023-02-21 09:34:20'),
(353, 151630, 'Cafetería y casinos', 1, 1, 1, '2023-02-21 09:34:20'),
(354, 151635, 'Silos', 1, 1, 1, '2023-02-21 09:34:20'),
(355, 151640, 'Invernaderos', 1, 1, 1, '2023-02-21 09:34:20'),
(356, 151645, 'Casetas y campamentos', 1, 1, 1, '2023-02-21 09:34:21'),
(357, 151650, 'Instalaciones agropecuarias', 1, 1, 1, '2023-02-21 09:34:21'),
(358, 151655, 'Viviendas para empleados y obreros', 1, 1, 1, '2023-02-21 09:34:21'),
(359, 151660, 'Terminal de buses y taxis', 1, 1, 1, '2023-02-21 09:34:21'),
(360, 151663, 'Terminal marítimo', 1, 1, 1, '2023-02-21 09:34:21'),
(361, 151665, 'Terminal férreo', 1, 1, 1, '2023-02-21 09:34:21'),
(362, 151670, 'Parqueaderos, garajes y depósitos', 1, 1, 1, '2023-02-21 09:34:21'),
(363, 151675, 'Hangares', 1, 1, 1, '2023-02-21 09:34:21'),
(364, 151680, 'Bodegas', 1, 1, 1, '2023-02-21 09:34:21'),
(365, 151695, 'Otros', 1, 1, 1, '2023-02-21 09:34:21'),
(366, 151699, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:21'),
(367, 1520, 'Maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:21'),
(368, 152099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:21'),
(369, 1524, 'Equipo de oficina', 1, 1, 1, '2023-02-21 09:34:21'),
(370, 152405, 'Muebles y enseres', 1, 1, 1, '2023-02-21 09:34:21'),
(371, 152410, 'Equipos', 1, 1, 1, '2023-02-21 09:34:21'),
(372, 152495, 'Otros', 1, 1, 1, '2023-02-21 09:34:21'),
(373, 152499, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:21'),
(374, 1528, 'Equipo de computación y comunicación', 1, 1, 1, '2023-02-21 09:34:21'),
(375, 152805, 'Equipos de procesamiento de datos', 1, 1, 1, '2023-02-21 09:34:22'),
(376, 152810, 'Equipos de telecomunicaciones', 1, 1, 1, '2023-02-21 09:34:22'),
(377, 152815, 'Equipos de radio', 1, 1, 1, '2023-02-21 09:34:22'),
(378, 152820, 'Satélites y antenas', 1, 1, 1, '2023-02-21 09:34:22'),
(379, 152825, 'Líneas telefónicas', 1, 1, 1, '2023-02-21 09:34:22'),
(380, 152895, 'Otros', 1, 1, 1, '2023-02-21 09:34:22'),
(381, 152899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:22'),
(382, 1532, 'Equipo médico-científico', 1, 1, 1, '2023-02-21 09:34:22'),
(383, 153205, 'Médico', 1, 1, 1, '2023-02-21 09:34:22'),
(384, 153210, 'Odontológico', 1, 1, 1, '2023-02-21 09:34:22'),
(385, 153215, 'Laboratorio', 1, 1, 1, '2023-02-21 09:34:22'),
(386, 153220, 'Instrumental', 1, 1, 1, '2023-02-21 09:34:22'),
(387, 153295, 'Otros', 1, 1, 1, '2023-02-21 09:34:22'),
(388, 153299, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:22'),
(389, 1536, 'Equipo de hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:22'),
(390, 153605, 'De habitaciones', 1, 1, 1, '2023-02-21 09:34:22'),
(391, 153610, 'De comestibles y bebidas', 1, 1, 1, '2023-02-21 09:34:22'),
(392, 153695, 'Otros', 1, 1, 1, '2023-02-21 09:34:22'),
(393, 153699, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:22'),
(394, 1540, 'Flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:22'),
(395, 154005, 'Autos, camionetas y camperos', 1, 1, 1, '2023-02-21 09:34:22'),
(396, 154008, 'Camiones, volquetas y furgones', 1, 1, 1, '2023-02-21 09:34:22'),
(397, 154010, 'Tractomulas y remolques', 1, 1, 1, '2023-02-21 09:34:22'),
(398, 154015, 'Buses y busetas', 1, 1, 1, '2023-02-21 09:34:22'),
(399, 154017, 'Recolectores y contenedores', 1, 1, 1, '2023-02-21 09:34:22'),
(400, 154020, 'Montacargas', 1, 1, 1, '2023-02-21 09:34:22'),
(401, 154025, 'Palas y grúas', 1, 1, 1, '2023-02-21 09:34:22'),
(402, 154030, 'Motocicletas', 1, 1, 1, '2023-02-21 09:34:22'),
(403, 154035, 'Bicicletas', 1, 1, 1, '2023-02-21 09:34:22'),
(404, 154040, 'Estibas y carretas', 1, 1, 1, '2023-02-21 09:34:22'),
(405, 154045, 'Bandas transportadoras', 1, 1, 1, '2023-02-21 09:34:22'),
(406, 154095, 'Otros', 1, 1, 1, '2023-02-21 09:34:23'),
(407, 154099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:23'),
(408, 1544, 'Flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:23'),
(409, 154405, 'Buques', 1, 1, 1, '2023-02-21 09:34:23'),
(410, 154410, 'Lanchas', 1, 1, 1, '2023-02-21 09:34:23'),
(411, 154415, 'Remolcadoras', 1, 1, 1, '2023-02-21 09:34:23'),
(412, 154420, 'Botes', 1, 1, 1, '2023-02-21 09:34:23'),
(413, 154425, 'Boyas', 1, 1, 1, '2023-02-21 09:34:23'),
(414, 154430, 'Amarres', 1, 1, 1, '2023-02-21 09:34:23'),
(415, 154435, 'Contenedores y chasises', 1, 1, 1, '2023-02-21 09:34:23'),
(416, 154440, 'Gabarras', 1, 1, 1, '2023-02-21 09:34:23'),
(417, 154495, 'Otros', 1, 1, 1, '2023-02-21 09:34:23'),
(418, 154499, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:23'),
(419, 1548, 'Flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:23'),
(420, 154805, 'Aviones', 1, 1, 1, '2023-02-21 09:34:23'),
(421, 154810, 'Avionetas', 1, 1, 1, '2023-02-21 09:34:23'),
(422, 154815, 'Helicópteros', 1, 1, 1, '2023-02-21 09:34:23'),
(423, 154820, 'Turbinas y motores', 1, 1, 1, '2023-02-21 09:34:23'),
(424, 154825, 'Manuales de entrenamiento personal técnico', 1, 1, 1, '2023-02-21 09:34:23'),
(425, 154830, 'Equipos de vuelo', 1, 1, 1, '2023-02-21 09:34:23'),
(426, 154895, 'Otros', 1, 1, 1, '2023-02-21 09:34:23'),
(427, 154899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:23'),
(428, 1552, 'Flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:23'),
(429, 155205, 'Locomotoras', 1, 1, 1, '2023-02-21 09:34:23'),
(430, 155210, 'Vagones', 1, 1, 1, '2023-02-21 09:34:23'),
(431, 155215, 'Redes férreas', 1, 1, 1, '2023-02-21 09:34:24'),
(432, 155295, 'Otros', 1, 1, 1, '2023-02-21 09:34:24'),
(433, 155299, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:24'),
(434, 1556, 'Acueductos, plantas y redes', 1, 1, 1, '2023-02-21 09:34:24'),
(435, 155605, 'Instalaciones para agua y energía', 1, 1, 1, '2023-02-21 09:34:24'),
(436, 155610, 'Acueducto, acequias y canalizaciones', 1, 1, 1, '2023-02-21 09:34:24'),
(437, 155615, 'Plantas de generación hidráulica', 1, 1, 1, '2023-02-21 09:34:24'),
(438, 155620, 'Plantas de generación térmica', 1, 1, 1, '2023-02-21 09:34:24'),
(439, 155625, 'Plantas de generación a gas', 1, 1, 1, '2023-02-21 09:34:24'),
(440, 155628, 'Plantas de generación diesel, gasolina y petróleo', 1, 1, 1, '2023-02-21 09:34:24'),
(441, 155630, 'Plantas de distribución', 1, 1, 1, '2023-02-21 09:34:24'),
(442, 155635, 'Plantas de transmisión y subestaciones', 1, 1, 1, '2023-02-21 09:34:24'),
(443, 155640, 'Oleoductos', 1, 1, 1, '2023-02-21 09:34:24'),
(444, 155645, 'Gasoductos', 1, 1, 1, '2023-02-21 09:34:24'),
(445, 155647, 'Poliductos', 1, 1, 1, '2023-02-21 09:34:24'),
(446, 155650, 'Redes de distribución', 1, 1, 1, '2023-02-21 09:34:24'),
(447, 155655, 'Plantas de tratamiento', 1, 1, 1, '2023-02-21 09:34:24'),
(448, 155660, 'Redes de recolección de aguas negras', 1, 1, 1, '2023-02-21 09:34:24'),
(449, 155665, 'Instalaciones y equipo de bombeo', 1, 1, 1, '2023-02-21 09:34:24'),
(450, 155670, 'Redes de distribución de vapor', 1, 1, 1, '2023-02-21 09:34:24'),
(451, 155675, 'Redes de aire', 1, 1, 1, '2023-02-21 09:34:24'),
(452, 155680, 'Redes alimentación de gas', 1, 1, 1, '2023-02-21 09:34:24'),
(453, 155682, 'Redes externas de telefonía', 1, 1, 1, '2023-02-21 09:34:24'),
(454, 155685, 'Plantas deshidratadoras', 1, 1, 1, '2023-02-21 09:34:24'),
(455, 155695, 'Otros', 1, 1, 1, '2023-02-21 09:34:24'),
(456, 155699, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:24'),
(457, 1560, 'Armamento de vigilancia', 1, 1, 1, '2023-02-21 09:34:25'),
(458, 156099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:25'),
(459, 1562, 'Envases y empaques', 1, 1, 1, '2023-02-21 09:34:25'),
(460, 156299, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:25'),
(461, 1564, 'Plantaciones agrícolas y forestales', 1, 1, 1, '2023-02-21 09:34:25'),
(462, 156405, 'Cultivos en desarrollo', 1, 1, 1, '2023-02-21 09:34:25'),
(463, 156410, 'Cultivos amortizables', 1, 1, 1, '2023-02-21 09:34:25'),
(464, 156499, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:25'),
(465, 1568, 'Vías de comunicación', 1, 1, 1, '2023-02-21 09:34:26'),
(466, 156805, 'Pavimentación y patios', 1, 1, 1, '2023-02-21 09:34:26'),
(467, 156810, 'Vías', 1, 1, 1, '2023-02-21 09:34:26'),
(468, 156815, 'Puentes', 1, 1, 1, '2023-02-21 09:34:26'),
(469, 156820, 'Calles', 1, 1, 1, '2023-02-21 09:34:26'),
(470, 156825, 'Aeródromos', 1, 1, 1, '2023-02-21 09:34:26'),
(471, 156895, 'Otros', 1, 1, 1, '2023-02-21 09:34:26'),
(472, 156899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:26'),
(473, 1572, 'Minas y canteras', 1, 1, 1, '2023-02-21 09:34:26'),
(474, 157205, 'Minas', 1, 1, 1, '2023-02-21 09:34:26'),
(475, 157210, 'Canteras', 1, 1, 1, '2023-02-21 09:34:26'),
(476, 157299, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:26'),
(477, 1576, 'Pozos artesianos', 1, 1, 1, '2023-02-21 09:34:26'),
(478, 157699, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:26'),
(479, 1580, 'Yacimientos', 1, 1, 1, '2023-02-21 09:34:26'),
(480, 158099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:26'),
(481, 1584, 'Semovientes', 1, 1, 1, '2023-02-21 09:34:26'),
(482, 158499, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:26'),
(483, 1588, 'Propiedades, planta y equipo en tránsito', 1, 1, 1, '2023-02-21 09:34:26'),
(484, 158805, 'Maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:26'),
(485, 158810, 'Equipo de oficina', 1, 1, 1, '2023-02-21 09:34:27'),
(486, 158815, 'Equipo de computación y comunicación', 1, 1, 1, '2023-02-21 09:34:27'),
(487, 158820, 'Equipo médico-científico', 1, 1, 1, '2023-02-21 09:34:27'),
(488, 158825, 'Equipo de hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:27'),
(489, 158830, 'Flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:27'),
(490, 158835, 'Flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:27'),
(491, 158840, 'Flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:27'),
(492, 158845, 'Flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:27'),
(493, 158850, 'Plantas y redes', 1, 1, 1, '2023-02-21 09:34:28'),
(494, 158855, 'Armamento de vigilancia', 1, 1, 1, '2023-02-21 09:34:28'),
(495, 158860, 'Semovientes', 1, 1, 1, '2023-02-21 09:34:28'),
(496, 158865, 'Envases y empaques', 1, 1, 1, '2023-02-21 09:34:28'),
(497, 158899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:28'),
(498, 1592, 'Depreciación acumulada', 1, 1, 1, '2023-02-21 09:34:28'),
(499, 159205, 'Construcciones y edificaciones', 1, 1, 1, '2023-02-21 09:34:28'),
(500, 159210, 'Maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:28'),
(501, 159215, 'Equipo de oficina', 1, 1, 1, '2023-02-21 09:34:28'),
(502, 159220, 'Equipo de computación y comunicación', 1, 1, 1, '2023-02-21 09:34:28'),
(503, 159225, 'Equipo médico-científico', 1, 1, 1, '2023-02-21 09:34:28'),
(504, 159230, 'Equipo de hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:28'),
(505, 159235, 'Flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:28'),
(506, 159240, 'Flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:28'),
(507, 159245, 'Flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:28'),
(508, 159250, 'Flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:28'),
(509, 159255, 'Acueductos, plantas y redes', 1, 1, 1, '2023-02-21 09:34:28'),
(510, 159260, 'Armamento de vigilancia', 1, 1, 1, '2023-02-21 09:34:28'),
(511, 159265, 'Envases y empaques', 1, 1, 1, '2023-02-21 09:34:28'),
(512, 159299, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:28'),
(513, 1596, 'Depreciación diferida', 1, 1, 1, '2023-02-21 09:34:28'),
(514, 159605, 'Exceso fiscal sobre la contable', 1, 1, 1, '2023-02-21 09:34:28'),
(515, 159610, 'Defecto fiscal sobre la contable (CR)', 1, 1, 1, '2023-02-21 09:34:28'),
(516, 159699, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:28'),
(517, 1597, 'Amortización acumulada', 1, 1, 1, '2023-02-21 09:34:29'),
(518, 159705, 'Plantaciones agrícolas y forestales', 1, 1, 1, '2023-02-21 09:34:29'),
(519, 159710, 'Vías de comunicación', 1, 1, 1, '2023-02-21 09:34:29'),
(520, 159715, 'Semovientes', 1, 1, 1, '2023-02-21 09:34:29'),
(521, 159799, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:29'),
(522, 1598, 'Agotamiento acumulado', 1, 1, 1, '2023-02-21 09:34:29'),
(523, 159805, 'Minas y canteras', 1, 1, 1, '2023-02-21 09:34:29'),
(524, 159815, 'Pozos artesianos', 1, 1, 1, '2023-02-21 09:34:29'),
(525, 159820, 'Yacimientos', 1, 1, 1, '2023-02-21 09:34:29'),
(526, 159899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:29'),
(527, 1599, 'Provisiones', 1, 1, 1, '2023-02-21 09:34:29'),
(528, 159904, 'Terrenos', 1, 1, 1, '2023-02-21 09:34:29'),
(529, 159906, 'Materiales proyectos petroleros', 1, 1, 1, '2023-02-21 09:34:29'),
(530, 159908, 'Construcciones en curso', 1, 1, 1, '2023-02-21 09:34:29'),
(531, 159912, 'Maquinaria en montaje', 1, 1, 1, '2023-02-21 09:34:29'),
(532, 159916, 'Construcciones y edificaciones', 1, 1, 1, '2023-02-21 09:34:29'),
(533, 159920, 'Maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:29'),
(534, 159924, 'Equipo de oficina', 1, 1, 1, '2023-02-21 09:34:29'),
(535, 159928, 'Equipo de computación y comunicación', 1, 1, 1, '2023-02-21 09:34:29'),
(536, 159932, 'Equipo médico-científico', 1, 1, 1, '2023-02-21 09:34:29'),
(537, 159936, 'Equipo de hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:29'),
(538, 159940, 'Flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:29'),
(539, 159944, 'Flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:29'),
(540, 159948, 'Flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:29'),
(541, 159952, 'Flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:29'),
(542, 159956, 'Acueductos, plantas y redes', 1, 1, 1, '2023-02-21 09:34:30'),
(543, 159960, 'Armamento de vigilancia', 1, 1, 1, '2023-02-21 09:34:30'),
(544, 159962, 'Envases y empaques', 1, 1, 1, '2023-02-21 09:34:30'),
(545, 159964, 'Plantaciones agrícolas y forestales', 1, 1, 1, '2023-02-21 09:34:30'),
(546, 159968, 'Vías de comunicación', 1, 1, 1, '2023-02-21 09:34:30'),
(547, 159972, 'Minas y canteras', 1, 1, 1, '2023-02-21 09:34:30'),
(548, 159980, 'Pozos artesianos', 1, 1, 1, '2023-02-21 09:34:30'),
(549, 159984, 'Yacimientos', 1, 1, 1, '2023-02-21 09:34:30'),
(550, 159988, 'Semovientes', 1, 1, 1, '2023-02-21 09:34:30'),
(551, 159992, 'Propiedades, planta y equipo en tránsito', 1, 1, 1, '2023-02-21 09:34:30'),
(552, 16, 'Intangibles', 1, 1, 1, '2023-02-21 09:34:30'),
(553, 1605, 'Crédito mercantil', 1, 1, 1, '2023-02-21 09:34:30'),
(554, 160505, 'Formado o estimado', 1, 1, 1, '2023-02-21 09:34:30'),
(555, 160510, 'Adquirido o comprado', 1, 1, 1, '2023-02-21 09:34:30'),
(556, 160599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:30'),
(557, 1610, 'Marcas', 1, 1, 1, '2023-02-21 09:34:30'),
(558, 161005, 'Adquiridas', 1, 1, 1, '2023-02-21 09:34:30'),
(559, 161010, 'Formadas', 1, 1, 1, '2023-02-21 09:34:30'),
(560, 161099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:30'),
(561, 1615, 'Patentes', 1, 1, 1, '2023-02-21 09:34:30'),
(562, 161505, 'Adquiridas', 1, 1, 1, '2023-02-21 09:34:30'),
(563, 161510, 'Formadas', 1, 1, 1, '2023-02-21 09:34:30'),
(564, 161599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:31'),
(565, 1620, 'Concesiones y franquicias', 1, 1, 1, '2023-02-21 09:34:31'),
(566, 162005, 'Concesiones', 1, 1, 1, '2023-02-21 09:34:31'),
(567, 162010, 'Franquicias', 1, 1, 1, '2023-02-21 09:34:31'),
(568, 162099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:31'),
(569, 1625, 'Derechos', 1, 1, 1, '2023-02-21 09:34:31'),
(570, 162505, 'Derechos de autor', 1, 1, 1, '2023-02-21 09:34:31'),
(571, 162510, 'Puesto de bolsa', 1, 1, 1, '2023-02-21 09:34:31'),
(572, 162515, 'En fideicomisos inmobiliarios', 1, 1, 1, '2023-02-21 09:34:31'),
(573, 162520, 'En fideicomisos de garantía', 1, 1, 1, '2023-02-21 09:34:31'),
(574, 162525, 'En fideicomisos de administración', 1, 1, 1, '2023-02-21 09:34:31'),
(575, 162530, 'De exhibición - películas', 1, 1, 1, '2023-02-21 09:34:31'),
(576, 162535, 'En bienes recibidos en arrendamiento financiero (leasing)', 1, 1, 1, '2023-02-21 09:34:31'),
(577, 162595, 'Otros', 1, 1, 1, '2023-02-21 09:34:31'),
(578, 162599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:31'),
(579, 1630, 'Know how', 1, 1, 1, '2023-02-21 09:34:31'),
(580, 163099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:31'),
(581, 1635, 'Licencias', 1, 1, 1, '2023-02-21 09:34:31'),
(582, 163599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:31'),
(583, 1698, 'Depreciación y/o amortización acumulada', 1, 1, 1, '2023-02-21 09:34:31'),
(584, 169805, 'Crédito mercantil', 1, 1, 1, '2023-02-21 09:34:31'),
(585, 169810, 'Marcas', 1, 1, 1, '2023-02-21 09:34:32'),
(586, 169815, 'Patentes', 1, 1, 1, '2023-02-21 09:34:32'),
(587, 169820, 'Concesiones y franquicias', 1, 1, 1, '2023-02-21 09:34:32'),
(588, 169830, 'Derechos', 1, 1, 1, '2023-02-21 09:34:32'),
(589, 169835, 'Know how', 1, 1, 1, '2023-02-21 09:34:32'),
(590, 169840, 'Licencias', 1, 1, 1, '2023-02-21 09:34:32'),
(591, 169899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:32'),
(592, 1699, 'Provisiones', 1, 1, 1, '2023-02-21 09:34:32'),
(593, 17, 'Diferidos', 1, 1, 1, '2023-02-21 09:34:32'),
(594, 1705, 'Gastos pagados por anticipado', 1, 1, 1, '2023-02-21 09:34:32'),
(595, 170505, 'Intereses', 1, 1, 1, '2023-02-21 09:34:32'),
(596, 170510, 'Honorarios', 1, 1, 1, '2023-02-21 09:34:32'),
(597, 170515, 'Comisiones', 1, 1, 1, '2023-02-21 09:34:32'),
(598, 170520, 'Seguros y fianzas', 1, 1, 1, '2023-02-21 09:34:32'),
(599, 170525, 'Arrendamientos', 1, 1, 1, '2023-02-21 09:34:32'),
(600, 170530, 'Bodegajes', 1, 1, 1, '2023-02-21 09:34:32'),
(601, 170535, 'Mantenimiento equipos', 1, 1, 1, '2023-02-21 09:34:32'),
(602, 170540, 'Servicios', 1, 1, 1, '2023-02-21 09:34:32'),
(603, 170545, 'Suscripciones', 1, 1, 1, '2023-02-21 09:34:32'),
(604, 170595, 'Otros', 1, 1, 1, '2023-02-21 09:34:33'),
(605, 1710, 'Cargos diferidos', 1, 1, 1, '2023-02-21 09:34:33'),
(606, 171004, 'Organización y preoperativos', 1, 1, 1, '2023-02-21 09:34:33'),
(607, 171008, 'Remodelaciones', 1, 1, 1, '2023-02-21 09:34:33'),
(608, 171012, 'Estudios, investigaciones y proyectos', 1, 1, 1, '2023-02-21 09:34:33'),
(609, 171016, 'Programas para computador (software)', 1, 1, 1, '2023-02-21 09:34:33'),
(610, 171020, 'Útiles y papelería', 1, 1, 1, '2023-02-21 09:34:33'),
(611, 171024, 'Mejoras a propiedades ajenas', 1, 1, 1, '2023-02-21 09:34:33'),
(612, 171028, 'Contribuciones y afiliaciones', 1, 1, 1, '2023-02-21 09:34:33'),
(613, 171032, 'Entrenamiento de personal', 1, 1, 1, '2023-02-21 09:34:33'),
(614, 171036, 'Ferias y exposiciones', 1, 1, 1, '2023-02-21 09:34:33'),
(615, 171040, 'Licencias', 1, 1, 1, '2023-02-21 09:34:34'),
(616, 171044, 'Publicidad, propaganda y promoción', 1, 1, 1, '2023-02-21 09:34:34'),
(617, 171048, 'Elementos de aseo y cafetería', 1, 1, 1, '2023-02-21 09:34:34'),
(618, 171052, 'Moldes y troqueles', 1, 1, 1, '2023-02-21 09:34:34'),
(619, 171056, 'Instrumental quirúrgico', 1, 1, 1, '2023-02-21 09:34:34'),
(620, 171060, 'Dotación y suministro a trabajadores', 1, 1, 1, '2023-02-21 09:34:34'),
(621, 171064, 'Elementos de ropería y lencería', 1, 1, 1, '2023-02-21 09:34:34'),
(622, 171068, 'Loza y cristalería', 1, 1, 1, '2023-02-21 09:34:34'),
(623, 171069, 'Platería', 1, 1, 1, '2023-02-21 09:34:34'),
(624, 171070, 'Cubiertería', 1, 1, 1, '2023-02-21 09:34:34'),
(625, 171076, 'Impuesto de renta diferido ?débitos? por diferencias temporales', 1, 1, 1, '2023-02-21 09:34:34'),
(626, 171080, 'Concursos y licitaciones', 1, 1, 1, '2023-02-21 09:34:34'),
(627, 171095, 'Otros', 1, 1, 1, '2023-02-21 09:34:34'),
(628, 171099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:34'),
(629, 1715, 'Costos de exploración por amortizar', 1, 1, 1, '2023-02-21 09:34:34'),
(630, 171505, 'Pozos secos', 1, 1, 1, '2023-02-21 09:34:34'),
(631, 171510, 'Pozos no comerciales', 1, 1, 1, '2023-02-21 09:34:34'),
(632, 171515, 'Otros costos de exploración', 1, 1, 1, '2023-02-21 09:34:34'),
(633, 171599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:34'),
(634, 1720, 'Costos de explotación y desarrollo', 1, 1, 1, '2023-02-21 09:34:34'),
(635, 172005, 'Perforación y explotación', 1, 1, 1, '2023-02-21 09:34:34'),
(636, 172010, 'Perforaciones campos en desarrollo', 1, 1, 1, '2023-02-21 09:34:35'),
(637, 172015, 'Facilidades de producción', 1, 1, 1, '2023-02-21 09:34:35'),
(638, 172020, 'Servicio a pozos', 1, 1, 1, '2023-02-21 09:34:35'),
(639, 172099, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:35'),
(640, 1730, 'Cargos por corrección monetaria diferida', 1, 1, 1, '2023-02-21 09:34:35'),
(641, 1798, 'Amortización acumulada', 1, 1, 1, '2023-02-21 09:34:35'),
(642, 179805, 'Costos de exploración por amortizar', 1, 1, 1, '2023-02-21 09:34:35'),
(643, 179810, 'Costos de explotación y desarrollo', 1, 1, 1, '2023-02-21 09:34:35'),
(644, 179899, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:35'),
(645, 18, 'Otros activos', 1, 1, 1, '2023-02-21 09:34:35'),
(646, 1805, 'Bienes de arte y cultura', 1, 1, 1, '2023-02-21 09:34:35'),
(647, 180505, 'Obras de arte', 1, 1, 1, '2023-02-21 09:34:36'),
(648, 180510, 'Bibliotecas', 1, 1, 1, '2023-02-21 09:34:36'),
(649, 180595, 'Otros', 1, 1, 1, '2023-02-21 09:34:36'),
(650, 180599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:36'),
(651, 1895, 'Diversos', 1, 1, 1, '2023-02-21 09:34:36'),
(652, 189505, 'Máquinas porteadoras', 1, 1, 1, '2023-02-21 09:34:36'),
(653, 189510, 'Bienes entregados en comodato', 1, 1, 1, '2023-02-21 09:34:36'),
(654, 189515, 'Amortización acumulada de bienes entregados en comodato (CR)', 1, 1, 1, '2023-02-21 09:34:36'),
(655, 189520, 'Bienes recibidos en pago', 1, 1, 1, '2023-02-21 09:34:36'),
(656, 189525, 'Derechos sucesorales', 1, 1, 1, '2023-02-21 09:34:36'),
(657, 189530, 'Estampillas', 1, 1, 1, '2023-02-21 09:34:36'),
(658, 189595, 'Otros', 1, 1, 1, '2023-02-21 09:34:36'),
(659, 189599, 'Ajustes por inflación', 1, 1, 1, '2023-02-21 09:34:36'),
(660, 1899, 'Provisiones', 1, 1, 1, '2023-02-21 09:34:36'),
(661, 189905, 'Bienes de arte y cultura', 1, 1, 1, '2023-02-21 09:34:36'),
(662, 189995, 'Diversos', 1, 1, 1, '2023-02-21 09:34:36'),
(663, 19, 'Valorizaciones', 1, 1, 1, '2023-02-21 09:34:36'),
(664, 1905, 'De inversiones', 1, 1, 1, '2023-02-21 09:34:36'),
(665, 190505, 'Acciones', 1, 1, 1, '2023-02-21 09:34:36'),
(666, 190510, 'Cuotas o partes de interés social', 1, 1, 1, '2023-02-21 09:34:36'),
(667, 190515, 'Derechos fiduciarios', 1, 1, 1, '2023-02-21 09:34:36'),
(668, 1910, 'De propiedades, planta y equipo', 1, 1, 1, '2023-02-21 09:34:36'),
(669, 191004, 'Terrenos', 1, 1, 1, '2023-02-21 09:34:36'),
(670, 191006, 'Materiales proyectos petroleros', 1, 1, 1, '2023-02-21 09:34:36'),
(671, 191008, 'Construcciones y edificaciones', 1, 1, 1, '2023-02-21 09:34:36'),
(672, 191012, 'Maquinaria y equipo', 1, 1, 1, '2023-02-21 09:34:36'),
(673, 191016, 'Equipo de oficina', 1, 1, 1, '2023-02-21 09:34:37'),
(674, 191020, 'Equipo de computación y comunicación', 1, 1, 1, '2023-02-21 09:34:37'),
(675, 191024, 'Equipo médico-científico', 1, 1, 1, '2023-02-21 09:34:37'),
(676, 191028, 'Equipo de hoteles y restaurantes', 1, 1, 1, '2023-02-21 09:34:37'),
(677, 191032, 'Flota y equipo de transporte', 1, 1, 1, '2023-02-21 09:34:37'),
(678, 191036, 'Flota y equipo fluvial y/o marítimo', 1, 1, 1, '2023-02-21 09:34:37'),
(679, 191040, 'Flota y equipo aéreo', 1, 1, 1, '2023-02-21 09:34:37'),
(680, 191044, 'Flota y equipo férreo', 1, 1, 1, '2023-02-21 09:34:37'),
(681, 191048, 'Acueductos, plantas y redes', 1, 1, 1, '2023-02-21 09:34:37'),
(682, 191052, 'Armamento de vigilancia', 1, 1, 1, '2023-02-21 09:34:37'),
(683, 191056, 'Envases y empaques', 1, 1, 1, '2023-02-21 09:34:37'),
(684, 191060, 'Plantaciones agrícolas y forestales', 1, 1, 1, '2023-02-21 09:34:37'),
(685, 191064, 'Vías de comunicación', 1, 1, 1, '2023-02-21 09:34:37'),
(686, 191068, 'Minas y canteras', 1, 1, 1, '2023-02-21 09:34:37'),
(687, 191072, 'Pozos artesianos', 1, 1, 1, '2023-02-21 09:34:37'),
(688, 191076, 'Yacimientos', 1, 1, 1, '2023-02-21 09:34:37'),
(689, 191080, 'Semovientes', 1, 1, 1, '2023-02-21 09:34:37'),
(690, 1995, 'De otros activos', 1, 1, 1, '2023-02-21 09:34:37'),
(691, 199505, 'Bienes de arte y cultura', 1, 1, 1, '2023-02-21 09:34:37'),
(692, 199510, 'Bienes entregados en comodato', 1, 1, 1, '2023-02-21 09:34:37'),
(693, 199515, 'Bienes recibidos en pago', 1, 1, 1, '2023-02-21 09:34:37'),
(694, 199520, 'Inventario de semovientes', 1, 1, 1, '2023-02-21 09:34:37'),
(696, 21, 'Obligaciones financieras', 2, 1, 1, '2023-02-21 09:38:40'),
(697, 2105, 'Bancos nacionales', 2, 1, 1, '2023-02-21 09:38:40'),
(698, 210505, 'Sobregiros', 2, 1, 1, '2023-02-21 09:38:40'),
(699, 210510, 'Pagarés', 2, 1, 1, '2023-02-21 09:38:40'),
(700, 210515, 'Cartas de crédito', 2, 1, 1, '2023-02-21 09:38:40'),
(701, 210520, 'Aceptaciones bancarias', 2, 1, 1, '2023-02-21 09:38:40'),
(702, 2110, 'Bancos del exterior', 2, 1, 1, '2023-02-21 09:38:40'),
(703, 211005, 'Sobregiros', 2, 1, 1, '2023-02-21 09:38:40'),
(704, 211010, 'Pagarés', 2, 1, 1, '2023-02-21 09:38:41'),
(705, 211015, 'Cartas de crédito', 2, 1, 1, '2023-02-21 09:38:41'),
(706, 211020, 'Aceptaciones bancarias', 2, 1, 1, '2023-02-21 09:38:41'),
(707, 2115, 'Corporaciones financieras', 2, 1, 1, '2023-02-21 09:38:41'),
(708, 211505, 'Pagarés', 2, 1, 1, '2023-02-21 09:38:41'),
(709, 211510, 'Aceptaciones financieras', 2, 1, 1, '2023-02-21 09:38:41'),
(710, 211515, 'Cartas de crédito', 2, 1, 1, '2023-02-21 09:38:41'),
(711, 211520, 'Contratos de arrendamiento financiero (leasing)', 2, 1, 1, '2023-02-21 09:38:41'),
(712, 2120, 'Compañías de financiamiento comercial', 2, 1, 1, '2023-02-21 09:38:41'),
(713, 212005, 'Pagarés', 2, 1, 1, '2023-02-21 09:38:41'),
(714, 212010, 'Aceptaciones financieras', 2, 1, 1, '2023-02-21 09:38:41'),
(715, 212020, 'Contratos de arrendamiento financiero (leasing)', 2, 1, 1, '2023-02-21 09:38:41'),
(716, 2125, 'Corporaciones de ahorro y vivienda', 2, 1, 1, '2023-02-21 09:38:41'),
(717, 212505, 'Sobregiros', 2, 1, 1, '2023-02-21 09:38:41'),
(718, 212510, 'Pagarés', 2, 1, 1, '2023-02-21 09:38:41'),
(719, 212515, 'Hipotecarias', 2, 1, 1, '2023-02-21 09:38:41');
INSERT INTO `pucs` (`id`, `code`, `nombre`, `parent_id`, `status`, `created_by`, `created_at`) VALUES
(720, 2130, 'Entidades financieras del exterior', 2, 1, 1, '2023-02-21 09:38:41'),
(721, 2135, 'Compromisos de recompra de inversiones negociadas', 2, 1, 1, '2023-02-21 09:38:41'),
(722, 213505, 'Acciones', 2, 1, 1, '2023-02-21 09:38:41'),
(723, 213510, 'Cuotas o partes de interés social', 2, 1, 1, '2023-02-21 09:38:41'),
(724, 213515, 'Bonos', 2, 1, 1, '2023-02-21 09:38:41'),
(725, 213520, 'Cédulas', 2, 1, 1, '2023-02-21 09:38:41'),
(726, 213525, 'Certificados', 2, 1, 1, '2023-02-21 09:38:41'),
(727, 213530, 'Papeles comerciales', 2, 1, 1, '2023-02-21 09:38:41'),
(728, 213535, 'Títulos', 2, 1, 1, '2023-02-21 09:38:41'),
(729, 213540, 'Aceptaciones bancarias o financieras', 2, 1, 1, '2023-02-21 09:38:41'),
(730, 213595, 'Otros', 2, 1, 1, '2023-02-21 09:38:41'),
(731, 2140, 'Compromisos de recompra de cartera negociada', 2, 1, 1, '2023-02-21 09:38:41'),
(732, 2145, 'Obligaciones gubernamentales', 2, 1, 1, '2023-02-21 09:38:41'),
(733, 214505, 'Gobierno Nacional', 2, 1, 1, '2023-02-21 09:38:42'),
(734, 214510, 'Entidades oficiales', 2, 1, 1, '2023-02-21 09:38:42'),
(735, 2195, 'Otras obligaciones', 2, 1, 1, '2023-02-21 09:38:42'),
(736, 219505, 'Particulares', 2, 1, 1, '2023-02-21 09:38:42'),
(737, 219510, 'Compañías vinculadas', 2, 1, 1, '2023-02-21 09:38:42'),
(738, 219515, 'Casa matriz', 2, 1, 1, '2023-02-21 09:38:42'),
(739, 219520, 'Socios o accionistas', 2, 1, 1, '2023-02-21 09:38:42'),
(740, 219525, 'Fondos y cooperativas', 2, 1, 1, '2023-02-21 09:38:42'),
(741, 219530, 'Directores', 2, 1, 1, '2023-02-21 09:38:42'),
(742, 219595, 'Otras', 2, 1, 1, '2023-02-21 09:38:42'),
(743, 22, 'Proveedores', 2, 1, 1, '2023-02-21 09:38:42'),
(744, 2205, 'Nacionales', 2, 1, 1, '2023-02-21 09:38:42'),
(745, 2210, 'Del exterior', 2, 1, 1, '2023-02-21 09:38:42'),
(746, 2215, 'Cuentas corrientes comerciales', 2, 1, 1, '2023-02-21 09:38:42'),
(747, 2220, 'Casa matriz', 2, 1, 1, '2023-02-21 09:38:42'),
(748, 2225, 'Compañías vinculadas', 2, 1, 1, '2023-02-21 09:38:42'),
(749, 23, 'Cuentas por pagar', 2, 1, 1, '2023-02-21 09:38:42'),
(750, 2305, 'Cuentas corrientes comerciales', 2, 1, 1, '2023-02-21 09:38:42'),
(751, 2310, 'A casa matriz', 2, 1, 1, '2023-02-21 09:38:42'),
(752, 2315, 'A compañías vinculadas', 2, 1, 1, '2023-02-21 09:38:42'),
(753, 2320, 'A contratistas', 2, 1, 1, '2023-02-21 09:38:42'),
(754, 2330, 'Órdenes de compra por utilizar', 2, 1, 1, '2023-02-21 09:38:42'),
(755, 2335, 'Costos y gastos por pagar', 2, 1, 1, '2023-02-21 09:38:42'),
(756, 233505, 'Gastos financieros', 2, 1, 1, '2023-02-21 09:38:42'),
(757, 233510, 'Gastos legales', 2, 1, 1, '2023-02-21 09:38:43'),
(758, 233515, 'Libros, suscripciones, periódicos y revistas', 2, 1, 1, '2023-02-21 09:38:43'),
(759, 233520, 'Comisiones', 2, 1, 1, '2023-02-21 09:38:43'),
(760, 233525, 'Honorarios', 2, 1, 1, '2023-02-21 09:38:43'),
(761, 233530, 'Servicios técnicos', 2, 1, 1, '2023-02-21 09:38:43'),
(762, 233535, 'Servicios de mantenimiento', 2, 1, 1, '2023-02-21 09:38:43'),
(763, 233540, 'Arrendamientos', 2, 1, 1, '2023-02-21 09:38:43'),
(764, 233545, 'Transportes, fletes y acarreos', 2, 1, 1, '2023-02-21 09:38:43'),
(765, 233550, 'Servicios públicos', 2, 1, 1, '2023-02-21 09:38:43'),
(766, 233555, 'Seguros', 2, 1, 1, '2023-02-21 09:38:43'),
(767, 233560, 'Gastos de viaje', 2, 1, 1, '2023-02-21 09:38:43'),
(768, 233565, 'Gastos de representación y relaciones públicas', 2, 1, 1, '2023-02-21 09:38:43'),
(769, 233570, 'Servicios aduaneros', 2, 1, 1, '2023-02-21 09:38:43'),
(770, 233595, 'Otros', 2, 1, 1, '2023-02-21 09:38:43'),
(771, 2340, 'Instalamentos por pagar', 2, 1, 1, '2023-02-21 09:38:43'),
(772, 2345, 'Acreedores oficiales', 2, 1, 1, '2023-02-21 09:38:43'),
(773, 2350, 'Regalías por pagar', 2, 1, 1, '2023-02-21 09:38:43'),
(774, 2355, 'Deudas con accionistas o socios', 2, 1, 1, '2023-02-21 09:38:43'),
(775, 235505, 'Accionistas', 2, 1, 1, '2023-02-21 09:38:43'),
(776, 235510, 'Socios', 2, 1, 1, '2023-02-21 09:38:44'),
(777, 2357, 'Deudas con directores', 2, 1, 1, '2023-02-21 09:38:44'),
(778, 2360, 'Dividendos o participaciones por pagar', 2, 1, 1, '2023-02-21 09:38:44'),
(779, 236005, 'Dividendos', 2, 1, 1, '2023-02-21 09:38:44'),
(780, 236010, 'Participaciones', 2, 1, 1, '2023-02-21 09:38:44'),
(781, 2365, 'Retención en la fuente', 2, 1, 1, '2023-02-21 09:38:44'),
(782, 236505, 'Salarios y pagos laborales', 2, 1, 1, '2023-02-21 09:38:44'),
(783, 236510, 'Dividendos y/o participaciones', 2, 1, 1, '2023-02-21 09:38:44'),
(784, 236515, 'Honorarios', 2, 1, 1, '2023-02-21 09:38:44'),
(785, 236520, 'Comisiones', 2, 1, 1, '2023-02-21 09:38:44'),
(786, 236525, 'Servicios', 2, 1, 1, '2023-02-21 09:38:44'),
(787, 236530, 'Arrendamientos', 2, 1, 1, '2023-02-21 09:38:44'),
(788, 236535, 'Rendimientos financieros', 2, 1, 1, '2023-02-21 09:38:44'),
(789, 236540, 'Compras', 2, 1, 1, '2023-02-21 09:38:44'),
(790, 236545, 'Loterías, rifas, apuestas y similares', 2, 1, 1, '2023-02-21 09:38:44'),
(791, 236550, 'Por pagos al exterior', 2, 1, 1, '2023-02-21 09:38:44'),
(792, 236555, 'Por ingresos obtenidos en el exterior', 2, 1, 1, '2023-02-21 09:38:44'),
(793, 236560, 'Enajenación propiedades planta y equipo, personas naturales', 2, 1, 1, '2023-02-21 09:38:44'),
(794, 236565, 'Por impuesto de timbre', 2, 1, 1, '2023-02-21 09:38:44'),
(795, 236570, 'Otras retenciones y patrimonio', 2, 1, 1, '2023-02-21 09:38:45'),
(796, 236575, 'Autorretenciones', 2, 1, 1, '2023-02-21 09:38:45'),
(797, 2367, 'Impuesto a las ventas retenido', 2, 1, 1, '2023-02-21 09:38:45'),
(798, 2368, 'Impuesto de industria y comercio retenido', 2, 1, 1, '2023-02-21 09:38:45'),
(799, 2370, 'Retenciones y aportes de nómina', 2, 1, 1, '2023-02-21 09:38:45'),
(800, 237005, 'Aportes a entidades promotoras de salud, EPS', 2, 1, 1, '2023-02-21 09:38:45'),
(801, 237006, 'Aportes a administradoras de riesgos profesionales, ARP', 2, 1, 1, '2023-02-21 09:38:45'),
(802, 237010, 'Aportes al ICBF, SENA y cajas de compensación', 2, 1, 1, '2023-02-21 09:38:45'),
(803, 237015, 'Aportes al FIC', 2, 1, 1, '2023-02-21 09:38:45'),
(804, 237025, 'Embargos judiciales', 2, 1, 1, '2023-02-21 09:38:45'),
(805, 237030, 'Libranzas', 2, 1, 1, '2023-02-21 09:38:45'),
(806, 237035, 'Sindicatos', 2, 1, 1, '2023-02-21 09:38:45'),
(807, 237040, 'Cooperativas', 2, 1, 1, '2023-02-21 09:38:45'),
(808, 237045, 'Fondos', 2, 1, 1, '2023-02-21 09:38:45'),
(809, 237095, 'Otros', 2, 1, 1, '2023-02-21 09:38:45'),
(810, 2375, 'Cuotas por devolver', 2, 1, 1, '2023-02-21 09:38:45'),
(811, 2380, 'Acreedores varios', 2, 1, 1, '2023-02-21 09:38:45'),
(812, 238005, 'Depositarios', 2, 1, 1, '2023-02-21 09:38:45'),
(813, 238010, 'Comisionistas de bolsas', 2, 1, 1, '2023-02-21 09:38:46'),
(814, 238015, 'Sociedad administradora-Fondos de inversión', 2, 1, 1, '2023-02-21 09:38:46'),
(815, 238020, 'Reintegros por pagar', 2, 1, 1, '2023-02-21 09:38:46'),
(816, 238025, 'Fondo de perseverancia', 2, 1, 1, '2023-02-21 09:38:46'),
(817, 238030, 'Fondos de cesantías y/o pensiones', 2, 1, 1, '2023-02-21 09:38:46'),
(818, 238035, 'Donaciones asignadas por pagar', 2, 1, 1, '2023-02-21 09:38:46'),
(819, 238095, 'Otros', 2, 1, 1, '2023-02-21 09:38:46'),
(820, 24, 'Impuestos, gravámenes y tasas', 2, 1, 1, '2023-02-21 09:38:46'),
(821, 2404, 'De renta y complementarios', 2, 1, 1, '2023-02-21 09:38:46'),
(822, 240405, 'Vigencia fiscal corriente', 2, 1, 1, '2023-02-21 09:38:46'),
(823, 240410, 'Vigencias fiscales anteriores', 2, 1, 1, '2023-02-21 09:38:46'),
(824, 2408, 'Impuesto sobre las ventas por pagar', 2, 1, 1, '2023-02-21 09:38:46'),
(825, 2412, 'De industria y comercio', 2, 1, 1, '2023-02-21 09:38:46'),
(826, 241205, 'Vigencia fiscal corriente', 2, 1, 1, '2023-02-21 09:38:46'),
(827, 241210, 'Vigencias fiscales anteriores', 2, 1, 1, '2023-02-21 09:38:46'),
(828, 2416, 'A la propiedad raíz', 2, 1, 1, '2023-02-21 09:38:46'),
(829, 2420, 'Derechos sobre instrumentos públicos', 2, 1, 1, '2023-02-21 09:38:46'),
(830, 2424, 'De valorización', 2, 1, 1, '2023-02-21 09:38:46'),
(831, 242405, 'Vigencia fiscal corriente', 2, 1, 1, '2023-02-21 09:38:46'),
(832, 242410, 'Vigencias fiscales anteriores', 2, 1, 1, '2023-02-21 09:38:46'),
(833, 2428, 'De turismo', 2, 1, 1, '2023-02-21 09:38:46'),
(834, 2432, 'Tasa por utilización de puertos', 2, 1, 1, '2023-02-21 09:38:46'),
(835, 2436, 'De vehículos', 2, 1, 1, '2023-02-21 09:38:46'),
(836, 243605, 'Vigencia fiscal corriente', 2, 1, 1, '2023-02-21 09:38:47'),
(837, 243610, 'Vigencias fiscales anteriores', 2, 1, 1, '2023-02-21 09:38:47'),
(838, 2440, 'De espectáculos públicos', 2, 1, 1, '2023-02-21 09:38:47'),
(839, 2444, 'De hidrocarburos y minas', 2, 1, 1, '2023-02-21 09:38:47'),
(840, 244405, 'De hidrocarburos', 2, 1, 1, '2023-02-21 09:38:47'),
(841, 244410, 'De minas', 2, 1, 1, '2023-02-21 09:38:47'),
(842, 2448, 'Regalías e impuestos a la pequeña y mediana minería', 2, 1, 1, '2023-02-21 09:38:47'),
(843, 2452, 'A las exportaciones cafeteras', 2, 1, 1, '2023-02-21 09:38:47'),
(844, 2456, 'A las importaciones', 2, 1, 1, '2023-02-21 09:38:48'),
(845, 2460, 'Cuotas de fomento', 2, 1, 1, '2023-02-21 09:38:48'),
(846, 2464, 'De licores, cervezas y cigarrillos', 2, 1, 1, '2023-02-21 09:38:48'),
(847, 246405, 'De licores', 2, 1, 1, '2023-02-21 09:38:48'),
(848, 246410, 'De cervezas', 2, 1, 1, '2023-02-21 09:38:48'),
(849, 246415, 'De cigarrillos', 2, 1, 1, '2023-02-21 09:38:48'),
(850, 2468, 'Al sacrificio de ganado', 2, 1, 1, '2023-02-21 09:38:48'),
(851, 2472, 'Al azar y juegos', 2, 1, 1, '2023-02-21 09:38:48'),
(852, 2476, 'Gravámenes y regalías por utilización del suelo', 2, 1, 1, '2023-02-21 09:38:48'),
(853, 2495, 'Otros', 2, 1, 1, '2023-02-21 09:38:48'),
(854, 25, 'Obligaciones laborales', 2, 1, 1, '2023-02-21 09:38:48'),
(855, 2505, 'Salarios por pagar', 2, 1, 1, '2023-02-21 09:38:48'),
(856, 2510, 'Cesantías consolidadas', 2, 1, 1, '2023-02-21 09:38:48'),
(857, 251005, 'Ley laboral anterior', 2, 1, 1, '2023-02-21 09:38:48'),
(858, 251010, 'Ley 50 de 1990 y normas posteriores', 2, 1, 1, '2023-02-21 09:38:48'),
(859, 2515, 'Intereses sobre cesantías', 2, 1, 1, '2023-02-21 09:38:48'),
(860, 2520, 'Prima de servicios', 2, 1, 1, '2023-02-21 09:38:48'),
(861, 2525, 'Vacaciones consolidadas', 2, 1, 1, '2023-02-21 09:38:48'),
(862, 2530, 'Prestaciones extralegales', 2, 1, 1, '2023-02-21 09:38:48'),
(863, 253005, 'Primas', 2, 1, 1, '2023-02-21 09:38:48'),
(864, 253010, 'Auxilios', 2, 1, 1, '2023-02-21 09:38:48'),
(865, 253015, 'Dotación y suministro a trabajadores', 2, 1, 1, '2023-02-21 09:38:48'),
(866, 253020, 'Bonificaciones', 2, 1, 1, '2023-02-21 09:38:48'),
(867, 253025, 'Seguros', 2, 1, 1, '2023-02-21 09:38:48'),
(868, 253095, 'Otras', 2, 1, 1, '2023-02-21 09:38:48'),
(869, 2532, 'Pensiones por pagar', 2, 1, 1, '2023-02-21 09:38:48'),
(870, 2535, 'Cuotas partes pensiones de jubilación', 2, 1, 1, '2023-02-21 09:38:49'),
(871, 2540, 'Indemnizaciones laborales', 2, 1, 1, '2023-02-21 09:38:49'),
(872, 26, 'Pasivos estimados y provisiones', 2, 1, 1, '2023-02-21 09:38:49'),
(873, 2605, 'Para costos y gastos', 2, 1, 1, '2023-02-21 09:38:49'),
(874, 260505, 'Intereses', 2, 1, 1, '2023-02-21 09:38:49'),
(875, 260510, 'Comisiones', 2, 1, 1, '2023-02-21 09:38:49'),
(876, 260515, 'Honorarios', 2, 1, 1, '2023-02-21 09:38:49'),
(877, 260520, 'Servicios técnicos', 2, 1, 1, '2023-02-21 09:38:49'),
(878, 260525, 'Transportes, fletes y acarreos', 2, 1, 1, '2023-02-21 09:38:49'),
(879, 260530, 'Gastos de viaje', 2, 1, 1, '2023-02-21 09:38:49'),
(880, 260535, 'Servicios públicos', 2, 1, 1, '2023-02-21 09:38:49'),
(881, 260540, 'Regalías', 2, 1, 1, '2023-02-21 09:38:49'),
(882, 260545, 'Garantías', 2, 1, 1, '2023-02-21 09:38:49'),
(883, 260550, 'Materiales y repuestos', 2, 1, 1, '2023-02-21 09:38:49'),
(884, 260595, 'Otros', 2, 1, 1, '2023-02-21 09:38:49'),
(885, 2610, 'Para obligaciones laborales', 2, 1, 1, '2023-02-21 09:38:49'),
(886, 261005, 'Cesantías', 2, 1, 1, '2023-02-21 09:38:49'),
(887, 261010, 'Intereses sobre cesantías', 2, 1, 1, '2023-02-21 09:38:49'),
(888, 261015, 'Vacaciones', 2, 1, 1, '2023-02-21 09:38:49'),
(889, 261020, 'Prima de servicios', 2, 1, 1, '2023-02-21 09:38:49'),
(890, 261025, 'Prestaciones extralegales', 2, 1, 1, '2023-02-21 09:38:49'),
(891, 261030, 'Viáticos', 2, 1, 1, '2023-02-21 09:38:49'),
(892, 261095, 'Otras', 2, 1, 1, '2023-02-21 09:38:49'),
(893, 2615, 'Para obligaciones fiscales', 2, 1, 1, '2023-02-21 09:38:49'),
(894, 261505, 'De renta y complementarios', 2, 1, 1, '2023-02-21 09:38:49'),
(895, 261510, 'De industria y comercio', 2, 1, 1, '2023-02-21 09:38:50'),
(896, 261515, 'Tasa por utilización de puertos', 2, 1, 1, '2023-02-21 09:38:50'),
(897, 261520, 'De vehículos', 2, 1, 1, '2023-02-21 09:38:50'),
(898, 261525, 'De hidrocarburos y minas', 2, 1, 1, '2023-02-21 09:38:50'),
(899, 261595, 'Otros', 2, 1, 1, '2023-02-21 09:38:50'),
(900, 2620, 'Pensiones de jubilación', 2, 1, 1, '2023-02-21 09:38:50'),
(901, 262005, 'Cálculo actuarial pensiones de jubilación', 2, 1, 1, '2023-02-21 09:38:50'),
(902, 262010, 'Pensiones de jubilación por amortizar (DB)', 2, 1, 1, '2023-02-21 09:38:50'),
(903, 2625, 'Para obras de urbanismo', 2, 1, 1, '2023-02-21 09:38:50'),
(904, 262505, 'Acueducto y alcantarillado', 2, 1, 1, '2023-02-21 09:38:50'),
(905, 262510, 'Energía eléctrica', 2, 1, 1, '2023-02-21 09:38:50'),
(906, 262515, 'Teléfonos', 2, 1, 1, '2023-02-21 09:38:50'),
(907, 262595, 'Otros', 2, 1, 1, '2023-02-21 09:38:50'),
(908, 2630, 'Para mantenimiento y reparaciones', 2, 1, 1, '2023-02-21 09:38:50'),
(909, 263005, 'Terrenos', 2, 1, 1, '2023-02-21 09:38:50'),
(910, 263010, 'Construcciones y edificaciones', 2, 1, 1, '2023-02-21 09:38:50'),
(911, 263015, 'Maquinaria y equipo', 2, 1, 1, '2023-02-21 09:38:50'),
(912, 263020, 'Equipo de oficina', 2, 1, 1, '2023-02-21 09:38:50'),
(913, 263025, 'Equipo de computación y comunicación', 2, 1, 1, '2023-02-21 09:38:50'),
(914, 263030, 'Equipo médico-científico', 2, 1, 1, '2023-02-21 09:38:50'),
(915, 263035, 'Equipo de hoteles y restaurantes', 2, 1, 1, '2023-02-21 09:38:50'),
(916, 263040, 'Flota y equipo de transporte', 2, 1, 1, '2023-02-21 09:38:50'),
(917, 263045, 'Flota y equipo fluvial y/o marítimo', 2, 1, 1, '2023-02-21 09:38:50'),
(918, 263050, 'Flota y equipo aéreo', 2, 1, 1, '2023-02-21 09:38:50'),
(919, 263055, 'Flota y equipo férreo', 2, 1, 1, '2023-02-21 09:38:50'),
(920, 263060, 'Acueductos, plantas y redes', 2, 1, 1, '2023-02-21 09:38:50'),
(921, 263065, 'Armamento de vigilancia', 2, 1, 1, '2023-02-21 09:38:51'),
(922, 263070, 'Envases y empaques', 2, 1, 1, '2023-02-21 09:38:51'),
(923, 263075, 'Plantaciones agrícolas y forestales', 2, 1, 1, '2023-02-21 09:38:51'),
(924, 263080, 'Vías de comunicación', 2, 1, 1, '2023-02-21 09:38:51'),
(925, 263085, 'Pozos artesianos', 2, 1, 1, '2023-02-21 09:38:51'),
(926, 263095, 'Otros', 2, 1, 1, '2023-02-21 09:38:51'),
(927, 2635, 'Para contingencias', 2, 1, 1, '2023-02-21 09:38:51'),
(928, 263505, 'Multas y sanciones autoridades administrativas', 2, 1, 1, '2023-02-21 09:38:51'),
(929, 263510, 'Intereses por multas y sanciones', 2, 1, 1, '2023-02-21 09:38:51'),
(930, 263515, 'Reclamos', 2, 1, 1, '2023-02-21 09:38:51'),
(931, 263520, 'Laborales', 2, 1, 1, '2023-02-21 09:38:51'),
(932, 263525, 'Civiles', 2, 1, 1, '2023-02-21 09:38:51'),
(933, 263530, 'Penales', 2, 1, 1, '2023-02-21 09:38:51'),
(934, 263535, 'Administrativos', 2, 1, 1, '2023-02-21 09:38:51'),
(935, 263540, 'Comerciales', 2, 1, 1, '2023-02-21 09:38:51'),
(936, 263595, 'Otras', 2, 1, 1, '2023-02-21 09:38:52'),
(937, 2640, 'Para obligaciones de garantías', 2, 1, 1, '2023-02-21 09:38:52'),
(938, 2695, 'Provisiones diversas', 2, 1, 1, '2023-02-21 09:38:52'),
(939, 269505, 'Para beneficencia', 2, 1, 1, '2023-02-21 09:38:52'),
(940, 269510, 'Para comunicaciones', 2, 1, 1, '2023-02-21 09:38:52'),
(941, 269515, 'Para pérdida en transporte', 2, 1, 1, '2023-02-21 09:38:52'),
(942, 269520, 'Para operación', 2, 1, 1, '2023-02-21 09:38:52'),
(943, 269525, 'Para protección de bienes agotables', 2, 1, 1, '2023-02-21 09:38:52'),
(944, 269530, 'Para ajustes en redención de unidades', 2, 1, 1, '2023-02-21 09:38:52'),
(945, 269535, 'Autoseguro', 2, 1, 1, '2023-02-21 09:38:52'),
(946, 269540, 'Planes y programas de reforestación y electrificación', 2, 1, 1, '2023-02-21 09:38:52'),
(947, 269595, 'Otras', 2, 1, 1, '2023-02-21 09:38:52'),
(948, 27, 'Diferidos', 2, 1, 1, '2023-02-21 09:38:53'),
(949, 2705, 'Ingresos recibidos por anticipado', 2, 1, 1, '2023-02-21 09:38:53'),
(950, 270505, 'Intereses', 2, 1, 1, '2023-02-21 09:38:53'),
(951, 270510, 'Comisiones', 2, 1, 1, '2023-02-21 09:38:53'),
(952, 270515, 'Arrendamientos', 2, 1, 1, '2023-02-21 09:38:53'),
(953, 270520, 'Honorarios', 2, 1, 1, '2023-02-21 09:38:53'),
(954, 270525, 'Servicios técnicos', 2, 1, 1, '2023-02-21 09:38:53'),
(955, 270530, 'De suscriptores', 2, 1, 1, '2023-02-21 09:38:53'),
(956, 270535, 'Transportes, fletes y acarreos', 2, 1, 1, '2023-02-21 09:38:53'),
(957, 270540, 'Mercancía en tránsito ya vendida', 2, 1, 1, '2023-02-21 09:38:53'),
(958, 270545, 'Matrículas y pensiones', 2, 1, 1, '2023-02-21 09:38:53'),
(959, 270550, 'Cuotas de administración', 2, 1, 1, '2023-02-21 09:38:53'),
(960, 270595, 'Otros', 2, 1, 1, '2023-02-21 09:38:53'),
(961, 2710, 'Abonos diferidos', 2, 1, 1, '2023-02-21 09:38:53'),
(962, 271005, 'Reajuste del sistema', 2, 1, 1, '2023-02-21 09:38:53'),
(963, 2715, 'Utilidad diferida en ventas a plazos', 2, 1, 1, '2023-02-21 09:38:53'),
(964, 2720, 'Crédito por corrección monetaria diferida', 2, 1, 1, '2023-02-21 09:38:53'),
(965, 2725, 'Impuestos diferidos', 2, 1, 1, '2023-02-21 09:38:53'),
(966, 272505, 'Por depreciación flexible', 2, 1, 1, '2023-02-21 09:38:53'),
(967, 272595, 'Diversos', 2, 1, 1, '2023-02-21 09:38:53'),
(968, 272599, 'Ajustes por inflación', 2, 1, 1, '2023-02-21 09:38:53'),
(969, 28, 'Otros pasivos', 2, 1, 1, '2023-02-21 09:38:53'),
(970, 2805, 'Anticipos y avances recibidos', 2, 1, 1, '2023-02-21 09:38:53'),
(971, 280505, 'De clientes', 2, 1, 1, '2023-02-21 09:38:53'),
(972, 280510, 'Sobre contratos', 2, 1, 1, '2023-02-21 09:38:53'),
(973, 280515, 'Para obras en proceso', 2, 1, 1, '2023-02-21 09:38:53'),
(974, 280595, 'Otros', 2, 1, 1, '2023-02-21 09:38:53'),
(975, 2810, 'Depósitos recibidos', 2, 1, 1, '2023-02-21 09:38:54'),
(976, 281005, 'Para futura suscripción de acciones', 2, 1, 1, '2023-02-21 09:38:54'),
(977, 281010, 'Para futuro pago de cuotas o derechos sociales', 2, 1, 1, '2023-02-21 09:38:54'),
(978, 281015, 'Para garantía en la prestación de servicios', 2, 1, 1, '2023-02-21 09:38:54'),
(979, 281020, 'Para garantía de contratos', 2, 1, 1, '2023-02-21 09:38:54'),
(980, 281025, 'De licitaciones', 2, 1, 1, '2023-02-21 09:38:54'),
(981, 281030, 'De manejo de bienes', 2, 1, 1, '2023-02-21 09:38:54'),
(982, 281035, 'Fondo de reserva', 2, 1, 1, '2023-02-21 09:38:54'),
(983, 281095, 'Otros', 2, 1, 1, '2023-02-21 09:38:54'),
(984, 2815, 'Ingresos recibidos para terceros', 2, 1, 1, '2023-02-21 09:38:54'),
(985, 281505, 'Valores recibidos para terceros', 2, 1, 1, '2023-02-21 09:38:54'),
(986, 281510, 'Venta por cuenta de terceros', 2, 1, 1, '2023-02-21 09:38:54'),
(987, 2820, 'Cuentas de operación conjunta', 2, 1, 1, '2023-02-21 09:38:54'),
(988, 2825, 'Retenciones a terceros sobre contratos', 2, 1, 1, '2023-02-21 09:38:54'),
(989, 282505, 'Cumplimiento obligaciones laborales', 2, 1, 1, '2023-02-21 09:38:54'),
(990, 282510, 'Para estabilidad de obra', 2, 1, 1, '2023-02-21 09:38:54'),
(991, 282515, 'Garantía cumplimiento de contratos', 2, 1, 1, '2023-02-21 09:38:54'),
(992, 2830, 'Embargos judiciales', 2, 1, 1, '2023-02-21 09:38:54'),
(993, 283005, 'Indemnizaciones', 2, 1, 1, '2023-02-21 09:38:54'),
(994, 283010, 'Depósitos judiciales', 2, 1, 1, '2023-02-21 09:38:54'),
(995, 2835, 'Acreedores del sistema', 2, 1, 1, '2023-02-21 09:38:54'),
(996, 283505, 'Cuotas netas', 2, 1, 1, '2023-02-21 09:38:54'),
(997, 283510, 'Grupos en formación', 2, 1, 1, '2023-02-21 09:38:54'),
(998, 2840, 'Cuentas en participación', 2, 1, 1, '2023-02-21 09:38:54'),
(999, 2895, 'Diversos', 2, 1, 1, '2023-02-21 09:38:54'),
(1000, 289505, 'Préstamos de productos', 2, 1, 1, '2023-02-21 09:38:54'),
(1001, 289510, 'Reembolso de costos exploratorios', 2, 1, 1, '2023-02-21 09:38:54'),
(1002, 289515, 'Programa de extensión agropecuaria', 2, 1, 1, '2023-02-21 09:38:55'),
(1003, 29, 'Bonos y papeles comerciales', 2, 1, 1, '2023-02-21 09:38:55'),
(1004, 2905, 'Bonos en circulación', 2, 1, 1, '2023-02-21 09:38:55'),
(1005, 2910, 'Bonos obligatoriamente convertibles en acciones', 2, 1, 1, '2023-02-21 09:38:55'),
(1006, 2915, 'Papeles comerciales', 2, 1, 1, '2023-02-21 09:38:55'),
(1007, 2920, 'Bonos pensionales', 2, 1, 1, '2023-02-21 09:38:55'),
(1008, 292005, 'Valor bonos pensionales', 2, 1, 1, '2023-02-21 09:38:55'),
(1009, 292010, 'Bonos pensionales por amortizar (DB)', 2, 1, 1, '2023-02-21 09:38:55'),
(1010, 292015, 'Intereses causados sobre bonos pensionales', 2, 1, 1, '2023-02-21 09:38:55'),
(1011, 2925, 'Títulos pensionales', 2, 1, 1, '2023-02-21 09:38:55'),
(1012, 292505, 'Valor títulos pensionales', 2, 1, 1, '2023-02-21 09:38:55'),
(1013, 292510, 'Títulos pensionales por amortizar (DB)', 2, 1, 1, '2023-02-21 09:38:55'),
(1014, 292515, 'Intereses causados sobre títulos pensionales', 2, 1, 1, '2023-02-21 09:38:55'),
(1016, 31, 'Capital social', 3, 1, 1, '2023-02-21 09:39:51'),
(1017, 3105, 'Capital suscrito y pagado', 3, 1, 1, '2023-02-21 09:39:51'),
(1018, 310505, 'Capital autorizado', 3, 1, 1, '2023-02-21 09:39:51'),
(1019, 310510, 'Capital por suscribir (DB)', 3, 1, 1, '2023-02-21 09:39:51'),
(1020, 310515, 'Capital suscrito por cobrar (DB)', 3, 1, 1, '2023-02-21 09:39:51'),
(1021, 3115, 'Aportes sociales', 3, 1, 1, '2023-02-21 09:39:51'),
(1022, 311505, 'Cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:51'),
(1023, 311510, 'Aportes de socios-fondo mutuo de inversión', 3, 1, 1, '2023-02-21 09:39:51'),
(1024, 311515, 'Contribución de la empresa-fondo mutuo de inversión', 3, 1, 1, '2023-02-21 09:39:51'),
(1025, 311520, 'Suscripciones del público', 3, 1, 1, '2023-02-21 09:39:51'),
(1026, 3120, 'Capital asignado', 3, 1, 1, '2023-02-21 09:39:51'),
(1027, 3125, 'Inversión suplementaria al capital asignado', 3, 1, 1, '2023-02-21 09:39:51'),
(1028, 3130, 'Capital de personas naturales', 3, 1, 1, '2023-02-21 09:39:51'),
(1029, 3135, 'Aportes del Estado', 3, 1, 1, '2023-02-21 09:39:51'),
(1030, 3140, 'Fondo social', 3, 1, 1, '2023-02-21 09:39:52'),
(1031, 32, 'Superávit de capital', 3, 1, 1, '2023-02-21 09:39:52'),
(1032, 3205, 'Prima en colocación de acciones, cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:52'),
(1033, 320505, 'Prima en colocación de acciones', 3, 1, 1, '2023-02-21 09:39:52'),
(1034, 320510, 'Prima en colocación de acciones por cobrar (DB)', 3, 1, 1, '2023-02-21 09:39:52'),
(1035, 320515, 'Prima en colocación de cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:52'),
(1036, 3210, 'Donaciones', 3, 1, 1, '2023-02-21 09:39:52'),
(1037, 321005, 'En dinero', 3, 1, 1, '2023-02-21 09:39:52'),
(1038, 321010, 'En valores mobiliarios', 3, 1, 1, '2023-02-21 09:39:52'),
(1039, 321015, 'En bienes muebles', 3, 1, 1, '2023-02-21 09:39:52'),
(1040, 321020, 'En bienes inmuebles', 3, 1, 1, '2023-02-21 09:39:52'),
(1041, 321025, 'En intangibles', 3, 1, 1, '2023-02-21 09:39:52'),
(1042, 3215, 'Crédito mercantil', 3, 1, 1, '2023-02-21 09:39:52'),
(1043, 3220, 'Know how', 3, 1, 1, '2023-02-21 09:39:52'),
(1044, 3225, 'Superávit método de participación', 3, 1, 1, '2023-02-21 09:39:52'),
(1045, 322505, 'De acciones', 3, 1, 1, '2023-02-21 09:39:52'),
(1046, 322510, 'De cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:52'),
(1047, 33, 'Reservas', 3, 1, 1, '2023-02-21 09:39:52'),
(1048, 3305, 'Reservas obligatorias', 3, 1, 1, '2023-02-21 09:39:52'),
(1049, 330505, 'Reserva legal', 3, 1, 1, '2023-02-21 09:39:52'),
(1050, 330510, 'Reservas por disposiciones fiscales', 3, 1, 1, '2023-02-21 09:39:52'),
(1051, 330515, 'Reserva para readquisición de acciones', 3, 1, 1, '2023-02-21 09:39:52'),
(1052, 330516, 'Acciones propias readquiridas (DB)', 3, 1, 1, '2023-02-21 09:39:53'),
(1053, 330517, 'Reserva para readquisición de cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:53'),
(1054, 330518, 'Cuotas o partes de interés social propias readquiridas (DB)', 3, 1, 1, '2023-02-21 09:39:53'),
(1055, 330520, 'Reserva para extensión agropecuaria', 3, 1, 1, '2023-02-21 09:39:53'),
(1056, 330525, 'Reserva Ley 7ª de 1990', 3, 1, 1, '2023-02-21 09:39:53'),
(1057, 330530, 'Reserva para reposición de semovientes', 3, 1, 1, '2023-02-21 09:39:53'),
(1058, 330535, 'Reserva Ley 4ª de 1980', 3, 1, 1, '2023-02-21 09:39:53'),
(1059, 330595, 'Otras', 3, 1, 1, '2023-02-21 09:39:53'),
(1060, 3310, 'Reservas estatutarias', 3, 1, 1, '2023-02-21 09:39:53'),
(1061, 331005, 'Para futuras capitalizaciones', 3, 1, 1, '2023-02-21 09:39:53'),
(1062, 331010, 'Para reposición de activos', 3, 1, 1, '2023-02-21 09:39:53'),
(1063, 331015, 'Para futuros ensanches', 3, 1, 1, '2023-02-21 09:39:53'),
(1064, 331095, 'Otras', 3, 1, 1, '2023-02-21 09:39:53'),
(1065, 3315, 'Reservas ocasionales', 3, 1, 1, '2023-02-21 09:39:53'),
(1066, 331505, 'Para beneficencia y civismo', 3, 1, 1, '2023-02-21 09:39:53'),
(1067, 331510, 'Para futuras capitalizaciones', 3, 1, 1, '2023-02-21 09:39:53'),
(1068, 331515, 'Para futuros ensanches', 3, 1, 1, '2023-02-21 09:39:53'),
(1069, 331520, 'Para adquisición o reposición de propiedades, planta y equipo', 3, 1, 1, '2023-02-21 09:39:53'),
(1070, 331525, 'Para investigaciones y desarrollo', 3, 1, 1, '2023-02-21 09:39:53'),
(1071, 331530, 'Para fomento económico', 3, 1, 1, '2023-02-21 09:39:53'),
(1072, 331535, 'Para capital de trabajo', 3, 1, 1, '2023-02-21 09:39:53'),
(1073, 331540, 'Para estabilización de rendimientos', 3, 1, 1, '2023-02-21 09:39:53'),
(1074, 331545, 'A disposición del máximo órgano social', 3, 1, 1, '2023-02-21 09:39:53'),
(1075, 331595, 'Otras', 3, 1, 1, '2023-02-21 09:39:53'),
(1076, 34, 'Revalorización del patrimonio', 3, 1, 1, '2023-02-21 09:39:54'),
(1077, 3405, 'Ajustes por inflación', 3, 1, 1, '2023-02-21 09:39:54'),
(1078, 340505, 'De capital social', 3, 1, 1, '2023-02-21 09:39:54'),
(1079, 340510, 'De superávit de capital', 3, 1, 1, '2023-02-21 09:39:54'),
(1080, 340515, 'De reservas', 3, 1, 1, '2023-02-21 09:39:54'),
(1081, 340520, 'De resultados de ejercicios anteriores', 3, 1, 1, '2023-02-21 09:39:54'),
(1082, 340525, 'De activos en período improductivo', 3, 1, 1, '2023-02-21 09:39:54'),
(1083, 340530, 'De saneamiento fiscal', 3, 1, 1, '2023-02-21 09:39:54'),
(1084, 340535, 'De ajustes Decreto 3019 de 1989', 3, 1, 1, '2023-02-21 09:39:54'),
(1085, 340540, 'De dividendos y participaciones decretadas en acciones, cuotas o partes de\r\n            interés social', 3, 1, 1, '2023-02-21 09:39:54'),
(1086, 340545, 'Superávit método de participación', 3, 1, 1, '2023-02-21 09:39:54'),
(1087, 3410, 'Saneamiento fiscal', 3, 1, 1, '2023-02-21 09:39:54'),
(1088, 3415, 'Ajustes por inflación Decreto 3019 de 1989', 3, 1, 1, '2023-02-21 09:39:54'),
(1089, 35, 'Dividendos o participaciones decretados en acciones, cuotas o partes de interés\r\n            social', 3, 1, 1, '2023-02-21 09:39:54'),
(1090, 3505, 'Dividendos decretados en acciones', 3, 1, 1, '2023-02-21 09:39:54'),
(1091, 3510, 'Participaciones decretadas en cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:54'),
(1092, 36, 'Resultados del ejercicio', 3, 1, 1, '2023-02-21 09:39:54'),
(1093, 3605, 'Utilidad del ejercicio', 3, 1, 1, '2023-02-21 09:39:54'),
(1094, 3610, 'Pérdida del ejercicio', 3, 1, 1, '2023-02-21 09:39:54'),
(1095, 37, 'Resultados de ejercicios anteriores', 3, 1, 1, '2023-02-21 09:39:54'),
(1096, 3705, 'Utilidades acumuladas', 3, 1, 1, '2023-02-21 09:39:55'),
(1097, 3710, 'Pérdidas acumuladas', 3, 1, 1, '2023-02-21 09:39:55'),
(1098, 38, 'Superávit por valorizaciones', 3, 1, 1, '2023-02-21 09:39:55'),
(1099, 3805, 'De inversiones', 3, 1, 1, '2023-02-21 09:39:55'),
(1100, 380505, 'Acciones', 3, 1, 1, '2023-02-21 09:39:55'),
(1101, 380510, 'Cuotas o partes de interés social', 3, 1, 1, '2023-02-21 09:39:55'),
(1102, 380515, 'Derechos fiduciarios', 3, 1, 1, '2023-02-21 09:39:55'),
(1103, 3810, 'De propiedades, planta y equipo', 3, 1, 1, '2023-02-21 09:39:55'),
(1104, 381004, 'Terrenos', 3, 1, 1, '2023-02-21 09:39:55'),
(1105, 381006, 'Materiales proyectos petroleros', 3, 1, 1, '2023-02-21 09:39:55'),
(1106, 381008, 'Construcciones y edificaciones', 3, 1, 1, '2023-02-21 09:39:55'),
(1107, 381012, 'Maquinaria y equipo', 3, 1, 1, '2023-02-21 09:39:55'),
(1108, 381016, 'Equipo de oficina', 3, 1, 1, '2023-02-21 09:39:55'),
(1109, 381020, 'Equipo de computación y comunicación', 3, 1, 1, '2023-02-21 09:39:55'),
(1110, 381024, 'Equipo médico-científico', 3, 1, 1, '2023-02-21 09:39:55'),
(1111, 381028, 'Equipo de hoteles y restaurantes', 3, 1, 1, '2023-02-21 09:39:55'),
(1112, 381032, 'Flota y equipo de transporte', 3, 1, 1, '2023-02-21 09:39:55'),
(1113, 381036, 'Flota y equipo fluvial y/o marítimo', 3, 1, 1, '2023-02-21 09:39:55'),
(1114, 381040, 'Flota y equipo aéreo', 3, 1, 1, '2023-02-21 09:39:55'),
(1115, 381044, 'Flota y equipo férreo', 3, 1, 1, '2023-02-21 09:39:55'),
(1116, 381048, 'Acueductos, plantas y redes', 3, 1, 1, '2023-02-21 09:39:55'),
(1117, 381052, 'Armamento de vigilancia', 3, 1, 1, '2023-02-21 09:39:55'),
(1118, 381056, 'Envases y empaques', 3, 1, 1, '2023-02-21 09:39:55'),
(1119, 381060, 'Plantaciones agrícolas y forestales', 3, 1, 1, '2023-02-21 09:39:55'),
(1120, 381064, 'Vías de comunicación', 3, 1, 1, '2023-02-21 09:39:55'),
(1121, 381068, 'Minas y canteras', 3, 1, 1, '2023-02-21 09:39:55'),
(1122, 381072, 'Pozos artesianos', 3, 1, 1, '2023-02-21 09:39:55'),
(1123, 381076, 'Yacimientos', 3, 1, 1, '2023-02-21 09:39:55'),
(1124, 381080, 'Semovientes', 3, 1, 1, '2023-02-21 09:39:56'),
(1125, 3895, 'De otros activos', 3, 1, 1, '2023-02-21 09:39:56'),
(1126, 389505, 'Bienes de arte y cultura', 3, 1, 1, '2023-02-21 09:39:56'),
(1127, 389510, 'Bienes entregados en comodato', 3, 1, 1, '2023-02-21 09:39:56'),
(1128, 389515, 'Bienes recibidos en pago', 3, 1, 1, '2023-02-21 09:39:56'),
(1129, 389520, 'Inventario de semovientes', 3, 1, 1, '2023-02-21 09:39:56'),
(1131, 41, 'Operacionales', 4, 1, 1, '2023-02-21 09:41:04'),
(1132, 4105, 'Agricultura, ganadería, caza y silvicultura', 4, 1, 1, '2023-02-21 09:41:04'),
(1133, 410505, 'Cultivo de cereales', 4, 1, 1, '2023-02-21 09:41:04'),
(1134, 410510, 'Cultivos de hortalizas, legumbres y plantas ornamentales', 4, 1, 1, '2023-02-21 09:41:04'),
(1135, 410515, 'Cultivos de frutas, nueces y plantas aromáticas', 4, 1, 1, '2023-02-21 09:41:04'),
(1136, 410520, 'Cultivo de café', 4, 1, 1, '2023-02-21 09:41:04'),
(1137, 410525, 'Cultivo de flores', 4, 1, 1, '2023-02-21 09:41:04'),
(1138, 410530, 'Cultivo de caña de azúcar', 4, 1, 1, '2023-02-21 09:41:04'),
(1139, 410535, 'Cultivo de algodón y plantas para material textil', 4, 1, 1, '2023-02-21 09:41:04'),
(1140, 410540, 'Cultivo de banano', 4, 1, 1, '2023-02-21 09:41:04'),
(1141, 410545, 'Otros cultivos agrícolas', 4, 1, 1, '2023-02-21 09:41:04'),
(1142, 410550, 'Cría de ovejas, cabras, asnos, mulas y burdéganos', 4, 1, 1, '2023-02-21 09:41:04'),
(1143, 410555, 'Cría de ganado caballar y vacuno', 4, 1, 1, '2023-02-21 09:41:04'),
(1144, 410560, 'Producción avícola', 4, 1, 1, '2023-02-21 09:41:04'),
(1145, 410565, 'Cría de otros animales', 4, 1, 1, '2023-02-21 09:41:04'),
(1146, 410570, 'Servicios agrícolas y ganaderos', 4, 1, 1, '2023-02-21 09:41:04'),
(1147, 410575, 'Actividad de caza', 4, 1, 1, '2023-02-21 09:41:04'),
(1148, 410580, 'Actividad de silvicultura', 4, 1, 1, '2023-02-21 09:41:04'),
(1149, 410595, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:04'),
(1150, 410599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:05'),
(1151, 4110, 'Pesca', 4, 1, 1, '2023-02-21 09:41:05'),
(1152, 411005, 'Actividad de pesca', 4, 1, 1, '2023-02-21 09:41:05'),
(1153, 411010, 'Explotación de criaderos de peces', 4, 1, 1, '2023-02-21 09:41:05'),
(1154, 411095, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:05'),
(1155, 411099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:05'),
(1156, 4115, 'Explotación de minas y canteras', 4, 1, 1, '2023-02-21 09:41:05'),
(1157, 411505, 'Carbón', 4, 1, 1, '2023-02-21 09:41:05'),
(1158, 411510, 'Petróleo crudo', 4, 1, 1, '2023-02-21 09:41:05'),
(1159, 411512, 'Gas natural', 4, 1, 1, '2023-02-21 09:41:05'),
(1160, 411514, 'Servicios relacionados con extracción de petróleo y gas', 4, 1, 1, '2023-02-21 09:41:05'),
(1161, 411515, 'Minerales de hierro', 4, 1, 1, '2023-02-21 09:41:05'),
(1162, 411520, 'Minerales metalíferos no ferrosos', 4, 1, 1, '2023-02-21 09:41:05'),
(1163, 411525, 'Piedra, arena y arcilla', 4, 1, 1, '2023-02-21 09:41:05'),
(1164, 411527, 'Piedras preciosas', 4, 1, 1, '2023-02-21 09:41:05'),
(1165, 411528, 'Oro', 4, 1, 1, '2023-02-21 09:41:05'),
(1166, 411530, 'Otras minas y canteras', 4, 1, 1, '2023-02-21 09:41:05'),
(1167, 411532, 'Prestación de servicios sector minero', 4, 1, 1, '2023-02-21 09:41:05'),
(1168, 411595, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:05'),
(1169, 411599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:05'),
(1170, 4120, 'Industrias manufactureras', 4, 1, 1, '2023-02-21 09:41:05'),
(1171, 412001, 'Producción y procesamiento de carnes y productos cárnicos', 4, 1, 1, '2023-02-21 09:41:05'),
(1172, 412002, 'Productos de pescado', 4, 1, 1, '2023-02-21 09:41:05'),
(1173, 412003, 'Productos de frutas, legumbres y hortalizas', 4, 1, 1, '2023-02-21 09:41:05'),
(1174, 412004, 'Elaboración de aceites y grasas', 4, 1, 1, '2023-02-21 09:41:05'),
(1175, 412005, 'Elaboración de productos lácteos', 4, 1, 1, '2023-02-21 09:41:05'),
(1176, 412006, 'Elaboración de productos de molinería', 4, 1, 1, '2023-02-21 09:41:05'),
(1177, 412007, 'Elaboración de almidones y derivados', 4, 1, 1, '2023-02-21 09:41:06'),
(1178, 412008, 'Elaboración de alimentos para animales', 4, 1, 1, '2023-02-21 09:41:06'),
(1179, 412009, 'Elaboración de productos para panadería', 4, 1, 1, '2023-02-21 09:41:06'),
(1180, 412010, 'Elaboración de azúcar y melazas', 4, 1, 1, '2023-02-21 09:41:06'),
(1181, 412011, 'Elaboración de cacao, chocolate y confitería', 4, 1, 1, '2023-02-21 09:41:06'),
(1182, 412012, 'Elaboración de pastas y productos farináceos', 4, 1, 1, '2023-02-21 09:41:06'),
(1183, 412013, 'Elaboración de productos de café', 4, 1, 1, '2023-02-21 09:41:06'),
(1184, 412014, 'Elaboración de otros productos alimenticios', 4, 1, 1, '2023-02-21 09:41:06'),
(1185, 412015, 'Elaboración de bebidas alcohólicas y alcohol etílico', 4, 1, 1, '2023-02-21 09:41:06'),
(1186, 412016, 'Elaboración de vinos', 4, 1, 1, '2023-02-21 09:41:06'),
(1187, 412017, 'Elaboración de bebidas malteadas y de malta', 4, 1, 1, '2023-02-21 09:41:06'),
(1188, 412018, 'Elaboración de bebidas no alcohólicas', 4, 1, 1, '2023-02-21 09:41:06'),
(1189, 412019, 'Elaboración de productos de tabaco', 4, 1, 1, '2023-02-21 09:41:06'),
(1190, 412020, 'Preparación e hilatura de fibras textiles y tejeduría', 4, 1, 1, '2023-02-21 09:41:06'),
(1191, 412021, 'Acabado de productos textiles', 4, 1, 1, '2023-02-21 09:41:06'),
(1192, 412022, 'Elaboración de artículos de materiales textiles', 4, 1, 1, '2023-02-21 09:41:06'),
(1193, 412023, 'Elaboración de tapices y alfombras', 4, 1, 1, '2023-02-21 09:41:06'),
(1194, 412024, 'Elaboración de cuerdas, cordeles, bramantes y redes', 4, 1, 1, '2023-02-21 09:41:06'),
(1195, 412025, 'Elaboración de otros productos textiles', 4, 1, 1, '2023-02-21 09:41:06'),
(1196, 412026, 'Elaboración de tejidos', 4, 1, 1, '2023-02-21 09:41:06'),
(1197, 412027, 'Elaboración de prendas de vestir', 4, 1, 1, '2023-02-21 09:41:06'),
(1198, 412028, 'Preparación, adobo y teñido de pieles', 4, 1, 1, '2023-02-21 09:41:06'),
(1199, 412029, 'Curtido, adobo o preparación de cuero', 4, 1, 1, '2023-02-21 09:41:06'),
(1200, 412030, 'Elaboración de maletas, bolsos y similares', 4, 1, 1, '2023-02-21 09:41:06'),
(1201, 412031, 'Elaboración de calzado', 4, 1, 1, '2023-02-21 09:41:07'),
(1202, 412032, 'Producción de madera, artículos de madera y corcho', 4, 1, 1, '2023-02-21 09:41:07'),
(1203, 412033, 'Elaboración de pasta y productos de madera, papel y cartón', 4, 1, 1, '2023-02-21 09:41:07'),
(1204, 412034, 'Ediciones y publicaciones', 4, 1, 1, '2023-02-21 09:41:07'),
(1205, 412035, 'Impresión', 4, 1, 1, '2023-02-21 09:41:07'),
(1206, 412036, 'Servicios relacionados con la edición y la impresión', 4, 1, 1, '2023-02-21 09:41:07'),
(1207, 412037, 'Reproducción de grabaciones', 4, 1, 1, '2023-02-21 09:41:07'),
(1208, 412038, 'Elaboración de productos de horno de coque', 4, 1, 1, '2023-02-21 09:41:07'),
(1209, 412039, 'Elaboración de productos de la refinación de petróleo', 4, 1, 1, '2023-02-21 09:41:07'),
(1210, 412040, 'Elaboración de sustancias químicas básicas', 4, 1, 1, '2023-02-21 09:41:07'),
(1211, 412041, 'Elaboración de abonos y compuestos de nitrógeno', 4, 1, 1, '2023-02-21 09:41:07'),
(1212, 412042, 'Elaboración de plástico y caucho sintético', 4, 1, 1, '2023-02-21 09:41:07'),
(1213, 412043, 'Elaboración de productos químicos de uso agropecuario', 4, 1, 1, '2023-02-21 09:41:07'),
(1214, 412044, 'Elaboración de pinturas, tintas y masillas', 4, 1, 1, '2023-02-21 09:41:07'),
(1215, 412045, 'Elaboración de productos farmacéuticos y botánicos', 4, 1, 1, '2023-02-21 09:41:07'),
(1216, 412046, 'Elaboración de jabones, detergentes y preparados de tocador', 4, 1, 1, '2023-02-21 09:41:07'),
(1217, 412047, 'Elaboración de otros productos químicos', 4, 1, 1, '2023-02-21 09:41:07'),
(1218, 412048, 'Elaboración de fibras', 4, 1, 1, '2023-02-21 09:41:07'),
(1219, 412049, 'Elaboración de otros productos de caucho', 4, 1, 1, '2023-02-21 09:41:07'),
(1220, 412050, 'Elaboración de productos de plástico', 4, 1, 1, '2023-02-21 09:41:07'),
(1221, 412051, 'Elaboración de vidrio y productos de vidrio', 4, 1, 1, '2023-02-21 09:41:07'),
(1222, 412052, 'Elaboración de productos de cerámica, loza, piedra, arcilla y porcelana', 4, 1, 1, '2023-02-21 09:41:07'),
(1223, 412053, 'Elaboración de cemento, cal y yeso', 4, 1, 1, '2023-02-21 09:41:07'),
(1224, 412054, 'Elaboración de artículos de hormigón, cemento y yeso', 4, 1, 1, '2023-02-21 09:41:07'),
(1225, 412055, 'Corte, tallado y acabado de la piedra', 4, 1, 1, '2023-02-21 09:41:08'),
(1226, 412056, 'Elaboración de otros productos minerales no metálicos', 4, 1, 1, '2023-02-21 09:41:08'),
(1227, 412057, 'Industrias básicas y fundición de hierro y acero', 4, 1, 1, '2023-02-21 09:41:08'),
(1228, 412058, 'Productos primarios de metales preciosos y de metales no ferrosos', 4, 1, 1, '2023-02-21 09:41:08'),
(1229, 412059, 'Fundición de metales no ferrosos', 4, 1, 1, '2023-02-21 09:41:08'),
(1230, 412060, 'Fabricación de productos metálicos para uso estructural', 4, 1, 1, '2023-02-21 09:41:08'),
(1231, 412061, 'Forja, prensado, estampado, laminado de metal y pulvimetalurgia', 4, 1, 1, '2023-02-21 09:41:08'),
(1232, 412062, 'Revestimiento de metales y obras de ingeniería mecánica', 4, 1, 1, '2023-02-21 09:41:08'),
(1233, 412063, 'Fabricación de artículos de ferretería', 4, 1, 1, '2023-02-21 09:41:08'),
(1234, 412064, 'Elaboración de otros productos de metal', 4, 1, 1, '2023-02-21 09:41:08'),
(1235, 412065, 'Fabricación de maquinaria y equipo', 4, 1, 1, '2023-02-21 09:41:08'),
(1236, 412066, 'Fabricación de equipos de elevación y manipulación', 4, 1, 1, '2023-02-21 09:41:08'),
(1237, 412067, 'Elaboración de aparatos de uso doméstico', 4, 1, 1, '2023-02-21 09:41:08'),
(1238, 412068, 'Elaboración de equipo de oficina', 4, 1, 1, '2023-02-21 09:41:08'),
(1239, 412069, 'Elaboración de pilas y baterías primarias', 4, 1, 1, '2023-02-21 09:41:08'),
(1240, 412070, 'Elaboración de equipo de iluminación', 4, 1, 1, '2023-02-21 09:41:08'),
(1241, 412071, 'Elaboración de otros tipos de equipo eléctrico', 4, 1, 1, '2023-02-21 09:41:08'),
(1242, 412072, 'Fabricación de equipos de radio, televisión y comunicaciones', 4, 1, 1, '2023-02-21 09:41:09'),
(1243, 412073, 'Fabricación de aparatos e instrumentos médicos', 4, 1, 1, '2023-02-21 09:41:09'),
(1244, 412074, 'Fabricación de instrumentos de medición y control', 4, 1, 1, '2023-02-21 09:41:09'),
(1245, 412075, 'Fabricación de instrumentos de óptica y equipo fotográfico', 4, 1, 1, '2023-02-21 09:41:09'),
(1246, 412076, 'Fabricación de relojes', 4, 1, 1, '2023-02-21 09:41:09'),
(1247, 412077, 'Fabricación de vehículos automotores', 4, 1, 1, '2023-02-21 09:41:09'),
(1248, 412078, 'Fabricación de carrocerías para automotores', 4, 1, 1, '2023-02-21 09:41:09'),
(1249, 412079, 'Fabricación de partes piezas y accesorios para automotores', 4, 1, 1, '2023-02-21 09:41:09'),
(1250, 412080, 'Fabricación y reparación de buques y otras embarcaciones', 4, 1, 1, '2023-02-21 09:41:09'),
(1251, 412081, 'Fabricación de locomotoras y material rodante para ferrocarriles', 4, 1, 1, '2023-02-21 09:41:09'),
(1252, 412082, 'Fabricación de aeronaves', 4, 1, 1, '2023-02-21 09:41:09'),
(1253, 412083, 'Fabricación de motocicletas', 4, 1, 1, '2023-02-21 09:41:09'),
(1254, 412084, 'Fabricación de bicicletas y sillas de ruedas', 4, 1, 1, '2023-02-21 09:41:09'),
(1255, 412085, 'Fabricación de otros tipos de transporte', 4, 1, 1, '2023-02-21 09:41:09'),
(1256, 412086, 'Fabricación de muebles', 4, 1, 1, '2023-02-21 09:41:10'),
(1257, 412087, 'Fabricación de joyas y artículos conexos', 4, 1, 1, '2023-02-21 09:41:10'),
(1258, 412088, 'Fabricación de instrumentos de música', 4, 1, 1, '2023-02-21 09:41:10'),
(1259, 412089, 'Fabricación de artículos y equipo para deporte', 4, 1, 1, '2023-02-21 09:41:10'),
(1260, 412090, 'Fabricación de juegos y juguetes', 4, 1, 1, '2023-02-21 09:41:10'),
(1261, 412091, 'Reciclamiento de desperdicios', 4, 1, 1, '2023-02-21 09:41:10'),
(1262, 412095, 'Productos de otras industrias manufactureras', 4, 1, 1, '2023-02-21 09:41:10'),
(1263, 412099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:10'),
(1264, 4125, 'Suministro de electricidad, gas y agua', 4, 1, 1, '2023-02-21 09:41:10'),
(1265, 412505, 'Generación, captación y distribución de energía eléctrica', 4, 1, 1, '2023-02-21 09:41:10'),
(1266, 412510, 'Fabricación de gas y distribución de combustibles gaseosos', 4, 1, 1, '2023-02-21 09:41:10'),
(1267, 412515, 'Captación, depuración y distribución de agua', 4, 1, 1, '2023-02-21 09:41:10'),
(1268, 412595, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:10'),
(1269, 412599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:10'),
(1270, 4130, 'Construcción', 4, 1, 1, '2023-02-21 09:41:10'),
(1271, 413005, 'Preparación de terrenos', 4, 1, 1, '2023-02-21 09:41:10'),
(1272, 413010, 'Construcción de edificios y obras de ingeniería civil', 4, 1, 1, '2023-02-21 09:41:10'),
(1273, 413015, 'Acondicionamiento de edificios', 4, 1, 1, '2023-02-21 09:41:10'),
(1274, 413020, 'Terminación de edificaciones', 4, 1, 1, '2023-02-21 09:41:10'),
(1275, 413025, 'Alquiler de equipo con operarios', 4, 1, 1, '2023-02-21 09:41:10'),
(1276, 413095, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:10'),
(1277, 413099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:11'),
(1278, 4135, 'Comercio al por mayor y al por menor', 4, 1, 1, '2023-02-21 09:41:11'),
(1279, 413502, 'Venta de vehículos automotores', 4, 1, 1, '2023-02-21 09:41:11'),
(1280, 413504, 'Mantenimiento, reparación y lavado de vehículos automotores', 4, 1, 1, '2023-02-21 09:41:11'),
(1281, 413506, 'Venta de partes, piezas y accesorios de vehículos automotores', 4, 1, 1, '2023-02-21 09:41:11'),
(1282, 413508, 'Venta de combustibles sólidos, líquidos, gaseosos', 4, 1, 1, '2023-02-21 09:41:11'),
(1283, 413510, 'Venta de lubricantes, aditivos, llantas y lujos para automotores', 4, 1, 1, '2023-02-21 09:41:11'),
(1284, 413512, 'Venta a cambio de retribución o por contrata', 4, 1, 1, '2023-02-21 09:41:11'),
(1285, 413514, 'Venta de insumos, materias primas agropecuarias y flores', 4, 1, 1, '2023-02-21 09:41:11'),
(1286, 413516, 'Venta de otros insumos y materias primas no agropecuarias', 4, 1, 1, '2023-02-21 09:41:11'),
(1287, 413518, 'Venta de animales vivos y cueros', 4, 1, 1, '2023-02-21 09:41:11'),
(1288, 413520, 'Venta de productos en almacenes no especializados', 4, 1, 1, '2023-02-21 09:41:11'),
(1289, 413522, 'Venta de productos agropecuarios', 4, 1, 1, '2023-02-21 09:41:11'),
(1290, 413524, 'Venta de productos textiles, de vestir, de cuero y calzado', 4, 1, 1, '2023-02-21 09:41:11'),
(1291, 413526, 'Venta de papel y cartón', 4, 1, 1, '2023-02-21 09:41:11'),
(1292, 413528, 'Venta de libros, revistas, elementos de papelería, útiles y textos\r\n            escolares', 4, 1, 1, '2023-02-21 09:41:11'),
(1293, 413530, 'Venta de juegos, juguetes y artículos deportivos', 4, 1, 1, '2023-02-21 09:41:11'),
(1294, 413532, 'Venta de instrumentos quirúrgicos y ortopédicos', 4, 1, 1, '2023-02-21 09:41:11'),
(1295, 413534, 'Venta de artículos en relojerías y joyerías', 4, 1, 1, '2023-02-21 09:41:11'),
(1296, 413536, 'Venta de electrodomésticos y muebles', 4, 1, 1, '2023-02-21 09:41:11'),
(1297, 413538, 'Venta de productos de aseo, farmacéuticos, medicinales, y artículos de\r\n            tocador', 4, 1, 1, '2023-02-21 09:41:11'),
(1298, 413540, 'Venta de cubiertos, vajillas, cristalería, porcelanas, cerámicas y otros\r\n            artículos de uso doméstico', 4, 1, 1, '2023-02-21 09:41:11'),
(1299, 413542, 'Venta de materiales de construcción, fontanería y calefacción', 4, 1, 1, '2023-02-21 09:41:11'),
(1300, 413544, 'Venta de pinturas y lacas', 4, 1, 1, '2023-02-21 09:41:11'),
(1301, 413546, 'Venta de productos de vidrios y marquetería', 4, 1, 1, '2023-02-21 09:41:11'),
(1302, 413548, 'Venta de herramientas y artículos de ferretería', 4, 1, 1, '2023-02-21 09:41:11'),
(1303, 413550, 'Venta de químicos', 4, 1, 1, '2023-02-21 09:41:11'),
(1304, 413552, 'Venta de productos intermedios, desperdicios y desechos', 4, 1, 1, '2023-02-21 09:41:12'),
(1305, 413554, 'Venta de maquinaria, equipo de oficina y programas de computador', 4, 1, 1, '2023-02-21 09:41:12'),
(1306, 413556, 'Venta de artículos en cacharrerías y misceláneas', 4, 1, 1, '2023-02-21 09:41:12'),
(1307, 413558, 'Venta de instrumentos musicales', 4, 1, 1, '2023-02-21 09:41:12'),
(1308, 413560, 'Venta de artículos en casas de empeño y prenderías', 4, 1, 1, '2023-02-21 09:41:12'),
(1309, 413562, 'Venta de equipo fotográfico', 4, 1, 1, '2023-02-21 09:41:12'),
(1310, 413564, 'Venta de equipo óptico y de precisión', 4, 1, 1, '2023-02-21 09:41:12'),
(1311, 413566, 'Venta de empaques', 4, 1, 1, '2023-02-21 09:41:12'),
(1312, 413568, 'Venta de equipo profesional y científico', 4, 1, 1, '2023-02-21 09:41:12'),
(1313, 413570, 'Venta de loterías, rifas, chance, apuestas y similares', 4, 1, 1, '2023-02-21 09:41:12'),
(1314, 413572, 'Reparación de efectos personales y electrodomésticos', 4, 1, 1, '2023-02-21 09:41:12'),
(1315, 413595, 'Venta de otros productos', 4, 1, 1, '2023-02-21 09:41:12'),
(1316, 413599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:12'),
(1317, 4140, 'Hoteles y restaurantes', 4, 1, 1, '2023-02-21 09:41:12'),
(1318, 414005, 'Hotelería', 4, 1, 1, '2023-02-21 09:41:12'),
(1319, 414010, 'Campamento y otros tipos de hospedaje', 4, 1, 1, '2023-02-21 09:41:12'),
(1320, 414015, 'Restaurantes', 4, 1, 1, '2023-02-21 09:41:12'),
(1321, 414020, 'Bares y cantinas', 4, 1, 1, '2023-02-21 09:41:12'),
(1322, 414095, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:12'),
(1323, 414099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:12'),
(1324, 4145, 'Transporte, almacenamiento y comunicaciones', 4, 1, 1, '2023-02-21 09:41:13'),
(1325, 414505, 'Servicio de transporte por carretera', 4, 1, 1, '2023-02-21 09:41:13'),
(1326, 414510, 'Servicio de transporte por vía férrea', 4, 1, 1, '2023-02-21 09:41:13'),
(1327, 414515, 'Servicio de transporte por vía acuática', 4, 1, 1, '2023-02-21 09:41:13'),
(1328, 414520, 'Servicio de transporte por vía aérea', 4, 1, 1, '2023-02-21 09:41:13'),
(1329, 414525, 'Servicio de transporte por tuberías', 4, 1, 1, '2023-02-21 09:41:13'),
(1330, 414530, 'Manipulación de carga', 4, 1, 1, '2023-02-21 09:41:13'),
(1331, 414535, 'Almacenamiento y depósito', 4, 1, 1, '2023-02-21 09:41:13'),
(1332, 414540, 'Servicios complementarios para el transporte', 4, 1, 1, '2023-02-21 09:41:13'),
(1333, 414545, 'Agencias de viaje', 4, 1, 1, '2023-02-21 09:41:13'),
(1334, 414550, 'Otras agencias de transporte', 4, 1, 1, '2023-02-21 09:41:13'),
(1335, 414555, 'Servicio postal y de correo', 4, 1, 1, '2023-02-21 09:41:13'),
(1336, 414560, 'Servicio telefónico', 4, 1, 1, '2023-02-21 09:41:13'),
(1337, 414565, 'Servicio de telégrafo', 4, 1, 1, '2023-02-21 09:41:13'),
(1338, 414570, 'Servicio de transmisión de datos', 4, 1, 1, '2023-02-21 09:41:13'),
(1339, 414575, 'Servicio de radio y televisión por cable', 4, 1, 1, '2023-02-21 09:41:14'),
(1340, 414580, 'Transmisión de sonido e imágenes por contrato', 4, 1, 1, '2023-02-21 09:41:14'),
(1341, 414595, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:14'),
(1342, 414599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:14'),
(1343, 4150, 'Actividad financiera', 4, 1, 1, '2023-02-21 09:41:14'),
(1344, 415005, 'Venta de inversiones', 4, 1, 1, '2023-02-21 09:41:14'),
(1345, 415010, 'Dividendos de sociedades anónimas y/o asimiladas', 4, 1, 1, '2023-02-21 09:41:14'),
(1346, 415015, 'Participaciones de sociedades limitadas y/o asimiladas', 4, 1, 1, '2023-02-21 09:41:14'),
(1347, 415020, 'Intereses', 4, 1, 1, '2023-02-21 09:41:14'),
(1348, 415025, 'Reajuste monetario-UPAC (hoy UVR)', 4, 1, 1, '2023-02-21 09:41:14'),
(1349, 415030, 'Comisiones', 4, 1, 1, '2023-02-21 09:41:14'),
(1350, 415035, 'Operaciones de descuento', 4, 1, 1, '2023-02-21 09:41:14'),
(1351, 415040, 'Cuotas de inscripción-consorcios', 4, 1, 1, '2023-02-21 09:41:14'),
(1352, 415045, 'Cuotas de administración-consorcios', 4, 1, 1, '2023-02-21 09:41:14'),
(1353, 415050, 'Reajuste del sistema-consorcios', 4, 1, 1, '2023-02-21 09:41:14'),
(1354, 415055, 'Eliminación de suscriptores-consorcios', 4, 1, 1, '2023-02-21 09:41:14'),
(1355, 415060, 'Cuotas de ingreso o retiro-sociedad administradora', 4, 1, 1, '2023-02-21 09:41:14'),
(1356, 415065, 'Servicios a comisionistas', 4, 1, 1, '2023-02-21 09:41:14'),
(1357, 415070, 'Inscripciones y cuotas', 4, 1, 1, '2023-02-21 09:41:14'),
(1358, 415075, 'Recuperación de garantías', 4, 1, 1, '2023-02-21 09:41:14'),
(1359, 415080, 'Ingresos método de participación', 4, 1, 1, '2023-02-21 09:41:14'),
(1360, 415095, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:14'),
(1361, 415099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:14'),
(1362, 4155, 'Actividades inmobiliarias, empresariales y de alquiler', 4, 1, 1, '2023-02-21 09:41:14'),
(1363, 415505, 'Arrendamientos de bienes inmuebles', 4, 1, 1, '2023-02-21 09:41:14'),
(1364, 415510, 'Inmobiliarias por retribución o contrata', 4, 1, 1, '2023-02-21 09:41:14'),
(1365, 415515, 'Alquiler equipo de transporte', 4, 1, 1, '2023-02-21 09:41:14'),
(1366, 415520, 'Alquiler maquinaria y equipo', 4, 1, 1, '2023-02-21 09:41:14'),
(1367, 415525, 'Alquiler de efectos personales y enseres domésticos', 4, 1, 1, '2023-02-21 09:41:14'),
(1368, 415530, 'Consultoría en equipo y programas de informática', 4, 1, 1, '2023-02-21 09:41:14');
INSERT INTO `pucs` (`id`, `code`, `nombre`, `parent_id`, `status`, `created_by`, `created_at`) VALUES
(1369, 415535, 'Procesamiento de datos', 4, 1, 1, '2023-02-21 09:41:15'),
(1370, 415540, 'Mantenimiento y reparación de maquinaria de oficina', 4, 1, 1, '2023-02-21 09:41:15'),
(1371, 415545, 'Investigaciones científicas y de desarrollo', 4, 1, 1, '2023-02-21 09:41:15'),
(1372, 415550, 'Actividades empresariales de consultoría', 4, 1, 1, '2023-02-21 09:41:15'),
(1373, 415555, 'Publicidad', 4, 1, 1, '2023-02-21 09:41:15'),
(1374, 415560, 'Dotación de personal', 4, 1, 1, '2023-02-21 09:41:15'),
(1375, 415565, 'Investigación y seguridad', 4, 1, 1, '2023-02-21 09:41:15'),
(1376, 415570, 'Limpieza de inmuebles', 4, 1, 1, '2023-02-21 09:41:15'),
(1377, 415575, 'Fotografía', 4, 1, 1, '2023-02-21 09:41:15'),
(1378, 415580, 'Envase y empaque', 4, 1, 1, '2023-02-21 09:41:15'),
(1379, 415585, 'Fotocopiado', 4, 1, 1, '2023-02-21 09:41:15'),
(1380, 415590, 'Mantenimiento y reparación de maquinaria y equipo', 4, 1, 1, '2023-02-21 09:41:15'),
(1381, 415595, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:15'),
(1382, 415599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:15'),
(1383, 4160, 'Enseñanza', 4, 1, 1, '2023-02-21 09:41:15'),
(1384, 416005, 'Actividades relacionadas con la educación', 4, 1, 1, '2023-02-21 09:41:15'),
(1385, 416095, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:15'),
(1386, 416099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:16'),
(1387, 4165, 'Servicios sociales y de salud', 4, 1, 1, '2023-02-21 09:41:16'),
(1388, 416505, 'Servicio hospitalario', 4, 1, 1, '2023-02-21 09:41:16'),
(1389, 416510, 'Servicio médico', 4, 1, 1, '2023-02-21 09:41:16'),
(1390, 416515, 'Servicio odontológico', 4, 1, 1, '2023-02-21 09:41:16'),
(1391, 416520, 'Servicio de laboratorio', 4, 1, 1, '2023-02-21 09:41:16'),
(1392, 416525, 'Actividades veterinarias', 4, 1, 1, '2023-02-21 09:41:16'),
(1393, 416530, 'Actividades de servicios sociales', 4, 1, 1, '2023-02-21 09:41:16'),
(1394, 416595, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:16'),
(1395, 416599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:16'),
(1396, 4170, 'Otras actividades de servicios comunitarios, sociales y personales', 4, 1, 1, '2023-02-21 09:41:16'),
(1397, 417005, 'Eliminación de desperdicios y aguas residuales', 4, 1, 1, '2023-02-21 09:41:16'),
(1398, 417010, 'Actividades de asociación', 4, 1, 1, '2023-02-21 09:41:16'),
(1399, 417015, 'Producción y distribución de filmes y videocintas', 4, 1, 1, '2023-02-21 09:41:16'),
(1400, 417020, 'Exhibición de filmes y videocintas', 4, 1, 1, '2023-02-21 09:41:16'),
(1401, 417025, 'Actividad de radio y televisión', 4, 1, 1, '2023-02-21 09:41:16'),
(1402, 417030, 'Actividad teatral, musical y artística', 4, 1, 1, '2023-02-21 09:41:16'),
(1403, 417035, 'Grabación y producción de discos', 4, 1, 1, '2023-02-21 09:41:16'),
(1404, 417040, 'Entretenimiento y esparcimiento', 4, 1, 1, '2023-02-21 09:41:16'),
(1405, 417045, 'Agencias de noticias', 4, 1, 1, '2023-02-21 09:41:16'),
(1406, 417050, 'Lavanderías y similares', 4, 1, 1, '2023-02-21 09:41:16'),
(1407, 417055, 'Peluquerías y similares', 4, 1, 1, '2023-02-21 09:41:16'),
(1408, 417060, 'Servicios funerarios', 4, 1, 1, '2023-02-21 09:41:16'),
(1409, 417065, 'Zonas francas', 4, 1, 1, '2023-02-21 09:41:16'),
(1410, 417095, 'Actividades conexas', 4, 1, 1, '2023-02-21 09:41:16'),
(1411, 417099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:16'),
(1412, 4175, 'Devoluciones en ventas (DB)', 4, 1, 1, '2023-02-21 09:41:16'),
(1413, 417599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:16'),
(1414, 42, 'No operacionales', 4, 1, 1, '2023-02-21 09:41:16'),
(1415, 4205, 'Otras ventas', 4, 1, 1, '2023-02-21 09:41:16'),
(1416, 420505, 'Materia prima', 4, 1, 1, '2023-02-21 09:41:16'),
(1417, 420510, 'Material de desecho', 4, 1, 1, '2023-02-21 09:41:17'),
(1418, 420515, 'Materiales varios', 4, 1, 1, '2023-02-21 09:41:17'),
(1419, 420520, 'Productos de diversificación', 4, 1, 1, '2023-02-21 09:41:17'),
(1420, 420525, 'Excedentes de exportación', 4, 1, 1, '2023-02-21 09:41:17'),
(1421, 420530, 'Envases y empaques', 4, 1, 1, '2023-02-21 09:41:17'),
(1422, 420535, 'Productos agrícolas', 4, 1, 1, '2023-02-21 09:41:17'),
(1423, 420540, 'De propaganda', 4, 1, 1, '2023-02-21 09:41:17'),
(1424, 420545, 'Productos en remate', 4, 1, 1, '2023-02-21 09:41:17'),
(1425, 420550, 'Combustibles y lubricantes', 4, 1, 1, '2023-02-21 09:41:17'),
(1426, 420599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:17'),
(1427, 4210, 'Financieros', 4, 1, 1, '2023-02-21 09:41:17'),
(1428, 421005, 'Intereses', 4, 1, 1, '2023-02-21 09:41:17'),
(1429, 421010, 'Reajuste monetario-UPAC (hoy UVR)', 4, 1, 1, '2023-02-21 09:41:17'),
(1430, 421015, 'Descuentos amortizados', 4, 1, 1, '2023-02-21 09:41:17'),
(1431, 421020, 'Diferencia en cambio', 4, 1, 1, '2023-02-21 09:41:17'),
(1432, 421025, 'Financiación vehículos', 4, 1, 1, '2023-02-21 09:41:17'),
(1433, 421030, 'Financiación sistemas de viajes', 4, 1, 1, '2023-02-21 09:41:17'),
(1434, 421035, 'Aceptaciones bancarias', 4, 1, 1, '2023-02-21 09:41:17'),
(1435, 421040, 'Descuentos comerciales condicionados', 4, 1, 1, '2023-02-21 09:41:17'),
(1436, 421045, 'Descuentos bancarios', 4, 1, 1, '2023-02-21 09:41:17'),
(1437, 421050, 'Comisiones cheques de otras plazas', 4, 1, 1, '2023-02-21 09:41:17'),
(1438, 421055, 'Multas y recargos', 4, 1, 1, '2023-02-21 09:41:17'),
(1439, 421060, 'Sanciones cheques devueltos', 4, 1, 1, '2023-02-21 09:41:17'),
(1440, 421095, 'Otros', 4, 1, 1, '2023-02-21 09:41:17'),
(1441, 421099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:17'),
(1442, 4215, 'Dividendos y participaciones', 4, 1, 1, '2023-02-21 09:41:17'),
(1443, 421505, 'De sociedades anónimas y/o asimiladas', 4, 1, 1, '2023-02-21 09:41:17'),
(1444, 421510, 'De sociedades limitadas y/o asimiladas', 4, 1, 1, '2023-02-21 09:41:17'),
(1445, 421599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:18'),
(1446, 4218, 'Ingresos método de participación', 4, 1, 1, '2023-02-21 09:41:18'),
(1447, 421805, 'De sociedades anónimas y/o asimiladas', 4, 1, 1, '2023-02-21 09:41:18'),
(1448, 421810, 'De sociedades limitadas y/o asimiladas', 4, 1, 1, '2023-02-21 09:41:18'),
(1449, 4220, 'Arrendamientos', 4, 1, 1, '2023-02-21 09:41:18'),
(1450, 422005, 'Terrenos', 4, 1, 1, '2023-02-21 09:41:18'),
(1451, 422010, 'Construcciones y edificios', 4, 1, 1, '2023-02-21 09:41:18'),
(1452, 422015, 'Maquinaria y equipo', 4, 1, 1, '2023-02-21 09:41:18'),
(1453, 422020, 'Equipo de oficina', 4, 1, 1, '2023-02-21 09:41:18'),
(1454, 422025, 'Equipo de computación y comunicación', 4, 1, 1, '2023-02-21 09:41:18'),
(1455, 422030, 'Equipo médico-científico', 4, 1, 1, '2023-02-21 09:41:18'),
(1456, 422035, 'Equipo de hoteles y restaurantes', 4, 1, 1, '2023-02-21 09:41:18'),
(1457, 422040, 'Flota y equipo de transporte', 4, 1, 1, '2023-02-21 09:41:18'),
(1458, 422045, 'Flota y equipo fluvial y/o marítimo', 4, 1, 1, '2023-02-21 09:41:18'),
(1459, 422050, 'Flota y equipo aéreo', 4, 1, 1, '2023-02-21 09:41:18'),
(1460, 422055, 'Flota y equipo férreo', 4, 1, 1, '2023-02-21 09:41:18'),
(1461, 422060, 'Acueductos, plantas y redes', 4, 1, 1, '2023-02-21 09:41:18'),
(1462, 422062, 'Envases y empaques', 4, 1, 1, '2023-02-21 09:41:18'),
(1463, 422065, 'Plantaciones agrícolas y forestales', 4, 1, 1, '2023-02-21 09:41:18'),
(1464, 422070, 'Aeródromos', 4, 1, 1, '2023-02-21 09:41:18'),
(1465, 422075, 'Semovientes', 4, 1, 1, '2023-02-21 09:41:18'),
(1466, 422099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:18'),
(1467, 4225, 'Comisiones', 4, 1, 1, '2023-02-21 09:41:18'),
(1468, 422505, 'Sobre inversiones', 4, 1, 1, '2023-02-21 09:41:18'),
(1469, 422510, 'De concesionarios', 4, 1, 1, '2023-02-21 09:41:18'),
(1470, 422515, 'De actividades financieras', 4, 1, 1, '2023-02-21 09:41:18'),
(1471, 422520, 'Por venta de servicios de taller', 4, 1, 1, '2023-02-21 09:41:18'),
(1472, 422525, 'Por venta de seguros', 4, 1, 1, '2023-02-21 09:41:18'),
(1473, 422530, 'Por ingresos para terceros', 4, 1, 1, '2023-02-21 09:41:18'),
(1474, 422535, 'Por distribución de películas', 4, 1, 1, '2023-02-21 09:41:19'),
(1475, 422540, 'Derechos de autor', 4, 1, 1, '2023-02-21 09:41:19'),
(1476, 422545, 'Derechos de programación', 4, 1, 1, '2023-02-21 09:41:19'),
(1477, 422599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:19'),
(1478, 4230, 'Honorarios', 4, 1, 1, '2023-02-21 09:41:19'),
(1479, 423005, 'Asesorías', 4, 1, 1, '2023-02-21 09:41:19'),
(1480, 423010, 'Asistencia técnica', 4, 1, 1, '2023-02-21 09:41:19'),
(1481, 423015, 'Administración de vinculadas', 4, 1, 1, '2023-02-21 09:41:19'),
(1482, 423099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:19'),
(1483, 4235, 'Servicios', 4, 1, 1, '2023-02-21 09:41:19'),
(1484, 423505, 'De báscula', 4, 1, 1, '2023-02-21 09:41:19'),
(1485, 423510, 'De transporte', 4, 1, 1, '2023-02-21 09:41:19'),
(1486, 423515, 'De prensa', 4, 1, 1, '2023-02-21 09:41:19'),
(1487, 423520, 'Administrativos', 4, 1, 1, '2023-02-21 09:41:19'),
(1488, 423525, 'Técnicos', 4, 1, 1, '2023-02-21 09:41:19'),
(1489, 423530, 'De computación', 4, 1, 1, '2023-02-21 09:41:19'),
(1490, 423535, 'De telefax', 4, 1, 1, '2023-02-21 09:41:19'),
(1491, 423540, 'Taller de vehículos', 4, 1, 1, '2023-02-21 09:41:19'),
(1492, 423545, 'De recepción de aeronaves', 4, 1, 1, '2023-02-21 09:41:20'),
(1493, 423550, 'De transporte programa gas natural', 4, 1, 1, '2023-02-21 09:41:20'),
(1494, 423555, 'Por contratos', 4, 1, 1, '2023-02-21 09:41:20'),
(1495, 423560, 'De trilla', 4, 1, 1, '2023-02-21 09:41:20'),
(1496, 423565, 'De mantenimiento', 4, 1, 1, '2023-02-21 09:41:20'),
(1497, 423570, 'Al personal', 4, 1, 1, '2023-02-21 09:41:20'),
(1498, 423575, 'De casino', 4, 1, 1, '2023-02-21 09:41:20'),
(1499, 423580, 'Fletes', 4, 1, 1, '2023-02-21 09:41:20'),
(1500, 423585, 'Entre compañías', 4, 1, 1, '2023-02-21 09:41:20'),
(1501, 423595, 'Otros', 4, 1, 1, '2023-02-21 09:41:20'),
(1502, 423599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:20'),
(1503, 4240, 'Utilidad en venta de inversiones', 4, 1, 1, '2023-02-21 09:41:20'),
(1504, 424005, 'Acciones', 4, 1, 1, '2023-02-21 09:41:20'),
(1505, 424010, 'Cuotas o partes de interés social', 4, 1, 1, '2023-02-21 09:41:20'),
(1506, 424015, 'Bonos', 4, 1, 1, '2023-02-21 09:41:20'),
(1507, 424020, 'Cédulas', 4, 1, 1, '2023-02-21 09:41:20'),
(1508, 424025, 'Certificados', 4, 1, 1, '2023-02-21 09:41:20'),
(1509, 424030, 'Papeles comerciales', 4, 1, 1, '2023-02-21 09:41:20'),
(1510, 424035, 'Títulos', 4, 1, 1, '2023-02-21 09:41:20'),
(1511, 424045, 'Derechos fiduciarios', 4, 1, 1, '2023-02-21 09:41:21'),
(1512, 424050, 'Obligatorias', 4, 1, 1, '2023-02-21 09:41:21'),
(1513, 424095, 'Otras', 4, 1, 1, '2023-02-21 09:41:21'),
(1514, 424099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:21'),
(1515, 4245, 'Utilidad en venta de propiedades, planta y equipo', 4, 1, 1, '2023-02-21 09:41:21'),
(1516, 424504, 'Terrenos', 4, 1, 1, '2023-02-21 09:41:21'),
(1517, 424506, 'Materiales industria petrolera', 4, 1, 1, '2023-02-21 09:41:21'),
(1518, 424508, 'Construcciones en curso', 4, 1, 1, '2023-02-21 09:41:21'),
(1519, 424512, 'Maquinaria en montaje', 4, 1, 1, '2023-02-21 09:41:21'),
(1520, 424516, 'Construcciones y edificaciones', 4, 1, 1, '2023-02-21 09:41:21'),
(1521, 424520, 'Maquinaria y equipo', 4, 1, 1, '2023-02-21 09:41:21'),
(1522, 424524, 'Equipo de oficina', 4, 1, 1, '2023-02-21 09:41:21'),
(1523, 424528, 'Equipo de computación y comunicación', 4, 1, 1, '2023-02-21 09:41:21'),
(1524, 424532, 'Equipo médico-científico', 4, 1, 1, '2023-02-21 09:41:21'),
(1525, 424536, 'Equipo de hoteles y restaurantes', 4, 1, 1, '2023-02-21 09:41:21'),
(1526, 424540, 'Flota y equipo de transporte', 4, 1, 1, '2023-02-21 09:41:21'),
(1527, 424544, 'Flota y equipo fluvial y/o marítimo', 4, 1, 1, '2023-02-21 09:41:21'),
(1528, 424548, 'Flota y equipo aéreo', 4, 1, 1, '2023-02-21 09:41:21'),
(1529, 424552, 'Flota y equipo férreo', 4, 1, 1, '2023-02-21 09:41:21'),
(1530, 424556, 'Acueductos, plantas y redes', 4, 1, 1, '2023-02-21 09:41:21'),
(1531, 424560, 'Armamento de vigilancia', 4, 1, 1, '2023-02-21 09:41:21'),
(1532, 424562, 'Envases y empaques', 4, 1, 1, '2023-02-21 09:41:22'),
(1533, 424564, 'Plantaciones agrícolas y forestales', 4, 1, 1, '2023-02-21 09:41:22'),
(1534, 424568, 'Vías de comunicación', 4, 1, 1, '2023-02-21 09:41:22'),
(1535, 424572, 'Minas y Canteras', 4, 1, 1, '2023-02-21 09:41:22'),
(1536, 424580, 'Pozos artesianos', 4, 1, 1, '2023-02-21 09:41:22'),
(1537, 424584, 'Yacimientos', 4, 1, 1, '2023-02-21 09:41:22'),
(1538, 424588, 'Semovientes', 4, 1, 1, '2023-02-21 09:41:22'),
(1539, 424599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:22'),
(1540, 4248, 'Utilidad en venta de otros bienes', 4, 1, 1, '2023-02-21 09:41:22'),
(1541, 424805, 'Intangibles', 4, 1, 1, '2023-02-21 09:41:22'),
(1542, 424810, 'Otros activos', 4, 1, 1, '2023-02-21 09:41:22'),
(1543, 424899, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:22'),
(1544, 4250, 'Recuperaciones', 4, 1, 1, '2023-02-21 09:41:22'),
(1545, 425005, 'Deudas malas', 4, 1, 1, '2023-02-21 09:41:22'),
(1546, 425010, 'Seguros', 4, 1, 1, '2023-02-21 09:41:22'),
(1547, 425015, 'Reclamos', 4, 1, 1, '2023-02-21 09:41:22'),
(1548, 425020, 'Reintegro por personal en comisión', 4, 1, 1, '2023-02-21 09:41:22'),
(1549, 425025, 'Reintegro garantías', 4, 1, 1, '2023-02-21 09:41:22'),
(1550, 425030, 'Descuentos concedidos', 4, 1, 1, '2023-02-21 09:41:22'),
(1551, 425035, 'De provisiones', 4, 1, 1, '2023-02-21 09:41:22'),
(1552, 425040, 'Gastos bancarios', 4, 1, 1, '2023-02-21 09:41:22'),
(1553, 425045, 'De depreciación', 4, 1, 1, '2023-02-21 09:41:23'),
(1554, 425050, 'Reintegro de otros costos y gastos', 4, 1, 1, '2023-02-21 09:41:23'),
(1555, 425099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:23'),
(1556, 4255, 'Indemnizaciones', 4, 1, 1, '2023-02-21 09:41:23'),
(1557, 425505, 'Por siniestro', 4, 1, 1, '2023-02-21 09:41:23'),
(1558, 425510, 'Por suministros', 4, 1, 1, '2023-02-21 09:41:23'),
(1559, 425515, 'Lucro cesante compañías de seguros', 4, 1, 1, '2023-02-21 09:41:23'),
(1560, 425520, 'Daño emergente compañías de seguros', 4, 1, 1, '2023-02-21 09:41:23'),
(1561, 425525, 'Por pérdida de mercancía', 4, 1, 1, '2023-02-21 09:41:23'),
(1562, 425530, 'Por incumplimiento de contratos', 4, 1, 1, '2023-02-21 09:41:23'),
(1563, 425535, 'De terceros', 4, 1, 1, '2023-02-21 09:41:23'),
(1564, 425540, 'Por incapacidades ISS', 4, 1, 1, '2023-02-21 09:41:23'),
(1565, 425595, 'Otras', 4, 1, 1, '2023-02-21 09:41:23'),
(1566, 425599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:23'),
(1567, 4260, 'Participaciones en concesiones', 4, 1, 1, '2023-02-21 09:41:23'),
(1568, 426099, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:23'),
(1569, 4265, 'Ingresos de ejercicios anteriores', 4, 1, 1, '2023-02-21 09:41:23'),
(1570, 426599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:23'),
(1571, 4275, 'Devoluciones en otras ventas (DB)', 4, 1, 1, '2023-02-21 09:41:23'),
(1572, 427599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:23'),
(1573, 4295, 'Diversos', 4, 1, 1, '2023-02-21 09:41:23'),
(1574, 429503, 'CERT', 4, 1, 1, '2023-02-21 09:41:24'),
(1575, 429505, 'Aprovechamientos', 4, 1, 1, '2023-02-21 09:41:24'),
(1576, 429507, 'Auxilios', 4, 1, 1, '2023-02-21 09:41:24'),
(1577, 429509, 'Subvenciones', 4, 1, 1, '2023-02-21 09:41:24'),
(1578, 429511, 'Ingresos por investigación y desarrollo', 4, 1, 1, '2023-02-21 09:41:24'),
(1579, 429513, 'Por trabajos ejecutados', 4, 1, 1, '2023-02-21 09:41:24'),
(1580, 429515, 'Regalías', 4, 1, 1, '2023-02-21 09:41:24'),
(1581, 429517, 'Derivados de las exportaciones', 4, 1, 1, '2023-02-21 09:41:24'),
(1582, 429519, 'Otros ingresos de explotación', 4, 1, 1, '2023-02-21 09:41:24'),
(1583, 429521, 'De la actividad ganadera', 4, 1, 1, '2023-02-21 09:41:24'),
(1584, 429525, 'Derechos y licitaciones', 4, 1, 1, '2023-02-21 09:41:24'),
(1585, 429530, 'Ingresos por elementos perdidos', 4, 1, 1, '2023-02-21 09:41:24'),
(1586, 429533, 'Multas y recargos', 4, 1, 1, '2023-02-21 09:41:24'),
(1587, 429535, 'Preavisos descontados', 4, 1, 1, '2023-02-21 09:41:24'),
(1588, 429537, 'Reclamos', 4, 1, 1, '2023-02-21 09:41:24'),
(1589, 429540, 'Recobro de daños', 4, 1, 1, '2023-02-21 09:41:24'),
(1590, 429543, 'Premios', 4, 1, 1, '2023-02-21 09:41:24'),
(1591, 429545, 'Bonificaciones', 4, 1, 1, '2023-02-21 09:41:24'),
(1592, 429547, 'Productos descontados', 4, 1, 1, '2023-02-21 09:41:24'),
(1593, 429549, 'Reconocimientos ISS', 4, 1, 1, '2023-02-21 09:41:24'),
(1594, 429551, 'Excedentes', 4, 1, 1, '2023-02-21 09:41:24'),
(1595, 429553, 'Sobrantes de caja', 4, 1, 1, '2023-02-21 09:41:24'),
(1596, 429555, 'Sobrantes en liquidación fletes', 4, 1, 1, '2023-02-21 09:41:24'),
(1597, 429557, 'Subsidios estatales', 4, 1, 1, '2023-02-21 09:41:25'),
(1598, 429559, 'Capacitación distribuidores', 4, 1, 1, '2023-02-21 09:41:25'),
(1599, 429561, 'De escrituración', 4, 1, 1, '2023-02-21 09:41:25'),
(1600, 429563, 'Registro promesas de venta', 4, 1, 1, '2023-02-21 09:41:25'),
(1601, 429567, 'Útiles, papelería y fotocopias', 4, 1, 1, '2023-02-21 09:41:25'),
(1602, 429571, 'Resultados, matrículas y traspasos', 4, 1, 1, '2023-02-21 09:41:25'),
(1603, 429573, 'Decoraciones', 4, 1, 1, '2023-02-21 09:41:25'),
(1604, 429575, 'Manejo de carga', 4, 1, 1, '2023-02-21 09:41:25'),
(1605, 429579, 'Historia clínica', 4, 1, 1, '2023-02-21 09:41:25'),
(1606, 429581, 'Ajuste al peso', 4, 1, 1, '2023-02-21 09:41:25'),
(1607, 429583, 'Llamadas telefónicas', 4, 1, 1, '2023-02-21 09:41:25'),
(1608, 429595, 'Otros', 4, 1, 1, '2023-02-21 09:41:25'),
(1609, 429599, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:25'),
(1610, 47, 'Ajustes por inflación', 4, 1, 1, '2023-02-21 09:41:25'),
(1611, 4705, 'Corrección monetaria', 4, 1, 1, '2023-02-21 09:41:25'),
(1612, 470505, 'Inversiones (CR)', 4, 1, 1, '2023-02-21 09:41:25'),
(1613, 470510, 'Inventarios (CR)', 4, 1, 1, '2023-02-21 09:41:25'),
(1614, 470515, 'Propiedades, planta y equipo (CR)', 4, 1, 1, '2023-02-21 09:41:25'),
(1615, 470520, 'Intangibles (CR)', 4, 1, 1, '2023-02-21 09:41:25'),
(1616, 470525, 'Activos diferidos', 4, 1, 1, '2023-02-21 09:41:25'),
(1617, 470530, 'Otros activos (CR)', 4, 1, 1, '2023-02-21 09:41:25'),
(1618, 470535, 'Pasivos sujetos de ajuste', 4, 1, 1, '2023-02-21 09:41:25'),
(1619, 470540, 'Patrimonio', 4, 1, 1, '2023-02-21 09:41:25'),
(1620, 470545, 'Depreciación acumulada (DB)', 4, 1, 1, '2023-02-21 09:41:25'),
(1621, 470550, 'Depreciación diferida (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1622, 470555, 'Agotamiento acumulado (DB)', 4, 1, 1, '2023-02-21 09:41:26'),
(1623, 470560, 'Amortización acumulada (DB)', 4, 1, 1, '2023-02-21 09:41:26'),
(1624, 470565, 'Ingresos operacionales (DB)', 4, 1, 1, '2023-02-21 09:41:26'),
(1625, 470568, 'Devoluciones en ventas (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1626, 470570, 'Ingresos no operacionales (DB)', 4, 1, 1, '2023-02-21 09:41:26'),
(1627, 470575, 'Gastos operacionales de administración (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1628, 470580, 'Gastos operacionales de ventas (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1629, 470585, 'Gastos no operacionales (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1630, 470590, 'Compras (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1631, 470591, 'Devoluciones en compras (DB)', 4, 1, 1, '2023-02-21 09:41:26'),
(1632, 470592, 'Costo de ventas (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1633, 470594, 'Costos de producción o de operación (CR)', 4, 1, 1, '2023-02-21 09:41:26'),
(1635, 51, 'Operacionales de administración', 5, 1, 1, '2023-02-21 09:43:40'),
(1636, 5105, 'Gastos de personal', 5, 1, 1, '2023-02-21 09:43:40'),
(1637, 510503, 'Salario integral', 5, 1, 1, '2023-02-21 09:43:40'),
(1638, 510506, 'Sueldos', 5, 1, 1, '2023-02-21 09:43:40'),
(1639, 510512, 'Jornales', 5, 1, 1, '2023-02-21 09:43:40'),
(1640, 510515, 'Horas extras y recargos', 5, 1, 1, '2023-02-21 09:43:40'),
(1641, 510518, 'Comisiones', 5, 1, 1, '2023-02-21 09:43:40'),
(1642, 510521, 'Viáticos', 5, 1, 1, '2023-02-21 09:43:40'),
(1643, 510524, 'Incapacidades', 5, 1, 1, '2023-02-21 09:43:41'),
(1644, 510527, 'Auxilio de transporte', 5, 1, 1, '2023-02-21 09:43:41'),
(1645, 510530, 'Cesantías', 5, 1, 1, '2023-02-21 09:43:41'),
(1646, 510533, 'Intereses sobre cesantías', 5, 1, 1, '2023-02-21 09:43:41'),
(1647, 510536, 'Prima de servicios', 5, 1, 1, '2023-02-21 09:43:41'),
(1648, 510539, 'Vacaciones', 5, 1, 1, '2023-02-21 09:43:41'),
(1649, 510542, 'Primas extralegales', 5, 1, 1, '2023-02-21 09:43:41'),
(1650, 510545, 'Auxilios', 5, 1, 1, '2023-02-21 09:43:41'),
(1651, 510548, 'Bonificaciones', 5, 1, 1, '2023-02-21 09:43:41'),
(1652, 510551, 'Dotación y suministro a trabajadores', 5, 1, 1, '2023-02-21 09:43:41'),
(1653, 510554, 'Seguros', 5, 1, 1, '2023-02-21 09:43:41'),
(1654, 510557, 'Cuotas partes pensiones de jubilación', 5, 1, 1, '2023-02-21 09:43:41'),
(1655, 510558, 'Amortización cálculo actuarial pensiones de jubilación', 5, 1, 1, '2023-02-21 09:43:41'),
(1656, 510559, 'Pensiones de jubilación', 5, 1, 1, '2023-02-21 09:43:41'),
(1657, 510560, 'Indemnizaciones laborales', 5, 1, 1, '2023-02-21 09:43:41'),
(1658, 510561, 'Amortización bonos pensionales', 5, 1, 1, '2023-02-21 09:43:41'),
(1659, 510562, 'Amortización títulos pensionales', 5, 1, 1, '2023-02-21 09:43:41'),
(1660, 510563, 'Capacitación al personal', 5, 1, 1, '2023-02-21 09:43:41'),
(1661, 510566, 'Gastos deportivos y de recreación', 5, 1, 1, '2023-02-21 09:43:41'),
(1662, 510568, 'Aportes a administradoras de riesgos profesionales, ARP', 5, 1, 1, '2023-02-21 09:43:41'),
(1663, 510569, 'Aportes a entidades promotoras de salud, EPS', 5, 1, 1, '2023-02-21 09:43:41'),
(1664, 510570, 'Aportes a fondos de pensiones y/o cesantías', 5, 1, 1, '2023-02-21 09:43:41'),
(1665, 510572, 'Aportes cajas de compensación familiar', 5, 1, 1, '2023-02-21 09:43:42'),
(1666, 510575, 'Aportes ICBF', 5, 1, 1, '2023-02-21 09:43:42'),
(1667, 510578, 'SENA', 5, 1, 1, '2023-02-21 09:43:42'),
(1668, 510581, 'Aportes sindicales', 5, 1, 1, '2023-02-21 09:43:42'),
(1669, 510584, 'Gastos médicos y drogas', 5, 1, 1, '2023-02-21 09:43:42'),
(1670, 510595, 'Otros', 5, 1, 1, '2023-02-21 09:43:42'),
(1671, 510599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:42'),
(1672, 5110, 'Honorarios', 5, 1, 1, '2023-02-21 09:43:42'),
(1673, 511005, 'Junta directiva', 5, 1, 1, '2023-02-21 09:43:42'),
(1674, 511010, 'Revisoría fiscal', 5, 1, 1, '2023-02-21 09:43:42'),
(1675, 511015, 'Auditoría externa', 5, 1, 1, '2023-02-21 09:43:42'),
(1676, 511020, 'Avalúos', 5, 1, 1, '2023-02-21 09:43:42'),
(1677, 511025, 'Asesoría jurídica', 5, 1, 1, '2023-02-21 09:43:42'),
(1678, 511030, 'Asesoría financiera', 5, 1, 1, '2023-02-21 09:43:42'),
(1679, 511035, 'Asesoría técnica', 5, 1, 1, '2023-02-21 09:43:42'),
(1680, 511095, 'Otros', 5, 1, 1, '2023-02-21 09:43:42'),
(1681, 511099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:42'),
(1682, 5115, 'Impuestos', 5, 1, 1, '2023-02-21 09:43:42'),
(1683, 511505, 'Industria y comercio', 5, 1, 1, '2023-02-21 09:43:42'),
(1684, 511510, 'De timbres', 5, 1, 1, '2023-02-21 09:43:42'),
(1685, 511515, 'A la propiedad raíz', 5, 1, 1, '2023-02-21 09:43:42'),
(1686, 511520, 'Derechos sobre instrumentos públicos', 5, 1, 1, '2023-02-21 09:43:42'),
(1687, 511525, 'De valorización', 5, 1, 1, '2023-02-21 09:43:42'),
(1688, 511530, 'De turismo', 5, 1, 1, '2023-02-21 09:43:42'),
(1689, 511535, 'Tasa por utilización de puertos', 5, 1, 1, '2023-02-21 09:43:42'),
(1690, 511540, 'De vehículos', 5, 1, 1, '2023-02-21 09:43:42'),
(1691, 511545, 'De espectáculos públicos', 5, 1, 1, '2023-02-21 09:43:42'),
(1692, 511550, 'Cuotas de fomento', 5, 1, 1, '2023-02-21 09:43:43'),
(1693, 511570, 'IVA descontable', 5, 1, 1, '2023-02-21 09:43:43'),
(1694, 511595, 'Otros', 5, 1, 1, '2023-02-21 09:43:43'),
(1695, 511599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:43'),
(1696, 5120, 'Arrendamientos', 5, 1, 1, '2023-02-21 09:43:43'),
(1697, 512005, 'Terrenos', 5, 1, 1, '2023-02-21 09:43:43'),
(1698, 512010, 'Construcciones y edificaciones', 5, 1, 1, '2023-02-21 09:43:43'),
(1699, 512015, 'Maquinaria y equipo', 5, 1, 1, '2023-02-21 09:43:43'),
(1700, 512020, 'Equipo de oficina', 5, 1, 1, '2023-02-21 09:43:43'),
(1701, 512025, 'Equipo de computación y comunicación', 5, 1, 1, '2023-02-21 09:43:43'),
(1702, 512030, 'Equipo médico-científico', 5, 1, 1, '2023-02-21 09:43:43'),
(1703, 512035, 'Equipo de hoteles y restaurantes', 5, 1, 1, '2023-02-21 09:43:43'),
(1704, 512040, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:43'),
(1705, 512045, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:43'),
(1706, 512050, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:43'),
(1707, 512055, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:43'),
(1708, 512060, 'Acueductos, plantas y redes', 5, 1, 1, '2023-02-21 09:43:43'),
(1709, 512065, 'Aeródromos', 5, 1, 1, '2023-02-21 09:43:43'),
(1710, 512070, 'Semovientes', 5, 1, 1, '2023-02-21 09:43:43'),
(1711, 512095, 'Otros', 5, 1, 1, '2023-02-21 09:43:43'),
(1712, 512099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:43'),
(1713, 5125, 'Contribuciones y afiliaciones', 5, 1, 1, '2023-02-21 09:43:43'),
(1714, 512505, 'Contribuciones', 5, 1, 1, '2023-02-21 09:43:43'),
(1715, 512510, 'Afiliaciones y sostenimiento', 5, 1, 1, '2023-02-21 09:43:43'),
(1716, 512599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:43'),
(1717, 5130, 'Seguros', 5, 1, 1, '2023-02-21 09:43:44'),
(1718, 513005, 'Manejo', 5, 1, 1, '2023-02-21 09:43:44'),
(1719, 513010, 'Cumplimiento', 5, 1, 1, '2023-02-21 09:43:44'),
(1720, 513015, 'Corriente débil', 5, 1, 1, '2023-02-21 09:43:44'),
(1721, 513020, 'Vida colectiva', 5, 1, 1, '2023-02-21 09:43:44'),
(1722, 513025, 'Incendio', 5, 1, 1, '2023-02-21 09:43:44'),
(1723, 513030, 'Terremoto', 5, 1, 1, '2023-02-21 09:43:44'),
(1724, 513035, 'Sustracción y hurto', 5, 1, 1, '2023-02-21 09:43:44'),
(1725, 513040, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:44'),
(1726, 513045, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:44'),
(1727, 513050, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:44'),
(1728, 513055, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:44'),
(1729, 513060, 'Responsabilidad civil y extracontractual', 5, 1, 1, '2023-02-21 09:43:44'),
(1730, 513065, 'Vuelo', 5, 1, 1, '2023-02-21 09:43:44'),
(1731, 513070, 'Rotura de maquinaria', 5, 1, 1, '2023-02-21 09:43:44'),
(1732, 513075, 'Obligatorio accidente de tránsito', 5, 1, 1, '2023-02-21 09:43:44'),
(1733, 513080, 'Lucro cesante', 5, 1, 1, '2023-02-21 09:43:44'),
(1734, 513085, 'Transporte de mercancía', 5, 1, 1, '2023-02-21 09:43:44'),
(1735, 513095, 'Otros', 5, 1, 1, '2023-02-21 09:43:44'),
(1736, 513099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:44'),
(1737, 5135, 'Servicios', 5, 1, 1, '2023-02-21 09:43:44'),
(1738, 513505, 'Aseo y vigilancia', 5, 1, 1, '2023-02-21 09:43:44'),
(1739, 513510, 'Temporales', 5, 1, 1, '2023-02-21 09:43:44'),
(1740, 513515, 'Asistencia técnica', 5, 1, 1, '2023-02-21 09:43:44'),
(1741, 513520, 'Procesamiento electrónico de datos', 5, 1, 1, '2023-02-21 09:43:44'),
(1742, 513525, 'Acueducto y alcantarillado', 5, 1, 1, '2023-02-21 09:43:44'),
(1743, 513530, 'Energía eléctrica', 5, 1, 1, '2023-02-21 09:43:44'),
(1744, 513535, 'Teléfono', 5, 1, 1, '2023-02-21 09:43:44'),
(1745, 513540, 'Correo, portes y telegramas', 5, 1, 1, '2023-02-21 09:43:44'),
(1746, 513545, 'Fax y télex', 5, 1, 1, '2023-02-21 09:43:45'),
(1747, 513550, 'Transporte, fletes y acarreos', 5, 1, 1, '2023-02-21 09:43:45'),
(1748, 513555, 'Gas', 5, 1, 1, '2023-02-21 09:43:45'),
(1749, 513595, 'Otros', 5, 1, 1, '2023-02-21 09:43:45'),
(1750, 513599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:45'),
(1751, 5140, 'Gastos legales', 5, 1, 1, '2023-02-21 09:43:45'),
(1752, 514005, 'Notariales', 5, 1, 1, '2023-02-21 09:43:45'),
(1753, 514010, 'Registro mercantil', 5, 1, 1, '2023-02-21 09:43:45'),
(1754, 514015, 'Trámites y licencias', 5, 1, 1, '2023-02-21 09:43:45'),
(1755, 514020, 'Aduaneros', 5, 1, 1, '2023-02-21 09:43:45'),
(1756, 514025, 'Consulares', 5, 1, 1, '2023-02-21 09:43:45'),
(1757, 514095, 'Otros', 5, 1, 1, '2023-02-21 09:43:46'),
(1758, 514099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:46'),
(1759, 5145, 'Mantenimiento y reparaciones', 5, 1, 1, '2023-02-21 09:43:46'),
(1760, 514505, 'Terrenos', 5, 1, 1, '2023-02-21 09:43:46'),
(1761, 514510, 'Construcciones y edificaciones', 5, 1, 1, '2023-02-21 09:43:46'),
(1762, 514515, 'Maquinaria y equipo', 5, 1, 1, '2023-02-21 09:43:46'),
(1763, 514520, 'Equipo de oficina', 5, 1, 1, '2023-02-21 09:43:46'),
(1764, 514525, 'Equipo de computación y comunicación', 5, 1, 1, '2023-02-21 09:43:46'),
(1765, 514530, 'Equipo médico-científico', 5, 1, 1, '2023-02-21 09:43:46'),
(1766, 514535, 'Equipo de hoteles y restaurantes', 5, 1, 1, '2023-02-21 09:43:46'),
(1767, 514540, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:46'),
(1768, 514545, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:46'),
(1769, 514550, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:46'),
(1770, 514555, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:46'),
(1771, 514560, 'Acueductos, plantas y redes', 5, 1, 1, '2023-02-21 09:43:46'),
(1772, 514565, 'Armamento de vigilancia', 5, 1, 1, '2023-02-21 09:43:46'),
(1773, 514570, 'Vías de comunicación', 5, 1, 1, '2023-02-21 09:43:46'),
(1774, 514599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:46'),
(1775, 5150, 'Adecuación e instalación', 5, 1, 1, '2023-02-21 09:43:46'),
(1776, 515005, 'Instalaciones eléctricas', 5, 1, 1, '2023-02-21 09:43:46'),
(1777, 515010, 'Arreglos ornamentales', 5, 1, 1, '2023-02-21 09:43:46'),
(1778, 515015, 'Reparaciones locativas', 5, 1, 1, '2023-02-21 09:43:46'),
(1779, 515095, 'Otros', 5, 1, 1, '2023-02-21 09:43:46'),
(1780, 515099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:47'),
(1781, 5155, 'Gastos de viaje', 5, 1, 1, '2023-02-21 09:43:47'),
(1782, 515505, 'Alojamiento y manutención', 5, 1, 1, '2023-02-21 09:43:47'),
(1783, 515510, 'Pasajes fluviales y/o marítimos', 5, 1, 1, '2023-02-21 09:43:47'),
(1784, 515515, 'Pasajes aéreos', 5, 1, 1, '2023-02-21 09:43:47'),
(1785, 515520, 'Pasajes terrestres', 5, 1, 1, '2023-02-21 09:43:47'),
(1786, 515525, 'Pasajes férreos', 5, 1, 1, '2023-02-21 09:43:47'),
(1787, 515595, 'Otros', 5, 1, 1, '2023-02-21 09:43:47'),
(1788, 515599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:47'),
(1789, 5160, 'Depreciaciones', 5, 1, 1, '2023-02-21 09:43:47'),
(1790, 516005, 'Construcciones y edificaciones', 5, 1, 1, '2023-02-21 09:43:47'),
(1791, 516010, 'Maquinaria y equipo', 5, 1, 1, '2023-02-21 09:43:47'),
(1792, 516015, 'Equipo de oficina', 5, 1, 1, '2023-02-21 09:43:47'),
(1793, 516020, 'Equipo de computación y comunicación', 5, 1, 1, '2023-02-21 09:43:47'),
(1794, 516025, 'Equipo médico-científico', 5, 1, 1, '2023-02-21 09:43:47'),
(1795, 516030, 'Equipo de hoteles y restaurantes', 5, 1, 1, '2023-02-21 09:43:47'),
(1796, 516035, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:47'),
(1797, 516040, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:47'),
(1798, 516045, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:47'),
(1799, 516050, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:47'),
(1800, 516055, 'Acueductos, plantas y redes', 5, 1, 1, '2023-02-21 09:43:47'),
(1801, 516060, 'Armamento de vigilancia', 5, 1, 1, '2023-02-21 09:43:47'),
(1802, 516099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:48'),
(1803, 5165, 'Amortizaciones', 5, 1, 1, '2023-02-21 09:43:48'),
(1804, 516505, 'Vías de comunicación', 5, 1, 1, '2023-02-21 09:43:48'),
(1805, 516510, 'Intangibles', 5, 1, 1, '2023-02-21 09:43:48'),
(1806, 516515, 'Cargos diferidos', 5, 1, 1, '2023-02-21 09:43:48'),
(1807, 516595, 'Otras', 5, 1, 1, '2023-02-21 09:43:48'),
(1808, 516599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:48'),
(1809, 5195, 'Diversos', 5, 1, 1, '2023-02-21 09:43:48'),
(1810, 519505, 'Comisiones', 5, 1, 1, '2023-02-21 09:43:48'),
(1811, 519510, 'Libros, suscripciones, periódicos y revistas', 5, 1, 1, '2023-02-21 09:43:48'),
(1812, 519515, 'Música ambiental', 5, 1, 1, '2023-02-21 09:43:48'),
(1813, 519520, 'Gastos de representación y relaciones públicas', 5, 1, 1, '2023-02-21 09:43:48'),
(1814, 519525, 'Elementos de aseo y cafetería', 5, 1, 1, '2023-02-21 09:43:48'),
(1815, 519530, 'Útiles, papelería y fotocopias', 5, 1, 1, '2023-02-21 09:43:48'),
(1816, 519535, 'Combustibles y lubricantes', 5, 1, 1, '2023-02-21 09:43:48'),
(1817, 519540, 'Envases y empaques', 5, 1, 1, '2023-02-21 09:43:48'),
(1818, 519545, 'Taxis y buses', 5, 1, 1, '2023-02-21 09:43:48'),
(1819, 519550, 'Estampillas', 5, 1, 1, '2023-02-21 09:43:48'),
(1820, 519555, 'Microfilmación', 5, 1, 1, '2023-02-21 09:43:48'),
(1821, 519560, 'Casino y restaurante', 5, 1, 1, '2023-02-21 09:43:48'),
(1822, 519565, 'Parqueaderos', 5, 1, 1, '2023-02-21 09:43:48'),
(1823, 519570, 'Indemnización por daños a terceros', 5, 1, 1, '2023-02-21 09:43:48'),
(1824, 519575, 'Pólvora y similares', 5, 1, 1, '2023-02-21 09:43:48'),
(1825, 519595, 'Otros', 5, 1, 1, '2023-02-21 09:43:49'),
(1826, 519599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:49'),
(1827, 5199, 'Provisiones', 5, 1, 1, '2023-02-21 09:43:49'),
(1828, 519905, 'Inversiones', 5, 1, 1, '2023-02-21 09:43:49'),
(1829, 519910, 'Deudores', 5, 1, 1, '2023-02-21 09:43:49'),
(1830, 519915, 'Propiedades, planta y equipo', 5, 1, 1, '2023-02-21 09:43:49'),
(1831, 519995, 'Otros activos', 5, 1, 1, '2023-02-21 09:43:49'),
(1832, 519999, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:49'),
(1833, 52, 'Operacionales de ventas', 5, 1, 1, '2023-02-21 09:43:49'),
(1834, 5205, 'Gastos de personal', 5, 1, 1, '2023-02-21 09:43:49'),
(1835, 520503, 'Salario integral', 5, 1, 1, '2023-02-21 09:43:49'),
(1836, 520506, 'Sueldos', 5, 1, 1, '2023-02-21 09:43:49'),
(1837, 520512, 'Jornales', 5, 1, 1, '2023-02-21 09:43:49'),
(1838, 520515, 'Horas extras y recargos', 5, 1, 1, '2023-02-21 09:43:49'),
(1839, 520518, 'Comisiones', 5, 1, 1, '2023-02-21 09:43:49'),
(1840, 520521, 'Viáticos', 5, 1, 1, '2023-02-21 09:43:49'),
(1841, 520524, 'Incapacidades', 5, 1, 1, '2023-02-21 09:43:49'),
(1842, 520527, 'Auxilio de transporte', 5, 1, 1, '2023-02-21 09:43:49'),
(1843, 520530, 'Cesantías', 5, 1, 1, '2023-02-21 09:43:49'),
(1844, 520533, 'Intereses sobre cesantías', 5, 1, 1, '2023-02-21 09:43:49'),
(1845, 520536, 'Prima de servicios', 5, 1, 1, '2023-02-21 09:43:50'),
(1846, 520539, 'Vacaciones', 5, 1, 1, '2023-02-21 09:43:50'),
(1847, 520542, 'Primas extralegales', 5, 1, 1, '2023-02-21 09:43:50'),
(1848, 520545, 'Auxilios', 5, 1, 1, '2023-02-21 09:43:50'),
(1849, 520548, 'Bonificaciones', 5, 1, 1, '2023-02-21 09:43:50'),
(1850, 520551, 'Dotación y suministro a trabajadores', 5, 1, 1, '2023-02-21 09:43:50'),
(1851, 520554, 'Seguros', 5, 1, 1, '2023-02-21 09:43:50'),
(1852, 520557, 'Cuotas partes pensiones de jubilación', 5, 1, 1, '2023-02-21 09:43:50'),
(1853, 520558, 'Amortización cálculo actuarial pensiones de jubilación', 5, 1, 1, '2023-02-21 09:43:50'),
(1854, 520559, 'Pensiones de jubilación', 5, 1, 1, '2023-02-21 09:43:50'),
(1855, 520560, 'Indemnizaciones laborales', 5, 1, 1, '2023-02-21 09:43:50'),
(1856, 520561, 'Amortización bonos pensionales', 5, 1, 1, '2023-02-21 09:43:50'),
(1857, 520562, 'Amortización títulos pensionales', 5, 1, 1, '2023-02-21 09:43:50'),
(1858, 520563, 'Capacitación al personal', 5, 1, 1, '2023-02-21 09:43:50'),
(1859, 520566, 'Gastos deportivos y de recreación', 5, 1, 1, '2023-02-21 09:43:50'),
(1860, 520568, 'Aportes a administradoras de riesgos profesionales, ARP', 5, 1, 1, '2023-02-21 09:43:50'),
(1861, 520569, 'Aportes a entidades promotoras de salud, EPS', 5, 1, 1, '2023-02-21 09:43:50'),
(1862, 520570, 'Aportes a fondos de pensiones y/o cesantías', 5, 1, 1, '2023-02-21 09:43:50'),
(1863, 520572, 'Aportes cajas de compensación familiar', 5, 1, 1, '2023-02-21 09:43:50'),
(1864, 520575, 'Aportes ICBF', 5, 1, 1, '2023-02-21 09:43:50'),
(1865, 520578, 'SENA', 5, 1, 1, '2023-02-21 09:43:50'),
(1866, 520581, 'Aportes sindicales', 5, 1, 1, '2023-02-21 09:43:50'),
(1867, 520584, 'Gastos médicos y drogas', 5, 1, 1, '2023-02-21 09:43:50'),
(1868, 520595, 'Otros', 5, 1, 1, '2023-02-21 09:43:50'),
(1869, 520599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:50'),
(1870, 5210, 'Honorarios', 5, 1, 1, '2023-02-21 09:43:51'),
(1871, 521005, 'Junta directiva', 5, 1, 1, '2023-02-21 09:43:51'),
(1872, 521010, 'Revisoría fiscal', 5, 1, 1, '2023-02-21 09:43:51'),
(1873, 521015, 'Auditoría externa', 5, 1, 1, '2023-02-21 09:43:51'),
(1874, 521020, 'Avalúos', 5, 1, 1, '2023-02-21 09:43:51'),
(1875, 521025, 'Asesoría jurídica', 5, 1, 1, '2023-02-21 09:43:51'),
(1876, 521030, 'Asesoría financiera', 5, 1, 1, '2023-02-21 09:43:51'),
(1877, 521035, 'Asesoría técnica', 5, 1, 1, '2023-02-21 09:43:51'),
(1878, 521095, 'Otros', 5, 1, 1, '2023-02-21 09:43:51'),
(1879, 521099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:51'),
(1880, 5215, 'Impuestos', 5, 1, 1, '2023-02-21 09:43:51'),
(1881, 521505, 'Industria y comercio', 5, 1, 1, '2023-02-21 09:43:51'),
(1882, 521510, 'De timbres', 5, 1, 1, '2023-02-21 09:43:51'),
(1883, 521515, 'A la propiedad raíz', 5, 1, 1, '2023-02-21 09:43:51'),
(1884, 521520, 'Derechos sobre instrumentos públicos', 5, 1, 1, '2023-02-21 09:43:52'),
(1885, 521525, 'De valorización', 5, 1, 1, '2023-02-21 09:43:52'),
(1886, 521530, 'De turismo', 5, 1, 1, '2023-02-21 09:43:52'),
(1887, 521535, 'Tasa por utilización de puertos', 5, 1, 1, '2023-02-21 09:43:52'),
(1888, 521540, 'De vehículos', 5, 1, 1, '2023-02-21 09:43:52'),
(1889, 521545, 'De espectáculos públicos', 5, 1, 1, '2023-02-21 09:43:52'),
(1890, 521550, 'Cuotas de fomento', 5, 1, 1, '2023-02-21 09:43:52'),
(1891, 521555, 'Licores', 5, 1, 1, '2023-02-21 09:43:52'),
(1892, 521560, 'Cervezas', 5, 1, 1, '2023-02-21 09:43:52'),
(1893, 521565, 'Cigarrillos', 5, 1, 1, '2023-02-21 09:43:52'),
(1894, 521570, 'IVA descontable', 5, 1, 1, '2023-02-21 09:43:52'),
(1895, 521595, 'Otros', 5, 1, 1, '2023-02-21 09:43:52'),
(1896, 521599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:52'),
(1897, 5220, 'Arrendamientos', 5, 1, 1, '2023-02-21 09:43:52'),
(1898, 522005, 'Terrenos', 5, 1, 1, '2023-02-21 09:43:52'),
(1899, 522010, 'Construcciones y edificaciones', 5, 1, 1, '2023-02-21 09:43:52'),
(1900, 522015, 'Maquinaria y equipo', 5, 1, 1, '2023-02-21 09:43:52'),
(1901, 522020, 'Equipo de oficina', 5, 1, 1, '2023-02-21 09:43:52'),
(1902, 522025, 'Equipo de computación y comunicación', 5, 1, 1, '2023-02-21 09:43:52'),
(1903, 522030, 'Equipo médico-científico', 5, 1, 1, '2023-02-21 09:43:52'),
(1904, 522035, 'Equipo de hoteles y restaurantes', 5, 1, 1, '2023-02-21 09:43:52'),
(1905, 522040, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:52'),
(1906, 522045, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:52'),
(1907, 522050, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:52'),
(1908, 522055, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:52'),
(1909, 522060, 'Acueductos, plantas y redes', 5, 1, 1, '2023-02-21 09:43:52'),
(1910, 522065, 'Aeródromos', 5, 1, 1, '2023-02-21 09:43:52'),
(1911, 522070, 'Semovientes', 5, 1, 1, '2023-02-21 09:43:53'),
(1912, 522095, 'Otros', 5, 1, 1, '2023-02-21 09:43:53'),
(1913, 522099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:53'),
(1914, 5225, 'Contribuciones y afiliaciones', 5, 1, 1, '2023-02-21 09:43:53'),
(1915, 522505, 'Contribuciones', 5, 1, 1, '2023-02-21 09:43:53'),
(1916, 522510, 'Afiliaciones y sostenimiento', 5, 1, 1, '2023-02-21 09:43:53'),
(1917, 522599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:53'),
(1918, 5230, 'Seguros', 5, 1, 1, '2023-02-21 09:43:53'),
(1919, 523005, 'Manejo', 5, 1, 1, '2023-02-21 09:43:53'),
(1920, 523010, 'Cumplimiento', 5, 1, 1, '2023-02-21 09:43:53'),
(1921, 523015, 'Corriente débil', 5, 1, 1, '2023-02-21 09:43:53'),
(1922, 523020, 'Vida colectiva', 5, 1, 1, '2023-02-21 09:43:53'),
(1923, 523025, 'Incendio', 5, 1, 1, '2023-02-21 09:43:53'),
(1924, 523030, 'Terremoto', 5, 1, 1, '2023-02-21 09:43:53'),
(1925, 523035, 'Sustracción y hurto', 5, 1, 1, '2023-02-21 09:43:53'),
(1926, 523040, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:53'),
(1927, 523045, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:53'),
(1928, 523050, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:53'),
(1929, 523055, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:53'),
(1930, 523060, 'Responsabilidad civil y extracontractual', 5, 1, 1, '2023-02-21 09:43:53'),
(1931, 523065, 'Vuelo', 5, 1, 1, '2023-02-21 09:43:53'),
(1932, 523070, 'Rotura de maquinaria', 5, 1, 1, '2023-02-21 09:43:53'),
(1933, 523075, 'Obligatorio accidente de tránsito', 5, 1, 1, '2023-02-21 09:43:53'),
(1934, 523080, 'Lucro cesante', 5, 1, 1, '2023-02-21 09:43:53'),
(1935, 523095, 'Otros', 5, 1, 1, '2023-02-21 09:43:53'),
(1936, 523099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:53'),
(1937, 5235, 'Servicios', 5, 1, 1, '2023-02-21 09:43:53'),
(1938, 523505, 'Aseo y vigilancia', 5, 1, 1, '2023-02-21 09:43:53'),
(1939, 523510, 'Temporales', 5, 1, 1, '2023-02-21 09:43:54'),
(1940, 523515, 'Asistencia técnica', 5, 1, 1, '2023-02-21 09:43:54'),
(1941, 523520, 'Procesamiento electrónico de datos', 5, 1, 1, '2023-02-21 09:43:54'),
(1942, 523525, 'Acueducto y alcantarillado', 5, 1, 1, '2023-02-21 09:43:54'),
(1943, 523530, 'Energía eléctrica', 5, 1, 1, '2023-02-21 09:43:54'),
(1944, 523535, 'Teléfono', 5, 1, 1, '2023-02-21 09:43:54'),
(1945, 523540, 'Correo, portes y telegramas', 5, 1, 1, '2023-02-21 09:43:54'),
(1946, 523545, 'Fax y télex', 5, 1, 1, '2023-02-21 09:43:54'),
(1947, 523550, 'Transporte, fletes y acarreos', 5, 1, 1, '2023-02-21 09:43:54'),
(1948, 523555, 'Gas', 5, 1, 1, '2023-02-21 09:43:54'),
(1949, 523560, 'Publicidad, propaganda y promoción', 5, 1, 1, '2023-02-21 09:43:54'),
(1950, 523595, 'Otros', 5, 1, 1, '2023-02-21 09:43:54'),
(1951, 523599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:54'),
(1952, 5240, 'Gastos legales', 5, 1, 1, '2023-02-21 09:43:54'),
(1953, 524005, 'Notariales', 5, 1, 1, '2023-02-21 09:43:54'),
(1954, 524010, 'Registro mercantil', 5, 1, 1, '2023-02-21 09:43:54'),
(1955, 524015, 'Trámites y licencias', 5, 1, 1, '2023-02-21 09:43:54'),
(1956, 524020, 'Aduaneros', 5, 1, 1, '2023-02-21 09:43:54'),
(1957, 524025, 'Consulares', 5, 1, 1, '2023-02-21 09:43:54'),
(1958, 524095, 'Otros', 5, 1, 1, '2023-02-21 09:43:55'),
(1959, 524099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:55'),
(1960, 5245, 'Mantenimiento y reparaciones', 5, 1, 1, '2023-02-21 09:43:55'),
(1961, 524505, 'Terrenos', 5, 1, 1, '2023-02-21 09:43:55'),
(1962, 524510, 'Construcciones y edificaciones', 5, 1, 1, '2023-02-21 09:43:55'),
(1963, 524515, 'Maquinaria y equipo', 5, 1, 1, '2023-02-21 09:43:55'),
(1964, 524520, 'Equipo de oficina', 5, 1, 1, '2023-02-21 09:43:55'),
(1965, 524525, 'Equipo de computación y comunicación', 5, 1, 1, '2023-02-21 09:43:55'),
(1966, 524530, 'Equipo médico-científico', 5, 1, 1, '2023-02-21 09:43:55'),
(1967, 524535, 'Equipo de hoteles y restaurantes', 5, 1, 1, '2023-02-21 09:43:55'),
(1968, 524540, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:55'),
(1969, 524545, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:55'),
(1970, 524550, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:55'),
(1971, 524555, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:55'),
(1972, 524560, 'Acueductos, plantas y redes', 5, 1, 1, '2023-02-21 09:43:55'),
(1973, 524565, 'Armamento de vigilancia', 5, 1, 1, '2023-02-21 09:43:55'),
(1974, 524570, 'Vías de comunicación', 5, 1, 1, '2023-02-21 09:43:55'),
(1975, 524599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:55'),
(1976, 5250, 'Adecuación e instalación', 5, 1, 1, '2023-02-21 09:43:55'),
(1977, 525005, 'Instalaciones eléctricas', 5, 1, 1, '2023-02-21 09:43:55'),
(1978, 525010, 'Arreglos ornamentales', 5, 1, 1, '2023-02-21 09:43:55'),
(1979, 525015, 'Reparaciones locativas', 5, 1, 1, '2023-02-21 09:43:55'),
(1980, 525095, 'Otros', 5, 1, 1, '2023-02-21 09:43:55'),
(1981, 525099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:56'),
(1982, 5255, 'Gastos de viaje', 5, 1, 1, '2023-02-21 09:43:56'),
(1983, 525505, 'Alojamiento y manutención', 5, 1, 1, '2023-02-21 09:43:56'),
(1984, 525510, 'Pasajes fluviales y/o marítimos', 5, 1, 1, '2023-02-21 09:43:56'),
(1985, 525515, 'Pasajes aéreos', 5, 1, 1, '2023-02-21 09:43:56'),
(1986, 525520, 'Pasajes terrestres', 5, 1, 1, '2023-02-21 09:43:56'),
(1987, 525525, 'Pasajes férreos', 5, 1, 1, '2023-02-21 09:43:56'),
(1988, 525595, 'Otros', 5, 1, 1, '2023-02-21 09:43:56'),
(1989, 525599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:56'),
(1990, 5260, 'Depreciaciones', 5, 1, 1, '2023-02-21 09:43:56'),
(1991, 526005, 'Construcciones y edificaciones', 5, 1, 1, '2023-02-21 09:43:56'),
(1992, 526010, 'Maquinaria y equipo', 5, 1, 1, '2023-02-21 09:43:56'),
(1993, 526015, 'Equipo de oficina', 5, 1, 1, '2023-02-21 09:43:56'),
(1994, 526020, 'Equipo de computación y comunicación', 5, 1, 1, '2023-02-21 09:43:56'),
(1995, 526025, 'Equipo médico-científico', 5, 1, 1, '2023-02-21 09:43:56'),
(1996, 526030, 'Equipo de hoteles y restaurantes', 5, 1, 1, '2023-02-21 09:43:56'),
(1997, 526035, 'Flota y equipo de transporte', 5, 1, 1, '2023-02-21 09:43:57'),
(1998, 526040, 'Flota y equipo fluvial y/o marítimo', 5, 1, 1, '2023-02-21 09:43:57'),
(1999, 526045, 'Flota y equipo aéreo', 5, 1, 1, '2023-02-21 09:43:57'),
(2000, 526050, 'Flota y equipo férreo', 5, 1, 1, '2023-02-21 09:43:57'),
(2001, 526055, 'Acueductos, plantas y redes', 5, 1, 1, '2023-02-21 09:43:57'),
(2002, 526060, 'Armamento de vigilancia', 5, 1, 1, '2023-02-21 09:43:57'),
(2003, 526065, 'Envases y empaques', 5, 1, 1, '2023-02-21 09:43:57'),
(2004, 526099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:57'),
(2005, 5265, 'Amortizaciones', 5, 1, 1, '2023-02-21 09:43:57'),
(2006, 526505, 'Vías de comunicación', 5, 1, 1, '2023-02-21 09:43:57'),
(2007, 526510, 'Intangibles', 5, 1, 1, '2023-02-21 09:43:57'),
(2008, 526515, 'Cargos diferidos', 5, 1, 1, '2023-02-21 09:43:57'),
(2009, 526595, 'Otras', 5, 1, 1, '2023-02-21 09:43:57'),
(2010, 526599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:57'),
(2011, 5270, 'Financieros-reajuste del sistema', 5, 1, 1, '2023-02-21 09:43:57'),
(2012, 527099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:57'),
(2013, 5275, 'Pérdidas método de participación', 5, 1, 1, '2023-02-21 09:43:58'),
(2014, 527505, 'De sociedades anónimas y/o asimiladas', 5, 1, 1, '2023-02-21 09:43:58'),
(2015, 527510, 'De sociedades limitadas y/o asimiladas', 5, 1, 1, '2023-02-21 09:43:58'),
(2016, 5295, 'Diversos', 5, 1, 1, '2023-02-21 09:43:58'),
(2017, 529505, 'Comisiones', 5, 1, 1, '2023-02-21 09:43:58'),
(2018, 529510, 'Libros, suscripciones, periódicos y revistas', 5, 1, 1, '2023-02-21 09:43:58'),
(2019, 529515, 'Música ambiental', 5, 1, 1, '2023-02-21 09:43:58'),
(2020, 529520, 'Gastos de representación y relaciones públicas', 5, 1, 1, '2023-02-21 09:43:58'),
(2021, 529525, 'Elementos de aseo y cafetería', 5, 1, 1, '2023-02-21 09:43:58'),
(2022, 529530, 'Útiles, papelería y fotocopias', 5, 1, 1, '2023-02-21 09:43:58'),
(2023, 529535, 'Combustibles y lubricantes', 5, 1, 1, '2023-02-21 09:43:58'),
(2024, 529540, 'Envases y empaques', 5, 1, 1, '2023-02-21 09:43:58'),
(2025, 529545, 'Taxis y buses', 5, 1, 1, '2023-02-21 09:43:58'),
(2026, 529550, 'Estampillas', 5, 1, 1, '2023-02-21 09:43:58'),
(2027, 529555, 'Microfilmación', 5, 1, 1, '2023-02-21 09:43:58'),
(2028, 529560, 'Casino y restaurante', 5, 1, 1, '2023-02-21 09:43:58'),
(2029, 529565, 'Parqueaderos', 5, 1, 1, '2023-02-21 09:43:58'),
(2030, 529570, 'Indemnización por daños a terceros', 5, 1, 1, '2023-02-21 09:43:58'),
(2031, 529575, 'Pólvora y similares', 5, 1, 1, '2023-02-21 09:43:59'),
(2032, 529595, 'Otros', 5, 1, 1, '2023-02-21 09:43:59'),
(2033, 529599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:59'),
(2034, 5299, 'Provisiones', 5, 1, 1, '2023-02-21 09:43:59'),
(2035, 529905, 'Inversiones', 5, 1, 1, '2023-02-21 09:43:59'),
(2036, 529910, 'Deudores', 5, 1, 1, '2023-02-21 09:43:59'),
(2037, 529915, 'Inventarios', 5, 1, 1, '2023-02-21 09:43:59'),
(2038, 529920, 'Propiedades, planta y equipo', 5, 1, 1, '2023-02-21 09:43:59'),
(2039, 529995, 'Otros activos', 5, 1, 1, '2023-02-21 09:43:59'),
(2040, 529999, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:59'),
(2041, 53, 'No operacionales', 5, 1, 1, '2023-02-21 09:43:59'),
(2042, 5305, 'Financieros', 5, 1, 1, '2023-02-21 09:43:59'),
(2043, 530505, 'Gastos bancarios', 5, 1, 1, '2023-02-21 09:43:59'),
(2044, 530510, 'Reajuste monetario-UPAC (hoy UVR)', 5, 1, 1, '2023-02-21 09:43:59'),
(2045, 530515, 'Comisiones', 5, 1, 1, '2023-02-21 09:43:59'),
(2046, 530520, 'Intereses', 5, 1, 1, '2023-02-21 09:43:59'),
(2047, 530525, 'Diferencia en cambio', 5, 1, 1, '2023-02-21 09:43:59'),
(2048, 530530, 'Gastos en negociación certificados de cambio', 5, 1, 1, '2023-02-21 09:43:59'),
(2049, 530535, 'Descuentos comerciales condicionados', 5, 1, 1, '2023-02-21 09:43:59'),
(2050, 530540, 'Gastos manejo y emisión de bonos', 5, 1, 1, '2023-02-21 09:43:59'),
(2051, 530545, 'Prima amortizada', 5, 1, 1, '2023-02-21 09:43:59'),
(2052, 530595, 'Otros', 5, 1, 1, '2023-02-21 09:43:59'),
(2053, 530599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:43:59'),
(2054, 5310, 'Pérdida en venta y retiro de bienes', 5, 1, 1, '2023-02-21 09:43:59'),
(2055, 531005, 'Venta de inversiones', 5, 1, 1, '2023-02-21 09:43:59'),
(2056, 531010, 'Venta de cartera', 5, 1, 1, '2023-02-21 09:43:59'),
(2057, 531015, 'Venta de propiedades, planta y equipo', 5, 1, 1, '2023-02-21 09:43:59'),
(2058, 531020, 'Venta de intangibles', 5, 1, 1, '2023-02-21 09:43:59'),
(2059, 531025, 'Venta de otros activos', 5, 1, 1, '2023-02-21 09:43:59'),
(2060, 531030, 'Retiro de propiedades, planta y equipo', 5, 1, 1, '2023-02-21 09:44:00'),
(2061, 531035, 'Retiro de otros activos', 5, 1, 1, '2023-02-21 09:44:00'),
(2062, 531040, 'Pérdidas por siniestros', 5, 1, 1, '2023-02-21 09:44:00'),
(2063, 531095, 'Otros', 5, 1, 1, '2023-02-21 09:44:00'),
(2064, 531099, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:44:00'),
(2065, 5313, 'Pérdidas método de participación', 5, 1, 1, '2023-02-21 09:44:00'),
(2066, 531305, 'De sociedades anónimas y/o asimiladas', 5, 1, 1, '2023-02-21 09:44:00'),
(2067, 531310, 'De sociedades limitadas y/o asimiladas', 5, 1, 1, '2023-02-21 09:44:00'),
(2068, 5315, 'Gastos extraordinarios', 5, 1, 1, '2023-02-21 09:44:00'),
(2069, 531505, 'Costas y procesos judiciales', 5, 1, 1, '2023-02-21 09:44:00'),
(2070, 531510, 'Actividades culturales y cívicas', 5, 1, 1, '2023-02-21 09:44:00'),
(2071, 531515, 'Costos y gastos de ejercicios anteriores', 5, 1, 1, '2023-02-21 09:44:00'),
(2072, 531520, 'Impuestos asumidos', 5, 1, 1, '2023-02-21 09:44:00'),
(2073, 531595, 'Otros', 5, 1, 1, '2023-02-21 09:44:00'),
(2074, 531599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:44:00'),
(2075, 5395, 'Gastos diversos', 5, 1, 1, '2023-02-21 09:44:00'),
(2076, 539505, 'Demandas laborales', 5, 1, 1, '2023-02-21 09:44:00'),
(2077, 539510, 'Demandas por incumplimiento de contratos', 5, 1, 1, '2023-02-21 09:44:00');
INSERT INTO `pucs` (`id`, `code`, `nombre`, `parent_id`, `status`, `created_by`, `created_at`) VALUES
(2078, 539515, 'Indemnizaciones', 5, 1, 1, '2023-02-21 09:44:00'),
(2079, 539520, 'Multas, sanciones y litigios', 5, 1, 1, '2023-02-21 09:44:00'),
(2080, 539525, 'Donaciones', 5, 1, 1, '2023-02-21 09:44:00'),
(2081, 539530, 'Constitución de garantías', 5, 1, 1, '2023-02-21 09:44:00'),
(2082, 539535, 'Amortización de bienes entregados en comodato', 5, 1, 1, '2023-02-21 09:44:00'),
(2083, 539595, 'Otros', 5, 1, 1, '2023-02-21 09:44:00'),
(2084, 539599, 'Ajustes por inflación', 5, 1, 1, '2023-02-21 09:44:00'),
(2085, 54, 'Impuesto de renta y complementarios', 5, 1, 1, '2023-02-21 09:44:00'),
(2086, 5405, 'Impuesto de renta y complementarios', 5, 1, 1, '2023-02-21 09:44:00'),
(2087, 540505, 'Impuesto de renta y complementarios', 5, 1, 1, '2023-02-21 09:44:00'),
(2088, 59, 'Ganancias y pérdidas', 5, 1, 1, '2023-02-21 09:44:01'),
(2089, 5905, 'Ganancias y pérdidas', 5, 1, 1, '2023-02-21 09:44:01'),
(2090, 590505, 'Ganancias y pérdidas', 5, 1, 1, '2023-02-21 09:44:01'),
(2092, 61, 'Costo de ventas y de prestación de servicios', 6, 1, 1, '2023-02-21 09:45:26'),
(2093, 6105, 'Agricultura, ganadería, caza y silvicultura', 6, 1, 1, '2023-02-21 09:45:26'),
(2094, 610505, 'Cultivo de cereales', 6, 1, 1, '2023-02-21 09:45:26'),
(2095, 610510, 'Cultivos de hortalizas, legumbres y plantas ornamentales', 6, 1, 1, '2023-02-21 09:45:26'),
(2096, 610515, 'Cultivos de frutas, nueces y plantas aromáticas', 6, 1, 1, '2023-02-21 09:45:26'),
(2097, 610520, 'Cultivo de café', 6, 1, 1, '2023-02-21 09:45:26'),
(2098, 610525, 'Cultivo de flores', 6, 1, 1, '2023-02-21 09:45:26'),
(2099, 610530, 'Cultivo de caña de azúcar', 6, 1, 1, '2023-02-21 09:45:27'),
(2100, 610535, 'Cultivo de algodón y plantas para material textil', 6, 1, 1, '2023-02-21 09:45:27'),
(2101, 610540, 'Cultivo de banano', 6, 1, 1, '2023-02-21 09:45:27'),
(2102, 610545, 'Otros cultivos agrícolas', 6, 1, 1, '2023-02-21 09:45:27'),
(2103, 610550, 'Cría de ovejas, cabras, asnos, mulas y burdéganos', 6, 1, 1, '2023-02-21 09:45:27'),
(2104, 610555, 'Cría de ganado caballar y vacuno', 6, 1, 1, '2023-02-21 09:45:27'),
(2105, 610560, 'Producción avícola', 6, 1, 1, '2023-02-21 09:45:27'),
(2106, 610565, 'Cría de otros animales', 6, 1, 1, '2023-02-21 09:45:27'),
(2107, 610570, 'Servicios agrícolas y ganaderos', 6, 1, 1, '2023-02-21 09:45:27'),
(2108, 610575, 'Actividad de caza', 6, 1, 1, '2023-02-21 09:45:27'),
(2109, 610580, 'Actividad de silvicultura', 6, 1, 1, '2023-02-21 09:45:27'),
(2110, 610595, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:27'),
(2111, 610599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:27'),
(2112, 6110, 'Pesca', 6, 1, 1, '2023-02-21 09:45:27'),
(2113, 611005, 'Actividad de pesca', 6, 1, 1, '2023-02-21 09:45:27'),
(2114, 611010, 'Explotación de criaderos de peces', 6, 1, 1, '2023-02-21 09:45:27'),
(2115, 611095, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:27'),
(2116, 611099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:27'),
(2117, 6115, 'Explotación de minas y canteras', 6, 1, 1, '2023-02-21 09:45:27'),
(2118, 611505, 'Carbón', 6, 1, 1, '2023-02-21 09:45:27'),
(2119, 611510, 'Petróleo crudo', 6, 1, 1, '2023-02-21 09:45:27'),
(2120, 611512, 'Gas natural', 6, 1, 1, '2023-02-21 09:45:27'),
(2121, 611514, 'Servicios relacionados con extracción de petróleo y gas', 6, 1, 1, '2023-02-21 09:45:27'),
(2122, 611515, 'Minerales de hierro', 6, 1, 1, '2023-02-21 09:45:27'),
(2123, 611520, 'Minerales metalíferos no ferrosos', 6, 1, 1, '2023-02-21 09:45:27'),
(2124, 611525, 'Piedra, arena y arcilla', 6, 1, 1, '2023-02-21 09:45:27'),
(2125, 611527, 'Piedras preciosas', 6, 1, 1, '2023-02-21 09:45:28'),
(2126, 611528, 'Oro', 6, 1, 1, '2023-02-21 09:45:28'),
(2127, 611530, 'Otras minas y canteras', 6, 1, 1, '2023-02-21 09:45:28'),
(2128, 611532, 'Prestación de servicios sector minero', 6, 1, 1, '2023-02-21 09:45:28'),
(2129, 611595, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:28'),
(2130, 611599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:28'),
(2131, 6120, 'Industrias manufactureras', 6, 1, 1, '2023-02-21 09:45:28'),
(2132, 612001, 'Producción y procesamiento de carnes y productos cárnicos', 6, 1, 1, '2023-02-21 09:45:28'),
(2133, 612002, 'Productos de pescado', 6, 1, 1, '2023-02-21 09:45:28'),
(2134, 612003, 'Productos de frutas, legumbres y hortalizas', 6, 1, 1, '2023-02-21 09:45:28'),
(2135, 612004, 'Elaboración de aceites y grasas', 6, 1, 1, '2023-02-21 09:45:28'),
(2136, 612005, 'Elaboración de productos lácteos', 6, 1, 1, '2023-02-21 09:45:28'),
(2137, 612006, 'Elaboración de productos de molinería', 6, 1, 1, '2023-02-21 09:45:28'),
(2138, 612007, 'Elaboración de almidones y derivados', 6, 1, 1, '2023-02-21 09:45:28'),
(2139, 612008, 'Elaboración de alimentos para animales', 6, 1, 1, '2023-02-21 09:45:28'),
(2140, 612009, 'Elaboración de productos para panadería', 6, 1, 1, '2023-02-21 09:45:28'),
(2141, 612010, 'Elaboración de azúcar y melazas', 6, 1, 1, '2023-02-21 09:45:28'),
(2142, 612011, 'Elaboración de cacao, chocolate y confitería', 6, 1, 1, '2023-02-21 09:45:28'),
(2143, 612012, 'Elaboración de pastas y productos farináceos', 6, 1, 1, '2023-02-21 09:45:28'),
(2144, 612013, 'Elaboración de productos de café', 6, 1, 1, '2023-02-21 09:45:28'),
(2145, 612014, 'Elaboración de otros productos alimenticios', 6, 1, 1, '2023-02-21 09:45:28'),
(2146, 612015, 'Elaboración de bebidas alcohólicas y alcohol etílico', 6, 1, 1, '2023-02-21 09:45:29'),
(2147, 612016, 'Elaboración de vinos', 6, 1, 1, '2023-02-21 09:45:29'),
(2148, 612017, 'Elaboración de bebidas malteadas y de malta', 6, 1, 1, '2023-02-21 09:45:29'),
(2149, 612018, 'Elaboración de bebidas no alcohólicas', 6, 1, 1, '2023-02-21 09:45:29'),
(2150, 612019, 'Elaboración de productos de tabaco', 6, 1, 1, '2023-02-21 09:45:29'),
(2151, 612020, 'Preparación e hilatura de fibras textiles y tejeduría', 6, 1, 1, '2023-02-21 09:45:29'),
(2152, 612021, 'Acabado de productos textiles', 6, 1, 1, '2023-02-21 09:45:29'),
(2153, 612022, 'Elaboración de artículos de materiales textiles', 6, 1, 1, '2023-02-21 09:45:29'),
(2154, 612023, 'Elaboración de tapices y alfombras', 6, 1, 1, '2023-02-21 09:45:29'),
(2155, 612024, 'Elaboración de cuerdas, cordeles, bramantes y redes', 6, 1, 1, '2023-02-21 09:45:29'),
(2156, 612025, 'Elaboración de otros productos textiles', 6, 1, 1, '2023-02-21 09:45:29'),
(2157, 612026, 'Elaboración de tejidos', 6, 1, 1, '2023-02-21 09:45:29'),
(2158, 612027, 'Elaboración de prendas de vestir', 6, 1, 1, '2023-02-21 09:45:29'),
(2159, 612028, 'Preparación, adobo y teñido de pieles', 6, 1, 1, '2023-02-21 09:45:29'),
(2160, 612029, 'Curtido, adobo o preparación de cuero', 6, 1, 1, '2023-02-21 09:45:29'),
(2161, 612030, 'Elaboración de maletas, bolsos y similares', 6, 1, 1, '2023-02-21 09:45:29'),
(2162, 612031, 'Elaboración de calzado', 6, 1, 1, '2023-02-21 09:45:29'),
(2163, 612032, 'Producción de madera, artículos de madera y corcho', 6, 1, 1, '2023-02-21 09:45:29'),
(2164, 612033, 'Elaboración de pasta y productos de madera, papel y cartón', 6, 1, 1, '2023-02-21 09:45:29'),
(2165, 612034, 'Ediciones y publicaciones', 6, 1, 1, '2023-02-21 09:45:29'),
(2166, 612035, 'Impresión', 6, 1, 1, '2023-02-21 09:45:29'),
(2167, 612036, 'Servicios relacionados con la edición y la impresión', 6, 1, 1, '2023-02-21 09:45:29'),
(2168, 612037, 'Reproducción de grabaciones', 6, 1, 1, '2023-02-21 09:45:29'),
(2169, 612038, 'Elaboración de productos de horno de coque', 6, 1, 1, '2023-02-21 09:45:29'),
(2170, 612039, 'Elaboración de productos de la refinación de petróleo', 6, 1, 1, '2023-02-21 09:45:29'),
(2171, 612040, 'Elaboración de sustancias químicas básicas', 6, 1, 1, '2023-02-21 09:45:29'),
(2172, 612041, 'Elaboración de abonos y compuestos de nitrógeno', 6, 1, 1, '2023-02-21 09:45:29'),
(2173, 612042, 'Elaboración de plástico y caucho sintético', 6, 1, 1, '2023-02-21 09:45:30'),
(2174, 612043, 'Elaboración de productos químicos de uso agropecuario', 6, 1, 1, '2023-02-21 09:45:30'),
(2175, 612044, 'Elaboración de pinturas, tintas y masillas', 6, 1, 1, '2023-02-21 09:45:30'),
(2176, 612045, 'Elaboración de productos farmacéuticos y botánicos', 6, 1, 1, '2023-02-21 09:45:30'),
(2177, 612046, 'Elaboración de jabones, detergentes y preparados de tocador', 6, 1, 1, '2023-02-21 09:45:30'),
(2178, 612047, 'Elaboración de otros productos químicos', 6, 1, 1, '2023-02-21 09:45:30'),
(2179, 612048, 'Elaboración de fibras', 6, 1, 1, '2023-02-21 09:45:30'),
(2180, 612049, 'Elaboración de otros productos de caucho', 6, 1, 1, '2023-02-21 09:45:30'),
(2181, 612050, 'Elaboración de productos de plástico', 6, 1, 1, '2023-02-21 09:45:30'),
(2182, 612051, 'Elaboración de vidrio y productos de vidrio', 6, 1, 1, '2023-02-21 09:45:30'),
(2183, 612052, 'Elaboración de productos de cerámica, loza, piedra, arcilla y porcelana', 6, 1, 1, '2023-02-21 09:45:30'),
(2184, 612053, 'Elaboración de cemento, cal y yeso', 6, 1, 1, '2023-02-21 09:45:30'),
(2185, 612054, 'Elaboración de artículos de hormigón, cemento y yeso', 6, 1, 1, '2023-02-21 09:45:30'),
(2186, 612055, 'Corte, tallado y acabado de la piedra', 6, 1, 1, '2023-02-21 09:45:31'),
(2187, 612056, 'Elaboración de otros productos minerales no metálicos', 6, 1, 1, '2023-02-21 09:45:31'),
(2188, 612057, 'Industrias básicas y fundición de hierro y acero', 6, 1, 1, '2023-02-21 09:45:31'),
(2189, 612058, 'Productos primarios de metales preciosos y de metales no ferrosos', 6, 1, 1, '2023-02-21 09:45:31'),
(2190, 612059, 'Fundición de metales no ferrosos', 6, 1, 1, '2023-02-21 09:45:31'),
(2191, 612060, 'Fabricación de productos metálicos para uso estructural', 6, 1, 1, '2023-02-21 09:45:31'),
(2192, 612061, 'Forja, prensado, estampado, laminado de metal y pulvimetalurgia', 6, 1, 1, '2023-02-21 09:45:31'),
(2193, 612062, 'Revestimiento de metales y obras de ingeniería mecánica', 6, 1, 1, '2023-02-21 09:45:31'),
(2194, 612063, 'Fabricación de artículos de ferretería', 6, 1, 1, '2023-02-21 09:45:31'),
(2195, 612064, 'Elaboración de otros productos de metal', 6, 1, 1, '2023-02-21 09:45:31'),
(2196, 612065, 'Fabricación de maquinaria y equipo', 6, 1, 1, '2023-02-21 09:45:31'),
(2197, 612066, 'Fabricación de equipos de elevación y manipulación', 6, 1, 1, '2023-02-21 09:45:31'),
(2198, 612067, 'Elaboración de aparatos de uso doméstico', 6, 1, 1, '2023-02-21 09:45:31'),
(2199, 612068, 'Elaboración de equipo de oficina', 6, 1, 1, '2023-02-21 09:45:31'),
(2200, 612069, 'Elaboración de pilas y baterías primarias', 6, 1, 1, '2023-02-21 09:45:31'),
(2201, 612070, 'Elaboración de equipo de iluminación', 6, 1, 1, '2023-02-21 09:45:31'),
(2202, 612071, 'Elaboración de otros tipos de equipo eléctrico', 6, 1, 1, '2023-02-21 09:45:32'),
(2203, 612072, 'Fabricación de equipos de radio, televisión y comunicaciones', 6, 1, 1, '2023-02-21 09:45:32'),
(2204, 612073, 'Fabricación de aparatos e instrumentos médicos', 6, 1, 1, '2023-02-21 09:45:32'),
(2205, 612074, 'Fabricación de instrumentos de medición y control', 6, 1, 1, '2023-02-21 09:45:32'),
(2206, 612075, 'Fabricación de instrumentos de óptica y equipo fotográfico', 6, 1, 1, '2023-02-21 09:45:32'),
(2207, 612076, 'Fabricación de relojes', 6, 1, 1, '2023-02-21 09:45:32'),
(2208, 612077, 'Fabricación de vehículos automotores', 6, 1, 1, '2023-02-21 09:45:32'),
(2209, 612078, 'Fabricación de carrocerías para automotores', 6, 1, 1, '2023-02-21 09:45:32'),
(2210, 612079, 'Fabricación de partes, piezas y accesorios para automotores', 6, 1, 1, '2023-02-21 09:45:32'),
(2211, 612080, 'Fabricación y reparación de buques y otras embarcaciones', 6, 1, 1, '2023-02-21 09:45:32'),
(2212, 612081, 'Fabricación de locomotoras y material rodante para ferrocarriles', 6, 1, 1, '2023-02-21 09:45:32'),
(2213, 612082, 'Fabricación de aeronaves', 6, 1, 1, '2023-02-21 09:45:32'),
(2214, 612083, 'Fabricación de motocicletas', 6, 1, 1, '2023-02-21 09:45:32'),
(2215, 612084, 'Fabricación de bicicletas y sillas de ruedas', 6, 1, 1, '2023-02-21 09:45:32'),
(2216, 612085, 'Fabricación de otros tipos de transporte', 6, 1, 1, '2023-02-21 09:45:33'),
(2217, 612086, 'Fabricación de muebles', 6, 1, 1, '2023-02-21 09:45:33'),
(2218, 612087, 'Fabricación de joyas y artículos conexos', 6, 1, 1, '2023-02-21 09:45:33'),
(2219, 612088, 'Fabricación de instrumentos de música', 6, 1, 1, '2023-02-21 09:45:33'),
(2220, 612089, 'Fabricación de artículos y equipo para deporte', 6, 1, 1, '2023-02-21 09:45:33'),
(2221, 612090, 'Fabricación de juegos y juguetes', 6, 1, 1, '2023-02-21 09:45:33'),
(2222, 612091, 'Reciclamiento de desperdicios', 6, 1, 1, '2023-02-21 09:45:33'),
(2223, 612095, 'Productos de otras industrias manufactureras', 6, 1, 1, '2023-02-21 09:45:33'),
(2224, 612099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:33'),
(2225, 6125, 'Suministro de electricidad, gas y agua', 6, 1, 1, '2023-02-21 09:45:33'),
(2226, 612505, 'Generación, captación y distribución de energía eléctrica', 6, 1, 1, '2023-02-21 09:45:33'),
(2227, 612510, 'Fabricación de gas y distribución de combustibles gaseosos', 6, 1, 1, '2023-02-21 09:45:33'),
(2228, 612515, 'Captación, depuración y distribución de agua', 6, 1, 1, '2023-02-21 09:45:33'),
(2229, 612595, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:33'),
(2230, 612599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:33'),
(2231, 6130, 'Construcción', 6, 1, 1, '2023-02-21 09:45:33'),
(2232, 613005, 'Preparación de terrenos', 6, 1, 1, '2023-02-21 09:45:33'),
(2233, 613010, 'Construcción de edificios y obras de ingeniería civil', 6, 1, 1, '2023-02-21 09:45:33'),
(2234, 613015, 'Acondicionamiento de edificios', 6, 1, 1, '2023-02-21 09:45:33'),
(2235, 613020, 'Terminación de edificaciones', 6, 1, 1, '2023-02-21 09:45:33'),
(2236, 613025, 'Alquiler de equipo con operario', 6, 1, 1, '2023-02-21 09:45:34'),
(2237, 613095, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:34'),
(2238, 613099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:34'),
(2239, 6135, 'Comercio al por mayor y al por menor', 6, 1, 1, '2023-02-21 09:45:34'),
(2240, 613502, 'Venta de vehículos automotores', 6, 1, 1, '2023-02-21 09:45:34'),
(2241, 613504, 'Mantenimiento, reparación y lavado de vehículos automotores', 6, 1, 1, '2023-02-21 09:45:34'),
(2242, 613506, 'Venta de partes, piezas y accesorios de vehículos automotores', 6, 1, 1, '2023-02-21 09:45:34'),
(2243, 613508, 'Venta de combustibles sólidos, líquidos, gaseosos', 6, 1, 1, '2023-02-21 09:45:34'),
(2244, 613510, 'Venta de lubricantes, aditivos, llantas y lujos para automotores', 6, 1, 1, '2023-02-21 09:45:34'),
(2245, 613512, 'Venta a cambio de retribución o por contrata', 6, 1, 1, '2023-02-21 09:45:34'),
(2246, 613514, 'Venta de insumos, materias primas agropecuarias y flores', 6, 1, 1, '2023-02-21 09:45:34'),
(2247, 613516, 'Venta de otros insumos y materias primas no agropecuarias', 6, 1, 1, '2023-02-21 09:45:35'),
(2248, 613518, 'Venta de animales vivos y cueros', 6, 1, 1, '2023-02-21 09:45:35'),
(2249, 613520, 'Venta de productos en almacenes no especializados', 6, 1, 1, '2023-02-21 09:45:35'),
(2250, 613522, 'Venta de productos agropecuarios', 6, 1, 1, '2023-02-21 09:45:35'),
(2251, 613524, 'Venta de productos textiles, de vestir, de cuero y calzado', 6, 1, 1, '2023-02-21 09:45:35'),
(2252, 613526, 'Venta de papel y cartón', 6, 1, 1, '2023-02-21 09:45:35'),
(2253, 613528, 'Venta de libros, revistas, elementos de papelería, útiles y textos\r\n            escolares', 6, 1, 1, '2023-02-21 09:45:35'),
(2254, 613530, 'Venta de juegos, juguetes y artículos deportivos', 6, 1, 1, '2023-02-21 09:45:35'),
(2255, 613532, 'Venta de instrumentos quirúrgicos y ortopédicos', 6, 1, 1, '2023-02-21 09:45:35'),
(2256, 613534, 'Venta de artículos en relojerías y joyerías', 6, 1, 1, '2023-02-21 09:45:35'),
(2257, 613536, 'Venta de electrodomésticos y muebles', 6, 1, 1, '2023-02-21 09:45:35'),
(2258, 613538, 'Venta de productos de aseo, farmacéuticos, medicinales y artículos de\r\n            tocador', 6, 1, 1, '2023-02-21 09:45:35'),
(2259, 613540, 'Venta de cubiertos, vajillas, cristalería, porcelanas, cerámicas y otros\r\n            artículos de uso doméstico', 6, 1, 1, '2023-02-21 09:45:35'),
(2260, 613542, 'Venta de materiales de construcción, fontanería y calefacción', 6, 1, 1, '2023-02-21 09:45:35'),
(2261, 613544, 'Venta de pinturas y lacas', 6, 1, 1, '2023-02-21 09:45:35'),
(2262, 613546, 'Venta de productos de vidrios y marquetería', 6, 1, 1, '2023-02-21 09:45:35'),
(2263, 613548, 'Venta de herramientas y artículos de ferretería', 6, 1, 1, '2023-02-21 09:45:36'),
(2264, 613550, 'Venta de químicos', 6, 1, 1, '2023-02-21 09:45:36'),
(2265, 613552, 'Venta de productos intermedios, desperdicios y desechos', 6, 1, 1, '2023-02-21 09:45:36'),
(2266, 613554, 'Venta de maquinaria, equipo de oficina y programas de computador', 6, 1, 1, '2023-02-21 09:45:36'),
(2267, 613556, 'Venta de artículos en cacharrerías y misceláneas', 6, 1, 1, '2023-02-21 09:45:36'),
(2268, 613558, 'Venta de instrumentos musicales', 6, 1, 1, '2023-02-21 09:45:36'),
(2269, 613560, 'Venta de artículos en casas de empeño y prenderías', 6, 1, 1, '2023-02-21 09:45:36'),
(2270, 613562, 'Venta de equipo fotográfico', 6, 1, 1, '2023-02-21 09:45:36'),
(2271, 613564, 'Venta de equipo óptico y de precisión', 6, 1, 1, '2023-02-21 09:45:36'),
(2272, 613566, 'Venta de empaques', 6, 1, 1, '2023-02-21 09:45:36'),
(2273, 613568, 'Venta de equipo profesional y científico', 6, 1, 1, '2023-02-21 09:45:36'),
(2274, 613570, 'Venta de loterías, rifas, chance, apuestas y similares', 6, 1, 1, '2023-02-21 09:45:36'),
(2275, 613572, 'Reparación de efectos personales y electrodomésticos', 6, 1, 1, '2023-02-21 09:45:36'),
(2276, 613595, 'Venta de otros productos', 6, 1, 1, '2023-02-21 09:45:36'),
(2277, 613599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:36'),
(2278, 6140, 'Hoteles y restaurantes', 6, 1, 1, '2023-02-21 09:45:36'),
(2279, 614005, 'Hotelería', 6, 1, 1, '2023-02-21 09:45:36'),
(2280, 614010, 'Campamento y otros tipos de hospedaje', 6, 1, 1, '2023-02-21 09:45:36'),
(2281, 614015, 'Restaurantes', 6, 1, 1, '2023-02-21 09:45:36'),
(2282, 614020, 'Bares y cantinas', 6, 1, 1, '2023-02-21 09:45:36'),
(2283, 614095, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:36'),
(2284, 614099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:36'),
(2285, 6145, 'Transporte, almacenamiento y comunicaciones', 6, 1, 1, '2023-02-21 09:45:36'),
(2286, 614505, 'Servicio de transporte por carretera', 6, 1, 1, '2023-02-21 09:45:36'),
(2287, 614510, 'Servicio de transporte por vía férrea', 6, 1, 1, '2023-02-21 09:45:36'),
(2288, 614515, 'Servicio de transporte por vía acuática', 6, 1, 1, '2023-02-21 09:45:36'),
(2289, 614520, 'Servicio de transporte por vía aérea', 6, 1, 1, '2023-02-21 09:45:36'),
(2290, 614525, 'Servicio de transporte por tuberías', 6, 1, 1, '2023-02-21 09:45:37'),
(2291, 614530, 'Manipulación de carga', 6, 1, 1, '2023-02-21 09:45:37'),
(2292, 614535, 'Almacenamiento y depósito', 6, 1, 1, '2023-02-21 09:45:37'),
(2293, 614540, 'Servicios complementarios para el transporte', 6, 1, 1, '2023-02-21 09:45:37'),
(2294, 614545, 'Agencias de viaje', 6, 1, 1, '2023-02-21 09:45:37'),
(2295, 614550, 'Otras agencias de transporte', 6, 1, 1, '2023-02-21 09:45:37'),
(2296, 614555, 'Servicio postal y de correo', 6, 1, 1, '2023-02-21 09:45:37'),
(2297, 614560, 'Servicio telefónico', 6, 1, 1, '2023-02-21 09:45:37'),
(2298, 614565, 'Servicio de telégrafo', 6, 1, 1, '2023-02-21 09:45:37'),
(2299, 614570, 'Servicio de transmisión de datos', 6, 1, 1, '2023-02-21 09:45:37'),
(2300, 614575, 'Servicio de radio y televisión por cable', 6, 1, 1, '2023-02-21 09:45:37'),
(2301, 614580, 'Transmisión de sonido e imágenes por contrato', 6, 1, 1, '2023-02-21 09:45:37'),
(2302, 614595, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:37'),
(2303, 614599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:37'),
(2304, 6150, 'Actividad financiera', 6, 1, 1, '2023-02-21 09:45:37'),
(2305, 615005, 'De inversiones', 6, 1, 1, '2023-02-21 09:45:37'),
(2306, 615010, 'De servicio de bolsa', 6, 1, 1, '2023-02-21 09:45:37'),
(2307, 615099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:37'),
(2308, 6155, 'Actividades inmobiliarias, empresariales y de alquiler', 6, 1, 1, '2023-02-21 09:45:37'),
(2309, 615505, 'Arrendamientos de bienes inmuebles', 6, 1, 1, '2023-02-21 09:45:37'),
(2310, 615510, 'Inmobiliarias por retribución o contrata', 6, 1, 1, '2023-02-21 09:45:37'),
(2311, 615515, 'Alquiler equipo de transporte', 6, 1, 1, '2023-02-21 09:45:37'),
(2312, 615520, 'Alquiler maquinaria y equipo', 6, 1, 1, '2023-02-21 09:45:37'),
(2313, 615525, 'Alquiler de efectos personales y enseres domésticos', 6, 1, 1, '2023-02-21 09:45:37'),
(2314, 615530, 'Consultoría en equipo y programas de informática', 6, 1, 1, '2023-02-21 09:45:37'),
(2315, 615535, 'Procesamiento de datos', 6, 1, 1, '2023-02-21 09:45:37'),
(2316, 615540, 'Mantenimiento y reparación de maquinaria de oficina', 6, 1, 1, '2023-02-21 09:45:38'),
(2317, 615545, 'Investigaciones científicas y de desarrollo', 6, 1, 1, '2023-02-21 09:45:38'),
(2318, 615550, 'Actividades empresariales de consultoría', 6, 1, 1, '2023-02-21 09:45:38'),
(2319, 615555, 'Publicidad', 6, 1, 1, '2023-02-21 09:45:38'),
(2320, 615560, 'Dotación de personal', 6, 1, 1, '2023-02-21 09:45:38'),
(2321, 615565, 'Investigación y seguridad', 6, 1, 1, '2023-02-21 09:45:38'),
(2322, 615570, 'Limpieza de inmuebles', 6, 1, 1, '2023-02-21 09:45:38'),
(2323, 615575, 'Fotografía', 6, 1, 1, '2023-02-21 09:45:38'),
(2324, 615580, 'Envase y empaque', 6, 1, 1, '2023-02-21 09:45:38'),
(2325, 615585, 'Fotocopiado', 6, 1, 1, '2023-02-21 09:45:38'),
(2326, 615590, 'Mantenimiento y reparación de maquinaria y equipo', 6, 1, 1, '2023-02-21 09:45:38'),
(2327, 615595, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:38'),
(2328, 615599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:38'),
(2329, 6160, 'Enseñanza', 6, 1, 1, '2023-02-21 09:45:38'),
(2330, 616005, 'Actividades relacionadas con la educación', 6, 1, 1, '2023-02-21 09:45:38'),
(2331, 616095, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:38'),
(2332, 616099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:38'),
(2333, 6165, 'Servicios sociales y de salud', 6, 1, 1, '2023-02-21 09:45:38'),
(2334, 616505, 'Servicio hospitalario', 6, 1, 1, '2023-02-21 09:45:38'),
(2335, 616510, 'Servicio médico', 6, 1, 1, '2023-02-21 09:45:38'),
(2336, 616515, 'Servicio odontológico', 6, 1, 1, '2023-02-21 09:45:38'),
(2337, 616520, 'Servicio de laboratorio', 6, 1, 1, '2023-02-21 09:45:38'),
(2338, 616525, 'Actividades veterinarias', 6, 1, 1, '2023-02-21 09:45:38'),
(2339, 616530, 'Actividades de servicios sociales', 6, 1, 1, '2023-02-21 09:45:38'),
(2340, 616595, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:38'),
(2341, 616599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:39'),
(2342, 6170, 'Otras actividades de servicios comunitarios, sociales y personales', 6, 1, 1, '2023-02-21 09:45:39'),
(2343, 617005, 'Eliminación de desperdicios y aguas residuales', 6, 1, 1, '2023-02-21 09:45:39'),
(2344, 617010, 'Actividades de asociación', 6, 1, 1, '2023-02-21 09:45:39'),
(2345, 617015, 'Producción y distribución de filmes y videocintas', 6, 1, 1, '2023-02-21 09:45:39'),
(2346, 617020, 'Exhibición de filmes y videocintas', 6, 1, 1, '2023-02-21 09:45:39'),
(2347, 617025, 'Actividad de radio y televisión', 6, 1, 1, '2023-02-21 09:45:39'),
(2348, 617030, 'Actividad teatral, musical y artística', 6, 1, 1, '2023-02-21 09:45:39'),
(2349, 617035, 'Grabación y producción de discos', 6, 1, 1, '2023-02-21 09:45:39'),
(2350, 617040, 'Entretenimiento y esparcimiento', 6, 1, 1, '2023-02-21 09:45:39'),
(2351, 617045, 'Agencias de noticias', 6, 1, 1, '2023-02-21 09:45:39'),
(2352, 617050, 'Lavanderías y similares', 6, 1, 1, '2023-02-21 09:45:39'),
(2353, 617055, 'Peluquerías y similares', 6, 1, 1, '2023-02-21 09:45:39'),
(2354, 617060, 'Servicios funerarios', 6, 1, 1, '2023-02-21 09:45:39'),
(2355, 617065, 'Zonas francas', 6, 1, 1, '2023-02-21 09:45:39'),
(2356, 617095, 'Actividades conexas', 6, 1, 1, '2023-02-21 09:45:39'),
(2357, 617099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:39'),
(2358, 62, 'Compras', 6, 1, 1, '2023-02-21 09:45:39'),
(2359, 6205, 'De mercancías', 6, 1, 1, '2023-02-21 09:45:39'),
(2360, 620599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:39'),
(2361, 6210, 'De materias primas', 6, 1, 1, '2023-02-21 09:45:39'),
(2362, 621099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:39'),
(2363, 6215, 'De materiales indirectos', 6, 1, 1, '2023-02-21 09:45:39'),
(2364, 621599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:39'),
(2365, 6220, 'Compra de energía', 6, 1, 1, '2023-02-21 09:45:39'),
(2366, 622099, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:40'),
(2367, 6225, 'Devoluciones en compras (CR)', 6, 1, 1, '2023-02-21 09:45:40'),
(2368, 622599, 'Ajustes por inflación', 6, 1, 1, '2023-02-21 09:45:40'),
(2370, 71, 'Materia prima', 7, 1, 1, '2023-02-21 09:46:06'),
(2371, 72, 'Mano de obra directa', 7, 1, 1, '2023-02-21 09:46:06'),
(2372, 73, 'Costos indirectos', 7, 1, 1, '2023-02-21 09:46:06'),
(2373, 74, 'Contratos de servicios', 7, 1, 1, '2023-02-21 09:46:06'),
(2375, 81, 'Derechos contingentes', 8, 1, 1, '2023-02-21 09:47:07'),
(2376, 8105, 'Bienes y valores entregados en custodia', 8, 1, 1, '2023-02-21 09:47:07'),
(2377, 810505, 'Valores mobiliarios', 8, 1, 1, '2023-02-21 09:47:08'),
(2378, 810510, 'Bienes muebles', 8, 1, 1, '2023-02-21 09:47:08'),
(2379, 810599, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:08'),
(2380, 8110, 'Bienes y valores entregados en garantía', 8, 1, 1, '2023-02-21 09:47:08'),
(2381, 811005, 'Valores mobiliarios', 8, 1, 1, '2023-02-21 09:47:08'),
(2382, 811010, 'Bienes muebles', 8, 1, 1, '2023-02-21 09:47:08'),
(2383, 811015, 'Bienes inmuebles', 8, 1, 1, '2023-02-21 09:47:08'),
(2384, 811020, 'Contratos de ganado en participación', 8, 1, 1, '2023-02-21 09:47:08'),
(2385, 811099, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:08'),
(2386, 8115, 'Bienes y valores en poder de terceros', 8, 1, 1, '2023-02-21 09:47:08'),
(2387, 811505, 'En arrendamiento', 8, 1, 1, '2023-02-21 09:47:08'),
(2388, 811510, 'En préstamo', 8, 1, 1, '2023-02-21 09:47:08'),
(2389, 811515, 'En depósito', 8, 1, 1, '2023-02-21 09:47:08'),
(2390, 811520, 'En consignación', 8, 1, 1, '2023-02-21 09:47:08'),
(2391, 811599, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:08'),
(2392, 8120, 'Litigios y/o demandas', 8, 1, 1, '2023-02-21 09:47:08'),
(2393, 812005, 'Ejecutivos', 8, 1, 1, '2023-02-21 09:47:09'),
(2394, 812010, 'Incumplimiento de contratos', 8, 1, 1, '2023-02-21 09:47:09'),
(2395, 8125, 'Promesas de compraventa', 8, 1, 1, '2023-02-21 09:47:09'),
(2396, 8195, 'Diversas', 8, 1, 1, '2023-02-21 09:47:09'),
(2397, 819505, 'Valores adquiridos por recibir', 8, 1, 1, '2023-02-21 09:47:09'),
(2398, 819595, 'Otras', 8, 1, 1, '2023-02-21 09:47:09'),
(2399, 819599, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:09'),
(2400, 82, 'Deudoras fiscales', 8, 1, 1, '2023-02-21 09:47:09'),
(2401, 83, 'Deudoras de control', 8, 1, 1, '2023-02-21 09:47:09'),
(2402, 8305, 'Bienes recibidos en arrendamiento financiero', 8, 1, 1, '2023-02-21 09:47:09'),
(2403, 830505, 'Bienes muebles', 8, 1, 1, '2023-02-21 09:47:09'),
(2404, 830510, 'Bienes inmuebles', 8, 1, 1, '2023-02-21 09:47:09'),
(2405, 830599, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:09'),
(2406, 8310, 'Títulos de inversión no colocados', 8, 1, 1, '2023-02-21 09:47:09'),
(2407, 831005, 'Acciones', 8, 1, 1, '2023-02-21 09:47:09'),
(2408, 831010, 'Bonos', 8, 1, 1, '2023-02-21 09:47:09'),
(2409, 831095, 'Otros', 8, 1, 1, '2023-02-21 09:47:09'),
(2410, 8315, 'Propiedades, planta y equipo totalmente depreciados, agotados y/o\r\n            amortizados', 8, 1, 1, '2023-02-21 09:47:09'),
(2411, 831506, 'Materiales proyectos petroleros', 8, 1, 1, '2023-02-21 09:47:09'),
(2412, 831516, 'Construcciones y edificaciones', 8, 1, 1, '2023-02-21 09:47:09'),
(2413, 831520, 'Maquinaria y equipo', 8, 1, 1, '2023-02-21 09:47:09'),
(2414, 831524, 'Equipo de oficina', 8, 1, 1, '2023-02-21 09:47:09'),
(2415, 831528, 'Equipo de computación y comunicación', 8, 1, 1, '2023-02-21 09:47:09'),
(2416, 831532, 'Equipo médico-científico', 8, 1, 1, '2023-02-21 09:47:09'),
(2417, 831536, 'Equipo de hoteles y restaurantes', 8, 1, 1, '2023-02-21 09:47:09'),
(2418, 831540, 'Flota y equipo de transporte', 8, 1, 1, '2023-02-21 09:47:09'),
(2419, 831544, 'Flota y equipo fluvial y/o marítimo', 8, 1, 1, '2023-02-21 09:47:09'),
(2420, 831548, 'Flota y equipo aéreo', 8, 1, 1, '2023-02-21 09:47:10'),
(2421, 831552, 'Flota y equipo férreo', 8, 1, 1, '2023-02-21 09:47:10'),
(2422, 831556, 'Acueductos, plantas y redes', 8, 1, 1, '2023-02-21 09:47:10'),
(2423, 831560, 'Armamento de vigilancia', 8, 1, 1, '2023-02-21 09:47:10'),
(2424, 831562, 'Envases y empaques', 8, 1, 1, '2023-02-21 09:47:10'),
(2425, 831564, 'Plantaciones agrícolas y forestales', 8, 1, 1, '2023-02-21 09:47:10'),
(2426, 831568, 'Vías de comunicación', 8, 1, 1, '2023-02-21 09:47:10'),
(2427, 831572, 'Minas y canteras', 8, 1, 1, '2023-02-21 09:47:10'),
(2428, 831576, 'Pozos artesianos', 8, 1, 1, '2023-02-21 09:47:10'),
(2429, 831580, 'Yacimientos', 8, 1, 1, '2023-02-21 09:47:10'),
(2430, 831584, 'Semovientes', 8, 1, 1, '2023-02-21 09:47:10'),
(2431, 831599, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:10'),
(2432, 8320, 'Créditos a favor no utilizados', 8, 1, 1, '2023-02-21 09:47:10'),
(2433, 832005, 'País', 8, 1, 1, '2023-02-21 09:47:10'),
(2434, 832010, 'Exterior', 8, 1, 1, '2023-02-21 09:47:10'),
(2435, 8325, 'Activos castigados', 8, 1, 1, '2023-02-21 09:47:10'),
(2436, 832505, 'Inversiones', 8, 1, 1, '2023-02-21 09:47:10'),
(2437, 832510, 'Deudores', 8, 1, 1, '2023-02-21 09:47:10'),
(2438, 832595, 'Otros activos', 8, 1, 1, '2023-02-21 09:47:10'),
(2439, 8330, 'Títulos de inversión amortizados', 8, 1, 1, '2023-02-21 09:47:10'),
(2440, 833005, 'Bonos', 8, 1, 1, '2023-02-21 09:47:10'),
(2441, 833095, 'Otros', 8, 1, 1, '2023-02-21 09:47:10'),
(2442, 8335, 'Capitalización por revalorización de patrimonio', 8, 1, 1, '2023-02-21 09:47:10'),
(2443, 8395, 'Otras cuentas deudoras de control', 8, 1, 1, '2023-02-21 09:47:10'),
(2444, 839505, 'Cheques posfechados', 8, 1, 1, '2023-02-21 09:47:10'),
(2445, 839510, 'Certificados de depósito a término', 8, 1, 1, '2023-02-21 09:47:10'),
(2446, 839515, 'Cheques devueltos', 8, 1, 1, '2023-02-21 09:47:10'),
(2447, 839520, 'Bienes y valores en fideicomiso', 8, 1, 1, '2023-02-21 09:47:10'),
(2448, 839525, 'Intereses sobre deudas vencidas', 8, 1, 1, '2023-02-21 09:47:11'),
(2449, 839595, 'Diversas', 8, 1, 1, '2023-02-21 09:47:11'),
(2450, 839599, 'Ajustes por inflación', 8, 1, 1, '2023-02-21 09:47:11'),
(2451, 8399, 'Ajustes por inflación activos', 8, 1, 1, '2023-02-21 09:47:11'),
(2452, 839905, 'Inversiones', 8, 1, 1, '2023-02-21 09:47:11'),
(2453, 839910, 'Inventarios', 8, 1, 1, '2023-02-21 09:47:11'),
(2454, 839915, 'Propiedades, planta y equipo', 8, 1, 1, '2023-02-21 09:47:11'),
(2455, 839920, 'Intangibles', 8, 1, 1, '2023-02-21 09:47:11'),
(2456, 839925, 'Cargos diferidos', 8, 1, 1, '2023-02-21 09:47:11'),
(2457, 839995, 'Otros activos', 8, 1, 1, '2023-02-21 09:47:11'),
(2458, 84, 'Derechos contingentes por contra (CR)', 8, 1, 1, '2023-02-21 09:47:11'),
(2459, 85, 'Deudoras fiscales por contra (CR)', 8, 1, 1, '2023-02-21 09:47:11'),
(2460, 86, 'Deudoras de control por contra (CR)', 8, 1, 1, '2023-02-21 09:47:11'),
(2462, 91, 'Responsabilidades contingentes', 9, 1, 1, '2023-02-21 09:48:10'),
(2463, 9105, 'Bienes y valores recibidos en custodia', 9, 1, 1, '2023-02-21 09:48:11'),
(2464, 910505, 'Valores mobiliarios', 9, 1, 1, '2023-02-21 09:48:11'),
(2465, 910510, 'Bienes muebles', 9, 1, 1, '2023-02-21 09:48:11'),
(2466, 910599, 'Ajustes por inflación', 9, 1, 1, '2023-02-21 09:48:11'),
(2467, 9110, 'Bienes y valores recibidos en garantía', 9, 1, 1, '2023-02-21 09:48:11'),
(2468, 911005, 'Valores mobiliarios', 9, 1, 1, '2023-02-21 09:48:11'),
(2469, 911010, 'Bienes muebles', 9, 1, 1, '2023-02-21 09:48:11'),
(2470, 911015, 'Bienes inmuebles', 9, 1, 1, '2023-02-21 09:48:11'),
(2471, 911020, 'Contratos de ganado en participación', 9, 1, 1, '2023-02-21 09:48:11'),
(2472, 911099, 'Ajustes por inflación', 9, 1, 1, '2023-02-21 09:48:11'),
(2473, 9115, 'Bienes y valores recibidos de terceros', 9, 1, 1, '2023-02-21 09:48:11'),
(2474, 911505, 'En arrendamiento', 9, 1, 1, '2023-02-21 09:48:11'),
(2475, 911510, 'En préstamo', 9, 1, 1, '2023-02-21 09:48:11'),
(2476, 911515, 'En depósito', 9, 1, 1, '2023-02-21 09:48:11'),
(2477, 911520, 'En consignación', 9, 1, 1, '2023-02-21 09:48:11'),
(2478, 911525, 'En comodato', 9, 1, 1, '2023-02-21 09:48:11'),
(2479, 911599, 'Ajustes por inflación', 9, 1, 1, '2023-02-21 09:48:11'),
(2480, 9120, 'Litigios y/o demandas', 9, 1, 1, '2023-02-21 09:48:11'),
(2481, 912005, 'Laborales', 9, 1, 1, '2023-02-21 09:48:11'),
(2482, 912010, 'Civiles', 9, 1, 1, '2023-02-21 09:48:11'),
(2483, 912015, 'Administrativos o arbitrales', 9, 1, 1, '2023-02-21 09:48:11'),
(2484, 912020, 'Tributarios', 9, 1, 1, '2023-02-21 09:48:11'),
(2485, 9125, 'Promesas de compraventa', 9, 1, 1, '2023-02-21 09:48:11'),
(2486, 9130, 'Contratos de administración delegada', 9, 1, 1, '2023-02-21 09:48:11'),
(2487, 9135, 'Cuentas en participación', 9, 1, 1, '2023-02-21 09:48:12'),
(2488, 9195, 'Otras responsabilidades contingentes', 9, 1, 1, '2023-02-21 09:48:12'),
(2489, 92, 'Acreedoras fiscales', 9, 1, 1, '2023-02-21 09:48:12'),
(2490, 93, 'Acreedoras de control', 9, 1, 1, '2023-02-21 09:48:12'),
(2491, 9305, 'Contratos de arrendamiento financiero', 9, 1, 1, '2023-02-21 09:48:12'),
(2492, 930505, 'Bienes muebles', 9, 1, 1, '2023-02-21 09:48:12'),
(2493, 930510, 'Bienes inmuebles', 9, 1, 1, '2023-02-21 09:48:12'),
(2494, 9395, 'Otras cuentas de orden acreedoras de control', 9, 1, 1, '2023-02-21 09:48:12'),
(2495, 939505, 'Documentos por cobrar descontados', 9, 1, 1, '2023-02-21 09:48:12'),
(2496, 939510, 'Convenios de pago', 9, 1, 1, '2023-02-21 09:48:12'),
(2497, 939515, 'Contratos de construcciones e instalaciones por ejecutar', 9, 1, 1, '2023-02-21 09:48:12'),
(2498, 939525, 'Adjudicaciones pendientes de legalizar', 9, 1, 1, '2023-02-21 09:48:12'),
(2499, 939530, 'Reserva artículo 3º Ley 4ª de 1980', 9, 1, 1, '2023-02-21 09:48:12'),
(2500, 939535, 'Reserva costo reposición semovientes', 9, 1, 1, '2023-02-21 09:48:12'),
(2501, 939595, 'Diversas', 9, 1, 1, '2023-02-21 09:48:12'),
(2502, 939599, 'Ajustes por inflación', 9, 1, 1, '2023-02-21 09:48:12'),
(2503, 9399, 'Ajustes por inflación patrimonio', 9, 1, 1, '2023-02-21 09:48:12'),
(2504, 939905, 'Capital social', 9, 1, 1, '2023-02-21 09:48:12'),
(2505, 939910, 'Superávit de capital', 9, 1, 1, '2023-02-21 09:48:12'),
(2506, 939915, 'Reservas', 9, 1, 1, '2023-02-21 09:48:12'),
(2507, 939925, 'Dividendos o participaciones decretadas en acciones, cuotas o partes de interés social', 9, 1, 1, '2023-02-21 09:48:12'),
(2508, 939930, 'Resultados de ejercicios anteriores', 9, 1, 1, '2023-02-21 09:48:12'),
(2509, 94, 'Responsabilidades contingentes por contra (DB)', 9, 1, 1, '2023-02-21 09:48:12'),
(2510, 95, 'Acreedoras fiscales por contra (DB)', 9, 1, 1, '2023-02-21 09:48:12'),
(2511, 96, 'Acreedoras de control por contra (DB)', 9, 1, 1, '2023-02-21 09:48:13');

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
-- Estructura de tabla para la tabla `remisiones`
--

CREATE TABLE `remisiones` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `observacion` text DEFAULT NULL,
  `nombre_recibed` varchar(255) DEFAULT NULL,
  `telefono_recibed` varchar(255) DEFAULT NULL,
  `firma_recibed` text DEFAULT NULL,
  `fecha_recibed` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `remisiones`
--

INSERT INTO `remisiones` (`id`, `code`, `cliente_id`, `asunto`, `observacion`, `nombre_recibed`, `telefono_recibed`, `firma_recibed`, `fecha_recibed`, `status`, `created_by`, `created_at`) VALUES
(3, '1', 44, 'VVV', NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-02-17 16:19:07'),
(7, '4', 17, 'dddd', NULL, NULL, NULL, NULL, NULL, 0, 1, '2023-02-17 16:23:02'),
(13, '5', 11, 'D', NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-02-17 16:34:11'),
(14, '6', 11, 'Salida de radios porgramados', 'Por medio de la presente se hace entrega de dos radios programados', NULL, NULL, NULL, NULL, 0, 1, '2023-02-17 16:34:31'),
(16, '7', 11, 'asd', 'asd', NULL, NULL, NULL, NULL, 0, 1, '2023-03-29 16:21:40'),
(17, '8', 11, 'asd', NULL, NULL, NULL, NULL, NULL, 0, 1, '2023-03-29 16:21:48'),
(18, '9', 14, 'asd', NULL, NULL, NULL, NULL, NULL, 0, 1, '2023-03-29 16:22:15'),
(19, '10', 13, 'asd', NULL, NULL, NULL, NULL, NULL, 0, 1, '2023-03-29 16:22:22'),
(20, '10', 16, 'asd', '21', NULL, NULL, NULL, NULL, 0, 1, '2023-03-29 16:22:30'),
(21, '11', 15, '123', 'asd', NULL, NULL, NULL, NULL, 0, 1, '2023-03-29 16:26:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `correos` text DEFAULT NULL,
  `tecnico_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `aprobado` int(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante_legal`
--

CREATE TABLE `representante_legal` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `nombres_suplente` varchar(255) DEFAULT NULL,
  `apellidos_suplente` varchar(255) DEFAULT NULL,
  `tipo_documento_suplente` int(11) DEFAULT NULL,
  `documento_suplente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `representante_legal`
--

INSERT INTO `representante_legal` (`id`, `nombres`, `apellidos`, `tipo_documento`, `documento`, `nombres_suplente`, `apellidos_suplente`, `tipo_documento_suplente`, `documento_suplente`) VALUES
(1, 'Santiago Smith', 'Delgado Henao', 4, '45544', 'Carlos', 'Slim', 6, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisor_fiscal`
--

CREATE TABLE `revisor_fiscal` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `revisor_fiscal`
--

INSERT INTO `revisor_fiscal` (`id`, `nombres`, `apellidos`, `tipo_documento`, `documento`) VALUES
(1, 'Monica', 'R', 12, '123333');

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
(35, 2, 1, 16, 1, 1, NULL, NULL, 0, 1, '2023-04-13 14:33:11'),
(36, 4, 1, 16, 0, NULL, 67, NULL, 1, 1, '2023-04-13 14:33:38'),
(37, 2, 1, 16, 1, NULL, 16, 'Producto asignado a la solicitud de inventario con código: SOL-YMPKS', 0, 1, '2023-05-05 07:49:26'),
(38, 2, 1, 15, 1, NULL, 16, 'Producto asignado a la solicitud de inventario con código: SOL-YMPKS', 0, 1, '2023-05-05 07:49:26'),
(39, 3, 1, 17, 1, NULL, 13, 'Producto asignado a la solicitud de inventario con código: SOL-ESWOF', 0, 1, '2023-05-05 07:53:42'),
(40, 3, 1, 18, 1, NULL, 13, 'Producto asignado a la solicitud de inventario con código: SOL-Y9NUK', 0, 1, '2023-05-05 07:58:10'),
(41, 3, 1, 19, 1, NULL, 11, 'Producto asignado a la solicitud de inventario con código: SOL-IN4OQ', 0, 1, '2023-05-05 08:06:42'),
(42, 2, 1, 19, 0, 8, NULL, NULL, 1, 1, '2023-05-08 11:49:55'),
(43, 2, 1, 19, 0, 1, NULL, NULL, 1, 1, '2023-05-08 12:13:53'),
(44, 2, 1, 19, 1, 10, NULL, NULL, 0, 1, '2023-05-08 12:16:16'),
(45, 2, 1, 19, 1, 26, NULL, NULL, 0, 1, '2023-05-08 12:28:32'),
(46, 2, 1, 19, 1, NULL, 14, 'Producto asignado a la solicitud de inventario con código: SOL-PV3VY', 0, 1, '2023-05-08 12:29:37'),
(47, 2, 1, 20, 1, 8, NULL, NULL, 0, 1, '2023-05-09 15:27:23');

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
-- Estructura de tabla para la tabla `solicitud_inventario`
--

CREATE TABLE `solicitud_inventario` (
  `id` int(11) NOT NULL,
  `codigo` varchar(200) NOT NULL,
  `tipo` int(1) DEFAULT NULL,
  `solicitante_id` int(11) NOT NULL,
  `aprobador_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_inventario`
--

INSERT INTO `solicitud_inventario` (`id`, `codigo`, `tipo`, `solicitante_id`, `aprobador_id`, `cliente_id`, `descripcion`, `estado`, `created_at`) VALUES
(7, 'SOL-KAMTN', 4, 1, NULL, 17, 'Mirar el cliente', 1, '2023-02-03 15:07:31'),
(8, 'SOL-QQULM', 1, 1, NULL, 28, 'asdasds', 1, '2023-03-01 07:39:31'),
(10, 'SOL-YMPKS', 1, 1, NULL, 16, 'ppp', 1, '2023-03-22 08:38:39'),
(11, 'SOL-ESWOF', 1, 1, NULL, 13, '444', 1, '2023-05-05 07:51:56'),
(12, 'SOL-Y9NUK', 3, 1, NULL, 13, 'aasd', 1, '2023-05-05 07:57:55'),
(13, 'SOL-IN4OQ', 4, 1, NULL, 11, '111', 1, '2023-05-05 08:06:24'),
(14, 'SOL-PV3VY', 1, 1, NULL, 14, 'sdasad', 1, '2023-05-08 12:29:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_inventario_detalle`
--

CREATE TABLE `solicitud_inventario_detalle` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `elemento` text NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_inventario_detalle`
--

INSERT INTO `solicitud_inventario_detalle` (`id`, `solicitud_id`, `elemento`, `cantidad`, `status`, `created_at`) VALUES
(24, 7, 'Perillas', '3', 1, '2023-03-03 14:35:57'),
(25, 7, 'Cables 3B', '1', 1, '2023-03-03 14:35:57'),
(26, 7, 'Tornillos', '4', 1, '2023-03-03 14:35:57'),
(28, 8, 'asdasdsad', '1', 1, '2023-03-03 14:36:41'),
(29, 8, 'dddd', '2', 1, '2023-03-03 14:36:41'),
(30, 10, 'ppp', '3', 2, '2023-03-22 08:38:39'),
(31, 10, 'lll', '2', 1, '2023-03-22 08:38:39'),
(32, 11, '4444', '1', 1, '2023-05-05 07:51:56'),
(33, 12, 'asd', '1', 1, '2023-05-05 07:57:55'),
(34, 13, '11', '1', 1, '2023-05-05 08:06:24'),
(35, 14, 'asd', '1', 1, '2023-05-08 12:29:05');

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
(9, 'PORTATILESSa', 87, 1, '2023-01-12'),
(13, 'REPETIDORASAsss', 88, 1, '2023-01-12'),
(14, 'OTROSss', 87, 1, '2023-01-12'),
(15, 'ddddd', 87, 1, '2023-03-21'),
(16, 'sdd', 88, 1, '2023-03-21');

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
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`id`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(1, 'Registro Civil', 1, 1, '2023-02-22 18:08:08'),
(2, 'Tarjeta de identidad', 1, 1, '2023-02-22 18:08:08'),
(3, 'Cédula de ciudadanía', 1, 1, '2023-02-22 18:08:08'),
(4, 'Tarjeta de extranjería', 1, 1, '2023-02-22 18:08:08'),
(5, 'NIT', 1, 1, '2023-02-22 18:08:08'),
(6, 'Pasaporte', 1, 1, '2023-02-22 18:08:08'),
(7, 'Documento de identificación extranjero', 1, 1, '2023-02-22 18:08:08'),
(8, 'NUIP', 1, 1, '2023-02-22 18:08:08'),
(9, 'No obligado a registrarse en RUT PN', 1, 1, '2023-02-22 18:08:08'),
(10, 'Permiso especial de permanencia PEP', 1, 1, '2023-02-22 18:09:57'),
(11, 'Sin identificación del exterior o para uso definido por la DIAN', 1, 1, '2023-02-22 18:09:57'),
(12, 'NIT de otro país/ Sin identificación del exterior (43 medios magnéticos)', 1, 1, '2023-02-22 18:09:57'),
(13, 'Salvoconducto de permanencia', 1, 1, '2023-02-22 18:09:57'),
(14, '1', 0, 1, '2023-02-22 22:10:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_empresas`
--

CREATE TABLE `tipos_empresas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_empresas`
--

INSERT INTO `tipos_empresas` (`id`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(1, 'Persona Jurídica', 1, 1, '2023-02-22 18:05:20'),
(2, 'Persona Natural', 1, 1, '2023-02-22 18:05:20'),
(3, 'Consorcio', 1, 1, '2023-02-22 18:05:20'),
(4, 'Unión Temporal', 1, 1, '2023-02-22 18:05:20'),
(5, '1111', 0, 1, '2023-02-22 22:10:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_regimenes`
--

CREATE TABLE `tipos_regimenes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_regimenes`
--

INSERT INTO `tipos_regimenes` (`id`, `code`, `nombre`, `status`, `created_by`, `created_at`) VALUES
(1, '001', 'Gran Contribuyente', 1, 1, '2023-02-22 18:06:22'),
(2, '002', 'Responsable de IVA', 1, 1, '2023-02-22 18:06:22'),
(3, '003', 'No Responsable de IVA', 1, 1, '2023-02-22 18:06:22'),
(4, '004', 'Empresa del Estado', 1, 1, '2023-02-22 18:06:22'),
(5, '099', 'Régimen simple ded tributación', 1, 1, '2023-02-22 18:06:22');

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios_reparaciones`
--
ALTER TABLE `accesorios_reparaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividades_economicas`
--
ALTER TABLE `actividades_economicas`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `avances_reparaciones`
--
ALTER TABLE `avances_reparaciones`
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
-- Indices de la tabla `categorias_reparaciones`
--
ALTER TABLE `categorias_reparaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_seguimiento_clientes`
--
ALTER TABLE `categorias_seguimiento_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centros_costo`
--
ALTER TABLE `centros_costo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_autoretencion`
--
ALTER TABLE `configuracion_autoretencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_impuestos`
--
ALTER TABLE `configuracion_impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_puc`
--
ALTER TABLE `configuracion_puc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contador`
--
ALTER TABLE `contador`
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
-- Indices de la tabla `datos_tributarios`
--
ALTER TABLE `datos_tributarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`);

--
-- Indices de la tabla `detalle_cotizaciones`
--
ALTER TABLE `detalle_cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_factura_compra`
--
ALTER TABLE `detalle_factura_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_factura_venta`
--
ALTER TABLE `detalle_factura_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ordenes`
--
ALTER TABLE `detalle_ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_precios`
--
ALTER TABLE `detalle_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detelle_remisiones`
--
ALTER TABLE `detelle_remisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_compra`
--
ALTER TABLE `factura_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_prospectos`
--
ALTER TABLE `historial_prospectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `history_cotizaciones`
--
ALTER TABLE `history_cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `created_by` (`created_by`);

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
-- Indices de la tabla `observaciones_proveedores`
--
ALTER TABLE `observaciones_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_compras`
--
ALTER TABLE `pagos_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_ventas`
--
ALTER TABLE `pagos_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parametrizacion_documentos`
--
ALTER TABLE `parametrizacion_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos_new`
--
ALTER TABLE `permisos_new`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precio_proveedores`
--
ALTER TABLE `precio_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prospectos`
--
ALTER TABLE `prospectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prospectos_empresas`
--
ALTER TABLE `prospectos_empresas`
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
-- Indices de la tabla `pucs`
--
ALTER TABLE `pucs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `remisiones`
--
ALTER TABLE `remisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `representante_legal`
--
ALTER TABLE `representante_legal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `revisor_fiscal`
--
ALTER TABLE `revisor_fiscal`
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
-- Indices de la tabla `solicitud_inventario`
--
ALTER TABLE `solicitud_inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_inventario_detalle`
--
ALTER TABLE `solicitud_inventario_detalle`
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
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_empresas`
--
ALTER TABLE `tipos_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_regimenes`
--
ALTER TABLE `tipos_regimenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculos_id_IDX` (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios_reparaciones`
--
ALTER TABLE `accesorios_reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `actividades_economicas`
--
ALTER TABLE `actividades_economicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=738;

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
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=888;

--
-- AUTO_INCREMENT de la tabla `avances_asignaciones`
--
ALTER TABLE `avances_asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1708;

--
-- AUTO_INCREMENT de la tabla `avances_reparaciones`
--
ALTER TABLE `avances_reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `categorias_reparaciones`
--
ALTER TABLE `categorias_reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias_seguimiento_clientes`
--
ALTER TABLE `categorias_seguimiento_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centros_costo`
--
ALTER TABLE `centros_costo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1104;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `configuracion_autoretencion`
--
ALTER TABLE `configuracion_autoretencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `configuracion_impuestos`
--
ALTER TABLE `configuracion_impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `configuracion_puc`
--
ALTER TABLE `configuracion_puc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3352;

--
-- AUTO_INCREMENT de la tabla `contador`
--
ALTER TABLE `contador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- AUTO_INCREMENT de la tabla `datos_tributarios`
--
ALTER TABLE `datos_tributarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `detalle_cotizaciones`
--
ALTER TABLE `detalle_cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `detalle_factura_compra`
--
ALTER TABLE `detalle_factura_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1272;

--
-- AUTO_INCREMENT de la tabla `detalle_factura_venta`
--
ALTER TABLE `detalle_factura_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_ordenes`
--
ALTER TABLE `detalle_ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_precios`
--
ALTER TABLE `detalle_precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detelle_remisiones`
--
ALTER TABLE `detelle_remisiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `factura_compra`
--
ALTER TABLE `factura_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1276;

--
-- AUTO_INCREMENT de la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historial_prospectos`
--
ALTER TABLE `historial_prospectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `history_cotizaciones`
--
ALTER TABLE `history_cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

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
-- AUTO_INCREMENT de la tabla `observaciones_proveedores`
--
ALTER TABLE `observaciones_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos_compras`
--
ALTER TABLE `pagos_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1031;

--
-- AUTO_INCREMENT de la tabla `pagos_ventas`
--
ALTER TABLE `pagos_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `parametrizacion_documentos`
--
ALTER TABLE `parametrizacion_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permisos_new`
--
ALTER TABLE `permisos_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9530;

--
-- AUTO_INCREMENT de la tabla `precio_proveedores`
--
ALTER TABLE `precio_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prospectos`
--
ALTER TABLE `prospectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5806;

--
-- AUTO_INCREMENT de la tabla `prospectos_empresas`
--
ALTER TABLE `prospectos_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `pucs`
--
ALTER TABLE `pucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2512;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT de la tabla `remisiones`
--
ALTER TABLE `remisiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `representante_legal`
--
ALTER TABLE `representante_legal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revisor_fiscal`
--
ALTER TABLE `revisor_fiscal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `salida_inventario`
--
ALTER TABLE `salida_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de la tabla `solicitud_inventario`
--
ALTER TABLE `solicitud_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `solicitud_inventario_detalle`
--
ALTER TABLE `solicitud_inventario_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `task_projects`
--
ALTER TABLE `task_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipos_empresas`
--
ALTER TABLE `tipos_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_regimenes`
--
ALTER TABLE `tipos_regimenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);

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
