<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251025175736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP FOREIGN KEY FK_EF9E05C2F624B39D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP FOREIGN KEY FK_EF9E05C2CD53EDB6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_EF9E05C2F624B39D ON realized_call
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_EF9E05C2CD53EDB6 ON realized_call
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD CONSTRAINT FK_EF9E05C2CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD CONSTRAINT FK_EF9E05C2F624B39D FOREIGN KEY (sender_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EF9E05C2F624B39D ON realized_call (sender_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EF9E05C2CD53EDB6 ON realized_call (receiver_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP FOREIGN KEY FK_EF9E05C2F624B39D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP FOREIGN KEY FK_EF9E05C2CD53EDB6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_EF9E05C2CD53EDB6 ON realized_call
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_EF9E05C2F624B39D ON realized_call
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD CONSTRAINT FK_EF9E05C2CD53EDB6 FOREIGN KEY (sender_id) REFERENCES contact (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD CONSTRAINT FK_EF9E05C2F624B39D FOREIGN KEY (receiver_id) REFERENCES contact (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EF9E05C2CD53EDB6 ON realized_call (sender_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EF9E05C2F624B39D ON realized_call (receiver_id)
        SQL);
    }
}
