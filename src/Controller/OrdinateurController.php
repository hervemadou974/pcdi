<?php

namespace App\Controller;

use App\Entity\Ordinateur;
use App\Form\OrdinateurType;
use App\Repository\OrdinateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ordinateur')]
final class OrdinateurController extends AbstractController
{
    #[Route(name: 'app_ordinateur_index', methods: ['GET'])]
    public function index(OrdinateurRepository $ordinateurRepository): Response
    {
        return $this->render('ordinateur/index.html.twig', [
            'ordinateurs' => $ordinateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ordinateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ordinateur = new Ordinateur();
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ordinateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_ordinateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordinateur/new.html.twig', [
            'ordinateur' => $ordinateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ordinateur_show', methods: ['GET'])]
    public function show(Ordinateur $ordinateur): Response
    {
        return $this->render('ordinateur/show.html.twig', [
            'ordinateur' => $ordinateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ordinateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ordinateur $ordinateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ordinateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordinateur/edit.html.twig', [
            'ordinateur' => $ordinateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ordinateur_delete', methods: ['POST'])]
    public function delete(Request $request, Ordinateur $ordinateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordinateur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ordinateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ordinateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
