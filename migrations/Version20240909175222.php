<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909175222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE words_remembering ADD id INT AUTO_INCREMENT NOT NULL, ADD user_id INT NOT NULL, DROP user_id_id, DROP place, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE words_remembering ADD CONSTRAINT FK_BCA8AA09A76ED395 FOREIGN KEY (user_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_BCA8AA09A76ED395 ON words_remembering (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE words_remembering MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE words_remembering DROP FOREIGN KEY FK_BCA8AA09A76ED395');
        $this->addSql('DROP INDEX IDX_BCA8AA09A76ED395 ON words_remembering');
        $this->addSql('DROP INDEX `primary` ON words_remembering');
        $this->addSql('ALTER TABLE words_remembering ADD place INT NOT NULL, DROP id, CHANGE user_id user_id_id INT NOT NULL');
    }
}
