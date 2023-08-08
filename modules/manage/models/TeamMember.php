<?php

namespace app\modules\manage\models;

use Yii;
use webvimark\modules\UserManagement\models\User;

/**
 * This is the model class for table "bm_team_member".
 *
 * @property int $id
 * @property int $id_working
 * @property int $id_position
 * @property int $id_user
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class TeamMember extends \app\models\BmTeamMember
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_working', 'id_position', 'id_user'], 'required'],
            [['id_working', 'id_position', 'id_user', 'user_created'], 'integer'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_working' => 'Cuộc họp',
            'id_position' => 'Chức vụ',
            'id_user' => 'Thành viên',
            'summary' => 'Ghi chú',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
        ];
    }
    
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'id_user']);
    }
    
    /**
     * Gets query for [[TeamPostion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberPosition()
    {
        return $this->hasOne(TeamPostion::className(), ['id' => 'id_position']);
    }
    
    /**
     * Gets query for [[Working]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberWorking()
    {
        return $this->hasOne(Working::className(), ['id' => 'id_working']);
    }
    
    /**
     * before save
     * set ngay luu, nguoi luu
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->user_created = Yii::$app->user->id;
                $this->date_created = date('Y-m-d H:i:s');
            }
        }
        return true;
    }
    /**
     * show user name
     */
    public function getUserCreated(){
        $user = User::findOne($this->user_created);
        if($user != null)
            return $user->username;
            else
                return '';
    }
}
