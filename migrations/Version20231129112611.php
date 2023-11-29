<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129112611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidato (id INT AUTO_INCREMENT NOT NULL, tutor_id INT DEFAULT NULL, dni VARCHAR(9) NOT NULL, fecha_nac DATETIME NOT NULL, apellidos VARCHAR(100) NOT NULL, nombre VARCHAR(100) NOT NULL, curso VARCHAR(10) NOT NULL, tlf VARCHAR(9) NOT NULL, correo VARCHAR(100) NOT NULL, domicilio VARCHAR(300) NOT NULL, INDEX IDX_2867675A208F64F1 (tutor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675A208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor_legal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675A208F64F1');
        $this->addSql('DROP TABLE candidato');
    }
}
