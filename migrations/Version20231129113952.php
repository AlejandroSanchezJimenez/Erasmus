<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129113952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convocatoria_baremables (id INT AUTO_INCREMENT NOT NULL, convocatoria_id INT NOT NULL, item_id INT NOT NULL, maximo INT NOT NULL, requisito TINYINT(1) NOT NULL, minimo INT DEFAULT NULL, aporta_candidato TINYINT(1) NOT NULL, INDEX IDX_C8A115834EE93BE6 (convocatoria_id), INDEX IDX_C8A11583126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convocatoria_baremables ADD CONSTRAINT FK_C8A115834EE93BE6 FOREIGN KEY (convocatoria_id) REFERENCES convocatoria (id)');
        $this->addSql('ALTER TABLE convocatoria_baremables ADD CONSTRAINT FK_C8A11583126F525E FOREIGN KEY (item_id) REFERENCES item_baremable (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convocatoria_baremables DROP FOREIGN KEY FK_C8A115834EE93BE6');
        $this->addSql('ALTER TABLE convocatoria_baremables DROP FOREIGN KEY FK_C8A11583126F525E');
        $this->addSql('DROP TABLE convocatoria_baremables');
    }
}
