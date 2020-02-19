<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205130341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE individ_connections (id INT AUTO_INCREMENT NOT NULL, individ1_id INT NOT NULL, relation_id INT NOT NULL, timestamp TIME NOT NULL, request_status VARCHAR(255) NOT NULL, INDEX IDX_270FA1B45C7DAF42 (individ1_id), INDEX IDX_270FA1B43256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individuals (id INT AUTO_INCREMENT NOT NULL, nickname VARCHAR(255) DEFAULT NULL, middlename VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zipcode INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, mobile INT DEFAULT NULL, birthdate DATE DEFAULT NULL, profile_image VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_connections (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, user2_id INT DEFAULT NULL, follow TINYINT(1) NOT NULL, INDEX IDX_16ED3580A76ED395 (user_id), INDEX IDX_16ED3580441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE individ_connections ADD CONSTRAINT FK_270FA1B45C7DAF42 FOREIGN KEY (individ1_id) REFERENCES individuals (id)');
        $this->addSql('ALTER TABLE individ_connections ADD CONSTRAINT FK_270FA1B43256915B FOREIGN KEY (relation_id) REFERENCES individuals (id)');
        $this->addSql('ALTER TABLE user_connections ADD CONSTRAINT FK_16ED3580A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_connections ADD CONSTRAINT FK_16ED3580441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE individ_connections DROP FOREIGN KEY FK_270FA1B45C7DAF42');
        $this->addSql('ALTER TABLE individ_connections DROP FOREIGN KEY FK_270FA1B43256915B');
        $this->addSql('ALTER TABLE user_connections DROP FOREIGN KEY FK_16ED3580A76ED395');
        $this->addSql('ALTER TABLE user_connections DROP FOREIGN KEY FK_16ED3580441B8B65');
        $this->addSql('DROP TABLE individ_connections');
        $this->addSql('DROP TABLE individuals');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_connections');
    }
}
