<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JsfssDistrictReports Model
 *
 * @method \App\Model\Entity\JsfssDistrictReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\JsfssDistrictReport findOrCreate($search, callable $callback = null, $options = [])
 */
class JsfssDistrictReportsTable extends Table
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

        $this->setTable('jsfss_district_reports');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('rgi_district_code')
            ->maxLength('rgi_district_code', 3)
            ->allowEmptyString('rgi_district_code');

        $validator
            ->scalar('districtName')
            ->maxLength('districtName', 50)
            ->allowEmptyString('districtName');

        $validator
            ->integer('greenCardHeadCount')
            ->allowEmptyString('greenCardHeadCount');

        $validator
            ->integer('greenCardMemberCount')
            ->allowEmptyString('greenCardMemberCount');

        return $validator;
    }
}
