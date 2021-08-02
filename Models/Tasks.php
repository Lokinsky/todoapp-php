<?php
namespace App\Models;

class Tasks extends Model{
    /**
     * Модель бд для таблицы - @var tasks
     */
    protected $user_name;
    protected $email;
    protected $text;
    protected $status;
    protected $createdAt;
    protected $length = [
        'user_name' =>45,
        'email'     =>255,
        'text'      =>255,
        'status'    =>1,
    ];
    public function __construct() {
        parent::__construct();
        $this->table = 'tasks';
    }
    public function insert($data = [])
    {
        return $this->validate($data,function ($data){
                return $this->db->insert($this->table,$data);
            }
        );
    }
    public function update($data = [])
    {
        return $this->validate($data,function ($data){
                $values = $this->get_set_values($data);
                if($values && isset($data['id'])) return $this->db->query(sprintf('UPDATE %s SET %s WHERE `id`= %d',$this->table, $values, $data['id']));
                    
            }
        );
    }
    public function select($limit = 3 , $offset=0,$order_by = 'user_name', $as = 'ASC')
    {
        $order_by_array = ['user_name' => 'user_name','email' => 'email','status' => 'status'];
        $order_by = array_search($order_by, $order_by_array)?$order_by_array[$order_by]:'status';

        $as_array = ['ASC' => 'ASC','DESC' => 'DESC'];
        $as = array_search($as, $as_array)?$as_array[$as]:'ASC';
        

        $page = $offset*$limit;
        $sql = sprintf('SELECT `id`, `user_name`, `email`, `text`, `status` 
            FROM tasks 
            ORDER BY %s %s 
            LIMIT %d OFFSET %d ',$order_by,$as,$limit,$page);
        
        $this->numRows = $this->db->query('SELECT COUNT(*) as "rows" FROM tasks')[0]['rows'];

        if($this->numRows > 0 && $res = $this->db->query($sql)) return $res;
        else return false;
    }
}

?>