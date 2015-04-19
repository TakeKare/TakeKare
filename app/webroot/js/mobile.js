
function getFormData(parent, data) {
    $('input[type="number"], input:checked[type="radio"], input:checked[type="checkbox"], textarea, select, input[type="hidden"]', parent).each(function(){
        data[this.name] = this.value;
        //console.log(this.id);
    });
console.log(data);
    return data;
}

$(function(){
    App.controller('home', function (page) {
        $('.incident', page).click(function(){
            location.href = $('base').attr('href') + 'mobile/incidents/save/' + $(this).data('id');
        });

        $(page)
            .find('.add')
            .on('click', function () {
                App.load('step1', {});
            });
    });

    App.controller('teams-location', function (page) {
        var myOptions = {
            zoom: 15,
            center: new google.maps.LatLng(-33.8681, 151.2075),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map($('#map', page)[0], myOptions);
        var markersArray = [];

        var i = 0;
        for (i in teams) {
            placeMarker(new google.maps.LatLng(teams[i]['Team']['last_lat'], teams[i]['Team']['last_lng']));
        }

        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng, true);
        });
        function placeMarker(location, rewriteLocation) {
            if (typeof(rewriteLocation) != 'undefined' && rewriteLocation) {
                clearOverlays();
                $('#IncidentLat').val(location.lat());
                $('#IncidentLng').val(location.lng());
            }
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markersArray.push(marker);
            map.setCenter(location);

        }

        function clearOverlays(){
            if (markersArray){
                for (i in markersArray){
                    markersArray[i].setMap(null);
                }
            }
        }
    });

    App.controller('step1', function (page) {
        $(page)
            .find('.back')
            .on('click', function () {
                location.href = $('base').attr('href') + 'mobile/incidents/index';
            });
        $(page)
            .find('.next')
            .on('click', function () {
                App.load('step2', getFormData(page, {}));
            });
    });

    App.controller('step2', function (page, data) {
        $(page)
            .find('.next')
            .on('click', function () {
                App.load('step3', getFormData(page, data));
            });
    });

    App.controller('step3', function (page, data) {
        $(page)
            .find('.next')
            .on('click', function () {
                App.load('step4', getFormData(page, data));
            });
    });

    App.controller('step4', function (page, data) {
        navigator.geolocation.getCurrentPosition(GetLocation);
        function GetLocation(location) {
            if ($('#IncidentLat', page).val() == '0.00000000') {
                $('#IncidentLat', page).val(location.coords.latitude);
                $('#IncidentLng', page).val(location.coords.longitude);
            }
        }

        $(page)
            .find('.next')
            .on('click', function () {
                var d = getFormData(page, data);

                $.ajax({
                    type: "POST",
                    url: $('base').attr('href') + 'mobile/incidents/save/' + d['data[Incident][id]'],
                    data: d,
                    //dataType: 'json',
                    success: function(){
                        location.href = $('base').attr('href') + 'mobile/incidents/index';
                    }
                });
            });
    });

});
