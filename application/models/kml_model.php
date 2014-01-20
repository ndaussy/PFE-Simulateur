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

        $content = utf8_encode(file_get_contents($filename));
        $kml = simplexml_load_string($content);


        for($a=0;$a<$kml->Document->Folder->Placemark->count();$a++)
        {
            echo "Value ".(string)$kml->Document->Folder->Placemark[$a]->name;
            echo "Value ".(string)$kml->Document->Folder->Placemark[$a]->Point->coordinates;
        }





        return true;

    }
}
