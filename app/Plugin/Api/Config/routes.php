<?php

Router::connect('/api/:controller', ['action' => 'collection', 'plugin' => 'api']);
Router::connect('/api/:controller/:id', ['action' => 'entity', 'plugin' => 'api'], ['pass' => ['id']]);

Router::parseExtensions('json');
