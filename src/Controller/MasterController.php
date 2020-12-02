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
    private $tags;

    /**
     * MasterController constructor.
     * @param $tags
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tags = $tagRepository->findAll();
    }


    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('master/home.html.twig', [
            'controller_name' => 'home',
            'tags' => $this->tags,
        ]);
    }

    /**
     * @Route("/about-me", name="about-me")
     */
    public function aboutMe(): Response
    {
        return $this->render('master/about.html.twig', [
            'controller_name' => 'about me',
            'tags' => $this->tags,
        ]);
    }



    /**
     * @Route("/articles/{category}", name="articles")
     */
    public function portfolioArticles($category, TagRepository $tagRepository, ArticlesRepository $articlesRepository): Response
    {
        if ($category == 'all'){
            $articles = $articlesRepository->findAll();
        } else {
            $tags = $tagRepository->findBy(['name' => $category]);
            $articles =  $tags[0]->getArticles()->toArray();
        }

        return $this->render('master/index.html.twig', [
            'articles' => $articles,
            'tags' => $this->tags,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle(Articles $article): Response
    {
        return $this->render('master/show.html.twig', [
            'article' => $article,
            'tags' => $this->tags,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('master/contact.html.twig', [
            // 'controller_name' => 'contact',
            'tags' => $this->tags,
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
            'tags' => $this->tags,
        ]);
    }
}
