
	    <script type="text/javascript"
	      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQs5tR44NEMgFLzDihOwTycxEn-uFBibY&sensor=false">
	    </script>
	    <script type="text/javascript">
            function initialisation(){
                var centreCarte = new google.maps.LatLng(49.4388469985253,1.12366212825436);

                var optionsCarte = {
                    zoom: 18,
                    center: centreCarte,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                }



                var maCarte = new google.maps.Map(document.getElementById("map-canvas"), optionsCarte);

                /*var optionsMarqueur = {
                    position: centreCarte,
                    map: maCarte,
                    title: "Position Bus"
                }
                var marqueur = new google.maps.Marker(optionsMarqueur);
                 */

                var ctaLayer = new google.maps.KmlLayer({
                    //url: 'http:://127.0.0.1/PFE-Simulateur/google_exemple_chicago.kml'
                    //url: 'https://kml-pfe-hebergement.googlecode.com/svn/trunk/TCAR.kml'
                     url: 'https://kml-pfe-hebergement.googlecode.com/svn/trunk/TCAR_91.kml'
                    //url: 'git://github.com/ndaussy/PFE-Simulateur/blob/master/kml/google_exemple_chicago.kml'
                });
                ctaLayer.setMap(maCarte);
            }
            google.maps.event.addDomListener(window, 'load', initialisation);
	    </script>

        <div class="span12" id$"style>
        <?php

        if(isset($_COOKIE['name_simulation']))
        {
            //test de la clés

            if(in_array($_COOKIE['name_simulation'],$name_Simulation))
            {
                echo validation_errors();

                echo form_open('simulation/arretSimu');

                echo '<legend>Simulation joué '.$_COOKIE['name_simulation'].'</legend>';
                echo '<div class="row-fluid">';
                echo ' <button class="btn btn-warning" name="arret_simulation" type="Submit">pause</button>';
                echo ' <button class="btn btn-danger" name="name_simulation" type="Submit">Arreter la simulation</button>';
                echo ' <button class="btn btn-sucess" name="name_simulation" type="Submit">lancer la simulation</button>';

            }
            else
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
            }
        }
        else
        {
           echo ' Activer les cookies pour ce site';
        }



         echo '</div>';

         echo '</div>';
        if(isset($_COOKIE['name_simulation']))//Affichage du tableaux de bord si la simulation est choisie
        {
            if(in_array($_COOKIE['name_simulation'],$name_Simulation))
            {
         ?>

	    <div class="span12" id="style">
	    	 <legend>Map</legend>



	    	 <div class="row-fluid">

				    <div class="span12" style="width: 100%" id="map-canvas">
				  	<!--googleMap-->
				    </div>

					
			</div>

            <div class="row-fluid">

               <div class="span12">
                <div id="container_2"  style="width: 100%; height: 200px; margin: 0 auto">  </div>
               </div>



                <script>
                    $(function () {
                    $('#container_2').highcharts({

                        title: {
                        text: 'Ligne Numeros 1'
                        },

                        subtitle: {
                        text: ''
                        },

                        xAxis: {
                        categories: [
                            <?php

                                for($a=0;$a<count($data["kml"]);$a++)
                                {
                                    if($a!=count($data["kml"]) )
                                    {
                                        if( array_key_exists ($a,$data["kml"]))   echo '"'.$data["kml"][$a]['arret'].'", ';

                                    }
                                    else
                                    {
                                        if( array_key_exists ($a,$data["kml"]))  echo "'".$data["kml"][$a]['arret']."'";
                                    }

                                }
                            ?>]
                        },

                        yAxis: {
                            title: {
                            text: ''
                            },

                            plotLines: [{
                            value: 1,
                            width: 1,
                            color: '#808080'
                            }]
                        },

                        tooltip: {
                        valueSuffix: ''
                        },

                        legend: {
                        layout: 'vertical',
                        align: 'center',
                        enabled: false,
                        verticalAlign: 'middle',
                        borderWidth: 1
                        },

                        series: [{
                        name: 'Ligne 1',
                        data: [
                            <?php

                                   for($a=0;$a<count($data["kml"]);$a++)
                                   {

                                       if($a!=count($data["kml"]) -1)
                                       {
                                         if( array_key_exists ($a,$data["kml"]))  echo '1 , ';

                                       }
                                       else
                                       {
                                         if( array_key_exists ($a,$data["kml"]))  echo '1  ';
                                       }

                                   }
                               ?>
                            ]
                        }
                        ]
                        });
                    });
                </script>

            <div class="row-fluid">

                <div class="span4">
                <div id="container" style="min-width: 210px; max-width: 300px; height: 250px; margin: 0 auto"></div>
                </div>
                <script>
                    $(function () {

                        $('#container').highcharts({

                                chart: {
                                    type: 'gauge',
                                    plotBackgroundColor: null,
                                    plotBackgroundImage: null,
                                    plotBorderWidth: 0,
                                    plotShadow: false
                                },

                                title: {
                                    text: 'Vitesse du vehicule'
                                },

                                pane: {
                                    startAngle: -150,
                                    endAngle: 150,
                                    background: [{
                                        backgroundColor: {
                                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                            stops: [
                                                [0, '#FFF'],
                                                [1, '#333']
                                            ]
                                        },
                                        borderWidth: 0,
                                        outerRadius: '109%'
                                    }, {
                                        backgroundColor: {
                                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                            stops: [
                                                [0, '#333'],
                                                [1, '#FFF']
                                            ]
                                        },
                                        borderWidth: 1,
                                        outerRadius: '107%'
                                    }, {
                                        // default background
                                    }, {
                                        backgroundColor: '#DDD',
                                        borderWidth: 0,
                                        outerRadius: '105%',
                                        innerRadius: '103%'
                                    }]
                                },

                                // the value axis
                                yAxis: {
                                    min: 0,
                                    max: 200,

                                    minorTickInterval: 'auto',
                                    minorTickWidth: 1,
                                    minorTickLength: 10,
                                    minorTickPosition: 'inside',
                                    minorTickColor: '#666',

                                    tickPixelInterval: 30,
                                    tickWidth: 2,
                                    tickPosition: 'inside',
                                    tickLength: 10,
                                    tickColor: '#666',
                                    labels: {
                                        step: 2,
                                        rotation: 'auto'
                                    },
                                    title: {
                                        text: 'km/h'
                                    },
                                    plotBands: [{
                                        from: 0,
                                        to: 120,
                                        color: '#55BF3B' // green
                                    }, {
                                        from: 120,
                                        to: 160,
                                        color: '#DDDF0D' // yellow
                                    }, {
                                        from: 160,
                                        to: 200,
                                        color: '#DF5353' // red
                                    }]
                                },

                                series: [{
                                    name: 'Speed',
                                    data: [80],
                                    tooltip: {
                                        valueSuffix: ' km/h'
                                    }
                                }]

                            },
                            // Add some life
                            function (chart) {
                                if (!chart.renderer.forExport) {
                                    setInterval(function () {
                                        var point = chart.series[0].points[0],
                                            newVal,
                                            inc = Math.round((Math.random() - 0.5) * 20);

                                        newVal = point.y + inc;
                                        if (newVal < 0 || newVal > 200) {
                                            newVal = point.y - inc;
                                        }

                                        point.update(newVal);

                                    }, 3000);
                                }
                            });
                    });
                </script>

                </div>
           </div>
	    </div>
        <?php
            }
        } ?>
	 

	 
