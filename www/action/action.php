<?
  include "config.php";
  header("Content-type: application/json");
  // if($_SERVER['HTTP_USER_AGENT'] == UACHECK) {
  $type = isset($_POST["type"]) ? $_POST["type"] : 0;
  $reg = "/\b(and|or|exec|execute|insert|select|delete|update|alter|create|drop|count|\*|chr|char|asc|mid|substring|master|truncate|declare|xp_cmdshell|restore|backup|net +user|net +localgroup +administrators)\b/";
  if (isset($_POST["intro"]) && isset($_POST["code"]) && isset($_POST["tags"])) {
    if (preg_match($reg, $_POST["intro"]) || preg_match($reg, $_POST["tags"])) {
      echo(json_encode(array("code" => 500)));
    } else {
      $time = time();
    $intro = $_POST["intro"];
    $code = base64_encode($_POST["code"]);
    $tags = $_POST["tags"];
    $sqlite3db = new SQLite3('../db.db');
    if($type == 0) {
      $sqlite3db->exec('insert into code (intro, code, tags, timestamp) values ("'. $intro .'","'. $code .'","'. $tags .'","'. $time .'")');
    } else {
      $sqlite3db->exec('update "code" set intro="'. $intro .'", code="'. $code .'", tags="'. $tags .'", timestamp="'. $time .'" where id='. $type);
    }
    $sqlite3db->close();
    echo json_encode(array('code' => 200));
    }
  } else {
    echo(json_encode(array("code" => 500)));
  }
  // } else {
  //   echo(json_encode(array("code" => 500)));
  // }
