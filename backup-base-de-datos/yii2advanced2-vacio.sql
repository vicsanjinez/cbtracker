-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-03-2017 a las 02:48:07
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `yii2advanced2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `contenido` text COLLATE utf8_unicode_ci NOT NULL,
  `fechaevaluacion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `idusuario` bigint(40) NOT NULL,
  `idusuariodestino` bigint(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1489165081),
('m140209_132017_init', 1489165087),
('m140403_174025_create_account_table', 1489165089),
('m140504_113157_update_tables', 1489165094),
('m140504_130429_create_token_table', 1489165095),
('m140830_171933_fix_ip_field', 1489165096),
('m140830_172703_change_account_table_name', 1489165096);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `social_account`
--

INSERT INTO `social_account` (`id`, `user_id`, `provider`, `client_id`, `data`) VALUES
(1, NULL, 'twitter', '240085820', '{"id":240085820,"id_str":"240085820","name":"Victor Sanjinez","screen_name":"victorsanjinez","location":"Bolivia","description":"Developer","url":"https:\\/\\/t.co\\/WMmjE9r8fi","entities":{"url":{"urls":[{"url":"https:\\/\\/t.co\\/WMmjE9r8fi","expanded_url":"https:\\/\\/bo.linkedin.com\\/in\\/victor-sanjinez-78484170","display_url":"bo.linkedin.com\\/in\\/victor-sanj\\u2026","indices":[0,23]}]},"description":{"urls":[]}},"protected":false,"followers_count":32,"friends_count":453,"listed_count":1,"created_at":"Wed Jan 19 03:37:30 +0000 2011","favourites_count":162,"utc_offset":-14400,"time_zone":"La Paz","geo_enabled":true,"verified":false,"statuses_count":102,"lang":"es","status":{"created_at":"Tue Feb 21 20:44:55 +0000 2017","id":834141874696888320,"id_str":"834141874696888320","text":"RT @artsweb: Penetration Testing Tools Cheat Sheet - https:\\/\\/t.co\\/DuaAnDLwUD #infosec #seguridad #Pentesting","truncated":false,"entities":{"hashtags":[{"text":"infosec","indices":[77,85]},{"text":"seguridad","indices":[86,96]},{"text":"Pentesting","indices":[97,108]}],"symbols":[],"user_mentions":[{"screen_name":"artsweb","name":"Marcos","id":37233925,"id_str":"37233925","indices":[3,11]}],"urls":[{"url":"https:\\/\\/t.co\\/DuaAnDLwUD","expanded_url":"https:\\/\\/highon.coffee\\/blog\\/penetration-testing-tools-cheat-sheet\\/","display_url":"highon.coffee\\/blog\\/penetrati\\u2026","indices":[53,76]}]},"source":"<a href=\\"http:\\/\\/twitter.com\\/download\\/android\\" rel=\\"nofollow\\">Twitter for Android<\\/a>","in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"geo":null,"coordinates":null,"place":null,"contributors":null,"retweeted_status":{"created_at":"Mon Feb 20 14:31:01 +0000 2017","id":833685394088538114,"id_str":"833685394088538114","text":"Penetration Testing Tools Cheat Sheet - https:\\/\\/t.co\\/DuaAnDLwUD #infosec #seguridad #Pentesting","truncated":false,"entities":{"hashtags":[{"text":"infosec","indices":[64,72]},{"text":"seguridad","indices":[73,83]},{"text":"Pentesting","indices":[84,95]}],"symbols":[],"user_mentions":[],"urls":[{"url":"https:\\/\\/t.co\\/DuaAnDLwUD","expanded_url":"https:\\/\\/highon.coffee\\/blog\\/penetration-testing-tools-cheat-sheet\\/","display_url":"highon.coffee\\/blog\\/penetrati\\u2026","indices":[40,63]}]},"source":"<a href=\\"https:\\/\\/about.twitter.com\\/products\\/tweetdeck\\" rel=\\"nofollow\\">TweetDeck<\\/a>","in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"geo":null,"coordinates":null,"place":null,"contributors":null,"is_quote_status":false,"retweet_count":4,"favorite_count":19,"favorited":false,"retweeted":true,"possibly_sensitive":false,"lang":"en"},"is_quote_status":false,"retweet_count":4,"favorite_count":0,"favorited":false,"retweeted":true,"possibly_sensitive":false,"lang":"en"},"contributors_enabled":false,"is_translator":false,"is_translation_enabled":true,"profile_background_color":"000305","profile_background_image_url":"http:\\/\\/pbs.twimg.com\\/profile_background_images\\/261330441\\/Jackass-3DMOD_2.jpg","profile_background_image_url_https":"https:\\/\\/pbs.twimg.com\\/profile_background_images\\/261330441\\/Jackass-3DMOD_2.jpg","profile_background_tile":false,"profile_image_url":"http:\\/\\/pbs.twimg.com\\/profile_images\\/820363093230419973\\/0YR3I6CY_normal.jpg","profile_image_url_https":"https:\\/\\/pbs.twimg.com\\/profile_images\\/820363093230419973\\/0YR3I6CY_normal.jpg","profile_banner_url":"https:\\/\\/pbs.twimg.com\\/profile_banners\\/240085820\\/1403822626","profile_link_color":"0084B4","profile_sidebar_border_color":"7CB3CF","profile_sidebar_fill_color":"000305","profile_text_color":"EBF5F4","profile_use_background_image":true,"has_extended_profile":false,"default_profile":false,"default_profile_image":false,"following":false,"follow_request_sent":false,"notifications":false,"translator_type":"none"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `registration_ip` bigint(20) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` text COLLATE utf8_unicode_ci NOT NULL,
  `localizacion` text COLLATE utf8_unicode_ci NOT NULL,
  `fechacreacion` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
