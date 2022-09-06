<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906194043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_settings (id INT AUTO_INCREMENT NOT NULL, color_cat_grande_voie VARCHAR(100) DEFAULT NULL, color_cat_grande_voie_trad VARCHAR(100) DEFAULT NULL, color_cat_alpi_rocheux VARCHAR(100) DEFAULT NULL, color_cat_alpi_mixte VARCHAR(100) DEFAULT NULL, color_cat_rando VARCHAR(100) DEFAULT NULL, color_cat_rando_alpine VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notebook_page ADD CONSTRAINT FK_330C64D612469DE2 FOREIGN KEY (category_id) REFERENCES main_category (id)');
        $this->addSql('CREATE INDEX IDX_330C64D612469DE2 ON notebook_page (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_settings');
        $this->addSql('ALTER TABLE notebook_page DROP FOREIGN KEY FK_330C64D612469DE2');
        $this->addSql('DROP INDEX IDX_330C64D612469DE2 ON notebook_page');
    }
}
