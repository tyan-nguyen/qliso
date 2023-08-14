<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_dm".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_created
 * @property int|null $user_created
 */
class BmDm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_dm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Name',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }
}
