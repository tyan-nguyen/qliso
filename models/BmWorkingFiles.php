<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_working_files".
 *
 * @property int $id
 * @property int $id_working
 * @property int|null $id_user
 * @property string $file_name
 * @property string|null $file_type
 * @property string|null $file_url
 * @property string|null $shared_with
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 *
 * @property BmWorking $working
 */
class BmWorkingFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_working_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_working', 'file_name'], 'required'],
            [['id_working', 'id_user', 'user_created'], 'integer'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['file_name', 'file_url', 'shared_with'], 'string', 'max' => 200],
            [['file_type'], 'string', 'max' => 20],
            [['id_working'], 'exist', 'skipOnError' => true, 'targetClass' => BmWorking::class, 'targetAttribute' => ['id_working' => 'id']],
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
            'id_user' => 'Id User',
            'file_name' => 'File Name',
            'file_type' => 'File Type',
            'file_url' => 'File Url',
            'shared_with' => 'Shared With',
            'summary' => 'Summary',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }

    /**
     * Gets query for [[Working]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorking()
    {
        return $this->hasOne(BmWorking::class, ['id' => 'id_working']);
    }
}
