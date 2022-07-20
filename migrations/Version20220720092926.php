<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720092926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD respansable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554D0CADC1 FOREIGN KEY (respansable_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_42C849554D0CADC1 ON reservation (respansable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849554D0CADC1');
        $this->addSql('DROP INDEX IDX_42C849554D0CADC1 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP respansable_id');
    }
}
