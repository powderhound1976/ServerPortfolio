<?php
require 'config.php';
session_start();
admin_check();
// Connect to MySQL
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    // Get the contact from the DB
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $polls = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$polls) {
        $msg = 'Something went wrong! Poll doesn\'t exist with that id.';
        redirect('polls-admin.php', $msg, 'danger');
    }

    if (!empty($_POST)) {
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $poll_id = isset($_POST['poll_id']) ? $_POST['poll_id'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $published = $blogs['published'] + 1;
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');

        $stmt = $pdo->prepare('UPDATE poll_post SET id = ?, title = ?, author_name = ?, content = ?, published = ?, created = ? WHERE id = ?');
        $stmt->execute([$_GET['id'], $title, $author_name, $content, $published, $created, $_GET['id']]);
        $msg = 'Updated successfully!';
        var_dump($blogs['published']);
        // redirect('blog-admin.php', $msg, 'success');
    }
} else {
    $msg = 'Something went wrong! No ID was specified.';
    redirect('blog-admin.php', $msg, 'danger');
}

?>

<?= template_header('Contact Update') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="columns">
    <?= admin_nav(2) ?>
    <div class="column">
        <h1 class="title">Blog Update</h1>

        <form action="poll-update.php?id=<?= $poll['id'] ?>" method="post" class="">
            <textarea class="field">
                <label for="" class="label">Title</label>
                <div class="control">
                    <input type="text" name="title" class="input" value="<?= $poll['id'] ?>" required>
                </div>
            </textarea>
            <div class="field">
                <label for="" class="label">Author Name</label>
                <div class="control">
                    <input type="text" name="author_name" class="input" value="<?= $poll['title'] ?>" required>
                </div>
            </div>
            <div class="field">
                <label for="" class="label">Content</label>
                <div class="control">
                    <textarea name="content" id="" style="width:100%; height:600px;" class="" value="" required><?= $poll['answers'] ?></textarea>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input type="submit" class="button" value="Update">
                </div>
            </div>
        </form>
        <!-- END PAGE CONTENT -->

        <?= template_footer() ?>