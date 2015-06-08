<div id="map" style="height:500px"></div>

<?= $this->element('Js' .  DS . 'leaflet') ?>
<?php $this->append('script'); ?>
<script type="text/javascript">
    var teams = <?= json_encode($teams); ?>;
    var incidents = <?= json_encode($incidents); ?>;
</script>
<?php $this->end(); ?>

