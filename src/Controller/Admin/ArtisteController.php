<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController
{
    #[Route('/admin/artiste', name: 'app_admin_artiste')]
    public function index(ArtisteRepository $artisteRepository): Response
    {

        $artistes = $artisteRepository->findAll();

        return $this->render('admin/artiste/artiste.html.twig', [
            "artistes" => $artistes,
        ]);

    }


    #[Route('/admin/artiste/supprimer/{id}', name: 'app_admin_artiste_supprimer', requirements: ['id' => '\d+'])]
    public function supprimer(ArtisteRepository $artisteRepository, Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {


        $artiste = $artisteRepository->find($id);
        if ($artiste) {
        $entityManager->remove($artiste);
        $entityManager->flush();
        $this->addFlash('success', 'L\'artiste a bien été supprimé');
        } else {
        $this->addFlash('danger', 'L\'artiste n\'existe pas');
        }
        return $this->redirectToRoute('app_admin_artiste');
    }

    #[Route('/admin/artiste/ajouter', name: 'app_admin_artiste_ajouter')]
    #[Route('/admin/artiste/modifier/{id}', name: 'app_admin_artiste_modifier', requirements: ['id' => '\d+'])]
    public function editer(ArtisteRepository $artisteRepository, Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {
        if ($request->attributes->get('_route') == 'app_admin_artiste_ajouter') {
            $artiste = new Artiste();

        } else {
            $artiste = $artisteRepository->find($id);
        }
        $form = $this->createForm(artisteType::class, $artiste);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artiste = $form->getData();
            $entityManager->persist($artiste);
            $entityManager->flush();
            if ($request->attributes->get('_route') == 'app_admin_artiste_ajouter') {
                $this->addFlash(
                    'success',
                    'artiste ajouté avec succès'
                );
            } else {
                $this->addFlash(
                    'success',
                    'artiste modifié avec succès'
                );
            }
            return $this->redirectToRoute('app_admin_artiste');
        }
        return $this->render('admin/artiste/editerArtiste.html.twig', [
            'controller_name' => 'ArtisteController',
            'formulaireArtiste' => $form->createView(),
        ]);
    }

}



