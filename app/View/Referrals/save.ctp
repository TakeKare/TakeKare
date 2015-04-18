<?=$this->Form->create($modelName, array('class' => 'row')); ?>
    <fieldset class="col-lg-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('id')?>
        <?=$this->Form->input('title', array('label' => __('Title')))?>
        <?=$this->Form->input('icon', array('label' => __('Icon')))?>
        <?=$this->Form->input('pos', array('label' => __('Position')))?>
    </fieldset>
    <fieldset class="col-lg-12">
        <?=$this->Form->submit(__('Save'))?>
    </fieldset>
<?=$this->Form->end(); ?>
