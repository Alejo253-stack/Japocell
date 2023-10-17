<?php
// Almacenar datos
$usuario = isset($_POST['login_usuario']) ? limpiar_cadena($_POST['login_usuario']) : '';
$clave = isset($_POST['login_clave']) ? limpiar_cadena($_POST['login_clave']) : '';

// Verificar campos obligatorios
if (empty($usuario) || empty($clave)) {
    mostrar_error("No has llenado todos los campos que son obligatorios");
}

// Verificar integridad de los datos
if (!es_formato_valido($usuario, "/^[a-zA-Z0-9]{4,20}$/")) {
    mostrar_error("El USUARIO no coincide con el formato solicitado");
}

if (!es_formato_valido($clave, "/^[a-zA-Z0-9$@.-]{7,100}$/")) {
    mostrar_error("Las CLAVE no coinciden con el formato solicitado");
}

$check_user = obtener_usuario($usuario);

if ($check_user && password_verify($clave, $check_user['usuario_clave'])) {
    iniciar_sesion($check_user);
    redirige("index.php?vista=home");
} else {
    mostrar_error("Usuario o clave incorrectos");
}

function mostrar_error($mensaje) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            ' . $mensaje . '
        </div>';
    exit();
}

function es_formato_valido($cadena, $patron) {
    return preg_match($patron, $cadena);
}

function obtener_usuario($usuario) {
    $conexion = conexion();

    $consulta = $conexion->prepare("SELECT * FROM usuario WHERE usuario_usuario = ?");
    $consulta->execute([$usuario]);

    return $consulta->fetch();
}

function iniciar_sesion($usuario) {
    session_start();

    $_SESSION['id'] = $usuario['usuario_id'];
    $_SESSION['nombre'] = $usuario['usuario_nombre'];
    $_SESSION['apellido'] = $usuario['usuario_apellido'];
    $_SESSION['usuario'] = $usuario['usuario_usuario'];
    $_SESSION['correo'] = $usuario['usuario_correo'];
    $_SESSION['clave'] = $usuario['usuario_clave'];
}

function redirige($url) {
    if (!headers_sent()) {
        header("Location: $url");
        exit();
    }
}
?>
