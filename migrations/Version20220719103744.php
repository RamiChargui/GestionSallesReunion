<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220719103744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_reservation (user_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_EBD380C0A76ED395 (user_id), INDEX IDX_EBD380C0B83297E7 (reservation_id), PRIMARY KEY(user_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_reservation ADD CONSTRAINT FK_EBD380C0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_reservation ADD CONSTRAINT FK_EBD380C0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_reservation');
        $this->addSql('ALTER TABLE `user` DROP nom, DROP prenom');
    }
}
