# Settings plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require jorisvaesen/cakephp-settings
```

Enable plugin:

```
bin/cake plugin load -b JorisVaesen/Settings
```

Migrate settings table

```
bin/cake migrations migrate -p JorisVaesen/Settings
```

## Usage

Create setting

```
bin/cake joris_vaesen/settings.create
```

Read setting

```php
use JorisVaesen\Settings\Settings;

echo Settings::read($name);
```

Write setting

```php
// Using simple find and update
$settingsTable = TableRegistry::getTableLocator()->get('JorisVaesen/Settings.Settings');
$setting = $settingsTable->find('name', ['name' => 'SETTING_NAME'])->first();
$setting->set('value', 'NEW VALUE');
$settingsTable->save($setting);

// Write method
TableRegistry::getTableLocator()->get('JorisVaesen/Settings.Settings')
    ->write('NAME', 'NEW_VALUE');
```