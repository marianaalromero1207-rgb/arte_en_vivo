<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- 1. Banner Principal de Bienvenida -->
<div class="hero-section">
    <h1>Bienvenido a ArteEnVivo</h1>
    <p>Ecosistema interactivo de galerías virtuales 2D y 3D</p>
    <a href="index.php?c=galeria&a=index" class="btn-hero">Explorar Galerías 3D</a>
</div>

<!-- 2. Sección de Obras Destacadas -->
<div class="recomendaciones-container">
    <div class="section-header">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <h2>✨ Recomendadas para ti</h2>
            <p>Basado en tus preferencias de arte</p>
        <?php else: ?>
            <h2>🔥 Obras Destacadas y Novedades</h2>
            <p>Explora la galería libremente. <a href="index.php?c=auth&a=login" class="link-login">Inicia sesión</a> para personalizar tus gustos.</p>
        <?php endif; ?>
    </div>

    <div class="obras-grid">
        <?php if (!empty($novedadesRecomendadas)): ?>
            <?php foreach ($novedadesRecomendadas as $obra): ?>
                <div class="obra-card">
                    <div class="obra-img-wrapper">
                        <?php 
                            $nombreImg = htmlspecialchars($obra['imagen'] ?? '');
                            // Si empieza con http es URL externa, de lo contrario busca en uploads
                            if (!empty($nombreImg) && (strpos($nombreImg, 'http://') === 0 || strpos($nombreImg, 'https://') === 0)) {
                                $imgSrc = $nombreImg;
                            } elseif (!empty($nombreImg) && file_exists(__DIR__ . '/../../public/uploads/' . $nombreImg)) {
                                $imgSrc = 'uploads/' . $nombreImg;
                            } else {
                                $imgSrc = 'assets/img/default.jpg'; // Imagen por defecto si no existe
                            }
                        ?>
                        <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($obra['titulo']) ?>" onerror="this.onerror=null; this.src='https://picsum.photos/400/300';">
                        <span class="tag-nuevo">Destacado</span>
                    </div>
                    <div class="obra-info">
                        <h3><?= htmlspecialchars($obra['titulo']) ?></h3>
                        <p class="descripcion-corta"><?= htmlspecialchars(substr($obra['descripcion'] ?? 'Sin descripción disponible.', 0, 70)) ?>...</p>
                        <div class="obra-footer">
                            <span class="precio">$<?= number_format($obra['precio'] ?? 0, 2) ?></span>
                            <a href="index.php?c=galeria&a=index" class="btn-ver">Explorar 3D</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-obras">
                <p style="color:#aaa;">No hay obras registradas por el momento.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .hero-section {
        text-align: center;
        padding: 3.5rem 1rem 2.5rem 1rem;
        background: linear-gradient(180deg, #0d0d0d 0%, #161616 100%);
        border-bottom: 1px solid #222;
    }
    .hero-section h1 { font-size: 2.5rem; color: #fff; margin-bottom: 0.5rem; }
    .hero-section p { color: #ff3b5c; font-size: 1.1rem; margin-bottom: 1.5rem; }
    .btn-hero {
        background: #ff3b5c; color: #fff; text-decoration: none;
        padding: 0.8rem 1.8rem; border-radius: 6px; font-weight: bold;
        box-shadow: 0 0 15px rgba(255, 59, 92, 0.4); display: inline-block;
    }

    .recomendaciones-container { max-width: 1100px; margin: 2rem auto; padding: 0 1.5rem; }
    .section-header h2 { font-size: 1.8rem; color: #fff; margin: 0; }
    .section-header p { color: #aaa; font-size: 0.95rem; margin-top: 0.4rem; margin-bottom: 2rem; }
    .link-login { color: #ff3b5c; text-decoration: underline; }

    .obras-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.8rem;
    }
    .obra-card {
        background: #161616; border: 1px solid #282828;
        border-radius: 10px; overflow: hidden;
    }
    .obra-img-wrapper { position: relative; height: 180px; background: #222; }
    .obra-img-wrapper img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .tag-nuevo {
        position: absolute; top: 10px; right: 10px;
        background: #ff3b5c; color: #fff; font-size: 0.75rem;
        font-weight: bold; padding: 0.2rem 0.6rem; border-radius: 4px;
    }

    .obra-info { padding: 1.2rem; }
    .obra-info h3 { font-size: 1.1rem; color: #fff; margin: 0 0 0.5rem 0; }
    .descripcion-corta { color: #888; font-size: 0.85rem; margin-bottom: 1rem; line-height: 1.3; }
    
    .obra-footer {
        display: flex; justify-content: space-between; align-items: center;
        border-top: 1px solid #222; padding-top: 0.8rem;
    }
    .obra-footer .precio { color: #4cd137; font-weight: bold; font-size: 1.1rem; }
    .obra-footer .btn-ver {
        border: 1px solid #ff3b5c; color: #ff3b5c;
        padding: 0.4rem 0.8rem; border-radius: 4px; text-decoration: none;
        font-size: 0.8rem; font-weight: bold;
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
