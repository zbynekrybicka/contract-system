<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251030233005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE meeting_contact (meeting_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_D4B0AEB567433D9C (meeting_id), INDEX IDX_D4B0AEB5E7A1254A (contact_id), PRIMARY KEY(meeting_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_contact ADD CONSTRAINT FK_D4B0AEB567433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_contact ADD CONSTRAINT FK_D4B0AEB5E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B867433D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B8E7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contact_meeting
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting ADD result LONGTEXT DEFAULT NULL, ADD result_type VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD result_type VARCHAR(255) NOT NULL, CHANGE receiver_id receiver_id INT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contact_meeting (contact_id INT NOT NULL, meeting_id INT NOT NULL, INDEX IDX_6F3AC0B8E7A1254A (contact_id), INDEX IDX_6F3AC0B867433D9C (meeting_id), PRIMARY KEY(meeting_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B867433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B8E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_contact DROP FOREIGN KEY FK_D4B0AEB567433D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting_contact DROP FOREIGN KEY FK_D4B0AEB5E7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE meeting_contact
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP result_type, CHANGE receiver_id receiver_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE meeting DROP result, DROP result_type
        SQL);
    }
}
