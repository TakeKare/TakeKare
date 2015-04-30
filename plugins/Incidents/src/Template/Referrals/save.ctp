    <ul class="nav nav-pills row">
                <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $referral->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $referral->id)]
            )
        ?></li>
                <li><?= $this->Html->link(__('List Referrals'), ['action' => 'index']) ?></li>
                        </ul>
            <div class="referrals form large-10 medium-9 columns">
            <?= $this->Form->create($referral); ?>
            <fieldset>
                <?php
                echo $this->Form->hidden('id');
                                echo $this->Form->input('title');
                                echo $this->Form->input('icon');
                                echo $this->Form->input(
                                    'color',
                                    [
                                        'templates' => [
                                            'formGroup' => '{{label}}<div class="input-group color">{{input}}<span class="input-group-addon"><i></i></span></div>',
                                        ]
                                    ]
                                );
                                echo $this->Form->input('pos');
                                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->element('Js' . DS . 'colorpicker') ?>
