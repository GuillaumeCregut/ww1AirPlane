<?php

namespace App\Controller;

use App\Entity\Aircraft;
use App\Form\AircraftType;
use App\Repository\AircraftRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/aircraft', name: "app_aircraft_")]
final class AircraftController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(AircraftRepository $aircraftRepository): Response
    {
        return $this->render('aircraft/index.html.twig', [
            'aircraft' => $aircraftRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        #[Autowire('%kernel.project_dir%/public/uploads')] string $fileDirectory
    ): Response {
        $aircraft = new Aircraft();
        $form = $this->createForm(AircraftType::class, $aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $picture */
            $picture = $form->get('picture')->getData();
            if ($picture) {
                $fileName = uniqid() . '.' . $picture->guessExtension();
                try {
                    $picture->move($fileDirectory, $fileName);
                    $aircraft->setPicture($fileName);
                } catch (FileException $e) {
                    dd('erreur ici', $fileName);
                }
            }
            $nbWings = $picture = $form->get('nbWings')->getData();
            $nbSeats = $form->get('nbSeats')->getData();
            $aircraft->setNbWings($nbWings);
            $aircraft->setNbSeats($nbSeats);
            $entityManager->persist($aircraft);
            $entityManager->flush();
            return $this->redirectToRoute('app_aircraft_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aircraft/new.html.twig', [
            'aircraft' => $aircraft,
            'form' => $form,
        ]);
    }
    #[Route('/show/{id}', name: 'show')]
    public function show(Aircraft $aircraft): Response
    {
        return $this->render('aircraft/show.html.twig', [
            'aircraft' => $aircraft,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Aircraft $aircraft,
        #[Autowire('%kernel.project_dir%/public/uploads')] string $fileDirectory,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(AircraftType::class, $aircraft);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $picture */
            $picture = $form->get('picture')->getData();
            if ($picture) {
                if ((null === $aircraft->getPicture()) || ('' === $aircraft->getPicture())) {
                    $fileName = uniqid() . '.' . $picture->guessExtension();
                } else {
                    $fileName = $aircraft->getPicture();
                }
                try {
                    $aircraft->setPicture($fileName);
                    $picture->move($fileDirectory, $fileName);
                } catch (FileException $e) {
                    dd('erreur ici', $fileName);
                }
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_aircraft_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aircraft/edit.html.twig', [
            'aircraft' => $aircraft,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Aircraft $aircraft, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $aircraft->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($aircraft);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_aircraft_index', [], Response::HTTP_SEE_OTHER);
    }
}
