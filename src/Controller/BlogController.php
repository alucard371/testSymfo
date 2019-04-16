<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/** @Route("/blog", name="blog/") */
class BlogController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('blog/accueil.html.twig', [
            'controller_name' => 'BlogController',
            
        ]);
    }

    /**
     * @Route("/show/{id}", name="show", requirements={"^[1-9]\d*$"})
     */
    public function show($id)
    {
        return $this->render('blog/show.html.twig', [
            'articles' => [1,2,3,4],
            'comments' => ['comments1', 'comments2', 'comments3', 'comments4'],
            'user_id' =>
            $id,
        ]);
    }

    /**
     * @Route("/article/new", name="article/new")
     */
    public function addArticle(Request $request)
    {
          // creates an article and gives it some dummy data for this example
          $article = new Article();
  
          $form = $this->createFormBuilder($article)
              ->add('auteur', TextType::class)
              ->add('corps', TextareaType::class)
              ->add('creation_date', DateType::class)
              ->add('save', SubmitType::class, ['label' => 'Create Article'])
              ->getForm();

              $form->handleRequest($request);

              if ($form->isSubmitted() && $form->isValid()) {
                  // $form->getData() holds the submitted values
                  // but, the original `$article` variable has also been updated
                  $article = $form->getData();
          
                  
                  $entityManager = $this->getDoctrine()->getManager();
                  $entityManager->persist($article);
                  $entityManager->flush();
                  
                  $this->addFlash(
                    'notice',
                    'Your article were saved!'
                );
              }
          return $this->render('blog/articles/new.html.twig', [
              'article' => $article,
              'form' => $form->createView(),
          ]);
    }
}
