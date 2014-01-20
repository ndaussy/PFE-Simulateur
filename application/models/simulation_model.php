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


             if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
             {

            echo 'not yet implemented on win serveur';

            return false;

            }
            else
            {

                $Userarray=array('name_simulation'=>$ArraySimu['name_simulation'],'username'=>$ArraySimu['username']);

                //ajout à la table usersimulation
                $this->db->insert('usersimulation',$Userarray);



                //UNIX
                function shutdown() {
                    posix_kill(posix_getpid(), SIGHUP);
                }



                // Switch over to daemon mode.

                if ($pid = pcntl_fork())
                    return;     // Parent

                ob_end_clean(); // Discard the output buffer and close

                fclose(STDIN);  // Close all of the standard
                fclose(STDOUT); // file descriptors as we
                fclose(STDERR); // are running as a daemon.

                register_shutdown_function('shutdown');

                if (posix_setsid() < 0)
                    return;

                if ($pid = pcntl_fork())
                    return;     // Parent

                // Now running as a daemon. This process will even survive
                // an apachectl stop.

                //Sauvegarde du txt
                $this->load->model('txt_model');
                $this->txt->save_Txt($ArraySimu['Path_txt'],$ArraySimu['name_simulation']);

                //Sauvegarde du Csv
                $this->load->model('csv_model');
                $this->csv->save_csv($ArraySimu['Path_txt'],$ArraySimu['name_simulation']);
            }

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
             $this->db->delete('usersimulation', array('name_simulation' => $value,'username'=>$this->session->userdata('username')));
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