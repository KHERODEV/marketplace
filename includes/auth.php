<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function verificarSesion()
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../index.php');
        exit;
    }
}

function verificarRol($roles)
{
    if (!in_array($_SESSION['usuario_rol'], (array)$roles)) {
        header('Location: ../index.php');
        exit;
    }
}

function esAdmin()
{
    return $_SESSION['usuario_rol'] === 'admin';
}

function esVendedor()
{
    return $_SESSION['usuario_rol'] === 'vendedor';
}

function esComprador()
{
    return $_SESSION['usuario_rol'] === 'comprador';
}
