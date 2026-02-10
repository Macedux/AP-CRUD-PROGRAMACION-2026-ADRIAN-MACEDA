<?php
class Comitatense extends Soldado {
    protected $legio; // legio I , II , III...
    protected $unidades; //Cantidad de tropas, el estandar es de 1000 pero la tardo antiguedad fue muy dura

    public function __construct($identitas,$legio,$unidades){
        parent:: __construct($identitas);
        $this->legio=$legio;
        $this->unidades=$unidades;
    }
            public function setLegio ($legio){
                $this->legio=$legio;
                
            }

            public function setUnidades($unidades)
            {
                $this->unidades = $unidades;
              
            }
            public function getLegio() {
                return $this->legio;
            }
            public function getUnidades(){  
                return $this->unidades;
            }
    }

?>