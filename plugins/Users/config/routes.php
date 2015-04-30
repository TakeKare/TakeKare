<?php
use Cake\Routing\Router;

Router::connect('/users/:action/*', ['controller' => 'Users', 'plugin' => 'Users']);

Router::plugin('Users', function ($routes) {
    $routes->fallbacks();
});
