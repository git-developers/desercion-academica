<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190302094614 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE qr (id_increment INT AUTO_INCREMENT NOT NULL, cht VARCHAR(45) NOT NULL, chl TEXT NOT NULL, chs VARCHAR(45) NOT NULL, choe VARCHAR(45) DEFAULT NULL, chld VARCHAR(45) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_bot (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description TEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chatbot_has_user (chatbot_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FAFB6A5A1984C580 (chatbot_id), INDEX IDX_FAFB6A5AA76ED395 (user_id), PRIMARY KEY(chatbot_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id_increment INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, ciclo INT DEFAULT NULL, range_start DATETIME DEFAULT NULL, range_end DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_has_user (course_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_797B6040591CC992 (course_id), INDEX IDX_797B6040A76ED395 (user_id), PRIMARY KEY(course_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_has_exam (course_id INT NOT NULL, exam_id INT NOT NULL, INDEX IDX_CC5310CF591CC992 (course_id), INDEX IDX_CC5310CF578D5E91 (exam_id), PRIMARY KEY(course_id, exam_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gcm (id_increment INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, click_action VARCHAR(45) DEFAULT NULL, icon VARCHAR(45) DEFAULT NULL, color VARCHAR(45) DEFAULT NULL, sound VARCHAR(45) DEFAULT NULL, badge VARCHAR(45) DEFAULT NULL, title VARCHAR(45) DEFAULT NULL, body TEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_CF0A2136A76ED395 (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id_increment INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX fk_category_category1_idx (category_id), UNIQUE INDEX code_UNIQUE (code), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_of_users (id_increment INT AUTO_INCREMENT NOT NULL, group_name VARCHAR(150) NOT NULL, slug VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_of_users_has_user (group_of_users_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6838269DFE905D17 (group_of_users_id), INDEX IDX_6838269DA76ED395 (user_id), PRIMARY KEY(group_of_users_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, slug VARCHAR(100) NOT NULL, group_rol VARCHAR(100) DEFAULT NULL, group_rol_tag VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grades (id_increment INT AUTO_INCREMENT NOT NULL, exam_id INT DEFAULT NULL, course_id INT NOT NULL, user_id INT DEFAULT NULL, grade INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX fk_grades_exam1_idx (exam_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files_mime_type (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, view VARCHAR(45) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX name_UNIQUE (name), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, description TEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_has_role (profile_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F35F3084CCFA12B8 (profile_id), INDEX IDX_F35F3084D60322AC (role_id), PRIMARY KEY(profile_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assistance (id_increment INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, attended TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX fk_assistance_user_tianos1_idx (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id_increment INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(45) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D044D5D4A76ED395 (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id_increment INT AUTO_INCREMENT NOT NULL, id_mime_type INT DEFAULT NULL, id_file VARCHAR(255) NOT NULL, unique_id VARCHAR(20) NOT NULL, slug VARCHAR(255) NOT NULL, icon_link VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, name TEXT NOT NULL, size VARCHAR(255) NOT NULL, INDEX IDX_6354059A1351609 (id_mime_type), UNIQUE INDEX id_file_UNIQUE (id_file), UNIQUE INDEX unique_id_UNIQUE (unique_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam (id_increment INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, description TEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tianos (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, client_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', slug VARCHAR(255) DEFAULT NULL, device_code VARCHAR(100) DEFAULT NULL, dni VARCHAR(8) DEFAULT NULL, name VARCHAR(100) NOT NULL, last_name VARCHAR(100) DEFAULT NULL, dob DATE DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, phone VARCHAR(45) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, last_access DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_3ABBC1D792FC23A8 (username_canonical), UNIQUE INDEX UNIQ_3ABBC1D7A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_3ABBC1D7C05FB297 (confirmation_token), INDEX IDX_3ABBC1D719EB6921 (client_id), INDEX FK_8D93D649CCFA12B8 (profile_id), UNIQUE INDEX email_UNIQUE (email), UNIQUE INDEX username_UNIQUE (username), UNIQUE INDEX dni_UNIQUE (dni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_files (user_id INT NOT NULL, files_id INT NOT NULL, INDEX IDX_FD5CDD03A76ED395 (user_id), INDEX IDX_FD5CDD03A3E65B2F (files_id), PRIMARY KEY(user_id, files_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chatbot_has_user ADD CONSTRAINT FK_FAFB6A5A1984C580 FOREIGN KEY (chatbot_id) REFERENCES chat_bot (id)');
        $this->addSql('ALTER TABLE chatbot_has_user ADD CONSTRAINT FK_FAFB6A5AA76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE course_has_user ADD CONSTRAINT FK_797B6040591CC992 FOREIGN KEY (course_id) REFERENCES course (id_increment)');
        $this->addSql('ALTER TABLE course_has_user ADD CONSTRAINT FK_797B6040A76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE course_has_exam ADD CONSTRAINT FK_CC5310CF591CC992 FOREIGN KEY (course_id) REFERENCES course (id_increment)');
        $this->addSql('ALTER TABLE course_has_exam ADD CONSTRAINT FK_CC5310CF578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id_increment)');
        $this->addSql('ALTER TABLE gcm ADD CONSTRAINT FK_CF0A2136A76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C112469DE2 FOREIGN KEY (category_id) REFERENCES category (id_increment)');
        $this->addSql('ALTER TABLE group_of_users_has_user ADD CONSTRAINT FK_6838269DFE905D17 FOREIGN KEY (group_of_users_id) REFERENCES group_of_users (id_increment)');
        $this->addSql('ALTER TABLE group_of_users_has_user ADD CONSTRAINT FK_6838269DA76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id_increment)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084D60322AC FOREIGN KEY (role_id) REFERENCES role (id_increment)');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F2A76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4A76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059A1351609 FOREIGN KEY (id_mime_type) REFERENCES files_mime_type (id_increment)');
        $this->addSql('ALTER TABLE user_tianos ADD CONSTRAINT FK_3ABBC1D7CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE user_tianos ADD CONSTRAINT FK_3ABBC1D719EB6921 FOREIGN KEY (client_id) REFERENCES client (id_increment)');
        $this->addSql('ALTER TABLE user_has_files ADD CONSTRAINT FK_FD5CDD03A76ED395 FOREIGN KEY (user_id) REFERENCES user_tianos (id)');
        $this->addSql('ALTER TABLE user_has_files ADD CONSTRAINT FK_FD5CDD03A3E65B2F FOREIGN KEY (files_id) REFERENCES files (id_increment) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chatbot_has_user DROP FOREIGN KEY FK_FAFB6A5A1984C580');
        $this->addSql('ALTER TABLE course_has_user DROP FOREIGN KEY FK_797B6040591CC992');
        $this->addSql('ALTER TABLE course_has_exam DROP FOREIGN KEY FK_CC5310CF591CC992');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C112469DE2');
        $this->addSql('ALTER TABLE group_of_users_has_user DROP FOREIGN KEY FK_6838269DFE905D17');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084D60322AC');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059A1351609');
        $this->addSql('ALTER TABLE user_tianos DROP FOREIGN KEY FK_3ABBC1D719EB6921');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084CCFA12B8');
        $this->addSql('ALTER TABLE user_tianos DROP FOREIGN KEY FK_3ABBC1D7CCFA12B8');
        $this->addSql('ALTER TABLE user_has_files DROP FOREIGN KEY FK_FD5CDD03A3E65B2F');
        $this->addSql('ALTER TABLE course_has_exam DROP FOREIGN KEY FK_CC5310CF578D5E91');
        $this->addSql('ALTER TABLE grades DROP FOREIGN KEY FK_3AE36110578D5E91');
        $this->addSql('ALTER TABLE chatbot_has_user DROP FOREIGN KEY FK_FAFB6A5AA76ED395');
        $this->addSql('ALTER TABLE course_has_user DROP FOREIGN KEY FK_797B6040A76ED395');
        $this->addSql('ALTER TABLE gcm DROP FOREIGN KEY FK_CF0A2136A76ED395');
        $this->addSql('ALTER TABLE group_of_users_has_user DROP FOREIGN KEY FK_6838269DA76ED395');
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F2A76ED395');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4A76ED395');
        $this->addSql('ALTER TABLE user_has_files DROP FOREIGN KEY FK_FD5CDD03A76ED395');
        $this->addSql('DROP TABLE qr');
        $this->addSql('DROP TABLE chat_bot');
        $this->addSql('DROP TABLE chatbot_has_user');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_has_user');
        $this->addSql('DROP TABLE course_has_exam');
        $this->addSql('DROP TABLE gcm');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE group_of_users');
        $this->addSql('DROP TABLE group_of_users_has_user');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE grades');
        $this->addSql('DROP TABLE files_mime_type');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_has_role');
        $this->addSql('DROP TABLE assistance');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE user_tianos');
        $this->addSql('DROP TABLE user_has_files');
    }
}
