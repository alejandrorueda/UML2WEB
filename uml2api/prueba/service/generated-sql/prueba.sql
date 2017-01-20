
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Usuario
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Usuario`;

CREATE TABLE `Usuario`
(
    `idusuario` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `email` VARCHAR(1) NOT NULL,
    `avatar` VARCHAR(255) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(100) NOT NULL,
    `fkperfil` INTEGER NOT NULL,
    `descendant_class` VARCHAR(100),
    PRIMARY KEY (`idusuario`),
    UNIQUE INDEX `ix_email_` (`email`),
    INDEX `Usuario_fi_96a8b0` (`fkperfil`),
    CONSTRAINT `Usuario_fk_96a8b0`
        FOREIGN KEY (`fkperfil`)
        REFERENCES `Perfil` (`idPerfil`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- amigos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `amigos`;

CREATE TABLE `amigos`
(
    `idUsuario` VARCHAR(50) NOT NULL,
    `relacionusuario` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`idUsuario`,`relacionusuario`),
    INDEX `fi_acionusuario_Usuario` (`relacionusuario`),
    CONSTRAINT `Usuario_usuario`
        FOREIGN KEY (`idUsuario`)
        REFERENCES `Usuario` (`idusuario`),
    CONSTRAINT `relacionusuario_Usuario`
        FOREIGN KEY (`relacionusuario`)
        REFERENCES `Usuario` (`idusuario`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- viajes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `viajes`;

CREATE TABLE `viajes`
(
    `idUsuario` VARCHAR(50) NOT NULL,
    `idViaje` INTEGER NOT NULL,
    PRIMARY KEY (`idUsuario`,`idViaje`),
    INDEX `fi_iaje_Usuario` (`idViaje`),
    CONSTRAINT `Usuario_viaje`
        FOREIGN KEY (`idUsuario`)
        REFERENCES `Usuario` (`idusuario`),
    CONSTRAINT `idViaje_Usuario`
        FOREIGN KEY (`idViaje`)
        REFERENCES `Viaje` (`idViaje`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Usuario_grupos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Usuario_grupos`;

