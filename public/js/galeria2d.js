function abrirModalObra(obra) {
    document.getElementById('modalImg').src = 'uploads/' + obra.imagen_url;
    document.getElementById('modalTitulo').innerText = obra.titulo;
    document.getElementById('modalCategoria').innerText = 'Categoría: ' + obra.categoria;
    document.getElementById('modalDescripcion').innerText = obra.descripcion || 'Sin descripción disponible.';
    document.getElementById('modalPrecio').innerText = '$' + parseFloat(obra.precio).toFixed(2) + ' USD';
    
    // Enlaces de acción
    document.getElementById('btnComprar').href = 'index.php?c=pago&a=checkout&id_obra=' + obra.id;
    document.getElementById('btnContactar').href = 'index.php?c=mensaje&a=nuevo&id_obra=' + obra.id;

    document.getElementById('modalObra').classList.remove('hidden');
}

function cerrarModal() {
    document.getElementById('modalObra').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera del contenido
window.onclick = function(event) {
    const modal = document.getElementById('modalObra');
    if (event.target === modal) {
        cerrarModal();
    }
};