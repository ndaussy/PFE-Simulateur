<<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unit_test extends CI_Controller {

	public function ControleurTelechargementTest()
	{
		/*$layout= new layout;
	
		$layout->set_titre("Test unitaire");

		$this->load->library('./../controllers/telecharger');

		$this->session->sess_destroy();

		$data['unitTest'][]=$this->unit->run($this->telecharger->do_upload(false),'is_false',"Telecharger fichier sans id");

		$layout->views('../themes/menu');
		
		$layout->views('../themes/connexion');

		$layout->views('testunit',$data);

		$layout->view('../themes/footer');	*/
	}

	public function ControleurUserTest()
	{
		/*$layout= new layout;
	
		$layout->set_titre("Test unitaire");

		$this->load->library('./../controllers/user');

		$this->session->sess_destroy();

		
		Fonction test : login($aff)
						delogin($aff)
						function deleteAccount($aff)
						function createAccount($aff)

		

		$data['unitTest'][]=$this->unit->run($this->user->index(false),'is_true',"Affichage");
		

		$layout->views('../themes/menu');
		
		$layout->views('../themes/connexion');

		$layout->views('testunit',$data);

		$layout->view('../themes/footer');	*/
	}

	/*
	*fonction a test :  function isLoggedIn()
	*					function createAccount($username,$password)
						function validCredentials($username,$password)
						function deleteAccount($username)
	*/
	public function ModelUserTest()
	{
		
		$layout= new layout;
	
		$layout->set_titre("Test unitaire");
		
		$layout->views('../themes/menu');
		
		$layout->views('../themes/connexion');
		
		

		$username = 'nico';
		$password = '1';
	
		$data['unitTest'][] = $this->unit->run($this->user_model->createAccount($username,$password), 'is_false', "Creation d'un compte avec redondance de la clé");
		
		$username = 'unit_test';
		$password = 'unit_test';


		$data['unitTest'][]= $this->unit->run($this->user_model->validCredentials($username,$password), 'is_false', "identification avec mauvais id");
		$data['unitTest'][]= $this->unit->run($this->user_model->isLoggedIn(), 'is_false', "Test connexion sans identification");
		
		
		$data['unitTest'][]= $this->unit->run($this->user_model->createAccount($username,$password), 'is_true', "Creation d'un compte");
		$data['unitTest'][]= $this->unit->run($this->user_model->validCredentials($username,$password), 'is_true', "identification avec id enregistré");
		$data['unitTest'][]= $this->unit->run($this->user_model->isLoggedIn(), 'is_true', "Test connexion ");
		$data['unitTest'][]= $this->unit->run($this->user_model->deleteAccount($username), 'is_true', "Test suppression de compte ");

		$layout->views('testunit',$data);

		$this->session->sess_destroy();

		$layout->view('../themes/footer');

	}

	/*
	 function addSimulation($ArraySimu)
     function deleteSimulation($idSimuation)
     function findSimulation($idSimulation)
     function isInSimulation($idSimulation)
	*/

	public function ModelSimulationTest()
	{
		
		$layout= new layout;
	
		$layout->set_titre("Test unitaire");
		
		$layout->views('../themes/menu');
		
		$layout->views('../themes/connexion');
		
		$this->load->library('./../models/simulation_model');

		$ArraySimu['name_simulation']="tata";
		$ArraySimu['username']="unit_test";
	
		$data['unitTest'][] = $this->unit->run($this->simulation_model->isInSimulation($ArraySimu['name_simulation']), 'is_false', "test présence simulation avant insertion");

		$data['unitTest'][] = $this->unit->run($this->simulation_model->deleteSimulation($ArraySimu), 'is_false', "suppression de la simulation avant ajout");

		$data['unitTest'][] = $this->unit->run($this->simulation_model->addSimulation($ArraySimu), 'is_true', "Ajout d'une simulation");

		$data['unitTest'][] = $this->unit->run($this->simulation_model->findSimulation($ArraySimu['name_simulation']), 'is_array', "Recuperer data simulation");

		$data['unitTest'][] = $this->unit->run($this->simulation_model->findSimulation('all'), 'is_array', "Recuperer toutes les simulations");

		$data['unitTest'][] = $this->unit->run($this->simulation_model->deleteSimulation($ArraySimu), 'is_true', "suppression de la simulation");
		

		$layout->views('testunit',$data);

		

		$layout->view('../themes/footer');

	}

}