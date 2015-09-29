-- MySQL Script generated by MySQL Workbench
-- Thu Aug 27 20:04:07 2015
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `object_id` INT NULL,
  `object_type` VARCHAR(45) NULL,
  `price` FLOAT NULL,
  `status` INT NULL,
  `user_id` INT NULL,
  `create_time` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`promo_sites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`promo_sites` (
  `id` INT NOT NULL,
  `object_name` VARCHAR(45) NULL,
  `object_description` LONGTEXT NULL,
  `object_coordinate` VARCHAR(45) NULL,
  `object_address` TEXT NULL,
  `price` VARCHAR(45) NULL,
  `metro_ids` INT NULL,
  `list` VARCHAR(45) NULL,
  `template_id` INT NULL,
  `contacts` VARCHAR(45) NULL,
  `user_id` INT NULL,
  `published` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`flyers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`flyers` (
  `id` INT NOT NULL,
  `object_name` VARCHAR(45) NULL,
  `object_description` LONGTEXT NULL,
  `object_coordinate` VARCHAR(45) NULL,
  `object_address` TEXT NULL,
  `price` VARCHAR(45) NULL,
  `metro_ids` INT NULL,
  `list` VARCHAR(45) NULL,
  `template_id` INT NULL,
  `contacts` VARCHAR(45) NULL,
  `user_id` INT NULL,
  `published` TINYINT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `object_description_UNIQUE` (`object_description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`metro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`metro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title_ru` VARCHAR(50) NULL,
  `coordinates` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`streets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`streets` (
  `id` INT NOT NULL,
  `city_id` INT NULL,
  `region_id` INT NULL,
  `title_ru` VARCHAR(45) NULL,
  `street_type` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title_ru` VARCHAR(70) NULL,
  `coordinates` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`regions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`regions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title_ru` VARCHAR(45) NULL,
  `regionscol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;