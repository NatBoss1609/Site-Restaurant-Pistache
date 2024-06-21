<?php

    include_once "header.php";

?>

    <main class="flex-container-menu">
        <section class="cadre_a_propos">
            <article class="text_container">
                <article class="heading_1">
                    <h1>NOUS <br> Contacter</h1>
                </article>
                <article class="par_1">
                    <p>
                        UNE QUESTION ? UN BESOIN ? <br> FAIRE PARTIE DE L'EQUIPE,
                    </p>
                </article>
            </article>
            <article class="img_cadre_a_propos">
                <img src="../img/chef-travaillant-ensemble-dans-cuisine-professionnelle_23-2149727999.png" alt="deux chefs de cuisine travaillant ensemble">
            </article>
        </section>

        <section class="contact_form">
            <form action="#" method="post">
                <article class="input-group">
                    <label for="first_name">Prénom :</label>
                    <input type="text" id="first_name" name="first_name" required>
                </article>
                <article class="input-group">
                    <label for="last_name">Nom :</label>
                    <input type="text" id="last_name" name="last_name" required>
                </article>
                <article class="input-group">
                    <label for="email">Adresse mail :</label>
                    <input type="email" id="email" name="email" required>
                </article>
                <article class="input-group">
                    <label for="message">Message :</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </article>
                <article class="input-group">
                    <button type="submit">Envoyer</button>
                </article>
            </form>
        </section>
    </main>


<?php

    include_once "footer.php"

?>

</body>
</html>