<?php
namespace App\Middleware;

class CSRF{
    /**
     * Middleware-компонент для защиты от CSRF-атак.
     */
    public static function get_token()
    {
        /**
         * Создание одноразового токена.
         * @return hash_hmac_string
         */
        return hash_hmac('sha256',$GLOBALS['SECRET'],$_SESSION['key']);
    }
    public static function validate($callback = null, $token = null)
    {
        /**
         * Статическая функция валидатора CSRF-защитника.
         * @return bool
         */
        if(!isset($token)) $token = isset($_REQUEST['csrf']) ? $_REQUEST['csrf'] : false;

        if(hash_equals(self::get_token(),$token)){
            if($callback!=null) return $callback();
            return true;
        }
        else{
            http_response_code(403);
            echo 'Access denied!';
            return false;
        }
    }
}

?>