<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241008134211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout du numéro d un episode et de sa description';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode ADD episode_number INT NOT NULL, ADD episode_description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode DROP episode_number, DROP episode_description');
    }
}