CREATE TABLE `Usuario_grupos`
(
    `idUsuario` VARCHAR(50) NOT NULL,
    `idGrupo` INTEGER NOT NULL,
    PRIMARY KEY (`idUsuario`,`idGrupo`),
    INDEX `fi_rupo_Usuario` (`idGrupo`),
    CONSTRAINT `Usuario_grupos`
        FOREIGN KEY (`idUsuario`)
        REFERENCES `Usuario` (`idusuario`),
    CONSTRAINT `idGrupo_Usuario`
        FOREIGN KEY (`idGrupo`)
        REFERENCES `Grupo` (`idGrupo`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Mensajes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Mensajes`;

CREATE TABLE `Mensajes`
(
    `idMensajes` INTEGER NOT NULL AUTO_INCREMENT,
    `asunto` VARCHAR(150) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `fkviaje` INTEGER,
    `fkpadre` INTEGER,
    PRIMARY KEY (`idMensajes`),
    INDEX `Mensajes_fi_db54df` (`fkviaje`),
    INDEX `Mensajes_fi_497546` (`fkpadre`),
    CONSTRAINT `Mensajes_fk_db54df`
        FOREIGN KEY (`fkviaje`)
        REFERENCES `Viaje` (`idViaje`),
    CONSTRAINT `Mensajes_fk_497546`
        FOREIGN KEY (`fkpadre`)
        REFERENCES `Mensajes` (`idMensajes`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Grupo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Grupo`;

CREATE TABLE `Grupo`
(
    `idGrupo` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(255) NOT NULL,
    `informacion` TEXT NOT NULL,
    PRIMARY KEY (`idGrupo`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Grupo_viaje
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Grupo_viaje`;

CREATE TABLE `Grupo_viaje`
(
    `idGrupo` INTEGER NOT NULL,
    `idViaje` INTEGER NOT NULL,
    PRIMARY KEY (`idGrupo`,`idViaje`),
    INDEX `fi_iaje_Grupo` (`idViaje`),
    CONSTRAINT `Grupo_viaje`
        FOREIGN KEY (`idGrupo`)
        REFERENCES `Grupo` (`idGrupo`),
    CONSTRAINT `idViaje_Grupo`
        FOREIGN KEY (`idViaje`)
        REFERENCES `Viaje` (`idViaje`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Viaje
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Viaje`;

CREATE TABLE `Viaje`
(
    `idViaje` INTEGER NOT NULL AUTO_INCREMENT,
    `transporte` TEXT NOT NULL,
    `nombre` VARCHAR(1) NOT NULL,
    `destino` VARCHAR(100) NOT NULL,
    `etiquetas` VARCHAR(1) NOT NULL,
    `hospedaje` TEXT NOT NULL,
    `fechainicio` DATE NOT NULL,
    `fechafinal` VARCHAR(1) NOT NULL,
    `informacion` TEXT NOT NULL,
    `imagenes` VARCHAR(1) NOT NULL,
    `precio` DOUBLE NOT NULL,
    PRIMARY KEY (`idViaje`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Perfil
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Perfil`;

CREATE TABLE `Perfil`
(
    `idPerfil` INTEGER NOT NULL AUTO_INCREMENT,
    `informacion` TEXT NOT NULL,
    `nacimiento` DATE NOT NULL,
    `gustos` VARCHAR(1) NOT NULL,
    PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Invitacion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Invitacion`;

CREATE TABLE `Invitacion`
(
    `idInvitacion` INTEGER NOT NULL AUTO_INCREMENT,
    `codigo` VARCHAR(1) NOT NULL,
    `activo` TINYINT(1) NOT NULL,
    `fkusuario` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`idInvitacion`),
    UNIQUE INDEX `ix_codigo_` (`codigo`),
    INDEX `Invitacion_fi_f55f2b` (`fkusuario`),
    CONSTRAINT `Invitacion_fk_f55f2b`
        FOREIGN KEY (`fkusuario`)
        REFERENCES `Usuario` (`idusuario`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Administrador
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Administrador`;

CREATE TABLE `Administrador`
(
    `idAdministrador` INTEGER NOT NULL AUTO_INCREMENT,
    `idusuario` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `email` VARCHAR(1) NOT NULL,
    `avatar` VARCHAR(255) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(100) NOT NULL,
    `fkperfil` INTEGER NOT NULL,
    PRIMARY KEY (`idAdministrador`,`idusuario`),
    UNIQUE INDEX `ix_idAdministrador` (`idAdministrador`),
    UNIQUE INDEX `Administrador_u_ce4c89` (`email`),
    INDEX `Administrador_i_01983e` (`fkperfil`),
    INDEX `Administrador_fi_04eafb` (`idusuario`),
    CONSTRAINT `Administrador_fk_04eafb`
        FOREIGN KEY (`idusuario`)
        REFERENCES `Usuario` (`idusuario`)
        ON DELETE CASCADE,
    CONSTRAINT `Administrador_fk_96a8b0`
        FOREIGN KEY (`fkperfil`)
        REFERENCES `Perfil` (`idPerfil`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Colaborador
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Colaborador`;

CREATE TABLE `Colaborador`
(
    `prueba` BIGINT NOT NULL,
    `mensaje` INTEGER,
    `idColaborador2` VARCHAR(200) NOT NULL,
    `idusuario` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `email` VARCHAR(1) NOT NULL,
    `avatar` VARCHAR(255) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(100) NOT NULL,
    `fkperfil` INTEGER NOT NULL,
    PRIMARY KEY (`idColaborador2`,`idusuario`),
    UNIQUE INDEX `ix_prueba_` (`prueba`),
    UNIQUE INDEX `ix_prueba_idColaborador2_` (`prueba`, `idColaborador2`),
    UNIQUE INDEX `Colaborador_u_ce4c89` (`email`),
    INDEX `Colaborador_i_01983e` (`fkperfil`),
    INDEX `Colaborador_fi_04eafb` (`idusuario`),
    CONSTRAINT `Colaborador_fk_04eafb`
        FOREIGN KEY (`idusuario`)
        REFERENCES `Usuario` (`idusuario`)
        ON DELETE CASCADE,
    CONSTRAINT `Colaborador_fk_96a8b0`
        FOREIGN KEY (`fkperfil`)
        REFERENCES `Perfil` (`idPerfil`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
