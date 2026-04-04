<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Query;

/**
 * Eventos Controller
 *
 * @property \App\Model\Table\EventosTable $Eventos
 */
class EventosController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

    private function getUserId(): ?int
    {
        $identity = $this->request->getAttribute('identity');
        return $identity ? $identity->id : null;
    }

    private function getLocale(): string
    {
        $locale = $this->request->getSession()->read('Config.language') ?? 'es';
        return $locale;
    }

    private function getMessage(string $key): string
    {
        $messages = [
            'es' => [
                'saved' => 'El evento ha sido guardado.',
                'not_saved' => 'No se pudo guardar el evento.',
                'deleted' => 'El evento ha sido eliminado.',
                'not_deleted' => 'No se pudo eliminar el evento.',
                'not_owner' => 'No tienes permiso para editar este evento.',
            ],
            'en' => [
                'saved' => 'The event has been saved.',
                'not_saved' => 'The event could not be saved.',
                'deleted' => 'The event has been deleted.',
                'not_deleted' => 'The event could not be deleted.',
                'not_owner' => 'You do not have permission to edit this event.',
            ],
        ];
        
        $locale = $this->getLocale();
        return $messages[$locale][$key] ?? $messages['es'][$key];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userId = $this->getUserId();
        $locale = $this->getLocale();
        
        $query = $this->Eventos->find();

        // Filtrar por usuario si está autenticado
        if ($userId) {
            $query->where(['user_id' => $userId]);
        }

        $search = $this->request->getQuery('search');
        $publico = $this->request->getQuery('publico_objetivo');
        $fechaDesde = $this->request->getQuery('fecha_desde');
        $fechaHasta = $this->request->getQuery('fecha_hasta');

        if (!empty($search)) {
            $descField = 'descripcion_' . $locale;
            
            // Si la columna no existe, solo buscar en otros campos
            $schema = $this->Eventos->getSchema();
            $hasDescField = $schema->hasColumn($descField);
            
            $conditions = [
                'OR' => [
                    'titulo LIKE' => '%' . $search . '%',
                    'ubicacion LIKE' => '%' . $search . '%',
                    'organizador LIKE' => '%' . $search . '%',
                ]
            ];
            
            if ($hasDescField) {
                $conditions['OR'][$descField . ' LIKE'] = '%' . $search . '%';
            }
            
            $query->where($conditions);
        }

        if (!empty($publico)) {
            $query->where(['publico_objetivo' => $publico]);
        }

        if (!empty($fechaDesde)) {
            $query->where(['fecha >=' => $fechaDesde]);
        }

        if (!empty($fechaHasta)) {
            $query->where(['fecha <=' => $fechaHasta]);
        }

        $query->orderBy(['fecha' => 'ASC']);

        $publicos = $this->Eventos->find()
            ->select(['publico_objetivo'])
            ->distinct()
            ->where(['publico_objetivo IS NOT NULL'])
            ->all()
            ->extract('publico_objetivo')
            ->toArray();

        $eventos = $this->paginate($query);
        
        // Pasar el locale a la vista para las descripciones bilingües
        $this->set(compact('eventos', 'publicos', 'search', 'publico', 'fechaDesde', 'fechaHasta', 'locale'));
    }

    /**
     * View method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evento = $this->Eventos->get($id, contain: []);
        $locale = $this->getLocale();
        $this->set(compact('evento', 'locale'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userId = $this->getUserId();
        
        if (!$userId) {
            return $this->redirect(['action' => 'index']);
        }
        
        $evento = $this->Eventos->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $userId;
            
            $evento = $this->Eventos->patchEntity($evento, $data);
            if ($this->Eventos->save($evento)) {
                $this->Flash->success($this->getMessage('saved'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error($this->getMessage('not_saved'));
        }
        $this->set(compact('evento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->getUserId();
        
        $evento = $this->Eventos->get($id, contain: []);
        
        // Verificar que el evento pertenece al usuario
        if ($evento->user_id != $userId) {
            $this->Flash->error($this->getMessage('not_owner'));
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->getData());
            if ($this->Eventos->save($evento)) {
                $this->Flash->success($this->getMessage('saved'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error($this->getMessage('not_saved'));
        }
        $this->set(compact('evento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $userId = $this->getUserId();
        $evento = $this->Eventos->get($id);
        
        // Verificar que el evento pertenece al usuario
        if ($evento->user_id != $userId) {
            $this->Flash->error($this->getMessage('not_owner'));
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->Eventos->delete($evento)) {
            $this->Flash->success($this->getMessage('deleted'));
        } else {
            $this->Flash->error($this->getMessage('not_deleted'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
