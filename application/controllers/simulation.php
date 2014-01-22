<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simulation extends CI_Controller {



	
         public function index()
        {



            $layout= new layout;

            $layout->set_titre("Simulation sauvegardé");

            $layout->views('../themes/menu');

            /*$data=array('sucess'=>'Identification Reussite','username'=>$this->session->userdata('username'));
            $layout->views('../themes/loginSucess',$data);*/


            $this->load->library('./../models/simulation_model');

            $data['result']=$this->simulation_model->findSimulation('all');

            $data['islogin']=$this->user_model->isLoggedIn();

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

        public function gestion()
        {
            if($this->user_model->isLoggedIn())
            {
                //suppression simulation
                $this->load->library('form_validation');

                $this->load->model('simulation_model');

                if($this->input->post('supprimer'))
                {


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

            }
            else
            {

                    $layout= new layout;

                    $layout->set_titre("Gestion des simulations");

                    $layout->views('../themes/menu');

                    $layout->views('../themes/connexion');

                    $layout->views('../themes/footer');

            }

        }

        //[name_simulation] + [time]
        public function playSimulation($data)
        {
        //$this->load->model("simulation_model");
        //



        return $this->simulation_model->playsimulation($data);

        }

        public function map()
        {
            $layout= new layout;
            $this->load->helper('cookie');
            $this->load->model('simulation_model');
            $layout->set_titre("Map");
            $data['name_simulation']=$this->simulation_model->findSimulation('all');

            for($a=0;$a<count($data['name_simulation']);$a++)
            {
                $data['name_Simulation'][$a]=$data['name_simulation'][$a]["name_simulation"];
            }
            unset($data['name_simulation']);

            if (!get_cookie('name_simulation')) {//premiére visite sur la page
                // cookie not set, first visit

                // create cookie to avoid hitting this case again
                $cookie = array(
                    'name'   => 'name_simulation',
                    'value'  => 'null',
                    'expire' => '86500'
                );



                $this->input->set_cookie($cookie);



                $layout->views('../themes/menu');



                $layout->views('map',$data);

                $layout->view('../themes/footer');

            }
            else
            {
                echo 'simulation choisi';

                $this->load->helper(array('form', 'url'));//deuxieme visites aprés validation du formulaire

                $this->load->library('form_validation');

                $this->form_validation->set_rules('simulation', 'simulation', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $layout->views('../themes/menu');

                    $layout->views('map',$data);

                    $layout->view('../themes/footer');
                }
                else
                {

                    $_COOKIE['name_simulation']=$this->input->post('simulation');

                    $layout= new layout;

                    $layout->set_titre("Map");

                    $layout->views('../themes/menu',$data);

                    $this->load->model('simulation_model');


                    $this->load->model('kml_model');

                    $data['kml']=$this->kml_model->getArretByLine('TCAR_91');
                    //suppression d'un elements sur deux

                    $cpt=count($data['kml']);

                    for($a=0;$a<$cpt;$a++)
                    {
                        if($a%2!=1)
                        {
                            unset($data['kml'][$a]);
                        }
                    }
                    //var_dump($data);
                    //$data['data']=$this->playSimulation($data);

                    $layout->views('map',$data);

                    $layout->view('../themes/footer');
                }
            }

        }

        public function arretSimu()
        {
            $this->load->helper('cookie');

            if (get_cookie('name_simulation'))
            {
                delete_cookie('name_simulation');

                $this->map();

            }
        }




    }



	

	
