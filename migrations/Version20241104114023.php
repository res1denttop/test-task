<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104114023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, employee_id VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, name_prefix VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, middle_initial VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, gender VARCHAR(5) NOT NULL, email VARCHAR(255) NOT NULL, birthday DATE DEFAULT NULL, birthtime TIME DEFAULT NULL, age VARCHAR(255) NOT NULL, joining_date DATE DEFAULT NULL, age_in_company VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, place_name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_5D9F75A18C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee');
    }
}
