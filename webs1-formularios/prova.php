<?php
include "conex.php";
$error = ""; // Variable per l'error
if (isset($_POST['user']) && isset($_POST['pass'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user = validate($_POST['user']);
    $pass = validate($_POST['pass']);
    // Les contrasenyes del conserge i l'admin estan guardades com a SHA-256
    $pass_hash = hash('sha256', $pass);
    // Busquem l'usuari introduït per verificar que existeix
    $sql = "SELECT * FROM administració WHERE nom='$user'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Comprovem que el hash coincideix amb el de la base de dades
        if ($pass_hash === $row['contrasenya']) {
            // admin -> veu les dades; conserge -> Formulari 2
            if ($row['nom'] == 'admin') {
                header("Location: dades.php");
            } elseif ($row['nom'] == 'conserge') {
                header("Location: Formulari2.php");
            } else {
                header("Location: Formulari1.php?error=Usuari no reconegut");
                exit();
            }
        } else {
            header("Location: Formulari1.php?error=Usuari o contrasenya incorrectes");
            exit();
        }
    } else {
        // L'usuari no existeix a la base de dades
        header("Location: Formulari1.php?error=Usuari o contrasenya incorrectes");
        exit();
    }
} else {
    header("Location: Formulari1.php");
    exit();
}
?>
