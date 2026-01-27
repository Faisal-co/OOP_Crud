<?php
require_once "database.php";
/* $obj = new Database();
 $obj->insert('users',['name'=>'Rana','user_name'=>'eeeeA','email'=>'Siraisal@gmail.com']);
echo "id for insert";
print_r($obj->getResult()); */

/*$obj = new Database();
$obj->update('users',['name'=>'Rana Siraj Aslam','user_name'=>'EEeeeA','email'=>'Siraisal@gmail.com'],'id = "24"');
// $obj->update('users',['name'=>'Rana'],'name = "Aslam"');
echo "Rowsupdate";
print_r($obj->getResult());*/
$obj = new Database();
 $obj->delete('users','id = "1"');
echo "Rows Delete";
print_r($obj->getResult()); // Showing All messages of $result Variable.

?>