<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901113728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE festival_artiste (festival_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_B1E20C5E8AEBAF57 (festival_id), INDEX IDX_B1E20C5E21D25844 (artiste_id), PRIMARY KEY(festival_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE festival_artiste ADD CONSTRAINT FK_B1E20C5E8AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE festival_artiste ADD CONSTRAINT FK_B1E20C5E21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste CHANGE instrument instrument VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festival_artiste DROP FOREIGN KEY FK_B1E20C5E8AEBAF57');
        $this->addSql('ALTER TABLE festival_artiste DROP FOREIGN KEY FK_B1E20C5E21D25844');
        $this->addSql('DROP TABLE festival_artiste');
        $this->addSql('ALTER TABLE artiste CHANGE instrument instrument VARCHAR(255) DEFAULT NULL');
    }
}
