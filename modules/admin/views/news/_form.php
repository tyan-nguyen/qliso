<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<!-- editor -->
<script src="<?= Yii::getAlias('@web') ?>/assets/editor/tinymce/tinymce.min.js"></script>

<div class="row news-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class="col-md-3">
    	<?= $form->field($model, 'type')->dropDownList($model->getType(), ['prompt'=>'-Chọn-']) ?>
    </div>
    <div class="col-md-3">
    	<?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-md-3">
    	<?= $form->field($model, 'level')->textInput(['maxlength' => true])?>
	</div>
    <div class="col-md-3">
    	<label>&nbsp;</label>
    	<?= $form->field($model, 'public')->checkbox() ?>
	</div>
	
	<div class="col-md-12">
    	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-md-12">
    	<?= !$model->isNewRecord ? $form->field($model, 'slug')->textInput(['maxlength' => true]) : '' ?>
	</div>
	<div class="col-md-12">
    	<?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
	</div>
	<div class="col-md-12">
    	<?= $form->field($model, 'content')->textarea(['id' => 'txtContent', 'rows' => 6]) ?>
	</div>	
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Lưu lại', ['class' => 'btn btn-lg btn-block btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script>

tinymce.remove();
//editor for content
tinymce.init({
	selector: "#txtContent",
	branding: false,
	statusbar: false,
	plugins: "media,image,paste,table,code,link,lists,advlist,responsivefilemanager,hr",
	menubar: 'edit view insert format table',
	toolbar: 'autolink | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist hr | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link unlink anchor codesample | ltr rtl | responsivefilemanager',
  	toolbar_sticky: true,
	paste_data_images: true,
	image_advtab: true,
	image_title: true,
	//images_upload_url: "<?= Yii::getAlias('@web') . '/assets/editor/upload.php' ?>", //upload img tab
	//images_upload_credentials: true,
	relative_urls : false,
	remove_script_host : true,
	document_base_url : "/",
	convert_urls : true,
	height : "500",
	
	external_filemanager_path:"<?= Yii::getAlias('@web') ?>/filemanager/filemanager/",
	filemanager_title:"QUẢN LÝ FILE" ,
	external_plugins: { "filemanager" : "<?= Yii::getAlias('@web') ?>/filemanager/filemanager/plugin.min.js"},
	filemanager_access_key: "<?= \app\models\User::hasRole('admin') ? '1fdb7184e697ab9355a3f1438ddc6ef9' : '' ?>",

	language_url : '<?= Yii::getAlias('@web')?>/assets/editor/tinymce/langs/vi.js',
		
	setup: function (editor) {
	    editor.on('change', function () {
	        tinymce.triggerSave();
	    });
	}
});

//prevent Bootstrap from hijacking TinyMCE modal focus
$(document).on('focusin', function(e) {
  if ($(e.target).closest(".mce-window").length) {
    e.stopImmediatePropagation();
  }
});
</script>

