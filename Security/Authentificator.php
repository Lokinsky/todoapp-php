<?php
namespace App\Security;

use App\Models\User;
/**
 * Аутентификатор
 */
class Authentificator
{
	public function __construct()
	{
		if($this->check_auth()) $this->get_profile();
	}
	public static function check_auth(){
		if(isset($_SESSION['auth']) && $_SESSION['auth']['last'] > time()) return true;
		else{
			unset($_SESSION['auth']);
			return false;
		} 
	}

	private function get_profile()
	{
		if(isset($_SESSION['auth']['id'])){
			$time_login = date('Y-m-d H:i:s');
			$user = new User();
			if($fetched_user = $user->get_profile($_SESSION['auth']['id'])[0]){
				$_SESSION['auth'] = [
					"last" 		=> $_SESSION['auth']['last'],
					"user_name"	=> $fetched_user['user_name'],
					"email"		=> $fetched_user['email'],
					"login"		=> $fetched_user['login'],
					"roles"		=> explode(',', $fetched_user['roles']),
					"id"		=> $fetched_user['id']
				];
			}
			
		}

	}
	public static function login($login, $password)
	{
		$user = new User();
		if($fetched_user = $user->get_profile(null,$login,$password)){
			$time_login = date('Y-m-d H:i:s');
			$_SESSION['auth'] = [
				"last" 		=> strtotime('+1 day', strtotime($time_login)),
				"user_name"	=> $fetched_user[0]['user_name'],
				"email"		=> $fetched_user[0]['email'],
				"login"		=> $fetched_user[0]['login'],
				"roles"		=> explode(',', $fetched_user[0]['roles']),
				"id"		=> $fetched_user[0]['id']
			];
			return true;
		}else{
			unset($_SESSION['auth']);
			return false;
		}
	}
	public static function logout(){
		unset($_SESSION['auth']);
	}
}
?>