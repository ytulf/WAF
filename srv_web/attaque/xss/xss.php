<html lang="fr">
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
            Exploitation de la faille XSS
        </title>        
        <script>
        document.cookie = 'login=Ton_login;'
        document.cookie = 'motdepasse=Ton_mot_de_passe;'
        </script>
    </head>
    <body>
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <h1>Mon super moteur de recherche qui concurrence Yahoo</h1>
                </div>
            </header>
            <article>
                <h3>Lancer une recherche avec le moteur de recherche ci-dessous :</h3>
            </article>
            <?php
         if(!empty($_GET['keyword']))
        {
            echo "Résultat(s) pour le mot-clé : ".$_GET['keyword'];
        } 
        ?>
         <form type="get" action="">
            <input type="text" name="keyword" size="100" required />
            <input type="submit" value="Rechercher" />
        </form>
        <aside>
                <h1>Idée de commande à utiliser pour comprendre la faille XSS</h1>
                <p>Comme je l'ai dit sur l'index de la section, la faille XSS consiste à injecter du code directement interprétable par le navigateur Web, comme, par exemple, du JavaScript ou du HTML. </p>
                <p> Essaye tout d'abord en entrant ceci :
                <font color="navy">< h1>< s>Test< /s>< /h1></font></p>
                <p>Enlève les espaces sinon cela risque de moins bien fonctionner.</p>
                </p>
                <p>On voit bien que le code a été interprété par le serveur.</p>
                <p>Maintenant essaye de faire apparaitre une pop-up. Il faut entrer ceci : 
                <font color="navy">< script>alert('Bonjour');< /script></font>
                </p>
                <p>Voilà, une pop-up est apparue. Cependant, ce n'est pas très intéressant. Maintenant essayons d'afficher tes cookies :
                <font color="navy">< script>alert("Tes jolies cookies sont :" + document.cookie);< /script></font>
                </p>
        </aside>
        <footer>
            <nav>
                <ul><li><a href="index.html">Clique ici</a> pour revenir à l'index de la rubrique.</li></ul>
                <ul><li><a href="../connexion.html">Clique ici</a> pour revenir à l'index du site.</li></ul>
           
            </nav>
        </footer>
        </div>
    </body>
</html>