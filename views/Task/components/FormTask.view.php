
<div>
    <form id="FormTask" method="POST">
        <input name="csrf" type="text" hidden value=<?= App\Middleware\CSRF::get_token()?>>
		<div class="input-group mb-3">
		  <input type="text" name="user_name" required  placeholder="Имя" class="form-control" aria-label="Имя">

		  <input type="text" name="email" required class="form-control" placeholder="e-mail" aria-label="e-mail">
		</div>

		<div class="input-group">
		  <span class="input-group-text">Текст задачи</span>
		  <textarea class="form-control" name="text" required type="text" placeholder="Текст задачи" aria-label="Текст задачи"></textarea>
		</div>
		<hr>
        <div class="d-flex justify-content-center">
        	<button class="btn btn-primary" type="submit">Отправить</button>
        </div>
    </form>

</div>