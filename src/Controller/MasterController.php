<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="homepage")
 */
class MasterController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('master/index.html.twig', [
            'controller_name' => 'homepage',
        ]);
    }

    /**
     * @Route("/about-me", name="about-me")
     */
    public function aboutMe(): Response
    {
        return $this->render('master/index.html.twig', [
            'controller_name' => 'about me',
        ]);
    }

    /**
     * @Route("/articles/{category}", name="articles")
     */
    public function portfolioArticles($category): Response
    {
        return $this->render('master/index.html.twig', [
            'controller_name' => 'articles ' . $category,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle($id): Response
    {
        return $this->render('master/index.html.twig', [
            'controller_name' => 'article ' . $id,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('master/index.html.twig', [
            'controller_name' => 'contact',
        ]);
    }
}
