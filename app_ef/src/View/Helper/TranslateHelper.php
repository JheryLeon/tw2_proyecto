<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

class TranslateHelper extends Helper
{
    public function __($text, $default = null)
    {
        try {
            $translations = $this->_view->get('translations') ?? [];
        } catch (\Exception $e) {
            $translations = [];
        }
        
        if (isset($translations[$text])) {
            return $translations[$text];
        }
        
        return $default ?? $text;
    }
    
    public function get($key, $default = null)
    {
        return $this->__($key, $default);
    }
}