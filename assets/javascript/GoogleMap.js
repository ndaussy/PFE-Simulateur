<script type="text/javascript"	      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQs5tR44NEMgFLzDihOwTycxEn-uFBibY&sensor=false">
</script>


  function initialize() {
    var mapOptions = {
      center: new google.maps.LatLng(50.3724823, 3.0756093),
      zoom: 18
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);

	var mapOptions = {
		position: centreCarte,
		map: maCarte,
		title: "Position du bus"
	}
  }
  google.maps.event.addDomListener(window, 'load', initialize);
