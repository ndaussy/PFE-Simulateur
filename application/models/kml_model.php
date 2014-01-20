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
        //$filename='https://github.com/ndaussy/PFE-Simulateur/blob/master/kml/TCAR.kml';
        $content = utf8_encode(file_get_contents($filename));
        $kml = simplexml_load_string($content);
        var_dump($kml->StyleMap);
        var_dump($kml->Folder[0]);
        echo "Value ".(string)$kml->Folder[0];
        //var_dump($kml->Folder->Placemark->name);
       // var_dump($kml->Folder->Placemark->Point->coordinate);
        //var_dump($kml->folder->Placemark);
        /*
         * Placemark>
   <name>Boulingrin</name>
   <Point>
         *
         */

      /*  for($a=0;$a<count($kml->Placemark);$a++)
        {
            var_dump($kml->Placemark[$a]->name);

        }
        */

        return true;

    }
}
