<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210609130840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8610CF4A2');
        $this->addSql('DROP INDEX IDX_FBD8E0F8610CF4A2 ON job');
        $this->addSql('ALTER TABLE job ADD companyname VARCHAR(255) NOT NULL, DROP companyid_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2BD3678C92488E90 ON recruteur (contactemail)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD companyid_id INT NOT NULL, DROP companyname');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8610CF4A2 FOREIGN KEY (companyid_id) REFERENCES recruteur (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8610CF4A2 ON job (companyid_id)');
        $this->addSql('DROP INDEX UNIQ_2BD3678C92488E90 ON recruteur');
    }
}
