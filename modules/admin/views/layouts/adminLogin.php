<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAdminAsset;
AppAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/stylesheets/theme.css" />
		<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/stylesheets/skins/default.css" />
		<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/stylesheets/theme-custom.css">
		<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/modernizr/modernizr.js"></script>
		<link rel="shortcut icon" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/icon/logo.ico" type="image/x-icon"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<!-- -------- body start  -->
<?php $this->beginBody() ?>
<?= $content ?>

<!-- -------- body end  -->
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/jquery/jquery.js"></script>
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<!-- Theme Base, Components and Settings -->
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/javascripts/theme.js"></script>
<!-- Theme Custom -->
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/javascripts/theme.custom.js"></script>
<!-- Theme Initialization Files -->
<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/javascripts/theme.init.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
