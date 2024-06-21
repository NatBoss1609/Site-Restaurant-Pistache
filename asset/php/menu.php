<?php
include_once "header.php";

// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "restaurant_pistache";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des catégories
$query_categories = "SELECT * FROM categories ORDER BY FIELD(name, 'Entrees', 'Plats', 'Desserts')";
$result_categories = $connexion->query($query_categories);

$categories = [];
while ($row = $result_categories->fetch_assoc()) {
    $categories[$row['id']] = $row['name'];
}

// Récupération des données du menu publiées et tri par ordre alphabétique
$query = "SELECT * FROM menu WHERE status = 'published' ORDER BY name ASC";
$result = $connexion->query($query);

$menu = [];
foreach ($categories as $category_id => $category_name) {
    $menu[$category_name] = [];
}

while ($row = $result->fetch_assoc()) {
    $menu[$categories[$row['category']]][] = $row;
}

$connexion->close();
?>

<main class="flex-container-menu">
    <section class="cadre_menu">
        <img src="../img/cadre_3_cote.png" alt="cadre à 3 côtés noir">
        <h1 class="heading-menu">
            <span class="span_menu_1">Explorez</span> <br> Notre <br> <span class="span-menu-2">menu</span>
        </h1>
        <p class="par-menu">
            Un rassemblement de saveurs uniques !
        </p>
    </section>

    <section class="menu-section">
        <?php foreach ($menu as $category => $items): ?>
            <h2 class="menu-title">Nos <?= htmlspecialchars($category) ?></h2>
            <ul class="menu-items">
                <?php foreach ($items as $item): ?>
                    <li class="menu-item"><?= htmlspecialchars($item['name']) ?> - <?= htmlspecialchars($item['price']) ?>€</li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </section>
</main>

<?php include_once "footer.php"; ?>
</body>
</html>