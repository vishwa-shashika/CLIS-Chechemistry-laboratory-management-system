<?php
include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Labtec"){
    header('location:index.php');
}

$id = $_POST['pid'];
$delete = $pdo->prepare("DELETE FROM items WHERE item_id=:id");
$delete->bindParam(':id', $id);

if($delete->execute()){
    
}else{
    echo "------------------------ delete faild";
}

?>