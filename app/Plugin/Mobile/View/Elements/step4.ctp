
<div class="app-topbar">
    <div class="app-button left" data-back data-autotitle></div>
    <div class="app-title"><?= __('Outcome') ?></div>
</div>
<div class="app-content">
    <div class="block">
        <?=$this->Form->input('comment', array('label' => __('Comment'), 'class' => 'app-input'))?>
    </div>
    <div class="block tags">
        <?=$this->Form->input('draft', array('label' => __('Draft'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('police', array('label' => __('Police'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('contact', array('label' => __('Conact'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('report', array('label' => __('Report'), 'type' => 'checkbox'))?>
    </div>
    <div class="block supplies">
        <?=$this->Form->input('water_given', array('label' => __('Water'), 'type' => 'number', 'class' => 'app-input', 'default' => 0))?>
        <?=$this->Form->input('chupa_chups_given', array('label' => __('Chupa Chups'), 'type' => 'number', 'class' => 'app-input', 'default' => 0))?>
        <?=$this->Form->input('thongs_given', array('label' => __('Thongs'), 'type' => 'number', 'class' => 'app-input', 'default' => 0))?>
        <?=$this->Form->input('vomit_bags_given', array('label' => __('Vomit bags'), 'type' => 'number', 'class' => 'app-input', 'default' => 0))?>
    </div>
    <?=$this->Form->input('lat', array('type' => 'hidden'))?>
    <?=$this->Form->input('lng', array('type' => 'hidden'))?>
    <div class="footer">
        <div class="p-1-2">
            <div class="app-button" data-back><i class="fa fa-angle-left"></i> <?= __('Back') ?></div>
        </div>
        <div class="p-1-2">
            <div class="app-button next""><?= __('Finish') ?> <i class="fa fa-angle-right"></i></div>
    </div>
</div>
