<?php
require '../views/partials/header.php';
?>
    <main>
        <h1>Lampadaires</h1>
        <table>
            <thead>
            <tr>
                <th>Référence</th>
                <th>Commune</th>
                <th>Adresse</th>
                <th>Type</th>
                <th>Puissance</th>
                <th>Installé le</th>
                <th>État</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lampadaires as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['reference']) ?></td>
                    <td><?= htmlspecialchars($l['commune']) ?></td>
                    <td><?= htmlspecialchars($l['adresse']) ?></td>
                    <td><?= htmlspecialchars($l['type_lampe']) ?></td>
                    <td><?= (int) $l['puissance_w'] ?> W</td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($l['date_installation']))) ?></td>
                    <td><?= htmlspecialchars($l['etat']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php require '../views/partials/pagination.php'; ?>
    </main>
<?php require '../views/partials/footer.php'; ?>