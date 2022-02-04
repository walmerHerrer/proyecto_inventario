<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204160731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE despacho (id INT AUTO_INCREMENT NOT NULL, almacen_id INT DEFAULT NULL, trabajador_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, fecha_salida DATETIME NOT NULL, items_desapachados NUMERIC(10, 2) DEFAULT NULL, cantidad_despacho NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_254BF5B3D17F50A6 (uuid), INDEX IDX_254BF5B39C9C9E68 (almacen_id), INDEX IDX_254BF5B3EC3656E (trabajador_id), INDEX IDX_254BF5B353C8D32C (propietario_id), INDEX IDX_254BF5B324DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE despacho_producto (despacho_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_5E741005299C08BC (despacho_id), INDEX IDX_5E7410057645698E (producto_id), PRIMARY KEY(despacho_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B39C9C9E68 FOREIGN KEY (almacen_id) REFERENCES almacen (id)');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B3EC3656E FOREIGN KEY (trabajador_id) REFERENCES trabajador (id)');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B353C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B324DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE despacho_producto ADD CONSTRAINT FK_5E741005299C08BC FOREIGN KEY (despacho_id) REFERENCES despacho (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE despacho_producto ADD CONSTRAINT FK_5E7410057645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orden_pedido CHANGE almacen_id almacen_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE despacho_producto DROP FOREIGN KEY FK_5E741005299C08BC');
        $this->addSql('DROP TABLE despacho');
        $this->addSql('DROP TABLE despacho_producto');
        $this->addSql('ALTER TABLE orden_pedido CHANGE almacen_id almacen_id INT DEFAULT NULL');
    }
}
