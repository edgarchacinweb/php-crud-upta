<?php
function connection() {
  $myconnection = new mysqli("localhost", "root", "", "crud");
  $myconnection->set_charset("utf8");
  
  if($myconnection->connect_errno) {
    header('Location:http://localhost:8080/crud/index.php?status=error');
    exit();
  }
  
  return $myconnection;
}

?>