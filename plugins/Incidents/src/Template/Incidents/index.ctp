<ul class="nav nav-pills row">
    <li><?= $this->Html->link(__('New Incident'), ['action' => 'save']) ?></li>
</ul>
<div class="incidents index large-10 medium-9 columns">
    <table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('area_id') ?></th>
            <th><?= $this->Paginator->sort('team_id') ?></th>
            <th><?= $this->Paginator->sort('males_number') ?></th>
            <th><?= $this->Paginator->sort('females_number') ?></th>
            <th><?= $this->Paginator->sort('age') ?></th>
            <th><?= $this->Paginator->sort('intoxication') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($incidents as $incident): ?>
        <tr>
            <td><?= $this->Number->format($incident->id) ?></td>
            <td>
                <?= $incident->has('area') ? $this->Html->link($incident->area->title, ['controller' => 'Areas', 'action' => 'save', $incident->area->id]) : '' ?>
            </td>
            <td>
                <?= $incident->has('team') ? $this->Html->link($incident->team->title, ['controller' => 'Teams', 'action' => 'save', $incident->team->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($incident->males_number) ?></td>
            <td><?= $this->Number->format($incident->females_number) ?></td>
            <td><?= (!$incident->age ?: $ages[$incident->age]) ?></td>
            <td><?= (!$incident->intoxication ?: $intoxications[$incident->intoxication]) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $incident->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $incident->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incident->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
