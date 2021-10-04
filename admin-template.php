<?php
require 'config.php';

//additional php code for this page goes here

?>
<?= template_header('Home') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="columns">
    <?= admin_nav() ?>
    <div class="column">
        <?= message() ?>
        <!-- PAGE CONTENT ON THE RIGHT SIDE -->
        <h1 class="title"> Page Title Goes Here </h1>
        <p> This is where page content goes. </p>
    </div>
    <!-- END RIGHT CONTENT COLUMN-->
</div>


<?= template_footer() ?>