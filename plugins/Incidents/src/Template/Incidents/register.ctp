<?php
use Cake\Routing\Router;

$radioOptions = ['type' => 'radio', 'escape' => false];

$referralsList = [];
foreach ($referrals as $r) {
    $referralsList[$r->id] = "<i class=\"fa fa-2x {$r->icon}\"></i><br />{$r->title}";
}

$supportTypesList = [];
foreach ($supportTypes as $s) {
    $supportTypesList[$s->id] = "<i class=\"fa fa-2x {$s->icon}\"></i><br />{$s->title}";
}
?>
<div class="register">
    <?= $this->Form->create($incident, ['class' => 'row col-lg-5', 'id' => 'wizard']); ?>
    <?php
    echo $this->Form->hidden('id');
    echo $this->Form->hidden('lat');
    echo $this->Form->hidden('lng');
    echo $this->Form->hidden('area_id');
    echo $this->Form->hidden('team_id');
    ?>

    <div id="bar" class="progress">
        <div class="progress-bar progress-bar-striped active" style="width:0"></div>
    </div>

    <ul style="display:none">
        <li><a href="#tab1" data-toggle="tab">Incident Report</a></li>
        <li><a href="#tab2" data-toggle="tab">Referred By</a></li>
        <li><a href="#tab3" data-toggle="tab">Support Provided</a></li>
        <li><a href="#tab4" data-toggle="tab">Outcome</a></li>
    </ul>
    <div class="tab-content">
        <fieldset class="tab-pane" id="tab1">
            <div class="row gender">
                <div class="col-xs-6">
                    <label for="males-number"><i class="fa fa-male"></i></label>
                    <?= $this->Form->input('males_number', ['default' => 0, 'label' => false]); ?>
                </div>
                <div class="col-xs-6">
                    <label for="females-number"><i class="fa fa-female"></i></label>
                    <?= $this->Form->input('females_number', ['default' => 0, 'label' => false]); ?>
                </div>
            </div>
            <div class="row col-lg-12 selector">
                <h5 class="legend"><?= __('Age') ?></h5>
                <?= $this->Form->input('age', $radioOptions); ?>
            </div>
            <div class="row col-lg-12 selector intoxication">
                <h5 class="legend"><?= __('Intoxication') ?></h5>
                <?= $this->Form->input('intoxication', $radioOptions); ?>
            </div>
            <div class="row col-lg-12 selector col-3">
                <h5 class="legend"><?= __('Receptiveness') ?></h5>
                <?= $this->Form->input('receptiveness', $radioOptions); ?>
            </div>
        </fieldset>
        <fieldset class="tab-pane" id="tab2">
            <div class="row col-lg-12 selector lg col-3">
                <?= $this->Form->input('referral_id', $radioOptions + ['options' => $referralsList]); ?>
            </div>
            <div class="row col-lg-12">
                <?= $this->Form->input('referral_comment', ['type' => 'text', 'label' => false, 'placeholder' => __('Comment...')]); ?>
            </div>
        </fieldset>
        <fieldset class="tab-pane" id="tab3">
            <div class="row col-lg-12 selector lg col-3">
                <?= $this->Form->input('support_type_id', $radioOptions + ['options' => $supportTypesList]); ?>
            </div>
            <div class="row col-lg-12">
                <?= $this->Form->input('sub_support_type_id', ['empty' => true, 'label' => false]); ?>
            </div>
        </fieldset>
        <fieldset class="tab-pane" id="tab4">
            <div class="row col-lg-12">
                <?= $this->Form->input('comment', ['label' => false, 'placeholder' => __('Comment...')]); ?>
            </div>
            <div class="row further-action">
                <h5 class="legend"><?= __('Further action required') ?></h5>
                <div class="col-xs-3"><?= $this->Form->input('draft'); ?></div>
                <div class="col-xs-3"><?= $this->Form->input('police'); ?></div>
                <div class="col-xs-3"><?= $this->Form->input('contact'); ?></div>
                <div class="col-xs-3"><?= $this->Form->input('report'); ?></div>
            </div>
            <div class="row supplies">
                <h5 class="legend"><?= __('Supplies') ?></h5>
                <div class="col-xs-3"><?= $this->Form->input('water_given', ['default' => 0]); ?></div>
                <div class="col-xs-3"><?= $this->Form->input('chupa_chups_given', ['label' => __('Chupa Chups'), 'default' => 0]); ?></div>
                <div class="col-xs-3"><?= $this->Form->input('thongs_given', ['label' => __('Thongs'). '<br />', 'escape' => false, 'default' => 0]); ?></div>
                <div class="col-xs-3"><?= $this->Form->input('vomit_bags_given', ['label' => __('Vomit Bags'), 'default' => 0]); ?></div>
            </div>
        </fieldset>
    </div>
    <ul class="pager wizard">
        <li class="previous back" style="display:none;"><a href="<?= Router::url(['action' => 'my']) ?>" class="btn"><i class="fa fa-angle-left"></i> <?= __('Back To List') ?></a></li>
        <li class="previous"><a href="javascript:;" class="btn"><i class="fa fa-angle-left"></i> <?= __('Back') ?></a></li>
        <li class="next"><a href="javascript:;" class="btn"><?= __('Next') ?> <i class="fa fa-angle-right"></i></a></li>
        <li class="next finish" style="display:none;"><?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?></li>
    </ul>
    <?= $this->Form->end() ?>
</div>

<div id="preloader"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>

<?php $this->append('script', $this->Html->script('jquery.bootstrap.wizard.min')); ?>
<?php $this->append('script'); ?>
<script type="text/javascript">
    var subSupportTypes = <?= json_encode($subSupportTypesFull) ?>;
</script>
<?php $this->end(); ?>
<?php $this->append('script', $this->Html->script('c' . DS . 'incidents' . DS . 'save')); ?>
