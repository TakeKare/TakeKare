<div class="app-page" data-page="home">
    <div class="app-topbar">
        <div class="app-title"><span class="app-icon"></span> <?= __('Take Kare') ?></div>
    </div>
    <?= $this->element('tabs') ?>
    <div class="app-content">
        <ul class="app-list">
        <?php foreach ($incidents as $inc): ?>
            <?php
            $style = '';
            if ($inc['Incident']['police']) {
                $style = 'is-police';
            } elseif ($inc['Incident']['report']) {
                $style = 'is-report';
            } elseif ($inc['Incident']['contact']) {
                $style = 'is-contact';
            } elseif ($inc['Incident']['draft']) {
                $style = 'is-draft';
            }
            ?>
            <li class="incident <?= $style ?>" data-id="<?=$inc['Incident']['id']?>">
                <span class="created"><?= date('l, j F, H:i', strtotime($inc['Incident']['created'])) ?></span><br />
                <p><strong><?= $inc['Incident']['males_number'] ?></strong> males, <strong><?= $inc['Incident']['females_number'] ?></strong> females. Support provided: <strong><?= $inc['SupportType']['title'] ?></strong></p>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="app-button add"><i class="fa fa-plus"></i></div>
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

<div class="app-page" data-page="teams-location">
    <div class="app-topbar">
        <div class="app-title"><?= __('Teams Location') ?></div>
    </div>
    <?= $this->element('tabs') ?>
    <div class="app-content">
        <div id="map"></div>
    </div>

</div>

<?=$this->Form->end(); ?>

<script>
    var teams = <?= json_encode($teams) ?>;

    $(function(){
        App.load('home');
    })
</script>
