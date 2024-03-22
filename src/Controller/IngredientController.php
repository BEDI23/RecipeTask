<?php

namespace App\Controller;

use App\Entity\Ingrediant;
use App\Form\IngredientType;
use App\Repository\IngrediantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
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
    #[Route('/new', name: 'new',methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $ingredient = new Ingrediant();
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();
            $manager->persist($ingredient);
            $manager->flush();
            $this->addFlash(
                'Success',
                'Votre ingredient a ete cree avec success !'
            );

            return $this->redirectToRoute('list');

        }

        return $this->render('pages/ingredient/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    #[Route('/edit/{id}', name: 'edit', methods: ['GET','POST'])]
    public function edit(Ingrediant $ingredient,Request $request,EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();
            $manager->persist($ingredient);
            $manager->flush();
            $this->addFlash(
                'Success',
                'Votre ingredient a ete modifier  avec success !'
            );

            return $this->redirectToRoute('list');

        }
            return $this->render('pages/ingredient/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET','POST'])]
    public function delete(EntityManagerInterface $manager, Ingrediant $ingrediant) : Response
    {
        if (!$ingrediant){
            $this->addFlash(
                'Echec',
                'Votre ingredient a pas ete trouver '
            );

            return $this->redirectToRoute('list');
        }
        $manager->remove($ingrediant);
        $manager->flush();
        $this->addFlash(
            'Success',
            'Votre ingredient a ete supprimer avec success !'
        );
        return $this->redirectToRoute('list');

    }
}
















