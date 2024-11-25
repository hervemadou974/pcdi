<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125113946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, many_to_one_id INT DEFAULT NULL, ordinateur_id INT DEFAULT NULL, reservation_date DATETIME NOT NULL, INDEX IDX_42C84955EAB5DEB (many_to_one_id), UNIQUE INDEX UNIQ_42C84955828317CA (ordinateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955EAB5DEB FOREIGN KEY (many_to_one_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955828317CA FOREIGN KEY (ordinateur_id) REFERENCES ordinateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955EAB5DEB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955828317CA');
        $this->addSql('DROP TABLE reservation');
    }
}
