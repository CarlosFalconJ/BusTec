<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423181932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aluno (id INT AUTO_INCREMENT NOT NULL, id_onibus INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_contato VARCHAR(255) NOT NULL, ra VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, numero_casa VARCHAR(255) NOT NULL, INDEX IDX_67C97100DE6C6A1F (id_onibus), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE onibus (id INT AUTO_INCREMENT NOT NULL, placa VARCHAR(255) NOT NULL, motorista_responsavel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ponto (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, ponto_referencia VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rota (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rota_onibus (id INT AUTO_INCREMENT NOT NULL, id_rota INT DEFAULT NULL, id_onibus INT DEFAULT NULL, INDEX IDX_C02FD0D0593FCA28 (id_rota), INDEX IDX_C02FD0D0DE6C6A1F (id_onibus), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rota_ponto (id INT AUTO_INCREMENT NOT NULL, id_rota INT DEFAULT NULL, id_ponto INT DEFAULT NULL, horario DATETIME NOT NULL, INDEX IDX_246F3034593FCA28 (id_rota), INDEX IDX_246F3034662797A6 (id_ponto), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aluno ADD CONSTRAINT FK_67C97100DE6C6A1F FOREIGN KEY (id_onibus) REFERENCES onibus (id)');
        $this->addSql('ALTER TABLE rota_onibus ADD CONSTRAINT FK_C02FD0D0593FCA28 FOREIGN KEY (id_rota) REFERENCES rota (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rota_onibus ADD CONSTRAINT FK_C02FD0D0DE6C6A1F FOREIGN KEY (id_onibus) REFERENCES onibus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rota_ponto ADD CONSTRAINT FK_246F3034593FCA28 FOREIGN KEY (id_rota) REFERENCES rota (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rota_ponto ADD CONSTRAINT FK_246F3034662797A6 FOREIGN KEY (id_ponto) REFERENCES ponto (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aluno DROP FOREIGN KEY FK_67C97100DE6C6A1F');
        $this->addSql('ALTER TABLE rota_onibus DROP FOREIGN KEY FK_C02FD0D0DE6C6A1F');
        $this->addSql('ALTER TABLE rota_ponto DROP FOREIGN KEY FK_246F3034662797A6');
        $this->addSql('ALTER TABLE rota_onibus DROP FOREIGN KEY FK_C02FD0D0593FCA28');
        $this->addSql('ALTER TABLE rota_ponto DROP FOREIGN KEY FK_246F3034593FCA28');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('DROP TABLE onibus');
        $this->addSql('DROP TABLE ponto');
        $this->addSql('DROP TABLE rota');
        $this->addSql('DROP TABLE rota_onibus');
        $this->addSql('DROP TABLE rota_ponto');
    }
}
