<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322115308 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE postes (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, nom VARCHAR(20) NOT NULL, remarque LONGTEXT DEFAULT NULL, INDEX IDX_5A763C646D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE benevole (id INT AUTO_INCREMENT NOT NULL, affectation_id INT DEFAULT NULL, nom VARCHAR(40) NOT NULL, prenom LONGTEXT NOT NULL, date_inscription DATETIME NOT NULL, date_naissance DATETIME DEFAULT NULL, numero_permis_conduire VARCHAR(15) DEFAULT NULL, INDEX IDX_B4014FDB6D0ABA22 (affectation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE postes ADD CONSTRAINT FK_5A763C646D861B89 FOREIGN KEY (equipe_id) REFERENCES equipes (id)');
        $this->addSql('ALTER TABLE benevole ADD CONSTRAINT FK_B4014FDB6D0ABA22 FOREIGN KEY (affectation_id) REFERENCES postes (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE benevole DROP FOREIGN KEY FK_B4014FDB6D0ABA22');
        $this->addSql('ALTER TABLE postes DROP FOREIGN KEY FK_5A763C646D861B89');
        $this->addSql('DROP TABLE postes');
        $this->addSql('DROP TABLE benevole');
        $this->addSql('DROP TABLE equipes');
    }
}
