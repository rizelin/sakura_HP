<!-- header -->
<?require_once("./require/header.php");?>

<div id="title_name"><h1>ログインページ</h1></div>
<?php if(!isset($_SESSION['id'])){ ?>
  <form class="login_form" action="./" method="post">
      <input type="text" name="id" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" class="login_button" name="" value="ログイン">
  </form>
<?php } ?>

<?require_once("./require/footer.php");?>
