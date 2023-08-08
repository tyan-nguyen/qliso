<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use app\modules\user\models\UserProfile;

class User extends \webvimark\modules\UserManagement\models\User
{
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
