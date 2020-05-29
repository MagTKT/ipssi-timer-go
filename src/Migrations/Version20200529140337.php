<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529140337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, id_status_id INT DEFAULT NULL, name_project VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EEEBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, id_status_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C4E0A61FEBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_project (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_project_id INT NOT NULL, id_status_id INT DEFAULT NULL, INDEX IDX_77BECEE479F37AE5 (id_user_id), INDEX IDX_77BECEE4B3E79F4B (id_project_id), INDEX IDX_77BECEE4EBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_team (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_team_id INT NOT NULL, id_status_id INT DEFAULT NULL, INDEX IDX_BE61EAD679F37AE5 (id_user_id), INDEX IDX_BE61EAD6F7F171DE (id_team_id), INDEX IDX_BE61EAD6EBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEEBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FEBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4B3E79F4B FOREIGN KEY (id_project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6F7F171DE FOREIGN KEY (id_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4B3E79F4B');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEEBC2BC9A');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FEBC2BC9A');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4EBC2BC9A');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6EBC2BC9A');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6F7F171DE');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE479F37AE5');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD679F37AE5');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_project');
        $this->addSql('DROP TABLE user_team');
    }
}
