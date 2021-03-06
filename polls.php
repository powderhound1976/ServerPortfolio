<?php

$pdo = pdo_connect_mysql();
$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers
                     FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id
                     GROUP BY p.id');
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
$type = isset($_GET['type']) ?: '';
$msg = isset($_GET['msg']) ?: '';

// Connect to MySQL


// query that sellects all the polls from databse




?>

<?= message() ?>

<!-- START PAGE CONTENT -->
<h1 class="title has-text-dark p-3">Polls Page</h1>
<p>Welcome, view our list of polls below.</p>
<a href="poll-create.php" class="button is-primary is-small">
    <span class="icon"><i class="fas fa-plus-square"></i></span>
    <span>Create Poll</span>
</a>
<br><br>
<div class="container">
    <table class="table is-hoveraeble is-bordered">
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Answers</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($polls as $poll) : ?>
                <tr>
                    <td>
                        <?= $poll['id'] ?>
                    </td>
                    <td>
                        <?= $poll['title'] ?>
                    </td>
                    <td>
                        <?= $poll['answers'] ?>
                    </td>
                    <td>
                        <a href="poll-vote.php?id=<?= $poll['id'] ?>" class="button is-link is-small" title="View Poll">
                            View &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon"><i class="fas fa-eye"></i></span>
                        </a>
                        </br></br>
                        <a href="poll-delete.php?id=<?= $poll['id'] ?>" class="button is-danger is-small">
                            Delete&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon"><i class="fas fa-trash-alt"></i></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- END PAGE CONTENT -->

<?= template_footer() ?>