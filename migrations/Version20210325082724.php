<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325082724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_9B80EC64AA08CB10 (login), UNIQUE INDEX UNIQ_9B80EC64E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activitesequencetheorique (id INT AUTO_INCREMENT NOT NULL, idsequencetheorique_id INT NOT NULL, idatelier_id INT NOT NULL, perfObjectif DOUBLE PRECISION NOT NULL, intensiteObjectif DOUBLE PRECISION NOT NULL, ordre INT NOT NULL, INDEX IDX_4EDF561A549B9888 (idsequencetheorique_id), INDEX IDX_4EDF561A4F4BD20F (idatelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, titre TEXT NOT NULL, image TEXT NOT NULL, uniteDePerformance TEXT NOT NULL, uniteDIntensite TEXT NOT NULL, description TEXT NOT NULL, resume TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoriesequence (id INT AUTO_INCREMENT NOT NULL, titre TEXT NOT NULL, image TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_atelier (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, atelier_id INT NOT NULL, titre LONGTEXT NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_92738A7076C50E4A (proprietaire_id), INDEX IDX_92738A7082E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sequencetheorique (id INT AUTO_INCREMENT NOT NULL, idcategoriesequence_id INT NOT NULL, titre TEXT NOT NULL, niveau INT NOT NULL, INDEX IDX_3107E7DE5FEF9641 (idcategoriesequence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activitesequencetheorique ADD CONSTRAINT FK_4EDF561A549B9888 FOREIGN KEY (idsequencetheorique_id) REFERENCES sequencetheorique (id)');
        $this->addSql('ALTER TABLE activitesequencetheorique ADD CONSTRAINT FK_4EDF561A4F4BD20F FOREIGN KEY (idatelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE commentaire_atelier ADD CONSTRAINT FK_92738A7076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES Utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire_atelier ADD CONSTRAINT FK_92738A7082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE sequencetheorique ADD CONSTRAINT FK_3107E7DE5FEF9641 FOREIGN KEY (idcategoriesequence_id) REFERENCES categoriesequence (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_atelier DROP FOREIGN KEY FK_92738A7076C50E4A');
        $this->addSql('ALTER TABLE activitesequencetheorique DROP FOREIGN KEY FK_4EDF561A4F4BD20F');
        $this->addSql('ALTER TABLE commentaire_atelier DROP FOREIGN KEY FK_92738A7082E2CF35');
        $this->addSql('ALTER TABLE sequencetheorique DROP FOREIGN KEY FK_3107E7DE5FEF9641');
        $this->addSql('ALTER TABLE activitesequencetheorique DROP FOREIGN KEY FK_4EDF561A549B9888');
        $this->addSql('DROP TABLE Utilisateur');
        $this->addSql('DROP TABLE activitesequencetheorique');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE categoriesequence');
        $this->addSql('DROP TABLE commentaire_atelier');
        $this->addSql('DROP TABLE sequencetheorique');
    }
}
