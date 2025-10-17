<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251017054238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE quantity quantity DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE menu ADD is_favorite TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE shift ADD color VARCHAR(100) DEFAULT NULL, CHANGE moment moment VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE quantity quantity INT NOT NULL');
        $this->addSql('ALTER TABLE menu DROP is_favorite');
        $this->addSql('ALTER TABLE shift DROP color, CHANGE moment moment VARCHAR(50) DEFAULT NULL');
    }
}
