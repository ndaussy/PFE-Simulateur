<?php
/**
 * Déclaration d'une classe qui contiendra les méthodes de Service WEB, et instanciation de la classe SoapServer
 * pour rendre notre Service disponible
 *
 */


ini_set('soap.wsdl_cache_enabled', 0);


$serversoap=new SoapServer(Null,array('uri'=> '192.168.10.1/nmea_rmc'));




    function nmea_rmc()
    {

           return "<nmea_rmc>$"."GPRMC,123519,A,4807.038,N,01131.000,E,022.4,084.4,230394,003.1,W*6A </nmea_rmc>";

    }



$serversoap->addFunction('nmea_rmc');





//Ici, on dit très simplement que maintenant c'est à PHP de prendre la main pour servir le Service WEB : il s'occupera de l'encodage XML, des
//Enveloppes SOAP, de gérer les demandes clientes, etc. Bref, on en a fini avec le serveur SOAP !!!!
$serversoap->handle();