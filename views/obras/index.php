<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<style>
    .crud-container { max-width: 1000px; margin: 2rem auto; padding: 1rem; color: #fff; }
    .crud-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    .crud-table th, .crud-table td { border: 1px solid #333; padding: 0.8rem; text-align: left; }
    .crud-table th { background: #1f1f1f; color: #ff3b5c; }
    .btn { padding: 0.4rem 0.8rem; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 0.85rem; }
    .btn-create { background: #ff3b5c; color: #fff; display: inline-block; margin-bottom: 1rem; }
    .btn-edit { background: #e1b12c; color: #000; }
    .btn-delete { background: #e84118; color: #fff; }
</style>

<div class="crud-container">
    <h2>🎨 Gestión de Obras de Arte</h2>
    <a href="index.php?c=obra&a=crear" class="btn btn-create">+ Nueva Obra</a>

    <table class="crud-table">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $o): ?>
            <tr>
                <td><img src="uploads/<?= htmlspecialchars($o['imagen'] ?? 'default.jpg') ?>" width="50" height="50" style="object-fit:cover; border-radius:4px;"></td>
                <td><?= htmlspecialchars($o['titulo']) ?></td>
                <td>$<?= number_format($o['precio'], 2) ?></td>
                <td>
                    <a href="index.php?c=obra&a=editar&id=<?= $o['id'] ?>" class="btn btn-edit">Editar</a>
                    <a href="index.php?c=obra&a=eliminar&id=<?= $o['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar esta obra?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>