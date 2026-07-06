<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');
require_once '../includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit;
}

$action = $_GET['action'] ?? '';
$db = getDB();

try {
    switch ($action) {

        case 'admin':
            // Total vendedores
            $stmt = $db->query("SELECT COUNT(*) as total FROM usuarios WHERE rol = 'vendedor' AND activo = true");
            $total_vendedores = $stmt->fetch()['total'];

            // Total productos
            $stmt = $db->query("SELECT COUNT(*) as total FROM productos WHERE activo = true");
            $total_productos = $stmt->fetch()['total'];

            // Total órdenes
            $stmt = $db->query("SELECT COUNT(*) as total FROM ordenes");
            $total_ordenes = $stmt->fetch()['total'];

            // Total compradores
            $stmt = $db->query("SELECT COUNT(*) as total FROM usuarios WHERE rol = 'comprador' AND activo = true");
            $total_compradores = $stmt->fetch()['total'];

            // Últimas órdenes
            $stmt = $db->query("
                SELECT
                    o.id, o.total, o.estado,
                    u.nombre || ' ' || u.apellido AS comprador,
                    TO_CHAR(o.created_at, 'DD/MM/YYYY') AS fecha
                FROM ordenes o
                JOIN usuarios u ON o.comprador_id = u.id
                ORDER BY o.created_at DESC
                LIMIT 5
            ");
            $ultimas_ordenes = $stmt->fetchAll();

            // Últimos vendedores
            $stmt = $db->query("
                SELECT
                    nombre, apellido, email, nombre_tienda,
                    TO_CHAR(created_at, 'DD/MM/YYYY') AS fecha
                FROM usuarios
                WHERE rol = 'vendedor' AND activo = true
                ORDER BY created_at DESC
                LIMIT 5
            ");
            $ultimos_vendedores = $stmt->fetchAll();

            echo json_encode([
                'success' => true,
                'data' => [
                    'total_vendedores'   => $total_vendedores,
                    'total_productos'    => $total_productos,
                    'total_ordenes'      => $total_ordenes,
                    'total_compradores'  => $total_compradores,
                    'ultimas_ordenes'    => $ultimas_ordenes,
                    'ultimos_vendedores' => $ultimos_vendedores,
                ]
            ]);
            break;

        case 'vendedor':
            $vendedor_id = $_SESSION['usuario_id'];

            // Total productos del vendedor
            $stmt = $db->prepare("SELECT COUNT(*) as total FROM productos WHERE vendedor_id = :id AND activo = true");
            $stmt->execute([':id' => $vendedor_id]);
            $total_productos = $stmt->fetch()['total'];

            // Total órdenes del vendedor
            $stmt = $db->prepare("SELECT COUNT(DISTINCT orden_id) as total FROM detalle_ordenes WHERE vendedor_id = :id");
            $stmt->execute([':id' => $vendedor_id]);
            $total_ordenes = $stmt->fetch()['total'];

            // Total ventas del vendedor
            $stmt = $db->prepare("SELECT COALESCE(SUM(subtotal), 0) as total FROM detalle_ordenes WHERE vendedor_id = :id");
            $stmt->execute([':id' => $vendedor_id]);
            $total_ventas = $stmt->fetch()['total'];

            // Productos con poco stock
            $stmt = $db->prepare("
                SELECT nombre, stock, precio
                FROM productos
                WHERE vendedor_id = :id AND activo = true AND stock <= 5
                ORDER BY stock ASC
                LIMIT 5
            ");
            $stmt->execute([':id' => $vendedor_id]);
            $poco_stock = $stmt->fetchAll();

            // Últimas órdenes del vendedor
            $stmt = $db->prepare("
                SELECT
                    do.nombre_producto, do.cantidad, do.subtotal, do.estado,
                    u.nombre || ' ' || u.apellido AS comprador,
                    TO_CHAR(do.created_at, 'DD/MM/YYYY') AS fecha
                FROM detalle_ordenes do
                JOIN ordenes o ON do.orden_id = o.id
                JOIN usuarios u ON o.comprador_id = u.id
                WHERE do.vendedor_id = :id
                ORDER BY do.created_at DESC
                LIMIT 5
            ");
            $stmt->execute([':id' => $vendedor_id]);
            $ultimas_ventas = $stmt->fetchAll();

            echo json_encode([
                'success' => true,
                'data' => [
                    'total_productos' => $total_productos,
                    'total_ordenes'   => $total_ordenes,
                    'total_ventas'    => number_format($total_ventas, 2),
                    'poco_stock'      => $poco_stock,
                    'ultimas_ventas'  => $ultimas_ventas,
                ]
            ]);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
