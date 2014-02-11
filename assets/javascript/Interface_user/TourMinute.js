
$(function () {

    $('#TourMinute').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

title: {
    text: 'Tour/Minutes'
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
    max: 4000,

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
    text: 'T/M'
    },
plotBands: [{
    from: 0,
    to: 2000,
    color: '#55BF3B' // green
    }, {
    from: 2000,
    to: 2500,
    color: '#DDDF0D' // yellow
    }, {
    from: 2500,
    to: 4000,
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
// Linkage avec les valeurs récupéré
function (chart) {
    setInterval(function () {
        var point = chart.series[0].points[0];
        var newVal;

        var bool = tabReturn || 0;

        if(bool)
        {
            newVal = parseInt(tabReturn.TourMinute);//tabReturn.TourMinute.valueOf();
            //alert(tabReturn.TourMinute);
            //document.getElementById('TourMinute').value
            //alert(tabReturn.TourMinute);


        }
        else
        {
            newVal=0;
        }

point.update(newVal);

}, 100);//non acccessible depuis l'exterieure

});
});
