<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
final class HomeController extends AbstractController
{
    #[Route(name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/nouveau-plat', name: 'app_nouveau_plat', methods: ['GET'])]
    public function nouveauPlat(): Response
    {
        return $this->redirectToRoute('app_plats_new');
    }

    #[Route('/historique-plats', name: 'app_historique_plats', methods: ['GET'])]
    public function historiquePlats(): Response
    {
        return $this->redirectToRoute('app_plats_index');
    }

    #[Route('/mes-objectifs-personnel', name: 'app_mes_objectifs', methods: ['GET'])]
    public function mesObjectifs(): Response
    {
        return $this->redirectToRoute('app_utilisateur_index');
    }
    
    
}
