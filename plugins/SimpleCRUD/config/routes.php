<?php
use Cake\Routing\Router;

Router::plugin('SimpleCRUD', function ($routes) {
    $routes->fallbacks();
});
