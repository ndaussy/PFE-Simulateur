<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simulation extends CI_Controller {



	
	 public function index()
	{

		if($this->user_model->isLoggedIn())
		{
		
		$layout= new layout;
		
		$layout->set_titre("Simulation sauvegardé");
		
		$layout->views('../themes/menu');
		
		$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
		$layout->views('../themes/loginSucess',$data);


		$this->load->library('./../models/simulation_model');

		$data['result']=$this->simulation_model->findSimulation('all');

		if($data['result']==false)
		{
		

		$data['result'][0]=array('name_simulation'=>'','date_add'=>'');

		$layout->views('simulation',$data);
		}
		else
		{
		$layout->views('simulation',$data);
		}

		

		$layout->view('../themes/footer');	

		}
		else
		{
			$this->load->helper('url');

			redirect('welcome', 'direction');

		}

				     
	}

	public function gestion()
	{
		//suppression simulation
		$this->load->library('form_validation');
		
		$this->load->library('./../models/simulation_model');

		if($this->input->post('supprimer'))
		{
            var_dump($this->input->post());

			foreach ($this->input->post() as $key => $value) 
			{
                if($key!='supprimer')
                {
                    $data["simulation"][]=$value;
                }

			}

            //tableau de recu de type simulation => 0 => nom_simu_a_delete
			
			$this->simulation_model->deleteSimulation($data['simulation']);

            $this->index();
		}
		else if ($this->input->post('ajouter'))
		{
			redirect('telecharger', 'direction');
		}
		else if($this->input->post('modifier'))
		{
			redirect('index','direction');

		}
        else
        {
            $this->index();
        }
		
	}


	public function map()
	{
		if($this->user_model->isLoggedIn())
		{
		
		$layout= new layout;
		
		$layout->set_titre("Map");
		
		$layout->views('../themes/menu');
		
		$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
		$layout->views('../themes/loginSucess',$data);


		$this->load->library('./../models/simulation_model');


		$layout->views('map');

		$layout->view('../themes/footer');	

		}
		else
		{
			$this->load->helper('url');

			redirect('welcome', 'direction');

		}

	}



	

	
}