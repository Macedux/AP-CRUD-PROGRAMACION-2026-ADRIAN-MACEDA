<?php


class GestorTropas
{


    public function __construct()
    {
        if (!isset($_SESSION['comitatus'])) {
            $_SESSION['comitatus'] = [];
        }

    }
    public function alistar($soldado) //crear dato
    {
        $_SESSION['comitatus'][] = $soldado;
    }
    public function listar() //enumerar tropas
    {
        return $_SESSION['comitatus'];
    }
    public function buscar($identitas) // buscar
    {
        foreach ($_SESSION['comitatus'] as $soldado) {
            if ($soldado->getIdentitas() == $identitas) {
                return $soldado;
            }
        }
    }
    public function actualizarComitatense($identitas, $legio, $unidades) //reforzar
    {
        foreach ($_SESSION['comitatus'] as $i => $soldado) {
            if ($soldado->getIdentitas() == $identitas) {
                $_SESSION['comitatus'][$i]->setLegio($legio);
                $_SESSION['comitatus'][$i]->setUnidades($unidades);
            }
        }
    }
    public function actualizarLimitanei($identitas, $frontera, $fortificacion)
    {
        foreach ($_SESSION['comitatus'] as $i => $soldado) {
            if ($soldado->getIdentitas() == $identitas) {
                $_SESSION['comitatus'][$i]->setFrontera($frontera);
                $_SESSION['comitatus'][$i]->setFortificacion($fortificacion);
            }
        }
    }
    public function decimar($identitas)
    {
        foreach ($_SESSION['comitatus'] as $i => $soldado) {
            if ($soldado->getIdentitas() == $identitas) {
                unset($_SESSION['comitatus'][$i]);
                $_SESSION['comitatus'] = array_values($_SESSION['comitatus']);
                break; // opcional: para parar cuando ya borró
            }
        }
    }
}

?>