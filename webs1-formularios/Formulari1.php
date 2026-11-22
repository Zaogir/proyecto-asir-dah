<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Autenticación</title>
    <link rel="stylesheet" href="estilos.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="text">Inici de sessió</div>
        <!-- L'action envia les dades a prova.php, que fa la validació -->
        <form action="prova.php" method="post">
            <?php
            // Missatge d'error (en vermell) vinculat a prova.php si l'inici de sessió és incorrecte
            if (isset($_GET['error'])) {
                $error = htmlspecialchars($_GET['error']);
                ?>
                <p class="error-message"><?php echo $error; ?></p>
                <?php
            }
            ?>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="user" name="user" required>
                    <div class="underline"></div>
                    <label for="user">Usuari</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="password" id="pass" name="pass" required>
                    <div class="underline"></div>
                    <label for="pass">Contrasenya</label>
                </div>
            </div>
            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" value="Enviar">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
