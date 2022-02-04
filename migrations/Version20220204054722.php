<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204054722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_pedido (id INT AUTO_INCREMENT NOT NULL, producto_id INT NOT NULL, orden_pedido_id INT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_A834F569D17F50A6 (uuid), INDEX IDX_A834F5697645698E (producto_id), INDEX IDX_A834F569503F48CE (orden_pedido_id), INDEX IDX_A834F56953C8D32C (propietario_id), INDEX IDX_A834F56924DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orden_pedido (id INT AUTO_INCREMENT NOT NULL, almacen_id INT NOT NULL, trabajador_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, fecha_pedido DATETIME NOT NULL, cantidad_pedido NUMERIC(10, 2) DEFAULT NULL, cantidad_items NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_2C77227FD17F50A6 (uuid), INDEX IDX_2C77227F9C9C9E68 (almacen_id), INDEX IDX_2C77227FEC3656E (trabajador_id), INDEX IDX_2C77227F53C8D32C (propietario_id), INDEX IDX_2C77227F24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orden_pedido_producto (orden_pedido_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_449301B2503F48CE (orden_pedido_id), INDEX IDX_449301B27645698E (producto_id), PRIMARY KEY(orden_pedido_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detalle_pedido ADD CONSTRAINT FK_A834F5697645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE detalle_pedido ADD CONSTRAINT FK_A834F569503F48CE FOREIGN KEY (orden_pedido_id) REFERENCES orden_pedido (id)');
        $this->addSql('ALTER TABLE detalle_pedido ADD CONSTRAINT FK_A834F56953C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE detalle_pedido ADD CONSTRAINT FK_A834F56924DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227F9C9C9E68 FOREIGN KEY (almacen_id) REFERENCES almacen (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227FEC3656E FOREIGN KEY (trabajador_id) REFERENCES trabajador (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227F53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227F24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE orden_pedido_producto ADD CONSTRAINT FK_449301B2503F48CE FOREIGN KEY (orden_pedido_id) REFERENCES orden_pedido (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orden_pedido_producto ADD CONSTRAINT FK_449301B27645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_pedido DROP FOREIGN KEY FK_A834F569503F48CE');
        $this->addSql('ALTER TABLE orden_pedido_producto DROP FOREIGN KEY FK_449301B2503F48CE');
        $this->addSql('DROP TABLE detalle_pedido');
        $this->addSql('DROP TABLE orden_pedido');
        $this->addSql('DROP TABLE orden_pedido_producto');
    }
}
