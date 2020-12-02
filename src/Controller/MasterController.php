<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Users;
use App\Repository\ArticlesRepository;
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

    public function getArticles($value)
    {
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT * FROM articles JOIN articles_tag a on articles.id = a.articles_id WHERE a.tag_id =' . $value . ';';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getArticle($value)
    {
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT * FROM tag JOIN articles_tag a on tag.id = a.tag_id WHERE a.articles_id =' . $value . ';';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getTags($value)
    {
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT * FROM tag WHERE id = ' . $value . ';';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAllTags()
    {
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT * FROM tag;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        return $statement->fetchAll();
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
               var_dump($articles);
               $tags = $this->getAllTags();
               break;
            case "javascript":
                $articles = $this->getArticles(3);
                var_dump($articles);
                $tags = $this->getTags(3);
                break;
            case "HTML":
                $articles = $this->getArticles(4);
                $tags = $this->getTags(4);
                break;
            case "PHP":
                $articles = $this->getArticles(5);
                $tags = $this->getTags(5);
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
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle(Articles $article, $id): Response
    {
        return $this->render('master/show.html.twig', [
            'article' => $article,
            'tags' => $this->getArticle($id),
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
