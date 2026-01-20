/*Local storage para invitado*/

document.addEventListener('DOMContentLoaded', () => {
  const botonInvitado = document.querySelector('.boton-invitado');

  if (botonInvitado) {
    botonInvitado.addEventListener('click', () => {
      localStorage.setItem('estaLogueado', false);
      window.location.href = "pMostrarZonas.php";
    });
  }
});