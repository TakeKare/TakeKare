
<div class="app-topbar">
    <div class="app-button left" data-back data-autotitle></div>
    <div class="app-title"><?= __('Support Provided') ?></div>
</div>
<div class="app-content">
    <div class="block referrals">
        <?php foreach($supportTypes as $r): ?>
            <div class="p-1-3">
                <?=$this->Form->input('support_type_id', array('type' => 'radio', 'options' => [$r['SupportType']['id'] => '<i class="fa ' . $r['SupportType']['icon'] . ' fa-2x"></i><br />' . $r['SupportType']['title']], 'div' => 'selector', 'hiddenField' => false))?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="block">
        <?=$this->Form->input('support_type_sub_id', array('label' => false, 'class' => 'app-input', 'options' => [1, 2]))?>
    </div>
    <div class="footer">
        <div class="p-1-2">
            <div class="app-button" data-back><i class="fa fa-angle-left"></i> <?= __('Back') ?></div>
        </div>
        <div class="p-1-2">
            <div class="app-button next"><?= __('Next') ?> <i class="fa fa-angle-right"></i></div>
        </div>
    </div>
</div>
