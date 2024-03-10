<?php
$conn = db_connect();

function getUsersList()
{
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $users;
}