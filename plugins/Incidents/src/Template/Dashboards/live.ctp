<?php use Cake\Routing\Router;

$this->assign('title', __('Live View')); ?>

<?= $this->element('incidents_filter', ['short' => true]) ?>

<?php if ($incidents->count() == 0): ?>
    <div class="alert alert-dismissible fade in alert-warning"><?= __('No incidents found.') ?></div>
<?php else: ?>

    <div class="row">
        <div class="col-lg-10">
            <div id="map" style="margin-bottom:1.5em">
                <div id="incidents-map" style="height:462px"></div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="fa fa-trophy fa-5x"></i></div>
                        <div class="col-xs-9 text-right">
                            <?php
                            $incidentsByTeam = $incidents
                                ->groupBy('team_id')
                                ->map(function ($value, $key) {
                                    return count($value);
                                })
                                ->toArray();
                            $bestTeamId = array_search(max($incidentsByTeam), $incidentsByTeam);
                            $teams = $teams->toArray();
                            ?>
                            <div class="huge"><?= $this->Number->format(max($incidentsByTeam)) ?></div>
                            <div><?= $teams[$bestTeamId] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="fa fa-life-ring fa-5x"></i></div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->count()) ?></div>
                            <div><?= __('Incidents') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="fa fa-male fa-5x"></i></div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->sumOf('males_number')) ?></div>
                            <div><?= __('Males') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3"><i class="fa fa-female fa-5x"></i></div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $this->Number->format($incidents->sumOf('females_number')) ?></div>
                            <div><?= __('Females') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-clock-o fa-fw"></i> <?= __('Incidents Timeline') ?></div>
        <div class="panel-body">
            <ul class="timeline">
                <?php foreach ($incidents as $k => $inc): ?>
                    <li<?= (($k % 2) ? '' : ' class="timeline-inverted"') ?>>
                        <?php if ($inc->support_type): ?>
                            <div class="timeline-badge"<?php if ($inc->support_type->color) echo " style=\"background-color: {$inc->support_type->color}\""; ?>><i class="fa <?= $inc->support_type->icon ?>"></i></div>
                        <?php else: ?>
                            <div class="timeline-badge"><i class="fa"></i></div>
                        <?php endif; ?>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <p><small class="text-muted"><a href="<?= Router::url(['controller' => 'Incidents', 'action' => 'save', $inc->id, 'plugin' => 'Incidents']) ?>"><i class="fa fa-clock-o"></i> <?= $inc->created->timeAgoInWords() ?> <?= __('by') ?> <strong><?= $inc->team->title ?></strong> <?= __('at') ?> <strong><?= $inc->area->title ?> <?= __('area') ?></strong></a></small></p>
                            </div>
                            <div class="timeline-body">
                                <p>
                                    <?php
                                    $lines = [];

                                    $people = '';
                                    if ($inc->males_number > 0) {
                                        $people .= '<i class="fa fa-male"></i> ' . $this->Number->format($inc->males_number);
                                    }
                                    if ($inc->females_number > 0) {
                                        if ($people) {
                                            $people .= ' ';
                                        }
                                        $people .= '<i class="fa fa-female"></i> ' . $this->Number->format($inc->females_number);
                                    }
                                    ?>
                                    <?php if ($people):?>
                                        <?= $people ?><br />
                                    <?php endif; ?>
                                    <?php if (isset($ages[$inc->age])): ?>
                                        <strong><?= __('Age') ?>:</strong> <?= $ages[$inc->age] ?><br />
                                    <?php endif; ?>
                                    <?php if (isset($intoxications[$inc->intoxication])): ?>
                                        <strong><?= __('Intoxication') ?>:</strong> <?= $intoxications[$inc->intoxication] ?><br />
                                    <?php endif; ?>
                                    <?php if (isset($receptivenesses[$inc->receptiveness])): ?>
                                        <strong><?= __('Receptiveness') ?>:</strong> <?= $receptivenesses[$inc->receptiveness] ?><br />
                                    <?php endif; ?>
                                    <?php if ($inc->referral): ?>
                                        <strong><?= __('Referred By') ?>:</strong> <?= $inc->referral->title ?><br />
                                    <?php endif; ?>
                                    <?php if ($inc->support_type): ?>
                                        <strong><?= __('Support Provided') ?>:</strong> <?= $inc->support_type->title ?>
                                        <?php if ($inc->sub_support_type): ?> (<?= $inc->sub_support_type->title ?>)<?php endif; ?><br />
                                    <?php endif; ?>
                                    <?php if ($inc->comment): ?>
                                        <strong><?= __('Comment') ?>:</strong> <?= h($inc->comment) ?><br />
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.panel-body -->
    </div>

<?php endif; ?>

<?= $this->element('Js' .  DS . 'leaflet') ?>
<?php $this->append('css', $this->Html->css('leaflet.awesome-markers.css')); ?>
<?php $this->append('css', $this->Html->css('bootstrap-datetimepicker.min.css')); ?>
<?php $this->append('script', $this->Html->script('leaflet.awesome-markers.min')); ?>
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
