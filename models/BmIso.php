<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_iso".
 *
 * @property int $id
 * @property string $name
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 *
 * @property BmExamination[] $bmExaminations
 */
class BmIso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_iso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['summary'], 'string'],
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
            'summary' => 'Summary',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }

    /**
     * Gets query for [[BmExaminations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBmExaminations()
    {
        return $this->hasMany(BmExamination::class, ['id_iso' => 'id']);
    }
}
