<?php
require 'config.php';

session_start();

admin_check();

$page = 'admin.php';
//additional php code for this page goes here
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<?= template_header('Home') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="columns">

    <?= admin_nav() ?>

    <div class="column">
        <?= message() ?>
        <table class="table">
            <tr>
                <td>Your account details:</td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><?= $_SESSION['name'] ?></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><?= $password ?></td>
            </tr>
            <tr>
                <td>Email Address: </td>
                <td><?= $email ?></td>
            </tr>
        </table>
    </div>
    <!-- END RIGHT CONTENT COLUMN-->
</div>


<?= template_footer() ?>