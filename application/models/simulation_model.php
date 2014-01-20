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
    $txt = new txt_model();

        if(!$this->isInSimulation($ArraySimu['name_simulation']))
        {
         $Userarray=array('name_simulation'=>$ArraySimu['name_simulation'],'username'=>$ArraySimu['username']);

         //ajout à la table usersimulation
         $this->db->insert('usersimulation',$Userarray);

         //Sauvegarde du txt
         $this->txt->save_Txt($ArraySimu['Path_txt'],$ArraySimu['name_simulation']);

         //Sauvegarde du Csv
         // $this->txt->save_Txt($ArraySimu['Path_txt'],$ArraySimu['name_simulation']);

        return true;

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

          foreach ($ArraySimu as $key => $value) 
          {
             $this->db->delete('usersimulation', array('name_simulation' => $value,'username'=>$this->session->userdata('username')));
             $this->txt_model-> delete_data_txt(array('name_simulation' => $value));
             $this->csv_model-> delete_data_csv(array('name_simulation' => $value));
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
      
         $query=$this->db->get_where('usersimulation',array('name_simulation'=>$name_simulation,'username'=>$this->session->userdata('username')), NULL, FALSE);

         return $query->result_array();
      }
      elseif($name_simulation=="all")
      {
        
         $query=$this->db->get_where('usersimulation',array('username'=>$this->session->userdata('username')), NULL, FALSE);

         return $query->result_array();
      }
      else
      {
        return false; 
      }
    }

    function isInSimulation($name_simulation)
    {

        $q = $this->db->get_where('usersimulation',array('name_simulation'=>$name_simulation,'username'=>$this->session->userdata('username')), NULL, FALSE);


       if($q->num_rows()==1)
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