$(function(){
    var incidentsByHours = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    var hours = ['12AM', '1AM', '2AM', '3AM', '4AM', '5AM', '6AM', '7AM', '8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM', '10PM', '11PM'];

    var params = [
        'age',
        'intoxication',
        'receptiveness'
    ];

    var series = {};

    series['sex'] = [
        ['Males', 0],
        ['Females', 0]
    ];

    var data = [];

    for (var i in incidents) {
        series['sex'][0][1] += incidents[i]['males_number'];
        series['sex'][1][1] += incidents[i]['females_number'];

        var hour = parseInt(incidents[i]['created'].substr(11, 2));
        incidentsByHours[hour]++;

        for (var field in lists) {
            if (incidents[i][field] === undefined || incidents[i][field] == null) {
                continue;
            }

            var value = incidents[i][field];

            if (data[field] === undefined) {
                data[field] = {};
            }

            if (data[field][value] === undefined) {
                data[field][value] = 0;
            }

            data[field][value]++;
        }
    }

    hours = hours.slice(12, 24).concat(hours.slice(0, 12));
    incidentsByHours = incidentsByHours.slice(12, 24).concat(incidentsByHours.slice(0, 12));

    if (incidentsByHours.length > 0) {
        var toShift = 0
        for (var i = 0; i < incidentsByHours.length; i++) {
            if (incidentsByHours[i] > 0) {
                break;
            }
            toShift++;
        }

        var toPop = 0;
        for (var i = incidentsByHours.length - 1; i >= 0; i--) {
            if (incidentsByHours[i] > 0) {
                break;
            }
            toPop++;
        }

        for (var i = 0; i < toShift; i++) {
            incidentsByHours.shift();
            hours.shift();
        }

        for (var i = 0; i < toPop; i++) {
            incidentsByHours.pop();
            hours.pop();
        }
    }

    for (var list in lists) {
        for (var l in lists[list]) {
            if (series[list] === undefined) {
                series[list] = [];
            }

            if (data[list] === undefined) {
                data[list] = {};
            }

            var key = l;
            var title = lists[list][l];
            series[list].push([
                title,
                data[list][key] === undefined
                    ? 0
                    : data[list][key]
            ]);
        }
    }

    drawSemiPieGraph($('#chart-sex'), 'Sex', series['sex']);
    drawSemiPieGraph($('#chart-age'), 'Age', series['age']);
    drawSemiPieGraph($('#chart-intoxication'), 'Intoxication', series['intoxication']);
    drawSemiPieGraph($('#chart-receptiveness'), 'Receptiveness', series['receptiveness']);
    drawPieGraph($('#chart-referred'), 'Referred By', series['referral_id']);
    drawPieGraph($('#chart-support'), 'Support Provided', series['support_type_id']);
    drawColumnGraph($('#chart-hours'), 'Incidents By Day Time', hours, incidentsByHours);

    if ($('#incidents-map').length > 0) {
        var map = L.map('incidents-map').setView([-33.869, 151.2094], 15);
        if (area !== undefined && area != null) {
            map.setView([area.lat, area.lng], 16);
        }
        L.tileLayer('http://{s}.tiles.mapbox.com/v3/jt987.lp09bdfp/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18
        }).addTo(map);

        var markers = new L.MarkerClusterGroup();
        for (var i in incidents) {
            var incident = incidents[i];
            if (incident.lat == null || incident.lng == null) {
                continue;
            }

            markers.addLayer(getIncidentMarker(incident));
        }
        map.addLayer(markers);
    }
});

function drawSemiPieGraph($div, title, data) {
    var params = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            height: 160,
            margins: [0, 0, 0, 0]
        },
        title: {
            text: title,
            align: 'center',
            verticalAlign: 'middle',
            y: 65
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                size: '240%',
                //center: ['50%', '50%'],
                center: ['50%', '100%']
            }
        },
        series: [{
            type: 'pie',
            innerSize: '40%',
            data: data
        }]
    };

    return $div.highcharts(params);
}

function drawPieGraph($div, title, data) {
    var params = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: title
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            data: data
        }]
    };

    return $div.highcharts(params);
}

function drawColumnGraph($div, title, xAxis, yAxis) {
    var params = {
        chart: {
            type: 'column'
        },
        title: {
            text: title
        },
        xAxis: {
            categories: xAxis
        },
        yAxis: {
            title: false
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
            column: {
                showInLegend: false
            }
        },
        series: [{
            data: yAxis
        }]
    };

    return $div.highcharts(params);
}
