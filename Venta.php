<?php

class Venta{

    //Atributos
    private $numero; //Int
    private $fecha; //String
    private $objCliente; //Instancia Cliente
    private $colObjMoto; //Arreglo Instancias Moto
    private $precioFinal; //Double

    //Constructor
    public function __construct($unNumero, $unaFecha, $unCliente, $unArregloMoto, $unPrecio){
        $this->numero=$unNumero;
        $this->fecha=$unaFecha;
        $this->objCliente=$unCliente;
        $this->colObjMoto=$unArregloMoto;
        $this->precioFinal=$unPrecio;
    }

    //Modificadores
    public function setNumero($unNumero){
        $this->numero=$unNumero;
    }

    public function setFecha($unaFecha){
        $this->fecha=$unaFecha;
    }

    public function setCliente($unCliente){
        $this->objCliente=$unCliente;
    }

    public function setColeccionMotos($unArregloMoto){
        $this->colObjMoto=$unArregloMoto;
    }

    public function setPrecioFinal($unPrecioFinal){
        $this->precioFinal=$unPrecioFinal;
    }

    //Observadores
    public function getNumero(){
        return $this->numero;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getCliente(){
        return $this->objCliente;
    }
    
    public function getColeccionMotos(){
        return $this->colObjMoto;
    }

    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    public function __toString(){
        $cadena="Codigo: ".$this->getNumero()."\n".
                "Fecha: ".$this->getFecha()."\n".
                "Cliente: ".$this->getCliente()->getNombre()." ".$this->getCliente()->getApellido()."\n".
                "Cantidad de motos: ".count($this->getColeccionMotos())."\n";
        return $cadena;
    }

    //Propios

    /**
     * Agrega una instancia de la clase moto al arreglo de colObjMoto
     * Debe cumplirse que el usuario no este dado de baja y que la moto este en estado activa
     * Devuelve true si se pudo ingresar la moto o false en caso contrario
     * @param Moto $unaMoto
     * @return boolean
     */
    public function incorporarMoto($unaMoto){
        $incorporado=false;
        if(!$this->getCliente()->getDadoBaja() && $unaMoto->getEstadoActiva()){
            $arreglo=$this->getColeccionMotos();
            array_push($arreglo,$unaMoto);
            $this->setColeccionMotos($arreglo);
            $incorporado=true;
            $this->setPrecioFinal($this->getPrecioFinal()+$unaMoto->darPrecioVenta());
        }
        return $incorporado;
    }

    /**
     * Retorna  la sumatoria del precio venta de cada una de las motos Nacionales vinculadas a la venta
     * Si no se encuentran motos nacionales devuelve 0
     * @return double
     */
    public function retornarTotalVentaNacional(){
        $total=0;
        $coleccionMotos=$this->getColeccionMotos();
        foreach($coleccionMotos as $moto){
            if($moto->esNacional()){
                $total=$total+$moto->darPrecioVenta();
            }
        }
        return $total;
    }

    /**
     * Retorna una colección de motos importadas vinculadas a la venta
     * Si no se encuentran motos importadas en la venta devuelve una coleccion vacia
     */
    public function retornarMotosImportadas(){
        $motosImportadas=[];
        $coleccionMotos=$this->getColeccionMotos();
        foreach($coleccionMotos as $motos){
            if($motos->esImportada()){
                $motosImportadas[]=$motos;
            }
        }
        return $motosImportadas;
    }

}