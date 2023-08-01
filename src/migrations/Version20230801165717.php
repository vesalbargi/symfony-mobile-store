<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801165717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mobile_company ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mobile_company ADD CONSTRAINT FK_AF15C4BAE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mobile_company ADD CONSTRAINT FK_AF15C4BABB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AF15C4BAE104C1D3 ON mobile_company (created_user_id)');
        $this->addSql('CREATE INDEX IDX_AF15C4BABB649746 ON mobile_company (updated_user_id)');
        $this->addSql('ALTER TABLE mobile_phone ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mobile_phone ADD CONSTRAINT FK_AA92691E104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mobile_phone ADD CONSTRAINT FK_AA92691BB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AA92691E104C1D3 ON mobile_phone (created_user_id)');
        $this->addSql('CREATE INDEX IDX_AA92691BB649746 ON mobile_phone (updated_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mobile_company DROP FOREIGN KEY FK_AF15C4BAE104C1D3');
        $this->addSql('ALTER TABLE mobile_company DROP FOREIGN KEY FK_AF15C4BABB649746');
        $this->addSql('DROP INDEX IDX_AF15C4BAE104C1D3 ON mobile_company');
        $this->addSql('DROP INDEX IDX_AF15C4BABB649746 ON mobile_company');
        $this->addSql('ALTER TABLE mobile_company DROP created_user_id, DROP updated_user_id');
        $this->addSql('ALTER TABLE mobile_phone DROP FOREIGN KEY FK_AA92691E104C1D3');
        $this->addSql('ALTER TABLE mobile_phone DROP FOREIGN KEY FK_AA92691BB649746');
        $this->addSql('DROP INDEX IDX_AA92691E104C1D3 ON mobile_phone');
        $this->addSql('DROP INDEX IDX_AA92691BB649746 ON mobile_phone');
        $this->addSql('ALTER TABLE mobile_phone DROP created_user_id, DROP updated_user_id');
    }
}
