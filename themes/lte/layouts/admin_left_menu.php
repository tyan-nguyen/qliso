 <?php
 	use app\models\User;
	use yii\helpers\Html;
	use app\modules\admin\models\ContactStudent;
use app\modules\admin\models\ContactTeacher;
use app\modules\manage\models\Iso;
use app\modules\manage\models\DocGroup;
use app\modules\manage\models\Examination;
 ?>
      <ul class="sidebar-menu" data-widget="tree">
      	<li>
          <a href="<?= Yii::getAlias('@web') ?>/">
            <i class="fa fa-home" aria-hidden="true"></i> <span>Trang chủ</span>
          </a>
        </li>
        
        <li class="header">LỊCH HỌP</li>
        
       	<li><?= Html::a('<i class="fa fa-circle-o"></i> Kho dữ liệu', Yii::getAlias('@web').'/manage/docs/index') ?></li>
        
         <?php if(User::hasRole('role_donvi')) { ?>
         <li><?= Html::a('<i class="fa fa-circle-o"></i> Đơn vị', Yii::getAlias('@web').'/manage/phong-ban') ?></li>
         <?php } ?>
         <?php if(User::hasRole('role_doankiemtra')) { ?>
         <li><?= Html::a('<i class="fa fa-circle-o"></i> Đoàn đánh giá', Yii::getAlias('@web').'/manage/doan-danh-gia') ?></li>
         <?php } ?>       
         
         
         <li class="header">ISO</li>
          <?php 
            $isoList = Iso::find()->all();
            foreach ($isoList as $indexIso => $iso){
          ?>
          
          <li class="treeview">
	          <a href="#">
	            <i class="fa fa-dashboard"></i> <span><?= $iso->name ?></span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<!-- <li><?= Html::a('<i class="fa fa-circle-o"></i> Kiểm tra nội bộ', Yii::getAlias('@web').'/manage/working/index-iso?idiso=' . $iso->id) ?></li>-->
	          	<?php 
	          	    $kyKiemTraTheoIso = Examination::find()->where([
	          	        'id_iso' => $iso->id
	          	    ])->all();
	          	    foreach ($kyKiemTraTheoIso as $indexKkt => $kkt){
	          	    ?>
	          	    <li><?= Html::a('<i class="fa fa-circle-o"></i> Kiểm tra nội bộ', Yii::getAlias('@web').'/manage/working/index-iso?idiso=' 
	          	        . $iso->id . '&idEx='.$kkt->id) ?></li>
	          	    <?php 
	          	    }
	          	
	          	?>
	          	<?php 
	          	    $listDocGroup = DocGroup::find()->where(['id_iso' => $iso->id])->all();
	          	    foreach ($listDocGroup as $indexldg=>$ldg){
	          	?>
	          	
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> ' . $ldg->name, Yii::getAlias('@web').'/manage/docs-iso/index?idiso=' . $iso->id) ?></li>
	          	
	          	<?php } ?>
	          	
	          	<!-- 
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Kiểm tra 1', Yii::getAlias('@web').'/manage/doc-manage/index-iso?idiso=' . $iso->id) ?></li>	 
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Kiểm tra 1', Yii::getAlias('@web').'/manage/doc-manage/index-iso?idiso=' . $iso->id) ?></li>
	          	 -->         		
	          </ul>
	        </li>
          
          <?php  
            }            
          ?> 	

        <?php if(User::hasRole('role_admin')) { ?>
       	<li class="header">CHỨC NĂNG</li>
        	
        	
       	
        
        
         
          <li class="treeview">
	          <a href="#">
	            <i class="fa fa-dashboard"></i> <span>BIỂU MẪU</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Danh sách mẫu', Yii::getAlias('@web').'/manage/template/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Kỳ kiểm tra', Yii::getAlias('@web').'/manage/examination/index') ?></li>	          	
	          	<!-- <li><?= Html::a('<i class="fa fa-circle-o"></i> Lịch họp', Yii::getAlias('@web').'/manage/working/index') ?></li> -->
	          	
	          </ul>
	        </li>
	       <?php } ?>
        
        
         <?php if(User::hasRole('role_admin')) { ?>
	        <li class="treeview">
	          <a href="#">
	            <i class="fa fa-dashboard"></i> <span>DANH MỤC</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Tiêu chuẩn ISO', Yii::getAlias('@web').'/manage/iso/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Loại tài liệu', Yii::getAlias('@web').'/manage/doc-type/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Nhóm tài liệu', Yii::getAlias('@web').'/manage/doc-group/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Chức vụ', Yii::getAlias('@web').'/manage/team-postion/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Phòng ban/Bộ môn', Yii::getAlias('@web').'/admin/room/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Khoa', Yii::getAlias('@web').'/admin/room-parent/index') ?></li>
	          	<li><?php // Html::a('<i class="fa fa-circle-o"></i> Tin tức', Yii::getAlias('@web').'/admin/news/index') ?></li>
	          	
	          </ul>
	        </li>
        <?php } ?>
        
	     
	     <?php if(User::hasRole('role_admin')) { ?>
	         <li class="treeview">
	          <a href="#">
	            <i class="fa fa-users"></i> <span>NGƯỜI DÙNG</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Quản lý tài khoản', Yii::getAlias('@web').'/user/user/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Quản lý truy cập', Yii::getAlias('@web').'/user/user-visit-log') ?></li>
	          </ul>
	        </li>
        <?php } ?>
        
        <?php if(User::hasRole('role_admin')) { ?>
        	<li><?= Html::a('<i class="fa fa-line-chart"></i> LƯỢT TRUY CẬP', Yii::getAlias('@web').'/admin/thong-ke-truy-cap') ?></li>
        <?php } ?>
        
         <?php /* if(User::hasRole('role_lienHe')) {
         	$numNewContact = ContactStudent::find()->where(['status'=>1])->count();
         	$numNewTeacherContact = ContactTeacher::find()->where(['status'=>1])->count();
         ?>
	        <li class="header">LIÊN HỆ</li>
	        <li><?= Html::a('<i class="glyphicon glyphicon-comment"></i> Liên hệ (SV) '. 
	        		($numNewContact> 0 ? ('<span class="label label-warning">'.$numNewContact.' mới</span>') : ''), 
	        		Yii::getAlias('@web').'/admin/contact-student/index') ?></li>
	        <li><?= Html::a('<i class="glyphicon glyphicon-comment"></i> Liên hệ (GV) '. 
	        		($numNewTeacherContact> 0 ? ('<span class="label label-warning">'.$numNewTeacherContact.' mới</span>') : ''), 
	        		Yii::getAlias('@web').'/admin/contact-teacher/index') ?></li>
	        		
      	<?php }*/ ?>
        
        <?php if(User::hasPermission('per_macdinh')) { ?>
	        <li class="header">TÀI KHOẢN CỦA BẠN</li>
	        <li><?= Html::a('<i class="fa fa-circle-o text-yellow"></i> Thay đổi mật khẩu', Yii::getAlias('@web').'/user/auth/change-own-password') ?></li>
	        <li><?= Html::a('<i class="fa fa-circle-o text-aqua"></i> Đăng xuất', Yii::getAlias('@web').'/user/auth/logout') ?></li>
      	<?php } ?>
      	
      </ul>