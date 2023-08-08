<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $room_parent
 * @property string $room_code
 * @property string $room_name
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

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
            'room_parent' => 'Room Parent',
            'room_code' => 'Room Code',
            'room_name' => 'Room Name',
        ];
    }
}
