<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617102309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, name VARCHAR(80) NOT NULL, firstname VARCHAR(80) NOT NULL, tel VARCHAR(20) NOT NULL, experience VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, openwork TINYINT(1) NOT NULL, langages JSON NOT NULL, UNIQUE INDEX UNIQ_6AB5B47179F37AE5 (id_user_id), FULLTEXT INDEX IDX_6AB5B4715E237E0683A00E68 (name, firstname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, recruteur_id INT DEFAULT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, missiontitle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, companyname VARCHAR(255) NOT NULL, INDEX IDX_FBD8E0F8BB0859F1 (recruteur_id), FULLTEXT INDEX IDX_FBD8E0F85F51A47F6DE44026 (missiontitle, description), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruteur (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, companyname VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, contactname VARCHAR(100) NOT NULL, contactemail VARCHAR(100) NOT NULL, phonenumber VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_2BD3678C92488E90 (contactemail), UNIQUE INDEX UNIQ_2BD3678C79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8BB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8BB0859F1');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47179F37AE5');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678C79F37AE5');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE recruteur');
        $this->addSql('DROP TABLE user');
    }
}
