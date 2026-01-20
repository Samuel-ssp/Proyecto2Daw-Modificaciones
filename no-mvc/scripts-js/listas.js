document.addEventListener('DOMContentLoaded', () => {

    // --- Buscador ---
    const inputBusqueda = document.getElementById('busqueda');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keyup', (e) => {
            const termino = e.target.value.toLowerCase();
            const filas = document.querySelectorAll('.tabla tbody tr');

            filas.forEach(fila => {
                const texto = fila.textContent.toLowerCase();
                if (texto.includes(termino)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    }

    // --- Modal Eliminar ---
    const modal = document.getElementById('modal-confirm');
    const btnsEliminar = document.querySelectorAll('.btn-eliminar');
    const btnSi = document.getElementById('btn-si');
    const btnNo = document.getElementById('btn-no'); // Cambiado de btn-cancelar a btn-no segun HTML
    const textoModal = document.getElementById('modal-text');

    let idAEliminar = null;
    let tipoEntidad = null;

    if (modal) {
        btnsEliminar.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const fila = e.target.closest('tr');
                const nombre = fila.querySelector('td').innerText.split('(')[0].trim();
                idAEliminar = e.target.getAttribute('data-id');
                tipoEntidad = e.target.getAttribute('data-type'); // evento, usuario, icono

                textoModal.textContent = `¿Estás seguro de que deseas eliminar este elemento: "${nombre}"?`;
                modal.style.display = 'flex';
            });
        });

        if (btnNo) {
            btnNo.addEventListener('click', () => {
                modal.style.display = 'none';
                idAEliminar = null;
                tipoEntidad = null;
            });
        }

        if (btnSi) {
            btnSi.addEventListener('click', () => {
                if (idAEliminar && tipoEntidad) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const idAdmin = urlParams.get('id'); // ID de sesión (admin)

                    if (idAdmin) {
                        let url = '';
                        if (tipoEntidad === 'evento') {
                            url = `pFuncionEliminarEvento.php?idEvento=${idAEliminar}&idAdmin=${idAdmin}`;
                        } else if (tipoEntidad === 'usuario') {
                            // Se envía 'id' para el usuario a eliminar y 'idAdmin' para mantener sesión
                            url = `pEliminarUsuario.php?id=${idAEliminar}&idAdmin=${idAdmin}`;
                        } else if (tipoEntidad === 'icono') {
                            url = `pEliminarIconos.php?id=${idAEliminar}&idAdmin=${idAdmin}`;
                        }

                        if (url) {
                            window.location.href = url;
                        } else {
                            alert("Error: Tipo de entidad desconocido.");
                        }
                    } else {
                        alert("Error: No se pudo identificar al administrador.");
                    }
                }
                modal.style.display = 'none';
            });
        }

        // Cerrar al hacer click fuera
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
                idAEliminar = null;
                tipoEntidad = null;
            }
        }
    }
});
