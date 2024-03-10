<?php
session_start();
require './database.php';
include './include/header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for server validation as well
    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_password = hash('sha256', $password);
    $conn = db_connect();
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$enc_password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header('Location: ./index.php');
    }else{
        // Show the error message in the login page
        $_SESSION['error'] = 'Invalid email or password';
        // print_r($_SESSION['error']);
        // die();
        header('Location: ./login.php');
    }
    mysqli_close($conn);
}

?>

<header>
    <h1>Login</h1>
</header>

<?php include 'include/menu.php'; ?>

<section>
    <?php
        if(isset($_SESSION['error'])){
            echo "<span class='error-text auth-err'>". $_SESSION['error'] . "</span>";
            unset($_SESSION['error']);
        }
    ?>
    <form action="" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p class="text-center">Don't have an account? <a href="./register.php">Register here</a>.</p>
</section>

<?php
include './include/footer.php';
?>