<?php

namespace Models;

require_once('core\Database.php');

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Core\Database::getpdo();
    }

    /**
     * cette méthode traite l'affichade de toutes les valeurs
     */
    public function findAll(): array
    {
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query("SELECT * FROM $this->table ORDER BY created_at DESC");
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
        return $articles;
    }

    /**
     * Cette méthode traite l'affichage d'une valeur
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        // On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();
        return $article;
    }

    /**
     * cette méthode traite l'insertation des données
     */
    public function insert($vars)
    {
        var_dump(extract($vars));
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
        $query->debugDumpParams();
    }

    /**
     * cette méthode permet de faire une suppression
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}
