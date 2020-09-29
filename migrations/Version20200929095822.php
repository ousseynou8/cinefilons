<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929095822 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD realisateurs VARCHAR(100) DEFAULT NULL, ADD acteurs VARCHAR(100) DEFAULT NULL, ADD trailer VARCHAR(255) DEFAULT NULL, ADD seances VARCHAR(255) DEFAULT NULL, ADD critiques_spectateurs VARCHAR(255) DEFAULT NULL, ADD photos LONGTEXT NOT NULL, ADD no VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP realisateurs, DROP acteurs, DROP trailer, DROP seances, DROP critiques_spectateurs, DROP photos, DROP no');
    }
}
