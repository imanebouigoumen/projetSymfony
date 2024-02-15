<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215130420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lecon AS SELECT id, prof_lecon_id, nom, description FROM lecon');
        $this->addSql('DROP TABLE lecon');
        $this->addSql('CREATE TABLE lecon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prof_lecon_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, CONSTRAINT FK_94E6242E46FE6ACF FOREIGN KEY (prof_lecon_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lecon (id, prof_lecon_id, nom, description) SELECT id, prof_lecon_id, nom, description FROM __temp__lecon');
        $this->addSql('DROP TABLE __temp__lecon');
        $this->addSql('CREATE INDEX IDX_94E6242E46FE6ACF ON lecon (prof_lecon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lecon AS SELECT id, prof_lecon_id, nom, description FROM lecon');
        $this->addSql('DROP TABLE lecon');
        $this->addSql('CREATE TABLE lecon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prof_lecon_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, CONSTRAINT FK_94E6242E46FE6ACF FOREIGN KEY (prof_lecon_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lecon (id, prof_lecon_id, nom, description) SELECT id, prof_lecon_id, nom, description FROM __temp__lecon');
        $this->addSql('DROP TABLE __temp__lecon');
        $this->addSql('CREATE INDEX IDX_94E6242E46FE6ACF ON lecon (prof_lecon_id)');
    }
}
