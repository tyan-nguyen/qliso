<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bm_examination".
 *
 * @property int $id
 * @property string $name
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 * @property int|null $id_iso
 *
 * @property BmWorking[] $bmWorkings
 * @property BmIso $iso
 */
class BmExamination extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_examination';
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
            [['user_created', 'id_iso'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['id_iso'], 'exist', 'skipOnError' => true, 'targetClass' => BmIso::class, 'targetAttribute' => ['id_iso' => 'id']],
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
            'id_iso' => 'Id Iso',
        ];
    }

    /**
     * Gets query for [[BmWorkings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBmWorkings()
    {
        return $this->hasMany(BmWorking::class, ['id_examination' => 'id']);
    }

    /**
     * Gets query for [[Iso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIso()
    {
        return $this->hasOne(BmIso::class, ['id' => 'id_iso']);
    }
}
