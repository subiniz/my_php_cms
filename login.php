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
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);

    //Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "ss", $email, $enc_password);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header('Location: ./index.php');
    }else{
        // Show the error message in the login page
        $_SESSION['error'] = 'Invalid email or password';
        print_r($_SESSION['error']);
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
        if(isset($_SESSION['error'])){
            echo "<span class='success-text auth-err'>". $_SESSION['error'] . "</span>";
            unset($_SESSION['success']);
        }
    ?>
    <form action="" method="post">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p class="text-center">Don't have an account? <a href="./register.php">Register here</a>.</p>
</section>

<?php
include './include/footer.php';
?>