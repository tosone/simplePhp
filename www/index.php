<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
  <title>Tosone's Code Snippets</title>
  <? include('_include/head.php'); ?>
  <script type="text/javascript" src="/javascripts/prettify.js"></script>
  <link rel="stylesheet" href="/stylesheets/index.css" />
  <link rel="stylesheet" href="/stylesheets/sweetalert.css">
  <script type="text/javascript" src="/javascripts/sweetalert.min.js"></script>
</head>
<body onload="prettyPrint()">
  <div class="container">
    <?
      include("_include/menu.php");
      $sqlite3db = new SQLite3('./db.db');
      include("action/config.php");
      $tpage = ceil(intval($sqlite3db->querySingle('select count(id) from code')) / PAGE_NUM);
      $page = intval(isset($_GET["page"]) ? $_GET["page"] : 1);
      $page = ($page > $tpage || $page < 1) ? 1 : $page;
      if($result = $sqlite3db -> query('select * from code order by [timestamp] desc limit '. PAGE_NUM .' offset '. (PAGE_NUM * ($page - 1)))) {
        while($row = $result -> fetchArray()) {
          echo('<div class="m_box">');
          //echo('<span class="editor_btn" data-id="' . $row["id"] . '">编辑</span>');
          echo('<span class="content_btn" data-id="' . $row["id"] . '">查看</span>');
          //echo('<span class="delete_btn" data-id="' . $row["id"] . '">删除</span>');
          echo('<p>' . $row["intro"] . '</p>');
          echo("<pre class=\"prettyprint linenums\">" . base64_decode($row["code"]) . "</pre>");
          echo('<div class="m_box_bottom clearfix"><div class="tags"><img src="./images/tag.png" alt="tag"/>');
          foreach (explode(";", $row["tags"]) as $tag) {
            echo('<a href="javascript:void(0);" class="ctag" data-tag="' . $tag . '">' . $tag . '</a>');
          }
          echo('</div><div class="timestamp">'. date('Y/m/d H:i:s', $row["timestamp"]) .'</div></div>');
          echo('</div>');
        }
      }
    ?>
    <div class="f_btn_group" id="f_btn_group">
      <?=($page == 1) ? '<a href="javascript:void(0);" class="f_btn f_ban" id="f_1">首页</a>' : '<a href="index.php" class="f_btn">首页</a>'?>
      <?=($page == 1) ? '<a href="javascript:void(0);" class="f_btn f_ban">上一页</a>' : '<a href="index.php?page='. ($page - 1) .'" class="f_btn">上一页</a>'?>
      <?='<a href="javascript:void(0);" class="f_btn f_num">'. $page .'&nbsp;/&nbsp;'. $tpage .'</a>'?>
      <?=($page == $tpage) ? '<a href="javascript:void(0);" class="f_btn f_ban">下一页</a>' : '<a href="index.php?page='. ($page + 1) .'" class="f_btn">下一页</a>'?>
      <?=($page == $tpage) ? '<a href="javascript:void(0);" class="f_btn f_ban">尾页</a>' : '<a href="index.php?page='. $tpage .'" class="f_btn">尾页</a>'?>
    </div>
  </div>
  <? include("_include/bottom.php"); ?>
  <? include("_include/script.php"); ?>
</body>
</html>
