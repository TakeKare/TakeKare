<div class="app-topbar">
    <div class="app-button left" data-back data-autotitle></div>
    <div class="app-title"><?= __('Referred By') ?></div>
</div>
<div class="app-content">
    <div class="block referrals">
        <?php foreach($referrals as $r): ?>
            <div class="p-1-3">
                <?=$this->Form->input('referral_id', array('type' => 'radio', 'options' => [$r['Referral']['id'] => '<i class="fa ' . $r['Referral']['icon'] . ' fa-2x"></i><br />' . $r['Referral']['title']], 'div' => 'selector', 'hiddenField' => false))?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="block">
        <?=$this->Form->input('referral_comment', array('label' => false, 'placeholder' => 'Comment...', 'type' => 'text', 'class' => 'app-input'))?>
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
