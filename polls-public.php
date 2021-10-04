<?php
require 'config.php';

session_start();


$type = isset($_GET['type']) ?: '';
$msg = isset($_GET['msg']) ?: '';

// Connect to MySQL
$pdo = pdo_connect_mysql();

// query that sellects all the polls from databse

$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers
                     FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id
                     GROUP BY p.id');

$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?= template_header('Polls') ?>
<?= template_nav() ?>
<?= message() ?>

<div class="dark">
    <div class="hero container">
        <!-- START PAGE CONTENT -->
        <h1 class="title is-1 ml-5 pl-5">Poll Maker</h1>
        <p class="subtitle ml-5 pl-5">The easiest way to create and deploy a poll!</p>
    </div>
</div>
<div class="grid container">

    <?php foreach ($polls as $poll) : ?>

        <div class="card card1">
            <div class="card-content card-grid">
                <div class="media">
                    <div class="media-content ">
                        <p class="is-3 card-text"><?= $poll['title'] ?>
                        </p>

                    </div>
                </div>
                <div class="view-poll">
                    <a href="poll-vote.php?id=<?= $poll['id'] ?>" class="button is-dark" title="View Poll">
                        View Poll&nbsp;&nbsp;&nbsp;<span class="icon"><i class="fas fa-eye"></i></span>
                    </a>
                </div>
            </div>
        </div>


    <?php endforeach; ?>
</div>
</tbody>
</table>

<!-- END PAGE CONTENT -->

<?= template_footer() ?>