<?php

namespace App\Controller\Admin;

use App\Entity\Festival;
use App\Form\FestivalType;
use App\Repository\FestivalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class FestivalController extends AbstractController
{
    #[Route('/admin/festival', name: 'app_admin_festival')]
    public function index(FestivalRepository $festivalRepository): Response
    {

        $festivals = $festivalRepository->findAll();
        return $this->render('admin/festival/festival.html.twig', [
            "festivals" => $festivals,
        ]);

    }


    #[Route('/admin/festival/supprimer/{id}', name: 'app_admin_festival_supprimer', requirements: ['id' => '\d+'])]
    public function supprimer(FestivalRepository $festivalRepository, Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {


        $festival = $festivalRepository->find($id);


       if ($festival) {
        $entityManager->remove($festival);
        $entityManager->flush();
        $this->addFlash('success', 'Le bien a bien été supprimé');
        } else {
        $this->addFlash('danger', 'Le bien n\'existe pas');
        }
        return $this->redirectToRoute('app_admin_festival');
    }

    #[Route('/admin/festival/ajouter', name: 'app_admin_festival_ajouter')]
    #[Route('/admin/festival/modifier/{id}', name: 'app_admin_festival_modifier', requirements: ['id' => '\d+'])]
    public function editer(FestivalRepository $festivalRepository, SluggerInterface $slugger, Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {
        if ($request->attributes->get('_route') == 'app_admin_festival_ajouter') {
            $festival = new Festival();

        } else {
            $festival = $festivalRepository->find($id);
        }
        $form = $this->createForm(FestivalType::class, $festival);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('photo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $festival->setPhoto($newFilename);
            }
            $festival = $form->getData();
            $entityManager->persist($festival);
            $entityManager->flush();
            if ($request->attributes->get('_route') == 'app_admin_festival_ajouter') {
                $this->addFlash(
                    'success',
                    'festival ajouté avec succès'
                );
            } else {
                $this->addFlash(
                    'success',
                    'festival modifié avec succès'
                );
            }
            return $this->redirectToRoute('app_admin_festival');
        }
        return $this->render('admin/festival/editerFestival.html.twig', [
            'controller_name' => 'FestivalController',
            'formulaireFestival' => $form->createView(),
        ]);
    }

}



