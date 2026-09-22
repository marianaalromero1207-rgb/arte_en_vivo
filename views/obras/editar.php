<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<div style="max-width: 500px; margin: 2rem auto; background: #161616; padding: 2rem; border-radius: 8px; color: #fff; border: 1px solid #ff3b5c;">
    <h2>✏️ Editar Obra</h2>
    <form action="index.php?c=obra&a=actualizar" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $obra['id'] ?>">
        
        <label style="display:block; margin: 0.8rem 0 0.3rem;">Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($obra['titulo']) ?>" required style="width:100%; padding: 0.5rem; background: #222; color: #fff; border: 1px solid #333;">

        <label style="display:block; margin: 0.8rem 0 0.3rem;">Precio ($):</label>
        <input type="number" step="0.01" name="precio" value="<?= $obra['precio'] ?>" required style="width:100%; padding: 0.5rem; background: #222; color: #fff; border: 1px solid #333;">

        <label style="display:block; margin: 0.8rem 0 0.3rem;">Descripción:</label>
        <textarea name="descripcion" style="width:100%; padding: 0.5rem; background: #222; color: #fff; border: 1px solid #333;"><?= htmlspecialchars($obra['descripcion']) ?></textarea>

        <label style="display:block; margin: 0.8rem 0 0.3rem;">Cambiar Imagen (opcional):</label>
        <input type="file" name="imagen" accept="image/*" style="display:block; margin-bottom: 1.5rem;">

        <button type="submit" style="background: #ff3b5c; color: white; padding: 0.7rem 1.5rem; border: none; font-weight: bold; cursor: pointer; border-radius: 4px;">Guardar Cambios</button>
    </form>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>