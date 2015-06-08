    <ul class="nav nav-pills row">
                <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $team->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]
            )
        ?></li>
                <li><?= $this->Html->link(__('List Teams'), ['action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('List Team Users'), ['action' => 'index', 'controller' => 'Users', 'plugin' => 'Users']) ?></li>
                        </ul>
            <div class="teams form large-10 medium-9 columns">
            <?= $this->Form->create($team); ?>
            <fieldset>
                <?php
                echo $this->Form->hidden('id');
                echo $this->Form->input('area_id', ['options' => $areasList]);
                echo $this->Form->input('title');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
