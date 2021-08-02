<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=<?= App\Middleware\CSRF::get_token() ?>>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Авторизация</title>
</head>
  <body>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      <div class="container">       

          <div class="d-flex justify-content-center flex-column">
            <div class="row">
              <h2>Авторизация</h2> 
            </div>
            <div><a href="/tasks" class="btn btn-light">Перейти к заданиям</a></div>

              <div class="card mt-5">
                <form class="p-4" action="/login" method="POST">
                  <div class="mb-3">
                    <label class="form-label">Логин</label>
                    <input type="text" class="form-control" name="login" placeholder="Логин">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" placeholder="Пароль">
                  </div>
                  <input type="text" name="csrf" hidden value="<?= App\Middleware\CSRF::get_token()?>">
                  <button type="submit" class="btn btn-primary">Войти</button>
                </form>
              </div>
          </div>
      </div>
  </body>
</html>