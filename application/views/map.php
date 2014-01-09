
	
      
	    <script type="text/javascript"
	      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQs5tR44NEMgFLzDihOwTycxEn-uFBibY&sensor=false">
	    </script>
	    <script type="text/javascript">
	      function initialisation(){
				var centreCarte = new google.maps.LatLng(50.3724823, 3.0756093);
				var optionsCarte = {
					zoom: 18,
					center: centreCarte,
					mapTypeId: google.maps.MapTypeId.HYBRID
				}
				var maCarte = new google.maps.Map(document.getElementById("map-canvas"), optionsCarte);
				var optionsMarqueur = {
					position: centreCarte,
					map: maCarte,
					title: "Position Bus"
				}
				var marqueur = new google.maps.Marker(optionsMarqueur);
			 }
			 google.maps.event.addDomListener(window, 'load', initialisation);
	    </script>

		
	    <div class="span10" id="style">
	    	 <legend>Map</legend>

	    	 <div class="span2">

					    	<input  type="image" src=<?php echo  base_url()."/assets/img/flecheG.jpg";?>   name="previous">
					</div>

			<div class="span6">
			</div>


	    	<div class="span2">

			    	<input  type="image" src=<?php echo  base_url()."/assets/img/flecheD.jpg";?>   name="previous">

			</div>

	    	 <div class="row-fluid">

				    <div class="span12" id="map-canvas">
				  	<!--googleMap-->
				    </div>

					
			</div>

	    </div>

	 

	 
