<?php

namespace App\Controller;

use App\Entity\Builder;
use App\Form\BuilderType;
use App\Repository\BuilderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/builder')]
final class BuilderController extends AbstractController
{
    #[Route(name: 'app_builder_index', methods: ['GET'])]
    public function index(BuilderRepository $builderRepository): Response
    {
        return $this->render('builder/index.html.twig', [
            'builders' => $builderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_builder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $builder = new Builder();
        $form = $this->createForm(BuilderType::class, $builder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($builder);
            $entityManager->flush();

            return $this->redirectToRoute('app_builder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('builder/new.html.twig', [
            'builder' => $builder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_builder_show', methods: ['GET'])]
    public function show(Builder $builder): Response
    {
        return $this->render('builder/show.html.twig', [
            'builder' => $builder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_builder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Builder $builder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BuilderType::class, $builder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_builder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('builder/edit.html.twig', [
            'builder' => $builder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_builder_delete', methods: ['POST'])]
    public function delete(Request $request, Builder $builder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$builder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($builder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_builder_index', [], Response::HTTP_SEE_OTHER);
    }
}
