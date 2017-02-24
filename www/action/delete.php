<?
  include "config.php";
  header("Content-type: application/json");
  // if($_SERVER['HTTP_USER_AGENT'] == UACHECK) {
  $id = $_GET["id"];
  $sqlite3db = new SQLite3('../db.db');
  $sqlite3db->exec("delete from code where id='". $id ."'");
  $sqlite3db->close();
  echo json_encode(array('code' => 200));
  // } else {
  //   echo(json_encode(array("code" => 500)));
  // }
