<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\user\models\UserProfile;

class User extends \webvimark\modules\UserManagement\models\User
{
    public static function getCuUser(){
        return User::findOne(Yii::$app->user->id);
    }
    
    public static function getUserRoom(){
        if(User::getCuUser() != null)
            return User::getCuUser()->info->room_id;
        else 
            return NULL;
    }
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInfo()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'id']);
    }
    /**
     * get list usser by username
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'username');
    }
    /**
     * get list usser by long name
     */
    public function getListLong(){
        $list = $this::find()->alias('t')
            ->joinWith(['info as if', 'info.room as r'])
            ->select(['t.id', "CONCAT(t.username, ' - ', if.name, ' - ', r.room_name) as longname"])->asArray()->all();
        return ArrayHelper::map($list, 'id', 'longname');
    }
}
