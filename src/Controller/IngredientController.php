<?php

namespace App\Controller;

use App\Repository\IngrediantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends AbstractController
{
    #[Route('/', name: 'app_ingredient')]
    public function index(IngrediantRepository $repository): Response
    {
        $ingredient = $repository->findAll();
        return $this->render('pages/ingredient/index.html.twig', [
            'Ingredient'=>$ingredient
        ]);
    }
}
