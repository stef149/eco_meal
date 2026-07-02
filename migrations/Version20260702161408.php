<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260702161408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE business ADD CONSTRAINT FK_8D36E38A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D36E38A76ED395 ON business (user_id)');
        $this->addSql('ALTER TABLE consumer ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consumer ADD CONSTRAINT FK_705B3727A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_705B3727A76ED395 ON consumer (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business DROP FOREIGN KEY FK_8D36E38A76ED395');
        $this->addSql('DROP INDEX UNIQ_8D36E38A76ED395 ON business');
        $this->addSql('ALTER TABLE business DROP user_id');
        $this->addSql('ALTER TABLE consumer DROP FOREIGN KEY FK_705B3727A76ED395');
        $this->addSql('DROP INDEX UNIQ_705B3727A76ED395 ON consumer');
        $this->addSql('ALTER TABLE consumer DROP user_id');
    }
}
