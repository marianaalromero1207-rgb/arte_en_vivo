<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main style="max-width: 500px; margin: 2rem auto; padding: 2rem; background: #fff; border: 1px solid #ddd; border-radius: 6px;">
    <h2>Editar Artista</h2>
    <form action="index.php?c=artista&a=editar&id=<?= $artista['id'] ?>" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($artista['nombre']) ?>" required style="width: 100%; padding: 0.5rem;">
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($artista['email']) ?>" required style="width: 100%; padding: 0.5rem;">
        </div>
        <div>
            <label>Biografía:</label>
            <textarea name="biografia" rows="4" style="width: 100%; padding: 0.5rem;"><?= htmlspecialchars($artista['biografia'] ?? '') ?></textarea>
        </div>
        <button type="submit" style="background: #000; color: #fff; padding: 0.7rem; border: none; cursor: pointer; font-weight: bold;">Guardar Cambios</button>
    </form>
</main>