<ul class="nav nav-pills row">
    <li><?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $incident->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $incident->id)]
        )
        ?></li>
    <li><?= $this->Html->link(__('List Incidents'), ['action' => 'index']) ?></li>
</ul>
<div>
    <?= $this->Form->create($incident); ?>
    <?php
    echo $this->Form->hidden('id');
    echo $this->Form->hidden('lat');
    echo $this->Form->hidden('lng');
    ?>
    <fieldset class="row">
        <div class="col-md-3"><?= $this->Form->input('area_id'); ?></div>
        <div class="col-md-3"><?= $this->Form->input('team_id'); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-2"><?= $this->Form->input('males_number', ['default' => 0]); ?></div>
        <div class="col-md-2"><?= $this->Form->input('females_number', ['default' => 0]); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-2"><?= $this->Form->input('age', ['empty' => true]); ?></div>
        <div class="col-md-2"><?= $this->Form->input('intoxication', ['empty' => true]); ?></div>
        <div class="col-md-2"><?= $this->Form->input('receptiveness', ['empty' => true]); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-6"><?= $this->Form->input('referral_id', ['empty' => true]); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-6"><?= $this->Form->input('referral_comment'); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-3"><?= $this->Form->input('support_type_id', ['empty' => true]); ?></div>
        <div class="col-md-3"><?= $this->Form->input('sub_support_type_id', ['empty' => true]); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-6"><?= $this->Form->input('comment'); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-1"><?= $this->Form->input('draft'); ?></div>
        <div class="col-md-1"><?= $this->Form->input('police'); ?></div>
        <div class="col-md-1"><?= $this->Form->input('contact'); ?></div>
        <div class="col-md-1"><?= $this->Form->input('report'); ?></div>
    </fieldset>
    <fieldset class="row">
        <div class="col-md-2"><?= $this->Form->input('water_given', ['default' => 0]); ?></div>
        <div class="col-md-2"><?= $this->Form->input('chupa_chups_given', ['label' => __('Chupa Chups'), 'default' => 0]); ?></div>
        <div class="col-md-2"><?= $this->Form->input('thongs_given', ['label' => __('Thongs'), 'default' => 0]); ?></div>
        <div class="col-md-2"><?= $this->Form->input('vomit_bags_given', ['label' => __('Vomit Bags'), 'default' => 0]); ?></div>
    </fieldset>
    <fieldset>
        <?= $this->element('entity_map'); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->append('script'); ?>
<script type="text/javascript">
    var subSupportTypes = <?= json_encode($subSupportTypesFull) ?>;
</script>
<?php $this->end(); ?>



