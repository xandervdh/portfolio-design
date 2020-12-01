<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Tag;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard", methods={"GET"})
     */
    public function dashboard(ArticlesRepository $articlesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $articles = count($articlesRepository->findAll());
        return $this->render('articles/dashboard.html.twig', [
            'controller_name' => 'dashboard',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/", name="articles_index", methods={"GET"})
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request, TagRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        //var_dump($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $tagName = $data->getTags()[0]->getName();
            $entityManager = $this->getDoctrine()->getManager();
            $tag = $repo->findOneBy(['name' => $tagName]);
            //$tag->setName($data->getTags()[0]->getName());
            //$tag->setArticle($article);
            $article->addTag($tag);
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="articles_show", methods={"GET"})
     */
    public function show(Articles $article): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="articles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="articles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }
}
