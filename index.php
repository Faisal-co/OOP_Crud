<?php
require_once "database.php";
$obj = new Database();
$obj->insert('users',['name'=>'Rana','user_name'=>'eeeeA','email'=>'Siraisal@gmail.com']);
echo "id for insert";
print_r($obj->getResult());

?>