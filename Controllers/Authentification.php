<?php
namespace App\Controllers;

use App\Utils\ObjectExt;
use App\Security\Authentificator;
use App\Middleware\CSRF;

class Authentification extends Controller{

	public function login(){
		if(!isset($_POST['login']) && !isset($_POST['password'])){
			if(Authentificator::check_auth()) header('Location: /tasks');
			else parent::view('LoginForm');
		}
		else{
			CSRF::validate(function (){ 
				$authentificator = new Authentificator();
                if($authentificator->login($_POST['login'], $_POST['password'])){
                	header('Location: /tasks');
                }else{
                	parent::view('FailedPage',[
                		'title' 			=> 'Авторизация',
                		'notification' 		=> 'Неудача',
                		'description' 		=> 'Пользователь с логином – '.$_POST['login'].', не найден или же пароль был введён неправильно.',
                		'return_page' 		=> '/login',
                		'return_page_text' 	=> 'Вернуться на страницу авторизации',
                		'as_component'      => false
                	],false, 'Common');
                }
            });
		}
	}
	public function logout(){
		Authentificator::logout();
		header('Location: /tasks');
	}
}

?>