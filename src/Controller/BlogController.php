<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticleRepository $repoArticles): Response
    {   
        //Pour selectionner des données dans une table SQL en BDD nous devons importer la classe Repository qui correspond a la table SQL, c'est a dire à l'entité correspondante(Article)
        // Une classe Repository permet uniquement de formuler et d'executer des requetes SQL de selection (SELECT)
        // Cette classe contient des méthodes mis à disposition par Symfony pour formuler et executer des requetes SQL en BDD
        //traitement requete selection BDD des articles
        //repoArticles est un objet issu de la class ArticleRepository
        // getRepository() : méthode permettant d'importer la classe Repository d'une entité

        // $repoArticles = $this->getDoctrine()->getRepository(Article::class);
        //outil de debug propre a symfony
        dump($repoArticles);
        //findAll()= SELECT * FROM article + FETCHALL
        // $articles : tableau multidimensionnel contenant l'ensemble des articles contenus dans la BDD
        $articles =$repoArticles->findAll();
        dump($articles);

        return $this->render('blog/blog.html.twig', [
            'articlesBDD' => $articles // on transmet au template les articles que nous avons selectionnés en bdd zfin de les traiter et de les afficher avec le langage TWIG
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('blog/home.html.twig',[
            'title' => 'Blog dédié à la musique, viendez voir, ça dechire',
            'age' =>25
        ]);
    }
    /**
     * Methode permettant de creer un nouvel article et de modifier un article
     * 
     * @Route("/blog/new", name="blog_create")
     */
    public function create(): Response
    {
        return $this->render('blog/create.html.twig');
    }
    /**
     * Méthode permettant d'afficher le detail d'un article

     * 
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article): Response
    {   // L'id transmit dans l'URL est envoyé directement en argument de la fonction show(), ce qui nous permet d'avoir accès à l'id de l'article a selectionner en BDD au sein de la méthode show()

        // dump($id);

        // $repoArticle = $this->getDoctrine()->getrepository(Article::class);
        // dump($repoArticle);

        // find() : méthode mise à dispostion par Symfony issue de la classe ArticleRepository permettant de selectionner un élément de la BDD par son ID 
        // $article : tableau ARRAY contenant toutes les données de l'article selectionné en BDD en fonction de l'ID transmit dans l'URL

        // SELECT * FROM article WHERE id = 6 + FETCH
        // $article = $repoArticle->find($id);
        dump($article);

        return $this->render('blog/show.html.twig', [
            'articleBDD' => $article // on transmet au template les données de l'article selectionné en BDD afin de les traiter avec le langage Twig dans le template

        ]);
    
    }

    
}
