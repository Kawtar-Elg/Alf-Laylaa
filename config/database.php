<?php
$host = "127.0.0.1";        
$port = 3308; 
$dbname = "alf-laylaa";      
$username = "root";          
$password = "";            

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "✅ Connexion réussie !";
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
