<?php
session_start();
require '../../database.php';

if(isset($_SESSION['id'])){
    $id = $_GET['id'];
    $conn = db_connect();
    $sql = "DELETE FROM users WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        $_SESSION['success'] = 'User successfully deleted';
        header('Location: ./index.php');
    }else{
        $_SESSION['error'] = 'Something went wrong';
        header('Location: ./index.php');
    }
}