<?=$this->Form->create($modelName, array('class' => 'row')); ?>
    <fieldset class="col-lg-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('id')?>
        <?=$this->Form->hidden('last_lat')?>
        <?=$this->Form->hidden('last_lng')?>
        <?=$this->Form->input('title', array('label' => __('Title')))?>
        <?=$this->Form->input('area_id', array('label' => __('Area')))?>
        <?=$this->Form->input('leader_id', array('label' => __('Lead'), 'empty' => true))?>
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
        center: new google.maps.LatLng(-33.8681, 151.2075),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById('map'), myOptions);
    var markersArray = [];

    <?php if ($data && $data['Team']['last_lat'] != 0 && $data['Team']['last_lng'] != 0): ?>
    placeMarker(new google.maps.LatLng(<?php echo $data['Team']['last_lat']; ?>, <?php echo $data['Team']['last_lng']; ?>));
    <?php endif; ?>

    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng, true);
    });
    function placeMarker(location, rewriteLocation) {
        if (typeof(rewriteLocation) != 'undefined' && rewriteLocation) {
            clearOverlays();
            $('#TeamLastLat').val(location.lat());
            $('#TeamLastLng').val(location.lng());
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
