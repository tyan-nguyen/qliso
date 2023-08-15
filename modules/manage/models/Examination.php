<?php

namespace app\modules\manage\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bm_examination".
 *
 * @property int $id
 * @property string $name
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
* @property int|null $id_iso
 *
 * @property BmWorking[] $bmWorkings
 * @property BmIso $iso
 */
class Examination extends \app\models\BmExamination
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'id_iso'], 'required'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['user_created', 'id_iso'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên kỳ đánh giá',
            'summary' => 'Ghi chú',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
            'id_iso' => 'Thuộc ISO',
        ];
    }
    
    /**
     * Gets query for [[Iso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIso()
    {
        return $this->hasOne(Iso::className(), ['id' => 'id_iso']);
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
    
    /**
     * get list examination by iso
     */
    public function getListByIso($idiso){
        $list = $this::find()->where([
            'id_iso' => $idiso
        ])->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
    
}
