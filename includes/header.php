<?php
require_once __DIR__ . '/auth.php';
verificarSesion();

$usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Usuario';
$usuario_rol    = $_SESSION['usuario_rol'] ?? '';
$nombre_tienda  = $_SESSION['nombre_tienda'] ?? '';
$pagina_actual  = basename($_SERVER['PHP_SELF']);
$carpeta_actual = basename(dirname($_SERVER['PHP_SELF']));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace — Panel</title>
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="font-sans bg-gray-50">

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-50 flex flex-col w-64 h-full text-white transition-all duration-300 bg-gray-900">

        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-700">
            <div class="flex items-center justify-center w-10 h-10 bg-orange-500 rounded-full">
                <i class="text-lg text-white fa-solid fa-store"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold leading-tight">Marketplace</h1>
                <p class="text-xs text-gray-400 capitalize"><?= htmlspecialchars($usuario_rol) ?></p>
            </div>
        </div>

        <!-- Usuario -->
        <div class="px-6 py-4 border-b border-gray-700">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center bg-orange-500 rounded-full w-9 h-9">
                    <i class="text-sm fa-solid fa-user"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold"><?= htmlspecialchars($usuario_nombre) ?></p>
                    <?php if ($nombre_tienda): ?>
                        <p class="text-xs text-gray-400"><?= htmlspecialchars($nombre_tienda) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Menú -->
        <nav class="flex-1 px-4 py-4 overflow-y-auto">

            <?php if ($usuario_rol === 'admin'): ?>
                <p class="px-2 mb-3 text-xs font-semibold tracking-wider text-gray-500 uppercase">Administración</p>
                <a href="../admin/dashboard.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'dashboard.php' && $carpeta_actual === 'admin' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a href="../admin/vendedores.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'vendedores.php' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-store"></i>
                    <span>Vendedores</span>
                </a>
                <a href="../admin/categorias.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'categorias.php' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-tags"></i>
                    <span>Categorías</span>
                </a>
                <a href="../admin/productos.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'productos.php' && $carpeta_actual === 'admin' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-box"></i>
                    <span>Productos</span>
                </a>
                <a href="../admin/ordenes.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'ordenes.php' && $carpeta_actual === 'admin' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-shopping-bag"></i>
                    <span>Órdenes</span>
                </a>
            <?php endif; ?>

            <?php if ($usuario_rol === 'vendedor'): ?>
                <p class="px-2 mb-3 text-xs font-semibold tracking-wider text-gray-500 uppercase">Mi Tienda</p>
                <a href="../vendor/dashboard.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'dashboard.php' && $carpeta_actual === 'vendor' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a href="../vendor/productos.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'productos.php' && $carpeta_actual === 'vendor' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-box"></i>
                    <span>Mis Productos</span>
                </a>
                <a href="../vendor/ordenes.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition <?= $pagina_actual === 'ordenes.php' && $carpeta_actual === 'vendor' ? 'bg-orange-500 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?>">
                    <i class="w-5 text-center fa-solid fa-shopping-bag"></i>
                    <span>Mis Órdenes</span>
                </a>
            <?php endif; ?>

            <!-- Ir al catálogo -->
            <div class="mt-4">
                <p class="px-2 mb-3 text-xs font-semibold tracking-wider text-gray-500 uppercase">Tienda</p>
                <a href="../pages/catalogo.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-1 transition text-gray-300 hover:bg-gray-800 hover:text-white">
                    <i class="w-5 text-center fa-solid fa-shop"></i>
                    <span>Ver Catálogo</span>
                </a>
            </div>

        </nav>

        <!-- Logout -->
        <div class="px-4 py-4 border-t border-gray-700">
            <a href="../api/logout.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-red-600 hover:text-white transition">
                <i class="w-5 text-center fa-solid fa-right-from-bracket"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>

    </aside>

    <!-- Contenido principal -->
    <div class="flex flex-col min-h-screen ml-64">

        <!-- Header superior -->
        <header class="sticky top-0 z-40 flex items-center justify-between px-6 py-4 bg-white shadow-sm">
            <div class="flex items-center gap-3">
                <button id="toggle-sidebar" class="text-gray-500 transition hover:text-orange-500">
                    <i class="text-xl fa-solid fa-bars"></i>
                </button>
                <h2 id="page-title" class="text-lg font-semibold text-gray-700">Dashboard</h2>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">
                    <i class="mr-1 fa-regular fa-clock"></i>
                    <span id="reloj"></span>
                </span>
                <div class="flex items-center gap-2">
                    <div class="flex items-center justify-center w-8 h-8 bg-orange-500 rounded-full">
                        <i class="text-xs text-white fa-solid fa-user"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700"><?= htmlspecialchars($usuario_nombre) ?></span>
                </div>
            </div>
        </header>

        <!-- Área de contenido -->
        <main class="flex-1 p-6">