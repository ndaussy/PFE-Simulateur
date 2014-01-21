<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	

	public $layout;
	public $data;

	function index()
	{
     	
		

		
		$this->layout = new layout;

		 $this->layout->views('../themes/menu');

	   
        $this->layout->views('../themes/connexion');

        //$this->layout->views('createAccount');
     

		$this->layout->view('../themes/footer');
		

		return true;
	}


	function delogin()
	{
			$this->session->sess_destroy();
			
			 redirect('welcome', 'direction');
			
	
		
	}

	function login()
	{


			
			$layout = new layout;

			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username','required');//|valid_email
			$this->form_validation->set_rules('password','Password','required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}
			else
			{
				

				
				$username=$this->input->post('username');
				$password=$this->input->post('password');


				

				if($this->user_model->validCredentials($username,$password))
				{
					$data=array('sucess'=>'Identification Reussite','username'=>$username);

					$this->load->helper('url');

					redirect('welcome', 'direction');

				}
				else
				{
					$data=array('error'=>'votre identifiant ou/et votre mot de passe sont faux');
					$layout->views('../themes/menu');

					$layout->views('../themes/loginError',$data);
					$layout->view('../themes/footer');

				}

					

			}
	}

	function deleteAccount()
	{
		if($this->user_model->deleteAccount($this->session->userdata('username')))
		{
			$this->delogin();

			redirect('welcome','direction');
		}

		
		
	}

	function createAccount()
	{
	
			$layout = new layout;


			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}
			else
			{



				$layout->set_titre("Create Account");

				$layout->views('../themes/menu');

				$layout->views('../themes/connexion');

				$this->load->model('user_model');

				$username=$this->input->post('username');
				$password=$this->input->post('password');

				if($this->user_model->createAccount($username,$password))
				{
					$data=array('reussite'=>'Votre compte a bien été crée');
					$layout->views('createAccountSucess',$data);

				}
				else
				{
					$data=array('erreur'=>'Votre identifiant est déjà utilisé');
					$layout->views('createAccountError',$data);

				}
				 
				$layout->view('../themes/footer');	
			}
	}

	function gestionUser()
	{

            if($this->user_model->isLoggedIn())
            {



			$layout = new layout;

			$layout->set_titre("Gestion du compte");

			$layout->views('../themes/menu');


			$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
			$layout->views('../themes/loginSucess',$data);

            $layout->views('gestionUser');


			$layout->view('../themes/footer');

            }
        else
        {
            $this->index();
        }


	}


}