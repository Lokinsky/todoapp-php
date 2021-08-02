<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=<?= App\Middleware\CSRF::get_token() ?>>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?= $title ?></title>
</head>
<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <div class="container">
        <div class="card" style="width: fit-content;">
            <div class="card-body" >
                <?php
                    if(App\Security\Authentificator::check_auth()){
                        echo
                        '<h5 class="card-title">
                            <b>Пользователь: </b>'.App\Utils\ObjectExt::session('auth')['user_name']
                        .'</h5>';
                    }
                ?>
                <?php 
                if(App\Security\Authentificator::check_auth()) {
                    echo 
                    '<a href="/logout" class="btn btn-danger">
                        Выйти
                    </a>';
                }else{ 
                    echo 
                    '<a href="/login" class="btn btn-success">
                        Авторизоваться
                    </a>';
                }
                ?>
            </div>
        </div>
        <div class="content">
            <div class="row" id="table-tasks">
                <?=App\Controllers\Task::getController()->TableTasks()?>
            </div>
            <?=App\Controllers\Task::getController()->FormTask()?>
        </div>
    </div>
    <script type="text/javascript" src="public/js/Form.Task.js"></script>
    <?php
        if(App\Security\Authentificator::check_auth()){
            echo '<script type="text/javascript" src="public/js/Form.Task.Admin.Utils.js"></script>';
        }
    ?>
</body>

</html>