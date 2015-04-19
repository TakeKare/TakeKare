var userData = {
  "type": "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "type": "Incident",
        "comment": ""
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.2041473388672,
          -33.86656714152149
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident",
        "number": ""
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.20758056640625,
          -33.88110466676628
        ]
      }
    }]};

var incidentData = {
  "type": "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.2068510055542,
          -33.86891896789376
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.2086534500122,
          -33.86585445407186
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.20985507965088,
          -33.86774306280644
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.20715141296387,
          -33.865177395484075
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.21118545532227,
          -33.87187647575139
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.2046194076538,
          -33.87091440612711
        ]
      }
    },
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.2110996246338,
          -33.86328872999274
        ]
      }
    }]};


var refData = {
  "type": "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "type": "Incident"
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          151.20500564575195,
          -33.88053461438696
        ]
      }
    }
  ]
};

$(function() {

    var map = L.map('live-map').setView([-33.869, 151.2094], 14);
    L.tileLayer('http://{s}.tiles.mapbox.com/v3/jt987.lp09bdfp/{z}/{x}/{y}.png', {
       attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
       maxZoom: 18
       }).addTo(map);
    var safeSpace = L.divIcon({
      className: 'fa-2x fa-h-square icon-1',
        iconSize: [20, 20]
    });
    var incident = L.divIcon({
      className: 'fa-2x fa-exclamation-circle icon-2',
        iconSize: [20, 20]
    });
    var user = L.divIcon({
      className: 'fa-2x fa-user icon-3',
        iconSize: [20, 20]
    });
    var ref = L.divIcon({
      className: 'fa-2x fa-ambulance',
        iconSize: [20, 20]
    });
    L.marker([-33.87406781608232,151.20644330978394] , {icon: safeSpace}).addTo(map);
    L.geoJson(refData,{
      pointToLayer: function(feature, latlng) {
        return L.marker(latlng, {icon: ref});
      } 
    }).addTo(map);
    L.geoJson(incidentData,{
      pointToLayer: function(feature, latlng) {
        return L.marker(latlng, {icon: incident});
      } 
    }).addTo(map);
    L.geoJson(userData,{
      pointToLayer: function(feature, latlng) {
        return L.marker(latlng, {icon: user});
      } 
    }).addTo(map);
map.scrollWheelZoom.disable();

    $("#btn-chat").click(function() {
	$("#new-chat").show();
	$("#new-chat-message").text($("#btn-input").val());
    });
    $('#btn-input').keypress(function (e) {
    if (e.which == 13) {
       $('#btn-chat').click();
    }
    });
});

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
