<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deckology - Dashboard de Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="contenedor-principal-admin">
        
        <nav class="barra-superior-admin">
            <ul>
                <li><a class="enlace-volver-atras" href="./pCerrarSesionAdmin.php"> ⬅ </a></li>
                <li class="titulo-dashboard">
                    <a href="pMostrarDashboard.php">Dashboard</a>
                </li>
                
                <li class="perfil-admin">
                    <a href="pPerfilAdministrador.php">
                        Hola <?php echo $_SESSION['nombreAdmin']; ?>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="contenido-dashboard">
            <h1 class="texto-principal">Selecciona una opción</h1>
            
            <div class="contenedor-opciones-admin">
                <a href="pLUsario.php">
                    <div class="tarjeta-opcion-admin">
                        <img src="./img/gestionarUsuarios.png" alt="Icono Usuarios" class="imagen-opcion">
                        <h2>Usuarios</h2>
                        <p class="descripcion-opcion">Gestiona los usuarios existentes</p>
                    </div>
                </a>
                
                <a href="../php/index.php?c=Zona&m=listar">
                    <div class="tarjeta-opcion-admin">
                        <img src="./img/gestionarZonas.png" alt="Icono Zonas" class="imagen-opcion">
                        <h2>Zonas</h2>
                        <p class="descripcion-opcion">Gestiona las zonas del juego</p>
                    </div>
                </a>
                
                <a href="../php/index.php?c=Carta&m=listarCartas">
                    <div class="tarjeta-opcion-admin">
                        <div class="icono-carta">
                            <img src="./img/gestionarCartas.png" alt="Icono Cartas" class="imagen-opcion">
                        </div>
                        <h2>Cartas</h2>
                        <p class="descripcion-opcion">Gestiona las cartas del juego</p>
                    </div>
                </a>    

                <a href="pListarEventos.php">
                    <div class="tarjeta-opcion-admin">
                        <img src="./img/gestionarEventos.png" alt="Icono Eventos" class="imagen-opcion">
                        <h2>Eventos</h2>
                        <p class="descripcion-opcion">Gestiona los eventos del juego</p>
                    </div>
                </a>

                <a href="plIconos.php">
                    <div class="tarjeta-opcion-admin">
                        <img src="./img/gestionarIconos.png" alt="Icono Eventos" class="imagen-opcion">
                        <h2>Iconos</h2>
                        <p class="descripcion-opcion">Gestiona los iconos para las cartas del juego</p>
                    </div>
                </a>

            </div>
        </div>

    </div>
</body>
</html>