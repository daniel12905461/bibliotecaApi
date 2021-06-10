DROP DATABASE IF EXISTS ProfeSoft;
CREATE DATABASE ProfeSoft;
USE ProfeSoft;

-- -----------------------------------------------------
-- Table `biblioteca`.`Profesor`
-- -----------------------------------------------------
CREATE TABLE prestamos (
id INT PRIMARY KEY  AUTO_INCREMENT,
nombres VARCHAR(45) NOT NULL,
apellidos VARCHAR(45) NULL,
ci VARCHAR(45) NULL,
curso VARCHAR(45) NOT NULL,
grado VARCHAR(45) NOT NULL,
fecha DATE NOT NULL,
estado VARCHAR(45) NULL
);

-- -----------------------------------------------------
-- Table `biblioteca`.`Profesor`
-- -----------------------------------------------------
CREATE TABLE prestamo_libros (
id INT PRIMARY KEY  AUTO_INCREMENT,
estado VARCHAR(45) NULL,
libros_id INT unsigned NOT NULL,
FOREIGN KEY (libros_id) REFERENCES libros(id),
prestamos_id INT NOT NULL,
FOREIGN KEY (prestamos_id) REFERENCES prestamos(id)
);
