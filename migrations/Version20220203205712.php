<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203205712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE almacen (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, telefono VARCHAR(11) DEFAULT NULL, direccion VARCHAR(80) DEFAULT NULL, ruc VARCHAR(11) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_D5B2D250D17F50A6 (uuid), INDEX IDX_D5B2D25053C8D32C (propietario_id), INDEX IDX_D5B2D25024DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE almacen ADD CONSTRAINT FK_D5B2D25053C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE almacen ADD CONSTRAINT FK_D5B2D25024DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE almacen');
    }
}
