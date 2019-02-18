<?php
    // code source de time_total.php
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
            Total Blind SQL Injection
        </title>        
    </head>
    <body>
        <body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <h1>Total Blind SQL Injection ou TIME Blind SQL Injection</h1>
                </div>
            </header>
        <article>
            <h3>Sur cette page rien ne s'affichera cependant il faut bien regarder le temps de r�ponse du serveur</h3>
        </article>
        <aside>
       <div id="logo">
                    <h1>Comment marche cette attaque ?</h1>
                </div>
                    <p>                    
                    Une "Total Blind SQL Injection" est une injection qui renvoie un r�sultat mais ce dernier n'est pas affich� et vous �tes donc incapable, visuellement, de savoir si oui ou non la requ�te a renvoy� un r�sultat.</p>

                    <p>Pourtant, l'exploitation n'est absolument pas impossible. Il y a juste que nous ne pouvons plus nous baser sur un retour visuel (une phrase ou un mot qui change, une image qui est affich�e dans un cas et pas dans l'autre etc). Il existe cependant une autre mesure, non visible, que l'on peut "calculer".<p>

                    <p>Le temps ! Voil�,� ce qui va nous permettre de d�terminer si la requ�te a renvoy�, ou non, un r�sultat. </p>
                    <p>Un test � effectuer :</p>
                    <p>Taper dans l'URL : "time.php?id=-1 OR (SELECT SLEEP(3) FROM users WHERE id=1 AND 1=2)"</p>
                    <p>Puis maintenant ceci : "time.php?id=-1 OR (SELECT SLEEP(3) FROM users WHERE id=1 AND 1=1)" </p>
                    <p> Comparer les deux temps de r�ponse (10 secondes normalement)</p>
        </aside>

        <?php
            if(!empty($_GET['id']))
            {
                $id = mysqli_real_escape_string($db, $_GET['id']);
                $query = "SELECT id, username FROM users WHERE id = ".$id;
                $rs_article = mysqli_query($db, $query);
            }
        ?>
        <footer>
            <nav>
                <ul><li><a href="index.html">Clique ici</a> pour revenir �l'index de la rubrique de l'injection sql.</li></ul>
                <ul><li><a href="../connexion.html">Clique ici</a> pour revenir �l'index.</li></ul>
           
            </nav>
        </footer>
        </div>
    </body>
</html>