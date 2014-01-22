<?php
class Execution_model extends CI_Model {
     

   //exec -- true pour executé la ligne de commande
   //$data -- donnée à envoyé au programme format [0]=>[frame],[id],['time]
   public function SendDataDungle($data,$exe)
   {

    try
    {
        for($nb_line=0;$nb_line<count($data);$nb_line++)
        {
            //echo $this->config->item('config_path_prog')."sendDataDungle.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id']."\n";
            //Appel de la fonction du dungle

            if($exe==true)
            {
                //echo  $this->config->item('config_path_prog')."Test_Projet.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id'];
                echo 'lancement process';
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    //lancement asynchrone.
                    pclose(popen($this->config->item('config_path_prog_dungle')." ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id'], "r"));

                } else {

                    system($this->config->item('config_path_prog')."Test_Projet.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id']." $!");

                }



            }

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
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            //lancement asynchrone.
            pclose(popen($this->config->item('config_path_prog_gps')." ", "r"));

        } else {

            system($this->config->item('config_path_prog')."ServeurSynchro.jar  $!");

        }
    }

    public function serveurSynchronisation()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            //lancement asynchrone.
            pclose(popen($this->config->item('config_path_prog_serveur')." ", "r"));

        } else {

            system($this->config->item('config_path_prog')."ServeurSynchro.jar  $!");

        }


    }






}

?>