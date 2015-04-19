<script>
var incidents = <?= json_encode($incidents) ?>;
</script>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

            <!-- /.row -->
            <div style="margin-top:5px;" class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="../img/white128_bottle.png" style="width:80px;">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countWater ?></div>
                                    <div>Water Bottles</div>
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
                                    <img src="../img/white128_thongs.png" style="width:80px;">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countThongs ?></div>
                                    <div>Thongs</div>
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
                                    <img src="../img/white128_bag.png" style="width:80px;">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countVomitBags ?></div>
                                    <div>Vomit Bags</div>
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
                                    <img src="../img/white128_ChupaChup.png" style="margin:7px;width:60px;">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $countChupaChups ?></div>
                                    <div>First Aid Assists</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Incident Type
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
                            <div id="incident-graph" style="margin:10px;height:350px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Gender Breakdown
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
                        <div "panel-body" "margin:0px;">
                            <div id="age-gender" style="margin:10px;height:350px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

               </div>
               <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
<script src="../js/report.js"></script>
