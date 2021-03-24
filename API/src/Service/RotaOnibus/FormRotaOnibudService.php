<?php


namespace App\Service\RotaOnibus;


use App\Entity\Onibus;
use App\Entity\Rota;
use App\Entity\RotaOnibus;
use App\Helper\ExtratorDadosDoRequest;
use App\Service\Rota\ParserRota;
use App\Service\Rota\Storage\FormRotaStorage;
use App\Service\Rota\Validation\RotaValidation;
use App\Service\RotaOnibus\RotaOnibusStorage\FormRotaOnibusStorage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormRotaOnibudService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function addRotaOnibusATabela($id_rota, $id_onibus)
    {
        $formRotaStorage = new FormRotaOnibusStorage($this->em);


        $add_rota_onibus = $this->addRotaOnibus($id_rota, $id_onibus);

        $rota_onibus = new RegraCadastrarRotaOnibus();
        $rota_onibus->setRotaStorage($formRotaStorage);
        $rotaOnibusInfo = $rota_onibus->cadastrar($add_rota_onibus);


        return$rotaOnibusInfo;

    }

    public function addRotaOnibus($id_rota, $id_onibus)
    {
        $rotaValid   = $this->getRota($id_rota);
        $onibusValid = $this->getOnibus($id_onibus);

        if ($rotaValid && $onibusValid){
            $rota   = $this->em->getReference(Rota::class, $id_rota);
            $onibus = $this->em->getReference(Onibus::class, $id_onibus);

            $rota_onibus = new RotaOnibus();
            $rota_onibus->setRota($rota);
            $rota_onibus->setOnibus($onibus);
        }else {
        throw new \Exception('Rota ou o Onibus invalidos', Response::HTTP_BAD_REQUEST);
         }
        return $rota_onibus;
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


}