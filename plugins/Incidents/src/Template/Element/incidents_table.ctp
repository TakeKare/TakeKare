<table class="table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('area_id') ?></th>
            <th><?= $this->Paginator->sort('team_id') ?></th>
            <th><?= __('People') ?></th>
            <th><?= $this->Paginator->sort('age') ?></th>
            <th><?= $this->Paginator->sort('intoxication') ?></th>
            <th><?= $this->Paginator->sort('receptiveness') ?></th>
            <th><?= $this->Paginator->sort('referral_id') ?></th>
            <th><?= $this->Paginator->sort('support_type_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($incidents as $incident): ?>
        <tr>
            <td><?= $this->Number->format($incident->id) ?></td>
            <td><?= $incident->created->timeAgoInWords() ?></td>
            <td>
                <?= $incident->has('area') ? $incident->area->title : '' ?>
            </td>
            <td>
                <?= $incident->has('team') ? $incident->team->title : '' ?>
            </td>
            <td>
                <?php if ($incident->males_number) echo '<i class="fa fa-male"></i> ' . $this->Number->format($incident->males_number) ?>
                <?php if ($incident->females_number) echo '<i class="fa fa-female"></i> ' . $this->Number->format($incident->females_number) ?>
            </td>
            <td><?= (!$incident->age ? '' : $ages[$incident->age]) ?></td>
            <td><?= (!$incident->intoxication ? '' : $intoxications[$incident->intoxication]) ?></td>
            <td><?= (!$incident->receptiveness ? '' : $receptivenesses[$incident->receptiveness]) ?></td>
            <td>
                <?= $incident->has('referral') ? $incident->referral->title : '' ?>
            </td>
            <td>
                <?= $incident->has('support_type') ? $incident->support_type->title : '' ?>
                <?php if ($incident->has('sub_support_type')): ?> <small>(<?= $incident->sub_support_type->title ?>)</small><?php endif; ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'save', $incident->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $incident->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incident->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
