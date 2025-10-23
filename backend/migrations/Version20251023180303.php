<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251023180303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE realized_call (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, purpose LONGTEXT NOT NULL, realized_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', successful TINYINT(1) DEFAULT 0 NOT NULL, description LONGTEXT DEFAULT NULL, next_call DATETIME DEFAULT NULL, INDEX IDX_EF9E05C2F624B39D (sender_id), INDEX IDX_EF9E05C2CD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD CONSTRAINT FK_EF9E05C2F624B39D FOREIGN KEY (sender_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call ADD CONSTRAINT FK_EF9E05C2CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES contact (id) ON DELETE RESTRICT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `call` DROP FOREIGN KEY FK_CC8E2F3ECD53EDB6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `call` DROP FOREIGN KEY FK_CC8E2F3EF624B39D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `call`
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE `call` (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, purpose LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, realized_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', successful TINYINT(1) DEFAULT 0 NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, next_call DATETIME DEFAULT NULL, INDEX IDX_CC8E2F3EF624B39D (sender_id), INDEX IDX_CC8E2F3ECD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `call` ADD CONSTRAINT FK_CC8E2F3ECD53EDB6 FOREIGN KEY (receiver_id) REFERENCES contact (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `call` ADD CONSTRAINT FK_CC8E2F3EF624B39D FOREIGN KEY (sender_id) REFERENCES contact (id) ON UPDATE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP FOREIGN KEY FK_EF9E05C2F624B39D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE realized_call DROP FOREIGN KEY FK_EF9E05C2CD53EDB6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE realized_call
        SQL);
    }
}
