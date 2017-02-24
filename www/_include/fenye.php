<div class="f_btn_group" id="f_btn_group">
  <?=($page == 1) ? '<a href="javascript:void(0);" class="f_btn f_ban" id="f_1">首页</a>' : '<a href="index.php" class="f_btn">首页</a>'?>
  <?=($page == 1) ? '<a href="javascript:void(0);" class="f_btn f_ban">上一页</a>' : '<a href="index.php?page='. ($page - 1) .'" class="f_btn">上一页</a>'?>
  <?='<a href="javascript:void(0);" class="f_btn f_num">'. $page .'&nbsp;/&nbsp;'. $tpage .'</a>'?>
  <?=($page == $tpage) ? '<a href="javascript:void(0);" class="f_btn f_ban">下一页</a>' : '<a href="index.php?page='. ($page + 1) .'" class="f_btn">下一页</a>'?>
  <?=($page == $tpage) ? '<a href="javascript:void(0);" class="f_btn f_ban">尾页</a>' : '<a href="index.php?page='. $tpage .'" class="f_btn">尾页</a>'?>
</div>
