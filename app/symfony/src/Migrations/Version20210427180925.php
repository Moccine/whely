<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427180925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE about_description (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_C9F6BCE7989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, street VARCHAR(125) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, country VARCHAR(125) DEFAULT NULL, postal_code VARCHAR(16) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, first_name VARCHAR(125) NOT NULL, last_name VARCHAR(125) NOT NULL, mobile_phone VARCHAR(50) NOT NULL, home_phone VARCHAR(50) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, type VARCHAR(50) NOT NULL, street VARCHAR(125) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, country VARCHAR(125) DEFAULT NULL, postal_code VARCHAR(16) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_history (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, history_date DATE DEFAULT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7E86A9C989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE letter (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, enabled TINYINT(1) NOT NULL, subject VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8E02EE0A77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, services_id INT DEFAULT NULL, news_id INT DEFAULT NULL, about_description_id INT DEFAULT NULL, company_history_id INT DEFAULT NULL, our_team_id INT DEFAULT NULL, partner_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, file_size INT NOT NULL, file_url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, extension VARCHAR(5) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_6A2CA10CAEF5A6C1 (services_id), INDEX IDX_6A2CA10CB5A459A0 (news_id), INDEX IDX_6A2CA10CD642B541 (about_description_id), INDEX IDX_6A2CA10CA38B6DC4 (company_history_id), INDEX IDX_6A2CA10C5E989027 (our_team_id), INDEX IDX_6A2CA10C9393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, second_title VARCHAR(255) DEFAULT NULL, 
        content LONGTEXT NOT NULL, elements LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', summary TINYTEXT DEFAULT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1DD39950989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_letter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, send TINYINT(1) NOT NULL, delivred TINYINT(1) NOT NULL, send_at DATETIME NOT NULL, content LONGTEXT NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_2AB2D7E989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter_subcriber (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(20) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_DC8A4568E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operator (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D7A6A781E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE our_team (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, facebook_link VARCHAR(255) DEFAULT NULL, twitter_link VARCHAR(255) DEFAULT NULL, youtube_link VARCHAR(255) DEFAULT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_CBB41F21989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameters (id INT AUTO_INCREMENT NOT NULL, parameter_key VARCHAR(155) NOT NULL, value VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, category VARCHAR(100) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, activity VARCHAR(255) DEFAULT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_312B3E16989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, second_title VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, elements LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', summary TINYTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, client INT NOT NULL, employees INT NOT NULL, satistified_customer INT NOT NULL, satisfaction INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcriber (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, consumed_at DATETIME DEFAULT NULL, generated_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5F37A13BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, roles JSON NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CD642B541 FOREIGN KEY (about_description_id) REFERENCES about_description (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA38B6DC4 FOREIGN KEY (company_history_id) REFERENCES company_history (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C5E989027 FOREIGN KEY (our_team_id) REFERENCES our_team (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CD642B541');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64919EB6921');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CA38B6DC4');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB5A459A0');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C5E989027');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C9393F8FE');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CAEF5A6C1');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE token DROP FOREIGN KEY FK_5F37A13BA76ED395');
        $this->addSql('DROP TABLE about_description');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE company_history');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE letter');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE news_letter');
        $this->addSql('DROP TABLE newsletter_subcriber');
        $this->addSql('DROP TABLE operator');
        $this->addSql('DROP TABLE our_team');
        $this->addSql('DROP TABLE parameters');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('DROP TABLE subcriber');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE user');
    }
}
