<?php
namespace Paw\App\Validators;

class InputValidator
{
    static public function sanitizeInput($string){
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }
}
