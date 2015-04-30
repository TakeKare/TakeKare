    <ul class="nav nav-pills row">
        <li><?= $this->Html->link(__('New Referral'), ['action' => 'save']) ?></li>
    </ul>
<div class="referrals index large-10 medium-9 columns">
    <table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th style="width:50px"><?= $this->Paginator->sort('icon') ?></th>
            <th style="width:50px"><?= __('Color') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($referrals as $referral): ?>
        <tr>
            <td><?= $this->Number->format($referral->id) ?></td>
            <td><?= h($referral->title) ?></td>
            <td><i class="fa <?= h($referral->icon) ?>"></i></td>
            <td<?php if ($referral->color) echo ' style="background: ' . $referral->color . '"'; ?>>&nbsp;</td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $referral->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $referral->id], ['confirm' => __('Are you sure you want to delete # {0}?', $referral->id)]) ?>
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
