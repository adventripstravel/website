-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-01-2021 a las 18:03:46
-- Versión del servidor: 10.0.38-MariaDB-0+deb8u1
-- Versión de PHP: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ad-website`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) NOT NULL,
  `folio` varchar(8) DEFAULT NULL,
  `customer_email` text,
  `customer_name` text,
  `reservation_date` datetime DEFAULT NULL,
  `status` set('available','finalized','no_show','cancelled','removed') NOT NULL DEFAULT 'available',
  `data` longtext,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` set('pending_payment','reserved_payment','full_payment') NOT NULL DEFAULT 'pending_payment',
  `__session` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bookings`
--

INSERT INTO `bookings` (`id`, `folio`, `customer_email`, `customer_name`, `reservation_date`, `status`, `data`, `creation_date`, `payment_status`, `__session`) VALUES
(1, 'WAJNTCOC', 'davidgomezmacias@gmail.com', 'David Miguel Gomez Macias', '2020-11-14 14:00:00', 'available', 'a:4:{s:8:\"customer\";a:3:{s:4:\"name\";s:25:\"David Miguel Gomez Macias\";s:5:\"email\";s:26:\"davidgomezmacias@gmail.com\";s:5:\"phone\";s:12:\"529982904203\";}s:11:\"reservation\";a:5:{s:3:\"pax\";a:3:{s:6:\"adults\";s:1:\"2\";s:9:\"childrens\";i:0;s:5:\"babys\";i:0;}s:4:\"date\";s:10:\"2020-11-14\";s:4:\"hour\";s:8:\"14:00:00\";s:5:\"hotel\";a:2:{s:4:\"name\";s:3:\"RIU\";s:4:\"room\";s:3:\"855\";}s:4:\"tour\";a:2:{s:4:\"name\";s:12:\"Isla mujeres\";s:5:\"price\";s:4:\"1200\";}}s:7:\"payment\";a:4:{s:8:\"discount\";N;s:12:\"type_payment\";s:4:\"cash\";s:8:\"subtotal\";s:4:\"1200\";s:5:\"total\";s:4:\"1200\";}s:8:\"metadata\";a:1:{s:7:\"version\";s:5:\"1.0.0\";}}', '2020-11-13 14:29:54', 'pending_payment', 'a:3:{s:4:\"user\";s:6:\"dgomez\";s:2:\"id\";s:1:\"1\";s:5:\"token\";a:3:{i:0;s:1:\"1\";i:1;s:4:\"F0iD\";i:2;s:128:\"k5SX2WEuXYCAANy4OOgPGm4CuHN5OfMQQ7myJStb5edDYYVv8iCbHcKIt34i424JbbzyUqM8XpVbn0UO6nZEyye2eM6tMXXebxulwIQUVwRfIhuGJozIgULTEOIoiAZ7\";}}'),
(2, 'UKMXAEBS', 'davidgomezmacias@gmail.com', 'David Miguel Gomez Macias', '2020-11-14 17:03:00', 'available', 'a:4:{s:8:\"customer\";a:3:{s:4:\"name\";s:25:\"David Miguel Gomez Macias\";s:5:\"email\";s:26:\"davidgomezmacias@gmail.com\";s:5:\"phone\";s:12:\"529982904203\";}s:11:\"reservation\";a:5:{s:3:\"pax\";a:3:{s:6:\"adults\";s:1:\"2\";s:9:\"childrens\";s:1:\"1\";s:5:\"babys\";i:0;}s:4:\"date\";s:10:\"2020-11-14\";s:4:\"hour\";s:8:\"17:03:00\";s:5:\"hotel\";a:2:{s:4:\"name\";s:3:\"RIU\";s:4:\"room\";s:3:\"855\";}s:4:\"tour\";a:2:{s:4:\"name\";s:12:\"Isla mujeres\";s:5:\"price\";s:4:\"4000\";}}s:7:\"payment\";a:4:{s:8:\"discount\";N;s:12:\"type_payment\";s:4:\"cash\";s:8:\"subtotal\";s:4:\"4000\";s:5:\"total\";s:4:\"4000\";}s:8:\"metadata\";a:1:{s:7:\"version\";s:5:\"1.0.0\";}}', '2020-11-13 15:16:16', 'pending_payment', 'a:3:{s:4:\"user\";s:6:\"dgomez\";s:2:\"id\";s:1:\"1\";s:5:\"token\";a:3:{i:0;s:1:\"1\";i:1;s:4:\"F0iD\";i:2;s:128:\"k5SX2WEuXYCAANy4OOgPGm4CuHN5OfMQQ7myJStb5edDYYVv8iCbHcKIt34i424JbbzyUqM8XpVbn0UO6nZEyye2eM6tMXXebxulwIQUVwRfIhuGJozIgULTEOIoiAZ7\";}}'),
(3, 'NSNFPZDL', 'gergomez18@gmail.com', 'Gersón Gómez', '2020-11-20 09:09:00', 'available', 'a:4:{s:8:\"customer\";a:3:{s:4:\"name\";s:14:\"Gersón Gómez\";s:5:\"email\";s:20:\"gergomez18@gmail.com\";s:5:\"phone\";s:12:\"529981579343\";}s:11:\"reservation\";a:5:{s:3:\"pax\";a:3:{s:6:\"adults\";s:1:\"2\";s:9:\"childrens\";s:1:\"1\";s:5:\"babys\";i:0;}s:4:\"date\";s:10:\"2020-11-20\";s:4:\"hour\";s:8:\"09:09:00\";s:5:\"hotel\";a:2:{s:4:\"name\";s:10:\"Riu Holbox\";s:4:\"room\";s:2:\"24\";}s:4:\"tour\";a:2:{s:4:\"name\";s:10:\"Holbox 2x1\";s:5:\"price\";s:4:\"1300\";}}s:7:\"payment\";a:4:{s:8:\"discount\";N;s:12:\"type_payment\";s:4:\"cash\";s:8:\"subtotal\";s:4:\"1300\";s:5:\"total\";s:4:\"1300\";}s:8:\"metadata\";a:1:{s:7:\"version\";s:5:\"1.0.0\";}}', '2020-11-15 12:06:35', 'pending_payment', 'a:3:{s:4:\"user\";s:19:\"vale@adventrips.com\";s:2:\"id\";s:1:\"3\";s:5:\"token\";s:128:\"R0uuuNx5L9kvltl8J9CFpC5fIZXHozXIJIKkAQmo7rPrlIyYQ568T4ABq0DSpPY3NOK60Ruac4zfo1Y5kgAjU6gt8lDgq9d1GVJbaLM6pa1rLyVAfQ4TdOmi8cQam9oK\";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `title` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `levels`
--

INSERT INTO `levels` (`id`, `code`, `title`) VALUES
(1, '{sysadmin}', 'Administrador de sistemas'),
(2, '{administrator}', 'Administrador'),
(11, '{customer}', 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `title` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `code`, `title`) VALUES
(1, '{users_read}', 'Ver los usuarios.'),
(2, '{users_create}', 'Crear usuarios.'),
(3, '{users_update}', 'Modificar usuarios.'),
(4, '{users_delete}', 'Eliminar usuarios.'),
(5, '{help_development}', 'Ayuda para desarrolladores.'),
(6, '{reservations_read}', 'Ver reservaciones.'),
(7, '{reservations_create}', 'Crear reservaciones.'),
(8, '{reservations_update}', 'Modificar reservaciones.'),
(9, '{reservations_delete}', 'Eliminar reservaciones.'),
(10, '{reservations_status}', 'Cambiar el estado de la reservación.'),
(11, '{reservations_payment}', 'Cambiar el estado de pago de la reservación.'),
(12, '{permissions_read}', 'Ver los permisos de usuario.'),
(13, '{permissions_create}', 'Crear permisos de usuario.'),
(14, '{permissions_delete}', 'Eliminar permisos de usuario.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `token` longtext NOT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL,
  `connection` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `id_user`, `token`, `login_date`, `logout_date`, `connection`) VALUES
(1, 1, 'tJqNz35G6BfJP14tgSdwyBtNWgbmhonDOq2rs8jps0Vsby2175CtRgq5phjTTMgDXhiGMNapVBiAb1Q9aZ2WaOEoX5wciqdhwVOpYFkUNUr1ZQaR9WAACDy9QBeHCEwf', '2020-11-06 16:44:03', '2020-11-06 17:15:20', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(2, 1, 'HUJMVXqLpBaq44OBaArbX1wX6i5UAsUVN8D9w3dreMtZehH6jy5ZhTMAppLZLW37c6bEHkFMtkT3KDUwBAZB68cMCS9Ujn3d5vvggEz8pFeAjT77oLbN5GTkUy8EiBSS', '2020-11-06 17:15:23', '2020-11-06 17:19:08', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(3, 1, 'Knf7bOeMkHHhNT9YB27GgRnr8MCOdrHFS0MqbAQwNq7O4G4GxmqGVtMb6Nw930qOXZB3mRrsFI2lvdRSd7N5Myy9h5wkWdrv9y9yZ555ZP4w6tEJeFbESOx26oFIz7AC', '2020-11-06 17:19:12', '2020-11-06 17:20:03', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(4, 1, '1gkg8mPtEaAjtImu7m1i7OHqfB5AHB76hlMMfnEB0tPvEN5CCb5lBonRr74aAA82Qrh140yr0YCzpiLdVdXKEjOpR7ZSvBz3FirIJV9cc5JYe0xRsmGiQBW2KQugcr2o', '2020-11-06 17:20:07', '2020-11-06 17:21:14', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(5, 1, 'k5SX2WEuXYCAANy4OOgPGm4CuHN5OfMQQ7myJStb5edDYYVv8iCbHcKIt34i424JbbzyUqM8XpVbn0UO6nZEyye2eM6tMXXebxulwIQUVwRfIhuGJozIgULTEOIoiAZ7', '2020-11-06 17:21:17', NULL, 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(6, 2, 'fu20mGcyVsccThYYaaMgqfRKbUnsn0MOfUoHQJD4cAN9dvQ6AT8TGF9XM2JvzhvFGsqSrp6ftYU5SiY38UUlMRFPDeeie7eDNE267eUUNq0RTd0vn1UpL49FSxdQCbe8', '2020-11-14 15:47:21', NULL, 'a:5:{s:2:\"ip\";s:14:\"187.189.50.142\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36\";}'),
(7, 2, 'KvrYbX7kqMqTUH0tYKK77UwmqXk1W6u78xNMgwOKjozRvBcWRv0rSHOgWE1yUuk23FrTD0N6ixBpWcrjSX2ZJl55xEWnG6d379IrnbhgtiLqU451ewJDHg1xYm8H0Anh', '2020-11-15 11:48:55', '2020-11-15 12:02:08', 'a:5:{s:2:\"ip\";s:14:\"187.189.50.142\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36\";}'),
(8, 3, 'R0uuuNx5L9kvltl8J9CFpC5fIZXHozXIJIKkAQmo7rPrlIyYQ568T4ABq0DSpPY3NOK60Ruac4zfo1Y5kgAjU6gt8lDgq9d1GVJbaLM6pa1rLyVAfQ4TdOmi8cQam9oK', '2020-11-15 12:02:26', NULL, 'a:5:{s:2:\"ip\";s:14:\"187.189.50.142\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36\";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` text,
  `name` text,
  `email` text,
  `phone` bigint(20) DEFAULT NULL,
  `password` text,
  `id_level` bigint(20) DEFAULT NULL,
  `permissions` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `phone`, `password`, `id_level`, `permissions`) VALUES
