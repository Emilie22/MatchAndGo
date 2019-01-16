<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116100713 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE picture_bg (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE chat_user');
        $this->addSql('ALTER TABLE user ADD picture_bg VARCHAR(255) NOT NULL, ADD facebook VARCHAR(255) DEFAULT NULL, ADD instagram VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chat ADD salon_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA4C91BDE4 ON chat (salon_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAA76ED395 ON chat (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA4C91BDE4');
        $this->addSql('CREATE TABLE chat_user (chat_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2B0F4B08A76ED395 (user_id), INDEX IDX_2B0F4B081A9A7125 (chat_id), PRIMARY KEY(chat_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE chat_user ADD CONSTRAINT FK_2B0F4B081A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chat_user ADD CONSTRAINT FK_2B0F4B08A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE picture_bg');
        $this->addSql('DROP TABLE salon');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA76ED395');
        $this->addSql('DROP INDEX IDX_659DF2AA4C91BDE4 ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAA76ED395 ON chat');
        $this->addSql('ALTER TABLE chat DROP salon_id, DROP user_id');
        $this->addSql('ALTER TABLE user DROP picture_bg, DROP facebook, DROP instagram');
    }
}
