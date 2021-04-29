<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428133729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file ADD my_file VARCHAR(255) NOT NULL, DROP myfile, CHANGE id id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610BF396750 FOREIGN KEY (id) REFERENCES myformation (id)');
        $this->addSql('ALTER TABLE myformation CHANGE date date DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610BF396750');
        $this->addSql('ALTER TABLE file ADD myfile VARCHAR(100) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`, DROP my_file, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE myformation CHANGE date date VARCHAR(50) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`');
    }
}
