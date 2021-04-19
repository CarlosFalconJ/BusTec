<?php


namespace App\Helper;


use Symfony\Component\HttpFoundation\Request;

class ExtratorDadosDoRequest
{
    public function buscadorDadosRequest(Request $request)
    {
        $allQuerys = $request->query->all();

        $infoOrdenacao = array_key_exists('sort', $allQuerys) ? $allQuerys['sort'] : null;
        unset($allQuerys['sort']);

        $paginaAtual = array_key_exists('page', $allQuerys) ? $allQuerys['page'] : 1;
        unset($allQuerys['page']);

        $itensPorPagina = array_key_exists('itensPorPagina', $allQuerys) ? $allQuerys['itensPorPagina'] : 10000;
        unset($allQuerys['itensPorPagina']);

        return [$infoOrdenacao, $allQuerys, $paginaAtual, $itensPorPagina];
    }

    public function buscadorDadosOrdenacao(Request $request)
    {
        [$infoOrdenacao, ] = $this->buscadorDadosRequest($request);

        return $infoOrdenacao;
    }

    public function bucadorDadosFiltro(Request $request)
    {
        [, $filtro] = $this->buscadorDadosRequest($request);

        return $filtro;
    }

    public function infoPaginacao(Request $request)
    {
        [, ,$paginaAtual,$itensPorPagina] = $this->buscadorDadosRequest($request);

        return [$paginaAtual, $itensPorPagina];
    }
}