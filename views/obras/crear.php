<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main style="max-width: 600px; margin: 2rem auto; padding: 2rem; background: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px;">
    <h2>Subir Nueva Obra de Arte</h2>

    <?php if (isset($error)): ?>
        <p style="color: red; background: #ffe6e6; padding: 0.5rem; border-radius: 4px;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="index.php?c=obra&a=crear" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
        <div>
            <label for="titulo" style="font-weight: bold; display: block; margin-bottom: 0.3rem;">Título de la Obra *</label>
            <input type="text" id="titulo" name="titulo" required style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div>
            <label for="precio" style="font-weight: bold; display: block; margin-bottom: 0.3rem;">Precio ($) *</label>
            <input type="number" id="precio" name="precio" step="0.01" min="0" required style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div>
            <label for="descripcion" style="font-weight: bold; display: block; margin-bottom: 0.3rem;">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>

        <div>
            <label for="imagen" style="font-weight: bold; display: block; margin-bottom: 0.3rem;">Imagen de la Obra *</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required style="width: 100%;">
        </div>

        <button type="submit" style="background-color: #000000; color: #ffffff; padding: 0.8rem; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
            Publicar Obra
        </button>
    </form>
</main>