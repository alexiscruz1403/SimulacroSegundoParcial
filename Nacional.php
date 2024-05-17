<?php

class Nacional extends Moto{
    //Atributos
    private $porcentajeDescuento;  //Double

    //Constructor
    public function __construct($unCodigo, $unCosto, $unAnio, $unaDescripcion, $unPorcentajeAnual){
        parent::__construct($unCodigo, $unCosto, $unAnio, $unaDescripcion, $unPorcentajeAnual);
        $this->porcentajeDescuento=15;
    }

    //Observadores
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }
    public function __toString(){
        $cadena=parent::__toString();
        $cadena.="Porcentaje descuento: ".$this->getPorcentajeDescuento()."\n";
        return $cadena;
    }

    //Modificadores
    public function setPorcentajeDescuento($unPorcentajeDescuento){
        $this->porcentajeDescuento=$unPorcentajeDescuento;
    }

    //Propios

    /**
     * Retorna el valor por el cual puede ser vendida la moto
     * @return double
     */
    public function darPrecioVenta(){
        $precioBase=parent::darPrecioVenta();
        $importeDescuento=$precioBase*($this->getPorcentajeDescuento()/100);
        $venta=$precioBase-$importeDescuento;
        return $venta;
    }

    public function esNacional(){
        return !parent::esNacional();
    }
}