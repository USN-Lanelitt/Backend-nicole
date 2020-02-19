<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205170753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC61875D1D77');
        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC61ED766068');
        $this->addSql('DROP TABLE friend');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE asset_categories CHANGE categoryname categoryname VARCHAR(255) DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE assets CHANGE assetname assetname VARCHAR(255) DEFAULT NULL, CHANGE asset_condition asset_condition VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE individ_connections CHANGE timestamp timestamp DATETIME DEFAULT NULL, CHANGE connection_type connection_type TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE individuals CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE middlename middlename VARCHAR(255) DEFAULT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE address2 address2 VARCHAR(255) DEFAULT NULL, CHANGE zipcode zipcode INT DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE mobile mobile INT DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT NULL, CHANGE profile_image profile_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE nickname nickname VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE usertype usertype TINYINT(1) DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL, CHANGE news_subscription news_subscription TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE friend (id INT AUTO_INCREMENT NOT NULL, username_id INT DEFAULT NULL, username2_id INT DEFAULT NULL, follow TINYINT(1) NOT NULL, INDEX IDX_55EEAC61ED766068 (username_id), INDEX IDX_55EEAC61875D1D77 (username2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, lname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, mobile VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61875D1D77 FOREIGN KEY (username2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE asset_categories CHANGE categoryname categoryname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE active active TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE assets CHANGE assetname assetname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE asset_condition asset_condition VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE individ_connections CHANGE timestamp timestamp DATETIME DEFAULT \'NULL\', CHANGE connection_type connection_type TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE individuals CHANGE firstname firstname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE middlename middlename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lastname lastname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address2 address2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE zipcode zipcode INT DEFAULT NULL, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile INT DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT \'NULL\', CHANGE profile_image profile_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE nickname nickname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE usertype usertype TINYINT(1) DEFAULT \'NULL\', CHANGE active active TINYINT(1) DEFAULT \'NULL\', CHANGE news_subscription news_subscription TINYINT(1) DEFAULT \'NULL\'');
    }
}
