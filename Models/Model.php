<?php
namespace App\Models;

use App\Database\DB;
use App\Utils\ObjectExt;

class Model extends ObjectExt{
    /**
     * Базовый клас моделей, 
     * который предоставляет минимальный набор общих инструментов
     */
    protected $id;
    protected $table;
    protected $db;
    public $countRows = '';
    public function __construct() {
        $this->db = new DB();
    }

    public function db()
    {
        return $this->db;
    }

    protected function validate($data = [],$callback)
    {
        /**
         * Базовый валидатор базового класса Model
         */
        foreach ($data as $key => $value) {
            if($key != 'id' && strlen($value) > $this->length[$key])
                die('ERROR 1: Max length for '.$key.' is: '.$this->length[$key]);
        }
        return $callback($data);
    }
    protected function get_set_values($data){
        $res = [];
        $keys = $this->get_object_properties($this, true);

        foreach ($data as $key => $value) {
            if($key != 'id' && array_search($key, $keys)){
                $res[] = sprintf(' `%s`="%s" ', htmlspecialchars($key),htmlspecialchars($value));
            }
        }
        if($res) return implode(',', $res);
        else return false;
    }
}

?>