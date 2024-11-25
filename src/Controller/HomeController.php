<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\OrdinateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(
        OrdinateurRepository $ordinateurRepository,
        ReservationRepository $reservationRepository
    ): Response {
        // Nombre total d'ordinateurs
        $totalOrdinateurs = $ordinateurRepository->count([]);

        // Nombre d'ordinateurs disponibles
        $ordinateursDisponibles = $ordinateurRepository->count(['isAvailable' => true]);

        // Liste des réservations
        $reservations = $reservationRepository->findAll();

        return $this->render('home/index.html.twig', [
            'totalOrdinateurs' => $totalOrdinateurs,
            'ordinateursDisponibles' => $ordinateursDisponibles,
            'reservations' => $reservations,
        ]);
    }
}
