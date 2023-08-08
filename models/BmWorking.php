<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_working".
 *
 * @property int $id
 * @property string|null $code
 * @property int $id_examination
 * @property int $id_room
 * @property string|null $date_exam
 * @property string|null $date_created
 * @property int|null $user_created
 * @property string|null $summary
 * @property int|null $id_template_group
 * @property int|null $id_template_single
 */
class BmWorking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_working';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_examination', 'id_room'], 'required'],
            [['id_examination', 'id_room', 'user_created', 'id_template_group', 'id_template_single'], 'integer'],
            [['date_exam', 'date_created'], 'safe'],
            [['summary'], 'string'],
            [['code'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'id_examination' => 'Id Examination',
            'id_room' => 'Id Room',
            'date_exam' => 'Date Exam',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
            'summary' => 'Summary',
            'id_template_group' => 'Id Template Group',
            'id_template_single' => 'Id Template Single',
        ];
    }
}
