<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318132413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rota_onibus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_rota INTEGER DEFAULT NULL, id_onibus INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_C02FD0D0593FCA28 ON rota_onibus (id_rota)');
        $this->addSql('CREATE INDEX IDX_C02FD0D0DE6C6A1F ON rota_onibus (id_onibus)');
        $this->addSql('DROP TABLE rotas_onibus');
        $this->addSql('DROP INDEX UNIQ_67C97100DE6C6A1F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__aluno AS SELECT id, id_onibus, nome, email, numero_contato, ra, bairro, rua, numero_casa FROM aluno');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('CREATE TABLE aluno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_onibus INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, numero_contato VARCHAR(255) NOT NULL COLLATE BINARY, ra VARCHAR(255) NOT NULL COLLATE BINARY, bairro VARCHAR(255) NOT NULL COLLATE BINARY, rua VARCHAR(255) NOT NULL COLLATE BINARY, numero_casa VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_67C97100DE6C6A1F FOREIGN KEY (id_onibus) REFERENCES onibus (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO aluno (id, id_onibus, nome, email, numero_contato, ra, bairro, rua, numero_casa) SELECT id, id_onibus, nome, email, numero_contato, ra, bairro, rua, numero_casa FROM __temp__aluno');
        $this->addSql('DROP TABLE __temp__aluno');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67C97100DE6C6A1F ON aluno (id_onibus)');
        $this->addSql('DROP INDEX IDX_F85BDFF259280FF1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__onibus AS SELECT id, placa, motorista_responsavel FROM onibus');
        $this->addSql('DROP TABLE onibus');
        $this->addSql('CREATE TABLE onibus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, placa VARCHAR(255) NOT NULL COLLATE BINARY, motorista_responsavel VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO onibus (id, placa, motorista_responsavel) SELECT id, placa, motorista_responsavel FROM __temp__onibus');
        $this->addSql('DROP TABLE __temp__onibus');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rota AS SELECT id, nome, cidade FROM rota');
        $this->addSql('DROP TABLE rota');
        $this->addSql('CREATE TABLE rota (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL COLLATE BINARY, cidade VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO rota (id, nome, cidade) SELECT id, nome, cidade FROM __temp__rota');
        $this->addSql('DROP TABLE __temp__rota');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rotas_onibus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('DROP TABLE rota_onibus');
        $this->addSql('DROP INDEX UNIQ_67C97100DE6C6A1F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__aluno AS SELECT id, id_onibus, nome, email, numero_contato, ra, bairro, rua, numero_casa FROM aluno');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('CREATE TABLE aluno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_onibus INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_contato VARCHAR(255) NOT NULL, ra VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, numero_casa VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO aluno (id, id_onibus, nome, email, numero_contato, ra, bairro, rua, numero_casa) SELECT id, id_onibus, nome, email, numero_contato, ra, bairro, rua, numero_casa FROM __temp__aluno');
        $this->addSql('DROP TABLE __temp__aluno');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67C97100DE6C6A1F ON aluno (id_onibus)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__onibus AS SELECT id, placa, motorista_responsavel FROM onibus');
        $this->addSql('DROP TABLE onibus');
        $this->addSql('CREATE TABLE onibus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, placa VARCHAR(255) NOT NULL, motorista_responsavel VARCHAR(255) NOT NULL, id_rotas_onibus INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO onibus (id, placa, motorista_responsavel) SELECT id, placa, motorista_responsavel FROM __temp__onibus');
        $this->addSql('DROP TABLE __temp__onibus');
        $this->addSql('CREATE INDEX IDX_F85BDFF259280FF1 ON onibus (id_rotas_onibus)');
        $this->addSql('ALTER TABLE rota ADD COLUMN horario DATE NOT NULL');
    }
}
