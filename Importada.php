<?php

class Importada extends Moto{
    //Atributos
    private $importeImportacion;  //Double
    private $paisImportacion;  //String

    //Constructor
    public function __construct($unCodigo, $unCosto, $unAnio, $unaDescripcion, $unPorcentaje, $unPaisImportacion, $unImporteImportacion){
        parent::__construct($unCodigo, $unCosto, $unAnio, $unaDescripcion, $unPorcentaje);
        $this->importeImportacion=$unImporteImportacion;
        $this->paisImportacion=$unPaisImportacion;
    }

    //Observadores
    public function getPaisImportacion(){
        return $this->paisImportacion;
    }
    public function getImporteImportacion(){
        return $this->importeImportacion;
    }
    public function __toString(){
        $cadena=parent::__toString();
        $cadena.="Pais de importacion: ".$this->getPaisImportacion()."\n".
                "Importe de importacion: $".$this->getImporteImportacion()."\n";
        return $cadena;
    }

    //Modificadores
    public function setPaisImportacion($unPaisImportacion){
        $this->paisImportacion=$unPaisImportacion;
    }
    public function setImporteImportacion($unImporteImportacion){
        $this->importeImportacion=$unImporteImportacion;
    }

    //Propios

    /**
     * Retorna el valor por el cual puede ser vendida la moto
     * @return double
     */
    public function darPrecioVenta(){
        $precioBase=parent::darPrecioVenta();
        $venta=$precioBase+$this->getImporteImportacion();
        return $venta;
    }

    public function esImportada(){
        return !parent::esImportada();
    }
}