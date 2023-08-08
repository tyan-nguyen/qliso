<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $room_parent
 * @property string $room_code
 * @property string $room_name
 */
class Room extends \app\models\Room
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_parent', 'room_code', 'room_name'], 'required'],
            [['room_parent'], 'integer'],
            [['room_code'], 'string', 'max' => 20],
            [['room_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_parent' => 'Khoa',
            'room_code' => 'Mã phòng/bộ môn',
            'room_name' => 'Tên phòng/bộ môn',
        ];
    }
    
    /**
     * get list room by khoa
     */
    public function getListByParent($parent){
    	$list = $this::find()->where(['room_parent'=>$parent])->asArray()->all();
    	return ArrayHelper::map($list, 'id', 'room_name');
    }
    
    /**
     * Gets query for [[RoomParent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoomParent()
    {
    	return $this->hasOne(RoomParent::className(), ['id' => 'room_parent']);
    }
    
    /**
     * get list room
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'room_name');
    }
}
