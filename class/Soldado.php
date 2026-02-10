<?php
class Soldado
{
    protected $identitas;

    public function __construct($identitas)
    {
        $this->identitas = $identitas;
    }
    public function getIdentitas()
    {
        return $this->identitas;
    }
}
