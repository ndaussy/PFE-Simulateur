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

    for($a=0;$a<count($kml);$a++)
    {
        if($a!=count($kml))
        {
        if( array_key_exists ($a,$kml))   echo '"'.$kml[$a]['arret'].'", ';

        }
else
                                    {
                                        if( array_key_exists ($a,$kml))  echo "'".$kml[$a]['arret']."'";
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

    for($a=0;$a<count($kml);$a++)
    {

        if($a!=count($kml))
        {
        if( array_key_exists ($a,$kml))  echo '1 , ';

        }
else
                                       {
                                           if( array_key_exists ($a,$kml))  echo '1  ';
                                           }

}
?>
]
}
]
});
});
</script>