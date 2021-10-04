<?php
require 'config.php';

// We need to start sessions, so you should alwasys start sessions using the below code.
session_start();

// if not logged in redirect to login page
// PASSWORD PROTECTED
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// query the db for the profile details
// We don't have the password or email info stored in sessions so instead we can get the results from the DB

$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

?>

<?= template_header('Profile') ?>
<?= template_nav() ?>
<?php
if (isset($_GET['type'])) {
    $_GET['type'] == 'success' ? (success($_GET['msg'])) : (danger($_GET['msg']));
}
?>
<!-- START PAGE CONTENT -->
<div class="columns">
    <?= admin_nav(1) ?>
    <div class="column">
        <?= message() ?>
        <!-- PAGE CONTENT ON THE RIGHT SIDE -->
        <h1 class="title has-text-dark p-3">Profile</h1>
        <p class="px-3">Your account details are below:</p>
        <div class="container">
            <div class="card article my-5">
                <div class="card-content">
                    <div class="media">
                        <div class="media-content ">
                            <div><span class="has-text-weight-bold">Username: </span><?= $_SESSION['name'] ?></div>
                            <div><span class="has-text-weight-bold">Password: </span><?= $password ?></div>
                            <div><span class="has-text-weight-bold">Email: </span><?= $email ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RIGHT CONTENT COLUMN-->
</div>

<!-- END PAGE CONTENT -->

<?= template_footer() ?>