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



        public function lancerSimu()
        {



            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->helper('cookie');

            $this->load->model('simulation_model');

            if($this->input->post('ajax') == '1')
            {

                $this->form_validation->set_rules('time', 'time', 'trim|required|xss_clean');
                $this->form_validation->set_message('required', '0');

                if($this->form_validation->run() == FALSE)
                {
                    echo false;
                } else
                {
                    if($this->input->post('time')==0.0)//Initialiser les registers
                    {
                        if(isset($_COOKIE['Option']))//Si les options sont choisi
                        {
                            $option=explode ( '_' , $_COOKIE['Option']);

                            //declenche les register services.
                            if(isset($option['gga']))
                            {
                                $this->simulation_model->RegisterService('rmc',true);
                            }
                            if(isset($option['rmc']))
                            {
                                $this->simulation_model->RegisterService('gga',true);
                            }

                            //lancement serveur synchronisation

                        }
                    }

                    if($this->input->post('time')=='Simulation terminé')
                    {
                        Sleep(10);
                    }


                    //Prendre la prochaine itération du temps; réaliser la requête & renvoyé le résultat
                    $arraydata=array('name_simulation'=>$_COOKIE['name_simulation'],'Scumul'=>$this->input->post('time'),'time'=>$this->input->post('time'));

                    //lance la simu pour les valeurs récupéré => tableau envoyé name_simulation,Scumul,time;
                    $this->simulation_model->playsimulation($arraydata);//on envoit les données.



                    if(($receivedata=$this->simulation_model->findSmallestTimeBetweenTxtCsv($arraydata))!=false)//si on ne trouve plus rien
                   {
                      //play les simulations :

                       echo $receivedata[0]['min( Scumul )'];
                   }
                   else
                   {
                       echo false;
                   }


                }
            }

        }

        public function map()
        {
            $layout= new layout;
            $this->load->library('form_validation');
            $this->load->helper('cookie');
            $this->load->model('simulation_model');
            $this->load->helper('form');
            $layout->set_titre("Map");
            $data['name_simulation']=$this->simulation_model->findSimulation('all');

            for($a=0;$a<count($data['name_simulation']);$a++)
            {
                $data['name_Simulation'][$a]=$data['name_simulation'][$a]["name_simulation"];
            }
            unset($data['name_simulation']);

            if (isset($_COOKIE['name_simulation']))//Si n'existe pas
            {
                $layout->views('../themes/menu');

                $layout->views('map',$data);

                $layout->view('../themes/footer');

            }
            else
            {
               // echo 'simulation choisi';
                $layout->ajouter_js("Interface_user/GoogleMap");
                $layout->ajouter_js("Interface_user/Ligne");

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

                    if(in_array($this->input->post('simulation'),$data['name_Simulation']))
                    {



                    $cookie = array(
                        'name' => 'Option',
                        'value' => $this->input->post('GGA')."_".$this->input->post('RMC')."_".$this->input->post('Can'),
                        'expire' => '128650'
                    );

                    $this->input->set_cookie($cookie);

                    // create cookie to avoid hitting this case again
                    $cookie = array(
                        'name'   => 'name_simulation',
                        'value'  => $this->input->post('simulation'),
                        'expire' => '1286500'
                    );

                    $this->input->set_cookie($cookie);

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
                    else
                    {
                        echo "A faire ";
                    }
                }
            }

        }

        public function arretSimu()
        {
            $layout= new layout;
            $this->load->helper('cookie');
            $this->load->model('simulation_model');
            $this->load->helper('form');
            $layout->set_titre("Map");
            $data['name_simulation']=$this->simulation_model->findSimulation('all');

            if(isset($_COOKIE['name_simulation']))
            {
                delete_cookie('name_simulation');
                delete_cookie('time');
                delete_cookie('Option');

            }

            $this->map();
        }




    }



	

	
