<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129113539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convocatoria (id INT AUTO_INCREMENT NOT NULL, proyecto_id INT NOT NULL, movilidades INT NOT NULL, tipo VARCHAR(10) NOT NULL, fecha_ini DATETIME NOT NULL, fecha_fin DATETIME NOT NULL, fecha_ini_pruebas DATETIME NOT NULL, fecha_fin_pruebas DATETIME NOT NULL, fecha_lista_prov DATETIME NOT NULL, fecha_lista_final DATETIME NOT NULL, INDEX IDX_6D773021F625D1BA (proyecto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convocatoria ADD CONSTRAINT FK_6D773021F625D1BA FOREIGN KEY (proyecto_id) REFERENCES proyecto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convocatoria DROP FOREIGN KEY FK_6D773021F625D1BA');
        $this->addSql('DROP TABLE convocatoria');
    }
}
