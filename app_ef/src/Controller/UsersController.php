<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'logout', 'register', 'setLanguage']);
    }

    public function setLanguage($lang = 'es')
    {
        $this->request->allowMethod(['post']);
        
        $identity = $this->request->getAttribute('identity');
        
        if ($identity) {
            $user = $this->Users->get($identity->id);
            $user->language = $lang;
            $this->Users->save($user);
            
            // Also save to session for immediate effect
            $this->request->getSession()->write('Config.language', $lang);
            
            // Refresh authentication identity
            $user = $this->Users->get($identity->id);
            $this->Authentication->setIdentity($user);
             
            // Set locale
            \Cake\I18n\I18n::setLocale($lang === 'en' ? 'en_US' : 'es_ES');
        } else {
            $this->request->getSession()->write('Config.language', $lang);
        }
        
        return $this->response->withStatus(200);
    }

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful registration, renders view otherwise.
     */
    public function register()
    {
        $this->request->allowMethod(['get', 'post']);
        
        $user = $this->Users->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['language'] = 'es';
            
            $user = $this->Users->patchEntity($user, $data);
            
            if ($this->Users->save($user)) {
                $this->Flash->success('Usuario registrado correctamente. Ya puedes iniciar sesión.');
                return $this->redirect(['action' => 'login']);
            }
            
            $this->Flash->error('No se pudo registrar el usuario. Por favor, intente nuevamente.');
        }
        
        $this->set(compact('user'));
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful login, renders view otherwise.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        
        $result = $this->Authentication->getResult();
        
        if ($result->isValid()) {
            // Aplicar idioma y rol del usuario desde la base de datos
            $identity = $this->request->getAttribute('identity');
            $lang = 'es';
            $role = 'user';
            
            if ($identity) {
                $userId = $identity->id ?? null;
                if ($userId) {
                    try {
                        $user = $this->Users->get($userId);
                        $lang = $user->language ?? 'es';
                        $role = $user->role ?? 'user';
                        
                        // Actualizar identity con los datos frescos
                        $this->Authentication->setIdentity($user);
                    } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
                        $lang = 'es';
                        $role = 'user';
                    }
                } else {
                    $lang = $identity->language ?? 'es';
                    $role = $identity->role ?? 'user';
                }
                
                // Guardar en sesión y aplicar locale
                $this->request->getSession()->write('Config.language', $lang);
                $locale = ($lang === 'en') ? 'en_US' : 'es_ES';
                \Cake\I18n\I18n::setLocale($locale);
                $this->set('locale', $lang);
            }
            
            $redirect = $this->Authentication->getLoginRedirect();
            if (!$redirect || $redirect === '/') {
                $redirect = '/';
            }
            return $this->redirect($redirect);
        }
        
        if ($this->request->is('post')) {
            $this->Flash->error('Correo o contraseña inválidos.');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response Redirects to login page.
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
        }
        return $this->redirect('/login');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $identity = $this->request->getAttribute('identity');
        $isAdmin = $identity && isset($identity->role) && $identity->role === 'admin';
        
        if ($isAdmin) {
            // Admin ve todos los usuarios
            $query = $this->Users->find();
        } else {
            // User solo ve su propia cuenta
            $query = $this->Users->find()->where(['id' => $identity->id]);
        }

        $users = $this->paginate($query);

        $this->set(compact('users', 'isAdmin'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $identity = $this->request->getAttribute('identity');
        if (!$identity || !isset($identity->role) || $identity->role !== 'admin') {
            $this->Flash->error(__('No tienes permiso para crear usuarios.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!isset($data['role']) || empty($data['role'])) {
                $data['role'] = 'user';
            }
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $identity = $this->request->getAttribute('identity');
        $isAdmin = $identity && isset($identity->role) && $identity->role === 'admin';
        
        // Si no es admin, solo puede editar su propia cuenta
        if (!$isAdmin && $identity && $id != $identity->id) {
            $this->Flash->error(__('No tienes permiso para editar este usuario.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            unset($data['password']);
            
            // Solo admin puede cambiar el rol
            if (!$isAdmin) {
                unset($data['role']);
            }
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'isAdmin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $identity = $this->request->getAttribute('identity');
        $isAdmin = $identity && isset($identity->role) && $identity->role === 'admin';
        
        // Si no es admin, solo puede eliminar su propia cuenta
        if (!$isAdmin && $identity && $id != $identity->id) {
            $this->Flash->error(__('No tienes permiso para eliminar este usuario.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $user = $this->Users->get($id);
        $isOwnAccount = $identity && $identity->id == $id;
        
        if ($this->Users->delete($user)) {
            if ($isOwnAccount) {
                $this->Flash->success(__('Your account has been deleted.'));
                $this->Authentication->logout();
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Change Password method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful change, renders view otherwise.
     */
    public function changePassword($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            
            $currentPassword = $data['current_password'];
            $newPassword = $data['new_password'];
            $confirmPassword = $data['confirm_password'];
            
            // Verificar contraseña actual
            if (!password_verify($currentPassword, $user->password)) {
                $this->Flash->error(__('Current password is incorrect.'));
                return $this->redirect(['action' => 'changePassword', $id]);
            }
            
            // Verificar que las nuevas contraseñas coincidan
            if ($newPassword !== $confirmPassword) {
                $this->Flash->error(__('New passwords do not match.'));
                return $this->redirect(['action' => 'changePassword', $id]);
            }
            
            // Verificar longitud mínima
            if (strlen($newPassword) < 6) {
                $this->Flash->error(__('New password must be at least 6 characters.'));
                return $this->redirect(['action' => 'changePassword', $id]);
            }
            
            // Actualizar password
            $user->password = $newPassword;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Password changed successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not change password. Please, try again.'));
        }
        
        $this->set(compact('user'));
    }
}