<?php

    include_once "header.php";

?>

    <main>
        <section id="section">
            <form id="formulaire" action="login.php" method="POST">
                <article class="input-formulaire">
                    <label>Email</label>
                    <input class="input" type="email" id="input-connexion-email" name="email"/>
                </article>
                <article class="input-formulaire">
                    <label>Mot de passe</label>
                    <input class="input" type="password" id="input-connexion-mdp" name="mdp"/>
                </article>
                <article id="parent-bouton">
                    <button type="submit" class="bouton">Se connecter</button>
                    <span id="span-connexion"></span>
                </article>
            </form>
        </section> 
    </main>



<?php

    include_once "footer.php"

?>

</body>
</html>