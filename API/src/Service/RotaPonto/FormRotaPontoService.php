<?php


namespace App\Service\RotaPonto;


use App\Entity\Onibus;
use App\Entity\Ponto;
use App\Entity\Rota;
use App\Entity\RotaPonto;
use App\Helper\ExtratorDadosDoRequest;
use App\Service\RotaPonto\RotaPontoStorage\FormRotaPontoStorage;
use App\Service\RotaPonto\Validation\RotaPontoValidation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormRotaPontoService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function addRotaPontoATabela($id_rota, $id_ponto,$dadosEmJson)
    {
        $formRotaStorage = new FormRotaPontoStorage($this->em);

        $add_rota_ponto = $this->addRotaPonto($id_rota, $id_ponto,$dadosEmJson);

        $rota_ponto = new RegraCadastrarRotaPonto();
        $rota_ponto->setRotaPontoStorage($formRotaStorage);
        $rotaPontoInfo = $rota_ponto->cadastrar($add_rota_ponto);


        return $rotaPontoInfo;

    }

    public function addRotaPonto($id_rota, $id_ponto,$dadosEmJson)
    {
        $rotaValid   = $this->getRota($id_rota);
        $pontoValid = $this->getPonto($id_ponto);

        if ($rotaValid && $pontoValid){
            $rota   = $this->em->getReference(Rota::class, $id_rota);
            $ponto = $this->em->getReference(Ponto::class, $id_ponto);


            $horario = new \DateTime($dadosEmJson->horario);
            $rota_ponto = new RotaPonto();
            $rota_ponto->setRota($rota);
            $rota_ponto->setPonto($ponto);
            $rota_ponto->setHorario($horario);
        }else {
            throw new \Exception('Rota ou Ponto invalido(s)', Response::HTTP_BAD_REQUEST);
        }
        return $rota_ponto;
    }

    public function excluirRotaPonto($id)
    {
        $rota_ponto = $this->getRotaPonto($id);
        $rota_ponto_Existe = !is_null($rota_ponto);
        $rota_ponto_info = null;


        if (!$rota_ponto_Existe){
            return new \Exception("Esse v??nculo n??o existe", Response::HTTP_NOT_FOUND);
        } else {

            $formRotaPontoStorage = new FormRotaPontoStorage($this->em);
            $rota_ponto_storage = new RegraApagarRotaPonto($formRotaPontoStorage);
            $rota_ponto_info = $rota_ponto_storage->apagar($rota_ponto);
        }
        return $rota_ponto_info;
    }

    public function atualizarRotaPonto($dadosEmJson, $id, $id_rota,$id_ponto)
    {
        $rota_ponto_Valid = $this->getRotaPonto($id);
        $rotaValid   = $this->getRota($id_rota);
        $pontoValid = $this->getPonto($id_ponto);

        $rotaPontoInfo = null;

        if ($rota_ponto_Valid && $rotaValid && $pontoValid){

            $rota   = $this->em->getReference(Rota::class, $id_rota);
            $ponto = $this->em->getReference(Ponto::class, $id_ponto);
            $rota_ponto = $this->em->getReference(RotaPonto::class, $id);


            $horario = new \DateTime($dadosEmJson->horario);
            $rota_ponto->setRota($rota);
            $rota_ponto->setPonto($ponto);
            $rota_ponto->setHorario($horario);
        } else {
            return new \Exception("O vinculo ou os dados n??o conferem", Response::HTTP_NOT_FOUND);
        }

        $formRotaStorage = new FormRotaPontoStorage($this->em);
        $rota_ponto_regra = new RegraAtualizarRotaPonto();
        $rota_ponto_regra->setRotaPontoStorage($formRotaStorage);
        $rotaPontoInfo = $rota_ponto_regra->atualizar($rota_ponto);

        return $rotaPontoInfo;
    }

    public function buscaUmVinculo($id)
    {
        $formRotaPontoStorage = new FormRotaPontoStorage($this->em);
        $vinculo = $formRotaPontoStorage->getVinculoPorID($id);

        return $vinculo;
    }


    public function getOnibus($id)
    {
        $id = isset($id) ? $id : 0;

        $onibusRepository = $this->em->getRepository(Onibus::class);
        $onibus = $onibusRepository->find($id);

        return $onibus;
    }

    public function getRota($id)
    {
        $id = isset($id) ? $id : 0;

        $rotaRepository = $this->em->getRepository(Rota::class);
        $rota = $rotaRepository->find($id);

        return $rota;
    }

    public function getPonto($id)
    {
        $id = isset($id) ? $id : 0;

        $pontoRepository = $this->em->getRepository(Ponto::class);
        $ponto = $pontoRepository->find($id);

        return $ponto;
    }

    public function getRotaPonto($id)
    {
        $id = isset($id) ? $id : 0;

        $rotaPontoRepository = $this->em->getRepository(RotaPonto::class);
        $rota_ponto = $rotaPontoRepository->find($id);

        return $rota_ponto;
    }

}