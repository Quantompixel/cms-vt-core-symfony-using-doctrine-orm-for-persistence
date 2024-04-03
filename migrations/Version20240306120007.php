<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306120007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie_quote AS SELECT id, movie_id, quote, character FROM movie_quote');
        $this->addSql('DROP TABLE movie_quote');
        $this->addSql('CREATE TABLE movie_quote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, movie_id INTEGER NOT NULL, quote VARCHAR(255) DEFAULT NULL, character VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1533D1688F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movie_quote (id, movie_id, quote, character) SELECT id, movie_id, quote, character FROM __temp__movie_quote');
        $this->addSql('DROP TABLE __temp__movie_quote');
        $this->addSql('CREATE INDEX IDX_1533D1688F93B6FC ON movie_quote (movie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE movie_quote ADD COLUMN time DATETIME DEFAULT NULL');
    }
}