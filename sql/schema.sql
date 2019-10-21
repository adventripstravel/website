-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-09-2019 a las 11:14:42
-- Versión del servidor: 10.0.38-MariaDB-0+deb8u1
-- Versión de PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `exploore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `tour` bigint(20) NOT NULL,
  `date_booking` date NOT NULL,
  `date_booked` date NOT NULL,
  `paxes` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `totals` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` text COLLATE utf8_unicode_ci NOT NULL,
  `language` enum('en','es') COLLATE utf8_unicode_ci NOT NULL,
  `canceled` tinyint(1) NOT NULL DEFAULT '0',
  `user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_payment_invalid`
--

CREATE TABLE `com_payment_invalid` (
  `id_payment_invalid` bigint(20) NOT NULL,
  `txn_id` text CHARACTER SET latin1 NOT NULL,
  `payer_email` text CHARACTER SET latin1 NOT NULL,
  `data` longtext CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_payment_settings`
--

CREATE TABLE `com_payment_settings` (
  `id_setting` bigint(20) NOT NULL,
  `email_notifications` text,
  `email_paypal_account` text,
  `conekta_private_key` text,
  `conekta_public_key` text,
  `conekta_oxxopay_expires` int(11) NOT NULL DEFAULT '5',
  `currency` text NOT NULL,
  `extra_charge` int(11) DEFAULT NULL,
  `sandbox` set('1','0') NOT NULL DEFAULT '0',
  `debug` set('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `com_payment_settings`
--

INSERT INTO `com_payment_settings` (`id_setting`, `email_notifications`, `email_paypal_account`, `conekta_private_key`, `conekta_public_key`, `conekta_oxxopay_expires`, `currency`, `extra_charge`, `sandbox`, `debug`) VALUES
(1, 'paypal@exploore.mx', 'paypal@exploore.mx', NULL, NULL, 0, 'USD', NULL, '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_payment_tmp`
--

CREATE TABLE `com_payment_tmp` (
  `id_tmp` bigint(20) NOT NULL,
  `incidence_number` text NOT NULL,
  `data` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_payment_verified`
--

CREATE TABLE `com_payment_verified` (
  `id_payment_verified` int(11) NOT NULL,
  `payment_method` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` text CHARACTER SET latin1 NOT NULL,
  `payer_email` text CHARACTER SET latin1 NOT NULL,
  `data` longtext CHARACTER SET latin1 NOT NULL,
  `status_payment` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `destinations`
--

INSERT INTO `destinations` (`id`, `name`) VALUES
(1, 'Cancún, Qroo. México'),
(2, 'Isla Mujeres, Qroo. México'),
(3, 'Puerto Morelos, Qroo. México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ladas`
--

CREATE TABLE `ladas` (
  `id` bigint(20) NOT NULL,
  `country` text COLLATE utf8_spanish_ci NOT NULL,
  `code` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ladas`
--

INSERT INTO `ladas` (`id`, `country`, `code`) VALUES
(1, '{\"es\":\"Afganistán\",\"en\":\"Afganistán\"}', '93'),
(2, '{\"es\":\"Albania\",\"en\":\"Albania\"}', '355'),
(3, '{\"es\":\"Alemania\",\"en\":\"Alemania\"}', '49'),
(4, '{\"es\":\"Argelia\",\"en\":\"Argelia\"}', '213'),
(5, '{\"es\":\"Andorra\",\"en\":\"Andorra\"}', '376'),
(6, '{\"es\":\"Angola\",\"en\":\"Angola\"}', '244'),
(7, '{\"es\":\"Anguila\",\"en\":\"Anguila\"}', '264'),
(8, '{\"es\":\"Antártida\",\"en\":\"Antártida\"}', '672'),
(9, '{\"es\":\"Antigua y Barbuda\",\"en\":\"Antigua y Barbuda\"}', '268'),
(10, '{\"es\":\"Antillas Neerlandesas\",\"en\":\"Antillas Neerlandesas\"}', '599'),
(11, '{\"es\":\"Arabia Saudita\",\"en\":\"Arabia Saudita\"}', '966'),
(12, '{\"es\":\"Argentina\",\"en\":\"Argentina\"}', '54'),
(13, '{\"es\":\"Armenia\",\"en\":\"Armenia\"}', '374'),
(14, '{\"es\":\"Aruba\",\"en\":\"Aruba\"}', '297'),
(15, '{\"es\":\"Australia\",\"en\":\"Australia\"}', '61'),
(16, '{\"es\":\"Austria\",\"en\":\"Austria\"}', '43'),
(17, '{\"es\":\"Azerbayán\",\"en\":\"Azerbayán\"}', '994'),
(18, '{\"es\":\"Bahamas\",\"en\":\"Bahamas\"}', '242'),
(19, '{\"es\":\"Bahrein\",\"en\":\"Bahrein\"}', '973'),
(20, '{\"es\":\"Bangladesh\",\"en\":\"Bangladesh\"}', '880'),
(21, '{\"es\":\"Barbados\",\"en\":\"Barbados\"}', '246'),
(22, '{\"es\":\"Bélgica\",\"en\":\"Bélgica\"}', '32'),
(23, '{\"es\":\"Belice\",\"en\":\"Belice\"}', '501'),
(24, '{\"es\":\"Ben\\u00edn\",\"en\":\"Ben\\u00edn\"}', '229'),
(25, '{\"es\":\"Bhut\\u00e1n\",\"en\":\"Bhut\\u00e1n\"}', '975'),
(26, '{\"es\":\"Bielorrusia\",\"en\":\"Bielorrusia\"}', '375'),
(27, '{\"es\":\"Birmania\",\"en\":\"Birmania\"}', '95'),
(28, '{\"es\":\"Bolivia\",\"en\":\"Bolivia\"}', '591'),
(29, '{\"es\":\"Bosnia y Herzegovina\",\"en\":\"Bosnia y Herzegovina\"}', '387'),
(30, '{\"es\":\"Botsuana\",\"en\":\"Botsuana\"}', '267'),
(31, '{\"es\":\"Brasil\",\"en\":\"Brasil\"}', '55'),
(32, '{\"es\":\"Brun\\u00e9i\",\"en\":\"Brun\\u00e9i\"}', '673'),
(33, '{\"es\":\"Bulgaria\",\"en\":\"Bulgaria\"}', '359'),
(34, '{\"es\":\"Burkina Faso\",\"en\":\"Burkina Faso\"}', '226'),
(35, '{\"es\":\"Burundi\",\"en\":\"Burundi\"}', '257'),
(36, '{\"es\":\"Cabo Verde\",\"en\":\"Cabo Verde\"}', '238'),
(37, '{\"es\":\"Camboya\",\"en\":\"Camboya\"}', '855'),
(38, '{\"es\":\"Camer\\u00fan\",\"en\":\"Camer\\u00fan\"}', '237'),
(39, '{\"es\":\"Canad\\u00e1\",\"en\":\"Canad\\u00e1\"}', '1'),
(40, '{\"es\":\"Chad\",\"en\":\"Chad\"}', '235'),
(41, '{\"es\":\"Chile\",\"en\":\"Chile\"}', '56'),
(42, '{\"es\":\"China\",\"en\":\"China\"}', '86'),
(43, '{\"es\":\"Chipre\",\"en\":\"Chipre\"}', '357'),
(44, '{\"es\":\"Ciudad del Vaticano\",\"en\":\"Ciudad del Vaticano\"}', '39'),
(45, '{\"es\":\"Colombia\",\"en\":\"Colombia\"}', '57'),
(46, '{\"es\":\"Comoras\",\"en\":\"Comoras\"}', '269'),
(47, '{\"es\":\"Congo\",\"en\":\"Congo\"}', '242'),
(48, '{\"es\":\"Corea del Norte\",\"en\":\"Corea del Norte\"}', '850'),
(49, '{\"es\":\"Corea del Sur\",\"en\":\"Corea del Sur\"}', '82'),
(50, '{\"es\":\"Costa de Marfil\",\"en\":\"Costa de Marfil\"}', '225'),
(51, '{\"es\":\"Costa Rica\",\"en\":\"Costa Rica\"}', '506'),
(52, '{\"es\":\"Croacia\",\"en\":\"Croacia\"}', '385'),
(53, '{\"es\":\"Cuba\",\"en\":\"Cuba\"}', '53'),
(54, '{\"es\":\"Dinamarca\",\"en\":\"Dinamarca\"}', '45'),
(55, '{\"es\":\"Dominica\",\"en\":\"Dominica\"}', '767'),
(56, '{\"es\":\"Ecuador\",\"en\":\"Ecuador\"}', '593'),
(57, '{\"es\":\"Egipto\",\"en\":\"Egipto\"}', '20'),
(58, '{\"es\":\"El Salvador\",\"en\":\"El Salvador\"}', '503'),
(59, '{\"es\":\"Emiratos \\u00c1rabes Unidos\",\"en\":\"Emiratos \\u00c1rabes Unidos\"}', '971'),
(60, '{\"es\":\"Eritrea\",\"en\":\"Eritrea\"}', '291'),
(61, '{\"es\":\"Eslovaquia\",\"en\":\"Eslovaquia\"}', '421'),
(62, '{\"es\":\"Eslovenia\",\"en\":\"Eslovenia\"}', '386'),
(63, '{\"es\":\"Espa\\u00f1a\",\"en\":\"Espa\\u00f1a\"}', '34'),
(64, '{\"es\":\"Estados Unidos de Am\\u00e9rica\",\"en\":\"Estados Unidos de Am\\u00e9rica\"}', '1'),
(65, '{\"es\":\"Estonia\",\"en\":\"Estonia\"}', '372'),
(66, '{\"es\":\"Etiop\\u00eda\",\"en\":\"Etiop\\u00eda\"}', '251'),
(67, '{\"es\":\"Filipinas\",\"en\":\"Filipinas\"}', '63'),
(68, '{\"es\":\"Finlandia\",\"en\":\"Finlandia\"}', '358'),
(69, '{\"es\":\"Fiyi\",\"en\":\"Fiyi\"}', '679'),
(70, '{\"es\":\"Francia\",\"en\":\"Francia\"}', '33'),
(71, '{\"es\":\"Gab\\u00f3n\",\"en\":\"Gab\\u00f3n\"}', '241'),
(72, '{\"es\":\"Gambia\",\"en\":\"Gambia\"}', '220'),
(73, '{\"es\":\"Georgia\",\"en\":\"Georgia\"}', '995'),
(74, '{\"es\":\"Ghana\",\"en\":\"Ghana\"}', '233'),
(75, '{\"es\":\"Gibraltar\",\"en\":\"Gibraltar\"}', '350'),
(76, '{\"es\":\"Granada\",\"en\":\"Granada\"}', '473'),
(77, '{\"es\":\"Grecia\",\"en\":\"Grecia\"}', '30'),
(78, '{\"es\":\"Groenlandia\",\"en\":\"Groenlandia\"}', '299'),
(79, '{\"es\":\"Guadalupe\",\"en\":\"Guadalupe\"}', '0'),
(80, '{\"es\":\"Guam\",\"en\":\"Guam\"}', '671'),
(81, '{\"es\":\"Guatemala\",\"en\":\"Guatemala\"}', '502'),
(82, '{\"es\":\"Guayana Francesa\",\"en\":\"Guayana Francesa\"}', '0'),
(83, '{\"es\":\"Guernsey\",\"en\":\"Guernsey\"}', '0'),
(84, '{\"es\":\"Guinea\",\"en\":\"Guinea\"}', '224'),
(85, '{\"es\":\"Guinea Ecuatorial\",\"en\":\"Guinea Ecuatorial\"}', '240'),
(86, '{\"es\":\"Guinea-Bissau\",\"en\":\"Guinea-Bissau\"}', '245'),
(87, '{\"es\":\"Guyana\",\"en\":\"Guyana\"}', '592'),
(88, '{\"es\":\"Hait\\u00ed\",\"en\":\"Hait\\u00ed\"}', '509'),
(89, '{\"es\":\"Honduras\",\"en\":\"Honduras\"}', '504'),
(90, '{\"es\":\"Hong kong\",\"en\":\"Hong kong\"}', '852'),
(91, '{\"es\":\"Hungr\\u00eda\",\"en\":\"Hungr\\u00eda\"}', '36'),
(92, '{\"es\":\"India\",\"en\":\"India\"}', '91'),
(93, '{\"es\":\"Indonesia\",\"en\":\"Indonesia\"}', '62'),
(94, '{\"es\":\"Irak\",\"en\":\"Irak\"}', '964'),
(95, '{\"es\":\"Ir\\u00e1n\",\"en\":\"Ir\\u00e1n\"}', '98'),
(96, '{\"es\":\"Irlanda\",\"en\":\"Irlanda\"}', '353'),
(97, '{\"es\":\"Isla Bouvet\",\"en\":\"Isla Bouvet\"}', '0'),
(98, '{\"es\":\"Isla de Man\",\"en\":\"Isla de Man\"}', '44'),
(99, '{\"es\":\"Isla de Navidad\",\"en\":\"Isla de Navidad\"}', '61'),
(100, '{\"es\":\"Isla Norfolk\",\"en\":\"Isla Norfolk\"}', '0'),
(101, '{\"es\":\"Islandia\",\"en\":\"Islandia\"}', '354'),
(102, '{\"es\":\"Islas Bermudas\",\"en\":\"Islas Bermudas\"}', '441'),
(103, '{\"es\":\"Islas Caim\\u00e1n\",\"en\":\"Islas Caim\\u00e1n\"}', '345'),
(104, '{\"es\":\"Islas Cocos (Keeling)\",\"en\":\"Islas Cocos (Keeling)\"}', '61'),
(105, '{\"es\":\"Islas Cook\",\"en\":\"Islas Cook\"}', '682'),
(106, '{\"es\":\"Islas de \\u00c5land\",\"en\":\"Islas de \\u00c5land\"}', '0'),
(107, '{\"es\":\"Islas Feroe\",\"en\":\"Islas Feroe\"}', '298'),
(108, '{\"es\":\"Islas Georgias del Sur y Sandwich del Sur\",\"en\":\"Islas Georgias del Sur y Sandwich del Sur\"}', '0'),
(109, '{\"es\":\"Islas Heard y McDonald\",\"en\":\"Islas Heard y McDonald\"}', '0'),
(110, '{\"es\":\"Islas Maldivas\",\"en\":\"Islas Maldivas\"}', '960'),
(111, '{\"es\":\"Islas Malvinas\",\"en\":\"Islas Malvinas\"}', '500'),
(112, '{\"es\":\"Islas Marianas del Norte\",\"en\":\"Islas Marianas del Norte\"}', '670'),
(113, '{\"es\":\"Islas Marshall\",\"en\":\"Islas Marshall\"}', '692'),
(114, '{\"es\":\"Islas Pitcairn\",\"en\":\"Islas Pitcairn\"}', '870'),
(115, '{\"es\":\"Islas Salom\\u00f3n\",\"en\":\"Islas Salom\\u00f3n\"}', '677'),
(116, '{\"es\":\"Islas Turcas y Caicos\",\"en\":\"Islas Turcas y Caicos\"}', '649'),
(117, '{\"es\":\"Islas Ultramarinas Menores de Estados Unidos\",\"en\":\"Islas Ultramarinas Menores de Estados Unidos\"}', '0'),
(118, '{\"es\":\"Islas V\\u00edrgenes Brit\\u00e1nicas\",\"en\":\"Islas V\\u00edrgenes Brit\\u00e1nicas\"}', '284'),
(119, '{\"es\":\"Islas V\\u00edrgenes de los Estados Unidos\",\"en\":\"Islas V\\u00edrgenes de los Estados Unidos\"}', '340'),
(120, '{\"es\":\"Israel\",\"en\":\"Israel\"}', '972'),
(121, '{\"es\":\"Italia\",\"en\":\"Italia\"}', '39'),
(122, '{\"es\":\"Jamaica\",\"en\":\"Jamaica\"}', '876'),
(123, '{\"es\":\"Jap\\u00f3n\",\"en\":\"Jap\\u00f3n\"}', '81'),
(124, '{\"es\":\"Jersey\",\"en\":\"Jersey\"}', '0'),
(125, '{\"es\":\"Jordania\",\"en\":\"Jordania\"}', '962'),
(126, '{\"es\":\"Kazajist\\u00e1n\",\"en\":\"Kazajist\\u00e1n\"}', '7'),
(127, '{\"es\":\"Kenia\",\"en\":\"Kenia\"}', '254'),
(128, '{\"es\":\"Kirgizst\\u00e1n\",\"en\":\"Kirgizst\\u00e1n\"}', '996'),
(129, '{\"es\":\"Kiribati\",\"en\":\"Kiribati\"}', '686'),
(130, '{\"es\":\"Kuwait\",\"en\":\"Kuwait\"}', '965'),
(131, '{\"es\":\"Laos\",\"en\":\"Laos\"}', '856'),
(132, '{\"es\":\"Lesoto\",\"en\":\"Lesoto\"}', '266'),
(133, '{\"es\":\"Letonia\",\"en\":\"Letonia\"}', '371'),
(134, '{\"es\":\"L\\u00edbano\",\"en\":\"L\\u00edbano\"}', '961'),
(135, '{\"es\":\"Liberia\",\"en\":\"Liberia\"}', '231'),
(136, '{\"es\":\"Libia\",\"en\":\"Libia\"}', '218'),
(137, '{\"es\":\"Liechtenstein\",\"en\":\"Liechtenstein\"}', '423'),
(138, '{\"es\":\"Lituania\",\"en\":\"Lituania\"}', '370'),
(139, '{\"es\":\"Luxemburgo\",\"en\":\"Luxemburgo\"}', '352'),
(140, '{\"es\":\"Macao\",\"en\":\"Macao\"}', '853'),
(141, '{\"es\":\"Maced\\u00f4nia\",\"en\":\"Maced\\u00f4nia\"}', '389'),
(142, '{\"es\":\"Madagascar\",\"en\":\"Madagascar\"}', '261'),
(143, '{\"es\":\"Malasia\",\"en\":\"Malasia\"}', '60'),
(144, '{\"es\":\"Malawi\",\"en\":\"Malawi\"}', '265'),
(145, '{\"es\":\"Mali\",\"en\":\"Mali\"}', '223'),
(146, '{\"es\":\"Malta\",\"en\":\"Malta\"}', '356'),
(147, '{\"es\":\"Marruecos\",\"en\":\"Marruecos\"}', '212'),
(148, '{\"es\":\"Martinica\",\"en\":\"Martinica\"}', '0'),
(149, '{\"es\":\"Mauricio\",\"en\":\"Mauricio\"}', '230'),
(150, '{\"es\":\"Mauritania\",\"en\":\"Mauritania\"}', '222'),
(151, '{\"es\":\"Mayotte\",\"en\":\"Mayotte\"}', '262'),
(152, '{\"es\":\"M\\u00e9xico\",\"en\":\"M\\u00e9xico\"}', '52'),
(153, '{\"es\":\"Micronesia\",\"en\":\"Micronesia\"}', '691'),
(154, '{\"es\":\"Moldavia\",\"en\":\"Moldavia\"}', '373'),
(155, '{\"es\":\"M\\u00f3naco\",\"en\":\"M\\u00f3naco\"}', '377'),
(156, '{\"es\":\"Mongolia\",\"en\":\"Mongolia\"}', '976'),
(157, '{\"es\":\"Montenegro\",\"en\":\"Montenegro\"}', '382'),
(158, '{\"es\":\"Montserrat\",\"en\":\"Montserrat\"}', '664'),
(159, '{\"es\":\"Mozambique\",\"en\":\"Mozambique\"}', '258'),
(160, '{\"es\":\"Namibia\",\"en\":\"Namibia\"}', '264'),
(161, '{\"es\":\"Nauru\",\"en\":\"Nauru\"}', '674'),
(162, '{\"es\":\"Nepal\",\"en\":\"Nepal\"}', '977'),
(163, '{\"es\":\"Nicaragua\",\"en\":\"Nicaragua\"}', '505'),
(164, '{\"es\":\"Niger\",\"en\":\"Niger\"}', '227'),
(165, '{\"es\":\"Nigeria\",\"en\":\"Nigeria\"}', '234'),
(166, '{\"es\":\"Niue\",\"en\":\"Niue\"}', '683'),
(168, '{\"es\":\"Noruega\",\"en\":\"Noruega\"}', '47'),
(169, '{\"es\":\"Nueva Caledonia\",\"en\":\"Nueva Caledonia\"}', '687'),
(170, '{\"es\":\"Nueva Zelanda\",\"en\":\"Nueva Zelanda\"}', '64'),
(171, '{\"es\":\"Om\\u00e1n\",\"en\":\"Om\\u00e1n\"}', '968'),
(172, '{\"es\":\"Pa\\u00edses Bajos\",\"en\":\"Pa\\u00edses Bajos\"}', '31'),
(173, '{\"es\":\"Pakist\\u00e1n\",\"en\":\"Pakist\\u00e1n\"}', '92'),
(174, '{\"es\":\"Palau\",\"en\":\"Palau\"}', '680'),
(175, '{\"es\":\"Palestina\",\"en\":\"Palestina\"}', '0'),
(176, '{\"es\":\"Panam\\u00e1\",\"en\":\"Panam\\u00e1\"}', '507'),
(177, '{\"es\":\"Pap\\u00faa Nueva Guinea\",\"en\":\"Pap\\u00faa Nueva Guinea\"}', '675'),
(178, '{\"es\":\"Paraguay\",\"en\":\"Paraguay\"}', '595'),
(179, '{\"es\":\"Per\\u00fa\",\"en\":\"Per\\u00fa\"}', '51'),
(180, '{\"es\":\"Polinesia Francesa\",\"en\":\"Polinesia Francesa\"}', '689'),
(181, '{\"es\":\"Polonia\",\"en\":\"Polonia\"}', '48'),
(182, '{\"es\":\"Portugal\",\"en\":\"Portugal\"}', '351'),
(183, '{\"es\":\"Puerto Rico\",\"en\":\"Puerto Rico\"}', '787'),
(184, '{\"es\":\"Qatar\",\"en\":\"Qatar\"}', '974'),
(185, '{\"es\":\"Reino Unido\",\"en\":\"Reino Unido\"}', '44'),
(186, '{\"es\":\"Rep\\u00fablica Centroafricana\",\"en\":\"Rep\\u00fablica Centroafricana\"}', '236'),
(187, '{\"es\":\"Rep\\u00fablica Checa\",\"en\":\"Rep\\u00fablica Checa\"}', '420'),
(188, '{\"es\":\"Rep\\u00fablica Dominicana\",\"en\":\"Rep\\u00fablica Dominicana\"}', '809'),
(189, '{\"es\":\"Reuni\\u00f3n\",\"en\":\"Reuni\\u00f3n\"}', '0'),
(190, '{\"es\":\"Ruanda\",\"en\":\"Ruanda\"}', '250'),
(191, '{\"es\":\"Ruman\\u00eda\",\"en\":\"Ruman\\u00eda\"}', '40'),
(192, '{\"es\":\"Rusia\",\"en\":\"Rusia\"}', '7'),
(193, '{\"es\":\"Sahara Occidental\",\"en\":\"Sahara Occidental\"}', '0'),
(194, '{\"es\":\"Samoa\",\"en\":\"Samoa\"}', '685'),
(195, '{\"es\":\"Samoa Americana\",\"en\":\"Samoa Americana\"}', '684'),
(196, '{\"es\":\"San Bartolom\\u00e9\",\"en\":\"San Bartolom\\u00e9\"}', '590'),
(197, '{\"es\":\"San Crist\\u00f3bal y Nieves\",\"en\":\"San Crist\\u00f3bal y Nieves\"}', '869'),
(198, '{\"es\":\"San Marino\",\"en\":\"San Marino\"}', '378'),
(199, '{\"es\":\"San Mart\\u00edn (Francia)\",\"en\":\"San Mart\\u00edn (Francia)\"}', '599'),
(200, '{\"es\":\"San Pedro y Miquel\\u00f3n\",\"en\":\"San Pedro y Miquel\\u00f3n\"}', '508'),
(201, '{\"es\":\"San Vicente y las Granadinas\",\"en\":\"San Vicente y las Granadinas\"}', '784'),
(202, '{\"es\":\"Santa Elena\",\"en\":\"Santa Elena\"}', '290'),
(203, '{\"es\":\"Santa Luc\\u00eda\",\"en\":\"Santa Luc\\u00eda\"}', '758'),
(204, '{\"es\":\"Santo Tom\\u00e9 y Pr\\u00edncipe\",\"en\":\"Santo Tom\\u00e9 y Pr\\u00edncipe\"}', '239'),
(205, '{\"es\":\"Senegal\",\"en\":\"Senegal\"}', '221'),
(206, '{\"es\":\"Serbia\",\"en\":\"Serbia\"}', '381'),
(207, '{\"es\":\"Seychelles\",\"en\":\"Seychelles\"}', '248'),
(208, '{\"es\":\"Sierra Leona\",\"en\":\"Sierra Leona\"}', '232'),
(209, '{\"es\":\"Singapur\",\"en\":\"Singapur\"}', '65'),
(210, '{\"es\":\"Siria\",\"en\":\"Siria\"}', '963'),
(211, '{\"es\":\"Somalia\",\"en\":\"Somalia\"}', '252'),
(212, '{\"es\":\"Sri lanka\",\"en\":\"Sri lanka\"}', '94'),
(213, '{\"es\":\"Sud\\u00e1frica\",\"en\":\"Sud\\u00e1frica\"}', '27'),
(214, '{\"es\":\"Sud\\u00e1n\",\"en\":\"Sud\\u00e1n\"}', '249'),
(215, '{\"es\":\"Suecia\",\"en\":\"Suecia\"}', '46'),
(216, '{\"es\":\"Suiza\",\"en\":\"Suiza\"}', '41'),
(217, '{\"es\":\"Surin\\u00e1m\",\"en\":\"Surin\\u00e1m\"}', '597'),
(218, '{\"es\":\"Svalbard y Jan Mayen\",\"en\":\"Svalbard y Jan Mayen\"}', '0'),
(219, '{\"es\":\"Swazilandia\",\"en\":\"Swazilandia\"}', '268'),
(220, '{\"es\":\"Tadjikist\\u00e1n\",\"en\":\"Tadjikist\\u00e1n\"}', '992'),
(221, '{\"es\":\"Tailandia\",\"en\":\"Tailandia\"}', '66'),
(222, '{\"es\":\"Taiw\\u00e1n\",\"en\":\"Taiw\\u00e1n\"}', '886'),
(223, '{\"es\":\"Tanzania\",\"en\":\"Tanzania\"}', '255'),
(224, '{\"es\":\"Territorio Brit\\u00e1nico del Oc\\u00e9ano \\u00cdndico\",\"en\":\"Territorio Brit\\u00e1nico del Oc\\u00e9ano \\u00cdndico\"}', '0'),
(225, '{\"es\":\"Territorios Australes y Ant\\u00e1rticas Franceses\",\"en\":\"Territorios Australes y Ant\\u00e1rticas Franceses\"}', '0'),
(226, '{\"es\":\"Timor Oriental\",\"en\":\"Timor Oriental\"}', '670'),
(227, '{\"es\":\"Togo\",\"en\":\"Togo\"}', '228'),
(228, '{\"es\":\"Tokelau\",\"en\":\"Tokelau\"}', '690'),
(229, '{\"es\":\"Tonga\",\"en\":\"Tonga\"}', '676'),
(230, '{\"es\":\"Trinidad y Tobago\",\"en\":\"Trinidad y Tobago\"}', '868'),
(231, '{\"es\":\"Tunez\",\"en\":\"Tunez\"}', '216'),
(232, '{\"es\":\"Turkmenist\\u00e1n\",\"en\":\"Turkmenist\\u00e1n\"}', '993'),
(233, '{\"es\":\"Turqu\\u00eda\",\"en\":\"Turqu\\u00eda\"}', '90'),
(234, '{\"es\":\"Tuvalu\",\"en\":\"Tuvalu\"}', '688'),
(235, '{\"es\":\"Ucrania\",\"en\":\"Ucrania\"}', '380'),
(236, '{\"es\":\"Uganda\",\"en\":\"Uganda\"}', '256'),
(237, '{\"es\":\"Uruguay\",\"en\":\"Uruguay\"}', '598'),
(238, '{\"es\":\"Uzbekist\\u00e1n\",\"en\":\"Uzbekist\\u00e1n\"}', '998'),
(239, '{\"es\":\"Vanuatu\",\"en\":\"Vanuatu\"}', '678'),
(240, '{\"es\":\"Venezuela\",\"en\":\"Venezuela\"}', '58'),
(241, '{\"es\":\"Vietnam\",\"en\":\"Vietnam\"}', '84'),
(242, '{\"es\":\"Wallis y Futuna\",\"en\":\"Wallis y Futuna\"}', '681'),
(243, '{\"es\":\"Yemen\",\"en\":\"Yemen\"}', '967'),
(244, '{\"es\":\"Yibuti\",\"en\":\"Yibuti\"}', '253'),
(245, '{\"es\":\"Zambia\",\"en\":\"Zambia\"}', '260'),
(246, '{\"es\":\"Zimbabue\",\"en\":\"Zimbabue\"}', '263');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `name`) VALUES
(1, 'Bahía Maya');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `observations` text COLLATE utf8_unicode_ci,
  `cost` text COLLATE utf8_unicode_ci NOT NULL,
  `price` text COLLATE utf8_unicode_ci NOT NULL,
  `discount` text COLLATE utf8_unicode_ci NOT NULL,
  `availability` int(11) DEFAULT NULL,
  `cover` text COLLATE utf8_unicode_ci NOT NULL,
  `gallery` text COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `transportation` text COLLATE utf8_unicode_ci,
  `destination` bigint(20) NOT NULL,
  `provider` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tours`
--

INSERT INTO `tours` (`id`, `name`, `description`, `observations`, `cost`, `price`, `discount`, `availability`, `cover`, `gallery`, `location`, `transportation`, `destination`, `provider`) VALUES
(1, '{\"es\":\"Catamaran a Isla Mujeres\",\"en\":\"Catamaran to Isla Mujeres\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"44.63\",\"children\":\"25.73\"}', '{\"adults\":\"85\",\"children\":\"49\"}', '{\"amount\":\"25\",\"type\":\"%\"}', NULL, 'uzdaKXnjevhbVLOo.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 1, 1),
(2, '{\"es\":\"Arrecife y Chef\'s\",\"en\":\"Reef Xperience & Chef\'s choice\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"44.24\",\"children\":\"38.64\"}', '{\"adults\":\"79\",\"children\":\"69\"}', '{\"amount\":\"20\",\"type\":\"%\"}', NULL, 'r06T7H3YJO0TZ4Ts.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', '{\"lat\":\"21.1568572\",\"lng\":\"-86.8248852\"}', 3, 1),
(3, '{\"es\":\"Arrecife y Snack\'s\",\"en\":\"Reef Xperience & Snacks\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"38.64\",\"children\":\"33.04\"}', '{\"adults\":\"69\",\"children\":\"59\"}', '{\"amount\":\"20\",\"type\":\"%\"}', NULL, 'GRF8orVCZm4aY5Xi.png', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', '{\"lat\":\"21.1568572\",\"lng\":\"-86.8248852\"}', 3, 1),
(4, '{\"es\":\"Buceo - Certificado de 2 tanques\",\"en\":\"Diving Xperience - 2 tanks certificate\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"64.13\",\"children\":\"64.13\"}', '{\"adults\":\"95\",\"children\":\"95\"}', '{\"amount\":\"10\",\"type\":\"%\"}', NULL, 'wphj092MAxmiGabs.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 3, 1),
(5, '{\"es\":\"Buceo - Curso Discovery Scuba\",\"en\":\"Diving Xperience - Scuba discovery course\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"84.38\",\"children\":\"84.38\"}', '{\"adults\":\"125\",\"children\":\"125\"}', '{\"amount\":\"10\",\"type\":\"%\"}', NULL, 'CtUZsnz6QiQ3c7uB.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 3, 1),
(6, '{\"es\":\"Buceo - Curso en mar abierto\",\"en\":\"Diving Xperience - Open water course\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"303.75\",\"children\":\"303.75\"}', '{\"adults\":\"450\",\"children\":\"450\"}', '{\"amount\":\"10\",\"type\":\"%\"}', NULL, 'iDkIDCFFWuIazfCI.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 3, 1),
(7, '{\"es\":\"Pesca privada por 6 horas\",\"en\":\"Fishing Xperience - Private for 6 hours\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"664.88\",\"children\":\"664.88\"}', '{\"adults\":\"985\",\"children\":\"985\"}', '{\"amount\":\"10\",\"type\":\"%\"}', NULL, 'KuxOC33fTVSuvTYw.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 1, 1),
(8, '{\"es\":\"Pesca privada por 4 horas\",\"en\":\"Fishing Xperience - Private for 4 hours\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"536.63\",\"children\":\"536.63\"}', '{\"adults\":\"795\",\"children\":\"795\"}', '{\"amount\":\"10\",\"type\":\"%\"}', NULL, 'sTWk2ML6bUosiW2V.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 1, 1);
INSERT INTO `tours` (`id`, `name`, `description`, `observations`, `cost`, `price`, `discount`, `availability`, `cover`, `gallery`, `location`, `transportation`, `destination`, `provider`) VALUES
(9, '{\"es\":\"Pesca compartida por 4 horas\",\"en\":\"Fishing Xperience - Shared for 4 hours\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"es\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\",\"en\":\"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,\"}', '{\"adults\":\"104.63\",\"children\":\"104.63\"}', '{\"adults\":\"155\",\"children\":\"155\"}', '{\"amount\":\"10\",\"type\":\"%\"}', NULL, '2eplIszUFvy8BKlu.jpeg', '', '{\"lat\":\"21.152401\",\"lng\":\"-86.8055883\"}', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `promotional_code` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci,
  `user_level` bigint(20) NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `signup_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `profile`, `promotional_code`, `avatar`, `user_level`, `username`, `password`, `signup_date`, `status`) VALUES
(1, 'Exploore', 'Exploore', 'reservaciones@exploore.mx', '529984209029', NULL, 'EX18AZ', NULL, 1, 'reservaciones@exploore.mx', 'af961edf9e916cd19cf6457a6d25e721d32f284d:6IzVEPYnRBCkzC9z5WT3fj8h5r11id7vYWFZgYaib4gvewNyD0T7wrKOVzihIY5W', '2019-04-01', 1),
(2, 'Gersón', 'Gómez', 'gergomez18@gmail.com', '529988701057', NULL, 'XHU18N', NULL, 1, 'gerson@exploore.mx', 'af961edf9e916cd19cf6457a6d25e721d32f284d:6IzVEPYnRBCkzC9z5WT3fj8h5r11id7vYWFZgYaib4gvewNyD0T7wrKOVzihIY5W', '2019-04-01', 1),
(3, 'Jan', 'Flóres', 'jc.fd@outlook.es', '529984209029', NULL, 'BP9HS6', NULL, 1, 'jc.fd@outlook.es', 'c5690379874706cfbc6e74af78b86efef3c99eb6:XBOaKUZv3mrv8Vky4jkicRkUKg72hfQYMUUnEHiYuIEGNzJ5P3jjEh5SweSNbx0e', '2019-04-01', 1),
(4, 'Alexis', 'Orózco', 'livinglavidalocalmx@gmail.com', '529982147010', NULL, 'CORGBC', NULL, 2, 'livinglavidalocalmx@gmail.com', 'fc1f0e160ec381e2621b5b869b71eec697d10ee1:b7TvQxd6MDHJdNpuwwZJauwQZwKan1GezJ6yrusH2PyuTmaKKrypWF2hgtvnyQrd', '2019-07-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_levels`
--

CREATE TABLE `users_levels` (
  `id` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users_levels`
--

INSERT INTO `users_levels` (`id`, `name`, `code`, `priority`) VALUES
(1, 'Propietario', '{owner}', 1),
(2, 'Administrador', '{administrator}', 2),
(3, 'Anfitrión', '{host}', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour` (`tour`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `com_payment_invalid`
--
ALTER TABLE `com_payment_invalid`
  ADD PRIMARY KEY (`id_payment_invalid`);

--
-- Indices de la tabla `com_payment_settings`
--
ALTER TABLE `com_payment_settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indices de la tabla `com_payment_tmp`
--
ALTER TABLE `com_payment_tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indices de la tabla `com_payment_verified`
--
ALTER TABLE `com_payment_verified`
  ADD PRIMARY KEY (`id_payment_verified`);

--
-- Indices de la tabla `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ladas`
--
ALTER TABLE `ladas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination` (`destination`),
  ADD KEY `provider` (`provider`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `users_levels`
--
ALTER TABLE `users_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `com_payment_invalid`
--
ALTER TABLE `com_payment_invalid`
  MODIFY `id_payment_invalid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `com_payment_settings`
--
ALTER TABLE `com_payment_settings`
  MODIFY `id_setting` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `com_payment_tmp`
--
ALTER TABLE `com_payment_tmp`
  MODIFY `id_tmp` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `com_payment_verified`
--
ALTER TABLE `com_payment_verified`
  MODIFY `id_payment_verified` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ladas`
--
ALTER TABLE `ladas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users_levels`
--
ALTER TABLE `users_levels`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tour`) REFERENCES `tours` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`destination`) REFERENCES `destinations` (`id`),
  ADD CONSTRAINT `tours_ibfk_2` FOREIGN KEY (`provider`) REFERENCES `providers` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_level`) REFERENCES `users_levels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
