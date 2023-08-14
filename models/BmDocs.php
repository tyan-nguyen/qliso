<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_docs".
 *
 * @property int $id
 * @property int $id_type
 * @property int $id_group
 * @property string|null $code
 * @property string|null $doc_name
 * @property string|null $doc_ext
 * @property string|null $doc_url
 * @property string|null $summary
 * @property int|null $user_created
 * @property string|null $date_created
 * @property string|null $doc_no
 * @property string|null $doc_summary
 * @property string|null $doc_date
 * @property string|null $doc_sign
 * @property int|null $doc_year
 * @property int|null $id_room
 * @property int|null $id_dm
 *
 * @property BmDocgroup $group
 * @property BmDoctype $type
 */
class BmDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_type', 'id_group'], 'required'],
            [['id_type', 'id_group', 'user_created', 'doc_year', 'id_room', 'id_dm'], 'integer'],
            [['summary', 'doc_summary'], 'string'],
            [['date_created', 'doc_date'], 'safe'],
            [['code', 'doc_name', 'doc_url'], 'string', 'max' => 200],
            [['doc_ext'], 'string', 'max' => 20],
            [['doc_no'], 'string', 'max' => 40],
            [['doc_sign'], 'string', 'max' => 100],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => BmDocgroup::class, 'targetAttribute' => ['id_group' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => BmDoctype::class, 'targetAttribute' => ['id_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_type' => 'Id Type',
            'id_group' => 'Id Group',
            'code' => 'Code',
            'doc_name' => 'Doc Name',
            'doc_ext' => 'Doc Ext',
            'doc_url' => 'Doc Url',
            'summary' => 'Summary',
            'user_created' => 'User Created',
            'date_created' => 'Date Created',
            'doc_no' => 'Doc No',
            'doc_summary' => 'Doc Summary',
            'doc_date' => 'Doc Date',
            'doc_sign' => 'Doc Sign',
            'doc_year' => 'Doc Year',
            'id_room' => 'Id Room',
            'id_dm' => 'Id Dm',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(BmDocgroup::class, ['id' => 'id_group']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(BmDoctype::class, ['id' => 'id_type']);
    }
}
