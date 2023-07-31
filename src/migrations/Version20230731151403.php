<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230731151403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mobile_company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobile_phone (id INT AUTO_INCREMENT NOT NULL, mobile_company_id INT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, operating_system VARCHAR(255) NOT NULL, screen_size DOUBLE PRECISION NOT NULL, memory INT NOT NULL, storage INT NOT NULL, camera VARCHAR(255) NOT NULL, battery_capacity INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_AA926916CC348F8 (mobile_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mobile_phone ADD CONSTRAINT FK_AA926916CC348F8 FOREIGN KEY (mobile_company_id) REFERENCES mobile_company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mobile_phone DROP FOREIGN KEY FK_AA926916CC348F8');
        $this->addSql('DROP TABLE mobile_company');
        $this->addSql('DROP TABLE mobile_phone');
    }
}
