<?php


namespace App\Controller\BustecAdm;



use App\Repository\AlunoRepository;
use App\Repository\OnibusRepository;
use App\Repository\PontoRepository;
use App\Repository\RotaRepository;
use App\Security\JwtAutenticador;
use App\Service\home\FormHomeService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Cookie;
use http\Env\Response;
use http\Header;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Twig\Token;


class HomeRender extends AbstractController
{

    private $onibusRepository;

    private $em;

    private $alunoRepository;

    private $rotaRepository;
    /**
     * @var PontoRepository
     */
    private $pontoRepository;

    public function __construct(EntityManagerInterface $em, OnibusRepository $onibusRepository, AlunoRepository $alunoRepository, RotaRepository $rotaRepository, PontoRepository $pontoRepository)
    {
        $this->em = $em;
        $this->onibusRepository = $onibusRepository;
        $this->alunoRepository = $alunoRepository;
        $this->rotaRepository = $rotaRepository;
        $this->pontoRepository = $pontoRepository;
    }

    public function buscaTotais(Request $request)
    {


       $homeService = New FormHomeService($this->em);
       $totalOnibus = $homeService->buscaTotalOnibus($this->onibusRepository);
       $totalAlunos = $homeService->buscaTotalAlunos($this->alunoRepository);
       $totalRotas  = $homeService->buscaTotalRotas($this->rotaRepository);
       $totalPontos = $homeService->buscaTotalPontos($this->pontoRepository);


        return $this->render('Home\home.html.twig',['totalOnibus' => $totalOnibus, 'totalAlunos' => $totalAlunos, 'totalRotas' => $totalRotas, 'totalPontos' => $totalPontos]);
    }


}