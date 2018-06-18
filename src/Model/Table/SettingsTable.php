<?php
namespace DatrixCms\Model\Table;

use ArrayObject;
use Cake\Cache\Cache;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;
use JorisVaesen\Settings\Model\Entity\Setting;

/**
 * Settings Model
 *
 * @method \JorisVaesen\Settings\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \JorisVaesen\Settings\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \JorisVaesen\Settings\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \JorisVaesen\Settings\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \JorisVaesen\Settings\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \JorisVaesen\Settings\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \JorisVaesen\Settings\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SettingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('settings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('value');

        return $validator;
    }

    public function findName(Query $query, array $options = [])
    {
        $name = Hash::get($options, 'name', false);

        if (!$name) {
            return $query;
        }

        return $query
            ->where([
                'Settings.name' => $name,
            ]);
    }

    public function afterSave(Event $event, Setting $entity, ArrayObject $options)
    {
        if (!$entity->getErrors()) {
            if (!is_int($entity->value) && !is_float($entity->value) && $entity->value !== '0' && empty($entity->value)) {
                Cache::delete($entity->name, 'JorisVaesenSettings');
            } else {
                Cache::write($entity->name, $entity->value, 'JorisVaesenSettings');
            }
        }
    }
}
