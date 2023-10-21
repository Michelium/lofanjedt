<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021130431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry ADD language_id INT DEFAULT NULL AFTER id');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D7082F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('CREATE INDEX IDX_2B219D7082F1BAF4 ON entry (language_id)');
        $this->addSql("INSERT INTO `language` (`id`, `name`) VALUES (1, 'Gambinoste'), (2, 'Arnaktis')");
        $this->addSql('UPDATE `entry` SET language_id = 1;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D7082F1BAF4');
        $this->addSql('DROP INDEX IDX_2B219D7082F1BAF4 ON entry');
        $this->addSql('ALTER TABLE entry DROP language_id');
    }
}
