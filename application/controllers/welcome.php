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

		if($this->user_model->isLoggedIn())
		{
			$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
			$this->layout->views('../themes/loginSucess',$data);

		}
		else
		{
			$this->layout->views('../themes/connexion');

		}
					
		
		$this->layout->views('welcome_message')
				     ->view('../themes/footer');

		///test envoi machin
		$this->load->model('send_data_dungle');

		$this->send_data_dungle->SendDataDungle();
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */