<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611113851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON DEFAULT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(80) NOT NULL, firstname VARCHAR(80) NOT NULL, tel VARCHAR(20) NOT NULL, experience VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, openwork TINYINT(1) NOT NULL, langages JSON NOT NULL, UNIQUE INDEX UNIQ_6AB5B471E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, missiontitle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, companyname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruteur (id INT AUTO_INCREMENT NOT NULL, companyname VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, contactname VARCHAR(100) NOT NULL, contactemail VARCHAR(100) NOT NULL, phonenumber VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_2BD3678C92488E90 (contactemail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON DEFAULT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE recruteur');
        $this->addSql('DROP TABLE user');
    }
}
