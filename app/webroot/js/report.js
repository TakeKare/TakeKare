$(function () {
    $('#incident-graph').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Incident Breakdown'
        },
        subtitle: {
            text: 'Saturday 18th April'
        },
        xAxis: {
            categories: [
                'De-escalation of Conflict',
                'Vulnerable to Sexual Assualt',
                'Vulnerable to Theft',
                'Vulnerable to Traffic Related Injury'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Incidents'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Yesterday',
            data: [20, 11, 6, 9]

        }, {
            name: 'Tonight',
            data: [14, 12, 9, 7]
        }]
    });
});

$(function () {

    var males = [0, 0, 0, 0];
    var females = [0, 0, 0, 0];

    var i =0;
    for (i in incidents) {
        males[parseInt(incidents[i]['Incident']['age']) - 1] += parseInt(incidents[i]['Incident']['males_number']);
        females[parseInt(incidents[i]['Incident']['age']) - 1] += parseInt(incidents[i]['Incident']['females_number']);
    }
    console.log(incidents);
    console.log(males);
    console.log(females);

    $('#age-gender').highcharts({
        chart: {
            type: 'column'
        },

        title: {
            text: 'People Assisted by Age and Gender'
        },

        subtitle: {
            text: 'Month of April'
        },

        xAxis: {
            categories: ['&lt; 18', '18 - 25', '23 - 39', '40 +']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number'
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: [{
            name: 'Male',
            //data: [50, 30, 40, 42, 24],
            data: males,
            stack: 'male'
        }, {
            name: 'Female',
            //data: [35, 44, 45, 24, 55],
            data: females,
	    color: '#d9534f',
            stack: 'female'
        }]
    });
});
