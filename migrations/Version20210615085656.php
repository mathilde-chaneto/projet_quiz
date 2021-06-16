<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615085656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE play (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, user_id INT NOT NULL, score INT DEFAULT NULL, INDEX IDX_5E89DEBA853CD175 (quiz_id), INDEX IDX_5E89DEBAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_category (quiz_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_D088E084853CD175 (quiz_id), INDEX IDX_D088E08412469DE2 (category_id), PRIMARY KEY(quiz_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_category ADD CONSTRAINT FK_D088E084853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_category ADD CONSTRAINT FK_D088E08412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE category_quiz');
        $this->addSql('DROP TABLE user_quiz');
        $this->addSql('ALTER TABLE quiz CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(50) NOT NULL, DROP score');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_quiz (category_id INT NOT NULL, quiz_id INT NOT NULL, INDEX IDX_2F8980D512469DE2 (category_id), INDEX IDX_2F8980D5853CD175 (quiz_id), PRIMARY KEY(category_id, quiz_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_quiz (user_id INT NOT NULL, quiz_id INT NOT NULL, INDEX IDX_DE93B65BA76ED395 (user_id), INDEX IDX_DE93B65B853CD175 (quiz_id), PRIMARY KEY(user_id, quiz_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_quiz ADD CONSTRAINT FK_2F8980D512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_quiz ADD CONSTRAINT FK_2F8980D5853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_quiz ADD CONSTRAINT FK_DE93B65B853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_quiz ADD CONSTRAINT FK_DE93B65BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE play');
        $this->addSql('DROP TABLE quiz_category');
        $this->addSql('ALTER TABLE quiz CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD score INT DEFAULT NULL, DROP username');
    }
}
