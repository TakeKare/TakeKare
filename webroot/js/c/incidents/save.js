$(function(){
    $('#support-type-id').on('change', function() {
        var $subs = $('#sub-support-type-id');
        var selected = $subs.val();
        $subs.empty();
        $subs.append('<option value=""></option>');
        for (var i in subSupportTypes) {
            var subType = subSupportTypes[i];
            if (subType.parent_id != this.value) {
                continue;
            }
            $subs.append('<option value="' + subType.id + '">' + subType.title + '</option>');
        }
        $subs.val(selected);
    }).triggerHandler('change');
});
