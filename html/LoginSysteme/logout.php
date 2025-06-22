<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Redirection vers la page de connexion ou la page avant authentification
header("Location: ../../html/HomePage/BeforeAuth.php");
exit();
