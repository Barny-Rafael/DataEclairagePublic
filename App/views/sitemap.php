<?php
// ... HTML propre à la page ...
require '../views/partials/header.php';
?>
    <main>
        <h1>Plan du site</h1>
        <nav>
            <ul>
                <?php foreach ($liens as [$url, $libelle]): ?>
                    <li><a href="<?= htmlspecialchars($url) ?>"><?= htmlspecialchars($libelle) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php require '../views/partials/pagination.php'; ?>
    </main>
<?php require '../views/partials/footer.php'; ?>