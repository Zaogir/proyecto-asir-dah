<?php
include "conex.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="estilos.css">
    <!-- Si l'usuari tria "Otro" en un títol, apareix un camp per escriure'l -->
    <script>
        function addCleseTitulo1() {
            let valor = document.getElementById('Titulo1').value;
            document.getElementById('OtroTitulo1').style.display = (valor == 'Otro') ? 'block' : 'none';
        }
        function addCleseTitulo2() {
            let valor = document.getElementById('Titulo2').value;
            document.getElementById('OtroTitulo2').style.display = (valor == 'Otro') ? 'block' : 'none';
        }
        // Validació de la lletra del DNI/NIE
        function validar(value) {
            var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
            var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
            var nieRexp = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
            var str = value.toString().toUpperCase();
            if (!nifRexp.test(str) && !nieRexp.test(str)) return alert("EL DNI/NIE no es correcte");
            var nie = str.replace(/^[X]/, '0').replace(/^[Y]/, '1').replace(/^[Z]/, '2');
            var letter = str.substr(-1);
            var charIndex = parseInt(nie.substr(0, 8)) % 23;
            if (validChars.charAt(charIndex) === letter) return true;
            return alert("EL DNI/NIE no es correcte");
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="text">Alta de Professor</div>
        <!-- Missatge d'error si el DNI introduït ja és a la base de dades -->
        <div class="error-message">
            <?php
            if (isset($error_message)) {
                echo '<p>' . $error_message . '</p>';
            }
            ?>
        </div>
        <form action="prova3.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="codigo_validacion" name="codigo_validacion" required>
                    <div class="underline"></div>
                    <label for="">Codi de Validació</label>
                </div>
                <div class="input-data">
                    <input type="text" id="dni" name="dni" required onblur="validar(this.value)">
                    <div class="underline"></div>
                    <label for="DNI">DNI</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data"><input type="text" readonly><div class="underline"></div><label for="">Nom</label></div>
                <div class="input-data"><input type="text" readonly><div class="underline"></div><label for="">1er Cognom</label></div>
            </div>
            <div class="form-row">
                <div class="input-data"><input type="text" readonly><div class="underline"></div><label for="">2on Cognom (Opcional)</label></div>
                <div class="input-data">
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="file" accept=".jpg, .jpeg, .png" id="foto" name="foto" required>
                    <div class="underline"></div>
                </div>
                <div class="input-data"><input type="email" readonly><div class="underline"></div><label for="">Email</label></div>
            </div>
            <div class="form-row">
                <div class="input-data"><input type="tel" readonly><div class="underline"></div><label for="">Telèfon</label></div>
            </div>

            <div class="text">Dades acadèmiques</div>

            <div class="form-row"><div class="input-data">Titol1</div></div>
            <div class="form-row">
                <div class="input-data" id="estudi1">
                    <select required name="estudi1">
                        <option value="" disabled selected>Seleccioni Tipus d'Estudi</option>
                        <option value="Postgrau">Postgrau</option>
                        <option value="Llicenciatura">Llicenciatura</option>
                        <option value="Grau">Grau</option>
                    </select>
                </div>
                <div class="input-data" id="titulo1">
                    <select id="Titulo1" name="titulo1" required onchange="addCleseTitulo1()">
                        <option value="" disabled selected>Nom d'Estudis</option>
                        <?php
                        // Llegim els títols de la base de dades per omplir el desplegable
                        $query = "SELECT * FROM titulos";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                        }
                        ?>
                        <option value="Otro">Introdueix un altre</option>
                    </select>
                </div>
                <div class="input-data" id="OtroTitulo1" style="display: none;">
                    <input type="text" name="OtroTitulo1" placeholder="Nom d'Estudis">
                </div>
            </div>

            <div class="form-row"><div class="input-data">Titol2</div></div>
            <div class="form-row">
                <div class="input-data" id="estudi2">
                    <select required name="estudi2">
                        <option value="" disabled selected>Seleccioni Tipus d'Estudi</option>
                        <option value="Postgrau">Postgrau</option>
                        <option value="Llicenciatura">Llicenciatura</option>
                        <option value="Grau">Grau</option>
                    </select>
                </div>
                <div class="input-data" id="titulo2">
                    <select id="Titulo2" name="titulo2" required onchange="addCleseTitulo2()">
                        <option value="" disabled selected>Nom d'Estudis</option>
                        <?php
                        // El mateix que abans, reutilitzant el resultat
                        mysqli_data_seek($result, 0);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                        }
                        ?>
                        <option value="Otro">Introdueix un altre</option>
                    </select>
                </div>
                <div class="input-data" id="OtroTitulo2" style="display: none;">
                    <input type="text" name="OtroTitulo2" placeholder="Nombre de los estudios">
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
