<?php
class Limitanei extends Soldado
{
    protected $frontera; // oriental/occidental
    protected $fortificacion; // "torre", "castellum", "castrum", "muralla", "civitas"

    public function __construct($identitas, $frontera, $fortificacion)
    {
        parent::__construct($identitas);
        $this->frontera = $frontera;
        $this->fortificacion = $fortificacion;
    }
    public function setFrontera($frontera)
    {
        $this->frontera = $frontera;

    }

    public function setFortificacion($fortificacion)
    {
        $this->fortificacion = $fortificacion;

    }
    public function getFrontera()
    {
        return $this->frontera;
    }
    public function getFortificacion()
    {
        return $this->fortificacion;
    }
}

?>