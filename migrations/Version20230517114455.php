<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517114455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE weather_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE weather_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE weather (id INT NOT NULL, temperature_value INT NOT NULL, temperature_unit VARCHAR(255) NOT NULL, clouds VARCHAR(255) NOT NULL, wind INT NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE weather_history (id INT NOT NULL, weather_id INT NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, lat INT NOT NULL, lng INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_838593008CE675E ON weather_history (weather_id)');
        $this->addSql('COMMENT ON COLUMN weather_history.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE weather_history ADD CONSTRAINT FK_838593008CE675E FOREIGN KEY (weather_id) REFERENCES weather (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE weather_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE weather_history_id_seq CASCADE');
        $this->addSql('ALTER TABLE weather_history DROP CONSTRAINT FK_838593008CE675E');
        $this->addSql('DROP TABLE weather');
        $this->addSql('DROP TABLE weather_history');
    }
}
