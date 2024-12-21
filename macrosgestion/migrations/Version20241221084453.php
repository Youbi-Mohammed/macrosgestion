<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241221084453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plats ADD CONSTRAINT FK_854A620AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_854A620AFB88E14F ON plats (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats DROP FOREIGN KEY FK_854A620AFB88E14F');
        $this->addSql('DROP INDEX IDX_854A620AFB88E14F ON plats');
        $this->addSql('ALTER TABLE plats DROP utilisateur_id');
    }
}
