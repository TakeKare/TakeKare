<?=$this->Form->create($modelName, array('class' => 'row')); ?>
    <fieldset class="col-lg-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('id')?>
        <?=$this->Form->input('city_id', array('label' => __('City')))?>
        <?=$this->Form->input('title', array('label' => __('Title')))?>
    </fieldset>
    <fieldset class="col-lg-12">
        <?=$this->Form->submit(__('Save'))?>
    </fieldset>
<?=$this->Form->end(); ?>

<div id="mapp"></div>

<style>
    #mapp { height: 200px; }
</style>

<script type="text/javascript">
    $(function(){
        var map = L.map('mapp').setView([51.505, -0.09], 13);
    });
</script>
