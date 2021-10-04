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
<h1 class="title has-text-dark p-3">Poll Manager</h1>
<p class="px-3">Use the options below to manage your current poll's</p>
<div class="container"><a href="poll-create.php" class="button is-primary is-small">
    <span class="icon"><i class="fas fa-plus-square"></i></span>
    <span>Create Poll</span>
  </a></div>
<!-- START PAGE CONTENT -->
<?php foreach ($polls as $poll) : ?>
  <!-- START ARTICLE -->
  <div class="container">

    <div class="card article my-5">

      <div class="card-content">
        <div class="media">
          <div class="media-content ">
            <h2 class="title has-text-dark is-4">Poll title: <?= $poll['title'] ?>
            </h2>


            <div class="container p-5">
              <div class="content article-body"><span class="has-text-weight-bold">Answers: </span><?= $poll['answers'] ?>
              </div>

              <a href="poll-vote.php?id=<?= $poll['id'] ?>" class="button is-small" title="View Poll">
                View &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon"><i class="fas fa-eye"></i></span>
              </a>

              <a href="poll-delete.php?id=<?= $poll['id'] ?>" class="button is-small">
                Delete&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon"><i class="fas fa-trash-alt"></i></span>
              </a>
            </div>


          </div>
        </div>
      </div>

    </div>
  <?php endforeach; ?>
  <!-- END PAGE CONTENT -->