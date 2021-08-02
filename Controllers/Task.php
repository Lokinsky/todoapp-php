<?php
namespace App\Controllers;

use App\Models\Tasks as TasksModel;
use App\Middleware\CSRF;
use App\Security\Authentificator;

class Task extends Controller{
    /**
     * Контроллер-обработчик маршрутов 
     * @var Route(/tasks)
     */
    public function index(){
        /**
         * Конуструктор базового представления
         * @var view
         */
        parent::view('Tasks', ['title' => 'Задания']);
    }
    public function FormTask(){
        /**
         * Конуструктор базового представления
         * @var view
         */
        parent::view('FormTask',[],true);
    }
    public function TableTasks(){
        /**
         * Конуструктор базового представления
         * @var view
         */
        $limit = 3;
        $page = isset($_GET['page']) && intval($_GET['page']) >= 0 ? intval($_GET['page']):0;

        $as = $_REQUEST['sort'] = isset($_REQUEST['sort']) ? htmlspecialchars($_REQUEST['sort']) : 'ASC';
        $order_by = $_REQUEST['by'] = isset($_REQUEST['by']) ? htmlspecialchars($_REQUEST['by']) : 'status';

        $tasks = new TasksModel();
        if($fetched = $tasks->select($limit, $page, $order_by, $as)){
            parent::view('TableTasks',[
                'tasks' => $fetched,
                'page'  => $page,
                'last'  => ceil($tasks->numRows / $limit) - 1,
                'total' => $tasks->numRows,
                'sort'  => $as,
                'by'    => $order_by 

            ],true);
        }else parent::view('FailedPage',[
                        'title'             => 'Страница не найдена',
                        'notification'      => 'Неудача',
                        'description'       => 'Страница не найдена – '.$page.'.',
                        'return_page'       => '/tasks',
                        'return_page_text'  => 'Вернуться на страницу заданий',
                        'as_component'      => true
                    ],false, 'Common');
            
    }
    public function apiInsertTask(){
        /**
         * API-функция для создания записи в бд
         * в таблице 
         * @var App\Models\Tasks
         */
        $data = parent::basicValidate($_POST);
        CSRF::validate(function () use ($data){
                $tasks = new TasksModel();
                $tasks->insert($data);
        });
    }
    public function apiUpdateTask(){
        /**
         * API-функция для обновления записи в бд
         * в таблице 
         * @var App\Models\Tasks
         */
        if(Authentificator::check_auth()){
            $data = parent::basicValidate($_POST);
            CSRF::validate(function () use ($data){
                    $tasks = new TasksModel();
                    $tasks->update($data);
            });
        }else{
            echo json_encode([
                'status'    => 403,
                'msg'       => 'Вы должны быть авторизированы для этого действия и быть администратором.'
            ]);
        }
        
    }
}

?>