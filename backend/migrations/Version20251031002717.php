<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251031002717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contract ADD salesman_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contract ADD CONSTRAINT FK_E98F28599F7F22E2 FOREIGN KEY (salesman_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E98F28599F7F22E2 ON contract (salesman_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contract DROP FOREIGN KEY FK_E98F28599F7F22E2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E98F28599F7F22E2 ON contract
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contract DROP salesman_id
        SQL);
    }
}
