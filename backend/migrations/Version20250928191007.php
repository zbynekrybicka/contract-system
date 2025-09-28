<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250928191007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(160) NOT NULL, starts_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', ends_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', location VARCHAR(200) DEFAULT NULL, online_url VARCHAR(255) DEFAULT NULL, note LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE meeting_participants (meeting_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_512A952F67433D9C (meeting_id), INDEX IDX_512A952FE7A1254A (contact_id), PRIMARY KEY(meeting_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_participants ADD CONSTRAINT FK_512A952F67433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_participants ADD CONSTRAINT FK_512A952FE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_participants DROP FOREIGN KEY FK_512A952F67433D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_participants DROP FOREIGN KEY FK_512A952FE7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE meeting
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE meeting_participants
        SQL);
    }
}
