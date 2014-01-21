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
        $q = $this->db->get_where('kml',$arraysimu, NULL, FALSE);


        if($q->num_rows()==1)
        {

            return true;
        }
        else
        {

            return false;
        }
    }

    public function delete_data_kml($arraysimu)
    {
        if($this->is_in_txt_table($arraysimu))
        {
            $this->db->delete('kml',$arraysimu);

            return true;
        }
        else
        {
            return false;
        }

    }

    public function insert_data_kml($data)
    {
        try
        {


            $this->db->insert('kml',$data);
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function save_kml($filename,$simulation)
    {

        $content = utf8_encode(file_get_contents($filename));
        $kml = simplexml_load_string($content);

        $arraytoinsert=array('name_simulation'=>$simulation,
                            'arret'=>'',
                            'latitude'=>0.0,
                            'longitude'=>0.0,
                            'ligne'=>''
        );
        $arraybatch=array();


        for($b=0;$b<$kml->Document->Folder->count();$b++)
        {
            $arraytoinsert['ligne']=(string)$kml->Document->Folder[$b]->name;

            for($a=0;$a<$kml->Document->Folder[$b]->Placemark->count();$a++)
            {
                $arraytoinsert['arret']=(string)$kml->Document->Folder[$b]->Placemark[$a]->name;
                //echo "name ".(string)$kml->Document->Folder->Placemark[$a]->name;
                $data=explode(',',(string)$kml->Document->Folder[$b]->Placemark[$a]->Point->coordinates);
                $arraytoinsert['latitude']=$data[0];
                $arraytoinsert['longitude']=$data[1];

                $this->insert_data_kml($arraytoinsert);
                //$arraybatch[]=$arraytoinsert;

            }



        }

        //$this->insert_data_kml($arraybatch);

        return true;

    }

    public function getArretByLine($simu)
    {
        $q=$this->db->get_where('kml',array('ligne '=> $simu ),null,FALSE);

        if($q->num_rows()!=0)
        {
            return $q->result_array();
        }
        else
        {
            return false;
        }
    }
}
