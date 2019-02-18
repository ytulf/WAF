<?php
    // code source de articles.php
    $host = "localhost";
    $user_mysql = "thomas";     // nom d'utilisateur de l'utilisateur de MySQL 
    $password_mysql = "root";     // mot de passe de l'utilisateur de MySQL
    $database = "injections_sql";

    $db = mysqli_connect($host, $user_mysql, $password_mysql, $database);
    mysqli_set_charset($db, "utf8");
?> 
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
            Affichage d'enregistrements
        </title>        
    </head>
    <body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <h1>Sur cette page nous allons afficher les éléments enregistrés dans la base de données</h1>
                </div>
            </header>
            <article>
                <h2>Voici ce que vous avez demandé :</h2>
            </article>
        <aside>
            <?php
            if(!empty($_GET['category']))
            {
                $category = mysqli_real_escape_string($db, $_GET['category']);
                $query = "SELECT id, title, DATE_FORMAT(date, '%d/%m/%Y') AS date FROM articles WHERE category_id = ".$category;
                $rs_articles = mysqli_query($db, $query);

                echo "<u>\n";

                if(mysqli_num_rows($rs_articles) > 0)
                {
                    while($r = mysqli_fetch_assoc($rs_articles))
                    {
                        echo "<li><a href=\"#\">".htmlspecialchars($r['title'])." - ".$r['date']."</a></li>\n";
                    }
                }

                echo "</u>\n";
            }
        ?>
</aside>   
    <footer>
        <nav>
                <ul><li><a href="index.html">Clique ici</a> pour revenir à l'index de la rubrique de l'injection sql.</li></ul>
                <ul><li><a href="../connexion.html">Clique ici</a> pour revenir à l'index.</li></ul>
           
            </nav>
    </footer>
        </div>
    </body>
</html>