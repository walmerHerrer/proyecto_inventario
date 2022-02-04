<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204172542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orden_compra ADD num_factura VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE orden_pedido CHANGE almacen_id almacen_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orden_compra DROP num_factura');
        $this->addSql('ALTER TABLE orden_pedido CHANGE almacen_id almacen_id INT DEFAULT NULL');
    }
}
