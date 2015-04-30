<?php
use Cake\Routing\Router;

Router::connect('/incidents/:action/*', ['controller' => 'Incidents', 'plugin' => 'Incidents']);
Router::connect('/teams/:action/*', ['controller' => 'Teams', 'plugin' => 'Incidents']);
Router::connect('/referrals/:action/*', ['controller' => 'Referrals', 'plugin' => 'Incidents']);
Router::connect('/support_types/:action/*', ['controller' => 'SupportTypes', 'plugin' => 'Incidents']);
Router::connect('/areas/:action/*', ['controller' => 'Areas', 'plugin' => 'Incidents']);
Router::connect('/cities/:action/*', ['controller' => 'Cities', 'plugin' => 'Incidents']);

Router::plugin('Incidents', function ($routes) {
    $routes->fallbacks();
});
