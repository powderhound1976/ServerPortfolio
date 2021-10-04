<?php
require 'config.php';

// Connect to MySQL
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$poll) {
        redirect('polls-admin.php', 'Poll does not exist with that ID.', 'danger');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM polls WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $stmt = $pdo->prepare('DELETE FROM poll_answers WHERE poll_id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the poll.';
            redirect('polls-admin.php', $msg, 'success');
        } else {
            header('Location: polls-admin.php');
            exit;
        }
    }
} else {
    redirect('polls-admin.php', 'No ID Specified', 'danger');
}

?>

<?= template_header('Delete Poll') ?>
<?= template_nav() ?>
<?= message() ?>
<!-- START PAGE CONTENT -->
<div class="columns">
    <?= admin_nav(4) ?>
    <div class="column">
        <h1 class="title has-text-dark p-3">Delete Poll</h1>
        <h2 class="px-3">Are you sure you want to delete poll number: <?= $poll['id'] ?></h2>
        <a href="poll-delete.php?id=<?= $poll['id'] ?>&confirm=yes" class="button ">Yes</a>
        <a href="poll-delete.php?id=<?= $poll['id'] ?>&confirm=no" class="button ">No</a>
        <!-- END PAGE CONTENT -->

        <?= template_footer() ?>