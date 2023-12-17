<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217055649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD order_nr INT NOT NULL');
        $this->addSql('ALTER TABLE tag ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_389B783C54C8C93 ON tag (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP order_nr');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783C54C8C93');
        $this->addSql('DROP INDEX IDX_389B783C54C8C93 ON tag');
        $this->addSql('ALTER TABLE tag DROP type_id');
    }
}
