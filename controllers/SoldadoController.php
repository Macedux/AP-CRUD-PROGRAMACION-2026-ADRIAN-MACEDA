<?php

class SoldadoController
{

    private $gestor;

    public function __construct($gestor)
    {
        $this->gestor = $gestor;
    }

    public function index()
    {
        ///calculos para el paginador de comitatus
        $comitatenses = $this->gestor->listarComitatenses();
        $totalComitatenses = count($comitatenses);
        $comitatensesPorPagina = 3;
        $totalPaginaComitatenses = ceil($totalComitatenses / $comitatensesPorPagina);
        $paginaActualComitatenses = $_GET["pActualComitatenses"] ?? 1;
        $comitatensesAcortados = array_slice($comitatenses, ($paginaActualComitatenses - 1) * $comitatensesPorPagina, $comitatensesPorPagina);
        
        ///calculos para el paginador de Limitanei
        $limitanei = $this->gestor->listarLimitanei();
        $totalLimitanei = count($limitanei);
        $limitaneiPorPagina = 3;
        $totalPaginaLimitanei = ceil($totalLimitanei / $limitaneiPorPagina);
        $paginaActualLimitanei = $_GET["pActualLimitanei"] ?? 1;
        $limitaneiAcortados = array_slice($limitanei, ( $paginaActualLimitanei - 1) * $limitaneiPorPagina, $limitaneiPorPagina);
        include "views/listar.php";
    }

    public function alistar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $identitas = $_POST['identitas'];
            if ($_POST['legio'] != null) {
                $legio = $_POST['legio'];
                $unidades = $_POST['unidades'];
                $vexila = new Comitatense($identitas, $legio, $unidades);
            } else {
                $frontera = $_POST['frontera'];
                $fortificacion = $_POST['fortificacion'];
                $vexila = new Limitanei($identitas, $frontera, $fortificacion);
            }
            $this->gestor->alistar($vexila);
            header("Location: index.php");
            // var_dump($_SESSION['comitatus']);
            exit();

        }
        include "views/crear.php";
    }
    public function actualizarComitatense()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->gestor->actualizarComitatense(
                $_POST['identitas'],
                $_POST['legio'],
                $_POST['unidades']
            );

            header("Location: index.php");
            exit();
        }
    }
    public function actualizarLimitanei()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->gestor->actualizarLimitanei(
                $_POST['identitas'],
                $_POST['frontera'],
                $_POST['fortificacion']
            );

            header("Location: index.php");
            exit();
        }
    }
    public function decimar()
    {

        $this->gestor->decimar($_GET['identitas']);


        header("Location: index.php");
        exit();
    }

}