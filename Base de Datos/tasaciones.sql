CREATE TABLE IF NOT EXISTS `tasaciones` ( 
`id` INT(5) NOT NULL AUTO_INCREMENT , 
`comunidad_id` INT(5) NOT NULL , 
`provincia_id` INT(5) NOT NULL , 
`municipio_id` INT(5) NOT NULL , 
`direccion` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , 
`metros_reales` FLOAT(5,2) NOT NULL , 
`metros_computados` FLOAT(5,2) NOT NULL , 
`valor_metros_cuadrados` FLOAT(5,2) NOT NULL , 
`archivo` VARCHAR(20) NOT NULL ,
PRIMARY KEY (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_spanish_ci;