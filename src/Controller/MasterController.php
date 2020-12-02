<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Tag;
use App\Entity\Users;
use App\Repository\ArticlesRepository;
use App\Repository\TagRepository;
use PhpParser\Node\Expr\Cast\Object_;
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
            'controller_name' => 'home',
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
    public function portfolioArticles($category, ArticlesRepository $articlesRepository, TagRepository $tagRepository): Response
    {
        $articles = [];
        switch ($category) {
            case "all":
                $articles = $articlesRepository->findAll();
                break;
            case "javascript":
                $tag = $tagRepository->find(1);
                $articles = $tag->getArticles()->toArray();
                break;
            case "HTML":
                $tag = $tagRepository->find(2);
                $articles = $tag->getArticles()->toArray();
                break;
            case "PHP":
                $tag = $tagRepository->find(5);
                $articles = $tag->getArticles()->toArray();
                break;
            case "bootstrap":
                $tag = $tagRepository->find(6);
                $articles = $tag->getArticles()->toArray();
                break;
            case "symfony":
                $tag = $tagRepository->find(7);
                $articles = $tag->getArticles()->toArray();
                break;
        }
        return $this->render('master/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle(Articles $article, $id): Response
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
