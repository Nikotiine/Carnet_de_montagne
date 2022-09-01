<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901150731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notebook_page ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE notebook_page ADD CONSTRAINT FK_330C64D612469DE2 FOREIGN KEY (category_id) REFERENCES main_category (id)');
        $this->addSql('CREATE INDEX IDX_330C64D612469DE2 ON notebook_page (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notebook_page DROP FOREIGN KEY FK_330C64D612469DE2');
        $this->addSql('DROP INDEX IDX_330C64D612469DE2 ON notebook_page');
        $this->addSql('ALTER TABLE notebook_page DROP category_id');
    }
}
