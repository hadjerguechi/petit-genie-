<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614130607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_6AB5B471E7927C74 ON candidat');
        $this->addSql('ALTER TABLE candidat ADD id_user_id INT NOT NULL, DROP email, DROP roles, DROP password');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B47179F37AE5 ON candidat (id_user_id)');
        $this->addSql('ALTER TABLE recruteur ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2BD3678C79F37AE5 ON recruteur (id_user_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47179F37AE5');
        $this->addSql('DROP INDEX UNIQ_6AB5B47179F37AE5 ON candidat');
        $this->addSql('ALTER TABLE candidat ADD email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD roles JSON DEFAULT NULL, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP id_user_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471E7927C74 ON candidat (email)');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678C79F37AE5');
        $this->addSql('DROP INDEX UNIQ_2BD3678C79F37AE5 ON recruteur');
        $this->addSql('ALTER TABLE recruteur DROP id_user_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL');
    }
}
