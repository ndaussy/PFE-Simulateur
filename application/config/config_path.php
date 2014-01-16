<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $config['config_path_prog'] = 'C:/wamp/www/PFE-Simulateur/application/prog_C/';
} else {
    $config['config_path_prog'] = 'var/www/prog_C/';
}

 
/* End of file site.php */
/* Location: ./system/application/config/config_path_prog.php */