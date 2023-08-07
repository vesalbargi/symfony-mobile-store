<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230805182609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CE104C1D3 ON comment (created_user_id)');
        $this->addSql('CREATE INDEX IDX_9474526CBB649746 ON comment (updated_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE104C1D3');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBB649746');
        $this->addSql('DROP INDEX IDX_9474526CE104C1D3 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CBB649746 ON comment');
        $this->addSql('ALTER TABLE comment DROP created_user_id, DROP updated_user_id, DROP created_at, DROP updated_at');
    }
}
