<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260908195310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spare_part_tag (spare_part_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY (spare_part_id, tag_id), CONSTRAINT FK_D652547A49B7A72 FOREIGN KEY (spare_part_id) REFERENCES spare_part (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D652547ABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D652547A49B7A72 ON spare_part_tag (spare_part_id)');
        $this->addSql('CREATE INDEX IDX_D652547ABAD26311 ON spare_part_tag (tag_id)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__spare_part AS SELECT id, name, article_number, price, description, updated_at, manufacturer, quantity, created_at, is_active, dimensions, combine_id FROM spare_part');
        $this->addSql('DROP TABLE spare_part');
        $this->addSql('CREATE TABLE spare_part (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, article_number VARCHAR(100) NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, description CLOB DEFAULT NULL, updated_at DATETIME NOT NULL, manufacturer VARCHAR(255) DEFAULT NULL, quantity INTEGER NOT NULL, created_at DATETIME NOT NULL, is_active BOOLEAN NOT NULL, dimensions VARCHAR(255) DEFAULT NULL, combine_id INTEGER DEFAULT NULL, type_id INTEGER DEFAULT NULL, CONSTRAINT FK_E3D09D369146FD7B FOREIGN KEY (combine_id) REFERENCES combine (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E3D09D36C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO spare_part (id, name, article_number, price, description, updated_at, manufacturer, quantity, created_at, is_active, dimensions, combine_id) SELECT id, name, article_number, price, description, updated_at, manufacturer, quantity, created_at, is_active, dimensions, combine_id FROM __temp__spare_part');
        $this->addSql('DROP TABLE __temp__spare_part');
        $this->addSql('CREATE INDEX IDX_E3D09D369146FD7B ON spare_part (combine_id)');
        $this->addSql('CREATE INDEX IDX_E3D09D36C54C8C93 ON spare_part (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE spare_part_tag');
        $this->addSql('DROP TABLE type');
        $this->addSql('CREATE TEMPORARY TABLE __temp__spare_part AS SELECT id, name, article_number, price, description, updated_at, manufacturer, quantity, created_at, is_active, dimensions, combine_id FROM spare_part');
        $this->addSql('DROP TABLE spare_part');
        $this->addSql('CREATE TABLE spare_part (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, article_number VARCHAR(100) NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, description CLOB DEFAULT NULL, updated_at DATETIME NOT NULL, manufacturer VARCHAR(255) DEFAULT NULL, quantity INTEGER NOT NULL, created_at DATETIME NOT NULL, is_active BOOLEAN NOT NULL, dimensions VARCHAR(255) DEFAULT NULL, combine_id INTEGER DEFAULT NULL, CONSTRAINT FK_E3D09D369146FD7B FOREIGN KEY (combine_id) REFERENCES combine (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO spare_part (id, name, article_number, price, description, updated_at, manufacturer, quantity, created_at, is_active, dimensions, combine_id) SELECT id, name, article_number, price, description, updated_at, manufacturer, quantity, created_at, is_active, dimensions, combine_id FROM __temp__spare_part');
        $this->addSql('DROP TABLE __temp__spare_part');
        $this->addSql('CREATE INDEX IDX_E3D09D369146FD7B ON spare_part (combine_id)');
    }
}
