<?php
    if(isset($_REQUEST['logout'])){
        session_destroy();
        header('Location: ./index.php');
    }
?>
<nav>
    <?php
        if(isset($_SESSION['name'])) {
            echo "<span class='text-profile'>Welcome, ".$_SESSION['name']."</span>";
        }
    ?>
    <a href="./index.php">Home</a>
    <?php
        if(isset($_SESSION['id'])) {
    ?>
            <a href="./pages/users/index.php">Users</a>
            <a href="#">Products</a>
            <a href="#">Categories</a>
            <a href="?logout=true">Logout</a>
    <?php
        } else {
    ?>
        <a href="http://localhost/my_php_cms/login.php">Login</a>
        <a href="http://localhost/my_php_cms/register.php">Register</a>
    <?php
    }
    ?>
</nav>