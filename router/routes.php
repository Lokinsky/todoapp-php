<?php
namespace App;

/**
 * Контейнер маршрутов.
 * @var Controller controller
 */
class Routes
{
    CONST WEB = array(
        '/tasks' => [
            'class' => Controllers\Task::class,
            'function' => 'index'
        ],
        '/login' => [
            'class' => Controllers\Authentification::class,
            'function' => 'login'
        ],
        '/logout' => [
            'class' => Controllers\Authentification::class,
            'function' => 'logout'
        ],
    );
    CONST API = array(
        '/api/tasks/add'    => [
            'class' => Controllers\Task::class,
            'function' => 'apiInsertTask'
        ],
        '/api/tasks/update'  => [
            'class' => Controllers\Task::class,
            'function' => 'apiUpdateTask'
        ],
    );
}
