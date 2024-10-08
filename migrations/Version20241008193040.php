<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241008193040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'changement de label en code';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subtitle CHANGE label code VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subtitle CHANGE code label VARCHAR(255) NOT NULL');
    }
}
