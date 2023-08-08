<?php

namespace app\modules\manage\controllers;

use yii\web\Controller;
use yii\db\Query;
use app\modules\admin\models\Teacher;
use app\modules\admin\models\ClassGroup;
use app\modules\admin\models\Room;
use app\modules\admin\models\Student;

/**
 * controller process ajax for select2
 */
class SelectController extends Controller
{
	/**
     * return list teacher search in select 2 ajax
     */
    public function actionTeacherList($q = null, $id = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, teacher_name AS text')
    		->from('teacher')
    		->where(['like', 'teacher_name', $q])
    		->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => Teacher::find($id)->teacher_name];
    	}
    	return $out;
    }    
    
    /**
     * return list subject search in select 2 ajax
     */
    public function actionSubjectList($q = null, $id = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, subject_name AS text')
    		->from('subject')
    		->where(['like', 'subject_name', $q, false])
    		->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => Subject::find($id)->subject_name];
    	}
    	return $out;
    }
    /**
     * return list class group search in select 2 ajax
     */
    public function actionClassGroupList($q = null, $id = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, class_code AS text')
    		->from('class_group')
    		->where(['like', 'class_code', $q])
    		->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => ClassGroup::find($id)->class_code];
    	}
    	return $out;
    }
    
    /**
     * return list student search in select 2 ajax
     */
    public function actionStudentList($q = null, $id = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, student_card AS text')
    		->from('student')
    		->where(['like', 'student_card', $q])
    		->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => Student::find($id)->student_card];
    	}
    	return $out;
    }    
    
    /**
     * get room by parent select2 ajax
     */
    public function actionGetListRoomByParent($parent){
    	$data= Room::find()->where(['room_parent' => $parent])->all();
    	$html="<option value=''>-Chọn-</option>";
    	foreach ($data as $key => $value) {
    		$html.="<option value='".$value->id."'>".$value->room_name."</option>";
    	}
    	return $html;
    }
    
    /**
     * return list room search in select 2 ajax
     */
    public function actionGetListRoomByNameAndParent($q = null, $idParent = null) {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$out = ['results' => ['id' => '', 'text' => '']];
    	if (!is_null($q)) {
    		$query = new Query();
    		$query->select('id, room_name AS text')
    		->from('room')
    		->where(['like', 'room_name', $q]);
    		if($idParent > 0){
    			$query = $query->andWhere(['room_parent'=>$idParent]);
    		}
    		
    		$query = $query->limit(20);
    		$command = $query->createCommand();
    		$data = $command->queryAll();
    		$out['results'] = array_values($data);
    	}
    	/* elseif ($id > 0) {
    		$out['results'] = ['id' => $id, 'text' => Teacher::find($id)->teacher_name];
    	} */
    	return $out;
    }    
}
