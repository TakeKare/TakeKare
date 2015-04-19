<p><?=$this->Html->link(__('Create New'), array('action' => 'save'))?></p>

<table class="table table-bordered">
    <tr>
        <th><?=$this->Paginator->sort('name')?></th>
        <th><?=$this->Paginator->sort('email')?></th>
        <th><?=__('Team')?></th>
        <th><?=$this->Paginator->sort('is_active')?></th>
        <th class="actions"><?=__('Actions')?></th>
    </tr>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><?=h($d[$modelName]['name']); ?></td>
            <td><?=h($d[$modelName]['email']); ?></td>
            <td><?=($d[$modelName]['team_id'] ? h($d['Team']['title']) : ''); ?></td>
            <td><?=($d[$modelName]['is_active'] ? __('Yes') : __('No'))?></td>
            <td class="actions">
                <?=$this->Html->link(__('Edit'), array('action' => 'save', $d[$modelName]['id']))?>
                <?=$this->Form->postLink(
                    __('Delete'),
                    array('action' => 'delete', $d[$modelName]['id']),
                    array(),
                    __('Are you sure you want to delete # %s?', $d[$modelName]['id'])
                )?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

