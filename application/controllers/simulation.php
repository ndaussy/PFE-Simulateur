<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simulation extends CI_Controller {



	
         public function index()
        {



            $layout= new layout;

            $layout->set_titre("Recorded Simulation");

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

                    $layout->set_titre("Management simulations");

                    $layout->views('../themes/menu');

                    $layout->views('../themes/connexion');

                    $layout->views('../themes/footer');

            }

        }



        public function lancerSimu()
        {



            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->helper('assets');
            $this->load->helper('cookie');

            $this->load->model('simulation_model');

            if($this->input->post('ajax') == '1')
            {

                $this->form_validation->set_rules('time', 'time', 'trim|required|xss_clean');
                $this->form_validation->set_message('required', '0');

                if($this->form_validation->run() == FALSE)
                {
                    $this->simulation_model->finSimulation();
                    echo false;

                } else
                {
                    if($this->input->post('time')==0.0)//Initialiser les registers
                    {
                     $this->simulation_model->initializationSimulation();
                    }

                    if($this->input->post('time')!='Simulation terminé')
                    {
                            //Prendre la prochaine itération du temps; réaliser la requête & renvoyé le résultat
                            $arraydata=array('name_simulation'=>$_COOKIE['name_simulation'],'Scumul'=>$this->input->post('time'),'time'=>$this->input->post('time'),'TempsRequete'=>$this->input->post('tempsMoyenRequete'));


                            //play les simulations :
                            //lance la simu pour les valeurs récupéré => tableau envoyé name_simulation,Scumul,time;
                            $this->simulation_model->playsimulation($arraydata);//on envoit les données.


                            if(($receivedata=$this->simulation_model->findSmallestTimeBetweenTxtCsv($arraydata))!=false)//si on ne trouve plus rien
                            {

                                echo json_encode($receivedata[0]);
                                //echo test;
                            }
                            else
                            {
                                echo false;
                            }


                    }
                    else
                    {
                        $this->load->model('simulation_model');
                        $this->simulation_model->finSimulation();
                    }

                }
            }

        }

        public function map()
        {
            $this->output->set_header("Cache-Control: no-cache, must-revalidate");
            //header("Cache-Control: no-cache, must-revalidate" );//pour cookies
            $layout= new layout;

            //Ajout des interfaces JS
            $layout->ajouter_js_externe("https://maps.googleapis.com/maps/api/js?key=AIzaSyAQs5tR44NEMgFLzDihOwTycxEn-uFBibY&sensor=false");
            $layout->ajouter_js("Interface_user/GoogleMap");
            $layout->ajouter_js("Interface_user/gestionMap");
           // $layout->ajouter_js("Interface_user/Ligne");
            $layout->ajouter_js("Interface_user/TourMinute");
            $layout->ajouter_js("Interface_user/Vitesse");


            $this->load->library('form_validation');
            $this->load->helper('cookie');
            $this->load->helper('assets');
            $this->load->model('simulation_model');
            $this->load->helper('form');

            $data['name_simulation']=$this->simulation_model->findSimulation('all');

            for($a=0;$a<count($data['name_simulation']);$a++)//mise en forme du tableau pour obtenir une verification + facile chez le client
            {
                $data['name_Simulation'][$a]=$data['name_simulation'][$a]["name_simulation"];
            }
            unset($data['name_simulation']);

            if (isset($_COOKIE['name_simulation']))//Si existe
            {
            //ne rien faire & poursuivre l'affichage finale
                $layout->set_titre("Play Simulation");
            }
            else//si les cookies n'existe pas
            {
                $layout->set_titre("Selecting services");

                $this->load->helper(array('form', 'url'));//deuxieme visites aprés validation du formulaire

                $this->load->library('form_validation');

                $this->form_validation->set_rules('simulation', 'simulation', 'required');

                if ($this->form_validation->run() == FALSE)
                {

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


                        $layout->set_titre("Selecting services");

                        $this->load->model('simulation_model');

                        $this->load->model('kml_model');
                        if(strstr($this->input->post('simulation'),"1"))
                        {
                           $this->load->model('lignes_model');

                            //[name_simulation] path
                          $data['kml']= $this->lignes_model->retournLines(array("name_simulation"=>"T1"));

                        }
                        elseif(strstr($this->input->post('simulation'),"2"))
                        {
                           // $data['kml']=$this->kml_model->getArretByLine('TCAR_92');
                        }
                        elseif((strstr($this->input->post('simulation'),"3")))
                        {
                           // $data['kml']=$this->kml_model->getArretByLine('TCAR_93');
                        }



                        //Relance pour cookies.
                        redirect('Simulation/map', 'refresh');
                    }
                    else
                    {
                        echo "A faire ";
                    }
                }
            }
            //if(strstr($this->input->post('simulation'),"1"))
            {
                $this->load->model('lignes_model');

                //[name_simulation] path
                $data['kml']= $this->lignes_model->retournLines(array("name_simulation"=>"T1"));

            }


            $layout->views('../themes/menu',$data);

            $layout->views('map',$data);

            $layout->view('../themes/footer');

        }

        public function arretSimu()
        {
            $layout= new layout;
            $this->load->helper('cookie');
            $this->load->model('simulation_model');
            $this->load->helper('form');
            $layout->set_titre("Selecting services");
            $data['name_simulation']=$this->simulation_model->findSimulation('all');

            if(isset($_COOKIE['name_simulation']))
            {
                delete_cookie('name_simulation');
                delete_cookie('time');
                delete_cookie('Option');

            }
            $this->simulation_model->finSimulation();


            redirect('Simulation/map', 'refresh');
        }




    }



	

	
