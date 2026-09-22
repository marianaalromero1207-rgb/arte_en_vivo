<div class="galeria-2d-container theme-<?= htmlspecialchars($galeria['estilo_tema']) ?>">
    <div class="galeria-header">
        <h2><?= htmlspecialchars($galeria['titulo']) ?></h2>
        <p class="artista-credito">Por: <strong><?= htmlspecialchars($galeria['artista_nombre']) ?></strong></p>
        <p><?= htmlspecialchars($galeria['descripcion']) ?></p>
    </div>

    <!-- Navegación Virtual 2D (Muro de Salón de Arte) -->
    <div class="virtual-wall" id="virtualWall">
        <?php if (empty($obras)): ?>
            <p class="empty-gallery">Esta galería aún no tiene obras expuestas.</p>
        <?php else: ?>
            <?php foreach ($obras as $index => $obra): ?>
                <div class=" cuadro-2d" onclick="abrirModalObra(<?= htmlspecialchars(json_encode($obra)) ?>)">
                    <div class="marco-arte">
                        <img src="uploads/<?= htmlspecialchars($obra['imagen_url']) ?>" alt="<?= htmlspecialchars($obra['titulo']) ?>">
                    </div>
                    <div class="ficha-tecnica-placa">
                        <span>#<?= $index + 1 ?></span>
                        <p class="titulo-obra"><?= htmlspecialchars($obra['titulo']) ?></p>
                        <p class="precio-obra">$<?= number_format($obra['precio'], 2) ?> USD</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para inspección detallada de obra -->
<div id="modalObra" class="modal-obra hidden">
    <div class="modal-content">
        <span class="close-btn" onclick="cerrarModal()">&times;</span>
        <div class="modal-body">
            <div class="modal-img-container">
                <img id="modalImg" src="" alt="">
            </div>
            <div class="modal-info">
                <h3 id="modalTitulo"></h3>
                <p id="modalCategoria" class="badge"></p>
                <p id="modalDescripcion"></p>
                <h4 id="modalPrecio" class="precio-destacado"></h4>
                <div class="modal-acciones">
                    <a id="btnComprar" href="#" class="btn btn-success">Comprar Obra</a>
                    <a id="btnContactar" href="#" class="btn btn-secondary">Contactar Artista</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/galeria2d.js"></script>