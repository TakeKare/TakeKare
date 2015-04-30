    <ul class="nav nav-pills row">
        <li><?= $this->Html->link(__('New Team'), ['action' => 'save']) ?></li>
        <li><?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index']) ?> </li>
    </ul>
<div class="teams index large-10 medium-9 columns">
    <table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('area_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= $this->Number->format($team->id) ?></td>
            <td><?= h($team->title) ?></td>
            <td>
                <?= $team->has('area') ? $this->Html->link($team->area->title, ['controller' => 'Areas', 'action' => 'save', $team->area->id]) : '' ?>
                <?= ($team->has('area') && $team->area->has('city')) ? '(' . $this->Html->link($team->area->city->title, ['controller' => 'Cities', 'action' => 'save', $team->area->city->id]) . ')' : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $team->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
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
