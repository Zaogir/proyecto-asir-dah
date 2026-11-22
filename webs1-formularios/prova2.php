<?php
// PHPMailer (instal·lat amb Composer a /vendor) per enviar el codi de registre als professors
include "conex.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

// Genera una cadena de 6 caràcters aleatoris: és el codi que rebrà el professor
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correuProfessor = $_POST['correuProfessor'];
    // Validem que el format del correu sigui vàlid
    if (!filter_var($correuProfessor, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Error: El format del correu no es valid";
        include 'Formulari2.php';
        exit();
    }
    $nom = $_POST['nom'];
    $primerCognom = $_POST['primerCognom'];
    $segonCognom = $_POST['segonCognom'];
    $numeroTelefon = $_POST['numeroTelefon'];

    // Comprovem si ja existeix algú amb aquest correu o telèfon
    $query = "SELECT * FROM profesores WHERE correuProfessor = '$correuProfessor' OR numeroTelefon = '$numeroTelefon'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $error_message = "Error: El correu o el numero de telefon ja estan registrats";
        include 'Formulari2.php';
        exit();
    }

    $codigo = generateRandomString(6);
    $sql = "INSERT INTO profesores (correuProfessor, nom, primerCognom, segonCognom, numeroTelefon, codigo)
            VALUES ('$correuProfessor', '$nom', '$primerCognom', '$segonCognom', '$numeroTelefon', '$codigo')";

    if (mysqli_query($conn, $sql)) {
        // Enviament del correu amb PHPMailer. Cal un compte de correu existent;
        // s'usa una "contrasenya d'aplicació" (verificació en 2 passos) i les credencials venen de variables d'entorn.
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('SMTP_USER');
        $mail->Password   = getenv('SMTP_PASS');
        $mail->SMTPSecure = 'tls';
        $mail->Port       = (int)(getenv('SMTP_PORT') ?: 587);

        // Format del correu
        $mail->setFrom(getenv('SMTP_USER'));
        $mail->addAddress($correuProfessor);
        $mail->Subject = 'Codi de registre';
        $mail->Body = 'El seu codi de registre es: ' . $codigo . "\n\n" .
                      'Completi el registre en el seguent form: ' . (getenv('APP_URL') ?: 'http://localhost') . '/Formulari3.php';

        // Si el correu s'ha enviat, tornem a l'inici de sessió
        if ($mail->send()) {
            header("Location: Formulari1.php");
            exit();
        } else {
            echo 'El correo electrónico no pudo ser enviado.';
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
