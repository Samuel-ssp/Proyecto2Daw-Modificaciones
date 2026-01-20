document.addEventListener("DOMContentLoaded", () => {
    const tabla = document.getElementById("tablaPuntuaciones");
    const filas = Array.from(tabla.querySelectorAll("tr")).slice(1);
    const filtroInput = document.getElementById("filtroNombre");
    const botonOrdenar = document.getElementById("botonOrdenar");

    let ordenAscendente = true;

    filtroInput.addEventListener("input", () => {
        const texto = filtroInput.value.toLowerCase();

        filas.forEach(fila => {
            const nombre = fila.children[0].textContent.toLowerCase();
            fila.style.display = nombre.includes(texto) ? "" : "none";
        });
    });

    botonOrdenar.addEventListener("click", () => {
        const filasOrdenadas = filas.sort((a, b) => {
            const scoreA = parseInt(a.children[1].textContent.replace(/,/g, ""));
            const scoreB = parseInt(b.children[1].textContent.replace(/,/g, ""));
            return ordenAscendente ? scoreA - scoreB : scoreB - scoreA;
        });

        filasOrdenadas.forEach(f => tabla.appendChild(f));
        ordenAscendente = !ordenAscendente;
    });
});
