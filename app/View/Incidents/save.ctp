<?=$this->Form->create($modelName, array('class' => 'row')); ?>
    <fieldset class="col-lg-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('id')?>
        <?=$this->Form->input('area_id', array('label' => __('Area')))?>
        <?=$this->Form->input('team_id', array('label' => __('Team')))?>
        <?=$this->Form->input('males_number', array('label' => __('Males')))?>
        <?=$this->Form->input('females_number', array('label' => __('Females')))?>
        <?=$this->Form->input('age', array('label' => __('Age'), 'empty' => true))?>
        <?=$this->Form->input('receptiveness', array('label' => __('Receptiveness'), 'empty' => true))?>
        <?=$this->Form->input('intoxication', array('label' => __('Intoxication'), 'empty' => true))?>
        <?=$this->Form->input('referral_id', array('label' => __('Referred By'), 'empty' => true))?>
        <?=$this->Form->input('referral_comment', array('label' => __('Comment'), 'type' => 'text'))?>
        <?=$this->Form->input('support_type_id', array('label' => __('Support Provided'), 'empty' => true))?>
        <?=$this->Form->input('support_type_sub_id', array('label' => __('Support Provided'), 'empty' => true))?>
        <?=$this->Form->input('comment', array('label' => __('Comment')))?>
        <?=$this->Form->input('draft', array('label' => __('Draft'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('police', array('label' => __('Police'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('contact', array('label' => __('Contact'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('report', array('label' => __('Report'), 'type' => 'checkbox'))?>
        <?=$this->Form->input('water_given', array('label' => __('Water')))?>
        <?=$this->Form->input('chupa_chups_given', array('label' => __('Chupa Chups')))?>
        <?=$this->Form->input('thongs_given', array('label' => __('Thongs')))?>
        <?=$this->Form->input('vomit_bags_given', array('label' => __('Vomig bags')))?>
        <?=$this->Form->input('created', array('label' => __('Created'), 'type' => 'text', 'default' => date('Y-m-d H:i:s')))?>
    </fieldset>
    <fieldset class="col-lg-12">
        <?=$this->Form->submit(__('Save'))?>
    </fieldset>
<?=$this->Form->end(); ?>

