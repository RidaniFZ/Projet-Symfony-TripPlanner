<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408100258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trip_activit (trip_id INT NOT NULL, activit_id INT NOT NULL, INDEX IDX_F1762FD9A5BC2E0E (trip_id), INDEX IDX_F1762FD9BA71FC0C (activit_id), PRIMARY KEY(trip_id, activit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trip_activit ADD CONSTRAINT FK_F1762FD9A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_activit ADD CONSTRAINT FK_F1762FD9BA71FC0C FOREIGN KEY (activit_id) REFERENCES activit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip ADD trip_groupe_id INT NOT NULL, ADD trip_hebergement_id INT NOT NULL, ADD trip_admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B675A74DB FOREIGN KEY (trip_groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B6236ABB4 FOREIGN KEY (trip_hebergement_id) REFERENCES hebergement (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BCC7AB100 FOREIGN KEY (trip_admin_id) REFERENCES membre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7656F53B675A74DB ON trip (trip_groupe_id)');
        $this->addSql('CREATE INDEX IDX_7656F53B6236ABB4 ON trip (trip_hebergement_id)');
        $this->addSql('CREATE INDEX IDX_7656F53BCC7AB100 ON trip (trip_admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE trip_activit');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B675A74DB');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B6236ABB4');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BCC7AB100');
        $this->addSql('DROP INDEX UNIQ_7656F53B675A74DB ON trip');
        $this->addSql('DROP INDEX IDX_7656F53B6236ABB4 ON trip');
        $this->addSql('DROP INDEX IDX_7656F53BCC7AB100 ON trip');
        $this->addSql('ALTER TABLE trip DROP trip_groupe_id, DROP trip_hebergement_id, DROP trip_admin_id');
    }
}
