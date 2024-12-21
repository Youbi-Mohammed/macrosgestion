<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241221084634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plats_ingredient (plats_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_6F3E06E6AA14E1C8 (plats_id), INDEX IDX_6F3E06E6933FE08C (ingredient_id), PRIMARY KEY(plats_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plats_ingredient ADD CONSTRAINT FK_6F3E06E6AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plats_ingredient ADD CONSTRAINT FK_6F3E06E6933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats_ingredient DROP FOREIGN KEY FK_6F3E06E6AA14E1C8');
        $this->addSql('ALTER TABLE plats_ingredient DROP FOREIGN KEY FK_6F3E06E6933FE08C');
        $this->addSql('DROP TABLE plats_ingredient');
    }
}
