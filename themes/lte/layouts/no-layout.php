<?php 
use yii\helpers\Html;
use app\assets\PhieuAsset;
use app\assets\AppAsset;
AppAsset::register($this);
PhieuAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= Yii::$app->charset ?>">
   	<?= Html::csrfMetaTags() ?>
  	<title><?= $this->title ?></title>
  	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="p-wrapper">
<!-- <div class="p-header">

<div class="p-logo">
	<img src="<?= Yii::getAlias('@web/images/logo.png') ?>" />
</div>
<div class="p-text">
	<div class="school-name">Trường Đại học Trà Vinh</div>
	<div class="school-slogan">Mang lại cơ hôi học tập chất lượng cho cộng đồng</div>
	<hr/>
</div>
</div>
 -->
 
<?= $content ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>