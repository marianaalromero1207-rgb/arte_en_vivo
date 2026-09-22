<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal - ArteEnVivo</title>
    <link rel="stylesheet" href="/arte_en_vivo/public/css/styles.css">
</head>
<body>
    <main class="auth-container" style="max-width: 600px;">
        <h2>¡Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?>!</h2>
        <p><strong>Correo:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
        <p><strong>Tipo de Cuenta:</strong> <?= htmlspecialchars($usuario['tipo_cuenta'] ?? 'comprador') ?></p>
        
        <?php if (!empty($usuario['biografia'])): ?>
            <p><strong>Biografía:</strong> <?= htmlspecialchars($usuario['biografia']) ?></p>
        <?php endif; ?>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="index.php?c=auth&a=logout" class="btn-primary" style="display: inline-block; text-decoration: none;">Cerrar Sesión</a>
        </div>
    </main>
</body>
</html>

<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main style="max-width: 1000px; margin: 2rem auto; padding: 1rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Gestión de Artistas</h2>
        <a href="index.php?c=artista&a=crear" style="background: #000; color: #fff; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px; font-weight: bold;">+ Nuevo Artista</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #222; color: #fff; text-align: left;">
                <th style="padding: 0.8rem;">ID</th>
                <th style="padding: 0.8rem;">Nombre</th>
                <th style="padding: 0.8rem;">Email</th>
                <th style="padding: 0.8rem;">Biografía</th>
                <th style="padding: 0.8rem;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artistas as $art): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 0.8rem;"><?= $art['id'] ?></td>
                    <td style="padding: 0.8rem;"><strong><?= htmlspecialchars($art['nombre']) ?></strong></td>
                    <td style="padding: 0.8rem;"><?= htmlspecialchars($art['email']) ?></td>
                    <td style="padding: 0.8rem;"><?= htmlspecialchars($art['biografia'] ?? 'Sin biografía') ?></td>
                    <td style="padding: 0.8rem;">
                        <a href="index.php?c=artista&a=editar&id=<?= $art['id'] ?>" style="color: #007bff; text-decoration: none; margin-right: 0.5rem;">Editar</a>
                        <a href="index.php?c=artista&a=eliminar&id=<?= $art['id'] ?>" onclick="return confirm('¿Eliminar artista?');" style="color: #dc3545; text-decoration: none;">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>