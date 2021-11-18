<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118153955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat_loi (contrat_id INT NOT NULL, loi_id INT NOT NULL, INDEX IDX_8E4303A21823061F (contrat_id), INDEX IDX_8E4303A2AB82AB5 (loi_id), PRIMARY KEY(contrat_id, loi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrat_loi ADD CONSTRAINT FK_8E4303A21823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat_loi ADD CONSTRAINT FK_8E4303A2AB82AB5 FOREIGN KEY (loi_id) REFERENCES loi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD local_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664105D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('CREATE INDEX IDX_FE8664105D5A2101 ON facture (local_id)');
        $this->addSql('ALTER TABLE local ADD contrat_id INT NOT NULL, ADD type_local_id INT NOT NULL, ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE local ADD CONSTRAINT FK_8BD688E81823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE local ADD CONSTRAINT FK_8BD688E890A506FD FOREIGN KEY (type_local_id) REFERENCES type_local (id)');
        $this->addSql('ALTER TABLE local ADD CONSTRAINT FK_8BD688E8F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BD688E81823061F ON local (contrat_id)');
        $this->addSql('CREATE INDEX IDX_8BD688E890A506FD ON local (type_local_id)');
        $this->addSql('CREATE INDEX IDX_8BD688E8F6BD1646 ON local (site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contrat_loi');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664105D5A2101');
        $this->addSql('DROP INDEX IDX_FE8664105D5A2101 ON facture');
        $this->addSql('ALTER TABLE facture DROP local_id');
        $this->addSql('ALTER TABLE local DROP FOREIGN KEY FK_8BD688E81823061F');
        $this->addSql('ALTER TABLE local DROP FOREIGN KEY FK_8BD688E890A506FD');
        $this->addSql('ALTER TABLE local DROP FOREIGN KEY FK_8BD688E8F6BD1646');
        $this->addSql('DROP INDEX UNIQ_8BD688E81823061F ON local');
        $this->addSql('DROP INDEX IDX_8BD688E890A506FD ON local');
        $this->addSql('DROP INDEX IDX_8BD688E8F6BD1646 ON local');
        $this->addSql('ALTER TABLE local DROP contrat_id, DROP type_local_id, DROP site_id');
    }
}
