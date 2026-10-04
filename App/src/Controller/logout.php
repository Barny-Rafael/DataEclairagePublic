<?php
// Déconnexion : on gère l'action directement ici, dans la page.
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}