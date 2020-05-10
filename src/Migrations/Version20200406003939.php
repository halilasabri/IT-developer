<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200406003939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property ADD surface INT NOT NULL, ADD bedroo INT NOT NULL, ADD rooms INT NOT NULL, ADD floor INT NOT NULL, ADD price INT NOT NULL, ADD heat INT NOT NULL, DROP email, DROP telephone, DROP fax, CHANGE agence titel VARCHAR(255) NOT NULL, CHANGE directeur_name description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property ADD email INT NOT NULL, ADD telephone INT NOT NULL, ADD fax INT NOT NULL, DROP surface, DROP bedroo, DROP rooms, DROP floor, DROP price, DROP heat, CHANGE titel agence VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description directeur_name LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
