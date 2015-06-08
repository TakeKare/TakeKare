$(function(){
    var map = L.map('map').setView([-33.869, 151.2094], 15);
    L.tileLayer('http://{s}.tiles.mapbox.com/v3/jt987.lp09bdfp/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18
    }).addTo(map);

    var options = {
        weekday: "long", year: "numeric", month: "short",
        day: "numeric", hour: "2-digit", minute: "2-digit"
    };

    for (var i in teams) {
        var team = teams[i];
        if (incidents[team.id] === undefined) {
            continue;
        }

        var incident = incidents[team.id];

        var marker = L.marker([incident.lat, incident.lng]);

        var popup = '<b>' + team.title + '</b><br />Incident #' + incident.id + ', ' + (new Date(incident.created)).toLocaleDateString('en-AU', options);
        marker.bindPopup(popup);

        map.addLayer(marker);
    }
});
