


            <?php require_once(base_url().'/assets/javascript/Interface_user/GoogleMap.js');  ?>

	    </script>

        <div class="row-fluid">
            <div class="span12" >
            <?php


                //test de la clés

                if(isset($_COOKIE['name_simulation']))//si existe
                {
                    echo validation_errors();

                    echo form_open('simulation/arretSimu');

                    echo '<legend>Simulation joué '.$_COOKIE['name_simulation'].'</legend>';
                    echo '<div class="row-fluid">';


                    echo ' <button class="btn btn-danger" name="name_simulation" type="Submit">Arreter la simulation</button>';
                    echo ' <button class="btn btn-warning" name="arret_simulation" type="Submit">pause</button>';
                    echo ' <button class="btn btn-success" name="name_simulation" type="Submit">lancer la simulation</button>';

                    echo'</form>';

                }
                else//si existe pas
                {
                    echo validation_errors();

                    echo form_open('simulation/map');



                    echo '<legend>Choix simulation</legend>';
                    echo '<div class="row-fluid">';


                    echo '<select name="simulation">',"\n";
                    for($cpt=0; $cpt<count($name_Simulation); $cpt++)
                    {
                        echo '<option value="'.$name_Simulation[$cpt].'">'.$name_Simulation[$cpt].'</option>';
                    }
                    echo '</select>',"\n";


                    echo ' <button class="btn btn-info" name="name_simulation" type="Submit">Charger la simulation</button>';

                    echo '</form>';
                }




        ?>
             </div>
        </div>

          <script >
        $(document).ready(function() {
            $('#submit').click(function() {
                var form_data = {
                    time : $('.time').val(),
                    ajax : '1'
                };
                $.ajax({
                    url: "<?php echo site_url('simulation/lancerSimu'); ?>",
                    type: 'POST',
                    async : false,
                    data: form_data,
                    success:
                        function (msg) {
                            alert('message send');
                            $('#message').html(msg);
                        }
                });



                return false;
            });



        });



        </script>

        <?php
        if(isset($_COOKIE['name_simulation']))//Affichage du tableaux de bord si la simulation est choisie
        {
            if(in_array($_COOKIE['name_simulation'],$name_Simulation))
            {
         ?>

        <div class="row-fluid">

	    <div class="span12" id="style">
	    	 <legend>Map</legend>
        <?
       // require_once(base_url().'/assets/javascript/Interface_user/ChargementPageClient.js');
        ?>

        <?php
 echo form_open('simulation/lancerSimu');
 ?>
        <div id="message">
            </div>

            <?=form_input(array('name'=>'time','value'=>'0.0','class'=>'time textbox','style'=>'width:150px;'))?><br />

            <p>
        <?='<br />'.form_submit('submit','test','id="submit"')?>
        </p>
            <?=form_close("\n")?>

       <!-- <form action="/simulation/lancerSimu" method="post" id="frmIdentification">
            <button class="btn btn-success" id="data" value="test" onclick="displayDate()">Test Javascript</button>
        </form>-->
	    	 <div class="row-fluid">

				    <div class="span12" style="width: 100%" id="map-canvas">
				  	<!--googleMap-->
				    </div>


			</div>

            <div class="row-fluid">

               <div class="span12">
                <div id="container_2"  style="width: 100%; height: 200px; margin: 0 auto">  </div>
               </div>


        <?php require_once(base_url().'/assets/javascript/Interface_user/Ligne.js');  ?>



            <div class="row-fluid">

                <div class="span4">
                <div id="container" style="min-width: 210px; max-width: 300px; height: 250px; margin: 0 auto"></div>

        <?php require_once(base_url().'/assets/javascript/Interface_user/Vitesse.js');  ?>

                </div>


                </div>
           </div>
	    </div>
        <?php
            }
        } ?>
	 

	 
