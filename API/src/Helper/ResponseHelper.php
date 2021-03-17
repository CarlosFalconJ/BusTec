<?php


namespace App\Helper;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    protected $sucesso;

    protected $conteudoResposta;

    protected $statusResposta;

    protected $paginaAtual;

    protected $itemPorPagina;

    protected $qtdContatos;

    public function __construct(bool $sucesso,$conteudoResposta,int $statusResposta = Response::HTTP_OK,int $qtdContatos = null, int $paginaAtual = null, int $itemPorPagina = null)
    {
        $this->sucesso = $sucesso;
        $this->conteudoResposta = $conteudoResposta;
        $this->statusResposta = $statusResposta;
        $this->paginaAtual = $paginaAtual;
        $this->itemPorPagina = $itemPorPagina;
        $this->qtdContatos = $qtdContatos;
    }

    public function getResponse(): JsonResponse
    {
        $conteudoResposta = [
            "sucesso" => $this->sucesso,
            "paginaAtual" => $this->paginaAtual,
            "itensPorPagina" => $this->itemPorPagina,
            "quandidaDeContatos" =>$this->qtdContatos,
            "conteudoResposta" => $this->conteudoResposta,
        ];
        if(is_null($this->paginaAtual)){
            unset($conteudoResposta['paginaAtual']);
            unset($conteudoResposta['iTensPorPagina']);
        }

        return new JsonResponse ($conteudoResposta,$this->statusResposta);
    }
    public static function Erro(\Throwable $erro)
    {
        return new self(false, ['mensagem' => $erro->getMessage()]);
    }
}