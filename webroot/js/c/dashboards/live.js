$(function(){
    if ($('#incidents-map').length > 0) {
        var map = L.map('incidents-map').setView([-33.869, 151.2094], 15);
        if (area !== undefined && area != null) {
            map.setView([area.lat, area.lng], 16);
        }
        L.tileLayer('http://{s}.tiles.mapbox.com/v3/jt987.lp09bdfp/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18
        }).addTo(map);

        for (var i in incidents) {
            var incident = incidents[i];
            if (incident.lat == null || incident.lng == null) {
                continue;
            }

            map.addLayer(getIncidentMarker(incident));
        }
    }
});
