<p><?=$this->Html->link(__('Create New'), array('action' => 'save'))?></p>

<table class="table table-bordered">
    <tr>
        <th><?=$this->Paginator->sort('title')?></th>
        <th class="actions"><?=__('Actions')?></th>
    </tr>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><i class="fa <?= $d[$modelName]['icon'] ;?>"></i> <?=h($d[$modelName]['title']); ?></td>
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
        <?php foreach ($d['SubSupportType'] as $sub): ?>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=h($sub['title']); ?></td>
                <td class="actions">
                    <?=$this->Html->link(__('Edit'), array('action' => 'save', $sub['id']))?>
                    <?=$this->Form->postLink(
                        __('Delete'),
                        array('action' => 'delete', $sub['id']),
                        array(),
                        __('Are you sure you want to delete # %s?', $sub['id'])
                    )?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
</table>

