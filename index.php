<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace — Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="min-h-screen bg-gray-50">

    <!-- Header -->
    <header class="px-6 py-4 bg-white shadow-sm">
        <div class="flex items-center justify-between max-w-6xl mx-auto">
            <div class="flex items-center gap-2">
                <i class="text-2xl text-orange-500 fa-solid fa-store"></i>
                <h1 class="text-xl font-bold text-gray-800">Marketplace</h1>
            </div>
        </div>
    </header>

    <!-- Contenido -->
    <div class="max-w-md px-6 mx-auto mt-16">

        <!-- Tabs -->
        <div class="flex mb-6 overflow-hidden bg-white shadow-sm rounded-xl">
            <button id="tab-login" class="flex-1 py-3 text-sm font-semibold text-white transition bg-orange-500">
                Iniciar Sesión
            </button>
            <button id="tab-registro" class="flex-1 py-3 text-sm font-semibold text-gray-500 transition hover:bg-gray-50">
                Registrarse
            </button>
        </div>

        <!-- Formulario Login -->
        <div id="form-login" class="p-8 bg-white shadow-sm rounded-2xl">
            <div class="mb-6 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-3 bg-orange-100 rounded-full">
                    <i class="text-2xl text-orange-500 fa-solid fa-store"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Bienvenido</h2>
                <p class="mt-1 text-sm text-gray-500">Ingresa tus credenciales para continuar</p>
            </div>

            <div id="alerta-login" class="flex items-center hidden gap-2 px-4 py-3 mb-5 text-sm text-red-700 border border-red-200 rounded-lg bg-red-50">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span id="mensaje-login"></span>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Correo electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" id="login-email" placeholder="correo@ejemplo.com"
                        class="w-full py-3 pl-10 pr-4 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-1 text-sm font-medium text-gray-700">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" id="login-password" placeholder="••••••••"
                        class="w-full py-3 pl-10 pr-10 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                    <button type="button" id="toggle-login-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <button id="btn-login" class="flex items-center justify-center w-full gap-2 py-3 font-semibold text-white transition bg-orange-500 rounded-lg shadow-sm hover:bg-orange-600">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Iniciar Sesión</span>
            </button>
        </div>

        <!-- Formulario Registro -->
        <div id="form-registro" class="hidden p-8 bg-white shadow-sm rounded-2xl">
            <div class="mb-6 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-3 bg-orange-100 rounded-full">
                    <i class="text-2xl text-orange-500 fa-solid fa-user-plus"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Crear Cuenta</h2>
                <p class="mt-1 text-sm text-gray-500">Únete a nuestro marketplace</p>
            </div>

            <div id="alerta-registro" class="flex items-center hidden gap-2 px-4 py-3 mb-5 text-sm text-red-700 border border-red-200 rounded-lg bg-red-50">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span id="mensaje-registro"></span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nombre *</label>
                    <input type="text" id="registro-nombre" placeholder="Nombre"
                        class="w-full px-3 py-3 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Apellido *</label>
                    <input type="text" id="registro-apellido" placeholder="Apellido"
                        class="w-full px-3 py-3 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Correo electrónico *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" id="registro-email" placeholder="correo@ejemplo.com"
                        class="w-full py-3 pl-10 pr-4 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Teléfono</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-phone"></i>
                    </span>
                    <input type="text" id="registro-telefono" placeholder="+56 9 1234 5678"
                        class="w-full py-3 pl-10 pr-4 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Tipo de cuenta *</label>
                <select id="registro-rol" class="w-full px-3 py-3 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="comprador">Comprador</option>
                    <option value="vendedor">Vendedor</option>
                </select>
            </div>

            <div id="campo-tienda" class="hidden mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Nombre de tu tienda *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-store"></i>
                    </span>
                    <input type="text" id="registro-tienda" placeholder="Nombre de tu tienda"
                        class="w-full py-3 pl-10 pr-4 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-1 text-sm font-medium text-gray-700">Contraseña *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" id="registro-password" placeholder="Mínimo 8 caracteres"
                        class="w-full py-3 pl-10 pr-10 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                    <button type="button" id="toggle-registro-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <button id="btn-registro" class="flex items-center justify-center w-full gap-2 py-3 font-semibold text-white transition bg-orange-500 rounded-lg shadow-sm hover:bg-orange-600">
                <i class="fa-solid fa-user-plus"></i>
                <span>Crear Cuenta</span>
            </button>
        </div>

        <p class="mt-6 text-sm text-center text-gray-400">
            © 2026 Marketplace — Todos los derechos reservados
        </p>
    </div>

    <script>
        $(document).ready(function() {

            // Tabs
            $('#tab-login').click(function() {
                $('#form-login').removeClass('hidden');
                $('#form-registro').addClass('hidden');
                $('#tab-login').addClass('bg-orange-500 text-white').removeClass('text-gray-500');
                $('#tab-registro').removeClass('bg-orange-500 text-white').addClass('text-gray-500');
            });

            $('#tab-registro').click(function() {
                $('#form-registro').removeClass('hidden');
                $('#form-login').addClass('hidden');
                $('#tab-registro').addClass('bg-orange-500 text-white').removeClass('text-gray-500');
                $('#tab-login').removeClass('bg-orange-500 text-white').addClass('text-gray-500');
            });

            // Mostrar campo tienda si es vendedor
            $('#registro-rol').change(function() {
                if ($(this).val() === 'vendedor') {
                    $('#campo-tienda').removeClass('hidden');
                } else {
                    $('#campo-tienda').addClass('hidden');
                }
            });

            // Toggle passwords
            $('#toggle-login-password').click(function() {
                togglePassword('#login-password', this);
            });
            $('#toggle-registro-password').click(function() {
                togglePassword('#registro-password', this);
            });

            function togglePassword(input, btn) {
                const tipo = $(input).attr('type') === 'password' ? 'text' : 'password';
                $(input).attr('type', tipo);
                $(btn).find('i').toggleClass('fa-eye fa-eye-slash');
            }

            // Login
            $('#btn-login').click(function() {
                const email = $('#login-email').val().trim();
                const password = $('#login-password').val().trim();

                if (!email || !password) {
                    mostrarAlerta('#alerta-login', '#mensaje-login', 'Por favor completa todos los campos');
                    return;
                }

                $(this).html('<i class="fa-solid fa-spinner fa-spin"></i> Ingresando...').prop('disabled', true);

                $.ajax({
                    url: 'api/auth.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        action: 'login',
                        email,
                        password
                    }),
                    success: function(res) {
                        if (res.success) {
                            window.location.href = res.redirect;
                        } else {
                            mostrarAlerta('#alerta-login', '#mensaje-login', res.message);
                            resetBtn('#btn-login', 'fa-right-to-bracket', 'Iniciar Sesión');
                        }
                    },
                    error: function() {
                        mostrarAlerta('#alerta-login', '#mensaje-login', 'Error de conexión, intenta nuevamente');
                        resetBtn('#btn-login', 'fa-right-to-bracket', 'Iniciar Sesión');
                    }
                });
            });

            // Registro
            $('#btn-registro').click(function() {
                const datos = {
                    action: 'registro',
                    nombre: $('#registro-nombre').val().trim(),
                    apellido: $('#registro-apellido').val().trim(),
                    email: $('#registro-email').val().trim(),
                    telefono: $('#registro-telefono').val().trim(),
                    rol: $('#registro-rol').val(),
                    nombre_tienda: $('#registro-tienda').val().trim(),
                    password: $('#registro-password').val()
                };

                if (!datos.nombre || !datos.apellido || !datos.email || !datos.password) {
                    mostrarAlerta('#alerta-registro', '#mensaje-registro', 'Por favor completa los campos obligatorios');
                    return;
                }

                if (datos.password.length < 8) {
                    mostrarAlerta('#alerta-registro', '#mensaje-registro', 'La contraseña debe tener mínimo 8 caracteres');
                    return;
                }

                if (datos.rol === 'vendedor' && !datos.nombre_tienda) {
                    mostrarAlerta('#alerta-registro', '#mensaje-registro', 'Por favor ingresa el nombre de tu tienda');
                    return;
                }

                $(this).html('<i class="fa-solid fa-spinner fa-spin"></i> Creando cuenta...').prop('disabled', true);

                $.ajax({
                    url: 'api/auth.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(datos),
                    success: function(res) {
                        if (res.success) {
                            window.location.href = res.redirect;
                        } else {
                            mostrarAlerta('#alerta-registro', '#mensaje-registro', res.message);
                            resetBtn('#btn-registro', 'fa-user-plus', 'Crear Cuenta');
                        }
                    },
                    error: function() {
                        mostrarAlerta('#alerta-registro', '#mensaje-registro', 'Error de conexión, intenta nuevamente');
                        resetBtn('#btn-registro', 'fa-user-plus', 'Crear Cuenta');
                    }
                });
            });

            // Enter para login
            $('#login-password').keypress(function(e) {
                if (e.which === 13) $('#btn-login').click();
            });

            function mostrarAlerta(alerta, mensaje, texto) {
                $(mensaje).text(texto);
                $(alerta).removeClass('hidden');
                setTimeout(() => $(alerta).addClass('hidden'), 4000);
            }

            function resetBtn(btn, icon, texto) {
                $(btn).html(`<i class="fa-solid ${icon}"></i> ${texto}`).prop('disabled', false);
            }

        });
    </script>
</body>

</html>