<?php
session_start();
require '../../database.php';
include '../../include/header.php';
include '../../process/user_process.php';
$conn = db_connect();
?>

<header>
    <h1>Users</h1>
</header>

<?php include '../../include/menu.php'; ?>

<section>
    <div class="container">
        <button class="add-button">+ Add User</button>
        <table>
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 1;
            $users = getUsersList();
            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $user['name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td>
                        <button class="btn">Edit</button>
                        <button class="btn">Delete</button>
                    </td>
                </tr>
            <?php
            }
            ?>
            <!-- Add more rows for additional users -->
        </table>
    </div>
</section>

<?php
include '../../include/footer.php';
?>