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
        <a href="<?= Router::url(['action' => 'register', $incident->id]) ?>">
            <span class="date"><?= $incident->created ?> <small>(<?=$incident->created->timeAgoInWords()?>)</small></span><br />
            <strong><?= $this->Number->format($incident->males_number) ?></strong> <?= __('males'); ?>, <strong><?= $this->Number->format($incident->females_number) ?></strong> <?= __('females'); ?>. <?= __('Support provided') ?>: <strong><?= $incident->support_type->title ?></strong>
        </a>
    </li>
<?php endforeach; ?>
</ul>
<div id="preloader"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>
