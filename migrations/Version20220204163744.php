<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204163744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orden_pedido ADD cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orden_pedido ADD CONSTRAINT FK_2C77227FDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_2C77227FDE734E51 ON orden_pedido (cliente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orden_pedido DROP FOREIGN KEY FK_2C77227FDE734E51');
        $this->addSql('DROP INDEX IDX_2C77227FDE734E51 ON orden_pedido');
        $this->addSql('ALTER TABLE orden_pedido DROP cliente_id');
    }
}
