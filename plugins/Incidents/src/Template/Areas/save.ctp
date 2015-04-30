    <ul class="nav nav-pills row">
                <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $area->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $area->id)]
            )
        ?></li>
                <li><?= $this->Html->link(__('List Areas'), ['action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
                        </ul>
            <div class="areas form large-10 medium-9 columns">
            <?= $this->Form->create($area); ?>
            <fieldset>
                <?php
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('lat');
                echo $this->Form->hidden('lng');
                echo $this->Form->input('city_id', ['options' => $cities]);
                echo $this->Form->input('title');
                echo $this->element('entity_map');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
