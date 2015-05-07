    <ul class="nav nav-pills row">
        <li><?= $this->Html->link(__('New User'), ['action' => 'save']) ?></li>
    </ul>
<div class="users index large-10 medium-9 columns">
    <table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('email') ?></th>
            <th><?= $this->Paginator->sort('team_id') ?></th>
            <th><?= $this->Paginator->sort('role') ?></th>
            <th><?= $this->Paginator->sort('is_active') ?></th>
            <th><?= $this->Paginator->sort('last_login_date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->name) ?></td>
            <td><?= h($user->email) ?></td>
            <td>
                <?= $user->has('team') ? $this->Html->link($user->team->title, ['plugin' => 'Incidents', 'controller' => 'Teams', 'action' => 'save', $user->team->id]) : '' ?>
            </td>
            <td><?= h(isset($roles[$user->role]) ? $roles[$user->role] : '') ?></td>
            <td><?= ($user->is_active ? __('Yes') : __('No')) ?></td>
            <td><?= h($user->last_login_date) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
