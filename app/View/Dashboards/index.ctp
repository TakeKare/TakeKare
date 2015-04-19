<script>
var incidents = <?= json_encode($incidents) ?>;
</script>
            <!-- /.row -->
            <div style="margin-top:15px;" class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exclamation-circle fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countTotal ?></div>
                                    <div>Total Incidents</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countPeople ?></div>
                                    <div>People Helped</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ambulance fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countProfessionals ?></div>
                                    <div>Referals</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-heart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countFirstAid ?></div>
                                    <div>First Aid Assists</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Live Map
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Export</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div "panel-body" style="margin:0px;">
                            <div id="live-map" style="height:500px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Report Timeline
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                            <?php
                            $icons = [
                                '<div class="timeline-badge"><i class="fa fa-user"></i></div>',
                                '<div class="timeline-badge warning"><i class="fa fa-ambulance"></i></div>',
                                '<div class="timeline-badge danger"><i class="fa fa-heart"></i></div>',
                            ];
                            ?>
                            <?php foreach ($incidents as $k => $inc): ?>
                                <li<?= (($k % 2) ? '' : ' class="timeline-inverted"') ?>>
                                    <?= $icons[rand(0, count($icons) - 1)] ?>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?= $this->Time->timeAgoInWords($inc['Incident']['created']) ?></small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p><?= $inc['Incident']['comment'] ?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php if ($k > 3) break; ?>
                            <?php endforeach; ?>>
                                <!--
                                <li>
                                    <div class="timeline-badge"><i class="fa fa-user"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                          <p>A highly intoxicated young woman was aggressively lashing out at her friends who
                                          sought help from a TK Team. Contacted the police via the CCTV control
                                          room, and ensured that no one was injured whilst waiting for the police to arrive.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-ambulance"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                                        </div>
                                        <div class="timeline-body">
                                          <p>Witnessed four young men becoming aggressive
                                        and violent with each other. They notified CCTV Control room, who called it through
                                        to the police. The team monitored the situation from a safe distance and ensured
                                        bystanders were kept away. Within minutes the police arrived, broke up the fight and
                                        once calm, the group moved on.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-heart"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 3 hours ago</small>
                                        </div>
                                        <div class="timeline-body">
                                          <p>Found a young man who looked a little out of place. He was from
                                          Inverell (north NSW) and had moved to Sydney 2 weeks earlier. His plans for
                                          accommodation had fallen through and his money had run out leaving him sleeping
                                          rough in the city. We were able to provide him with homelessness referral so he
                                          would be able to gain access to services which would help him get back on his feet.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 4 hours ago</small>
                                        </div>
                                        <div class="timeline-body">
                                          <p>A 19 year old woman got separated from the friends she had been
                                          clubbing with before suffering a severe asthma attack on the street. A Take Kare
                                          team provided first aid and called an ambulance. After being released from hospital a
                                          few hours later, our teams then supported her to get home safely.</p>
                                        </div>
                                    </div>
                                </li>
                                -->
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Kare Chat
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                <li id="new-chat" class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img style="width:50px;" src="http://api.randomuser.me/portraits/thumb/men/11.jpg" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> just now</small>
                                            <strong class="pull-right primary-font">Team Alpha</strong>
                                        </div>
                                        <p id="new-chat-message"></p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img style="width:50px;" src="http://api.randomuser.me/portraits/thumb/women/58.jpg" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Team Beta</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                      Alright, I'll come on over
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img style="width:50px;" src="http://api.randomuser.me/portraits/thumb/men/11.jpg" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                            <strong class="pull-right primary-font">Team Alpha</strong>
                                        </div>
                                        <p>
Need a little assistance down Oxford St
                                        </p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img style="width:50px;" src="http://api.randomuser.me/portraits/thumb/women/58.jpg" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Team Omega</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                        </div>
                                        <p>
                 There is a big event down by Liverpool St, we might need some more people here.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img style="width:50px;" src="http://api.randomuser.me/portraits/thumb/men/25.jpg" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                    Hope everyone is having a safe night! Any large events on?
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
<script src="js/live-map.js"></script>
