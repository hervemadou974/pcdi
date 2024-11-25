<?php

namespace App\Controller;

use App\Repository\OrdinateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(OrdinateurRepository $ordinateurRepository): Response
    {
        // Récupérer le nombre total d'ordinateurs
        $totalOrdinateurs = $ordinateurRepository->count([]);

        // Récupérer le nombre d'ordinateurs disponibles
        $ordinateursDisponibles = $ordinateurRepository->count(['isAvailable' => true]);

        return $this->render('home/index.html.twig', [
            'totalOrdinateurs' => $totalOrdinateurs,
            'ordinateursDisponibles' => $ordinateursDisponibles,
        ]);
    }
}
