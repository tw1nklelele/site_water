<?php
function sort_link_th($title, $a, $b) {
  $SORTIROVKA=$_GET['sort'];
  if ($SORTIROVKA == $a) {
    return '<a class= "link_sort" id="link_sort_select" href="?sort='.$b.'">'.$title.' </a>';
  } elseif ($SORTIROVKA == $b) {
    return '<a class="link_sort" id="link_sort_select" href="?sort='.$a.'">'.$title.'<img id="img_sort" src="Images/img_sort.png"></a>';
  }
    return '<a class="link_sort" href="?sort='.$a.'">'.$title.'</a>';
  }

?>