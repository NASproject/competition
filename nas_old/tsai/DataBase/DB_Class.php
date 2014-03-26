<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once $_SESSION['ROOT'] . '/DataBase/DB_config.php';

class DataBase {

    protected $conn;       // 連線
    protected $queryData;    // 查詢資料

    // 建構子, 連結資料庫的預設值

    public function __construct($host = '', $user = '', $password = '', $db = '') {

        global $DB_host, $DB_user, $DB_password, $DB_DB; // 引用全域變數
        $host = $host == '' ? $DB_host : $host;
        $user = $user == '' ? $DB_user : $user;
        $password = $password == '' ? $DB_password : $password;
        $db = $db == '' ? $DB_DB : $db;

        $this->conn = mysql_connect($host, $user, $password);
        if (!$this->conn) {
            die('MySQL Connect Error');
        }
        mysql_query('SET NAMES utf8');
        if (!mysql_select_db($db, $this->conn)) {
            die('MySQL Select DB Error');
        }
    }

    // 輸入處理, 防資料隱碼
    function safeStr($str) {
        return mysql_real_escape_string($str, $this->conn);
        ;
    }

    // 傳回 SQLdata 中的資料筆數
    function length() {
        return mysql_num_rows($this->queryData);
    }

    // 傳回搜尋的一筆資料
    function getOne() {
        return mysql_fetch_array($this->queryData);
    }

    function getOneJ() {
        return json_encode(mysql_fetch_array($this->queryData));
    }

    function getList() {
        while ($row = mysql_fetch_assoc($this->queryData)) {
            $myjsons[] = $row;
        }
        $this->queryData = json_encode($myjsons);
        return $this->queryData;
    }

    function getArray() {
        while ($row = mysql_fetch_assoc($this->queryData)) {
            $myjsons[] = $row;
        }
        $this->queryData = $myjsons;
        return $this->queryData;
    }

    // 關閉連線
    function close() {
        return mysql_close($this->conn);
    }

    // 資料庫搜尋
    function select($table, $where = '', $orderby = '', $cols = '*') {

        $orderby = !empty($orderby) ? "ORDER BY $orderby" : ''; // order資料處理
        $where = !empty($where) ? "WHERE $where" : '';          // where資料處理
        $SQLStr = "SELECT $cols FROM $table $where $orderby";   // 執行字串建立與處理
        $this->query($SQLStr);                                  // 呼叫query執行
    }

    function distinct($table, $where = '', $orderby = '', $cols = '*') {

        $orderby = !empty($orderby) ? "ORDER BY $orderby" : ''; // order資料處理
        $where = !empty($where) ? "WHERE $where" : '';          // where資料處理
        $SQLStr = "SELECT DISTINCT $cols FROM $table $where $orderby";   // 執行字串建立與處理
        $this->query($SQLStr);                                  // 呼叫query執行
    }

    // 新增 $record 內容為 key(欄位名稱) => value(設定值)
    function insert($table, $record) {

        $keyStr = $valueStr = '';
        foreach ($record as $key => $value) {
            if ($keyStr == '') {
                $keyStr = "`$key`";
                $valueStr = "'$value'";
            } else {
                $keyStr .= ", `$key`";
                $valueStr .= ", '$value'";
            }
        }
        $SQLStr = "INSERT INTO $table ($keyStr) VALUES ($valueStr);";
        return $this->query($SQLStr, 'INSERT');
    }

    // 修改 $record 內容為 key(欄位名稱) => value(設定值)
    function update($table, $record, $where = '') {

        $str = '';
        foreach ($record as $key => $value) {
            if ($str == '') {
                $str = "`$key` = '$value'";
            } else {
                $str .= ", `$key` = '$value'";
            }
        }
        $SQLStr = "UPDATE $table SET $str WHERE $where;";
        $this->query($SQLStr);
    }

    // 刪除
    function delete($table, $where = '') {

        $SQLStr = "DELETE FROM $table WHERE $where";    // 執行字串建立與處理
        $this->query($SQLStr);                          // 呼叫execute執行
    }

    // 執行
    protected function query($SQLStr, $type = '') {

        $this->queryData = mysql_query($SQLStr, $this->conn);
        if ($type == 'INSERT') {
            return mysql_insert_id($this->conn);
        }
    }

}

?>
