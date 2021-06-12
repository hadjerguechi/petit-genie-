<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210612212828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruteur ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2BD3678C79F37AE5 ON recruteur (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678C79F37AE5');
        $this->addSql('DROP INDEX UNIQ_2BD3678C79F37AE5 ON recruteur');
        $this->addSql('ALTER TABLE recruteur DROP id_user_id');
    }
}
