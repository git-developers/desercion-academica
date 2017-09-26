<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170925235357 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_has_course (user_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_9DDBBECEA76ED395 (user_id), INDEX IDX_9DDBBECE591CC992 (course_id), PRIMARY KEY(user_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_has_course ADD CONSTRAINT FK_9DDBBECEA76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE user_has_course ADD CONSTRAINT FK_9DDBBECE591CC992 FOREIGN KEY (course_id) REFERENCES course (id_increment)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_has_course');
    }
}
