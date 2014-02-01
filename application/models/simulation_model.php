<?php
class Simulation_model extends CI_Model {

    private $txt;
    private $kml;
    private $csv;
    /*
    * name_simulation
    * username
    * Path_csv
    * Path_txt
    */
    function addSimulation($ArraySimu)
   {


        if(!$this->isInSimulation($ArraySimu['name_simulation']))
        {

                $Userarray=array('name_simulation'=>$ArraySimu['name_simulation'],'state_txt'=>'Traitement non fini','state_csv'=>"Traitement non commencé");

                //ajout à la table usersimulation
                $this->db->insert('usersimulation',$Userarray);

                //Sauvegarde du txt
                $this->load->model('txt_model');
                $this->txt_model->save_txt($ArraySimu['Path_txt'],$ArraySimu['name_simulation']);

                $Userarray['state_txt']="Insertion reussite";

                $Userarray['state_csv']="Traitement non fini";

                $this->db->update('usersimulation', $Userarray, 'name_simulation = "'.$ArraySimu['name_simulation'].'"');

                //Sauvegarde du Csv
                $this->load->model('csv_model');
                $this->csv_model->save_csv($ArraySimu['Path_csv'],$ArraySimu['name_simulation']);

                $Userarray['state_csv']="Insertion reussite";
                $this->db->update('usersimulation', $Userarray, 'name_simulation = "'.$ArraySimu['name_simulation'].'"');

                return true;
        }
        else
        {
          return false;
        }

   }

    //Lancement des registers & serveurs.
    function initializationSimulation()
    {
        $this->load->model('execution_model');

        if(isset($_COOKIE))
        {
                //Service GPS
                if(strstr($_COOKIE['Option'], "rmc"))
                {
                    $this->execution_model->RegisterService("rmc",true);
                }
                if(strstr($_COOKIE['Option'], "gga"))
                {
                    $this->execution_model->RegisterService("gga",true);
                }
                //Serveur pour fin de service ( ne gére pas la synchro )

        }

    }

    //Fin de simulation -- permet d'envoyer une requête indiquant la fin de la simulation
    function finSimulation()
    {

            $host="127.0.0.1";
            $port_gga=9999;
            $port_rmc=9900;
            $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

            // create the request packet
           // $packet = "fin simulation";

             $packet =  "fin simulation";

            // UDP is connectionless, so we just send on it.
            for($a=0;$a<20;$a++)
            {
            socket_sendto($socket, $packet, strlen($packet),0, $host, $port_gga);

            socket_sendto($socket, $packet, strlen($packet),0, $host, $port_rmc);
            }

            socket_close($socket);

    }

    //[name_simulation] [time]
    function playsimulation($arrayData)
    {

       $this->load->model('execution_model');
        if(isset($_COOKIE))
        {
                $rmc=true;
                $gga=true;
                //lancer le serveur de synchronisation
                //$this->execution_model->serveurSynchronisation();

                $this->load->model('csv_model');

                $arrayDataJava=$this->csv_model->returnInformation(array('name_simulation'=>$arrayData['name_simulation'],'Scumul'=>$arrayData["time"]));
                //var_dump($arrayDataJava);
                $dataSendGpsRmc=$arrayDataJava[0]['Latitude']." ".$arrayDataJava[0]['Longitude'];
                $dataSendGpsGga=$dataSendGpsRmc;
                if($arrayDataJava[0]['Altitude']!=0)
                {
                    $rmc=true;//à mettre à false si on souhaite pas que des trames GGA soit utilisé pour le RMC
                    $gga=true;
                    $dataSendGpsGga=$dataSendGpsRmc." ".$arrayDataJava[0]['Altitude'];
                }

                //$dataSendGpsGga=$dataSendGpsRmc." 49.8954879";
                //echo $dataSendGpsGga;
                if(strstr($_COOKIE['Option'], "rmc")&&$rmc)//permet de gérer si la simulation émule ce service
                {
                    //Lancement service gps
                    $this->execution_model->Gps("rmc",$dataSendGpsRmc,true);
                }
                if(strstr($_COOKIE['Option'], "gga")&&$gga)
                {
                    //Lancement service gps

                    $this->execution_model->Gps("gga",$dataSendGpsGga,true);
                }

                if(strstr($_COOKIE['Option'], "can"))
                {
                    $this->load->model('txt_model');
                    //lancer l'execution pour le dungle

                    if($this->execution_model->SendDataDungle( $this->txt_model->returnInformation(array('name_simulation'=>$arrayData['name_simulation'],'time'=>$arrayData['time']))
                        ,true))
                    {

                    }
                    else
                    {
                        return false;
                    }
                }


        }




    }

    //format $data 'name_simulation'=>Tata Scumul=>0.0 time=>0.0 ajout d'un delta du au temps de requête
    function findSmallestTimeBetweenTxtCsv($data)
    {
       $q=' SELECT min( Scumul ) as Scumul, Longitude, Latitude, Altitude, `Navigation-Based Vehicule Speed` as VitesseNav, `Engine Speed` as TourMinute
            FROM `csv`
            WHERE Scumul > ('.$data['Scumul'].'+0.1)
                AND name_simulation = "'.$data['name_simulation'].'";';

       // echo $q;

        $q=$this->db->query($q);

        if($q->num_rows()==1)
        {
            return $q->result_array();
        }
        else
        {
            return false;
        }

    }

    //
    function deleteSimulation($ArraySimu)
    {
        $bool = true;
        foreach ($ArraySimu as $key => $value) 
        {

             if(!$this->isInSimulation($value))
             {
                $bool = false;
             }
        }
        
        if($bool)
        {
            $this->load->model('txt_model');
            $this->load->model('csv_model');
            $this->load->model('kml_model');

          foreach ($ArraySimu as $key => $value) 
          {
             $this->db->delete('usersimulation', array('name_simulation' => $value));
             $this->txt_model-> delete_data_txt(array('name_simulation' => $value));
             $this->csv_model-> delete_data_csv(array('name_simulation' => $value));
             $this->kml_model-> delete_data_kml(array('name_simulation' => $value));
          }
       

        return true;

        }
        else
        {
          return false; 
        }
    }

     function findSimulation($name_simulation)
    {
          if($this->isInSimulation($name_simulation))
          {

             $query=$this->db->get_where('usersimulation',array('name_simulation'=>$name_simulation), NULL, FALSE);

             return $query->result_array();
          }
         elseif($name_simulation=="all")
          {

             $query=$this->db->get('usersimulation');

             return $query->result_array();
          }
          else
          {
            return false;
          }
    }

    function isInSimulation($name_simulation)
    {

        $q = $this->db->get_where('usersimulation',array('name_simulation'=>$name_simulation), NULL, FALSE);


       if($q->num_rows()!=0)
       {

        return true;
       }
       else
       {

        return false;
       }

    }
	

}

	

?>