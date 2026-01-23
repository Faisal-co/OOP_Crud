<?php
require "database.php";
$obj = new Database();
$obj->insert('registered_users',['full_name'=>'ABC','username'=>'XYZ','email'=>'abc@gmail.com']);

?>