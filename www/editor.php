<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
  <title>Tosone的微博客</title>
  <? include('_include/head.php'); ?>
  <link rel="stylesheet" href="/stylesheets/editor.css" />
  <link rel="stylesheet" href="/stylesheets/sweetalert.css">
  <script type="text/javascript" src="/javascripts/sweetalert.min.js"></script>
</head>
<body class="container">
  <?
    include("_include/menu.php");
    $sqlite3db = new SQLite3('db.db');
    $codes = array('intro' => "", 'code' => "", 'tags' => "");
    if(isset($_GET["id"])) {
      $codes = $sqlite3db->querySingle('select * from code where id="'. $_GET["id"] .'"', true);
    }
  ?>
  <div class="container editor_con">
    <div class="form_group clearfix">
      <div class="descri">
        <label for="intro">介绍</label>
      </div>
      <div class="con_input">
        <textarea id="intro" placeholder="介绍"><?=$codes["intro"]?></textarea>
      </div>
    </div>
    <div class="form_group clearfix">
      <div class="descri">
        <label for="code">代码</label>
      </div>
      <div class="con_input">
        <textarea id="code" placeholder="代码" style="height: 530px;font-size: 12px;line-height: 1.5;"><?=base64_decode($codes["code"])?></textarea>
      </div>
    </div>
    <div class="form_group clearfix">
      <div class="descri">
        <label for="tags">标签</label>
      </div>
      <div class="con_input">
        <input type="text" id="tags" placeholder="多个标签请以英文分号分隔" value="<?=$codes["tags"]?>" />
      </div>
    </div>
    <div class="form_group">
      <button id="submit">提交</button>
    </div>
  </div>
  <? include("_include/bottom.php"); ?>
  <script>
    $("#search").click(function(){
      var url = window.location.protocol + "//" + window.location.host + "/searchKeyWords.php";
      window.location.href = url + "?keywords=" + $("#search_input").val();
    });
    $("#search_input").keypress(function (e) {
      var e = e || event, keycode = e.which || e.keyCode;
      if (keycode == 13) {
        var url = window.location.protocol + "//" + window.location.host + "/searchKeyWords.php";
        window.location.href = url + "?keywords=" + $("#search_input").val();
      }
    });
    function escapeHtml(unsafe) {
      return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
    $("#submit").click(function(){
      var intro = escapeHtml($("#intro").val());
      var code = escapeHtml($("#code").val());
      var tags = escapeHtml($("#tags").val());
      if(intro == "" || code == "" || tags == "") {
        swal("介绍、代码或标签不能为空！");
      } else {
        $.post("/action/action.php", {<?=isset($_GET["id"])?("type: ". $_GET["id"] .","):""?> intro: intro, code: code, tags: tags}, function(data){
          if(data.code == 500) {
            swal("添加或者修改失败！");
          }
          if(data.code == 200) window.location.href = "/";
        }, 'json');
      }
    });
  </script>
</body>
</html>
