-- MySQL Workbench Forward Engineering


-- -----------------------------------------------------
-- Schema designdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema designdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `designdb` DEFAULT CHARACTER SET utf8mb4 ;
USE `designdb` ;

-- -----------------------------------------------------
-- Table `designdb`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`administrador` (
  `idadministrador` INT(11) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idadministrador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`categorias` (
  `idcategorias` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategorias`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`estado_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`estado_pedido` (
  `idestado_pedido` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idestado_pedido`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`estado_mesas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`estado_mesas` (
  `idestado_mesas` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idestado_mesas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`rol` (
  `idrol` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idrol`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`meseros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`meseros` (
  `idmeseros` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `rol_idrol` INT(11) NOT NULL,
  PRIMARY KEY (`idmeseros`),
  INDEX `fk_meseros_rol1_idx` (`rol_idrol` ) ,
  CONSTRAINT `fk_meseros_rol1`
    FOREIGN KEY (`rol_idrol`)
    REFERENCES `designdb`.`rol` (`idrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`mesas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`mesas` (
  `idmesas` INT(11) NOT NULL,
  `numerom` INT(11) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `estado_mesas_idestado_mesas` INT(11) NOT NULL,
  `meseros_idmeseros` INT(11) NOT NULL,
  PRIMARY KEY (`idmesas`),
  INDEX `fk_mesas_estado_mesas1_idx` (`estado_mesas_idestado_mesas` ) ,
  INDEX `fk_mesas_meseros1_idx` (`meseros_idmeseros` ) ,
  CONSTRAINT `fk_mesas_estado_mesas1`
    FOREIGN KEY (`estado_mesas_idestado_mesas`)
    REFERENCES `designdb`.`estado_mesas` (`idestado_mesas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mesas_meseros1`
    FOREIGN KEY (`meseros_idmeseros`)
    REFERENCES `designdb`.`meseros` (`idmeseros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`pedidos` (
  `idpedidos` INT(11) NOT NULL,
  `mesas_idmesas` INT(11) NOT NULL,
  `meseros_idmeseros` INT(11) NOT NULL,
  `estado_pedido_idestado_pedido` INT(11) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `turno` INT(11) NOT NULL,
  PRIMARY KEY (`idpedidos`),
  INDEX `fk_pedidos_mesas1_idx` (`mesas_idmesas` ) ,
  INDEX `fk_pedidos_meseros1_idx` (`meseros_idmeseros` ) ,
  INDEX `fk_pedidos_estado_pedido1_idx` (`estado_pedido_idestado_pedido` ) ,
  CONSTRAINT `fk_pedidos_estado_pedido1`
    FOREIGN KEY (`estado_pedido_idestado_pedido`)
    REFERENCES `designdb`.`estado_pedido` (`idestado_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_mesas1`
    FOREIGN KEY (`mesas_idmesas`)
    REFERENCES `designdb`.`mesas` (`idmesas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_meseros1`
    FOREIGN KEY (`meseros_idmeseros`)
    REFERENCES `designdb`.`meseros` (`idmeseros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`productos` (
  `idproductos` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `categorias_idcategorias` INT(11) NOT NULL,
  `precio` DECIMAL(10,0) NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`idproductos`),
  INDEX `fk_productos_categorias_idx` (`categorias_idcategorias` ) ,
  CONSTRAINT `fk_productos_categorias`
    FOREIGN KEY (`categorias_idcategorias`)
    REFERENCES `designdb`.`categorias` (`idcategorias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`detalle_pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`detalle_pedidos` (
  `iddetalle_pedidos` INT(11) NOT NULL,
  `pedidos_idpedidos` INT(11) NOT NULL,
  `productos_idproductos` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  PRIMARY KEY (`iddetalle_pedidos`),
  INDEX `fk_detalle_pedidos_pedidos1_idx` (`pedidos_idpedidos` ) ,
  INDEX `fk_detalle_pedidos_productos1_idx` (`productos_idproductos` ) ,
  CONSTRAINT `fk_detalle_pedidos_pedidos1`
    FOREIGN KEY (`pedidos_idpedidos`)
    REFERENCES `designdb`.`pedidos` (`idpedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedidos_productos1`
    FOREIGN KEY (`productos_idproductos`)
    REFERENCES `designdb`.`productos` (`idproductos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`medio_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`medio_pago` (
  `idmedio_pago` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmedio_pago`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `designdb`.`pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `designdb`.`pago` (
  `idpago` INT(11) NOT NULL,
  `pedidos_idpedidos` INT(11) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `medio_pago_idmedio_pago` INT(11) NOT NULL,
  `monto` DECIMAL(10,0) NOT NULL,
  PRIMARY KEY (`idpago`),
  INDEX `fk_pago_pedidos1_idx` (`pedidos_idpedidos` ) ,
  INDEX `fk_pago_medio_pago1_idx` (`medio_pago_idmedio_pago` ) ,
  CONSTRAINT `fk_pago_medio_pago1`
    FOREIGN KEY (`medio_pago_idmedio_pago`)
    REFERENCES `designdb`.`medio_pago` (`idmedio_pago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_pedidos1`
    FOREIGN KEY (`pedidos_idpedidos`)
    REFERENCES `designdb`.`pedidos` (`idpedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;
