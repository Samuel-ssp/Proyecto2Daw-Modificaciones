<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear evento</title>
        <link rel="stylesheet" href="./css/estiloAdmin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav class="barra-superior-admin">
            <ul>
                <li><a class="enlace-volver-atras" href="pListarEventos.php"> ⬅ </a></li>
                <li class="titulo-dashboard"><a href="pMostrarDashboard.php">Dashboard</a></li>
                <li class="perfil-admin">
                    <a href="pPerfilAdministrador.php">Hola <?php echo $_SESSION['nombreAdmin']; ?></a>
                </li>
            </ul>
        </nav>
        <main class="mainEstrecho">
            <form class="formulario" action="pFuncionCrearEvento.php" method="POST">
                <h1>Crear nuevo evento</h1>
                
                <?php if(isset($mensaje) && !empty($mensaje)): ?>
                    <p style="color: red; font-weight: bold; text-align: center;"><?php echo $mensaje; ?></p>
                <?php endif; ?>

                <input type="hidden" name="idAdmin" value="<?php echo $idAdmin; ?>">

                <label>Nombre del evento</label>
                <input type="text" name="nombre" required/>

                <label>Descripción</label>
                <input type="text" name="descripcion"/>

                <label>Daño</label>
                <input type="number" name="dano" required/>

                <label>Rondas</label>
                <input type="number" name="turnos_duracion" required/>

                <label>Zona</label>
                <select name="id_zona">
                    <?php foreach($zonas as $zona): ?>
                        <option value="<?php echo $zona['id_Zona']; ?>">
                            <?php echo htmlspecialchars($zona['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Icono</label>
                <select name="id_icono">
                    <?php foreach($iconos as $icono): ?>
                        <option value="<?php echo $icono['id_icono']; ?>">
                            <?php echo htmlspecialchars($icono['codigo']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="seccionBotones">
                    <a href="pListarEventos.php">
                        <button type="button" id="cancelar">Cancelar</button>
                    </a>
                    <input id="modificar" type="submit" value="Crear"/>
                </div>
                
            </form>
        </main>
    </body>
</html>