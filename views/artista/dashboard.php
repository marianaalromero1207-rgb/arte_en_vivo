<div class="container">
    <h2>Panel de Artista - Mis Galerías 2D</h2>
    
    <!-- Formulario para crear galería -->
    <div class="card card-form">
        <h3>Crear Nueva Galería Virtual</h3>
        <form action="index.php?c=artista&a=crearGaleria" method="POST">
            <input type="text" name="titulo" placeholder="Título de la Galería" required>
            <textarea name="descripcion" placeholder="Descripción de la exposición"></textarea>
            <select name="estilo_tema">
                <option value="minimalista">Minimalista Blanco</option>
                <option value="clasico_madera">Clásico Marco de Madera</option>
                <option value="oscuro_galeria">Galería Nocturna Única</option>
            </select>
            <button type="submit" class="btn btn-primary">Crear Galería</button>
        </form>
    </div>

    <!-- Lista de galerías -->
    <h3>Tus Galerías Creadas</h3>
    <div class="grid-galerias">
        <?php foreach ($galerias as $g): ?>
            <div class="galeria-card">
                <h4><?= htmlspecialchars($g['titulo']) ?></h4>
                <p><?= htmlspecialchars($g['descripcion']) ?></p>
                <small>Tema: <?= htmlspecialchars($g['estilo_tema']) ?></small>
                <a href="index.php?c=artista&a=verGaleria&id=<?= $g['id'] ?>" class="btn">Gestionar Obras</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>