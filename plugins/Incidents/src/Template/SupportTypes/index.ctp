    <ul class="nav nav-pills row">
        <li><?= $this->Html->link(__('New Support Type'), ['action' => 'save']) ?></li>
    </ul>
<div class="supportTypes index large-10 medium-9 columns">
    <table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th style="width:50px"><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th style="width:50px"><?= $this->Paginator->sort('icon') ?></th>
            <th style="width:50px"><?= __('Color') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($supportTypes as $supportType): ?>
        <tr>
            <td><?= $this->Number->format($supportType->id) ?></td>
            <td><?= h($supportType->title) ?></td>
            <td><i class="fa <?= h($supportType->icon) ?>"></i></td>
            <td<?php if ($supportType->color) echo ' style="background: ' . $supportType->color . '"'; ?>>&nbsp;</td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $supportType->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supportType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supportType->id)]) ?>
            </td>
        </tr>
        <?php foreach ($supportType->sub_support_types as $sub): ?>
            <tr>
                <td><?= $this->Number->format($sub->id) ?></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($sub->title) ?></td>
                <td><i class="fa <?= h($sub->icon) ?>"></i></td>
                <td<?php if ($sub->color) echo ' style="background: ' . $sub->color . '"'; ?>>&nbsp;</td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'save', $sub->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sub->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sub->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
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
