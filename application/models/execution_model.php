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
            //echo $this->config->item('config_path_prog')a."sendDataDungle.exe ".$data[$nb_line]['frame']." ".$dta[$nb_line]['time']." ".$data[$nb_line]['id']."\n";
            //Appel de la fonction du dungle
            $dataFinal="";
            $dataFinal=$dataFinal." ".$data[$nb_line]['frame']." ".$data[$nb_line]['id']." ";

        }

        if($exe==true)
        {
            //echo  $this->config->item('config_path_prog')."Test_Projet.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id'];
            //echo 'lancement process';
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                //lancement asynchrone.
                //pclose(popen($this->config->item('config_path_prog_dungle')." F3 00 00 0C FF FF FF FF FEF1 "  , "r"));
                pclose(popen($this->config->item('config_path_prog_dungle').$dataFinal , "r"));

            } else {

                system($this->config->item('config_path_prog')."Test_Projet.exe ".$dataFinal." $!");

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


    public function Gps($type,$data,$exe)
    {
        if($exe==true)
        {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                if($type=="gga")
                {
                   $port=44200;
                }
                elseif($type=="rmc")
                {
                   $port=44100;
                }
                //lancement asynchrone.//3 ou 4 argument, 1er argument port d'envoi exemple 3 argument == gga //
                //format data = Latitude Longitude Altitude
                pclose(popen($this->config->item('config_path_prog_gps')." ".$port." ".$data , "r"));

            } else {

                system($this->config->item('config_path_prog')."ServeurSynchro.jar  $!");

            }
        }
    }

    public function RegisterService($name,$exe)
    {
        if($exe==true)
        {
            $port=450;
            //echo  $this->config->item('config_path_prog')."Test_Projet.exe ".$data[$nb_line]['frame']." ".$data[$nb_line]['time']." ".$data[$nb_line]['id'];
            //echo 'lancement process'; 1 argument nom du service, 2 eme argument nom du port ou le service sera consommé
            //adresse par default == 239.255.42.21
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                //definition des ports
                if($name=='gga')
                {$port=44200;
                 $port_message_fin=9999;}
                if($name=='rmc')
                {$port=44100;
                $port_message_fin=9900;}
                //lancement asynchrone.
                pclose(popen($this->config->item('config_path_prog_register')." gps_".$name." ".$port." ".$port_message_fin, "r"));

            } else {

                system($this->config->item('config_path_prog_register').""."  $!");

            }



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