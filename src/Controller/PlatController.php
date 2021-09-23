<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\CategoriePlatRepository;
use App\Services\HandleImage;
use App\Repository\PlatRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/plat')]
class PlatController extends AbstractController
{
    #[Route('/', name: 'plat_index', methods: ['GET'])]
    public function index(PlatRepository $platRepository, CategoriePlatRepository $categorieRepository): Response
    {
        return $this->render('plat/index.html.twig', [
            //'plats' => $platRepository->findAll(),
            'categoriesPlats' => $categorieRepository->findAll(),
        ]);
    }

    

    #[Route('/new', name: 'plat_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN', message:'Réservé aux administrateurs')]
    public function new(Request $request, HandleImage $handleImage): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile=$form->get('image_file')->getData();

            if($imageFile){
            //     $originalFileName=pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            //     $safeFileName=$slugger->slug($originalFileName);
            //     $slugFileName=$safeFileName.'-'.uniqid().'.'.$imageFile->guessExtention();
                $handleImage->saveImage($imageFile, $plat);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plat/new.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'plat_show', methods: ['GET'])]
    public function show(Plat $plat): Response
    {
        return $this->render('plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    #[Route('/{id}/edit', name: 'plat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plat $plat, HandleImage $handleImage): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);


        $vintageImage=$plat->getImage();

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image_upload')->getData(); 

            if($imageFile)
            {
                $handleImage->editImage($imageFile, $plat, $vintageImage); 

            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'plat_delete', methods: ['POST'])]
    public function delete(Request $request, Plat $plat, HandleImage $handleImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $vintageImage = $plat->getImage();
            $handleImage->deleteImage($vintageImage);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
