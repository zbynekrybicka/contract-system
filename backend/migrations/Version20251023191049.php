<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251023191049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B867433D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B8E7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON contact_meeting
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B867433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B8E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD PRIMARY KEY (meeting_id, contact_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B867433D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting DROP FOREIGN KEY FK_6F3AC0B8E7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON contact_meeting
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B867433D9C FOREIGN KEY (meeting_id) REFERENCES contact (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD CONSTRAINT FK_6F3AC0B8E7A1254A FOREIGN KEY (contact_id) REFERENCES meeting (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact_meeting ADD PRIMARY KEY (contact_id, meeting_id)
        SQL);
    }
}
