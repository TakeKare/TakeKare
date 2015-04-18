<?=$this->Form->create('User', array('action' => 'register', 'class' => ''))?>
    <fieldset>
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('redirect', array('default' => dim($this->params->query['redirect'], null)))?>
        <?=$this->Form->input('email', array('label' => false, 'placeholder' => __('Email')))?>
        <?=$this->Form->input('password', array('label' => false, 'placeholder' => __('Password')))?>
        <?=$this->Form->input('password_repeat', array('type' => 'password', 'label' => false, 'placeholder' => __('Repeat password')))?>
        <?=$this->Form->button(__('Register'), array('class' => 'btn btn-lg btn-success btn-block'))?>
    </fieldset>
<?=$this->Form->end()?>
