<?=$this->Form->create($modelName, array('class' => 'row')); ?>
    <fieldset class="col-lg-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('id')?>
        <?=$this->Form->hidden('lat')?>
        <?=$this->Form->hidden('lng')?>
        <?=$this->Form->input('area_id', array('label' => __('Area')))?>
        <?=$this->Form->input('team_id', array('label' => __('Team')))?>
        <?=$this->Form->input('males_number', array('label' => __('Males')))?>
        <?=$this->Form->input('females_number', array('label' => __('Females')))?>
        <?=$this->Form->input('age', array('label' => __('Age'), 'empty' => true))?>
        <?=$this->Form->input('receptiveness', array('label' => __('Receptiveness'), 'empty' => true))?>
        <?=$this->Form->input('intoxication', array('label' => __('Intoxication'), 'empty' => true))?>
        <?=$this->Form->input('referral_id', array('label' => __('Referred By'), 'empty' => true))?>
        <?=$this->Form->input('referral_comment', array('label' => __('Comment'), 'type' => 'text'))?>
        <?=$this->Form->input('support_type_id', array('label' => __('Support Provided'), 'empty' => true))?>
        <?=$this->Form->input('support_type_sub_id', array('label' => __('Support Provided'), 'empty' => true))?>
        <?=$this->Form->input('comment', array('label' => __('Comment')))?>
        <?=$this->Form->input('draft', array('label' => __('Draft'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('police', array('label' => __('Police'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('contact', array('label' => __('Contact'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('report', array('label' => __('Report'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('water_given', array('label' => __('Water')))?>
        <?=$this->Form->input('chupa_chups_given', array('label' => __('Chupa Chups')))?>
        <?=$this->Form->input('thongs_given', array('label' => __('Thongs')))?>
        <?=$this->Form->input('vomit_bags_given', array('label' => __('Vomig bags')))?>
        <?=$this->Form->input('created', array('label' => __('Created'), 'type' => 'text', 'default' => date('Y-m-d H:i:s')))?>
    </fieldset>
    <fieldset class="col-lg-12">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <div id="map" style="width: 480px; height: 400px; display: inline-block;"></div>
    </fieldset>
    <fieldset class="col-lg-12">
        <?=$this->Form->submit(__('Save'))?>
    </fieldset>
<?=$this->Form->end(); ?>

<script type="text/javascript">
    // <![CDATA[
    var myOptions = {
        zoom: 15,
        center: new google.maps.LatLng(55.166625, 23.873291),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById('map'), myOptions);
    var markersArray = [];

    <?php if ($data && $data['Incident']['lat'] != 0 && $data['Incident']['lng'] != 0): ?>
    placeMarker(new google.maps.LatLng(<?php echo $data['Incident']['lat']; ?>, <?php echo $data['Incident']['lng']; ?>));
    <?php endif; ?>

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
    // ]]>
</script>

