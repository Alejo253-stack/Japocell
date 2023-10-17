<?php
// Establecer conexión a la base de datos
function conectarBaseDeDatos() {
    $host = 'localhost';
    $db = 'inventarios_japocell';
    $usuario = 'root';
    $contrasena = '101002349500';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $usuario, $contrasena);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

// Verificar datos
function verificarDatos($filtro, $cadena) {
    return !preg_match("/^$filtro$/", $cadena);
}

// Limpiar cadenas de texto
function limpiarCadena($cadena) {
    $cadena = trim($cadena);
    $cadena = strip_tags($cadena);
    $cadena = htmlspecialchars($cadena);
    $cadena = preg_replace('/[^a-zA-Z0-9_\-$.@]/', '', $cadena);
    return $cadena;
}

// Función para renombrar fotos
function renombrarFotos($nombre) {
    $nombre = str_replace([' ', '/', '#', '-', '$', '.', ','], '_', $nombre);
    $nombre = $nombre . '_' . rand(0, 100);
    return $nombre;
}

// Función para generar paginación de tablas
function paginadorTablas($pagina, $Npaginas, $url, $botones) {
    $tabla = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';
    $ci = 0;

    if ($pagina <= 1) {
        $tabla .= '<a class="pagination-previous is-disabled" disabled>Anterior</a><ul class="pagination-list">';
    } else {
        $tabla .= '<a class="pagination-previous" href="' . $url . ($pagina - 1) . '">Anterior</a><ul class="pagination-list"><li><a class="pagination-link" href="' . $url . '1">1</a></li><li><span class="pagination-ellipsis">&hellip;</span></li>';
    }

    for ($i = $pagina; $i <= $Npaginas; $i++) {
        if ($ci >= $botones) {
            break;
        }
        $ci++;
        $tabla .= '<li><a class="pagination-link' . ($pagina == $i ? ' is-current' : '') . '" href="' . $url . $i . '">' . $i . '</a></li>';
    }

    if ($pagina == $Npaginas) {
        $tabla .= '</ul><a class="pagination-next is-disabled" disabled>Siguiente</a>';
    } else {
        $tabla .= '<li><span class="pagination-ellipsis">&hellip;</span></li><li><a class="pagination-link" href="' . $url . $Npaginas . '">' . $Npaginas . '</a></li></ul><a class="pagination-next" href="' . $url . ($pagina + 1) . '">Siguiente</a>';
    }

    $tabla .= '</nav>';
    return $tabla;
}
