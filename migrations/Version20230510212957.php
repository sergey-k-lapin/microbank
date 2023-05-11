<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510212957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crate database migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE `bank` (
  `id` int NOT NULL AUTO_INCREMENT,
  `legal_name` text,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

        $this->addSql("INSERT INTO `bank` VALUES (1,'Bank of England','London EC2R 8AH'),(2,'Deutsche Bank AG','Taunusanlage 12, 60325 Frankfurt am Main');");

        $this->addSql("CREATE TABLE `monetary_amount` (
  `id` int NOT NULL AUTO_INCREMENT,
  `max_value` decimal(10,0) DEFAULT '0',
  `min_value` decimal(10,0) DEFAULT '0',
  `currency` varchar(45) DEFAULT 'EUR',
  `value` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

        $this->addSql("INSERT INTO `monetary_amount` VALUES (1,0,0,'GBP',1000000),(2,0,0,'EUR',512000);");

        $this->addSql("CREATE TABLE `person` (
  `id` int NOT NULL AUTO_INCREMENT,
  `given_name` varchar(45) NOT NULL,
  `family_name` varchar(45) DEFAULT NULL,
  `additional_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

        $this->addSql("INSERT INTO `person` VALUES (1,'Adam','Smith',NULL);");

        $this->addSql("CREATE TABLE `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bank_id` int NOT NULL,
  `amount_id` int NOT NULL,
  `person_id` int NOT NULL,
  `identifier` varchar(45) DEFAULT NULL,
  `discr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Account_1_idx` (`bank_id`),
  KEY `fk_Account_2_idx` (`amount_id`),
  KEY `fk_Account_3_idx` (`person_id`),
  CONSTRAINT `fk_Account_1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`),
  CONSTRAINT `fk_Account_2` FOREIGN KEY (`amount_id`) REFERENCES `monetary_amount` (`id`),
  CONSTRAINT `fk_Account_3` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

        $this->addSql("INSERT INTO `account` VALUES (1,1,1,1,'GB98MIDL07009312345678','account'),(2,2,2,1,'DE91100000000123456789','depositaccount');");

        $this->addSql("CREATE TABLE `deposit_account` (
  `id` int NOT NULL,
  `base_rate` float NOT NULL,
  `period` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_deposit_account_1` FOREIGN KEY (`id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

        $this->addSql("INSERT INTO `deposit_account` VALUES (2,23,180);");
        $this->addSql("CREATE TABLE `credit_account` (
  `id` int NOT NULL,
  `rate` float NOT NULL,
  `overdraft` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_credit_account_1` FOREIGN KEY (`id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE IF EXISTS `deposit_account`;");
        $this->addSql("DROP TABLE IF EXISTS `credit_account`;");
        $this->addSql("DROP TABLE IF EXISTS `monetary_amount`;");
        $this->addSql("DROP TABLE IF EXISTS `account`;");
        $this->addSql("DROP TABLE IF EXISTS `bank`;");
        $this->addSql("DROP TABLE IF EXISTS `person`;");
        // this down() migration is auto-generated, please modify it to your needs

    }
}
