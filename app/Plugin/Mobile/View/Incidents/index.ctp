<div class="app-page" data-page="home">
    <div class="app-topbar">
        <div class="app-title"><span class="app-icon"></span> <?= __('Take Kare') ?></div>
    </div>
    <div class="app-content">
        <ul class="app-list">
        <?php foreach ($incidents as $inc): ?>
            <li class=""><a href="<?=Router::url(['action' => 'save', $inc['Incident']['id']])?>">asdasd</a></li>
        <?php endforeach; ?>
            <li class=""><a href="<?=Router::url(['action' => 'save', $inc['Incident']['id']])?>">asdasd</a></li>
        </ul>
    </div>

</div>

<?=$this->Form->create('Incident', array('class' => '')); ?>

<div class="app-page" data-page="step1">
    <?= $this->element('step1') ?>
</div>

<div class="app-page" data-page="step2">
    <?= $this->element('step2') ?>
</div>

<div class="app-page" data-page="step3">
    <?= $this->element('step3') ?>
</div>

<div class="app-page" data-page="step4">
    <?= $this->element('step4') ?>
</div>

<?=$this->Form->end(); ?>

<script>
    $(function(){
        try {
            App.restore();
        } catch (err) {
            App.load('home');
        }
    })
</script>
