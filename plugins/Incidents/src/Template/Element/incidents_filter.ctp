<div class="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#filter" data-parent="#accordion" data-toggle="collapse" class="" aria-expanded="true"><?= __('Filter') ?></a>
            </h4>
        </div>
        <div class="panel-collapse collapse<?php if (!empty($this->request->query)) echo ' in'; ?>" id="filter" aria-expanded="true" style="">
            <div class="panel-body">
                <?= $this->Form->create(null, ['id' => 'filter', 'type' => 'get']) ?>
                    <div class="row">
                        <div class="col-lg-2"><?= $this->Form->input('area_id', ['multiple' => 'select', 'options' => $areas, 'value' => $query['area_id']]) ?></div>
                        <div class="col-lg-2"><?= $this->Form->input('team_id', ['multiple' => 'select', 'options' => $teams, 'value' => $query['team_id']]) ?></div>
                        <div class="col-lg-1"><?= $this->Form->input('age', ['multiple' => 'select', 'options' => $ages, 'value' => $query['age']]) ?></div>
                        <div class="col-lg-1"><?= $this->Form->input('intoxication', ['multiple' => 'select', 'options' => $intoxications, 'value' => $query['intoxication']]) ?></div>
                        <div class="col-lg-2"><?= $this->Form->input('receptiveness', ['multiple' => 'select', 'options' => $receptivenesses, 'value' => $query['receptiveness']]) ?></div>
                        <div class="col-lg-2"><?= $this->Form->input('referral_id', ['multiple' => 'select', 'options' => $referrals, 'value' => $query['referral_id'], 'label' => __('Referred By')]) ?></div>
                        <div class="col-lg-2"><?= $this->Form->input('support_type_id', ['multiple' => 'select', 'options' => $supportTypes, 'value' => $query['support_type_id'], 'label' => __('Support Provided')]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><?= $this->Form->input('created_from', ['class' => 'datetime', 'empty' => true, 'value' => $query['created_from']]) ?></div>
                        <div class="col-lg-2"><?= $this->Form->input('created_to', ['class' => 'datetime', 'empty' => true, 'value' => $query['created_to']]) ?></div>
                    </div>
                    <?= $this->Form->button(__('Filter'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
