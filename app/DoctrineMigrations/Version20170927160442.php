<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170927160442 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exam (id_increment INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, description TEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_has_exam (course_id INT NOT NULL, exam_id INT NOT NULL, INDEX IDX_CC5310CF591CC992 (course_id), INDEX IDX_CC5310CF578D5E91 (exam_id), PRIMARY KEY(course_id, exam_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_has_exam ADD CONSTRAINT FK_CC5310CF591CC992 FOREIGN KEY (course_id) REFERENCES course (id_increment)');
        $this->addSql('ALTER TABLE course_has_exam ADD CONSTRAINT FK_CC5310CF578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id_increment)');
        $this->addSql('ALTER TABLE assistance CHANGE is_active is_active TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_has_exam DROP FOREIGN KEY FK_CC5310CF578D5E91');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE course_has_exam');
        $this->addSql('ALTER TABLE assistance CHANGE is_active is_active VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
