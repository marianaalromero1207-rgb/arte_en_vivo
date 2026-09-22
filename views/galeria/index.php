<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
    body { margin: 0; background-color: #0d0d0d; color: #fff; font-family: sans-serif; overflow-x: hidden; }
    .galeria-header { text-align: center; padding: 1.5rem 1rem; position: absolute; top: 70px; left: 50%; transform: translateX(-50%); z-index: 10; pointer-events: none; }
    .galeria-header h1 { margin: 0; font-size: 1.8rem; text-shadow: 0 2px 4px rgba(0,0,0,0.8); }
    .galeria-header p { margin: 0.3rem 0 0 0; color: #aaa; font-size: 0.9rem; text-shadow: 0 2px 4px rgba(0,0,0,0.8); }
    
    #canvas-container { width: 100vw; height: calc(100vh - 70px); display: block; cursor: grab; }
    #canvas-container:active { cursor: grabbing; }

    /* Modal con miniatura de la imagen arriba */
    .modal-obra { 
        display: none; 
        position: fixed; 
        bottom: 20px; 
        left: 50%; 
        transform: translateX(-50%); 
        background: rgba(18, 18, 18, 0.95); 
        border: 1px solid #ff3b5c; 
        padding: 1.2rem 1.8rem; 
        border-radius: 12px; 
        z-index: 20; 
        max-width: 460px; 
        width: 90%; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.9);
        backdrop-filter: blur(8px);
    }
    .preview-imagen-container {
        width: 100%;
        height: 180px;
        background: #000;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #333;
    }
    .preview-imagen-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .modal-obra h2 { margin: 0 0 0.3rem 0; color: #fff; font-size: 1.4rem; text-align: center; }
    .modal-obra .artista { color: #ff3b5c; font-weight: bold; font-size: 0.9rem; text-align: center; margin-bottom: 0.8rem; }
    .modal-obra .detalles-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; margin-bottom: 0.8rem; font-size: 0.8rem; background: #1a1a1a; padding: 0.6rem 0.8rem; border-radius: 6px; }
    .modal-obra .desc { color: #ccc; font-size: 0.85rem; margin-bottom: 0.8rem; text-align: center; line-height: 1.3; }
    .modal-obra .footer-info { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #333; padding-top: 0.8rem; }
    .modal-obra .precio { font-size: 1.3rem; font-weight: bold; color: #4cd137; }
    .btn-cerrar { background: #ff3b5c; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 4px; cursor: pointer; font-weight: bold; }
    .btn-cerrar:hover { background: #e02e4c; }
</style>

<div class="galeria-header">
    <h1>Exposición Virtual 3D</h1>
    <p>Haz clic sobre cualquier cuadro para desplegar sus detalles completos</p>
</div>

<div id="canvas-container"></div>

<!-- Modal Informativo con Vista Previa de la Imagen -->
<div id="modalObra" class="modal-obra">
    <div class="preview-imagen-container">
        <img id="modalImg" src="" alt="Vista previa de la obra">
    </div>

    <h2 id="modalTitulo">Nombre de la Obra</h2>
    <div id="modalArtista" class="artista">Artista: -</div>
    
    <div class="desc" id="modalDesc">Descripción completa de la obra...</div>

    <div class="detalles-grid">
        <div><strong>📍 Ubicación:</strong> <span id="modalUbicacion">Muro Frontal</span></div>
        <div><strong>🎨 Formato:</strong> Lienzo Digital 2D</div>
    </div>

    <div class="footer-info">
        <div id="modalPrecio" class="precio">$0.00</div>
        <button class="btn-cerrar" onclick="cerrarModal()">Cerrar / Volver</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

<script>
    const obrasData = <?= json_encode($obras ?? []) ?>;

    const container = document.getElementById('canvas-container');
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0x0d0d0d);

    const camera = new THREE.PerspectiveCamera(60, window.innerWidth / (window.innerHeight - 70), 0.1, 1000);
    camera.position.set(0, 2, 8);

    const renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight - 70);
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);

    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.maxPolarAngle = Math.PI / 2 - 0.01;
    controls.minDistance = 2;
    controls.maxDistance = 12;

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambientLight);

    const mainLight = new THREE.PointLight(0xffffff, 0.8, 20);
    mainLight.position.set(0, 4, 0);
    scene.add(mainLight);

    const floorGeo = new THREE.PlaneGeometry(20, 20);
    const floorMat = new THREE.MeshStandardMaterial({ color: 0x1a1a1a, roughness: 0.4 });
    const floor = new THREE.Mesh(floorGeo, floorMat);
    floor.rotation.x = -Math.PI / 2;
    scene.add(floor);

    const wallGeo = new THREE.PlaneGeometry(20, 6);
    const wallMat = new THREE.MeshStandardMaterial({ color: 0x222222 });
    const wall = new THREE.Mesh(wallGeo, wallMat);
    wall.position.set(0, 3, -8);
    scene.add(wall);

    const loader = new THREE.TextureLoader();
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();
    const cuadrosMesh = [];

    const startX = -((obrasData.length - 1) * 3.5) / 2;

    obrasData.forEach((obra, index) => {
        const posX = startX + index * 3.5;

        const frameGeo = new THREE.BoxGeometry(2.4, 3.0, 0.1);
        const frameMat = new THREE.MeshStandardMaterial({ color: 0x111111 });
        const frame = new THREE.Mesh(frameGeo, frameMat);
        frame.position.set(posX, 3, -7.9);

        const obraConUbicacion = {
            ...obra,
            ubicacion: `Pared Principal (Sector ${index + 1})`
        };

        const imgPath = 'uploads/' + obra.imagen;
        loader.load(
            imgPath,
            (texture) => {
                const canvasGeo = new THREE.PlaneGeometry(2.2, 2.8);
                const canvasMat = new THREE.MeshBasicMaterial({ map: texture });
                const canvasMesh = new THREE.Mesh(canvasGeo, canvasMat);
                canvasMesh.position.set(0, 0, 0.06);
                canvasMesh.userData = obraConUbicacion;
                frame.add(canvasMesh);
                cuadrosMesh.push(canvasMesh);
            },
            undefined,
            () => {
                const canvasGeo = new THREE.PlaneGeometry(2.2, 2.8);
                const canvasMat = new THREE.MeshStandardMaterial({ color: 0xff3b5c });
                const canvasMesh = new THREE.Mesh(canvasGeo, canvasMat);
                canvasMesh.position.set(0, 0, 0.06);
                canvasMesh.userData = obraConUbicacion;
                frame.add(canvasMesh);
                cuadrosMesh.push(canvasMesh);
            }
        );

        const spot = new THREE.SpotLight(0xffffff, 1, 8, Math.PI / 6, 0.5);
        spot.position.set(posX, 5.5, -6);
        spot.target = frame;
        scene.add(spot);
        scene.add(frame);
    });

    window.addEventListener('click', (event) => {
        const rect = renderer.domElement.getBoundingClientRect();
        mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;

        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObjects(cuadrosMesh);

        if (intersects.length > 0) {
            const data = intersects[0].object.userData;
            
            // Cargar imagen de la obra en el modal
            document.getElementById('modalImg').src = 'uploads/' + data.imagen;
            document.getElementById('modalTitulo').innerText = data.titulo;
            document.getElementById('modalArtista').innerText = "Artista: " + (data.artista_nombre || 'Sofía Morales');
            document.getElementById('modalDesc').innerText = data.descripcion || 'Sin descripción disponible.';
            document.getElementById('modalUbicacion').innerText = data.ubicacion;
            document.getElementById('modalPrecio').innerText = "$" + parseFloat(data.precio).toFixed(2);
            
            document.getElementById('modalObra').style.display = 'block';

            const targetX = intersects[0].object.parent.position.x;
            controls.target.set(targetX, 3, -7.9);
        }
    });

    function cerrarModal() {
        document.getElementById('modalObra').style.display = 'none';
        controls.target.set(0, 2, 0);
    }

    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }
    animate();

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / (window.innerHeight - 70);
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight - 70);
    });
</script>