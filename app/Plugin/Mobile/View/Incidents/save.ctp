
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
        App.load('step1');
    });
</script>
