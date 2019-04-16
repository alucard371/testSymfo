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
use Symfony\Component\HttpFoundation\Response;
use App\Form\ArticleType;

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
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }

        $articles = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findAll();

    if (!$articles) {
        throw $this->createNotFoundException(
            'No articles found'
        );
    }

        return $this->render('blog/articles/article.html.twig', ['article' => $article, 'articles' => $articles]);
    }

    /**
     * @Route("/show", name="show_all")
     */
    public function showAll()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No articles found'
            );
        }
        return $this->render('blog/articles/articles.html.twig', ['articles' => $articles]);
    }


    /**
     * @Route("/article/new", name="article/new")
     */
    public function addArticle(Request $request)
    {
          // creates an article and gives it some dummy data for this example
          $article = new Article();

        // $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
  
        //   $form = $this->createFormBuilder($article)
        //       ->add('auteur', TextType::class,[
        //           'label' => 'auteur'
        //       ])
        //       ->add('corps', TextareaType::class,[
        //       ])
        //       ->add('creation_date', DateType::class)
        //       ->add('save', SubmitType::class, ['label' => 'Create Article'])
        //       ->getForm();

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


    /**
     * @Route("/article/destroy/{id}", name="destroy")
     */
    public function destroyArticle($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();

            return $this->redirectToRoute('home');
            $this->addFlash("warning", "votre article à été supprimé");
    }
}
