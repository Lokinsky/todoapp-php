<?php
namespace App\Controllers;

use App\Utils\TemplateBuilder;

class Controller extends TemplateBuilder
{
    /**
     * Базовый класс предоставляющий 
     * общий для всех контроллеров
     * функционал
     */
    public function __construct(){

    }
    
    public function basicValidate($array = [])
    {
        /**
         * Валидатор на наличие xss-атак
         */
        $result = [];
        foreach ($array as $key => $value) {
            if(strcmp($key,'csrf')!=0)
                $result[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $result;
    }
    public static function getController(){
        $class = static::class;
        return new $class();
    }
}
