<?php $this->assign('title', __('Report')); ?>

<?= $this->element('incidents_filter') ?>

<?php if ($incidents->count() == 0): ?>
    <div class="alert alert-dismissible fade in alert-warning"><?= __('No incidents found.') ?></div>
<?php else: ?>

    <div id="map" style="margin-bottom:1.5em">
        <div id="incidents-map" style="height:500px"></div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-sex"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-age"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-intoxication"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-receptiveness"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-hours"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-referred"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chart-support"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= $this->Html->image('white128_bottle.png', ['width' => 80]) ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->sumOf('water_given')) ?></div>
                            <div><?= __('Water Given') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= $this->Html->image('white128_ChupaChup.png', ['width' => 80]) ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->sumOf('chupa_chups_given')) ?></div>
                            <div><?= __('Chupa Chups') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= $this->Html->image('white128_thongs.png', ['width' => 80]) ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->sumOf('thongs_given')) ?></div>
                            <div><?= __('Thongs') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <?= $this->Html->image('white128_bag.png', ['width' => 80]) ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->sumOf('vomit_bags_given')) ?></div>
                            <div><?= __('Vomit Bags') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $this->append('script', $this->Html->script('//code.highcharts.com/highcharts.js')); ?>
<?php $this->append('script', $this->Html->script('//code.highcharts.com/modules/exporting.js')); ?>
<?= $this->element('Js' .  DS . 'leaflet') ?>
<?php $this->append('css', $this->Html->css('leaflet.awesome-markers.css')); ?>
<?php $this->append('css', $this->Html->css('MarkerCluster.css')); ?>
<?php $this->append('css', $this->Html->css('bootstrap-datetimepicker.min.css')); ?>
<?php $this->append('script', $this->Html->script('leaflet.awesome-markers.min')); ?>
<?php $this->append('script', $this->Html->script('leaflet.markercluster')); ?>
<?php $this->append('script', $this->Html->script('moment.min')); ?>
<?php $this->append('script', $this->Html->script('bootstrap-datetimepicker.min')); ?>
<?php $this->append('script'); ?>
<script type="text/javascript">
    var incidents = <?= json_encode($incidents); ?>;
    var area = <?= json_encode($area); ?>;

    var lists = {
        'age': <?= json_encode($ages); ?>,
        'intoxication': <?= json_encode($intoxications); ?>,
        'receptiveness': <?= json_encode($receptivenesses); ?>,
        'referral_id': <?= json_encode($referrals); ?>,
        'support_type_id': <?= json_encode($supportTypes); ?>
    };
</script>
<?php $this->end(); ?>
