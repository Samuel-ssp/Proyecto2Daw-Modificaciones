<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Deckology - Registro</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <div class="contenedor-principal-login">
        <a id="volver-atras" href="index.php?c=Usuario&m=mostrarLogin"> ⬅ Volver</a>

        <form id="formRegistro" class="formulario-base" action="index.php?c=Usuario&m=registrar" method="post">
            <h2>Crear Cuenta</h2>
            <p>Únete a la comunidad Deckology</p>
            <label>Nombre:</label>
            <input type="text" name="usuario" id="nombre" required>
            <div id="errorNombre" class="errorFormulario"></div>

            <label>Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>
            <div id="errorEmail" class="errorFormulario"></div>

            <label>Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <div id="errorPassword" class="errorFormulario"></div>

            <label>Confirmar Contraseña:</label>
            <input type="password" name="password2" id="password2" required>
            <div id="errorPassword2" class="errorFormulario"></div>
            <?php
            if (isset($datos['error'])) {
                echo "<div class='errorFormulario'>" . $datos['error'] . "</div>";
            }
            ?>
            <div class="division-con-flex">
                <a href="index.php?c=Usuario&m=mostrarLogin" class="boton cancelar">Cancelar</a>
                <button type="submit" class="boton enviar">Crear Cuenta</button>
            </div>

            <p class="texto-ayuda">
                ¿Ya tienes cuenta?
                <a href="index.php?c=Usuario&m=mostrarLogin">Inicia sesión</a>
            </p>
        </form>
    </div>
    <script src="../js/vista/registro.js"></script>
</body>

</html>