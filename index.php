<?php
// Enlace a repositorio github :  https://github.com/Macedux/AP-CRUD-PROGRAMACION-2026-ADRIAN-MACEDA.git
require_once "autoload.php";
session_start();


// 1. Creamos la implementación concreta
$gestor = new GestorTropas();

// 2. Se la pasamos al controlador
$controller = new SoldadoController($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {

    case 'reclutar':
        $controller->alistar();
        break;


    case 'editarComitatense':
        $controller->actualizarComitatense();
        break;

    case 'editarLimitanei':
        $controller->actualizarLimitanei();
        break;

    case 'decimar':
        $controller->decimar();
        break;

    default:
        $controller->index();
}
?>