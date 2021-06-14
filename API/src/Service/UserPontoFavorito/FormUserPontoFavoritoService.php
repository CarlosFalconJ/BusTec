<?php


namespace App\Service\UserPontoFavorito;


use App\Entity\Onibus;
use App\Entity\PontosFavoritosMobile;
use App\Entity\Rota;
use App\Entity\RotaOnibus;
use App\Entity\UserMobile;
use App\Entity\UsuarioPontosFavoritos;
use App\Helper\ExtratorDadosDoRequest;
use App\Service\RotaOnibus\RegraCadastrarRotaOnibus;
use App\Service\RotaOnibus\RotaOnibusStorage\FormRotaOnibusStorage;
use App\Service\UserPontoFavorito\UserPontoFavoritoStorage\FormUserPontoFavoritoStorage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormUserPontoFavoritoService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function insert($id_user, $id_ponto_favorito)
    {
        $formUserPontoStorage = new FormUserPontoFavoritoStorage($this->em);


        $add_user_ponto = $this->addUserPontoF($id_user, $id_ponto_favorito);

        $user_pontoF = new RegraCadastrarUserPontoFavorito();
        $user_pontoF->setRotaStorage($formUserPontoStorage);
        $user_pontoF_info = $user_pontoF->cadastrar($add_user_ponto);

        return $user_pontoF_info;
    }
    public function addUserPontoF($id_user, $id_ponto_favorito)
    {
        $userValid   = $this->getUser($id_user);
        $pontoFavoritoValid = $this->getPontoFavorito($id_ponto_favorito);

        if ($userValid && $pontoFavoritoValid){
            $user   = $this->em->getReference(UserMobile::class, $id_user);
            $ponto_favorito = $this->em->getReference(PontosFavoritosMobile::class, $id_ponto_favorito);

            $user_pontoF= new UsuarioPontosFavoritos();
            $user_pontoF->setUsuario($user);
            $user_pontoF->setPontoFavorito($ponto_favorito);
        }else {
            throw new \Exception('Usuario ou Rota Favorita não existem', Response::HTTP_BAD_REQUEST);
        }
        return $user_pontoF;
    }

    public function getUser($id)
    {
        $id = isset($id) ? $id : 0;

        $userRepository = $this->em->getRepository(UserMobile::class);
        $user = $userRepository->find($id);

        return $user;
    }

    public function getPontoFavorito($id)
    {
        $id = isset($id) ? $id : 0;

        $pontoFavoritoRepository = $this->em->getRepository(PontosFavoritosMobile::class);
        $ponto_favorito= $pontoFavoritoRepository->find($id);

        return $ponto_favorito;
    }

}