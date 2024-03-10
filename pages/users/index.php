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
        <a href="./create.php">
            <button class="add-button">+ Add User</button>
        </a>
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
                        <a href="update.php?id=<?php echo $user['id']; ?>">
                            <button class="btn">Edit</button>
                        </a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>" onclick="confirm('Are you sure?')">
                        <button class="btn">Delete</button>
                        </a>
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