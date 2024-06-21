<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: connexion.php");
    exit();
}

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
$query_categories = "SELECT * FROM categories ORDER BY name ASC";
$result_categories = $connexion->query($query_categories);

$categories = [];
while ($row = $result_categories->fetch_assoc()) {
    $categories[$row['id']] = $row['name'];
}

// Traitement des ajouts, modifications et suppressions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action == 'add_category') {
            $name = $_POST['category_name'];
            $add_category_query = "INSERT INTO categories (name) VALUES ('$name')";
            $connexion->query($add_category_query);
        } elseif ($action == 'edit_category' && isset($_POST['category_id'])) {
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];
            $edit_category_query = "UPDATE categories SET name='$name' WHERE id=$id";
            $connexion->query($edit_category_query);
        } elseif ($action == 'delete_category' && isset($_POST['category_id'])) {
            $id = $_POST['category_id'];
            $delete_category_query = "DELETE FROM categories WHERE id=$id";
            $connexion->query($delete_category_query);
        } elseif ($action == 'add_menu') {
            $category = $_POST['category'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $status = ($_POST['submit'] == 'Publier') ? 'published' : 'draft';
            $add_query = "INSERT INTO menu (category, name, price, status, creation_date) VALUES ('$category', '$name', '$price', '$status', NOW())";
            $connexion->query($add_query);
        } elseif ($action == 'edit_menu' && isset($_POST['menu_id'])) {
            $id = $_POST['menu_id'];
            $category = $_POST['category'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $status = ($_POST['submit'] == 'Publier') ? 'published' : 'draft';
            $edit_query = "UPDATE menu SET category='$category', name='$name', price='$price', status='$status' WHERE id=$id";
            $connexion->query($edit_query);
        } elseif ($action == 'delete_menu' && isset($_POST['menu_id'])) {
            $id = $_POST['menu_id'];
            $delete_query = "DELETE FROM menu WHERE id=$id";
            $connexion->query($delete_query);
        }

        header("Location: gestion_menu.php");
        exit();
    }
}

// Récupération des données du menu et tri par catégorie et ordre alphabétique
$query_menu = "SELECT * FROM menu ORDER BY FIELD(category, '1', '2', '3'), name ASC";
$result_menu = $connexion->query($query_menu);

?>

<?php include_once "header.php"; ?>

<main>
    <h1>Gestion du Menu</h1>

    <section>
        <h2>Ajouter une catégorie</h2>
        <form method="POST">
            <input type="hidden" name="action" value="add_category">
            <label>Nom de la catégorie: <input type="text" name="category_name"></label>
            <button type="submit">Ajouter</button>
        </form>
    </section>

    <section>
        <h2>Catégories existantes</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($categories as $id => $name): ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="category_id" value="<?= $id ?>">
                        <input type="hidden" name="action" value="edit_category">
                        <td><input type="text" name="category_name" value="<?= htmlspecialchars($name) ?>"></td>
                        <td>
                            <button type="submit">Modifier</button>
                            <button type="submit" formaction="gestion_menu.php?action=delete_category">Supprimer</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section>
        <h2>Ajouter un élément</h2>
        <form method="POST">
            <input type="hidden" name="action" value="add_menu">
            <label>Catégorie:
                <select name="category">
                    <?php foreach ($categories as $id => $name): ?>
                        <option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Nom: <input type="text" name="name"></label>
            <label>Prix: <input type="text" name="price" placeholder="15.0"></label>
            <button type="submit" name="submit" value="Enregistrer en brouillon">Enregistrer en brouillon</button>
            <button type="submit" name="submit" value="Publier">Publier</button>
        </form>
    </section>

    <section>
        <h2>Éléments du menu</h2>
        <table>
            <tr>
                <th>Catégorie</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result_menu->fetch_assoc()): ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="menu_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="action" value="edit_menu">
                        <td>
                            <select name="category">
                                <?php foreach ($categories as $id => $name): ?>
                                    <option value="<?= $id ?>" <?= $row['category'] == $id ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>"></td>
                        <td><input type="text" name="price" value="<?= htmlspecialchars($row['price']) ?>"></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['creation_date']) ?></td>
                        <td>
                            <button type="submit" name="submit" value="Enregistrer en brouillon">Enregistrer en brouillon</button>
                            <button type="submit" name="submit" value="Publier">Publier</button>
                        </td>
                    </form>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="menu_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="action" value="delete_menu">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>
</main>

<?php include_once "footer.php"; ?>
</body>
</html>

<?php $connexion->close(); ?>