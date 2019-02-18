<?php
    // code source de backdoor.php
    $host = "localhost";
    $user_mysql = "thomas";     // nom d'utilisateur de l'utilisateur de MySQL 
    $password_mysql = "root";     // mot de passe de l'utilisateur de MySQL
    $database = "injections_sql";

    $db = mysqli_connect($host, $user_mysql, $password_mysql, $database);

    if(!$db)
    {
        echo "Echec de la connexion\n";
        exit();
    }

    mysqli_set_charset($db, "utf8");
?>

<!DOCTYPE>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114760253-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-114760253-1');
        </script>
        <meta name="robots" content="noindex">
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style.css" />
        <title>
            Portes d'entrées dérobées
        </title>        
    </head>
    <body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <h1>Portes d'entrées dérobées </h1>
                </div>
        </header>
        <article>
            <h3> Les injections SQL permettent principalement de manipuler la base de données mais peuvent parfois servir de portes d'entrées dérobées  </h3>
        </article>
        
        <aside>
            <?php
            if(!empty($_GET['article']))
            {
                $article = $_GET['article'];
                $query = "SELECT articles.id, articles.title, DATE_FORMAT(date, '%d/%m/%Y') AS date, content, categories.title AS title_category FROM articles INNER JOIN categories ON articles.category_id = categories.id WHERE articles.id = ".$article;
                $rs_article = mysqli_query($db, $query);

                if(mysqli_num_rows($rs_article) == 1)
                {
                    $r = mysqli_fetch_assoc($rs_article);

                    echo "<h1>".$r['title']."</h1>\n";
                    echo "<span>dans <a href=\"#\">".$r['title_category']."</a> le ".$r['date']."</span>\n\n";

                    echo "<p>".$r['content']."</p>";
                }
            }
        ?>
        </aside>
            <nav>
                <ul><li><a href="index.html">Clique ici</a> pour revenir à l'index de la rubrique de l'injection sql.</li></ul>
                <ul><li><a href="../connexion.html">Clique ici</a> pour revenir à l'index.</li></ul>
           </nav>
        </div>
    </body>
</html>