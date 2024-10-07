<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241007095432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'changement de la duration en int et non en datetime';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode CHANGE duration duration INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE episode CHANGE duration duration TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\'');
    }
}
