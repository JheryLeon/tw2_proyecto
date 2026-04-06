<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\I18n\I18n;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication', [
            'unauthenticatedRedirect' => '/users/login',
        ]);

        $this->setLocaleFromUser();
    }

    protected function setLocaleFromUser(): void
    {
        $identity = $this->request->getAttribute('identity');
        
        $lang = 'es';
        
        if ($identity) {
            $userId = $identity->id ?? null;
            
            if ($userId) {
                try {
                    $userTable = $this->getTableLocator()->get('Users');
                    $user = $userTable->get($userId);
                    $lang = $user->language ?? 'es';
                } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
                    $lang = 'es';
                }
            } elseif (isset($identity->language) && !empty($identity->language)) {
                $lang = $identity->language;
            }
        }
        
        if ($lang === 'es') {
            $locale = 'es_ES';
        } else {
            $locale = 'en_US';
        }
        
        \Cake\I18n\I18n::setLocale($locale);
        $this->set('locale', $lang);
        $this->set('_locale', $lang);
    }

    protected function isAdmin(): bool
    {
        $identity = $this->request->getAttribute('identity');
        return $identity && isset($identity->role) && $identity->role === 'admin';
    }

    protected function getCurrentUserId(): ?int
    {
        $identity = $this->request->getAttribute('identity');
        return $identity ? $identity->id : null;
    }
}
