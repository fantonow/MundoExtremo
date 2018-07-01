-- --------------------------------------------------------
-- Servidor:                     mundoextremo.mysql.dbaas.com.br
-- Versão do servidor:           5.6.35-81.0-log - Percona Server (GPL), Release 81.0, Revision c96c427
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para mundoextremo
CREATE DATABASE IF NOT EXISTS `mundoextremo` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `mundoextremo`;

-- Copiando estrutura para tabela mundoextremo.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) DEFAULT NULL,
  `passcode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ds_log` longtext,
  `ds_tipo` varchar(10) DEFAULT NULL,
  `dt_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151112 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para função mundoextremo.POS_ULTIMO_TEXTO
DELIMITER //
CREATE DEFINER=`mundoextremo`@`%%` FUNCTION `POS_ULTIMO_TEXTO`(
	`texto_p` VARCHAR(500),
	`caracter_p` VARCHAR(12)

) RETURNS int(11)
RETURN (LENGTH(texto_p)- LOCATE(caracter_p, REVERSE(texto_p))-(LENGTH(caracter_p)-1))//
DELIMITER ;

-- Copiando estrutura para procedure mundoextremo.SET_VIEW_ID
DELIMITER //
CREATE DEFINER=`mundoextremo`@`%%` PROCEDURE `SET_VIEW_ID`(
	IN `ID_P` INT

)
INSERT INTO views (id_wiki, dt_atualizacao) VALUES (ID_P, NOW())//
DELIMITER ;

-- Copiando estrutura para procedure mundoextremo.SET_VIEW_IMG_ID
DELIMITER //
CREATE DEFINER=`mundoextremo`@`%%` PROCEDURE `SET_VIEW_IMG_ID`(
	IN `ID_P` INT


)
INSERT INTO views_img (id_wiki, dt_atualizacao) VALUES (ID_P, NOW())//
DELIMITER ;

-- Copiando estrutura para tabela mundoextremo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `first_name` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.views
CREATE TABLE IF NOT EXISTS `views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_wiki` int(11) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133950 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.views_img
CREATE TABLE IF NOT EXISTS `views_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_wiki` int(11) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.voting_count
CREATE TABLE IF NOT EXISTS `voting_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_content_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `vote_up` int(11) NOT NULL,
  `vote_down` int(11) NOT NULL,
  `dt_atualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.voting_count_log
CREATE TABLE IF NOT EXISTS `voting_count_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_content_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `vote_up` int(11) NOT NULL,
  `vote_down` int(11) NOT NULL,
  `dt_atualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.wiki
CREATE TABLE IF NOT EXISTS `wiki` (
  `id` int(11) NOT NULL,
  `ds_titulo` varchar(50) DEFAULT NULL,
  `ds_url_image` varchar(500) DEFAULT NULL,
  `ds_url_image_bkp` varchar(500) DEFAULT NULL,
  `ds_conteudo` longtext,
  `dt_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nr_views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `ds_titulo` (`ds_titulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela mundoextremo.word_search
CREATE TABLE IF NOT EXISTS `word_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ds_word` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para trigger mundoextremo.voting_count_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `voting_count_before_insert` AFTER UPDATE ON `voting_count` FOR EACH ROW INSERT INTO voting_count_log (unique_content_id,vote_up,vote_down,dt_atualizacao) values (new.unique_content_id,new.vote_up,new.vote_down,now())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
