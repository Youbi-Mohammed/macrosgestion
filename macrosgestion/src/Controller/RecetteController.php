<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/Recette')]
final class RecetteController extends AbstractController
{
    #[Route(name: 'app_recette_index', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('app_recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recette/new.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recette_show', methods: ['GET'])]
    public function show(Recette $recette): Response
    {
        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recette/edit.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recette_delete', methods: ['POST'])]
    public function delete(Request $request, Recette $recette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recette_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/recette/ajouter', name: 'ajouter_recette')]
    public function ajouterRecette(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les ingrédients de la base pour afficher dans le formulaire
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        if ($request->isMethod('POST')) {
            // Récupérer les données du formulaire
            $titre = $request->request->get('titre');
            $instructions = $request->request->get('instructions');
            $selectedIngredientIds = $request->request->get('ingredients', []); // Tableau des IDs sélectionnés

            // Vérification des champs requis
            if (empty($titre) || empty($instructions)) {
                $this->addFlash('error', 'Le titre et les instructions sont obligatoires.');
                return $this->render('recette/ajouter.html.twig', [
                    'ingredients' => $ingredients,
                ]);
            }

            // Création de la recette
            $recette = new Recette();
            $recette->setTitre($titre);
            $recette->setInstructions($instructions);

            // Ajout des ingrédients sélectionnés
            foreach ($selectedIngredientIds as $ingredientId) {
                $ingredient = $entityManager->getRepository(Ingredient::class)->find($ingredientId);
                if ($ingredient) {
                    $recette->addIngredient($ingredient);
                }
            }

            // Sauvegarde de la recette
            $entityManager->persist($recette);
            $entityManager->flush();

            // Redirection ou message de confirmation
            $this->addFlash('success', 'La recette a été ajoutée avec succès.');

            return $this->redirectToRoute('ajouter_recette');
        }

        // Afficher le formulaire pour ajouter une recette
        return $this->render('add_recette.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    
}
