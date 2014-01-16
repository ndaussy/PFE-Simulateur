<?php

//Classe gérant
class Txt_model extends CI_Model {

    public function is_in_txt_table($arraysimu)
    {
        //var_dump($arraysimu);

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
   
	public function save_Txt($filename,$name_simulation)
	{

        $etat_simu=true;

        $row = 0;

		if (($handle = fopen($filename, "r")) !== FALSE)
		{ 
			while (($line = fgets($handle, 4096)) !== FALSE)
			{
                    try
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
                        var_dump($array_sql['frame']);

                        //echo "frame =".$array_sql['frame']."\n";

                        if($this->is_in_txt_table($array_sql)==false)
                        {
                            echo "Tentative d'insertion";
                            $this->insert_data_txt($array_sql);
                        }
                        else
                        {
                            echo "déjà présent en base";
                        }

                    }

                    }Catch(Exception $ex)
                    {
                        echo "Erreur lors du traitement des données Txt, ligne n°".$c." erreur : ".$ex;
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
            echo $sql;
        }
    }

    public function delete_data_txt($name_simulation)
    {
        try
        {
            return $this->db->delete('txt', array('name_simulation' => $name_simulation));

        }Catch(SQLiteException $sql)
        {
            echo $sql;
        }
    }




    public function select_data_txt_by_time($arraysimu)
    {

        $q=$this->db->get_where('txt',$arraysimu);

        return $q->result_array();
    }

}
?>