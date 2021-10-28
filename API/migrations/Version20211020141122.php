<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020141122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aluno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_onibus INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_contato VARCHAR(255) NOT NULL, ra VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, numero_casa VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67C97100DE6C6A1F ON aluno (id_onibus)');
        $this->addSql('CREATE TABLE login_acess_token (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user INTEGER DEFAULT NULL, token VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FF1B8FFD6B3CA4B ON login_acess_token (id_user)');
        $this->addSql('CREATE TABLE onibus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, placa VARCHAR(255) NOT NULL, motorista_responsavel VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ponto (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, ponto_referencia VARCHAR(255) NOT NULL, numero INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE pontos_favoritos_mobile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_ponto INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_134F9C47662797A6 ON pontos_favoritos_mobile (id_ponto)');
        $this->addSql('CREATE TABLE rota (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE rota_onibus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_rota INTEGER DEFAULT NULL, id_onibus INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_C02FD0D0593FCA28 ON rota_onibus (id_rota)');
        $this->addSql('CREATE INDEX IDX_C02FD0D0DE6C6A1F ON rota_onibus (id_onibus)');
        $this->addSql('CREATE TABLE rota_ponto (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_rota INTEGER DEFAULT NULL, id_ponto INTEGER DEFAULT NULL, horario DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_246F3034593FCA28 ON rota_ponto (id_rota)');
        $this->addSql('CREATE INDEX IDX_246F3034662797A6 ON rota_ponto (id_ponto)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE TABLE user_mobile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_592138DDF85E0677 ON user_mobile (username)');
        $this->addSql('CREATE TABLE usuario_pontos_favoritos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_ponto_favorito INTEGER DEFAULT NULL, id_user INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_94C8F133C09C8F7C ON usuario_pontos_favoritos (id_ponto_favorito)');
        $this->addSql('CREATE INDEX IDX_94C8F1336B3CA4B ON usuario_pontos_favoritos (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE aluno');
        $this->addSql('DROP TABLE login_acess_token');
        $this->addSql('DROP TABLE onibus');
        $this->addSql('DROP TABLE ponto');
        $this->addSql('DROP TABLE pontos_favoritos_mobile');
        $this->addSql('DROP TABLE rota');
        $this->addSql('DROP TABLE rota_onibus');
        $this->addSql('DROP TABLE rota_ponto');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_mobile');
        $this->addSql('DROP TABLE usuario_pontos_favoritos');
    }
}
