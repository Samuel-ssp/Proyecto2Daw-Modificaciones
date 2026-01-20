/*Nada mas cargar la pagina q haga todo esto*/
document.addEventListener('DOMContentLoaded', () => {

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