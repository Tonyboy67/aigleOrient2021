<?php

namespace App\Controller;

use App\Entity\CategoriePlat;
use App\Form\CategoriePlatType;
use App\Repository\CategoriePlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie/plat')]
class CategoriePlatController extends AbstractController
{
    #[Route('/', name: 'categorie_plat_index', methods: ['GET'])]
    public function index(CategoriePlatRepository $categoriePlatRepository): Response
    {
        return $this->render('categorie_plat/index.html.twig', [
            'categorie_plats' => $categoriePlatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'categorie_plat_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categoriePlat = new CategoriePlat();
        $form = $this->createForm(CategoriePlatType::class, $categoriePlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriePlat);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_plat/new.html.twig', [
            'categorie_plat' => $categoriePlat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'categorie_plat_show', methods: ['GET'])]
    public function show(CategoriePlat $categoriePlat): Response
    {
        return $this->render('categorie_plat/show.html.twig', [
            'categorie_plat' => $categoriePlat,
        ]);
    }

    #[Route('/{id}/edit', name: 'categorie_plat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoriePlat $categoriePlat): Response
    {
        $form = $this->createForm(CategoriePlatType::class, $categoriePlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_plat/edit.html.twig', [
            'categorie_plat' => $categoriePlat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'categorie_plat_delete', methods: ['POST'])]
    public function delete(Request $request, CategoriePlat $categoriePlat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriePlat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriePlat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
