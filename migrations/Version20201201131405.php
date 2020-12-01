<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201131405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_articles (tag_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_89EC4AB3BAD26311 (tag_id), INDEX IDX_89EC4AB31EBAF6CC (articles_id), PRIMARY KEY(tag_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_articles ADD CONSTRAINT FK_89EC4AB3BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_articles ADD CONSTRAINT FK_89EC4AB31EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B7837294869C');
        $this->addSql('DROP INDEX IDX_389B7837294869C ON tag');
        $this->addSql('ALTER TABLE tag DROP article_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tag_articles');
        $this->addSql('ALTER TABLE articles CHANGE content content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tag ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B7837294869C FOREIGN KEY (article_id) REFERENCES articles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_389B7837294869C ON tag (article_id)');
    }
}
