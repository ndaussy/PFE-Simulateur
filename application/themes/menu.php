
<div class ="row-fluid">

    <div class ="span12">

        <div class="test_css">
            <div class="logo">
                <div class="wasbo">

                </div>

            </div>
            <div class="bbb">
                <p class="Letter" style="margin-left:10px;">W</p>
                <p style="margin-left:-5px;" class="Point">eb </p>
                <p class="Letter"> A</p>
                <p style="margin-left:-5px;"class="Point">pplication</p>
                <p class="Letter">S</p>
                <p style="margin-left:-5px;"class="Point">imulation of</p>
                <p class="Letter">B</p>
                <p style="margin-left:-5px;"class="Point">us</p>
                <p class="Letter">O</p>
                <p style="margin-left:-5px;"class="Point">perations</p>
            </div>

        </div>

        <!--<Legend> W.A.S.B.O : Web Application for Simulation of Bus Operation </legend>
        -->
            <nav class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <ul class="nav">
                    <li>  <img src="<?php  echo img_url('logo.jpg'); ?>" height="50%" width="50%"  /></li>

                    <li >    
                    <a href="<?php echo site_url('welcome');?>" > Home </a>
                    </li>

                    <li >
                    <a href="<?php echo site_url('simulation/map');?>" >
                        Access simulator </a>
                    </li>

                      <?php if($this->user_model->isLoggedIn())
                      {?>


                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Simulation <b class="caret"></b> </a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('telecharger');?>">New Simulation </a></li>
                        <li><a href="<?php echo site_url('simulation');?>" >Recorded simulation</a></li>
                        
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


   






