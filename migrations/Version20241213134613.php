<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241213134613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout du role pour le user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` DROP roles');
    }
}
