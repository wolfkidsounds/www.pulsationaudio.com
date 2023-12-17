<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217063736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content_tag (content_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B662E17684A0A3ED (content_id), INDEX IDX_B662E176BAD26311 (tag_id), PRIMARY KEY(content_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content_tag ADD CONSTRAINT FK_B662E17684A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_tag ADD CONSTRAINT FK_B662E176BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content ADD category_id INT DEFAULT NULL, ADD template_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A95DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A912469DE2 ON content (category_id)');
        $this->addSql('CREATE INDEX IDX_FEC530A95DA0FB8 ON content (template_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_tag DROP FOREIGN KEY FK_B662E17684A0A3ED');
        $this->addSql('ALTER TABLE content_tag DROP FOREIGN KEY FK_B662E176BAD26311');
        $this->addSql('DROP TABLE content_tag');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A912469DE2');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A95DA0FB8');
        $this->addSql('DROP INDEX IDX_FEC530A912469DE2 ON content');
        $this->addSql('DROP INDEX IDX_FEC530A95DA0FB8 ON content');
        $this->addSql('ALTER TABLE content DROP category_id, DROP template_id');
    }
}
