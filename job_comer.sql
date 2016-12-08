-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema job_comer
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role` ;

CREATE TABLE IF NOT EXISTS `role` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(45) NOT NULL,
  `birthdate` DATE NOT NULL,
  `foto` VARCHAR(45) NOT NULL DEFAULT 0,
  `role` INT NOT NULL DEFAULT 1,
  `address` VARCHAR(45) NULL,
  `tel` VARCHAR(45) NULL,
  `zipcode` VARCHAR(45) NULL,
  `hobby` VARCHAR(45) NULL,
  `bahasa` VARCHAR(45) NULL,
  `warga_negara` VARCHAR(45) NULL,
  `agama` VARCHAR(45) NULL,
  `about_me` VARCHAR(45) NULL,
  `activation_token` VARCHAR(255) NOT NULL,
  `last_activation_request` DATETIME NOT NULL,
  `lost_password_request` TINYINT(1) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 0,
  `sign_up_stamp` DATETIME NOT NULL,
  `last_sign_in_stamp` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_user_role1_idx` (`role` ASC),
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role`)
    REFERENCES `role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kategori`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kategori` ;

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_has_kategori`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_has_kategori` ;

CREATE TABLE IF NOT EXISTS `user_has_kategori` (
  `user_id` INT NOT NULL,
  `kategori_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `kategori_id`),
  INDEX `fk_user_has_kategori_kategori1_idx` (`kategori_id` ASC),
  INDEX `fk_user_has_kategori_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_kategori_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_kategori_kategori1`
    FOREIGN KEY (`kategori_id`)
    REFERENCES `kategori` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pekerjaan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pekerjaan` ;

CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id` INT NOT NULL,
  `nama` VARCHAR(45) NULL,
  `deskripsi` VARCHAR(45) NULL,
  `pekerjaancol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pekerjaan_has_kategori`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pekerjaan_has_kategori` ;

CREATE TABLE IF NOT EXISTS `pekerjaan_has_kategori` (
  `pekerjaan_id` INT NOT NULL,
  `kategori_id` INT NOT NULL,
  PRIMARY KEY (`pekerjaan_id`, `kategori_id`),
  INDEX `fk_pekerjaan_has_kategori_kategori1_idx` (`kategori_id` ASC),
  INDEX `fk_pekerjaan_has_kategori_pekerjaan1_idx` (`pekerjaan_id` ASC),
  CONSTRAINT `fk_pekerjaan_has_kategori_pekerjaan1`
    FOREIGN KEY (`pekerjaan_id`)
    REFERENCES `pekerjaan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pekerjaan_has_kategori_kategori1`
    FOREIGN KEY (`kategori_id`)
    REFERENCES `kategori` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `report`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `report` ;

CREATE TABLE IF NOT EXISTS `report` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `pekerjaan_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_report_user1_idx` (`user_id` ASC),
  INDEX `fk_report_pekerjaan1_idx` (`pekerjaan_id` ASC),
  CONSTRAINT `fk_report_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_pekerjaan1`
    FOREIGN KEY (`pekerjaan_id`)
    REFERENCES `pekerjaan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `message`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `message` ;

CREATE TABLE IF NOT EXISTS `message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id1` INT NOT NULL,
  `user_id2` INT NOT NULL,
  PRIMARY KEY (`id`, `user_id1`, `user_id2`),
  INDEX `fk_message_user1_idx` (`user_id2` ASC),
  INDEX `fk_message_user2_idx` (`user_id1` ASC),
  CONSTRAINT `fk_message_user1`
    FOREIGN KEY (`user_id2`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_user2`
    FOREIGN KEY (`user_id1`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `message_reply`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `message_reply` ;

CREATE TABLE IF NOT EXISTS `message_reply` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reply` VARCHAR(255) NULL,
  `user_id` INT NOT NULL,
  `time` VARCHAR(255) NULL,
  `message_id` INT NOT NULL,
  PRIMARY KEY (`id`, `user_id`, `message_id`),
  INDEX `fk_message_reply_user1_idx` (`user_id` ASC),
  INDEX `fk_message_reply_message1_idx` (`message_id` ASC),
  CONSTRAINT `fk_message_reply_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_reply_message1`
    FOREIGN KEY (`message_id`)
    REFERENCES `message` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pengalaman_kerja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pengalaman_kerja` ;

CREATE TABLE IF NOT EXISTS `pengalaman_kerja` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `tgl_masuk` DATE NULL,
  `tgl_keluar` DATE NULL,
  `nama_perusahaan` VARCHAR(255) NULL,
  `posisi` VARCHAR(255) NULL,
  `gaji` INT NULL,
  `deskripsi` VARCHAR(255) NULL,
  `show` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_pengalaman_kerja_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_pengalaman_kerja_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `informal` ;

CREATE TABLE IF NOT EXISTS `informal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `sekolah` VARCHAR(255) NOT NULL,
  `tahun` YEAR NOT NULL,
  `deskripsi` VARCHAR(255) NULL,
  `show` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_pendidikan_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_pendidikan_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `company`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `company` ;

CREATE TABLE IF NOT EXISTS `company` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `nama` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `nama_cp` VARCHAR(45) NULL,
  `tel` VARCHAR(45) NULL,
  `alamat` VARCHAR(45) NULL,
  `deskripsi` VARCHAR(45) NULL,
  `logo` VARCHAR(45) NULL,
  `activation_token` VARCHAR(255) NOT NULL,
  `last_activation_request` DATETIME NULL,
  `lost_password_request` TINYINT(1) NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 0,
  `sign_up_stamp` DATETIME NOT NULL,
  `last_sign_in_stamp` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `activation_token_UNIQUE` (`activation_token` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lowongan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lowongan` ;

CREATE TABLE IF NOT EXISTS `lowongan` (
  `id` VARCHAR(45) NOT NULL,
  `perusahaan_id` INT NOT NULL,
  `judul` VARCHAR(45) NULL,
  `posisi` VARCHAR(45) NULL,
  `syarat` VARCHAR(45) NULL,
  `tgl_upload` DATE NULL,
  `tgl_batas` DATE NULL,
  PRIMARY KEY (`id`, `perusahaan_id`),
  INDEX `fk_lowongan_perusahaan1_idx` (`perusahaan_id` ASC),
  CONSTRAINT `fk_lowongan_perusahaan1`
    FOREIGN KEY (`perusahaan_id`)
    REFERENCES `company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pendaftar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pendaftar` ;

CREATE TABLE IF NOT EXISTS `pendaftar` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `lowongan_id` VARCHAR(45) NOT NULL,
  `tgl` DATE NULL,
  `deskripsi` VARCHAR(45) NULL,
  PRIMARY KEY (`user_id`, `lowongan_id`),
  INDEX `fk_user_has_lowongan_lowongan1_idx` (`lowongan_id` ASC),
  INDEX `fk_user_has_lowongan_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_lowongan_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_lowongan_lowongan1`
    FOREIGN KEY (`lowongan_id`)
    REFERENCES `lowongan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `report_palsu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `report_palsu` ;

CREATE TABLE IF NOT EXISTS `report_palsu` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `perusahaan_id` INT NOT NULL,
  `deskripsi` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`user_id`, `perusahaan_id`),
  INDEX `fk_user_has_perusahaan_perusahaan1_idx` (`perusahaan_id` ASC),
  INDEX `fk_user_has_perusahaan_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_perusahaan_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_perusahaan_perusahaan1`
    FOREIGN KEY (`perusahaan_id`)
    REFERENCES `company` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saran_pekerjaan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `saran_pekerjaan` ;

CREATE TABLE IF NOT EXISTS `saran_pekerjaan` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `lowongan_id` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_id`, `lowongan_id`),
  INDEX `fk_user_has_lowongan_lowongan2_idx` (`lowongan_id` ASC),
  INDEX `fk_user_has_lowongan_user2_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_lowongan_user2`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_lowongan_lowongan2`
    FOREIGN KEY (`lowongan_id`)
    REFERENCES `lowongan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `notification`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `notification` ;

CREATE TABLE IF NOT EXISTS `notification` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `nama` VARCHAR(45) NULL,
  `deskripsi` VARCHAR(45) NULL,
  `sudah_dibuka` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_notification_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_notification_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `option`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `option` ;

CREATE TABLE IF NOT EXISTS `option` (
  `name` VARCHAR(45) NOT NULL,
  `value` LONGTEXT NULL,
  PRIMARY KEY (`name`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_setting_shown`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_setting_shown` ;

CREATE TABLE IF NOT EXISTS `user_setting_shown` (
  `user_id` INT NOT NULL,
  `gender` TINYINT(1) NOT NULL DEFAULT 1,
  `birthdate` TINYINT(1) NOT NULL DEFAULT 1,
  `address` TINYINT(1) NOT NULL DEFAULT 1,
  `tel` TINYINT(1) NOT NULL DEFAULT 1,
  `hobby` TINYINT(1) NOT NULL DEFAULT 1,
  `bahasa` TINYINT(1) NOT NULL DEFAULT 1,
  `warga_negara` TINYINT(1) NOT NULL DEFAULT 1,
  `agama` TINYINT(1) NOT NULL DEFAULT 1,
  `about_me` TINYINT(1) NOT NULL DEFAULT 1,
  `biodata` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_setting_shown_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `formal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `formal` ;

CREATE TABLE IF NOT EXISTS `formal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `sekolah` VARCHAR(255) NOT NULL,
  `tahun` YEAR NOT NULL,
  `deskripsi` VARCHAR(255) NULL,
  `show` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_pendidikan_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_pendidikan_user10`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pages` ;

CREATE TABLE IF NOT EXISTS `pages` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `content` VARCHAR(5000) NOT NULL,
  `main` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `role`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `role` (`id`, `name`) VALUES (0, 'Admin');
INSERT INTO `role` (`id`, `name`) VALUES (1, 'Student');

COMMIT;


-- -----------------------------------------------------
-- Data for table `user`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `gender`, `birthdate`, `foto`, `role`, `address`, `tel`, `zipcode`, `hobby`, `bahasa`, `warga_negara`, `agama`, `about_me`, `activation_token`, `last_activation_request`, `lost_password_request`, `active`, `sign_up_stamp`, `last_sign_in_stamp`) VALUES (1, 'admin', '$2y$10$c/5DQPs9rvnDfocbHWIRuOlXuWJ8Ogm0/AiCwnzqDniN7wzinz21G', 'admin@admin.com', 'admin', 'male', '0', DEFAULT, DEFAULT, '0', '0', '0', '', NULL, NULL, NULL, NULL, '983653c03db61a918527064ad99a31fd0feae77d', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `gender`, `birthdate`, `foto`, `role`, `address`, `tel`, `zipcode`, `hobby`, `bahasa`, `warga_negara`, `agama`, `about_me`, `activation_token`, `last_activation_request`, `lost_password_request`, `active`, `sign_up_stamp`, `last_sign_in_stamp`) VALUES (2, 'student', '$2y$10$oJ4arK0b/XKjwVFVlJKaVu0FxUVppyU2JPBbbxThugyGwgREi.n6W', 'student@student.com', 'IMMA STUDENT', 'male', '2012-05-05', '2.png', DEFAULT, 'THIS IS MY ADDRESS', '01234156789', '012345', 'I DONT HAVE HOBBY', 'Indonesia', 'Indonesia', 'THIS IS AGAMA', 'I DONT KNOW ANYTHING ABOUT ME', '983653c03db61a918527064ad99a31fd0feae771', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

COMMIT;


-- -----------------------------------------------------
-- Data for table `pengalaman_kerja`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `pengalaman_kerja` (`id`, `user_id`, `tgl_masuk`, `tgl_keluar`, `nama_perusahaan`, `posisi`, `gaji`, `deskripsi`, `show`) VALUES (1, 2, '2012-02-01', '2016-01-02', 'XX', 'Jabatan', 10000, 'none', DEFAULT);

COMMIT;


-- -----------------------------------------------------
-- Data for table `informal`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `informal` (`id`, `user_id`, `sekolah`, `tahun`, `deskripsi`, `show`) VALUES (1, 2, 'SMA XXX', 2016, NULL, 1);
INSERT INTO `informal` (`id`, `user_id`, `sekolah`, `tahun`, `deskripsi`, `show`) VALUES (2, 2, 'SMP XXXX', 2011, NULL, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `option`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `option` (`name`, `value`) VALUES ('website_name', 'Job Comer');
INSERT INTO `option` (`name`, `value`) VALUES ('email', 'jobcomer@gmail.com');
INSERT INTO `option` (`name`, `value`) VALUES ('activation', '0');
INSERT INTO `option` (`name`, `value`) VALUES ('resend_activation_threshold', '0');
INSERT INTO `option` (`name`, `value`) VALUES ('languange', 'en');

COMMIT;


-- -----------------------------------------------------
-- Data for table `user_setting_shown`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `user_setting_shown` (`user_id`, `gender`, `birthdate`, `address`, `tel`, `hobby`, `bahasa`, `warga_negara`, `agama`, `about_me`, `biodata`) VALUES (1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `user_setting_shown` (`user_id`, `gender`, `birthdate`, `address`, `tel`, `hobby`, `bahasa`, `warga_negara`, `agama`, `about_me`, `biodata`) VALUES (2, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT);

COMMIT;


-- -----------------------------------------------------
-- Data for table `formal`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `formal` (`id`, `user_id`, `sekolah`, `tahun`, `deskripsi`, `show`) VALUES (1, 2, 'SMA XXX', 2011, '1', 1);
INSERT INTO `formal` (`id`, `user_id`, `sekolah`, `tahun`, `deskripsi`, `show`) VALUES (2, 2, 'SER', 2019, '', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `pages`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `pages` (`id`, `name`, `content`, `main`) VALUES (1, 'About Us', 'asdf', 1);
INSERT INTO `pages` (`id`, `name`, `content`, `main`) VALUES (2, 'Contact Us', 'Demo', 2);
INSERT INTO `pages` (`id`, `name`, `content`, `main`) VALUES (3, 'Term of Service', 'ASDF', 0);

COMMIT;

