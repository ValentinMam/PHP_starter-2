<?php

   const MYSQL_HOST = 'localhost';
      const MYSQL_PORT = 3307;
      const MYSQL_NAME = 'blog';
      const MYSQL_USER = 'root';
      const MYSQL_PASSWORD = 'root';
function getPosts() {
    // We connect to the database.
     try {
    $database = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
        MYSQL_USER,
        MYSQL_PASSWORD
    );
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}

    // We retrieve the 5 last blog posts.
    $statement = $database->query(
        "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
    );
    $posts = [];
    while (($row = $statement->fetch())) {
        $post = [
            'title' => $row['titre'],
            'french_creation_date' => $row['date_creation_fr'],
            'content' => $row['contenu'],
        ];

        $posts[] = $post;
    }

    return $posts;
}

?>