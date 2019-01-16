<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190115143023 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA4C91BDE4');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE salon');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, salon_id INT NOT NULL, message VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date_send DATETIME NOT NULL, INDEX IDX_659DF2AA4C91BDE4 (salon_id), INDEX IDX_659DF2AAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, nom INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
