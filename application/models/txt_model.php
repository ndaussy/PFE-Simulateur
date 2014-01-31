<?php

//Classe gérant
class Txt_model extends CI_Model {

    public function is_in_txt_table($arraysimu)
    {


        $q=$this->db->query('SELECT * FROM txt WHERE
                                     name_simulation = "'.$arraysimu['name_simulation'].'"
                                     AND time = '.$arraysimu['time'].'
                                     AND id = "'.$arraysimu['id'].'"
                                     AND frame = "'.$arraysimu['frame'].'";'
                            , FALSE);



        //$q = $this->db->get_where('txt',$arraysimu, NULL, FALSE);
        //var_dump($q);

        if($q->num_rows()!=0)
        {
            return true;

        }
        else
        {

            return false;
        }

    }

    //format du tableau recçu [0] => ['time'] ['name_simulation']
    public function returnInformation($arrayInfo)
    {

        $q=$this->db->query('SELECT * FROM txt WHERE
                                     name_simulation = "'.$arrayInfo['name_simulation'].'"
                                     AND time = '.$arrayInfo['time'].';'
                            , FALSE);

        if($q->num_rows()!=0)
        {
            $array_sql=$q->result_array();
            
            for($nb_line=0;$nb_line<count($array_sql);$nb_line++)
            {
                $frame = str_split ($array_sql[$nb_line]['frame'], 2);

                $array_sql[$nb_line]['frame']=$frame[0]." ".$frame[1]." ".$frame[2]." ".$frame[3]." ".$frame[4]." ".$frame[5]." ".$frame[6]." ".$frame[7];
            }


        }
        else
        {
            $array_sql=array('0'=>array('time'=>0,'id'=>0,'frame'=>0));
        }

        return $array_sql;
    }

	public function save_txt($filename,$name_simulation)
	{

        // for set memory limit & execution time
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '6780');

        $etat_simu=true;

        $row = 0;

		if (($handle = fopen($filename, "r")) !== FALSE)
		{ 
			while (($line = fgets($handle, 4096)) !== FALSE)
			{
                    try
                    {
                   
                    if(strlen(trim($line)))//si la ligne n'est pas vide
                    {

                    //Test de l'id avant ajout.
                    //$array[2]--id
                    //$array[0]--time
                    //$array[4]++ -- frame
                    $array_from_explode=explode(" ",$line);

                    //array utilisé pour l'insertion
                    $array_sql = array('name_simulation'=>$name_simulation,'time'=>"",'id'=>"",'frame'=>"");

                    //split la chaine pour verifier que le premier éléments est différents d'un chiffre
                    $chars = str_split($array_from_explode[2]);

                    if($this->is_integer_char($chars[0])==false)//test si le premier éléments est différents d'un chiffre.
                    {
                        //Ajout du temps.
                        $array_sql['time']=$array_from_explode[0];//time

                        //Ajout de l'id -- 4 Premier éléments
                        for($a=0 ; $a < 4 ; $a++)
                        {
                        $array_sql['id']=$array_sql['id'].$chars[$a];
                        }

                        ///ajout de l'éléments frame
                        for($a = 4 ; $a < (count($array_from_explode)) ; $a++ )//-2 pour supprimer les élements\n
                        {
                        $array_sql['frame']=$array_sql['frame'].$array_from_explode[$a];
                        }
                        $array_sql['frame']=trim($array_sql['frame']);



                        if($this->is_in_txt_table($array_sql)==false)
                        {

                            $this->insert_data_txt($array_sql);
                        }


                    }
                    }

                    }Catch(Exception $ex)
                    {
                        //echo "Erreur lors du traitement des données Txt, ligne n°".$c." erreur : ".$ex;
                        $etat_simu=false;
                    }


            }

            fclose($handle);

            if($etat_simu)
            {
                unlink($filename);

            }

            return $etat_simu;
        }

        $etat_simu=false;

        return  $etat_simu;

	}

    private function is_integer_char($v)
    {
        $i = intval($v);
        if ("$i" == "$v") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Format du model : time => temps relatif
    //                    id  => id de la trame
    //                  frame => trame
    public function insert_data_txt($data)
    {
        try
        {
           return $this->db->insert('txt',$data);
        }Catch(Exception $sql)
        {
            echo $sql->getMessage();
        }
    }

    public function delete_data_txt($Array_name_simulation)
    {
        try
        {
            if($this->is_in_txt($Array_name_simulation))
            {
            $this->db->delete('txt', $Array_name_simulation);
            return true;
            }
            else
            {
             return false;
            }
        }Catch(SQLiteException $sql)
        {
            echo $sql->getMessage();
        }
    }

    public function is_in_txt($arraySimulationName)
    {
        $q=$this->db->get_where('txt',$arraySimulationName);

        if($q->num_rows()!=0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }


    public function select_data_txt_by_time($arraysimu)
    {

        $q=$this->db->get_where('txt',$arraysimu);

        return $q->result_array();
    }

}
?>