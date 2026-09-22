<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main style="max-width: 500px; margin: 2rem auto; padding: 2rem; background: #fff; border: 1px solid #ddd; border-radius: 6px;">
    <h2>Crear Nuevo Grupo</h2>
    <form action="index.php?c=grupo&a=crear" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        <div>
            <label style="font-weight: bold;">Nombre del Grupo:</label>
            <input type="text" name="nombre" required style="width: 100%; padding: 0.5rem; margin-top: 0.3rem;">
        </div>
        <div>
            <label style="font-weight: bold;">Descripción:</label>
            <textarea name="descripcion" rows="4" style="width: 100%; padding: 0.5rem; margin-top: 0.3rem;"></textarea>
        </div>
        <button type="submit" style="background: #ff3b5c; color: #fff; padding: 0.7rem; border: none; font-weight: bold; cursor: pointer;">Guardar Grupo</button>
    </form>
</main>