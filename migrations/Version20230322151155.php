<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322151155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE motdepasse (id INT AUTO_INCREMENT NOT NULL, website VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motdepasse_confidentialite (motdepasse_id INT NOT NULL, confidentialite_id INT NOT NULL, INDEX IDX_47F4063ABBC366E9 (motdepasse_id), INDEX IDX_47F4063A11C0A539 (confidentialite_id), PRIMARY KEY(motdepasse_id, confidentialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE motdepasse_confidentialite ADD CONSTRAINT FK_47F4063ABBC366E9 FOREIGN KEY (motdepasse_id) REFERENCES motdepasse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motdepasse_confidentialite ADD CONSTRAINT FK_47F4063A11C0A539 FOREIGN KEY (confidentialite_id) REFERENCES confidentialite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motdepasse_confidentialite DROP FOREIGN KEY FK_47F4063ABBC366E9');
        $this->addSql('ALTER TABLE motdepasse_confidentialite DROP FOREIGN KEY FK_47F4063A11C0A539');
        $this->addSql('DROP TABLE motdepasse');
        $this->addSql('DROP TABLE motdepasse_confidentialite');
    }
}
