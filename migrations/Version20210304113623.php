<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304113623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accommodation CHANGE status status INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE book_at book_at DATETIME DEFAULT NULL, CHANGE rooms_amount rooms_amount INT UNSIGNED NOT NULL, CHANGE people_amount people_amount INT UNSIGNED NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accommodation CHANGE status status INT NOT NULL, CHANGE book_at book_at DATETIME NOT NULL, CHANGE rooms_amount rooms_amount INT NOT NULL, CHANGE people_amount people_amount INT NOT NULL');
    }
	
	// Fix: https://github.com/doctrine/migrations/issues/1104
	public function isTransactional(): bool
	{
		return false;
	}
}
