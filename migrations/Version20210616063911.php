<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616063911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_FBD8E0F85F51A47F6DE4402617BBE3948CDE5729 ON job');
        $this->addSql('CREATE FULLTEXT INDEX IDX_FBD8E0F85F51A47F6DE44026 ON job (missiontitle, description)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_FBD8E0F85F51A47F6DE44026 ON job');
        $this->addSql('CREATE FULLTEXT INDEX IDX_FBD8E0F85F51A47F6DE4402617BBE3948CDE5729 ON job (missiontitle, description, companyname, type)');
    }
}