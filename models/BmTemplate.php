<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_template".
 *
 * @property int $id
 * @property string $name
 * @property string|null $summary
 * @property string|null $code
 * @property string|null $file_name
 * @property int|null $is_default
 * @property string|null $date_created
 * @property int|null $user_created
 */
class BmTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['summary'], 'string'],
            [['is_default', 'user_created'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'code', 'file_name'], 'string', 'max' => 200],
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
            'summary' => 'Summary',
            'code' => 'Code',
            'file_name' => 'File Name',
            'is_default' => 'Is Default',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }
}
