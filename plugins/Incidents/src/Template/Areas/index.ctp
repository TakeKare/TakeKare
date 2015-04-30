    <ul class="nav nav-pills row">
        <li><?= $this->Html->link(__('New Area'), ['action' => 'save']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'save']) ?> </li>
    </ul>
<div class="areas index large-10 medium-9 columns">
    <table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('city_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($areas as $area): ?>
        <tr>
            <td><?= $this->Number->format($area->id) ?></td>
            <td><?= h($area->title) ?></td>
            <td>
                <?= $area->has('city') ? $this->Html->link($area->city->title, ['controller' => 'Cities', 'action' => 'save', $area->city->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $area->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $area->id], ['confirm' => __('Are you sure you want to delete # {0}?', $area->id)]) ?>
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
