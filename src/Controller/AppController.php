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
        $sessionLang = $this->request->getSession()->read('Config.language');
        
        $lang = null;
        
        if ($identity && isset($identity->language) && !empty($identity->language)) {
            $lang = $identity->language;
        } elseif ($sessionLang) {
            $lang = $sessionLang;
        }
        
        if ($lang) {
            if ($lang === 'es') {
                $locale = 'es';
            } elseif ($lang === 'en') {
                $locale = 'en';
            } else {
                $locale = $lang;
            }
            \Cake\I18n\I18n::setLocale($locale === 'en' ? 'en_US' : 'es_ES');
            $this->set('locale', $locale);
        } else {
            $this->set('locale', 'es');
        }
    }
}
