<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220612103244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE absences (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, du DATETIME DEFAULT NULL, au DATETIME DEFAULT NULL, absent TINYINT(1) DEFAULT NULL, dateabsence DATETIME DEFAULT NULL, enretard TINYINT(1) DEFAULT NULL, dateretard DATETIME DEFAULT NULL, present TINYINT(1) DEFAULT NULL, datepresence DATETIME DEFAULT NULL, userid VARCHAR(255) DEFAULT NULL, INDEX IDX_F9C0EFFFAFC2B591 (module_id), INDEX IDX_F9C0EFFF8F5EA509 (classe_id), INDEX IDX_F9C0EFFFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE absences_etudiants (absences_id INT NOT NULL, etudiants_id INT NOT NULL, INDEX IDX_E06802E59A5BDCB7 (absences_id), INDEX IDX_E06802E5A873A5C6 (etudiants_id), PRIMARY KEY(absences_id, etudiants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE absences_intervenants (absences_id INT NOT NULL, intervenants_id INT NOT NULL, INDEX IDX_69E4FB759A5BDCB7 (absences_id), INDEX IDX_69E4FB75130E9263 (intervenants_id), PRIMARY KEY(absences_id, intervenants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blocs (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) NOT NULL, INDEX IDX_90770F748F5EA509 (classe_id), INDEX IDX_90770F74A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendrier (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, bloc_id INT DEFAULT NULL, module_id INT DEFAULT NULL, intervenant_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, all_day TINYINT(1) DEFAULT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_B2753CB98F5EA509 (classe_id), INDEX IDX_B2753CB95582E9C0 (bloc_id), INDEX IDX_B2753CB9AFC2B591 (module_id), INDEX IDX_B2753CB9AB9A1716 (intervenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, intervenant_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_A2B07288AFC2B591 (module_id), INDEX IDX_A2B07288AB9A1716 (intervenant_id), INDEX IDX_A2B07288A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprises (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, responsable VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiants (id INT AUTO_INCREMENT NOT NULL, classes_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_227C02EB9E225B24 (classes_id), INDEX IDX_227C02EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiants_modules (etudiants_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_D43B3B6AA873A5C6 (etudiants_id), INDEX IDX_D43B3B6A60D6DC42 (modules_id), PRIMARY KEY(etudiants_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, telechargements_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_6354059AFC2B591 (module_id), INDEX IDX_63540591536CC8D (telechargements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenants (id INT AUTO_INCREMENT NOT NULL, classes_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_79A002C09E225B24 (classes_id), INDEX IDX_79A002C0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenants_modules (intervenants_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_5A1867E4130E9263 (intervenants_id), INDEX IDX_5A1867E460D6DC42 (modules_id), PRIMARY KEY(intervenants_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, objet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_DB021E96F624B39D (sender_id), INDEX IDX_DB021E96E92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modules (id INT AUTO_INCREMENT NOT NULL, bloc_id INT DEFAULT NULL, classes_id INT DEFAULT NULL, users_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_2EB743D75582E9C0 (bloc_id), INDEX IDX_2EB743D79E225B24 (classes_id), INDEX IDX_2EB743D767B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telechargements (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_623AB077A76ED395 (user_id), INDEX IDX_623AB0778F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteurs (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, users_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_58316743A4AEAFEA (entreprise_id), INDEX IDX_5831674367B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_classes (users_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_F2ED0A0F67B3B43D (users_id), INDEX IDX_F2ED0A0F9E225B24 (classes_id), PRIMARY KEY(users_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFFAFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFF8F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE absences_etudiants ADD CONSTRAINT FK_E06802E59A5BDCB7 FOREIGN KEY (absences_id) REFERENCES absences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absences_etudiants ADD CONSTRAINT FK_E06802E5A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absences_intervenants ADD CONSTRAINT FK_69E4FB759A5BDCB7 FOREIGN KEY (absences_id) REFERENCES absences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absences_intervenants ADD CONSTRAINT FK_69E4FB75130E9263 FOREIGN KEY (intervenants_id) REFERENCES intervenants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blocs ADD CONSTRAINT FK_90770F748F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE blocs ADD CONSTRAINT FK_90770F74A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB98F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB95582E9C0 FOREIGN KEY (bloc_id) REFERENCES blocs (id)');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9AFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288AFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenants (id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EBA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE etudiants_modules ADD CONSTRAINT FK_D43B3B6AA873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiants_modules ADD CONSTRAINT FK_D43B3B6A60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059AFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_63540591536CC8D FOREIGN KEY (telechargements_id) REFERENCES telechargements (id)');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C09E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE intervenants_modules ADD CONSTRAINT FK_5A1867E4130E9263 FOREIGN KEY (intervenants_id) REFERENCES intervenants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenants_modules ADD CONSTRAINT FK_5A1867E460D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96E92F8F78 FOREIGN KEY (recipient_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D75582E9C0 FOREIGN KEY (bloc_id) REFERENCES blocs (id)');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D79E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D767B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE telechargements ADD CONSTRAINT FK_623AB077A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE telechargements ADD CONSTRAINT FK_623AB0778F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_58316743A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_5831674367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_classes ADD CONSTRAINT FK_F2ED0A0F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_classes ADD CONSTRAINT FK_F2ED0A0F9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences_etudiants DROP FOREIGN KEY FK_E06802E59A5BDCB7');
        $this->addSql('ALTER TABLE absences_intervenants DROP FOREIGN KEY FK_69E4FB759A5BDCB7');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB95582E9C0');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D75582E9C0');
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFF8F5EA509');
        $this->addSql('ALTER TABLE blocs DROP FOREIGN KEY FK_90770F748F5EA509');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB98F5EA509');
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB9E225B24');
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C09E225B24');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D79E225B24');
        $this->addSql('ALTER TABLE telechargements DROP FOREIGN KEY FK_623AB0778F5EA509');
        $this->addSql('ALTER TABLE users_classes DROP FOREIGN KEY FK_F2ED0A0F9E225B24');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_58316743A4AEAFEA');
        $this->addSql('ALTER TABLE absences_etudiants DROP FOREIGN KEY FK_E06802E5A873A5C6');
        $this->addSql('ALTER TABLE etudiants_modules DROP FOREIGN KEY FK_D43B3B6AA873A5C6');
        $this->addSql('ALTER TABLE absences_intervenants DROP FOREIGN KEY FK_69E4FB75130E9263');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288AB9A1716');
        $this->addSql('ALTER TABLE intervenants_modules DROP FOREIGN KEY FK_5A1867E4130E9263');
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFFAFC2B591');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9AFC2B591');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288AFC2B591');
        $this->addSql('ALTER TABLE etudiants_modules DROP FOREIGN KEY FK_D43B3B6A60D6DC42');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059AFC2B591');
        $this->addSql('ALTER TABLE intervenants_modules DROP FOREIGN KEY FK_5A1867E460D6DC42');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_63540591536CC8D');
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFFA76ED395');
        $this->addSql('ALTER TABLE blocs DROP FOREIGN KEY FK_90770F74A76ED395');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9AB9A1716');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288A76ED395');
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EBA76ED395');
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C0A76ED395');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96E92F8F78');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D767B3B43D');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE telechargements DROP FOREIGN KEY FK_623AB077A76ED395');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_5831674367B3B43D');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A76ED395');
        $this->addSql('ALTER TABLE users_classes DROP FOREIGN KEY FK_F2ED0A0F67B3B43D');
        $this->addSql('DROP TABLE absences');
        $this->addSql('DROP TABLE absences_etudiants');
        $this->addSql('DROP TABLE absences_intervenants');
        $this->addSql('DROP TABLE blocs');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE entreprises');
        $this->addSql('DROP TABLE etudiants');
        $this->addSql('DROP TABLE etudiants_modules');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE intervenants');
        $this->addSql('DROP TABLE intervenants_modules');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE modules');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE telechargements');
        $this->addSql('DROP TABLE tuteurs');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_classes');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
