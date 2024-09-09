<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909184419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reaction_time DROP FOREIGN KEY FK_17DF06F29D86650F');
        $this->addSql('DROP INDEX IDX_17DF06F29D86650F ON reaction_time');
        $this->addSql('ALTER TABLE reaction_time CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE reaction_time ADD CONSTRAINT FK_17DF06F2A76ED395 FOREIGN KEY (user_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_17DF06F2A76ED395 ON reaction_time (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reaction_time DROP FOREIGN KEY FK_17DF06F2A76ED395');
        $this->addSql('DROP INDEX IDX_17DF06F2A76ED395 ON reaction_time');
        $this->addSql('ALTER TABLE reaction_time CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE reaction_time ADD CONSTRAINT FK_17DF06F29D86650F FOREIGN KEY (user_id_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_17DF06F29D86650F ON reaction_time (user_id_id)');
    }
}
