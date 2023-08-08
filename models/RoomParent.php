<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_parent".
 *
 * @property int $id
 * @property string $room_name
 */
class RoomParent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_parent';
    }

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
            'room_name' => 'Room Name',
        ];
    }
    
}
