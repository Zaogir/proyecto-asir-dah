<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari d'Autenticació de Professors</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <div class="text">Professors Vàlids</div>
        <div class="error-message">
            <?php
            // Missatge d'error vinculat a prova2.php si el correu o el telèfon ja existeixen a la base de dades
            if (isset($error_message)) {
                echo '<p>' . $error_message . '</p>';
            }
            ?>
        </div>
        <form action="prova2.php" method="post">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="correuProfessor" name="correuProfessor" required>
                    <div class="underline"></div>
                    <label for="correuProfessor">Correu del professor</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="nom" name="nom" required>
                    <div class="underline"></div>
                    <label for="nom">Nom</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="primerCognom" name="primerCognom" required>
                    <div class="underline"></div>
                    <label for="primerCognom">Primer Cognom</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="segonCognom" name="segonCognom">
                    <div class="underline"></div>
                    <label for="segonCognom">Segon Cognom (opcional)</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="tel" id="numeroTelefon" name="numeroTelefon" pattern="[0-9]{9}" required>
                    <div class="underline"></div>
                    <label for="numeroTelefon">Número de Telèfon (9 dígits)</label>
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
