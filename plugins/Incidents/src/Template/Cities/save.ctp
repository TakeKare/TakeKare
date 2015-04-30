    <ul class="nav nav-pills row">
                <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $city->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]
            )
        ?></li>
                <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add']) ?> </li>
                        </ul>
            <div class="cities form large-10 medium-9 columns">
            <?= $this->Form->create($city); ?>
            <fieldset>
                <?php
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('lat');
                echo $this->Form->hidden('lng');
                echo $this->Form->input('title');
                echo $this->element('entity_map');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>

