<?php

//Classe gérant
class Txt_model extends CI_Model {
     
   
	public function save_Txt($filename,$name_simulation)
	{
		//$filename = 'C:\wamp\wwwT2_tcar_6106_2009609_0443_0_141512_161546_0_0csv';//Pour test
		//$name_simulation = "test d'insertion";
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
                    $array=explode(" ",$line);

                    //array utilisé pour l'insertion
                    $array_sql = array('name_simulation'=>$name_simulation,'time'=>"",'id'=>"",'frame'=>"");

                    //split la chaine pour verifier que le premier éléments est différents d'un chiffre
                    $chars = str_split($array[2]);

                    if(!is_int($chars[0])&&!is_int($line))//test si le premier éléments est différents d'un chiffre.
                    {
                        //Ajout du temps.
                        $array_sql['time']=$array[0];//time

                        //Ajout de l'id -- 4 Premier éléments
                        for($a=0 ; $a < 4 ; $a++)
                        {

                        $array_sql['id']=$array_sql['id'].$chars[$a];
                        }

                        ///ajout de l'éléments frame
                        for($a = 4 ; $a < count($array) ; $a++ )
                        {
                        $array_sql['frame']=$array_sql['frame'].$array[$a];
                        }
                        //echo "frame =".$array_sql['frame']."\n";

                        $this->insert_data_txt($array_sql);

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

    public function select_data_txt()
    {//fonction à définir pour la récupération
    }

}
?>