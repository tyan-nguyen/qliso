<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>




<?php $form = ActiveForm::begin([
      //'action' => '',
      'method' => 'get',
      'id'=>'frm-search',
      'options' => ['data-pjax' => true ]
  ]); ?>
<div class="input-group">

   <div class="form-group">
                <label>Chọn khoảng thời gian:<br/>(Ví dụ: 01/01/2021 - 31/12/2021)</label>

                <div class="input-group">
                	<div class="input-group-addon">
                    	<i class="fa fa-calendar"></i>
                 	</div>
				  <?= Html::activeInput('text', $model, 'search_tu_ngay', ['id'=>'txtSearchTuNgay','class' => 'form-control','placeholder'=>'Nhập từ khóa tìm kiếm']) ?>

				  <div class="input-group-btn">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				  </div>
				</div>

              </div>
              <!-- /.form group -->


    <!-- <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm" /> -->


    <div class="input-group-btn">

        <div class="btn-group" role="group">
            <div class="dropdown dropdown-lg">
                <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button> -->



            </div>

        </div>

    </div>

</div>
<?php ActiveForm::end(); ?>



<style type="text/css">

.dropdown.dropdown-lg .dropdown-menu {
    margin-top: -1px;
    padding: 6px 20px;
}
.input-group-btn .btn-group {
    display: flex !important;
}
.btn-group .btn {
    border-radius: 0;
    margin-left: -1px;
}
.btn-group .btn:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
.btn-group .form-horizontal .btn[type="submit"] {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.form-horizontal .form-group {
    margin-left: 0;
    margin-right: 0;
}
.form-group .form-control:last-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.dropdown-menu1 {
        width: 288px;

    }
@media screen and (max-width: 768px) {
    #adv-search {
        /*width: 500px;*/
        /*margin: 0 auto;*/
    }
    .dropdown.dropdown-lg {
        position: inherit !important;

    }
    .dropdown.dropdown-lg .dropdown-menu {
        width: 100%;
    }
}
</style>