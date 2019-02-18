<?php
    // code source de time_basique.php
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
            Blind SQL Injection
        </title>        
    </head>
    <body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <h1>Injection SQL en aveugle </h1>
                </div>
        </header>
        <article>
            <h3> Le site vous dira juste "Utilisateur existant." ou "Utilisateur inexistant", à aucun moment, les informations de cet utilisateur ne sont affichées. </h3>
        </article>
        
        <aside>
       <?php
            if(!empty($_GET['id']))
            {
                $id = mysqli_real_escape_string($db, $_GET['id']);
                $query = "SELECT id, username FROM users WHERE id = ".$id;
                $rs_article = mysqli_query($db, $query);

                if(mysqli_num_rows($rs_article) == 1)
                {
                    echo "<p>Utilisateur existant.</p>";
                }
                else
                {
                    echo "<p>Utilisateur inexistant.</p>";
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

