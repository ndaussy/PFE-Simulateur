<?php
/**
 * Created by PhpStorm.
 * User: DAUSSY
 * Date: 19/01/14
 * Time: 17:19
 */

//Classe gérant
class Kml_model extends CI_Model {

    public function is_in_txt_table($arraysimu)
    {

    }

    public function save_kml($filename,$simulation)
    {
        $kml = new SimpleXMLElement($filename);

        /*
         * Placemark>
   <name>Boulingrin</name>
   <Point>
         *
         */

        for($a=0;$a<count($kml->Placemark);$a++)
        {
            var_dump($kml->Placemark[$a]->name);

        }

        return true;

    }
}
