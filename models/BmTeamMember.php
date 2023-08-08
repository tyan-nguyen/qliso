<?php

namespace app\models;

use Yii;

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
class BmTeamMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_team_member';
    }

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
            'id_working' => 'Id Working',
            'id_position' => 'Id Position',
            'id_user' => 'Id User',
            'summary' => 'Summary',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }
}
