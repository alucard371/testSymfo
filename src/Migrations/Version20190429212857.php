<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429212857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE name name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE owner CHANGE seniority seniority INT DEFAULT NULL');
        $this->addSql('ALTER TABLE health_pro CHANGE fee fee INT DEFAULT NULL, CHANGE comments_id comments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE corps corps VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE article CHANGE auteur auteur VARCHAR(100) NOT NULL, CHANGE titre titre VARCHAR(45) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE auteur auteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE titre titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE comment CHANGE corps corps VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE health_pro CHANGE fee fee INT NOT NULL, CHANGE comments_id comments_id INT NOT NULL');
        $this->addSql('ALTER TABLE owner CHANGE seniority seniority INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE name name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
