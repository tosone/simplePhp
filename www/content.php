<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
  <title>Tosone's Code Snippets</title>
  <? include('_include/head.php'); ?>
  <script type="text/javascript" src="/javascripts/prettify.js"></script>
  <link rel="stylesheet" href="/stylesheets/index.css" />
  <link rel="stylesheet" href="/stylesheets/sweetalert.css">
  <script type="text/javascript" src="/javascripts/sweetalert.min.js"></script>
</head>
<body  onload="prettyPrint()">
  <div class="container">
    <?
      include("_include/menu.php");
      $sqlite3db = new SQLite3('./db.db');
      if(isset($_GET["id"])) {
        $id = $_GET["id"];
      } else {
        echo('<script>window.location.href="/";</script>');
      }
      $content = $sqlite3db -> querySingle('SELECT * FROM code where id=' . $id, true);
      echo('<div class="m_box">');
      echo('<span class="editor_btn" data-id="' . $content["id"] . '">编辑</span>');
      echo('<span class="delete_btn" data-id="' . $content["id"] . '">删除</span>');
      echo('<p>' . $content["intro"] . '</p>');
      echo("<pre class=\"prettyprint linenums\">" . base64_decode($content["code"]) . "</pre>");
      echo('<div class="m_box_bottom clearfix"><div class="tags"><img src="./images/tag.png" alt="tag"/>');
      foreach (explode(";", $content["tags"]) as $tag)
        echo('<a href="javascript:void(0);" class="ctag" data-tag="' . $tag . '">' . $tag . '</a>');
      echo('</div><div class="timestamp">'. date('Y/m/d H:i:s', $content["timestamp"]) .'</div></div>');
      echo('</div>');
    ?>
  </div>
  <? include("_include/bottom.php"); ?>
  <? include("_include/script.php"); ?>
</body>
</html>
