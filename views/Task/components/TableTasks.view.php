<div class="p-2">
    <div>
        <h3>Задания (всего записей – <?=$total?>)</h3>
    </div>
    <div class="mb-2 d-flex flex-row">
        <h4>Сортировка </h4>
        <form id="FormSort" action="/tasks" method="GET" class="mb-2 d-flex flex-row">
            <input type="text" name="page" value="<?=$page?>" hidden>
            <select name="by" class="form-select form-select-sm m-1" style="width: min-content;">
                <?php
                    echo 
                    '
                    <option '.($by == 'user_name' ? 'selected':'').' value="user_name">Имя</option>
                    <option '.($by == 'email' ? 'selected':'').' value="email">Почта</option>
                    <option '.($by == 'status' ? 'selected':'').' value="status">Статус</option>
                    ';
                ?>
              
            </select>
            <select name="sort" class="form-select form-select-sm m-1" style="width: min-content;">
              <?php
                echo 
                '<option '.($sort == 'ASC' ? 'selected':'').' value="ASC">по возрастанию</option>
                <option '.($sort == 'DESC' ? 'selected':'').' value="DESC">по убыванию</option>';
              ?>
            </select>
        </form>
    </div>
    <?=App\Utils\Pagination::getPagination($last, $page)?>
    <table id="table-tasks" class="table">
        <thead>
            <th>#</th>
            <th>Имя</th>
            <th>Почта</th>
            <th>Текст</th>
            <th>Статус</th>
        </thead>
        <tbody>
        <?php
            $editable = App\Security\Authentificator::check_auth();
            foreach ($tasks as $key => $task) {
                echo 
                "<tr>
                <td>".$task['id']."</td>
                <td>".$task['user_name']."</td>
                <td>".$task['email']."</td>
                <td>
                ".($editable ? 
                    "<input class='form-control' 
                        type='text' 
                        value='".$task['text']."' 
                        data-action='update-task' 
                        data-id='".$task['id']."'>" 
                    :
                    "<input class='form-control' 
                        type='text' 
                        value='".$task['text']."' 
                        disabled>"
                )."

                </td>
                <td>
                ".($editable ?
                    "<input type='checkbox' 
                        data-action='update-task' 
                        data-id='".$task['id']."' 
                        value='".intval($task['status'])."'
                        ".(boolval($task['status'])?'checked':'').">" 
                        :
                    "<input type='checkbox' 
                        value='".intval($task['status'])."'
                        ".(boolval($task['status'])?'checked':'')."
                        disabled>"
                )."

                </td>
                </tr>";

            }
            ?>
        </tbody>
    </table>
</div>
