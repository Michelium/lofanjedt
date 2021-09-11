<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911212332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry ADD base_form VARCHAR(255) DEFAULT NULL, ADD base_form_ipa VARCHAR(255) DEFAULT NULL, ADD countability VARCHAR(255) DEFAULT NULL, ADD plural_form VARCHAR(255) DEFAULT NULL, ADD plural_form_ipa VARCHAR(255) DEFAULT NULL, ADD equivalent_english VARCHAR(255) DEFAULT NULL, ADD definition_english VARCHAR(255) DEFAULT NULL, ADD equivalent_other_languages VARCHAR(255) DEFAULT NULL, ADD additional_information VARCHAR(255) DEFAULT NULL, ADD dialect VARCHAR(255) DEFAULT NULL, ADD etymology VARCHAR(255) DEFAULT NULL, ADD infinitive VARCHAR(255) DEFAULT NULL, ADD infinitive_ipa VARCHAR(255) DEFAULT NULL, ADD transitivity VARCHAR(255) DEFAULT NULL, ADD conjugation VARCHAR(255) DEFAULT NULL, ADD definiteness VARCHAR(255) DEFAULT NULL, ADD meaning VARCHAR(255) DEFAULT NULL, ADD gender VARCHAR(255) DEFAULT NULL, ADD literal_meaning_english VARCHAR(255) DEFAULT NULL, ADD pronouns_type VARCHAR(255) DEFAULT NULL, ADD conjunctions_type VARCHAR(255) DEFAULT NULL, ADD adpositions_type VARCHAR(255) DEFAULT NULL, ADD numerals_type VARCHAR(255) DEFAULT NULL, ADD affixes_type VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry DROP base_form, DROP base_form_ipa, DROP countability, DROP plural_form, DROP plural_form_ipa, DROP equivalent_english, DROP definition_english, DROP equivalent_other_languages, DROP additional_information, DROP dialect, DROP etymology, DROP infinitive, DROP infinitive_ipa, DROP transitivity, DROP conjugation, DROP definiteness, DROP meaning, DROP gender, DROP literal_meaning_english, DROP pronouns_type, DROP conjunctions_type, DROP adpositions_type, DROP numerals_type, DROP affixes_type');
    }
}
