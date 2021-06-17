<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617122001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE FULLTEXT INDEX IDX_6AB5B4715E237E0683A00E68 ON candidat (name, firstname)');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F898C92C83');
        $this->addSql('DROP INDEX IDX_FBD8E0F898C92C83 ON job');
        $this->addSql('ALTER TABLE job CHANGE id_recruteur_id recruteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8BB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8BB0859F1 ON job (recruteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_6AB5B4715E237E0683A00E68 ON candidat');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8BB0859F1');
        $this->addSql('DROP INDEX IDX_FBD8E0F8BB0859F1 ON job');
        $this->addSql('ALTER TABLE job CHANGE recruteur_id id_recruteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F898C92C83 FOREIGN KEY (id_recruteur_id) REFERENCES recruteur (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F898C92C83 ON job (id_recruteur_id)');
    }
}
