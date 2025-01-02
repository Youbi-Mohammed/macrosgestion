<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241228095738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette ADD plats_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390AA14E1C8 ON recette (plats_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390AA14E1C8');
        $this->addSql('DROP INDEX IDX_49BB6390AA14E1C8 ON recette');
        $this->addSql('ALTER TABLE recette DROP plats_id');
    }
}
