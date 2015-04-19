
function getFormData(parent, data) {
    $('input[type="number"], input:checked[type="radio"], input:checked[type="checkbox"], textarea, select, input[type="hidden"]', parent).each(function(){
        data[this.name] = this.value;
        console.log(this.id);
    });
console.log(data);
    return data;
}

$(function(){
    App.controller('home', function (page) {
        $(page)
            .find('.add')
            .on('click', function () {
                App.load('step1', {});
            });
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
        if ($('#IncidentLat', page).val() == '0.00000000') {
            navigator.geolocation.getCurrentPosition(GetLocation);
            function GetLocation(location) {
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
