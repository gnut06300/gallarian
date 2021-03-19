<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

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
    public function newCategory(Request $request,EntityManagerInterface $em,SluggerInterface $slugger): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //methode 3 en passant l'objet dans createForm pour qu'il hydrate l'objet Category
            //dd($category);

            //methode 2 via request
            //dd($request->request->get('category_form')['name']);
            //$name=$request->request->get('category_form')['name'];
            //$content=$request->request->get('category_form')['content'];
            //dd($request->server->get('HTTP_HOST'));

            //methode 1 via formType
            //$name=$form->getData()->getName();
            //$content=$form->getData()->getContent();
            //$category->setName($name);
            //$category->setContent($content);
            //$em= $this->getDoctrine()->getManager(); //sans EntityManagerInterface $em uniquement dans un controller extends AbstractController
            $category->setSlug($slugger->slug($category->getName()."-".uniqid())->lower());
            $em->persist($category);
            $em->flush();
            //dd($name,$content);

            //dd($form->getData()->getName());        
            //dd($form->getData(),$request->request,$category);

        }
        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
        
        ]);
    }
    
}
