<?php
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Controller\Component\AuthComponent;
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
                        <li><a href="<?=Router::url(array('controller' => 'Users', 'action' => 'profile', 'plugin' => 'Users'))?>"><i class="fa fa-user fa-fw"></i> <?=__('User Profile')?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?=Router::url(array('controller' => 'Cities', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-folder fa-fw"></i> <?=__('Cities')?></a></li>
                        <li><a href="<?=Router::url(array('controller' => 'Areas', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-file fa-fw"></i> <?=__('Areas')?></a></li>
                        <li><a href="<?=Router::url(array('controller' => 'Teams', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-users fa-fw"></i> <?=__('Teams')?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?=Router::url(array('controller' => 'Referrals', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-file fa-fw"></i> <?=__('Referrals')?></a></li>
                        <li><a href="<?=Router::url(array('controller' => 'SupportTypes', 'action' => 'index', 'plugin' => 'Incidents'))?>"><i class="fa fa-file fa-fw"></i> <?=__('Support Types')?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?=Router::url(array('controller' => 'Users', 'action' => 'logout', 'plugin' => 'Users'))?>"><i class="fa fa-sign-out fa-fw"></i> <?=__('Logout')?></a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse" aria-expanded="false">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?=Router::url(['controller' => 'Incidents', 'action' => 'index', 'plugin' => 'Incidents'])?>"><i class="fa fa-exclamation-circle fa-fw"></i> <?=__('Incidents')?></a>
                    </li>
                    <li>
                        <a href="<?=Router::url(['controller' => 'dashboards', 'action' => 'index'])?>"><i class="fa fa-dashboard fa-fw"></i> <?=__('Overview')?></a>
                    </li>
                    <li>
                        <a href="<?=Router::url(['controller' => 'dashboards', 'action' => 'reports'])?>"><i class="fa fa-bar-chart fa-fw"></i> <?=__(' Reporting')?></a>
                    </li>
                    <?php /*
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?=__('Manager View')?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php foreach ($userBranches as $branchId => $branchTitle): ?>
                        <li><?=$this->Html->link($branchTitle, ['controller' => 'dashboards', 'action' => 'manager', $branchId])?></li>
                    <?php endforeach; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> <?=__('Team View')?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <?php foreach ($userBranches as $branchId => $branchTitle): ?>
                    <li><?=$this->Html->link($branchTitle, ['controller' => 'dashboards', 'action' => 'team', $branchId])?></li>
                <?php endforeach; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
 */ ?>
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


<?php /*
    <div id="wrapper">

        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo Router::url("/", true); ?>" class="navbar-brand"><?=cfg('Site.name')?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?=$this->element('Nav' . DS . 'main')?>

                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">7 New Messages</li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                    <span class="name">John Smith:</span>
                                    <span class="message">Hey there, I wanted to ask you something...</span>
                                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                    <span class="name">John Smith:</span>
                                    <span class="message">Hey there, I wanted to ask you something...</span>
                                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                    <span class="name">John Smith:</span>
                                    <span class="message">Hey there, I wanted to ask you something...</span>
                                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">View Inbox <span class="badge">7</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown alerts-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                            <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                            <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                            <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                            <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                            <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                            <li class="divider"></li>
                            <li><a href="#">View All</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money"></i> <?=__('Accounts')?> <b class="caret"></b></a>
                        <ul class="dropdown-menu dropdown-accounts">
                            <li>
                                <a href="#">
                                    <span class="pull-right text-muted small">$25.40</span>
                                    <strong>Ladbrokes</strong>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <span class="pull-right text-muted small">$19.40</span>
                                    <strong>Bet365</strong>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?=$this->Html->link('<strong>' . __('Accounts List') . '</strong> <i class="fa fa-angle-right"></i>', array('controller' => 'accounts', 'action' => 'index'), array('class' => 'text-center', 'escape' => false))?>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>

                    <?php if (!isset($userInfo) || !$userInfo): ?>

                    <?php else: ?>
                        <li class="dropdown user-dropdown">
                            <a href="<?=Router::url(array('controller' => 'users', 'action' => 'profile'))?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$userInfo['email']?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=Router::url(array('controller' => 'users', 'action' => 'logout'))?>"><i class="fa fa-power-off"></i> <?=__('Log Out')?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <h1><?=$title_for_layout?></h1>

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>

        </div>

    </div>
*/
?>

<?=$this->element('Layout' . DS . 'foot') ?>

</body>
</html>
