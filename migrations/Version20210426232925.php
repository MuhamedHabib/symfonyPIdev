<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426232925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE message');
        $this->addSql('ALTER TABLE myformation CHANGE date date DATE NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE events (id_event INT AUTO_INCREMENT NOT NULL, nom_event VARCHAR(99) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`, date_deb DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id_event)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE message (id_message INT AUTO_INCREMENT NOT NULL, date_creation DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, id_user INT DEFAULT NULL, message VARCHAR(99) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`, reponse VARCHAR(99) CHARACTER SET utf32 DEFAULT NULL COLLATE `utf32_general_ci`, record VARCHAR(99) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`, INDEX FK_B6BD307F6B3CA4B (id_user), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE myformation CHANGE date date VARCHAR(50) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`, CHANGE image image VARCHAR(255) CHARACTER SET utf32 DEFAULT NULL COLLATE `utf32_general_ci`');
    }
}
