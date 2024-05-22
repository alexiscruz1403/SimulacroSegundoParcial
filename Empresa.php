<?php

class Empresa{

    //Atributos
    private $denominacion; //String
    private $direccion; //String
    private $colObjCliente; //Coleccion de Objetos Cliente
    private $colObjMoto; //Coleccion de Objetos Moto
    private $colObjVenta; //Coleccion de Objetos Venta

    //Constructor
    public function __construct($unaDenominacion, $unaDireccion, $unArregloMoto, $unArregloCliente, $unArregloVenta){
        $this->denominacion=$unaDenominacion;
        $this->direccion=$unaDireccion;
        $this->colObjMoto=$unArregloMoto;
        $this->colObjCliente=$unArregloCliente;
        $this->colObjVenta=$unArregloVenta;
    }

    //Observadores
    public function getDenominacion(){
        return $this->denominacion;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getColeccionMotos(){
        return $this->colObjMoto;
    }
    public function getColeccionClientes(){
        return $this->colObjCliente;
    }
    public function getColeccionVentas(){
        return $this->colObjVenta;
    }
    public function __toString(){
        return "Denominacion: ".$this->getDenominacion()."\n".
                "Direccion: ".$this->getDireccion()."\n".
                "Cantidad de motos: ".count($this->getColeccionMotos())."\n".
                "Cantidad de clientes: ".count($this->getColeccionClientes())."\n".
                "Cantidad de ventas: ".count($this->getColeccionVentas())."\n";
    }

    //Modificadores
    public function setDenominacion($unaDenominacion){
        $this->denominacion=$unaDenominacion;
    }
    public function setDireccion($unaDireccion){
        $this->direccion=$unaDireccion;
    }
    public function setColeccionMotos($unArregloMoto){
        $this->colObjMoto=$unArregloMoto;
    }
    public function setColeccionClientes($unArregloCliente){
        $this->colObjCliente=$unArregloCliente;
    }
    public function setColeccionVentas($unArregloVenta){
        $this->colObjVenta=$unArregloVenta;
    }

    //Propios

    /**
     * Retorna el objeto Moto dentro de la coleccion de motos cuyo codigo coincida con el ingresado por parametro
     * Si no se encuentra el codigo cargado en la coleccion, retorna null
     * @param string $unCodigo
     * @return Moto
     */
    public function retornaMoto($codigoMoto){
        $encontrado=false;
        $moto=null;
        $coleccionMotos=$this->getColeccionMotos();
        $cantidadMotos=count($coleccionMotos);
        $i=0;
        while($i<$cantidadMotos && !$encontrado){
            if($coleccionMotos[$i]->verificarCodigo($codigoMoto)){
                $moto=$coleccionMotos[$i];
                $encontrado=true;
            }
            $i++;
        }
        return $moto;
    }

    /**
     * Agrega una venta a la coleccion de ventas
     * @param Venta $unaVenta
     */
    public function agregarVenta($unaVenta){
        $arregloVentas=$this->getColeccionVentas();
        array_push($arregloVentas,$unaVenta);
        $this->setColeccionVentas($arregloVentas);
    }

    /**
     * Crea una instancia venta y la agrega a la coleccion de ventas
     * Antes verifica que el cliente no esta dado de baja
     * Antes verifica que las motos esten disponibles para la venta
     * Si una moto no esta disponible, no la agrega a la venta pero si a las demas
     * La venta se cancela si el cliente esta dado de baja o si ninguna moto esta a la venta
     * Devuelve el precio final si se pudo registrar la venta o -1 en caso contrario
     * @param array $colCodigosMoto
     * @param Cliente $unCliente
     * @return boolean
     */
    public function registrarVenta($colCodigosMoto, $unCliente){
        if(!$unCliente->getDadoBaja()){
            $arregloMotoVenta=array();
            $unaVenta=new Venta(0,0,$unCliente,$arregloMotoVenta,0);
            foreach($colCodigosMoto as $codigo){
                $moto=$this->retornaMoto($codigo);
                if($moto!=null){
                    $unaVenta->incorporarMoto($moto);
                    $moto->setEstadoActiva(false);
                }
            }
            if(count($unaVenta->getColeccionMotos())!=0){
                echo "INGRESE LOS DATOS DE LA VENTA\n";
                echo "Numero de venta: ";
                $numero=trim(fgets(STDIN));
                echo "Fecha: ";
                $fecha=trim(fgets(STDIN));
                $unaVenta->setNumero($numero);
                $unaVenta->setFecha($fecha);
                $this->agregarVenta($unaVenta);
                $precioFinal=$unaVenta->getPrecioFinal();
            }
            else{
                $precioFinal=-1;
            }
        }else{
            $precioFinal=-1;
        }
        return $precioFinal;
    }

    /**
     * Retorna una coleccion de ventas realizadas al cliente cuyo tipo y numero de documento coinciden con los ingresados por parametro
     * Si no encuentran ventas realizada a ese cliente, retorna una coleccion vacia
     * @param string $tipoDocumento
     * @param int $numeroDocumento
     * @return array
     */
    public function retornarVentasXCliente($tipoDocumento,$numeroDocumento){
        $arregloVentas=array();
        foreach($this->getColeccionVentas() as $venta){
            if($venta->getCliente()->verificarDocumento($tipoDocumento,$numeroDocumento)){
                array_push($arregloVentas,$venta);
            }
        }
        return $arregloVentas;
    }

    /**
     * Recorre la colección de ventas realizadas por la empresa y retorna el importe total de ventas Nacionales
     * Si no se vendieron motos nacionales devuelve 0
     * @return double
     */
    public function informarSumaVentasNacionales(){
        $coleccionVentas=$this->getColeccionVentas();
        $total=0;
        foreach($coleccionVentas as $venta){
            $total+=$venta->retornarTotalVentaNacional();
        }
        return $total;
    }

    /**
     * Recorre la colección de ventas realizadas por la empresa y retorna una colección de ventas de motos  importadas
     * Si en la venta al menos una de las motos es importada la venta debe ser informada
     * Si no se encuentran ventas con motos importadas vinculadas, retorna una coleccion vacia
     * @return array
     */
    public function informarVentasImportadas(){
        $coleccionVentasConImportadas=[];
        $coleccionVentas=$this->getColeccionVentas();
        foreach($coleccionVentas as $venta){
            $motosImportadasEnVenta=$venta->retornarMotosImportadas();
            if(count($motosImportadasEnVenta)!=0){
                $coleccionVentasConImportadas[]=$venta;
            }
        }
        return $coleccionVentasConImportadas;
    }
}