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