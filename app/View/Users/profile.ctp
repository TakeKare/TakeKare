<?=$this->Session->flash()?>

<?=$this->Form->create('User', array('action' => 'profile'))?>
    <fieldset class="col-md-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->input('name', array('label' => __('Name'), 'value' => $userInfo['name'], 'disabled' => 'disabled'))?>
        <?=$this->Form->input('email', array('label' => __('Email'), 'value' => $userInfo['email'], 'disabled' => 'disabled'))?>
        <?php //echo $this->Form->checkbox('send_promos', array('label' => __('field send_promos')))?>
        <?=$this->Form->input('change_password', array('label' => __('Change password'), 'type' => 'checkbox'))?>
        <div id="passwordFields">
            <?=$this->Form->input('password', array('label' => __('New password'), 'value' => ''))?>
            <?=$this->Form->input('password_repeat', array('label' => __('Repeat'), 'type' => 'password', 'value' => ''))?>
        </div>
        <?=$this->Form->button(__('Save'))?>
    </fieldset>
<?=$this->Form->end()?>

<script type="text/javascript">
    $(function(){
        $('#UserChangePassword').click(function(){
            if (this.checked)
                $('#passwordFields').show();
            else
                $('#passwordFields').hide();
        }).triggerHandler('click');
    });
</script>
