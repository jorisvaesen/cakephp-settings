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

## Usage

Create setting

```
bin/cake Settings create
```

Read setting

```php
use JorisVaesen\Settings\Settings;

echo Settings::read($name);
```

Write setting

```php
$settingsTable = TableRegistry::getTableLocator()->get('Settings.Settings')->find('name', ['name' => 'SETTING_NAME']);
```