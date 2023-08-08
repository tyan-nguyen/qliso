<?php

namespace app\modules\user\models;

use Yii;
use app\modules\admin\models\Room;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $address
 * @property string|null $position
 * @property int $room_id
 */
class UserProfile extends \app\models\UserProfile
{
    public $idRoomParent;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'room_id'], 'required'],
            [['room_id', 'idRoomParent'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 11],
            [['address', 'position'], 'string', 'max' => 200],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Họ tên',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'position' => 'Chức vụ',
            'room_id' => 'Phòng/ban',
            'idRoomParent'=>'Nhóm phòng/ban'
        ];
    }
    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
    
}
