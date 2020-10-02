<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002140747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, film_id INT NOT NULL, user_id INT NOT NULL, note INT NOT NULL, text LONGTEXT DEFAULT NULL, INDEX IDX_67F068BC567F5183 (film_id), INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, note INT NOT NULL, duree VARCHAR(100) DEFAULT NULL, type VARCHAR(100) NOT NULL, date_de_sortie VARCHAR(100) NOT NULL, classification VARCHAR(100) DEFAULT NULL, synopsis VARCHAR(255) DEFAULT NULL, videos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', critiques_presse LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', poster VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(100) DEFAULT NULL, realisateurs VARCHAR(100) DEFAULT NULL, acteurs VARCHAR(100) DEFAULT NULL, trailer VARCHAR(255) DEFAULT NULL, seances VARCHAR(255) DEFAULT NULL, critiques_spectateurs VARCHAR(255) DEFAULT NULL, photos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', casting VARCHAR(255) DEFAULT NULL, code_allocine INT NOT NULL, UNIQUE INDEX UNIQ_8244BE229375F7 (code_allocine), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC567F5183');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE film');
    }
}
