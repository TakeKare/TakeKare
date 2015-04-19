<?php
$config = array(
    'Email' => array(
        'from'     => 'info@coinbuzz.net',
        'fromName' => 'Take Kare',
        'admin'    => 'andrej@melon.com.au'
    ),
    'Paths' => array(
        'www_tmp'      => ROOT . DS . 'app' . DS . 'tmp' . DS,
        'uploads_dir'  => ROOT . DS . 'app' . DS . 'webroot' . DS . 'uploads' . DS,
        'uploads_href' => '/uploads/',
        'images'       => 'images',
        'files'        => 'files',
    ),
    'Site' => array(
        'name' => 'Scannner'
    ),
    'Predictions' => array(
        'success_limit' => 60
    ),
);

Configure::write('Session.cookie', 'WB');

Cache::config('url', array(
        'engine'    => 'File',
        'path'      => CACHE . 'url' . DS,
        'duration'  => '30 minutes',
        //'duration'  => 1,
        'serialize' => true,
    ));

if (is_readable($local = dirname(__FILE__) . DS . 'app_local.php'))
    Configure::load('app_local');
