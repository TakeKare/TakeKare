<?php
use Cake\Routing\Router;

Router::plugin('Base', function ($routes) {
    $routes->fallbacks();
});
