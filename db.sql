CREATE DATABASE scmth;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usu` varchar(50) NOT NULL,
  `con` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` (`id`, `usu`, `con`, `nombre`, `correo`, `tipo`, `estado`) VALUES
(1, 'casar', '12345', 'Cesar','cesar@gmail.com', 'a', 'y'),
(2, 'memelo', '54321', 'Oscar','memelo@gmail.com', 'e', 'n'),
(3, 'memelo2', '12345', 'Oscar','memelo@gmail.com', 'e', 'y');