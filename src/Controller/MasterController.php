<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Users;
use App\Repository\ArticlesRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        return $this->render('master/home.html.twig', [
            'controller_name' => 'succeeded',
        ]);
    }

    /**
     * @Route("/about-me", name="about-me")
     */
    public function aboutMe(): Response
    {
        return $this->render('master/about.html.twig', [
            'controller_name' => 'about me',
        ]);
    }

    /**
     * @Route("/articles/{category}", name="articles")
     */
    public function portfolioArticles($category, ArticlesRepository $articlesRepository): Response
    {
        $articles = [];
        switch ($category){
            case "all":
               $articles = $articlesRepository->findAll();
               break;
            case "javascript":
                $articles = $articlesRepository->findByTag('javascript');
                break;
            case "HTML":
                $articles = $articlesRepository->findByTag('HTML');
                break;
            case "PHP":
                $articles = $articlesRepository->findByTag('PHP');
                break;
            case "bootstrap":
                $articles = $articlesRepository->findByTag('bootstrap');
                break;
            case "symfony":
                $articles = $articlesRepository->findByTag('symfony');
                break;
        }
        return $this->render('master/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle(Articles $article): Response
    {
        return $this->render('master/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('master/contact.html.twig', [
           // 'controller_name' => 'contact',
        ]);
    }

    /**
     * @Route("/search/", name="search", methods={"POST"})
     */
    public function search(ArticlesRepository $repository)
    {
        $value = $_POST['search'];
        var_dump($value);
        $result = $repository->findBySearch($value);

        return $this->render('master/search.html.twig', [
            'results' => $result,
        ]);
    }
}
