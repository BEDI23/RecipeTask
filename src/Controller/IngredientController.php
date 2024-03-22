<?php

namespace App\Controller;

use App\Entity\Ingrediant;
use App\Form\IngredientType;
use App\Repository\IngrediantRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends AbstractController
{
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function index(IngrediantRepository $repository, PaginatorInterface $paginator ,Request $request): Response
    {
        $ingredient = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('pages/ingredient/index.html.twig', [
            'Ingredient'=>$ingredient
        ]);
    }
    #[Route('/', name: 'new',methods: ['GET','POST'])]
    public function new() : Response
    {
        $ingredient = new Ingrediant();
        $form = $this->createForm(IngredientType::class, $ingredient);
        return $this->render('pages/ingredient/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
















