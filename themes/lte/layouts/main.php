<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="<?= Yii::$app->charset ?>">
   <?= Html::csrfMetaTags() ?>
  <title><?= $this->title ?></title>
  <?php $this->head() ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/logo.png" type="image/png" id="favicon" />
	<style>
		.content-wrapper {
		width: auto !important;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= Yii::getAlias('@web') ?>/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">QLISO<?php /* Html::img(Yii::getAlias('@web') . '/pks/img/logo1.png', ['style'=>'width:50px'])*/?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">HỆ THỐNG QLISO<?php /* Html::img(Yii::getAlias('@web') . '/pks/img/logo1.png', ['style'=>'width:50px'])*/?></span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

     <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        	<li class="dropdown user user-menu">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
	              <span class="hidden-xs"><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '' ?></span>
	            </a>
            </li>
		</ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
		<?php include('admin_left_menu.php') ?>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container">
  	<section class="content-header">
      <h1 style="text-transform: uppercase;">
        <?= $this->title ?>
        <!-- <small><?= $this->title ?></small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $this->title ?></li>
      </ol>
    </section>
    
    <!-- <hr style="margin: 10px 15px 0px 15px"/> -->

	<section class="content">
		<?= $content ?>
	</section>
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Hệ thống Quản lý ISO - ver</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> Phòng Đảm bảo chất lượng.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<script>
	$("a[href='<?= Yii::$app->request->url ?>']").parent().addClass('active');
	$("a[href='<?= Yii::$app->request->url ?>']").parent().parent().parent().addClass('active');
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
