<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116101034 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE picture_bg (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0155143989D9B62 ON blog (slug)');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAC790EC1F');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAF6C43E79');
        $this->addSql('DROP INDEX IDX_659DF2AAF6C43E79 ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAC790EC1F ON chat');
        $this->addSql('ALTER TABLE chat ADD salon_id INT NOT NULL, ADD user_id INT NOT NULL, ADD date_send DATETIME NOT NULL, DROP user_sender_id, DROP user_getter_id');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AA4C91BDE4 ON chat (salon_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAA76ED395 ON chat (user_id)');
        $this->addSql('ALTER TABLE user ADD picture_bg VARCHAR(255) NOT NULL, ADD facebook VARCHAR(255) DEFAULT NULL, ADD instagram VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA4C91BDE4');
        $this->addSql('DROP TABLE picture_bg');
        $this->addSql('DROP TABLE salon');
        $this->addSql('DROP INDEX UNIQ_C0155143989D9B62 ON blog');
        $this->addSql('ALTER TABLE blog DROP slug');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA76ED395');
        $this->addSql('DROP INDEX IDX_659DF2AA4C91BDE4 ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAA76ED395 ON chat');
        $this->addSql('ALTER TABLE chat ADD user_sender_id INT DEFAULT NULL, ADD user_getter_id INT DEFAULT NULL, DROP salon_id, DROP user_id, DROP date_send');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAC790EC1F FOREIGN KEY (user_getter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAF6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAF6C43E79 ON chat (user_sender_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAC790EC1F ON chat (user_getter_id)');
        $this->addSql('ALTER TABLE user DROP picture_bg, DROP facebook, DROP instagram');
    }
}
