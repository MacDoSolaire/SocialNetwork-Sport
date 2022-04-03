<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317190242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participer_event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, evenement_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_FB606537FD02F13 ON participer_event (evenement_id)');
        $this->addSql('CREATE INDEX IDX_FB6065376A99F74A ON participer_event (membre_id)');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('DROP TABLE membre_evenement');
        $this->addSql('DROP TABLE publication_reply');
        $this->addSql('DROP INDEX IDX_8FF9F39C6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__amitie AS SELECT id, membre_id, date, status FROM amitie');
        $this->addSql('DROP TABLE amitie');
        $this->addSql('CREATE TABLE amitie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, status VARCHAR(1) NOT NULL COLLATE BINARY, CONSTRAINT FK_8FF9F39C6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO amitie (id, membre_id, date, status) SELECT id, membre_id, date, status FROM __temp__amitie');
        $this->addSql('DROP TABLE __temp__amitie');
        $this->addSql('CREATE INDEX IDX_8FF9F39C6A99F74A ON amitie (membre_id)');
        $this->addSql('DROP INDEX IDX_B26681E6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement AS SELECT id, membre_id, adresse, date_deb, date_fin, visibilite, nb_pers, signalement, message FROM evenement');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('CREATE TABLE evenement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER DEFAULT NULL, adresse VARCHAR(255) NOT NULL COLLATE BINARY, date_deb DATETIME NOT NULL, date_fin DATETIME NOT NULL, visibilite INTEGER NOT NULL, nb_pers INTEGER NOT NULL, signalement INTEGER NOT NULL, message CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_B26681E6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO evenement (id, membre_id, adresse, date_deb, date_fin, visibilite, nb_pers, signalement, message) SELECT id, membre_id, adresse, date_deb, date_fin, visibilite, nb_pers, signalement, message FROM __temp__evenement');
        $this->addSql('DROP TABLE __temp__evenement');
        $this->addSql('CREATE INDEX IDX_B26681E6A99F74A ON evenement (membre_id)');
        $this->addSql('DROP INDEX IDX_F30253E6A99F74A');
        $this->addSql('DROP INDEX IDX_F30253EFD02F13');
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement_like AS SELECT id, evenement_id, membre_id FROM evenement_like');
        $this->addSql('DROP TABLE evenement_like');
        $this->addSql('CREATE TABLE evenement_like (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, evenement_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, CONSTRAINT FK_F30253EFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F30253E6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO evenement_like (id, evenement_id, membre_id) SELECT id, evenement_id, membre_id FROM __temp__evenement_like');
        $this->addSql('DROP TABLE __temp__evenement_like');
        $this->addSql('CREATE INDEX IDX_F30253E6A99F74A ON evenement_like (membre_id)');
        $this->addSql('CREATE INDEX IDX_F30253EFD02F13 ON evenement_like (evenement_id)');
        $this->addSql('DROP INDEX IDX_6E026A186A99F74A');
        $this->addSql('DROP INDEX IDX_6E026A18FD02F13');
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement_reply AS SELECT id, evenement_id, membre_id, message, date FROM evenement_reply');
        $this->addSql('DROP TABLE evenement_reply');
        $this->addSql('CREATE TABLE evenement_reply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, evenement_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL, CONSTRAINT FK_6E026A18FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6E026A186A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO evenement_reply (id, evenement_id, membre_id, message, date) SELECT id, evenement_id, membre_id, message, date FROM __temp__evenement_reply');
        $this->addSql('DROP TABLE __temp__evenement_reply');
        $this->addSql('CREATE INDEX IDX_6E026A186A99F74A ON evenement_reply (membre_id)');
        $this->addSql('CREATE INDEX IDX_6E026A18FD02F13 ON evenement_reply (evenement_id)');
        $this->addSql('DROP INDEX IDX_2321BE989AC0396');
        $this->addSql('DROP INDEX IDX_2321BE986A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre_conversation AS SELECT membre_id, conversation_id FROM membre_conversation');
        $this->addSql('DROP TABLE membre_conversation');
        $this->addSql('CREATE TABLE membre_conversation (membre_id INTEGER NOT NULL, conversation_id INTEGER NOT NULL, PRIMARY KEY(membre_id, conversation_id), CONSTRAINT FK_2321BE986A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2321BE989AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO membre_conversation (membre_id, conversation_id) SELECT membre_id, conversation_id FROM __temp__membre_conversation');
        $this->addSql('DROP TABLE __temp__membre_conversation');
        $this->addSql('CREATE INDEX IDX_2321BE989AC0396 ON membre_conversation (conversation_id)');
        $this->addSql('CREATE INDEX IDX_2321BE986A99F74A ON membre_conversation (membre_id)');
        $this->addSql('DROP INDEX IDX_C80C000B6A99F74A');
        $this->addSql('DROP INDEX IDX_C80C000B9AC0396');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messagePrive AS SELECT id, conversation_id, membre_id, message, date FROM messagePrive');
        $this->addSql('DROP TABLE messagePrive');
        $this->addSql('CREATE TABLE messagePrive (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, conversation_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL, CONSTRAINT FK_C80C000B9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C80C000B6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO messagePrive (id, conversation_id, membre_id, message, date) SELECT id, conversation_id, membre_id, message, date FROM __temp__messagePrive');
        $this->addSql('DROP TABLE __temp__messagePrive');
        $this->addSql('CREATE INDEX IDX_C80C000B6A99F74A ON messagePrive (membre_id)');
        $this->addSql('CREATE INDEX IDX_C80C000B9AC0396 ON messagePrive (conversation_id)');
        $this->addSql('DROP INDEX IDX_AF3C67796A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication AS SELECT id, membre_id, date, visibilite, signalement, message FROM publication');
        $this->addSql('DROP TABLE publication');
        $this->addSql('CREATE TABLE publication (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, visibilite INTEGER NOT NULL, signalement INTEGER NOT NULL, message CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_AF3C67796A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publication (id, membre_id, date, visibilite, signalement, message) SELECT id, membre_id, date, visibilite, signalement, message FROM __temp__publication');
        $this->addSql('DROP TABLE __temp__publication');
        $this->addSql('CREATE INDEX IDX_AF3C67796A99F74A ON publication (membre_id)');
        $this->addSql('DROP INDEX IDX_6AB418326A99F74A');
        $this->addSql('DROP INDEX IDX_6AB4183238B217A7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publicationReply AS SELECT id, publication_id, membre_id, message, date FROM publicationReply');
        $this->addSql('DROP TABLE publicationReply');
        $this->addSql('CREATE TABLE publicationReply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publication_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL, CONSTRAINT FK_6AB4183238B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6AB418326A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publicationReply (id, publication_id, membre_id, message, date) SELECT id, publication_id, membre_id, message, date FROM __temp__publicationReply');
        $this->addSql('DROP TABLE __temp__publicationReply');
        $this->addSql('CREATE INDEX IDX_6AB418326A99F74A ON publicationReply (membre_id)');
        $this->addSql('CREATE INDEX IDX_6AB4183238B217A7 ON publicationReply (publication_id)');
        $this->addSql('DROP INDEX IDX_A79BC17E6A99F74A');
        $this->addSql('DROP INDEX IDX_A79BC17E38B217A7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication_like AS SELECT id, publication_id, membre_id FROM publication_like');
        $this->addSql('DROP TABLE publication_like');
        $this->addSql('CREATE TABLE publication_like (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publication_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, CONSTRAINT FK_A79BC17E38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A79BC17E6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publication_like (id, publication_id, membre_id) SELECT id, publication_id, membre_id FROM __temp__publication_like');
        $this->addSql('DROP TABLE __temp__publication_like');
        $this->addSql('CREATE INDEX IDX_A79BC17E6A99F74A ON publication_like (membre_id)');
        $this->addSql('CREATE INDEX IDX_A79BC17E38B217A7 ON publication_like (publication_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER DEFAULT NULL, publications_id INTEGER DEFAULT NULL, message CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67F068BCAFFB3979 ON commentaire (publications_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC71128C5C ON commentaire (membres_id)');
        $this->addSql('CREATE TABLE "like" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER DEFAULT NULL, publications_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_AC6340B3AFFB3979 ON "like" (publications_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B371128C5C ON "like" (membres_id)');
        $this->addSql('CREATE TABLE membre_evenement (membre_id INTEGER NOT NULL, evenement_id INTEGER NOT NULL, PRIMARY KEY(membre_id, evenement_id))');
        $this->addSql('CREATE INDEX IDX_B4436BE0FD02F13 ON membre_evenement (evenement_id)');
        $this->addSql('CREATE INDEX IDX_B4436BE06A99F74A ON membre_evenement (membre_id)');
        $this->addSql('CREATE TABLE publication_reply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publication_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL COLLATE BINARY, date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_1876806C6A99F74A ON publication_reply (membre_id)');
        $this->addSql('CREATE INDEX IDX_1876806C38B217A7 ON publication_reply (publication_id)');
        $this->addSql('DROP TABLE participer_event');
        $this->addSql('DROP INDEX IDX_8FF9F39C6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__amitie AS SELECT id, membre_id, date, status FROM amitie');
        $this->addSql('DROP TABLE amitie');
        $this->addSql('CREATE TABLE amitie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, status VARCHAR(1) NOT NULL)');
        $this->addSql('INSERT INTO amitie (id, membre_id, date, status) SELECT id, membre_id, date, status FROM __temp__amitie');
        $this->addSql('DROP TABLE __temp__amitie');
        $this->addSql('CREATE INDEX IDX_8FF9F39C6A99F74A ON amitie (membre_id)');
        $this->addSql('DROP INDEX IDX_B26681E6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement AS SELECT id, membre_id, adresse, date_deb, date_fin, visibilite, nb_pers, signalement, message FROM evenement');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('CREATE TABLE evenement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER DEFAULT NULL, adresse VARCHAR(255) NOT NULL, date_deb DATETIME NOT NULL, date_fin DATETIME NOT NULL, visibilite INTEGER NOT NULL, nb_pers INTEGER NOT NULL, signalement INTEGER NOT NULL, message CLOB NOT NULL)');
        $this->addSql('INSERT INTO evenement (id, membre_id, adresse, date_deb, date_fin, visibilite, nb_pers, signalement, message) SELECT id, membre_id, adresse, date_deb, date_fin, visibilite, nb_pers, signalement, message FROM __temp__evenement');
        $this->addSql('DROP TABLE __temp__evenement');
        $this->addSql('CREATE INDEX IDX_B26681E6A99F74A ON evenement (membre_id)');
        $this->addSql('DROP INDEX IDX_F30253EFD02F13');
        $this->addSql('DROP INDEX IDX_F30253E6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement_like AS SELECT id, evenement_id, membre_id FROM evenement_like');
        $this->addSql('DROP TABLE evenement_like');
        $this->addSql('CREATE TABLE evenement_like (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, evenement_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO evenement_like (id, evenement_id, membre_id) SELECT id, evenement_id, membre_id FROM __temp__evenement_like');
        $this->addSql('DROP TABLE __temp__evenement_like');
        $this->addSql('CREATE INDEX IDX_F30253EFD02F13 ON evenement_like (evenement_id)');
        $this->addSql('CREATE INDEX IDX_F30253E6A99F74A ON evenement_like (membre_id)');
        $this->addSql('DROP INDEX IDX_6E026A18FD02F13');
        $this->addSql('DROP INDEX IDX_6E026A186A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement_reply AS SELECT id, evenement_id, membre_id, message, date FROM evenement_reply');
        $this->addSql('DROP TABLE evenement_reply');
        $this->addSql('CREATE TABLE evenement_reply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, evenement_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO evenement_reply (id, evenement_id, membre_id, message, date) SELECT id, evenement_id, membre_id, message, date FROM __temp__evenement_reply');
        $this->addSql('DROP TABLE __temp__evenement_reply');
        $this->addSql('CREATE INDEX IDX_6E026A18FD02F13 ON evenement_reply (evenement_id)');
        $this->addSql('CREATE INDEX IDX_6E026A186A99F74A ON evenement_reply (membre_id)');
        $this->addSql('DROP INDEX IDX_2321BE986A99F74A');
        $this->addSql('DROP INDEX IDX_2321BE989AC0396');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre_conversation AS SELECT membre_id, conversation_id FROM membre_conversation');
        $this->addSql('DROP TABLE membre_conversation');
        $this->addSql('CREATE TABLE membre_conversation (membre_id INTEGER NOT NULL, conversation_id INTEGER NOT NULL, PRIMARY KEY(membre_id, conversation_id))');
        $this->addSql('INSERT INTO membre_conversation (membre_id, conversation_id) SELECT membre_id, conversation_id FROM __temp__membre_conversation');
        $this->addSql('DROP TABLE __temp__membre_conversation');
        $this->addSql('CREATE INDEX IDX_2321BE986A99F74A ON membre_conversation (membre_id)');
        $this->addSql('CREATE INDEX IDX_2321BE989AC0396 ON membre_conversation (conversation_id)');
        $this->addSql('DROP INDEX IDX_C80C000B9AC0396');
        $this->addSql('DROP INDEX IDX_C80C000B6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messagePrive AS SELECT id, conversation_id, membre_id, message, date FROM messagePrive');
        $this->addSql('DROP TABLE messagePrive');
        $this->addSql('CREATE TABLE messagePrive (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, conversation_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO messagePrive (id, conversation_id, membre_id, message, date) SELECT id, conversation_id, membre_id, message, date FROM __temp__messagePrive');
        $this->addSql('DROP TABLE __temp__messagePrive');
        $this->addSql('CREATE INDEX IDX_C80C000B9AC0396 ON messagePrive (conversation_id)');
        $this->addSql('CREATE INDEX IDX_C80C000B6A99F74A ON messagePrive (membre_id)');
        $this->addSql('DROP INDEX IDX_AF3C67796A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication AS SELECT id, membre_id, date, visibilite, signalement, message FROM publication');
        $this->addSql('DROP TABLE publication');
        $this->addSql('CREATE TABLE publication (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, date DATETIME NOT NULL, visibilite INTEGER NOT NULL, signalement INTEGER NOT NULL, message CLOB NOT NULL)');
        $this->addSql('INSERT INTO publication (id, membre_id, date, visibilite, signalement, message) SELECT id, membre_id, date, visibilite, signalement, message FROM __temp__publication');
        $this->addSql('DROP TABLE __temp__publication');
        $this->addSql('CREATE INDEX IDX_AF3C67796A99F74A ON publication (membre_id)');
        $this->addSql('DROP INDEX IDX_6AB4183238B217A7');
        $this->addSql('DROP INDEX IDX_6AB418326A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publicationReply AS SELECT id, publication_id, membre_id, message, date FROM publicationReply');
        $this->addSql('DROP TABLE publicationReply');
        $this->addSql('CREATE TABLE publicationReply (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publication_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL, message CLOB NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO publicationReply (id, publication_id, membre_id, message, date) SELECT id, publication_id, membre_id, message, date FROM __temp__publicationReply');
        $this->addSql('DROP TABLE __temp__publicationReply');
        $this->addSql('CREATE INDEX IDX_6AB4183238B217A7 ON publicationReply (publication_id)');
        $this->addSql('CREATE INDEX IDX_6AB418326A99F74A ON publicationReply (membre_id)');
        $this->addSql('DROP INDEX IDX_A79BC17E38B217A7');
        $this->addSql('DROP INDEX IDX_A79BC17E6A99F74A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication_like AS SELECT id, publication_id, membre_id FROM publication_like');
        $this->addSql('DROP TABLE publication_like');
        $this->addSql('CREATE TABLE publication_like (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, publication_id INTEGER DEFAULT NULL, membre_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO publication_like (id, publication_id, membre_id) SELECT id, publication_id, membre_id FROM __temp__publication_like');
        $this->addSql('DROP TABLE __temp__publication_like');
        $this->addSql('CREATE INDEX IDX_A79BC17E38B217A7 ON publication_like (publication_id)');
        $this->addSql('CREATE INDEX IDX_A79BC17E6A99F74A ON publication_like (membre_id)');
    }
}
