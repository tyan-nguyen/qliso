<?php

use yii\helpers\Html;
use app\modules\manage\models\Working;
use app\models\User;

/* @var $this yii\web\View */

$this->title = 'HỆ THỐNG QUẢN LÝ BIỂU MẪU';
?>

<?php 
/* if(User::hasRole('role_admin')){
   echo $this->render('_admin', [
        'examinations' => $examinations
    ]);
} */
?>

<?php 
if(User::hasRole('role_donvi')){
   echo $this->render('_donvi', [
        'examinations' => $examinations
    ]);
}
?>

<?php 
if(User::hasRole('role_doankiemtra')){
   echo $this->render('_doankiemtra', [
        'examinations' => $examinations
    ]);
}
?>