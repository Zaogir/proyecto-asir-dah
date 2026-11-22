<?php
include "conex.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_validacion = $_POST["codigo_validacion"];
    $dni = $_POST["dni"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $ruta_foto = '';

    // Agafem la foto i la movem al directori de fotos
    if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
        $target_directory = "/var/www/html/fotos/";
        $target_file = $target_directory . basename($_FILES["foto"]["name"]);
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $ruta_foto = $target_file;
        } else {
            echo "Error al subir la foto.";
            exit();
        }
    } else {
        echo "Debes seleccionar una foto.";
        exit();
    }

    // Si el DNI ja existeix, tornem al Formulari 3 amb un error
    $query = "SELECT * FROM profesores2 WHERE dni = '$dni'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $error_message = "Error: El dni itroduit ja es a la base de dades, parli amb el conserge per solucionar el problema";
        include 'Formulari3.php';
        exit();
    }

    // Títols i tipus d'estudi del formulari
    $titulo1 = $_POST["titulo1"];
    $titulo2 = $_POST["titulo2"];
    $estudi1 = $_POST["estudi1"];
    $estudi2 = $_POST["estudi2"];

    // Si trien "Otro", el nou títol s'afegeix a la taula de títols perquè surti al següent usuari
    if ($titulo1 == "Otro") {
        $nuevo_titulo = $_POST["OtroTitulo1"];
        $insertar_titulo = "INSERT INTO titulos (nombre) VALUES ('$nuevo_titulo')";
        mysqli_query($conn, $insertar_titulo);
        $titulo1 = $nuevo_titulo;
    }
    if ($titulo2 == "Otro") {
        $nuevo_titulo = $_POST["OtroTitulo2"];
        $insertar_titulo = "INSERT INTO titulos (nombre) VALUES ('$nuevo_titulo')";
        mysqli_query($conn, $insertar_titulo);
        $titulo2 = $nuevo_titulo;
    }

    // Busquem el professor pel codi de validació: si no existeix, no s'insereix res
    $consulta_id_profesor = "SELECT id FROM profesores WHERE codigo = '$codigo_validacion'";
    $resultado = mysqli_query($conn, $consulta_id_profesor);
    $fila = mysqli_fetch_assoc($resultado);
    $id_profesor = $fila['id'];

    // Inserts de les dades del professor
    $insertar_profesor = "INSERT INTO profesores2 (id, fecha_nacimiento, dni, foto)
                          VALUES ('$id_profesor', '$fecha_nacimiento', '$dni', '$ruta_foto')";
    mysqli_query($conn, $insertar_profesor);
    $insertar_estudios1 = "INSERT INTO TitolProfe (id, tipus, nombre) VALUES ('$id_profesor', '$estudi1', '$titulo1')";
    mysqli_query($conn, $insertar_estudios1);
    $insertar_estudios2 = "INSERT INTO TitolProfe2 (id, tipus2, nombre2) VALUES ('$id_profesor', '$estudi2', '$titulo2')";
    mysqli_query($conn, $insertar_estudios2);

    echo "Les teves dades han sigut introduides correctament si tens cap dubte parla amb consergeria.";
}
?>
