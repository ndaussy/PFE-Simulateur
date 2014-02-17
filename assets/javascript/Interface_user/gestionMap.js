

//listener




//Variable globale
var tabReturn;
var parcoursBus = [];
var traceParcoursBus;
var Latence=0;
var PourcentageError=20;//Pourcentage d'erreur

var timeExecution=0.0;

//Variable googleMap
var maCarte;
var marker;
var centreCarte;
var image = 'http://127.0.0.1/PFE-Simulateur/assets/img/Bus_position.png';
var DoSimu=true;
var EndSimu=false;
var myVar;//contient le timeout

function Pause()
               {
                   DoSimu=false;
                   alert("Boutton Appuyer");
                   }

$(document).ready(function() {




    /*var pause = document.getElementById("pause");
     pause.addEventListener("Click", Pause, false);*/

    if(document.getElementById('delta'))
    {
    var delta = document.getElementById("delta").value;//Temps en ms*100 pour seconde
    }



//Variable globale utilisé pour partagé les données récupéré entre
//les différents prog javascript

//Fonction javascript GoogleMap


//Fonction d'execution
function Execution()
{

                     $('#pause').click(function() {

                        DoSimu=false;//arret d'envoi des information dans une ancienne version, plus d'actualité vu
                            //qu'on clear my var & arrête le compteur
                        clearInterval(myVar);

                        });


                    var dbt = new Date();
                    var dbt_requete=dbt.getTime();

                    var Ancientime=$('.time').val();
                    var TempsRecu=0.0;


                    if(document.getElementById('tempsreel').checked)//verifie si temps réel est coché
                    {
                    delta=(Latence+((Latence*PourcentageError)/100))/1000;//on prends l'ancienne Latence à laquelle on ajout un pourcentage d
                    //'erreur, la latence est donnée en ms & le delta en s
                    document.getElementById("delta").value=delta;
                    }
                    else
                    {
                        delta = document.getElementById("delta").value;//Recuperation du delta
                    }

                    if((delta)>=(Latence/1000))
                    {

                    //declaration d'une forme
                    var form_data = {
                    time : $('.time').val(),
                    ajax : '1',
                    tempsMoyenRequete : delta//ms
                    };



                    //mise en forme de la requêtes ajax
                    $.ajax({
                    url: Direction,
                    type: 'POST',
                    async : false,
                    data: form_data,
                    success:
                    function (msg) {


                        if(msg!=false)//reçoit false à la fin
                        {//VitesseNav - TourMinute valeur retour
                            tabReturn = JSON.parse(msg);
                            document.getElementById('time').value= tabReturn.Scumul;

                            $('#Kilometrage').html(tabReturn.Kilometrage);
                            $('#Scumul').html("Temps Relatif : " +tabReturn.Scumul + "s ,Delta : "+form_data.tempsMoyenRequete+" ms");



                            if(tabReturn.EtatPorte==2)//Affiché porte Red
                            {
                            document.getElementById('PorteClose').style.display='inline';
                            document.getElementById('PorteOpen').style.display='none';
                            }
                            else if(tabReturn.EtatPorte==0)//Affiché Porte Green
                            {
                            document.getElementById('PorteClose').style.display='none';
                            document.getElementById('PorteOpen').style.display='inline';
                            }

                            TempsRecu= tabReturn.Scumul;
                            //alert(msg.join(""));
                        }
                        else
                        {
                            EndSimu=true;
                        }
                    }


                    });

                    if(EndSimu)//si fin de simulation
                    {
                        document.getElementById('time').value='Simulation terminé';
                        $('#message').html("Simulation terminé");
                    }
                    else
                    {
                        //faux--pour obtenir du temps réel, il faut que TemposMoyenRequête == temps réelle requêtes
                        //timeExecution=Ancientime-TempsRecu-form_data.tempsMoyenRequete;
                        //timeExecution=(form_data.tempsMoyenRequete*100)-500;//ms-- on mets toujours un temps d'exe == latence
                        /*if(document.getElementById('tempsreel').checked)
                        {
                        delta=(Latence+((Latence*PourcentageError)/100));
                        delta=delta/1000;
                        }
                        else
                        {
                            timeExecution=(Latence+((Latence*PourcentageError)/100));
                        }*/
                        timeExecution=(Latence+((Latence*PourcentageError)/100));

                    //alert(timeExecution);
                    }

                    var fin = new Date();
                    var fin_requete=fin.getTime();

                    Latence=fin_requete-dbt_requete;

                    $('#Latence').html("Ping : "+(Latence)+" ms");
                    //document.getElementById('Latence').value= (fin_debut-dbt_requete);

                    return false;
                    }
                    else
                    {
                        alert("Le delta est inferieur au temps de latence,\n Latence : "+(Latence/1000)+"\n Delta"+delta);
                        clearInterval(myVar);
                    }

                    };

                    function Timeout()
                    {
                        if(DoSimu)//pour la pause
                        {
                        //Même temps d'execution pour Map & Recuperation data
                        //setTimeout(Execution,timeExecution);//Recuperation des données
                        Execution();
                        //setTimeout(addMarker,timeExecution);//GoogleMap AddMarker
                        addMarker();
                        }

                        if(EndSimu)//arret simu
                        {
                            clearInterval(myVar);
                        }
                    }

                    function BeginSimulation()
                    {
                        DoSimu=true;
                        EndSimu=false;

                        timeExecution=0.0;

                        if(!EndSimu)
                        {
                            myVar=setInterval(function(){Timeout()},timeExecution);//Execute toutes les delta milliseconde la fonction
                         }

                    }

                    $('#tempsreel').click(function()
                    {
                        var tempsreel=document.getElementById("tempsreel")

                        if(tempsreel.checked)
                        {
                        alert('En temps réel, le delta équivaut à la latence avec une erreur de 20%');
                        }

                    });

                        $('#time').click(function()
                        {
                            clearInterval(myVar);//stop simu
                        }
                        );

                        $('#delta').click(function()
                        {
                            clearInterval(myVar);
                        }
                        );


                        $('#lancerSimu').click(function()
                         {

                        BeginSimulation();

                        });

                        $('#pause').click(function() {

                        DoSimu=false;//arret d'envoi des information dans une ancienne version, plus d'actualité vu
                            //qu'on clear my var & arrête le compteur
                        clearInterval(myVar);

                        });




});

