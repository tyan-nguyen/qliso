<?php

namespace app\modules\manage\models;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bm_iso".
 *
 * @property int $id
 * @property string $name
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 *
 * @property BmExamination[] $bmExaminations
 */
class Iso extends \app\models\BmIso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['user_created'], 'integer'],
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
            'name' => 'Tên ISO',
            'summary' => 'Ghi chú',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[BmExaminations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExaminations()
    {
        return $this->hasMany(Examination::class, ['id_iso' => 'id']);
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
     * get list iso
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
