 <?php
 	use app\models\User;
	use yii\helpers\Html;
	use app\modules\admin\models\ContactStudent;
use app\modules\admin\models\ContactTeacher;
 ?>
      <ul class="sidebar-menu" data-widget="tree">
      	<li>
          <a href="<?= Yii::getAlias('@web') ?>/">
            <i class="fa fa-home" aria-hidden="true"></i> <span>Trang chủ</span>
          </a>
        </li>
        
        <?php if(User::hasRole('role_macDinh')) { ?>
        	<li class="header">CHỨC NĂNG</li>
         <?php } ?>
         
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
	          	
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Chức vụ', Yii::getAlias('@web').'/manage/team-postion/index') ?></li>
	          	
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Lịch họp', Yii::getAlias('@web').'/manage/working/index') ?></li>
	          	
	          </ul>
	        </li>
        
         <?php if(User::hasRole('role_khaoSatSV')) { ?>
	        <li class="treeview">
	          <a href="#">
	            <i class="fa fa-dashboard"></i> <span>KHẢO SÁT SINH VIÊN</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Danh sách khảo sát', Yii::getAlias('@web').'/surveysv/survey-course/index') ?></li>
	          	
	          </ul>
	        </li>
        <?php } ?>
        
         <?php if(User::hasRole('role_mauKhaoSat')) { ?>
	        <li class="treeview">
	          <a href="#">
	            <i class="fa fa-dashboard"></i> <span>MẪU KHẢO SÁT</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Danh sách mẫu', Yii::getAlias('@web').'/ksadmin/survey/index') ?></li>
	          	
	          </ul>
	        </li>
        <?php } ?>
        
         <?php if(User::hasRole('role_danhMuc')) { ?>
	        <li class="treeview">
	          <a href="#">
	            <i class="fa fa-dashboard"></i> <span>DANH MỤC</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Danh sách lớp', Yii::getAlias('@web').'/admin/classs/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Sinh viên', Yii::getAlias('@web').'/admin/student/index') ?></li>
	          	<!-- <li><?= Html::a('<i class="fa fa-circle-o"></i> Nhóm lớp', Yii::getAlias('@web').'/admin/student-class/index') ?></li> -->
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Môn học', Yii::getAlias('@web').'/admin/subject/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Giảng viên', Yii::getAlias('@web').'/admin/teacher/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Phòng ban/Bộ môn', Yii::getAlias('@web').'/admin/room/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Khoa', Yii::getAlias('@web').'/admin/room-parent/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Học kỳ', Yii::getAlias('@web').'/admin/course/index') ?></li>
	          	<li><?= Html::a('<i class="fa fa-circle-o"></i> Tin tức', Yii::getAlias('@web').'/admin/news/index') ?></li>
	          	
	          </ul>
	        </li>
        <?php } ?>
        
	     
	     <?php if(User::hasRole('Admin')) { ?>
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
        
        <?php if(User::hasRole('Admin')) { ?>
        	<li><?= Html::a('<i class="fa fa-line-chart"></i> LƯỢT TRUY CẬP', Yii::getAlias('@web').'/admin/thong-ke-truy-cap') ?></li>
        <?php } ?>
        
         <?php if(User::hasRole('role_lienHe')) {
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
	        		
      	<?php } ?>
        
        <?php if(User::hasRole('role_macDinh')) { ?>
	        <li class="header">TÀI KHOẢN CỦA BẠN</li>
	        <li><?= Html::a('<i class="fa fa-circle-o text-yellow"></i> Thay đổi mật khẩu', Yii::getAlias('@web').'/user/auth/change-own-password') ?></li>
	        <li><?= Html::a('<i class="fa fa-circle-o text-aqua"></i> Đăng xuất', Yii::getAlias('@web').'/user/auth/logout') ?></li>
      	<?php } ?>
      	
      </ul>