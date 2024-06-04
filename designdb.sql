-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2024 a las 15:14:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `designdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idadministrador` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategorias` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategorias`, `nombre`) VALUES
(1, 'Entradas'),
(2, 'Sopas'),
(3, 'Platos fuertes'),
(4, 'Postres'),
(5, 'Bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `iddetalle_pedidos` int(11) NOT NULL,
  `pedidocrt_idpe` int(11) NOT NULL,
  `productos_idproductos` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` decimal(20,2) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mesas`
--

CREATE TABLE `estado_mesas` (
  `idestado_mesas` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE `estado_pedido` (
  `idestado_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_pago`
--

CREATE TABLE `medio_pago` (
  `idmedio_pago` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `idmesas` int(11) NOT NULL,
  `numerom` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `estado_mesas_idestado_mesas` int(11) NOT NULL,
  `meseros_idmeseros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meseros`
--

CREATE TABLE `meseros` (
  `idmeseros` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rol_idrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL,
  `pedidos_idpedidos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `medio_pago_idmedio_pago` int(11) NOT NULL,
  `monto` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidocrt`
--

CREATE TABLE `pedidocrt` (
  `idpe` int(11) NOT NULL,
  `clevetransa` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(60,2) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidocrt`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedidos` int(11) NOT NULL,
  `mesas_idmesas` int(11) NOT NULL,
  `meseros_idmeseros` int(11) NOT NULL,
  `estado_pedido_idestado_pedido` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `categorias_idcategorias` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproductos`, `nombre`, `categorias_idcategorias`, `precio`, `imagen`, `descripcion`) VALUES
(10, 'Empana de viento', 1, '5', 'admin/img/empanadaviento.jpg', 'Empanada de harina con brisa del mar adentro'),
(11, 'Caldo de gallina', 2, '70', 'admin/img/sopagallina.jpg', 'Sopas echas por el niño de la propaganda de ricostilla'),
(12, 'Fritada', 3, '80', 'admin/img/fritada.jpg', 'Deliciosas fritadas echas por la vieja petra'),
(15, 'Churrasco', 3, '90', 'admin/img/churrasco.jpg', 'Delicioso churrasco echo por manos de calle larga'),
(20, 'Empanadas de morocho', 1, '4', 'admin/img/empanadamorocho.jpg', 'Deliciosas empanadas echas por chamos de caracas '),
(22, 'Locro quiteño', 2, '1', 'admin/img/locro.jpg', 'Especialidad de Ecuador'),
(30, 'Tamales', 1, '10', 'admin/img/Tamales.jpg', 'Tamales de la casa, mis vales presentación especial'),
(33, 'Sopas de bola verde', 2, '40', 'admin/img/sopaverde.jpg', 'Deliciosas sopas de bola de chivo'),
(40, 'Salsa blanca con tomate', 1, '50', 'admin/img/salsa.jfif', 'Salsa blanca, el precio es porque duras jarto una semana '),
(50, 'Espinaca con aguacate', 1, '60', 'admin/img/espinaca.jfif', 'Espinacas de la casa, te da las fuerzas de popeye'),
(111, 'Sandwich de vegetales', 3, '40', 'admin/img/sanvegetal.jpg', 'En mis vales puedes disfrutar de los mas deliciosos sandwich hechos para ti con hiervas finas del campo cordobes'),
(112, 'Helados', 4, '2', 'admin/img/helado.jpg', 'Deliciosos helados hechos con leche de chivo mezclada con leche condensada '),
(113, 'Tres leches ', 4, '30', 'admin/img/tresleches.jpg', 'Delicioso postres tres leches, leche de chivo, leche de vaca y leche de burra'),
(114, 'Mouse de mora', 4, '3', 'admin/img/mora.jpg', 'Deliciosos Mouse de mora con trosos de amor'),
(116, 'Postre nubes', 4, '2', 'admin/img/postrenube.jpg', 'Delicioso postre con trosos de nubes de la sierra nevada de santa marta'),
(123, 'Arroz marinero', 3, '10', 'admin/img/arrozmarinero.jpg', 'Disfruta del mas delicioso arroz de semana santa'),
(124, 'Filete de res en salsa', 3, '90', 'admin/img/fileteres.jpg', 'Disfruta de la mas deliciosa carne de los potreros de san andrés'),
(132, 'Jugo de naranja', 5, '1', 'admin/img/jugonaranja.jpg', 'Jugo de naranja echo con las naranjas del vecino de mi vale'),
(136, 'Jugo de kiwi', 5, '2', 'admin/img/kiwi.jpg', 'Jugo de kiwi delicioso con fruticas de perico lijero'),
(142, 'Cecina lojana', 3, '70', 'admin/img/lojana.jpg', 'Deliciosa Cecina echas por madres chinuanas'),
(152, 'Jugo de tomate', 5, '5', 'admin/img/tomate.jpg', 'Si quieres echar el polvo con tu mujer tomate un juguito de tomate en mis vales'),
(200, 'Ron diablo', 5, '90', 'admin/img/ron.jpg', 'Pierdete en el inframundo del ron '),
(201, 'Cerveza', 5, '20', 'admin/img/cerveza.jpg', 'Cerveza con levadura de harina de promasa bien fria'),
(1122, 'pollo frito', 1, '46545', 'admin/img/ron.jpg', 'kdfgijdirjg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idadministrador`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategorias`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`iddetalle_pedidos`),
  ADD KEY `fk_detalle_pedidos_productos1_idx` (`productos_idproductos`),
  ADD KEY `pedidocrt_idpe` (`pedidocrt_idpe`);

--
-- Indices de la tabla `estado_mesas`
--
ALTER TABLE `estado_mesas`
  ADD PRIMARY KEY (`idestado_mesas`);

--
-- Indices de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  ADD PRIMARY KEY (`idestado_pedido`);

--
-- Indices de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  ADD PRIMARY KEY (`idmedio_pago`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`idmesas`),
  ADD KEY `fk_mesas_estado_mesas1_idx` (`estado_mesas_idestado_mesas`),
  ADD KEY `fk_mesas_meseros1_idx` (`meseros_idmeseros`);

--
-- Indices de la tabla `meseros`
--
ALTER TABLE `meseros`
  ADD PRIMARY KEY (`idmeseros`),
  ADD KEY `fk_meseros_rol1_idx` (`rol_idrol`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `fk_pago_pedidos1_idx` (`pedidos_idpedidos`),
  ADD KEY `fk_pago_medio_pago1_idx` (`medio_pago_idmedio_pago`);

--
-- Indices de la tabla `pedidocrt`
--
ALTER TABLE `pedidocrt`
  ADD PRIMARY KEY (`idpe`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedidos`),
  ADD UNIQUE KEY `idpedidos` (`idpedidos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproductos`),
  ADD KEY `fk_productos_categorias_idx` (`categorias_idcategorias`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `iddetalle_pedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  MODIFY `idmedio_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidocrt`
--
ALTER TABLE `pedidocrt`
  MODIFY `idpe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`pedidocrt_idpe`) REFERENCES `pedidocrt` (`idpe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_pedidos_productos1` FOREIGN KEY (`productos_idproductos`) REFERENCES `productos` (`idproductos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `fk_mesas_estado_mesas1` FOREIGN KEY (`estado_mesas_idestado_mesas`) REFERENCES `estado_mesas` (`idestado_mesas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mesas_meseros1` FOREIGN KEY (`meseros_idmeseros`) REFERENCES `meseros` (`idmeseros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `meseros`
--
ALTER TABLE `meseros`
  ADD CONSTRAINT `fk_meseros_rol1` FOREIGN KEY (`rol_idrol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_medio_pago1` FOREIGN KEY (`medio_pago_idmedio_pago`) REFERENCES `medio_pago` (`idmedio_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pago_pedidos1` FOREIGN KEY (`pedidos_idpedidos`) REFERENCES `pedidos` (`idpedidos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_estado_pedido1` FOREIGN KEY (`estado_pedido_idestado_pedido`) REFERENCES `estado_pedido` (`idestado_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedidos_mesas1` FOREIGN KEY (`mesas_idmesas`) REFERENCES `mesas` (`idmesas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedidos_meseros1` FOREIGN KEY (`meseros_idmeseros`) REFERENCES `meseros` (`idmeseros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`categorias_idcategorias`) REFERENCES `categorias` (`idcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
