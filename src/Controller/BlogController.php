<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ArticleType;
use App\Form\CommentType;

use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

//include paginator interface
use Knp\Component\Pager\PaginatorInterface;
use knp_paginator;

/** @Route("/blog", name="blog/") */
class BlogController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function testApi()
    {
        return $this->render('blog/testApi.html.twig');
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(Request $request, PaginatorInterface $paginator)
    {

        $query = $this->getDoctrine()
            ->getRepository(Article::class)
            ->createQueryBuilder('articles')
            
            // ->from('Article', 'articles')
            ->addOrderBy('articles.id', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        $articles = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No articles found'
            );
        }

        return $this->render('blog/accueil.html.twig', [
            'articles' => $articles,
            'pagination' => $pagination,
            
        ]);
    }

    /**
     * @Route("/profile/{id}", name="profile", requirements={"^[1-9]\d*$"})
     */
    public function showProfile($id, Request $request, User $user)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        // dd($user);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        return $this->render('blog/user/profile.html.twig', [
            'user' => $user,
  ]);


    }

    /**
     * @Route("/show/{id}", name="show", requirements={"^[1-9]\d*$"})
     */
    public function show($id, Request $request, Article $article)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }

        $comments = $article->getComments();

        // creates a comment
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $article->addComment($comment);
                $entityManager->persist($comment);
            //   $comment->setArticle($article);
                $entityManager->flush();
                
                $this->addFlash(
                'notice',
                'Votre commentaire à été créer !'
            );
            
        //     return $this->redirectToRoute('show',
        // ['id' => $id]);
            }

        $articles = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No articles found'
            );
        }
        return $this->render('blog/articles/article.html.twig', [
            'article' => $article,
            'articles' => $articles,
            'form' => $form->createView(),
  ]);
    }

    /**
     * @Route("/show", name="show_all")
     */
    public function showAll(Request $request, PaginatorInterface $paginator)
    {

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $query = $this->getDoctrine()
            ->getRepository(Article::class)
            ->createQueryBuilder('articles')
            
            // ->from('Article', 'articles')
            ->addOrderBy('articles.id', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        
        if (!$articles) {
            throw $this->createNotFoundException(
                'No articles found'
            );
            $this->addFlash(
                'danger',
                'No articles found!'
            );
        }
        return $this->render('blog/articles/articles.html.twig', [
            'articles' => $articles,
            'pagination' => $pagination,
            ]);
    }


    /**
     * @Route("/article/new", name="article/new")
     */
    public function addArticle(Request $request)
    {
        // creates a Session object from the HttpFoundation component
        $session = new Session();

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($session);
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $formFactory = Forms::createFormFactoryBuilder()
        
            ->addExtension(new CsrfExtension($csrfManager))
            ->getFormFactory();


        // creates an article
        $article = new Article();

        
        $form = $this->createForm(ArticleType::class, $article);

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
                    'Votre article à été créer !'
                );
              }
            return $this->render('blog/articles/new.html.twig', [
                    'article' => $article,
                    'form' => $form->createView(),
          ]);
    }

    /**
     * @Route("/article/edit/{id}", name="article/edit", requirements={"^[1-9]\d*$"})
     */
    public function updateArticle(Request $request,$id=null)
    {
        // creates a Session object from the HttpFoundation component
        $session = new Session();

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($session);
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $formFactory = Forms::createFormFactoryBuilder()
        
            ->addExtension(new CsrfExtension($csrfManager))
            ->getFormFactory();

        if ($id)
        {
             $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);
        }
        else
        {
            $this->addFlash(
                'warning',
                'No article with this id!');
            return $this->redirectToRoute('accueil');
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

              if ($form->isSubmitted() && $form->isValid()) {
                  // $form->getData() holds the submitted values
                  // but, the original `$article` variable has also been updated
          
                  $entityManager = $this->getDoctrine()->getManager();
                  $entityManager->persist($article);
                  $entityManager->flush();

                  $this->addFlash("warning", "votre article à été modifié");
                  return $this->redirectToRoute('blog/accueil');};

                  return $this->render('blog/articles/edit.html.twig', [
                    'article' => $article,
                    'form' => $form->createView(),
          ]);
    }

    /**
     * @Route("/article/{slug}/comment/edit/{id}", name="comment/edit", requirements={"^[1-9]\d*$"})
     */
    public function updateComment($id,Request $request)
    {
        
             $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($id);

            if (!$comment) {
                throw $this->createNotFoundException(
                    'No comment found for id ' . $id
                );
            }

            $form = $this->createForm(CommentType::class, $comment);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($comment);
              //$comment->setArticle($article);
                $entityManager->flush();
                
                
            $this->addFlash("warning", "votre comment à été modifié");
            return $this->redirectToRoute('blog/accueil');};

            return $this->render('blog/commentaires/edit.html.twig', [
              'comment' => $comment,
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

            $this->addFlash("warning", "votre article à été supprimé");
            return $this->redirectToRoute('blog/accueil');
            
    }

    /**
     * @Route("/article/comment/destroy/{id}", name="destroyComment")
     */
    public function destroyComment($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comment = $repository->find($id);
        $entityManager->remove($comment);
        // $entityManager->removeComment($comment);
        $entityManager->flush();
        $this->addFlash("warning", "votre commentaire à été supprimé");
        return $this->redirectToRoute('blog/show_all');
    }



}
