<?php
class Execution_model extends CI_Model {
     


   public function SendDataDungle($data)
   {

    try
    {
        for($nb_line=0;$nb_line<count($data);$nb_line++)
        {
        //echo $this->config->item('config_path_prog')."sendDataDungle.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id']."\n";
        //Appel de la fonction du dungle
        system($this->config->item('config_path_prog')."sendDataDungle.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id']);
        }

        return true;

    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
        return false;
    }
       
    }


    public function Gps($data)
    {

    }

    public function serveurSynchronisation()
    {

    }






}

?>