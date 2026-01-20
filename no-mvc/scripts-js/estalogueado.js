/*Nada mas cargar la pagina q haga todo esto*/
document.addEventListener('DOMContentLoaded', () => {

    /*-------Controlar sesion-------*/

    // Obtenemos el estado desde la variable global inyectada o por defecto false
    let estaLogueado = window.estaLogueado || false;

    /*Local storage para invitado*/
    let estaLogueadoLS = localStorage.getItem('estaLogueado');
    if (estaLogueadoLS) {
        estaLogueado = estaLogueadoLS;
    } else if (estaLogueado === true) {
        localStorage.removeItem('estaLogueado');
    }

    const enlacePerfil = document.querySelector('a[href^="pPerfilUsuario.php"]');
    const botonSesion = document.getElementById('boton-sesion');

    if (estaLogueado === true) {
        //con el usuario logeado los estilos de Perfil no se tocan y en el select de sesion solo se muestra Cerrar Sesión

        botonSesion.textContent = 'Cerrar Sesión';
        /*Cuando seleccione cerrar sesion href a acceso y estaLogueado flase*/

        botonSesion.addEventListener('click', () => {
            // Redirect to MVC Logout
            window.location.href = "../php/index.php?c=Usuario&m=cerrarSesion";
        });


    } else {
        enlacePerfil.style.display = 'none';

        botonSesion.textContent = 'Iniciar Sesión';
        botonSesion.addEventListener('click', () => {
            localStorage.removeItem('estaLogueado');
            window.location.href = "../php/index.php?c=Usuario&m=mostrarLogin";
        });
    }


    /*----PopUp*/

    const botonComoJugar = document.getElementById('boton-como-jugar');
    const popup = document.getElementById('popup-reglas');
    const botonCerrar = popup.querySelector('.cerrar-popup');

    botonComoJugar.addEventListener('click', () => {
        popup.style.display = 'block';
    });

    if (botonCerrar) {
        botonCerrar.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    }
});