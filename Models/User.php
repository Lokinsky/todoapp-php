<?php
namespace App\Models;

/**
 * Модель пользователя
 */
class User extends Model
{
	protected $user_name;
    protected $email;
    protected $password;
    protected $roles;
    protected $length = [
    	'login' 	=>255,
        'user_name'	=>45,
        'email'		=>255,
        'password'	=>255,
        'roles'		=>255,
    ];
    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }
    public function get_profile($id = NULL, $login = '', $password = '')
    {
    	if(!$id && !$login && !$password) return false;
    	$sql = sprintf('SELECT `id`, `user_name`, `email`, `login`, `password`, `roles` 
            FROM users 
      		WHERE id=%d OR login="%s" AND password="%s" ',$id, $login, $password);
    	if($res = $this->db->query($sql)) return $res;
    	else return false;
    }
}
?>