$(function(){
    if ($('.datetime').length > 0) {
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    }
});

function getIncidentMarker(incident) {
    var params = {};
    if (incident.support_type != null) {
        var iconParams = {
            icon: incident.support_type.icon.replace('fa-', ''),
            prefix: 'fa'
        };

        if (incident.support_type.color != '') {
            iconParams.markerColor = incident.support_type.color;
        }

        params.icon = L.AwesomeMarkers.icon(iconParams);
    }

    var marker = L.marker([incident.lat, incident.lng], params);

    var options = {
        weekday: "long", year: "numeric", month: "short",
        day: "numeric", hour: "2-digit", minute: "2-digit"
    };

    var url = $('base').attr('href') + 'incidents/save/' + incident.id;

    var popup = '<a href="' + url + '"><b>#' + incident.id + '</b> ' + (new Date(incident.created)).toLocaleDateString('en-AU', options) + ' by <strong>' + incident.team.title + '</strong></a>';
    var people = '';
    if (incident.males_number > 0) {
        people += '<i class="fa fa-male"></i> ' + incident.males_number;
    }
    if (incident.females_number > 0) {
        if (people != '') {
            people += ' ';
        }

        people += '<i class="fa fa-female"></i> ' + incident.females_number;
    }
    if (people != '') {
        popup += '<br />' + people;
    }

    if (lists !== undefined) {
        if (incident.age > 0) {
            popup += '<br ><b>Age: </b>' + lists.age[incident.age];
        }
        if (incident.intoxication > 0) {
            popup += '<br ><b>Intoxication: </b>' + lists.intoxication[incident.intoxication];
        }
        if (incident.receptiveness > 0) {
            popup += '<br ><b>Receptiveness: </b>' + lists.receptiveness[incident.receptiveness];
        }
    }

    if (incident.referral != null) {
        popup += '<br ><b>Referred By: </b>' + incident.referral.title;
    }

    if (incident.support_type != null) {
        popup += '<br ><b>Support Provided: </b>' + incident.support_type.title;
    }

    if (incident.comment != '') {
        popup += '<br ><b>Comment: </b>' + incident.comment;
    }

    marker.bindPopup(popup);

    return marker;
}
