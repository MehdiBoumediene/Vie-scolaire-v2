<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615132102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE notes_etudiants');
        $this->addSql('DROP TABLE notes_modules');
        $this->addSql('ALTER TABLE notes DROP INDEX IDX_11BA68CAB9A1716, ADD UNIQUE INDEX UNIQ_11BA68CAB9A1716 (intervenant_id)');
        $this->addSql('ALTER TABLE notes ADD module_id INT DEFAULT NULL, ADD apprenant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CAFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CC5697D6D FOREIGN KEY (apprenant_id) REFERENCES etudiants (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11BA68CAFC2B591 ON notes (module_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11BA68CC5697D6D ON notes (apprenant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notes_etudiants (notes_id INT NOT NULL, etudiants_id INT NOT NULL, INDEX IDX_83C197D6FC56F556 (notes_id), INDEX IDX_83C197D6A873A5C6 (etudiants_id), PRIMARY KEY(notes_id, etudiants_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notes_modules (notes_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_2E610F83FC56F556 (notes_id), INDEX IDX_2E610F8360D6DC42 (modules_id), PRIMARY KEY(notes_id, modules_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE notes_etudiants ADD CONSTRAINT FK_83C197D6A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_etudiants ADD CONSTRAINT FK_83C197D6FC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_modules ADD CONSTRAINT FK_2E610F8360D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_modules ADD CONSTRAINT FK_2E610F83FC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes DROP INDEX UNIQ_11BA68CAB9A1716, ADD INDEX IDX_11BA68CAB9A1716 (intervenant_id)');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CAFC2B591');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CC5697D6D');
        $this->addSql('DROP INDEX UNIQ_11BA68CAFC2B591 ON notes');
        $this->addSql('DROP INDEX UNIQ_11BA68CC5697D6D ON notes');
        $this->addSql('ALTER TABLE notes DROP module_id, DROP apprenant_id');
    }
}
