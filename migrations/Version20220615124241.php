<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615124241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, note VARCHAR(255) DEFAULT NULL, coefmodule VARCHAR(255) DEFAULT NULL, coefbloc VARCHAR(255) DEFAULT NULL, moy VARCHAR(255) DEFAULT NULL, moygeneral VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes_modules (notes_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_2E610F83FC56F556 (notes_id), INDEX IDX_2E610F8360D6DC42 (modules_id), PRIMARY KEY(notes_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes_etudiants (notes_id INT NOT NULL, etudiants_id INT NOT NULL, INDEX IDX_83C197D6FC56F556 (notes_id), INDEX IDX_83C197D6A873A5C6 (etudiants_id), PRIMARY KEY(notes_id, etudiants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notes_modules ADD CONSTRAINT FK_2E610F83FC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_modules ADD CONSTRAINT FK_2E610F8360D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_etudiants ADD CONSTRAINT FK_83C197D6FC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_etudiants ADD CONSTRAINT FK_83C197D6A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notes_modules DROP FOREIGN KEY FK_2E610F83FC56F556');
        $this->addSql('ALTER TABLE notes_etudiants DROP FOREIGN KEY FK_83C197D6FC56F556');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE notes_modules');
        $this->addSql('DROP TABLE notes_etudiants');
    }
}
