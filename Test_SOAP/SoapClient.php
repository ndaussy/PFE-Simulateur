<?php
try
{

$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
//socket_connect($sock,"239.255.42.21", 10000); //=> port ou répondre
socket_connect($sock,"239.255.42.21",5353);//=>  port ou s'identifer ,
socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1);
//$buf = "<nmea_rmc> $"."GPRMC,123519,A,4807.038,N,01131.000,E,022w.4,084.4,230394,003.1,W*6A </nmea_rmc>";
$buf = "_gps._ebsf_socket._udp.local";//<symbolic name>._<protocol>.<domain>

socket_write($sock,$buf,strlen($buf));
socket_close($sock);

$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

}
Catch(Exception $ex)
{
    echo $ex;
}
echo "Broadcast";
?>
