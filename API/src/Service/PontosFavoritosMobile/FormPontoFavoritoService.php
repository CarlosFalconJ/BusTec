<?php


namespace App\Service\PontosFavoritosMobile;


use App\Entity\Ponto;
use App\Entity\PontosFavoritosMobile;
use App\Entity\UserMobile;
use App\Helper\ExtratorDadosDoRequest;
use App\Service\PontosFavoritosMobile\Storage\FormPontoFavoritoStorage;
use App\Service\PontosFavoritosMobile\Validation\PontoFavoritoValidation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormPontoFavoritoService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function cadastrar($dadosEmJSon,  $id_ponto)
    {
        $formPontoFavoritoStorage = new FormPontoFavoritoStorage($this->em);

        $add_ponto_favorito = $this->addUsuarioPontoFavorito($dadosEmJSon, $id_ponto);


        $user = new RegraCadastrarPontoFavorito();
        $user->setPontoFavoritoStorage($formPontoFavoritoStorage);
        $userInfo = $user->cadastrar($add_ponto_favorito);


        return $userInfo;

    }
    public function addUsuarioPontoFavorito($dadosEmJSon, $id_ponto)
    {
        $pontoValid = $this->getPonto($id_ponto);

        if ($pontoValid){
            $ponto = $this->em->getReference(Ponto::class, $id_ponto);

            $ponto_favorito = new PontosFavoritosMobile();
            $ponto_favorito->setNome($dadosEmJSon->nome);
            $ponto_favorito->setPonto($ponto);

        }else {
            throw new \Exception('Ponto invalido(s)', Response::HTTP_BAD_REQUEST);
        }
        return $ponto_favorito;
    }

    public function busca($id_user)
    {
        $formRotaStorage = new FormPontoFavoritoStorage($this->em);

        $ponto_favorito = $formRotaStorage->getPontoFavorito($id_user);

        return $ponto_favorito;
    }
    public function getPonto($id)
    {
        $id = isset($id) ? $id : 0;

        $pontoRepository = $this->em->getRepository(Ponto::class);
        $ponto = $pontoRepository->find($id);

        return $ponto;
    }
}