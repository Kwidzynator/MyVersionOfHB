<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240904153220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE words_remembering ADD place INT AUTO_INCREMENT NOT NULL, DROP id, ADD PRIMARY KEY (place)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE words_remembering MODIFY place INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON words_remembering');
        $this->addSql('ALTER TABLE words_remembering ADD id INT NOT NULL, DROP place');
    }
}
