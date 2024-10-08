<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241008191918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des sous-titres, de la note et de la bande annonce des media';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE media_subtitle (media_id INT NOT NULL, subtitle_id INT NOT NULL, INDEX IDX_5EE4B903EA9FDD75 (media_id), INDEX IDX_5EE4B90310F3A34 (subtitle_id), PRIMARY KEY(media_id, subtitle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subtitle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_subtitle ADD CONSTRAINT FK_5EE4B903EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_subtitle ADD CONSTRAINT FK_5EE4B90310F3A34 FOREIGN KEY (subtitle_id) REFERENCES subtitle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media ADD rating INT DEFAULT NULL, ADD trailer JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media_subtitle DROP FOREIGN KEY FK_5EE4B903EA9FDD75');
        $this->addSql('ALTER TABLE media_subtitle DROP FOREIGN KEY FK_5EE4B90310F3A34');
        $this->addSql('DROP TABLE media_subtitle');
        $this->addSql('DROP TABLE subtitle');
        $this->addSql('ALTER TABLE media DROP rating, DROP trailer');
    }
}
