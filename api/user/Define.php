<?php
class Define{
    public static $dsn = 'mysql:dbname=sgrpg;host=127.0.0.1';
    public static $user ='senpai';
    public static $pw = 'indocurry';
    
    /**
 * 実行結果をJSON形式で返却する
 *
 * @param boolean $status
 * @param array   $value
 * @return void
 */

// public static function connect(){
//     $dbh = new PDO($dsn, $user, $pw);   // 接続
//     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // エラーモード
// }

public static function sendResponse($status, $value=[]){
    header('Content-type: application/json');
    echo json_encode([
      'status' => $status,
      'result' => $value
    ]);
  }


}