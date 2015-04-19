<p><?=$this->Html->link(__('Create New'), array('action' => 'save'))?></p>

<table class="table table-bordered">
    <tr>
        <th><?=$this->Paginator->sort('created')?></th>
        <th><?=__('Group')?></th>
        <th><?=$this->Paginator->sort('support_type_id')?></th>
        <th><?=$this->Paginator->sort('area_id')?></th>
        <th><?=$this->Paginator->sort('team_id')?></th>
        <th class="actions"><?=__('Actions')?></th>
    </tr>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><?=h($d[$modelName]['created']); ?></td>
            <td><strong><?= $d[$modelName]['males_number'] ?></strong> males, <strong><?= $d[$modelName]['females_number'] ?></strong> females</td>
            <td><?= $d['SupportType']['title'] ?></td>
            <td><?=h($d['Area']['title']); ?></td>
            <td><?=h($d['Team']['title']); ?></td>
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
