<?php

include_once 'Cliente.php';
include_once 'Empresa.php';
include_once 'Moto.php';
include_once 'Importada.php';
include_once 'Nacional.php';
include_once 'Venta.php';

//Main

//Punto 1
$objCliente1=new Cliente('Juan','Perez','Dni',40100200);
$objCliente2=new Cliente('Martin','Juarez','Dni',40123123);

//Punto 2
$objMoto1=new Nacional(11,2230000,2022,'Benelli Imperiale 400',85);
$objMoto2=new Nacional(12,584000,2021,'Zanella Zr 150 Ohc',70);
$objMoto3=new Nacional(13,999900,2023,'Zanella Patagonian Eagle 250',55);
$objMoto3->setEstadoActiva(false);
$objMoto3->setPorcentajeDescuento(0);
$objMoto4=new Importada(14,12499900,2020,'Pitbike Enduro Motocross Apollo Aiii 190cc Plr',100,'Francia',6244400);

//Punto 3
$colMotos=array($objMoto1,$objMoto2,$objMoto3,$objMoto4);
$colClientes=array($objCliente1,$objCliente2);
$colVentas=array();
$unaEmpresa=new Empresa('ALta Gama','Av Argentina 123',$colMotos,$colClientes,$colVentas);

//Punto 4
$colCodigos1=array(11,12,13,14);
$precioVenta=$unaEmpresa->registrarVenta($colCodigos1,$objCliente2);
if($precioVenta>0){
    echo "Venta realizada. Total: $".$precioVenta."\n";
}else{
    echo "No se pudo realizar la venta\n";
}

//Punto 5
$colCodigos2=array(13,14);
$precioVenta=$unaEmpresa->registrarVenta($colCodigos2,$objCliente2);
if($precioVenta>0){
    echo "Venta realizada. Total: $".$precioVenta."\n";
}else{
    echo "No se pudo realizar la venta\n";
}

//Punto 6
$colCodigos3=array(14,2);
$precioVenta=$unaEmpresa->registrarVenta($colCodigos3,$objCliente2);
if($precioVenta>0){
    echo "Venta realizada. Total: $".$precioVenta."\n";
}else{
    echo "No se pudo realizar la venta\n";
}

//Punto 7
$colVentasImportadas=$unaEmpresa->informarVentasImportadas();
foreach($colVentasImportadas as $venta){
    echo $venta;
}

//Punto 8
$sumaVentasNacionales=$unaEmpresa->informarSumaVentasNacionales();
echo "Importe por ventas de motos nacionales: $".$sumaVentasNacionales."\n";

//Punto 9
echo $unaEmpresa;