<?php
require 'config.php';

session_start();

?>

<?= template_header('Login') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="dark">
  <div class="hero container">
    <!-- START PAGE CONTENT -->
    <h1 class="title is-1 ml-5 pl-5">Login</h1>
    <p class="subtitle ml-5 pl-5">Subtitle</p>
  </div>
</div>
<div class="container">
  <form action="authenticate.php" method="post">
    <div class="field">
      <p class="control has-icons-left">
        <input name="username" class="input" type="text" placeholder="Username" required>
        <span class="icon is-small is-left">
          <i class="fas fa-user"></i>
        </span>
      </p>
    </div>
    <div class="field">
      <p class="control has-icons-left">
        <input name="password" class="input" type="password" placeholder="Password" required>
        <span class="icon is-small is-left">
          <i class="fas fa-lock"></i>
        </span>
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button class="button is-success">
          Login
        </button>
      </p>
    </div>
    <a href="register.php" class="button">Sign Up</a>
  </form>
</div>
<!-- END PAGE CONTENT -->

<?= template_footer() ?>