<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Le blog de l'AVBN</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <h1>Le super blog de l'AVBN !</h1>
    <p>Derniers billets du blog :</p>

    <?php
      // Connexion à la base de données
      const MYSQL_HOST = 'localhost';
      const MYSQL_PORT = 3307;
      const MYSQL_NAME = 'blog';
      const MYSQL_USER = 'root';
      const MYSQL_PASSWORD = 'root';
     try {
    $bdd = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
        MYSQL_USER,
        MYSQL_PASSWORD
    );
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}

      // On récupère les 5 derniers billets
      $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

      while ($donnees = $req->fetch())
      {
      ?>
    <div class="news">
        <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
            <em>le <?php echo $donnees['date_creation_fr']; ?></em>
        </h3>
        <p>
            <?php
         // On affiche le contenu du billet
                echo    nl2br ( htmlspecialchars( $donnees['contenu']));
         ?>
            <br />
            <em><a href="#">Commentaires</a></em>
        </p>
    </div>
    <?php
      } // Fin de la boucle des billets
      $req->closeCursor();
      ?>
</body>

</html>