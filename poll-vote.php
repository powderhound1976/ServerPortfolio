<?php
require 'config.php';

session_start();
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the poll record exists with the id specified
    if ($poll) {
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt->execute([$_GET['id']]);
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['poll_answer'])) {
            echo 'test';
            // update the vote answer by 1
            $stmt = $pdo->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt->execute([$_POST['poll_answer']]);
            header('Location: poll-result.php?id=' . $_GET['id']);
            exit;
        }
    } else {
        $msg = 'Something went wrong! A poll with that ID does not exist.';
        redirect('polls.php', $msg, 'danger');
    }
} else {
    $msg = 'Something went wrong! No ID set.';
    redirect('polls.php', $msg, 'danger');
}

?>

<?= template_header('Poll Vote') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="dark">
    <div class="hero container">
        <!-- START PAGE CONTENT -->
        <h1 class="title"><?= $poll['title'] ?></h1>
        <h2 class="subtitle pt-2"><?= $poll['desc'] ?></h2>
    </div>
</div>

<div class="container ">



    <form action="poll-vote.php?id=<?= $_GET['id'] ?>" method="post">
        <?php for ($i = 0; $i < count($poll_answers); $i++) : ?>
            <div class="control">
                <input type="radio" name="poll_answer" value="<?= $poll_answers[$i]['id'] ?>" <?= $i == 0 ? ' checked' : '' ?>>
                <label for="" class="radio">&nbsp;<?= $poll_answers[$i]['title'] ?></label>
            </div>
        <?php endfor; ?>
        <br>
        <div class="field">
            <div class="control">
                <button class="button" value="submit">Vote</button>
            </div>
        </div>
    </form>
    <!-- END PAGE CONTENT -->
</div>
<?= template_footer() ?>