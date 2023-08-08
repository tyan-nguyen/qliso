<?php
use app\modules\manage\models\Working;
?>
<div class="row">
    <div class="col-md-12 col-xs-12">
    	<h2>QUẢN TRỊ</h2>
    </div>
    <?php foreach ($examinations as $indexEx=>$exam) { 
        $workingNumber = Working::find()->where(['id_examination'=>$exam->id])->count();
    ?>
    <div class="col-md-4 col-xs-12">
    
    	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $exam->name ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
              <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3><?= $workingNumber ?></h3>
                    <p>Cuộc họp</p>
                    </div>
                    <div class="icon" style="top:0px">
                    <span class="glyphicon glyphicon-book"></span>
                    </div>
               </div>
        </div>
        <!-- /.box-body -->
        <a style="color:white;text-transform: uppercase;font-style: bold;" href="<?= Yii::getAlias('@web/manage/working/index?idEx=' . $exam->id)?>" class="uppercase">
        <div class="box-footer text-center" style="background-color: #3c8dbc;">
          <span class="glyphicon glyphicon-log-in"></span> &nbsp;Vào quản lý
        </div>
        </a>
        <!-- /.box-footer -->
      </div>
    
    </div>
    
    <?php } ?>
</div>