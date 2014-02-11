<script type="text/javascript">
    var Direction = "<?php echo site_url('simulation/lancerSimu'); ?>"
</script>




        <div class="row-fluid">
            <div class="span12" >
            <?php


                //test de la clés

                if(isset($_COOKIE['name_simulation']))//si existe
                {



                    echo validation_errors();



                    echo '<legend>Simulation play '.$_COOKIE['name_simulation'].'</legend>';
                    echo '<div class="row-fluid">';
                        echo '<div class="span6">';
                     echo form_open('simulation/arretSimu');
                    echo ' <button class="btn btn-danger"  name="name_simulation" type="Submit">Stop Simulation</button>';


                     echo'</form>';

                    echo ' <button class="btn btn-warning" id="pause" name="arret_simulation">Pause</button>';

                    echo ' <button class="btn btn-success" id="lancerSimu" name="name_simulation" >Play Simulation</button>';




                    echo '</div>';

                    echo '<div class="span6">';


                    echo '<div class="row-fluid">';
                    ?>

                    <div class="row-fluid">
                        <input type="checkbox" name="TempsReel" id="tempsreel" > Real time <br>
                    </br>

                    </div>

                    <?php
                         echo form_open('simulation/lancerSimu');?>

                        Relative time (s) :
                            <?=form_input(array('name'=>'time','id'=>'time','value'=>'0.0','class'=>'time textbox','style'=>'width:150px;'))?><br />

                        <?=form_close("\n")?>

                    </div>

                    <div class="row-fluid">
                    <div id="Latence"/>
                    </div>

                    <div class="row-fluid">
                        Delta between requests (s) :
                        <INPUT type="text" value="0.5" id="delta" class="textbox time "/>
                    </div>

                    <?php
                    echo '</div>';

                }
                else//si existe pas
                {
                    echo validation_errors();

                    echo form_open('simulation/map');



                    echo '<legend>Choice simulation</legend>';
                    echo '<div class="row-fluid">';

                    echo '<div class="row-fluid">';
                        echo '<div class="span2">';
                        echo 'Simulation to play';
                        echo '</div>';

                        echo '<div class=span4>';
                        echo '<select name="simulation">',"\n";
                        for($cpt=0; $cpt<count($name_Simulation); $cpt++)
                        {
                            echo '<option value="'.$name_Simulation[$cpt].'">'.$name_Simulation[$cpt].'</option>';
                        }
                        echo '</select>',"\n";
                         echo '</div>';
                     echo '</div>';


                     echo '<div class="row-fluid">';
                        echo '<div class="span2">';
                        echo 'Option Simulation';
                        echo '</div>';

                        echo '<div class=span4>';
                        echo '<input type="checkbox" name="GGA" checked value="gga"> Service gps, trame GGA</br>
                        <input type="checkbox" name="RMC" checked value="rmc"> Service gps, trame RMC</br>
                        <input type="checkbox" name="Can" checked value="can"> CAN';
                         echo '</div>';
                     echo '</div>';


                    echo '<div class="row-fluid">';
                        echo '<div class="span2">';
                        //echo 'Loading simuation';
                        echo '</div>';

                        echo '<div class=span4>';
                     echo '</br></br>';
                     echo ' <button class="btn btn-success" name="name_simulation" type="Submit">Begin simulation</button>';
                      echo '</div>';
                    echo '</div>';
                    echo '</form>';
                }




        ?>
             </div>
        </div>



        <?php
        if(isset($_COOKIE['name_simulation']))//Affichage du tableaux de bord si la simulation est choisie
        {
            if(in_array($_COOKIE['name_simulation'],$name_Simulation))
            {
         ?>

        <div class="row-fluid">

	    <div class="span12" id="style">
	    	 <legend>Map</legend>



            <script type="text/javascript"
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQs5tR44NEMgFLzDihOwTycxEn-uFBibY&sensor=false">
            </script>


	    	 <div class="row-fluid">

				    <div class="span12" style="width: 100%;" id="map-canvas">
				  	<!--googleMap-->
				    </div>


			</div>

            <div class="row-fluid"><!--GoogleMap-->

               <div class="span12">
                <div id="container_2"  style="width: 100%; height: 200px; margin: 0 auto">  </div>
               </div>


         <?php require_once(base_url().'/assets/javascript/Interface_user/Ligne.js');  ?>



            <div class="row-fluid"><!--Tableau de bord-->

                <div class="span4">
                    <div id="TourMinute" style="min-width: 200px; max-width: 200px; height: 250px; margin: 0 auto"></div>


                </div>


                <div class="span4">

                    <div class="row-fluid"><!-- Time -->

                        <div class="span2" >
                        </div>
                        <div class="span8" id="Scumul">
                        </div>
                        <div class="span2" >
                            </div>

                    </div>

                    <div class="row-fluid"><!--Porte & Kilometrage -->
                        <div class="span6" id="EtatPorte" ><!-- Etat Porte-->

                            <p>Door status :</p>

                            <div class="span4" id="PorteClose" style="display:none">

                                <img src="<?php echo img_url('button-red.png'); ?>"  />
                             </div>

                             <div class="span4" id="PorteOpen" style="display:none">
                                <img src="<?php echo img_url('button-green.png'); ?>"  />
                             </div>

                        </div><!-- Etat Porte-->
                        <p>Kilometers :</p>
                        <div class="span6" id="Kilometrage"></div><!-- Kilometrage-->
                    </div><!--Porte & Kilometrage -->

                </div>

            <div class="span4">
                <div id="VitesseNav" style="min-width: 200px; max-width: 200px; height: 250px; margin: 0 auto"></div>

            </div>

           </div>
	    </div>
        <?php
            }
        } ?>


	 
