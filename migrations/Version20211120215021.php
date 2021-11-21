<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120215021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bailleur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, nationalite VARCHAR(255) NOT NULL, num_piece VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, lieu_de_travail VARCHAR(255) NOT NULL, nom_agence VARCHAR(255) NOT NULL, nbr_immeuble INT NOT NULL, UNIQUE INDEX UNIQ_7ABB27F3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, nationalite VARCHAR(255) NOT NULL, num_piece VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, tuteur VARCHAR(255) NOT NULL, tel_tuteur VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C47CF6EBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superviseur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, nationalite VARCHAR(255) NOT NULL, num_piece VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, num_de_lieu INT NOT NULL, nom_du_ministere VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9DF40730E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, nationalite VARCHAR(255) NOT NULL, num_piece VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bailleur');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE superviseur');
        $this->addSql('DROP TABLE user');
    }
}
