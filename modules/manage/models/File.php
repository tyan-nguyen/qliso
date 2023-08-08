<?php

namespace app\modules\manage\models;

use Yii;
use app\models\Custom;

/**
 * This is the model class for table "bm_working".
 */
class File
{
    CONST DRIVE_PATH = 'https://docs.google.com/document/d/';
    
    public $idWorking;
    public function findWorking(){
        $working = Working::findOne($this->idWorking);
        return $working;
    }
    public function createWorkingFolder(){
        $working = $this->findWorking();
        if($working != NULL){
            if($this->createFolder($working->code))
                return true;
            else 
                return false;
        } else 
            return false;
    }
    
    public function createFolder($name){
        $dir = Yii::getAlias('@webroot/results/' . $name );
        if (!file_exists($dir)) {
            return mkdir($dir, 0777, true);
        } else 
            return true;
    }
}