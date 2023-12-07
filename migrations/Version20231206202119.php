<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206202119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convocatoria_destinatario (id INT AUTO_INCREMENT NOT NULL, convocatoria_id INT NOT NULL, destinatario_id INT NOT NULL, INDEX IDX_74A39FEA4EE93BE6 (convocatoria_id), INDEX IDX_74A39FEAB564FBC1 (destinatario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convocatoria_destinatario ADD CONSTRAINT FK_74A39FEA4EE93BE6 FOREIGN KEY (convocatoria_id) REFERENCES convocatoria (id)');
        $this->addSql('ALTER TABLE convocatoria_destinatario ADD CONSTRAINT FK_74A39FEAB564FBC1 FOREIGN KEY (destinatario_id) REFERENCES destinatario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convocatoria_destinatario DROP FOREIGN KEY FK_74A39FEA4EE93BE6');
        $this->addSql('ALTER TABLE convocatoria_destinatario DROP FOREIGN KEY FK_74A39FEAB564FBC1');
        $this->addSql('DROP TABLE convocatoria_destinatario');
    }
}
