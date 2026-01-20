<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Deckology - Pantalla de Acceso</title>
  <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>
  <div class="contenedor-principal-acceso">

    <button class="boton-admin">
      <a href="pLoginAdmin.php">Administrador</a>
    </button>

    <div class="seccion-logo">
      <img src="./img/Logo.png" alt="Logo Deckology" class="logo">
      <p class="subtitulo">Aprende a proteger el planeta mientras juegas</p>
    </div>

    <div class="caja-login">



      <div class="botones-login">
        <a href="../php/index.php?c=Usuario&m=mostrarLogin" class="boton">Iniciar sesión</a>
        <a href="../php/index.php?c=Usuario&m=mostrarRegistro" class="boton">Registrarse</a>
      </div>
      <a href="../php/index.php?c=Usuario&m=mostrarZonas">
        <button class="boton-invitado">Entrar como Invitado</button>
      </a>

    </div>

    <p class="pie-de-pagina">Proyecto educativo</p>

  </div>
  <script type="module" src="./scripts-js/botonInvitado-acceso.js"></script>
</body>

</html>