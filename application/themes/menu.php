
<div class ="row-fluid">

    <div class ="span12">

        <Legend>Gestionnaire Des Simulateurs EBSF</legend>

            <nav class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <ul class="nav">
                    <li> <a class="brand" href="#">G.D.S</a> </li>
                    
                    <li >    
                    <a href="<?php echo site_url('welcome');?>" > Acceuil </a>
                    </li>

                    <li >
                    <a href="<?php echo site_url('simulation/map');?>" > Accéder au Simulateur </a>
                    </li>

                      <?php if($this->user_model->isLoggedIn())
                      {?>


                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Simulation <b class="caret"></b> </a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('telecharger');?>">Télécharger Simulation</a></li>
                        <li><a href="<?php echo site_url('simulation');?>" >Simulation enregistré</a></li>
                        
                      </ul>
                    </li>

                      <?php
                      }
                      ?>

                    <li>
                        <a href="<?php echo site_url('user/gestionUser');?>" > Admin </a>
                    </li>

                  <!--  <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> UnitTest <b class="caret"></b><a/>
                
                        <ul class="dropdown-menu">
                            <li><a href="#"></a></li>
                            <li class="dropdown-submenu">
                                <a href="#">Module</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php// echo site_url('unit_test/ModelUserTest');?>">User_Model</a></li>
                                    <li><a href="<?php// echo site_url('unit_test/ModelSimulationTest');?>">Simulation_Model</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu">
                                <a href="#">Controleur</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php// echo site_url('unit_test/ControleurUserTest');?>">User</a></li>
                                     <li><a href="<?php// echo site_url('unit_test/ControleurTelechargementTest');?>">Telechargement</a></li>
                                </ul>
                            </li>
                        </ul>

                    </li>-->

                    <li>
                        <a href="#" > FAQ </a>
                    </li>

                    <li>
                        <a href="#" > Contact </a>
                    </li>


                 </ul>
                </div>
              </div>
            </nav>

    </div>

</div>


   






