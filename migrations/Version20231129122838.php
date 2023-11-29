<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129122838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE solicitud (id INT AUTO_INCREMENT NOT NULL, candidato_id INT NOT NULL, convocatoria_id INT NOT NULL, dni VARCHAR(9) NOT NULL, fecha_nac DATETIME NOT NULL, apellidos VARCHAR(100) NOT NULL, nombre VARCHAR(100) NOT NULL, curso VARCHAR(10) NOT NULL, tlf VARCHAR(9) NOT NULL, correo VARCHAR(100) NOT NULL, domicilio VARCHAR(300) NOT NULL, id_tutor VARCHAR(10) NOT NULL, url_notas VARCHAR(100) DEFAULT NULL, url_idioma VARCHAR(100) DEFAULT NULL, INDEX IDX_96D27CC0FE0067E5 (candidato_id), INDEX IDX_96D27CC04EE93BE6 (convocatoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0FE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC04EE93BE6 FOREIGN KEY (convocatoria_id) REFERENCES convocatoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC0FE0067E5');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC04EE93BE6');
        $this->addSql('DROP TABLE solicitud');
    }
}
