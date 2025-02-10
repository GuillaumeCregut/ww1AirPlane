<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250128112451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aircraft_aircraft_type (aircraft_id INT NOT NULL, aircraft_type_id INT NOT NULL, INDEX IDX_118F5CD7846E2F5C (aircraft_id), INDEX IDX_118F5CD7B5DC64D (aircraft_type_id), PRIMARY KEY(aircraft_id, aircraft_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aircraft_aircraft_type ADD CONSTRAINT FK_118F5CD7846E2F5C FOREIGN KEY (aircraft_id) REFERENCES aircraft (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aircraft_aircraft_type ADD CONSTRAINT FK_118F5CD7B5DC64D FOREIGN KEY (aircraft_type_id) REFERENCES aircraft_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aircraft_aircraft_type DROP FOREIGN KEY FK_118F5CD7846E2F5C');
        $this->addSql('ALTER TABLE aircraft_aircraft_type DROP FOREIGN KEY FK_118F5CD7B5DC64D');
        $this->addSql('DROP TABLE aircraft_aircraft_type');
    }
}
