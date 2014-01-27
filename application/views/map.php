




            <script >

                $(document).ready(function() {

                    var myVar;
                    var DoSimu=true;



                    $('#lancerSimu').click(function() {

                        DoSimu=true;

                        var timeExecution=0.0;
                        //myVar=setInterval(function(){Execution()},1000);//Execute toutes les 1000 milliseconde la fonction

                        function Execution()
                        {
                        var Ancientime=$('.time').val();
                        var TempsRecu=0.0;

                        //declaration d'une forme
                        var form_data = {
                            time : $('.time').val(),
                            ajax : '1',
                            tempsMoyenRequete : 0.10//100ms
                        };

                        $.ajax({
                            url: "<?php echo site_url('simulation/lancerSimu'); ?>",
                            type: 'POST',
                            async : false,
                            data: form_data,
                            success:
                                function (msg) {
                                    //alert('message send');
                                    $('#message').html(msg);

                                    //alert(timeExecution);
                                    TempsRecu=msg;
                                    document.getElementById('time').value=msg;
                                }
                        });

                            timeExecution=Ancientime-TempsRecu-0.1;

                        return false;

                        };

                        function Timeout()
                        {
                            if(DoSimu)
                            {
                            setTimeout(Execution,timeExecution);
                            }
                        }

                        myVar=setInterval(function(){Timeout()},100);//Execute toutes les 1000 milliseconde la fonction



                    });

                    $('#pause').click(function() {

                        DoSimu=false;

                    });




                });

            </script>

	    </script>

        <div class="row-fluid">
            <div class="span12" >
            <?php


                //test de la clés

                if(isset($_COOKIE['name_simulation']))//si existe
                {

                    require_once(base_url().'/assets/javascript/Interface_user/GoogleMap.js');

                    echo validation_errors();



                    echo '<legend>Simulation joué '.$_COOKIE['name_simulation'].'</legend>';
                    echo '<div class="row-fluid">';

                     echo form_open('simulation/arretSimu');
                    echo ' <button class="btn btn-danger"  name="name_simulation" type="Submit">Arreter la simulation</button>';
                     echo'</form>';


                   echo ' <button class="btn btn-warning" id="pause" name="arret_simulation" type="Submit">pause</button>';

                    echo ' <button class="btn btn-success" id="lancerSimu" name="name_simulation" >Lancer la simulation</button>';
                    echo '</div>';

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



        <?php
        if(isset($_COOKIE['name_simulation']))//Affichage du tableaux de bord si la simulation est choisie
        {
            if(in_array($_COOKIE['name_simulation'],$name_Simulation))
            {
         ?>

        <div class="row-fluid">

	    <div class="span12" id="style">
	    	 <legend>Map</legend>
         <div class="span12"> </div>
        <?
       // require_once(base_url().'/assets/javascript/Interface_user/ChargementPageClient.js');
        ?>

        <?php
 echo form_open('simulation/lancerSimu');
 ?>
        <div id="message">
            </div>
        <div id="timer">
            </div>

            <?=form_input(array('name'=>'time','id'=>'time','value'=>'0.0','class'=>'time textbox','style'=>'width:150px;'))?><br />

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
	 

	 
