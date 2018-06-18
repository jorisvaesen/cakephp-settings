<?php
namespace JorisVaesen\Settings;

use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;

class Settings
{
    public static function read($name)
    {
        return Cache::remember($name, function () use ($name) {
            $s = TableRegistry::getTableLocator()->get('JorisVaesen/Settings.Settings')
                ->find()
                ->select(['Settings.value'])
                ->where([
                    'Settings.name' => $name
                ])
                ->enableHydration(false)
                ->first();

            if (isset($s['value'])) {
                return $s['value'];
            }

            return null;
        }, 'JorisVaesenSettings');
    }
}