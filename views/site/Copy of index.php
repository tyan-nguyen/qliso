<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'HỆ THỐNG KHẢO SÁT';
?>

<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getOnline()); ?></h3>

              <p>Đang truy cập</p>
            </div>
            <div class="icon">
              <i class="fa  fa-clock-o"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getToday()) ?></h3>

              <p>Hôm nay</p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getYesterday()) ?></h3>

              <p>Hôm qua</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= number_format(Yii::$app->userCounter->getTotal()); ?></h3>

              <p>Tổng truy cập</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      
<div class="row">
	<div class="col-md-6">
		<div class="d-cover">		
		</div>
	</div>
	<div class="col-md-3 col-xs-12">
			<?php 
				foreach ($surveyCourses as $indexSc => $sc){
					if($sc->sumPaper > 0)
						$percent = round($sc->sumPaperDone/$sc->sumPaper, 2) *100;
					else 
						$percent = 0;
			?>
				<!-- Info Boxes Style 2 -->
	          <div class="info-box bg-<?= $percent<50?'yellow':'green' ?>">
	            <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
	
	            <div class="info-box-content">
	              <span class="info-box-text"><?= $sc->survey->show_name ?> (<?= $sc->course->name ?>)</span>
	              <span class="info-box-number"><?= $sc->sumPaperDone ?> phiếu</span>
	
	              <div class="progress">
	                <div class="progress-bar" style="width: <?= $percent ?>%"></div>
	              </div>
	              <span class="progress-description">
	                    <?= $percent ?>% trong tổng <?= $sc->sumPaper ?> phiếu
	                  </span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
			<?php } ?>

        </div>
        
        <div class="col-md-3 col-xs-12">
        
        	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Liên hệ</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
              <?php 
              	foreach ($contactStudent as $indexContact=>$contact){
              ?>
              	<li class="item">
                  <div class="product-img">
                    <img src="<?= Yii::getAlias('@web/images/user.png') ?>" alt="SV Image">
                  </div>
                  <div class="product-info">
                  	<?= $contact->getTypeText() ?> <br/>
                    <a href="javascript:void(0)" class="product-title"><?= $contact->student->student_card ?>
                      <?= $contact->getStatusText() ?></a>
                    <span class="product-description content-less-400">
                          <?= $contact->content_student ?>
                    </span>
                   
                  </div>
                </li>
              <?php 
              	}
              ?>

              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?= Yii::getAlias('@web/admin/contact-student/index')?>" class="uppercase">Xem thêm</a>
            </div>
            <!-- /.box-footer -->
          </div>
        
        </div>
</div>