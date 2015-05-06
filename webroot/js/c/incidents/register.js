$(function() {
    $('#wizard').bootstrapWizard({
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#bar .progress-bar').css({width: $percent + '%'});

            $('#page-title').text(tab.text());

            // If it's the last tab then hide the last button and show the finish instead
            $('#wizard').find('.pager .next').toggle($current < $total);
            $('#wizard').find('.pager .finish').toggle($current >= $total);
            $('#wizard').find('.pager .back').toggle($current == 1).removeClass('disabled');
        }
    });

    navigator.geolocation.getCurrentPosition(GetLocation);
    function GetLocation(location) {
        if ($('#wizard input[name="lat"]').val() == '') {
            $('#wizard input[name="lat"]').val(location.coords.latitude);
            $('#wizard input[name="lng"]').val(location.coords.longitude);
        }
    }
});

