<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307075209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conversation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_creation DATE NOT NULL)');
        $this->addSql('DROP TABLE membre_message_prive');
        $this->addSql('DROP TABLE messagePrive');
        $this->addSql('DROP INDEX IDX_8FF9F39C6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__amitie AS SELECT id, membre_id, date, status FROM amitie');
        $this->addSql('DROP TABLE amitie');
        $this->addSql('CREATE TABLE amitie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, status VARCHAR(1) NOT NULL COLLATE BINARY, CONSTRAINT FK_8FF9F39C6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO amitie (id, membre_id, date, status) SELECT id, membre_id, date, status FROM __temp__amitie');
        $this->addSql('DROP TABLE __temp__amitie');
        $this->addSql('CREATE INDEX IDX_8FF9F39C6A99F74A ON amitie (membre_id)');
        $this->addSql('DROP INDEX IDX_67F068BCAFFB3979');
        $this->addSql('DROP INDEX IDX_67F068BC71128C5C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, membres_id, publications_id, message, date FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER DEFAULT NULL, publications_id INTEGER DEFAULT NULL, message CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL, CONSTRAINT FK_67F068BC71128C5C FOREIGN KEY (membres_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_67F068BCAFFB3979 FOREIGN KEY (publications_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, membres_id, publications_id, message, date) SELECT id, membres_id, publications_id, message, date FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCAFFB3979 ON commentaire (publications_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC71128C5C ON commentaire (membres_id)');
        $this->addSql('DROP INDEX IDX_AC6340B3AFFB3979');
        $this->addSql('DROP INDEX IDX_AC6340B371128C5C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__like AS SELECT id, membres_id, publications_id FROM "like"');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('CREATE TABLE "like" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER DEFAULT NULL, publications_id INTEGER DEFAULT NULL, CONSTRAINT FK_AC6340B371128C5C FOREIGN KEY (membres_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC6340B3AFFB3979 FOREIGN KEY (publications_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "like" (id, membres_id, publications_id) SELECT id, membres_id, publications_id FROM __temp__like');
        $this->addSql('DROP TABLE __temp__like');
        $this->addSql('CREATE INDEX IDX_AC6340B3AFFB3979 ON "like" (publications_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B371128C5C ON "like" (membres_id)');
        $this->addSql('DROP INDEX IDX_B4436BE0FD02F13');
        $this->addSql('DROP INDEX IDX_B4436BE06A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre_evenement AS SELECT membre_id, evenement_id FROM membre_evenement');
        $this->addSql('DROP TABLE membre_evenement');
        $this->addSql('CREATE TABLE membre_evenement (membre_id INTEGER NOT NULL, evenement_id INTEGER NOT NULL, PRIMARY KEY(membre_id, evenement_id), CONSTRAINT FK_B4436BE06A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B4436BE0FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO membre_evenement (membre_id, evenement_id) SELECT membre_id, evenement_id FROM __temp__membre_evenement');
        $this->addSql('DROP TABLE __temp__membre_evenement');
        $this->addSql('CREATE INDEX IDX_B4436BE0FD02F13 ON membre_evenement (evenement_id)');
        $this->addSql('CREATE INDEX IDX_B4436BE06A99F74A ON membre_evenement (membre_id)');
        $this->addSql('DROP INDEX IDX_AF3C67796A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication AS SELECT id, membre_id, date, visibilite, signalement, message FROM publication');
        $this->addSql('DROP TABLE publication');
        $this->addSql('CREATE TABLE publication (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, visibilite INTEGER NOT NULL, signalement INTEGER NOT NULL, message CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_AF3C67796A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publication (id, membre_id, date, visibilite, signalement, message) SELECT id, membre_id, date, visibilite, signalement, message FROM __temp__publication');
        $this->addSql('DROP TABLE __temp__publication');
        $this->addSql('CREATE INDEX IDX_AF3C67796A99F74A ON publication (membre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE membre_message_prive (membre_id INTEGER NOT NULL, message_prive_id INTEGER NOT NULL, PRIMARY KEY(membre_id, message_prive_id))');
        $this->addSql('CREATE INDEX IDX_2570D51477321B04 ON membre_message_prive (message_prive_id)');
        $this->addSql('CREATE INDEX IDX_2570D5146A99F74A ON membre_message_prive (membre_id)');
        $this->addSql('CREATE TABLE messagePrive (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATETIME NOT NULL, message CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP INDEX IDX_8FF9F39C6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__amitie AS SELECT id, membre_id, date, status FROM amitie');
        $this->addSql('DROP TABLE amitie');
        $this->addSql('CREATE TABLE amitie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, status VARCHAR(1) NOT NULL)');
        $this->addSql('INSERT INTO amitie (id, membre_id, date, status) SELECT id, membre_id, date, status FROM __temp__amitie');
        $this->addSql('DROP TABLE __temp__amitie');
        $this->addSql('CREATE INDEX IDX_8FF9F39C6A99F74A ON amitie (membre_id)');
        $this->addSql('DROP INDEX IDX_67F068BC71128C5C');
        $this->addSql('DROP INDEX IDX_67F068BCAFFB3979');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, membres_id, publications_id, message, date FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER DEFAULT NULL, publications_id INTEGER DEFAULT NULL, message CLOB NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, membres_id, publications_id, message, date) SELECT id, membres_id, publications_id, message, date FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC71128C5C ON commentaire (membres_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCAFFB3979 ON commentaire (publications_id)');
        $this->addSql('DROP INDEX IDX_AC6340B371128C5C');
        $this->addSql('DROP INDEX IDX_AC6340B3AFFB3979');
        $this->addSql('CREATE TEMPORARY TABLE __temp__like AS SELECT id, membres_id, publications_id FROM "like"');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('CREATE TABLE "like" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER DEFAULT NULL, publications_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO "like" (id, membres_id, publications_id) SELECT id, membres_id, publications_id FROM __temp__like');
        $this->addSql('DROP TABLE __temp__like');
        $this->addSql('CREATE INDEX IDX_AC6340B371128C5C ON "like" (membres_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3AFFB3979 ON "like" (publications_id)');
        $this->addSql('DROP INDEX IDX_B4436BE06A99F74A');
        $this->addSql('DROP INDEX IDX_B4436BE0FD02F13');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre_evenement AS SELECT membre_id, evenement_id FROM membre_evenement');
        $this->addSql('DROP TABLE membre_evenement');
        $this->addSql('CREATE TABLE membre_evenement (membre_id INTEGER NOT NULL, evenement_id INTEGER NOT NULL, PRIMARY KEY(membre_id, evenement_id))');
        $this->addSql('INSERT INTO membre_evenement (membre_id, evenement_id) SELECT membre_id, evenement_id FROM __temp__membre_evenement');
        $this->addSql('DROP TABLE __temp__membre_evenement');
        $this->addSql('CREATE INDEX IDX_B4436BE06A99F74A ON membre_evenement (membre_id)');
        $this->addSql('CREATE INDEX IDX_B4436BE0FD02F13 ON membre_evenement (evenement_id)');
        $this->addSql('DROP INDEX IDX_AF3C67796A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication AS SELECT id, membre_id, date, visibilite, signalement, message FROM publication');
        $this->addSql('DROP TABLE publication');
        $this->addSql('CREATE TABLE publication (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, visibilite INTEGER NOT NULL, signalement INTEGER NOT NULL, message CLOB NOT NULL)');
        $this->addSql('INSERT INTO publication (id, membre_id, date, visibilite, signalement, message) SELECT id, membre_id, date, visibilite, signalement, message FROM __temp__publication');
        $this->addSql('DROP TABLE __temp__publication');
        $this->addSql('CREATE INDEX IDX_AF3C67796A99F74A ON publication (membre_id)');
    }
}
