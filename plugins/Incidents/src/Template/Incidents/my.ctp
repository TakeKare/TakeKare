<?php
use Cake\Routing\Router;

$this->assign('title', __('My Incidents'));
?>
<ul class="nav nav-pills row actions">
    <li><?= $this->Html->link(__('New Incident'), ['action' => 'register']) ?></li>
</ul>
<?= $this->Html->link('+', ['action' => 'register'], ['class' => 'btn btn-primary add mobile-only', 'escape' => false]) ?>

<ul class="my-incidents">
<?php foreach ($incidents as $incident): ?>
    <li>
        <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $incident->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incident->id), 'escape' => false, 'class' => 'del']) ?>
        <a href="<?= Router::url(['action' => 'register', $incident->id]) ?>" class="item">
            <span class="date"><?= $incident->created ?> <small>(<?=$incident->created->timeAgoInWords()?>)</small></span><br />
            <strong><?= $this->Number->format($incident->males_number) ?></strong> <?= __('males'); ?>,
            <strong><?= $this->Number->format($incident->females_number) ?></strong> <?= __('females'); ?>.
            <?php if($incident->has('support_type')): ?>
                <?= __('Support provided') ?>: <strong><?= $incident->support_type->title ?></strong>
            <?php endif; ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
<div id="preloader"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>
