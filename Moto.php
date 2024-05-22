<?php

class Moto{

    //Atributos
    private $codigo; //Int
    private $costo; //Double
    private $anioFabricacion; //Int
    private $descripcion; //String
    private $porcentajeIncrementoAnual; //Double
    private $activa; //Boolean

    //Constructor
    public function __construct($unCodigo, $unCosto, $unAnio, $unaDescripcion, $unPorcentaje){
        $this->codigo=$unCodigo;
        $this->costo=$unCosto;
        $this->anioFabricacion=$unAnio;
        $this->descripcion=$unaDescripcion;
        $this->porcentajeIncrementoAnual=$unPorcentaje;
        $this->activa=true;
    }

    //Modificadores
    
    public function setCodigo($unCodigo){
        $this->codigo=$unCodigo;
    }

    public function setCosto($unCosto){
        $this->costo=$unCosto;
    }

    public function setAnioFabricacion($unAnio){
        $this->anioFabricacion=$unAnio;
    }

    public function setDescripcion($unaDescripcion){
        $this->descripcion=$unaDescripcion;
    }

    public function setPorcentajeIncrementoAnual($unPorcentaje){
        $this->porcentajeIncrementoAnual=$unPorcentaje;
    }

    public function setEstadoActiva($unEstado){
        $this->activa=$unEstado;
    }

    //Observadores

    public function getCodigo(){
        return $this->codigo;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPorcentajeIncrementoAnual(){
        return $this->porcentajeIncrementoAnual;
    }

    public function getEstadoActiva(){
        return $this->activa;
    }

    public function __toString(){
        $cadena="Codigo: ".$this->getCodigo()."\n".
                "Costo: $".$this->getCosto()."\n".
                "Año de fabricacion: ".$this->getAnioFabricacion()."\n".
                "Descripcion: ".$this->getDescripcion()."\n".
                "Porcentaje de incremento anual: ".$this->getPorcentajeIncrementoAnual()."%\n";
        if($this->getEstadoActiva()){
            $cadena=$cadena."Estado: Activa\n";
        }else{
            $cadena=$cadena."Estado: No activa\n";
        }
        return $cadena;
    }

    //Propios

    /**
     * Retorna el valor por el cual puede ser vendida la moto
     * @return double
     */
    public function darPrecioVenta(){
        $anio=2024-$this->getAnioFabricacion();
        $costo=$this->getCosto();
        $porcentaje=$this->getPorcentajeIncrementoAnual();
        $venta=$costo+$costo*($anio*($porcentaje/100));
        return $venta;
    }

    public function esNacional(){
        return false;
    }

    public function esImportada(){
        return false;
    }

    /**
     * Verifica si el codigo ingresado por parametro coincide con el codigo actual de la moto
     * Retorna true si coincide o false en caso contrario
     * @param int $codigo
     * @return boolean
     */
    public function verificarCodigo($codigo){
        return $this->getCodigo()==$codigo;
    }
}