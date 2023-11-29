<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129114221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convocatoria_idioma (id INT AUTO_INCREMENT NOT NULL, convocatoria_id INT NOT NULL, nivel_idioma_id INT NOT NULL, puntuacion INT NOT NULL, INDEX IDX_BF59F0B4EE93BE6 (convocatoria_id), INDEX IDX_BF59F0BDAF15DDC (nivel_idioma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convocatoria_idioma ADD CONSTRAINT FK_BF59F0B4EE93BE6 FOREIGN KEY (convocatoria_id) REFERENCES convocatoria (id)');
        $this->addSql('ALTER TABLE convocatoria_idioma ADD CONSTRAINT FK_BF59F0BDAF15DDC FOREIGN KEY (nivel_idioma_id) REFERENCES nivel_idioma (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convocatoria_idioma DROP FOREIGN KEY FK_BF59F0B4EE93BE6');
        $this->addSql('ALTER TABLE convocatoria_idioma DROP FOREIGN KEY FK_BF59F0BDAF15DDC');
        $this->addSql('DROP TABLE convocatoria_idioma');
    }
}
