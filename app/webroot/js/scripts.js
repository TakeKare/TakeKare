$(function(){

    $('#platforms-tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('#UserCustomFormat').change(function(){
        $('#UserMessageFormat').attr('disabled', this.checked ? false : 'disabled');
    }).triggerHandler('change');

});