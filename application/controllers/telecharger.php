<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telecharger extends CI_Controller {


	
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

		if($this->user_model->isLoggedIn())
		{

		
		
		$layout= new layout;
	
		
		$layout->set_titre("Telecharger Simulation");


		
		$layout->views('../themes/menu');
		
		$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
		$layout->views('../themes/loginSucess',$data);
			
		$data['erreur']="";


		$layout->views('telecharger_Simu',$data);
		 
		
		$layout->view('../themes/footer');	

		}
		else
		{
			$this->load->helper('url');

			redirect('welcome', 'direction');

		}

				     
	}

	

	public function do_upload()
	{

		if($this->user_model->isLoggedIn())
		{
			$layout = new layout;

			$this->load->helper(array('form', 'url'));

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'txt|csv';
			$config['max_size']	= '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$config['overwrite'] = true;

			$this->load->library('upload', $config);
			
			$this->load->model('simulation_model');

            $data = array('CSV'=>'','TXT'=>'');

            if($this->upload->do_upload('CSV'))
            {
                $data['CSV'] = $this->upload->data();

				//Si les fichiers sont dl a changer car on dl deux fois ..
                if ( $this->upload->do_upload('TXT') )
				{
                    $data['TXT'] = $this->upload->data();
					
					
					$this->load->library('form_validation');

					$this->form_validation->set_rules('name_simulation','Name','required');
					
					if(!$this->simulation_model->isInSimulation($this->input->post('name_simulation')))
					{
						if ($this->form_validation->run() == FALSE)
						{
							
							$this->index();
							
							return false;
						}
						else
						{
							
							$layout->set_titre("Telecharger Simulation");

							$layout->views('../themes/menu');

							$this->simulation_model->addSimulation(array('name_simulation'=>$this->input->post('name_simulation'),
                                                                        'username'=>$this->session->userdata('username'),
                                                                        'Path_csv'=>$data['CSV']['full_path'],
                                                                        'Path_txt'=>$data['TXT']['full_path']));

                            $data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
                            $layout->views('../themes/loginSucess',$data);


							$layout->views('telecharger_do_upload', $data);
							 
							
							$layout->view('../themes/footer');
							
							


							return true;
						}
					}
					else
					{
					
				
		
					$layout->set_titre("Telecharger Simulation");


					
					$layout->views('../themes/menu');
					
					$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
					$layout->views('../themes/loginSucess',$data);
						
					$data['erreur']='Nom de simulation déjà utilisé';


					$layout->views('telecharger_Simu',$data);
					 
					
					$layout->view('../themes/footer');	
					}
							
						
				}	
				else
				{

					$layout->set_titre("Telecharger Simulation");

					$layout->views('../themes/menu');
					
					$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
					$layout->views('../themes/loginSucess',$data);

					$data = array('erreur' => $this->upload->display_errors());
					
					$layout->views('telecharger_Simu',$data);
					 
					
					$layout->view('../themes/footer');	
					

					return false;
					
				}
            }
            else
            {
                echo "blindage";
            }

		}
		else
		{
			
			
			redirect('welcome', 'direction');
			
			return false;

		}
		
	}




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */