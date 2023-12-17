<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217064618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A95DA0FB8');
        $this->addSql('DROP INDEX IDX_FEC530A95DA0FB8 ON content');
        $this->addSql('ALTER TABLE content ADD title VARCHAR(255) NOT NULL, DROP template_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content ADD template_id INT DEFAULT NULL, DROP title');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A95DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A95DA0FB8 ON content (template_id)');
    }
}
