<?php
require 'config.php';

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
<?= template_header('Home') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="columns">
    <?= admin_nav(2) ?>
    <div class="column p-3">
        <?php include 'pollscards.php'; ?>
    </div>
    <!-- END RIGHT CONTENT COLUMN-->
</div>