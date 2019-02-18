<?php
    // code source de connexion.php
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
            Contournement d'un formulaire d'authentification
        </title>        
    </head>
    <body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <h1>Connexion au site d'administration</h1>
                </div>
        </header>
 <article>
            <h3>Veuillez rentrer votre identifiant et votre mot de passe afin de vous connecter.</h3>
        </article>
        
        <aside>
        <form action="connexion.php" method="GET">
            <b>Nom d'utilisateur :</b> <input type="text" name="username"/>
            <b>Mot de passe :</b> <input type="password" name="password" />
            <input type="submit" value="Connexion" />
        </form>
        </aside>
            <nav>
                <ul><li><a href="index.html">Clique ici</a> pour revenir à l'index de la rubrique de l'injection sql.</li></ul>
                <ul><li><a href="../connexion.html">Clique ici</a> pour revenir à l'index.</li></ul>
           </nav>
            <footer>
                <?php
        if(!empty($_GET['username']) && !empty($_GET['password']))
        {
            $username = $_GET['username'];
            $password = $_GET['password'];

            $query = "SELECT id, username FROM users WHERE username = '".$username."' AND password = '".$password."'";
            $rs = mysqli_query($db, $query);

            if(mysqli_num_rows($rs) == 1)
            {
                $user = mysqli_fetch_assoc($rs);

                echo "Bienvenue ".htmlspecialchars($user['username']);
            }
            else
            {
                echo "Mauvais nom d'utilisateur et/ou mot de passe !";
            }

            mysqli_free_result($rs);
            mysqli_close($db);
        }
        ?>
            </footer>
        </div>
    </body>
</html>

