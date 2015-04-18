
function getFormData(parent, data) {
    $('input[type="number"], input:checked[type="radio"], input:checked[type="checkbox"], textarea, select, input:hidden', parent).each(function(){
        data[this.name] = this.value;
    });

    return data;
}

$(function(){
    App.controller('step1', function (page) {
        $(page)
            .find('.next')
            .on('click', function () {
                App.load('step2', getFormData(page, {}));
            });
    });

    App.controller('step1', function (page) {
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
        $(page)
            .find('.next')
            .on('click', function () {
                var d = getFormData(page, data);
console.log(d);
                $.ajax({
                    type: "POST",
                    url: $('base').attr('href') + 'mobile/incidents/save/' + d['data[Incident][id]'],
                    data: d,
                    //dataType: 'json',
                    success: function(){
                        //location.href = $('base').attr('href') + 'mobile/incidents/index';
                    }
                });


                console.log(d);
            });
    });

});
