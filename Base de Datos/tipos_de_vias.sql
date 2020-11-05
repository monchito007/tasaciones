CREATE TABLE IF NOT EXISTS `tipos_de_via` ( `id` INT(3) NOT NULL AUTO_INCREMENT , `tipo` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `tipos_de_via` (`id`, `tipo`) VALUES
(1, 'arroyo'),
(2, 'avenida'),
(3, 'barrio'),
(4, 'bulevar'),
(5, 'calle'),
(6, 'callejón'),
(7, 'camino'),
(8, 'camino alto'),
(9, 'camino bajo'),
(10, 'camino viejo'),
(11, 'campillo'),
(12, 'carrera'),
(13, 'carretera'),
(14, 'cerrillo'),
(15, 'costanilla'),
(16, 'cuesta'),
(17, 'ensanche'),
(18, 'extrarradio'),
(19, 'glorieta'),
(20, 'interior'),
(21, 'pasadizo'),
(22, 'pasaje'),
(23, 'paseo'),
(24, 'paseo alto'),
(25, 'paseo bajo'),
(26, 'plaza'),
(27, 'pradera'),
(28, 'pasaje'),
(29, 'puente'),
(30, 'punto kilométrico'),
(31, 'rambla'),
(32, 'ribera'),
(33, 'ronda'),
(34, 'travesía'),
(35, 'vereda');

