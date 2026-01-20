<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Eventos</title>
    <link rel="stylesheet" href="./css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="barra-superior-admin">
        <ul>
            <li><a class="enlace-volver-atras" href="pMostrarDashboard.php"> ⬅ </a></li>
            <li class="titulo-dashboard"><a href="pMostrarDashboard.php">Dashboard</a></li>
            <li class="perfil-admin">
                <a href="pPerfilAdministrador.php">
                    Hola <?php echo $_SESSION['nombreAdmin']; ?>
                </a>
            </li>
        </ul>
    </nav>

<h1 class="titulo"> Listar Eventos</h1>

<main class="contenedor-tabla">

    <div id="busquedaCrear">
        <input type="text" id="busqueda" placeholder="🔍 Buscar"/>
        <!-- Enlace a crear (pendiente de implementar MVC si se requiere, mantenemos estructura) -->
        <a href="pVcrearEvento.php"><button class="btn-crear">Crear</button></a>
    </div>

    <table class="tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Daño</th>
                <th>Duracion</th>
                <th>Eliminar</th>
                <th>Modificar</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($eventos as $evento): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($evento['nombre']); ?>
                    <br>
                    (<?php echo htmlspecialchars($evento['codigo_icono']); ?>) 
                    - <?php echo htmlspecialchars($evento['nombre_zona']); ?>
                </td>
                <td><?php echo htmlspecialchars($evento['dano']); ?></td>
                <td><?php echo htmlspecialchars($evento['turnos_duracion']); ?></td>
                <td><button class="btn-eliminar" data-id="<?php echo $evento['id_evento']; ?>" data-type="evento">Eliminar</button></td>
                <td>
                    <a href="pModificarEvento.php?idEvento=<?php echo $evento['id_evento']; ?>">
                        <button class="btn-modificar">Modificar</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<div id="modal-confirm" style="display: none;">
    <div class="modal-content">
        <p id="modal-text"></p>
        <button id="btn-si">Sí</button>
        <button id="btn-no">No</button>
    </div>
</div>

<script src="./scripts-js/listas.js"></script>

</body>
</html>
