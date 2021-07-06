<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705090415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBA853CD175');
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBAA76ED395');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92A76ED395');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBA853CD175');
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBAA76ED395');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92A76ED395');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