(1, 'dgomez', 'Administrador', 'davidgomezmacias@gmail.com', 529981904203, '1b42f6b8eb057aa91ffd85f945efa7c0cb65a3ca:Jq2CpecTSBjDX14rOyG47dEv6jDGUW22P8FBR8uk7NWESr4E9gxDFGUVO3078rx8', 1, 'a:14:{i:0;s:12:\"{users_read}\";i:1;s:14:\"{users_create}\";i:2;s:14:\"{users_update}\";i:3;s:14:\"{users_delete}\";i:4;s:18:\"{help_development}\";i:5;s:19:\"{reservations_read}\";i:6;s:21:\"{reservations_create}\";i:7;s:21:\"{reservations_update}\";i:8;s:21:\"{reservations_delete}\";i:9;s:21:\"{reservations_status}\";i:10;s:22:\"{reservations_payment}\";i:11;s:18:\"{permissions_read}\";i:12;s:20:\"{permissions_create}\";i:13;s:20:\"{permissions_delete}\";}'),
(2, 'ggomez', 'Gersón Gómez Macías', 'ggomez@codemonkey.com.mx', 52, '5534895f13296c960a447b5fc3a35710ba6d1509:Qj0FfImGd4DcfipnLFBvscsVfRUfTX8djnzRF8wCfiwI4hbuU3ryrfnCNOyMIRYJ', 1, 'a:14:{i:0;s:12:\"{users_read}\";i:1;s:14:\"{users_create}\";i:2;s:14:\"{users_update}\";i:3;s:14:\"{users_delete}\";i:4;s:18:\"{help_development}\";i:5;s:19:\"{reservations_read}\";i:6;s:21:\"{reservations_create}\";i:7;s:21:\"{reservations_update}\";i:8;s:21:\"{reservations_delete}\";i:9;s:21:\"{reservations_status}\";i:10;s:22:\"{reservations_payment}\";i:11;s:18:\"{permissions_read}\";i:12;s:20:\"{permissions_create}\";i:13;s:20:\"{permissions_delete}\";}'),
(3, 'vale@adventrips.com', 'Valentina Uitzil', 'vale@adventrips.com', 52, '58e0949255c7e6d30f772e65a908bebf82c6107a:eurJlOOqwBcAGUL9SPFX37JAaHOXh2yDcl8o5sToyrvaynupnqbytcx7sDUAy07T', 1, 'a:14:{i:0;s:12:\"{users_read}\";i:1;s:14:\"{users_create}\";i:2;s:14:\"{users_update}\";i:3;s:14:\"{users_delete}\";i:4;s:18:\"{help_development}\";i:5;s:19:\"{reservations_read}\";i:6;s:21:\"{reservations_create}\";i:7;s:21:\"{reservations_update}\";i:8;s:21:\"{reservations_delete}\";i:9;s:21:\"{reservations_status}\";i:10;s:22:\"{reservations_payment}\";i:11;s:18:\"{permissions_read}\";i:12;s:20:\"{permissions_create}\";i:13;s:20:\"{permissions_delete}\";}');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level` (`id_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
