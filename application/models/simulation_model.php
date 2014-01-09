<?php
class Simulation_model extends CI_Model {
     
   
    function addSimulation($ArraySimu)
	   {

        if(!$this->isInSimulation($ArraySimu['name_simulation']))
        {
         
         $this->db->insert('usersimulation',$ArraySimu);

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
        
          foreach ($ArraySimu as $key => $value) 
          {
             $this->db->delete('usersimulation', array('name_simulation' => $value,'username'=>$this->session->userdata('username'))); 
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