<?php

namespace Controllers;

class Article
{
    /**
     * cette méthode affiche la liste des articles
     */
    public function index()
    {
        $model = new \Models\Article();
        $articles = $model->findAll();
        $pageTitle = 'Accueil';
        \Core\Utils::render('articles/index', compact('pageTitle', 'articles'));
    }

    public function show()
    {
        // On part du principe qu'on ne possède pas de param "id"
        $article_id = null;

        // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        // On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }
        $model = new \Models\Article();
        $article = $model->find($article_id);

        /**
         * 4. Récupération des commentaires de l'article en question
         * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
         */
        $modelComment = new \Models\Comment();
        $commentaires = $modelComment->findAll();

        /**
         * 5. On affiche 
         */
        $pageTitle = $article['title'];
        \Core\Utils::render('articles/show', compact('article', 'commentaires', 'article_id'));
    }

    public function delete()
    {

        /**
         * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $id = $_GET['id'];


        /**
         * 3. Vérification que l'article existe bel et bien
         */
        $modelArticle = new \Models\Article();
        $article = $modelArticle->find($id);
        if (empty($article)) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }
        /**
         * 4. Réelle suppression de l'article
         */
        $modelArticle->delete($id);

        /**
         * 5. Redirection vers la page d'accueil
         */
        \Core\Utils::http('index.php');
    }
}
