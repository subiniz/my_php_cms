<?php
session_start();
require '../../database.php';
include '../../include/header.php';
include '../../process/user_process.php';
$conn = db_connect();
$user = getUserDetail();
// print_r($user);
// die();
$userId = $user['id'];
if(isset($_POST['name']) && isset($_POST['email'])) {
    $conn = db_connect();
    $name = $_POST['name'];
    $email = $_POST['email'];
    if(isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $enc_password = hash('sha256', $password);
        $enc_confirm_password = hash('sha256', $confirm_password);

        if($enc_password == $enc_confirm_password){
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$enc_password' WHERE id = $userId";
            if(mysqli_query($conn, $sql)){
                $_SESSION['success'] = 'User details successfully updated';
                header('Location: ./index.php');
            }else{
                $_SESSION['error'] = 'Something went wrong';
                header('Location: ./update.php');
            }
        }else{
            $_SESSION['error'] = 'The password does not match';
            header('Location: ./update.php');
        }
    }

    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $userId";
    if(mysqli_query($conn, $sql)){
        $_SESSION['success'] = 'User details successfully updated';
        header('Location: ./index.php');
    }else{
        $_SESSION['error'] = 'Something went wrong';
        header('Location: ./update.php');
    }
}
?>

<header>
    <h1>Users</h1>
</header>

<?php include '../../include/menu.php'; ?>

<section>
    <div class="container">
        <h2 class="text-center">Add New User</h2>
        <form action="" method="post">
            <label for="name">Name *:</label>
            <input type="text" id="name" name="name" value="<?= $user['name']; ?>">
            <label for="email">Email *:</label>
            <input type="text" id="email" name="email" value="<?= $user['email']; ?>">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" onkeyup="validatePassword()">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" onkeyup="validatePassword()">
            <div class="form-group">
                <span class="error-text" id="password_error_msg" style="display: none;">The password doesn't match</span>
                <span class="success-text" id="password_success_msg" style="display: none;">The password matches</span>
            </div>
            <input type="submit" id="register_btn" value="Update">
            <a href="../index.php"><button>Cancel</button></a>
        </form>
    </div>
</section>

<?php
include '../../include/footer.php';
?>