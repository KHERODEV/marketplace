<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');
require_once '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

try {
    $db = getDB();

    switch ($action) {

        case 'login':
            $email = trim($data['email'] ?? '');
            $password = trim($data['password'] ?? '');

            if (!$email || !$password) {
                echo json_encode(['success' => false, 'message' => 'Campos requeridos']);
                exit;
            }

            $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email AND activo = true LIMIT 1");
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['usuario_id']     = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_email']  = $usuario['email'];
                $_SESSION['usuario_rol']    = $usuario['rol'];
                $_SESSION['nombre_tienda']  = $usuario['nombre_tienda'];

                // Redirigir según rol
                $redirect = match ($usuario['rol']) {
                    'admin'    => 'admin/dashboard.php',
                    'vendedor' => 'vendor/dashboard.php',
                    default    => 'pages/catalogo.php'
                };

                echo json_encode(['success' => true, 'redirect' => $redirect]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
            }
            break;

        case 'registro':
            $nombre       = trim($data['nombre'] ?? '');
            $apellido     = trim($data['apellido'] ?? '');
            $email        = trim($data['email'] ?? '');
            $password     = trim($data['password'] ?? '');
            $rol          = trim($data['rol'] ?? 'comprador');
            $telefono     = trim($data['telefono'] ?? '');
            $nombre_tienda = trim($data['nombre_tienda'] ?? '');

            if (!$nombre || !$apellido || !$email || !$password) {
                echo json_encode(['success' => false, 'message' => 'Campos obligatorios incompletos']);
                exit;
            }

            if (strlen($password) < 8) {
                echo json_encode(['success' => false, 'message' => 'La contraseña debe tener mínimo 8 caracteres']);
                exit;
            }

            // Verificar email duplicado
            $stmtCheck = $db->prepare("SELECT id FROM usuarios WHERE email = :email");
            $stmtCheck->execute([':email' => $email]);
            if ($stmtCheck->fetch()) {
                echo json_encode(['success' => false, 'message' => 'El correo ya está registrado']);
                exit;
            }

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $db->prepare("
                INSERT INTO usuarios (nombre, apellido, email, password, rol, telefono, nombre_tienda)
                VALUES (:nombre, :apellido, :email, :password, :rol, :telefono, :nombre_tienda)
                RETURNING id, nombre, email, rol, nombre_tienda
            ");
            $stmt->execute([
                ':nombre'       => $nombre,
                ':apellido'     => $apellido,
                ':email'        => $email,
                ':password'     => $passwordHash,
                ':rol'          => $rol,
                ':telefono'     => $telefono ?: null,
                ':nombre_tienda' => $nombre_tienda ?: null,
            ]);

            $nuevoUsuario = $stmt->fetch();

            $_SESSION['usuario_id']     = $nuevoUsuario['id'];
            $_SESSION['usuario_nombre'] = $nuevoUsuario['nombre'];
            $_SESSION['usuario_email']  = $nuevoUsuario['email'];
            $_SESSION['usuario_rol']    = $nuevoUsuario['rol'];
            $_SESSION['nombre_tienda']  = $nuevoUsuario['nombre_tienda'];

            $redirect = match ($nuevoUsuario['rol']) {
                'admin'    => 'admin/dashboard.php',
                'vendedor' => 'vendor/dashboard.php',
                default    => 'pages/catalogo.php'
            };

            echo json_encode(['success' => true, 'redirect' => $redirect]);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
