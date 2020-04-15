<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414202054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre_groupe DROP FOREIGN KEY FK_9EB019986A99F74A');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BCC7AB100');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE membre_groupe');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C2193B230BE FOREIGN KEY (admin_groupe_id) REFERENCES user (id)');
        $this->addSql('DROP INDEX IDX_7656F53BCC7AB100 ON trip');
        $this->addSql('ALTER TABLE trip DROP trip_admin_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adress VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_pass VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE membre_groupe (membre_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_9EB019987A45358C (groupe_id), INDEX IDX_9EB019986A99F74A (membre_id), PRIMARY KEY(membre_id, groupe_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE membre_groupe ADD CONSTRAINT FK_9EB019986A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_groupe ADD CONSTRAINT FK_9EB019987A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C2193B230BE');
        $this->addSql('ALTER TABLE trip ADD trip_admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BCC7AB100 FOREIGN KEY (trip_admin_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_7656F53BCC7AB100 ON trip (trip_admin_id)');
    }
}
