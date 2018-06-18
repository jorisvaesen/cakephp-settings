<?php
namespace JorisVaesen\Settings\Shell;

use Cake\Console\Shell;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

class CreateShell extends Shell
{
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    public function main()
    {
        $this->out('Please enter the following properties');

        $settingsTable = TableRegistry::getTableLocator()->get('Settings.Settings');
        $setting = $settingsTable->newEntity();

        $fields = [
            'name' => 'identifier',
            'type' => 'input control type text, number, email, ...',
            'label' => 'Label of the input control',
            'help' => 'help text visible under the input control',
            'value' => 'default value',
        ];

        foreach ($fields as $field => $help) {
            $value = $this->in($field . ' ('. $help .'):');
            $setting->set($field, $value, ['guard' => false]);
        }

        $now = FrozenTime::now();
        $setting->set([
            'created' => $now,
            'modified' => $now,
        ]);

        if ($settingsTable->save($setting)) {
            $this->success('Setting saved.');
        } else {
            $this->err('Setting could not be saved.');
        }
    }
}
