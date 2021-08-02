<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item <?=($current == 0) ? disabled:''?>">
      <a class="page-link " href="<?=$first_link?>">В начало </a>
    </li>
    <li class="page-item <?=($current == 0) ? disabled:''?>">
      <a class="page-link" href="<?=$prev_link?>" tabindex="-1" aria-disabled="true">Предыдущая</a>
    </li>
    <li class="page-item active" aria-current="page">
      <a class="page-link" href="#"><?=$current+1?></a>
    </li>
    <li class="page-item <?=($current >= $last) ? disabled:''?>">
      <a class="page-link" href="<?=$next_link?>">Следующая</a>
    </li>
    <li class="page-item <?=($current >= $last) ? disabled:''?>">
      <a class="page-link " href="<?=$last_link?>">Последняя (<?=$last+1?>)</a>
    </li>
  </ul>
</nav>