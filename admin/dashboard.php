<?php require_once '../includes/header.php'; ?>
<?php verificarRol('admin'); ?>

<div class="space-y-6">

    <!-- Título -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Dashboard</h3>
            <p class="mt-1 text-sm text-gray-500">Resumen general del marketplace</p>
        </div>
        <div class="px-4 py-2 text-sm text-gray-500 bg-white rounded-lg shadow-sm">
            <i class="mr-2 fa-regular fa-calendar"></i>
            <span id="fecha-hoy"></span>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

        <!-- Total Vendedores -->
        <div class="flex items-center gap-4 p-6 bg-white border-l-4 border-orange-500 shadow-sm rounded-xl">
            <div class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-full">
                <i class="text-xl text-orange-500 fa-solid fa-store"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Vendedores</p>
                <p class="text-2xl font-bold text-gray-800" id="total-vendedores">...</p>
            </div>
        </div>

        <!-- Total Productos -->
        <div class="flex items-center gap-4 p-6 bg-white border-l-4 border-blue-500 shadow-sm rounded-xl">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                <i class="text-xl text-blue-500 fa-solid fa-box"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Productos</p>
                <p class="text-2xl font-bold text-gray-800" id="total-productos">...</p>
            </div>
        </div>

        <!-- Total Órdenes -->
        <div class="flex items-center gap-4 p-6 bg-white border-l-4 border-green-500 shadow-sm rounded-xl">
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                <i class="text-xl text-green-500 fa-solid fa-shopping-bag"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Órdenes</p>
                <p class="text-2xl font-bold text-gray-800" id="total-ordenes">...</p>
            </div>
        </div>

        <!-- Total Compradores -->
        <div class="flex items-center gap-4 p-6 bg-white border-l-4 border-purple-500 shadow-sm rounded-xl">
            <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full">
                <i class="text-xl text-purple-500 fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Compradores</p>
                <p class="text-2xl font-bold text-gray-800" id="total-compradores">...</p>
            </div>
        </div>

    </div>

    <!-- Fila 2: Últimas órdenes + Productos destacados -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        <!-- Últimas órdenes -->
        <div class="p-6 bg-white shadow-sm rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold text-gray-800">
                    <i class="mr-2 text-orange-500 fa-solid fa-shopping-bag"></i>
                    Últimas Órdenes
                </h4>
                <a href="ordenes.php" class="text-sm text-orange-500 hover:underline">Ver todas</a>
            </div>
            <div id="lista-ordenes">
                <div class="py-8 text-center text-gray-400">
                    <i class="text-2xl fa-solid fa-spinner fa-spin"></i>
                    <p class="mt-2 text-sm">Cargando órdenes...</p>
                </div>
            </div>
        </div>

        <!-- Últimos vendedores -->
        <div class="p-6 bg-white shadow-sm rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold text-gray-800">
                    <i class="mr-2 text-blue-500 fa-solid fa-store"></i>
                    Últimos Vendedores
                </h4>
                <a href="vendedores.php" class="text-sm text-orange-500 hover:underline">Ver todos</a>
            </div>
            <div id="lista-vendedores">
                <div class="py-8 text-center text-gray-400">
                    <i class="text-2xl fa-solid fa-spinner fa-spin"></i>
                    <p class="mt-2 text-sm">Cargando vendedores...</p>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    $(document).ready(function() {

        $('#page-title').text('Dashboard');

        // Fecha de hoy
        const hoy = new Date();
        const opciones = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        $('#fecha-hoy').text(hoy.toLocaleDateString('es-CL', opciones));

        // Cargar estadísticas
        $.ajax({
            url: '../api/dashboard.php',
            method: 'GET',
            data: {
                action: 'admin'
            },
            success: function(res) {
                if (res.success) {
                    $('#total-vendedores').text(res.data.total_vendedores);
                    $('#total-productos').text(res.data.total_productos);
                    $('#total-ordenes').text(res.data.total_ordenes);
                    $('#total-compradores').text(res.data.total_compradores);

                    // Últimas órdenes
                    if (res.data.ultimas_ordenes.length > 0) {
                        let html = '';
                        const estadoColor = {
                            'pendiente': 'bg-yellow-100 text-yellow-700',
                            'pagado': 'bg-green-100 text-green-700',
                            'enviado': 'bg-blue-100 text-blue-700',
                            'entregado': 'bg-purple-100 text-purple-700',
                            'cancelado': 'bg-red-100 text-red-700'
                        };
                        res.data.ultimas_ordenes.forEach(o => {
                            html += `
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">${o.comprador}</p>
                                    <p class="text-xs text-gray-500">${o.fecha} — $${o.total}</p>
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full font-medium ${estadoColor[o.estado] || 'bg-gray-100 text-gray-600'}">
                                    ${o.estado}
                                </span>
                            </div>`;
                        });
                        $('#lista-ordenes').html(html);
                    } else {
                        $('#lista-ordenes').html('<p class="py-8 text-sm text-center text-gray-400">No hay órdenes aún</p>');
                    }

                    // Últimos vendedores
                    if (res.data.ultimos_vendedores.length > 0) {
                        let html = '';
                        res.data.ultimos_vendedores.forEach(v => {
                            html += `
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-8 h-8 bg-orange-100 rounded-full">
                                        <i class="text-xs text-orange-500 fa-solid fa-store"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">${v.nombre_tienda || v.nombre}</p>
                                        <p class="text-xs text-gray-500">${v.email}</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-400">${v.fecha}</span>
                            </div>`;
                        });
                        $('#lista-vendedores').html(html);
                    } else {
                        $('#lista-vendedores').html('<p class="py-8 text-sm text-center text-gray-400">No hay vendedores aún</p>');
                    }
                }
            },
            error: function() {
                console.log('Error al cargar estadísticas');
            }
        });

    });
</script>

<?php require_once '../includes/footer.php'; ?>