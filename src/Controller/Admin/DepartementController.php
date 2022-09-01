<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    #[Route('/admin/departement', name: 'app_admin_departement')]
    public function index(DepartementRepository $departementRepository): Response
    {

        $departements = $departementRepository->findAll();

        return $this->render('admin/departement/departement.html.twig', [
            "departements" => $departements,
        ]);

    }


    #[Route('/admin/departement/supprimer/{id}', name: 'app_admin_departement_supprimer', requirements: ['id' => '\d+'])]
    public function supprimer(DepartementRepository $departementRepository, Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {


        $departement = $departementRepository->find($id);

        if ($departement) {
        $entityManager->remove($departement);
        $entityManager->flush();
        $this->addFlash('success', 'Le departement a bien été supprimé');
        } else {
        $this->addFlash('danger', 'Le departement n\'existe pas');
        }
        return $this->redirectToRoute('app_admin_departement');
    }

    #[Route('/admin/departement/ajouter', name: 'app_admin_departement_ajouter')]
    #[Route('/admin/departement/modifier/{id}', name: 'app_admin_departement_modifier', requirements: ['id' => '\d+'])]
    public function editer(DepartementRepository $departementRepository, Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {
        if ($request->attributes->get('_route') == 'app_admin_departement_ajouter') {
            $departement = new departement();

        } else {
            $departement = $departementRepository->find($id);
        }
        $form = $this->createForm(DepartementType::class, $departement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $departement = $form->getData();
            $entityManager->persist($departement);
            $entityManager->flush();
            if ($request->attributes->get('_route') == 'app_admin_departement_ajouter') {
                $this->addFlash(
                    'success',
                    'departement ajouté avec succès'
                );
            } else {
                $this->addFlash(
                    'success',
                    'departement modifié avec succès'
                );
            }
            return $this->redirectToRoute('app_admin_departement');
        }
        return $this->render('admin/departement/editerDepartement.html.twig', [
            'controller_name' => 'departementController',
            'formulaireDepartement' => $form->createView(),
        ]);
    }

}

