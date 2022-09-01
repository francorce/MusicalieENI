<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Repository\ArtisteRepository;
use App\Repository\DepartementRepository;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FestivalController extends AbstractController
{
    #[Route('/festival', name: 'app_festival')]
    public function index(FestivalRepository $festivalRepository, DepartementRepository $departementRepository): Response
    {
        $festivals = $festivalRepository->findAll();
        $departements = $departementRepository->findAll();
        return $this->render('festival/index.html.twig', [
            "festivals" => $festivals,
            "departements" => $departements,
        ]);
    }

    #[Route('/festival/detail/{id}', name: 'app_festival_detail', requirements: ['id' => '\d+'])]
    public function detail(FestivalRepository $festivalRepository, DepartementRepository $departementRepository, $id = null): Response
    {

        $departement = $departementRepository->find($id);
        $festivals = $festivalRepository->findAll();
        return $this->render('festival/detail.html.twig', [
            "departement" => $departement,
            "festivals" => $festivals,
        ]);
    }

    #[Route('/festival/detail/fest/{id}', name: 'app_festival_detail_fest', requirements: ['id' => '\d+'])]
    public function ez(FestivalRepository $festivalRepository, ArtisteRepository $artisteRepository, $id = null): Response
    {
        $festival = $festivalRepository->find($id);
        $artistes = $festivalRepository->findAll();
        return $this->render('festival/detailFest.html.twig', [
            "festival" => $festival,
            "artistes" => $artistes,
        ]);
    }
}

