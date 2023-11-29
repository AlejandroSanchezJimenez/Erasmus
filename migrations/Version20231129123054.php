<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129123054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE baremacion (id INT AUTO_INCREMENT NOT NULL, candidato_id INT NOT NULL, convocatoria_id INT NOT NULL, item_id INT NOT NULL, nota INT NOT NULL, INDEX IDX_7CB90D7FFE0067E5 (candidato_id), INDEX IDX_7CB90D7F4EE93BE6 (convocatoria_id), INDEX IDX_7CB90D7F126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baremacion ADD CONSTRAINT FK_7CB90D7FFE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id)');
        $this->addSql('ALTER TABLE baremacion ADD CONSTRAINT FK_7CB90D7F4EE93BE6 FOREIGN KEY (convocatoria_id) REFERENCES convocatoria (id)');
        $this->addSql('ALTER TABLE baremacion ADD CONSTRAINT FK_7CB90D7F126F525E FOREIGN KEY (item_id) REFERENCES item_baremable (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE baremacion DROP FOREIGN KEY FK_7CB90D7FFE0067E5');
        $this->addSql('ALTER TABLE baremacion DROP FOREIGN KEY FK_7CB90D7F4EE93BE6');
        $this->addSql('ALTER TABLE baremacion DROP FOREIGN KEY FK_7CB90D7F126F525E');
        $this->addSql('DROP TABLE baremacion');
    }
}
