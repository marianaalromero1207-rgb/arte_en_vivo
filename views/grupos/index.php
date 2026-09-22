<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main style="max-width: 900px; margin: 2rem auto; padding: 1rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Grupos y Categorías de Galería</h2>
        <a href="index.php?c=grupo&a=crear" style="background: #ff3b5c; color: #fff; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px; font-weight: bold;">+ Nuevo Grupo</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #111; color: #fff; text-align: left;">
                <th style="padding: 0.8rem;">ID</th>
                <th style="padding: 0.8rem;">Nombre del Grupo</th>
                <th style="padding: 0.8rem;">Descripción</th>
                <th style="padding: 0.8rem;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $g): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 0.8rem;"><?= $g['id'] ?></td>
                    <td style="padding: 0.8rem;"><strong><?= htmlspecialchars($g['nombre']) ?></strong></td>
                    <td style="padding: 0.8rem;"><?= htmlspecialchars($g['descripcion'] ?? 'Sin descripción') ?></td>
                    <td style="padding: 0.8rem;">
                        <a href="index.php?c=grupo&a=editar&id=<?= $g['id'] ?>" style="color: #007bff; text-decoration: none; margin-right: 0.5rem;">Editar</a>
                        <a href="index.php?c=grupo&a=eliminar&id=<?= $g['id'] ?>" onclick="return confirm('¿Eliminar este grupo?');" style="color: #dc3545; text-decoration: none;">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>