<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $config['config_path_prog_dungle'] = 'start C:/wamp/www/PFE-Simulateur/application/prog_C/Test_Projet.exe';
    $config['config_path_prog_serveur'] = 'start java -jar C:/wamp/www/PFE-Simulateur/application/prog_C/ServeurSynchro.jar';
    $config['config_path_prog_gps'] = 'start java -jar C:/wamp/www/PFE-Simulateur/application/prog_C/GpsRegister.jar';
} else {
    $config['config_path_prog'] = 'var/www/prog_C/';
}

 
/* End of file site.php */
/* Location: ./system/application/config/config_path_prog.php */