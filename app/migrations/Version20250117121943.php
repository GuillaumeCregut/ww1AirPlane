<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250117121943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aircraft (id INT AUTO_INCREMENT NOT NULL, date_in_id INT NOT NULL, year_out_id INT NOT NULL, builder_id INT NOT NULL, name VARCHAR(255) NOT NULL, full_date_in DATETIME NOT NULL, full_date_out DATETIME NOT NULL, INDEX IDX_13D96729AA0996BF (date_in_id), INDEX IDX_13D967291C1B7123 (year_out_id), INDEX IDX_13D96729959F66E4 (builder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE builder (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D627AF49F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE years (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aircraft ADD CONSTRAINT FK_13D96729AA0996BF FOREIGN KEY (date_in_id) REFERENCES years (id)');
        $this->addSql('ALTER TABLE aircraft ADD CONSTRAINT FK_13D967291C1B7123 FOREIGN KEY (year_out_id) REFERENCES years (id)');
        $this->addSql('ALTER TABLE aircraft ADD CONSTRAINT FK_13D96729959F66E4 FOREIGN KEY (builder_id) REFERENCES builder (id)');
        $this->addSql('ALTER TABLE builder ADD CONSTRAINT FK_D627AF49F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aircraft DROP FOREIGN KEY FK_13D96729AA0996BF');
        $this->addSql('ALTER TABLE aircraft DROP FOREIGN KEY FK_13D967291C1B7123');
        $this->addSql('ALTER TABLE aircraft DROP FOREIGN KEY FK_13D96729959F66E4');
        $this->addSql('ALTER TABLE builder DROP FOREIGN KEY FK_D627AF49F92F3E70');
        $this->addSql('DROP TABLE aircraft');
        $this->addSql('DROP TABLE builder');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE years');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
