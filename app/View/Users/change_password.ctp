<?=$this->Form->create('User', array('action' => 'change_password', 'url' => array($userId, $hash)))?>
    <fieldset class="col-md-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->input('password', array('label' => __('field new password')))?>
        <?=$this->Form->input('password_repeat', array('label' => __('field password_repeat'), 'type' => 'password'))?>
        <?=$this->Form->button(__('button change password'))?>
    </fieldset>
<?=$this->Form->end()?>