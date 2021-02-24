<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224182328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accommodation (id INT AUTO_INCREMENT NOT NULL, status INT NOT NULL, check_in_at DATETIME NOT NULL, check_out_at DATETIME NOT NULL, book_at DATETIME NOT NULL, rooms_amount INT NOT NULL, people_amount INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accommodation_room (accommodation_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_7BA793508F3692CD (accommodation_id), INDEX IDX_7BA7935054177093 (room_id), PRIMARY KEY(accommodation_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accommodation_guest (accommodation_id INT NOT NULL, guest_id INT NOT NULL, INDEX IDX_A008B9CF8F3692CD (accommodation_id), INDEX IDX_A008B9CF9A4AA658 (guest_id), PRIMARY KEY(accommodation_id, guest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accommodation_room ADD CONSTRAINT FK_7BA793508F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accommodation_room ADD CONSTRAINT FK_7BA7935054177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accommodation_guest ADD CONSTRAINT FK_A008B9CF8F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accommodation_guest ADD CONSTRAINT FK_A008B9CF9A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP INDEX UNIQ_ACB79A355E237E06 ON guest');
        $this->addSql('ALTER TABLE guest ADD surname VARCHAR(255) DEFAULT NULL, ADD nationality VARCHAR(255) DEFAULT NULL, ADD uuid VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A35E7927C74 ON guest (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A35444F97DD ON guest (phone)');
        $this->addSql('CREATE UNIQUE INDEX unique_uuid ON guest (nationality, uuid)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accommodation_room DROP FOREIGN KEY FK_7BA793508F3692CD');
        $this->addSql('ALTER TABLE accommodation_guest DROP FOREIGN KEY FK_A008B9CF8F3692CD');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, status INT DEFAULT 1 NOT NULL, contact VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, amount INT NOT NULL, rooms INT NOT NULL, start DATE NOT NULL, end DATE NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE accommodation');
        $this->addSql('DROP TABLE accommodation_room');
        $this->addSql('DROP TABLE accommodation_guest');
        $this->addSql('DROP INDEX UNIQ_ACB79A35E7927C74 ON guest');
        $this->addSql('DROP INDEX UNIQ_ACB79A35444F97DD ON guest');
        $this->addSql('DROP INDEX unique_uuid ON guest');
        $this->addSql('ALTER TABLE guest DROP surname, DROP nationality, DROP uuid, DROP email, DROP phone, CHANGE name name VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACB79A355E237E06 ON guest (name)');
    }
	 
	// Fix: https://github.com/doctrine/migrations/issues/1104
	public function isTransactional(): bool
	{
		return false;
	}
}
