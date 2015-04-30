    <ul class="nav nav-pills row">
                <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $incident->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $incident->id)]
            )
        ?></li>
                <li><?= $this->Html->link(__('List Incidents'), ['action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('List Referrals'), ['controller' => 'Referrals', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Referral'), ['controller' => 'Referrals', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('List Support Types'), ['controller' => 'SupportTypes', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Support Type'), ['controller' => 'SupportTypes', 'action' => 'add']) ?></li>
                        </ul>
            <div class="incidents form large-10 medium-9 columns">
            <?= $this->Form->create($incident); ?>
            <fieldset>
                <?php
                echo $this->Form->hidden('id');
                echo $this->Form->input('area_id', ['options' => $areas]);
                echo $this->Form->input('team_id', ['options' => $teams]);
                echo $this->Form->input('males_number');
                echo $this->Form->input('females_number');
                echo $this->Form->input('age');
                echo $this->Form->input('intoxication');
                echo $this->Form->input('receptiveness');
                echo $this->Form->input('referral_id', ['options' => $referrals, 'empty' => true]);
                echo $this->Form->input('referral_comment');
                echo $this->Form->input('support_type_id', ['options' => $supportTypes, 'empty' => true]);
                echo $this->Form->input('sub_support_type_id');
                echo $this->Form->input('comment');
                echo $this->Form->input('lat');
                echo $this->Form->input('lng');
                echo $this->Form->input('draft');
                echo $this->Form->input('police');
                echo $this->Form->input('contact');
                echo $this->Form->input('report');
                echo $this->Form->input('water_given');
                echo $this->Form->input('chupa_chups_given');
                echo $this->Form->input('thongs_given');
                echo $this->Form->input('vomit_bags_given');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
