<?php
// Connexió a la base de dades.
// Les credencials es llegeixen de variables d'entorn (veure .env.example); mai es guarden al codi.
$serverName = getenv("DB_HOST") ?: "localhost";
$userName   = getenv("DB_USER") ?: "admin";
$password   = getenv("DB_PASS") ?: "";
$dbName     = getenv("DB_NAME") ?: "formulari";

// Creació de la connexió
$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if (mysqli_connect_errno()) {
    echo "Failed to connect!";
    exit();
}
?>
