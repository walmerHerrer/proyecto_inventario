<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207162400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE almacen (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, telefono VARCHAR(11) DEFAULT NULL, direccion VARCHAR(80) DEFAULT NULL, ruc VARCHAR(11) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_D5B2D250D17F50A6 (uuid), INDEX IDX_D5B2D25053C8D32C (propietario_id), INDEX IDX_D5B2D25024DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, detalle VARCHAR(80) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_4E10122DD17F50A6 (uuid), INDEX IDX_4E10122D53C8D32C (propietario_id), INDEX IDX_4E10122D24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(80) DEFAULT NULL, telefono VARCHAR(11) DEFAULT NULL, direccion VARCHAR(80) DEFAULT NULL, dni VARCHAR(8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_F41C9B25D17F50A6 (uuid), INDEX IDX_F41C9B2553C8D32C (propietario_id), INDEX IDX_F41C9B2524DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, alias VARCHAR(15) NOT NULL, nombre VARCHAR(255) NOT NULL, nombre_corto VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_D48A2F7CD17F50A6 (uuid), INDEX IDX_D48A2F7C53C8D32C (propietario_id), INDEX IDX_D48A2F7C24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_config_menu_menus (config_id INT NOT NULL, config_menu_id INT NOT NULL, INDEX IDX_A8E9CD3124DB0683 (config_id), INDEX IDX_A8E9CD31B9CB2BE2 (config_menu_id), PRIMARY KEY(config_id, config_menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, route VARCHAR(255) NOT NULL, activo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE despacho (id INT AUTO_INCREMENT NOT NULL, almacen_id INT DEFAULT NULL, trabajador_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, fecha_salida DATETIME NOT NULL, items_desapachados NUMERIC(10, 2) DEFAULT NULL, cantidad_despacho NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_254BF5B3D17F50A6 (uuid), INDEX IDX_254BF5B39C9C9E68 (almacen_id), INDEX IDX_254BF5B3EC3656E (trabajador_id), INDEX IDX_254BF5B353C8D32C (propietario_id), INDEX IDX_254BF5B324DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE despacho_producto (despacho_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_5E741005299C08BC (despacho_id), INDEX IDX_5E7410057645698E (producto_id), PRIMARY KEY(despacho_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_orden_compra (id INT AUTO_INCREMENT NOT NULL, producto_id INT NOT NULL, orden_compra_id INT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, precio_proveedor NUMERIC(10, 2) DEFAULT NULL, cant_recibida NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_BF1A3A25D17F50A6 (uuid), INDEX IDX_BF1A3A257645698E (producto_id), INDEX IDX_BF1A3A25EA8C2923 (orden_compra_id), INDEX IDX_BF1A3A2553C8D32C (propietario_id), INDEX IDX_BF1A3A2524DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_orden_pedido (id INT AUTO_INCREMENT NOT NULL, producto_id INT NOT NULL, orden_pedido_id INT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, precio_venta NUMERIC(10, 2) NOT NULL, cantidad INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_E5371D14D17F50A6 (uuid), INDEX IDX_E5371D147645698E (producto_id), INDEX IDX_E5371D14503F48CE (orden_pedido_id), INDEX IDX_E5371D1453C8D32C (propietario_id), INDEX IDX_E5371D1424DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, padre_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, ruta VARCHAR(50) DEFAULT NULL, icono VARCHAR(50) DEFAULT NULL, orden SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_7D053A93D17F50A6 (uuid), INDEX IDX_7D053A93613CEC58 (padre_id), INDEX IDX_7D053A9353C8D32C (propietario_id), INDEX IDX_7D053A9324DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orden_compra (id INT AUTO_INCREMENT NOT NULL, trabajador_id INT NOT NULL, proveedor_id INT NOT NULL, almacen_id INT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, fecha DATETIME NOT NULL, num_factura VARCHAR(10) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_765A054ED17F50A6 (uuid), INDEX IDX_765A054EEC3656E (trabajador_id), INDEX IDX_765A054ECB305D73 (proveedor_id), INDEX IDX_765A054E9C9C9E68 (almacen_id), INDEX IDX_765A054E53C8D32C (propietario_id), INDEX IDX_765A054E24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orden_pedido (id INT AUTO_INCREMENT NOT NULL, almacen_id INT NOT NULL, trabajador_id INT DEFAULT NULL, cliente_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, fecha_pedido DATETIME NOT NULL, despacho TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_2C77227FD17F50A6 (uuid), INDEX IDX_2C77227F9C9C9E68 (almacen_id), INDEX IDX_2C77227FEC3656E (trabajador_id), INDEX IDX_2C77227FDE734E51 (cliente_id), INDEX IDX_2C77227F53C8D32C (propietario_id), INDEX IDX_2C77227F24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametro (id INT AUTO_INCREMENT NOT NULL, padre_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(100) NOT NULL, alias VARCHAR(16) DEFAULT NULL, valor NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_4C12795FD17F50A6 (uuid), INDEX IDX_4C12795F613CEC58 (padre_id), INDEX IDX_4C12795F53C8D32C (propietario_id), INDEX IDX_4C12795F24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, precio_unitario NUMERIC(10, 2) NOT NULL, descripcion VARCHAR(80) DEFAULT NULL, precio_venta NUMERIC(10, 2) NOT NULL, nombre VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_A7BB0615D17F50A6 (uuid), INDEX IDX_A7BB06153397707A (categoria_id), INDEX IDX_A7BB061553C8D32C (propietario_id), INDEX IDX_A7BB061524DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(80) DEFAULT NULL, telefono VARCHAR(11) DEFAULT NULL, direccion VARCHAR(80) DEFAULT NULL, dni VARCHAR(8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_16C068CED17F50A6 (uuid), INDEX IDX_16C068CE53C8D32C (propietario_id), INDEX IDX_16C068CE24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trabajador (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(80) DEFAULT NULL, telefono VARCHAR(11) DEFAULT NULL, direccion VARCHAR(80) DEFAULT NULL, dni VARCHAR(8) NOT NULL, cargo VARCHAR(30) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_42157CDFD17F50A6 (uuid), INDEX IDX_42157CDF53C8D32C (propietario_id), INDEX IDX_42157CDF24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, full_name VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), UNIQUE INDEX UNIQ_2265B05DD17F50A6 (uuid), INDEX IDX_2265B05D53C8D32C (propietario_id), INDEX IDX_2265B05D24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_usuario_rol (usuario_id INT NOT NULL, usuario_rol_id INT NOT NULL, INDEX IDX_4AC6232ADB38439E (usuario_id), INDEX IDX_4AC6232AFEA85A65 (usuario_rol_id), PRIMARY KEY(usuario_id, usuario_rol_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_permiso (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, listar TINYINT(1) DEFAULT NULL, mostrar TINYINT(1) DEFAULT NULL, crear TINYINT(1) DEFAULT NULL, editar TINYINT(1) DEFAULT NULL, eliminar TINYINT(1) DEFAULT NULL, imprimir TINYINT(1) DEFAULT NULL, exportar TINYINT(1) DEFAULT NULL, importar TINYINT(1) DEFAULT NULL, maestro TINYINT(1) DEFAULT NULL, INDEX IDX_845C01D9CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_permiso_usuario_rol (usuario_permiso_id INT NOT NULL, usuario_rol_id INT NOT NULL, INDEX IDX_B45A84629FDFE795 (usuario_permiso_id), INDEX IDX_B45A8462FEA85A65 (usuario_rol_id), PRIMARY KEY(usuario_permiso_id, usuario_rol_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_rol (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, config_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, rol VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, activo TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_72EDD1A4D17F50A6 (uuid), INDEX IDX_72EDD1A453C8D32C (propietario_id), INDEX IDX_72EDD1A424DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE almacen ADD CONSTRAINT FK_D5B2D25053C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE almacen ADD CONSTRAINT FK_D5B2D25024DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122D53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122D24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B2553C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B2524DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7C53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7C24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE config_config_menu_menus ADD CONSTRAINT FK_A8E9CD3124DB0683 FOREIGN KEY (config_id) REFERENCES config (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE config_config_menu_menus ADD CONSTRAINT FK_A8E9CD31B9CB2BE2 FOREIGN KEY (config_menu_id) REFERENCES config_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B39C9C9E68 FOREIGN KEY (almacen_id) REFERENCES almacen (id)');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B3EC3656E FOREIGN KEY (trabajador_id) REFERENCES trabajador (id)');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B353C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B324DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE despacho_producto ADD CONSTRAINT FK_5E741005299C08BC FOREIGN KEY (despacho_id) REFERENCES despacho (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE despacho_producto ADD CONSTRAINT FK_5E7410057645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_orden_compra ADD CONSTRAINT FK_BF1A3A257645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE detalle_orden_compra ADD CONSTRAINT FK_BF1A3A25EA8C2923 FOREIGN KEY (orden_compra_id) REFERENCES orden_compra (id)');
        $this->addSql('ALTER TABLE detalle_orden_compra ADD CONSTRAINT FK_BF1A3A2553C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE detalle_orden_compra ADD CONSTRAINT FK_BF1A3A2524DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE detalle_orden_pedido ADD CONSTRAINT FK_E5371D147645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE detalle_orden_pedido ADD CONSTRAINT FK_E5371D14503F48CE FOREIGN KEY (orden_pedido_id) REFERENCES orden_pedido (id)');
        $this->addSql('ALTER TABLE detalle_orden_pedido ADD CONSTRAINT FK_E5371D1453C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE detalle_orden_pedido ADD CONSTRAINT FK_E5371D1424DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93613CEC58 FOREIGN KEY (padre_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9353C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9324DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE orden_compra ADD CONSTRAINT FK_765A054EEC3656E FOREIGN KEY (trabajador_id) REFERENCES trabajador (id)');
        $this->addSql('ALTER TABLE orden_compra ADD CONSTRAINT FK_765A054ECB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('ALTER TABLE orden_compra ADD CONSTRAINT FK_765A054E9C9C9E68 FOREIGN KEY (almacen_id) REFERENCES almacen (id)');
        $this->addSql('ALTER TABLE orden_compra ADD CONSTRAINT FK_765A054E53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE orden_compra ADD CONSTRAINT FK_765A054E24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227F9C9C9E68 FOREIGN KEY (almacen_id) REFERENCES almacen (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227FEC3656E FOREIGN KEY (trabajador_id) REFERENCES trabajador (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227FDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227F53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227F24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE parametro ADD CONSTRAINT FK_4C12795F613CEC58 FOREIGN KEY (padre_id) REFERENCES parametro (id)');
        $this->addSql('ALTER TABLE parametro ADD CONSTRAINT FK_4C12795F53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE parametro ADD CONSTRAINT FK_4C12795F24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06153397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061553C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061524DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE proveedor ADD CONSTRAINT FK_16C068CE53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE proveedor ADD CONSTRAINT FK_16C068CE24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE trabajador ADD CONSTRAINT FK_42157CDF53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE trabajador ADD CONSTRAINT FK_42157CDF24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D24DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
        $this->addSql('ALTER TABLE usuario_usuario_rol ADD CONSTRAINT FK_4AC6232ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_usuario_rol ADD CONSTRAINT FK_4AC6232AFEA85A65 FOREIGN KEY (usuario_rol_id) REFERENCES usuario_rol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_permiso ADD CONSTRAINT FK_845C01D9CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE usuario_permiso_usuario_rol ADD CONSTRAINT FK_B45A84629FDFE795 FOREIGN KEY (usuario_permiso_id) REFERENCES usuario_permiso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_permiso_usuario_rol ADD CONSTRAINT FK_B45A8462FEA85A65 FOREIGN KEY (usuario_rol_id) REFERENCES usuario_rol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_rol ADD CONSTRAINT FK_72EDD1A453C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_rol ADD CONSTRAINT FK_72EDD1A424DB0683 FOREIGN KEY (config_id) REFERENCES config (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE despacho DROP FOREIGN KEY FK_254BF5B39C9C9E68');
        $this->addSql('ALTER TABLE orden_compra DROP FOREIGN KEY FK_765A054E9C9C9E68');
        $this->addSql('ALTER TABLE orden_pedido DROP FOREIGN KEY FK_2C77227F9C9C9E68');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06153397707A');
        $this->addSql('ALTER TABLE orden_pedido DROP FOREIGN KEY FK_2C77227FDE734E51');
        $this->addSql('ALTER TABLE almacen DROP FOREIGN KEY FK_D5B2D25024DB0683');
        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122D24DB0683');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B2524DB0683');
        $this->addSql('ALTER TABLE config DROP FOREIGN KEY FK_D48A2F7C24DB0683');
        $this->addSql('ALTER TABLE config_config_menu_menus DROP FOREIGN KEY FK_A8E9CD3124DB0683');
        $this->addSql('ALTER TABLE despacho DROP FOREIGN KEY FK_254BF5B324DB0683');
        $this->addSql('ALTER TABLE detalle_orden_compra DROP FOREIGN KEY FK_BF1A3A2524DB0683');
        $this->addSql('ALTER TABLE detalle_orden_pedido DROP FOREIGN KEY FK_E5371D1424DB0683');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9324DB0683');
        $this->addSql('ALTER TABLE orden_compra DROP FOREIGN KEY FK_765A054E24DB0683');
        $this->addSql('ALTER TABLE orden_pedido DROP FOREIGN KEY FK_2C77227F24DB0683');
        $this->addSql('ALTER TABLE parametro DROP FOREIGN KEY FK_4C12795F24DB0683');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB061524DB0683');
        $this->addSql('ALTER TABLE proveedor DROP FOREIGN KEY FK_16C068CE24DB0683');
        $this->addSql('ALTER TABLE trabajador DROP FOREIGN KEY FK_42157CDF24DB0683');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D24DB0683');
        $this->addSql('ALTER TABLE usuario_rol DROP FOREIGN KEY FK_72EDD1A424DB0683');
        $this->addSql('ALTER TABLE config_config_menu_menus DROP FOREIGN KEY FK_A8E9CD31B9CB2BE2');
        $this->addSql('ALTER TABLE despacho_producto DROP FOREIGN KEY FK_5E741005299C08BC');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93613CEC58');
        $this->addSql('ALTER TABLE usuario_permiso DROP FOREIGN KEY FK_845C01D9CCD7E912');
        $this->addSql('ALTER TABLE detalle_orden_compra DROP FOREIGN KEY FK_BF1A3A25EA8C2923');
        $this->addSql('ALTER TABLE detalle_orden_pedido DROP FOREIGN KEY FK_E5371D14503F48CE');
        $this->addSql('ALTER TABLE parametro DROP FOREIGN KEY FK_4C12795F613CEC58');
        $this->addSql('ALTER TABLE despacho_producto DROP FOREIGN KEY FK_5E7410057645698E');
        $this->addSql('ALTER TABLE detalle_orden_compra DROP FOREIGN KEY FK_BF1A3A257645698E');
        $this->addSql('ALTER TABLE detalle_orden_pedido DROP FOREIGN KEY FK_E5371D147645698E');
        $this->addSql('ALTER TABLE orden_compra DROP FOREIGN KEY FK_765A054ECB305D73');
        $this->addSql('ALTER TABLE despacho DROP FOREIGN KEY FK_254BF5B3EC3656E');
        $this->addSql('ALTER TABLE orden_compra DROP FOREIGN KEY FK_765A054EEC3656E');
        $this->addSql('ALTER TABLE orden_pedido DROP FOREIGN KEY FK_2C77227FEC3656E');
        $this->addSql('ALTER TABLE almacen DROP FOREIGN KEY FK_D5B2D25053C8D32C');
        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122D53C8D32C');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B2553C8D32C');
        $this->addSql('ALTER TABLE config DROP FOREIGN KEY FK_D48A2F7C53C8D32C');
        $this->addSql('ALTER TABLE despacho DROP FOREIGN KEY FK_254BF5B353C8D32C');
        $this->addSql('ALTER TABLE detalle_orden_compra DROP FOREIGN KEY FK_BF1A3A2553C8D32C');
        $this->addSql('ALTER TABLE detalle_orden_pedido DROP FOREIGN KEY FK_E5371D1453C8D32C');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9353C8D32C');
        $this->addSql('ALTER TABLE orden_compra DROP FOREIGN KEY FK_765A054E53C8D32C');
        $this->addSql('ALTER TABLE orden_pedido DROP FOREIGN KEY FK_2C77227F53C8D32C');
        $this->addSql('ALTER TABLE parametro DROP FOREIGN KEY FK_4C12795F53C8D32C');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB061553C8D32C');
        $this->addSql('ALTER TABLE proveedor DROP FOREIGN KEY FK_16C068CE53C8D32C');
        $this->addSql('ALTER TABLE trabajador DROP FOREIGN KEY FK_42157CDF53C8D32C');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D53C8D32C');
        $this->addSql('ALTER TABLE usuario_usuario_rol DROP FOREIGN KEY FK_4AC6232ADB38439E');
        $this->addSql('ALTER TABLE usuario_rol DROP FOREIGN KEY FK_72EDD1A453C8D32C');
        $this->addSql('ALTER TABLE usuario_permiso_usuario_rol DROP FOREIGN KEY FK_B45A84629FDFE795');
        $this->addSql('ALTER TABLE usuario_usuario_rol DROP FOREIGN KEY FK_4AC6232AFEA85A65');
        $this->addSql('ALTER TABLE usuario_permiso_usuario_rol DROP FOREIGN KEY FK_B45A8462FEA85A65');
        $this->addSql('DROP TABLE almacen');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE config');
        $this->addSql('DROP TABLE config_config_menu_menus');
        $this->addSql('DROP TABLE config_menu');
        $this->addSql('DROP TABLE despacho');
        $this->addSql('DROP TABLE despacho_producto');
        $this->addSql('DROP TABLE detalle_orden_compra');
        $this->addSql('DROP TABLE detalle_orden_pedido');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE orden_compra');
        $this->addSql('DROP TABLE orden_pedido');
        $this->addSql('DROP TABLE parametro');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE proveedor');
        $this->addSql('DROP TABLE trabajador');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_usuario_rol');
        $this->addSql('DROP TABLE usuario_permiso');
        $this->addSql('DROP TABLE usuario_permiso_usuario_rol');
        $this->addSql('DROP TABLE usuario_rol');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
