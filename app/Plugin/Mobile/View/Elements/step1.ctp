<div class="app-topbar">
    <div class="app-title"><?= __('Incident Report') ?></div>
</div>
<div class="app-content">
    <?=$this->Form->input('id', array('type' => 'hidden'))?>
    <div class="block genders">
        <div class="gender">
            <label for="IncidentMalesNumber"><i class="fa fa-male"></i></label>
            <input class="app-input" name="data[Incident][males_number]" id="IncidentMalesNumber" type="number" value="1" />
        </div>
        <div class="gender">
            <label for="IncidentFemalesNumber"><i class="fa fa-female fa-fw"></i></label>
            <input class="app-input" name="data[Incident][females_number]" id="IncidentFemalesNumber" type="number" value="1" />
        </div>
    </div>
    <div class="block age">
        <label><?= __('Age') ?></label>
        <?php foreach (Incident::ageList() as $k => $v): ?>
            <div class="p-1-4">
                <?=$this->Form->input('age', array('type' => 'radio', 'options' => [$k => $v], 'div' => 'selector'))?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="block intoxication">
        <label><?= __('Intoxication') ?></label>
        <?php foreach (Incident::intoxicationList(true) as $k => $v): ?>
            <div class="p-1-4">
                <?=$this->Form->input('intoxication', array('type' => 'radio', 'options' => [$k => $v], 'div' => 'selector'))?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="block receptiveness">
        <label><?= __('Receptiveness') ?></label>
        <?php foreach (Incident::receptivenessList(true) as $k => $v): ?>
            <div class="p-1-3">
                <?=$this->Form->input('receptiveness', array('type' => 'radio', 'options' => [$k => $v], 'div' => 'selector'))?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="footer">
        <div class="p-1-2">
            &nbsp;
        </div>
        <div class="p-1-2">
            <div class="app-button next"><?= __('Next') ?> <i class="fa fa-angle-right"></i></div>
        </div>
    </div>

</div>
