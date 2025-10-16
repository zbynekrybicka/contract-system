<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251015200541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, superior_id INT DEFAULT NULL, first_name VARCHAR(160) NOT NULL, middle_name VARCHAR(160) NOT NULL, last_name VARCHAR(160) NOT NULL, email VARCHAR(180) NOT NULL, dial_number INT DEFAULT 420 NOT NULL, phone_number VARCHAR(9) NOT NULL, INDEX IDX_4C62E63863D7ADF1 (superior_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, appointment DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', place VARCHAR(160) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE contact_meeting (contact_id INT NOT NULL, meeting_id INT NOT NULL, INDEX IDX_6F3AC0B8E7A1254A (contact_id), INDEX IDX_6F3AC0B867433D9C (meeting_id), PRIMARY KEY(contact_id, meeting_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, contact_id INT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D649E7A1254A (contact_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact ADD CONSTRAINT FK_4C62E63863D7ADF1 FOREIGN KEY (superior_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B8E7A1254A FOREIGN KEY (contact_id) REFERENCES meeting (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B867433D9C FOREIGN KEY (meeting_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63863D7ADF1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B8E7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B867433D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contact
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE meeting
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contact_meeting
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
