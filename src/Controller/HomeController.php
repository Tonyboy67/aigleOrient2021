<?php
namespace App\Controller;  #voir dans composer.json autoload
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(Request $request) {
        return $this->redirectToRoute('plat_index', [], Response::HTTP_SEE_OTHER);
    }
}