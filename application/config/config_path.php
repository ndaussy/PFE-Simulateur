<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $config['config_path_prog_dungle'] = 'start '.base_url().'/application/prog_C/Test_Projet.exe';
    $config['config_path_prog_serveur'] = 'start java-jar '.base_url().'/application/prog_C/ServeurSynchro.jar';
    $config['config_path_prog_gps'] = 'start java-jar '.base_url().'/application/prog_C/ServeurSynchro.jar';
} else {
    $config['config_path_prog'] = base_url();
}

 
/* End of file site.php */
/* Location: ./system/application/config/config_path_prog.php */