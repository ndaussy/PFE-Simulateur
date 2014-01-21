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

                $Userarray=array('name_simulation'=>$ArraySimu['name_simulation'],'state_txt'=>'Traitement non fini','state_csv'=>"Traitemment non commencé");

                //ajout à la table usersimulation
                $this->db->insert('usersimulation',$Userarray);

                //Sauvegarde du txt
                $this->load->model('txt_model');
                $this->txt_model->save_txt($ArraySimu['Path_txt'],$ArraySimu['name_simulation']);

                $Userarray['state_txt']="Insertion reussite";

                unlink($ArraySimu['Path_txt']);

                $Userarray['state_csv']="Traitement non fini";

                //Sauvegarde du Csv
                $this->load->model('csv_model');
                $this->csv_model->save_csv($ArraySimu['Path_csv'],$ArraySimu['name_simulation']);

                $Userarray['state_csv']="Insertion reussite";

                unlink($ArraySimu['Path_csv']);

                return true;
        }
        else
        {
          return false;
        }

   }

    //[name_simulation] [time]
    function playsimulation($arrayData)
    {
        $this->load->model('txt_model');

        $arrayDataDungle=$this->txt_model->returnInformation($arrayData);

       $this->load->model('execution_model');

        if($this->execution_model->SendDataDungle($arrayDataDungle,true))
        {
            //return true;
        }
        else
        {
            return false;
        }

        $this->load->model('csv_model');

        $arrayDataJava=$this->csv_model->returnInformation($arrayData);

        return $arrayData;

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