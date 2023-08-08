<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_document".
 *
 * @property int $id
 * @property int $id_working
 * @property string|null $document_name
 * @property string|null $document_url
 * @property string|null $document_type
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class BmDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_working'], 'required'],
            [['id_working', 'user_created'], 'integer'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['document_name', 'document_url'], 'string', 'max' => 200],
            [['document_type'], 'string', 'max' => 20],
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
            'document_name' => 'Document Name',
            'document_url' => 'Document Url',
            'document_type' => 'Document Type',
            'summary' => 'Summary',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }
}
