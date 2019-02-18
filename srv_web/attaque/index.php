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
        <link rel="stylesheet" href="style.css" />
        <title>Bienvenue</title>
	</head>
	<body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <div id="logo">
                        <img src="images/white_hat.png" alt="White hat" />
                        <h1>Thomas SAVIO</h1>    
                    </div>
				<h2>Bienvenue, vous êtes sur le serveur qui sert pour apprendre les attaques basiques utilisées par les pirates </h2>
			</div>
            </header>
<br>
<br>
                <article>
                    <h1>Bravo tu as réussi à trouver la section pour expérimenter des attaques</h1>
                    <p>                    
                    En exécutant la commande : "nmap -sS www.thomas-savio.fr" tu as pu te rendre compte que le port 8080 était ouvert, ou alors tu l'as trouvé par chance, mais maintenant il te faut trouver comment te connecter.</p> 
                    <p>Un conseil, les comptes administrateurs ('Administrateur' ou 'Admin' ou 'Root') ne sont généralement pas désactivés. Pour le mot de passe à toi de trouver !</p>
                    <p>Un autre conseil, tout n'est que code, cependant certains sont interprétés tandis que d'autre ne le sont pas, à toi de chercher</p>
                    <!--Oui je l'ai caché dans le code source. Normalement il ne faut pas faire ceci, cependant sur ce site Web ce n'est pas grave. Voici le mot de passe : 'root'-->
                </article>
            <aside>
        <form action="" method="GET">
            <b>Nom d'utilisateur :</b> <input type="text" name="username" required/>
            <b>Mot de passe :</b> <input type="password" name="password" required/>
            <input type="submit" value="Connexion" />
        </form>
        </aside>
            <footer>
                <?php
        if(!empty($_GET['username']) && !empty($_GET['password']))
        {
            $username = mysqli_real_escape_string($db, $_GET['username']);
            $password = mysqli_real_escape_string($db, $_GET['password']);

            $query = "SELECT id, username FROM users WHERE username = '".$username."' AND password = '".$password."'";
            $rs = mysqli_query($db, $query);

            if(mysqli_num_rows($rs) == 1)
            {
                $user = mysqli_fetch_assoc($rs);
               header("Location: http://www.thomas-savio.fr:8080/connexion.html" );
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
