<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220822060136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP INDEX UNIQ_CE606404DC304035, ADD INDEX IDX_CE606404DC304035 (salle_id)');
        $this->addSql('ALTER TABLE reclamation CHANGE date_rec date_rec DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP INDEX IDX_CE606404DC304035, ADD UNIQUE INDEX UNIQ_CE606404DC304035 (salle_id)');
        $this->addSql('ALTER TABLE reclamation CHANGE date_rec date_rec DATETIME NOT NULL');
    }
}
