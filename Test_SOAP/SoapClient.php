<?php
/**
 * Invocation du Service WEB que nous venons de créer
 */
//include('./SoapClientPort.php');

//Cette option permet d'éviter la mise en cache du WSDL, qui se renouvelle toutes les 24 heures... Pour le développement, ce n'est pas génial !!!
ini_set('soap.wsdl_cache_enabled', 0);

//On doit passer le fichier WSDL du Service en paramètre de l'objet SoapClient
$service=new SoapClient("http://127.0.0.1/PFE-Simulateur/Test_SOAP/GeolocalizationReferenceBasic.wsdl");

//On accède à la méthode de notre classe DateServeur, déclaré dans notre SoapServer
$taballservices = $service->retourDate();

echo $service->nmea_rmc();


//On renvoie le résutat de notre méthode, pour voir...
print_r($taballservices);
