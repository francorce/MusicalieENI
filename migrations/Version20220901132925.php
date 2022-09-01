<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901132925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festival_departement DROP FOREIGN KEY FK_64BFEE5ACCF9E01E');
        $this->addSql('ALTER TABLE festival_departement DROP FOREIGN KEY FK_64BFEE5A8AEBAF57');
        $this->addSql('DROP TABLE festival_departement');
        $this->addSql('ALTER TABLE festival ADD departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE festival ADD CONSTRAINT FK_57CF789CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_57CF789CCF9E01E ON festival (departement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE festival_departement (festival_id INT NOT NULL, departement_id INT NOT NULL, INDEX IDX_64BFEE5A8AEBAF57 (festival_id), INDEX IDX_64BFEE5ACCF9E01E (departement_id), PRIMARY KEY(festival_id, departement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE festival_departement ADD CONSTRAINT FK_64BFEE5ACCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE festival_departement ADD CONSTRAINT FK_64BFEE5A8AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE festival DROP FOREIGN KEY FK_57CF789CCF9E01E');
        $this->addSql('DROP INDEX IDX_57CF789CCF9E01E ON festival');
        $this->addSql('ALTER TABLE festival DROP departement_id');
    }
}
