<?php

use \Cake\Cache\Cache;

Cache::setConfig('JorisVaesenSettings', [
    'className' => 'File',
    'prefix' => 'settings_',
    'path' => CACHE . 'jorisvaesen-settings' . DS,
    'serialize' => true,
    'duration' => '+99 years',
    'url' => null,
    'groups' => ['settings']
]);