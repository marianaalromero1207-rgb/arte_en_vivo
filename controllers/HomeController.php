<?php

class HomeController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $novedadesRecomendadas = [];
        $esVisitante = !isset($_SESSION['usuario_id']);

        // Intentar cargar modelo ObraModel o Obra
        $obraModelPath = __DIR__ . '/../models/ObraModel.php';
        if (!file_exists($obraModelPath)) {
            $obraModelPath = __DIR__ . '/../models/Obra.php';
        }

        if (file_exists($obraModelPath)) {
            require_once $obraModelPath;
            
            $nombreClase = class_exists('ObraModel') ? 'ObraModel' : (class_exists('Obra') ? 'Obra' : null);

            if ($nombreClase) {
                $obraModel = new $nombreClase();

                if (!$esVisitante) {
                    // Usuario logueado: Obtener por sus intereses
                    $usuarioModelPath = __DIR__ . '/../models/Usuario.php';
                    if (file_exists($usuarioModelPath)) {
                        require_once $usuarioModelPath;
                        if (class_exists('Usuario')) {
                            $usuarioModel = new Usuario();
                            $usuario = $usuarioModel->obtenerPorId($_SESSION['usuario_id']);
                            $interes = !empty($usuario['intereses']) ? $usuario['intereses'] : 'Abstracto';

                            if (method_exists($obraModel, 'obtenerPorInteres')) {
                                $novedadesRecomendadas = $obraModel->obtenerPorInteres($interes);
                            }
                        }
                    }
                }

                // Visitante o si no trajo recomendaciones de usuario: Mostrar últimas obras generales
                if (empty($novedadesRecomendadas)) {
                    if (method_exists($obraModel, 'obtenerTodasLasObras')) {
                        $novedadesRecomendadas = array_slice($obraModel->obtenerTodasLasObras(), 0, 4);
                    } elseif (method_exists($obraModel, 'obtenerTodas')) {
                        $novedadesRecomendadas = array_slice($obraModel->obtenerTodas(), 0, 4);
                    }
                }
            }
        }

        require_once __DIR__ . '/../views/home/index.php';
    }
}