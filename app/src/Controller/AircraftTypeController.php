<?php

namespace App\Controller;

use App\Entity\AircraftType;
use App\Form\AircraftTypeType;
use App\Repository\AircraftTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/aircraft/type', name: 'app_aircraft_type_')]
final class AircraftTypeController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(AircraftTypeRepository $aircraftTypeRepository): Response
    {
        return $this->render('aircraft_type/index.html.twig', [
            'aircraft_types' => $aircraftTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aircraftType = new AircraftType();
        $form = $this->createForm(AircraftTypeType::class, $aircraftType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aircraftType);
            $entityManager->flush();

            return $this->redirectToRoute('app_aircraft_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aircraft_type/new.html.twig', [
            'aircraft_type' => $aircraftType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AircraftType $aircraftType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AircraftTypeType::class, $aircraftType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_aircraft_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aircraft_type/edit.html.twig', [
            'aircraft_type' => $aircraftType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, AircraftType $aircraftType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aircraftType->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($aircraftType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_aircraft_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
