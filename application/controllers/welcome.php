<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
public function index()
    {

        //$this->load->library('../models/Client_Socket_model.php');

        $this->layout->set_titre("Page d'acceuil");

        $this->layout->views('../themes/menu');

        /*if($this->user_model->isLoggedIn())
        {
            $data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
            $this->layout->views('../themes/loginSucess',$data);

        }
        else
        {
            $this->layout->views('../themes/connexion');

        }*/


        $this->layout->views('welcome_message')
            ->view('../themes/footer');
        $this->load->model('simulation_model');
        $this->simulation_model->finSimulation();
        //pclose(popen($this->config->item('config_path_prog_dungle')." F3 00 00 0C FF FF FF FF FEF1 "  , "r"));
       /* $this->load->model('simulation_model');

        //[name_simulation] [time]
        $this->simulation_model->playsimulation(array("name_simulation"=>"T1_tronquer","time"=>'0.0'));
        */

        /*   $this->load->model('kml_model');

         $this->kml_model->delete_data_kml(array('name_simulation'=>'testdinsertion'));

          if($this->kml_model->save_kml('C:\wamp\www\PFE-Simulateur\kml\TCAR.kml',"testdinsertion"))
          {
              echo 'insertion reussite';
          }
          else
          {
             echo 'insertion erreur !';
          }


         $this->load->model('csv_model');

          if($this->csv_model->delete_data_csv(array('name_simulation'=>'testdinsertion')))
          {
              echo 'suppression effectué';
          }

          if($this->csv_model->save_csv('C:\wamp\www\T2_tcar_6106_2009609_0443_0_141512_161546_0.0_.csv',"testdinsertion"))
          {
              echo 'insertion reussite';
          }
          else
          {
              echo 'insertion erreur !';
          }
          */

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */