<?php if ($pagination['totalPages'] > 1): ?>
    <nav class="pagination" aria-label="Pagination">
        <?php if ($pagination['page'] > 1): ?>
            <a href="?page=<?= $pagination['page'] - 1 ?>">&laquo; Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
            <?php if ($i === $pagination['page']): ?>
                <span aria-current="page"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagination['page'] < $pagination['totalPages']): ?>
            <a href="?page=<?= $pagination['page'] + 1 ?>">Suivant &raquo;</a>
        <?php endif; ?>

        <p>Page <?= $pagination['page'] ?> sur <?= $pagination['totalPages'] ?></p>
    </nav>
<?php endif; ?>