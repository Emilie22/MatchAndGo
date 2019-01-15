<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190115093346 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0155143989D9B62 ON blog (slug)');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAC790EC1F');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAF6C43E79');
        $this->addSql('DROP INDEX IDX_659DF2AAC790EC1F ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAF6C43E79 ON chat');
        $this->addSql('ALTER TABLE chat DROP user_sender_id, DROP user_getter_id, DROP chat_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_C0155143989D9B62 ON blog');
        $this->addSql('ALTER TABLE blog DROP slug');
        $this->addSql('ALTER TABLE chat ADD user_sender_id INT DEFAULT NULL, ADD user_getter_id INT DEFAULT NULL, ADD chat_id INT NOT NULL');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAC790EC1F FOREIGN KEY (user_getter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAF6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAC790EC1F ON chat (user_getter_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAF6C43E79 ON chat (user_sender_id)');
    }
}
