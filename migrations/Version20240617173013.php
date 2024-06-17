<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617173013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reaction_time (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, time TIME NOT NULL, INDEX IDX_17DF06F29D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remembering_numbers (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, numbers_remembered INT NOT NULL, INDEX IDX_456FED219D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE time_writing (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, time TIME NOT NULL, INDEX IDX_B91F5CFD9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words_remembering (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, moves INT NOT NULL, INDEX IDX_BCA8AA099D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reaction_time ADD CONSTRAINT FK_17DF06F29D86650F FOREIGN KEY (user_id_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE remembering_numbers ADD CONSTRAINT FK_456FED219D86650F FOREIGN KEY (user_id_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE time_writing ADD CONSTRAINT FK_B91F5CFD9D86650F FOREIGN KEY (user_id_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE words_remembering ADD CONSTRAINT FK_BCA8AA099D86650F FOREIGN KEY (user_id_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE login CHANGE login login VARCHAR(32) NOT NULL, CHANGE password password VARCHAR(32) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reaction_time DROP FOREIGN KEY FK_17DF06F29D86650F');
        $this->addSql('ALTER TABLE remembering_numbers DROP FOREIGN KEY FK_456FED219D86650F');
        $this->addSql('ALTER TABLE time_writing DROP FOREIGN KEY FK_B91F5CFD9D86650F');
        $this->addSql('ALTER TABLE words_remembering DROP FOREIGN KEY FK_BCA8AA099D86650F');
        $this->addSql('DROP TABLE reaction_time');
        $this->addSql('DROP TABLE remembering_numbers');
        $this->addSql('DROP TABLE time_writing');
        $this->addSql('DROP TABLE words');
        $this->addSql('DROP TABLE words_remembering');
        $this->addSql('ALTER TABLE login CHANGE login login VARCHAR(40) NOT NULL, CHANGE password password VARCHAR(40) NOT NULL');
    }
}
