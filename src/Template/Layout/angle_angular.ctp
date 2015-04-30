<?php
use Cake\Routing\Router;
$this->append('script', $this->Html->script(['base', 'app']));
?>
<!DOCTYPE html>
<html lang="en" data-ng-app="takekare">
<head>
    <base href="<?php echo Router::url("/", true); ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="{{app.description}}">
    <meta name="keywords" content="app, responsive, angular, bootstrap, dashboard, admin">
    <title data-ng-bind="::pageTitle()">Angle - Angular Bootstrap Admin Template</title>
    <?= $this->Html->css('app.css') ?>
</head>
<body data-ng-class="{ 'layout-fixed' : app.layout.isFixed, 'aside-collapsed' : app.layout.isCollapsed, 'layout-boxed' : app.layout.isBoxed, 'layout-fs': app.useFullLayout, 'hidden-footer': app.hiddenFooter, 'layout-h': app.layout.horizontal, 'aside-float': app.layout.isFloat}">
    <div data-ui-view="" data-autoscroll="false" class="wrapper">
        <!-- top navbar-->
        <header ng-include="'views/partials/top-navbar.html'" class="topnavbar-wrapper"></header>
        <!-- sidebar-->
        <aside ng-controller="SidebarController" class="aside">
            <div class="aside-inner">
                <nav class="sidebar">
                    <!-- START sidebar nav-->
                    <ul class="nav">
                        <!-- Iterates over all sidebar items-->
                        <li>
                            <a title="Single View" ng-href="#/app/cities" href="#/app/cities"><em class="fa fa-file-o" ></em><span class="ng-binding">Cities</span></a>
                        </li>
                        <li>
                            <a title="Single View" ng-href="#/app/areas" href="#/app/areas"><em class="fa fa-file-o" ></em><span class="ng-binding">Areas</span></a>
                        </li>
                    </ul>
                    <!-- END sidebar nav-->
                </nav>
            </div>
        </aside>
        <!-- offsidebar-->
        <aside ng-include="'views/partials/offsidebar.html'" class="offsidebar"></aside>
        <!-- Main section-->
        <section>
            <!-- Page content-->
            <div ui-view="" autoscroll="false" ng-class="app.viewAnimation" class="content-wrapper">
                <?php //$this->fetch('content') ?>
            </div>
        </section>
        <!-- Page footer-->
        <footer ng-include="'views/partials/footer.html'"></footer>
    </div>
    <?= $this->fetch('script') ?>
</body>
</html>
