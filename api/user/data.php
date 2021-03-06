<?php
require_once('../Define.php');
/**
 * MySQLに接続しデータを取得する
 *
 */

// 以下のコメントを外すと実行時エラーが発生した際にエラー内容が表示される
// ini_set('display_errors', 'On');
// ini_set('error_reporting', E_ALL);

//-------------------------------------------------
// 引数を受け取る
//-------------------------------------------------
// ユーザーIDを受け取る
$uid = isset($_GET['uid'])?  $_GET['uid']:null;

// Validation
if( ($uid === null) || (!is_numeric($uid)) ){
  Define::sendResponse(false, 'Invalid uid');
  exit(1);
}

//-------------------------------------------------
// 準備
//-------------------------------------------------
$dsn  = Define::$dsn;
$user = Define::$user;     // MySQLのユーザーID
$pw   = Define::$pw;   // MySQLのパスワード

// 実行したいSQL
$sql = 'SELECT * FROM User WHERE id=:id';  // Userテーブルの指定列を取得


//-------------------------------------------------
// SQLを実行
//-------------------------------------------------
try{
  $dbh = new PDO($dsn, $user, $pw);   // 接続
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // エラーモード
  $sth = $dbh->prepare($sql);         // SQL準備

  // プレースホルダに値を入れる
  $sth->bindValue(':id', $uid, PDO::PARAM_INT);

  // 実行
  $sth->execute();

  // 実行結果から1レコード取ってくる
  $buff = $sth->fetch(PDO::FETCH_ASSOC);
}
catch( PDOException $e ) {
  Define::sendResponse(false, 'Database error: '.$e->getMessage());  // 本来エラーメッセージはサーバ内のログへ保存する(悪意のある人間にヒントを与えない)
  exit(1);
}

//-------------------------------------------------
// 実行結果を返却
//-------------------------------------------------
// データが0件
if( $buff === false ){
  Define::sendResponse(false, 'Not Fund user');
}
// データを正常に取得
else{
  Define::sendResponse(true, $buff);
}


