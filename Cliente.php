<?php

class Cliente{
    //Atributos
    private $nombre; //String
    private $apellido; //String
    private $tipoDocumento; //String
    private $numeroDocumento; //Int
    private $dadoBaja; //Boolean;

    //Constructor 
    public function __construct($unNombre, $unApellido, $unTipoDocumento, $unNumeroDocumento){
        $this->nombre=$unNombre;
        $this->apellido=$unApellido;
        $this->tipoDocumento=$unTipoDocumento;
        $this->numeroDocumento=$unNumeroDocumento;
        $this->dadoBaja=false;
    }

    //Observadores

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }
    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }
    public function getDadoBaja(){
        return $this->dadoBaja;
    }
    public function __toString(){
        $cadena="Nombre: ".$this->getNombre()."\n".
                "Apellido: ".$this->getApellido()."\n".
                "Tipo de documento: ".$this->getTipoDocumento()."\n".
                "Numero Documento: ".$this->getNumeroDocumento()."\n";
        if($this->dadoBaja){
            $cadena=$cadena."Cliente dado de baja\n";
        }else{
            $cadena=$cadena."Cliente activo\n";
        }
        return $cadena;
    }

    //Modificadores

    public function setNombre($unNombre){
        $this->nombre=$unNombre;
    }
    public function setApellido($unApellido){
        $this->apellido=$unApellido;
    }
    public function setTipoDocumento($unTipoDocumento){
        $this->tipoDocumento=$unTipoDocumento;
    }
    public function setNumeroDocumento($unNumeroDocumento){
        $this->numeroDocumento=$unNumeroDocumento;
    }
    public function setDadoBaja($unEstado){
        $this->dadoBaja=$unEstado;
    }

    //Propios

    /**
     * Verifica si el tipo y numero de documento ingresados por parametro coinciden con los del cliente
     * Retorna true si coinciden o false en caso contrario
     * @param string $tipoDocumento
     * @param int $numeroDocumento
     * @return boolean
     */
    public function verificarDocumento($tipoDocumento,$numeroDocumento){
        return ($this->getNumeroDocumento()==$numeroDocumento && $this->getTipoDocumento()==$tipoDocumento);
    }

}