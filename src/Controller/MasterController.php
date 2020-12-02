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
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();
        return $this->render('master/home.html.twig', [
            'controller_name' => 'home',
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/about-me", name="about-me")
     */
    public function aboutMe(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();
        return $this->render('master/about.html.twig', [
            'controller_name' => 'about me',
            'tags' => $tags,
        ]);
    }



    /**
     * @Route("/articles/{category}", name="articles")
     */
    public function portfolioArticles($category, ArticlesRepository $articlesRepository, TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();
        $articles = [];
        switch ($category) {
            case "all":
                $articles = $articlesRepository->findAll();
                break;
            case "HTML":
                $tag = $tagRepository->findBy(['name' => 'HTML']);
                $articles = $tag[0]->getArticles()->toArray();
                break;
            case "javascript":
                $tag = $tagRepository->findBy(['name' => 'javascript']);
                $articles = $tag[0]->getArticles()->toArray();
                break;
            case "PHP":
                $tag = $tagRepository->findBy(['name' => 'PHP']);
                $articles = $tag[0]->getArticles()->toArray();
                break;
            case "bootstrap":
                $tag = $tagRepository->findBy(['name' => 'bootstrap']);
                $articles = $tag[0]->getArticles()->toArray();
                break;
            case "symfony":
                $tag = $tagRepository->findBy(['name' => 'symfony']);
                $articles = $tag[0]->getArticles()->toArray();
                break;
        }
        return $this->render('master/index.html.twig', [
            'articles' => $articles,
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle(Articles $article, TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();
        return $this->render('master/show.html.twig', [
            'article' => $article,
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();
        return $this->render('master/contact.html.twig', [
            // 'controller_name' => 'contact',
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/search/", name="search", methods={"POST"})
     */
    public function search(ArticlesRepository $repository, TagRepository $tagRepository)
    {
        $tags = $tagRepository->findAll();
        $value = $_POST['search'];
        var_dump($value);
        $result = $repository->findBySearch($value);

        return $this->render('master/search.html.twig', [
            'results' => $result,
            'tags' => $tags,
        ]);
    }
}
