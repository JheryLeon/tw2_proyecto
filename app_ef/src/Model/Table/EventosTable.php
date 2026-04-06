<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eventos Model
 *
 * @method \App\Model\Entity\Evento newEmptyEntity()
 * @method \App\Model\Entity\Evento newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Evento> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Evento get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Evento findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Evento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Evento> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Evento|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Evento saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Evento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Evento>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Evento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Evento> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Evento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Evento>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Evento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Evento> deleteManyOrFail(iterable $entities, array $options = [])
 */
class EventosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('eventos');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 250)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->scalar('ubicacion')
            ->maxLength('ubicacion', 250)
            ->requirePresence('ubicacion', 'create')
            ->notEmptyString('ubicacion');

        $validator
            ->integer('capacidad')
            ->allowEmptyString('capacidad');

        $validator
            ->scalar('publico_objetivo')
            ->maxLength('publico_objetivo', 100)
            ->allowEmptyString('publico_objetivo');

        $validator
            ->scalar('organizador')
            ->maxLength('organizador', 250)
            ->allowEmptyString('organizador');

        $validator
            ->scalar('descripcion_es')
            ->allowEmptyString('descripcion_es');

        $validator
            ->scalar('descripcion_en')
            ->allowEmptyString('descripcion_en');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
