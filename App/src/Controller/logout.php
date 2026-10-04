<?php
// vide et detruit la session
$_SESSION = [];
session_destroy();

// redirection vers l'accueil
header('Location: /');
exit;