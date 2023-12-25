<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231225155441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A93ADB05F1');
        $this->addSql('ALTER TABLE content_tag DROP FOREIGN KEY FK_B662E176BAD26311');
        $this->addSql('ALTER TABLE content_tag DROP FOREIGN KEY FK_B662E17684A0A3ED');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B78312469DE2');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783C54C8C93');
        $this->addSql('DROP TABLE content_tag');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP INDEX IDX_FEC530A93ADB05F1 ON content');
        $this->addSql('ALTER TABLE content DROP options_id, DROP description');
        $this->addSql('ALTER TABLE easy_media__media CHANGE name name VARCHAR(255) NOT NULL, CHANGE slug slug VARCHAR(100) NOT NULL, CHANGE mime mime VARCHAR(255) DEFAULT NULL, CHANGE metas metas JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE page ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content_tag (content_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B662E176BAD26311 (tag_id), INDEX IDX_B662E17684A0A3ED (content_id), PRIMARY KEY(content_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE options (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_389B78312469DE2 (category_id), INDEX IDX_389B783C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE content_tag ADD CONSTRAINT FK_B662E176BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_tag ADD CONSTRAINT FK_B662E17684A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B78312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE content ADD options_id INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A93ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A93ADB05F1 ON content (options_id)');
        $this->addSql('ALTER TABLE easy_media__media CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mime mime VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE metas metas JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE page DROP description');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
