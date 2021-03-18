<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        //$categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        //dd($categories);

        return $this->render('category/index.html.twig', [
            'categories'=>$categoryRepository->findAll(),
            //'categories' => $categories,
            //'categories' => $this->getDoctrine()->getRepository(Category::class)->findAll()
        ]);
    }
    /**
     * @Route("/categories/new", name="categories_new")
     */
    public function newCategory(): Response
    {
        $form = $this->createForm(CategoryFormType::class);

        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
        
        ]);
    }

}
