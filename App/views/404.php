<?php
// ... HTML propre à la page ...
require '../views/partials/header.php';
?>
    <h1>Erreur 404</h1>

    <p>La page demandée "<?= htmlspecialchars($chemin) ?>" n'existe pas.</p>

<?php require '../views/partials/footer.php'; ?>