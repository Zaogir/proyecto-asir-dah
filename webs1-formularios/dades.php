<?php
include "conex.php";
// INNER JOIN de totes les taules per tenir tota la informació del professor
$query = "SELECT profesores.id, profesores.nom, profesores.primerCognom, profesores.segonCognom,
                 profesores.correuProfessor, profesores.numeroTelefon,
                 profesores2.fecha_nacimiento, profesores2.dni, profesores2.foto,
                 TitolProfe.tipus, TitolProfe.nombre AS nombre_titulo,
                 TitolProfe2.tipus2, TitolProfe2.nombre2
          FROM profesores
          INNER JOIN profesores2 ON profesores.id = profesores2.id
          INNER JOIN TitolProfe  ON profesores.id = TitolProfe.id
          INNER JOIN TitolProfe2 ON profesores.id = TitolProfe2.id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="es" <?php if ($count > 1) echo 'class="multiple-profesores"'; ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informació de Profesors</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <h1>Informació de Profesor</h1>
    <?php
    // Mostrem els resultats amb un while per si hi ha més d'un professor
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="profesor">';
        echo '<img src="' . strstr($row['foto'], '/fotos/') . '" alt="Foto">';
        echo '<h2>' . $row['nom'] . ' ' . $row['primerCognom'] . ' ' . $row['segonCognom'] . '</h2>';
        echo '<p><strong>Correu:</strong> ' . $row['correuProfessor'] . '</p>';
        echo '<p><strong>Número de Telefon:</strong> ' . $row['numeroTelefon'] . '</p>';
        echo '<p><strong>Fecha de Naixement:</strong> ' . $row['fecha_nacimiento'] . '</p>';
        echo '<p><strong>DNI:</strong> ' . $row['dni'] . '</p>';
        echo '<p><strong>Titol:</strong> ' . $row['tipus'] . ' - ' . $row['nombre_titulo'] . '</p>';
        echo '<p><strong>Titol:</strong> ' . $row['tipus2'] . ' - ' . $row['nombre2'] . '</p>';
        echo '</div>';
    }
    ?>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
