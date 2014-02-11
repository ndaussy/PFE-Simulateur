






function initialisation(){
        centreCarte = new google.maps.LatLng(49.4388469985253,1.12366212825436);

        var optionsCarte = {
            zoom: 10,
            center: centreCarte,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }



        maCarte = new google.maps.Map(document.getElementById("map-canvas"), optionsCarte);



        //Configuration du Kml -- Dans le cadre de plusieurs simulation, passé les arguments en BDD
        var ctaLayer = new google.maps.KmlLayer({
           url: 'https://kml-pfe-hebergement.googlecode.com/svn/trunk/TCAR_91.kml'
        });
         //ajout du kml
        ctaLayer.setMap(maCarte);


}
//ajout du marker
function addMarker() {

    var bool = tabReturn || 0;


    if(bool)
    {
        parcoursBus.push(new google.maps.LatLng(tabReturn.Latitude,tabReturn.Longitude));//Ajout de la line

        traceParcoursBus = new google.maps.Polyline({
        path: parcoursBus,//chemin du tracé
        strokeColor: "#FF0000",//couleur du tracé
        strokeOpacity: 1.0,//opacité du tracé
        strokeWeight: 2//grosseur du tracé
        });

        if( marker || 0)
        {
        marker.setMap(null);
        }

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(tabReturn.Latitude,tabReturn.Longitude),
            map: maCarte,
            icon: image,
            title: 'Position Bus - Temps Reel' +
                ' \n  Latitude : '+tabReturn.Latitude +"\n Longitude : " +tabReturn.Longitude
                +' \n Tour/Minute moteur : '+tabReturn.TourMinute+'\n Vitesse Nav :'+tabReturn.VitesseNav


        });



        traceParcoursBus.setMap(maCarte);
        /*

         */

    }
}



google.maps.event.addDomListener(window, 'load', initialisation);//chargement asyncrhone
