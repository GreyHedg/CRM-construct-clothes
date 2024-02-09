<?php 

$connect = mysqli_connect('localhost', 'root', 'SerSer', 'project');

if (!$connect){
    die("Connection failed: " . mysqli_connect_error());
} 

?>