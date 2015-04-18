<?=$this->Form->create('User', array('action' => 'login', 'class' => ''))?>
    <fieldset>
        <?php if (!isset($showErrors) || $showErrors) echo $this->Form->listErrors()?>

        <?=$this->Form->hidden('redirect', array('default' => dim($this->params->query['redirect'], dim($redirect, null))))?>

        <?=$this->Form->input('email', array('label' => false, 'placeholder' => __('Email')))?>
        <?=$this->Form->input('password', array('label' => false, 'placeholder' => __('Password')))?>
        <?=$this->Form->button(__('Login'), array('class' => 'btn btn-lg btn-primary btn-block'))?>

        <?php /*$this->Html->link(__('title users reminder'), array('action' => 'reminder'), array('class' => 'btn btn-link'))?>
        <?=$this->Html->link(__('link register'), array('action' => 'register'), array('class' => 'btn btn-link'))*/ ?>
    </fieldset>
<?=$this->Form->end()?>
