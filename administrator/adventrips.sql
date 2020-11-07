-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-11-2020 a las 10:29:51
-- Versión del servidor: 10.5.5-MariaDB-1:10.5.5+maria~buster
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adventrips`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `title` text DEFAULT NULL
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
  `title` text DEFAULT NULL
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
  `connection` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `id_user`, `token`, `login_date`, `logout_date`, `connection`) VALUES
(1, 1, 'tJqNz35G6BfJP14tgSdwyBtNWgbmhonDOq2rs8jps0Vsby2175CtRgq5phjTTMgDXhiGMNapVBiAb1Q9aZ2WaOEoX5wciqdhwVOpYFkUNUr1ZQaR9WAACDy9QBeHCEwf', '2020-11-06 16:44:03', '2020-11-06 17:15:20', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(2, 1, 'HUJMVXqLpBaq44OBaArbX1wX6i5UAsUVN8D9w3dreMtZehH6jy5ZhTMAppLZLW37c6bEHkFMtkT3KDUwBAZB68cMCS9Ujn3d5vvggEz8pFeAjT77oLbN5GTkUy8EiBSS', '2020-11-06 17:15:23', '2020-11-06 17:19:08', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(3, 1, 'Knf7bOeMkHHhNT9YB27GgRnr8MCOdrHFS0MqbAQwNq7O4G4GxmqGVtMb6Nw930qOXZB3mRrsFI2lvdRSd7N5Myy9h5wkWdrv9y9yZ555ZP4w6tEJeFbESOx26oFIz7AC', '2020-11-06 17:19:12', '2020-11-06 17:20:03', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(4, 1, '1gkg8mPtEaAjtImu7m1i7OHqfB5AHB76hlMMfnEB0tPvEN5CCb5lBonRr74aAA82Qrh140yr0YCzpiLdVdXKEjOpR7ZSvBz3FirIJV9cc5JYe0xRsmGiQBW2KQugcr2o', '2020-11-06 17:20:07', '2020-11-06 17:21:14', 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}'),
(5, 1, 'k5SX2WEuXYCAANy4OOgPGm4CuHN5OfMQQ7myJStb5edDYYVv8iCbHcKIt34i424JbbzyUqM8XpVbn0UO6nZEyye2eM6tMXXebxulwIQUVwRfIhuGJozIgULTEOIoiAZ7', '2020-11-06 17:21:17', NULL, 'a:5:{s:2:\"ip\";s:9:\"127.0.0.1\";s:7:\"browser\";s:6:\"CHROME\";s:6:\"device\";s:7:\"Desktop\";s:2:\"so\";s:3:\"WIN\";s:15:\"HTTP_USER_AGENT\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.183 Safari/537.36\";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `id_level` bigint(20) DEFAULT NULL,
  `permissions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `phone`, `password`, `id_level`, `permissions`) VALUES
(1, 'dgomez', 'Administrador', 'davidgomezmacias@gmail.com', 529981904203, '1b42f6b8eb057aa91ffd85f945efa7c0cb65a3ca:Jq2CpecTSBjDX14rOyG47dEv6jDGUW22P8FBR8uk7NWESr4E9gxDFGUVO3078rx8', 1, 'a:14:{i:0;s:12:\"{users_read}\";i:1;s:14:\"{users_create}\";i:2;s:14:\"{users_update}\";i:3;s:14:\"{users_delete}\";i:4;s:18:\"{help_development}\";i:5;s:19:\"{reservations_read}\";i:6;s:21:\"{reservations_create}\";i:7;s:21:\"{reservations_update}\";i:8;s:21:\"{reservations_delete}\";i:9;s:21:\"{reservations_status}\";i:10;s:22:\"{reservations_payment}\";i:11;s:18:\"{permissions_read}\";i:12;s:20:\"{permissions_create}\";i:13;s:20:\"{permissions_delete}\";}'),
(2, 'ggomez', 'Gersón Gómez Macías', 'ggomez@codemonkey.com.mx', 52, '0a3e07024e4b47f5707011f1e04b773847cc9a34:vBi30S3SX872CWnOrZtyZS8DKzlfQfez1PNcjlEJJsjmUD4uawAPTqR5mWto94U7', 1, 'a:14:{i:0;s:12:\"{users_read}\";i:1;s:14:\"{users_create}\";i:2;s:14:\"{users_update}\";i:3;s:14:\"{users_delete}\";i:4;s:18:\"{help_development}\";i:5;s:19:\"{reservations_read}\";i:6;s:21:\"{reservations_create}\";i:7;s:21:\"{reservations_update}\";i:8;s:21:\"{reservations_delete}\";i:9;s:21:\"{reservations_status}\";i:10;s:22:\"{reservations_payment}\";i:11;s:18:\"{permissions_read}\";i:12;s:20:\"{permissions_create}\";i:13;s:20:\"{permissions_delete}\";}');

--
-- Índices para tablas volcadas
--

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
