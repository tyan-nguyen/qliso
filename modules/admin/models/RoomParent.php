<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "room_parent".
 *
 * @property int $id
 * @property string $room_name
 */
class RoomParent extends \app\models\RoomParent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_name'], 'required'],
            [['room_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_name' => 'Tên khoa',
        ];
    }
    
    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasss()
    {
    	return $this->hasMany(Classs::className(), ['id_room_parent' => 'id']);
    }
    
    /**
     * get list khoa
     */
    public function getList(){
    	$list = $this::find()->asArray()->all();
    	return ArrayHelper::map($list, 'id', 'room_name');
    }
}
