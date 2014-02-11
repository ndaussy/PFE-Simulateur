

<script>


$(function () {
    $('#container_2').highcharts({
        chart: {
            type: 'scatter',

            events: {

                click: function(e) {
                    // find the clicked values and the series
                    var x = e.xAxis[0].value,
                        y = e.yAxis[0].value,
                        series = this.series[0];
                        //alert("Value "+x+" Value"+y);


                }
        }
},


        title: {
            text: 'Line Number 1'
        },

subtitle: {
    text: '',
    enabled : false
    },

xAxis: {

    /*minPadding: 0.2,
    maxPadding: 0.2,
    maxZoom: 0.05,
        */

    categories: [
    <?php

    for($a=0;$a<count($kml);$a++)
    {
        if($a==0)
        {
        echo "'".$kml[$a]['Arret']."'";
        }
        else
        {
            echo ", '".$kml[$a]['Arret']."'";
        }


}


?>],

},

yAxis: {
    title: {
    text: 'TimeLine'

    },

minPadding: 0.2,
maxPadding: 0.2,
maxZoom: 60,

plotLines: [{
    value: 0,
    width: 0,
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

plotOptions: {
    line: {
    dataLabels: {
    enabled: true
    },
enableMouseTracking: false
},

    series: {
    allowPointSelect: true,
    lineWidth: 1,
    point: {
    events: {
    'click': function() {
    var bool = tabReturn || 0;

    if(bool)
    {
    //alert('Point cliqué y (time) =' + this.y);
    tabReturn.Scumul=this.y;

    }
    clearInterval(myVar);//Stop la boucle
    document.getElementById('time').value=this.y;
                    }
            }
        }
    }
},

series: [{
    name: 'Ligne 1',
    data: [
    <?php

    for($a=0;$a<count($kml);$a++)
    {
        if($a==0)//[x,y]
        {
        echo $kml[$a]['Scumul'];
        }
        else
        {
            echo ", ".$kml[$a]['Scumul'];
        }


    }


    /*for($a=0;$a<count($kml);$a++)
    {
        if($a==0)//[x,y]
        {
        echo "[".$kml[$a]['Longitude'].",".$kml[$a]['Latitude']."]";
        }
        if($a!=count($kml)-1)
        {
            echo ", [".$kml[$a]['Longitude'].",".$kml[$a]['Latitude']."]";
            }
        if($a==count($kml)-1)
        {
            echo ",[".$kml[$a]['Longitude'].",".$kml[$a]['Latitude']."]";
            }

}*/
    ?>


]
}
]
});
});
</script>