<?php
include_once('common.php');
if(isset($_POST['field_id']) && isset($_SESSION['cpf'])){
    $field_id =  $_POST['field_id'];
    $cpf= $_SESSION['cpf'];
    $query = "insert into field_user values ($field_id, '$cpf')";
    echo $query;
    mysqli_query($conn,$query);
    header("location:home.php");
}
?>
