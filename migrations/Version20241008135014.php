<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241008135014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de l image de couverture pour les épisodes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode ADD episode_cover_image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode DROP episode_cover_image');
    }
}
