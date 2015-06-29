<?php
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Controller\Component\AuthComponent;
use Users\Model\Entity\User;
?>
<!DOCTYPE html>
<html lang="en">
<?= $this->Element('Layout' . DS . 'head') ?>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a href="<?php echo Router::url("/", true); ?>" class="navbar-brand" title="<?= Configure::read('App.title') ?>" style="padding-top: 5px; padding-bottom: 0;"><?=$this->Html->image('logo_app.png')?></a>

            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?=$userInfo['name']?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=Router::url(array('controller' => 'Users', 'action' => 'profile', 'plugin' => 'Users'))?>"><i class="fa fa-user fa-fw"></i> <?=__('My Profile')?></a></li>
                        <?php if ($userInfo['role'] != User::ROLE_TEAM_LEAD): ?>
                        <li><a href="<?=Router::url(array('controller' => 'Users', 'action' => 'index', 'plugin' => 'Users'))?>"><i class="fa fa-users fa-fw"></i> <?=__('Users')?></a></li>
                        <?php endif; ?>
                        <?php if ($userInfo['role'] == User::ROLE_SUPER_ADMIN): ?>
                            <li class="divider"></li>
                            <li><a href="<?=Router::url(array('controller' => 'Cities', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-folder fa-fw"></i> <?=__('Cities')?></a></li>
                            <li><a href="<?=Router::url(array('controller' => 'Areas', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-file fa-fw"></i> <?=__('Areas')?></a></li>
                            <li><a href="<?=Router::url(array('controller' => 'Teams', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-users fa-fw"></i> <?=__('Teams')?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?=Router::url(array('controller' => 'Referrals', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-file fa-fw"></i> <?=__('Referrals')?></a></li>
                            <li><a href="<?=Router::url(array('controller' => 'SupportTypes', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-file fa-fw"></i> <?=__('Support Types')?></a></li>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a href="<?=Router::url(array('controller' => 'Users', 'action' => 'logout', 'plugin' => 'Users'))?>"><i class="fa fa-sign-out fa-fw"></i> <?=__('Logout')?></a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse collapse" aria-expanded="false">
                <ul class="nav" id="side-menu">
                <?php if ($userInfo['role'] == User::ROLE_TEAM_LEAD): ?>
                    <li>
                        <a href="<?=Router::url(['controller' => 'Incidents', 'action' => 'my', 'plugin' => 'Incidents'])?>"><i class="fa fa-exclamation-circle fa-fw"></i> <?=__('Incidents')?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?=Router::url(['controller' => 'Incidents', 'action' => 'index', 'plugin' => 'Incidents'])?>"><i class="fa fa-exclamation-circle fa-fw"></i> <?=__('Incidents')?></a>
                    </li>
                    <li>
                        <a href="<?=Router::url(['controller' => 'Dashboards', 'action' => 'live', 'plugin' => 'Incidents'])?>"><i class="fa fa-dashboard fa-fw"></i> <?=__('Live View')?></a>
                    </li>
                    <li>
                        <a href="<?=Router::url(['controller' => 'Dashboards', 'action' => 'report', 'plugin' => 'Incidents'])?>"><i class="fa fa-bar-chart fa-fw"></i> <?=__('Report')?></a>
                    </li>
                <?php endif; ?>
                    <li>
                        <a href="<?=Router::url(['controller' => 'Teams', 'action' => 'locations', 'plugin' => 'Incidents'])?>"><i class="fa fa-map-marker fa-fw"></i> <?=__('Team Locations')?></a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">

        <h1 id="page-title"><?= $this->fetch('title') ?></h1>

        <?= $this->Flash->render() ?>

        <?php echo $this->fetch('content'); ?>

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?=$this->element('Layout' . DS . 'foot') ?>

</body>
</html>
