<?php if (!CakeSession::check('Message.flash')): ?>
    <p><?php echo __('text reminder')?>
    <?=$this->Form->create('User', array('action' => 'reminder', 'class' => ''))?>
        <fieldset>
            <?=$this->Form->listErrors()?>
            <?=$this->Form->input('email', array('label' => false, 'placeholder' => __('Email')))?>
            <?=$this->Form->button(__('Send'), array('class' => 'btn btn-lg btn-success btn-block'))?>
        </fieldset>
    <?=$this->Form->end()?>
<?php endif; ?>