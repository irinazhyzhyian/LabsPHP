<?php defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');

class MyDB
{
var $dblogin = "root"; 
var $dbpass = ""; 
var $db = "mysite"; 
var $dbhost="site";

var $link;
var $query;
var $err;
var $result;
var $data;
var $fetch;

function connect() {
$this->link = new mysqli($this->dbhost, $this->dblogin, $this->dbpass, $this->db);
$this->link->query('SET NAMES utf8');
}

function run($query) {
    $this->query = $query;
    $this->result = $this->link->query($this->query);
    $this->err = $this->link->error;
    if($this->result===false)
        return false;
}
function row() {
    $this->data = $this->result->fetch_assoc();
}
function fetch() {
    if($this->result===false)
        return false;
    while ($this->data = $this->result->fetch_assoc()) {
        $this->fetch = $this->data;
        return $this->fetch;
    }
}
function stop() {
unset($this->data);
unset($this->result);
unset($this->fetch);
unset($this->err);
unset($this->query);
}
}