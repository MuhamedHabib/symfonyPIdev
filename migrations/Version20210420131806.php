<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420131806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file CHANGE id id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE myformation DROP brochure_filename');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE myformation ADD brochure_filename VARCHAR(255) CHARACTER SET utf32 NOT NULL COLLATE `utf32_general_ci`');
    }
}
