<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200825171053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, id_status_id INT DEFAULT NULL, team_admin_id INT NOT NULL, name VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_C4E0A61FEBC2BC9A (id_status_id), INDEX IDX_C4E0A61FDC695E6E (team_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, id_status_id INT DEFAULT NULL, team_id INT DEFAULT NULL, name_project VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_2FB3D0EEEBC2BC9A (id_status_id), INDEX IDX_2FB3D0EE296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timer (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_team_id INT NOT NULL, id_project_id INT NOT NULL, date_time_debut DATETIME NOT NULL, date_time_fin DATETIME DEFAULT NULL, cumul_s INT DEFAULT NULL, timer_comment VARCHAR(255) DEFAULT NULL, INDEX IDX_6AD0DE1A79F37AE5 (id_user_id), INDEX IDX_6AD0DE1AF7F171DE (id_team_id), INDEX IDX_6AD0DE1AB3E79F4B (id_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6496BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_project (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_project_id INT NOT NULL, id_status_id INT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_77BECEE479F37AE5 (id_user_id), INDEX IDX_77BECEE4B3E79F4B (id_project_id), INDEX IDX_77BECEE4EBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_team (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_team_id INT NOT NULL, id_status_id INT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_BE61EAD679F37AE5 (id_user_id), INDEX IDX_BE61EAD6F7F171DE (id_team_id), INDEX IDX_BE61EAD6EBC2BC9A (id_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FEBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FDC695E6E FOREIGN KEY (team_admin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEEBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE timer ADD CONSTRAINT FK_6AD0DE1A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE timer ADD CONSTRAINT FK_6AD0DE1AF7F171DE FOREIGN KEY (id_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE timer ADD CONSTRAINT FK_6AD0DE1AB3E79F4B FOREIGN KEY (id_project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
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

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE296CD8AE');
        $this->addSql('ALTER TABLE timer DROP FOREIGN KEY FK_6AD0DE1AF7F171DE');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6F7F171DE');
        $this->addSql('ALTER TABLE timer DROP FOREIGN KEY FK_6AD0DE1AB3E79F4B');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4B3E79F4B');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FDC695E6E');
        $this->addSql('ALTER TABLE timer DROP FOREIGN KEY FK_6AD0DE1A79F37AE5');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE479F37AE5');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD679F37AE5');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FEBC2BC9A');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEEBC2BC9A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496BF700BD');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4EBC2BC9A');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6EBC2BC9A');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE timer');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_project');
        $this->addSql('DROP TABLE user_team');
        $this->addSql('DROP TABLE status');
    }
}
