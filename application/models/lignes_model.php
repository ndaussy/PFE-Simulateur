<?php
/**
 * Created by PhpStorm.
 * User: DAUSSY
 * Date: 04/02/14
 * Time: 15:31
 */

class Lignes_model extends CI_Model {

    public function is_in_txt_table($arraysimu)
    {

    }
    //name_simulation;
    public function retournLines($name)
    {


        $q=$this->db->get_where('lignes',$name);

        if($q->num_rows()>=1)
        {
            return $array_sql=$q->result_array();



        }
        else
        {
            $array_sql=array('0'=>"erreur query nb rows >= 1");
        }

        return $array_sql;
    }


    //name_simulation + path $filename
    public function save_lignes($array)
    {
        try
        {
            if (($handle = fopen($array['filename'], "r")) !== FALSE)
            {
                # Set the parent multidimensional array key to 0.

                $line=0;

                //creation du tableau:
                $arraytoinsert = array();
                $arraymodel= array();

                while (($data = fgetcsv($handle, 0, ";")) !== FALSE)
                {

                    if($line==0)//creation de la premiere ligne & du tableau
                    {
                        $arraymodel=array('name_simulation'=>$array['name_simulation'],
                            $data[0]=>'',
                            $data[1]=>'',
                            $data[2]=>'',
                            $data[3]=>''
                        );
                    }
                    else
                    {
                        $arraytoinsert=$arraymodel;
                        $cpt=0;
                        foreach($arraytoinsert as $key => $value )
                        {
                            if($key!='name_simulation')
                            {
                            $arraytoinsert[$key]=$data[$cpt];
                            $cpt++;
                            }
                        }

                        try
                        {
                           // var_dump($arraytoinsert);
                          $this->db->insert('lignes',$arraytoinsert);
                        }
                        catch(Exception $ex)
                        {
                            echo $ex->getMessage();
                        }

                    }

                    //insertion BDD


                    $line++;
                }
            }
        }Catch(Exception $ex)
        {
            echo $ex;
        }
    }

}