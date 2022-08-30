<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830120102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE felling (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notebook_page (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT NOT NULL, condition_meteot_id INT DEFAULT NULL, moutain_location_id INT NOT NULL, feeling_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, rout_name VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', achieve_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', story LONGTEXT NOT NULL, height_difference INT DEFAULT NULL, total_time TIME DEFAULT NULL, point_to_review LONGTEXT DEFAULT NULL, INDEX IDX_330C64D6FCFA9DAE (difficulty_id), INDEX IDX_330C64D691439334 (condition_meteot_id), INDEX IDX_330C64D62281FA6 (moutain_location_id), INDEX IDX_330C64D6CB9214C2 (feeling_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notebook_page ADD CONSTRAINT FK_330C64D6FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE notebook_page ADD CONSTRAINT FK_330C64D691439334 FOREIGN KEY (condition_meteot_id) REFERENCES condition_meteo (id)');
        $this->addSql('ALTER TABLE notebook_page ADD CONSTRAINT FK_330C64D62281FA6 FOREIGN KEY (moutain_location_id) REFERENCES mountain_location (id)');
        $this->addSql('ALTER TABLE notebook_page ADD CONSTRAINT FK_330C64D6CB9214C2 FOREIGN KEY (feeling_id) REFERENCES felling (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notebook_page DROP FOREIGN KEY FK_330C64D6FCFA9DAE');
        $this->addSql('ALTER TABLE notebook_page DROP FOREIGN KEY FK_330C64D691439334');
        $this->addSql('ALTER TABLE notebook_page DROP FOREIGN KEY FK_330C64D62281FA6');
        $this->addSql('ALTER TABLE notebook_page DROP FOREIGN KEY FK_330C64D6CB9214C2');
        $this->addSql('DROP TABLE felling');
        $this->addSql('DROP TABLE notebook_page');
    }
}
